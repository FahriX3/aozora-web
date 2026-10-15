# Aozora Web

Aplikasi web profil komunitas dan sistem manajemen kegiatan untuk Aozora Nihongo Club (ANC), ekstrakurikuler Bahasa dan Budaya Jepang di SMK Negeri 1 Purwokerto.

Proyek ini dibangun menggunakan Laravel 13 dan Filament v5 untuk menyediakan portal informasi publik bagi anggota dan siswa, sekaligus panel administrasi internal untuk mengelola kegiatan, dokumentasi, kepengurusan, dan inventaris barang milik klub.

---

## Fitur Utama

### Portal Publik
- Halaman beranda menampilkan profil klub, jadwal pertemuan mingguan, divisi minat (Kaiwa, Shodo, Cosplay, Matsuri, Anime & Manga, dan Edukasi), serta agenda kegiatan terdekat.
- Direktori agenda menyediakan rincian jadwal, rundown acara, koordinat lokasi kegiatan, galeri foto dokumentasi, dan tautan video aftermovie.
- Halaman pengurus memuat struktur pembina, pengurus harian, koordinator divisi, dan anggota aktif.
- Chatbot Sora AI (Sora-chan) berfungsi sebagai asisten interaktif untuk tanya-jawab seputar kegiatan klub dan materi dasar bahasa Jepang, dilengkapi respons streaming dan pembatasan token harian per pengguna.
- Sistem autentikasi mendukung pendaftaran dan masuk akun lokal maupun integrasi akun Google melalui Google OAuth.

### Panel Administrasi (Filament)
- Pengelolaan acara dan dokumentasi untuk menambah jadwal kegiatan, rundown susunan acara, titik lokasi, foto arsip, serta tautan video.
- Pengelolaan data pembina dan pengurus per divisi kepengurusan.
- Sistem inventaris untuk mendata perlengkapan klub, mencatat riwayat peminjaman barang, dan memproses laporan kerusakan aset.
- Pengaturan peran dan hak akses berbasis Spatie Permission untuk membedakan wewenang pengurus, koordinator kegiatan, koordinator inventaris, PDD, admin, hingga super admin.

---

## Teknologi yang Digunakan

- Backend: PHP 8.3+, Laravel 13
- Admin Panel: Filament v5
- Manajemen Hak Akses: Spatie Laravel Permission
- Autentikasi Eksternal: Laravel Socialite (Google OAuth)
- Frontend: Blade Templates, Tailwind CSS v4, Vite
- Integrasi Asisten AI: API model eksternal dengan response streaming (Server-Sent Events)
- Basis Data: SQLite (bawaan) atau MySQL / MariaDB

---

## Prasyarat Sistem

Sebelum menjalankan proyek, pastikan lingkungan komputer telah terpasang:
- PHP >= 8.3 dengan ekstensi pendukung Laravel (pdo, mbstring, openssl, tokenizer, xml, ctype, json, bcmath, curl, intl)
- Composer
- Node.js (versi 18 ke atas) dan NPM
- Server basis data seperti SQLite atau MySQL

---

## Panduan Instalasi Lokal

Ikuti langkah-langkah berikut untuk memasang dan menjalankan proyek di komputer lokal:

1. Unduh atau clone repositori:
   ```bash
   git clone https://github.com/FahriX3/aozora-web.git
   cd aozora-web
   ```

2. Pasang dependensi PHP:
   ```bash
   composer install
   ```

3. Pasang dependensi JavaScript:
   ```bash
   npm install
   ```

4. Siapkan berkas konfigurasi lingkungan:
   Salin berkas contoh `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   Buka berkas `.env` dan sesuaikan koneksi database. Secara bawaan, proyek dapat langsung menggunakan SQLite.

5. Buat Application Key aplikasi:
   ```bash
   php artisan key:generate
   ```

6. Jalankan migrasi basis data dan seeder data awal:
   ```bash
   php artisan migrate --seed
   ```
   Perintah ini membuat skema tabel sekaligus mengisi data awal peran, akun pengelola, susunan pengurus, dan contoh acara.

7. Kompilasi aset tampilan antarmuka:
   Untuk mode pengembangan aktif:
   ```bash
   npm run dev
   ```
   Atau untuk membangun berkas produksi:
   ```bash
   npm run build
   ```

8. Jalankan server lokal aplikasi:
   Buka jendela terminal baru lalu jalankan:
   ```bash
   php artisan serve
   ```
   Aplikasi publik dapat dibuka melalui peramban di `http://localhost:8000`.

---

## Akses Panel Admin

Panel manajemen Filament dapat diakses melalui alamat:
```
http://localhost:8000/admin
```

Akun bawaan hasil seeder yang dapat digunakan untuk masuk:
- Email: `admin@aozora.local`
- Kata Sandi: `password`
- Peran: `super_admin`

---

## Konfigurasi Layanan Tambahan

Buka berkas `.env` untuk melengkapi konfigurasi fitur eksternal bila diperlukan:

### Google OAuth
Untuk mengaktifkan autentikasi akun Google, tambahkan kredensial dari Google Cloud Console:
```env
GOOGLE_CLIENT_ID=isi_client_id_anda
GOOGLE_CLIENT_SECRET=isi_client_secret_anda
GOOGLE_REDIRECT_URI="${APP_URL}/auth/google/callback"
---

## Struktur Direktori Utama

- `app/Filament/Resources/`: Konfigurasi resource panel admin Filament (acara, dokumentasi, inventaris, pengurus, peran, pengguna).
- `app/Http/Controllers/`: Logika pemrosesan halaman publik, autentikasi, dan endpoint API chatbot Sora.
- `app/Models/`: Model Eloquent untuk seluruh entitas data aplikasi.
- `database/migrations/`: Berkas skema tabel basis data.
- `database/seeders/`: Pengisi data awal peran, pengguna, pengurus, inventaris, dan acara.
- `resources/views/`: Berkas template Blade untuk antarmuka pengguna web publik.
- `routes/web.php`: Rute halaman publik dan rute API internal.

---

## Lisensi

Proyek ini menggunakan lisensi [MIT](LICENSE).
