@extends('layouts.app')

@section('title', ($heroTitle ?: 'AHP Training') . ' — Program Latihan Terstruktur | Coach Agam')
@section('meta_description', 'AHP Training adalah program pelatihan sepakbola profesional terstruktur 6 tahap: Pre Test, Program Latihan, Volume & Intensitas, Evaluation Training Load, Post Test, hingga Report Individual Players.')
@section('og_type', 'website')
@section('og_title', ($heroTitle ?: 'AHP Training') . ' — Coach Agam')
@section('og_description', 'Program latihan sepakbola terstruktur berbasis data ilmiah. Dari Pre Test hingga Report Individual — semua tercatat dan terukur.')

@section('schema_extra')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "Course",
  "name": "{{ addslashes($heroTitle ?: 'AHP Training') }}",
  "description": "Program pelatihan fisik dan teknik sepakbola profesional terstruktur dalam 6 tahap.",
  "url": "{{ url('/ahp-training') }}",
  "provider": {
    "@@type": "Person",
    "name": "Coach Agam",
    "url": "{{ url('/profil-coach-agam') }}"
  }
}
</script>
@endsection

@section('content')

<x-breadcrumb
    title="{{ $heroTitle }}"
    subtitle="{{ $heroSubtitle }}"
    image="{{ $__globalBreadcrumbImage }}"
    :links="['Beranda' => '/', 'AHP Training' => '']"
/>

<style>
/* ── BASE ─────────────────────────────────────────────────────── */
.ahp-wrap {
    width: 100%; max-width: 1200px;
    margin: 0 auto; padding: 0 40px; box-sizing: border-box;
}
@media(max-width:768px){ .ahp-wrap { padding: 0 20px; } }

/* Headlines */
.ahp-headline {
    font-size: clamp(28px, 3.5vw, 52px);
    line-height: 1.1; letter-spacing: -1.5px; color: #0D0D0D; margin: 0 0 24px;
}
.ahp-headline .hl-bold { font-weight: 800; }
.ahp-headline .hl-thin  { font-weight: 300; font-style: italic; color: #4B5563; }
.ahp-headline.light .hl-bold { color: #FFFFFF; }
.ahp-headline.light .hl-thin  { color: #6B7280; }

/* Eyebrow */
.ahp-eyebrow { display:flex; align-items:center; gap:12px; margin-bottom:20px; }
.ahp-eyebrow .step-num  { font-size:11px; font-weight:800; letter-spacing:3px; color:#1A1A1A; }
.ahp-eyebrow .step-line { flex:1; max-width:40px; height:1px; background:#1A1A1A; }
.ahp-eyebrow .step-label{ font-size:10px; font-weight:700; letter-spacing:4px; text-transform:uppercase; color:#9CA3AF; }
.ahp-eyebrow.light .step-num  { color:#9CA3AF; }
.ahp-eyebrow.light .step-line { background:rgba(255,255,255,0.2); }

/* Body text */
.ahp-body { font-size:15px; line-height:1.9; color:#6B7280; max-width:520px; }
.ahp-body.light { color:#9CA3AF; }

/* Image box */
.ahp-img { position:relative; overflow:hidden; background:#F3F4F6; }
.ahp-img img { width:100%; height:100%; object-fit:cover; display:block; }
.ahp-img-ph {
    width:100%; height:100%; min-height:280px;
    display:flex; flex-direction:column;
    align-items:center; justify-content:center;
    gap:14px; color:#C1C8D1;
}
.ahp-img-ph span { font-size:11px; font-weight:700; letter-spacing:3px; text-transform:uppercase; }

/* Step number watermark */
.step-watermark {
    font-size: 120px; font-weight:900; color:#F3F4F6;
    line-height:1; letter-spacing:-4px; margin-bottom:-24px;
    display:block; user-select:none;
}

/* ── INTRO (Overview) ─────────────────────────────────────────── */
.ahp-intro { padding:100px 0 80px; background:#fff; }
.ahp-intro-grid {
    display: grid; grid-template-columns: 1fr; gap:64px; align-items:center;
}
@media(min-width:960px){ .ahp-intro-grid { grid-template-columns: 5fr 4fr; } }
.ahp-intro-img { aspect-ratio:4/3; }
.ahp-intro-float-label {
    position:absolute; top:-20px; right:-20px;
    background:#0D0D0D; color:#fff;
    padding:14px 20px;
    font-size:11px; font-weight:700; letter-spacing:3px; text-transform:uppercase; line-height:1.5; z-index:2;
}
@media(max-width:960px){ .ahp-intro-float-label { right:0; top:0; } }

/* ── SECTION 1: PRE TEST (white) ─────────────────────────────── */
.ahp-step { padding:100px 0; }
.ahp-step.bg-white { background:#fff; }
.ahp-step.bg-gray  { background:#F9FAFB; }
.ahp-step.bg-dark  { background:#0D0D0D; }

.ahp-step-grid { display:grid; grid-template-columns:1fr; gap:64px; align-items:center; }
@media(min-width:960px){ .ahp-step-grid { grid-template-columns:1fr 1fr; gap:80px; } }
.ahp-step-img { aspect-ratio:4/3; }

/* ── SECTION 2: PROGRAM LATIHAN (dark 4-col) ─────────────────── */
.prog-cards-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1px;
    background: rgba(255,255,255,0.07);
    border: 1px solid rgba(255,255,255,0.07);
    margin-top: 48px;
}
@media(min-width:960px){ .prog-cards-grid { grid-template-columns: repeat(4, 1fr); } }
.prog-card {
    background:#0D0D0D; padding:36px 28px;
    transition: background 200ms;
}
.prog-card:hover { background:#161616; }
.prog-card-num {
    font-size:11px; font-weight:800; letter-spacing:4px;
    color:rgba(255,255,255,0.2); margin-bottom:16px;
}
.prog-card-title {
    font-size:18px; font-weight:700; color:#F5F5F5; margin-bottom:12px; letter-spacing:-0.3px;
}
.prog-card-desc { font-size:13px; line-height:1.8; color:#6B7280; }
.prog-card-icon {
    width:44px; height:44px;
    border:1px solid rgba(255,255,255,0.1);
    display:flex; align-items:center; justify-content:center;
    color:rgba(255,255,255,0.5); margin-bottom:20px;
}

/* ── SECTION 6: REPORT (search box) ────────────────────────── */
.ahp-report-grid { display:grid; grid-template-columns:1fr; gap:64px; align-items:center; }
@media(min-width:960px){ .ahp-report-grid { grid-template-columns:1fr 1fr; gap:80px; } }
.search-box-wrap {
    background:#fff;
    border:1px solid #E5E7EB;
    padding:40px;
}
@media(max-width:768px){ .search-box-wrap { padding:28px 20px; } }
.search-input {
    width:100%; box-sizing:border-box;
    padding:16px 20px;
    font-size:15px; font-weight:600;
    border:2px solid #E5E7EB; outline:none;
    color:#1A1A1A; font-family:inherit;
    transition:border 200ms;
    text-transform:uppercase; letter-spacing:2px;
}
.search-input:focus { border-color:#1A1A1A; }
.search-input::placeholder { text-transform:none; letter-spacing:0; font-weight:400; color:#9CA3AF; }
.search-btn {
    width:100%; padding:16px;
    background:#1A1A1A; color:#fff;
    font-size:13px; font-weight:700; letter-spacing:2px; text-transform:uppercase;
    border:none; cursor:pointer; margin-top:12px;
    display:flex; align-items:center; justify-content:center; gap:10px;
    transition:background 200ms; font-family:inherit;
}
.search-btn:hover { background:#333; }

@media(max-width:768px){
    .ahp-step { padding: 60px 0; }
    .ahp-intro { padding: 60px 0; }
    .step-watermark { font-size:80px; margin-bottom:-14px; }
    .prog-cards-grid { grid-template-columns:1fr; }
    .prog-card { padding:28px 20px; }
}
</style>


{{-- ══════════════════════════════════════════════════════
     INTRO / OVERVIEW (Existing - Preserved)
     ══════════════════════════════════════════════════════ --}}
<section class="ahp-intro">
    <div class="ahp-wrap">
        <div class="ahp-intro-grid">
            {{-- LEFT --}}
            <div>
                <div class="ahp-eyebrow">
                    <span class="step-num">AHP</span>
                    <span class="step-line"></span>
                    <span class="step-label">{{ $introEyebrowLabel }}</span>
                </div>
                <h2 class="ahp-headline" style="font-size:clamp(32px,4vw,60px); margin-bottom:32px;">
                    <span class="hl-bold">{{ $introHeadlineBold }}</span><br>
                    <span class="hl-thin">{{ $introHeadlineThin }}</span>
                </h2>
                <div class="ahp-body" style="max-width:600px;">{!! $aboutText !!}</div>
                {{-- Stats --}}
                <div style="display:flex; gap:40px; margin-top:48px; padding-top:32px; border-top:1px solid #E5E7EB; flex-wrap:wrap;">
                    <div>
                        <div style="font-size:32px; font-weight:900; letter-spacing:-1px; color:#0D0D0D;">{{ $stat1Value }}</div>
                        <div style="font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#9CA3AF; margin-top:4px;">{{ $stat1Label }}</div>
                    </div>
                    <div>
                        <div style="font-size:32px; font-weight:900; letter-spacing:-1px; color:#0D0D0D;">{{ $stat2Value }}</div>
                        <div style="font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#9CA3AF; margin-top:4px;">{{ $stat2Label }}</div>
                    </div>
                    <div>
                        <div style="font-size:32px; font-weight:900; letter-spacing:-1px; color:#0D0D0D;">{{ $stat3Value }}</div>
                        <div style="font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#9CA3AF; margin-top:4px;">{{ $stat3Label }}</div>
                    </div>
                </div>
            </div>
            {{-- RIGHT: image --}}
            <div style="position:relative;">
                <div class="ahp-img ahp-intro-img">
                    @if($aboutImage)
                        <img src="{{ asset('storage/'.$aboutImage) }}" alt="{{ $heroTitle }}">
                    @else
                        <div class="ahp-img-ph" style="background:linear-gradient(160deg,#1A1A1A,#3A3A3A);">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.15)" stroke-width="1.5"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                            <span style="color:rgba(255,255,255,0.2);">Gambar AHP</span>
                        </div>
                    @endif
                </div>
                <div class="ahp-intro-float-label">{!! nl2br(e($introBadgeText)) !!}</div>
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     SECTION 1: PRE TEST
     ══════════════════════════════════════════════════════ --}}
<section class="ahp-step bg-gray">
    <div class="ahp-wrap">
        <div class="ahp-step-grid">
            {{-- Content --}}
            <div>
                <span class="step-watermark">01</span>
                <div class="ahp-eyebrow">
                    <span class="step-num">Tahap 1</span>
                    <span class="step-line"></span>
                    <span class="step-label">Initial Assessment</span>
                </div>
                <h2 class="ahp-headline">
                    <span class="hl-bold">{{ $preTestTitle ?: 'Pre Test' }}</span>
                </h2>
                <div class="ahp-body">{!! nl2br(e($preTestDesc)) !!}</div>
                @php $preItems = json_decode($preTestItems ?? '[]', true) ?: []; @endphp
                @if(count($preItems) > 0)
                <ul style="margin-top:28px; padding:0; list-style:none; display:flex; flex-direction:column; gap:10px;">
                    @foreach($preItems as $item)
                    <li style="display:flex; align-items:center; gap:12px; font-size:14px; color:#374151;">
                        <span style="width:20px; height:20px; background:#1A1A1A; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        {{ $item }}
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
            {{-- Image --}}
            <div class="ahp-img ahp-step-img">
                @if($preTestImage)
                    <img src="{{ asset('storage/'.$preTestImage) }}" alt="{{ $preTestTitle }}">
                @else
                    <div class="ahp-img-ph">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>
                        <span>Pre Test</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     SECTION 2: PROGRAM LATIHAN (dark, 4 cards)
     ══════════════════════════════════════════════════════ --}}
<section class="ahp-step bg-dark">
    <div class="ahp-wrap">
        {{-- Header --}}
        <div style="display:flex; justify-content:space-between; align-items:flex-end; flex-wrap:wrap; gap:24px;">
            <div>
                <div class="ahp-eyebrow light">
                    <span class="step-num">Tahap 2</span>
                    <span class="step-line"></span>
                    <span class="step-label">Structured Training</span>
                </div>
                <h2 class="ahp-headline light" style="font-size:clamp(24px,3vw,44px);">
                    <span class="hl-bold">{{ $programTitle ?: 'Program Latihan' }}</span><br>
                    <span class="hl-thin">{{ $programSubtitle ?: 'Tahunan · Bulanan · Mingguan · Harian' }}</span>
                </h2>
            </div>
            <p class="ahp-body light" style="max-width:340px; margin:0;">{!! nl2br(e($programDesc)) !!}</p>
        </div>

        {{-- 4 Cards --}}
        @php
        $progCards = json_decode($programCards ?? '[]', true) ?: [
            ['title' => 'Tahunan',   'desc' => 'Perencanaan jangka panjang satu tahun penuh mencakup fase preseason, kompetisi, dan pemulihan.', 'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>'],
            ['title' => 'Bulanan',   'desc' => 'Siklus latihan bulanan dengan variasi intensitas untuk mencegah plateau dan overtraining.', 'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>'],
            ['title' => 'Mingguan',  'desc' => 'Penyesuaian beban latihan per minggu berdasarkan respons tubuh dan jadwal pertandingan.', 'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>'],
            ['title' => 'Harian',    'desc' => 'Sesi latihan harian yang terstruktur dengan warm-up, core session, dan cool-down.', 'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>'],
        ];
        @endphp
        <div class="prog-cards-grid">
            @foreach($progCards as $idx => $card)
            <div class="prog-card">
                <div class="prog-card-num">{{ str_pad($idx+1,'2','0',STR_PAD_LEFT) }}</div>
                <div class="prog-card-icon">{!! $card['icon'] ?? '' !!}</div>
                <div class="prog-card-title">{{ $card['title'] }}</div>
                <div class="prog-card-desc">{{ $card['desc'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     SECTION 3: VOLUME & INTENSITAS
     ══════════════════════════════════════════════════════ --}}
<section class="ahp-step bg-white">
    <div class="ahp-wrap">
        <div class="ahp-step-grid">
            {{-- Image first (swap order on desktop) --}}
            <div class="ahp-img ahp-step-img" style="order:2;">
                @if($volumeImage)
                    <img src="{{ asset('storage/'.$volumeImage) }}" alt="{{ $volumeTitle }}">
                @else
                    <div class="ahp-img-ph">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>
                        <span>Volume & Intensitas</span>
                    </div>
                @endif
            </div>
            {{-- Content --}}
            <div style="order:1;">
                <span class="step-watermark">03</span>
                <div class="ahp-eyebrow">
                    <span class="step-num">Tahap 3</span>
                    <span class="step-line"></span>
                    <span class="step-label">Periodization</span>
                </div>
                <h2 class="ahp-headline">
                    <span class="hl-bold">{{ $volumeTitle ?: 'Volume & Intensitas' }}</span>
                </h2>
                <div class="ahp-body">{!! nl2br(e($volumeDesc)) !!}</div>
                @php $volStats = json_decode($volumeStats ?? '[]', true) ?: []; @endphp
                @if(count($volStats) > 0)
                <div style="display:flex; gap:32px; margin-top:36px; padding-top:24px; border-top:1px solid #E5E7EB; flex-wrap:wrap;">
                    @foreach($volStats as $vs)
                    <div>
                        <div style="font-size:28px; font-weight:900; letter-spacing:-1px; color:#0D0D0D;">{{ $vs['value'] }}</div>
                        <div style="font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#9CA3AF; margin-top:4px;">{{ $vs['label'] }}</div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     SECTION 4: EVALUATION TRAINING LOAD
     ══════════════════════════════════════════════════════ --}}
<section class="ahp-step bg-gray">
    <div class="ahp-wrap">
        <div class="ahp-step-grid">
            {{-- Content --}}
            <div>
                <span class="step-watermark">04</span>
                <div class="ahp-eyebrow">
                    <span class="step-num">Tahap 4</span>
                    <span class="step-line"></span>
                    <span class="step-label">Monitoring</span>
                </div>
                <h2 class="ahp-headline">
                    <span class="hl-bold">{{ $evalTitle ?: 'Evaluation Training Load' }}</span>
                </h2>
                <div class="ahp-body">{!! nl2br(e($evalDesc)) !!}</div>
                @php $evalItems = json_decode($evalPoints ?? '[]', true) ?: []; @endphp
                @if(count($evalItems) > 0)
                <ul style="margin-top:28px; padding:0; list-style:none; display:flex; flex-direction:column; gap:10px;">
                    @foreach($evalItems as $item)
                    <li style="display:flex; align-items:center; gap:12px; font-size:14px; color:#374151;">
                        <span style="width:20px; height:20px; background:#1A1A1A; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        {{ $item }}
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
            {{-- Image --}}
            <div class="ahp-img ahp-step-img">
                @if($evalImage)
                    <img src="{{ asset('storage/'.$evalImage) }}" alt="{{ $evalTitle }}">
                @else
                    <div class="ahp-img-ph">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        <span>Evaluation Load</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     SECTION 5: POST TEST
     ══════════════════════════════════════════════════════ --}}
<section class="ahp-step bg-white">
    <div class="ahp-wrap">
        <div class="ahp-step-grid">
            {{-- Image (right/swap) --}}
            <div class="ahp-img ahp-step-img" style="order:2;">
                @if($postTestImage)
                    <img src="{{ asset('storage/'.$postTestImage) }}" alt="{{ $postTestTitle }}">
                @else
                    <div class="ahp-img-ph">
                        <svg width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                        <span>Post Test</span>
                    </div>
                @endif
            </div>
            {{-- Content --}}
            <div style="order:1;">
                <span class="step-watermark">05</span>
                <div class="ahp-eyebrow">
                    <span class="step-num">Tahap 5</span>
                    <span class="step-line"></span>
                    <span class="step-label">Final Assessment</span>
                </div>
                <h2 class="ahp-headline">
                    <span class="hl-bold">{{ $postTestTitle ?: 'Post Test' }}</span>
                </h2>
                <div class="ahp-body">{!! nl2br(e($postTestDesc)) !!}</div>
                @php $postItems = json_decode($postTestItems ?? '[]', true) ?: []; @endphp
                @if(count($postItems) > 0)
                <ul style="margin-top:28px; padding:0; list-style:none; display:flex; flex-direction:column; gap:10px;">
                    @foreach($postItems as $item)
                    <li style="display:flex; align-items:center; gap:12px; font-size:14px; color:#374151;">
                        <span style="width:20px; height:20px; background:#1A1A1A; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </span>
                        {{ $item }}
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
        </div>
    </div>
</section>


{{-- ══════════════════════════════════════════════════════
     SECTION 6: REPORT INDIVIDUAL PLAYERS (dark + search)
     ══════════════════════════════════════════════════════ --}}
<section class="ahp-step bg-dark">
    <div class="ahp-wrap">
        <div class="ahp-report-grid">
            {{-- Left: content --}}
            <div>
                <span class="step-watermark" style="color:rgba(255,255,255,0.05);">06</span>
                <div class="ahp-eyebrow light">
                    <span class="step-num">Tahap 6</span>
                    <span class="step-line"></span>
                    <span class="step-label">Individual Report</span>
                </div>
                <h2 class="ahp-headline light">
                    <span class="hl-bold">{{ $reportTitle ?: 'Report Individual' }}</span><br>
                    <span class="hl-thin">Players</span>
                </h2>
                <div class="ahp-body light">{!! nl2br(e($reportDesc)) !!}</div>

                {{-- Optional: report image --}}
                @if($reportImage)
                <div class="ahp-img" style="aspect-ratio:16/7; margin-top:40px;">
                    <img src="{{ asset('storage/'.$reportImage) }}" alt="{{ $reportTitle }}">
                </div>
                @endif
            </div>

            {{-- Right: View Players CTA --}}
            <div>
                <div class="search-box-wrap" style="text-align:center; padding:48px 40px;">
                    <div style="margin-bottom:28px;">
                        <div style="font-size:11px; font-weight:800; letter-spacing:3px; text-transform:uppercase; color:#9CA3AF; margin-bottom:8px;">Direktori Atlet</div>
                        <h3 style="font-size:22px; font-weight:800; color:#0D0D0D; letter-spacing:-0.5px; margin:0 0 8px;">Lihat Semua Pemain</h3>
                        <p style="font-size:13px; color:#6B7280; margin:0; line-height:1.7;">Jelajahi profil dan statistik performa seluruh atlet yang tergabung dalam program AHP Training Coach Agam.</p>
                    </div>

                    <a href="{{ route('ahp.players') }}"
                       style="display:inline-flex;align-items:center;gap:10px;background:#1A1A1A;color:#fff;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;border:none;cursor:pointer;padding:16px 32px;text-decoration:none;transition:background 200ms;font-family:inherit;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        Lihat Semua Pemain
                    </a>

                    <div style="margin-top:24px; padding-top:24px; border-top:1px solid #F3F4F6;">
                        <p style="font-size:12px; color:#9CA3AF; margin:0; line-height:1.7;">
                            Ingin bergabung? Hubungi Coach Agam melalui
                            <a href="{{ route('kontak') }}" style="color:#1A1A1A; font-weight:700; text-decoration:none;">halaman kontak</a>
                            untuk mendaftar program AHP Training.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<x-cta-kerjasama />

@endsection
