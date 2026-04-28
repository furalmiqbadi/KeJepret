@extends('layouts.app')
@section('title', 'Riwayat Order')
@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8">

    <div class="flex items-center justify-between gap-4 mb-8">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">RIWAYAT</p>
            <h1 class="text-3xl font-black text-gray-900">Riwayat Order</h1>
            <p class="text-gray-500 text-sm mt-1">Daftar pembelian foto yang pernah kamu buat.</p>
        </div>

        <a href="{{ route('runner.search') }}" class="hidden sm:flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-100 text-gray-600 rounded-2xl font-bold text-sm hover:text-blue-600 hover:border-blue-200 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari Foto
        </a>
    </div>

    @if($orders->isEmpty())
    <div class="text-center py-24">
        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
        </div>
        <p class="font-black text-gray-400 text-lg">Belum ada order</p>
        <p class="text-gray-400 text-sm mt-1">Cari foto dan checkout untuk membuat order pertama.</p>
        <a href="{{ route('runner.search') }}" class="inline-flex items-center gap-2 mt-5 px-6 py-3 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition">
            Cari Foto
        </a>
    </div>
    @else
    <div class="space-y-3">
        @foreach($orders as $order)
        <a href="{{ route('order.detail', $order->id) }}" class="block bg-white rounded-2xl border border-gray-100 shadow-sm p-5 hover:border-blue-200 hover:shadow-md transition">
            <div class="flex items-start justify-between gap-4">
                <div class="min-w-0">
                    <p class="font-black text-gray-900 truncate">{{ $order->order_code }}</p>
                    <p class="text-xs text-gray-400 font-semibold mt-1">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</p>
                    <p class="text-sm font-black text-blue-600 mt-3">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                </div>

                <div class="flex flex-col items-end gap-2 shrink-0">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-[11px] font-black
                        {{ $order->status === 'paid' ? 'bg-green-50 text-green-600' : ($order->status === 'pending' ? 'bg-yellow-50 text-yellow-600' : 'bg-red-50 text-red-500') }}">
                        {{ strtoupper($order->status) }}
                    </span>
                    <span class="text-xs font-bold text-gray-400">Detail</span>
                </div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $orders->links() }}
    </div>
    @endif

</div>
@endsection
