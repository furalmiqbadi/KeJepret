<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // ═══════════════════════════════════════════
    // CHECKOUT — Buat order dari cart
    // ═══════════════════════════════════════════
    public function checkout()
    {
        $userId = Auth::id();

        $cartItems = DB::table('cart_items')
            ->join('photos', 'cart_items.photo_id', '=', 'photos.id')
            ->where('cart_items.user_id', $userId)
            ->select(
                'cart_items.id as cart_id',
                'photos.id as photo_id',
                'photos.price',
                'photos.photographer_id'
            )
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Cart kamu kosong.');
        }

        $total               = $cartItems->sum('price');
        $platformFee         = $total * 0.15;
        $photographerAmount  = $total - $platformFee;

        // Buat order di tabel orders
        $orderId = DB::table('orders')->insertGetId([
            'user_id'             => $userId,
            'order_code'          => 'ORD-' . strtoupper(uniqid()),
            'total_amount'        => $total,
            'platform_fee'        => $platformFee,
            'photographer_amount' => $photographerAmount,
            'status'              => 'pending',
            'expired_at'          => now()->addHours(24),
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);

        // Buat order_items dari setiap item cart
        foreach ($cartItems as $item) {
            DB::table('order_items')->insert([
                'order_id'            => $orderId,
                'photo_id'            => $item->photo_id,
                'photographer_id'     => $item->photographer_id,
                'price'               => $item->price,
                'photographer_amount' => $item->price * 0.85,
                'download_token'      => Str::uuid(),
                'created_at'          => now(),
            ]);
        }

        // Kosongkan cart
        DB::table('cart_items')->where('user_id', $userId)->delete();

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
            ->get();

        return view('order.history', compact('orders'));
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

        if (!$order) {
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
            ->get();

        return view('order.detail', compact('order', 'items'));
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

        if (!$order) {
            abort(404, 'Order tidak ditemukan.');
        }

        if ($order->status !== 'pending') {
            return redirect()->route('order.detail', $id)
                ->with('error', 'Order sudah diproses sebelumnya.');
        }

        DB::beginTransaction();
        try {
            // 1. Update status order → paid
            DB::table('orders')
                ->where('id', $id)
                ->update(['status' => 'paid', 'updated_at' => now()]);

            // 2. Ambil semua order_items
            $items = DB::table('order_items')
                ->where('order_id', $id)
                ->get();

            foreach ($items as $item) {
                $photographerId = $item->photographer_id;
                $amount         = $item->photographer_amount;

                // 3. Update/insert photographer_balances
                $balance = DB::table('photographer_balances')
                    ->where('photographer_id', $photographerId)
                    ->first();

                if ($balance) {
                    $newBalance = $balance->balance + $amount;
                    DB::table('photographer_balances')
                        ->where('photographer_id', $photographerId)
                        ->update([
                            'balance'      => $newBalance,
                            'total_earned' => $balance->total_earned + $amount,
                            'updated_at'   => now(),
                        ]);
                } else {
                    $newBalance = $amount;
                    DB::table('photographer_balances')->insert([
                        'photographer_id' => $photographerId,
                        'balance'         => $newBalance,
                        'total_earned'    => $amount,
                        'updated_at'      => now(),
                    ]);
                }

                // 4. Catat di balance_transactions
                DB::table('balance_transactions')->insert([
                    'photographer_id' => $photographerId,
                    'order_item_id'   => $item->id,
                    'withdraw_id'     => null,
                    'type'            => 'credit',
                    'amount'          => $amount,
                    'balance_after'   => $newBalance,
                    'description'     => 'Penjualan foto - Order #' . $order->order_code,
                ]);
            }

            DB::commit();

            return redirect()->route('order.detail', $id)
                ->with('success', 'Pembayaran berhasil dikonfirmasi!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('order.detail', $id)
                ->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }
}
