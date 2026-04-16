@extends('layouts.app')

@section('title', 'Search')

@section('content')
    <div class="bg-white p-12 rounded-3xl shadow-sm border border-gray-100 text-center space-y-6">
        <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
        </div>
        <h1 class="text-3xl font-black tracking-tight text-gray-900">Ini Halaman Search</h1>
        <p class="text-gray-500 max-w-md mx-auto">Anda bisa mencari fotografer atau EO dengan filter kategori per event
            seperti yang direncanakan di sketsa.</p>
    </div>
@endsection