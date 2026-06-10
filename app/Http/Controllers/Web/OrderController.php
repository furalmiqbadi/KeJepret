<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\PakasirService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function __construct(private readonly PakasirService $pakasir)
    {
    }

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
                    'payment_channel' => 'pakasir',
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

    public function history()
    {
        $orders = DB::table('orders')
            ->where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('runner.order-history', compact('orders'));
    }

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
            ->select('order_items.*', 'photos.category', 'photos.watermark_path')
            ->get()
            ->map(function ($item) {
                $item->watermark_url = env('AWS_URL').'/'.$item->watermark_path;

                return $item;
            });

        return view('runner.order-detail', compact('order', 'items'));
    }

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
            $paymentUrl = $order->tripay_pay_url;

            if (! $paymentUrl) {
                $paymentUrl = $this->pakasir->buildPaymentUrl(
                    $order->order_code,
                    $order->total_amount,
                    route('order.detail', $order->id)
                );

                DB::table('orders')
                    ->where('id', $id)
                    ->update([
                        'payment_channel' => 'pakasir',
                        'tripay_reference' => $order->order_code,
                        'tripay_pay_url' => $paymentUrl,
                        'updated_at' => now(),
                    ]);
            }

            return redirect()->away($paymentUrl);
        } catch (\Exception $e) {
            Log::error('Pakasir redirect failed for order_id='.$id.' user_id='.$userId.' msg='.$e->getMessage());

            return redirect()->route('order.detail', $id)
                ->with('error', 'Gagal membuka halaman pembayaran. Coba lagi.');
        }
    }
}
