@extends('layouts.app')

@section('title', 'Cari Profil Pemain — AHP Training')
@section('meta_description', 'Cari data dan profil perkembangan pemain AHP Training menggunakan kode NO REG.')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<style>
    .ahp-search-wrap {
        min-height: 100vh;
        background: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Inter', sans-serif;
        padding: 60px 20px;
        position: relative;
        overflow: hidden;
    }
    .ahp-search-wrap::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse at 50% 0%, rgba(26,26,26,0.03) 0%, transparent 60%),
                    radial-gradient(ellipse at 80% 80%, rgba(163,163,163,0.05) 0%, transparent 50%);
        pointer-events: none;
    }
    .search-card {
        background: #FFFFFF;
        border: 1px solid #E5E5E5;
        padding: 52px 48px;
        max-width: 520px;
        width: 100%;
        position: relative;
        z-index: 1;
        animation: fadeUp 0.6s ease both;
    }
    @keyframes fadeUp { from { opacity:0; transform:translateY(24px); } to { opacity:1; transform:translateY(0); } }
    .ahp-badge {
        display: inline-block;
        background: #FAFAFA;
        border: 1px solid #1A1A1A;
        color: #1A1A1A;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        padding: 5px 12px;
        margin-bottom: 24px;
    }
    .search-title {
        font-size: 32px;
        font-weight: 800;
        color: #1A1A1A;
        line-height: 1.2;
        margin-bottom: 10px;
        letter-spacing: -0.02em;
    }
    .search-subtitle {
        font-size: 14px;
        color: #6B7280;
        margin-bottom: 36px;
        line-height: 1.6;
    }
    .search-input-wrap {
        position: relative;
        margin-bottom: 16px;
    }
    .search-input {
        width: 100%;
        background: #FAFAFA;
        border: 1px solid #E5E5E5;
        color: #1A1A1A;
        font-size: 18px;
        font-family: 'JetBrains Mono', monospace;
        font-weight: 600;
        padding: 16px 20px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
    }
    .search-input::placeholder { color: #9CA3AF; }
    .search-input:focus {
        border-color: #1A1A1A;
        box-shadow: 0 0 0 3px rgba(26,26,26,0.1);
    }
    .search-btn {
        width: 100%;
        background: #1A1A1A;
        border: none;
        color: #FFFFFF;
        font-size: 14px;
        font-weight: 800;
        font-family: 'Inter', sans-serif;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        padding: 16px 24px;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.2s;
    }
    .search-btn:hover { background: #333333; transform: translateY(-1px); }
    .search-btn:active { transform: translateY(0); }
    .error-box {
        background: rgba(239,68,68,0.1);
        border: 1px solid rgba(239,68,68,0.3);
        color: #DC2626;
        font-size: 13px;
        padding: 12px 16px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .hint-text {
        font-size: 11px;
        color: #6B7280;
        margin-top: 16px;
        text-align: center;
        line-height: 1.6;
    }
    .hint-text code {
        font-family: 'JetBrains Mono', monospace;
        color: #1A1A1A;
        background: #FAFAFA;
        border: 1px solid #E5E5E5;
        padding: 2px 6px;
        font-size: 11px;
    }
    .bg-grid {
        position: absolute;
        inset: 0;
        background-image: linear-gradient(rgba(0,0,0,0.03) 1px, transparent 1px),
                          linear-gradient(90deg, rgba(0,0,0,0.03) 1px, transparent 1px);
        background-size: 40px 40px;
        pointer-events: none;
    }
</style>
</head>
<body>
<div class="ahp-search-wrap">
    <div class="bg-grid"></div>
    <div class="search-card">
        <div class="ahp-badge">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;margin-right:4px;"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"/><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"/><path d="M4 22h16"/><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"/><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"/><path d="M18 2H6v7a6 6 0 0 0 12 0V2z"/></svg>
            AHP Training
        </div>
        <h1 class="search-title">Cari<br>Profil Pemain</h1>
        <p class="search-subtitle">Masukkan kode NO REG pemain untuk melihat data perkembangan lengkap dari sesi Pre Test hingga Post Test.</p>

        @if(session('error'))
        <div class="error-box">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('ahp.player.resolve') }}" method="GET">
            <div class="search-input-wrap">
                <input
                    type="text"
                    name="no_reg"
                    class="search-input"
                    placeholder="AHP-03"
                    value="{{ old('no_reg', request('no_reg')) }}"
                    autofocus
                    autocomplete="off"
                    maxlength="20"
                >
            </div>
            <button type="submit" class="search-btn">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                &nbsp;Cari Pemain
            </button>
        </form>

        <p class="hint-text">
            Contoh kode: <code>AHP-03</code>, <code>AHP-07</code>, <code>AHP-15</code><br>
            Kode diberikan oleh Coach Agam saat pendaftaran program.
        </p>
    </div>
</div>
</body>
</html>
@endsection
