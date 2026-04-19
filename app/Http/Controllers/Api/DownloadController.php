<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download(Request $request, $token)
    {
        $item = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('photos', 'order_items.photo_id', '=', 'photos.id')
            ->where('orders.user_id', $request->user()->id)
            ->where('orders.status', 'paid')
            ->where('order_items.download_token', $token)
            ->select('photos.r2_path', 'photos.filename', 'order_items.id as item_id')
            ->first();

        if (!$item) {
            return response()->json(['success' => false, 'message' => 'File tidak ditemukan atau belum dibayar'], 404);
        }

        $url = Storage::disk('s3')->temporaryUrl($item->r2_path, now()->addMinutes(5));

        // Catat waktu download
        DB::table('order_items')
            ->where('id', $item->item_id)
            ->update(['downloaded_at' => now()]);

        return response()->json([
            'success' => true,
            'data'    => [
                'download_url' => $url,
                'filename'     => $item->filename,
                'expires_in'   => '5 menit'
            ]
        ]);
    }
}