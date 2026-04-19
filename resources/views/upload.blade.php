{{--
|--------------------------------------------------------------------------
| upload.blade.php  (Demo Mode)
|--------------------------------------------------------------------------
| Halaman demo upload foto event untuk fotografer/penyelenggara.
| Fotografer bisa upload foto event, sistem akan otomatis melakukan
| face embedding menggunakan AI untuk mempersiapkan pencarian.
|
| Route      : GET /demo/upload
| Middleware : -  (publik demo, atau bisa dikunci dengan auth:fotografer)
| Controller : DemoController@uploadPage
|
| Variabel dari controller:
|   $photos – Paginated collection of Photo models yang sudah diupload
|              (field: id, filename, r2_url, status, created_at)
|
| Endpoint AJAX:
|   POST /demo/upload → { success, message, photo{} }
|--------------------------------------------------------------------------
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KeJepret Demo – Upload Foto Event</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,700&display=swap" rel="stylesheet">

    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* ============================================================
         * CSS Variables – Design System KeJepret
         * ============================================================ */
        :root {
            --bg-base:      #080810;
            --bg-surface:   #0f0f1a;
            --bg-card:      #16162a;
            --accent:       #f59e0b;
            --accent-blue:  #3b82f6;
            --text-primary: #f1f1f5;
            --text-muted:   #6b7280;
            --border:       rgba(255,255,255,0.07);
        }

        *, *::before, *::after { box-sizing: border-box; }
        body {
            background-color: var(--bg-base);
            color: var(--text-primary);
            font-family: 'DM Sans', sans-serif;
            margin: 0;
            min-height: 100vh;
            background-image:
                radial-gradient(ellipse 70% 40% at 50% 0%, rgba(59,130,246,0.08) 0%, transparent 60%),
                linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
            background-size: 100% 100%, 40px 40px, 40px 40px;
        }
        .font-display { font-family: 'Bebas Neue', sans-serif; letter-spacing: 0.03em; }

        /* ===== Navbar ===== */
        .top-nav {
            position: fixed; top: 0; left: 0; right: 0; height: 56px;
            background: rgba(8,8,16,0.85); backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 1.5rem; z-index: 10;
        }
        .logo { display: flex; align-items: center; gap: 0.6rem; text-decoration: none; }
        .logo-icon { width: 30px; height: 30px; background: var(--accent); border-radius: 8px; display: flex; align-items: center; justify-content: center; }

        /* ===== Demo badge ===== */
        .demo-badge {
            display: inline-flex; align-items: center; gap: 0.4rem;
            background: rgba(59,130,246,0.12); border: 1px solid rgba(59,130,246,0.25);
            color: #93c5fd;
            font-size: 0.7rem; font-weight: 700; letter-spacing: 0.08em; text-transform: uppercase;
            padding: 0.3rem 0.75rem; border-radius: 9999px;
        }

        /* ===== Page layout ===== */
        .page-content {
            padding: 5rem 1rem 3rem;
            max-width: 680px; margin: 0 auto;
        }

        /* ===== Upload Card ===== */
        .upload-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 1.5rem;
            overflow: hidden;
            margin-bottom: 2rem;
        }
        .card-header { padding: 1.75rem 2rem; border-bottom: 1px solid var(--border); }
        .card-body { padding: 1.75rem 2rem; }

        /* ===== Drop zone ===== */
        .drop-zone {
            border: 2px dashed rgba(59,130,246,0.3);
            border-radius: 1rem;
            background: rgba(59,130,246,0.04);
            cursor: pointer; transition: all 0.2s;
            text-align: center; padding: 2.5rem 1.5rem;
            position: relative;
        }
        .drop-zone:hover, .drop-zone.dragover {
            border-color: var(--accent-blue);
            background: rgba(59,130,246,0.08);
        }
        .drop-zone input { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; }

        /* ===== Progress bar ===== */
        .progress-wrap {
            background: var(--bg-card); border-radius: 9999px;
            height: 6px; margin-top: 1rem; overflow: hidden;
            display: none;
        }
        .progress-wrap.show { display: block; }
        .progress-bar {
            height: 100%; background: var(--accent);
            border-radius: 9999px;
            transition: width 0.3s ease;
            width: 0%;
        }

        /* ===== Button ===== */
        .btn-upload {
            width: 100%; background: var(--accent-blue); color: #fff;
            font-weight: 700; font-size: 0.9rem; border: none;
            border-radius: 0.875rem; padding: 0.875rem;
            cursor: pointer; display: flex; align-items: center;
            justify-content: center; gap: 0.5rem;
            transition: all 0.2s; font-family: 'DM Sans', sans-serif;
        }
        .btn-upload:hover:not(:disabled) { background: #2563eb; box-shadow: 0 8px 24px rgba(59,130,246,0.35); }
        .btn-upload:disabled { opacity: 0.4; cursor: not-allowed; }

        /* ===== Status box ===== */
        .status-box {
            border-radius: 0.75rem; padding: 0.875rem 1rem;
            font-size: 0.85rem; margin-top: 1rem;
            display: none; align-items: center; gap: 0.5rem;
        }
        .status-box.show { display: flex; }
        .status-loading { background: rgba(59,130,246,0.1); border: 1px solid rgba(59,130,246,0.2); color: #93c5fd; }
        .status-success { background: rgba(16,185,129,0.1); border: 1px solid rgba(16,185,129,0.2); color: #6ee7b7; }
        .status-error   { background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.2); color: #fca5a5; }

        /* ===== Spinner ===== */
        @keyframes spin { to { transform: rotate(360deg); } }
        .spinner { width: 16px; height: 16px; border: 2px solid rgba(255,255,255,0.2); border-top-color: #fff; border-radius: 50%; animation: spin 0.7s linear infinite; flex-shrink: 0; }

        /* ===== Photo grid (uploaded photos list) ===== */
        .photos-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: 1.5rem;
            overflow: hidden;
        }
        .photos-header {
            padding: 1.25rem 1.75rem;
            border-bottom: 1px solid var(--border);
            display: flex; align-items: center; justify-content: space-between;
        }
        .photos-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 0.75rem;
            padding: 1.25rem 1.75rem;
        }
        @media (min-width: 480px) {
            .photos-grid { grid-template-columns: repeat(3, 1fr); }
        }

        /* ===== Photo item ===== */
        .photo-item {
            border-radius: 0.875rem; overflow: hidden;
            background: var(--bg-card); border: 1px solid var(--border);
            position: relative;
        }
        .photo-item img { width: 100%; aspect-ratio: 3/4; object-fit: cover; display: block; }
        .photo-footer {
            padding: 0.5rem 0.6rem;
            display: flex; align-items: center; justify-content: space-between;
        }
        .status-badge {
            font-size: 0.6rem; font-weight: 700; letter-spacing: 0.05em;
            padding: 0.2rem 0.5rem; border-radius: 9999px;
        }
        .status-embedded { background: rgba(16,185,129,0.15); color: #6ee7b7; }
        .status-processing { background: rgba(245,158,11,0.15); color: #fcd34d; }
        .status-pending { background: rgba(107,114,128,0.2); color: var(--text-muted); }

        /* ===== New item animation ===== */
        @keyframes slideIn {
            from { opacity: 0; transform: scale(0.95); }
            to   { opacity: 1; transform: scale(1); }
        }
        .photo-item.new { animation: slideIn 0.3s ease; }

        /* ===== Empty state di grid ===== */
        .empty-photos {
            grid-column: 1 / -1;
            text-align: center; padding: 2.5rem;
            color: var(--text-muted); font-size: 0.875rem;
        }
    </style>
</head>
<body>

    {{-- Navbar --}}
    <nav class="top-nav">
        <a href="{{ url('/') }}" class="logo">
            <div class="logo-icon">
                <svg class="w-4 h-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <span class="font-display text-lg" style="color: var(--text-primary);">KeJepret</span>
        </a>
        <div class="flex items-center gap-3">
            <a href="{{ url('/demo/search') }}" style="color: var(--text-muted); font-size: 0.8rem; text-decoration: none;">Cari Foto</a>
            <a href="{{ route('register') }}"
               style="background: var(--accent); color: #000; font-weight: 700; font-size: 0.8rem; padding: 0.4rem 1rem; border-radius: 9999px; text-decoration: none;">
                Daftar
            </a>
        </div>
    </nav>

    {{-- ============================================================
         PAGE CONTENT
         ============================================================ --}}
    <div class="page-content">

        {{-- ===== Upload Card ===== --}}
        <div class="upload-card">
            <div class="card-header">
                <div class="demo-badge mb-3">📷 Mode Fotografer</div>
                <h1 class="font-display text-3xl mb-1">UPLOAD FOTO EVENT</h1>
                <p class="text-sm" style="color: var(--text-muted);">
                    Upload foto dari event lari/olahraga. Sistem AI akan otomatis men-index semua wajah di foto.
                </p>
            </div>

            <div class="card-body">

                {{-- Drop zone --}}
                <div class="drop-zone" id="dropZone">
                    <input type="file" id="photoInput" accept="image/*" multiple>
                    <div class="w-14 h-14 mx-auto mb-3 rounded-full flex items-center justify-center"
                         style="background: rgba(59,130,246,0.1);">
                        <svg class="w-7 h-7 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                        </svg>
                    </div>
                    <p class="text-sm font-semibold mb-1">Upload Foto Event</p>
                    <p class="text-xs" style="color: var(--text-muted);">
                        Klik atau drag & drop · JPG, PNG · Maks 10MB per foto
                    </p>
                    <p id="fileCount" class="text-xs mt-2 hidden" style="color: var(--accent);"></p>
                </div>

                {{-- Progress bar (hidden until upload) --}}
                <div class="progress-wrap" id="progressWrap">
                    <div class="progress-bar" id="progressBar"></div>
                </div>

                {{-- Upload button --}}
                <button id="btnUpload" class="btn-upload mt-4" disabled>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                    Upload & Proses AI
                </button>

                {{-- Status --}}
                <div id="statusBox" class="status-box"></div>

                {{-- Info box --}}
                <div class="mt-4 p-4 rounded-xl text-xs space-y-1.5"
                     style="background: rgba(59,130,246,0.05); border: 1px solid rgba(59,130,246,0.12); color: var(--text-muted);">
                    <p class="font-semibold" style="color: #93c5fd;">ℹ️ Proses setelah upload:</p>
                    <p>1. Foto disimpan ke cloud storage (R2)</p>
                    <p>2. AI mendeteksi semua wajah dalam foto</p>
                    <p>3. Face embedding diindeks ke database</p>
                    <p>4. Foto siap dicari oleh peserta event</p>
                </div>
            </div>
        </div>

        {{-- ===== Daftar Foto Terupload ===== --}}
        <div class="photos-card">
            <div class="photos-header">
                <h2 class="font-display text-xl">FOTO TERUPLOAD</h2>
                <span class="text-xs px-2 py-1 rounded-full font-semibold"
                      style="background: rgba(255,255,255,0.06); color: var(--text-muted);">
                    {{ $photos?->total() ?? $photos?->count() ?? 0 }} foto
                </span>
            </div>

            <div class="photos-grid" id="photoGrid">
                @if(isset($photos) && $photos->isNotEmpty())
                    @foreach($photos as $photo)
                        <div class="photo-item" id="photo-{{ $photo->id }}">
                            <img src="{{ $photo->r2_url }}" alt="{{ $photo->filename }}" loading="lazy">
                            <div class="photo-footer">
                                <span class="text-xs truncate" style="color: var(--text-muted); max-width: 80px;" title="{{ $photo->filename }}">
                                    {{ Str::limit($photo->filename, 12) }}
                                </span>
                                @php
                                    $statusClass = match($photo->status) {
                                        'embedded'   => 'status-embedded',
                                        'processing' => 'status-processing',
                                        default      => 'status-pending',
                                    };
                                    $statusLabel = match($photo->status) {
                                        'embedded'   => '✓ Indexed',
                                        'processing' => '⏳ Proses',
                                        default      => '⋯ Queue',
                                    };
                                @endphp
                                <span class="status-badge {{ $statusClass }}">{{ $statusLabel }}</span>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="empty-photos">
                        <div class="text-4xl mb-3">📂</div>
                        <p class="font-semibold mb-1">Belum Ada Foto</p>
                        <p style="color: var(--text-muted);">Upload foto event di atas untuk memulai.</p>
                    </div>
                @endif
            </div>

            {{-- Pagination --}}
            @if(isset($photos) && $photos->hasPages())
                <div class="px-6 pb-5">
                    {{ $photos->links() }}
                </div>
            @endif
        </div>

        {{-- Link ke search demo --}}
        <div class="text-center mt-6">
            <a href="{{ url('/demo/search') }}" style="color: var(--accent); font-size: 0.875rem; font-weight: 600; text-decoration: none;">
                → Pergi ke halaman Cari Foto (untuk peserta)
            </a>
        </div>
    </div>

{{-- ============================================================
     JAVASCRIPT – Upload handler dengan progress bar
     ============================================================ --}}
<script>
    const photoInput   = document.getElementById('photoInput');
    const dropZone     = document.getElementById('dropZone');
    const btnUpload    = document.getElementById('btnUpload');
    const statusBox    = document.getElementById('statusBox');
    const progressWrap = document.getElementById('progressWrap');
    const progressBar  = document.getElementById('progressBar');
    const fileCount    = document.getElementById('fileCount');
    const photoGrid    = document.getElementById('photoGrid');

    /** Array file yang akan diupload */
    let filesToUpload = [];

    /** Update UI saat file dipilih */
    function handleFiles(files) {
        filesToUpload = Array.from(files).filter(f => f.type.startsWith('image/'));
        if (filesToUpload.length === 0) return;

        fileCount.textContent = `${filesToUpload.length} foto dipilih`;
        fileCount.classList.remove('hidden');
        btnUpload.disabled = false;
    }

    photoInput.addEventListener('change', () => handleFiles(photoInput.files));

    /** Drag & drop */
    dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('dragover'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        handleFiles(e.dataTransfer.files);
    });

    /** Tampilkan status */
    function showStatus(type, html) {
        statusBox.className = `status-box show status-${type}`;
        statusBox.innerHTML = html;
    }

    /**
     * uploadFile – Upload satu file ke /demo/upload
     * @param {File} file
     * @param {number} index  – Index untuk update progress
     * @param {number} total  – Total file
     */
    async function uploadFile(file, index, total) {
        const formData = new FormData();
        formData.append('photo', file);
        formData.append('_token', document.querySelector('meta[name="csrf-token"]').content);

        const res = await fetch('{{ url('/demo/upload') }}', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
            body: formData
        });
        const data = await res.json();

        // Update progress bar
        const pct = Math.round(((index + 1) / total) * 100);
        progressBar.style.width = pct + '%';

        if (data.success && data.photo) {
            // Hapus empty state jika ada
            const emptyEl = photoGrid.querySelector('.empty-photos');
            if (emptyEl) emptyEl.remove();

            // Prepend foto baru ke grid
            const div = document.createElement('div');
            div.className = 'photo-item new';
            div.id = 'photo-' + data.photo.id;
            div.innerHTML = `
                <img src="${data.photo.r2_url}" alt="${data.photo.filename}" loading="lazy">
                <div class="photo-footer">
                    <span class="text-xs truncate" style="color: var(--text-muted); max-width: 80px;" title="${data.photo.filename}">
                        ${data.photo.filename.substring(0, 12)}...
                    </span>
                    <span class="status-badge status-processing">⏳ Proses</span>
                </div>
            `;
            photoGrid.insertBefore(div, photoGrid.firstChild);
        }

        return data;
    }

    /** Handle submit – Upload semua file satu per satu */
    btnUpload.addEventListener('click', async function () {
        if (filesToUpload.length === 0) return;

        btnUpload.disabled = true;
        btnUpload.innerHTML = '<div class="spinner"></div> Mengupload...';
        progressWrap.classList.add('show');
        progressBar.style.width = '0%';

        let successCount = 0;
        let errorCount = 0;

        showStatus('loading', `⏳ Mengupload ${filesToUpload.length} foto...`);

        for (let i = 0; i < filesToUpload.length; i++) {
            try {
                const data = await uploadFile(filesToUpload[i], i, filesToUpload.length);
                if (data.success) successCount++;
                else errorCount++;
            } catch (err) {
                errorCount++;
            }
        }

        // Selesai
        progressBar.style.width = '100%';

        if (errorCount === 0) {
            showStatus('success', `✅ ${successCount} foto berhasil diupload dan sedang diproses AI!`);
        } else {
            showStatus('error', `⚠️ ${successCount} berhasil, ${errorCount} gagal.`);
        }

        btnUpload.disabled = false;
        btnUpload.innerHTML = `<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg> Upload & Proses AI`;
        filesToUpload = [];
        fileCount.classList.add('hidden');
        photoInput.value = '';
    });

    /**
     * Polling status embedding – Cek status foto yang sedang diproses
     * Setiap 5 detik cek semua foto yang masih "processing"
     */
    setInterval(async () => {
        const processingItems = photoGrid.querySelectorAll('.status-badge.status-processing');
        if (processingItems.length === 0) return;

        try {
            const res = await fetch('{{ url('/demo/upload/status') }}', {
                headers: { 'Accept': 'application/json' }
            });
            const data = await res.json();
            if (!data.photos) return;

            data.photos.forEach(photo => {
                if (photo.status === 'embedded') {
                    const el = document.getElementById('photo-' + photo.id);
                    if (el) {
                        const badge = el.querySelector('.status-badge');
                        if (badge) {
                            badge.className = 'status-badge status-embedded';
                            badge.textContent = '✓ Indexed';
                        }
                    }
                }
            });
        } catch (err) {
            // Polling error – abaikan saja
        }
    }, 5000);
</script>

</body>
</html>
