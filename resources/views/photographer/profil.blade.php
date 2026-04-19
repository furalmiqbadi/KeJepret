@extends('layouts.app')
@section('title', 'Profil Fotografer')
@section('content')

@php $user = auth()->user(); @endphp

<div class="max-w-2xl mx-auto px-4 sm:px-6 py-8">

    {{-- Profile Header --}}
    <div class="flex items-start gap-5 mb-8">
        <div class="w-16 h-16 rounded-full bg-blue-100 flex items-center justify-center flex-shrink-0 border-2 border-white shadow-md">
            <span class="text-2xl font-black text-blue-600">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
        </div>
        <div>
            <h1 class="text-2xl font-black text-gray-900 mb-0.5">{{ $user->name }}</h1>
            <p class="text-gray-400 text-sm font-semibold mb-2">{{ $user->email }}</p>
            <div class="flex items-center gap-2 flex-wrap">
                <span class="inline-block bg-blue-50 text-blue-600 text-[11px] font-bold px-3 py-1 rounded-full border border-blue-100">Fotografer</span>
                @php
                    $profile = $user->photographerProfile;
                    $verStatus = $profile->verification_status ?? 'pending';
                @endphp
                @if($verStatus === 'verified')
                <span class="inline-block bg-green-50 text-green-600 text-[11px] font-bold px-3 py-1 rounded-full border border-green-100">Terverifikasi</span>
                @elseif($verStatus === 'rejected')
                <span class="inline-block bg-red-50 text-red-500 text-[11px] font-bold px-3 py-1 rounded-full border border-red-100">Ditolak</span>
                @else
                <span class="inline-block bg-yellow-50 text-yellow-600 text-[11px] font-bold px-3 py-1 rounded-full border border-yellow-100">Menunggu Verifikasi</span>
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

    {{-- Saldo Card --}}
    <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-3xl p-6 mb-4 relative overflow-hidden">
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/10 rounded-full"></div>
        <div class="absolute -right-4 -bottom-8 w-24 h-24 bg-white/5 rounded-full"></div>
        <div class="relative z-10">
            <p class="text-blue-100 text-xs font-bold uppercase tracking-widest mb-1">Saldo Aktif</p>
            <p class="text-4xl font-black text-white mb-0.5">Rp {{ number_format($balance->balance, 0, ',', '.') }}</p>
            <p class="text-blue-200 text-sm font-semibold mb-5">Total pernah masuk: Rp {{ number_format($balance->total_earned, 0, ',', '.') }}</p>

            {{-- Form Withdraw --}}
            <div x-data="{ open: false }">
                <button @click="open = !open" type="button"
                    class="inline-flex items-center gap-2 bg-white text-blue-600 font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-blue-50 transition shadow">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Tarik Saldo
                </button>

                <div x-show="open" x-transition class="mt-4 bg-white rounded-2xl p-5 space-y-3">
                    <form action="{{ route('balance.withdraw.post') }}" method="POST" class="space-y-3">
                        @csrf
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">Jumlah</label>
                                <div class="relative mt-1">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-black text-slate-400">Rp</span>
                                    <input type="number" name="amount" min="50000" step="10000" placeholder="50000"
                                        class="w-full bg-slate-50 border border-slate-100 rounded-xl pl-10 pr-3 py-3 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-100">
                                </div>
                            </div>
                            <div>
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">Bank</label>
                                <input type="text" name="bank_name" placeholder="BCA" value="{{ old('bank_name') }}"
                                    class="w-full mt-1 bg-slate-50 border border-slate-100 rounded-xl px-3 py-3 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-100">
                            </div>
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">No. Rekening</label>
                            <input type="text" name="bank_account_number" placeholder="08xxxxxxxxxx" value="{{ old('bank_account_number') }}"
                                class="w-full mt-1 bg-slate-50 border border-slate-100 rounded-xl px-3 py-3 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-100">
                        </div>
                        <div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.15em]">Atas Nama</label>
                            <input type="text" name="bank_account_name" placeholder="Nama Rekening" value="{{ old('bank_account_name') }}"
                                class="w-full mt-1 bg-slate-50 border border-slate-100 rounded-xl px-3 py-3 text-sm font-bold outline-none focus:ring-2 focus:ring-blue-100">
                        </div>
                        <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-xl font-bold text-sm hover:bg-blue-700 transition">
                            Ajukan Withdraw
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Menu --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm divide-y divide-gray-50 overflow-hidden mb-4">
        <a href="{{ route('photographer.portfolio') }}" class="flex items-center justify-between p-4 hover:bg-gray-50 transition group">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-50 transition">
                    <svg class="w-4 h-4 text-gray-500 group-hover:text-blue-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-900">Portfolio Foto</p>
                    <p class="text-xs text-gray-400">Kelola foto yang sudah diupload</p>
                </div>
            </div>
            <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>

        <a href="{{ route('balance.sales') }}" class="flex items-center justify-between p-4 hover:bg-gray-50 transition group">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 bg-gray-100 rounded-xl flex items-center justify-center group-hover:bg-blue-50 transition">
                    <svg class="w-4 h-4 text-gray-500 group-hover:text-blue-500 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-900">Riwayat Penjualan</p>
                    <p class="text-xs text-gray-400">Lihat foto yang sudah terjual</p>
                </div>
            </div>
            <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        </a>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center justify-between p-4 hover:bg-red-50 transition group text-left">
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 bg-red-50 rounded-xl flex items-center justify-center">
                        <svg class="w-4 h-4 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-red-500">Keluar</p>
                        <p class="text-xs text-gray-400">Logout dari akun ini</p>
                    </div>
                </div>
                <svg class="w-4 h-4 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
            </button>
        </form>
    </div>

</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
