<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SearchSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // ════════════════════════════════
    // INDEX — Tampilkan semua item di cart
    // ════════════════════════════════
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
            ->get()
            ->map(function ($item) {
                $item->watermark_url = env('AWS_URL') . '/' . $item->watermark_path;
                return $item;
            });

        $total = $items->sum('price');
        $lastSearchSession = SearchSession::where('user_id', Auth::id())
            ->where('search_status', 'completed')
            ->where('result_count', '>', 0)
            ->latest('created_at')
            ->first();
        $searchBackUrl = $lastSearchSession
            ? route('runner.search.results', $lastSearchSession->id)
            : route('runner.search');

        return view('runner.cart', compact('items', 'total', 'searchBackUrl'));
    }

    // ════════════════════════════════
    // ADD — Tambah foto ke cart
    // ════════════════════════════════
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
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Foto sudah ada di cart.',
                    'cart_count' => DB::table('cart_items')->where('user_id', $userId)->count(),
                ], 409);
            }

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
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Foto sudah pernah dibeli.',
                    'cart_count' => DB::table('cart_items')->where('user_id', $userId)->count(),
                ], 409);
            }

            return back()->with('error', 'Foto sudah pernah dibeli.');
        }

        DB::table('cart_items')->insert([
            'user_id'    => $userId,
            'photo_id'   => $photoId,
            'price'      => DB::table('photos')->where('id', $photoId)->value('price'),
            'created_at' => now(),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil ditambahkan ke cart.',
                'cart_count' => DB::table('cart_items')->where('user_id', $userId)->count(),
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Foto berhasil ditambahkan ke cart.');
    }

    // ════════════════════════════════
    // REMOVE — Hapus item dari cart
    // ════════════════════════════════
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
