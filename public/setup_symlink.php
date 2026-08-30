<?php
/**
 * Script Bantuan untuk Membuat Symlink Storage di cPanel/Shared Hosting
 * 
 * CARA PENGGUNAAN DI HOSTING (CPANEL):
 * 1. Pindahkan semua isi folder public/ ke dalam public_html/
 * 2. Buka browser dan akses: namadomainanda.com/setup_symlink.php
 * 3. File upload akan otomatis tersinkron / realtime ke folder public_html/storage.
 */

// Menentukan letak target folder (storage asli) dan folder tujuan symlink (public_html/storage)
// Asumsi: folder core laravel ada tepat 1 tingkat di bawah folder file ini berjalan
$targetFolder = realpath(__DIR__ . '/../storage/app/public');
$linkFolder = __DIR__ . '/storage';

if (!$targetFolder) {
    die("Target folder (storage/app/public) tidak ditemukan. Pastikan folder framework laravel berada pada struktur yang tepat.");
}

if (file_exists($linkFolder)) {
    die("Folder atau Symlink 'storage' sudah ada di dalam public. Hapus folder tersebut terlebih dahulu jika ingin menghubungkan ulang (symlink).");
}

try {
    symlink($targetFolder, $linkFolder);
    echo "<h2>Sukses!</h2>";
    echo "Symlink berhasil dibuat. Folder <b>public/storage</b> sekarang sudah terhubung secara <i>real-time</i> dengan <b>storage/app/public</b>.";
    echo "<br><br><i>Catatan: Setelah sukses, sangat disarankan untuk MENGHAPUS file setup_symlink.php ini demi keamanan.</i>";
} catch (Exception $e) {
    echo "<h2>Gagal!</h2>";
    echo "Gagal membuat symlink. Hal ini biasanya karena fungsi symlink() diblokir oleh pihak Hosting (cPanel).<br>";
    echo "Pesan Error: " . $e->getMessage();
}
