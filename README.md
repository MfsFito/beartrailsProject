# BearTrails

Platform wisata interaktif berbasis web untuk menemukan destinasi wisata di Indonesia, melihat cuaca real-time, menjelajahi peta, serta terhubung dengan Tour Guide terverifikasi.

*"Follow the Trail, Discover the World"*

## Sitemap

Sitemap BearTrails ada di (sitemap_beartrails.jpg)
![Sitemap BearTrails](sitemap_beartrails.jpg)

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