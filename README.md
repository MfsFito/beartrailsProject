# BearTrails

Platform wisata interaktif berbasis web untuk menemukan destinasi wisata di Indonesia, melihat cuaca real-time, menjelajahi peta, serta terhubung dengan Tour Guide terverifikasi.

*"Follow the Trail, Discover the World"*

## Sitemap

Sitemap BearTrails ada di (sitemap_beartrails.jpg)

---

## Fitur Utama

### Aktor Sistem
- Publik / Tamu
- User (Wisatawan)
- Tour Guide
- Administrator

### Halaman Utama
- `/` — Beranda
- `/destinations` — Daftar Destinasi + Filter & Search
- `/destinations/{id}` — Detail Destinasi (Peta, Cuaca, Review, Favorit, Rute)
- `/explore` — Peta Bebas + Cuaca di Titik Mana Saja
- `/tourguides` — Daftar Tour Guide
- `/tourguides/{id}` — Detail Tour Guide + Availability + Portofolio
- `/login` — Login Terpusat (semua role)
- `/register` — Registrasi User
- `/profile` — Profil User + Favorit + Riwayat Review
- `/tourguide/dashboard` — Dashboard Tour Guide
- `/admin/dashboard` — Admin Panel


## Tech Stack

- **Backend**     : Laravel 11 (PHP)
- **Frontend**    : Blade Template, HTML5, CSS, JavaScript
- **Styling**     : Tailwind CSS
- **Database**    : MySQL
- **Maps**        : Leaflet.js + OpenStreetMap
- **Weather**     : Open-Meteo API
- **Lainnya**     : Git, XAMPP

---

## Database

**Nama Database**: `beartrails`

**Tabel Utama**:
- `users`
- `destinations`
- `reviews`
- `favorites`
- `tourguide_profiles`
- `tourguide_availabilities`
- `tourguide_portfolios`

Detail skema tabel lengkap terdapat di folder `database/migrations/`.

## Cara Menjalankan Project

1. `git clone <repository-url>`
2. `cd beartrails`
3. `composer install`
4. `npm install && npm run dev`
5. `cp .env.example .env`
6. `php artisan key:generate`
7. `php artisan migrate --seed`
8. `php artisan serve`
