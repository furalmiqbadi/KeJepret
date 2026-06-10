<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PakasirService
{
    public function projectSlug(): string
    {
        return (string) config('services.pakasir.project_slug', '');
    }

    public function apiKey(): string
    {
        return (string) config('services.pakasir.api_key', '');
    }

    public function baseUrl(): string
    {
        return rtrim((string) config('services.pakasir.base_url', 'https://app.pakasir.com'), '/');
    }

    public function buildPaymentUrl(string $orderCode, float|int $amount, ?string $redirectUrl = null): string
    {
        $query = [
            'order_id' => $orderCode,
            'qris_only' => 1,
        ];

        if ($redirectUrl) {
            $query['redirect'] = $redirectUrl;
        }

        return $this->baseUrl().'/pay/'.$this->projectSlug().'/'.(int) round($amount).'?'.http_build_query($query, '', '&', PHP_QUERY_RFC3986);
    }

    public function fetchTransactionDetail(string $orderCode, float|int $amount): ?array
    {
        if ($this->projectSlug() === '' || $this->apiKey() === '') {
            return null;
        }

        $response = Http::timeout(20)->get($this->baseUrl().'/api/transactiondetail', [
            'project' => $this->projectSlug(),
            'amount' => (int) round($amount),
            'order_id' => $orderCode,
            'api_key' => $this->apiKey(),
        ]);

        if (! $response->successful()) {
            Log::warning('Pakasir transaction detail failed', [
                'order_id' => $orderCode,
                'amount' => $amount,
                'status' => $response->status(),
            ]);

            return null;
        }

        return $response->json('transaction');
    }

    public function settlePaidOrder(string $orderCode, float|int $amount, ?string $paymentMethod = null, ?string $completedAt = null): bool
    {
        return DB::transaction(function () use ($orderCode, $amount, $paymentMethod, $completedAt) {
            $order = DB::table('orders')
                ->where('order_code', $orderCode)
                ->lockForUpdate()
                ->first();

            if (! $order) {
                return false;
            }

            if ((float) $order->total_amount !== (float) $amount) {
                Log::warning('Pakasir amount mismatch', [
                    'order_code' => $orderCode,
                    'expected' => $order->total_amount,
                    'received' => $amount,
                ]);

                return false;
            }

            if ($order->status === 'paid') {
                return true;
            }

            if ($order->status !== 'pending') {
                return false;
            }

            if ($order->expired_at && now()->greaterThan($order->expired_at)) {
                DB::table('orders')
                    ->where('id', $order->id)
                    ->update([
                        'status' => 'expired',
                        'updated_at' => now(),
                    ]);

                return false;
            }

            $paidAt = $completedAt ? Carbon::parse($completedAt) : now();

            DB::table('orders')
                ->where('id', $order->id)
                ->update([
                    'status' => 'paid',
                    'payment_channel' => $paymentMethod ?? $order->payment_channel ?? 'pakasir',
                    'paid_at' => $paidAt,
                    'updated_at' => now(),
                ]);

            $items = DB::table('order_items')
                ->where('order_id', $order->id)
                ->get();

            foreach ($items as $item) {
                $photographerId = $item->photographer_id;
                $amountItem = $item->photographer_amount;

                $balance = DB::table('photographer_balances')
                    ->where('photographer_id', $photographerId)
                    ->lockForUpdate()
                    ->first();

                if ($balance) {
                    $newBalance = $balance->balance + $amountItem;

                    DB::table('photographer_balances')
                        ->where('photographer_id', $photographerId)
                        ->update([
                            'balance' => $newBalance,
                            'total_earned' => $balance->total_earned + $amountItem,
                            'updated_at' => now(),
                        ]);
                } else {
                    $newBalance = $amountItem;

                    DB::table('photographer_balances')->insert([
                        'photographer_id' => $photographerId,
                        'balance' => $newBalance,
                        'total_earned' => $amountItem,
                        'updated_at' => now(),
                    ]);
                }

                DB::table('balance_transactions')->insert([
                    'photographer_id' => $photographerId,
                    'order_item_id' => $item->id,
                    'withdraw_id' => null,
                    'type' => 'credit',
                    'amount' => $amountItem,
                    'balance_after' => $newBalance,
                    'description' => 'Penjualan foto - Order #'.$order->order_code,
                    'created_at' => now(),
                ]);
            }

            return true;
        });
    }
}
