<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeJepret Demo – Upload Foto</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-6">

    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-2xl">
        <div class="mb-6 text-center">
            <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest">🎬 Demo Mode</span>
            <h1 class="text-2xl font-bold mt-3 text-gray-800">KeJepret – Upload Foto Event</h1>
            <p class="text-gray-500 text-sm mt-1">Upload foto peserta lari, lalu sistem AI akan embed wajah secara otomatis.</p>
        </div>

        <!-- Form Upload - support MULTIPLE foto sekaligus -->
        <form id="uploadForm" enctype="multipart/form-data">
            @csrf
            <label class="block mb-2 text-sm font-medium text-gray-700">Pilih Foto (JPG/PNG, max 10MB, bisa pilih banyak)</label>
            <input type="file" name="photo[]" id="photoInput" accept="image/*" multiple
                class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-2 mb-2">
            <p class="text-xs text-gray-400 mb-4">💡 Tahan Ctrl/Cmd untuk pilih banyak file sekaligus</p>

            <button type="submit" id="submitBtn"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                🚀 Upload & Embed
            </button>
        </form>

        <!-- Progress -->
        <div id="progressBox" class="mt-4 hidden">
            <div class="flex justify-between text-sm text-gray-600 mb-1">
                <span id="progressText">Mengupload...</span>
                <span id="progressCount">0/0</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div id="progressBar" class="bg-blue-500 h-2 rounded-full transition-all" style="width:0%"></div>
            </div>
        </div>

        <!-- Status -->
        <div id="statusBox" class="mt-4 hidden p-4 rounded-lg text-sm"></div>

        <!-- Daftar Foto -->
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-3">📸 Foto Terupload ({{ count($photos) }})</h2>
            @if($photos->isEmpty())
                <p class="text-gray-400 text-sm text-center">Belum ada foto. Upload sekarang!</p>
            @else
                <div class="grid grid-cols-2 gap-3">
                    @foreach($photos as $photo)
                        <div class="relative rounded-lg overflow-hidden border bg-gray-100">
                            <img src="{{ $photo->r2_url }}"
                                 referrerpolicy="no-referrer"
                                 class="w-full h-36 object-cover"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'">
                            <div class="w-full h-36 hidden items-center justify-center bg-gray-200 text-gray-400 text-xs flex-col gap-1">
                                <span class="text-2xl">🖼️</span>
                                <span>Foto tersimpan di R2</span>
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-xs px-2 py-1 flex justify-between items-center">
                                <span class="truncate max-w-[70%]">{{ $photo->filename }}</span>
                                <span class="{{ $photo->status === 'embedded' ? 'text-green-300' : 'text-yellow-300' }} font-bold">
                                    {{ $photo->status === 'embedded' ? '✅ Embedded' : '⏳ ' . $photo->status }}
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="mt-6 text-center">
            <a href="{{ url('/demo/search') }}" class="text-blue-600 hover:underline text-sm">→ Pergi ke halaman Search Foto</a>
        </div>
    </div>

    <script>
        document.getElementById('uploadForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const files = document.getElementById('photoInput').files;
            if (files.length === 0) return;

            const statusBox  = document.getElementById('statusBox');
            const progressBox = document.getElementById('progressBox');
            const progressBar = document.getElementById('progressBar');
            const progressText = document.getElementById('progressText');
            const progressCount = document.getElementById('progressCount');
            const submitBtn = document.getElementById('submitBtn');

            submitBtn.disabled = true;
            submitBtn.textContent = '⏳ Uploading...';
            progressBox.classList.remove('hidden');
            statusBox.classList.add('hidden');

            let success = 0, failed = 0;
            const total = files.length;

            for (let i = 0; i < total; i++) {
                const formData = new FormData();
                formData.append('photo', files[i]);
                formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

                progressText.textContent = `Mengupload: ${files[i].name}`;
                progressCount.textContent = `${i+1}/${total}`;
                progressBar.style.width = `${Math.round(((i) / total) * 100)}%`;

                try {
                    const res = await fetch('{{ url('/demo/upload/process') }}', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                        body: formData
                    });
                    const data = await res.json();
                    if (data.success) success++;
                    else failed++;
                } catch (err) {
                    failed++;
                }
            }

            progressBar.style.width = '100%';
            progressText.textContent = 'Selesai!';

            statusBox.classList.remove('hidden');
            if (failed === 0) {
                statusBox.className = 'mt-4 p-4 rounded-lg text-sm bg-green-50 text-green-700';
                statusBox.textContent = `✅ ${success} foto berhasil diupload & diembed!`;
            } else {
                statusBox.className = 'mt-4 p-4 rounded-lg text-sm bg-yellow-50 text-yellow-700';
                statusBox.textContent = `⚠️ ${success} berhasil, ${failed} gagal.`;
            }

            submitBtn.disabled = false;
            submitBtn.textContent = '🚀 Upload & Embed';
            setTimeout(() => location.reload(), 1500);
        });
    </script>

</body>
</html>