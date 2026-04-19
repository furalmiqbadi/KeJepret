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
            ->where('order_items.id', $token)
            ->select('photos.original_path', 'photos.filename')
            ->first();

        if (!$item) {
            return response()->json(['success' => false, 'message' => 'File tidak ditemukan atau belum dibayar'], 404);
        }

        $url = Storage::disk('s3')->temporaryUrl($item->original_path, now()->addMinutes(5));

        return response()->json([
            'success' => true,
            'data'    => [
                'download_url' => $url,
                'expires_in'   => '5 menit'
            ]
        ]);
    }
}