# BearTrails

**Platform Wisata Interaktif Lombok**  
*Follow the Trail, Discover the World*

## 📋 Deskripsi Project

BearTrails adalah website yang membantu wisatawan menemukan destinasi wisata di Lombok, melihat informasi cuaca real-time, peta interaktif, serta terhubung langsung dengan Tour Guide lokal terverifikasi.

Project ini dibangun menggunakan **Laravel 12** dengan pendekatan tim selama 6 hari untuk mensimulasikan proses pengembangan software secara kolaboratif.

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
├── public/assets/
└── README.md
```

## 🎯 Sitemap

![Sitemap BearTrails](sitemap_beartrails.jpg)

---

## 👏 Terima Kasih