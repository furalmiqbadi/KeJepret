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

        $orderId = DB::table('orders')->insertGetId([
            'user_id'    => $userId,
            'total'      => $total,
            'status'     => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($cartItems as $item) {
            DB::table('order_items')->insert([
                'order_id'   => $orderId,
                'photo_id'   => $item->photo_id,
                'price'      => $item->price,
                'created_at' => now(),
                'updated_at' => now(),
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
                'note'     => 'Payment gateway (Tripay) belum diintegrasikan'
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

    public function webhook(Request $request)
    {
        // TODO: Implementasi Tripay webhook
        return response()->json(['success' => true, 'message' => 'Webhook received']);
    }
}