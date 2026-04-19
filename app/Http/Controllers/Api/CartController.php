<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $items = DB::table('cart_items')
            ->join('photos', 'cart_items.photo_id', '=', 'photos.id')
            ->join('users', 'photos.photographer_id', '=', 'users.id')
            ->where('cart_items.user_id', $request->user()->id)
            ->select(
                'cart_items.id as cart_item_id',
                'photos.id as photo_id',
                'photos.watermark_path',
                'photos.price',
                'photos.category',
                'users.name as photographer'
            )
            ->get();

        $total = $items->sum('price');

        return response()->json(['success' => true, 'data' => ['items' => $items, 'total' => $total]]);
    }

    public function add(Request $request)
    {
        $request->validate(['photo_id' => 'required|exists:photos,id']);

        $userId  = $request->user()->id;
        $photoId = $request->photo_id;

        $exists = DB::table('cart_items')
            ->where('user_id', $userId)
            ->where('photo_id', $photoId)
            ->exists();

        if ($exists) {
            return response()->json(['success' => false, 'message' => 'Foto sudah ada di cart'], 409);
        }

        $bought = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('order_items.photo_id', $photoId)
            ->where('orders.status', 'paid')
            ->exists();

        if ($bought) {
            return response()->json(['success' => false, 'message' => 'Foto sudah pernah dibeli'], 409);
        }

        DB::table('cart_items')->insert([
            'user_id'    => $userId,
            'photo_id'   => $photoId,
            'price'      => DB::table('photos')->where('id', $photoId)->value('price'),
            'created_at' => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Foto berhasil ditambahkan ke cart']);
    }

    public function remove(Request $request, $id)
    {
        $deleted = DB::table('cart_items')
            ->where('id', $id)
            ->where('user_id', $request->user()->id)
            ->delete();

        if (!$deleted) {
            return response()->json(['success' => false, 'message' => 'Item tidak ditemukan'], 404);
        }

        return response()->json(['success' => true, 'message' => 'Item berhasil dihapus dari cart']);
    }
}