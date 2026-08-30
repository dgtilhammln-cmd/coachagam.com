@echo off
color 0A
echo =======================================================
echo          AUTO DEPLOY SCRIPT - COACH AGAM
echo =======================================================
echo.

echo [1] Menambahkan semua file yang berubah ke Git...
git add .
echo.

:: Otomatis membuat pesan commit berdasarkan waktu saat ini
set commitMsg="Auto deploy update - %date% %time%"

echo.
echo [3] Menyimpan commit: %commitMsg%...
git commit -m %commitMsg%
echo.

echo [4] Mendorong (Push) kode ke GitHub Repository...
:: Pastikan branch utama bernama main, ganti 'master' jika Anda memakai master
git push origin main
echo.

echo [5] Membuka koneksi SSH ke Server dan menarik (Pull) kode terbaru...
ssh -p 65002 u664715641@46.202.186.86 "cd domains/coachagam.hvmdigital.id/public_html && git pull origin main && php artisan optimize:clear && php artisan view:clear"

echo.
echo =======================================================
echo               DEPLOYMENT BERHASIL! 
echo =======================================================
pause
