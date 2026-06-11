@extends('layouts.app')
@section('title', 'Upload Foto')
@section('content')

<div class="max-w-2xl mx-auto px-4 sm:px-6 py-12 relative z-10 animate-in fade-in slide-in-from-bottom-4 duration-1000">

    <div class="mb-10">
        <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600 mb-2">FOTOGRAFER</p>
        <h1 class="text-4xl font-black text-slate-900 tracking-tight mb-1">Upload Foto</h1>
        <p class="text-sm font-bold text-slate-500">Pilih banyak foto sekaligus untuk dijual</p>
    </div>

    {{-- SUCCESS TOAST --}}
    @if(session('success'))
    <div id="toast-success" class="bg-green-50 border border-green-100 text-green-600 px-6 py-5 rounded-[1.5rem] mb-8 shadow-sm flex items-start gap-4 animate-in fade-in slide-in-from-top-4 relative">
        <svg class="w-6 h-6 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="flex-1">
            <p class="text-sm font-black mb-1.5 tracking-wide">Upload Berhasil!</p>
            <p class="text-xs font-bold text-green-700">{{ session('success') }}</p>
        </div>
        <button onclick="dismissToast('toast-success')" class="text-green-400 hover:text-green-700 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    {{-- ERROR TOAST --}}
    @if($errors->any())
    <div id="toast-error" class="bg-red-50 border border-red-100 text-red-600 px-6 py-5 rounded-[1.5rem] mb-8 shadow-sm flex items-start gap-4 animate-in fade-in slide-in-from-top-4 relative" style="animation: shake 0.5s ease;">
        <svg class="w-6 h-6 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div class="flex-1">
            <p class="text-sm font-black mb-1.5 tracking-wide">Upload Gagal!</p>
            <ul class="list-disc pl-5 text-xs font-semibold space-y-1 text-red-700">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button onclick="dismissToast('toast-error')" class="text-red-400 hover:text-red-700 transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    @endif

    <div class="glass-card rounded-[2.5rem] p-8 md:p-12 relative overflow-hidden shadow-2xl hover:shadow-blue-500/10 transition-all duration-500">
        {{-- Ambient decorative glow --}}
        <div class="absolute -top-32 -right-32 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-32 -left-32 w-80 h-80 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

        <form id="upload-form" action="{{ route('photographer.upload.post', [], false) }}" method="POST" enctype="multipart/form-data" class="relative z-10 space-y-8">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- Pilih Event --}}
                <div class="space-y-2 group">
                    <label class="block text-[11px] font-black text-slate-500 mb-2 uppercase tracking-widest group-focus-within:text-blue-600 transition-colors">Pilih Event <span class="normal-case tracking-normal font-medium opacity-60">(opsional)</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </span>
                        <select name="event_id" class="w-full bg-white/70 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 block pl-12 pr-10 py-4 transition-all shadow-sm outline-none appearance-none cursor-pointer">
                            <option value="">Tanpa Event</option>
                            @foreach($events as $event)
                            <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                                {{ $event->name }} &mdash; {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                            </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                {{-- Kategori --}}
                <div class="space-y-2 group">
                    <label class="block text-[11px] font-black text-slate-500 mb-2 uppercase tracking-widest group-focus-within:text-blue-600 transition-colors">Kategori <span class="normal-case tracking-normal font-medium opacity-60">(opsional)</span></label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-4.5 flex items-center pointer-events-none text-slate-400 group-focus-within:text-blue-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        </span>
                        <input type="text" name="category" value="{{ old('category') }}" placeholder="Contoh: Finish Line, Action"
                            class="w-full bg-white/70 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 block pl-12 pr-4 py-4 transition-all shadow-sm outline-none placeholder:text-slate-300">
                    </div>
                </div>
            </div>

            {{-- Harga --}}
            <div class="space-y-2 group">
                <label class="block text-[11px] font-black text-slate-500 mb-2 uppercase tracking-widest group-focus-within:text-indigo-600 transition-colors">Harga per Foto</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-sm font-black text-slate-400 group-focus-within:text-indigo-500 transition-colors">Rp</span>
                    <input type="number" name="price" value="{{ old('price', 25000) }}" min="5000" step="1000"
                        class="w-full bg-white/70 border {{ $errors->has('price') ? 'border-red-300' : 'border-slate-200' }} text-slate-900 text-lg font-black rounded-2xl focus:ring-4 focus:ring-indigo-500/15 focus:border-indigo-500 block pl-14 pr-4 py-4 transition-all shadow-sm outline-none placeholder:text-slate-300">
                </div>
                <p class="text-[10px] text-slate-400 font-bold ml-2 uppercase tracking-wider">Minimum Rp 5.000</p>
            </div>

            <div class="my-8 relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-slate-200/80"></div>
                </div>
                <div class="relative flex justify-center">
                    <span class="bg-white/90 backdrop-blur-md px-5 text-[10px] font-black text-slate-400 uppercase tracking-widest rounded-full border border-slate-200/80 py-1.5 shadow-sm">Pilih File Gambar</span>
                </div>
            </div>

            {{-- Upload Foto Drag & Drop Style --}}
            <div class="space-y-4">
                <div class="relative flex justify-center items-center w-full">
                    <label for="photo-input" class="flex flex-col items-center justify-center w-full h-48 bg-white/40 border-2 border-dashed {{ $errors->has('photos') || $errors->has('photos.*') ? 'border-red-400' : 'border-blue-300' }} rounded-3xl cursor-pointer hover:bg-blue-50/50 hover:border-blue-500 transition-all group overflow-hidden relative">
                        
                        <div class="flex flex-col items-center justify-center pt-5 pb-6 text-center px-4 relative z-10 group-hover:-translate-y-2 transition-transform duration-300">
                            <div class="w-16 h-16 bg-blue-100/50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <p class="text-sm font-black text-slate-700 mb-1">Klik untuk memilih foto</p>
                            <p class="text-xs text-slate-500 font-semibold">Format JPG/PNG, maksimal 10MB per file. Bisa pilih banyak.</p>
                        </div>

                        {{-- Input file tersembunyi --}}
                        <input id="photo-input" type="file" name="photos[]" accept="image/png,image/jpeg,image/jpg" multiple required class="hidden" />
                    </label>
                </div>
                
                {{-- Preview Container --}}
                <div id="preview-container" class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-4 empty:hidden"></div>
                
                <p id="file-count" class="text-xs text-center font-bold text-slate-500 hidden"></p>
            </div>

            <div class="pt-6">
                <button id="submit-btn" type="submit"
                    class="w-full flex items-center justify-center gap-3 text-white bg-gradient-to-r from-blue-600 via-indigo-600 to-blue-700 hover:from-blue-700 hover:to-indigo-800 font-black rounded-2xl text-[11px] px-6 py-4.5 text-center uppercase tracking-[0.2em] shadow-xl shadow-blue-500/25 hover:shadow-blue-500/40 transition-all duration-300 hover:-translate-y-1 active:translate-y-0">
                    <svg id="btn-icon-upload" class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    <svg id="btn-icon-spinner" class="w-5 h-5 animate-spin hidden shrink-0" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="white" stroke-width="4"/>
                        <path class="opacity-75" fill="white" d="M4 12a8 8 0 018-8v8z"/>
                    </svg>
                    <span id="btn-label">Upload Foto Sekarang</span>
                </button>
            </div>

        </form>
    </div>

    {{-- LOADING OVERLAY --}}
    <div id="loading-overlay" class="hidden fixed inset-0 bg-white/80 backdrop-blur-md z-50 flex flex-col items-center justify-center gap-6 animate-in fade-in duration-300">
        <div class="bg-white rounded-[2rem] shadow-2xl shadow-blue-500/20 border border-slate-100 p-12 flex flex-col items-center gap-6 max-w-sm w-full mx-4 relative overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-tr from-blue-50 to-indigo-50 opacity-50"></div>
            
            <div class="relative z-10 w-20 h-20 flex items-center justify-center">
                <svg class="animate-spin w-20 h-20 text-blue-100" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-100" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3"/>
                    <path class="text-blue-600" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
                </svg>
                <div class="absolute inset-0 flex items-center justify-center">
                    <svg class="w-8 h-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                </div>
            </div>
            <div class="text-center relative z-10">
                <p class="text-xl font-black text-slate-900 tracking-tight">Mengupload Foto...</p>
                <p id="overlay-file-count" class="text-sm font-bold text-slate-500 mt-2">Mohon tunggu, jangan tutup halaman</p>
            </div>
            <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden relative z-10">
                <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full animate-[pulse_1s_ease-in-out_infinite]" style="width: 100%"></div>
            </div>
        </div>
    </div>

    {{-- IMAGE PREVIEW MODAL --}}
    <div id="image-modal" class="hidden fixed inset-0 z-[100] flex items-center justify-center bg-slate-900/60 backdrop-blur-3xl p-4 animate-in fade-in duration-300">
        <button type="button" onclick="closeModal()" class="absolute top-6 right-6 sm:top-8 sm:right-8 text-white/50 hover:text-white bg-white/10 hover:bg-white/20 p-3 rounded-full backdrop-blur-md transition-all hover:scale-110 shadow-lg">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
        <img id="modal-image" src="" alt="Preview" class="max-w-full max-h-[90vh] object-contain rounded-2xl shadow-[0_0_50px_rgba(0,0,0,0.5)] animate-in zoom-in-95 duration-300">
    </div>

</div>

<style>
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

    @if(session('success'))
    setTimeout(() => dismissToast('toast-success'), 5000);
    @endif

    // Modal logic
    function showModal(src) {
        document.getElementById('modal-image').src = src;
        document.getElementById('image-modal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('image-modal').classList.add('hidden');
        document.body.style.overflow = '';
    }

    document.getElementById('image-modal').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    // Preview Multi Foto & Delete
    const photoInput = document.getElementById('photo-input');
    const previewContainer = document.getElementById('preview-container');
    const fileCountLabel = document.getElementById('file-count');
    
    let selectedFiles = [];

    photoInput.addEventListener('change', function () {
        // Append new files to our array
        Array.from(this.files).forEach(file => {
            if (file.type.match('image.*')) {
                selectedFiles.push(file);
            }
        });
        renderPreviews();
    });

    function renderPreviews() {
        previewContainer.innerHTML = '';
        
        // Update the actual input.files using DataTransfer
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        photoInput.files = dt.files;

        const count = selectedFiles.length;
        if (count > 0) {
            fileCountLabel.textContent = count + ' file dipilih (siap diupload)';
            fileCountLabel.classList.remove('hidden');
            
            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'relative aspect-square rounded-[1.25rem] overflow-hidden border-2 border-slate-100 shadow-md group animate-in zoom-in duration-300';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-full object-cover cursor-pointer hover:scale-110 transition-transform duration-500';
                    img.onclick = () => showModal(e.target.result);
                    
                    const overlay = document.createElement('div');
                    overlay.className = 'absolute inset-0 bg-gradient-to-t from-slate-900/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none';
                    
                    const deleteBtn = document.createElement('button');
                    deleteBtn.type = 'button';
                    deleteBtn.className = 'absolute top-2 right-2 bg-red-500/90 hover:bg-red-600 text-white p-1.5 rounded-full opacity-0 group-hover:opacity-100 transition-all duration-300 hover:scale-110 shadow-sm backdrop-blur-md';
                    deleteBtn.innerHTML = '<svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>';
                    deleteBtn.onclick = (event) => {
                        event.stopPropagation();
                        selectedFiles.splice(index, 1);
                        renderPreviews();
                    };

                    wrapper.appendChild(img);
                    wrapper.appendChild(overlay);
                    wrapper.appendChild(deleteBtn);
                    previewContainer.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        } else {
            fileCountLabel.classList.add('hidden');
        }
    }

    // Animasi loading saat submit
    document.getElementById('upload-form').addEventListener('submit', function () {
        const count = document.getElementById('photo-input').files.length;
        if (count === 0) return; // Prevent if no files (walaupun ada required)
        
        document.getElementById('btn-icon-upload').classList.add('hidden');
        document.getElementById('btn-icon-spinner').classList.remove('hidden');
        document.getElementById('btn-label').textContent = 'Memproses...';
        document.getElementById('submit-btn').classList.add('opacity-80', 'pointer-events-none');
        
        document.getElementById('overlay-file-count').textContent = count + ' foto sedang diunggah...';
        document.getElementById('loading-overlay').classList.remove('hidden');
    });
</script>

@endsection