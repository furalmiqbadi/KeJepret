<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $userId = $request->user()->id;

        $cartItems = DB::table('cart_items')
            ->join('photos', 'cart_items.photo_id', '=', 'photos.id')
            ->where('cart_items.user_id', $userId)
            ->select('cart_items.id as cart_id', 'photos.id as photo_id', 'photos.price', 'photos.photographer_id')
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Cart kosong'], 400);
        }

        $total = $cartItems->sum('price');

        $platformFee = $total * 0.15;
        $photographerAmount = $total - $platformFee;

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

        foreach ($cartItems as $item) {
            DB::table('order_items')->insert([
                'order_id'            => $orderId,
                'photo_id'            => $item->photo_id,
                'photographer_id'     => $item->photographer_id,
                'price'               => $item->price,
                'photographer_amount' => $item->price * 0.85,
                'download_token'      => \Illuminate\Support\Str::uuid(),
                'created_at'          => now(),
            ]);
        }

        DB::table('cart_items')->where('user_id', $userId)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil dibuat',
            'data'    => [
                'order_id' => $orderId,
                'total'    => $total,
                'status'   => 'pending',
                'note'     => 'Klik tombol bayar untuk konfirmasi pembayaran'
            ]
        ]);
    }

    public function history(Request $request)
    {
        $orders = DB::table('orders')
            ->where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json(['success' => true, 'data' => $orders]);
    }

    public function detail(Request $request, $id)
    {
        $order = DB::table('orders')
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order tidak ditemukan'], 404);
        }

        $items = DB::table('order_items')
            ->join('photos', 'order_items.photo_id', '=', 'photos.id')
            ->where('order_items.order_id', $id)
            ->select('order_items.*', 'photos.category', 'photos.watermark_path')
            ->get();

        return response()->json(['success' => true, 'data' => ['order' => $order, 'items' => $items]]);
    }

    public function manualPay(Request $request, $id)
    {
        $userId = $request->user()->id;

        $order = DB::table('orders')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order tidak ditemukan'], 404);
        }

        if ($order->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Order sudah diproses sebelumnya'], 400);
        }

        DB::beginTransaction();
        try {
            // 1. Update status order jadi paid
            DB::table('orders')
                ->where('id', $id)
                ->update(['status' => 'paid', 'updated_at' => now()]);

            // 2. Ambil semua order items
            $items = DB::table('order_items')
                ->where('order_id', $id)
                ->get();

            foreach ($items as $item) {
                $photographerId = $item->photographer_id;
                $amount         = $item->photographer_amount;

                // 3. Cek apakah sudah ada record balance
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

                // 4. Catat balance transaction
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

            return response()->json([
                'success' => true,
                'message' => 'Pembayaran berhasil dikonfirmasi',
                'data'    => [
                    'order_id' => (int) $id,
                    'status'   => 'paid',
                    'total'    => $order->total_amount,
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Gagal: ' . $e->getMessage()], 500);
        }
    }

    public function webhook(Request $request)
    {
        // TODO: Implementasi Tripay webhook
        return response()->json(['success' => true, 'message' => 'Webhook received']);
    }
}
