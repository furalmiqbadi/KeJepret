<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // ══════════════════════════════
    // INDEX — Tampilkan semua item di cart
    // ══════════════════════════════
    public function index()
    {
        $items = DB::table('cart_items')
            ->join('photos', 'cart_items.photo_id', '=', 'photos.id')
            ->join('users', 'photos.photographer_id', '=', 'users.id')
            ->where('cart_items.user_id', Auth::id())
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

        return view('cart.index', compact('items', 'total'));
    }

    // ══════════════════════════════
    // ADD — Tambah foto ke cart
    // ══════════════════════════════
    public function add(Request $request)
    {
        $request->validate([
            'photo_id' => 'required|exists:photos,id',
        ]);

        $userId  = Auth::id();
        $photoId = $request->photo_id;

        // Cek sudah ada di cart
        $exists = DB::table('cart_items')
            ->where('user_id', $userId)
            ->where('photo_id', $photoId)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Foto sudah ada di cart.');
        }

        // Cek sudah pernah dibeli
        $bought = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('orders.user_id', $userId)
            ->where('order_items.photo_id', $photoId)
            ->where('orders.status', 'paid')
            ->exists();

        if ($bought) {
            return back()->with('error', 'Foto sudah pernah dibeli.');
        }

        DB::table('cart_items')->insert([
            'user_id'    => $userId,
            'photo_id'   => $photoId,
            'price'      => DB::table('photos')->where('id', $photoId)->value('price'),
            'created_at' => now(),
        ]);

        return back()->with('success', 'Foto berhasil ditambahkan ke cart.');
    }

    // ══════════════════════════════
    // REMOVE — Hapus item dari cart
    // ══════════════════════════════
    public function remove($id)
    {
        $deleted = DB::table('cart_items')
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        if (!$deleted) {
            return back()->with('error', 'Item tidak ditemukan di cart.');
        }

        return back()->with('success', 'Item berhasil dihapus dari cart.');
    }
}
