<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{
    // ══════════════════════════════════════════
    // INDEX — Halaman saldo fotografer
    // ══════════════════════════════════════════
    public function index()
    {
        // Tabel: photographer_balances
        // Kolom: photographer_id, balance, total_earned
        $balance = DB::table('photographer_balances')
            ->where('photographer_id', Auth::id())
            ->first();

        // Jika belum ada record, default 0
        $balance = $balance ?? (object) [
            'balance'      => 0,
            'total_earned' => 0,
        ];

        return view('balance.index', compact('balance'));
    }

    // ══════════════════════════════════════════
    // SALES — Riwayat penjualan foto
    // ══════════════════════════════════════════
    public function sales()
    {
        // Tabel: order_items JOIN orders JOIN photos
        // Kolom order_items: id, price, photographer_amount, order_id, photo_id
        // Kolom orders: created_at, order_code, status
        // Kolom photos: photographer_id, category, filename
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

        return view('balance.sales', compact('sales', 'totalRevenue'));
    }

    // ══════════════════════════════════════════
    // SHOW FORM WITHDRAW
    // ══════════════════════════════════════════
    public function showWithdraw()
    {
        $balance = DB::table('photographer_balances')
            ->where('photographer_id', Auth::id())
            ->first();

        return view('balance.withdraw', compact('balance'));
    }

    // ══════════════════════════════════════════
    // WITHDRAW — Ajukan penarikan saldo
    // ══════════════════════════════════════════
    public function withdraw(Request $request)
    {
        $request->validate([
            // Tabel withdrawals: amount (decimal 10,2), min 50000
            'amount'              => 'required|numeric|min:50000',
            // Kolom: bank_name varchar(50)
            'bank_name'           => 'required|string|max:50',
            // Kolom: bank_account_number varchar(30)
            'bank_account_number' => 'required|string|max:30',
            // Kolom: bank_account_name varchar(100)
            'bank_account_name'   => 'required|string|max:100',
        ]);

        // Cek saldo mencukupi dari tabel photographer_balances
        $balance = DB::table('photographer_balances')
            ->where('photographer_id', Auth::id())
            ->first();

        if (!$balance || $balance->balance < $request->amount) {
            return back()->with('error', 'Saldo tidak cukup untuk melakukan withdraw.');
        }

        // Insert ke tabel withdrawals
        // Kolom: photographer_id, amount, bank_name, bank_account_number,
        //        bank_account_name, status (default: pending)
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

        return redirect()->route('balance.index')
            ->with('success', 'Permintaan withdraw berhasil! Menunggu approval admin.');
    }
}
