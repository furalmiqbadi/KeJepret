@extends('layouts.app')
@section('title', 'Ajukan Event Baru')
@section('content')

<div class="max-w-2xl mx-auto px-4 sm:px-6 pt-24 pb-12 relative z-10">
    <div class="mb-10 text-center">
        <p class="text-[10px] font-black uppercase tracking-[0.25em] text-blue-600 mb-2">PUNYA EVENT LARI?</p>
        <h1 class="text-3xl sm:text-4xl font-black text-slate-800 mb-4">Ajukan Event Baru</h1>
        <p class="text-slate-500 text-sm max-w-md mx-auto leading-relaxed font-medium">Beri tahu kami event lari terdekatmu dan simpan momen terbaik bersama fotografer profesional.</p>
    </div>

    @if(session('success'))
    <div class="clean-glass rounded-2xl p-4 mb-6 relative overflow-hidden bg-green-50/50 border border-green-100/50">
        <div class="absolute -left-1 top-0 bottom-0 w-2 bg-gradient-to-b from-green-400 to-green-500"></div>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-white flex items-center justify-center shadow-sm">
                <svg class="w-5 h-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div>
                <p class="font-black text-slate-700 text-sm mb-0.5">Pengajuan Terkirim!</p>
                <p class="text-xs text-slate-500 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <form method="POST" action="{{ route('event.propose.post') }}" class="clean-glass rounded-[2rem] p-6 sm:p-8">
        @csrf
        <div class="space-y-6">
            {{-- Nama Event --}}
            <div>
                <label for="name" class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2">Nama Acara <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-3.5 clean-glass-input rounded-2xl text-sm font-bold text-slate-800 outline-none @error('name') border-red-300 focus:border-red-400 focus:ring-red-500/10 @enderror"
                    placeholder="Contoh: Jakarta Marathon 2026">
                @error('name') <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Tanggal Event --}}
            <div>
                <label for="event_date" class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2">Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                <input type="date" name="event_date" id="event_date" value="{{ old('event_date') }}" required
                    class="w-full px-4 py-3.5 clean-glass-input rounded-2xl text-sm font-bold text-slate-800 outline-none @error('event_date') border-red-300 focus:border-red-400 focus:ring-red-500/10 @enderror">
                @error('event_date') <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Lokasi Event --}}
            <div>
                <label for="location" class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2">Lokasi (Kota/Venue) <span class="text-red-500">*</span></label>
                <input type="text" name="location" id="location" value="{{ old('location') }}" required
                    class="w-full px-4 py-3.5 clean-glass-input rounded-2xl text-sm font-bold text-slate-800 outline-none @error('location') border-red-300 focus:border-red-400 focus:ring-red-500/10 @enderror"
                    placeholder="Contoh: GBK, Jakarta Pusat">
                @error('location') <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Deskripsi Event --}}
            <div>
                <label for="description" class="block text-xs font-black uppercase tracking-wider text-slate-700 mb-2">Deskripsi Singkat Acara <span class="text-red-500">*</span></label>
                <textarea name="description" id="description" rows="4" required
                    class="w-full px-4 py-3.5 clean-glass-input rounded-2xl text-sm font-medium text-slate-800 outline-none @error('description') border-red-300 focus:border-red-400 focus:ring-red-500/10 @enderror"
                    placeholder="Ceritakan sedikit tentang acara ini..."></textarea>
                @error('description') <p class="mt-2 text-xs font-bold text-red-500">{{ $message }}</p> @enderror
            </div>

            {{-- Tombol Submit --}}
            <button type="submit" class="w-full py-4 text-center rounded-2xl text-xs font-black uppercase tracking-widest text-white shadow-lg active:scale-[0.98] transition-all bg-gradient-to-r from-sky-500 via-blue-600 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 hover:shadow-blue-500/25">
                Kirim Pengajuan
            </button>
        </div>
    </form>
</div>
@endsection