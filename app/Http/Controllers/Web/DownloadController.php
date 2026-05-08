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

        // Catat waktu download di kolom downloaded_at
        DB::table('order_items')
            ->where('id', $item->item_id)
            ->update(['downloaded_at' => now()]);

        // Force download via Laravel response stream (bukan redirect)
        $fileContent = Storage::disk('s3')->get($item->r2_path);
        $filename = $item->filename;

        return response($fileContent)
            ->header('Content-Type', 'application/octet-stream')
            ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
    }
}
