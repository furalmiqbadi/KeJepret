<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    // ══════════════════════════════════════════
    // DOWNLOAD FOTO VIA TOKEN
    // ══════════════════════════════════════════
    public function download($token)
    {
        // Tabel: order_items JOIN orders JOIN photos
        // Kolom order_items: download_token varchar(100) unique nullable
        //                    downloaded_at timestamp nullable
        //                    id
        // Kolom orders: user_id, status (harus 'paid')
        // Kolom photos: r2_path, filename
        $item = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('photos', 'order_items.photo_id', '=', 'photos.id')
            ->where('orders.user_id', Auth::id())
            ->where('orders.status', 'paid')
            ->where('order_items.download_token', $token)
            ->select(
                'photos.r2_path',
                'photos.filename',
                'order_items.id as item_id'
            )
            ->first();

        if (!$item) {
            abort(404, 'File tidak ditemukan atau belum dibayar.');
        }

        // Generate temporary URL dari R2 (berlaku 5 menit)
        $url = Storage::disk('s3')->temporaryUrl($item->r2_path, now()->addMinutes(5));

        // Catat waktu download di kolom downloaded_at
        DB::table('order_items')
            ->where('id', $item->item_id)
            ->update(['downloaded_at' => now()]);

        // Redirect langsung ke signed URL R2 → browser otomatis download
        return redirect()->away($url);
    }
}
