<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{
    public function index(Request $request)
    {
        $balance = DB::table('photographer_balances')
            ->where('photographer_id', $request->user()->id)
            ->first();

        return response()->json([
            'success' => true,
            'data'    => $balance ?? [
                'balance'      => 0,
                'total_earned' => 0
            ]
        ]);
    }

    public function sales(Request $request)
    {
        $sales = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('photos', 'order_items.photo_id', '=', 'photos.id')
            ->where('photos.photographer_id', $request->user()->id)
            ->where('orders.status', 'paid')
            ->select(
                'order_items.id',
                'order_items.price',
                'order_items.photographer_amount',
                'orders.created_at as sold_at',
                'orders.order_code',
                'photos.category',
                'photos.filename'
            )
            ->orderByDesc('orders.created_at')
            ->get();

        $totalRevenue = $sales->sum('photographer_amount');

        return response()->json([
            'success' => true,
            'data'    => [
                'sales'         => $sales,
                'total_revenue' => $totalRevenue
            ]
        ]);
    }

    public function withdraw(Request $request)
    {
        $request->validate([
            'amount'              => 'required|numeric|min:50000',
            'bank_name'           => 'required|string',
            'bank_account_number' => 'required|string',
            'bank_account_name'   => 'required|string',
        ]);

        $balance = DB::table('photographer_balances')
            ->where('photographer_id', $request->user()->id)
            ->first();

        if (!$balance || $balance->balance < $request->amount) {
            return response()->json([
                'success' => false,
                'message' => 'Saldo tidak cukup'
            ], 400);
        }

        DB::table('withdrawals')->insert([
            'photographer_id'     => $request->user()->id,
            'amount'              => $request->amount,
            'bank_name'           => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'bank_account_name'   => $request->bank_account_name,
            'status'              => 'pending',
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Permintaan withdraw berhasil, menunggu approval admin'
        ]);
    }
}