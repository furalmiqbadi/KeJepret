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
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden mb-6">

        {{-- Header --}}
        <div class="px-6 py-5 border-b border-gray-50">
            <p class="text-xs font-bold uppercase tracking-widest text-blue-600 mb-1">TEMUKAN FOTOMU</p>
            <h2 class="text-xl font-black text-gray-900">Cari Foto di Event Ini</h2>
            <p class="text-sm text-gray-400 mt-1">Gunakan selfie atau unggah file foto untuk menemukan fotomu.</p>
        </div>

        {{-- Tabs --}}
        <div class="flex border-b border-gray-100" id="search-tabs">
            <button onclick="switchTab('selfie')" id="tab-selfie"
                class="flex-1 flex items-center justify-center gap-2 py-4 text-sm font-black border-b-2 border-blue-600 text-blue-600 transition-all">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                Selfie AI
                <span class="text-[10px] bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full font-bold">Utama</span>
            </button>
            <button onclick="switchTab('file')" id="tab-file"
                class="flex-1 flex items-center justify-center gap-2 py-4 text-sm font-bold text-gray-400 border-b-2 border-transparent transition-all hover:text-gray-600">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                Upload File
            </button>
        </div>

        {{-- Tab: Selfie AI --}}
        <div id="panel-selfie" class="p-6">
            <form action="{{ route('runner.search.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <input type="hidden" name="search_type" value="selfie">

                <div id="selfie-dropzone"
                    onclick="document.getElementById('selfie-input').click()"
                    class="border-2 border-dashed border-gray-200 rounded-2xl p-10 text-center hover:border-blue-300 hover:bg-blue-50/30 transition-all cursor-pointer group">
                    <div class="w-14 h-14 bg-gray-100 group-hover:bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-3 transition-colors">
                        <svg class="w-7 h-7 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <p class="font-black text-gray-700 text-sm mb-1">Unggah foto selfie kamu</p>
                    <p class="text-xs text-gray-400 mb-3">AI akan mencocokkan wajahmu dari semua foto di event ini</p>
                    <div class="flex items-center justify-center gap-2">
                        <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full">JPG, PNG</span>
                        <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full">Maks 10MB</span>
                    </div>
                    <div id="selfie-preview" class="hidden mt-4">
                        <img id="selfie-preview-img" src="" alt="" class="w-24 h-24 rounded-2xl object-cover mx-auto border-4 border-blue-200">
                        <p id="selfie-preview-name" class="text-xs font-bold text-blue-600 mt-2"></p>
                    </div>
                </div>
                <input type="file" id="selfie-input" name="selfie" accept="image/*" class="hidden" onchange="previewSelfie(this)">

                <button type="submit"
                    class="w-full mt-4 py-4 bg-blue-600 hover:bg-blue-700 text-white font-black text-sm rounded-2xl shadow-lg shadow-blue-200 transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Cari Fotomu dengan AI
                </button>
            </form>
        </div>

        {{-- Tab: Upload File --}}
        <div id="panel-file" class="p-6 hidden">
            <form action="{{ route('runner.search.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="event_id" value="{{ $event->id }}">
                <input type="hidden" name="search_type" value="file">

                <div id="file-dropzone"
                    onclick="document.getElementById('file-input').click()"
                    class="border-2 border-dashed border-gray-200 rounded-2xl p-10 text-center hover:border-blue-300 hover:bg-blue-50/30 transition-all cursor-pointer group">
                    <div class="w-14 h-14 bg-gray-100 group-hover:bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-3 transition-colors">
                        <svg class="w-7 h-7 text-gray-400 group-hover:text-blue-500 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                    </div>
                    <p class="font-black text-gray-700 text-sm mb-1">Upload foto dari event ini</p>
                    <p class="text-xs text-gray-400 mb-3">Unggah foto yang sudah kamu punya dari event ini untuk dicari yang lebih bagus</p>
                    <div class="flex items-center justify-center gap-2">
                        <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full">JPG, PNG</span>
                        <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2.5 py-1 rounded-full">Maks 10MB</span>
                    </div>
                    <div id="file-preview" class="hidden mt-4">
                        <img id="file-preview-img" src="" alt="" class="w-24 h-24 rounded-2xl object-cover mx-auto border-4 border-blue-200">
                        <p id="file-preview-name" class="text-xs font-bold text-blue-600 mt-2"></p>
                    </div>
                </div>
                <input type="file" id="file-input" name="photo_file" accept="image/*" class="hidden" onchange="previewFile(this)">

                <button type="submit"
                    class="w-full mt-4 py-4 bg-gray-900 hover:bg-gray-800 text-white font-black text-sm rounded-2xl transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    Cari dengan File Foto
                </button>
            </form>
        </div>

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
            <a href="{{ route('login') }}" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-black text-sm rounded-xl transition-colors shadow-md shadow-blue-200">
                Masuk Sekarang
            </a>
            <a href="{{ route('register') }}" class="px-6 py-3 bg-white hover:bg-gray-50 text-gray-700 font-bold text-sm rounded-xl border border-gray-200 transition-colors">
                Daftar Gratis
            </a>
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

<script>
function switchTab(tab) {
    const tabs    = ['selfie', 'file'];
    tabs.forEach(t => {
        const btn   = document.getElementById('tab-' + t);
        const panel = document.getElementById('panel-' + t);
        if (t === tab) {
            btn.classList.add('border-blue-600', 'text-blue-600');
            btn.classList.remove('border-transparent', 'text-gray-400');
            panel.classList.remove('hidden');
        } else {
            btn.classList.remove('border-blue-600', 'text-blue-600');
            btn.classList.add('border-transparent', 'text-gray-400');
            panel.classList.add('hidden');
        }
    });
}

function previewSelfie(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('selfie-preview-img').src = e.target.result;
            document.getElementById('selfie-preview-name').textContent = input.files[0].name;
            document.getElementById('selfie-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function previewFile(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('file-preview-img').src = e.target.result;
            document.getElementById('file-preview-name').textContent = input.files[0].name;
            document.getElementById('file-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>

@endsection
