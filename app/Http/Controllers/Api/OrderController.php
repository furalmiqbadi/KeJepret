<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PakasirService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function __construct(private readonly PakasirService $pakasir)
    {
    }

    public function checkout(Request $request)
    {
        $userId = $request->user()->id;

        $cartItems = DB::table('cart_items')
            ->join('photos', 'cart_items.photo_id', '=', 'photos.id')
            ->where('cart_items.user_id', $userId)
            ->where('photos.is_active', true)
            ->select('cart_items.id as cart_id', 'photos.id as photo_id', 'photos.price', 'photos.photographer_id')
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Cart kosong'], 400);
        }

        $total = $cartItems->sum('price');
        $platformFee = $total * 0.15;
        $photographerAmount = $total - $platformFee;

        $orderId = DB::table('orders')->insertGetId([
            'user_id' => $userId,
            'order_code' => 'ORD-'.strtoupper(uniqid()),
            'total_amount' => $total,
            'platform_fee' => $platformFee,
            'photographer_amount' => $photographerAmount,
            'payment_channel' => 'pakasir',
            'status' => 'pending',
            'expired_at' => now()->addHours(24),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        foreach ($cartItems as $item) {
            DB::table('order_items')->insert([
                'order_id' => $orderId,
                'photo_id' => $item->photo_id,
                'photographer_id' => $item->photographer_id,
                'price' => $item->price,
                'photographer_amount' => $item->price * 0.85,
                'download_token' => Str::uuid(),
                'created_at' => now(),
            ]);
        }

        DB::table('cart_items')->where('user_id', $userId)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil dibuat',
            'data' => [
                'order_id' => $orderId,
                'total' => $total,
                'status' => 'pending',
                'note' => 'Klik tombol bayar untuk membuka pembayaran Pakasir',
            ],
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

        if (! $order) {
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

        if (! $order) {
            return response()->json(['success' => false, 'message' => 'Order tidak ditemukan'], 404);
        }

        if ($order->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'Order sudah diproses sebelumnya'], 400);
        }

        if ($order->expired_at && now()->greaterThan($order->expired_at)) {
            DB::table('orders')
                ->where('id', $id)
                ->where('status', 'pending')
                ->update([
                    'status' => 'expired',
                    'updated_at' => now(),
                ]);

            return response()->json(['success' => false, 'message' => 'Order sudah expired dan tidak bisa dibayar'], 400);
        }

        try {
            $paymentUrl = $order->tripay_pay_url;

            if (! $paymentUrl) {
                $paymentUrl = $this->pakasir->buildPaymentUrl(
                    $order->order_code,
                    $order->total_amount,
                    url('/orders/'.$order->id)
                );

                DB::table('orders')
                    ->where('id', $id)
                    ->update([
                        'payment_channel' => 'pakasir',
                        'tripay_reference' => $order->order_code,
                        'tripay_pay_url' => $paymentUrl,
                        'updated_at' => now(),
                    ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Link pembayaran Pakasir siap dibuka',
                'data' => [
                    'order_id' => (int) $id,
                    'status' => 'pending',
                    'payment_url' => $paymentUrl,
                ],
            ]);
        } catch (\Exception $e) {
            Log::error('Pakasir payment link failed for order_id='.$id.' user_id='.$userId.' msg='.$e->getMessage());

            return response()->json(['success' => false, 'message' => 'Gagal membuka halaman pembayaran'], 500);
        }
    }

    public function webhook(Request $request)
    {
        $validated = $request->validate([
            'project' => ['nullable', 'string'],
            'order_id' => ['required', 'string'],
            'amount' => ['required', 'numeric'],
            'status' => ['nullable', 'string'],
            'payment_method' => ['nullable', 'string'],
            'completed_at' => ['nullable', 'string'],
        ]);

        if ($this->pakasir->projectSlug() !== '' && isset($validated['project']) && $validated['project'] !== $this->pakasir->projectSlug()) {
            return response()->json(['success' => false, 'message' => 'Project tidak valid'], 422);
        }

        $transaction = $this->pakasir->fetchTransactionDetail($validated['order_id'], $validated['amount']);

        $transactionStatus = strtolower((string) ($transaction['status'] ?? $validated['status'] ?? ''));
        $isPaid = in_array($transactionStatus, ['completed', 'paid', 'success', 'settled'], true);

        if (! $isPaid) {
            return response()->json(['success' => true, 'message' => 'Status belum dibayar'], 200);
        }

        $settled = $this->pakasir->settlePaidOrder(
            $validated['order_id'],
            $validated['amount'],
            $validated['payment_method'] ?? ($transaction['payment_method'] ?? null),
            $validated['completed_at'] ?? ($transaction['completed_at'] ?? null)
        );

        if (! $settled) {
            return response()->json(['success' => false, 'message' => 'Order tidak bisa diproses'], 422);
        }

        return response()->json(['success' => true, 'message' => 'Webhook diterima']);
    }
}
