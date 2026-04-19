<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{
    // ════════════════════════════════
    // INDEX — Halaman profil & saldo fotografer
    // ════════════════════════════════
    public function index()
    {
        $balance = DB::table('photographer_balances')
            ->where('photographer_id', Auth::id())
            ->first();

        $balance = $balance ?? (object) [
            'balance'      => 0,
            'total_earned' => 0,
        ];

        return view('photographer.profil', compact('balance'));
    }

    // ════════════════════════════════
    // SALES — Riwayat penjualan foto
    // ════════════════════════════════
    public function sales()
    {
        $sales = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('photos', 'order_items.photo_id', '=', 'photos.id')
            ->where('photos.photographer_id', Auth::id())
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

        return view('photographer.sales', compact('sales', 'totalRevenue'));
    }

    // ════════════════════════════════
    // WITHDRAW — Ajukan penarikan saldo
    // ════════════════════════════════
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount'              => 'required|numeric|min:50000',
            'bank_name'           => 'required|string|max:50',
            'bank_account_number' => 'required|string|max:30',
            'bank_account_name'   => 'required|string|max:100',
        ]);

        $balance = DB::table('photographer_balances')
            ->where('photographer_id', Auth::id())
            ->first();

        if (!$balance || $balance->balance < $request->amount) {
            return back()->with('error', 'Saldo tidak cukup untuk melakukan withdraw.');
        }

        DB::table('withdrawals')->insert([
            'photographer_id'     => Auth::id(),
            'amount'              => $request->amount,
            'bank_name'           => $request->bank_name,
            'bank_account_number' => $request->bank_account_number,
            'bank_account_name'   => $request->bank_account_name,
            'status'              => 'pending',
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);

        return redirect()->route('photographer.profil')
            ->with('success', 'Permintaan withdraw berhasil! Menunggu approval admin.');
    }
}
