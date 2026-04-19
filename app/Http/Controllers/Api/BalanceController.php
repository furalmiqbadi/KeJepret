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
            'data'    => $balance ?? ['balance' => 0, 'pending' => 0]
        ]);
    }

    public function sales(Request $request)
    {
        $sales = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('photos', 'order_items.photo_id', '=', 'photos.id')
            ->where('photos.photographer_id', $request->user()->id)
            ->where('orders.status', 'paid')
            ->select('order_items.*', 'orders.created_at as sold_at', 'photos.category')
            ->orderByDesc('orders.created_at')
            ->get();

        $total = $sales->sum('price');

        return response()->json([
            'success' => true,
            'data'    => ['sales' => $sales, 'total_revenue' => $total]
        ]);
    }

    public function withdraw(Request $request)
    {
        $request->validate(['amount' => 'required|numeric|min:50000']);

        $balance = DB::table('photographer_balances')
            ->where('photographer_id', $request->user()->id)
            ->first();

        if (!$balance || $balance->balance < $request->amount) {
            return response()->json(['success' => false, 'message' => 'Saldo tidak cukup'], 400);
        }

        DB::table('withdrawals')->insert([
            'photographer_id' => $request->user()->id,
            'amount'          => $request->amount,
            'status'          => 'pending',
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return response()->json(['success' => true, 'message' => 'Permintaan withdraw berhasil, menunggu approval admin']);
    }
}