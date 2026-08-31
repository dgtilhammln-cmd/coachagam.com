# Coach Agam — Platform Analisis Performa Atlet Sepakbola

**Website:** https://coachagam.hvmdigital.id
**Developer:** Ilham Maulana | **Agensi:** HVM Digital (hvmdigital.id)
**Lisensi Aktif s/d:** 26 Juni 2027

Platform profesional berbasis Laravel 11 untuk manajemen profil, analisis performa, dan laporan medis/fisik atlet sepakbola — dirancang khusus untuk Coach Agam dan program pembinaan AHP Training.

---

## Daftar Isi

- Tech Stack
- Fitur Halaman Publik
- Fitur AHP Training (Publik)
- Fitur Admin Panel
- Sistem AHP Training (Admin)
- Sistem Blog
- CRM Leads
- Analytics
- Lisensi (Hidden)
- SEO dan Teknis
- Cara Instalasi
- Deploy ke Hostinger

---

## Tech Stack

| Layer | Teknologi |
|---|---|
| Backend | Laravel 11 (PHP 8.2+) |
| Database | MySQL |
| Templating | Laravel Blade |
| Frontend Interactivity | Alpine.js |
| Styling | Vanilla CSS + CSS Variables |
| Charts | Chart.js |
| Carousel | Swiper.js |
| PDF | Barryvdh/Laravel-DomPDF |
| Excel Import | Maatwebsite/Laravel-Excel |

---

## Fitur Halaman Publik

### Beranda (/)
- Hero section dengan slide dinamis (bisa diubah dari admin)
- Section profil singkat Coach Agam
- Highlight program AHP Training
- Section CTA menuju WhatsApp
- Footer dengan social media links

### Profil Coach Agam (/profil-coach-agam)
- Foto profil, biodata, dan deskripsi lengkap
- Timeline karier (dikustomisasi dari admin)
- Riwayat Pendidikan
- Sertifikasi & Lisensi
- Pengalaman Organisasi
- Prestasi & Pencapaian
- Informasi kontak dan sosial media
- CV Preview & Download (/profil-coach-agam/cv)

### Blog (/blog)
- Daftar artikel dengan thumbnail dan kategori
- Filter berdasarkan kategori (/blog/category/{slug})
- Halaman detail artikel dengan SEO lengkap (/blog/{slug})
- Meta description, OG tags, Schema.org per artikel

### Kontak (/kontak)
- Form kontak yang terhubung ke WhatsApp
- Tracking klik WhatsApp via API

### Galeri (/gallery)
- Galeri foto kegiatan dan training yang dikustomisasi dari admin

---

## Fitur AHP Training (Publik)

### Halaman Utama (/ahp-training)
- Penjelasan program dan keunggulan
- Tombol CTA untuk bergabung / kontak

### Pencarian Pemain (/ahp-training/search)
- Multi-term Search: Nama, No Reg, angka No Reg, atau kombinasi
- Filter Posisi: ALL, GK, DEF, MID, ATT
- Dua mode tampilan:
  - Carousel (Swiper.js): kartu bergeser horizontal, premium
  - Grid Kotak: tampilan grid standar
- Ganti mode tampilan secara real-time tanpa reload halaman

### Daftar Pemain (/ahp-training/player)
- Daftar semua pemain aktif beserta statistik ringkas

### Profil Pemain (/ahp-training/player/{slug})
Hero Section:
- Foto cutout pemain dengan background kustom
- No Reg sebagai watermark besar
- Posisi, usia otomatis (dihitung real-time dari tanggal lahir), tinggi, berat
- Tombol share ke WhatsApp, Twitter/X, Facebook, Copy Link

Grafik Analisis (Chart.js):
- Radar Chart: Overview 7 metrik utama (BMI, MoCA, Passing, Scanning, Acceleration, Speed, Yo-Yo)
- Bar Chart: Progres per sesi (BMI, MoCA Score, Passing Sukses)

Tabel Komparasi Pre Test vs Post Test:
- 17+ metrik dibandingkan secara otomatis
- Indikator warna: hijau = progres positif, merah = regresi
- Persentase perubahan per metrik

Metrik yang ditampilkan:
WEIGHT (kg), Body Mass Index (BMI), Body Fat Percentage2, Skeletal Muscle Mass,
Skor MoCA INA, Jumlah Total Passing, Passing Sukses, Passing Gagal,
Jumlah Scaning (per 10 detik), Initial Acceleration (0-10m)2,
Acceleration Phase (10-20m)3, Maximal Speed/ Velocity (20-30m)4,
RAST Test, Level, Balikan, Distance, Vo2max

Download Laporan PDF:
- Download laporan satu sesi tertentu
- Download laporan gabungan semua sesi

### Download PDF (/ahp-training/player/{slug}/pdf)
- Foto, biodata, data sesi, semua metrik dengan rating (Excellent/Good/Average/Fair/Poor)
- Bisa difilter per sesi via ?session={id}

### Verifikasi Sertifikat (/verify-certificate)
- Form verifikasi sertifikat keikutsertaan program

---

## Fitur Admin Panel

URL Admin: /admin
Login: /admin/login
Dilindungi middleware admin (session auth) + middleware CheckLicense.

### Dashboard Admin (/admin)
- Ringkasan: jumlah pemain AHP, total sesi, total blog post
- Card info lisensi sistem
- Akses cepat ke semua modul

### Settings General (/admin/settings/general)
- Nama website, tagline, meta description global
- Google Analytics ID, Facebook Pixel ID
- Script kustom head/body
- Logo website & favicon

### Settings Homepage (/admin/settings/homepage)
- Manajemen Slide Hero Banner (tambah, hapus, ubah)
- Upload foto hero per slide
- Judul, subjudul, dan teks CTA per slide

### Settings Header (/admin/settings/header)
- Logo header
- Pengaturan warna dan style navigasi

---

## Sistem AHP Training (Admin)

URL Dasar: /admin/ahp-training

### Dashboard AHP (/admin/ahp-training)
- Statistik: total pemain, total sesi, total data hasil test

### Manajemen Pemain (/admin/ahp-training/players)
- Daftar pemain
- CRUD: Tambah / Edit / Hapus pemain
- Field: No Reg, Nama, Posisi, Tanggal Lahir, Status aktif/nonaktif
- Upload foto profil dan foto OG (Social Media)
- Usia dihitung otomatis dari tanggal lahir (real-time)

### Manajemen Sesi Test (/admin/ahp-training/sessions)
- Daftar sesi dengan jumlah data per sesi
- Buat sesi baru:
  - Label dari dropdown (Pre Test, Post Test, Program Latihan, Evaluation Training Load, dll.)
  - Atau ketik label kustom manual (override dropdown)
  - Format nama sesi otomatis: [Label] [Tanggal] (contoh: Post Test 28 Juli 2026)
  - Tanggal & waktu test, Lokasi/venue, Suhu/cuaca, Minggu ke-, Catatan pelatih
- Edit sesi — ubah semua informasi sesi yang sudah dibuat
- Hapus sesi (konfirmasi, semua data hasil test ikut terhapus)

### Input Hasil Test (/admin/ahp-training/sessions/{id}/results)
- Tabel input semua metrik per pemain dalam satu sesi
- Kolom AGE di-lock, dihitung otomatis dari tanggal lahir pemain
- Notifikasi edukasi AGE di bagian atas form
- Kolom input lengkap:
  HEIGHT (cm), WEIGHT (kg), Body Mass Index (BMI), Body Fat Percentage2,
  Skeletal Muscle Mass, Skor MoCA INA, Jumlah Total Passing,
  Passing Sukses, Passing Gagal, Jumlah Scaning (per 10 detik),
  Initial Acceleration (0-10m)2, Acceleration Phase (10-20m)3,
  Maximal Speed/ Velocity (20-30m)4, RAST Test, Level, Balikan,
  Distance, Vo2max, Catatan Rating
- Simpan semua data sekaligus (bulk save)

### Import Data Excel/CSV (/admin/ahp-training/sessions/{id}/import)
- Upload file Excel (.xlsx, .xls) atau CSV
- Preview panduan visual format kolom yang benar
- AGE dihitung otomatis oleh sistem, tidak perlu diisi di file
- Data dibaca dari baris ke-5 (baris 1-4 dianggap header)
- Tombol download template CSV

### Template CSV (/admin/ahp-training/results/download-template)
- Download template CSV dengan header kolom format benar
- Disertai satu baris contoh data

---

## Sistem Blog

### Admin Blog — Posts (/admin/blog/posts)
- Buat, edit, hapus artikel
- WYSIWYG editor untuk konten
- Thumbnail / cover image
- Slug URL otomatis dari judul
- Meta description & keywords per artikel
- Status: Draft / Published
- Assign ke kategori

### Admin Blog — Kategori (/admin/blog/categories)
- Tambah, edit, hapus kategori
- Slug otomatis

### Pages Blog Settings (/admin/pages/blog)
- Pengaturan teks dan heading halaman blog publik

---

## CRM Leads

URL: /admin/crm

- Daftar leads masuk dari form kontak dan klik WhatsApp
- Detail per lead (nama, nomor HP, pesan, sumber)
- Update status: New / Contacted / Converted / Rejected
- Hapus lead

---

## Analytics

URL: /admin/analytics

- Dashboard analitik pengunjung website
- Grafik jumlah kunjungan harian (interaktif, wave chart)
- Statistik per halaman (page views)
- Tracking klik WhatsApp terpisah
- Data tersimpan di database lokal (tabel analytics_logs)

---

## Lisensi (Hidden)

URL: /admin/lisensi
PENTING: Halaman ini tersembunyi dari sidebar, tidak dapat diakses publik/klien.

- Info lisensi: tanggal aktif dan tanggal berakhir
- Update periode lisensi baru
- Mekanisme:
  - Jika lisensi kadaluarsa, seluruh halaman publik otomatis DOWN
  - Jika lisensi diperpanjang (update tanggal), website langsung aktif kembali
  - Lisensi aktif hingga 26 Juni 2027
- Info "Developed by HVM Digital" ditampilkan di dashboard admin

---

## Pages Management (Admin)

### Profil Coach Agam (/admin/pages/profile)
- Upload foto profil
- Edit biodata (nama, gelar, deskripsi)
- Kelola Timeline karier (tambah/hapus)
- Kelola Riwayat Pendidikan
- Kelola Sertifikasi & Lisensi
- Kelola Pengalaman Organisasi
- Kelola Prestasi & Pencapaian
- Kelola Info Kontak & Sosial Media

### Galeri (/admin/pages/gallery)
- Upload foto galeri kegiatan
- Edit judul & deskripsi per foto
- Hapus foto

### Footer (/admin/pages/footer)
- Edit teks, link, dan konten footer

### AHP Training Page Settings (/admin/pages/ahp-training)
- Edit konten halaman publik AHP Training
- Upload foto latar belakang hero
- Edit teks CTA, deskripsi program

---

## SEO dan Teknis

### SEO Otomatis
- Sitemap XML dinamis (/sitemap.xml) — semua halaman publik, blog, profil pemain
- robots.txt (/robots.txt)
- llms.txt untuk AI crawlers (/llms.txt)
- Meta title, description, keywords per halaman
- Open Graph tags (Facebook, WhatsApp)
- Twitter Cards (X/Twitter)
- Schema.org JSON-LD per halaman (Person, BlogPosting, CollectionPage, BreadcrumbList)
- Canonical URL di setiap halaman

### Tracking
- Google Analytics ID via admin settings
- Facebook Pixel ID via admin settings
- Tracking klik WhatsApp via POST /api/track/wa
- Tracking lead via POST /api/track/lead

---

## Cara Instalasi

1. Clone repository
   git clone https://github.com/dgtilhammln-cmd/coachagam.com.git

2. Install dependensi PHP
   composer install

3. Setup environment
   copy .env.example .env
   (Edit .env: isi DB_*, APP_URL, dll.)

4. Generate key
   php artisan key:generate

5. Jalankan migrasi
   php artisan migrate

6. Link storage (untuk foto, galeri, dll.)
   php artisan storage:link

7. Jalankan server lokal
   php artisan serve

Buka http://127.0.0.1:8000 — Admin di http://127.0.0.1:8000/admin

---

## Deploy ke Hostinger

Lihat panduan lengkap di DEPLOY-HOSTINGER.md

Quick deploy:
  .\deploy.bat

Script otomatis:
1. git add -A
2. git commit (timestamp otomatis)
3. git push ke GitHub
4. SSH ke Hostinger: git pull + clear cache Laravel

---

## Struktur Direktori Penting

app/
  Http/
    Controllers/
      Admin/
        AhpPlayerController.php
        AhpSessionController.php
        AhpResultController.php
        AnalyticsController.php
        BlogController.php
        CrmController.php
        Pages/  (ProfileCoachAgam, Gallery, Footer, AhpTraining settings)
      AhpTrainingController.php   (frontend AHP)
    Middleware/
      CheckLicense.php            (middleware lisensi sistem)
  Imports/
    AhpTestResultImport.php       (logic import Excel)
  Models/
    AhpPlayer.php
    AhpTestSession.php
    AhpTestResult.php             (22 kolom metrik termasuk vo2max)
    AnalyticsLog.php
    Lead.php
    Post.php
    SiteSetting.php

resources/views/
  admin/
    ahp-training/
      players/
      sessions/    (create, edit, index)
      results/     (index=input, import)
    blog/
    crm/
    analytics/
    settings/
    pages/
  pages/
    ahp/
      player.blade.php         (profil pemain, premium dark UI)
      pdf.blade.php            (template laporan PDF)
      players-list.blade.php
    blog/
    profile.blade.php
    cv-preview.blade.php

---

(c) 2026-2027 HVM Digital - Ilham Maulana. All rights reserved.
