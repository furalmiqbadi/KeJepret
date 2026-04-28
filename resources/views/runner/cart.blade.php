@extends('layouts.app')
@section('title', 'Keranjang')
@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">

    <div class="flex items-center justify-between gap-4 mb-8">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">KERANJANG</p>
            <h1 class="text-3xl font-black text-gray-900">Foto Pilihanmu</h1>
            <p class="text-gray-500 text-sm mt-1">{{ $items->count() }} foto siap checkout.</p>
        </div>

        <a href="{{ $searchBackUrl }}" class="hidden sm:flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-100 text-gray-600 rounded-2xl font-bold text-sm hover:text-blue-600 hover:border-blue-200 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari Foto Lagi
        </a>
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

    @if($items->isEmpty())
    <div class="text-center py-24">
        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
        <p class="font-black text-gray-400 text-lg">Keranjang masih kosong</p>
        <p class="text-gray-400 text-sm mt-1">Cari fotomu dulu, lalu tambahkan foto yang ingin dibeli.</p>
        <a href="{{ $searchBackUrl }}" class="inline-flex items-center gap-2 mt-5 px-6 py-3 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            Cari Foto
        </a>
    </div>
    @else
    <div class="grid lg:grid-cols-[1fr_20rem] gap-6 items-start">
        <div class="space-y-3">
            @foreach($items as $item)
            <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-3 sm:p-4">
                <div class="flex gap-4">
                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-gray-100 overflow-hidden shrink-0">
                        <img src="{{ $item->watermark_url }}" alt="Foto dari {{ $item->photographer }}"
                            class="w-full h-full object-cover">
                    </div>

                    <div class="flex-1 min-w-0 flex flex-col justify-between">
                        <div>
                            <p class="text-sm font-black text-gray-900 truncate">{{ $item->category ?? 'Foto Event' }}</p>
                            <p class="text-xs text-gray-400 font-semibold mt-1 truncate">{{ $item->photographer }}</p>
                            <p class="text-base font-black text-blue-600 mt-3">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>

                        <form action="{{ route('cart.remove', $item->cart_item_id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="inline-flex items-center gap-1.5 text-xs font-bold text-red-500 hover:text-red-600 transition">
                                <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 lg:sticky lg:top-24">
            <p class="text-xs font-bold uppercase tracking-widest text-gray-400 mb-4">Ringkasan</p>

            <div class="space-y-3 pb-4 border-b border-gray-100">
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 font-semibold">Jumlah foto</span>
                    <span class="font-black text-gray-900">{{ $items->count() }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                    <span class="text-gray-500 font-semibold">Subtotal</span>
                    <span class="font-black text-gray-900">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="flex items-center justify-between py-5">
                <span class="text-sm font-black text-gray-900">Total</span>
                <span class="text-xl font-black text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
            </div>

            <form action="{{ route('order.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-2xl font-black text-sm hover:bg-blue-700 active:scale-[0.98] transition shadow-lg shadow-blue-500/20">
                    Checkout
                </button>
            </form>

            <a href="{{ $searchBackUrl }}" class="sm:hidden flex items-center justify-center gap-2 mt-3 w-full py-3 bg-slate-50 text-gray-500 rounded-2xl font-bold text-sm hover:text-blue-600 transition">
                Cari Foto Lagi
            </a>
        </div>
    </div>
    @endif

</div>
@endsection
