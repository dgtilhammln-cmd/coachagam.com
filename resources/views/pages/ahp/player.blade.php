@extends('layouts.app')

@section('title', $meta['title'])
@section('meta_description', $meta['description'])
@section('meta_keywords', $meta['keywords'])
@section('canonical', $meta['url'])

@push('head')
{{-- SEO & OpenGraph / Twitter Cards --}}
<meta property="og:title" content="{{ $meta['title'] }}">
<meta property="og:description" content="{{ $meta['description'] }}">
<meta property="og:image" content="{{ $meta['og_image'] }}">
<meta property="og:url" content="{{ $meta['url'] }}">
<meta property="og:type" content="profile">
<meta property="profile:first_name" content="{{ explode(' ', $player->name)[0] }}">
<meta property="profile:username" content="{{ $player->no_reg }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $meta['title'] }}">
<meta name="twitter:description" content="{{ $meta['description'] }}">
<meta name="twitter:image" content="{{ $meta['og_image'] }}">

{{-- AEO / Schema.org (JSON-LD) --}}
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@@type": "ListItem",
      "position": 1,
      "name": "Beranda",
      "item": "{{ url('/') }}"
    },
    {
      "@@type": "ListItem",
      "position": 2,
      "name": "AHP Training",
      "item": "{{ route('ahp.search') }}"
    },
    {
      "@@type": "ListItem",
      "position": 3,
      "name": "Profil Atlet: {{ $player->name }}",
      "item": "{{ url()->current() }}"
    }
  ]
}
</script>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
:root {
    --bg-dark: #000000;
    --card-dark: #0A0A0A;
    --border-dark: #222222;
    --text-main: #FFFFFF;
    --text-muted: #888888;
    --accent-red: #A3A3A3; /* Changed to silver as requested */
    --silver: #A3A3A3;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body { background: var(--bg-dark); color: var(--text-main); font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }

/* ── HERO SECTION (MAN UTD STYLE) ── */
.profile-hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    padding-top: 70px;
    overflow: hidden;
}

.hero-bg {
    position: absolute;
    inset: 0;
    background-size: cover;
    background-position: center top;
    background-repeat: no-repeat;
    opacity: 1;
    z-index: 1;
}
.profile-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.1) 50%, rgba(0,0,0,0.8) 100%),
                linear-gradient(to bottom, rgba(0,0,0,0.1) 0%, #000 100%);
    z-index: 2;
    pointer-events: none;
}

.hero-content {
    position: relative;
    z-index: 3;
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 40px;
    align-items: end;
    height: 100%;
}

/* Left Side */
.hero-left {
    padding-bottom: 60px;
    position: relative;
}
.breadcrumb {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    color: var(--text-main);
    margin-bottom: 80px;
    text-transform: uppercase;
}
.hero-watermark {
    position: absolute;
    bottom: -20px;
    left: -20px;
    font-size: 320px;
    font-weight: 900;
    color: rgba(255,255,255,0.03);
    line-height: 0.8;
    z-index: -1;
    pointer-events: none;
    font-family: 'Inter', sans-serif;
}
.crest-icon {
    width: 32px;
    height: auto;
    margin-bottom: 24px;
    filter: brightness(0) invert(1);
    opacity: 0.8;
}
.hero-name {
    font-size: 56px;
    font-weight: 800;
    color: #FFFFFF;
    text-transform: uppercase;
    line-height: 1;
    letter-spacing: -0.02em;
    margin-bottom: 8px;
    white-space: pre-line;
}
.hero-position {
    font-size: 16px;
    font-weight: 500;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--text-main);
}

/* Center Side (Photo) */
.hero-center {
    display: flex;
    justify-content: center;
    align-items: flex-end;
    height: 100%;
}
.hero-cutout {
    max-height: 75vh;
    width: auto;
    object-fit: contain;
    object-position: bottom;
    display: block;
    filter: drop-shadow(0 20px 40px rgba(0,0,0,0.5));
}

/* Right Side (Stats) */
.hero-right {
    padding-bottom: 60px;
}
.stats-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    padding-bottom: 12px;
    margin-bottom: 20px;
}
.stats-header span {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.15em;
    color: #FFFFFF !important;
}
.btn-choose {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    color: var(--text-main);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: color 0.2s;
}
.btn-choose:hover { color: var(--silver); }

.stats-table {
    display: flex;
    flex-direction: column;
    gap: 4px;
    margin-bottom: 32px;
}
.stat-row {
    display: grid;
    grid-template-columns: 140px 1fr;
    background: rgba(255,255,255,0.03);
    padding: 14px 16px;
    border-radius: 2px;
}
.stat-row:hover { background: rgba(255,255,255,0.06); }
.s-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.1em;
    color: var(--text-muted);
}
.s-val {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.05em;
    color: var(--text-main);
    font-family: 'JetBrains Mono', monospace;
}
.player-tracker {
    display: flex;
    justify-content: flex-end;
    align-items: center;
}
.pt-box {
    display: flex;
    border: 1px solid var(--accent-red);
    align-items: stretch;
}
.pt-label {
    padding: 8px 16px;
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    color: var(--text-main);
}
.pt-on {
    background: var(--accent-red);
    padding: 8px 16px;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 0.1em;
    color: var(--text-main);
}

/* ── DATA SECTION ── */
.data-section {
    background: var(--bg-dark);
    padding: 60px 20px 100px;
}
.ahp-container {
    max-width: 1100px;
    margin: 0 auto;
}
.section-title {
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--silver);
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 16px;
}
.section-title::after { content: ''; flex: 1; height: 1px; background: var(--border-dark); }

/* Charts */
.charts-grid {
    display: grid;
    grid-template-columns: 1fr 1.5fr;
    gap: 24px;
    margin-bottom: 40px;
}
.chart-card {
    background: var(--card-dark);
    border: 1px solid var(--border-dark);
    padding: 32px;
}
.chart-card-title {
    font-size: 12px;
    font-weight: 700;
    color: var(--text-main);
    letter-spacing: 0.1em;
    margin-bottom: 24px;
    display: flex;
    align-items: center;
    gap: 8px;
    text-transform: uppercase;
}
.chart-card-title::before {
    content: ''; width: 4px; height: 14px; background: var(--silver);
}

/* Table */
.compare-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
}
.compare-table th {
    background: var(--card-dark);
    border-bottom: 1px solid #444;
    padding: 14px 20px;
    text-align: left;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: var(--silver);
}
.compare-table td {
    padding: 16px 20px;
    border-bottom: 1px solid var(--border-dark);
    color: var(--text-main);
    vertical-align: middle;
}
.compare-table tr:hover td { background: rgba(255,255,255,0.02); }
.compare-table .metric-name { font-weight: 600; font-size: 13px; letter-spacing: 0.02em; }
.compare-table .mono { font-family: 'JetBrains Mono', monospace; font-size: 13px; color: var(--silver); }
.delta-up   { color: #10B981; font-weight: 700; font-family: 'JetBrains Mono', monospace; font-size: 13px; }
.delta-down { color: #EF4444; font-weight: 700; font-family: 'JetBrains Mono', monospace; font-size: 13px; }
.delta-same { color: var(--silver); font-weight: 600; font-family: 'JetBrains Mono', monospace; font-size: 13px; }

@media (max-width: 992px) {
    .hero-content { grid-template-columns: 1fr; gap: 20px; padding-top: 40px; }
    .hero-left { padding-bottom: 0; text-align: center; }
    .hero-watermark { display: none; }
    .breadcrumb { margin-bottom: 20px; }
    .hero-right { padding-bottom: 40px; }
    .charts-grid { grid-template-columns: 1fr; }
}
</style>
@endpush

@section('content')

@php
    $playerBg = \App\Models\SiteSetting::where('key', 'page_ahp_training.player_bg')->value('value');
    $latest = $postResult ?? $preResult;
@endphp

{{-- 1. HERO SECTION --}}
<div class="profile-hero">
    @if($playerBg)
        <div class="hero-bg" style="background-image: url('{{ asset('storage/' . $playerBg) }}')" role="img" aria-label="Latar belakang profil atlet {{ $player->name }}"></div>
    @else
        {{-- Default dark gradient if no bg uploaded --}}
        <div class="hero-bg" style="background: radial-gradient(circle at center, #222 0%, #000 70%); opacity:1; mask-image:none;-webkit-mask-image:none;" role="presentation"></div>
    @endif
    
    <div class="hero-content">
        {{-- LEFT: Identity --}}
        <div class="hero-left">
            <div class="breadcrumb">
                <span style="color:#888888; font-weight:600;">AHP TRAINING / PROFIL /</span> <span style="color:#FFFFFF; font-weight:800;">{{ strtoupper($player->name) }}</span>
            </div>
            
            {{-- Watermark (Using last 2 digits of NO_REG or something short) --}}
            @php 
                $numb = preg_replace('/[^0-9]/', '', $player->no_reg); 
                if(!$numb) $numb = 'AHP';
            @endphp
            <div class="hero-watermark">{{ $numb }}</div>
            
            {{-- Assuming we have an icon, fallback to a soccer ball svg --}}
            <svg class="crest-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="12" cy="12" r="10"/><path d="M12 2l2.4 7.4h7.6l-6.2 4.5 2.4 7.4-6.2-4.5-6.2 4.5 2.4-7.4-6.2-4.5h7.6z"/>
            </svg>
            
            <h1 class="hero-name">{{ str_replace(' ', "\n", strtoupper($player->name)) }}</h1>
            <div class="hero-position">{{ strtoupper($player->position ?? 'PLAYER') }}</div>
        </div>

        {{-- CENTER: Cutout Photo --}}
        <div class="hero-center">
            <img src="{{ $player->photo_url }}" alt="Foto profil atlet sepakbola {{ $player->name }} dari AHP Training Coach Agam" class="hero-cutout">
        </div>

        {{-- RIGHT: Stats List --}}
        <div class="hero-right">
            <div class="stats-header">
                <span>STATISTICS</span>
            </div>
            
            <div class="stats-table">
                <div class="stat-row">
                    <div class="s-label">NO REG</div>
                    <div class="s-val">{{ $player->no_reg }}</div>
                </div>
                <div class="stat-row">
                    <div class="s-label">DOB</div>
                    <div class="s-val">{{ $player->date_of_birth ? strtoupper($player->date_of_birth->format('d M Y')) : '-' }}</div>
                </div>
                <div class="stat-row">
                    <div class="s-label">AGE</div>
                    <div class="s-val">{{ $player->age }} YEARS</div>
                </div>
                <div class="stat-row">
                    <div class="s-label">POSITION</div>
                    <div class="s-val">{{ strtoupper($player->position ?? '-') }}</div>
                </div>
                <div class="stat-row">
                    <div class="s-label">HEIGHT</div>
                    <div class="s-val">{{ $latest ? $latest->height_cm . ' CM' : '-' }}</div>
                </div>
                <div class="stat-row">
                    <div class="s-label">WEIGHT</div>
                    <div class="s-val">{{ $latest ? $latest->weight_kg . ' KG' : '-' }}</div>
                </div>
                <div class="stat-row">
                    <div class="s-label">STATUS</div>
                    <div class="s-val">{{ $player->is_active ? 'ACTIVE' : 'INACTIVE' }}</div>
                </div>
            </div>

            <div class="player-tracker">
                <div class="pt-box">
                    <div class="pt-label">PLAYER TRACKER</div>
                    <div class="pt-on">ON</div>
                </div>
            </div>
            
            {{-- Social Share --}}
            <div style="margin-top:24px; display:flex; gap:16px; justify-content:flex-end; align-items:center;">
                <span style="font-size:10px; font-weight:600; color:var(--silver); letter-spacing:0.1em; text-transform:uppercase;">SHARE</span>
                
                {{-- Copy Link --}}
                <button onclick="navigator.clipboard.writeText('{{ $meta['url'] }}'); alert('Tautan disalin ke clipboard!');" style="background:transparent; border:none; color:var(--silver); cursor:pointer; padding:0; transition:color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--silver)'" title="Copy Link">
                    <svg width="18" height="18" viewBox="0 0 24 24"><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none" d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" /><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none" d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" /></svg>
                </button>

                {{-- WhatsApp --}}
                <a href="https://api.whatsapp.com/send?text={{ urlencode($meta['title'] . ' ' . $meta['url']) }}" target="_blank" style="color:var(--silver); transition:color 0.2s; display:flex; align-items:center;" onmouseover="this.style.color='#25D366'" onmouseout="this.style.color='var(--silver)'" title="Share via WhatsApp">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                </a>
                
                {{-- Twitter/X --}}
                <a href="https://twitter.com/intent/tweet?text={{ urlencode($meta['title']) }}&url={{ urlencode($meta['url']) }}" target="_blank" style="color:var(--silver); transition:color 0.2s; display:flex; align-items:center;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='var(--silver)'" title="Share via X">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>

                {{-- Facebook --}}
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($meta['url']) }}" target="_blank" style="color:var(--silver); transition:color 0.2s; display:flex; align-items:center;" onmouseover="this.style.color='#1877F2'" onmouseout="this.style.color='var(--silver)'" title="Share via Facebook">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
            </div>
        </div>
    </div>
</div>

{{-- 2. DATA SECTION (CHARTS & TABLE) --}}
<div class="data-section">
    <div class="ahp-container">

        {{-- SEO Description --}}
        <div style="background:var(--card-dark);border:1px solid var(--border-dark);padding:28px 32px;margin-bottom:32px;font-size:15px;line-height:1.8;color:var(--text-muted);">
            <h2 style="color:var(--text-main); font-size:18px; font-weight:700; margin-bottom:12px; text-transform:uppercase; letter-spacing:0.05em;">Analisis Performa: {{ $player->name }}</h2>
            <p>
                <strong style="color:var(--text-main)">{{ $player->name }}</strong> ({{ $player->no_reg }}) adalah seorang <strong style="color:var(--text-main)">{{ $player->position ?? 'Pemain' }}</strong> berusia <strong style="color:var(--text-main)">{{ $player->age }} tahun</strong> yang mengikuti program pembinaan intensif <a href="{{ route('ahp.search') }}" style="color:var(--text-main);text-decoration:underline;">AHP Training Coach Agam</a>. Halaman ini menyajikan laporan performa berbasis data, mencakup evaluasi komposisi tubuh (BMI, Body Fat, Muscle Mass), kapasitas kognitif (MoCA Score), hingga tes atletik (Passing, Scanning, Akselerasi, Yo-Yo) — dari sesi Pre Test sebagai <em>baseline</em> hingga Post Test sebagai bukti nyata perkembangan selama 8 minggu program.
            </p>
        </div>
        
        @if(!$preResult)
            <div style="background:var(--card-dark);border:1px solid var(--border-dark);padding:48px;text-align:center;">
                <p style="color:var(--text-muted);font-size:14px;letter-spacing:0.05em;text-transform:uppercase;">No testing data available for this player yet.</p>
            </div>
        @else

            {{-- Charts --}}
            <h2 class="section-title">PERFORMANCE ANALYSIS</h2>
            <div class="charts-grid">
                <div class="chart-card">
                    <h3 class="chart-card-title">Radar Performa</h3>
                    <canvas id="radarChart"></canvas>
                </div>
                <div class="chart-card">
                    <h3 class="chart-card-title">Perkembangan Per Sesi</h3>
                    <canvas id="lineChart"></canvas>
                </div>
            </div>

            {{-- Comparison Table --}}
            @if($postResult)
            <h2 class="section-title">PRE TEST VS POST TEST COMPARISON</h2>
            <div style="background:var(--card-dark);border:1px solid var(--border-dark);overflow:hidden;margin-bottom:40px;">
                <table class="compare-table">
                    <thead>
                        <tr>
                            <th>Metrik</th>
                            <th>Pre Test</th>
                            <th>Post Test</th>
                            <th>Perubahan</th>
                            <th>Trend</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                    $comparisons = [
                        ['WEIGHT (kg)',                $preResult->weight_kg,         $postResult->weight_kg,         'lower'],
                        ['Body Mass Index (BMI)',      $preResult->bmi,               $postResult->bmi,               'lower'],
                        ['Body Fat Percentage2',       $preResult->body_fat_percentage,$postResult->body_fat_percentage,'lower'],
                        ['Skeletal Muscle Mass',       $preResult->skeletal_muscle_mass,$postResult->skeletal_muscle_mass,'higher'],
                        ['Skor MoCA INA',              $preResult->moca_score,        $postResult->moca_score,        'higher'],
                        ['Jumlah Total Passing',       $preResult->total_passing,     $postResult->total_passing,     'higher'],
                        ['Passing Sukses',             $preResult->passing_sukses,    $postResult->passing_sukses,    'higher'],
                        ['Passing Gagal',              $preResult->passing_gagal,     $postResult->passing_gagal,     'lower'],
                        ['Jumlah Scaning (per 10 detik)', $preResult->scanning_per_10sec,$postResult->scanning_per_10sec,'higher'],
                        ['Initial Acceleration (0-10m)2', $preResult->initial_acceleration,$postResult->initial_acceleration,'lower'],
                        ['Acceleration Phase (10-20m)3', $preResult->acceleration_phase,$postResult->acceleration_phase,'lower'],
                        ['Maximal Speed/ Velocity (20-30m)4', $preResult->maximal_speed,    $postResult->maximal_speed,     'lower'],
                        ['RAST Test',                  $preResult->rast_test,         $postResult->rast_test,         'lower'],
                        ['Level',                      $preResult->yo_yo_level,       $postResult->yo_yo_level,       'higher'],
                        ['Balikan',                    $preResult->yo_yo_balikan,     $postResult->yo_yo_balikan,     'higher'],
                        ['Distance',                   $preResult->yo_yo_distance,    $postResult->yo_yo_distance,    'higher'],
                        ['Vo2max',                     $preResult->vo2max,            $postResult->vo2max,            'higher'],
                    ];
                    @endphp
                    @foreach($comparisons as [$metric, $pre, $post, $better])
                    @php
                        $diff = $post - $pre;
                        $pct  = $pre > 0 ? round(abs($diff / $pre) * 100, 1) : 0;
                        $same = abs($diff) < 0.01;
                        $arrow = $same ? '—' : ($diff > 0 ? '↑' : '↓');
                        $color = $same ? 'var(--silver)' : ($diff > 0 ? '#10B981' : '#EF4444');
                    @endphp
                    <tr>
                        <td class="metric-name">{{ $metric }}</td>
                        <td class="mono">{{ $pre ?? '—' }}</td>
                        <td class="mono">{{ $post ?? '—' }}</td>
                        <td class="mono" style="color: {{ $color }}; font-weight: 700;">{{ $same ? '—' : (($diff > 0 ? '+' : '') . number_format($diff, 2)) }}</td>
                        <td class="mono" style="color: {{ $color }}; font-weight: 700;">{{ $same ? '—' : ($arrow . ' ' . $pct . '%') }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            
            {{-- ── PDF DOWNLOAD SECTION ── --}}
            <div style="margin-top:40px; padding:32px; background:var(--card-dark); border:1px solid var(--border-dark);">
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; flex-wrap:wrap; gap:12px;">
                    <div>
                        <div style="font-size:10px; font-weight:700; letter-spacing:0.15em; color:var(--silver); text-transform:uppercase; margin-bottom:6px;">DOWNLOAD LAPORAN PDF</div>
                        <p style="font-size:12px; color:var(--text-muted); margin:0;">Unduh laporan performa per sesi atau laporan gabungan semua sesi.</p>
                    </div>
                    {{-- All sessions combined --}}
                    <a href="{{ route('ahp.player.pdf', strtolower($player->no_reg . '-' . \Illuminate\Support\Str::slug($player->name))) }}"
                       style="display:inline-flex; align-items:center; gap:8px; background:#FFFFFF; color:#000000; font-size:10px; font-weight:800; letter-spacing:0.12em; text-transform:uppercase; text-decoration:none; padding:12px 24px; border:1px solid #FFFFFF; transition:all 0.2s;"
                       onmouseover="this.style.background='transparent';this.style.color='#FFFFFF';"
                       onmouseout="this.style.background='#FFFFFF';this.style.color='#000000';">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Semua Sesi
                    </a>
                </div>

                {{-- Per-session buttons --}}
                @if($results->count() > 0)
                <div style="display:flex; flex-wrap:wrap; gap:10px;">
                    @foreach($results as $result)
                    @php
                        $pdfUrl = route('ahp.player.pdf', strtolower($player->no_reg . '-' . \Illuminate\Support\Str::slug($player->name))) . '?session=' . $result->session_id;
                    @endphp
                    <a href="{{ $pdfUrl }}"
                       style="display:inline-flex; align-items:center; gap:8px; background:transparent; color:var(--text-main); font-size:10px; font-weight:700; letter-spacing:0.1em; text-transform:uppercase; text-decoration:none; padding:10px 20px; border:1px solid var(--border-dark); transition:all 0.2s;"
                       onmouseover="this.style.borderColor='#FFFFFF';this.style.background='rgba(255,255,255,0.05)';"
                       onmouseout="this.style.borderColor='var(--border-dark)';this.style.background='transparent';">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        {{ $result->session->full_label }}
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
            @endif {{-- end if postResult (comparison table) --}}

            {{-- Coach Agam Profile Section (from Home) --}}
            <div style="margin-top:80px;">
                @php
                    $profileSettings = \App\Models\SiteSetting::where('group', 'page_profile')->get()->keyBy('key');
                @endphp
                <div style="background-color:#FFFFFF; border-radius:12px; overflow:hidden;">
                    <x-profile-section :settings="$profileSettings" />
                </div>
            </div>

        @endif {{-- end if preResult --}}
        

    </div>
</div>

@if($preResult)
<script>
// Chart Global Config for Dark Theme
Chart.defaults.color = '#888888';
Chart.defaults.font.family = "'Inter', sans-serif";

// Radar Chart
const radarData = {
    labels: @json($radarMetrics),
    datasets: [
        {
            label: '{{ $preResult->session->full_label }}',
            data: @json($preRadar),
            borderColor: '#555555',
            backgroundColor: 'rgba(255,255,255,0.05)',
            borderWidth: 2,
            pointBackgroundColor: '#555555',
            pointRadius: 4,
        },
        @if($postResult)
        {
            label: '{{ $postResult->session->full_label }}',
            data: @json($postRadar),
            borderColor: '#FFFFFF',
            backgroundColor: 'rgba(255,255,255,0.15)',
            borderWidth: 2,
            pointBackgroundColor: '#FFFFFF',
            pointRadius: 4,
        }
        @endif
    ]
};
new Chart(document.getElementById('radarChart'), {
    type: 'radar',
    data: radarData,
    options: {
        scales: {
            r: {
                min: 0, max: 100,
                grid: { color: 'rgba(255,255,255,0.15)', lineWidth: 1.2 },
                angleLines: { color: 'rgba(255,255,255,0.15)', lineWidth: 1.2 },
                pointLabels: { color: '#F3F4F6', font: { size: 12, weight: 'bold' }, padding: 14 },
                ticks: { display: true, color: '#A3A3A3', backdropColor: 'transparent', font: { size: 10, weight: 'bold' }, stepSize: 20, z: 5, showLabelBackdrop: false }
            }
        },
        plugins: {
            legend: { position: 'top', labels: { color: '#FFFFFF', font: { size: 13, weight: 'bold' }, boxWidth: 16, padding: 24 } },
            tooltip: { backgroundColor: 'rgba(0,0,0,0.9)', titleFont: { size: 14, weight: 'bold' }, bodyFont: { size: 14 }, padding: 14, displayColors: true, borderColor: '#444', borderWidth: 1 }
        },
        elements: {
            line: { tension: 0.3 }
        },
        animation: { duration: 1200, easing: 'easeOutQuart' }
    }
});

// Bar Chart
const sessionLabels = @json($sessionLabels);
new Chart(document.getElementById('lineChart'), {
    type: 'bar',
    data: {
        labels: sessionLabels,
        datasets: [
            {
                label: 'BMI', data: @json($lineData['bmi']),
                backgroundColor: '#333333',
                yAxisID: 'y'
            },
            {
                label: 'MoCA Score', data: @json($lineData['moca_score']),
                backgroundColor: '#777777',
                yAxisID: 'y'
            },
            {
                label: 'Passing Sukses', data: @json($lineData['passing_sukses']),
                backgroundColor: '#DDDDDD',
                yAxisID: 'y'
            },
        ]
    },
    options: {
        responsive: true,
        scales: {
            x: { grid: { color: '#222222' }, ticks: { color: '#888', font: { size: 11 } } },
            y: { 
                type: 'linear', 
                position: 'left', 
                grid: { color: '#222222' }, 
                ticks: { color: '#888', font: { size: 10 } }, 
                title: { display: true, text: 'Nilai / Skor', color: '#888', font: { size: 10 } } 
            }
        },
        plugins: { 
            legend: { labels: { color: '#FFFFFF', font: { size: 12, weight: 'bold' }, boxWidth: 16, padding: 16 } },
            tooltip: { backgroundColor: 'rgba(0,0,0,0.85)', titleFont: { size: 13 }, bodyFont: { size: 13 }, padding: 12, displayColors: true, borderColor: '#333', borderWidth: 1 }
        },
        animation: { duration: 1200, easing: 'easeOutQuart' }
    }
});
</script>
@endif

@endsection
