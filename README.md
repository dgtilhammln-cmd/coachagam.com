# AHP Training - Coach Agam ⚽

Sistem Informasi, Manajemen Profil, dan Analisis Performa Pemain Sepakbola Profesional. Platform ini dirancang secara khusus untuk memberikan laporan dan visualisasi performa setiap atlet secara *real-time* kepada pelatih dan pemain, dibalut dengan desain UI/UX bertema *dark-mode* yang modern, premium, dan sangat interaktif.

---

## 👨‍💻 Developer & Pembuat
- **Developer:** Ilham Maulana
- **Agensi:** HVM Digital (hvmdigital.id)

---

## 🚀 Fitur Utama (Features)

### 1. User Interface (Front-End) yang Elegan & Interaktif
- **Premium Dark Mode UI:** Antarmuka dengan balutan warna gelap profesional layaknya aplikasi statistik sepakbola papan atas Eropa.
- **Mobile Responsive:** Berjalan sangat mulus dan *responsive* di perangkat Desktop, Tablet, maupun Smartphone.
- **Dua Mode Tampilan Card (List Pemain):** Pengguna dapat memilih mode tampilan daftar pemain menggunakan mode **Carousel (SwiperJS)** atau **Grid Kotak**, yang perubahannya terjadi secara *real-time* tanpa perlu memuat ulang halaman.
- **Advanced Multi-term Search System:** Sistem pencarian cerdas yang memungkinkan pengguna mencari berdasarkan Nama, Nomor Registrasi (No Reg), Angka murni dari No Reg, ataupun kombinasi keduaya (contoh: "Ronaldo 07") secara instan.
- **Filter Berdasarkan Posisi:** Pemilahan data pemain berdasarkan posisi (ALL, GK, DEF, MID, ATT).

### 2. Halaman Analisis & Profil Pemain (Player Profile)
- **Data Demografi Otomatis:** Perhitungan umur otomatis (dari tanggal lahir), tinggi, berat, status aktif, dan nomor registrasi.
- **Visualisasi Grafik Data (Chart.js):** 
  - **Radar Chart:** Menampilkan gambaran umum (Overview) performa pemain di setiap atribut secara *spider-web* untuk memudahkan identifikasi titik kuat/lemah pemain.
  - **Bar/Line Chart:** Melacak rekam jejak progres fisik per sesi (Pre Test, Post Test, dll).
- **Tabel Komparasi & Trend Analysis (Pre-Test vs Post-Test):** Tabel yang menyoroti perkembangan antar fase latihan, dilengkapi dengan panah kalkulasi persentase, dan indikator cerdas (hijau untuk progres positif, merah untuk regresi).

### 3. Fitur Head-to-Head & Export
- **Live Player Comparison (H2H):** Bandingkan dua pemain yang berbeda di dalam satu layar. Didukung oleh kustomisasi dropdown super elegan (Alpine.js) dan tabel komparasi interaktif yang bisa di-*swipe* ke samping saat dibuka di *mobile*.
- **Generate & Download PDF:** Fitur untuk mengunduh laporan analisis progres dan rapot nilai per-sesi milik pemain ke dalam format dokumen PDF.

### 4. Admin Panel & Backend 
- **Manajemen Data Pemain:** CRUD (Create, Read, Update, Delete) biodata dan pasfoto atlet.
- **Manajemen Sesi Uji & Data Medis/Fisik:** Form pencatatan lengkap mulai dari BMI, Body Fat, MoCA Score, akurasi *Passing*, *Scanning*, *Acceleration 0-10m*, hingga *Yo-Yo Test*.
- **Website Settings & SEO Management:** 
  - Dynamic Meta Tags (Title, Description, Keyword, Schema.org).
  - Open Graph & Twitter Cards Setup.
  - Pengelolaan teks statis, logo, hero banner, dan pengaturan *script* bawaan.

### 5. Hosting / cPanel Ready
- **Symlink Generator (`setup_symlink.php`):** *Script* sakti bawaan yang dirancang untuk mempermudah migrasi ke *shared hosting* / cPanel agar seluruh foto pemain selalu tersinkronisasi dan tampil sempurna *(real-time)* tanpa repot berurusan dengan *command-line*.

---

## 🛠️ Stack Teknologi (Tech Stack)

Proyek ini dibangun di atas pondasi arsitektur teknologi web modern:
- **Backend / Framework Utama:** Laravel 11 (PHP 8.2+)
- **Database:** MySQL
- **Templating Engine:** Laravel Blade
- **Frontend Interactivity:** Alpine.js (Lightweight Javascript Framework)
- **Styling:** Custom Vanilla CSS & CSS Variables (Bebas framework gemuk / *bloated-free* untuk menjamin perfoma *loading* super cepat).
- **Data Visualization (Chart):** Chart.js
- **Carousel & Swiping:** Swiper.js

---

## ⚙️ Cara Instalasi Singkat

1. Jalankan `composer install` untuk mengunduh library PHP.
2. Gandakan file `.env.example` ke `.env` dan masukkan konfigurasi database lokal Anda.
3. Jalankan `php artisan key:generate`.
4. Jalankan migrasi dan seeder: `php artisan migrate:fresh --seed` (jika tersedia).
5. Tautkan storage *local* agar gambar dapat dibaca browser: `php artisan storage:link`.
6. Hidupkan server: `php artisan serve`.
7. Siap! Buka `http://127.0.0.1:8000` di *browser*.

*(Bagi instalasi Cpanel: Jangan lupa ikuti petunjuk menggunakan file setup_symlink.php di dalam public_html)*

---

*© Copyright HVM Digital - Ilham Maulana*
