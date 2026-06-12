@extends('layouts.app')
@section('title', $event->name)
@section('content')

<div class="max-w-3xl mx-auto px-4 sm:px-6 py-8 relative">
    {{-- Decorative Ambient Orbs --}}
    <div class="absolute top-20 -left-40 w-96 h-96 bg-sky-300/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-[40%] -right-40 w-[28rem] h-[28rem] bg-indigo-300/10 rounded-full blur-3xl pointer-events-none"></div>

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-xs font-semibold text-slate-400 mb-6 relative z-10">
        <a href="{{ route('search') }}" class="hover:text-blue-600 transition-colors">Cari Acara</a>
        <svg class="w-3 h-3 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        <span class="text-slate-700 font-bold">{{ Str::limit($event->name, 40) }}</span>
    </div>

    {{-- Cover Image --}}
    @if($event->cover_image)
    <div class="w-full h-56 sm:h-72 rounded-[2rem] overflow-hidden mb-6 bg-slate-950/5 border border-white/60 shadow-lg shadow-slate-200/50 relative z-10">
        <img src="{{ env('AWS_URL') }}/{{ $event->cover_image }}"
             alt="{{ $event->name }}"
             class="w-full h-full object-cover">
    </div>
    @else
    <div class="w-full h-40 rounded-[2rem] bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center mb-6 border border-white/60 shadow-md relative z-10">
        <svg class="w-16 h-16 text-blue-200" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
    </div>
    @endif

    {{-- Event Info (Clean Glass) --}}
    <div class="clean-glass rounded-[2.5rem] p-6 mb-6 relative overflow-hidden z-10 border border-white/50 bg-white/60 backdrop-blur-xl">
        {{-- Ambient Orbs tipis dekoratif --}}
        <div class="absolute -top-10 -right-10 w-20 h-20 bg-blue-300/5 rounded-full blur-xl pointer-events-none"></div>

        <h1 class="text-2xl sm:text-3xl font-black text-slate-800 tracking-tight leading-tight mb-5">{{ $event->name }}</h1>

        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 mb-5">
            <div class="flex items-start gap-2.5">
                <div class="w-9 h-9 bg-sky-50 rounded-xl flex items-center justify-center flex-shrink-0 text-sky-600 shadow-sm border border-sky-100/50">
                    <svg class="w-4.5 h-4.5 stroke-[2]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Tanggal</p>
                    <p class="text-xs font-black text-slate-700 mt-0.5">{{ \Carbon\Carbon::parse($event->event_date)->translatedFormat('d M Y') }}</p>
                </div>
            </div>

            <div class="flex items-start gap-2.5">
                <div class="w-9 h-9 bg-sky-50 rounded-xl flex items-center justify-center flex-shrink-0 text-sky-600 shadow-sm border border-sky-100/50">
                    <svg class="w-4.5 h-4.5 stroke-[2]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Lokasi</p>
                    <p class="text-xs font-black text-slate-700 mt-0.5">{{ $event->location }}</p>
                </div>
            </div>

            <div class="flex items-start gap-2.5">
                <div class="w-9 h-9 bg-sky-50 rounded-xl flex items-center justify-center flex-shrink-0 text-sky-600 shadow-sm border border-sky-100/50">
                    <svg class="w-4.5 h-4.5 stroke-[2]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <div>
                    <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Total Foto</p>
                    <p class="text-xs font-black text-slate-700 mt-0.5">{{ number_format($event->photos_count) }} foto</p>
                </div>
            </div>
        </div>

        @if($event->description)
        <div class="border-t border-slate-200/40 pt-4">
            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400 mb-1.5">Deskripsi</p>
            <p class="text-xs text-slate-500 leading-relaxed font-semibold">{{ $event->description }}</p>
        </div>
        @endif
    </div>

    {{-- ===== CARI FOTO ===== --}}
    @auth
    <div class="clean-glass rounded-[2.5rem] overflow-hidden mb-6 relative z-10 border border-white/50 bg-white/60 backdrop-blur-xl"
         x-data="eventSearch()" x-init="init()">
        
        {{-- Ambient Orbs tipis dekoratif --}}
        <div class="absolute -top-10 -left-10 w-24 h-24 bg-blue-300/5 rounded-full blur-xl pointer-events-none"></div>

        {{-- Header --}}
        <div class="px-6 py-5 border-b border-slate-200/40 relative z-10">
            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-600 mb-1">TEMUKAN FOTOMU</p>
            <h2 class="text-lg font-black text-slate-800">Cari Foto di Acara Ini</h2>
            <p class="text-xs text-slate-400 font-semibold mt-1">Ambil swafoto langsung atau unggah berkas. Kecerdasan buatan akan mencarikan fotomu di acara ini.</p>
        </div>

        {{-- Tab Toggle --}}
        <div class="grid grid-cols-2 gap-2 bg-slate-200/40 backdrop-blur-md rounded-2xl p-1 mx-6 mt-5 relative z-10 border border-slate-100/50">
            <button type="button" @click="mode = 'camera'"
                :class="mode === 'camera' ? 'bg-white shadow-sm text-blue-600 border border-white/60' : 'text-slate-400 hover:text-slate-600'"
                class="flex items-center justify-center gap-2 py-2.5 rounded-xl font-black text-xs uppercase tracking-wider transition-all cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Kamera
            </button>
            <button type="button" @click="mode = 'file'"
                :class="mode === 'file' ? 'bg-white shadow-sm text-blue-600 border border-white/60' : 'text-slate-400 hover:text-slate-600'"
                class="flex items-center justify-center gap-2 py-2.5 rounded-xl font-black text-xs uppercase tracking-wider transition-all cursor-pointer">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                Unggah Berkas
            </button>
        </div>

        <form action="{{ route('runner.search.post', [], false) }}" method="POST" enctype="multipart/form-data"
              class="p-6 space-y-5 relative z-10" @submit="prepareSubmit">
            @csrf
            {{-- event_id otomatis dari event yang sedang dibuka --}}
            <input type="hidden" name="event_id" value="{{ $event->id }}">

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

            <input type="hidden" name="selfie_base64" x-ref="selfieBase64">
            <input type="file" name="selfie" x-ref="selfieFile" accept="image/png,image/jpeg,image/jpg"
                class="hidden" @change="onFileChange">

            {{-- MODE KAMERA --}}
            <div x-show="mode === 'camera'" x-transition>
                <div class="relative rounded-2xl overflow-hidden bg-slate-900 aspect-square max-w-sm mx-auto shadow-inner border border-slate-950/20">
                    <video x-ref="video" autoplay playsinline muted
                        class="w-full h-full object-cover" x-show="!capturedImage"></video>
                    <img :src="capturedImage" x-show="capturedImage"
                        class="w-full h-full object-cover">

                    {{-- Ring panduan --}}
                    <div x-show="!capturedImage" class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="w-48 h-48 rounded-full border-4 border-white/40 border-dashed"></div>
                    </div>

                    {{-- Tombol capture / retake --}}
                    <div class="absolute bottom-4 inset-x-0 flex justify-center gap-4">
                        <template x-if="!capturedImage">
                            <button type="button" @click="capture"
                                class="w-16 h-16 bg-white rounded-full border-4 border-blue-500 shadow-xl flex items-center justify-center hover:scale-105 active:scale-95 transition cursor-pointer">
                                <div class="w-10 h-10 bg-blue-500 rounded-full"></div>
                            </button>
                        </template>
                        <template x-if="capturedImage">
                            <button type="button" @click="retake"
                                class="px-5 py-2.5 bg-white/95 backdrop-blur rounded-2xl font-black text-xs uppercase tracking-wider text-slate-700 shadow-md hover:bg-white transition flex items-center gap-2 cursor-pointer border border-slate-100/50">
                                <svg class="w-3.5 h-3.5 text-sky-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                Ulangi
                            </button>
                        </template>
                    </div>
                    <canvas x-ref="canvas" class="hidden"></canvas>
                </div>
                <p class="text-[10px] text-slate-400 font-bold text-center mt-2.5">Posisikan wajah di dalam lingkaran lalu tekan tombol bulat.</p>
            </div>

            {{-- MODE FILE --}}
            <div x-show="mode === 'file'" x-transition>
                <div class="bg-white/40 border border-dashed border-slate-300/80 backdrop-blur-md rounded-2xl p-8 text-center cursor-pointer hover:border-sky-400 hover:bg-white/60 transition-all duration-300 shadow-inner group max-w-sm mx-auto"
                    @click="$refs.selfieFile.click()">
                    <template x-if="!filePreview">
                        <div class="space-y-2">
                            <span class="w-12 h-12 bg-sky-50 rounded-xl flex items-center justify-center mx-auto shadow-sm text-sky-500 border border-sky-100/50 group-hover:scale-105 transition-transform duration-300">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            </span>
                            <p class="text-xs font-black text-slate-600 uppercase tracking-wider pt-2">Pilih berkas fotomu</p>
                            <p class="text-[10px] text-slate-400 font-bold">JPG, PNG, atau JPEG (Maks. 5MB)</p>
                        </div>
                    </template>
                    <template x-if="filePreview">
                        <div class="space-y-2">
                            <img :src="filePreview" class="w-40 h-40 object-cover rounded-2xl mx-auto shadow-md border border-white/60">
                            <p class="text-[10px] font-black text-blue-600 uppercase tracking-wider pt-2">Foto dipilih. Klik untuk ganti.</p>
                        </div>
                    </template>
                </div>
            </div>

            {{-- Tombol Submit --}}
            <button type="submit"
                :disabled="mode === 'camera' ? !capturedImage : !fileSelected"
                :class="(mode === 'camera' ? !capturedImage : !fileSelected) ? 'opacity-40 cursor-not-allowed shadow-none' : 'hover:scale-[1.01] active:scale-95 shadow-md shadow-blue-500/25 hover:shadow-lg'"
                class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-2xl font-black text-xs uppercase italic tracking-[0.15em] transition-all flex items-center justify-center gap-2 cursor-pointer relative overflow-hidden">
                <span class="absolute top-0 -left-[100%] w-[50%] h-full bg-white/20 skew-x-[-25deg] group-hover:left-[150%] transition-all duration-1000"></span>
                <svg class="w-4.5 h-4.5 stroke-[2.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Cari Fotoku di Acara Ini
            </button>
        </form>
    </div>

    @else
    {{-- Guest: minta login dulu --}}
    <div class="clean-glass rounded-[2.5rem] p-8 text-center mb-6 relative overflow-hidden z-10 border border-white/50 bg-white/60 backdrop-blur-xl">
        {{-- Ambient Orbs tipis dekoratif --}}
        <div class="absolute -top-10 -right-10 w-24 h-24 bg-blue-300/5 rounded-full blur-xl pointer-events-none"></div>

        <div class="w-14 h-14 bg-sky-50 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-sm border border-sky-100/50 text-sky-500">
            <svg class="w-7 h-7 stroke-[1.5]" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        </div>
        <h3 class="font-black text-slate-800 text-lg mb-1 leading-tight">Masuk untuk Mencari Foto</h3>
        <p class="text-xs text-slate-400 font-semibold mb-6">Kamu perlu masuk terlebih dahulu untuk mencari foto di acara ini.</p>
        <div class="flex gap-3 justify-center">
            <a href="{{ route('login') }}" class="px-6 py-3.5 bg-gradient-to-r from-sky-500 to-blue-600 hover:from-sky-600 hover:to-blue-700 text-white font-black text-xs uppercase italic tracking-wider rounded-xl transition-all hover:-translate-y-0.5 active:translate-y-0 shadow-md shadow-blue-200/50">Masuk Sekarang</a>
            <a href="{{ route('register') }}" class="px-6 py-3.5 bg-white/40 hover:bg-white/70 border border-slate-200 text-slate-600 hover:text-slate-800 rounded-xl font-bold text-xs uppercase tracking-wider transition-all hover:-translate-y-0.5 active:translate-y-0 shadow-sm">Daftar Gratis</a>
        </div>
    </div>
    @endauth

    {{-- Back --}}
    <div class="text-center relative z-10">
        <a href="{{ route('search') }}" class="inline-flex items-center gap-2 text-xs font-black uppercase tracking-wider text-slate-400 hover:text-blue-600 transition-colors">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
            Kembali ke Daftar Acara
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
