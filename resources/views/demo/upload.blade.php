<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Foto Event - KeJepret</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    
    <style>
        .dz-remove {
            color: #ef4444 !important;
            font-weight: bold !important;
            margin-top: 5px !important;
            text-decoration: none !important;
        }
        .dz-remove:hover { text-decoration: underline !important; }
    </style>
</head>
<body class="bg-gray-100 p-10 font-sans">

    <div class="max-w-4xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">📸 KeJepret Upload Demo</h1>
            <a href="{{ route('demo.search') }}" class="text-blue-500 hover:underline font-semibold">Ke Halaman Search →</a>
        </div>

        <div class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">
            <h2 class="text-xl font-semibold mb-2">Upload Foto Event</h2>
            <p class="text-gray-500 mb-6 text-sm">Pilih foto yang ingin diupload, lalu klik tombol <b>Submit</b> di bawah.</p>

            <form action="{{ route('demo.upload.process') }}" method="POST" enctype="multipart/form-data" 
                  class="dropzone border-2 border-dashed border-blue-400 rounded-lg p-10 bg-blue-50 hover:bg-blue-100 transition flex flex-col justify-center items-center" 
                  id="imageUploadForm">
                @csrf
                <div class="dz-message text-gray-600 font-medium">
                    Tarik (Drag & Drop) foto ke sini, atau klik untuk memilih file dari komputer.
                    <br><span class="text-sm text-gray-400 font-normal">(Maksimal 5MB per foto)</span>
                </div>
            </form>

            <div class="mt-6 flex justify-end">
                <button id="submitUploadBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg shadow-md transition duration-200">
                     Submit & Upload Foto
                </button>
            </div>

            <div id="successMessage" class="hidden mt-4 p-4 bg-green-100 text-green-700 rounded-lg text-center font-semibold">
                ✅ Upload berhasil! Layar sudah dibersihkan untuk foto selanjutnya.
            </div>

        </div>
    </div>

    <script>
        Dropzone.autoDiscover = false;

        document.addEventListener("DOMContentLoaded", function() {
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let submitBtn = document.getElementById('submitUploadBtn');
            let successMsg = document.getElementById('successMessage');

            let myDropzone = new Dropzone("#imageUploadForm", {
                paramName: "photo", 
                maxFilesize: 5, 
                acceptedFiles: ".jpeg,.jpg,.png", 
                headers: { 'X-CSRF-TOKEN': csrfToken },
                addRemoveLinks: true,
                dictRemoveFile: "Batal",
                
                // INI KUNCI UTAMANYA: Matikan auto-upload!
                autoProcessQueue: false, 
                parallelUploads: 10, // Bisa upload 10 foto sekaligus antreannya

                init: function() {
                    let dz = this;

                    // 1. Logika ketika tombol SUBMIT diklik
                    submitBtn.addEventListener("click", function(e) {
                        e.preventDefault();
                        if (dz.getQueuedFiles().length > 0) {
                            dz.processQueue(); // Perintahkan dropzone buat jalanin upload
                            submitBtn.innerHTML = 'Sedang Mengupload... ⏳';
                            submitBtn.disabled = true;
                            submitBtn.classList.replace('bg-blue-600', 'bg-gray-400');
                            successMsg.classList.add('hidden');
                        } else {
                            alert("Pilih foto dulu sebelum di-submit!");
                        }
                    });

                    // 2. Logika ketika SEMUA file selesai diupload
                    this.on("queuecomplete", function() {
                        // Kembalikan tombol ke keadaan semula
                        submitBtn.innerHTML = 'Submit & Upload Foto';
                        submitBtn.disabled = false;
                        submitBtn.classList.replace('bg-gray-400', 'bg-blue-600');
                        
                        // Tampilkan pesan sukses
                        successMsg.classList.remove('hidden');

                        // Bersihkan layar Dropzone setelah delay 1.5 detik biar user sempet liat
                        setTimeout(function() {
                            dz.removeAllFiles(true);
                            // Sembunyikan pesan sukses lagi setelah beberapa detik
                            setTimeout(() => successMsg.classList.add('hidden'), 3000);
                        }, 1500);
                    });
                },
                
                success: function(file, response) {
                    file.previewElement.classList.add("dz-success");
                },
                
                error: function(file, response) {
                    file.previewElement.classList.add("dz-error");
                    let errorMsg = response.message || "Terjadi kesalahan pada server.";
                    file.previewElement.querySelector('.dz-error-message').textContent = errorMsg;
                }
            });
        });
    </script>
</body>
</html>