@extends('layouts.app')
@section('title', 'Detail Order')
@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">

    <div class="flex items-center justify-between gap-4 mb-8">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">ORDER</p>
            <h1 class="text-3xl font-black text-gray-900">{{ $order->order_code }}</h1>
            <p class="text-gray-500 text-sm mt-1">Dibuat pada {{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</p>
        </div>

        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-black
            {{ $order->status === 'paid' ? 'bg-green-50 text-green-600' : ($order->status === 'pending' ? 'bg-yellow-50 text-yellow-600' : 'bg-red-50 text-red-500') }}">
            {{ strtoupper($order->status) }}
        </span>
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

    <div class="grid lg:grid-cols-[1fr_20rem] gap-6 items-start">
        <div class="space-y-3">
            @foreach($items as $item)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-3 sm:p-4">
                <div class="flex gap-4">
                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-gray-100 overflow-hidden shrink-0">
                        <img src="{{ $item->watermark_url }}" alt="Foto order"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="flex-1 min-w-0 flex flex-col justify-between">
                        <div>
                            <p class="text-sm font-black text-gray-900 truncate">{{ $item->category ?? 'Foto Event' }}</p>
                            <p class="text-xs text-gray-400 font-semibold mt-1">Pendapatan fotografer: Rp {{ number_format($item->photographer_amount, 0, ',', '.') }}</p>
                            <p class="text-base font-black text-blue-600 mt-3">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>

                        @if($order->status === 'paid')
                        <div class="mt-3">
                            <a href="{{ route('download', $item->download_token) }}" class="inline-flex items-center gap-1.5 px-4 py-2 bg-blue-600 text-white rounded-xl text-xs font-bold hover:bg-blue-700 transition">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                Download Original
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 lg:sticky lg:top-24">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Ringkasan Pembayaran</p>

            <div class="space-y-3 pb-4 border-b border-gray-100">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 font-semibold">Jumlah foto</span>
                    <span class="font-black text-gray-900">{{ $items->count() }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 font-semibold">Subtotal</span>
                    <span class="font-black text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 font-semibold">Biaya platform 15%</span>
                    <span class="font-black text-gray-900">Rp {{ number_format($order->platform_fee, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 font-semibold">Untuk fotografer 85%</span>
                    <span class="font-black text-gray-900">Rp {{ number_format($order->photographer_amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="flex items-center justify-between py-5">
                <span class="text-sm font-black text-gray-900">Total Bayar</span>
                <span class="text-xl font-black text-blue-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
            </div>

            @if($order->status === 'pending')
            <div class="bg-yellow-50 border border-yellow-100 rounded-2xl p-4 mb-4">
                <p class="text-xs font-bold text-yellow-700">Pembayaran masih manual. Setelah transfer/konfirmasi pembayaran selesai, tekan tombol di bawah.</p>
            </div>

            <form action="{{ route('order.pay', $order->id) }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-2xl font-black text-sm hover:bg-blue-700 active:scale-[0.98] transition shadow-lg shadow-blue-500/20">
                    Telah Melakukan Pembayaran
                </button>
            </form>
            @elseif($order->status === 'paid')
            <div class="bg-green-50 border border-green-100 rounded-2xl p-4">
                <p class="text-xs font-bold text-green-700">Pembayaran terkonfirmasi. File original sudah bisa diunduh.</p>
                @if($order->paid_at)
                <p class="text-[11px] text-green-600 font-semibold mt-1">{{ \Carbon\Carbon::parse($order->paid_at)->format('d M Y, H:i') }}</p>
                @endif
            </div>
            @else
            <div class="bg-red-50 border border-red-100 rounded-2xl p-4">
                <p class="text-xs font-bold text-red-600">Order ini tidak dapat dibayar karena statusnya {{ $order->status }}.</p>
            </div>
            @endif

            <a href="{{ route('order.history') }}" class="flex items-center justify-center gap-2 mt-3 w-full py-3 bg-slate-50 text-gray-500 rounded-2xl font-bold text-sm hover:text-blue-600 transition">
                Riwayat Order
            </a>
        </div>
    </div>

</div>
@endsection
