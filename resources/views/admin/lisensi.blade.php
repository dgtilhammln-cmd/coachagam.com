<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Manajemen Lisensi — Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Montserrat', sans-serif;
            background: #0f0f0f;
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .card {
            background: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 520px;
        }
        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 32px;
        }
        .brand-icon {
            width: 42px;
            height: 42px;
            background: #fff;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .brand-text {
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.3px;
        }
        .brand-sub {
            font-size: 10px;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 1px;
        }
        h1 {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin-bottom: 6px;
        }
        .subtitle {
            font-size: 12px;
            color: #666;
            margin-bottom: 28px;
            line-height: 1.6;
        }
        .status-block {
            background: #111;
            border: 1px solid #2a2a2a;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 28px;
        }
        .status-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 13px;
            color: #888;
            margin-bottom: 10px;
        }
        .status-row:last-child { margin-bottom: 0; }
        .status-row strong {
            font-weight: 600;
            color: #fff;
        }
        .badge-active {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(34,197,94,0.12);
            color: #22C55E;
            border: 1px solid rgba(34,197,94,0.3);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-expired {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(239,68,68,0.12);
            color: #EF4444;
            border: 1px solid rgba(239,68,68,0.3);
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .dot {
            width: 6px;
            height: 6px;
            border-radius: 50%;
            display: inline-block;
        }
        .dot-green { background: #22C55E; }
        .dot-red { background: #EF4444; animation: blink 1s infinite; }
        @keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0.3; } }

        .countdown {
            text-align: center;
            padding: 16px 0;
            border-top: 1px solid #2a2a2a;
            border-bottom: 1px solid #2a2a2a;
            margin-bottom: 28px;
        }
        .countdown-label {
            font-size: 10px;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }
        .countdown-numbers {
            display: flex;
            justify-content: center;
            gap: 16px;
        }
        .countdown-unit {
            text-align: center;
        }
        .countdown-val {
            font-size: 32px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
            letter-spacing: -2px;
        }
        .countdown-lbl {
            font-size: 10px;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 4px;
        }
        .sep { font-size: 28px; font-weight: 300; color: #333; align-self: center; margin-bottom: 16px; }
        
        form label {
            display: block;
            font-size: 11px;
            font-weight: 700;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 8px;
        }
        form input[type="date"] {
            width: 100%;
            background: #111;
            border: 1px solid #2a2a2a;
            color: #fff;
            padding: 12px 16px;
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
            font-size: 14px;
            outline: none;
            margin-bottom: 16px;
            transition: border-color 200ms;
        }
        form input[type="date"]:focus { border-color: #444; }
        form input[type="date"]::-webkit-calendar-picker-indicator { filter: invert(1); }
        
        .btn {
            width: 100%;
            padding: 14px;
            background: #fff;
            color: #000;
            border: none;
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.5px;
            cursor: pointer;
            text-transform: uppercase;
            transition: background 200ms, transform 100ms;
        }
        .btn:hover { background: #e5e5e5; }
        .btn:active { transform: scale(0.99); }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .alert-success { background: rgba(34,197,94,0.12); color: #22C55E; border: 1px solid rgba(34,197,94,0.3); }
        .alert-error { background: rgba(239,68,68,0.12); color: #EF4444; border: 1px solid rgba(239,68,68,0.3); }

        .footer-note {
            text-align: center;
            margin-top: 24px;
            font-size: 11px;
            color: #444;
        }
        .footer-note a { color: #666; text-decoration: none; }
        .footer-note a:hover { color: #999; }
    </style>
</head>
<body>
@php
    use App\Http\Middleware\CheckLicense;
    use Carbon\Carbon;
    $expiryDate = CheckLicense::getExpiryDate();
    $isActive   = CheckLicense::isActive();
    $daysLeft   = CheckLicense::daysRemaining();
    $hours      = (int) now()->diffInHours($expiryDate, false);
    $mins       = (int) now()->diffInMinutes($expiryDate, false) % 60;
    $secs       = (int) now()->diffInSeconds($expiryDate, false) % 60;
@endphp

<div class="card">
    <div class="brand">
        <div class="brand-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="2.5" stroke-linecap="round">
                <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
        </div>
        <div>
            <div class="brand-text">Manajemen Lisensi</div>
            <div class="brand-sub">HVM Digital — Admin</div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
            {{ session('success') }}
        </div>
    @endif
    @error('expiry_date')
        <div class="alert alert-error">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ $message }}
        </div>
    @enderror

    <div class="status-block">
        <div class="status-row">
            <span>Status Lisensi</span>
            @if($isActive)
                <span class="badge-active"><span class="dot dot-green"></span> Aktif</span>
            @else
                <span class="badge-expired"><span class="dot dot-red"></span> Expired</span>
            @endif
        </div>
        <div class="status-row">
            <span>Berakhir Tanggal</span>
            <strong>{{ $expiryDate->translatedFormat('d F Y') }}</strong>
        </div>
        <div class="status-row">
            <span>Sisa Waktu</span>
            <strong>{{ $daysLeft > 0 ? $daysLeft . ' Hari' : 'Lisensi Expired' }}</strong>
        </div>
        <div class="status-row">
            <span>Client</span>
            <strong>Coach Agam — coachagam.hvmdigital.id</strong>
        </div>
    </div>

    {{-- Countdown --}}
    @if($isActive && $daysLeft <= 30)
    <div class="countdown">
        <div class="countdown-label">Countdown berakhir</div>
        <div class="countdown-numbers" id="countdown" data-expiry="{{ $expiryDate->toIso8601String() }}">
            <div class="countdown-unit">
                <div class="countdown-val" id="cd-days">{{ $daysLeft }}</div>
                <div class="countdown-lbl">Hari</div>
            </div>
            <div class="sep">:</div>
            <div class="countdown-unit">
                <div class="countdown-val" id="cd-hours">--</div>
                <div class="countdown-lbl">Jam</div>
            </div>
            <div class="sep">:</div>
            <div class="countdown-unit">
                <div class="countdown-val" id="cd-mins">--</div>
                <div class="countdown-lbl">Menit</div>
            </div>
            <div class="sep">:</div>
            <div class="countdown-unit">
                <div class="countdown-val" id="cd-secs">--</div>
                <div class="countdown-lbl">Detik</div>
            </div>
        </div>
    </div>
    @endif

    {{-- Update Form --}}
    <form method="POST" action="{{ route('admin.lisensi.update') }}">
        @csrf
        <label for="expiry_date">Perpanjang Periode Lisensi</label>
        <input type="date" name="expiry_date" id="expiry_date"
               min="{{ now()->addDay()->format('Y-m-d') }}"
               value="{{ $expiryDate->format('Y-m-d') }}">
        <button type="submit" class="btn">
            Simpan & Aktifkan Lisensi Baru
        </button>
    </form>

    <div class="footer-note">
        Dikembangkan oleh <a href="https://hvmdigital.id" target="_blank" rel="noopener">HVM Digital</a> &nbsp;·&nbsp;
        <a href="{{ route('admin.dashboard') }}">Kembali ke Dashboard</a>
    </div>
</div>

<script>
(function() {
    const el = document.getElementById('countdown');
    if (!el) return;
    const expiry = new Date(el.dataset.expiry);
    function pad(n) { return String(n).padStart(2, '0'); }
    function tick() {
        const now = new Date();
        const diff = Math.max(0, Math.floor((expiry - now) / 1000));
        const d = Math.floor(diff / 86400);
        const h = Math.floor((diff % 86400) / 3600);
        const m = Math.floor((diff % 3600) / 60);
        const s = diff % 60;
        const dEl = document.getElementById('cd-days');
        const hEl = document.getElementById('cd-hours');
        const mEl = document.getElementById('cd-mins');
        const sEl = document.getElementById('cd-secs');
        if (dEl) dEl.textContent = pad(d);
        if (hEl) hEl.textContent = pad(h);
        if (mEl) mEl.textContent = pad(m);
        if (sEl) sEl.textContent = pad(s);
        if (diff > 0) setTimeout(tick, 1000);
    }
    tick();
})();
</script>
</body>
</html>
