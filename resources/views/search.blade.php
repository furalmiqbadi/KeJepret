<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Foto Saya - KeJepret</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .loading-spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body class="bg-gray-100 p-5 md:p-10">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-10">
            <h1 class="text-4xl font-bold text-blue-600 mb-2">🔍 KeJepret Search Demo</h1>
            <p class="text-gray-600">Cukup upload selfie, AI akan mencarikan foto kamu di database.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="md:col-span-1">
                <div class="bg-white p-6 rounded-2xl shadow-lg border border-gray-200">
                    <h2 class="font-bold text-lg mb-4">Ambil Selfie</h2>
                    
                    <form id="searchForm" enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:border-blue-500 transition cursor-pointer">
                            <input type="file" name="selfie" id="selfieInput" class="hidden" accept="image/*" required>
                            <label for="selfieInput" class="cursor-pointer">
                                <div id="previewContainer" class="mb-2 hidden">
                                    <img id="imagePreview" src="#" class="max-h-48 mx-auto rounded-lg shadow-sm">
                                </div>
                                <div id="uploadPlaceholder">
                                    <span class="text-4xl">📸</span>
                                    <p class="text-sm text-gray-500 mt-2">Klik untuk pilih foto selfie</p>
                                </div>
                            </label>
                        </div>

                        <button type="submit" id="btnSubmit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl shadow-md transition-all active:scale-95">
                            Cari Wajah Saya!
                        </button>
                    </form>
                </div>
            </div>

            <div class="md:col-span-2">
                <div class="bg-white p-6 rounded-2xl shadow-lg min-h-[400px] border border-gray-200">
                    <h2 class="font-bold text-lg mb-4">Hasil Pencarian:</h2>
                    
                    <div id="statusAlert" class="hidden p-3 rounded-lg mb-4 text-center font-medium"></div>

                    <div id="loader" class="hidden flex-col items-center justify-center py-20">
                        <div class="loading-spinner mb-4"></div>
                        <p class="text-gray-500 animate-pulse">AI sedang mencocokkan wajah...</p>
                    </div>

                    <div id="resultsGrid" class="grid grid-cols-2 gap-4">
                        <p class="col-span-2 text-center text-gray-400 mt-20">Belum ada hasil. Silakan upload selfie di sebelah kiri.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const selfieInput = document.getElementById('selfieInput');
        const imagePreview = document.getElementById('imagePreview');
        const previewContainer = document.getElementById('previewContainer');
        const uploadPlaceholder = document.getElementById('uploadPlaceholder');
        const searchForm = document.getElementById('searchForm');
        const btnSubmit = document.getElementById('btnSubmit');
        const resultsGrid = document.getElementById('resultsGrid');
        const loader = document.getElementById('loader');
        const statusAlert = document.getElementById('statusAlert');

        // Preview Foto saat dipilih
        selfieInput.onchange = evt => {
            const [file] = selfieInput.files;
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                previewContainer.classList.remove('hidden');
                uploadPlaceholder.classList.add('hidden');
            }
        }

        // Proses Form via AJAX
        searchForm.onsubmit = async (e) => {
            e.preventDefault();
            
            // Reset UI
            resultsGrid.innerHTML = '';
            statusAlert.classList.add('hidden');
            loader.classList.remove('hidden');
            btnSubmit.disabled = true;
            btnSubmit.classList.add('opacity-50');

            const formData = new FormData(searchForm);

            try {
                const response = await fetch("{{ route('demo.search.process') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const res = await response.json();

                if (res.success) {
                    // Tampilkan Pesan Sukses
                    statusAlert.innerText = res.message || "Pencarian Berhasil!";
                    statusAlert.className = "p-3 rounded-lg mb-4 text-center font-medium bg-green-100 text-green-700";
                    statusAlert.classList.remove('hidden');

                    if (res.data && res.data.length > 0) {
                        res.data.forEach(item => {
                            const card = `
                                <div class="group relative overflow-hidden rounded-xl shadow-sm hover:shadow-xl transition-all border border-gray-100">
                                    <img src="${item.r2_url}" class="w-full h-40 object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute bottom-0 left-0 right-0 p-2 bg-gradient-to-t from-black/70 to-transparent">
                                        <a href="${item.r2_url}" target="_blank" class="text-xs text-white hover:underline font-bold">Buka Foto Original →</a>
                                    </div>
                                </div>
                            `;
                            resultsGrid.innerHTML += card;
                        });
                    } else {
                        resultsGrid.innerHTML = `<p class="col-span-2 text-center text-gray-400 mt-20">Wajah tidak ditemukan di foto event manapun. 😢</p>`;
                    }
                } else {
                    throw new Error(res.message || "Gagal memproses AI.");
                }

            } catch (err) {
                statusAlert.innerText = "Error: " + err.message;
                statusAlert.className = "p-3 rounded-lg mb-4 text-center font-medium bg-red-100 text-red-700";
                statusAlert.classList.remove('hidden');
            } finally {
                loader.classList.add('hidden');
                btnSubmit.disabled = false;
                btnSubmit.classList.remove('opacity-50');
            }
        };
    </script>
</body>
</html>