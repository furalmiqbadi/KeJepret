@extends('layouts.app')
@section('title', 'Cari Foto')
@section('content')

<div class="max-w-lg mx-auto px-4 sm:px-6 pt-2 sm:pt-24 pb-8 sm:pb-12">
    {{-- Judul Halaman dengan Margin atas lapang & Ambient glow --}}
    <div class="mb-10 text-center relative">
        <div class="absolute -top-10 left-1/2 -translate-x-1/2 w-48 h-12 bg-sky-400/10 rounded-full blur-xl pointer-events-none"></div>
        <p class="text-[10px] font-black uppercase tracking-[0.25em] text-sky-500 mb-2">Pencarian Wajah AI</p>
        <h1 class="text-3xl font-black tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-slate-900 via-sky-900 to-slate-900">Cari Fotomu</h1>
        <p class="text-slate-500 text-xs mt-2 max-w-sm mx-auto leading-relaxed">Cukup ambil swafoto atau unggah foto, teknologi AI kami akan mencarikan semua fotomu dari berbagai acara.</p>
    </div>
    @if(session('info'))
    <div class="flex items-start gap-3 bg-yellow-50/80 backdrop-blur border border-yellow-200/50 text-yellow-800 rounded-2xl px-5 py-4 mb-6 shadow-sm">
        <svg class="w-5 h-5 mt-0.5 shrink-0 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-xs font-bold leading-relaxed">{{ session('info') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="flex items-start gap-3 bg-red-50/80 backdrop-blur border border-red-200/50 text-red-700 rounded-2xl px-5 py-4 mb-6 shadow-sm">
        <svg class="w-5 h-5 mt-0.5 shrink-0 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-xs font-bold leading-relaxed">{{ session('error') }}</p>
    </div>
    @endif

    {{-- Card Glassmorphism Utama --}}
    <div class="clean-glass rounded-[2.5rem] p-8 space-y-6 relative overflow-hidden" x-data="searchPage()">
        {{-- Ambient Orbs dekoratif di dalam kartu --}}
        <div class="absolute -top-12 -right-12 w-28 h-28 bg-blue-300/10 rounded-full blur-2xl pointer-events-none"></div>
        <div class="absolute -bottom-12 -left-12 w-28 h-28 bg-indigo-300/10 rounded-full blur-2xl pointer-events-none"></div>

        {{-- Tab Pilih Metode --}}
        <div class="grid grid-cols-2 gap-2 bg-slate-200/30 backdrop-blur rounded-2xl p-1.5 border border-slate-100/50 relative z-10">
            <button type="button" @click="mode = 'camera'"
                :class="mode === 'camera' ? 'bg-white shadow-sm text-sky-600' : 'text-slate-400 hover:text-slate-600'"
                class="flex items-center justify-center gap-2 py-3 rounded-xl font-black text-[10px] uppercase tracking-wider transition-all cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Kamera
            </button>
            <button type="button" @click="mode = 'file'"
                :class="mode === 'file' ? 'bg-white shadow-sm text-sky-600' : 'text-slate-400 hover:text-slate-600'"
                class="flex items-center justify-center gap-2 py-3 rounded-xl font-black text-[10px] uppercase tracking-wider transition-all cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Unggah Foto
            </button>
        </div>

        <form action="{{ route('runner.search.post', [], false) }}" method="POST" enctype="multipart/form-data" class="space-y-6 relative z-10" @submit="prepareSubmit">
            @csrf

            {{-- Hidden input untuk selfie dari kamera --}}
            <input type="hidden" name="selfie_base64" x-ref="selfieBase64">

            <div class="space-y-2 group">
                <label class="block text-[11px] font-black text-slate-500 uppercase tracking-widest">Kategori <span class="normal-case tracking-normal font-medium opacity-60">(opsional)</span></label>
                <div class="relative">
                    <select name="category" class="w-full bg-white/70 border border-slate-200 text-slate-900 text-sm font-bold rounded-2xl focus:ring-4 focus:ring-blue-500/15 focus:border-blue-500 block pl-5 pr-10 py-4 transition-all shadow-sm outline-none appearance-none cursor-pointer">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $key => $label)
                        <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

            <input type="file" name="selfie" x-ref="selfieFile" accept="image/png,image/jpeg,image/jpg"
                class="hidden" @change="onFileChange">

            {{-- MODE KAMERA --}}
            <div x-show="mode === 'camera'" x-transition>
                <div class="relative rounded-[2rem] overflow-hidden bg-slate-950 aspect-square shadow-inner ring-4 ring-slate-100/50">
                    <video x-ref="video" autoplay playsinline muted
                        class="w-full h-full object-cover" x-show="!capturedImage"></video>
                    <img :src="capturedImage" x-show="capturedImage"
                        class="w-full h-full object-cover">

                    {{-- Overlay ring --}}
                    <div x-show="!capturedImage" class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="w-48 h-48 rounded-full border-4 border-dashed border-blue-500/80 animate-[spin_30s_linear_infinite] shadow-[0_0_20px_rgba(59,130,246,0.35)]"></div>
                    </div>

                    {{-- Tombol Capture / Retake --}}
                    <div class="absolute bottom-4 inset-x-0 flex justify-center gap-4 z-20">
                        <template x-if="!capturedImage">
                            <button type="button" @click="capture"
                                class="w-16 h-16 bg-white rounded-full border-4 border-blue-600 shadow-2xl flex items-center justify-center hover:scale-105 active:scale-95 transition cursor-pointer">
                                <div class="w-10 h-10 bg-blue-600 rounded-full"></div>
                            </button>
                        </template>
                        <template x-if="capturedImage">
                            <button type="button" @click="retake"
                                class="px-5 py-2.5 bg-white/95 backdrop-blur rounded-2xl font-black text-[10px] uppercase tracking-wider text-slate-800 shadow-xl hover:bg-white transition flex items-center gap-2 cursor-pointer border border-slate-200/60">
                                <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                Ulangi Foto
                            </button>
                        </template>
                    </div>

                    {{-- Canvas tersembunyi untuk capture --}}
                    <canvas x-ref="canvas" class="hidden"></canvas>
                </div>
                <p class="text-[10px] text-slate-400 font-black text-center mt-3 uppercase tracking-widest">Posisikan wajah di dalam lingkaran lalu tekan tombol bulat.</p>
            </div>

            {{-- MODE FILE --}}
            <div x-show="mode === 'file'" x-transition>
                <div class="bg-gradient-to-br from-blue-50/20 to-indigo-50/20 border-2 border-dashed border-blue-200/60 hover:border-blue-400 hover:from-blue-50/40 hover:to-indigo-50/40 rounded-2xl p-8 text-center cursor-pointer transition-all shadow-inner relative group"
                    @click="$refs.selfieFile.click()">
                    <template x-if="!filePreview">
                        <div class="space-y-3">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center mx-auto shadow-md shadow-blue-500/5 group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            </div>
                            <div>
                                <p class="text-sm font-extrabold text-slate-700">Klik untuk pilih foto terbaikmu</p>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mt-1.5">JPG / PNG, maksimal 5MB</p>
                            </div>
                        </div>
                    </template>
                    <template x-if="filePreview">
                        <div class="relative">
                            <div class="w-40 h-40 rounded-2xl overflow-hidden mx-auto shadow-lg border-2 border-white ring-4 ring-blue-50">
                                <img :src="filePreview" class="w-full h-full object-cover">
                            </div>
                            <p class="text-[11px] font-black text-blue-600 mt-4 group-hover:text-blue-700 uppercase tracking-wider">Foto dipilih. Klik untuk ganti.</p>
                        </div>
                    </template>
                </div>
                @error('selfie')
                    <p class="text-xs text-red-500 font-bold mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pilih Acara --}}
            <div class="space-y-2 relative" x-data="{ open: false }" @click.away="open = false">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] block">Pilih Acara <span class="normal-case tracking-normal font-medium text-slate-400">(opsional)</span></label>

                <input type="hidden" name="event_id" :value="selectedEventId" :disabled="selectedEventId === ''">

                <div class="relative">
                    {{-- Icon kalender --}}
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 flex items-center justify-center pointer-events-none z-20">
                        <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </span>

                    {{-- Input teks ketik nama acara --}}
                    <input type="text"
                        x-model="eventSearch"
                        @focus="open = true"
                        @input="open = true; selectedEventId = ''"
                        :placeholder="selectedEventId ? selectedEventLabel : 'Ketik nama acara...'"
                        autocomplete="off"
                        class="w-full bg-white/70 border border-slate-200/80 rounded-2xl pl-11 pr-10 py-4 text-xs font-black text-slate-700 placeholder-slate-400 outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all shadow-sm">

                    {{-- Clear button --}}
                    <button type="button"
                        x-show="selectedEventId !== '' || eventSearch !== ''"
                        @click="selectedEventId = ''; selectedEventLabel = 'Semua Acara'; eventSearch = ''; open = false;"
                        class="absolute right-4 top-1/2 -translate-y-1/2 w-5 h-5 flex items-center justify-center rounded-full bg-slate-100 hover:bg-slate-200 text-slate-400 hover:text-slate-600 transition-all z-20">
                        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                {{-- Dropdown Suggestions --}}
                <div x-show="open"
                     x-transition:enter="transition ease-out duration-150"
                     x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     x-transition:leave="transition ease-in duration-100"
                     x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                     x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                     style="display: none;"
                     class="absolute z-[90] top-full mt-2 left-0 right-0 bg-white/95 backdrop-blur-xl border border-slate-200/60 rounded-2xl shadow-[0_20px_40px_-10px_rgba(15,23,42,0.15)] max-h-56 overflow-y-auto p-1.5 space-y-1">

                    {{-- Opsi Semua Acara --}}
                    <button type="button"
                        @click="selectedEventId = ''; selectedEventLabel = 'Semua Acara'; eventSearch = ''; open = false;"
                        :class="selectedEventId === '' ? 'bg-blue-50/80 text-blue-600' : 'text-slate-600 hover:bg-slate-50'"
                        class="w-full text-left px-4 py-3 rounded-xl font-black text-xs uppercase tracking-wider transition-all cursor-pointer flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-sky-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                            <span>Semua Acara</span>
                        </div>
                        <template x-if="selectedEventId === ''">
                            <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                        </template>
                    </button>

                    {{-- Loop Opsi Event (difilter realtime) --}}
                    <template x-for="item in filteredEvents" :key="item.id">
                        <button type="button"
                            @click="selectedEventId = item.id; selectedEventLabel = item.name; eventSearch = item.name; open = false;"
                            :class="selectedEventId == item.id ? 'bg-blue-50/80 text-blue-600' : 'text-slate-600 hover:bg-slate-50'"
                            class="w-full text-left px-4 py-3 rounded-xl font-black text-xs uppercase tracking-wider transition-all cursor-pointer flex items-center justify-between">
                            <div>
                                <span x-text="item.name" class="block"></span>
                                <span class="block text-[9px] text-slate-400 font-semibold normal-case tracking-normal mt-0.5" x-text="item.date"></span>
                            </div>
                            <template x-if="selectedEventId == item.id">
                                <svg class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </template>
                        </button>
                    </template>

                    {{-- Kosong --}}
                    <template x-if="filteredEvents.length === 0">
                        <div class="px-4 py-3 text-center text-[10px] text-slate-400 font-semibold">Tidak ada acara ditemukan</div>
                    </template>
                </div>

                @error('event_id')
                    <p class="text-xs text-red-500 font-bold mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Tombol Submit --}}
            <button type="submit"
                :disabled="mode === 'camera' ? !capturedImage : !fileSelected"
                :class="(mode === 'camera' ? !capturedImage : !fileSelected) ? 'opacity-40 cursor-not-allowed bg-sky-500' : 'bg-gradient-to-r from-sky-500 via-blue-500 to-indigo-600 hover:from-sky-600 hover:to-indigo-700 shadow-md shadow-slate-300/40 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 duration-300 cursor-pointer'"
                class="w-full py-4.5 text-white rounded-2xl font-black text-sm uppercase italic tracking-[0.15em] transition-all flex items-center justify-center gap-3">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Cari Fotoku
            </button>
        </form>
    </div>
</div>

{{-- LOADING OVERLAY AI SEARCH --}}
<div id="search-overlay" class="hidden fixed inset-0 bg-white/5 backdrop-blur-sm z-[200] flex items-center justify-center transition-all duration-300">
    <div class="clean-glass rounded-[2.5rem] p-10 flex flex-col items-center gap-6 max-w-sm w-full mx-4 relative overflow-hidden shadow-2xl shadow-blue-900/5"
         style="background: rgba(255, 255, 255, 0.6); border: 2px solid rgba(59, 130, 246, 0.3); backdrop-filter: blur(20px);">

        {{-- Spinner wajah --}}
        <div class="relative w-24 h-24">
            <svg class="w-24 h-24 text-blue-100/30" fill="none" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"/>
            </svg>
            <svg class="animate-spin w-24 h-24 text-blue-600 absolute inset-0" fill="none" viewBox="0 0 24 24" style="animation-duration:1.2s;">
                <path fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/>
            </svg>
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-12 h-12 bg-white/40 backdrop-blur-sm rounded-full flex items-center justify-center shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] border border-white/50">
                    <svg class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="text-center relative z-10">
            <p class="text-xl font-black text-blue-700 leading-tight">AI Memindai Wajah...</p>
            <p class="text-xs text-blue-500 font-semibold mt-2 leading-relaxed">Mencocokkan wajahmu dengan ribuan foto berkualitas tinggi di sistem KeJepret</p>
        </div>

        {{-- Step progress --}}
        <div class="w-full space-y-2.5 relative z-10">
            <div id="step-enroll" class="flex items-center gap-3 px-4 py-3 bg-blue-50/40 backdrop-blur-sm rounded-2xl border border-blue-100/40 transition-all duration-500">
                <div class="w-5 h-5 rounded-full bg-blue-600 flex items-center justify-center text-white text-[10px] font-black shrink-0 animate-pulse">1</div>
                <p class="text-[11px] font-bold text-blue-700">Mendaftarkan wajah ke AI...</p>
            </div>
            <div id="step-search" class="flex items-center gap-3 px-4 py-3 bg-white/20 backdrop-blur-sm rounded-2xl border border-white/25 transition-all duration-500">
                <div class="w-5 h-5 rounded-full bg-white/30 backdrop-blur-sm flex items-center justify-center text-slate-400 text-[10px] font-black shrink-0 border border-white/20">2</div>
                <p class="text-[11px] font-bold text-slate-400">Mencari foto yang cocok...</p>
            </div>
            <div id="step-done" class="flex items-center gap-3 px-4 py-3 bg-white/20 backdrop-blur-sm rounded-2xl border border-white/25 transition-all duration-500">
                <div class="w-5 h-5 rounded-full bg-white/30 backdrop-blur-sm flex items-center justify-center text-slate-400 text-[10px] font-black shrink-0 border border-white/20">3</div>
                <p class="text-[11px] font-bold text-slate-400">Menyiapkan hasil...</p>
            </div>
        </div>

        <div class="w-full bg-slate-100/70 backdrop-blur-sm rounded-full h-2 overflow-hidden border border-slate-200/40 p-[2px] relative z-10 shadow-inner">
            <div id="search-progress" class="h-full bg-gradient-to-r from-blue-600 to-indigo-600 rounded-full transition-all duration-700" style="width:0%"></div>
        </div>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
function searchPage() {
    return {
        mode: 'camera',
        capturedImage: null,
        filePreview: null,
        fileSelected: false,
        stream: null,
        
        // State untuk custom event select dropdown
        selectedEventId: '{{ old('event_id') }}',
        selectedEventLabel: 'Semua Acara',
        dropdownOpen: false,
        eventSearch: '',
        eventsList: [
            @foreach($events as $event)
            {
                id: '{{ $event->id }}',
                name: '{!! addslashes($event->name) !!}',
                date: '{{ \Carbon\Carbon::parse($event->event_date)->format("d M Y") }}'
            },
            @endforeach
        ],

        get filteredEvents() {
            if (!this.eventSearch.trim()) return this.eventsList;
            const q = this.eventSearch.toLowerCase();
            return this.eventsList.filter(e => e.name.toLowerCase().includes(q));
        },

        async init() {
            // Set label event default jika ada request old input (contoh setelah submit error)
            const found = this.eventsList.find(e => e.id == this.selectedEventId);
            if (found) {
                this.selectedEventLabel = found.name + ' — ' + found.date;
            } else {
                this.selectedEventLabel = 'Semua Acara';
            }

            await this.startCamera();
            this.$watch('mode', async (val) => {
                if (val === 'camera') {
                    await this.startCamera();
                } else {
                    this.stopCamera();
                }
            });
        },

        async startCamera() {
            this.capturedImage = null;
            try {
                this.stream = await navigator.mediaDevices.getUserMedia({
                    video: { facingMode: 'user', width: { ideal: 640 }, height: { ideal: 640 } }
                });
                this.$refs.video.srcObject = this.stream;
            } catch (e) {
                this.mode = 'file';
            }
        },

        stopCamera() {
            if (this.stream) {
                this.stream.getTracks().forEach(t => t.stop());
                this.stream = null;
            }
        },

        capture() {
            const video  = this.$refs.video;
            const canvas = this.$refs.canvas;
            canvas.width  = video.videoWidth;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0);
            this.capturedImage = canvas.toDataURL('image/jpeg', 0.9);
            this.stopCamera();
        },

        retake() {
            this.capturedImage = null;
            this.startCamera();
        },

        onFileChange(e) {
            const file = e.target.files[0];
            if (!file) return;
            this.fileSelected = true;
            const reader = new FileReader();
            reader.onload = (ev) => { this.filePreview = ev.target.result; };
            reader.readAsDataURL(file);
        },

        prepareSubmit(e) {
            if (this.mode === 'camera') {
                if (!this.capturedImage) { e.preventDefault(); return; }
                this.$refs.selfieBase64.value = this.capturedImage;
            }

            // Tampilkan overlay loading
            document.getElementById('search-overlay').classList.remove('hidden');
            document.body.style.overflow = 'hidden';

            const progress   = document.getElementById('search-progress');
            const stepSearch = document.getElementById('step-search');
            const stepDone   = document.getElementById('step-done');

            // Step 1 aktif langsung
            progress.style.width = '20%';

            // Step 2 aktif setelah 1.5 detik
            setTimeout(() => {
                progress.style.width = '55%';
                stepSearch.classList.remove('opacity-60');
                stepSearch.classList.replace('bg-white/20', 'bg-blue-50/40');
                stepSearch.classList.replace('border-white/25', 'border-blue-100/40');
                stepSearch.classList.add('shadow-sm', 'shadow-blue-500/5');
                
                const numBox = stepSearch.querySelector('div');
                numBox.classList.replace('bg-white/30', 'bg-blue-600');
                numBox.classList.replace('border-white/20', 'border-blue-600');
                numBox.classList.replace('text-slate-400', 'text-white');
                numBox.classList.add('animate-pulse', 'shadow-sm', 'shadow-blue-500/20');
                
                stepSearch.querySelector('p').classList.replace('text-slate-400', 'text-blue-700');
                stepSearch.querySelector('p').textContent = 'Mencari foto yang cocok...';
            }, 1500);

            // Step 3 aktif setelah 3.5 detik
            setTimeout(() => {
                progress.style.width = '95%';
                stepDone.classList.remove('opacity-60');
                stepDone.classList.replace('bg-white/20', 'bg-blue-50/40');
                stepDone.classList.replace('border-white/25', 'border-blue-100/40');
                stepDone.classList.add('shadow-sm', 'shadow-blue-500/5');
                
                const numBox = stepDone.querySelector('div');
                numBox.classList.replace('bg-white/30', 'bg-blue-600');
                numBox.classList.replace('border-white/20', 'border-blue-600');
                numBox.classList.replace('text-slate-400', 'text-white');
                numBox.classList.add('animate-pulse', 'shadow-sm', 'shadow-blue-500/20');
                
                stepDone.querySelector('p').classList.replace('text-slate-400', 'text-blue-700');
                stepDone.querySelector('p').textContent = 'Menyiapkan hasil...';
            }, 3500);
        },

        destroy() {
            this.stopCamera();
        }
    }
}
</script>
@endsection