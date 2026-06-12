# Use Case Sederhana KeJepret

Dokumen ini berisi use case sederhana untuk diagram utama KeJepret. Aktor utama dibuat hanya 3 role agar diagram tidak terlalu ramai, tetapi fitur penting tetap tercakup.

## Keterangan Relasi

| Relasi | Makna |
| --- | --- |
| `include` | Use case utama wajib memakai use case lain. Contoh: Checkout wajib membuat order. |
| `extend` | Use case tambahan yang terjadi jika kondisi tertentu terpenuhi. Contoh: Download foto hanya muncul jika order sudah paid. |

Catatan: istilah UML yang benar adalah `extend`, bukan `exclude/outclude`.

## Aktor Utama

| Aktor | Deskripsi |
| --- | --- |
| Runner | Pengguna yang mencari, membeli, membayar, dan mengunduh foto. |
| Photographer | Pengguna yang mengunggah foto, mengelola foto, melihat penjualan, dan menarik saldo. |
| Admin | Pengelola sistem yang memverifikasi fotografer, mengelola event, withdrawal, foto, dan user. |

## 1. Use Case Runner

| Kode | Use Case | Deskripsi | Include | Extend |
| --- | --- | --- | --- | --- |
| RUN-01 | Registrasi/Login Runner | Runner membuat akun atau masuk ke sistem. | - | Edit Profil, Logout |
| RUN-02 | Melihat Event | Runner melihat daftar dan detail event. | RUN-01 | Filter Event |
| RUN-03 | Mencari Foto dengan Selfie | Runner mencari foto dirinya menggunakan selfie. | RUN-02, Upload Selfie, AI Face Search | Filter Kategori, Lihat Hasil Search |
| RUN-04 | Melihat Hasil Search | Runner melihat foto yang cocok dari hasil pencarian. | RUN-03 | Tambah ke Keranjang |
| RUN-05 | Mengelola Keranjang | Runner melihat dan menghapus foto di keranjang. | RUN-04 | Checkout |
| RUN-06 | Checkout Foto | Runner membuat pesanan dari isi keranjang. | RUN-05, Hitung Total, Buat Order | Bayar Pakasir |
| RUN-07 | Membayar Pesanan | Runner membuka link pembayaran Pakasir. | RUN-06, Pakasir | Cek Status Pembayaran |
| RUN-08 | Melihat Riwayat Pesanan | Runner melihat pesanan yang pernah dibuat. | RUN-01 | Lihat Detail Pesanan |
| RUN-09 | Melihat Detail Pesanan | Runner melihat item, total, dan status pesanan. | RUN-08 | Bayar Ulang, Download Foto |
| RUN-10 | Download Foto Original | Runner mengunduh foto original setelah pembayaran berhasil. | RUN-09, Order Paid, Storage S3/R2 | - |

### Relasi Runner yang Disarankan untuk Diagram

- `Mencari Foto dengan Selfie` `include` `Upload Selfie` dan `AI Face Search`.
- `Filter Kategori` `extend` `Mencari Foto dengan Selfie` karena opsional.
- `Checkout Foto` `include` `Hitung Total` dan `Buat Order`.
- `Membayar Pesanan` `include` `Pakasir`.
- `Download Foto Original` `extend` `Melihat Detail Pesanan` karena hanya tersedia jika status order sudah paid.

## 2. Use Case Photographer

| Kode | Use Case | Deskripsi | Include | Extend |
| --- | --- | --- | --- | --- |
| PHT-01 | Registrasi/Login Photographer | Photographer membuat akun atau masuk ke sistem. | Upload KTP | Menunggu Verifikasi, Logout |
| PHT-02 | Menunggu Verifikasi | Photographer menunggu persetujuan admin sebelum dapat upload foto. | PHT-01 | - |
| PHT-03 | Mengelola Portfolio | Photographer melihat daftar foto miliknya. | PHT-01, Status Verified | Upload Foto, Ubah Harga, Arsip Foto, Hapus Foto |
| PHT-04 | Upload Foto | Photographer mengunggah foto event/lomba. | PHT-03, Storage S3/R2, AI Face Search | Pilih Kategori |
| PHT-05 | Mengelola Harga Foto | Photographer mengubah harga foto miliknya. | PHT-03 | - |
| PHT-06 | Mengarsipkan/Menghapus Foto | Photographer mengarsipkan atau menghapus foto miliknya. | PHT-03 | - |
| PHT-07 | Melihat Riwayat Penjualan | Photographer melihat foto yang terjual dan pendapatannya. | PHT-01, Status Verified | Highlight dari Notifikasi |
| PHT-08 | Melihat Notifikasi Penjualan | Photographer melihat notifikasi saat fotonya terjual. | PHT-07 | Tandai Dibaca |
| PHT-09 | Melihat Saldo | Photographer melihat saldo dari penjualan. | PHT-07 | Ajukan Withdrawal |
| PHT-10 | Mengajukan Withdrawal | Photographer mengajukan pencairan saldo. | PHT-09, Validasi Saldo | - |

### Relasi Photographer yang Disarankan untuk Diagram

- `Registrasi/Login Photographer` `include` `Upload KTP` saat registrasi fotografer.
- `Menunggu Verifikasi` `extend` `Registrasi/Login Photographer` jika akun belum disetujui admin.
- `Upload Foto` `include` `Storage S3/R2` dan `AI Face Search`.
- `Pilih Kategori` `extend` `Upload Foto` karena opsional; jika kosong default-nya `Umum`.
- `Ubah Harga`, `Arsip Foto`, dan `Hapus Foto` `extend` `Mengelola Portfolio`.
- `Highlight dari Notifikasi` `extend` `Melihat Riwayat Penjualan`.
- `Mengajukan Withdrawal` `extend` `Melihat Saldo` dan `include` `Validasi Saldo`.

## 3. Use Case Admin

| Kode | Use Case | Deskripsi | Include | Extend |
| --- | --- | --- | --- | --- |
| ADM-01 | Login Admin | Admin masuk ke panel pengelolaan. | - | Logout |
| ADM-02 | Mengelola Verifikasi Photographer | Admin melihat dan memproses fotografer pending. | ADM-01 | Setujui Photographer, Tolak Photographer |
| ADM-03 | Mengelola Status Photographer | Admin mengatur status fotografer. | ADM-01 | Blokir Photographer, Buka Blokir Photographer |
| ADM-04 | Mengelola Event | Admin membuat, mengubah, dan menghapus/menonaktifkan event. | ADM-01 | Upload Cover Event |
| ADM-05 | Mengelola Withdrawal | Admin memproses pengajuan pencairan saldo fotografer. | ADM-01 | Setujui Withdrawal, Tolak Withdrawal |
| ADM-06 | Moderasi Foto | Admin memeriksa dan mengatur status foto. | ADM-01 | Nonaktifkan Foto |
| ADM-07 | Mengelola User | Admin melihat/mengelola data pengguna. | ADM-01 | - |
| ADM-08 | Melihat Statistik Sistem | Admin melihat ringkasan data sistem. | ADM-01 | - |

### Relasi Admin yang Disarankan untuk Diagram

- `Mengelola Verifikasi Photographer` `extend` ke `Setujui Photographer` atau `Tolak Photographer`.
- `Mengelola Status Photographer` `extend` ke `Blokir Photographer` atau `Buka Blokir Photographer`.
- `Mengelola Event` `extend` ke `Upload Cover Event` jika event memakai cover.
- `Mengelola Withdrawal` `extend` ke `Setujui Withdrawal` atau `Tolak Withdrawal`.
- `Moderasi Foto` `extend` ke `Nonaktifkan Foto` jika foto perlu dinonaktifkan.
