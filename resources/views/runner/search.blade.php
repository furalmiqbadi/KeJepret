@extends('layouts.app')
@section('title', 'Cari Foto')
@section('content')

<div class="max-w-lg mx-auto px-4 sm:px-6 py-8">

    <div class="mb-8">
        <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">AI FACE SEARCH</p>
        <h1 class="text-3xl font-black text-gray-900">Cari Fotomu</h1>
        <p class="text-gray-500 text-sm mt-1">Ambil selfie atau upload foto, AI akan mencarikan fotomu dari event.</p>
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

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-6 space-y-6" x-data="searchPage()">

        {{-- Tab Pilih Metode --}}
        <div class="grid grid-cols-2 gap-2 bg-slate-100 rounded-2xl p-1">
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

        <form action="{{ route('runner.search.post') }}" method="POST" enctype="multipart/form-data" class="space-y-5" @submit="prepareSubmit">
            @csrf

            {{-- Hidden input untuk selfie dari kamera --}}
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

                    {{-- Overlay ring --}}
                    <div x-show="!capturedImage" class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="w-48 h-48 rounded-full border-4 border-white/50 border-dashed"></div>
                    </div>

                    {{-- Tombol Capture / Retake --}}
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

                    {{-- Canvas tersembunyi untuk capture --}}
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
                        <div class="relative">
                            <img :src="filePreview" class="w-40 h-40 object-cover rounded-xl mx-auto">
                            <p class="text-xs font-bold text-blue-600 mt-3">Foto dipilih. Klik untuk ganti.</p>
                        </div>
                    </template>
                </div>
                @error('selfie')
                    <p class="text-xs text-red-500 font-bold mt-2">{{ $message }}</p>
                @enderror
            </div>

            {{-- Pilih Event --}}
            <div class="space-y-2">
                <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Pilih Event <span class="normal-case tracking-normal font-medium">(opsional)</span></label>
                <div class="relative">
                    <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <select name="event_id" class="w-full bg-slate-50 border border-slate-100 rounded-2xl pl-11 pr-4 py-4 text-sm font-bold text-slate-900 outline-none focus:ring-4 focus:ring-blue-100 transition-all appearance-none">
                        <option value="">Semua Event</option>
                        @foreach($events as $event)
                        <option value="{{ $event->id }}" {{ old('event_id') == $event->id ? 'selected' : '' }}>
                            {{ $event->name }} &mdash; {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit"
                :disabled="mode === 'camera' ? !capturedImage : !fileSelected"
                :class="(mode === 'camera' ? !capturedImage : !fileSelected) ? 'opacity-40 cursor-not-allowed' : 'hover:bg-blue-700 hover:scale-[1.02] active:scale-[0.98] shadow-lg shadow-blue-500/25'"
                class="w-full py-4 bg-blue-600 text-white rounded-2xl font-black text-sm uppercase italic tracking-[0.1em] transition-all flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Cari Fotoku
            </button>
        </form>
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
