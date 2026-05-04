# AGENTS.md

> Tujuan file ini: memberi instruksi permanen untuk Codex/AI coding agents agar bekerja konsisten di repository ini.
> Simpan file ini di root repository. Untuk aturan khusus folder, tambahkan `AGENTS.md` atau `AGENTS.override.md` di folder terkait.

---

## 0. Cara membaca instruksi ini

Instruksi ini berlaku untuk semua perubahan di repository ini, kecuali ada instruksi yang lebih spesifik di subfolder.

Prioritas:
1. Instruksi eksplisit dari user pada prompt saat ini.
2. `AGENTS.override.md` di folder kerja, jika ada.
3. `AGENTS.md` terdekat dari file yang dikerjakan.
4. `AGENTS.md` root repository ini.
5. Instruksi global user, jika ada.

Jika ada konflik, gunakan instruksi yang lebih spesifik dan jelaskan konfliknya di final response.

---

## 1. Bahasa dan gaya komunikasi

- Gunakan Bahasa Indonesia untuk penjelasan kepada user, kecuali user meminta bahasa lain.
- Untuk nama variable, function, class, commit, branch, dan komentar kode, ikuti bahasa/style yang sudah ada di codebase.
- Jawaban harus ringkas, teknis, dan actionable.
- Jangan terlalu percaya diri bila belum menjalankan test atau belum membaca file terkait.
- Selalu bedakan antara:
  - fakta dari codebase,
  - asumsi,
  - rekomendasi,
  - hal yang belum diverifikasi.
- Untuk task kompleks, mulai dengan rencana singkat sebelum mengubah file.
- Setelah selesai, berikan ringkasan:
  - file yang diubah,
  - alasan perubahan,
  - command verifikasi yang dijalankan,
  - hasil test/lint/build,
  - risiko atau follow-up.

---

## 2. Working agreement utama

Selalu ikuti prinsip ini:

- Pahami dulu konteks sebelum edit.
- Buat perubahan sekecil mungkin untuk menyelesaikan masalah.
- Ikuti pola existing di codebase.
- Jangan refactor besar kecuali diminta.
- Jangan ubah public API, schema database, contract API, atau format response kecuali diminta.
- Tambahkan atau update test bila mengubah behavior.
- Jalankan test yang paling relevan sebelum selesai.
- Review diff sendiri sebelum final.
- Berhenti dan jelaskan bila menemukan ambiguity, missing dependency, atau risiko besar.

---

## 3. Informasi project

### Ringkasan

- Nama project: `KeJepret`
- Tujuan project: marketplace foto event/lomba, tempat runner mencari foto dirinya dengan selfie/face search, memasukkan foto ke cart, checkout, membayar, lalu mengunduh foto original; fotografer mengunggah foto, mengatur harga, melihat penjualan, dan melakukan withdrawal; admin memverifikasi fotografer, event, foto, dan withdrawal.
- Tipe project: web app Laravel dengan web UI Blade, REST API, dan admin panel.
- Environment utama: PHP `^8.3`, Node.js untuk asset build.
- Package manager: Composer dan npm.
- Framework utama: Laravel `^12.0`, Filament `^5.0`, Laravel Sanctum `^4.3`, Vite, Tailwind CSS `^4.0`.
- Database: relational database via Laravel migrations; test memakai SQLite in-memory dari `phpunit.xml`. Database lokal/produksi mengikuti konfigurasi `.env`.
- Storage: disk `s3` Laravel untuk S3-compatible storage/Cloudflare R2; path foto memakai `AWS_URL`, `AWS_ENDPOINT`, `AWS_BUCKET`, dan credential terkait.
- Integrasi AI: service eksternal FastAPI/HTTP melalui `AI_BASE_URL` dan `AI_API_KEY` untuk enroll wajah runner, embed foto, dan search wajah.
- Runtime target: Laravel app server/PHP-FPM atau `php artisan serve` untuk lokal, plus Vite dev server saat development.
- Deployment target: belum terdokumentasi di repo; perlakukan sebagai Laravel production deployment sampai ada runbook resmi.

### Pemilik area

- Frontend: Blade views di `resources/views`, asset Vite/Tailwind di `resources/js` dan `resources/css`.
- Backend: Laravel controllers, middleware, models, routes, migrations, seeders, dan tests.
- Admin: Filament resources/pages/widgets di `app/Filament`.
- Infra/DevOps: belum ada owner atau runbook khusus di repo.
- Data/ML: AI face-search service eksternal; repo ini hanya memanggil endpoint HTTP dan menyimpan metadata/hasilnya.
- Security: auth Laravel/Sanctum, middleware role, photographer verification, banned user check, validasi upload, dan proteksi file download.
- Product/Design: flow runner, photographer, dan admin yang ada di Blade/Filament.

### Link penting

- Product spec: belum tersedia di repo.
- Architecture docs: belum tersedia di repo; gunakan `routes/web.php`, `routes/api.php`, migrations, dan controller terkait sebagai source of truth.
- API docs: belum tersedia di repo; route API ada di `routes/api.php`.
- Runbook: belum tersedia di repo.
- Issue tracker: belum tercatat di repo.
- Design file: belum tercatat di repo.
- Observability dashboard: belum tercatat di repo.
- Error tracking: belum tercatat di repo.
- CI/CD: belum ada workflow `.github/workflows` di repo saat instruksi ini dibuat.

---

## 4. Struktur repository

```text
.
├── app/
│   ├── Filament/          # admin panel: resources, pages, widgets
│   ├── Http/Controllers/  # controller Web dan Api
│   ├── Http/Middleware/   # role, photographer verified, banned checks
│   ├── Models/            # Eloquent models domain KeJepret
│   └── Providers/         # Laravel dan Filament providers
├── bootstrap/             # bootstrap Laravel 12 dan alias middleware
├── config/                # konfigurasi Laravel, filesystem, database, cache, dll.
├── database/
│   ├── migrations/        # schema users, events, photos, search, cart, orders, balances, withdrawals
│   ├── factories/         # factories test
│   └── seeders/           # seeders lokal/test
├── public/                # static assets
├── resources/
│   ├── views/             # Blade UI runner, photographer, auth, layout, partials
│   ├── css/               # Tailwind entry
│   └── js/                # Vite JS entry
├── routes/
│   ├── web.php            # web routes untuk guest, runner, photographer, admin
│   ├── api.php            # Sanctum API routes
│   └── console.php        # console routes
├── storage/               # runtime storage/log/cache lokal; jangan commit output runtime
├── tests/                 # PHPUnit Unit dan Feature tests
├── vendor/                # Composer dependencies; jangan edit manual
├── composer.json          # dependency dan script Laravel
├── package.json           # Vite/Tailwind scripts
├── phpunit.xml            # konfigurasi test
├── vite.config.js         # konfigurasi Vite Laravel plugin
└── AGENTS.md              # instruksi untuk Codex
```

### File/folder prioritas untuk dibaca

Saat memulai task, prioritaskan membaca:

1. File yang disebut user.
2. Test terkait.
3. Route terkait di `routes/web.php` atau `routes/api.php`.
4. Controller terkait di `app/Http/Controllers/Web` atau `app/Http/Controllers/Api`.
5. Model dan migration domain terkait di `app/Models` dan `database/migrations`.
6. Blade view atau Filament resource terkait bila perubahan UI/admin.
7. Middleware terkait bila perubahan menyentuh role/auth/verification/banned behavior.
8. Konfigurasi build/test/lint terkait.

### Folder yang boleh diedit

- `app/`: source Laravel, controllers, models, middleware, providers, Filament.
- `database/migrations/`: hanya migration baru untuk perubahan schema; jangan edit migration lama yang sudah dipakai.
- `database/factories/` dan `database/seeders/`: data test/dev, tanpa data produksi atau secret.
- `resources/views/`, `resources/css/`, `resources/js/`: UI Blade dan asset frontend.
- `routes/`: route web/API/console sesuai kebutuhan.
- `tests/`: PHPUnit unit/feature tests.
- `config/`: hanya bila perubahan konfigurasi memang diperlukan dan dampaknya dijelaskan.
- `public/assets/`: asset publik kecil yang dibutuhkan UI; hindari binary besar tanpa izin.

### Folder/file yang jangan diedit tanpa izin

- `.env`, `.env.*`, secret files.
- Lockfile: `package-lock.json`, `pnpm-lock.yaml`, `yarn.lock`, `poetry.lock`, `Cargo.lock`, kecuali perubahan dependency memang diminta.
- Generated files: `dist/`, `build/`, `coverage/`, `generated/`, `__generated__/`.
- Migration lama yang sudah pernah dijalankan.
- Vendor code: `vendor/`, third-party copied source.
- Runtime/cache/log files: `storage/logs/`, `storage/framework/`, `bootstrap/cache/`.
- File besar/binary tanpa instruksi eksplisit.
- Konfigurasi CI/CD produksi tanpa menjelaskan risiko.

---

## 5. Commands standar

Command berikut berasal dari `composer.json`, `package.json`, `phpunit.xml`, dan konvensi Laravel. Jangan menjalankan script tidak dikenal sebelum membaca isinya.

### Setup

```bash
# install dependencies
composer install
npm install

# copy env sample, jika file .env.example sudah tersedia
cp .env.example .env

# generate app key
php artisan key:generate

# run database migrations
php artisan migrate

# build frontend assets
npm run build

# project setup script dari composer.json
composer run setup
```

### Development

```bash
# run Laravel server, queue listener, log tail, dan Vite bersamaan
composer run dev

# run Laravel server saja
php artisan serve

# run Vite dev server saja
npm run dev

# run queue worker/listener saja
php artisan queue:listen --tries=1 --timeout=0

# tail Laravel logs dengan Pail
php artisan pail --timeout=0
```

### Test

```bash
# all tests
composer run test
php artisan test

# unit tests
php artisan test --testsuite=Unit

# integration tests
php artisan test --testsuite=Feature

# e2e tests
# belum ada e2e test di repo

# single test file
php artisan test tests/Feature/ExampleTest.php

# single test case
php artisan test --filter=ExampleTest
```

### Quality checks

```bash
# lint
./vendor/bin/pint --test

# format check
./vendor/bin/pint --test

# auto format PHP
./vendor/bin/pint

# build
npm run build

# security/dependency audit
composer audit
npm audit
```

### Database

```bash
# create migration
php artisan make:migration <nama_migration>

# run migration
php artisan migrate

# rollback migration
php artisan migrate:rollback

# seed database
php artisan db:seed
```

### Docker/local services

```bash
# start services
# belum ada docker-compose atau Docker config di repo

# stop services
# belum ada docker-compose atau Docker config di repo

# view logs
php artisan pail --timeout=0
```

---

## 6. Aturan menjalankan command

Sebelum menjalankan command:

- Jelaskan command yang akan dijalankan bila command berisiko.
- Gunakan command yang spesifik dan relevan; jangan langsung menjalankan seluruh suite bila perubahan kecil dan ada test terfokus.
- Jangan menjalankan command destruktif tanpa izin.
- Jangan menjalankan script tidak dikenal tanpa membaca isi script terlebih dahulu.
- Jika command gagal karena setup lokal, jelaskan error dan kemungkinan penyebabnya.

Command yang perlu izin eksplisit:

```bash
rm -rf ...
git reset --hard
git clean -fd
git push --force
git push --force-with-lease
dropdb ...
createdb ... # jika mengganti DB yang ada
docker system prune
kubectl delete ...
terraform apply
terraform destroy
npm publish
pnpm publish
yarn publish
pip upload
twine upload
```

Command yang sebaiknya dihindari:

```bash
git add .
git commit --all
chmod -R 777 .
sudo ...
curl ... | sh
wget ... | sh
```

---

## 7. Git workflow

- Jangan membuat commit kecuali user meminta.
- Jangan push kecuali user meminta.
- Jangan membuat branch kecuali user meminta.
- Sebelum final, jalankan `git diff` atau equivalent untuk review perubahan.
- Bila user meminta commit:
  - stage file secara selektif,
  - jangan pakai `git add .`,
  - buat commit kecil dan fokus,
  - gunakan pesan commit yang jelas.

### Format commit yang disarankan

Gunakan Conventional Commits bila project ini belum punya format lain:

```text
feat(scope): add user invite flow
fix(auth): handle expired refresh token
test(payments): cover refund validation
docs(api): update webhook example
refactor(ui): simplify modal state
chore(deps): update minor dependencies
```

---

## 8. Definition of Done

Sebuah task dianggap selesai bila:

- Requirement user terpenuhi.
- Perubahan minimal dan sesuai pola existing.
- Test relevan sudah ditambahkan/diupdate bila behavior berubah.
- Test/lint/typecheck relevan sudah dijalankan, atau alasan tidak menjalankan sudah dijelaskan.
- Tidak ada secret, debug log, atau perubahan unrelated.
- Diff sudah direview.
- Risiko dan follow-up disebutkan di final response.

Final response harus menyebutkan:

```text
Ringkasan:
- ...

Verifikasi:
- `command` -> hasil

Catatan/Risiko:
- ...
```

---

## 9. Prompt handling untuk Codex

Saat menerima task, lakukan langkah ini:

1. Identifikasi jenis task:
   - bug fix,
   - fitur,
   - refactor,
   - test,
   - review,
   - docs,
   - migration,
   - performance,
   - security.
2. Baca file yang paling relevan.
3. Cari test atau contoh existing.
4. Buat rencana singkat.
5. Implementasikan patch minimal.
6. Jalankan verifikasi.
7. Review diff.
8. Laporkan hasil.

Untuk task ambiguous:

- Jangan menebak perubahan besar.
- Pilih asumsi paling aman.
- Jelaskan asumsi di final response.
- Bila benar-benar blocking, tanyakan klarifikasi sebelum edit besar.

---

## 10. Code style umum

- Ikuti style existing lebih dulu daripada preferensi pribadi.
- Hindari perubahan formatting massal.
- Hindari rename file/symbol tanpa kebutuhan.
- Gunakan nama yang jelas dan searchable.
- Prefer explicitness di business logic.
- Hindari abstraction prematur.
- Hindari duplicate logic yang rawan drift; refactor kecil boleh bila mendukung task.
- Jangan menambahkan komentar yang hanya mengulang kode.
- Tambahkan komentar untuk:
  - business rule yang tidak obvious,
  - workaround,
  - edge case,
  - trade-off penting,
  - interaksi dengan sistem eksternal.

---

## 11. Dependency policy

Jangan menambah dependency baru kecuali:

- user meminta eksplisit, atau
- manfaatnya jelas,
- tidak ada solusi ringan di dependency existing,
- lisensi aman,
- ukuran/impact wajar,
- maintenance terlihat sehat,
- risiko security rendah.

Jika ingin menambah dependency, jelaskan:

- nama package,
- alasan,
- alternatif tanpa dependency,
- impact bundle/runtime,
- command install yang akan dijalankan.

Jangan upgrade dependency besar tanpa instruksi eksplisit.

---

## 12. Environment dan secret

- Jangan membaca, menampilkan, atau menyalin isi secret dari `.env` kecuali user meminta dan konteks aman.
- Jangan commit `.env`.
- Gunakan `.env.example` untuk dokumentasi variable.
- Jika menambah env var:
  - update `.env.example`,
  - update docs setup,
  - update validation/config schema,
  - jelaskan default dan requirement.
- Jangan hardcode API keys, tokens, password, private keys, atau credentials.
- Jangan log data sensitif.

Contoh data sensitif:

- token auth,
- session cookie,
- password,
- secret key,
- nomor kartu,
- PII seperti email/phone/address bila tidak perlu,
- internal IDs sensitif,
- medical/financial data.

---

## 13. Security rules

Selalu perhatikan:

- input validation,
- output encoding,
- authn/authz,
- access control per tenant/user,
- CSRF bila relevan,
- SSRF bila menerima URL,
- SQL injection,
- command injection,
- path traversal,
- unsafe deserialization,
- insecure randomness,
- leakage melalui logs/errors,
- dependency vulnerabilities.

Untuk endpoint/API baru:

- Validasi request body/query/params.
- Pastikan authorization explicit.
- Jangan percaya client-side checks.
- Tambahkan test untuk unauthorized/forbidden cases.
- Pastikan error message tidak membocorkan detail internal.

Untuk file upload:

- Validasi size.
- Validasi MIME/type dengan hati-hati.
- Jangan percaya filename.
- Hindari path traversal.
- Scan atau sandbox bila diperlukan.
- Simpan di storage yang sesuai.

Untuk crypto:

- Jangan membuat algoritma crypto sendiri.
- Gunakan library standar.
- Jangan log key/material.
- Gunakan constant-time compare untuk secret/token bila relevan.

---

## 14. Privacy dan compliance

- Minimalkan pengumpulan data.
- Jangan expose PII di client/log/test snapshot.
- Gunakan anonymized fixture data.
- Jangan memakai data produksi di test lokal.
- Jika menambah telemetry, jelaskan event name, properties, dan alasan.
- Pastikan user consent bila fitur membutuhkan tracking khusus.

---

## 15. Performance guidelines

- Jangan optimize prematur.
- Untuk perubahan performance, ukur sebelum/sesudah bila memungkinkan.
- Hindari N+1 query.
- Hindari loop blocking di request path.
- Gunakan pagination untuk list besar.
- Batasi payload API.
- Cache hanya jika invalidation jelas.
- Jangan memperkenalkan memory leak.
- Untuk frontend, perhatikan bundle size, rerender berlebih, lazy loading, dan waterfall request.

---

## 16. Accessibility guidelines

Untuk UI/frontend:

- Gunakan semantic HTML.
- Pastikan keyboard navigation.
- Pastikan focus state jelas.
- Gunakan label untuk input.
- Tambahkan alt text meaningful untuk image informatif.
- Jangan mengandalkan warna saja untuk status.
- Pastikan dialog/modal punya focus management.
- Pastikan aria hanya dipakai jika perlu dan benar.
- Test basic screen reader behavior bila memungkinkan.

---

## 17. Internationalization dan localization

- Jangan hardcode text user-facing bila project memakai i18n.
- Tambahkan key translation sesuai pola existing.
- Hindari format tanggal/angka/currency manual.
- Gunakan timezone handling yang explicit.
- Jangan menggabungkan string yang sulit diterjemahkan.
- Pastikan fallback locale.

---

## 18. Observability dan logging

- Log harus membantu debugging tanpa membocorkan data sensitif.
- Gunakan structured logging bila project sudah memakai.
- Jangan menambahkan `console.log`/debug print permanen.
- Untuk error handling:
  - log detail internal di server,
  - tampilkan message aman ke user,
  - preserve stack trace di environment dev.
- Untuk fitur penting, tambahkan metric/trace/event bila pola existing mendukung.

---

## 19. Error handling

- Jangan swallow error diam-diam.
- Gunakan error type/pattern existing.
- Pastikan user-facing error jelas dan aman.
- Hindari generic catch yang mengubah semua error menjadi response sukses.
- Untuk retry:
  - batasi jumlah retry,
  - gunakan backoff,
  - hindari retry untuk error non-transient,
  - pastikan idempotency bila operasi write.

---

## 20. API design rules

Jika mengubah API:

- Pertahankan backward compatibility kecuali diminta.
- Jangan mengubah response shape tanpa test dan dokumentasi.
- Gunakan status code yang sesuai.
- Validasi input.
- Dokumentasikan endpoint baru.
- Tambahkan test:
  - success,
  - validation error,
  - unauthorized,
  - forbidden,
  - not found,
  - edge cases.

Untuk REST:

- Gunakan nouns untuk resource.
- Gunakan method HTTP sesuai aksi.
- Pastikan pagination/filter/sort konsisten.

Untuk GraphQL:

- Hindari field mahal tanpa pagination.
- Pastikan resolver tidak N+1.
- Gunakan authorization di resolver/service layer.

Untuk RPC/tRPC/gRPC:

- Ikuti naming dan schema existing.
- Pastikan contract typed dan tested.

---

## 21. Database rules

- Jangan mengubah schema tanpa migration.
- Jangan mengedit migration lama yang sudah release.
- Migration harus backward-compatible bila deploy rolling.
- Pastikan migration aman untuk data besar:
  - hindari lock panjang,
  - hindari backfill blocking,
  - pecah perubahan besar,
  - gunakan index concurrently bila DB mendukung.
- Tambahkan rollback strategy bila project mengharuskan.
- Update model/schema/types terkait.
- Update seed/fixtures bila perlu.
- Tambahkan test untuk query/business logic baru.

Untuk query:

- Hindari N+1.
- Gunakan transaction untuk operasi multi-step yang harus atomic.
- Pastikan isolation/idempotency untuk job/payment/webhook.
- Jangan interpolasi string mentah untuk SQL.
- Gunakan parameterized queries/ORM safe API.

---

## 22. Frontend rules

- UI project ini memakai Blade + Tailwind + sedikit JavaScript/Vite, bukan SPA framework.
- Ikuti layout, partial, dan pola Blade existing.
- Pisahkan tampilan Blade dari business logic; logic domain tetap di controller/model/service sesuai pola Laravel.
- Jangan membuat global JavaScript state baru tanpa alasan.
- Gunakan komponen/partial existing sebelum membuat partial baru.
- Pastikan loading, empty, error, dan success state.
- Pastikan responsive behavior.
- Jangan menambahkan dependency UI baru tanpa izin.
- Jangan fetch data berulang tanpa kebutuhan; untuk flow server-rendered, prefer validasi dan render dari controller.
- Jangan menyimpan secret di client.
- Form penting harus punya validasi server-side; client-side validation hanya pelengkap.
- Untuk upload/selfie/camera flow, perhatikan permission kamera, ukuran file, preview, error state, dan fallback upload file.

---

## 23. Backend rules

- Project ini saat ini banyak memakai controller langsung dengan Eloquent/Query Builder. Ikuti pola existing untuk perubahan kecil; pertimbangkan service class hanya bila logic mulai berulang atau kompleks.
- Controller/handler tetap jangan terlalu gemuk untuk behavior baru yang menyentuh banyak domain.
- Validasi input sebelum business logic.
- Authorization harus explicit dan dekat dengan boundary.
- Jangan log request body penuh bila ada PII/secret.
- Gunakan transaction untuk write kompleks.
- Pastikan idempotency untuk:
  - payment,
  - webhook,
  - queue job,
  - external API callback.
- Gunakan timeout untuk request ke service eksternal.
- Handle rate limit dan transient failures.

---

## 24. Queue, job, dan async processing

- Job harus idempotent bila bisa dijalankan ulang.
- Gunakan retry policy yang aman.
- Jangan retry infinite.
- Jangan hilangkan error tanpa logging.
- Pastikan poison message handling.
- Jangan mengirim notifikasi/email duplikat.
- Tambahkan correlation/request ID bila pola existing ada.
- Test edge case retry/failure bila behavior penting.

---

## 25. External integrations

Saat mengubah integrasi pihak ketiga:

- Baca wrapper/client existing.
- Jangan menyebar call API langsung ke banyak tempat.
- Gunakan timeout.
- Handle rate limit.
- Handle auth expired.
- Handle partial failure.
- Jangan log token atau full payload sensitif.
- Tambahkan fixture/mocking untuk test.
- Update docs env var bila menambah credential.

---

## 26. Testing strategy

Prioritas test:

1. Unit test untuk pure logic.
2. Integration test untuk boundary/database/API.
3. E2E test untuk critical user flow.
4. Regression test untuk bug fix.

Aturan:

- Tambahkan test yang gagal sebelum fix bila memungkinkan.
- Jangan menghapus test kecuali test salah dan jelaskan alasannya.
- Jangan snapshot besar tanpa alasan.
- Hindari test flaky.
- Gunakan fixture/factory existing.
- Jangan bergantung pada urutan test.
- Jangan bergantung pada network eksternal.
- Jangan memakai data waktu real tanpa kontrol bila bisa di-mock.

Untuk bug fix:

- Tambahkan regression test yang mereproduksi bug.
- Pastikan test gagal di behavior lama dan pass setelah fix, bila memungkinkan.

Untuk frontend:

- Test behavior, bukan implementation detail.
- Query element seperti user melihatnya.
- Cover loading/error/empty state untuk fitur penting.

Untuk backend:

- Test auth, validation, success, dan failure path.
- Gunakan database test isolation sesuai pola existing.

---

## 27. Dokumentasi

Update docs bila:

- command setup berubah,
- env var bertambah,
- public API berubah,
- behavior user-facing berubah,
- migration/deployment membutuhkan langkah manual,
- runbook incident berubah,
- fitur baru perlu instruksi usage.

Dokumentasi harus:

- singkat,
- akurat,
- menyebut command yang benar,
- memberi contoh minimal,
- menghindari klaim yang belum diverifikasi.

---

## 28. Review checklist

Sebelum final, review sendiri:

- Apakah perubahan sesuai request?
- Apakah ada perubahan unrelated?
- Apakah nama function/variable jelas?
- Apakah public API berubah?
- Apakah error handling aman?
- Apakah authorization cukup?
- Apakah test relevan ada?
- Apakah test/lint/typecheck dijalankan?
- Apakah ada secret/log sensitif?
- Apakah docs perlu update?
- Apakah migration aman?
- Apakah performance memburuk?
- Apakah accessibility tetap baik?

---

## 29. Task playbooks

### 29.1 Bug fix

Langkah:

1. Reproduce atau pahami bug dari report.
2. Cari root cause.
3. Cari test existing.
4. Tambahkan regression test bila memungkinkan.
5. Implement fix minimal.
6. Jalankan test terkait.
7. Jelaskan root cause dan fix.

Jangan:

- refactor besar,
- mengubah behavior lain,
- menghapus validasi,
- menutupi error tanpa memahami penyebab.

### 29.2 Feature

Langkah:

1. Identifikasi requirement dan acceptance criteria.
2. Cari pola fitur serupa.
3. Implement mengikuti pola existing.
4. Tambahkan test.
5. Update docs bila user-facing/API.
6. Jalankan verifikasi.

Jangan:

- membuat arsitektur baru tanpa kebutuhan,
- menambah dependency tanpa izin,
- mengubah scope di luar request.

### 29.3 Refactor

Langkah:

1. Pastikan tujuan refactor jelas.
2. Pastikan behavior existing terlindungi test.
3. Lakukan perubahan kecil.
4. Jalankan test.
5. Jelaskan bahwa behavior tidak dimaksudkan berubah.

Jangan:

- mencampur refactor dengan feature,
- mengubah public behavior,
- rename massal tanpa alasan.

### 29.4 Test-only task

Langkah:

1. Cari behavior yang perlu dilindungi.
2. Gunakan pattern test existing.
3. Hindari test rapuh.
4. Jalankan test spesifik.
5. Jelaskan coverage yang ditambah.

### 29.5 Documentation task

Langkah:

1. Verifikasi command/API dari source of truth.
2. Update docs yang relevan.
3. Jangan membuat dokumentasi spekulatif.
4. Pastikan contoh bisa dijalankan bila memungkinkan.

### 29.6 Performance task

Langkah:

1. Identifikasi baseline atau bottleneck.
2. Buat perubahan minimal.
3. Ukur ulang bila tooling tersedia.
4. Tambahkan test/perf guard bila pola existing mendukung.
5. Jelaskan trade-off.

### 29.7 Security task

Langkah:

1. Identifikasi threat model.
2. Periksa boundary input/output/auth/log.
3. Implement fix paling aman.
4. Tambahkan test negatif.
5. Jelaskan risiko residual.

### 29.8 Database migration task

Langkah:

1. Pahami schema saat ini.
2. Buat migration baru.
3. Pastikan forward/backward compatibility.
4. Update models/types.
5. Update seed/fixtures.
6. Jalankan migration di env test/lokal bila memungkinkan.
7. Jalankan test terkait.

### 29.9 Dependency upgrade

Langkah:

1. Baca changelog/release notes bila tersedia.
2. Upgrade versi minimal yang diminta.
3. Jalankan install.
4. Perbaiki breaking changes.
5. Jalankan test/lint/build.
6. Jelaskan perubahan lockfile.

### 29.10 PR review

Fokus review:

- correctness,
- security,
- regressions,
- data loss,
- race conditions,
- authorization,
- API compatibility,
- migration safety,
- test gaps.

Abaikan style kecil kecuali berdampak ke maintainability.

---

## 30. Stack-specific guidance

### 30.1 PHP/Laravel

- Ikuti convention Laravel.
- Tambahkan migration/model/factory/test sesuai kebutuhan.
- Jangan expose env secret.
- Validasi request sebelum business logic. Pola existing masih banyak memakai `$request->validate()` di controller; Form Request boleh ditambahkan bila membuat flow baru yang kompleks.
- Gunakan middleware existing untuk boundary auth/role: `auth`, `auth:sanctum`, `role`, `photographer.verified`, dan `banned`.
- Pertahankan response shape API di `app/Http/Controllers/Api` kecuali user meminta perubahan contract.
- Untuk operasi uang/order/saldo/withdrawal, gunakan transaction dan pastikan operasi tidak mudah diproses dua kali.
- Gunakan Eloquent relationship bila cocok, tetapi ikuti pola existing yang masih campuran Eloquent dan Query Builder.
- Jalankan `./vendor/bin/pint --test` untuk cek style PHP bila menyentuh kode PHP.

Commands umum:

```bash
php artisan test
./vendor/bin/pint --test
```

### 30.2 Blade/Vite/Tailwind

- UI utama memakai Blade di `resources/views`, bukan React/Vue.
- Ikuti layout dan partial existing: `resources/views/layouts/app.blade.php`, `partials/navbar.blade.php`, `partials/sidebar.blade.php`, dan `partials/bottom-nav.blade.php`.
- Gunakan Tailwind CSS existing melalui `resources/css/app.css`; hindari CSS global baru kecuali benar-benar perlu.
- Pastikan form upload/search/cart/order punya state error/success dari session dan validasi server-side.
- Jangan expose `AI_API_KEY`, AWS secret, atau credential lain ke JavaScript/client.
- Jalankan `npm run build` bila mengubah asset frontend, Vite config, atau CSS/JS entry.

### 30.3 Filament Admin

- Admin panel berada di path `/admin` dengan brand `KeJepret Admin`.
- Resource admin ada di `app/Filament/Resources`; pages/widgets di `app/Filament/Pages` dan `app/Filament/Widgets`.
- Untuk fitur admin baru, gunakan resource/page/action Filament sesuai pola existing sebelum membuat controller admin kustom.
- Pastikan aksi admin yang memverifikasi fotografer, mengubah event, menonaktifkan foto, atau memproses withdrawal memiliki validasi dan status transition yang jelas.

### 30.4 Sanctum REST API

- API ada di `routes/api.php` dan dilindungi `auth:sanctum` untuk endpoint non-public.
- Endpoint publik saat ini hanya register/login.
- Endpoint role runner, photographer, dan admin wajib tetap dibatasi middleware role yang sesuai.
- Untuk endpoint baru, tambahkan test feature yang mencakup unauthenticated, wrong role/forbidden, validation error, dan success path bila memungkinkan.
- Jangan mengembalikan stack trace, token, path private storage, atau payload sensitif di response API production.

### 30.5 File Upload, Storage, dan AI Integration

- Foto original disimpan private di disk `s3`, watermark disimpan public sesuai pola `PhotoController`.
- Validasi upload minimal harus membatasi tipe gambar dan ukuran file.
- Jangan percaya filename dari user; gunakan nama file generated seperti pola existing.
- AI service dipanggil via `Http::withHeaders(['X-API-Key' => env('AI_API_KEY')])` dan `AI_BASE_URL`.
- Gunakan timeout untuk call AI/storage eksternal dan handle failure tanpa membuat data domain inkonsisten.
- Jangan log API key, signed URL sensitif, selfie, atau payload image/base64.

---

## 31. Monorepo guidance

Project ini bukan monorepo. Perlakukan root repository sebagai satu aplikasi Laravel.

- Jangan menambah struktur `apps/` atau `packages/` tanpa instruksi eksplisit.
- Dependency PHP dikelola di root `composer.json`.
- Dependency frontend dikelola di root `package.json`.
- Jalankan command dari root repo kecuali dokumentasi project nanti menyatakan lain.

---

## 32. CI/CD guidance

- Jangan mengubah workflow CI/CD tanpa membaca workflow terkait.
- Untuk CI failure, baca log error utama dulu.
- Jangan men-disable test untuk membuat CI hijau.
- Jika menambah job:
  - jelaskan trigger,
  - jelaskan secret/permission,
  - pastikan caching aman,
  - pastikan command bisa berjalan dari clean checkout.
- Jangan menambah secret ke repository.

---

## 33. Release guidance

Jika task menyentuh release:

- Update changelog bila project memakai.
- Update version hanya jika diminta.
- Jangan publish package/release tanpa instruksi eksplisit.
- Pastikan migration/deployment notes jelas.
- Jelaskan backward compatibility.

---

## 34. File generation dan formatting

- Jangan format seluruh repo kecuali user meminta.
- Jangan mengubah line endings massal.
- Jangan regenerate snapshots/golden files tanpa menjelaskan.
- Jika generated files perlu update, jalankan generator resmi dan sebutkan command.
- Jangan mengedit generated files manual kecuali itu pola project.

---

## 35. Handling unknowns

Jika tidak yakin:

- Baca file terkait sebelum menyimpulkan.
- Cari pattern existing.
- Pilih solusi paling konservatif.
- Tulis asumsi.
- Jangan membuat klaim bahwa test pass bila tidak dijalankan.
- Jangan menyembunyikan kegagalan command.

Format untuk ketidakpastian:

```text
Catatan: saya belum bisa memverifikasi X karena Y. Perubahan ini dibuat berdasarkan pola Z.
```

---

## 36. Instruksi khusus repository

### Architecture rules

- Web UI dan web flow ada di `app/Http/Controllers/Web` dan `resources/views`.
- REST API ada di `app/Http/Controllers/Api` dan `routes/api.php`; jangan campur response Blade ke controller API.
- Role boundary harus eksplisit di route/middleware: `runner`, `photographer`, dan `admin`.
- Photographer yang belum diverifikasi hanya boleh masuk flow waiting; route upload/portfolio/sales/withdrawal harus lewat `photographer.verified`.
- User banned tidak boleh mengakses area photographer sesuai middleware `banned`; bila memperluas ban ke role lain, jelaskan behavior baru dan tambahkan test.
- Admin panel utama memakai Filament. Jangan membuat UI admin paralel di Blade tanpa alasan produk yang jelas.
- Integrasi AI dan storage eksternal harus tetap berada di server-side Laravel, bukan client-side JavaScript.
- Untuk behavior baru yang menyentuh order, balance, withdrawal, download token, atau search result, baca migration dan model terkait sebelum mengubah controller.

### Naming conventions

- Gunakan istilah domain yang sudah ada: `runner`, `photographer`, `admin`, `event`, `photo`, `search_session`, `search_result`, `cart_item`, `order`, `order_item`, `photographer_balance`, `balance_transaction`, `withdrawal`.
- Nama route web mengikuti pola existing seperti `runner.search`, `photographer.upload`, `admin.photographers.pending`.
- Controller web berada di namespace `App\Http\Controllers\Web`; controller API berada di `App\Http\Controllers\Api`.
- Kolom/path storage mengikuti pola existing: `selfies/temp/...`, `photos/original/...`, `photos/watermark/...`.
- Status enum harus konsisten dengan migration: contoh `pending`, `paid`, `expired`, `failed`, `embedded`, `completed`, `approved`, `rejected`.

### Domain rules

- Runner mencari foto dengan selfie atau kamera base64, opsional difilter `event_id`.
- Upload foto fotografer harus membuat record `photos`, menyimpan original private, membuat watermark public, lalu mengirim foto ke AI untuk embedding.
- Harga foto minimal mengikuti validasi existing: `min:5000`.
- Checkout mengambil item dari `cart_items`, membuat `orders` dan `order_items`, lalu mengosongkan cart.
- Fee platform existing adalah 15%; photographer amount existing 85%. Jangan ubah rasio ini tanpa instruksi produk.
- Pembayaran manual mengubah order `pending` menjadi `paid`, mengkredit saldo fotografer, dan mencatat `balance_transactions`. Pastikan tidak double-credit.
- Download harus menggunakan `download_token` dari `order_items` dan hanya untuk order yang valid/paid sesuai pola existing.
- Withdrawal harus mengurangi/menahan saldo sesuai status yang ada dan wajib punya audit di `balance_transactions` bila behavior saldo berubah.
- Event dapat memiliki foto dan search; perubahan event aktif/nonaktif harus mempertimbangkan tampilan home/search/upload.
- Data wajah/selfie adalah data sensitif. Jangan tampilkan, log, atau simpan lebih lama dari kebutuhan flow tanpa arahan eksplisit.

### Test rules

- Test framework adalah PHPUnit via `php artisan test`; test suite ada di `tests/Unit` dan `tests/Feature`.
- `phpunit.xml` memakai SQLite in-memory, cache array, queue sync, dan session array untuk testing.
- Untuk perubahan API, tambahkan Feature test pada auth, role authorization, validasi, dan success path bila memungkinkan.
- Untuk perubahan uang/order/saldo/withdrawal/download, tambahkan regression test atau feature test karena risikonya tinggi.
- Mock/fake call eksternal AI/storage bila test menyentuh `Http` atau `Storage`; jangan bergantung network eksternal.
- Test contoh bawaan masih ada; jangan menghapus test tanpa mengganti coverage yang relevan.

### Deployment rules

- Belum ada runbook deployment di repo. Gunakan praktik Laravel production standar sampai dokumentasi resmi tersedia.
- Jangan mengubah konfigurasi production, queue, filesystem, cache, session, atau CI/CD tanpa menjelaskan risiko.
- Pastikan env production memiliki `APP_KEY`, database config, `FILESYSTEM_DISK`, AWS/R2 config, `AI_BASE_URL`, dan `AI_API_KEY`.
- Jalankan `php artisan migrate` untuk schema change; jangan edit migration lama.
- Jalankan `npm run build` sebelum deployment bila asset frontend berubah.
- Jalankan `php artisan config:cache`/`route:cache` hanya di deployment process yang memang mendukungnya; jangan commit cache hasil runtime.

---

## 37. Nested AGENTS.md yang disarankan

Jika repo membesar, buat file tambahan yang lebih spesifik:

```text
app/Http/Controllers/Api/AGENTS.md
app/Http/Controllers/Web/AGENTS.md
app/Filament/AGENTS.md
database/AGENTS.md
resources/views/AGENTS.md
```

Contoh `resources/views/AGENTS.md`:

```md
# resources/views/AGENTS.md

- Ikuti layout dan partial Blade existing.
- Semua form wajib menampilkan validasi error dan session flash bila relevan.
- Jangan expose secret/env server ke client.
- Jalankan `npm run build` bila mengubah asset CSS/JS.
```

Contoh `app/Http/Controllers/Api/AGENTS.md`:

```md
# app/Http/Controllers/Api/AGENTS.md

- Endpoint baru wajib punya validasi request dan auth/role middleware.
- Jangan log request body penuh.
- Pertahankan JSON response shape yang sudah dipakai client.
- Jalankan `php artisan test --testsuite=Feature` atau test spesifik sebelum final.
```

Contoh `database/AGENTS.md`:

```md
# database/AGENTS.md

- Jangan edit migration lama.
- Semua schema change harus migration baru.
- Untuk table besar, hindari migration blocking.
- Jelaskan rollback plan untuk migration berisiko.
```

---

## 38. Template final response untuk Codex

Gunakan format ini setelah menyelesaikan task:

```text
Ringkasan:
- ...

Perubahan:
- `path/file`: ...
- `path/file`: ...

Verifikasi:
- `command` -> pass/fail/not run
- `command` -> pass/fail/not run

Catatan/Risiko:
- ...

Follow-up:
- ...
```

Jika tidak ada follow-up, tulis:

```text
Follow-up:
- Tidak ada.
```

---

## 39. Instruksi anti-pattern

Jangan lakukan ini:

- Mengubah banyak file tanpa rencana.
- Melakukan refactor luas saat user meminta bug fix kecil.
- Menambah dependency untuk masalah sederhana.
- Menghapus test failing tanpa memahami alasan.
- Mengubah snapshot besar tanpa review.
- Menambahkan mock yang membuat test tidak berarti.
- Menyembunyikan error command.
- Mengatakan "semua test pass" jika tidak menjalankan test.
- Membuat migration destructive tanpa izin.
- Mengubah behavior public API tanpa menyebut breaking change.
- Menulis komentar generik yang tidak menambah informasi.
- Menggunakan data produksi atau secret di test.

---

## 40. Checklist cepat sebelum mulai task

- [ ] Sudah baca instruksi user.
- [ ] Sudah identifikasi file relevan.
- [ ] Sudah cek pattern existing.
- [ ] Sudah tahu command test/lint yang relevan.
- [ ] Sudah punya rencana minimal.

## 41. Checklist cepat sebelum final

- [ ] Diff sesuai request.
- [ ] Tidak ada perubahan unrelated.
- [ ] Test/lint/typecheck relevan dijalankan atau alasan disebut.
- [ ] Tidak ada secret/debug log.
- [ ] Docs/env/schema update bila perlu.
- [ ] Risiko disebut.
- [ ] Final response ringkas dan jelas.
