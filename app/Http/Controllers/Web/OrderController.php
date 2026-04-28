<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // ═══════════════════════════════════════════
    // CHECKOUT — Buat order dari cart
    // ═══════════════════════════════════════════
    public function checkout()
    {
        $userId = Auth::id();

        try {
            $orderId = DB::transaction(function () use ($userId) {
                $cartItems = DB::table('cart_items')
                    ->join('photos', 'cart_items.photo_id', '=', 'photos.id')
                    ->where('cart_items.user_id', $userId)
                    ->where('photos.is_active', true)
                    ->select(
                        'cart_items.id as cart_id',
                        'photos.id as photo_id',
                        'photos.price',
                        'photos.photographer_id'
                    )
                    ->lockForUpdate()
                    ->get();

                if ($cartItems->isEmpty()) {
                    return null;
                }

                $total = $cartItems->sum('price');
                $platformFee = $total * 0.15;
                $photographerAmount = $total - $platformFee;

                $orderId = DB::table('orders')->insertGetId([
                    'user_id' => $userId,
                    'order_code' => 'ORD-'.strtoupper(uniqid()),
                    'total_amount' => $total,
                    'platform_fee' => $platformFee,
                    'photographer_amount' => $photographerAmount,
                    'status' => 'pending',
                    'expired_at' => now()->addHours(24),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                foreach ($cartItems as $item) {
                    DB::table('order_items')->insert([
                        'order_id' => $orderId,
                        'photo_id' => $item->photo_id,
                        'photographer_id' => $item->photographer_id,
                        'price' => $item->price,
                        'photographer_amount' => $item->price * 0.85,
                        'download_token' => Str::uuid(),
                        'created_at' => now(),
                    ]);
                }

                DB::table('cart_items')->where('user_id', $userId)->delete();

                return $orderId;
            });
        } catch (\Exception $e) {
            Log::error('Checkout failed for user_id='.$userId.' msg='.$e->getMessage());

            return redirect()->route('cart.index')
                ->with('error', 'Gagal membuat order. Coba lagi.');
        }

        if (! $orderId) {
            return redirect()->route('cart.index')
                ->with('error', 'Cart kamu kosong atau foto sudah tidak tersedia.');
        }

        return redirect()->route('order.detail', $orderId)
            ->with('success', 'Order berhasil dibuat. Silakan lakukan pembayaran.');
    }

    // ═══════════════════════════════════════════
    // HISTORY — Daftar semua order milik user
    // ═══════════════════════════════════════════
    public function history()
    {
        $orders = DB::table('orders')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('runner.order-history', compact('orders'));
    }

    // ═══════════════════════════════════════════
    // DETAIL — Detail satu order
    // ═══════════════════════════════════════════
    public function detail($id)
    {
        $order = DB::table('orders')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (! $order) {
            abort(404, 'Order tidak ditemukan.');
        }

        $items = DB::table('order_items')
            ->join('photos', 'order_items.photo_id', '=', 'photos.id')
            ->where('order_items.order_id', $id)
            ->select(
                'order_items.*',
                'photos.category',
                'photos.watermark_path'
            )
            ->get()
            ->map(function ($item) {
                $item->watermark_url = env('AWS_URL').'/'.$item->watermark_path;

                return $item;
            });

        return view('runner.order-detail', compact('order', 'items'));
    }

    // ═══════════════════════════════════════════
    // MANUAL PAY — Konfirmasi pembayaran manual
    // ═══════════════════════════════════════════
    public function manualPay($id)
    {
        $userId = Auth::id();

        $order = DB::table('orders')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (! $order) {
            abort(404, 'Order tidak ditemukan.');
        }

        if ($order->status !== 'pending') {
            return redirect()->route('order.detail', $id)
                ->with('error', 'Order sudah diproses sebelumnya.');
        }

        if ($order->expired_at && now()->greaterThan($order->expired_at)) {
            DB::table('orders')
                ->where('id', $id)
                ->where('status', 'pending')
                ->update([
                    'status' => 'expired',
                    'updated_at' => now(),
                ]);

            return redirect()->route('order.detail', $id)
                ->with('error', 'Order sudah expired dan tidak bisa dibayar.');
        }

        try {
            DB::transaction(function () use ($id, $userId) {
                $order = DB::table('orders')
                    ->where('id', $id)
                    ->where('user_id', $userId)
                    ->lockForUpdate()
                    ->first();

                if (! $order) {
                    abort(404, 'Order tidak ditemukan.');
                }

                if ($order->status !== 'pending') {
                    throw new \RuntimeException('Order sudah diproses sebelumnya.');
                }

                if ($order->expired_at && now()->greaterThan($order->expired_at)) {
                    DB::table('orders')
                        ->where('id', $id)
                        ->update([
                            'status' => 'expired',
                            'updated_at' => now(),
                        ]);

                    throw new \RuntimeException('Order sudah expired dan tidak bisa dibayar.');
                }

                DB::table('orders')
                    ->where('id', $id)
                    ->update([
                        'status' => 'paid',
                        'paid_at' => now(),
                        'updated_at' => now(),
                    ]);

                $items = DB::table('order_items')
                    ->where('order_id', $id)
                    ->get();

                foreach ($items as $item) {
                    $photographerId = $item->photographer_id;
                    $amount = $item->photographer_amount;

                    $balance = DB::table('photographer_balances')
                        ->where('photographer_id', $photographerId)
                        ->lockForUpdate()
                        ->first();

                    if ($balance) {
                        $newBalance = $balance->balance + $amount;
                        DB::table('photographer_balances')
                            ->where('photographer_id', $photographerId)
                            ->update([
                                'balance' => $newBalance,
                                'total_earned' => $balance->total_earned + $amount,
                                'updated_at' => now(),
                            ]);
                    } else {
                        $newBalance = $amount;
                        DB::table('photographer_balances')->insert([
                            'photographer_id' => $photographerId,
                            'balance' => $newBalance,
                            'total_earned' => $amount,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }

                    DB::table('balance_transactions')->insert([
                        'photographer_id' => $photographerId,
                        'order_item_id' => $item->id,
                        'withdraw_id' => null,
                        'type' => 'credit',
                        'amount' => $amount,
                        'balance_after' => $newBalance,
                        'description' => 'Penjualan foto - Order #'.$order->order_code,
                        'created_at' => now(),
                    ]);
                }
            });

            return redirect()->route('order.detail', $id)
                ->with('success', 'Pembayaran berhasil dikonfirmasi!');

        } catch (\RuntimeException $e) {
            return redirect()->route('order.detail', $id)
                ->with('error', $e->getMessage());
        } catch (\Exception $e) {
            Log::error('Manual payment failed for order_id='.$id.' user_id='.$userId.' msg='.$e->getMessage());

            return redirect()->route('order.detail', $id)
                ->with('error', 'Gagal memproses pembayaran. Coba lagi.');
        }
    }
}
