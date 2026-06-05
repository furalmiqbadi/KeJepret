@extends('layouts.app')
@section('title', 'Profil Fotografer')
@section('content')

@php $user = auth()->user(); @endphp

<div class="max-w-5xl mx-auto px-4 sm:px-6 py-12 relative z-10 animate-in fade-in slide-in-from-bottom-4 duration-1000">

    {{-- HEADER --}}
    <div class="mb-10 text-center">
        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600 mb-2">FOTOGRAFER</p>
        <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-1">Profil & Keuangan</h1>
        <p class="text-sm font-bold text-slate-500">Kelola profil, saldo penghasilan, dan tarik dana.</p>
    </div>

    @if(session('success'))
    <div id="toast-success" class="bg-green-50 border border-green-100 text-green-600 px-6 py-5 rounded-[1.5rem] mb-8 shadow-sm flex items-start gap-4 animate-in fade-in slide-in-from-top-4 relative">
        <svg class="w-6 h-6 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="flex-1">
            <p class="text-sm font-black mb-1.5 tracking-wide">Berhasil!</p>
            <p class="text-xs font-bold text-green-700">{{ session('success') }}</p>
        </div>
        <button onclick="dismissToast('toast-success')" class="text-green-400 hover:text-green-700 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div id="toast-error" class="bg-red-50 border border-red-100 text-red-600 px-6 py-5 rounded-[1.5rem] mb-8 shadow-sm flex items-start gap-4 animate-in fade-in slide-in-from-top-4 relative">
        <svg class="w-6 h-6 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="flex-1">
            <p class="text-sm font-black mb-1.5 tracking-wide">Gagal!</p>
            <p class="text-xs font-bold text-red-700">{{ session('error') }}</p>
        </div>
        <button onclick="dismissToast('toast-error')" class="text-red-400 hover:text-red-700 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    {{-- TWO COLUMN LAYOUT --}}
    <div class="grid grid-cols-1 md:grid-cols-12 gap-8">
        
        {{-- LEFT COLUMN: Profile & Menu --}}
        <div class="md:col-span-5 space-y-6">
            
            {{-- Profile Card --}}
            <div class="bg-white rounded-[2rem] p-8 shadow-xl shadow-slate-200/50 border border-slate-100 text-center relative overflow-hidden group">
                <div class="w-24 h-24 mx-auto rounded-3xl bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center shadow-[0_10px_25px_rgba(37,99,235,0.2)] mb-5 group-hover:scale-105 transition-transform duration-500">
                    <span class="text-4xl font-black text-white italic tracking-tighter">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
                <h2 class="text-2xl font-black text-slate-900 tracking-tight mb-1">{{ $user->name }}</h2>
                <p class="text-slate-500 text-xs font-bold mb-5">{{ $user->email }}</p>
                
                <div class="flex justify-center gap-2 mb-6">
                    <span class="bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full">Fotografer</span>
                    @php
                        $profile = $user->photographerProfile;
                        $verStatus = $profile->verification_status ?? 'pending';
                    @endphp
                    @if($verStatus === 'verified')
                    <span class="bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full">Terverifikasi</span>
                    @elseif($verStatus === 'rejected')
                    <span class="bg-red-50 text-red-500 text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full">Ditolak</span>
                    @else
                    <span class="bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest px-3 py-1 rounded-full">Pending</span>
                    @endif
                </div>

                <a href="{{ route('profil.edit') }}" class="inline-flex w-full justify-center items-center gap-2 bg-slate-50 hover:bg-slate-100 text-slate-700 font-bold text-xs uppercase tracking-widest px-6 py-4 rounded-2xl transition-all">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    Edit Profil
                </a>
            </div>

            {{-- Menu Card --}}
            <div class="bg-slate-900 rounded-[2rem] p-4 shadow-xl shadow-slate-900/20">
                <div class="space-y-1">
                    <a href="{{ route('photographer.portfolio') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-white/10 text-slate-300 hover:text-white transition-all group">
                        <div class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-blue-500 group-hover:scale-110 transition-all">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-sm font-bold tracking-wide flex-1">Portfolio Foto</span>
                        <svg class="w-4 h-4 opacity-50 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    
                    <a href="{{ route('balance.sales') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-white/10 text-slate-300 hover:text-white transition-all group">
                        <div class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center group-hover:bg-blue-500 group-hover:scale-110 transition-all">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <span class="text-sm font-bold tracking-wide flex-1">Statistik Penjualan</span>
                        <svg class="w-4 h-4 opacity-50 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-red-500/10 text-red-400 hover:text-red-500 transition-all group">
                            <div class="w-8 h-8 rounded-xl bg-red-500/10 flex items-center justify-center group-hover:bg-red-500 group-hover:text-white group-hover:scale-110 transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </div>
                            <span class="text-sm font-bold tracking-wide flex-1 text-left">Keluar Akun</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>

        {{-- RIGHT COLUMN: Finance --}}
        <div class="md:col-span-7 space-y-6">
            
            {{-- Balance Card --}}
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-[2rem] p-10 text-white shadow-2xl shadow-blue-500/30 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -left-10 -bottom-10 w-48 h-48 bg-black/10 rounded-full blur-2xl"></div>
                
                <div class="relative z-10" x-data="{ openWithdraw: false }">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-200 mb-2">Saldo Tersedia</p>
                    <p class="text-5xl font-black tracking-tight mb-2">Rp {{ number_format($balance->balance, 0, ',', '.') }}</p>
                    <p class="text-blue-200 text-xs font-bold mb-8 opacity-80">Total pendapatan: Rp {{ number_format($balance->total_earned, 0, ',', '.') }}</p>

                    <button @click="openWithdraw = !openWithdraw" type="button" class="inline-flex items-center gap-2 bg-white text-blue-600 font-black text-xs uppercase tracking-widest px-8 py-4 rounded-2xl hover:shadow-lg hover:scale-105 transition-all">
                        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Tarik Saldo
                    </button>

                    <div x-show="openWithdraw" x-transition.opacity class="mt-8 bg-white/10 backdrop-blur-md rounded-[1.5rem] p-6 border border-white/20">
                        <form action="{{ route('balance.withdraw.post') }}" method="POST" class="space-y-4">
                            @csrf
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-[10px] font-black text-blue-200 uppercase tracking-widest block mb-1.5">Jumlah Tarik</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-black text-slate-800">Rp</span>
                                        <input type="number" name="amount" min="50000" step="1000" placeholder="50.000"
                                            class="w-full bg-white border-0 rounded-xl pl-10 pr-4 py-3.5 text-sm font-bold text-slate-900 outline-none focus:ring-4 focus:ring-blue-400/30">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-blue-200 uppercase tracking-widest block mb-1.5">Bank Penerima</label>
                                    <input type="text" name="bank_name" placeholder="BCA / Mandiri / dll" value="{{ old('bank_name') }}"
                                        class="w-full bg-white border-0 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-900 outline-none focus:ring-4 focus:ring-blue-400/30">
                                </div>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-blue-200 uppercase tracking-widest block mb-1.5">No. Rekening</label>
                                <input type="text" name="bank_account_number" placeholder="Nomor rekening" value="{{ old('bank_account_number') }}"
                                    class="w-full bg-white border-0 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-900 outline-none focus:ring-4 focus:ring-blue-400/30">
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-blue-200 uppercase tracking-widest block mb-1.5">Atas Nama Rekening</label>
                                <input type="text" name="bank_account_name" placeholder="Nama lengkap pemilik rekening" value="{{ old('bank_account_name') }}"
                                    class="w-full bg-white border-0 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-900 outline-none focus:ring-4 focus:ring-blue-400/30">
                            </div>
                            <button type="submit" class="w-full mt-2 py-4 bg-slate-900 hover:bg-black text-white rounded-xl font-black text-xs uppercase tracking-widest transition-all">
                                Ajukan Penarikan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Withdrawal History --}}
            <div class="bg-white rounded-[2rem] border border-slate-100 shadow-xl shadow-slate-200/50 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                    <h2 class="text-sm font-black uppercase tracking-widest text-slate-800">Riwayat Penarikan</h2>
                    <span class="inline-flex items-center justify-center px-3 py-1 text-xs font-bold bg-white border border-slate-200 text-slate-500 rounded-full shadow-sm">{{ $withdrawals->count() }} Data</span>
                </div>

                @if($withdrawals->isEmpty())
                    <div class="py-12 text-center px-4">
                        <div class="w-16 h-16 bg-slate-50 text-slate-300 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-inner">
                            <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-slate-500">Belum ada riwayat penarikan</p>
                    </div>
                @else
                    <div class="divide-y divide-slate-50">
                        @foreach($withdrawals as $withdrawal)
                            <div class="p-6 hover:bg-slate-50/80 transition-colors">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div>
                                        <p class="text-xl font-black text-slate-900">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</p>
                                        <p class="text-xs font-bold text-slate-500 mt-1">
                                            {{ $withdrawal->bank_name }} &bull; {{ $withdrawal->bank_account_number }}
                                        </p>
                                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mt-2">
                                            {{ \Carbon\Carbon::parse($withdrawal->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }}
                                        </p>
                                        @if($withdrawal->rejection_reason)
                                        <p class="text-xs font-bold text-red-500 mt-2 bg-red-50 inline-block px-2 py-1 rounded-md border border-red-100">
                                            Alasan ditolak: {{ $withdrawal->rejection_reason }}
                                        </p>
                                        @endif
                                    </div>
                                    <div class="shrink-0">
                                        @php
                                            $statusColors = [
                                                'approved' => 'bg-green-50 text-green-600 border-green-200',
                                                'transferred' => 'bg-blue-50 text-blue-600 border-blue-200',
                                                'rejected' => 'bg-red-50 text-red-600 border-red-200',
                                            ];
                                            $colorClass = $statusColors[$withdrawal->status] ?? 'bg-amber-50 text-amber-600 border-amber-200';
                                        @endphp
                                        <span class="inline-flex items-center px-3.5 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest border {{ $colorClass }}">
                                            {{ $withdrawal->status }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>

</div>

<script>
    function dismissToast(id) {
        const el = document.getElementById(id);
        if (!el) return;
        el.style.opacity = '0';
        el.style.transform = 'translateY(-12px)';
        setTimeout(() => el.remove(), 400);
    }
    @if(session('success') || session('error'))
    setTimeout(() => dismissToast(document.getElementById('toast-success') ? 'toast-success' : 'toast-error'), 5000);
    @endif
</script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@endsection
