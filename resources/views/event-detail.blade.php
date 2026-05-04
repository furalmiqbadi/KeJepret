@extends('layouts.app')
@section('title', $event->name)
@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8">

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-xs font-semibold text-gray-400 mb-6">
        <a href="{{ route('search') }}" class="hover:text-blue-600 transition-colors">Cari Event</a>
        <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-gray-700">{{ Str::limit($event->name, 40) }}</span>
    </div>

    {{-- Cover Image --}}
    @if($event->cover_image)
    <div class="w-full h-56 sm:h-72 rounded-3xl overflow-hidden mb-6 bg-gray-100">
        <img src="{{ env('AWS_URL') }}/{{ $event->cover_image }}"
             alt="{{ $event->name }}"
             class="w-full h-full object-cover">
    </div>
    @else
    <div class="w-full h-40 rounded-3xl bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center mb-6">
        <svg class="w-16 h-16 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
    </div>
    @endif

    {{-- Event Info --}}
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 mb-6">
        <h1 class="text-2xl sm:text-3xl font-black text-gray-900 mb-4">{{ $event->name }}</h1>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-5">
            <div class="flex items-start gap-2">
                <div class="w-8 h-8 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Tanggal</p>
                    <p class="text-sm font-black text-gray-900">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}</p>
                </div>
            </div>

            <div class="flex items-start gap-2">
                <div class="w-8 h-8 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Lokasi</p>
                    <p class="text-sm font-black text-gray-900">{{ $event->location }}</p>
                </div>
            </div>

            <div class="flex items-start gap-2">
                <div class="w-8 h-8 bg-blue-50 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-4 h-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400">Total Foto</p>
                    <p class="text-sm font-black text-gray-900">{{ number_format($event->photos_count) }} foto</p>
                </div>
            </div>
        </div>

        @if($event->description)
        <div class="border-t border-gray-50 pt-4">
            <p class="text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Deskripsi</p>
            <p class="text-sm text-gray-600 leading-relaxed">{{ $event->description }}</p>
        </div>
        @endif
    </div>

    {{-- ===== CARI FOTO ===== --}}
    @auth
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-6"
         x-data="eventSearch()" x-init="init()">

        {{-- Header --}}
        <div class="px-6 py-5 border-b border-gray-50">
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">TEMUKAN FOTOMU</p>
            <h2 class="text-xl font-black text-gray-900">Cari Foto di Event Ini</h2>
            <p class="text-sm text-gray-400 mt-1">Ambil selfie langsung atau upload file — AI akan mencarikan fotomu di event ini.</p>
        </div>

        {{-- Tab Toggle --}}
        <div class="grid grid-cols-2 gap-2 bg-slate-100 rounded-2xl p-1 mx-6 mt-5">
            <button type="button" @click="mode = 'camera'"
                :class="mode === 'camera' ? 'bg-white shadow text-blue-600' : 'text-gray-400 hover:text-gray-600'"
                class="flex items-center justify-center gap-2 py-3 rounded-xl font-bold text-sm transition-all">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Kamera
            </button>
            <button type="button" @click="mode = 'file'"
                :class="mode === 'file' ? 'bg-white shadow text-blue-600' : 'text-gray-400 hover:text-gray-600'"
                class="flex items-center justify-center gap-2 py-3 rounded-xl font-bold text-sm transition-all">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Upload File
            </button>
        </div>

        <form action="{{ route('runner.search.post') }}" method="POST" enctype="multipart/form-data"
              class="p-6 space-y-5" @submit="prepareSubmit">
            @csrf
            {{-- event_id otomatis dari event yang sedang dibuka --}}
            <input type="hidden" name="event_id" value="{{ $event->id }}">
            <input type="hidden" name="selfie_base64" x-ref="selfieBase64">
            <input type="file" name="selfie" x-ref="selfieFile" accept="image/png,image/jpeg,image/jpg"
                class="hidden" @change="onFileChange">

            {{-- MODE KAMERA --}}
            <div x-show="mode === 'camera'" x-transition>
                <div class="relative rounded-2xl overflow-hidden bg-black aspect-square">
                    <video x-ref="video" autoplay playsinline muted
                        class="w-full h-full object-cover" x-show="!capturedImage"></video>
                    <img :src="capturedImage" x-show="capturedImage"
                        class="w-full h-full object-cover">

                    {{-- Ring panduan --}}
                    <div x-show="!capturedImage" class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="w-48 h-48 rounded-full border-4 border-white/50 border-dashed"></div>
                    </div>

                    {{-- Tombol capture / retake --}}
                    <div class="absolute bottom-4 inset-x-0 flex justify-center gap-4">
                        <template x-if="!capturedImage">
                            <button type="button" @click="capture"
                                class="w-16 h-16 bg-white rounded-full border-4 border-blue-600 shadow-xl flex items-center justify-center hover:scale-105 active:scale-95 transition">
                                <div class="w-10 h-10 bg-blue-600 rounded-full"></div>
                            </button>
                        </template>
                        <template x-if="capturedImage">
                            <button type="button" @click="retake"
                                class="px-5 py-2.5 bg-white/90 backdrop-blur rounded-2xl font-bold text-sm text-gray-800 shadow hover:bg-white transition flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                Ulangi
                            </button>
                        </template>
                    </div>
                    <canvas x-ref="canvas" class="hidden"></canvas>
                </div>
                <p class="text-xs text-gray-400 font-medium text-center mt-2">Posisikan wajah di dalam lingkaran lalu tekan tombol bulat.</p>
            </div>

            {{-- MODE FILE --}}
            <div x-show="mode === 'file'" x-transition>
                <div class="bg-slate-50 border border-dashed border-slate-200 rounded-2xl p-6 text-center cursor-pointer hover:border-blue-300 hover:bg-blue-50/30 transition"
                    @click="$refs.selfieFile.click()">
                    <template x-if="!filePreview">
                        <div>
                            <svg class="w-10 h-10 text-slate-300 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            <p class="text-sm font-bold text-slate-500">Klik untuk pilih foto</p>
                            <p class="text-xs text-slate-400 mt-1">JPG / PNG, maks 5MB</p>
                        </div>
                    </template>
                    <template x-if="filePreview">
                        <div>
                            <img :src="filePreview" class="w-40 h-40 object-cover rounded-xl mx-auto">
                            <p class="text-xs font-bold text-blue-600 mt-3">Foto dipilih. Klik untuk ganti.</p>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit"
                :disabled="mode === 'camera' ? !capturedImage : !fileSelected"
                :class="(mode === 'camera' ? !capturedImage : !fileSelected) ? 'opacity-40 cursor-not-allowed' : 'hover:bg-blue-700 hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-blue-500/25'"
                class="w-full py-4 bg-blue-600 text-white rounded-2xl font-black text-sm uppercase italic tracking-[0.1em] transition-all flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Cari Fotoku di Event Ini
            </button>
        </form>
    </div>

    @else
    {{-- Guest: minta login dulu --}}
    <div class="bg-blue-50 border border-blue-100 rounded-3xl p-8 text-center mb-6">
        <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <h3 class="font-black text-gray-900 text-lg mb-2">Login untuk Mencari Foto</h3>
        <p class="text-sm text-gray-500 mb-5">Kamu perlu login terlebih dahulu untuk mencari foto di event ini.</p>
        <div class="flex gap-3 justify-center">
            <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-black text-sm rounded-xl transition-colors shadow-md shadow-blue-200">Masuk Sekarang</a>
            <a href="{{ route('register') }}" class="px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-bold text-sm rounded-xl border border-gray-200 transition-colors">Daftar Gratis</a>
        </div>
    </div>
    @endauth

    {{-- Back --}}
    <div class="text-center">
        <a href="{{ route('search') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-blue-600 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Daftar Event
        </a>
    </div>

</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
function eventSearch() {
    return {
        mode: 'camera',
        capturedImage: null,
        filePreview: null,
        fileSelected: false,
        stream: null,

        async init() {
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
        },

        destroy() {
            this.stopCamera();
        }
    }
}
</script>

@endsection
