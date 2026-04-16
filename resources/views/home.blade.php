@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="bg-white p-12 rounded-3xl shadow-sm border border-gray-100 text-center space-y-6">
    <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
    </div>
    <h1 class="text-3xl font-black tracking-tight text-gray-900">Selamat Datang di Beranda</h1>
    <p class="text-gray-500 max-w-md mx-auto">Ini halaman Beranda kosong dulu. Navigasi Sidebar (Desktop) dan Bottom Nav (Mobile) sudah terintegrasi sempurna.</p>
</div>
@endsection
