@extends('layouts.app')
@section('title', 'Menunggu Verifikasi')
@section('content')

@php
    $user    = auth()->user();
    $profile = $user->photographerProfile;
    $status  = $profile->verification_status ?? 'pending';
@endphp

<div class="max-w-lg mx-auto px-4 sm:px-6 py-16 flex flex-col items-center text-center">

    @if($status === 'rejected')
    {{-- REJECTED --}}
    <div class="w-20 h-20 bg-red-100 rounded-3xl flex items-center justify-center mb-6">
        <svg class="w-10 h-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    </div>
    <span class="inline-block bg-red-50 text-red-500 text-[11px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full border border-red-100 mb-4">Ditolak</span>
    <h1 class="text-3xl font-black text-gray-900 mb-3">Pendaftaran Ditolak</h1>
    <p class="text-gray-500 text-sm leading-relaxed mb-8 max-w-sm">
        Maaf, pendaftaran fotografer kamu tidak disetujui oleh admin.
        @if($profile->rejection_reason)
        <span class="block mt-2 font-bold text-gray-700">Alasan: {{ $profile->rejection_reason }}</span>
        @endif
    </p>
    <div class="flex flex-col sm:flex-row gap-3 w-full max-w-xs">
        <a href="{{ route('home') }}" class="flex-1 py-3 bg-gray-100 text-gray-700 rounded-2xl font-bold text-sm hover:bg-gray-200 transition text-center">Kembali ke Home</a>
        <a href="mailto:support@kejepret.id" class="flex-1 py-3 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition text-center">Hubungi Admin</a>
    </div>

    @else
    {{-- PENDING --}}
    <div class="w-20 h-20 bg-yellow-100 rounded-3xl flex items-center justify-center mb-6 relative">
        <svg class="w-10 h-10 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{-- Pulse indicator --}}
        <span class="absolute -top-1 -right-1 flex h-4 w-4">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-yellow-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-4 w-4 bg-yellow-500"></span>
        </span>
    </div>
    <span class="inline-block bg-yellow-50 text-yellow-600 text-[11px] font-black uppercase tracking-widest px-4 py-1.5 rounded-full border border-yellow-100 mb-4">Menunggu Verifikasi</span>
    <h1 class="text-3xl font-black text-gray-900 mb-3">Sedang Diproses</h1>
    <p class="text-gray-500 text-sm leading-relaxed mb-8 max-w-sm">
        Pendaftaran fotografer kamu sedang ditinjau oleh admin KeJepret.
        Biasanya proses verifikasi membutuhkan waktu <span class="font-bold text-gray-700">1x24 jam</span>.
        Kamu akan bisa mulai upload foto setelah akun diverifikasi.
    </p>

    {{-- Steps --}}
    <div class="w-full max-w-sm bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-8 text-left">
        <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Proses Verifikasi</p>
        <div class="space-y-4">
            <div class="flex items-center gap-3">
                <div class="w-7 h-7 bg-green-500 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-900">Pendaftaran Dikirim</p>
                    <p class="text-xs text-gray-400">Data kamu sudah kami terima</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-7 h-7 bg-yellow-400 rounded-full flex items-center justify-center flex-shrink-0 animate-pulse">
                    <svg class="w-3.5 h-3.5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-900">Ditinjau Admin</p>
                    <p class="text-xs text-gray-400">Sedang dalam proses review</p>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-7 h-7 bg-gray-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <svg class="w-3.5 h-3.5 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <p class="text-sm font-bold text-gray-300">Akun Diaktifkan</p>
                    <p class="text-xs text-gray-300">Bisa upload foto event</p>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row gap-3 w-full max-w-xs">
        <a href="{{ route('home') }}" class="flex-1 py-3 bg-gray-100 text-gray-700 rounded-2xl font-bold text-sm hover:bg-gray-200 transition text-center">Kembali ke Home</a>
        <a href="{{ route('photographer.profil') }}" class="flex-1 py-3 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition text-center">Lihat Profil</a>
    </div>
    @endif

</div>
@endsection
