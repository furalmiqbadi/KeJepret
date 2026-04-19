@extends('layouts.app')
@section('title', 'Daftarkan Wajah')
@section('content')

<div class="max-w-lg mx-auto px-4 sm:px-6 py-8">

    <div class="mb-8">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">AI FACE ENROLL</p>
        <h1 class="text-3xl font-black text-gray-900">Daftarkan Wajahmu</h1>
        <p class="text-gray-500 text-sm mt-1">Upload selfie agar sistem AI bisa mengenali wajahmu di setiap foto event.</p>
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

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 space-y-6">

        <div class="flex items-start gap-3 bg-blue-50 border border-blue-100 text-blue-700 rounded-2xl px-5 py-4">
            <svg class="w-5 h-5 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <p class="text-xs font-bold leading-relaxed">Gunakan foto wajah yang jelas, tidak buram, dan pencahayaan cukup. Hindari menggunakan kacamata atau masker.</p>
        </div>

        <form action="{{ route('runner.enroll.post') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

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
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Daftarkan Wajah
            </button>
        </form>

        <div class="text-center">
            <a href="{{ route('runner.search') }}" class="text-sm font-bold text-blue-600 hover:underline">Langsung Cari Foto</a>
        </div>
    </div>
</div>
@endsection
