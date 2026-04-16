<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Wajah - KeJepret</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-10 font-sans">

    <div class="max-w-5xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">🔍 KeJepret Search Demo</h1>
            <a href="{{ route('demo.upload') }}" class="text-gray-500 hover:underline font-semibold">← Kembali ke Upload</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-1 bg-white p-6 rounded-xl shadow-lg border border-gray-200 h-fit">
                <h2 class="text-lg font-semibold mb-2">Ambil Selfie</h2>
                <p class="text-gray-500 mb-4 text-xs">Arahkan wajah ke kamera, lalu jepret untuk mencari foto event kamu.</p>

                <div class="relative bg-black rounded-lg overflow-hidden mb-4 aspect-[3/4] flex justify-center items-center">
                    <video id="cameraStream" class="w-full h-full object-cover transform -scale-x-100" autoplay playsinline></video>
                    
                    <img id="photoPreview" class="absolute inset-0 w-full h-full object-cover transform -scale-x-100 hidden z-10" />
                    
                    <button id="snapBtn" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-white text-blue-600 rounded-full p-4 shadow-lg hover:bg-gray-200 transition z-20">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </button>
                </div>

                <div class="flex flex-col gap-2">
                    <button id="retakeBtn" class="hidden w-full bg-gray-200 text-gray-700 py-2 rounded-lg hover:bg-gray-300 transition font-semibold">
                        Ulangi Foto
                    </button>
                    <button id="searchBtn" class="hidden w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-bold shadow-md">
                        Cari Wajah Saya!
                    </button>
                    
                    <div class="text-center mt-2">
                        <span class="text-xs text-gray-400">Atau</span>
                        <input type="file" id="fileUpload" accept="image/*" class="hidden" />
                        <label for="fileUpload" class="block mt-1 text-sm text-blue-500 hover:underline cursor-pointer">
                            Upload foto dari galeri
                        </label>
                    </div>
                </div>

                <canvas id="canvas" class="hidden"></canvas>
            </div>

            <div class="md:col-span-2 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                <h2 class="text-lg font-semibold mb-4">Hasil Pencarian:</h2>
                
                <div id="loadingIndicator" class="hidden text-center py-10">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mb-2"></div>
                    <p class="text-gray-500 text-sm">AI sedang mencocokkan wajahmu dengan jutaan foto event...</p>
                </div>

                <div id="resultsGrid" class="grid grid-cols-2 gap-4">
                    <div class="col-span-2 text-center text-gray-400 py-10 border-2 border-dashed rounded-lg">
                        Belum ada pencarian. Silakan jepret selfie di sebelah kiri!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const video = document.getElementById('cameraStream');
        const canvas = document.getElementById('canvas');
        const photoPreview = document.getElementById('photoPreview');
        const snapBtn = document.getElementById('snapBtn');
        const retakeBtn = document.getElementById('retakeBtn');
        const searchBtn = document.getElementById('searchBtn');
        const fileUpload = document.getElementById('fileUpload');
        const resultsGrid = document.getElementById('resultsGrid');
        const loadingIndicator = document.getElementById('loadingIndicator');

        let currentBlob = null; // Menyimpan foto yang akan dikirim

        // 1. Inisialisasi Kamera saat halaman dimuat
        async function startCamera() {
            try {
                // Minta izin kamera (facingMode user = kamera depan untuk HP)
                const stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: "user" } });
                video.srcObject = stream;
            } catch (err) {
                console.error("Error akses kamera:", err);
                alert("Gagal mengakses kamera. Pastikan browser mengizinkan akses kamera.");
            }
        }
        startCamera();

        // 2. Fungsi Jepret Foto (SUDAH DITAMBAHKAN LOGIKA MIRROR DI CANVAS)
        snapBtn.addEventListener('click', () => {
            // Set ukuran canvas sama dengan video
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            
            const context = canvas.getContext('2d');
            
            // --- LOGIKA MIRROR CANVAS ---
            // Membalikkan sumbu X agar fotonya tersimpan persis seperti yang kita lihat di layar
            context.translate(canvas.width, 0);
            context.scale(-1, 1);
            
            // Gambar frame video saat ini ke canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Ubah canvas jadi file gambar (Blob)
            canvas.toBlob((blob) => {
                currentBlob = blob;
                const imageUrl = URL.createObjectURL(blob);
                
                // Tampilkan preview
                photoPreview.src = imageUrl;
                photoPreview.classList.remove('hidden');
                
                // Atur tombol
                snapBtn.classList.add('hidden');
                retakeBtn.classList.remove('hidden');
                searchBtn.classList.remove('hidden');
            }, 'image/jpeg', 0.9);
        });

        // 3. Fungsi Ulangi Foto
        retakeBtn.addEventListener('click', () => {
            currentBlob = null;
            photoPreview.classList.add('hidden');
            snapBtn.classList.remove('hidden');
            retakeBtn.classList.add('hidden');
            searchBtn.classList.add('hidden');
        });

        // 4. Jika user pilih upload manual dari galeri
        fileUpload.addEventListener('change', function(e) {
            if (e.target.files && e.target.files[0]) {
                currentBlob = e.target.files[0];
                const imageUrl = URL.createObjectURL(currentBlob);
                
                // Tampilkan preview
                photoPreview.src = imageUrl;
                photoPreview.classList.remove('hidden');
                
                // Atur tombol
                snapBtn.classList.add('hidden');
                retakeBtn.classList.remove('hidden');
                searchBtn.classList.remove('hidden');
            }
        });

        // 5. Kirim data ke Backend (Controller Laravel)
        searchBtn.addEventListener('click', async () => {
            if (!currentBlob) return;

            // Tampilkan Loading
            resultsGrid.innerHTML = '';
            loadingIndicator.classList.remove('hidden');
            searchBtn.disabled = true;
            searchBtn.innerHTML = 'Mencari...';

            let formData = new FormData();
            // Kita namakan 'selfie' sesuai yang nanti akan ditangkap di Controller
            formData.append('selfie', currentBlob, 'selfie.jpg'); 

            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                // Tembak ke route demo.search.process
                const response = await fetch("{{ route('demo.search.process') }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                });

                const data = await response.json();
                
                loadingIndicator.classList.add('hidden');
                searchBtn.disabled = false;
                searchBtn.innerHTML = 'Cari Wajah Saya!';

                // Tampilkan pesan/hasil dari controller
                resultsGrid.innerHTML = `<div class="col-span-2 p-4 bg-green-100 text-green-700 rounded-lg text-center font-bold">
                    ${data.message}
                </div>`;

            } catch (error) {
                loadingIndicator.classList.add('hidden');
                searchBtn.disabled = false;
                searchBtn.innerHTML = 'Cari Wajah Saya!';
                console.error("Error:", error);
                alert("Terjadi kesalahan saat mencari.");
            }
        });
    </script>
</body>
</html>