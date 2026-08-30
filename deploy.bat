@echo off
color 0A
title DEPLOY - COACH AGAM

echo.
echo  =========================================
echo   AUTO DEPLOY :: COACH AGAM
echo  =========================================
echo.

:: ── STEP 1: Cek ada perubahan ────────────────────────────────
echo  [1/4] Staging semua perubahan...
git add .

:: Cek apakah ada sesuatu yang perlu di-commit
git diff --cached --quiet
if %errorlevel% == 0 (
    echo.
    echo  [!] Tidak ada perubahan baru. Lanjut push dan deploy server...
    goto :push
)

:: ── STEP 2: Commit ───────────────────────────────────────────
set "ts=%date:~6,4%-%date:~3,2%-%date:~0,2% %time:~0,5%"
echo  [2/4] Commit: Deploy %ts%
git commit -m "Deploy: %ts%"
if %errorlevel% neq 0 (
    echo.
    echo  [X] Commit GAGAL! Periksa status git.
    pause
    exit /b 1
)

:: ── STEP 3: Push ke GitHub ───────────────────────────────────
:push
echo.
echo  [3/4] Push ke GitHub...
git push origin main
if %errorlevel% neq 0 (
    echo.
    echo  [X] Push GAGAL! Periksa koneksi atau SSH key GitHub.
    pause
    exit /b 1
)

:: ── STEP 4: Pull & Clear Cache di Hostinger ──────────────────
echo.
echo  [4/4] Deploy ke server Hostinger (git pull + clear cache)...
ssh -p 65002 u664715641@46.202.186.86 "cd ~/domains/coachagam.hvmdigital.id/public_html && git pull origin main && /usr/bin/php artisan route:clear && /usr/bin/php artisan view:clear && /usr/bin/php artisan cache:clear && echo '[OK] SERVER UPDATED'"

if %errorlevel% neq 0 (
    echo.
    echo  [!] SSH/Deploy server mungkin butuh password atau ada error.
    echo      Cek output di atas.
) else (
    echo.
    echo  =========================================
    echo   [OK] DEPLOY BERHASIL! Cek website kamu.
    echo  =========================================
)

echo.
pause
