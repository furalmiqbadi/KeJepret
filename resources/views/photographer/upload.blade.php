@extends('layouts.app')
@section('title', 'Upload Foto')
@section('content')

<div class="max-w-lg mx-auto px-4 sm:px-6 py-8">

    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">FOTOGRAFER</p>
            <h1 class="text-3xl font-black text-gray-900">Upload Foto</h1>
            <p class="text-gray-500 text-sm mt-1">Upload foto event sekaligus banyak file.</p>
        </div>
        <a href="{{ route('photographer.portfolio') }}" class="flex items-center gap-2 text-sm font-bold text-gray-500 hover:text-blue-600 transition">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Portfolio
        </a>
    </div>

    {{-- SUCCESS TOAST --}}
    @if(session('success'))
    <div id="toast-success"
        class="flex items-start gap-3 bg-green-50 border border-green-200 text-green-700 rounded-2xl px-5 py-4 mb-6 shadow-lg shadow-green-500/10
               translate-y-0 opacity-100 transition-all duration-500"
        style="animation: slideDown 0.4s ease;">
        <div class="w-8 h-8 bg-green-500 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <div class="flex-1">
            <p class="text-sm font-black text-green-800">Upload Berhasil!</p>
            <p class="text-xs text-green-600 mt-0.5">{{ session('success') }}</p>
        </div>
        <button onclick="dismissToast('toast-success')" class="text-green-400 hover:text-green-700 transition ml-2 mt-0.5">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    @endif

    {{-- ERROR TOAST --}}
    @if($errors->any())
    <div id="toast-error"
        class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-600 rounded-2xl px-5 py-4 mb-6 shadow-lg shadow-red-500/10
               transition-all duration-500"
        style="animation: shake 0.5s ease;">
        <div class="w-8 h-8 bg-red-500 rounded-xl flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div class="flex-1">
            <p class="text-sm font-black text-red-800 mb-1">Upload Gagal!</p>
            <ul class="text-xs font-semibold space-y-0.5 text-red-600">
                @foreach($errors->all() as $error)
                <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button onclick="dismissToast('toast-error')" class="text-red-400 hover:text-red-700 transition ml-2 mt-0.5">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    @endif

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 space-y-6">

        <form id="upload-form" action="{{ route('photographer.upload.post') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Pilih Event --}}
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Pilih Event <span class="normal-case tracking-normal font-medium">(opsional)</span></label>
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <select name="event_id" class="w-full bg-slate-50 border border-slate-100 rounded-2xl pl-11 pr-4 py-4 text-sm font-bold text-slate-900 outline-none focus:ring-4 focus:ring-blue-100 transition-all appearance-none">
                        <option value="">Tanpa Event</option>
                        @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                            {{ $event->name }} &mdash; {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Harga --}}
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Harga per Foto</label>
                <div class="relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm font-black text-slate-400">Rp</span>
                    <input type="number" name="price" value="{{ old('price', 25000) }}" min="5000" step="1000"
                        class="w-full bg-slate-50 border {{ $errors->has('price') ? 'border-red-300' : 'border-slate-100' }} rounded-2xl pl-12 pr-4 py-4 text-sm font-bold text-slate-900 outline-none focus:ring-4 focus:ring-blue-100 transition-all">
                </div>
                <p class="text-xs text-slate-400 font-medium ml-1">Minimum Rp 5.000</p>
            </div>

            {{-- Kategori --}}
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Kategori <span class="normal-case tracking-normal font-medium">(opsional)</span></label>
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    <input type="text" name="category" value="{{ old('category') }}" placeholder="Contoh: Finish Line, Start, Action"
                        class="w-full bg-slate-50 border border-slate-100 rounded-2xl pl-11 pr-4 py-4 text-sm font-bold text-slate-900 outline-none focus:ring-4 focus:ring-blue-100 transition-all">
                </div>
            </div>

            {{-- Upload Foto --}}
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Pilih Foto</label>
                <div class="bg-slate-50 border {{ $errors->has('photos') || $errors->has('photos.*') ? 'border-red-300' : 'border-slate-100' }} rounded-2xl px-4 py-4">
                    <input id="photo-input" type="file" name="photos[]" accept="image/png,image/jpeg,image/jpg" multiple required
                        class="block w-full text-sm font-bold text-slate-700 file:mr-4 file:rounded-xl file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-blue-700">
                    <p id="file-count" class="text-xs text-slate-400 font-medium mt-2">Format JPG/PNG, maksimal 10MB per file. Bisa pilih banyak file sekaligus.</p>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <button id="submit-btn" type="submit"
                class="w-full py-4 bg-blue-600 text-white rounded-2xl font-black text-sm uppercase italic tracking-[0.1em] shadow-lg shadow-blue-500/25 hover:bg-blue-700 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                <svg id="btn-icon-upload" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                </svg>
                <svg id="btn-icon-spinner" class="w-5 h-5 animate-spin hidden" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="white" stroke-width="4"/>
                    <path class="opacity-75" fill="white" d="M4 12a8 8 0 018-8v8z"/>
                </svg>
                <span id="btn-label">Upload Foto</span>
            </button>

        </form>
    </div>

    {{-- LOADING OVERLAY --}}
    <div id="loading-overlay" class="hidden fixed inset-0 bg-white/80 backdrop-blur-sm z-50 flex flex-col items-center justify-center gap-6">
        <div class="bg-white rounded-3xl shadow-2xl shadow-blue-500/10 border border-gray-100 p-10 flex flex-col items-center gap-5 max-w-xs w-full mx-4">
            <div class="relative w-16 h-16">
                <svg class="animate-spin w-16 h-16 text-blue-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-20" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                    <path class="opacity-90" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                </svg>
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                </div>
            </div>
            <div class="text-center">
                <p class="text-lg font-black text-gray-900">Mengupload Foto...</p>
                <p id="overlay-file-count" class="text-sm text-gray-400 mt-1">Mohon tunggu, jangan tutup halaman ini</p>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-1.5 overflow-hidden">
                <div class="h-full bg-blue-600 rounded-full animate-pulse" style="width: 100%"></div>
            </div>
        </div>
    </div>

</div>

<style>
    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-16px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        15%       { transform: translateX(-6px); }
        30%       { transform: translateX(6px); }
        45%       { transform: translateX(-4px); }
        60%       { transform: translateX(4px); }
        75%       { transform: translateX(-2px); }
        90%       { transform: translateX(2px); }
    }
    .toast-hide {
        opacity: 0;
        transform: translateY(-12px);
        transition: all 0.4s ease;
    }
</style>

<script>
    // Dismiss toast manual
    function dismissToast(id) {
        const el = document.getElementById(id);
        if (!el) return;
        el.classList.add('toast-hide');
        setTimeout(() => el.remove(), 400);
    }

    // Auto dismiss success setelah 4 detik
    @if(session('success'))
    setTimeout(() => dismissToast('toast-success'), 4000);
    @endif

    // Tampilkan jumlah file dipilih
    document.getElementById('photo-input').addEventListener('change', function () {
        const count = this.files.length;
        const label = document.getElementById('file-count');
        if (count > 0) {
            label.textContent = count + ' file dipilih (siap diupload)';
            label.classList.remove('text-slate-400');
            label.classList.add('text-blue-600', 'font-bold');
        } else {
            label.textContent = 'Format JPG/PNG, maksimal 10MB per file. Bisa pilih banyak file sekaligus.';
            label.classList.add('text-slate-400');
            label.classList.remove('text-blue-600', 'font-bold');
        }
    });

    // Animasi loading saat submit
    document.getElementById('upload-form').addEventListener('submit', function () {
        const count = document.getElementById('photo-input').files.length;
        document.getElementById('btn-icon-upload').classList.add('hidden');
        document.getElementById('btn-icon-spinner').classList.remove('hidden');
        document.getElementById('btn-label').textContent = 'Mengupload...';
        document.getElementById('submit-btn').disabled = true;
        document.getElementById('submit-btn').classList.add('opacity-75', 'cursor-not-allowed');
        document.getElementById('overlay-file-count').textContent = count + ' foto sedang diproses, mohon tunggu...';
        document.getElementById('loading-overlay').classList.remove('hidden');
    });
</script>

@endsection