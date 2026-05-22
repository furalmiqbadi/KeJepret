# KeJepret

KeJepret adalah sebuah platform marketplace foto event dan perlombaan. Platform ini menjembatani pelari (runner) untuk mencari foto diri mereka menggunakan teknologi pencarian wajah (*face search*) dari hasil jepretan para fotografer.

## 🚀 Fitur Utama
- **Runner**: Pencarian foto otomatis dan cerdas menggunakan wajah (selfie), keranjang belanja (*cart*), halaman checkout pembayaran, serta pengunduhan foto resolusi asli paska-pembayaran.
- **Photographer**: Unggah hasil foto, penentuan harga jual secara mandiri (minimal Rp 5.000), melihat laporan ringkasan penjualan, serta melakukan permintaan penarikan dana (*withdrawal*).
- **Admin Panel**: Menggunakan Filament interaktif untuk memverifikasi pendaftaran fotografer, manajemen data event aktif, moderasi foto, serta menyetujui pencairan dana fotografer.
- **AI Face Search Engine**: Terintegrasi dengan layanan AI REST API eksternal (FastAPI) untuk melakukan proses *face embedding* dan pembandingan/pencarian wajah.

## 🛠️ Teknologi yang Digunakan
- **Backend Framework**: Laravel ^12.0
- **Admin & Dashboard**: Filament ^5.0
- **Authentication**: Laravel Sanctum ^4.3
- **Frontend**: Blade Templates, Tailwind CSS ^4.0, Vite
- **Database**: Relational Database via Laravel (MySQL / PostgreSQL dll.) serta SQLite untuk *testing*.
- **Storage Object**: Cloud Storage berbasis kompatibilitas Amazon S3 (disarankan AWS S3 / Cloudflare R2).
- **Core Environment**: PHP ^8.3, Node.js

## 📦 Prasyarat Instalasi
Pastikan sistem operasi/lingkungan *development* Anda telah ter-install perangkat lunak berikut:
- PHP >= 8.3
- Composer >= 2.x
- Node.js >= 20.x & npm
- Database Server (contoh: MySQL, MariaDB, atau PostgreSQL)

## ⚙️ Cara Instalasi
1. Lakukan kloning repositori ke komputer lokal:
   ```bash
   git clone https://github.com/username/kejepret.git
   cd kejepret
   ```
2. Pasang semua dependensi sistem:
   ```bash
   composer install
   npm install
   ```
3. Gandakan berkas konfigurasi *environment* dan hasilkan *app key* baru:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Sesuaikan `.env` server lokal Anda (Database, Storage AWS, dan API AI):
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   ...
   # Konfigurasi Storage R2 / S3
   AWS_ACCESS_KEY_ID=your_key
   AWS_SECRET_ACCESS_KEY=your_secret
   AWS_DEFAULT_REGION=us-east-1
   AWS_BUCKET=your_bucket
   AWS_URL=your_storage_url
   AWS_ENDPOINT=your_endpoint
   
   # Konfigurasi AI Face Search Eksternal
   AI_BASE_URL=https://ai.example.com
   AI_API_KEY=your_ai_api_key
   ```
5. Segarkan basis data utama dari skema dan jalankan *seeder*:
   ```bash
   php artisan migrate --seed
   ```
6. Kompilasi aset di mode pengembangan & jalankan aplikasi:
   ```bash
   npm run dev
   # (Jalankan serve pada terminal baru)
   php artisan serve
   ```

## 📂 Susunan Project
- `app/Filament/` - Area Admin Panel (Resources, Pages, Widgets) untuk administrasi project.
- `app/Models/` & `database/migrations/` - Model Eloquent dan Skema/Struktur database secara berdampingan.
- `app/Http/Controllers/` - *Web Request controller* dan Sanctum REST API controller.
- `resources/views/` - UI tampilan frontend (Blade) untuk tipe user *runner* dan *photographer*.
- `routes/` - Pengaturan alur akses (Routing web vs Routing *role-based* vs API).
- `tests/` - Letak PHPUnit *Feature*, *Unit* testing dan validasi QA.

## 💡 Contoh Penggunaan
- **Akses Runner**: Runner dapat mengunjungi *homepage* via `http://localhost:8000/`. Pelari dapat melakukan *upload* sebuah gambar *selfie* di sebuah laman pencarian event. Sistem akan menampilkan seluruh hasil jepretan yang memuat kemiripan dengan wajah pelari.
- **Akses Photographer**: Fotografer dapat masuk dan menggunakan akun yang telah diverifikasi untuk menuju portal *upload*, menetapkan *watermark*, dan mengatur harga karya mereka.
- **Akses Admin Panel**: Panel pengurus dapat diakses pada *endpoint* `http://localhost:8000/admin`. Gunakan kredensial spesifik akun admin saat inisialisasi awal.

## 🤝 Kontribusi
Kami sangat menerima berbagai *pull request* untuk memperbaiki kerusakan (*bug*) maupun meningkatkan stabilitas dan penambahan fitur *platform*. Untuk perubahan-perubahan yang berskala sangat luas/besar, mohon buka *issue* terlebih dahulu guna berdiskusi mengenai gagasan yang ingin diubah bersama *maintainer*.
Harap untuk senantiasa menjalankan proses verifikasi dan tes bawaan menggunakan perintah:
```bash
php artisan test
```

## 📜 Lisensi
Aplikasi (Source Code) KeJepret ini dirilis ke khalayak umum di bawah syarat izin perangkat lunak [MIT License](https://opensource.org/licenses/MIT).
