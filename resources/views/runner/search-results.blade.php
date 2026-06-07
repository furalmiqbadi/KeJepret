@extends('layouts.app')
@section('title', 'Hasil Pencarian')
@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 py-8">

    <div class="flex items-center justify-between gap-4 mb-8">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">HASIL AI SEARCH</p>
            <h1 class="text-3xl font-black text-gray-900">Foto Ditemukan</h1>
            <p class="text-gray-500 text-sm mt-1">{{ $photos->count() }} foto cocok dengan wajahmu.</p>
        </div>
        <div class="flex items-center gap-3 shrink-0">
            <a href="{{ route('cart.index') }}" class="relative flex items-center justify-center w-12 h-12 bg-white border border-gray-100 rounded-2xl text-blue-600 shadow-sm hover:border-blue-200 transition" aria-label="Lihat Keranjang">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <span id="cart-count-badge" class="absolute -top-2 -right-2 min-w-6 h-6 px-1 bg-blue-600 text-white text-[10px] font-black rounded-full flex items-center justify-center {{ ($cartCount ?? 0) > 0 ? '' : 'hidden' }}">{{ $cartCount ?? 0 }}</span>
            </a>
            <a href="{{ route('runner.search') }}" class="hidden sm:flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-blue-600 transition-colors">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Cari Lagi
            </a>
        </div>
    </div>

    <div id="cart-flash" class="hidden flex items-start gap-3 rounded-2xl px-5 py-4 mb-6">
        <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        <p class="text-sm font-bold"></p>
    </div>

    @if($photos->isEmpty())
    <div class="text-center py-24">
        <div class="w-16 h-16 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <p class="font-black text-gray-400 text-lg">Tidak ada foto ditemukan</p>
        <p class="text-gray-400 text-sm mt-1">Coba upload selfie dengan pencahayaan lebih baik.</p>
        <a href="{{ route('runner.search') }}" class="inline-block mt-4 px-6 py-3 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition">Coba Lagi</a>
    </div>
    @else
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 relative z-10">
        @foreach($photos as $photo)
        <div class="clean-glass rounded-[2rem] overflow-hidden hover:shadow-xl hover:shadow-blue-900/10 transition-all duration-300 group border border-white/50 flex flex-col">

            {{-- Foto Watermark --}}
            <div class="relative aspect-[4/5] sm:aspect-square overflow-hidden bg-slate-100 flex items-center justify-center">
                {{-- Blurred Background --}}
                <img src="{{ $photo['watermark_url'] }}" class="absolute inset-0 w-full h-full object-cover opacity-60 blur-md scale-110 pointer-events-none" alt="Blurred background">
                
                <button
                    type="button"
                    class="preview-trigger block w-full h-full relative z-10"
                    data-preview-url="{{ $photo['watermark_url'] }}"
                    data-preview-alt="Preview foto event {{ $photo['event_name'] }}"
                    aria-label="Lihat preview foto"
                >
                    <img src="{{ $photo['watermark_url'] }}" alt="Foto"
                        class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-500 drop-shadow-2xl">
                </button>
                <div class="absolute top-3 right-3 bg-gradient-to-br from-blue-600 to-indigo-600 text-white text-[10px] font-black px-3 py-1.5 rounded-full shadow-lg border border-white/20 z-20">
                    {{ round($photo['similarity_score']) }}% Cocok
                </div>
            </div>

            {{-- Info --}}
            <div class="p-4 space-y-1.5 bg-white/40 flex-1">
                <p class="text-xs font-black text-slate-800 truncate leading-none">{{ $photo['event_name'] }}</p>
                <div class="flex items-center gap-1">
                    <svg class="w-3 h-3 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">{{ $photo['photographer'] }}</p>
                </div>
                <p class="text-sm font-black text-blue-600 pt-1">Rp {{ number_format($photo['price'], 0, ',', '.') }}</p>
            </div>

            {{-- Tombol Keranjang --}}
            <div class="px-4 pb-4 bg-white/40">
                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form">
                    @csrf
                    <input type="hidden" name="photo_id" value="{{ $photo['photo_id'] }}">
                    <button type="submit"
                        class="cart-button w-full py-3 rounded-2xl font-black text-[11px] uppercase tracking-wider active:scale-95 transition-all duration-300 flex items-center justify-center gap-2 shadow-sm {{ $photo['in_cart'] ? 'bg-green-600 text-white border border-green-700 cursor-not-allowed' : 'bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-600 text-white hover:shadow-lg hover:shadow-blue-500/20 hover:-translate-y-0.5' }}"
                        {{ $photo['in_cart'] ? 'disabled' : '' }}>
                        <svg class="w-4 h-4 {{ $photo['in_cart'] ? '' : 'animate-bounce' }}" style="animation-duration: 2s;" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="{{ $photo['in_cart'] ? 'M5 13l4 4L19 7' : 'M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z' }}"/></svg>
                        <span>{{ $photo['in_cart'] ? 'Sudah di Keranjang' : 'Tambah Keranjang' }}</span>
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Aksi bawah --}}
    <div class="mt-8 flex items-center justify-between">
        <a href="{{ route('runner.search') }}" class="text-sm font-bold text-gray-500 hover:text-blue-600 transition-colors">Cari Lagi</a>
        <a href="{{ route('cart.index') }}" class="flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-2xl font-bold text-sm hover:bg-blue-700 transition shadow-lg shadow-blue-500/20">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            Lihat Keranjang
        </a>
    </div>
    @endif

</div>

<div id="photo-preview-modal" class="fixed inset-0 z-50 hidden">
    <div class="absolute inset-0 bg-black/80" data-preview-close></div>
    <div class="relative z-10 h-full w-full flex items-center justify-center p-4">
        <div class="relative max-w-5xl w-full">
            <button
                type="button"
                id="photo-preview-close"
                class="absolute -top-12 right-0 text-white bg-white/10 hover:bg-white/20 rounded-xl px-3 py-2 text-sm font-bold"
                aria-label="Tutup preview"
            >
                Tutup
            </button>
            <img id="photo-preview-image" src="" alt="Preview foto" class="w-full max-h-[85vh] object-contain rounded-2xl bg-black/40">
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.add-to-cart-form').forEach((form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const button = form.querySelector('.cart-button');
        const label = button.querySelector('span');
        const badge = document.getElementById('cart-count-badge');
        const flash = document.getElementById('cart-flash');

        button.disabled = true;
        label.textContent = 'Menambahkan...';

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                },
                body: new FormData(form),
            });
            const data = await response.json();

            if (!response.ok || !data.success) {
                button.disabled = false;
                label.textContent = 'Tambah ke Keranjang';
                showCartFlash(flash, data.message || 'Gagal menambahkan foto.', false);
                return;
            }

            badge.textContent = data.cart_count;
            badge.classList.remove('hidden');
            button.classList.remove('bg-gradient-to-r', 'from-sky-500', 'via-blue-500', 'to-indigo-600', 'hover:shadow-lg', 'hover:shadow-blue-500/20', 'hover:-translate-y-0.5');
            button.classList.add('bg-green-600', 'text-white', 'border', 'border-green-700', 'cursor-not-allowed');
            label.textContent = 'Sudah di Keranjang';
            showCartFlash(flash, data.message, true);
        } catch (error) {
            button.disabled = false;
            label.textContent = 'Tambah ke Keranjang';
            showCartFlash(flash, 'Koneksi gagal. Coba lagi.', false);
        }
    });
});

function showCartFlash(flash, message, success) {
    flash.classList.remove('hidden', 'bg-green-50', 'border', 'border-green-100', 'text-green-700', 'bg-red-50', 'border-red-100', 'text-red-600');
    flash.classList.add('border');
    flash.classList.add(success ? 'bg-green-50' : 'bg-red-50');
    flash.classList.add(success ? 'border-green-100' : 'border-red-100');
    flash.classList.add(success ? 'text-green-700' : 'text-red-600');
    flash.querySelector('p').textContent = message;
}

const previewModal = document.getElementById('photo-preview-modal');
const previewImage = document.getElementById('photo-preview-image');
const previewClose = document.getElementById('photo-preview-close');

document.querySelectorAll('.preview-trigger').forEach((button) => {
    button.addEventListener('click', () => {
        previewImage.src = button.dataset.previewUrl;
        previewImage.alt = button.dataset.previewAlt || 'Preview foto';
        previewModal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
    });
});

function closePreviewModal() {
    previewModal.classList.add('hidden');
    previewImage.src = '';
    document.body.classList.remove('overflow-hidden');
}

previewClose.addEventListener('click', closePreviewModal);

previewModal.querySelectorAll('[data-preview-close]').forEach((el) => {
    el.addEventListener('click', closePreviewModal);
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape' && !previewModal.classList.contains('hidden')) {
        closePreviewModal();
    }
});
</script>
@endsection
