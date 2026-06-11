<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PhotographerNotificationController extends Controller
{
    public function index(Request $request)
    {
        $limit = min(max((int) $request->integer('limit', 8), 1), 10);
        $page = max((int) $request->integer('page', 1), 1);
        $offset = ($page - 1) * $limit;

        $baseQuery = DB::table('photographer_notifications')
            ->join('order_items', 'photographer_notifications.order_item_id', '=', 'order_items.id')
            ->join('orders', 'photographer_notifications.order_id', '=', 'orders.id')
            ->join('photos', 'photographer_notifications.photo_id', '=', 'photos.id')
            ->where('photographer_notifications.photographer_id', Auth::id());

        $total = (clone $baseQuery)->count();
        $unreadCount = (clone $baseQuery)->whereNull('photographer_notifications.read_at')->count();

        $notifications = $baseQuery
            ->select(
                'photographer_notifications.id',
                'photographer_notifications.order_item_id',
                'photographer_notifications.title',
                'photographer_notifications.message',
                'photographer_notifications.amount',
                'photographer_notifications.read_at',
                'photographer_notifications.created_at',
                'orders.order_code',
                'photos.category',
                'photos.filename',
                'photos.watermark_path'
            )
            ->orderByDesc('photographer_notifications.created_at')
            ->offset($offset)
            ->limit($limit)
            ->get()
            ->map(function ($notification) {
                return [
                    'id' => $notification->id,
                    'order_item_id' => $notification->order_item_id,
                    'title' => $notification->title,
                    'message' => $notification->message,
                    'amount' => (float) $notification->amount,
                    'amount_formatted' => 'Rp '.number_format((float) $notification->amount, 0, ',', '.'),
                    'is_read' => $notification->read_at !== null,
                    'created_at' => $notification->created_at,
                    'time_label' => optional(Carbon::parse($notification->created_at))->diffForHumans(),
                    'order_code' => $notification->order_code,
                    'category' => $notification->category ?? 'Foto Event',
                    'filename' => $notification->filename,
                    'thumbnail_url' => $notification->watermark_path ? env('AWS_URL').'/'.$notification->watermark_path : null,
                    'sales_url' => route('balance.sales', ['highlight' => $notification->order_item_id], false).'#sale-'.$notification->order_item_id,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $notifications,
            'meta' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
                'unread_count' => $unreadCount,
                'has_next' => $offset + $limit < $total,
                'has_prev' => $page > 1,
            ],
        ]);
    }

    public function markRead(Request $request, int $id)
    {
        DB::table('photographer_notifications')
            ->where('id', $id)
            ->where('photographer_id', Auth::id())
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
                'updated_at' => now(),
            ]);

        return response()->json(['success' => true]);
    }
}
