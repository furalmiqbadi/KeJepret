@extends('layouts.app')
@section('title', 'Profil Fotografer')
@section('content')

@php $user = auth()->user(); @endphp

<div class="max-w-6xl mx-auto px-4 sm:px-6 py-12 relative z-10">

    {{-- Background Ambient Elements --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-4xl h-96 bg-gradient-to-b from-sky-100/50 to-transparent blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed -bottom-32 -left-32 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>
    <div class="fixed top-1/4 -right-32 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none -z-10"></div>

    {{-- HEADER --}}
    <div class="mb-12 text-center animate-in fade-in slide-in-from-bottom-4 duration-700">
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-50 border border-blue-100 mb-4 shadow-sm">
            <span class="w-2 h-2 rounded-full bg-blue-600 animate-pulse"></span>
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600">WORKSPACE FOTOGRAFER</p>
        </div>
        <h1 class="text-4xl sm:text-5xl font-black text-slate-900 tracking-tight mb-2">Profil & Keuangan</h1>
        <p class="text-sm sm:text-base font-semibold text-slate-500 max-w-xl mx-auto">Kelola identitas publik, cek saldo penghasilan, dan tarik dana ke rekening Anda secara praktis.</p>
    </div>

    {{-- Toasts --}}
    @if(session('success'))
    <div id="toast-success" class="glass-card bg-green-50/80 border border-green-200 text-green-700 px-6 py-5 rounded-[1.5rem] mb-8 shadow-sm flex items-start gap-4 animate-in fade-in slide-in-from-top-4 relative max-w-2xl mx-auto">
        <svg class="w-6 h-6 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="flex-1">
            <p class="text-sm font-black mb-1 tracking-wide">Berhasil!</p>
            <p class="text-xs font-bold">{{ session('success') }}</p>
        </div>
        <button onclick="dismissToast('toast-success')" class="text-green-400 hover:text-green-700 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif
    @if(session('error'))
    <div id="toast-error" class="glass-card bg-red-50/80 border border-red-200 text-red-700 px-6 py-5 rounded-[1.5rem] mb-8 shadow-sm flex items-start gap-4 animate-in fade-in slide-in-from-top-4 relative max-w-2xl mx-auto">
        <svg class="w-6 h-6 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="flex-1">
            <p class="text-sm font-black mb-1 tracking-wide">Gagal!</p>
            <p class="text-xs font-bold">{{ session('error') }}</p>
        </div>
        <button onclick="dismissToast('toast-error')" class="text-red-400 hover:text-red-700 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif
    @if($errors->any())
    <div id="toast-validation" class="glass-card bg-red-50/80 border border-red-200 text-red-700 px-6 py-5 rounded-[1.5rem] mb-8 shadow-sm flex items-start gap-4 animate-in fade-in slide-in-from-top-4 relative max-w-2xl mx-auto">
        <svg class="w-6 h-6 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="flex-1">
            <p class="text-sm font-black mb-1 tracking-wide">Input Tidak Valid!</p>
            <ul class="text-xs font-bold list-disc pl-4 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button onclick="dismissToast('toast-validation')" class="text-red-400 hover:text-red-700 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    {{-- TWO COLUMN LAYOUT --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        {{-- LEFT COLUMN: Profile & Menu --}}
        <div class="lg:col-span-4 space-y-6 animate-in fade-in slide-in-from-left-8 duration-700 delay-100">
            
            {{-- Profile Card --}}
            <div class="glass-card rounded-[2.5rem] p-8 text-center relative overflow-hidden group border border-white/60 shadow-[0_20px_40px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_60px_rgba(37,99,235,0.08)] transition-all duration-500 bg-white/60 backdrop-blur-2xl">
                
                {{-- Cover background --}}
                <div class="absolute top-0 left-0 right-0 h-32 bg-gradient-to-br from-blue-600 to-indigo-700"></div>

                {{-- Avatar --}}
                <div class="w-32 h-32 mx-auto rounded-[2rem] bg-slate-100 flex items-center justify-center shadow-xl mb-5 group-hover:scale-105 group-hover:-translate-y-1 transition-all duration-500 overflow-hidden relative border-[6px] border-white mt-12 z-10">
                    @if($user->profile_face_url)
                        <img src="{{ $user->profile_face_url }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-tr from-blue-600 to-indigo-600 flex items-center justify-center">
                            <span class="text-5xl font-black text-white italic tracking-tighter">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                    @endif
                </div>
                
                <h2 class="text-2xl font-black text-slate-900 tracking-tight mb-1">{{ $user->name }}</h2>
                <p class="text-slate-500 text-sm font-semibold mb-5">{{ $user->email }}</p>
                
                <div class="flex justify-center gap-2 mb-8">
                    @php
                        $profile = $user->photographerProfile;
                        $verStatus = $profile->verification_status ?? 'pending';
                    @endphp
                    @if($verStatus === 'verified')
                    <span class="inline-flex items-center gap-1.5 bg-green-50 text-green-600 border border-green-200/60 text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full shadow-sm">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        Terverifikasi
                    </span>
                    @elseif($verStatus === 'rejected')
                    <span class="inline-flex items-center gap-1.5 bg-red-50 text-red-600 border border-red-200/60 text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full shadow-sm">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                        Ditolak
                    </span>
                    @else
                    <span class="inline-flex items-center gap-1.5 bg-amber-50 text-amber-600 border border-amber-200/60 text-[10px] font-black uppercase tracking-widest px-3 py-1.5 rounded-full shadow-sm">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Pending
                    </span>
                    @endif
                </div>

                <a href="{{ route('profil.edit') }}" class="inline-flex w-full justify-center items-center gap-2 bg-slate-900 hover:bg-black text-white shadow-lg hover:shadow-xl shadow-slate-900/20 font-bold text-xs uppercase tracking-widest px-6 py-4 rounded-[1.25rem] transition-all hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                    Edit Profil
                </a>
            </div>

            {{-- Menu Navigation --}}
            <div class="glass-card bg-white/70 backdrop-blur-2xl rounded-[2.5rem] p-3 shadow-xl shadow-slate-200/40 border border-white">
                <nav class="space-y-1">
                    <a href="{{ route('photographer.portfolio') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-white hover:shadow-sm text-slate-600 hover:text-blue-600 transition-all group font-bold">
                        <div class="w-10 h-10 rounded-[1rem] bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <span class="text-sm tracking-wide flex-1">Portfolio Foto</span>
                        <svg class="w-4 h-4 opacity-30 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>
                    
                    <a href="{{ route('balance.sales') }}" class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-white hover:shadow-sm text-slate-600 hover:text-indigo-600 transition-all group font-bold">
                        <div class="w-10 h-10 rounded-[1rem] bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <span class="text-sm tracking-wide flex-1">Statistik Penjualan</span>
                        <svg class="w-4 h-4 opacity-30 group-hover:opacity-100 group-hover:translate-x-1 transition-all" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                    </a>

                    <div class="h-px bg-slate-200/50 my-2 mx-4"></div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-red-50 text-red-500 transition-all group font-bold">
                            <div class="w-10 h-10 rounded-[1rem] bg-red-100/50 text-red-500 flex items-center justify-center group-hover:scale-110 group-hover:bg-red-500 group-hover:text-white transition-all shadow-sm">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </div>
                            <span class="text-sm tracking-wide flex-1 text-left">Keluar Akun</span>
                        </button>
                    </form>
                </nav>
            </div>

        </div>

        {{-- RIGHT COLUMN: Finance --}}
        <div class="lg:col-span-8 space-y-6 animate-in fade-in slide-in-from-right-8 duration-700 delay-200">
            
            {{-- Balance Digital Wallet Card --}}
            <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-[0_20px_50px_rgba(15,23,42,0.3)] relative overflow-hidden group">
                {{-- Decorative blobs --}}
                <div class="absolute -right-20 -top-20 w-64 h-64 bg-blue-500/30 rounded-full blur-3xl group-hover:bg-blue-400/40 transition-colors duration-700"></div>
                <div class="absolute -left-20 -bottom-20 w-64 h-64 bg-indigo-500/30 rounded-full blur-3xl group-hover:bg-indigo-400/40 transition-colors duration-700"></div>
                
                {{-- Glossy reflections --}}
                <div class="absolute top-0 left-0 w-full h-1/2 bg-gradient-to-b from-white/10 to-transparent pointer-events-none"></div>

                <div class="relative z-10" x-data="{ openWithdraw: {{ $errors->any() || session('error') ? 'true' : 'false' }} }">
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-8">
                        <div>
                            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full mb-6 border border-white/10">
                                <svg class="w-4 h-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <p class="text-[10px] font-black uppercase tracking-[0.2em] text-white">Dompet Penghasilan</p>
                            </div>
                            
                            <p class="text-sm font-semibold text-slate-300 mb-1">Saldo Tersedia</p>
                            <p class="text-5xl md:text-6xl font-black tracking-tighter mb-3 drop-shadow-md">Rp {{ number_format($balance->balance, 0, ',', '.') }}</p>
                            
                            <div class="flex items-center gap-2 text-sm font-bold text-slate-400 bg-black/20 inline-flex px-3 py-1.5 rounded-lg backdrop-blur-sm border border-white/5">
                                <span>Total Akumulasi:</span>
                                <span class="text-white">Rp {{ number_format($balance->total_earned, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="shrink-0 w-full md:w-auto relative z-20">
                            <button @click="openWithdraw = !openWithdraw" type="button" class="w-full md:w-auto inline-flex items-center justify-center gap-3 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-400 hover:to-indigo-400 text-white font-black text-sm uppercase tracking-widest px-8 py-5 rounded-2xl shadow-[0_10px_25px_rgba(59,130,246,0.5)] hover:shadow-[0_15px_35px_rgba(59,130,246,0.6)] hover:-translate-y-1 transition-all duration-300 border border-blue-400/50">
                                <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                Tarik Dana
                            </button>
                        </div>
                    </div>

                    {{-- Withdraw Form Dropdown --}}
                    <div x-show="openWithdraw" style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4" class="w-full mt-8 bg-white/10 backdrop-blur-2xl rounded-[2rem] p-8 border border-white/20 shadow-2xl relative z-30">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="font-black text-lg">Formulir Penarikan</h3>
                            <button @click="openWithdraw = false" class="w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <form action="{{ route('balance.withdraw.post') }}" method="POST" class="space-y-5">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="text-[10px] font-black text-slate-300 uppercase tracking-widest block mb-2">Jumlah Penarikan</label>
                                    <div class="relative group">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-black text-slate-400 group-focus-within:text-blue-500 transition-colors">Rp</span>
                                        <input type="number" name="amount" min="50000" step="1000" placeholder="50.000"
                                            class="w-full bg-white/5 border border-white/10 rounded-2xl pl-12 pr-4 py-4 text-sm font-bold text-white outline-none focus:bg-white/10 focus:border-blue-500/50 transition-all placeholder:text-slate-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-300 uppercase tracking-widest block mb-2">Bank Penerima</label>
                                    <input type="text" name="bank_name" placeholder="BCA / Mandiri / BNI" value="{{ old('bank_name') }}"
                                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-white outline-none focus:bg-white/10 focus:border-blue-500/50 transition-all placeholder:text-slate-500">
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="text-[10px] font-black text-slate-300 uppercase tracking-widest block mb-2">Nomor Rekening</label>
                                    <input type="text" name="bank_account_number" placeholder="Contoh: 1234567890" value="{{ old('bank_account_number') }}"
                                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-white outline-none focus:bg-white/10 focus:border-blue-500/50 transition-all placeholder:text-slate-500">
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-300 uppercase tracking-widest block mb-2">Atas Nama Rekening</label>
                                    <input type="text" name="bank_account_name" placeholder="Sesuai buku tabungan" value="{{ old('bank_account_name') }}"
                                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 text-sm font-bold text-white outline-none focus:bg-white/10 focus:border-blue-500/50 transition-all placeholder:text-slate-500">
                                </div>
                            </div>
                            <button type="submit" class="w-full mt-4 py-4 bg-white text-slate-900 hover:bg-slate-100 rounded-2xl font-black text-xs uppercase tracking-widest transition-all shadow-lg hover:scale-[1.01]">
                                Ajukan Penarikan Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Withdrawal History --}}
            <div class="glass-card bg-white/70 backdrop-blur-2xl rounded-[2.5rem] border border-white shadow-[0_20px_40px_rgba(0,0,0,0.04)] overflow-hidden">
                <div class="px-8 py-7 border-b border-slate-100/60 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-slate-100 rounded-[1rem] flex items-center justify-center text-slate-600 border border-slate-200/50">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <h2 class="text-base font-black text-slate-900 tracking-tight">Riwayat Penarikan</h2>
                    </div>
                    <span class="inline-flex items-center justify-center px-3 py-1.5 text-[10px] uppercase tracking-widest font-black bg-white text-slate-500 rounded-full shadow-sm border border-slate-200/60">{{ $withdrawals->count() }} Transaksi</span>
                </div>

                @if($withdrawals->isEmpty())
                    <div class="py-16 text-center px-4">
                        <div class="w-20 h-20 bg-slate-50 text-slate-300 rounded-[1.5rem] flex items-center justify-center mx-auto mb-5 shadow-inner border border-slate-100">
                            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <p class="text-sm font-bold text-slate-500">Belum ada riwayat penarikan dana</p>
                        <p class="text-xs text-slate-400 mt-1 font-medium">Lakukan penarikan pertama Anda melalui dompet di atas.</p>
                    </div>
                @else
                    <div class="divide-y divide-slate-100/60">
                        @foreach($withdrawals as $withdrawal)
                            <div class="p-6 sm:px-8 hover:bg-white/80 transition-colors group">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                    <div class="flex items-start gap-4">
                                        <div class="w-12 h-12 rounded-[1rem] bg-slate-100 flex items-center justify-center shrink-0 border border-slate-200/50 text-slate-400 group-hover:bg-blue-50 group-hover:text-blue-600 group-hover:border-blue-100 transition-colors shadow-sm">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-xl font-black text-slate-900 tracking-tight">Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}</p>
                                            <div class="flex items-center gap-2 mt-1">
                                                <p class="text-[11px] font-black text-slate-500 uppercase tracking-widest">
                                                    {{ $withdrawal->bank_name }} &bull; {{ $withdrawal->bank_account_number }}
                                                </p>
                                            </div>
                                            <p class="text-[10px] font-bold text-slate-400 mt-1.5 flex items-center gap-1.5">
                                                <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                {{ \Carbon\Carbon::parse($withdrawal->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }}
                                            </p>
                                            
                                            @if($withdrawal->rejection_reason)
                                            <div class="mt-3 bg-red-50/80 border border-red-100 rounded-xl p-3 inline-flex items-start gap-2 max-w-sm">
                                                <svg class="w-4 h-4 text-red-500 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <p class="text-[11px] font-bold text-red-600 leading-snug">
                                                    Ditolak: {{ $withdrawal->rejection_reason }}
                                                </p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="shrink-0 flex sm:flex-col items-end gap-2">
                                        @php
                                            $statusConfig = [
                                                'approved' => ['bg-green-50 text-green-600 border-green-200/50', 'M5 13l4 4L19 7', 'Selesai'],
                                                'transferred' => ['bg-blue-50 text-blue-600 border-blue-200/50', 'M5 13l4 4L19 7', 'Ditransfer'],
                                                'rejected' => ['bg-red-50 text-red-600 border-red-200/50', 'M6 18L18 6M6 6l12 12', 'Ditolak'],
                                                'pending' => ['bg-amber-50 text-amber-600 border-amber-200/50', 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z', 'Diproses'],
                                            ];
                                            $config = $statusConfig[$withdrawal->status] ?? $statusConfig['pending'];
                                        @endphp
                                        <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border {{ $config[0] }} shadow-sm">
                                            <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $config[1] }}"/></svg>
                                            <span class="text-[9px] font-black uppercase tracking-widest">{{ $config[2] }}</span>
                                        </div>
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
    @if(session('success') || session('error') || $errors->any())
    setTimeout(() => {
        dismissToast(document.getElementById('toast-success') ? 'toast-success' : (document.getElementById('toast-error') ? 'toast-error' : 'toast-validation'))
    }, 5000);
    @endif
</script>
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@endsection
