@extends('layouts.app')
@section('title', 'Menunggu Verifikasi')
@section('content')

@php
    $user    = auth()->user();
    $profile = $user->photographerProfile;
    $status  = $profile->verification_status ?? 'pending';
@endphp

<style>
    .clean-glass {
        background: rgba(255, 255, 255, 0.72);
        backdrop-filter: blur(32px) saturate(140%);
        -webkit-backdrop-filter: blur(32px) saturate(140%);
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 30px 60px -15px rgba(15, 23, 42, 0.05), 0 0 0 1px rgba(255, 255, 255, 0.6) inset;
    }
    .clean-glass-box {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(15, 23, 42, 0.06);
        color: #334155;
    }
</style>

<div class="max-w-xl mx-auto px-6 py-12 flex flex-col items-center text-center relative z-10 animate-in fade-in slide-in-from-bottom-4 duration-1000">

    <div class="clean-glass p-8 md:p-10 rounded-[2.5rem] w-full space-y-6 relative overflow-hidden">
        {{-- Modern Ambient Decorative Glow inside Card --}}
        <div class="absolute top-0 right-0 w-32 h-32 bg-sky-400/4 rounded-full blur-3xl pointer-events-none"></div>

        @if($status === 'verified')
        {{-- VERIFIED --}}
        <div class="mx-auto w-20 h-20 rounded-3xl bg-emerald-500/10 text-emerald-600 flex items-center justify-center border border-emerald-500/20 shadow-inner mb-2">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        
        <div>
            <span class="inline-block bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full border border-emerald-100 mb-4">Terverifikasi</span>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Akun Diaktifkan!</h1>
            <p class="text-slate-500 font-semibold text-xs leading-relaxed mt-2 max-w-sm mx-auto">
                Selamat! Akun fotografer kamu sudah diverifikasi. Kamu sekarang bisa mulai mengunggah foto acara.
            </p>
        </div>

        <div class="clean-glass-box rounded-2xl p-5 text-left space-y-4">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tahapan Verifikasi</p>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Pendaftaran Dikirim</p>
                        <p class="text-[10px] text-slate-400">Data pendaftaran telah diterima</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Ditinjau Admin</p>
                        <p class="text-[10px] text-slate-400">Proses evaluasi dokumen selesai</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Akun Diaktifkan</p>
                        <p class="text-[10px] text-slate-400">Akses penuh galeri fotografer aktif</p>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('photographer.portfolio') }}" class="w-full py-3.5 bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 text-white rounded-2xl font-black text-[11px] uppercase tracking-widest shadow-md shadow-slate-300/40 hover:shadow-lg hover:shadow-slate-300/60 hover:-translate-y-0.5 active:translate-y-0 transition-all cursor-pointer flex items-center justify-center gap-2 mt-2">
            Mulai Unggah Foto
            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
            </svg>
        </a>

        @elseif($status === 'rejected')
        {{-- REJECTED --}}
        <div class="mx-auto w-20 h-20 rounded-3xl bg-red-500/10 text-red-600 flex items-center justify-center border border-red-500/20 shadow-inner mb-2">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        
        <div>
            <span class="inline-block bg-red-50 text-red-500 text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full border border-red-100 mb-4">Ditolak</span>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Pendaftaran Ditolak</h1>
            <p class="text-slate-500 font-semibold text-xs leading-relaxed mt-2 max-w-sm mx-auto">
                Maaf, pendaftaran fotografer kamu tidak disetujui oleh admin KeJepret.
                @if($profile->rejection_reason)
                <span class="block mt-2 font-black text-red-600">Alasan: {{ $profile->rejection_reason }}</span>
                @endif
            </p>
        </div>

        <div class="clean-glass-box rounded-2xl p-5 text-left space-y-4">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tahapan Verifikasi</p>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Pendaftaran Dikirim</p>
                        <p class="text-[10px] text-slate-400">Data pendaftaran telah diterima</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-red-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Ditinjau Admin</p>
                        <p class="text-[10px] text-slate-400">Evaluasi dokumen tidak disetujui</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-slate-100 rounded-full flex items-center justify-center flex-shrink-0 border border-slate-200">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400">Akun Diaktifkan</p>
                        <p class="text-[10px] text-slate-400/60">Akses penuh galeri fotografer aktif</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-2">
            <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 py-3.5 bg-white/40 hover:bg-white/75 border border-slate-350 hover:border-slate-400 text-slate-650 hover:text-slate-800 rounded-full font-black text-[10px] uppercase tracking-widest transition-all shadow-sm shadow-slate-200/40 hover:shadow active:scale-[0.98] cursor-pointer">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Beranda
            </a>
            <a href="mailto:support@kejepret.id" class="flex items-center justify-center gap-2 py-3.5 bg-gradient-to-r from-sky-500 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 text-white rounded-full font-black text-[10px] uppercase tracking-widest transition-all shadow-sm active:scale-[0.98] cursor-pointer">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                Dukungan
            </a>
        </div>

        @else
        {{-- PENDING --}}
        <div class="mx-auto w-20 h-20 rounded-3xl bg-amber-500/10 text-amber-600 flex items-center justify-center border border-amber-500/20 shadow-inner mb-2 relative">
            <svg class="w-10 h-10 animate-spin-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.21 8H18.5" />
            </svg>
            <span class="absolute -top-1 -right-1 flex h-4 w-4">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-4 w-4 bg-amber-500"></span>
            </span>
        </div>
        
        <div>
            <span class="inline-block bg-amber-50 text-amber-600 text-[10px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full border border-amber-100 mb-4 animate-pulse">Menunggu Verifikasi</span>
            <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Sedang Diproses</h1>
            <p class="text-slate-500 font-semibold text-xs leading-relaxed mt-2 max-w-sm mx-auto">
                Pendaftaran fotografer kamu sedang ditinjau oleh admin KeJepret.
                Proses verifikasi membutuhkan waktu maksimal <span class="font-black text-indigo-650">1x24 jam</span>.
            </p>
        </div>

        <div class="clean-glass-box rounded-2xl p-5 text-left space-y-4">
            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tahapan Verifikasi</p>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-emerald-500 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Pendaftaran Dikirim</p>
                        <p class="text-[10px] text-slate-400">Data pendaftaran telah diterima</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-amber-500 rounded-full flex items-center justify-center flex-shrink-0 animate-pulse">
                        <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-800">Ditinjau Admin</p>
                        <p class="text-[10px] text-slate-400">Sedang dalam proses peninjauan berkas</p>
                    </div>
                </div>
                <div class="flex items-center gap-3">
                    <div class="w-7 h-7 bg-slate-100 rounded-full flex items-center justify-center flex-shrink-0 border border-slate-200">
                        <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-slate-400">Akun Diaktifkan</p>
                        <p class="text-[10px] text-slate-400/60">Akses penuh galeri fotografer aktif</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4 mt-2">
            <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 py-3.5 bg-white/40 hover:bg-white/75 border border-slate-350 hover:border-slate-400 text-slate-650 hover:text-slate-800 rounded-full font-black text-[10px] uppercase tracking-widest transition-all shadow-sm shadow-slate-200/40 hover:shadow active:scale-[0.98] cursor-pointer">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Beranda
            </a>
            <a href="{{ route('photographer.profil') }}" class="flex items-center justify-center gap-2 py-3.5 bg-gradient-to-r from-sky-500 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 text-white rounded-full font-black text-[10px] uppercase tracking-widest transition-all shadow-sm active:scale-[0.98] cursor-pointer">
                <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Lihat Profil
            </a>
        </div>

        @endif

    </div>

    <p class="text-center text-[10px] font-bold text-slate-500 uppercase tracking-[0.3em] mt-8">
        &copy; 2026 KEJEPRET STUDIO
    </p>

</div>
@endsection