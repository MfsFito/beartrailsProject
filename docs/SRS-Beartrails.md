# BearTrails SRS
**Kelompok:** We Bare Bears | **Anggota:** Rival (Grizzly), Fatio (Panda), Alif (Ice Bear)
**Mata Kuliah:** Pemrograman Web | RPL | APBO | **Status:** FINAL

> Dokumen ini adalah Sumber Kebenaran Tunggal proyek. Semua keputusan desain, teknis, dan fitur mengacu pada dokumen ini.

---

## 1. PENDAHULUAN

### 1.1 Tujuan Dokumen
SRS ini berfungsi sebagai: (1) Sumber Kebenaran Tunggal seluruh tim, (2) kontrak internal antara anggota kelompok soal scope, fitur, dan batasan sistem, (3) referensi prompt untuk pengembangan berbantuan AI, dan (4) pedoman tugas untuk 3 mata kuliah: Pemrograman Web, RPL, dan APBO.

### 1.2 Ruang Lingkup Sistem
BearTrails adalah platform wisata interaktif berbasis web yang memungkinkan pengguna menemukan destinasi wisata di Indonesia, melihat cuaca real-time, menjelajahi peta secara bebas, mendapatkan rute perjalanan, dan terhubung dengan Tour Guide terverifikasi. Sistem melibatkan tiga peran utama: Wisatawan (User), Tour Guide, dan Administrator.

### 1.3 Latar Belakang & Masalah yang Diselesaikan
Masalah yang dialami wisatawan Indonesia saat ini:
- Informasi destinasi tersebar di berbagai platform yang tidak terintegrasi.
- Tidak ada cara mudah menemukan Tour Guide lokal terpercaya untuk destinasi spesifik.
- Tidak ada informasi cuaca real-time sebelum berkunjung.
- Tidak ada pusat komunitas untuk berbagi ulasan destinasi secara terpusat.

BearTrails menjawab semua masalah ini dalam satu platform terintegrasi.

### 1.4 Definisi & Singkatan
- **User / Wisatawan:** Pengguna terdaftar yang mencari dan memesan wisata.
- **Tour Guide:** Pemandu wisata terverifikasi yang mendaftar melalui kerjasama dengan BearTrails.
- **Admin:** Pengelola platform dengan akses penuh ke semua data.
- **SRS:** Software Requirements Specification (dokumen ini).
- **PRD:** Product Requirements Document (versi awal v1.0).
- **API:** Application Programming Interface — antarmuka integrasi layanan eksternal.
- **CRUD:** Create, Read, Update, Delete — operasi dasar database.
- **Role:** Peran pengguna dalam sistem (user / tourguide / admin).
- **Availability:** Jadwal ketersediaan Tour Guide yang diatur sendiri di dashboard.
- **Session:** Sesi login yang menjaga status autentikasi pengguna.

### 1.5 Keterkaitan dengan Mata Kuliah
- **Pemrograman Web:** Deliverable = Website BearTrails fungsional (PHP + Laravel + MySQL).
- **RPL:** Deliverable = Dokumen SRS ini + Diagram Use Case, Sequence, Activity.
- **APBO:** Deliverable = Class Diagram, ERD, Diagram UML lengkap.

---

## 2. GAMBARAN UMUM SISTEM

### 2.1 Perspektif Produk
BearTrails adalah aplikasi web standalone dengan arsitektur client-server tradisional. Frontend: HTML/CSS/JavaScript. Backend: Laravel (PHP Framework). Database: MySQL. Integrasi 2 API eksternal: OpenStreetMap+Leaflet untuk peta interaktif, dan Open-Meteo untuk cuaca real-time.

### 2.2 Tech Stack Lengkap
- **Frontend:** HTML5, CSS3, JavaScript ES6+ — Responsive, Mobile-first.
- **CSS Framework:** Tailwind CSS atau Custom CSS dengan design token warna BearTrails.
- **Backend:** Laravel 11.x — routing, ORM (Eloquent), middleware, session.
- **Database:** MySQL 8.x — relational database.
- **Maps API:** OpenStreetMap + Leaflet.js — gratis, open-source, peta interaktif.
- **Weather API:** Open-Meteo API — gratis, tidak perlu API key, data cuaca real-time.
- **Design Tool:** Google Stitch (Figma) — wireframe & prototyping UI.
- **Version Control:** Git + GitHub — kolaborasi tim 3 orang.
- **Server (Dev):** XAMPP / Laragon / Herd — local development environment.

### 2.3 Karakteristik Pengguna
**User / Wisatawan:** Wisatawan domestik, traveler muda, pecinta alam. Fasih internet dasar. Mendapatkan akun dengan registrasi mandiri di website.

**Tour Guide:** Pemandu wisata profesional yang sudah menjalin kerjasama dengan tim BearTrails. Mendapatkan akun dari Admin setelah kerjasama via email/hubungi tim — TIDAK bisa daftar mandiri.

**Admin:** Anggota tim We Bare Bears atau pengelola yang ditunjuk. Akses penuh sistem. Akunnya dibuat manual di database (seeder).

### 2.4 Asumsi & Batasan
**Asumsi:**
- Semua Tour Guide telah menjalin kerjasama offline sebelum mendapat akun.
- User memiliki koneksi internet untuk mengakses peta dan cuaca real-time.
- Foto destinasi dikelola oleh Admin dan di-upload ke server.

**Batasan (Out of Scope):**
- Tidak ada sistem pembayaran online (payment gateway).
- Tidak ada live chat real-time dalam platform — kontak via info eksternal.
- Tidak ada aplikasi mobile native (iOS/Android) — hanya web responsif.
- Tour Guide tidak melakukan konfirmasi booking di dalam platform; kontak langsung ke User di luar platform.

---

## 3. PERAN & HAK AKSES

### 3.1 Matriks Hak Akses
Berikut adalah hak akses setiap role untuk setiap fitur/halaman:

- **Beranda (index):** Bisa diakses oleh Tamu, User, Tour Guide, Admin.
- **Daftar Destinasi:** Bisa diakses oleh Tamu, User, Tour Guide, Admin.
- **Detail Destinasi:** Bisa diakses oleh Tamu, User, Tour Guide, Admin.
- **Fitur Explore (/explore):** Bisa diakses oleh Tamu, User, Tour Guide, Admin.
- **Simpan Favorit:** Hanya User dan Admin. Tamu diarahkan ke halaman login.
- **Tulis Review:** Hanya User dan Admin. Tamu diarahkan ke halaman login.
- **Halaman Tour Guide (list):** Bisa diakses oleh Tamu, User, Tour Guide, Admin.
- **Detail Tour Guide:** Bisa diakses oleh Tamu, User, Tour Guide, Admin.
- **Profil User:** Hanya User dan Admin. Tamu dan Tour Guide tidak bisa akses.
- **Dashboard Tour Guide:** Hanya Tour Guide dan Admin. Tamu dan User biasa tidak bisa akses.
- **Admin Panel:** Hanya Admin. Semua role lain tidak bisa akses.

### 3.2 Sistem Login Terpusat
Hanya ada SATU halaman login (/login) untuk semua peran. Setelah autentikasi berhasil, sistem mendeteksi role dari database dan melakukan redirect otomatis:
- Jika role = "user" → redirect ke beranda (/)
- Jika role = "tourguide" → redirect ke dashboard tour guide (/tourguide/dashboard)
- Jika role = "admin" → redirect ke admin panel (/admin/dashboard)

---

## 4. PERSYARATAN FUNGSIONAL

### 4.1 Modul Autentikasi (AUTH)
- **AUTH-01 — Login Terpusat:** Satu form login untuk semua role. Deteksi role otomatis dan redirect sesuai. Berlaku untuk semua role.
- **AUTH-02 — Registrasi User:** User dapat membuat akun baru. Field yang diisi: nama, email, password, konfirmasi password. Berlaku untuk tamu.
- **AUTH-03 — Validasi Form JS:** Validasi client-side: format email, minimal 8 karakter password, konfirmasi password harus cocok. Berlaku untuk semua.
- **AUTH-04 — Enkripsi Password:** Password disimpan dengan bcrypt menggunakan Laravel Hash::make. Berlaku untuk semua.
- **AUTH-05 — Session Management:** Laravel session menjaga status login. Logout menghapus session. Berlaku untuk semua.
- **AUTH-06 — Redirect Guest:** Akses halaman terproteksi tanpa login akan di-redirect ke /login. Berlaku untuk semua.
- **AUTH-07 — Pembuatan Akun TG:** Admin membuat akun Tour Guide dari panel admin. Tour Guide tidak bisa daftar mandiri. Hanya Admin.

### 4.2 Modul Beranda (HOME)
- **HOME-01 — Hero Section:** Tagline besar, deskripsi singkat platform, search bar terpusat.
- **HOME-02 — Search Bar:** Input pencarian destinasi + tombol Cari. Redirect ke /search?q={keyword}.
- **HOME-03 — Quick Tags:** Shortcut kategori (Pantai, Gunung, Budaya, Kuliner) yang mengarah ke filter di halaman destinations.
- **HOME-04 — Peta Interaktif:** Leaflet.js menampilkan semua destinasi dengan marker. Klik marker → buka halaman detail destinasi.
- **HOME-05 — Cuaca 5 Kota:** Grid cuaca real-time 5 kota besar via Open-Meteo API, di-fetch di sisi client (JavaScript). Menampilkan cuaca per jam (pagi–malam hari ini) dan ringkasan 7 hari ke depan.
- **HOME-06 — Destinasi Populer:** Grid 4 kolom destinasi dengan rating tertinggi. Ada filter tab kategori.
- **HOME-07 — Seksi Tour Guide:** Grid 3-4 card Tour Guide unggulan dengan tombol "Lihat Semua".
- **HOME-08 — Stats Bar:** Counter animasi menampilkan: jumlah destinasi, user, tour guide, dan review.

### 4.3 Modul Destinasi (DEST)
- **DEST-01 — Daftar Destinasi:** Grid semua destinasi dengan foto, nama, kategori, lokasi, rating.
- **DEST-02 — Filter Kategori:** Tab: Semua | Pantai | Gunung | Budaya | Kuliner. Update grid tanpa reload halaman (JavaScript).
- **DEST-03 — Filter Lokasi:** Dropdown provinsi/kota. Bisa dikombinasikan dengan filter kategori.
- **DEST-04 — Search Destinasi:** Search bar inline di halaman destinations.
- **DEST-05 — Detail Destinasi:** Halaman penuh satu destinasi: foto hero, deskripsi, peta Leaflet embed, cuaca lokasi, review.
- **DEST-06 — Cuaca Lokasi Detail:** Card cuaca destinasi menampilkan cuaca per jam hari ini (pagi–malam) dan ramalan 7 hari ke depan via Open-Meteo API. Data: suhu, weathercode, kelembaban, kecepatan angin.
- **DEST-07 — Galeri Foto:** Foto utama dari tabel destinations dan foto galeri tambahan dari tabel destination_images.
- **DEST-08 — Tombol Favorit:** Toggle ❤️/🤍 di card dan di halaman detail. Butuh login. Tersimpan di tabel favorites.
- **DEST-09 — Rating & Review:** Daftar ulasan + form tulis review (rating 1-5 bintang + komentar). Butuh login.
- **DEST-10 — Fitur Rute:** User bisa menentukan titik asal dan titik tujuan di peta, sistem menampilkan rute perjalanan menggunakan Leaflet Routing Machine (OSRM — gratis, tanpa API key). Informasi rute mencakup jarak total dan estimasi waktu tempuh.
- **DEST-11 — Request GPS / Lokasi Saat Ini:** Tombol "Gunakan Lokasi Saya" memanfaatkan browser Geolocation API untuk mendapatkan posisi user saat ini, lalu peta otomatis pindah ke lokasi tersebut dan menampilkan cuaca lokasi user.

### 4.4 Modul Explore
Halaman `/explore` — fitur peta bebas untuk menjelajahi cuaca di titik mana saja di dunia, tidak terbatas pada destinasi yang ada di database.

- **EXPL-01 — Peta Bebas:** Leaflet.js full-screen. User bisa klik di mana saja di peta untuk mendapatkan informasi titik tersebut.
- **EXPL-02 — Info Klik Titik:** Saat user klik titik di peta, sistem menampilkan popup berisi: latitude, longitude, dan data cuaca real-time titik tersebut via Open-Meteo API (suhu, kondisi, kelembaban).
- **EXPL-03 — Cuaca Detail Titik:** Cuaca yang ditampilkan mencakup cuaca per jam hari ini (pagi–malam) dan ramalan 7 hari ke depan.
- **EXPL-04 — Input Koordinat Manual:** Form input latitude & longitude secara manual. Setelah submit, peta fly/pan ke koordinat tersebut dan menampilkan popup cuaca titik itu.
- **EXPL-05 — Display Koordinat:** Koordinat (lat/lng) dari titik yang diklik atau diinput ditampilkan secara jelas di panel samping atau popup.
- **EXPL-06 — Akses Publik:** Fitur Explore bisa diakses semua pengunjung tanpa perlu login.

### 4.5 Modul Tour Guide (TG)
- **TG-01 — Daftar Tour Guide:** Halaman /tourguides. Grid semua Tour Guide aktif dengan foto, nama, lokasi, harga per hari, rating. Bisa diakses semua orang.
- **TG-02 — Filter Tour Guide:** Filter berdasarkan lokasi wilayah layanan. Bisa diakses semua orang.
- **TG-03 — Detail Tour Guide:** Halaman profil publik TG: foto, bio, lokasi, harga per hari, rating, availability, portofolio foto. Bisa diakses semua orang.
- **TG-04 — Kontak Tour Guide:** Tampilkan nomor telepon TG. User menghubungi langsung di luar platform. Bisa diakses semua orang.
- **TG-05 — Kalender Availability:** Tampilkan daftar tanggal kapan TG tersedia berdasarkan data yang diatur TG. Bisa diakses semua orang.
- **TG-06 — Portofolio Foto:** Tampilkan galeri foto portofolio beserta judul dan deskripsi yang diposting dari dashboard TG. Bisa diakses semua orang.
- **TG-07 — Dashboard TG:** Halaman khusus TG setelah login. Tampilkan profil, availability, portofolio. Hanya Tour Guide.
- **TG-08 — Kelola Availability:** TG menambah/hapus tanggal ketersediaan (available_date, status). Hanya Tour Guide.
- **TG-09 — Kelola Portofolio:** TG menambah/hapus foto portofolio: foto, judul, deskripsi. Hanya Tour Guide.
- **TG-10 — Edit Profil TG:** TG edit info diri: foto, bio, lokasi, harga per hari, nomor telepon. Hanya Tour Guide.

### 4.6 Modul Profil User (PROFILE)
- **PRO-01 — Lihat Profil:** Tampilkan nama, email, foto profil, tanggal bergabung.
- **PRO-02 — Edit Profil:** User bisa edit nama dan upload foto profil.
- **PRO-03 — Favorit Tersimpan:** Daftar destinasi yang disimpan user dengan tombol hapus favorit.
- **PRO-04 — Riwayat Review:** Daftar semua review yang pernah ditulis user beserta tanggalnya.

### 4.7 Modul Admin Panel (ADMIN)
- **ADM-01 — Dashboard Overview:** Statistik platform: total destinasi, user, tour guide, review.
- **ADM-02 — Kelola Destinasi:** CRUD destinasi: tambah (nama, kategori, lokasi, koordinat, deskripsi, harga tiket, foto utama, foto galeri), edit, hapus.
- **ADM-03 — Kelola User:** Lihat daftar user, hapus akun bermasalah.
- **ADM-04 — Kelola Tour Guide:** Buat akun Tour Guide baru, toggle status aktif/nonaktif, hapus akun TG.
- **ADM-05 — Kelola Review:** Lihat semua review, hapus review yang melanggar aturan komunitas.

---

## 5. PERSYARATAN NON-FUNGSIONAL

- **Performa:** Waktu muat halaman harus di bawah 3 detik pada koneksi standar (3G/4G).
- **Keamanan — Autentikasi:** Bcrypt untuk password, CSRF token pada semua form (Laravel default).
- **Keamanan — SQL Injection:** Gunakan Eloquent ORM / Query Builder Laravel (parameterized query).
- **Keamanan — XSS:** Sanitasi input, gunakan `{{ }}` Blade untuk output (auto-escape).
- **Keamanan — Akses Role:** Middleware Laravel auth & role check di semua route terproteksi.
- **Usability — Responsif:** Layout adaptif: mobile (< 768px), tablet, desktop. Mobile-first approach.
- **Usability — Font & Warna:** Plus Jakarta Sans (body), Fraunces (display). Token warna konsisten di seluruh halaman.
- **Reliabilitas — API Fallback:** Jika Open-Meteo gagal, tampilkan pesan "Data cuaca tidak tersedia" tanpa crash halaman.
- **Maintainability:** MVC pattern Laravel: Model, View (Blade), Controller terpisah dan rapi.
- **Skalabilitas:** Index pada kolom yang sering di-query (kategori, lokasi, user_id).

---

## 6. STRUKTUR DATABASE (MySQL)

Semua tabel menggunakan engine InnoDB untuk mendukung foreign key constraint. Charset: utf8mb4 untuk mendukung emoji dan karakter Unicode penuh.

### 6.1 Tabel: users
Menyimpan semua akun pengguna dari ketiga role.
- `id` — BIGINT UNSIGNED, Primary Key, Auto Increment. ID unik pengguna.
- `name` — VARCHAR(255), NOT NULL. Nama lengkap pengguna.
- `email` — VARCHAR(255), UNIQUE, NOT NULL. Email yang digunakan untuk login.
- `email_verified_at` — TIMESTAMP, NULLABLE. Waktu verifikasi email.
- `password` — VARCHAR(255), NOT NULL. Password yang sudah di-hash dengan bcrypt.
- `role` — ENUM, default 'user'. Nilai yang valid: 'user', 'tourguide', 'admin'.
- `remember_token` — VARCHAR(100), NULLABLE. Token untuk fitur remember me.
- `created_at` — TIMESTAMP, default NOW(). Tanggal registrasi.
- `updated_at` — TIMESTAMP, default NOW(). Dikelola otomatis oleh Laravel.

### 6.2 Tabel: destinations
Menyimpan semua data destinasi wisata.
- `id` — BIGINT UNSIGNED, Primary Key, Auto Increment. ID unik destinasi.
- `name` — VARCHAR(255), NOT NULL. Nama destinasi wisata.
- `description` — TEXT, NOT NULL. Deskripsi lengkap destinasi.
- `location` — VARCHAR(255), NOT NULL. Nama kota atau daerah destinasi.
- `latitude` — DECIMAL(10,7), NULLABLE. Koordinat GPS latitude.
- `longitude` — DECIMAL(10,7), NULLABLE. Koordinat GPS longitude.
- `category` — VARCHAR(255), NOT NULL. Kategori destinasi: 'pantai', 'gunung', 'budaya', 'kuliner'.
- `image` — VARCHAR(255), NULLABLE. Path ke foto utama destinasi.
- `entry_fee` — DECIMAL(10,2), default 0. Harga tiket masuk destinasi.
- `created_at` — TIMESTAMP, default NOW(). Waktu data ditambahkan.
- `updated_at` — TIMESTAMP, default NOW(). Dikelola otomatis oleh Laravel.

### 6.3 Tabel: reviews
Menyimpan semua ulasan pengguna untuk destinasi.
- `id` — BIGINT UNSIGNED, Primary Key, Auto Increment. ID unik review.
- `user_id` — BIGINT UNSIGNED, Foreign Key ke users.id, CASCADE DELETE. Penulis review.
- `destination_id` — BIGINT UNSIGNED, Foreign Key ke destinations.id, CASCADE DELETE. Destinasi yang diulas.
- `rating` — INTEGER, NOT NULL, nilai 1-5. Rating bintang.
- `comment` — TEXT, NULLABLE. Isi ulasan dalam teks.
- `created_at` — TIMESTAMP, default NOW(). Waktu review dikirim.
- `updated_at` — TIMESTAMP, default NOW(). Dikelola otomatis oleh Laravel.

### 6.4 Tabel: favorites
Menyimpan destinasi yang disimpan/difavoritkan oleh user.
- `id` — BIGINT UNSIGNED, Primary Key, Auto Increment. ID favorit.
- `user_id` — BIGINT UNSIGNED, Foreign Key ke users.id, CASCADE DELETE. Pemilik favorit.
- `destination_id` — BIGINT UNSIGNED, Foreign Key ke destinations.id, CASCADE DELETE. Destinasi yang disimpan.
- `created_at` — TIMESTAMP, default NOW(). Waktu disimpan.
- `updated_at` — TIMESTAMP, default NOW(). Dikelola otomatis oleh Laravel.

### 6.5 Tabel: tourguide_profiles
Tabel extension untuk users dengan role tourguide. Relasi one-to-one dengan tabel users.
- `id` — BIGINT UNSIGNED, Primary Key, Auto Increment. ID profil TG.
- `user_id` — BIGINT UNSIGNED, Foreign Key ke users.id, CASCADE DELETE. Link ke akun user di tabel users.
- `phone` — VARCHAR(255), NULLABLE. Nomor telepon Tour Guide.
- `bio` — TEXT, NULLABLE. Deskripsi atau bio Tour Guide.
- `photo` — VARCHAR(255), NULLABLE. Foto profil khusus TG.
- `location` — VARCHAR(255), NOT NULL. Wilayah layanan Tour Guide, contoh: Lombok Barat.
- `price_per_day` — DECIMAL(10,2), NOT NULL. Harga jasa Tour Guide per hari dalam Rupiah.
- `status` — ENUM, default 'active'. Nilai yang valid: 'active', 'inactive'. Status akun TG.
- `rating` — DECIMAL(3,2), default 0. Rating rata-rata Tour Guide skala 0-5.
- `created_at` — TIMESTAMP, default NOW(). Waktu profil dibuat.
- `updated_at` — TIMESTAMP, default NOW(). Dikelola otomatis oleh Laravel.

### 6.6 Tabel: tourguide_availabilities
Menyimpan jadwal ketersediaan yang diatur oleh Tour Guide.
- `id` — BIGINT UNSIGNED, Primary Key, Auto Increment. ID jadwal.
- `tourguide_profile_id` — BIGINT UNSIGNED, Foreign Key ke tourguide_profiles.id, CASCADE DELETE. Profil Tour Guide yang bersangkutan.
- `available_date` — DATE, NOT NULL. Tanggal Tour Guide tersedia.
- `status` — ENUM, default 'available'. Nilai yang valid: 'available', 'booked'. Status tanggal tersebut.
- `created_at` — TIMESTAMP, default NOW(). Waktu jadwal dibuat.
- `updated_at` — TIMESTAMP, default NOW(). Dikelola otomatis oleh Laravel.

### 6.7 Tabel: tourguide_portfolios
Menyimpan foto portofolio yang diunggah oleh Tour Guide.
- `id` — BIGINT UNSIGNED, Primary Key, Auto Increment. ID portofolio.
- `tourguide_profile_id` — BIGINT UNSIGNED, Foreign Key ke tourguide_profiles.id, CASCADE DELETE. Profil Tour Guide pemilik portofolio.
- `image` — VARCHAR(255), NOT NULL. Path ke foto portofolio.
- `title` — VARCHAR(255), NULLABLE. Judul atau keterangan foto.
- `description` — TEXT, NULLABLE. Deskripsi tambahan portofolio.
- `created_at` — TIMESTAMP, default NOW(). Waktu diposting.
- `updated_at` — TIMESTAMP, default NOW(). Waktu terakhir diubah.

### 6.8 Tabel: destination_images
Menyimpan foto galeri tambahan untuk setiap destinasi.
- `id` — BIGINT UNSIGNED, Primary Key, Auto Increment. ID gambar.
- `destination_id` — BIGINT UNSIGNED, Foreign Key ke destinations.id, CASCADE DELETE. Destinasi pemilik foto.
- `image` — VARCHAR(255), NOT NULL. Path ke file foto.
- `order` — INTEGER, default 0. Urutan tampil foto di galeri.
- `created_at` — TIMESTAMP, default NOW(). Waktu foto diunggah.
- `updated_at` — TIMESTAMP, default NOW(). Dikelola otomatis oleh Laravel.

---

## 7. INTEGRASI API EKSTERNAL

### 7.1 API 1 — OpenStreetMap + Leaflet.js (Peta Interaktif)
- **Tujuan:** Menampilkan peta interaktif dengan marker destinasi wisata.
- **Library:** Leaflet.js v1.9.x (CDN atau npm).
- **Tile Provider:** OpenStreetMap — gratis, tidak perlu API key.
- **Digunakan di:** Halaman beranda (semua destinasi), halaman detail destinasi (lokasi spesifik), dan halaman Explore (peta bebas).
- **Cara kerja:** Data koordinat (latitude, longitude, nama destinasi) diambil dari database. Laravel mengirim data koordinat ke Blade view, kemudian JavaScript merender marker di peta.
- **Biaya:** Gratis sepenuhnya (open-source).

Contoh implementasi JavaScript minimal:
```javascript
const map = L.map('map').setView([-8.65, 115.21], 8);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
destinations.forEach(d => L.marker([d.lat, d.lng]).addTo(map).bindPopup(d.name));
```

### 7.2 API 2 — Open-Meteo (Cuaca Real-Time)
- **Tujuan:** Menampilkan data cuaca real-time di beranda (5 kota), halaman detail destinasi, dan halaman Explore.
- **Endpoint:** https://api.open-meteo.com/v1/forecast
- **Parameter yang digunakan:** latitude, longitude, current=temperature_2m,weathercode,relative_humidity_2m, hourly=temperature_2m,weathercode,precipitation_probability, daily=temperature_2m_max,temperature_2m_min,weathercode,precipitation_sum
- **API Key:** Tidak diperlukan — gratis tanpa autentikasi.
- **Cara kerja:** Data di-fetch via JavaScript di sisi client saat halaman dimuat.
- **Fallback:** Jika fetch gagal, tampilkan card "Data cuaca tidak tersedia saat ini" tanpa crash.
- **Biaya:** Gratis, batas 10.000 request per hari (lebih dari cukup).

Contoh URL request:
```
https://api.open-meteo.com/v1/forecast?latitude=-8.65&longitude=115.21&current=temperature_2m,weathercode&timezone=Asia/Makassar
```

---

## 8. ARSITEKTUR LARAVEL & STRUKTUR PROYEK

### 8.1 Pola MVC Laravel
Proyek menggunakan pola MVC (Model-View-Controller) bawaan Laravel:

- **Model (M)** — lokasi: `app/Models/` — berisi Eloquent ORM: User, Destination, DestinationImage, Review, Favorite, TourguideProfile, TourguideAvailability, TourguidePortfolio.
- **View (V)** — lokasi: `resources/views/` — berisi template Blade (.blade.php) untuk semua halaman HTML.
- **Controller (C)** — lokasi: `app/Http/Controllers/` — berisi logic bisnis: AuthController, HomeController, DestinationController, ReviewController, FavoriteController, TourguideProfileController, AdminController, ExploreController, ProfileController.
- **Routes** — lokasi: `routes/web.php` — berisi semua definisi URL dan middleware.
- **Middleware** — lokasi: `app/Http/Middleware/` — berisi RoleMiddleware yang mengecek role user sebelum akses halaman tertentu.
- **Database** — lokasi: `database/migrations/` — berisi file migrasi untuk semua tabel.

### 8.2 Struktur Route Utama (routes/web.php)

**Route Public (tanpa middleware):**
- GET `/` → HomeController@index
- GET `/about` → view about
- GET `/explore` → ExploreController@index
- GET `/destinations` → DestinationController@index
- GET `/destinations/{destination}` → DestinationController@show
- GET `/tourguides` → TourguideProfileController@index
- GET `/tourguides/{tourguideProfile}` → TourguideProfileController@show

**Route Auth (tamu saja — middleware: guest):**
- GET/POST `/login` → AuthController (Breeze)
- GET/POST `/register` → AuthController (Breeze)

**Route Authenticated (semua yang sudah login — middleware: auth):**
- POST `/logout` → AuthController@logout
- GET `/profile` → ProfileController@edit
- PATCH `/profile` → ProfileController@update
- DELETE `/profile` → ProfileController@destroy
- POST `/destinations/{destination}/reviews` → ReviewController@store
- DELETE `/reviews/{review}` → ReviewController@destroy
- POST `/destinations/{destination}/favorite` → FavoriteController@toggle
- GET `/favorites` → FavoriteController@index

**Route Tour Guide (middleware: auth, role:tourguide) — prefix: /tourguide:**
- GET `/dashboard` → TourguideProfileController@dashboard
- GET `/profile/edit` → TourguideProfileController@edit
- POST `/profile` → TourguideProfileController@update
- POST `/availability` → TourguideProfileController@storeAvailability
- DELETE `/availability/{availability}` → TourguideProfileController@destroyAvailability
- POST `/portfolio` → TourguideProfileController@storePortfolio
- DELETE `/portfolio/{portfolio}` → TourguideProfileController@destroyPortfolio

**Route Admin (middleware: auth, role:admin) — prefix: /admin:**
- GET `/dashboard` → AdminController@dashboard
- GET `/destinations/create` → DestinationController@create
- POST `/destinations` → DestinationController@store
- GET `/destinations/{destination}/edit` → DestinationController@edit
- PUT `/destinations/{destination}` → DestinationController@update
- DELETE `/destinations/{destination}` → DestinationController@destroy
- DELETE `/destinations/{destination}/images/{image}` → DestinationController@destroyImage
- POST `/tourguide` → AdminController@storeTourguide
- PATCH `/tourguide/{user}/toggle` → AdminController@toggleTourguide
- DELETE `/tourguide/{user}` → AdminController@destroyTourguide
- GET `/users` → AdminController@users
- DELETE `/users/{user}` → AdminController@destroyUser

**Route User (middleware: auth, role:user):**
- GET `/dashboard` → redirect ke /

---

## 9. SPESIFIKASI HALAMAN & KOMPONEN UI

### 9.1 Design System — Token Warna
Semua komponen UI menggunakan token warna berikut secara konsisten:
- **Deep Forest (#1B4332):** Digunakan untuk Header, Navbar background, tombol utama, heading berwarna.
- **Emerald (#2D6A4F):** Digunakan untuk hover state, aksen, badge, sub-heading.
- **Mint Fresh (#74C69D):** Digunakan untuk highlight, tag kategori, border aktif, footer accent.
- **Sandy Beige (#F4E9D8):** Digunakan sebagai background utama halaman (body).
- **Warm White (#FAFAF8):** Digunakan sebagai background card dan section alternatif.
- **Charcoal (#2D2D2D):** Digunakan untuk teks utama dan heading konten.
- **Soft Gray (#6B7280):** Digunakan untuk teks sekunder dan placeholder input.
- **Golden Sun (#F4A261):** Digunakan untuk rating bintang, tombol CTA, badge kategori.
- **Sky Blue (#90E0EF):** Digunakan untuk elemen cuaca dan badge lokasi.

Font yang digunakan: Plus Jakarta Sans untuk body/UI, Fraunces untuk display/tagline besar. Keduanya di-load via Google Fonts.

### 9.2 Struktur Halaman Lengkap
- **Beranda (/):** Hero, Search, Quick Tags, Peta, Cuaca, Destinasi Populer, Tour Guide, Stats. Bisa diakses semua orang.
- **Daftar Destinasi (/destinations):** Filter tab, filter lokasi, search, grid card destinasi. Bisa diakses semua orang.
- **Detail Destinasi (/destinations/{id}):** Foto hero, galeri foto, info, deskripsi, peta, cuaca (current + hourly + 7 hari), rute navigasi, review. Bisa diakses semua orang.
- **Explore (/explore):** Peta bebas full-screen, klik titik → cuaca real-time, input koordinat manual, tombol GPS. Bisa diakses semua orang.
- **Daftar Tour Guide (/tourguides):** Grid card TG, filter lokasi. Bisa diakses semua orang.
- **Detail Tour Guide (/tourguides/{id}):** Profil TG, kontak telepon, kalender availability, galeri portofolio. Bisa diakses semua orang.
- **Login (/login):** Form login terpusat + deteksi role. Hanya untuk tamu.
- **Register (/register):** Form registrasi user + validasi JS. Hanya untuk tamu.
- **About (/about):** Info platform, visi misi, tim We Bare Bears, tech stack. Bisa diakses semua orang.
- **Profil User (/profile):** Data diri, edit profil, favorit tersimpan, riwayat review. Hanya untuk user yang sudah login.
- **Dashboard TG (/tourguide/dashboard):** Overview, kelola availability, kelola portofolio foto, edit profil. Hanya untuk Tour Guide.
- **Admin Panel (/admin/dashboard):** Statistik, kelola destinasi/user/TG/review, modal tambah TG. Hanya untuk Admin.
- **Tambah Destinasi (/admin/destinations/create):** Form tambah destinasi lengkap. Hanya untuk Admin.
- **Edit Destinasi (/admin/destinations/{id}/edit):** Form edit destinasi + kelola galeri foto. Hanya untuk Admin.
- **Kelola User (/admin/users):** Tabel semua user + hapus akun. Hanya untuk Admin.

### 9.3 Komponen UI Global
- **Navbar:** Logo di kiri, menu di tengah (Home, Destinasi, Tour Guide, Explore, About), tombol Masuk+Daftar di kanan (untuk tamu) ATAU dropdown nama user (untuk yang sudah login). Background Deep Forest. Responsive dengan hamburger menu di mobile.
- **Footer:** Copyright, link destinasi, link about, nama anggota tim. Background slate-900, nama anggota berwarna emerald.
- **Tombol Primary:** Background secondary-container, teks on-secondary-container, border radius 8px, hover opacity 90%.
- **Destination Card:** Thumbnail foto, badge kategori, nama, lokasi, rating bintang, tombol favorit (untuk user login).
- **Tour Guide Card:** Foto profil, nama, lokasi, harga per hari, status badge (Aktif/Nonaktif).
- **Weather Card:** Background Sky Blue (#90E0EF), ikon material symbols cuaca, suhu besar, kelembaban, kondisi cuaca.

---

## 10. USER FLOW

### 10.1 Alur Tamu (Tanpa Login)
1. Buka BearTrails → melihat halaman beranda (/) dengan hero, peta, cuaca.
2. Cari destinasi via search bar → diarahkan ke /destinations?q={keyword}.
3. Browse & filter destinasi di halaman /destinations (filter kategori & lokasi).
4. Klik card destinasi → melihat halaman detail /destinations/{id} (foto, cuaca, peta, review).
5. Lihat Tour Guide terkait → klik link TG → /tourguides/{id}.
6. Coba klik tombol Favorit atau tulis Review → sistem redirect ke /login.
7. Registrasi di /register → submit → redirect ke beranda (otomatis login).

### 10.2 Alur User (Setelah Login)
1. Login di /login → session dibuat → redirect ke beranda (/).
2. Browse destinasi di /destinations → klik card.
3. Simpan favorit dengan klik ❤️ → POST ke /destinations/{id}/favorite → toggle favorit.
4. Tulis review melalui form di /destinations/{id} → POST → review langsung tampil.
5. Hubungi Tour Guide: buka /tourguides/{id} → lihat nomor telepon → hubungi langsung di luar platform.
6. Cek profil di /profile → lihat daftar favorit & riwayat review.
7. Logout: klik Keluar → POST /logout → session dihapus → redirect ke beranda.

### 10.3 Alur Tour Guide
1. Terima akun dari Admin via email berisi kredensial login.
2. Login pertama kali di /login → sistem deteksi role tourguide → redirect ke /tourguide/dashboard.
3. Lengkapi profil: edit bio, lokasi, harga per hari, nomor telepon, foto profil.
4. Atur availability: tambah tanggal ketersediaan satu per satu.
5. Upload portofolio: tambah foto beserta judul dan deskripsi.
6. User menemukan profil TG di /tourguides/{id} lalu menghubungi langsung via telepon.

### 10.4 Alur Admin
1. Login di /login → sistem deteksi role admin → redirect ke /admin/dashboard.
2. Tambah destinasi baru di /admin/destinations/create → isi form lengkap → simpan.
3. Buat akun Tour Guide baru via modal di /admin/dashboard → isi data TG → buat akun.
4. Kirim kredensial ke Tour Guide via email (di luar platform).
5. Moderasi review di dashboard admin → hapus review yang melanggar aturan.
6. Kelola user di /admin/users → hapus akun yang bermasalah jika perlu.

---

## 11. DASHBOARD TOUR GUIDE — SPESIFIKASI DETAIL

### 11.1 Tampilan Dashboard
Dashboard Tour Guide terdiri dari beberapa section:
- **Header Profil:** Foto TG, nama, lokasi, harga per hari, status akun.
- **Ringkasan:** Jumlah jadwal aktif, jumlah foto portofolio.
- **Kelola Availability:** Tabel tanggal yang sudah ada + form tambah tanggal baru + tombol Hapus per baris.
- **Kelola Portofolio:** Grid foto portofolio + form upload foto baru (multiple) + tombol hapus per foto.
- **Edit Profil:** Form edit: foto, bio, lokasi, harga per hari, nomor telepon.

### 11.2 Form Kelola Availability
- **Tanggal:** Date picker (available_date). Validasi: tidak boleh sebelum hari ini.
- **Status:** Dropdown — 'available' atau 'booked'. Default: available.

### 11.3 Form Kelola Portofolio
- **Foto:** File upload multiple (jpg/png). Wajib diisi, maksimal 2MB per foto.
- **Judul:** Text input. Opsional, maksimal 255 karakter.
- **Deskripsi:** Textarea. Opsional.

### 11.4 Halaman Detail Tour Guide (Tampilan Publik — /tourguides/{id})
Yang dilihat User ketika membuka halaman detail TG:
- Foto profil TG, nama, lokasi, harga per hari, rating, status (Aktif/Nonaktif).
- Bio atau deskripsi TG.
- Informasi kontak: nomor telepon TG.
- Daftar tanggal availability — menampilkan kapan TG tersedia dan statusnya.
- Grid foto portofolio beserta judul dan deskripsi.

Penting: Tidak ada tombol booking atau konfirmasi di dalam platform. Semua komunikasi dilanjutkan di luar platform via telepon.

---

## 12. ERROR HANDLING & EDGE CASES

- **API Open-Meteo timeout/error:** Tampilkan card "Data cuaca tidak tersedia" tanpa crash halaman.
- **Tile map Leaflet gagal load:** Tampilkan kotak placeholder dengan pesan "Peta tidak dapat dimuat".
- **User akses halaman dilindungi tanpa login:** Redirect ke /login dengan flash message "Harap login terlebih dahulu".
- **User (role: user) akses /tourguide/dashboard:** 403 Forbidden — middleware block + redirect ke login.
- **Upload foto melebihi 2MB:** Validasi di controller (nullable|image|max:2048), return error message ke form.
- **Destinasi tidak ditemukan (ID salah/tidak ada):** Tampilkan halaman 404 custom BearTrails.
- **Duplikasi favorit:** Toggle behavior — jika sudah ada di favorites, hapus; jika belum ada, tambah.
- **Login dengan credential salah:** Flash message "Email atau password salah". Form tidak di-clear.
- **Ownership check:** User hanya bisa hapus review miliknya sendiri. TG hanya bisa hapus availability dan portofolio miliknya sendiri.

---

## 13. KETERKAITAN DENGAN TIGA MATA KULIAH

### 13.1 Pemrograman Web
Deliverable utama: Website BearTrails yang berfungsi penuh.
- **Frontend:** HTML5, CSS3 dengan token warna, JavaScript ES6+, responsive design.
- **Backend:** Laravel — routing, controller, Blade, Eloquent ORM, session, middleware.
- **Database:** MySQL dengan migrasi Laravel, seeder untuk data dummy.
- **Integrasi API:** Leaflet.js + OpenStreetMap, Open-Meteo (fetch client-side).
- **Fitur Khusus:** Toggle favorit, filter dinamis, form validasi JS, upload foto, galeri lightbox, rute navigasi GPS.

### 13.2 Rekayasa Perangkat Lunak (RPL)
Deliverable: Dokumentasi (dokumen ini = SRS) + diagram-diagram teknis.
- **SRS (dokumen ini):** Bab 1-12 mencakup semua requirements.
- **Use Case Diagram:** Berdasarkan Bab 4 (Fitur) + Bab 3 (Role & Akses).
- **Activity Diagram:** Berdasarkan Bab 10 (User Flow).
- **Sequence Diagram:** Berdasarkan Bab 8 (Arsitektur) — contoh: alur login, alur favorit.
- **Test Cases:** Berdasarkan Bab 12 (Error Handling & Edge Cases).

### 13.3 Analisis & Perancangan Berorientasi Objek (APBO)
Deliverable: Diagram UML lengkap.
- **Class Diagram:** Berdasarkan Bab 6 (Database) — 8 tabel = 8 class utama.
- **ERD (Entity Relationship Diagram):** Berdasarkan Bab 6 — relasi antar tabel.
- **Use Case Diagram:** Berdasarkan Bab 4 & Bab 3 — aktor dan use case.
- **Sequence Diagram:** Berdasarkan Bab 10 — alur login, hubungi TG, simpan favorit.
- **State Diagram:** Untuk tombol favorit (toggle), status akun TG (active/inactive), status availability (available/booked).
- **Component Diagram:** Berdasarkan Bab 7 & 8 — komponen sistem (Frontend, Backend, DB, API Eksternal).

---

## 14. PENUTUP

Dokumen SRS BearTrails v3.0 mencakup seluruh aspek sistem dari perspektif fungsional, teknis, dan desain. Dokumen ini telah disesuaikan dengan implementasi aktual proyek.

*BearTrails SRS v3.0 | We Bare Bears | 2026 — "Follow the Trail, Discover the World"*