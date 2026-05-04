@extends('layouts.app')
@section('title', 'Riwayat Pencarian')
@section('content')

<div class="max-w-2xl mx-auto px-4 sm:px-6 py-8">

    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">RIWAYAT</p>
            <h1 class="text-3xl font-black text-gray-900">Riwayat Pencarian</h1>
        </div>
        <a href="{{ route('runner.search') }}" class="flex items-center gap-2 px-4 py-2.5 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari Lagi
        </a>
    </div>

    @if($sessions->isEmpty())
    <div class="text-center py-24">
        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <p class="font-black text-gray-400 text-lg">Belum ada riwayat pencarian</p>
        <a href="{{ route('runner.search') }}" class="inline-block mt-4 px-6 py-3 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition">Mulai Cari Foto</a>
    </div>
    @else
    <div class="space-y-3">
        @foreach($sessions as $session)
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-black text-gray-900 truncate">
                        {{ $session->event->name ?? 'Semua Event' }}
                    </p>
                    <p class="text-xs text-gray-400 font-semibold mt-0.5">
                        {{ \Carbon\Carbon::parse($session->created_at)->setTimezone('Asia/Jakarta')->translatedFormat('d M Y, H:i') }} WIB
                    </p>
                </div>
                <div class="flex flex-col items-end gap-1 flex-shrink-0">
                    <span class="inline-block text-[11px] font-black px-3 py-1 rounded-full
                        {{ $session->search_status === 'completed' ? 'bg-green-50 text-green-600' : ($session->search_status === 'failed' ? 'bg-red-50 text-red-500' : 'bg-yellow-50 text-yellow-600') }}">
                        {{ ucfirst($session->search_status) }}
                    </span>
                    <span class="text-xs text-gray-400 font-semibold">{{ $session->result_count }} foto ditemukan</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $sessions->links() }}
    </div>
    @endif

</div>
@endsection
