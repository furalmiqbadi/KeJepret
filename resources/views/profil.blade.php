@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <div class="bg-white p-12 rounded-3xl shadow-sm border border-gray-100 text-center space-y-6">
        <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
        </div>
        <h1 class="text-3xl font-black tracking-tight text-gray-900">Ini Halaman Profil</h1>
        <p class="text-gray-500 max-w-md mx-auto">Dashboard untuk User Biasa dan Fotografer (Saldo, Chat, Laporan Penjualan)
            akan diimplementasikan di sini sesuai sketsa.</p>
    </div>
@endsection