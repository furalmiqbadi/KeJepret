<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $totalUsers         = DB::table('users')->count();
        $totalPhotographers = DB::table('users')->where('role', 'photographer')->count();
        $totalRunners       = DB::table('users')->where('role', 'runner')->count();
        $totalPhotos        = DB::table('photos')->where('is_active', true)->count();
        $totalOrders        = DB::table('orders')->where('status', 'paid')->count();
        $totalRevenue       = DB::table('orders')->where('status', 'paid')->sum('total_amount');
        $pendingWithdrawals = DB::table('withdrawals')->where('status', 'pending')->count();
        $pendingVerif       = DB::table('photographer_profiles')->where('verification_status', 'pending')->count();

        return [
            Stat::make('Total Pengguna', number_format($totalUsers))
                ->description('Runner: ' . $totalRunners . ' | Fotografer: ' . $totalPhotographers)
                ->icon('heroicon-o-users')
                ->color('info'),

            Stat::make('Total Foto Aktif', number_format($totalPhotos))
                ->description('Foto yang sedang dijual')
                ->icon('heroicon-o-photo')
                ->color('success'),

            Stat::make('Total Order Dibayar', number_format($totalOrders))
                ->description('Rp ' . number_format($totalRevenue, 0, ',', '.'))
                ->icon('heroicon-o-shopping-bag')
                ->color('primary'),

            Stat::make('Withdrawal Pending', number_format($pendingWithdrawals))
                ->description('Menunggu persetujuan admin')
                ->icon('heroicon-o-banknotes')
                ->color('warning'),

            Stat::make('Fotografer Pending Verifikasi', number_format($pendingVerif))
                ->description('Menunggu review admin')
                ->icon('heroicon-o-identification')
                ->color('danger'),
        ];
    }
}
