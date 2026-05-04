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
            'balance' => 0,
            'total_earned' => 0,
        ];

        $withdrawals = DB::table('withdrawals')
            ->where('photographer_id', Auth::id())
            ->orderByDesc('created_at')
            ->limit(10)
            ->get();

        return view('photographer.profil', compact('balance', 'withdrawals'));
    }

    // ════════════════════════════════
    // SALES — Riwayat penjualan foto
    // ════════════════════════════════
    public function sales()
    {
        $photographerId = Auth::id();

        // Riwayat semua penjualan
        $sales = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('photos', 'order_items.photo_id', '=', 'photos.id')
            ->where('photos.photographer_id', $photographerId)
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

        // Statistik foto
        $totalFotos = DB::table('photos')->where('photographer_id', $photographerId)->count();
        $fotoTersedia = DB::table('photos')->where('photographer_id', $photographerId)->where('is_active', true)->count();
        $fotoTerjual = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('photos', 'order_items.photo_id', '=', 'photos.id')
            ->where('photos.photographer_id', $photographerId)
            ->where('orders.status', 'paid')
            ->distinct('order_items.photo_id')
            ->count('order_items.photo_id');

        // Statistik pendapatan
        $totalRevenue = $sales->sum('photographer_amount');

        $pendapatanBulanIni = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('photos', 'order_items.photo_id', '=', 'photos.id')
            ->where('photos.photographer_id', $photographerId)
            ->where('orders.status', 'paid')
            ->whereMonth('orders.created_at', now()->month)
            ->whereYear('orders.created_at', now()->year)
            ->sum('order_items.photographer_amount');

        $penjualanBulanIni = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->join('photos', 'order_items.photo_id', '=', 'photos.id')
            ->where('photos.photographer_id', $photographerId)
            ->where('orders.status', 'paid')
            ->whereMonth('orders.created_at', now()->month)
            ->whereYear('orders.created_at', now()->year)
            ->count();

        return view('photographer.sales', compact(
            'sales',
            'totalRevenue',
            'totalFotos',
            'fotoTersedia',
            'fotoTerjual',
            'pendapatanBulanIni',
            'penjualanBulanIni'
        ));
    }

    // ════════════════════════════════
    // WITHDRAW — Ajukan penarikan saldo
    // ════════════════════════════════
    public function withdraw(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:50000',
            'bank_name' => 'required|string|max:50',
            'bank_account_number' => 'required|string|max:30',
            'bank_account_name' => 'required|string|max:100',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $photographerId = Auth::id();

                $balance = DB::table('photographer_balances')
                    ->where('photographer_id', $photographerId)
                    ->lockForUpdate()
                    ->first();

                if (! $balance || $balance->balance < $request->amount) {
                    throw new \RuntimeException('Saldo tidak cukup untuk melakukan withdraw.');
                }

                $newBalance = $balance->balance - $request->amount;

                $withdrawId = DB::table('withdrawals')->insertGetId([
                    'photographer_id' => $photographerId,
                    'amount' => $request->amount,
                    'bank_name' => $request->bank_name,
                    'bank_account_number' => $request->bank_account_number,
                    'bank_account_name' => $request->bank_account_name,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('photographer_balances')
                    ->where('photographer_id', $photographerId)
                    ->update([
                        'balance' => $newBalance,
                        'updated_at' => now(),
                    ]);

                DB::table('balance_transactions')->insert([
                    'photographer_id' => $photographerId,
                    'order_item_id' => null,
                    'withdraw_id' => $withdrawId,
                    'type' => 'debit',
                    'amount' => $request->amount,
                    'balance_after' => $newBalance,
                    'description' => 'Pengajuan withdrawal #'.$withdrawId,
                    'created_at' => now(),
                ]);
            });
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengajukan withdraw. Coba lagi.');
        }

        return redirect()->route('photographer.profil')
            ->with('success', 'Permintaan withdraw berhasil! Menunggu approval admin.');
    }
}
