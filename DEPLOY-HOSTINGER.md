# ================================================================
# COACH AGAM — Panduan Deploy ke Hostinger
# ================================================================

## Struktur Deploy yang Direkomendasikan (Hostinger Shared Hosting)

Hostinger shared hosting memiliki `public_html` sebagai web root.
Kita upload Laravel dengan pendekatan **"project di luar public_html"**:

```
home/
├── public_html/          ← Web root (hanya isi dari public/ Laravel)
│   ├── index.php         ← Entry point (path diupdate)
│   ├── .htaccess         ← Apache rewrite rules
│   ├── build/            ← Compiled Vite assets
│   └── ...file publik lainnya
│
└── laravel/              ← Seluruh project Laravel (1 level di atas public_html)
    ├── app/
    ├── bootstrap/
    ├── config/
    ├── database/
    ├── resources/
    ├── routes/
    ├── storage/
    ├── vendor/
    └── ...
```

---

## LANGKAH-LANGKAH DEPLOY

### 1. Build Assets di Lokal (WAJIB sebelum upload)
```bash
npm run build
```
Ini akan menghasilkan folder `public/build/` yang harus ikut diupload.

### 2. Upload via File Manager / FTP

**Upload folder `public/` ke `public_html/`:**
- Semua isi dari `public/` → masuk ke `public_html/`
- Termasuk: `index.php`, `.htaccess`, `build/`, `favicon.ico`, dll.

**Upload sisa project ke folder `laravel/` (1 level di atas `public_html`):**
- Folder: `app/`, `bootstrap/`, `config/`, `database/`, `resources/`, `routes/`, `storage/`, `vendor/`
- File: `.env`, `artisan`, `composer.json`, dll.
- **JANGAN upload**: `node_modules/`, `.git/`, `public/` (sudah di-upload ke public_html)

### 3. Update `index.php` di `public_html/`

Ubah path di baris autoloader dan bootstrap:

```php
// SEBELUM (default Laravel):
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// SESUDAH (sesuaikan path ke folder laravel/):
require __DIR__.'/../laravel/vendor/autoload.php';
$app = require_once __DIR__.'/../laravel/bootstrap/app.php';
```

### 4. Buat Database di Hostinger hPanel

1. Login ke **hPanel** → **Databases** → **MySQL Databases**
2. Buat database baru, misal: `u123456789_coachagam`
3. Buat user database dengan password kuat
4. Assign user ke database dengan semua privilege

### 5. Update `.env` untuk Produksi

Upload file `.env` ke folder `laravel/` dengan isi:

```env
APP_NAME="Coach Agam"
APP_ENV=production
APP_KEY=base64:xxxx...   # Jangan diubah dari lokal
APP_DEBUG=false
APP_URL=https://coachagam.com

APP_TIMEZONE=Asia/Jakarta
APP_LOCALE=id

DB_CONNECTION=mysql
DB_HOST=127.0.0.1        # Hostinger biasanya pakai 127.0.0.1
DB_PORT=3306
DB_DATABASE=u123456789_coachagam
DB_USERNAME=u123456789_coachagam_user
DB_PASSWORD=PasswordKuatAnda

SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

> ⚠️ **JANGAN** upload `.env` lokal langsung. Buat `.env` baru khusus produksi.

### 6. Jalankan Artisan via SSH (Hostinger Premium)

Jika Hostinger plan Anda mendukung SSH:
```bash
cd ~/laravel
php artisan migrate --force
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link
```

Jika **tidak ada SSH** → jalankan migration via route sementara (lihat langkah 7).

### 7. Migration Tanpa SSH (Hostinger Starter)

Jika tidak ada SSH, buat route sementara untuk menjalankan migrasi:
- Akses `https://coachagam.com/run-migrate-temp` setelah deploy
- **Langsung hapus route tersebut setelah selesai!**

### 8. Permissions (via File Manager)

Set permission berikut via hPanel File Manager:
```
storage/           → 775 (rekursif)
bootstrap/cache/   → 775
```

### 9. Verifikasi

1. Akses `https://coachagam.com` → Homepage harus tampil
2. Akses `https://coachagam.com/admin/login` → Login admin
3. Login dengan: `admin@coachagam.com` / `Admin@2025` (lalu segera ganti!)

---

## FILE `.env` PRODUKSI (Template Lengkap)

```env
APP_NAME="Coach Agam"
APP_ENV=production
APP_KEY=base64:COPY_DARI_FILE_ENV_LOKAL_ANDA
APP_DEBUG=false
APP_URL=https://coachagam.com

APP_TIMEZONE=Asia/Jakarta
APP_LOCALE=id
APP_FALLBACK_LOCALE=id
APP_FAKER_LOCALE=id_ID

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_hostinger
DB_USERNAME=nama_user_hostinger
DB_PASSWORD=password_database_anda

SESSION_DRIVER=file
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=.coachagam.com

CACHE_STORE=file
QUEUE_CONNECTION=sync

MAIL_MAILER=smtp
MAIL_HOST=smtp.hostinger.com
MAIL_PORT=587
MAIL_USERNAME=info@coachagam.com
MAIL_PASSWORD=email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="info@coachagam.com"
MAIL_FROM_NAME="Coach Agam"

VITE_APP_NAME="Coach Agam"
```

---

## CHECKLIST SEBELUM GO LIVE

- [ ] `npm run build` dijalankan — folder `public/build/` ada
- [ ] Semua file terupload dengan benar
- [ ] `index.php` di `public_html/` path-nya sudah diupdate
- [ ] `.env` produksi sudah dibuat dengan `APP_DEBUG=false`
- [ ] Database sudah dibuat di hPanel
- [ ] Migration sudah dijalankan
- [ ] `storage/` permission 775
- [ ] Admin password sudah diganti dari default
- [ ] SSL/HTTPS aktif di hPanel

---

## TROUBLESHOOTING UMUM

| Error | Solusi |
|-------|--------|
| 500 Internal Server Error | Cek `.env` sudah ada dan benar |
| 403 Forbidden | Cek `.htaccess` di `public_html/` ada |
| Blank page | Set `APP_DEBUG=true` sementara, cek error log |
| Assets tidak load | Pastikan `public/build/` terupload |
| DB connection failed | Cek `DB_HOST`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` |
| Session error | Pastikan `storage/framework/sessions/` writable (775) |
