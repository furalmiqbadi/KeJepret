@extends('layouts.app')
@section('title', 'Statistik Penjualan')
@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 py-12 relative z-10 animate-in fade-in slide-in-from-bottom-4 duration-1000">

    {{-- HEADER --}}
    <div class="mb-10">
        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600 mb-2">FOTOGRAFER</p>
        <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-1">Statistik Penjualan</h1>
        <p class="text-sm font-bold text-slate-500">Pantau performa foto dan pendapatan kamu.</p>
    </div>

    {{-- STATISTIK CARDS --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">

        {{-- Total Foto --}}
        <div class="bg-white rounded-[1.5rem] p-6 border border-slate-100 shadow-xl shadow-slate-200/50 hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-slate-50 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out z-0"></div>
            <div class="relative z-10">
                <div class="w-12 h-12 bg-slate-100 rounded-2xl flex items-center justify-center mb-4 text-slate-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-3xl font-black text-slate-900 tracking-tight">{{ $totalFotos }}</p>
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-1">Total Foto</p>
            </div>
        </div>

        {{-- Foto Tersedia --}}
        <div class="bg-white rounded-[1.5rem] p-6 border border-slate-100 shadow-xl shadow-slate-200/50 hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-green-50 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out z-0"></div>
            <div class="relative z-10">
                <div class="w-12 h-12 bg-green-100/50 rounded-2xl flex items-center justify-center mb-4 text-green-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-3xl font-black text-green-600 tracking-tight">{{ $fotoTersedia }}</p>
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-1">Foto Tersedia</p>
            </div>
        </div>

        {{-- Foto Terjual --}}
        <div class="bg-white rounded-[1.5rem] p-6 border border-slate-100 shadow-xl shadow-slate-200/50 hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out z-0"></div>
            <div class="relative z-10">
                <div class="w-12 h-12 bg-blue-100/50 rounded-2xl flex items-center justify-center mb-4 text-blue-600">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <p class="text-3xl font-black text-blue-600 tracking-tight">{{ $fotoTerjual }}</p>
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-1">Foto Terjual</p>
            </div>
        </div>

        {{-- Total Pendapatan --}}
        <div class="bg-white rounded-[1.5rem] p-6 border border-slate-100 shadow-xl shadow-slate-200/50 hover:-translate-y-1 transition-transform duration-300 relative overflow-hidden group">
            <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full group-hover:scale-150 transition-transform duration-500 ease-out z-0"></div>
            <div class="relative z-10">
                <div class="w-12 h-12 bg-amber-100/50 rounded-2xl flex items-center justify-center mb-4 text-amber-500">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-2xl font-black text-amber-500 tracking-tight whitespace-nowrap">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest mt-1">Total Pendapatan</p>
            </div>
        </div>

    </div>

    {{-- BULAN INI --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">

        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-[2rem] p-8 text-white shadow-2xl shadow-blue-500/30 relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute -left-10 -bottom-10 w-48 h-48 bg-black/10 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-200 mb-2">Penjualan Bulan Ini</p>
                <p class="text-5xl font-black tracking-tight mb-2">{{ $penjualanBulanIni }}</p>
                <p class="text-blue-100 text-sm font-bold opacity-80">Transaksi pada {{ now()->translatedFormat('F Y') }}</p>
            </div>
        </div>

        <div class="bg-gradient-to-br from-slate-900 to-slate-800 rounded-[2rem] p-8 text-white shadow-2xl shadow-slate-900/30 relative overflow-hidden">
            <div class="absolute -right-10 -top-10 w-48 h-48 bg-white/5 rounded-full blur-2xl"></div>
            <div class="absolute -left-10 -bottom-10 w-48 h-48 bg-black/30 rounded-full blur-2xl"></div>
            <div class="relative z-10">
                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400 mb-2">Pendapatan Bulan Ini</p>
                <p class="text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-amber-200 to-yellow-400 tracking-tight mb-2">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</p>
                <p class="text-slate-400 text-sm font-bold">Pada {{ now()->translatedFormat('F Y') }}</p>
            </div>
        </div>

    </div>

    {{-- TABEL RIWAYAT PENJUALAN --}}
    <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h2 class="text-sm font-black uppercase tracking-widest text-slate-800">Riwayat Penjualan</h2>
            <span class="inline-flex items-center justify-center px-3 py-1 text-xs font-bold bg-white border border-slate-200 text-slate-500 rounded-full shadow-sm">{{ $sales->count() }} transaksi</span>
        </div>

        @if($sales->isEmpty())
            <div class="py-20 text-center px-4">
                <div class="w-20 h-20 bg-slate-50 text-slate-300 rounded-3xl flex items-center justify-center mx-auto mb-5 shadow-inner">
                    <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                    </svg>
                </div>
                <p class="text-lg font-black text-slate-700">Belum ada foto yang terjual</p>
                <p class="text-slate-400 font-bold text-sm mt-1">Terus upload foto terbaikmu!</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-slate-50 border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 whitespace-nowrap">Foto</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 whitespace-nowrap">Kode Order</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 whitespace-nowrap">Kategori</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 whitespace-nowrap">Harga</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 whitespace-nowrap">Pendapatan</th>
                            <th class="px-8 py-4 text-[10px] font-black uppercase tracking-[0.15em] text-slate-400 whitespace-nowrap">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach($sales as $item)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-8 py-5">
                                    <span class="font-bold text-slate-800 text-xs">{{ Str::limit($item->filename, 30) }}</span>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="font-mono text-[11px] font-bold text-slate-500 bg-white border border-slate-200 shadow-sm px-2.5 py-1 rounded-md">{{ $item->order_code }}</span>
                                </td>
                                <td class="px-8 py-5">
                                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-500 bg-slate-100 px-2.5 py-1 rounded-full">
                                        {{ $item->category ?? 'Umum' }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-slate-600 font-bold text-xs whitespace-nowrap">
                                    Rp {{ number_format($item->price, 0, ',', '.') }}
                                </td>
                                <td class="px-8 py-5 whitespace-nowrap">
                                    <span class="inline-flex items-center gap-1 text-green-600 font-black text-xs bg-green-50 px-2.5 py-1 rounded-lg">
                                        + Rp {{ number_format($item->photographer_amount, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="px-8 py-5 text-slate-400 font-bold text-[11px] whitespace-nowrap">
                                    {{ \Carbon\Carbon::parse($item->sold_at)->setTimezone('Asia/Jakarta')->format('d M Y, H:i') }} WIB
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

</div>

@endsection
