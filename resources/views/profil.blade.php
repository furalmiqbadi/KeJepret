@extends('layouts.app')

@section('title', 'Profil Pengguna')

@section('content')
<div class="max-w-4xl mx-auto space-y-8">
    <!-- User Header Card -->
    <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 flex flex-col md:flex-row items-center gap-6">
        <div class="w-24 h-24 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center shrink-0 border-4 border-blue-100/50">
            @if(Auth::user()->profile_face_url)
                <img src="{{ Auth::user()->profile_face_url }}" class="w-full h-full rounded-full object-cover">
            @else
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            @endif
        </div>
        <div class="text-center md:text-left space-y-1">
            <h1 class="text-3xl font-black tracking-tighter text-gray-900">{{ Auth::user()->name }}</h1>
            <p class="text-gray-500 font-medium">{{ Auth::user()->email }}</p>
            <div class="flex flex-wrap justify-center md:justify-start gap-2 pt-2">
                <span class="px-3 py-1 bg-green-50 text-green-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-green-100">User Aktif</span>
                @if(Auth::user()->face_enrolled)
                    <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-widest rounded-full border border-blue-100">Pendaftaran Wajah Aktif</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Identifikasi Wajah (1-5 Foto) -->
    <div class="bg-white p-10 rounded-[2.5rem] shadow-xl shadow-gray-100 border border-gray-100 space-y-8 relative overflow-hidden">
        <div class="space-y-2">
            <h2 class="text-2xl font-black text-gray-900 tracking-tight">Identitas Biometrik (1-5 Foto)</h2>
            <p class="text-gray-500 max-w-xl">Makin banyak foto wajah (maks 5), makin akurat sistem AI dalam mencari foto Anda di event. Unggah foto dengan sudut wajah berbeda (depan, samping, senyum).</p>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-4">
            @foreach(Auth::user()->faces as $face)
                <div class="relative group aspect-square rounded-2xl overflow-hidden border-2 border-gray-100">
                    <img src="{{ $face->face_url }}" class="w-full h-full object-cover">
                    <button onclick="deleteFace({{ $face->id }})" class="absolute top-2 right-2 bg-red-500 text-white p-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                    </button>
                </div>
            @endforeach

            @if(Auth::user()->faces->count() < 5)
                <label for="upload-face" class="aspect-square border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center gap-2 hover:bg-gray-50 hover:border-blue-400 transition-all cursor-pointer group">
                    <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" /></svg>
                    </div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">Tambah Foto</span>
                </label>
                <input type="file" id="upload-face" class="hidden" accept="image/*">
            @endif
        </div>

        <!-- Progress Overlay -->
        <div id="loading-overlay" class="hidden absolute inset-0 bg-white/80 backdrop-blur-md flex flex-col items-center justify-center z-50">
            <div class="w-12 h-12 border-4 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
            <p class="mt-4 font-black uppercase tracking-widest text-blue-900 text-[10px]">Sinkronisasi AI...</p>
        </div>
    </div>
</div>

<script>
    const uploadInput = document.getElementById('upload-face');
    const overlay = document.getElementById('loading-overlay');

    if (uploadInput) {
        uploadInput.addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if (!file) return;

            const formData = new FormData();
            formData.append('image', file);

            overlay.classList.remove('hidden');

            try {
                const response = await fetch("{{ route('face.enroll') }}", {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                    body: formData
                });

                const data = await response.json();
                if (data.success) {
                    location.reload();
                } else {
                    alert('Gagal: ' + data.message);
                }
            } catch (err) {
                console.error(err);
                alert('Terjadi kesalahan jaringan.');
            } finally {
                overlay.classList.add('hidden');
            }
        });
    }

    async function deleteFace(id) {
        if (!confirm('Hapus foto wajah ini?')) return;

        overlay.classList.remove('hidden');

        try {
            const response = await fetch(`/face/delete/${id}`, {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            });

            const data = await response.json();
            if (data.success) {
                location.reload();
            } else {
                alert('Gagal: ' + data.message);
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan jaringan.');
        } finally {
            overlay.classList.add('hidden');
        }
    }
</script>
@endsection