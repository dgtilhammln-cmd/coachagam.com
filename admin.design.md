# UI/UX Design Guidelines: Dashboard Sistem
**Dokumen:** `design.dashboard.md`
**Referensi Utama:** Layout "Skillset" Dashboard (Monokromatis, Minimalis)
**Modifikasi Utama:** Sudut tegas/lancip (0px border-radius), Tipografi tipis (Montserrat Light), Animasi pertumbuhan data slow-motion.

---

## 1. Filosofi Desain
Desain ini mengusung tema **Brutalism-Minimalist** yang profesional, bersih, dan berwibawa. Berbeda dengan tren modern yang serba membulat (*rounded*), dashboard ini menggunakan garis keras dan sudut tajam untuk menonjolkan ketegasan data, dipadukan dengan tipografi yang elegan dan tipis agar tidak terlihat kaku atau mengintimidasi.

## 2. Tipografi
Seluruh sistem menggunakan satu jenis font family untuk menjaga konsistensi dan kesan elegan.

* **Font Family Utama:** `Montserrat`, sans-serif.
* **Karakteristik (Sesuai Instruksi):** Dominan menggunakan *font-weight* tipis (kurus) untuk memberikan kesan modern dan ringan, mengimbangi sudut-sudut komponen yang tajam.
* **Penggunaan Bobot (Weight):**
    * **Extra Light (200) / Light (300):** Digunakan untuk angka statistik besar (misal: nominal $23,902 pada KPI card), *placeholder* input, dan teks deskripsi sekunder.
    * **Regular (400):** Digunakan untuk teks *body*, label tabel, dan menu sidebar navigasi.
    * **Medium (500):** Digunakan *hanya* untuk Header halaman atau penekanan metrik penting agar terbaca jelas (maksimal bobot yang digunakan, hindari Bold/700 kecuali sangat mendesak).

## 3. Bentuk dan Sudut (Shape & Geometry)
*Aturan Emas: Dilarang menggunakan lengkungan.*

* **Border Radius:** `0px` secara mutlak untuk seluruh elemen.
* **Penerapan:** Ini berlaku untuk *Card*, Tombol (*Buttons*), *Input Field* (Search bar), *Dropdown*, Label/Badge (seperti label "Paid" pada tabel), hingga *Tooltip*.
* **Borders:** Gunakan garis tepi (*border*) setebal `1px` dengan warna abu-abu terang (`#E0E0E0`) untuk memisahkan komponen jika tidak menggunakan *shadow*.

## 4. Palet Warna (Color Scheme)
Mengadaptasi gaya *high-contrast monochrome* dari referensi.

* **Background Utama:** `#F5F5F5` (Abu-abu sangat terang, mengurangi kelelahan mata).
* **Surface/Card:** `#FFFFFF` (Putih bersih untuk menonjolkan data).
* **Primary Accent/Dark Surface:** `#1A1A1A` (Hitam/Abu-abu sangat gelap untuk KPI Card utama atau tombol *Call-to-Action*).
* **Text (Primary):** `#212121` (Hitam keabu-abuan untuk kontras yang baik tanpa menyilaukan).
* **Text (Secondary/Muted):** `#9E9E9E` (Abu-abu untuk tanggal, label, *breadcrumb*).
* **Semantic Colors (Tipis/Muted):**
    * **Success/Growth:** `#2E7D32` (Hijau gelap untuk panah indikator naik/persentase positif).
    * **Danger/Decline:** `#C62828` (Merah gelap untuk metrik turun).

## 5. Layout & Struktur
* **Sidebar (Kiri):** Lebar tetap (sekitar `240px` - `260px`). Latar belakang putih mutlak, pemisah dengan konten utama menggunakan garis lurus vertikal tipis (`1px solid #EAEAEA`) tanpa bayangan (*shadow*).
* **Top Bar:** Berisi Global Search (kotak bersudut siku) dan Profile Picture (Jika menggunakan foto asli tetap persegi/kotak, BUKAN lingkaran).
* **Grid:** Menggunakan sistem 12-kolom standar untuk penempatan *Card* dan *Chart*.

## 6. Pedoman Komponen Utama
### A. KPI Cards (Statistik Ringkas)
* Bentuk kotak sempurna (sudut lancip).
* *Padding* luas (minimal `24px`) agar teks tipis Montserrat bisa "bernapas".
* Angka utama menggunakan ukuran besar (misal: `32px`) dengan Montserrat Light (300).
* *Card* yang di-highlight (seperti Total Revenue) menggunakan *background* hitam `#1A1A1A` dengan teks putih.

### B. Tabel Data
* Tidak ada garis vertikal di dalam tabel, hanya garis horizontal tipis (`1px solid #F0F0F0`) sebagai pemisah antar baris.
* *Header* tabel menggunakan font Montserrat Regular (400) warna abu-abu sekunder.
* Status Badge (misal: "Paid", "Pending") berbentuk persegi panjang bersudut tajam (`border-radius: 0`).

### C. Charts & Grafik
* **Bar Chart:** Batang grafik memiliki sudut atas rata/siku-siku 90 derajat (bukan kapsul/melengkung seperti di gambar referensi).
* **Donut Chart/Pie Chart:** Karena ini secara inheren berbentuk lingkaran, potongannya tetap presisi tanpa sudut membulat di ujung *slice*-nya.

---

## 7. Interaksi & Animasi (Sangat Penting)
Untuk memberikan efek dramatis dan elegan yang kontras dengan bentuk kotaknya yang kaku, sistem animasi dibuat **halus (smooth)** dan **lambat (slow-motion)**.

### Aturan Animasi Global
* **Timing Function:** Gunakan *Cubic Bezier* yang memberikan efek lambat di akhir. Contoh: `cubic-bezier(0.22, 1, 0.36, 1)` (ease-out-quint).
* **Duration:** `1.2s` hingga `2.0s` (Lebih lambat dari standar aplikasi biasa yang hanya 0.3s).

### Animasi Loading Data / Memasuki Halaman
1.  **Bar Charts (Grafik Batang):**
    * *Initial State:* Tinggi batang (`height` atau `scaleY`) = `0`, *opacity* = `0`.
    * *Animation:* Batang tumbuh dari garis bawah ke atas secara perlahan selama `1.5` detik. Jika ada beberapa batang, berikan *delay* (stagger) antar batang sebesar `0.1s` agar terlihat gelombang pertumbuhan lambat dari kiri ke kanan.
2.  **Line Charts (Grafik Garis):**
    * Garis tergambar secara perlahan dari kiri ke kanan (*stroke-dashoffset* animation) memakan waktu `2` detik penuh dengan pergerakan *smooth*.
3.  **Statistik Angka (Counter Up):**
    * Angka pada KPI Card (misal: $0 menjadi $23,902) bergulir atau bertambah dengan efek *ease-out* lambat selama `1.5` detik.
4.  **Skeleton Loading:**
    * Saat mengambil data dari API, tampilkan *skeleton/shimmer* berbentuk kotak-kotak tajam dengan pergerakan gradien cahaya yang sangat lambat, menjaga kesan tenang (*calm UI*).