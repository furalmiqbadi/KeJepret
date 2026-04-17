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

    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-xl">
        <!-- Header Demo -->
        <div class="mb-6 text-center">
            <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest">🎬 Demo Mode</span>
            <h1 class="text-2xl font-bold mt-3 text-gray-800">KeJepret – Upload Foto Event</h1>
            <p class="text-gray-500 text-sm mt-1">Upload foto peserta lari, lalu sistem AI akan embed wajah secara otomatis.</p>
        </div>

        <!-- Form Upload -->
        <form id="uploadForm" enctype="multipart/form-data">
            @csrf
            <label class="block mb-2 text-sm font-medium text-gray-700">Pilih Foto (JPG/PNG, max 10MB)</label>
            <input type="file" name="photo" id="photoInput" accept="image/*"
                class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-2 mb-4">

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                🚀 Upload & Embed
            </button>
        </form>

        <!-- Status -->
        <div id="statusBox" class="mt-4 hidden p-4 rounded-lg text-sm"></div>

        <!-- Daftar Foto -->
        <div class="mt-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-3">📸 Foto Terupload</h2>
            @if($photos->isEmpty())
                <p class="text-gray-400 text-sm text-center">Belum ada foto. Upload sekarang!</p>
            @else
                <div class="grid grid-cols-2 gap-3" id="photoGrid">
                    @foreach($photos as $photo)
                        <div class="relative rounded-lg overflow-hidden border">
                            <img src="{{ $photo->r2_url }}" class="w-full h-32 object-cover">
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white text-xs px-2 py-1 flex justify-between">
                                <span>{{ $photo->filename }}</span>
                                <span class="{{ $photo->status === 'embedded' ? 'text-green-300' : 'text-yellow-300' }}">
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
            const formData = new FormData(this);
            const statusBox = document.getElementById('statusBox');

            statusBox.className = 'mt-4 p-4 rounded-lg text-sm bg-blue-50 text-blue-700';
            statusBox.classList.remove('hidden');
            statusBox.textContent = '⏳ Mengupload dan memproses...';

            try {
                const res = await fetch('{{ url('/demo/upload') }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: formData
                });
                const data = await res.json();

                if (data.success) {
                    statusBox.className = 'mt-4 p-4 rounded-lg text-sm bg-green-50 text-green-700';
                    statusBox.textContent = '✅ ' + data.message;
                    setTimeout(() => location.reload(), 1500);
                } else {
                    statusBox.className = 'mt-4 p-4 rounded-lg text-sm bg-red-50 text-red-700';
                    statusBox.textContent = '❌ ' + data.message;
                }
            } catch (err) {
                statusBox.className = 'mt-4 p-4 rounded-lg text-sm bg-red-50 text-red-700';
                statusBox.textContent = '❌ Error: ' + err.message;
            }
        });
    </script>

</body>
</html>