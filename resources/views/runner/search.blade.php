@extends('layouts.app')
@section('title', 'Cari Foto')
@section('content')

<div class="max-w-lg mx-auto px-4 sm:px-6 py-8">

    <div class="mb-8">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">AI FACE SEARCH</p>
        <h1 class="text-3xl font-black text-gray-900">Cari Fotomu</h1>
        <p class="text-gray-500 text-sm mt-1">Upload selfie dan sistem AI akan mencarikan fotomu dari event.</p>
    </div>

    @if(session('info'))
    <div class="flex items-start gap-3 bg-yellow-50 border border-yellow-100 text-yellow-700 rounded-2xl px-5 py-4 mb-6">
        <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-sm font-bold">{{ session('info') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="flex items-start gap-3 bg-red-50 border border-red-100 text-red-600 rounded-2xl px-5 py-4 mb-6">
        <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-sm font-bold">{{ session('error') }}</p>
    </div>
    @endif

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 space-y-6">

        <form action="{{ route('runner.search.post') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- Pilih Event --}}
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Pilih Event <span class="normal-case tracking-normal font-medium">(opsional)</span></label>
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <select name="event_id" class="w-full bg-slate-50 border border-slate-100 rounded-2xl pl-11 pr-4 py-4 text-sm font-bold text-slate-900 outline-none focus:ring-4 focus:ring-blue-100 transition-all appearance-none">
                        <option value="">Semua Event</option>
                        @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                            {{ $event->name }} — {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Upload Selfie --}}
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Upload Selfie</label>
                <div class="bg-slate-50 border {{ $errors->has('selfie') ? 'border-red-300' : 'border-slate-100' }} rounded-2xl px-4 py-4">
                    <input type="file" name="selfie" accept="image/png,image/jpeg,image/jpg" required
                        class="block w-full text-sm font-bold text-slate-700 file:mr-4 file:rounded-xl file:border-0 file:bg-blue-600 file:px-4 file:py-2 file:text-sm file:font-bold file:text-white hover:file:bg-blue-700">
                    <p class="text-xs text-slate-400 font-medium mt-2">Format JPG/PNG, maksimal 5MB.</p>
                </div>
                @error('selfie')
                    <p class="text-xs text-red-500 font-bold">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" class="w-full py-4 bg-blue-600 text-white rounded-2xl font-black text-sm uppercase italic tracking-[0.1em] shadow-lg shadow-blue-500/25 hover:bg-blue-700 hover:scale-[1.02] active:scale-[0.98] transition-all flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Cari Fotoku
            </button>
        </form>

        <div class="flex items-center justify-between pt-2 border-t border-gray-100">
            <a href="{{ route('runner.enroll') }}" class="text-sm font-bold text-blue-600 hover:underline">Belum daftarkan wajah?</a>
            <a href="{{ route('runner.search.history') }}" class="text-sm font-bold text-gray-400 hover:text-gray-700">Riwayat Pencarian</a>
        </div>
    </div>
</div>
@endsection
