# BearTrails

**Platform Wisata Interaktif Lombok**  
*Follow the Trail, Discover the World*

## 📋 Deskripsi Project

BearTrails adalah website yang membantu wisatawan menemukan destinasi wisata di Lombok, melihat informasi cuaca real-time, peta interaktif, serta terhubung langsung dengan Tour Guide lokal terverifikasi.

---

## ✨ Fitur Utama

### Untuk Pengguna
- Jelajah destinasi dengan filter dan pencarian
- Detail destinasi lengkap (peta, cuaca real-time, forecast 7 hari, galeri foto, review)
- Fitur rute menuju destinasi
- Simpan destinasi favorit
- Daftar & detail Tour Guide + jadwal ketersediaan
- Profil pengguna + riwayat review

### Untuk Tour Guide
- Dashboard khusus Tour Guide
- Kelola profil, jadwal ketersediaan, dan portofolio
- Verifikasi akun oleh Admin

### Untuk Admin
- Kelola destinasi, user, dan Tour Guide
- Toggle status Tour Guide
- Monitoring review dan data platform

---

## 👥 Tim Pengembang

| Nama       | Role              | Tanggung Jawab Utama                          |
|------------|-------------------|-----------------------------------------------|
| **FATIO**  | Fullstack         | Database, Migration, Model, Integrasi API, Seeder, Deployment |
| **ALIF**   | Backend           | Controller, Middleware, Logic, Authentication, Authorization |
| **RIVAL**  | Frontend          | UI/UX, Blade Template, Responsive Design, Styling |

## 🛠 Tech Stack

| Kategori       | Teknologi                          |
|----------------|------------------------------------|
| Backend        | Laravel 12                         |
| Frontend       | Blade Template + Alpine.js         |
| Styling        | Tailwind CSS v4                    |
| Database       | MySQL                              |
| Mapping        | Leaflet.js + OpenStreetMap         |
| Weather        | Open-Meteo API                     |
| Authentication | Laravel Breeze                     |
| Lainnya        | Git, Composer, npm, Vite           |


## 📁 Struktur Folder Utama

```
BearTrails/
├── app/Models/                 # Semua Eloquent Models
├── app/Http/Controllers/       # Controller
├── database/migrations/        # Migration files
├── database/seeders/           # Seeder & Factory
├── resources/views/            # Blade Templates
│   ├── layouts/
│   ├── destinations/
│   ├── tourguides/
│   └── admin/
├── routes/web.php
├── BUG/                        # Dokumentasi Bug
│   ├── SS Bug 1/
│   ├── SS Bug 2/
│   ├── SS Bug 3/
│   └── SS Bug 4/
├── public/assets/
└── README.md
```

## 🎯 Sitemap

![Sitemap BearTrails](sitemap_beartrails.jpg)

---

## Bug Log

### Bug 1 — Halaman Explore Tidak Ditemukan

Gejala: Klik menu Explore di navbar → error 500 `View [explore] not found`

Langkah reproduksi:
1. Buka website BearTrails
2. Klik menu Explore di navbar
3. Halaman error 500 muncul

Hipotesis penyebab: Nama file view salah — tersimpan sebagai `explor.blade.php` bukan `explore.blade.php` (typo satu huruf)

Fix: Rename file dari `explor.blade.php` menjadi `explore.blade.php`

![Error 500 saat buka Explore](BUG/SS%20Bug%201/1.png)
![Nama file typo — explor.blade.php](BUG/SS%20Bug%201/2.png)
![Nama file sudah diperbaiki — explore.blade.php](BUG/SS%20Bug%201/3.png)
![Halaman Explore berhasil dibuka](BUG/SS%20Bug%201/4.png)

---

### Bug 2 — Dashboard Tour Guide Error 500

Gejala: Login sebagai Tour Guide → redirect ke dashboard → error 500 `Call to undefined method TourguideProfile::availabilities()`

Langkah reproduksi:
1. Login sebagai akun Tour Guide
2. Sistem redirect ke /tourguide/dashboard
3. Halaman error 500 muncul

Hipotesis penyebab: Relasi `availabilities()` dan `portfolios()` belum didefinisikan di Model `TourguideProfile`

Fix: Tambahkan relasi `hasMany` ke `TourguideAvailability` dan `TourguidePortfolio` di Model `TourguideProfile`

![Error 500 di dashboard Tour Guide](BUG/SS%20Bug%202/1.png)
![Code Model sebelum fix — relasi belum ada](BUG/SS%20Bug%202/2.png)
![Code Model setelah fix — relasi sudah ditambahkan](BUG/SS%20Bug%202/3.png)
![Dashboard Tour Guide berhasil dibuka](BUG/SS%20Bug%202/4.png)

---

### Bug 3 — Layout Galeri Foto Destinasi Kacau

Gejala: Halaman detail destinasi dengan lebih dari 1 foto galeri — layout foto berantakan dan tidak proporsional

Langkah reproduksi:
1. Buka halaman detail destinasi yang punya 3 atau lebih foto galeri
2. Layout foto terlihat kacau dan nabrak konten lain

Hipotesis penyebab: Layout grid galeri tidak menyesuaikan jumlah foto — semua kondisi dipaksa pakai grid 4 kolom meskipun fotonya hanya 2 atau 3

Fix: Tambahkan kondisi tampilan berdasarkan jumlah foto (1 foto = full width, 2 foto = 2 kolom, 3 foto = 3 kolom, 4+ foto = 1 besar kiri + grid kecil kanan)

![Layout galeri kacau](BUG/SS%20Bug%203/1.png)
![Layout galeri sudah rapi setelah fix](BUG/SS%20Bug%203/2.png)

---

### Bug 4 — Admin Tidak Bisa Hapus Review

Gejala: Login sebagai Admin → coba hapus review di halaman detail destinasi → error 403 Forbidden

Langkah reproduksi:
1. Login sebagai Admin
2. Buka halaman detail destinasi yang ada reviewnya
3. Klik tombol Hapus Review
4. Error 403 Forbidden muncul

Hipotesis penyebab: Method `destroy` di `ReviewController` hanya mengizinkan pemilik review yang bisa hapus, tidak ada pengecekan role admin

Fix:
```php
// Sebelum
if ($review->user_id !== auth()->id()) {
    abort(403);
}

// Setelah
if (auth()->user()->role !== 'admin' && $review->user_id !== auth()->id()) {
    abort(403);
}
```

![Error 403 saat admin hapus review](BUG/SS%20Bug%204/1.png)
![Code ReviewController sebelum fix](BUG/SS%20Bug%204/2.png)
![Code ReviewController setelah fix](BUG/SS%20Bug%204/3.png)

---

## AI Usage Statement

Penggunaan AI dalam project ini bersifat assistif — membantu memahami konsep dan debugging, bukan menggantikan proses belajar dan pengembangan.

### FATIO (Fullstack)

1) Tool: Claude AI (Anthropic)

2) Untuk apa:
- Memahami konsep migration Laravel (tipe data, foreign key, constraint)
- Memahami cara kerja Eloquent ORM dan relasi antar model
- Belajar cara integrasi Open-Meteo API dan Leaflet.js di Laravel
- Debugging error yang muncul saat development
- Memahami cara kerja seeder dan storage symlink

3) Prompt utama:
- "Jelaskan perbedaan hasMany dan belongsTo di Laravel Eloquent dengan contoh kasus tour guide dan availability"
- "Bagaimana cara fetch data dari Open-Meteo API menggunakan JavaScript dan tampilkan di Blade Laravel?"
- "Contoh migration Laravel lengkap dengan berbagai tipe data (string, decimal, enum, foreignId, timestamps)"

4) Bagian output AI yang dipakai:
- Pemahaman konsep relasi Eloquent untuk Model TourguideProfile, TourguideAvailability, TourguidePortfolio
- Struktur fetch API Open-Meteo di JavaScript (parameter hourly, daily, current)
- Pemahaman cara kerja php artisan storage:link dan symlink

5) Bagian yang saya ubah dan alasan:
- Data seeder destinasi → diganti dengan destinasi nyata Lombok beserta koordinat GPS yang akurat
- Parameter API Open-Meteo → ditambah timezone=Asia/Makassar karena default UTC menyebabkan jam tidak sesuai waktu Indonesia Tengah (WITA)
- Struktur migration → disesuaikan dengan kebutuhan project (tambah kolom entry_fee, price_per_day, status, dll)

---

## 👏 Terima Kasih