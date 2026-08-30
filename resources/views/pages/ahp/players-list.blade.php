@extends('layouts.app')

@section('title', $meta['title'])
@section('meta_description', $meta['description'])
@section('meta_keywords', $meta['keywords'])
@section('canonical', $meta['url'])

@push('head')
<meta property="og:title" content="{{ $meta['title'] }}">
<meta property="og:description" content="{{ $meta['description'] }}">
<meta property="og:image" content="{{ $meta['og_image'] }}">
<meta property="og:url" content="{{ $meta['url'] }}">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $meta['title'] }}">
<meta name="twitter:description" content="{{ $meta['description'] }}">

<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
</script>
<script type="application/ld+json">
{
  "@@context":"https://schema.org","@@type":"BreadcrumbList",
  "itemListElement":[
    {"@@type":"ListItem","position":1,"name":"Beranda","item":"{{ url('/') }}"},
    {"@@type":"ListItem","position":2,"name":"AHP Training","item":"{{ route('ahp-training') }}"},
    {"@@type":"ListItem","position":3,"name":"Players","item":"{{ $meta['url'] }}"}
  ]
}
</script>

{{-- Swiper & Chart loaded in head so they're ready for Alpine x-init --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>

<style>
/* ════════════════════════════
   AHP PLAYERS – DARK FOOTBALL
   ════════════════════════════ */
:root{
    --p-bg:#060606;--p-card:#0e0e0e;--p-border:#1e1e1e;
    --p-muted:#555;--p-white:#fff;--p-silver:#a0a0a0;
}
body{ background:var(--p-bg); }

/* ── TOP BAR ─────────────────── */
.pl-page{ background:var(--p-bg); min-height:100vh; padding-top:70px; overflow-x:hidden; width:100%; }
.pl-topbar{
    display:flex; justify-content:space-between; align-items:center;
    flex-wrap:wrap; gap:16px; padding:12px 48px;
    border-bottom:1px solid var(--p-border);
}
.pl-breadcrumb{ display:flex; align-items:center; gap:6px; }
.pl-bc-link{
    font-size:10px; font-weight:700; letter-spacing:2px; text-transform:uppercase;
    color:#444; text-decoration:none; transition:color .2s;
}
.pl-bc-link:hover{ color:var(--p-white); }
.pl-bc-sep{ color:#2a2a2a; font-size:12px; }
.pl-bc-cur{ font-size:10px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:var(--p-white); }

/* ── CONTROLS ────────────────── */
.pl-controls{ display:flex; align-items:center; gap:16px; flex-wrap:wrap; justify-content:flex-end; }
.pl-search-wrap{ position:relative; }
.pl-search{
    background:transparent; border:1px solid #1e1e1e;
    color:var(--p-white); padding:7px 12px 7px 32px;
    border-radius:3px; font-size:10px; font-weight:600;
    font-family:inherit; letter-spacing:1px; text-transform:uppercase;
    width:160px; transition:border-color .2s, width .3s;
}
.pl-search:focus{ outline:none; border-color:#444; width:200px; }
.pl-search::placeholder{ color:#333; text-transform:none; font-weight:400; letter-spacing:0; }
.pl-search-icon{
    position:absolute; left:10px; top:50%; transform:translateY(-50%);
    color:#333; pointer-events:none;
}
.pl-filters{ display:flex; gap:5px; }
.pl-filter-btn{
    background:transparent; border:1px solid #1e1e1e; color:#444;
    padding:6px 14px; border-radius:3px; font-size:9px; font-weight:700;
    letter-spacing:2px; text-transform:uppercase; cursor:pointer;
    transition:border-color .2s, color .2s, background .2s; font-family:inherit;
}
.pl-filter-btn:hover{ border-color:#444; color:#aaa; }
.pl-filter-btn.active{ border-color:#666; color:var(--p-white); background:#111; }

/* View toggle */
.pl-view-toggle{ display:flex; border:1px solid #1e1e1e; border-radius:3px; overflow:hidden; }
.pl-view-btn{
    background:transparent; border:none; color:#444; padding:7px 10px;
    cursor:pointer; transition:all .2s; display:flex; align-items:center; justify-content:center;
}
.pl-view-btn:first-child{ border-right:1px solid #1e1e1e; }
.pl-view-btn.active{ background:#111; color:var(--p-white); }
.pl-view-btn:hover{ color:var(--p-white); }

/* ── SWIPER ──────────────────── */
.pl-swiper-wrap{ padding:20px 0 90px; width:100%; max-width:100%; overflow:hidden; }
.pl-swiper{ width:100%; padding:30px 0 55px !important; overflow:visible !important; }
.pl-slide{ width:230px !important; height:390px !important; cursor:pointer; transition:opacity .35s ease; }
.pl-slide:not(.swiper-slide-active){ opacity:.5; }
.pl-slide.swiper-slide-active{ opacity:1; }
.pl-card{ position:relative; width:100%; height:100%; user-select:none; }
.pl-shield{
    position:absolute; bottom:0; left:50%; transform:translateX(-50%);
    width:86%; height:74%;
    background:linear-gradient(150deg, #2a2a2a 0%, #111111 100%);
    border:1px solid #333333;
    clip-path:polygon(50% 0%,100% 12%,100% 80%,50% 100%,0 80%,0 12%);
    z-index:1; transition:all .4s ease;
}
.swiper-slide-active .pl-shield{
    /* Premium metallic silver gradient */
    background:linear-gradient(145deg, #f3f4f6 0%, #d1d5db 25%, #9ca3af 65%, #4b5563 100%);
    box-shadow:inset 0 0 40px rgba(255,255,255,.2), 0 30px 60px rgba(0,0,0,.9);
    border:1px solid #ffffff;
}
.pl-num-badge{
    position:absolute; top:29%; right:10px;
    width:38px; height:38px; background:var(--p-bg); border:1px solid #2e2e2e; border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    font-size:13px; font-weight:800; color:var(--p-white);
    z-index:3; opacity:0; transform:scale(.6); transition:opacity .35s, transform .35s;
}
.swiper-slide-active .pl-num-badge{ opacity:1; transform:scale(1); border-color:#d1d5db; color:#e5e7eb; }
.pl-photo{
    position:absolute; bottom:16%; left:50%; transform:translateX(-50%);
    width:115%; height:110%;
    object-fit:contain; object-position:bottom center;
    z-index:2; filter:drop-shadow(0 14px 24px rgba(0,0,0,.9));
    transition:transform .4s cubic-bezier(0.2, 0.8, 0.2, 1); pointer-events:none;
}
.swiper-slide-active .pl-photo{ transform:translateX(-50%) scale(1.08) translateY(-4px); }
.pl-info{ position:absolute; bottom:7%; left:0; right:0; text-align:center; z-index:3; padding:0 10px; }
.pl-info-name{
    font-size:15px; font-weight:900; color:var(--p-white); text-transform:uppercase;
    letter-spacing:-.2px; line-height:1.15; text-shadow:0 3px 12px rgba(0,0,0,1);
    overflow:hidden; text-overflow:ellipsis; white-space:nowrap;
}
.pl-info-sub{ 
    font-size:9px; font-weight:700; color:#e5e7eb; letter-spacing:2px; text-transform:uppercase; 
    margin-top:4px; text-shadow:0 2px 8px rgba(0,0,0,1);
}

/* Tiny view-detail button */
.pl-btn-detail{
    position:absolute; bottom:-30px; left:50%;
    transform:translateX(-50%) translateY(10px);
    border:1px solid #555; color:var(--p-white); background:rgba(0,0,0,0.8);
    padding:8px 20px; border-radius:4px;
    font-size:8px; font-weight:800; letter-spacing:2px; text-transform:uppercase;
    text-decoration:none; z-index:5; opacity:0;
    transition:all .3s cubic-bezier(0.2, 0.8, 0.2, 1);
    white-space:nowrap; backdrop-filter:blur(4px);
}
.swiper-slide-active .pl-btn-detail{ opacity:1; transform:translateX(-50%) translateY(0); }
.pl-btn-detail:hover{ border-color:#fff; background:#111; }

.pl-swiper .swiper-button-prev, .pl-swiper .swiper-button-next{ color:#2a2a2a; transition:color .2s; }
.pl-swiper .swiper-button-prev:hover, .pl-swiper .swiper-button-next:hover{ color:#666; }
.pl-swiper .swiper-button-prev::after, .pl-swiper .swiper-button-next::after{ font-size:16px; }

/* ── GRID ────────────────────── */
.pl-grid-wrap{ padding:36px 48px 56px; }
.pl-grid{
    display:grid; grid-template-columns:repeat(4,1fr);
    gap:1px; background:#0e0e0e; border:1px solid #111;
}
.pl-grid-card{
    background:#080808; padding:24px 16px 18px;
    display:flex; flex-direction:column; align-items:center; text-align:center;
    cursor:pointer; transition:background .2s; text-decoration:none; overflow:hidden;
}
.pl-grid-card:hover{ background:#0e0e0e; }
.pl-grid-noreg{ font-size:8px; font-weight:700; letter-spacing:3px; color:#333; text-transform:uppercase; margin-bottom:10px; }
.pl-grid-photo-wrap{ width:90px; height:110px; display:flex; align-items:flex-end; justify-content:center; margin-bottom:12px; }
.pl-grid-photo{ max-width:100%; max-height:100%; object-fit:contain; object-position:bottom; filter:drop-shadow(0 4px 10px rgba(0,0,0,.7)); transition:transform .25s; }
.pl-grid-card:hover .pl-grid-photo{ transform:scale(1.06) translateY(-3px); }
.pl-grid-name{ font-size:12px; font-weight:800; color:var(--p-white); text-transform:uppercase; letter-spacing:-.1px; line-height:1.2; margin-bottom:3px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap; width:100%; }
.pl-grid-pos{ font-size:8px; font-weight:600; letter-spacing:2px; color:#444; text-transform:uppercase; margin-bottom:12px; }
.pl-grid-btn{
    display:inline-flex; align-items:center; gap:5px;
    border:1px solid #1e1e1e; color:#444;
    font-size:7px; font-weight:700; letter-spacing:2px; text-transform:uppercase;
    padding:5px 12px; border-radius:2px; transition:border-color .2s, color .2s; text-decoration:none;
}
.pl-grid-card:hover .pl-grid-btn{ border-color:#444; color:var(--p-white); }

/* ── EMPTY ───────────────────── */
.pl-empty{ text-align:center; color:#2a2a2a; font-size:10px; font-weight:700; letter-spacing:4px; text-transform:uppercase; padding:100px 20px; width:100%; }

/* ── COMPARISON ──────────────── */
.cmp-wrap{ background:var(--p-bg); border-top:1px solid #111; padding:60px 48px 80px; }
.cmp-eyebrow{ font-size:9px; font-weight:700; letter-spacing:4px; text-transform:uppercase; color:var(--p-silver); margin-bottom:8px; }
.cmp-heading{ font-size:clamp(24px,3vw,38px); font-weight:800; color:var(--p-white); letter-spacing:-1px; margin-bottom:40px; line-height:1.1; }
.cmp-selectors{ display:grid; grid-template-columns:1fr auto 1fr; gap:20px; align-items:center; margin-bottom:28px; }
.cmp-select-label{ font-size:9px; font-weight:700; letter-spacing:3px; color:var(--p-muted); text-transform:uppercase; margin-bottom:7px; }
.cmp-select{
    width:100%; background:#0a0a0a; border:1px solid var(--p-border);
    color:var(--p-white); padding:12px 14px; font-size:12px; font-weight:600;
    font-family:inherit; border-radius:2px; cursor:pointer; appearance:none;
    background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='10' viewBox='0 0 24 24' fill='none' stroke='%23444' stroke-width='2'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
    background-repeat:no-repeat; background-position:right 12px center; transition:border-color .2s;
}
.cmp-select:focus{ outline:none; border-color:#444; }

/* Custom Premium Select Dropdown */
.cmp-custom-select { position:relative; width:100%; user-select:none; text-align:left; }
.cmp-custom-trigger {
    background:#0a0a0a; border:1px solid var(--p-border); color:var(--p-white);
    padding:12px 14px; font-size:11px; font-weight:700; font-family:inherit; letter-spacing:1px;
    border-radius:2px; cursor:pointer; display:flex; justify-content:space-between; align-items:center;
    transition:border-color .2s, background .2s;
}
.cmp-custom-trigger:hover { border-color:#444; background:#111; }
.cmp-custom-dropdown {
    position:absolute; top:calc(100% + 4px); left:0; width:100%;
    background:#0a0a0a; border:1px solid #222; border-radius:4px;
    max-height:280px; overflow-y:auto; z-index:100; box-shadow:0 10px 30px rgba(0,0,0,0.8);
}
.cmp-custom-option {
    padding:12px 14px; font-size:10px; font-weight:700; letter-spacing:1px; color:#9ca3af;
    cursor:pointer; transition:background .15s, color .15s;
    border-bottom:1px solid #151515; text-transform:uppercase;
}
.cmp-custom-option:last-child { border-bottom:none; }
.cmp-custom-option:hover { background:#1a1a1a; color:var(--p-white); }
.cmp-custom-option.selected { background:#1a1a1a; color:var(--p-white); border-left:3px solid #fff; padding-left:11px; }
/* Scrollbar styling for dropdown */
.cmp-custom-dropdown::-webkit-scrollbar { width:5px; }
.cmp-custom-dropdown::-webkit-scrollbar-track { background:#0a0a0a; }
.cmp-custom-dropdown::-webkit-scrollbar-thumb { background:#333; border-radius:4px; }

.cmp-vs-txt{ text-align:center; font-size:16px; font-weight:900; color:#222; letter-spacing:2px; }
.cmp-btn{
    display:inline-flex; align-items:center; gap:8px;
    border:1px solid #2a2a2a; color:var(--p-white); background:transparent;
    padding:10px 24px; border-radius:2px; font-size:9px; font-weight:700;
    letter-spacing:2.5px; text-transform:uppercase; cursor:pointer; font-family:inherit;
    transition:border-color .2s, background .2s;
}
.cmp-btn:hover{ border-color:#666; background:#0e0e0e; }

/* Result */
.cmp-strip{ display:grid; grid-template-columns:1fr auto 1fr; gap:20px; align-items:center; margin:40px 0; }
.cmp-pc{ background:#080808; border:1px solid var(--p-border); padding:20px; display:flex; align-items:center; gap:14px; }
.cmp-pc.right{ flex-direction:row-reverse; text-align:right; }
.cmp-pc-img{ width:56px; height:70px; object-fit:contain; object-position:bottom; flex-shrink:0; filter:drop-shadow(0 4px 8px rgba(0,0,0,.8)); }
.cmp-pc-name{ font-size:15px; font-weight:800; color:var(--p-white); text-transform:uppercase; letter-spacing:-.2px; line-height:1.1; }
.cmp-pc-meta{ font-size:8px; font-weight:600; letter-spacing:2px; color:var(--p-muted); text-transform:uppercase; margin-top:3px; }
.cmp-vs-badge{ width:44px; height:44px; border:1px solid #1e1e1e; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:9px; font-weight:800; color:#2a2a2a; letter-spacing:1px; flex-shrink:0; }

.cmp-charts{ display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:20px; }
.cmp-chart-box{ background:#080808; border:1px solid var(--p-border); padding:24px; }
.cmp-chart-label{ font-size:8px; font-weight:700; letter-spacing:3px; color:var(--p-muted); text-transform:uppercase; margin-bottom:18px; display:flex; align-items:center; gap:8px; }
.cmp-chart-label::before{ content:''; width:2px; height:10px; background:#333; display:inline-block; }

.cmp-table-box{ background:#080808; border:1px solid var(--p-border); overflow:hidden; }
.cmp-table-responsive { width:100%; overflow-x:auto; -webkit-overflow-scrolling:touch; padding-bottom:2px; }
.cmp-table{ width:100%; border-collapse:collapse; font-size:11px; min-width:500px; }
.cmp-table th{ background:#0a0a0a; border-bottom:1px solid var(--p-border); padding:11px 18px; font-size:8px; font-weight:700; letter-spacing:2.5px; text-transform:uppercase; color:var(--p-muted); text-align:left; }
.cmp-table th:nth-child(2),.cmp-table th:nth-child(3){ text-align:center; }
.cmp-table th:last-child{ text-align:right; }
.cmp-table td{ padding:11px 18px; border-bottom:1px solid #0e0e0e; color:var(--p-white); vertical-align:middle; font-family:'JetBrains Mono',monospace; font-size:12px; }
.cmp-table td:first-child{ font-family:inherit; font-size:10px; font-weight:600; color:#666; letter-spacing:.3px; }
.cmp-table td:nth-child(2),.cmp-table td:nth-child(3){ text-align:center; }
.cmp-table td:last-child{ text-align:right; }
.cmp-table tr:hover td{ background:rgba(255,255,255,.015); }
.win{ color:#fff !important; font-weight:800 !important; }
.lose{ color:#333 !important; }
.bar-cell{ vertical-align:middle; }
.bar-pair{ display:flex; align-items:center; gap:4px; justify-content:center; }
.bar-a{ height:3px; background:#777; border-radius:2px 0 0 2px; min-width:2px; transition:width .5s; }
.bar-b{ height:3px; background:#222; border-radius:0 2px 2px 0; min-width:2px; transition:width .5s; }

.cmp-nodata{ padding:40px; text-align:center; color:#333; font-size:10px; font-weight:700; letter-spacing:3px; text-transform:uppercase; }
[x-cloak]{ display:none !important; }

/* ── RESPONSIVE ──────────────── */
@media(max-width:1100px){ .pl-grid{ grid-template-columns:repeat(3,1fr); } }
@media(max-width:768px){
    .pl-topbar{ padding:16px 20px; flex-direction:column; align-items:flex-start; }
    .pl-controls{ justify-content:flex-start; flex-wrap:wrap; }
    .pl-slide{ width:200px !important; height:350px !important; }
    .pl-grid{ grid-template-columns:repeat(2,1fr); }
    .pl-grid-wrap{ padding:24px 20px 40px; }
    .cmp-wrap{ padding:40px 20px 60px; }
    .cmp-selectors{ grid-template-columns:1fr; gap:8px; }
    .cmp-vs-txt{ display:none; }
    .cmp-strip{ grid-template-columns:1fr; gap:10px; }
    .cmp-vs-badge{ display:none; }
    .cmp-pc.right{ flex-direction:row; text-align:left; }
    .cmp-charts{ grid-template-columns:1fr; }
}
@media(max-width:480px){
    .pl-slide{ width:185px !important; height:320px !important; }
    .pl-grid{ grid-template-columns:repeat(2,1fr); }
    .pl-filter-btn{ padding:5px 10px; font-size:8px; }
    .pl-search{ width:130px; }
}
</style>
@endpush

@section('content')

@php
/* Build category for each player */
$catMap = [];
foreach ($players as $p) {
    $pos = trim(strtoupper($p->position ?? ''));
    if ($pos === '') { $cat = 'all'; }
    elseif (str_contains($pos,'GOALKEEPER') || str_contains($pos,' GK') || $pos === 'GK') { $cat = 'goalkeeper'; }
    elseif (str_contains($pos,'DEFENDER') || str_contains($pos,'BACK') || in_array($pos,['CB','LB','RB','WB','LWB','RWB'])) { $cat = 'defender'; }
    elseif (str_contains($pos,'MIDFIELD') || str_contains($pos,'GELANDANG') || in_array($pos,['CM','AM','DM','CDM','CAM','RM','LM'])) { $cat = 'midfield'; }
    elseif (str_contains($pos,'FORWARD') || str_contains($pos,'STRIKER') || str_contains($pos,'ATTACK') || str_contains($pos,'WINGER') || str_contains($pos,'PENYERANG') || in_array($pos,['ST','CF','LW','RW'])) { $cat = 'attacker'; }
    else { $cat = 'all'; }
    $catMap[$p->id] = $cat;
}

/* Stats for comparison */
$statsJson = $playersWithStats->map(function($item) {
    $p = $item['player']; $r = $item['latest'];
    if (!$r) return ['id'=>$p->id,'has_data'=>false];
    return ['id'=>$p->id,'has_data'=>true,'session'=>$r->session?->label ?? 'Post Test',
        'height'=>$r->height_cm,'weight'=>$r->weight_kg,'bmi'=>$r->bmi,'body_fat'=>$r->body_fat_percentage,
        'muscle_mass'=>$r->skeletal_muscle_mass,'moca'=>$r->moca_score,'passing'=>$r->passing_sukses,
        'scanning'=>$r->scanning_per_10sec,'accel'=>$r->initial_acceleration,'speed'=>$r->maximal_speed,
        'rast'=>$r->rast_test,'yoyo_level'=>$r->yo_yo_level,'yoyo_dist'=>$r->yo_yo_distance,
    ];
})->keyBy('id')->toArray();

/* Players for Alpine comparison dropdowns */
$playersForAlpine = $players->map(function($p) use ($catMap) {
    preg_match('/\d+$/', $p->no_reg, $m);
    return [
        'id'=>$p->id,'name'=>$p->name,'no_reg'=>$p->no_reg,
        'position'=>strtoupper($p->position ?? '') ?: 'PLAYER',
        'photo'=>$p->photo_url,
        'slug'=>strtolower($p->no_reg.'-'.\Illuminate\Support\Str::slug($p->name)),
        'num'=>$m[0] ?? '0','category'=>$catMap[$p->id],
    ];
})->values()->toArray();
@endphp

{{-- ════ MAIN PAGE WRAPPER (Alpine for view-mode + comparison only) ════ --}}
<div class="pl-page"
     x-data="{
         viewMode: 'swiper',
         swiper: null,
         activeFilter: 'all',
         buildSwiper() {
             if (this.swiper) { this.swiper.destroy(true,true); this.swiper = null; }
             this.$nextTick(() => {
                 const slides = document.querySelectorAll('#pl-swiper-wrapper .pl-slide');
                 if (!slides.length) return;
                 this.swiper = new Swiper('.pl-swiper', {
                     effect:'coverflow', grabCursor:true, centeredSlides:true,
                     slidesPerView:'auto', speed:450,
                     coverflowEffect:{ rotate:0, stretch:-55, depth:210, modifier:1, slideShadows:false },
                     loop:false, keyboard:{enabled:true},
                     navigation:{nextEl:'.swiper-button-next',prevEl:'.swiper-button-prev'},
                     initialSlide: Math.floor(slides.length/2),
                 });
             });
         },
         setView(m) {
             this.viewMode = m;
             if (m==='swiper') this.buildSwiper();
             else if (this.swiper) { this.swiper.destroy(true,true); this.swiper = null; }
         }
     }"
     x-init="buildSwiper()"
>

    {{-- TOP BAR --}}
    <div class="pl-topbar">
        <nav class="pl-breadcrumb" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="pl-bc-link">Beranda</a>
            <span class="pl-bc-sep">›</span>
            <a href="{{ route('ahp-training') }}" class="pl-bc-link">AHP Training</a>
            <span class="pl-bc-sep">›</span>
            <span class="pl-bc-cur">Players</span>
        </nav>

        <div class="pl-controls">
            {{-- SEARCH --}}
            <div class="pl-search-wrap">
                <svg class="pl-search-icon" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input
                    type="text"
                    id="pl-search-input"
                    class="pl-search"
                    placeholder="Cari pemain..."
                    oninput="plFilter()"
                    autocomplete="off"
                >
            </div>

            {{-- FILTERS --}}
            <div class="pl-filters" role="group">
                <button onclick="plSetFilter('all')"        id="pbf-all"        class="pl-filter-btn active">ALL</button>
                <button onclick="plSetFilter('goalkeeper')" id="pbf-goalkeeper" class="pl-filter-btn">GK</button>
                <button onclick="plSetFilter('defender')"   id="pbf-defender"   class="pl-filter-btn">DEF</button>
                <button onclick="plSetFilter('midfield')"   id="pbf-midfield"   class="pl-filter-btn">MID</button>
                <button onclick="plSetFilter('attacker')"   id="pbf-attacker"   class="pl-filter-btn">ATT</button>
            </div>

            {{-- VIEW TOGGLE --}}
            <div class="pl-view-toggle">
                <button @click="setView('swiper')" :class="{ active: viewMode==='swiper' }" class="pl-view-btn" title="Carousel">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="6" width="6" height="12" rx="1"/><rect x="9" y="3" width="6" height="18" rx="1"/><rect x="17" y="6" width="6" height="12" rx="1"/></svg>
                </button>
                <button @click="setView('grid')" :class="{ active: viewMode==='grid' }" class="pl-view-btn" title="Grid">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ════ HIDDEN POOL: all slides live here, moved to swiper on filter ════ --}}
    <div id="pl-pool" style="display:none" aria-hidden="true">
        @foreach($players as $player)
        @php
            $slug = strtolower($player->no_reg.'-'.\Illuminate\Support\Str::slug($player->name));
            preg_match('/\d+$/', $player->no_reg, $m);
            $num  = $m[0] ?? '0';
            $cat  = $catMap[$player->id];
            $pos  = strtoupper($player->position ?? '') ?: 'PLAYER';
            $url  = route('ahp.player', $slug);
        @endphp
        <div class="pl-slide swiper-slide"
             data-slide
             data-cat="{{ $cat }}"
             data-name="{{ strtolower($player->name) }}"
             data-noreg="{{ strtolower($player->no_reg) }}"
             onclick="window.location.href='{{ $url }}'">
            <div class="pl-card">
                <div class="pl-shield"></div>
                <div class="pl-num-badge">{{ $num }}</div>
                <img src="{{ $player->photo_url }}"
                     alt="Foto {{ $player->name }} – AHP Training Coach Agam"
                     class="pl-photo" loading="lazy">
                <div class="pl-info">
                    <div class="pl-info-name">{{ $player->name }}</div>
                    <div class="pl-info-sub">{{ $player->no_reg }} · {{ $pos }}</div>
                </div>
                <a href="{{ $url }}" class="pl-btn-detail" onclick="event.stopPropagation()">+ Detail</a>
            </div>
        </div>
        @endforeach
    </div>

    {{-- ════ SWIPER VIEW ════ --}}
    <div x-show="viewMode==='swiper'" class="pl-swiper-wrap">
        <div class="swiper pl-swiper">
            <div class="swiper-wrapper" id="pl-swiper-wrapper">
                {{-- Slides are moved here dynamically by plFilter() --}}
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
        <div id="pl-swiper-empty" class="pl-empty" style="display:none">Tidak ada pemain di kategori ini.</div>
    </div>

    {{-- ════ GRID VIEW ════ --}}
    <div x-show="viewMode==='grid'" class="pl-grid-wrap">
        <div class="pl-grid" id="pl-grid">
            @foreach($players as $player)
            @php
                $slug = strtolower($player->no_reg.'-'.\Illuminate\Support\Str::slug($player->name));
                $cat  = $catMap[$player->id];
                $pos  = strtoupper($player->position ?? '') ?: 'PLAYER';
                $url  = route('ahp.player', $slug);
            @endphp
            <a class="pl-grid-card"
               href="{{ $url }}"
               data-grid-card
               data-cat="{{ $cat }}"
               data-name="{{ strtolower($player->name) }}"
               data-noreg="{{ strtolower($player->no_reg) }}">
                <div class="pl-grid-noreg">{{ $player->no_reg }}</div>
                <div class="pl-grid-photo-wrap">
                    <img src="{{ $player->photo_url }}"
                         alt="Foto {{ $player->name }}"
                         class="pl-grid-photo" loading="lazy">
                </div>
                <div class="pl-grid-name">{{ $player->name }}</div>
                <div class="pl-grid-pos">{{ $pos }}</div>
                <span class="pl-grid-btn">
                    <svg width="7" height="7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    + Detail
                </span>
            </a>
            @endforeach
        </div>
        <div id="pl-grid-empty" class="pl-empty" style="display:none">Tidak ada pemain di kategori ini.</div>
    </div>

</div>{{-- /.pl-page --}}

{{-- ════════════ COMPARISON ════════════ --}}
<section class="cmp-wrap"
         x-data="{
             allPlayers: {{ json_encode($playersForAlpine) }},
             statsMap: {{ json_encode($statsJson) }},
             p1:'', p2:'', result:null, rc:null, bc:null,
             compare(){
                 if(!this.p1||!this.p2||this.p1===this.p2) return;
                 const id1=parseInt(this.p1), id2=parseInt(this.p2);
                 const pl1=this.allPlayers.find(p=>p.id===id1);
                 const pl2=this.allPlayers.find(p=>p.id===id2);
                 this.result={pl1,pl2,s1:this.statsMap[id1]||{has_data:false},s2:this.statsMap[id2]||{has_data:false}};
                 this.$nextTick(()=>this.draw(this.result.s1,this.result.s2,pl1,pl2));
                 this.$nextTick(()=>document.getElementById('cmp-res').scrollIntoView({behavior:'smooth',block:'start'}));
             },
             draw(s1,s2,pl1,pl2){
                 const n=(v,mn,mx)=>v!=null?Math.min(100,Math.max(0,Math.round(((v-mn)/(mx-mn))*100))):0;
                 const rCtx=document.getElementById('cmpR');
                 if(rCtx){
                     if(this.rc)this.rc.destroy();
                     const labels=['BMI','MoCA','Passing','Scanning','Akselerasi','Kecepatan','Yo-Yo'];
                     const d1=s1.has_data?[n(s1.bmi,15,35),n(s1.moca,0,30),n(s1.passing,0,20),n(s1.scanning,0,20),n(s1.accel?100-s1.accel*10:0,0,100),n(s1.speed?100-s1.speed*10:0,0,100),n(s1.yoyo_dist,0,2400)]:Array(7).fill(0);
                     const d2=s2.has_data?[n(s2.bmi,15,35),n(s2.moca,0,30),n(s2.passing,0,20),n(s2.scanning,0,20),n(s2.accel?100-s2.accel*10:0,0,100),n(s2.speed?100-s2.speed*10:0,0,100),n(s2.yoyo_dist,0,2400)]:Array(7).fill(0);
                     this.rc=new Chart(rCtx,{type:'radar',data:{labels,datasets:[
                         {label:pl1.name,data:d1,borderColor:'#d0d0d0',backgroundColor:'rgba(220,220,220,.1)',borderWidth:2,pointBackgroundColor:'#d0d0d0',pointRadius:3},
                         {label:pl2.name,data:d2,borderColor:'#505050',backgroundColor:'rgba(80,80,80,.1)',borderWidth:2,pointBackgroundColor:'#505050',pointRadius:3},
                     ]},options:{responsive:true,maintainAspectRatio:false,
                         scales:{r:{min:0,max:100,grid:{color:'#1a1a1a'},angleLines:{color:'#1a1a1a'},pointLabels:{color:'#555',font:{size:10}},ticks:{display:false}}},
                         plugins:{legend:{labels:{color:'#555',font:{size:10},boxWidth:10}}},
                         animation:{duration:800,easing:'easeOutQuart'}
                     }});
                 }
                 const bCtx=document.getElementById('cmpB');
                 if(bCtx){
                     if(this.bc)this.bc.destroy();
                     const bl=['Tinggi','Berat','BMI','MoCA','Passing','Scanning','Yo-Yo(m)'];
                     const bd1=s1.has_data?[s1.height,s1.weight,s1.bmi,s1.moca,s1.passing,s1.scanning,s1.yoyo_dist]:Array(7).fill(null);
                     const bd2=s2.has_data?[s2.height,s2.weight,s2.bmi,s2.moca,s2.passing,s2.scanning,s2.yoyo_dist]:Array(7).fill(null);
                     this.bc=new Chart(bCtx,{type:'bar',data:{labels:bl,datasets:[
                         {label:pl1.name,data:bd1,backgroundColor:'rgba(200,200,200,.85)',borderRadius:2},
                         {label:pl2.name,data:bd2,backgroundColor:'rgba(50,50,50,.9)',borderRadius:2,borderColor:'#333',borderWidth:1},
                     ]},options:{responsive:true,maintainAspectRatio:false,
                         scales:{x:{grid:{color:'#111'},ticks:{color:'#555',font:{size:10}}},y:{grid:{color:'#111'},ticks:{color:'#555',font:{size:10}}}},
                         plugins:{legend:{labels:{color:'#555',font:{size:10},boxWidth:10}}},
                         animation:{duration:800,easing:'easeOutQuart'}
                     }});
                 }
             }
         }"
>
    <div class="cmp-eyebrow">PLAYER COMPARISON</div>
    <h2 class="cmp-heading">Bandingkan Performa<br><span style="font-weight:300;font-style:italic;">Antar Pemain</span></h2>

    <div class="cmp-selectors">
        <div>
            <div class="cmp-select-label">Pemain 1</div>
            <select class="cmp-select" x-model="p1" id="cmp-p1">
                <option value="">— Pilih Pemain —</option>
                @foreach($players as $p)
                <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->no_reg }})</option>
                @endforeach
            </select>
        </div>
        <div class="cmp-vs-txt">VS</div>
        <div>
            <div class="cmp-select-label">Pemain 2</div>
            <select class="cmp-select" x-model="p2" id="cmp-p2">
                <option value="">— Pilih Pemain —</option>
                @foreach($players as $p)
                <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->no_reg }})</option>
                @endforeach
            </select>
        </div>
    </div>

    <button @click="compare()" class="cmp-btn" id="cmp-go-btn">
        <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M8 3H5a2 2 0 0 0-2 2v3"/><path d="M21 8V5a2 2 0 0 0-2-2h-3"/><path d="M3 16v3a2 2 0 0 0 2 2h3"/><path d="M16 21h3a2 2 0 0 0 2-2v-3"/></svg>
        Bandingkan Sekarang
    </button>

    {{-- RESULT --}}
    <div id="cmp-res" x-show="result!==null" x-cloak>
        {{-- Player strip --}}
        <div class="cmp-strip">
            <div class="cmp-pc">
                <img :src="result?.pl1?.photo" :alt="result?.pl1?.name" class="cmp-pc-img">
                <div>
                    <div class="cmp-pc-name" x-text="result?.pl1?.name"></div>
                    <div class="cmp-pc-meta" x-text="(result?.pl1?.no_reg||'') + ' · ' + (result?.pl1?.position||'')"></div>
                    <div class="cmp-pc-meta" x-text="result?.s1?.has_data ? 'Sesi: '+(result.s1.session||'Post Test') : 'Belum ada data'"></div>
                </div>
            </div>
            <div class="cmp-vs-badge">VS</div>
            <div class="cmp-pc right">
                <img :src="result?.pl2?.photo" :alt="result?.pl2?.name" class="cmp-pc-img">
                <div>
                    <div class="cmp-pc-name" x-text="result?.pl2?.name"></div>
                    <div class="cmp-pc-meta" x-text="(result?.pl2?.no_reg||'') + ' · ' + (result?.pl2?.position||'')"></div>
                    <div class="cmp-pc-meta" x-text="result?.s2?.has_data ? 'Sesi: '+(result.s2.session||'Post Test') : 'Belum ada data'"></div>
                </div>
            </div>
        </div>

        {{-- Charts --}}
        <div class="cmp-charts">
            <div class="cmp-chart-box">
                <div class="cmp-chart-label">Radar Performa</div>
                <div style="height:270px;position:relative;"><canvas id="cmpR"></canvas></div>
            </div>
            <div class="cmp-chart-box">
                <div class="cmp-chart-label">Statistik Fisik & Teknis</div>
                <div style="height:270px;position:relative;"><canvas id="cmpB"></canvas></div>
            </div>
        </div>

        {{-- H2H Table --}}
        <div class="cmp-table-box">
            <div style="padding:18px 20px 0;">
                <div class="cmp-chart-label">Head-to-Head</div>
            </div>
            <table class="cmp-table">
                <thead>
                    <tr>
                        <th>Metrik</th>
                        <th x-text="result?.pl1?.name || 'Pemain 1'"></th>
                        <th></th>
                        <th x-text="result?.pl2?.name || 'Pemain 2'"></th>
                    </tr>
                </thead>
                <tbody>
                    <template x-if="result?.s1?.has_data || result?.s2?.has_data">
                        <template x-for="r in [
                            {l:'Tinggi (cm)',k:'height',b:'higher'},
                            {l:'Berat (kg)',k:'weight',b:'lower'},
                            {l:'BMI',k:'bmi',b:'lower'},
                            {l:'Body Fat (%)',k:'body_fat',b:'lower'},
                            {l:'Muscle Mass (kg)',k:'muscle_mass',b:'higher'},
                            {l:'MoCA Score',k:'moca',b:'higher'},
                            {l:'Passing Sukses',k:'passing',b:'higher'},
                            {l:'Scanning/10s',k:'scanning',b:'higher'},
                            {l:'Akselerasi 0-10m (s)',k:'accel',b:'lower'},
                            {l:'Top Speed (s)',k:'speed',b:'lower'},
                            {l:'Yo-Yo Level',k:'yoyo_level',b:'higher'},
                            {l:'Yo-Yo Jarak (m)',k:'yoyo_dist',b:'higher'},
                        ]" :key="r.l">
                            <tr>
                                <td x-text="r.l"></td>
                                <td :class="{win: result.s1[r.k]!=null && result.s2[r.k]!=null && ((r.b==='higher'&&result.s1[r.k]>result.s2[r.k])||(r.b==='lower'&&result.s1[r.k]<result.s2[r.k])), lose: result.s1[r.k]!=null && result.s2[r.k]!=null && ((r.b==='higher'&&result.s1[r.k]<result.s2[r.k])||(r.b==='lower'&&result.s1[r.k]>result.s2[r.k]))}" x-text="result.s1[r.k] ?? '—'"></td>
                                <td class="bar-cell">
                                    <div class="bar-pair">
                                        <div class="bar-a" :style="'width:'+(result.s1[r.k]&&result.s2[r.k] ? Math.round(result.s1[r.k]/(result.s1[r.k]+result.s2[r.k])*56) : 28)+'px'"></div>
                                        <div class="bar-b" :style="'width:'+(result.s1[r.k]&&result.s2[r.k] ? Math.round(result.s2[r.k]/(result.s1[r.k]+result.s2[r.k])*56) : 28)+'px'"></div>
                                    </div>
                                </td>
                                <td :class="{win: result.s1[r.k]!=null && result.s2[r.k]!=null && ((r.b==='higher'&&result.s2[r.k]>result.s1[r.k])||(r.b==='lower'&&result.s2[r.k]<result.s1[r.k])), lose: result.s1[r.k]!=null && result.s2[r.k]!=null && ((r.b==='higher'&&result.s2[r.k]<result.s1[r.k])||(r.b==='lower'&&result.s2[r.k]>result.s1[r.k]))}" x-text="result.s2[r.k] ?? '—'"></td>
                            </tr>
                        </template>
                    </template>
                    <template x-if="!result?.s1?.has_data && !result?.s2?.has_data">
                        <tr><td colspan="4" class="cmp-nodata">Kedua pemain belum memiliki data test.</td></tr>
                    </template>
                </tbody>
            </table>
        </div>

    </div>
</section>

{{-- ════════════ FILTER & SWIPER LOGIC ════════════ --}}
<script>
var _currentFilter = 'all';

function plSetFilter(cat) {
    _currentFilter = cat;
    /* Update button states */
    document.querySelectorAll('.pl-filter-btn').forEach(btn => btn.classList.remove('active'));
    const active = document.getElementById('pbf-' + cat);
    if (active) active.classList.add('active');
    plFilter();
}

function plFilter() {
    const cat = _currentFilter;
    const qRaw = (document.getElementById('pl-search-input')?.value || '').toLowerCase().trim();
    const qTerms = qRaw.split(/\s+/).filter(Boolean); // Pisah kata untuk pencarian canggih (e.g., "ahmad 27")

    /* ── SWIPER ── */
    const pool    = document.getElementById('pl-pool');
    const wrapper = document.getElementById('pl-swiper-wrapper');
    const isEmpty = () => !wrapper.querySelector('.pl-slide');

    if (pool && wrapper) {
        /* Move ALL slides back to pool */
        Array.from(wrapper.querySelectorAll('.pl-slide')).forEach(el => pool.appendChild(el));

        /* Move matching slides to wrapper */
        Array.from(pool.querySelectorAll('.pl-slide')).forEach(el => {
            const elCat   = el.dataset.cat;
            const elName  = el.dataset.name;
            const elNoreg = el.dataset.noreg;
            const elNum   = elNoreg.replace(/[^0-9]/g, ''); // Ambil murni angkanya (misal "01" atau "1")
            
            const catOk   = cat === 'all' || elCat === cat;
            
            // Canggih: Setiap kata yang diketik harus cocok di nama ATAU no_reg ATAU angka murninya
            const qOk     = qTerms.length === 0 || qTerms.every(term => 
                elName.includes(term) || elNoreg.includes(term) || elNum.includes(term) || elNum === term
            );
            
            if (catOk && qOk) wrapper.appendChild(el);
        });

        /* Rebuild swiper via Alpine */
        const alpineEl = document.querySelector('[data-slide]')?.closest('.pl-page') || document.querySelector('.pl-page');
        const component = alpineEl ? Alpine.$data(alpineEl) : null;
        const emptyDiv  = document.getElementById('pl-swiper-empty');

        if (isEmpty()) {
            if (emptyDiv) emptyDiv.style.display = '';
        } else {
            if (emptyDiv) emptyDiv.style.display = 'none';
            if (component) {
                if (component.swiper) { component.swiper.destroy(true,true); component.swiper = null; }
                setTimeout(() => {
                    const slides = wrapper.querySelectorAll('.pl-slide');
                    if (!slides.length) return;
                    component.swiper = new Swiper('.pl-swiper', {
                        effect:'coverflow', grabCursor:true, centeredSlides:true,
                        slidesPerView:'auto', speed:450,
                        coverflowEffect:{ rotate:0, stretch:-55, depth:210, modifier:1, slideShadows:false },
                        loop:false, keyboard:{enabled:true},
                        navigation:{nextEl:'.swiper-button-next',prevEl:'.swiper-button-prev'},
                        initialSlide: Math.floor(slides.length/2),
                    });
                }, 20);
            }
        }
    }

    /* ── GRID ── */
    let gridVisible = 0;
    document.querySelectorAll('[data-grid-card]').forEach(el => {
        const elCat   = el.dataset.cat;
        const elName  = el.dataset.name;
        const elNoreg = el.dataset.noreg;
        const elNum   = elNoreg.replace(/[^0-9]/g, '');
        
        const catOk   = cat === 'all' || elCat === cat;
        
        const qOk     = qTerms.length === 0 || qTerms.every(term => 
            elName.includes(term) || elNoreg.includes(term) || elNum.includes(term) || elNum === term
        );
        
        const show    = catOk && qOk;
        el.style.display = show ? '' : 'none';
        if (show) gridVisible++;
    });
    const gridEmpty = document.getElementById('pl-grid-empty');
    if (gridEmpty) gridEmpty.style.display = gridVisible ? 'none' : '';
}

/* Init: populate swiper with all slides on load */
document.addEventListener('DOMContentLoaded', function() {
    plFilter();
});
</script>

@endsection
