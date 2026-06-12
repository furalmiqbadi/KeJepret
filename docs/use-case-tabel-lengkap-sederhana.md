# Tabel Deskripsi Use Case Lengkap KeJepret

Dokumen ini dibuat dari `docs/use-case-per-role-dan-fitur.md`. Fitur utama dibuatkan tabel, lalu fitur pada kolom `include` dan `extend` hanya ikut dibuat tabel jika belum ada sebagai fitur utama. Jadi tidak ada duplikasi fitur.

Jumlah tabel: **60** tabel. Terdiri dari **28** use case utama dan **32** fitur include/extend non-duplikat.

Item include/extend yang tidak dihitung ulang karena sudah ada sebagai fitur utama: `Checkout`, `Bayar Pakasir`, `Lihat Detail Pesanan`, `Download Foto`, `Menunggu Verifikasi`, `Upload Foto`, `Ajukan Withdrawal`.

## Daftar Tabel

| No | ID | Nama Use Case | Aktor Primer | Sumber |
| --- | --- | --- | --- | --- |
| 1 | RUN-01 | Registrasi/Login Runner | Runner | Use Case Utama |
| 2 | RUN-02 | Melihat Event | Runner | Use Case Utama |
| 3 | RUN-03 | Mencari Foto dengan Selfie | Runner | Use Case Utama |
| 4 | RUN-04 | Melihat Hasil Search | Runner | Use Case Utama |
| 5 | RUN-05 | Mengelola Keranjang | Runner | Use Case Utama |
| 6 | RUN-06 | Checkout Foto | Runner | Use Case Utama |
| 7 | RUN-07 | Membayar Pesanan | Runner | Use Case Utama |
| 8 | RUN-08 | Melihat Riwayat Pesanan | Runner | Use Case Utama |
| 9 | RUN-09 | Melihat Detail Pesanan | Runner | Use Case Utama |
| 10 | RUN-10 | Download Foto Original | Runner | Use Case Utama |
| 11 | PHT-01 | Registrasi/Login Photographer | Photographer | Use Case Utama |
| 12 | PHT-02 | Menunggu Verifikasi | Photographer | Use Case Utama |
| 13 | PHT-03 | Mengelola Portfolio | Photographer | Use Case Utama |
| 14 | PHT-04 | Upload Foto | Photographer | Use Case Utama |
| 15 | PHT-05 | Mengelola Harga Foto | Photographer | Use Case Utama |
| 16 | PHT-06 | Mengarsipkan/Menghapus Foto | Photographer | Use Case Utama |
| 17 | PHT-07 | Melihat Riwayat Penjualan | Photographer | Use Case Utama |
| 18 | PHT-08 | Melihat Notifikasi Penjualan | Photographer | Use Case Utama |
| 19 | PHT-09 | Melihat Saldo | Photographer | Use Case Utama |
| 20 | PHT-10 | Mengajukan Withdrawal | Photographer | Use Case Utama |
| 21 | ADM-01 | Login Admin | Admin | Use Case Utama |
| 22 | ADM-02 | Mengelola Verifikasi Photographer | Admin | Use Case Utama |
| 23 | ADM-03 | Mengelola Status Photographer | Admin | Use Case Utama |
| 24 | ADM-04 | Mengelola Event | Admin | Use Case Utama |
| 25 | ADM-05 | Mengelola Withdrawal | Admin | Use Case Utama |
| 26 | ADM-06 | Moderasi Foto | Admin | Use Case Utama |
| 27 | ADM-07 | Mengelola User | Admin | Use Case Utama |
| 28 | ADM-08 | Melihat Statistik Sistem | Admin | Use Case Utama |
| 29 | EXT-01 | Edit Profil | Runner/Photographer | Fitur Include/Extend |
| 30 | EXT-02 | Logout | Runner/Photographer/Admin | Fitur Include/Extend |
| 31 | EXT-03 | Filter Event | Runner | Fitur Include/Extend |
| 32 | EXT-04 | Upload Selfie | Runner | Fitur Include/Extend |
| 33 | EXT-05 | AI Face Search | Sistem Pendukung | Fitur Include/Extend |
| 34 | EXT-06 | Filter Kategori | Runner | Fitur Include/Extend |
| 35 | EXT-07 | Lihat Hasil Search | Runner | Fitur Include/Extend |
| 36 | EXT-08 | Tambah ke Keranjang | Runner | Fitur Include/Extend |
| 37 | EXT-09 | Hitung Total | Sistem Pendukung | Fitur Include/Extend |
| 38 | EXT-10 | Buat Order | Sistem Pendukung | Fitur Include/Extend |
| 39 | EXT-11 | Pakasir | Sistem Pendukung | Fitur Include/Extend |
| 40 | EXT-12 | Cek Status Pembayaran | Runner | Fitur Include/Extend |
| 41 | EXT-13 | Bayar Ulang | Runner | Fitur Include/Extend |
| 42 | EXT-14 | Order Paid | Sistem Pendukung | Fitur Include/Extend |
| 43 | EXT-15 | Storage S3/R2 | Sistem Pendukung | Fitur Include/Extend |
| 44 | EXT-16 | Upload KTP | Photographer | Fitur Include/Extend |
| 45 | EXT-17 | Status Verified | Sistem Pendukung | Fitur Include/Extend |
| 46 | EXT-18 | Ubah Harga | Photographer | Fitur Include/Extend |
| 47 | EXT-19 | Arsip Foto | Photographer | Fitur Include/Extend |
| 48 | EXT-20 | Hapus Foto | Photographer | Fitur Include/Extend |
| 49 | EXT-21 | Pilih Kategori | Photographer | Fitur Include/Extend |
| 50 | EXT-22 | Highlight dari Notifikasi | Sistem Pendukung | Fitur Include/Extend |
| 51 | EXT-23 | Tandai Dibaca | Photographer | Fitur Include/Extend |
| 52 | EXT-24 | Validasi Saldo | Sistem Pendukung | Fitur Include/Extend |
| 53 | EXT-25 | Setujui Photographer | Admin | Fitur Include/Extend |
| 54 | EXT-26 | Tolak Photographer | Admin | Fitur Include/Extend |
| 55 | EXT-27 | Blokir Photographer | Admin | Fitur Include/Extend |
| 56 | EXT-28 | Buka Blokir Photographer | Admin | Fitur Include/Extend |
| 57 | EXT-29 | Upload Cover Event | Admin | Fitur Include/Extend |
| 58 | EXT-30 | Setujui Withdrawal | Admin | Fitur Include/Extend |
| 59 | EXT-31 | Tolak Withdrawal | Admin | Fitur Include/Extend |
| 60 | EXT-32 | Nonaktifkan Foto | Admin | Fitur Include/Extend |

## Use Case Runner

### Tabel 1 Deskripsi Use Case - Registrasi/Login Runner

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Registrasi/Login Runner |
| ID Use Case | RUN-01 |
| Aktor Primer | Runner |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner membuat akun atau masuk ke sistem. |
| Trigger | Runner membuka form registrasi/login lalu mengirim data. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | - |
| Relasi - Extend | Edit Profil, Logout |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Registrasi/Login Runner.
2. Runner membuka form registrasi/login lalu mengirim data.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Edit Profil, Logout.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: akun/sesi tersedia. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 2 Deskripsi Use Case - Melihat Event

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Melihat Event |
| ID Use Case | RUN-02 |
| Aktor Primer | Runner |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner melihat daftar dan detail event. |
| Trigger | Runner membuka menu Melihat Event. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | RUN-01 |
| Relasi - Extend | Filter Event |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Melihat Event.
2. Runner membuka menu Melihat Event.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: RUN-01.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Proses include dijalankan: RUN-01.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Filter Event.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 3 Deskripsi Use Case - Mencari Foto dengan Selfie

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Mencari Foto dengan Selfie |
| ID Use Case | RUN-03 |
| Aktor Primer | Runner |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | Storage S3/R2 |
| Deskripsi Singkat | Runner mencari foto dirinya menggunakan selfie. |
| Trigger | Runner mengirim data pencarian. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | RUN-02, Upload Selfie, AI Face Search |
| Relasi - Extend | Filter Kategori, Lihat Hasil Search |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Mencari Foto dengan Selfie.
2. Runner mengirim data pencarian.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: RUN-02, Upload Selfie, AI Face Search.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Proses include dijalankan: RUN-02, Upload Selfie, AI Face Search.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Filter Kategori, Lihat Hasil Search.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 4 Deskripsi Use Case - Melihat Hasil Search

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Melihat Hasil Search |
| ID Use Case | RUN-04 |
| Aktor Primer | Runner |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner melihat foto yang cocok dari hasil pencarian. |
| Trigger | Runner membuka menu Melihat Hasil Search. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | RUN-03 |
| Relasi - Extend | Tambah ke Keranjang |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Melihat Hasil Search.
2. Runner membuka menu Melihat Hasil Search.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: RUN-03.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Proses include dijalankan: RUN-03.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Tambah ke Keranjang.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 5 Deskripsi Use Case - Mengelola Keranjang

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Mengelola Keranjang |
| ID Use Case | RUN-05 |
| Aktor Primer | Runner |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner melihat dan menghapus foto di keranjang. |
| Trigger | Runner memilih fitur Mengelola Keranjang. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | RUN-04 |
| Relasi - Extend | Checkout |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Mengelola Keranjang.
2. Runner memilih fitur Mengelola Keranjang.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: RUN-04.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Proses include dijalankan: RUN-04.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Checkout.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 6 Deskripsi Use Case - Checkout Foto

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Checkout Foto |
| ID Use Case | RUN-06 |
| Aktor Primer | Runner |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner membuat pesanan dari isi keranjang. |
| Trigger | Runner menekan tombol checkout. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | RUN-05, Hitung Total, Buat Order |
| Relasi - Extend | Bayar Pakasir |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Checkout Foto.
2. Runner menekan tombol checkout.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: RUN-05, Hitung Total, Buat Order.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Proses include dijalankan: RUN-05, Hitung Total, Buat Order.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Bayar Pakasir.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 7 Deskripsi Use Case - Membayar Pesanan

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Membayar Pesanan |
| ID Use Case | RUN-07 |
| Aktor Primer | Runner |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner membuka link pembayaran Pakasir. |
| Trigger | Runner menekan tombol bayar atau sistem memproses pembayaran. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | RUN-06, Pakasir |
| Relasi - Extend | Cek Status Pembayaran |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Membayar Pesanan.
2. Runner menekan tombol bayar atau sistem memproses pembayaran.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: RUN-06, Pakasir.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Proses include dijalankan: RUN-06, Pakasir.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Cek Status Pembayaran.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: pembayaran diproses/diarahkan. Gagal: sistem menampilkan error pembayaran.

### Tabel 8 Deskripsi Use Case - Melihat Riwayat Pesanan

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Melihat Riwayat Pesanan |
| ID Use Case | RUN-08 |
| Aktor Primer | Runner |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner melihat pesanan yang pernah dibuat. |
| Trigger | Runner membuka menu Melihat Riwayat Pesanan. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | RUN-01 |
| Relasi - Extend | Lihat Detail Pesanan |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Melihat Riwayat Pesanan.
2. Runner membuka menu Melihat Riwayat Pesanan.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: RUN-01.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Proses include dijalankan: RUN-01.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Lihat Detail Pesanan.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 9 Deskripsi Use Case - Melihat Detail Pesanan

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Melihat Detail Pesanan |
| ID Use Case | RUN-09 |
| Aktor Primer | Runner |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner melihat item, total, dan status pesanan. |
| Trigger | Runner membuka menu Melihat Detail Pesanan. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | RUN-08 |
| Relasi - Extend | Bayar Ulang, Download Foto |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Melihat Detail Pesanan.
2. Runner membuka menu Melihat Detail Pesanan.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: RUN-08.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Proses include dijalankan: RUN-08.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Bayar Ulang, Download Foto.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 10 Deskripsi Use Case - Download Foto Original

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Download Foto Original |
| ID Use Case | RUN-10 |
| Aktor Primer | Runner |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner mengunduh foto original setelah pembayaran berhasil. |
| Trigger | Runner menekan tombol download. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | RUN-09, Order Paid, Storage S3/R2 |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Download Foto Original.
2. Runner menekan tombol download.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: RUN-09, Order Paid, Storage S3/R2.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Proses include dijalankan: RUN-09, Order Paid, Storage S3/R2.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: file foto original terunduh. Gagal: akses download ditolak atau file tidak tersedia.

## Use Case Photographer

### Tabel 11 Deskripsi Use Case - Registrasi/Login Photographer

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Registrasi/Login Photographer |
| ID Use Case | PHT-01 |
| Aktor Primer | Photographer |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer membuat akun atau masuk ke sistem. |
| Trigger | Photographer membuka form registrasi/login lalu mengirim data. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | Upload KTP |
| Relasi - Extend | Menunggu Verifikasi, Logout |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Registrasi/Login Photographer.
2. Photographer membuka form registrasi/login lalu mengirim data.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: Upload KTP.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Proses include dijalankan: Upload KTP.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Menunggu Verifikasi, Logout.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: akun/sesi tersedia. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 12 Deskripsi Use Case - Menunggu Verifikasi

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Menunggu Verifikasi |
| ID Use Case | PHT-02 |
| Aktor Primer | Photographer |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer menunggu persetujuan admin sebelum dapat upload foto. |
| Trigger | Photographer memilih fitur Menunggu Verifikasi. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | PHT-01 |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Menunggu Verifikasi.
2. Photographer memilih fitur Menunggu Verifikasi.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: PHT-01.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Proses include dijalankan: PHT-01.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 13 Deskripsi Use Case - Mengelola Portfolio

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Mengelola Portfolio |
| ID Use Case | PHT-03 |
| Aktor Primer | Photographer |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer melihat daftar foto miliknya. |
| Trigger | Photographer memilih fitur Mengelola Portfolio. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | PHT-01, Status Verified |
| Relasi - Extend | Upload Foto, Ubah Harga, Arsip Foto, Hapus Foto |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Mengelola Portfolio.
2. Photographer memilih fitur Mengelola Portfolio.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: PHT-01, Status Verified.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Proses include dijalankan: PHT-01, Status Verified.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Upload Foto, Ubah Harga, Arsip Foto, Hapus Foto.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 14 Deskripsi Use Case - Upload Foto

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Upload Foto |
| ID Use Case | PHT-04 |
| Aktor Primer | Photographer |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer mengunggah foto event/lomba. |
| Trigger | Photographer memilih file lalu menekan tombol upload/simpan. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | PHT-03, Storage S3/R2, AI Face Search |
| Relasi - Extend | Pilih Kategori |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Upload Foto.
2. Photographer memilih file lalu menekan tombol upload/simpan.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: PHT-03, Storage S3/R2, AI Face Search.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Proses include dijalankan: PHT-03, Storage S3/R2, AI Face Search.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Pilih Kategori.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: file tersimpan. Gagal: sistem menampilkan error upload.

### Tabel 15 Deskripsi Use Case - Mengelola Harga Foto

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Mengelola Harga Foto |
| ID Use Case | PHT-05 |
| Aktor Primer | Photographer |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer mengubah harga foto miliknya. |
| Trigger | Photographer memilih fitur Mengelola Harga Foto. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | PHT-03 |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Mengelola Harga Foto.
2. Photographer memilih fitur Mengelola Harga Foto.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: PHT-03.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Proses include dijalankan: PHT-03.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 16 Deskripsi Use Case - Mengarsipkan/Menghapus Foto

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Mengarsipkan/Menghapus Foto |
| ID Use Case | PHT-06 |
| Aktor Primer | Photographer |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer mengarsipkan atau menghapus foto miliknya. |
| Trigger | Photographer memilih fitur Mengarsipkan/Menghapus Foto. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | PHT-03 |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Mengarsipkan/Menghapus Foto.
2. Photographer memilih fitur Mengarsipkan/Menghapus Foto.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: PHT-03.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Proses include dijalankan: PHT-03.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 17 Deskripsi Use Case - Melihat Riwayat Penjualan

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Melihat Riwayat Penjualan |
| ID Use Case | PHT-07 |
| Aktor Primer | Photographer |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer melihat foto yang terjual dan pendapatannya. |
| Trigger | Photographer membuka menu Melihat Riwayat Penjualan. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | PHT-01, Status Verified |
| Relasi - Extend | Highlight dari Notifikasi |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Melihat Riwayat Penjualan.
2. Photographer membuka menu Melihat Riwayat Penjualan.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: PHT-01, Status Verified.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Proses include dijalankan: PHT-01, Status Verified.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Highlight dari Notifikasi.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 18 Deskripsi Use Case - Melihat Notifikasi Penjualan

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Melihat Notifikasi Penjualan |
| ID Use Case | PHT-08 |
| Aktor Primer | Photographer |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer melihat notifikasi saat fotonya terjual. |
| Trigger | Photographer membuka menu Melihat Notifikasi Penjualan. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | PHT-07 |
| Relasi - Extend | Tandai Dibaca |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Melihat Notifikasi Penjualan.
2. Photographer membuka menu Melihat Notifikasi Penjualan.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: PHT-07.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Proses include dijalankan: PHT-07.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Tandai Dibaca.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 19 Deskripsi Use Case - Melihat Saldo

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Melihat Saldo |
| ID Use Case | PHT-09 |
| Aktor Primer | Photographer |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer melihat saldo dari penjualan. |
| Trigger | Photographer membuka menu Melihat Saldo. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | PHT-07 |
| Relasi - Extend | Ajukan Withdrawal |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Melihat Saldo.
2. Photographer membuka menu Melihat Saldo.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: PHT-07.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Proses include dijalankan: PHT-07.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Ajukan Withdrawal.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 20 Deskripsi Use Case - Mengajukan Withdrawal

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Mengajukan Withdrawal |
| ID Use Case | PHT-10 |
| Aktor Primer | Photographer |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer mengajukan pencairan saldo. |
| Trigger | Photographer memilih fitur Mengajukan Withdrawal. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | PHT-09, Validasi Saldo |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Mengajukan Withdrawal.
2. Photographer memilih fitur Mengajukan Withdrawal.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: PHT-09, Validasi Saldo.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Proses include dijalankan: PHT-09, Validasi Saldo.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: data withdrawal diproses. Gagal: sistem menampilkan error saldo/status.

## Use Case Admin

### Tabel 21 Deskripsi Use Case - Login Admin

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Login Admin |
| ID Use Case | ADM-01 |
| Aktor Primer | Admin |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin masuk ke panel pengelolaan. |
| Trigger | Admin membuka form registrasi/login lalu mengirim data. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | - |
| Relasi - Extend | Logout |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Login Admin.
2. Admin membuka form registrasi/login lalu mengirim data.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Logout.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: akun/sesi tersedia. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 22 Deskripsi Use Case - Mengelola Verifikasi Photographer

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Mengelola Verifikasi Photographer |
| ID Use Case | ADM-02 |
| Aktor Primer | Admin |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin melihat dan memproses fotografer pending. |
| Trigger | Admin memilih fitur Mengelola Verifikasi Photographer. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | ADM-01 |
| Relasi - Extend | Setujui Photographer, Tolak Photographer |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Mengelola Verifikasi Photographer.
2. Admin memilih fitur Mengelola Verifikasi Photographer.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: ADM-01.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Proses include dijalankan: ADM-01.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Setujui Photographer, Tolak Photographer.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 23 Deskripsi Use Case - Mengelola Status Photographer

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Mengelola Status Photographer |
| ID Use Case | ADM-03 |
| Aktor Primer | Admin |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin mengatur status fotografer. |
| Trigger | Admin memilih fitur Mengelola Status Photographer. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | ADM-01 |
| Relasi - Extend | Blokir Photographer, Buka Blokir Photographer |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Mengelola Status Photographer.
2. Admin memilih fitur Mengelola Status Photographer.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: ADM-01.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Proses include dijalankan: ADM-01.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Blokir Photographer, Buka Blokir Photographer.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 24 Deskripsi Use Case - Mengelola Event

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Mengelola Event |
| ID Use Case | ADM-04 |
| Aktor Primer | Admin |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin membuat, mengubah, dan menghapus/menonaktifkan event. |
| Trigger | Admin memilih fitur Mengelola Event. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | ADM-01 |
| Relasi - Extend | Upload Cover Event |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Mengelola Event.
2. Admin memilih fitur Mengelola Event.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: ADM-01.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Proses include dijalankan: ADM-01.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Upload Cover Event.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 25 Deskripsi Use Case - Mengelola Withdrawal

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Mengelola Withdrawal |
| ID Use Case | ADM-05 |
| Aktor Primer | Admin |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin memproses pengajuan pencairan saldo fotografer. |
| Trigger | Admin memilih fitur Mengelola Withdrawal. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | ADM-01 |
| Relasi - Extend | Setujui Withdrawal, Tolak Withdrawal |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Mengelola Withdrawal.
2. Admin memilih fitur Mengelola Withdrawal.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: ADM-01.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Proses include dijalankan: ADM-01.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Setujui Withdrawal, Tolak Withdrawal.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: data withdrawal diproses. Gagal: sistem menampilkan error saldo/status.

### Tabel 26 Deskripsi Use Case - Moderasi Foto

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Moderasi Foto |
| ID Use Case | ADM-06 |
| Aktor Primer | Admin |
| Tipe Use Case | Essential (Utama) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin memeriksa dan mengatur status foto. |
| Trigger | Admin memilih fitur Moderasi Foto. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | ADM-01 |
| Relasi - Extend | Nonaktifkan Foto |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Moderasi Foto.
2. Admin memilih fitur Moderasi Foto.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: ADM-01.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Proses include dijalankan: ADM-01.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika kondisi terpenuhi, sistem menjalankan fitur tambahan: Nonaktifkan Foto.
2. Jika data tidak valid, sistem menampilkan pesan error.
3. Jika aktor tidak memiliki hak akses, sistem menolak proses.
4. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 27 Deskripsi Use Case - Mengelola User

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Mengelola User |
| ID Use Case | ADM-07 |
| Aktor Primer | Admin |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin melihat/mengelola data pengguna. |
| Trigger | Admin memilih fitur Mengelola User. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | ADM-01 |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Mengelola User.
2. Admin memilih fitur Mengelola User.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: ADM-01.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Proses include dijalankan: ADM-01.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 28 Deskripsi Use Case - Melihat Statistik Sistem

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Melihat Statistik Sistem |
| ID Use Case | ADM-08 |
| Aktor Primer | Admin |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin melihat ringkasan data sistem. |
| Trigger | Admin membuka menu Melihat Statistik Sistem. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | ADM-01 |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Melihat Statistik Sistem.
2. Admin membuka menu Melihat Statistik Sistem.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem menjalankan proses wajib: ADM-01.
5. Sistem memproses data sesuai aturan bisnis KeJepret.
6. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
7. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Proses include dijalankan: ADM-01.
2. Jika proses include gagal, sistem menghentikan proses utama dan menampilkan pesan error.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

## Use Case Sistem Pendukung

### Tabel 29 Deskripsi Use Case - Edit Profil

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Edit Profil |
| ID Use Case | EXT-01 |
| Aktor Primer | Runner/Photographer |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Aktor memperbarui data profil akunnya pada sistem. |
| Trigger | Aktor memilih fitur Edit Profil. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner/Photographer |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Aktor sudah memiliki sesi sesuai role masing-masing. |

**Alur Normal:**
1. Aktor memulai fitur Edit Profil.
2. Aktor memilih fitur Edit Profil.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Aktor.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 30 Deskripsi Use Case - Logout

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Logout |
| ID Use Case | EXT-02 |
| Aktor Primer | Runner/Photographer/Admin |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Aktor keluar dari sistem dan sesi login dihapus. |
| Trigger | Aktor memilih fitur Logout. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner/Photographer/Admin |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Aktor sudah memiliki sesi sesuai role masing-masing. |

**Alur Normal:**
1. Aktor memulai fitur Logout.
2. Aktor memilih fitur Logout.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Aktor.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

## Use Case Runner

### Tabel 31 Deskripsi Use Case - Filter Event

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Filter Event |
| ID Use Case | EXT-03 |
| Aktor Primer | Runner |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner menyaring daftar event agar lebih mudah menemukan event yang sesuai. |
| Trigger | Runner memilih fitur Filter Event. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Filter Event.
2. Runner memilih fitur Filter Event.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 32 Deskripsi Use Case - Upload Selfie

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Upload Selfie |
| ID Use Case | EXT-04 |
| Aktor Primer | Runner |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | Storage S3/R2 |
| Deskripsi Singkat | Runner mengunggah atau mengambil selfie sebagai input pencarian foto. |
| Trigger | Runner memilih file lalu menekan tombol upload/simpan. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Upload Selfie.
2. Runner memilih file lalu menekan tombol upload/simpan.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: file tersimpan. Gagal: sistem menampilkan error upload.

## Use Case Sistem Pendukung

### Tabel 33 Deskripsi Use Case - AI Face Search

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | AI Face Search |
| ID Use Case | EXT-05 |
| Aktor Primer | Sistem Pendukung |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | AI Face Search |
| Deskripsi Singkat | Sistem AI memproses selfie/foto untuk mencari kecocokan wajah atau membuat embedding. |
| Trigger | Sistem Pendukung mengirim data pencarian. |
| Tipe | Internal |
| Relasi - Asosiasi | Sistem Pendukung |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Use case pemicu sudah berjalan dan data yang dibutuhkan tersedia. |

**Alur Normal:**
1. Sistem Pendukung memulai fitur AI Face Search.
2. Sistem Pendukung mengirim data pencarian.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Sistem Pendukung.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

## Use Case Runner

### Tabel 34 Deskripsi Use Case - Filter Kategori

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Filter Kategori |
| ID Use Case | EXT-06 |
| Aktor Primer | Runner |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner memilih kategori foto sebagai filter opsional saat mencari foto. |
| Trigger | Runner memilih fitur Filter Kategori. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Filter Kategori.
2. Runner memilih fitur Filter Kategori.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 35 Deskripsi Use Case - Lihat Hasil Search

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Lihat Hasil Search |
| ID Use Case | EXT-07 |
| Aktor Primer | Runner |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner melihat hasil pencarian foto berdasarkan selfie. |
| Trigger | Runner membuka menu Lihat Hasil Search. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Lihat Hasil Search.
2. Runner membuka menu Lihat Hasil Search.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 36 Deskripsi Use Case - Tambah ke Keranjang

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Tambah ke Keranjang |
| ID Use Case | EXT-08 |
| Aktor Primer | Runner |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner memasukkan foto yang dipilih ke keranjang belanja. |
| Trigger | Runner memilih fitur Tambah ke Keranjang. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Tambah ke Keranjang.
2. Runner memilih fitur Tambah ke Keranjang.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

## Use Case Sistem Pendukung

### Tabel 37 Deskripsi Use Case - Hitung Total

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Hitung Total |
| ID Use Case | EXT-09 |
| Aktor Primer | Sistem Pendukung |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | Sistem Internal KeJepret |
| Deskripsi Singkat | Sistem menghitung total harga foto yang akan dibeli. |
| Trigger | Sistem Pendukung memilih fitur Hitung Total. |
| Tipe | Internal |
| Relasi - Asosiasi | Sistem Pendukung |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Use case pemicu sudah berjalan dan data yang dibutuhkan tersedia. |

**Alur Normal:**
1. Sistem Pendukung memulai fitur Hitung Total.
2. Sistem Pendukung memilih fitur Hitung Total.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Sistem Pendukung.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 38 Deskripsi Use Case - Buat Order

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Buat Order |
| ID Use Case | EXT-10 |
| Aktor Primer | Sistem Pendukung |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | Sistem Internal KeJepret |
| Deskripsi Singkat | Sistem membuat data pesanan dari keranjang runner. |
| Trigger | Sistem Pendukung memilih fitur Buat Order. |
| Tipe | Internal |
| Relasi - Asosiasi | Sistem Pendukung |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Use case pemicu sudah berjalan dan data yang dibutuhkan tersedia. |

**Alur Normal:**
1. Sistem Pendukung memulai fitur Buat Order.
2. Sistem Pendukung memilih fitur Buat Order.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Sistem Pendukung.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 39 Deskripsi Use Case - Pakasir

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Pakasir |
| ID Use Case | EXT-11 |
| Aktor Primer | Sistem Pendukung |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | Pakasir |
| Deskripsi Singkat | Payment gateway Pakasir memproses pembayaran pesanan. |
| Trigger | Sistem Pendukung menekan tombol bayar atau sistem memproses pembayaran. |
| Tipe | Internal |
| Relasi - Asosiasi | Sistem Pendukung |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Use case pemicu sudah berjalan dan data yang dibutuhkan tersedia. |

**Alur Normal:**
1. Sistem Pendukung memulai fitur Pakasir.
2. Sistem Pendukung menekan tombol bayar atau sistem memproses pembayaran.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Sistem Pendukung.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: pembayaran diproses/diarahkan. Gagal: sistem menampilkan error pembayaran.

## Use Case Runner

### Tabel 40 Deskripsi Use Case - Cek Status Pembayaran

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Cek Status Pembayaran |
| ID Use Case | EXT-12 |
| Aktor Primer | Runner |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner atau sistem memeriksa status pembayaran pesanan. |
| Trigger | Runner menekan tombol bayar atau sistem memproses pembayaran. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Cek Status Pembayaran.
2. Runner menekan tombol bayar atau sistem memproses pembayaran.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: pembayaran diproses/diarahkan. Gagal: sistem menampilkan error pembayaran.

### Tabel 41 Deskripsi Use Case - Bayar Ulang

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Bayar Ulang |
| ID Use Case | EXT-13 |
| Aktor Primer | Runner |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Runner membuka kembali link pembayaran untuk pesanan yang masih pending. |
| Trigger | Runner menekan tombol bayar atau sistem memproses pembayaran. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Runner |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Runner sudah memiliki akun/sesi sesuai kebutuhan fitur. |

**Alur Normal:**
1. Runner memulai fitur Bayar Ulang.
2. Runner menekan tombol bayar atau sistem memproses pembayaran.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Runner.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: pembayaran diproses/diarahkan. Gagal: sistem menampilkan error pembayaran.

## Use Case Sistem Pendukung

### Tabel 42 Deskripsi Use Case - Order Paid

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Order Paid |
| ID Use Case | EXT-14 |
| Aktor Primer | Sistem Pendukung |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | Sistem Internal KeJepret |
| Deskripsi Singkat | Sistem memastikan status pesanan sudah paid sebelum akses download diberikan. |
| Trigger | Sistem Pendukung memilih fitur Order Paid. |
| Tipe | Internal |
| Relasi - Asosiasi | Sistem Pendukung |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Use case pemicu sudah berjalan dan data yang dibutuhkan tersedia. |

**Alur Normal:**
1. Sistem Pendukung memulai fitur Order Paid.
2. Sistem Pendukung memilih fitur Order Paid.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Sistem Pendukung.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 43 Deskripsi Use Case - Storage S3/R2

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Storage S3/R2 |
| ID Use Case | EXT-15 |
| Aktor Primer | Sistem Pendukung |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | Storage S3/R2 |
| Deskripsi Singkat | Storage menyimpan dan menyediakan file foto, watermark, selfie, dokumen, atau cover. |
| Trigger | Sistem Pendukung memilih fitur Storage S3/R2. |
| Tipe | Internal |
| Relasi - Asosiasi | Sistem Pendukung |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Use case pemicu sudah berjalan dan data yang dibutuhkan tersedia. |

**Alur Normal:**
1. Sistem Pendukung memulai fitur Storage S3/R2.
2. Sistem Pendukung memilih fitur Storage S3/R2.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Sistem Pendukung.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

## Use Case Photographer

### Tabel 44 Deskripsi Use Case - Upload KTP

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Upload KTP |
| ID Use Case | EXT-16 |
| Aktor Primer | Photographer |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | Storage S3/R2 |
| Deskripsi Singkat | Photographer mengunggah KTP sebagai dokumen verifikasi akun. |
| Trigger | Photographer memilih file lalu menekan tombol upload/simpan. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Upload KTP.
2. Photographer memilih file lalu menekan tombol upload/simpan.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: file tersimpan. Gagal: sistem menampilkan error upload.

## Use Case Sistem Pendukung

### Tabel 45 Deskripsi Use Case - Status Verified

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Status Verified |
| ID Use Case | EXT-17 |
| Aktor Primer | Sistem Pendukung |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | Sistem Internal KeJepret |
| Deskripsi Singkat | Sistem memastikan photographer sudah berstatus verified. |
| Trigger | Sistem Pendukung memilih fitur Status Verified. |
| Tipe | Internal |
| Relasi - Asosiasi | Sistem Pendukung |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Use case pemicu sudah berjalan dan data yang dibutuhkan tersedia. |

**Alur Normal:**
1. Sistem Pendukung memulai fitur Status Verified.
2. Sistem Pendukung memilih fitur Status Verified.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Sistem Pendukung.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

## Use Case Photographer

### Tabel 46 Deskripsi Use Case - Ubah Harga

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Ubah Harga |
| ID Use Case | EXT-18 |
| Aktor Primer | Photographer |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer memperbarui harga foto miliknya. |
| Trigger | Photographer memilih fitur Ubah Harga. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Ubah Harga.
2. Photographer memilih fitur Ubah Harga.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 47 Deskripsi Use Case - Arsip Foto

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Arsip Foto |
| ID Use Case | EXT-19 |
| Aktor Primer | Photographer |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer mengarsipkan foto agar tidak aktif dijual. |
| Trigger | Photographer memilih fitur Arsip Foto. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Arsip Foto.
2. Photographer memilih fitur Arsip Foto.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 48 Deskripsi Use Case - Hapus Foto

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Hapus Foto |
| ID Use Case | EXT-20 |
| Aktor Primer | Photographer |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer menghapus foto miliknya sesuai aturan sistem. |
| Trigger | Photographer memilih fitur Hapus Foto. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Hapus Foto.
2. Photographer memilih fitur Hapus Foto.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

### Tabel 49 Deskripsi Use Case - Pilih Kategori

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Pilih Kategori |
| ID Use Case | EXT-21 |
| Aktor Primer | Photographer |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer memilih kategori foto saat upload; jika kosong sistem memakai kategori Umum. |
| Trigger | Photographer memilih fitur Pilih Kategori. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Pilih Kategori.
2. Photographer memilih fitur Pilih Kategori.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

## Use Case Sistem Pendukung

### Tabel 50 Deskripsi Use Case - Highlight dari Notifikasi

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Highlight dari Notifikasi |
| ID Use Case | EXT-22 |
| Aktor Primer | Sistem Pendukung |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | Sistem Internal KeJepret |
| Deskripsi Singkat | Sistem menyorot item penjualan yang dibuka dari notifikasi. |
| Trigger | Sistem Pendukung memilih fitur Highlight dari Notifikasi. |
| Tipe | Internal |
| Relasi - Asosiasi | Sistem Pendukung |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Use case pemicu sudah berjalan dan data yang dibutuhkan tersedia. |

**Alur Normal:**
1. Sistem Pendukung memulai fitur Highlight dari Notifikasi.
2. Sistem Pendukung memilih fitur Highlight dari Notifikasi.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Sistem Pendukung.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

## Use Case Photographer

### Tabel 51 Deskripsi Use Case - Tandai Dibaca

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Tandai Dibaca |
| ID Use Case | EXT-23 |
| Aktor Primer | Photographer |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Photographer menandai notifikasi penjualan sebagai sudah dibaca. |
| Trigger | Photographer memilih fitur Tandai Dibaca. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Photographer |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Photographer memiliki akun dan status akses sesuai fitur yang digunakan. |

**Alur Normal:**
1. Photographer memulai fitur Tandai Dibaca.
2. Photographer memilih fitur Tandai Dibaca.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Photographer.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

## Use Case Sistem Pendukung

### Tabel 52 Deskripsi Use Case - Validasi Saldo

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Validasi Saldo |
| ID Use Case | EXT-24 |
| Aktor Primer | Sistem Pendukung |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | Sistem Internal KeJepret |
| Deskripsi Singkat | Sistem memastikan saldo photographer mencukupi sebelum withdrawal dibuat. |
| Trigger | Sistem Pendukung memilih fitur Validasi Saldo. |
| Tipe | Internal |
| Relasi - Asosiasi | Sistem Pendukung |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Use case pemicu sudah berjalan dan data yang dibutuhkan tersedia. |

**Alur Normal:**
1. Sistem Pendukung memulai fitur Validasi Saldo.
2. Sistem Pendukung memilih fitur Validasi Saldo.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Sistem Pendukung.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: sistem menampilkan atau menyimpan hasil proses. Gagal: sistem menampilkan pesan kesalahan.

## Use Case Admin

### Tabel 53 Deskripsi Use Case - Setujui Photographer

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Setujui Photographer |
| ID Use Case | EXT-25 |
| Aktor Primer | Admin |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin menyetujui pendaftaran photographer. |
| Trigger | Admin memilih aksi Setujui Photographer. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Setujui Photographer.
2. Admin memilih aksi Setujui Photographer.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: status data berubah sesuai aksi admin. Gagal: sistem menampilkan error.

### Tabel 54 Deskripsi Use Case - Tolak Photographer

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Tolak Photographer |
| ID Use Case | EXT-26 |
| Aktor Primer | Admin |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin menolak pendaftaran photographer. |
| Trigger | Admin memilih aksi Tolak Photographer. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Tolak Photographer.
2. Admin memilih aksi Tolak Photographer.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: status data berubah sesuai aksi admin. Gagal: sistem menampilkan error.

### Tabel 55 Deskripsi Use Case - Blokir Photographer

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Blokir Photographer |
| ID Use Case | EXT-27 |
| Aktor Primer | Admin |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin memblokir photographer agar tidak dapat memakai fitur utama. |
| Trigger | Admin memilih aksi Blokir Photographer. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Blokir Photographer.
2. Admin memilih aksi Blokir Photographer.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: status data berubah sesuai aksi admin. Gagal: sistem menampilkan error.

### Tabel 56 Deskripsi Use Case - Buka Blokir Photographer

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Buka Blokir Photographer |
| ID Use Case | EXT-28 |
| Aktor Primer | Admin |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin membuka blokir photographer. |
| Trigger | Admin memilih aksi Buka Blokir Photographer. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Buka Blokir Photographer.
2. Admin memilih aksi Buka Blokir Photographer.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: status data berubah sesuai aksi admin. Gagal: sistem menampilkan error.

### Tabel 57 Deskripsi Use Case - Upload Cover Event

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Upload Cover Event |
| ID Use Case | EXT-29 |
| Aktor Primer | Admin |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | Storage S3/R2 |
| Deskripsi Singkat | Admin mengunggah cover event. |
| Trigger | Admin memilih file lalu menekan tombol upload/simpan. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Upload Cover Event.
2. Admin memilih file lalu menekan tombol upload/simpan.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: file tersimpan. Gagal: sistem menampilkan error upload.

### Tabel 58 Deskripsi Use Case - Setujui Withdrawal

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Setujui Withdrawal |
| ID Use Case | EXT-30 |
| Aktor Primer | Admin |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin menyetujui pengajuan withdrawal. |
| Trigger | Admin memilih aksi Setujui Withdrawal. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Setujui Withdrawal.
2. Admin memilih aksi Setujui Withdrawal.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: data withdrawal diproses. Gagal: sistem menampilkan error saldo/status.

### Tabel 59 Deskripsi Use Case - Tolak Withdrawal

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Tolak Withdrawal |
| ID Use Case | EXT-31 |
| Aktor Primer | Admin |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin menolak pengajuan withdrawal. |
| Trigger | Admin memilih aksi Tolak Withdrawal. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Tolak Withdrawal.
2. Admin memilih aksi Tolak Withdrawal.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: data withdrawal diproses. Gagal: sistem menampilkan error saldo/status.

### Tabel 60 Deskripsi Use Case - Nonaktifkan Foto

| Elemen | Keterangan |
| --- | --- |
| Nama Use Case | Nonaktifkan Foto |
| ID Use Case | EXT-32 |
| Aktor Primer | Admin |
| Tipe Use Case | Supporting (Pendukung) |
| Aktor Sekunder | - |
| Deskripsi Singkat | Admin menonaktifkan foto yang tidak layak atau bermasalah. |
| Trigger | Admin memilih aksi Nonaktifkan Foto. |
| Tipe | Eksternal |
| Relasi - Asosiasi | Admin |
| Relasi - Include | - |
| Relasi - Extend | - |
| Relasi - Generalisasi | - |
| Pre Kondisi | Admin sudah masuk ke panel pengelolaan sistem. |

**Alur Normal:**
1. Admin memulai fitur Nonaktifkan Foto.
2. Admin memilih aksi Nonaktifkan Foto.
3. Sistem menerima permintaan dan memeriksa data yang dikirim.
4. Sistem memproses data sesuai aturan bisnis KeJepret.
5. Sistem menyimpan perubahan atau mengambil data yang dibutuhkan.
6. Sistem menampilkan hasil proses kepada Admin.

**Sub Alur:**
1. Tidak ada sub alur wajib khusus selain proses utama.

**Alur Alternatif:**
1. Jika data tidak valid, sistem menampilkan pesan error.
2. Jika aktor tidak memiliki hak akses, sistem menolak proses.
3. Jika data tidak ditemukan, sistem menampilkan pesan data tidak tersedia.

**Post Kondisi:** Sukses: status data berubah sesuai aksi admin. Gagal: sistem menampilkan error.
