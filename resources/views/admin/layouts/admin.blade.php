<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Admin Panel') — Coach Agam</title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect width='100' height='100' fill='%231A1A1A'/><text y='.9em' font-size='80' x='10' fill='white'>A</text></svg>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js"></script>
    @stack('head')
    <style>
        /* ════════════════════════════════════════════════════════
           BRUTALISM-MINIMALIST ADMIN DESIGN SYSTEM
           Filosofi: Sudut 0px, Montserrat, Monokromatis, Slow Anim
        ════════════════════════════════════════════════════════ */

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            border-radius: 0 !important; /* ATURAN EMAS: TIDAK ADA LENGKUNGAN */
        }

        html { font-size: 16px; }

        body {
            font-family: 'Montserrat', sans-serif;
            background: #F5F5F5;
            color: #212121;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            font-weight: 400;
        }

        /* ── Sidebar Space ──────────────────────────────────── */
        .admin-sidebar-offset {
            margin-left: 256px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── Top Bar ────────────────────────────────────────── */
        .admin-topbar {
            height: 56px;
            background: #FFFFFF;
            border-bottom: 1px solid #E0E0E0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 28px;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        /* ── Content Area ───────────────────────────────────── */
        .admin-content {
            flex: 1;
            padding: 28px 28px 48px;
        }

        /* ── Cards ──────────────────────────────────────────── */
        .admin-card {
            background: #FFFFFF;
            border: 1px solid #E0E0E0;
            overflow: hidden;
        }
        .admin-card-header {
            padding: 16px 22px;
            border-bottom: 1px solid #E0E0E0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #FAFAFA;
        }
        .admin-card-header h2 {
            font-size: 13px;
            font-weight: 500;
            color: #212121;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }
        .admin-card-body { padding: 22px; }

        /* ── Form Elements ──────────────────────────────────── */
        .form-group { margin-bottom: 20px; }

        .form-label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            color: #9E9E9E;
            margin-bottom: 7px;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .form-label .hint { font-size: 11px; font-weight: 400; color: #9E9E9E; margin-left: 4px; }

        .form-input, .form-textarea, .form-select {
            width: 100%;
            background: #FFFFFF;
            border: 1px solid #E0E0E0;
            color: #212121;
            font-size: 13px;
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
            outline: none;
            transition: border-color 200ms cubic-bezier(0.22, 1, 0.36, 1);
        }
        .form-input, .form-select { padding: 10px 14px; }
        .form-textarea { padding: 10px 14px; resize: vertical; min-height: 88px; }
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            border-color: #212121;
        }
        .hint { font-size: 11px; color: #9E9E9E; margin-top: 5px; line-height: 1.4; }
        .form-hint { font-size: 11px; color: #9E9E9E; margin-top: 5px; line-height: 1.4; }
        .form-error { font-size: 12px; color: #C62828; margin-top: 5px; }

        /* ── Buttons ────────────────────────────────────────── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #1A1A1A;
            color: #FFFFFF;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 10px 22px;
            border: 1px solid #1A1A1A;
            cursor: pointer;
            text-decoration: none;
            transition: all 300ms cubic-bezier(0.22, 1, 0.36, 1);
        }
        .btn-primary:hover {
            background: #333333;
            border-color: #333333;
        }

        .btn-silver {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #F5F5F5;
            color: #212121;
            font-size: 12px;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            padding: 10px 22px;
            border: 1px solid #E0E0E0;
            cursor: pointer;
            text-decoration: none;
            transition: all 300ms cubic-bezier(0.22, 1, 0.36, 1);
        }
        .btn-silver:hover {
            background: #EEEEEE;
            border-color: #BDBDBD;
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: transparent;
            color: #212121;
            font-size: 12px;
            font-weight: 500;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 0.04em;
            padding: 10px 22px;
            border: 1px solid #E0E0E0;
            cursor: pointer;
            text-decoration: none;
            transition: all 300ms cubic-bezier(0.22, 1, 0.36, 1);
        }
        .btn-outline:hover {
            border-color: #212121;
            background: #F5F5F5;
        }

        .btn-danger-soft {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: transparent;
            color: #C62828;
            font-size: 11px;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 0.05em;
            padding: 7px 14px;
            border: 1px solid #C62828;
            cursor: pointer;
            transition: all 200ms;
        }
        .btn-danger-soft:hover {
            background: #C62828;
            color: #FFFFFF;
        }

        /* ── Alert Banners ──────────────────────────────────── */
        .alert {
            padding: 12px 16px;
            font-size: 13px;
            font-weight: 400;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 3px solid;
        }
        .alert-success {
            background: #FFFFFF;
            border: 1px solid #E0E0E0;
            border-left: 3px solid #2E7D32;
            color: #2E7D32;
        }
        .alert-error {
            background: #FFFFFF;
            border: 1px solid #E0E0E0;
            border-left: 3px solid #C62828;
            color: #C62828;
        }
        .alert-info {
            background: #FFFFFF;
            border: 1px solid #E0E0E0;
            border-left: 3px solid #1A1A1A;
            color: #212121;
        }
        .alert-warning {
            background: #FFFFFF;
            border: 1px solid #E0E0E0;
            border-left: 3px solid #B45309;
            color: #B45309;
        }

        /* ── KPI / Stat Cards ───────────────────────────────── */
        .stat-card {
            background: #FFFFFF;
            border: 1px solid #E0E0E0;
            padding: 24px;
            display: flex;
            flex-direction: column;
            gap: 8px;
            transition: border-color 300ms cubic-bezier(0.22, 1, 0.36, 1);
        }
        .stat-card:hover { border-color: #9E9E9E; }
        .stat-card.dark {
            background: #1A1A1A;
            border-color: #1A1A1A;
        }
        .stat-icon {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            background: #F5F5F5;
            border: 1px solid #E0E0E0;
        }
        .stat-icon.dark { background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.12); }
        .stat-value {
            font-size: 36px;
            font-weight: 200;
            color: #212121;
            line-height: 1;
            letter-spacing: -0.02em;
        }
        .stat-value.dark { color: #FFFFFF; font-weight: 200; }
        .stat-label {
            font-size: 11px;
            font-weight: 400;
            color: #9E9E9E;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }
        .stat-label.dark { color: rgba(255,255,255,0.5); }
        .stat-trend {
            font-size: 11px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .stat-trend.up { color: #2E7D32; }
        .stat-trend.down { color: #C62828; }
        .stat-trend.dark-up { color: rgba(255,255,255,0.7); }

        /* ── Slide / Config Card ─────────────────────────────── */
        .slide-card {
            background: #FFFFFF;
            border: 1px solid #E0E0E0;
            margin-bottom: 12px;
            overflow: hidden;
        }
        .slide-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 18px;
            background: #FAFAFA;
            border-bottom: 1px solid #E0E0E0;
        }
        .slide-card-body { padding: 18px; }

        /* ── Tab Nav ────────────────────────────────────────── */
        .tab-nav {
            display: flex;
            gap: 0;
            border-bottom: 2px solid #E0E0E0;
            margin-bottom: 24px;
        }
        .tab-btn {
            padding: 10px 20px;
            font-size: 11px;
            font-weight: 600;
            font-family: 'Montserrat', sans-serif;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            border: none;
            background: transparent;
            cursor: pointer;
            color: #9E9E9E;
            position: relative;
            transition: color 200ms;
            display: flex;
            align-items: center;
            gap: 7px;
        }
        .tab-btn::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            height: 2px;
            background: #1A1A1A;
            transform: scaleX(0);
            transition: transform 250ms cubic-bezier(0.22, 1, 0.36, 1);
        }
        .tab-btn.active { color: #212121; }
        .tab-btn.active::after { transform: scaleX(1); }
        .tab-btn:hover:not(.active) { color: #424242; background: #F5F5F5; }

        /* ── Page Title ─────────────────────────────────────── */
        .page-title {
            font-size: 26px;
            font-weight: 300;
            color: #212121;
            letter-spacing: -0.01em;
        }
        .page-subtitle {
            font-size: 12px;
            font-weight: 400;
            color: #9E9E9E;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* ── Breadcrumb ─────────────────────────────────────── */
        .breadcrumb { display: flex; align-items: center; gap: 8px; font-size: 12px; }
        .breadcrumb a { color: #9E9E9E; text-decoration: none; font-weight: 400; transition: color 150ms; }
        .breadcrumb a:hover { color: #212121; }
        .breadcrumb-sep { color: #BDBDBD; }
        .breadcrumb-current { color: #424242; font-weight: 500; }

        /* ── Misc ───────────────────────────────────────────── */
        .divider { height: 1px; background: #E0E0E0; border: none; margin: 0; }

        /* ── Table Styles (Brutalist) ────────────────────────── */
        .data-table { width: 100%; border-collapse: collapse; }
        .data-table th {
            font-size: 10px;
            font-weight: 600;
            color: #9E9E9E;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 10px 16px;
            text-align: left;
            border-bottom: 1px solid #E0E0E0;
            background: #FAFAFA;
        }
        .data-table td {
            font-size: 13px;
            font-weight: 400;
            color: #212121;
            padding: 12px 16px;
            border-bottom: 1px solid #F0F0F0;
        }
        .data-table tr:last-child td { border-bottom: none; }
        .data-table tr:hover td { background: #FAFAFA; }
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 3px 9px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }
        .badge-dark { background: #1A1A1A; color: #FFFFFF; }
        .badge-light { background: #F5F5F5; color: #212121; border: 1px solid #E0E0E0; }
        .badge-success { background: #F5F5F5; color: #2E7D32; border: 1px solid #2E7D32; }
        .badge-danger { background: #F5F5F5; color: #C62828; border: 1px solid #C62828; }
        .badge-warning { background: #F5F5F5; color: #B45309; border: 1px solid #B45309; }

        /* ── Slow Animations ─────────────────────────────────── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        @keyframes growBar {
            from { transform: scaleY(0); opacity: 0; }
            to   { transform: scaleY(1); opacity: 1; }
        }
        @keyframes shimmer {
            0%   { background-position: -800px 0; }
            100% { background-position: 800px 0; }
        }
        .anim-fade-up {
            animation: fadeUp 1.2s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .anim-delay-1 { animation-delay: 0.1s; }
        .anim-delay-2 { animation-delay: 0.2s; }
        .anim-delay-3 { animation-delay: 0.3s; }
        .anim-delay-4 { animation-delay: 0.4s; }
        .skeleton {
            background: linear-gradient(90deg, #F5F5F5 25%, #E0E0E0 50%, #F5F5F5 75%);
            background-size: 800px 100%;
            animation: shimmer 2.5s cubic-bezier(0.22, 1, 0.36, 1) infinite;
        }

        /* ── Responsive ─────────────────────────────────────── */
        @media (max-width: 768px) {
            .admin-sidebar-offset { margin-left: 0; }
            .admin-content { padding: 20px 16px 40px; }
        }
    </style>
</head>
<body x-data="{ settingsOpen: {{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }} }">

    @include('admin.partials.sidebar')

    {{-- Main Area --}}
    <div class="admin-sidebar-offset">

        {{-- Top Bar --}}
        <header class="admin-topbar" role="banner">
            <nav class="breadcrumb" aria-label="Breadcrumb">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                @hasSection('breadcrumb')
                    <span class="breadcrumb-sep" aria-hidden="true">/</span>
                    @yield('breadcrumb')
                @endif
            </nav>

            <div style="display:flex;align-items:center;gap:20px;">
                <span style="font-size:11px;color:#9E9E9E;font-weight:400;text-transform:uppercase;letter-spacing:0.06em;">
                    {{ now()->locale('id')->translatedFormat('D, d M Y') }}
                </span>
                <div style="display:flex;align-items:center;gap:10px;">
                    {{-- Profile Square (no border-radius) --}}
                    <div style="
                        width: 30px; height: 30px;
                        background: #1A1A1A;
                        display: flex; align-items: center; justify-content: center;
                        font-size: 11px; font-weight: 700; color: #FFFFFF;
                        font-family: 'Montserrat', sans-serif;
                        flex-shrink: 0;
                    " aria-hidden="true">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}</div>
                    <span style="font-size:12px;font-weight:500;color:#212121;">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <span style="font-size:9px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;background:#F5F5F5;border:1px solid #E0E0E0;padding:3px 8px;">Administrator</span>
                </div>
            </div>
        </header>

        {{-- Page Content --}}
        <main class="admin-content" id="admin-main-content" tabindex="-1">

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="alert alert-success" role="alert" aria-live="polite">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="20 6 9 17 4 12"/></svg>
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="alert alert-error" role="alert" aria-live="assertive">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                {{ session('error') }}
            </div>
            @endif

            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>
</html>
