@extends('layouts.app')

@section('title', 'Koleksi')

@section('content')
    <div class="bg-white p-12 rounded-3xl shadow-sm border border-gray-100 text-center space-y-6">
        <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
        </div>
        <h1 class="text-3xl font-black tracking-tight text-gray-900">Ini Halaman Koleksi</h1>
        <p class="text-gray-500 max-w-md mx-auto">Daftar foto yang sudah Anda beli akan ditata rapi dalam grid premium di
            sini.</p>
    </div>
@endsection