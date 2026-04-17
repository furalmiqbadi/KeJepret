<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeJepret Demo – Cari Foto Saya</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center p-6">

    <div class="bg-white rounded-2xl shadow-lg p-8 w-full max-w-xl">
        <!-- Header Demo -->
        <div class="mb-6 text-center">
            <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full uppercase tracking-widest">🎬 Demo Mode</span>
            <h1 class="text-2xl font-bold mt-3 text-gray-800">KeJepret – Cari Foto Kamu</h1>
            <p class="text-gray-500 text-sm mt-1">Upload selfie kamu, AI akan mencocokkan dengan foto event yang tersedia.</p>
        </div>

        <!-- Form Search -->
        <form id="searchForm" enctype="multipart/form-data">
            @csrf
            <label class="block mb-2 text-sm font-medium text-gray-700">Upload Selfie Kamu (JPG/PNG)</label>
            <input type="file" name="selfie" id="selfieInput" accept="image/*"
                class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 p-2 mb-4">

            <!-- Preview Selfie -->
            <div id="previewBox" class="hidden mb-4">
                <img id="selfiePreview" class="w-24 h-24 rounded-full object-cover mx-auto border-4 border-blue-400">
            </div>

            <button type="submit"
                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                🔍 Cari Foto Saya
            </button>
        </form>

        <!-- Status -->
        <div id="statusBox" class="mt-4 hidden p-4 rounded-lg text-sm"></div>

        <!-- Hasil -->
        <div id="resultsBox" class="mt-8 hidden">
            <h2 class="text-lg font-semibold text-gray-700 mb-3">🏃 Foto Kamu Ditemukan</h2>
            <div id="resultsGrid" class="grid grid-cols-2 gap-3"></div>
        </div>

        <div class="mt-6 text-center">
            <a href="{{ url('/demo/upload') }}" class="text-blue-600 hover:underline text-sm">← Kembali ke Upload Foto</a>
        </div>
    </div>

    <script>
        // Preview selfie
        document.getElementById('selfieInput').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('selfiePreview').src = e.target.result;
                    document.getElementById('previewBox').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('searchForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const statusBox = document.getElementById('statusBox');
            const resultsBox = document.getElementById('resultsBox');
            const resultsGrid = document.getElementById('resultsGrid');

            statusBox.className = 'mt-4 p-4 rounded-lg text-sm bg-blue-50 text-blue-700';
            statusBox.classList.remove('hidden');
            statusBox.textContent = '⏳ AI sedang mencari wajah kamu di foto event...';
            resultsBox.classList.add('hidden');

            try {
                const res = await fetch('{{ url('/demo/search') }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: formData
                });
                const data = await res.json();

                if (data.success) {
                    if (data.count === 0) {
                        statusBox.className = 'mt-4 p-4 rounded-lg text-sm bg-yellow-50 text-yellow-700';
                        statusBox.textContent = '😔 Wajah kamu tidak ditemukan di foto event.';
                    } else {
                        statusBox.className = 'mt-4 p-4 rounded-lg text-sm bg-green-50 text-green-700';
                        statusBox.textContent = `✅ Ditemukan ${data.count} foto!`;

                        resultsGrid.innerHTML = data.photos.map(photo => `
                            <div class="relative rounded-lg overflow-hidden border shadow">
                                <img src="${photo.r2_url}" class="w-full h-36 object-cover">
                                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 text-white text-xs px-2 py-1 flex justify-between">
                                    <span>${photo.filename}</span>
                                    <span class="text-green-300 font-bold">${photo.score}%</span>
                                </div>
                            </div>
                        `).join('');
                        resultsBox.classList.remove('hidden');
                    }
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