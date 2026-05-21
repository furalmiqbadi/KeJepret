@extends('layouts.app')
@section('title', 'Profil Fotografer')
@section('content')

@php $user = auth()->user(); @endphp

<div class="max-w-2xl mx-auto px-4 sm:px-6 py-8 relative z-10">

    {{-- Profile Header --}}
    <div class="glass-card rounded-[2rem] p-8 mb-6 flex flex-col sm:flex-row items-center sm:items-start text-center sm:text-left gap-6 hover:translate-y-[-2px] transition-all duration-300">
        <div class="w-24 h-24 rounded-3xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center border border-white/30 shadow-[0_10px_25px_rgba(37,99,235,0.2)]">
            <span class="text-4xl font-black text-white italic tracking-tighter">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
        </div>
        <div class="flex-1">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight mb-1">{{ $user->name }}</h1>
            <p class="text-slate-600 text-sm font-semibold mb-4">{{ $user->email }}</p>
            <div class="flex items-center justify-center sm:justify-start gap-2 flex-wrap">
                <span class="inline-block bg-blue-600/10 text-blue-600 text-[11px] font-black uppercase tracking-wider px-3.5 py-1.5 rounded-2xl border border-blue-500/15">Fotografer</span>
                @php
                    $profile = $user->photographerProfile;
                    $verStatus = $profile->verification_status ?? 'pending';
                @endphp
                @if($verStatus === 'verified')
                <span class="inline-block bg-green-500/10 text-green-600 text-[11px] font-black uppercase tracking-wider px-3.5 py-1.5 rounded-2xl border border-green-500/15">Terverifikasi</span>
                @elseif($verStatus === 'rejected')
                <span class="inline-block bg-red-500/10 text-red-500 text-[11px] font-black uppercase tracking-wider px-3.5 py-1.5 rounded-2xl border border-red-500/15">Ditolak</span>
                @else
                <span class="inline-block bg-yellow-500/10 text-yellow-600 text-[11px] font-black uppercase tracking-wider px-3.5 py-1.5 rounded-2xl border border-yellow-500/15">Menunggu Verifikasi</span>
                @endif
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="flex items-start gap-3 bg-green-50 border border-green-100 text-green-700 rounded-2xl px-5 py-4 mb-6">
        <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        <p class="text-sm font-bold">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="flex items-start gap-3 bg-red-50 border border-red-100 text-red-600 rounded-2xl px-5 py-4 mb-6">
        <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-sm font-bold">{{ session('error') }}</p>
    </div>
    @endif

    {{-- Saldo Card (Glossy Blue Glass) --}}
    <div class="glass-btn-blue rounded-[2rem] p-8 mb-6 relative overflow-hidden shadow-xl shadow-blue-500/10 hover:translate-y-[-2px] transition-all duration-300">
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/10 rounded-full"></div>
        <div class="absolute -right-4 -bottom-8 w-24 h-24 bg-white/5 rounded-full"></div>
        <div class="relative z-10">
            <p class="text-blue-100 text-xs font-black uppercase tracking-widest mb-1.5">Saldo Aktif</p>
            <p class="text-4xl font-black text-white mb-1">Rp {{ number_format($balance->balance, 0, ',', '.') }}</p>
            <p class="text-blue-200 text-xs font-semibold mb-6">Total pernah masuk: Rp {{ number_format($balance->total_earned, 0, ',', '.') }}</p>

            {{-- Form Withdraw --}}
            <div x-data="{ open: false }">
                <button @click="open = !open" type="button"
                    class="inline-flex items-center gap-2 bg-white text-blue-600 font-black text-xs uppercase tracking-widest px-6 py-3.5 rounded-2xl hover:bg-blue-50 transition-all hover:shadow-lg active:scale-[0.98]">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Tarik Saldo
                </button>

                <div x-show="open" x-transition class="mt-6 bg-white/95 rounded-2xl p-6 shadow-2xl space-y-4">
                    <form action="{{ route('balance.withdraw.post') }}" method="POST" class="space-y-4 text-left">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Jumlah Tarik</label>
                                <div class="relative mt-1">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-black text-slate-500">Rp</span>
                                    <input type="number" name="amount" min="50000" step="1000" placeholder="50000"
                                        class="w-full bg-slate-50 border border-slate-100 rounded-xl pl-9 pr-3 py-3 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-100">
                                </div>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Bank Penerima</label>
                                <input type="text" name="bank_name" placeholder="BCA / Mandiri" value="{{ old('bank_name') }}"
                                    class="w-full mt-1 bg-slate-50 border border-slate-100 rounded-xl px-3 py-3 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-100">
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">No. Rekening</label>
                            <input type="text" name="bank_account_number" placeholder="Nomor rekening bank anda" value="{{ old('bank_account_number') }}"
                                class="w-full mt-1 bg-slate-50 border border-slate-100 rounded-xl px-3 py-3 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-100">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Atas Nama Rekening</label>
                            <input type="text" name="bank_account_name" placeholder="Nama lengkap pemilik rekening" value="{{ old('bank_account_name') }}"
                                class="w-full mt-1 bg-slate-50 border border-slate-100 rounded-xl px-3 py-3 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-100">
                        </div>
                        <button type="submit" class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-black text-xs uppercase tracking-widest transition-all">
                            Ajukan Withdraw
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu List (Designed EXACTLY like User Reference Mockup) --}}
    <div class="backdrop-blur-3xl bg-slate-950/70 border border-white/10 rounded-[2.2rem] p-4 shadow-2xl space-y-2 hover:translate-y-[-2px] transition-all duration-300 mb-6">
        
        {{-- Portfolio --}}
        <a href="{{ route('photographer.portfolio') }}" 
           class="flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300 group
                  {{ Route::is('photographer.portfolio') ? 'bg-white text-slate-900 shadow-xl font-bold' : 'text-white/85 hover:bg-white hover:text-slate-900' }}">
            <div class="flex items-center gap-4">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold tracking-wide">Portfolio Foto</span>
            </div>
            <svg class="w-4 h-4 opacity-50 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        {{-- Sales History --}}
        <a href="{{ route('balance.sales') }}" 
           class="flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300 group
                  {{ Route::is('balance.sales') ? 'bg-white text-slate-900 shadow-xl font-bold' : 'text-white/85 hover:bg-white hover:text-slate-900' }}">
            <div class="flex items-center gap-4">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <span class="text-sm font-bold tracking-wide">Riwayat Penjualan</span>
            </div>
            <svg class="w-4 h-4 opacity-50 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
            </svg>
        </a>

        {{-- Logout --}}
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" 
                    class="w-full flex items-center justify-between px-5 py-4 rounded-2xl transition-all duration-300 group text-left text-red-400 hover:bg-red-500 hover:text-white">
                <div class="flex items-center gap-4">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <span class="text-sm font-bold tracking-wide">Keluar</span>
                </div>
                <svg class="w-4 h-4 opacity-50 group-hover:opacity-100 transition-opacity" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
        </form>

    </div>

    {{-- Riwayat Withdrawal (Glass Card) --}}
    <div class="glass-card rounded-[2rem] p-8 shadow-md hover:translate-y-[-2px] transition-all duration-300">
        <div class="flex items-center justify-between mb-6 pb-4 border-b border-slate-500/10">
            <div>
                <h2 class="text-base font-black uppercase tracking-wider text-slate-900">Riwayat Withdrawal</h2>
                <p class="text-xs text-slate-500 font-bold mt-1">10 pengajuan terakhir</p>
            </div>
            <span class="text-xs bg-slate-900/5 text-slate-600 font-black px-3 py-1 rounded-full border border-slate-500/10">{{ $withdrawals->count() }} DATA</span>
        </div>

        @if($withdrawals->isEmpty())
            <div class="py-12 text-center">
                <svg class="w-12 h-12 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <p class="text-slate-500 font-bold text-sm">Belum ada pengajuan withdrawal</p>
            </div>
        @else
            <div class="divide-y divide-slate-500/10">
                @foreach($withdrawals as $withdrawal)
                    <div class="py-4 first:pt-0 last:pb-0">
                        <div class="flex items-start justify-between gap-4">
                            <div class="min-w-0">
                                <p class="text-lg font-black text-slate-900">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</p>
                                <p class="text-xs text-slate-500 font-semibold mt-1 truncate">
                                    {{ $withdrawal->bank_name }} • {{ $withdrawal->bank_account_number }} • {{ $withdrawal->bank_account_name }}
                                </p>
                                <p class="text-[11px] text-slate-400 font-bold mt-2">
                                    {{ \Carbon\Carbon::parse($withdrawal->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }} WIB
                                </p>

                                @if($withdrawal->rejection_reason)
                                <p class="text-xs font-bold text-red-500 mt-2">Alasan Ditolak: {{ $withdrawal->rejection_reason }}</p>
                                @endif
                            </div>

                            <span class="inline-flex items-center px-3 py-1 rounded-full text-[10px] font-black shrink-0 border
                                {{ $withdrawal->status === 'approved' ? 'bg-green-500/10 text-green-600 border-green-500/15' : ($withdrawal->status === 'transferred' ? 'bg-blue-500/10 text-blue-600 border-blue-500/15' : ($withdrawal->status === 'rejected' ? 'bg-red-500/10 text-red-500 border-red-500/15' : 'bg-yellow-500/10 text-yellow-600 border-yellow-500/15')) }}">
                                {{ strtoupper($withdrawal->status) }}
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
