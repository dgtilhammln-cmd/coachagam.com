@extends('layouts.app')

@section('title', 'Coach Agam - AHP Training Platform | Optimalkan Performa Atletik Anda')
@section('description', 'Platform pelatihan atletik berbasis AHP dengan program ilmiah, monitoring beban latihan, dan analitik performa. Wujudkan potensi terbaik Anda bersama Coach Agam.')
@section('keywords', 'coach agam, ahp training, latihan atletik, program latihan, monitoring RPE, pre test post test, performa atletik')

@section('content')

{{-- =========================================================
     SECTION 1: HERO
     ========================================================= --}}
<section
    id="hero"
    aria-label="Hero - Optimize Athletic Performance"
    style="
        position: relative;
        width: 100%;
        min-height: 100vh;
        background-color: #0F0F0F;
        display: flex;
        align-items: center;
        padding-top: 64px;
        overflow: hidden;
    "
>
    {{-- Background Glow Effects --}}
    <div aria-hidden="true" style="position:absolute; inset:0; pointer-events:none; overflow:hidden;">
        <div style="
            position:absolute; top:20%; left:-10%;
            width:500px; height:500px;
            background: radial-gradient(circle, rgba(192,192,192,0.06) 0%, transparent 70%);
            border-radius:50%; filter:blur(60px);
        "></div>
        <div style="
            position:absolute; bottom:10%; right:-5%;
            width:400px; height:400px;
            background: radial-gradient(circle, rgba(168,168,168,0.05) 0%, transparent 70%);
            border-radius:50%; filter:blur(80px);
        "></div>
        {{-- Grid Pattern --}}
        <div style="
            position:absolute; inset:0;
            background-image:
                linear-gradient(rgba(176,176,176,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(176,176,176,0.03) 1px, transparent 1px);
            background-size: 48px 48px;
        "></div>
    </div>

    <div style="max-width:1140px; margin:0 auto; padding:80px 24px; width:100%; position:relative; z-index:1;">
        <div style="
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 64px;
            align-items: center;
        " class="hero-grid">

            {{-- Hero Text --}}
            <div class="fade-in">
                <div class="section-label" style="margin-bottom:20px;">
                    🏆 &nbsp; Platform Pelatihan AHP #1
                </div>

                <h1 style="
                    font-size: clamp(36px, 5vw, 60px);
                    font-weight: 700;
                    color: #FFFFFF;
                    line-height: 1.1;
                    letter-spacing: -0.03em;
                    margin: 0 0 24px;
                ">
                    Optimalkan<br>
                    <span style="
                        background: linear-gradient(135deg, #F0F0F0, #C0C0C0, #A8A8A8);
                        -webkit-background-clip: text;
                        -webkit-text-fill-color: transparent;
                        background-clip: text;
                    ">Performa Atletik</span><br>
                    Anda
                </h1>

                <p style="font-size:18px; color:#A3A3A3; line-height:1.7; margin:0 0 40px; max-width:460px;">
                    Program latihan ilmiah berbasis data dengan metodologi AHP — dari Pre-Test hingga Post-Test, semua termonitor secara akurat dan terstruktur.
                </p>

                <div style="display:flex; gap:16px; flex-wrap:wrap;">
                    <x-button href="#ahp-training" variant="primary" size="lg">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polygon points="5 3 19 12 5 21 5 3"/></svg>
                        Mulai Training
                    </x-button>
                    <x-button href="#about" variant="secondary" size="lg">
                        Pelajari Lebih Lanjut
                    </x-button>
                </div>

                {{-- Trust Badges --}}
                <div style="display:flex; align-items:center; gap:24px; margin-top:48px; flex-wrap:wrap;">
                    @foreach([
                        ['num' => '200+', 'label' => 'Atlet Terlatih'],
                        ['num' => '95%',  'label' => 'Tingkat Kepuasan'],
                        ['num' => '3x',   'label' => 'Peningkatan Performa'],
                    ] as $stat)
                        <div style="text-align:left;">
                            <div style="
                                font-size:24px; font-weight:700;
                                background: linear-gradient(135deg, #F0F0F0, #C0C0C0);
                                -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
                            ">{{ $stat['num'] }}</div>
                            <div style="font-size:12px; color:#6B7280; margin-top:2px;">{{ $stat['label'] }}</div>
                        </div>
                        @if(!$loop->last)
                            <div style="width:1px; height:36px; background:rgba(176,176,176,0.2);" aria-hidden="true"></div>
                        @endif
                    @endforeach
                </div>
            </div>

            {{-- Hero Visual --}}
            <div class="fade-in fade-in-delay-2 hero-image-col">
                <div style="
                    position: relative;
                    width: 100%;
                    aspect-ratio: 1;
                    max-width: 520px;
                    margin: 0 auto;
                ">
                    {{-- Main card --}}
                    <div style="
                        background: #1A1A1A;
                        border: 1px solid rgba(192,192,192,0.25);
                        border-radius: 24px;
                        padding: 32px;
                        box-shadow: 0 24px 80px rgba(0,0,0,0.7);
                        position: relative;
                        overflow: hidden;
                    ">
                        {{-- Top gradient bar --}}
                        <div style="
                            position:absolute; top:0; left:0; right:0; height:3px;
                            background: linear-gradient(90deg, #F0F0F0, #C0C0C0, #A8A8A8);
                        " aria-hidden="true"></div>

                        {{-- Header --}}
                        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:28px;">
                            <div>
                                <div style="font-size:12px; color:#6B7280; text-transform:uppercase; letter-spacing:0.08em; margin-bottom:4px;">Dashboard Atlet</div>
                                <div style="font-size:18px; font-weight:700; color:#FFFFFF;">Performance Score</div>
                            </div>
                            <div style="
                                width:48px; height:48px; border-radius:12px;
                                background: linear-gradient(135deg, #F0F0F0, #C0C0C0, #A8A8A8);
                                display:flex; align-items:center; justify-content:center;
                                font-size:22px;
                            " aria-hidden="true">📊</div>
                        </div>

                        {{-- Score Ring --}}
                        <div style="display:flex; align-items:center; justify-content:center; margin:20px 0 28px;">
                            <div style="position:relative; width:140px; height:140px;">
                                <svg viewBox="0 0 140 140" style="width:140px;height:140px;transform:rotate(-90deg);">
                                    <circle cx="70" cy="70" r="56" fill="none" stroke="#262626" stroke-width="12"/>
                                    <circle cx="70" cy="70" r="56" fill="none"
                                        stroke="url(#scoreGrad)" stroke-width="12"
                                        stroke-dasharray="352" stroke-dashoffset="70"
                                        stroke-linecap="round"/>
                                    <defs>
                                        <linearGradient id="scoreGrad" x1="0%" y1="0%" x2="100%" y2="0%">
                                            <stop offset="0%" stop-color="#F0F0F0"/>
                                            <stop offset="50%" stop-color="#C0C0C0"/>
                                            <stop offset="100%" stop-color="#A8A8A8"/>
                                        </linearGradient>
                                    </defs>
                                </svg>
                                <div style="position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;">
                                    <div style="font-size:32px;font-weight:700;color:#FFFFFF;line-height:1;">87</div>
                                    <div style="font-size:11px;color:#6B7280;margin-top:2px;">/ 100</div>
                                </div>
                            </div>
                        </div>

                        {{-- Stats Row --}}
                        <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:12px; margin-bottom:24px;">
                            @foreach([
                                ['icon' => '⚡', 'label' => 'RPE',      'value' => '7.2'],
                                ['icon' => '📈', 'label' => 'Volume',   'value' => '+18%'],
                                ['icon' => '🎯', 'label' => 'Target',   'value' => '94%'],
                            ] as $metric)
                                <div style="
                                    background:#262626;
                                    border-radius:10px;
                                    padding:12px;
                                    text-align:center;
                                ">
                                    <div style="font-size:18px; margin-bottom:4px;" aria-hidden="true">{{ $metric['icon'] }}</div>
                                    <div style="font-size:16px; font-weight:700; color:#FFFFFF;">{{ $metric['value'] }}</div>
                                    <div style="font-size:10px; color:#6B7280; text-transform:uppercase; letter-spacing:0.06em;">{{ $metric['label'] }}</div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Progress bars --}}
                        @foreach([
                            ['label' => 'Kekuatan',    'pct' => 82, 'color' => '#C0C0C0'],
                            ['label' => 'Kecepatan',   'pct' => 74, 'color' => '#A8A8A8'],
                            ['label' => 'Ketahanan',   'pct' => 91, 'color' => '#D3D3D3'],
                        ] as $bar)
                            <div style="margin-bottom:12px;">
                                <div style="display:flex;justify-content:space-between;font-size:12px;color:#A3A3A3;margin-bottom:5px;">
                                    <span>{{ $bar['label'] }}</span>
                                    <span style="color:#FFFFFF;font-weight:600;">{{ $bar['pct'] }}%</span>
                                </div>
                                <div style="height:6px;background:#262626;border-radius:9999px;overflow:hidden;">
                                    <div style="
                                        height:100%; width:{{ $bar['pct'] }}%;
                                        background: linear-gradient(90deg, #F0F0F0, {{ $bar['color'] }});
                                        border-radius:9999px;
                                        transition: width 1s ease-out;
                                    " role="progressbar" aria-valuenow="{{ $bar['pct'] }}" aria-valuemin="0" aria-valuemax="100" aria-label="{{ $bar['label'] }}"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Floating badges --}}
                    <div style="
                        position:absolute; top:-16px; right:-16px;
                        background: linear-gradient(135deg, #F0F0F0, #C0C0C0);
                        color: #0F0F0F;
                        border-radius:12px;
                        padding:10px 16px;
                        font-size:13px;
                        font-weight:700;
                        box-shadow: 0 8px 24px rgba(0,0,0,0.5);
                        display:flex; align-items:center; gap:6px;
                    " aria-hidden="true">
                        ✅ Pre-Test Selesai
                    </div>
                    <div style="
                        position:absolute; bottom:-16px; left:-16px;
                        background: #1A1A1A;
                        border: 1px solid rgba(192,192,192,0.3);
                        color: #D3D3D3;
                        border-radius:12px;
                        padding:10px 16px;
                        font-size:13px;
                        font-weight:600;
                        box-shadow: 0 8px 24px rgba(0,0,0,0.5);
                        display:flex; align-items:center; gap:6px;
                    " aria-hidden="true">
                        🔥 Sesi Aktif: 14/20
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================
     SECTION 2: FEATURES (3 Cards)
     ========================================================= --}}
<section
    id="features"
    aria-labelledby="features-title"
    style="background-color:#0F0F0F; padding:96px 0;"
>
    <div style="max-width:1140px; margin:0 auto; padding:0 24px;">

        <x-section-title
            label="Fitur Unggulan"
            title="Mengapa Memilih AHP Training?"
            subtitle="Sistem pelatihan komprehensif yang menggabungkan ilmu olahraga dengan teknologi untuk hasil yang terukur dan konsisten."
            :centered="true"
        />

        <div style="
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        " class="features-grid" role="list">

            @foreach([
                [
                    'icon'  => '📋',
                    'title' => 'Pre-Test & Post-Test Tracking',
                    'desc'  => 'Ukur performa atletik sebelum dan sesudah program latihan dengan tes terstandarisasi untuk melihat progres yang nyata dan terukur.',
                    'tags'  => ['Standar Ilmiah', 'Progres Terukur'],
                ],
                [
                    'icon'  => '📊',
                    'title' => 'Manajemen Beban Latihan',
                    'desc'  => 'Monitor RPE, volume latihan, dan status pemulihan atlet secara real-time untuk mencegah overtraining dan memaksimalkan adaptasi tubuh.',
                    'tags'  => ['RPE Monitoring', 'Anti Overtraining'],
                ],
                [
                    'icon'  => '📈',
                    'title' => 'Laporan Analitik Visual',
                    'desc'  => 'Visualisasi data performa yang indah dan informatif. Chart interaktif yang memudahkan coach dan atlet memahami tren perkembangan.',
                    'tags'  => ['Data Visual', 'Tren Performa'],
                ],
            ] as $i => $feature)
                <div
                    class="fade-in fade-in-delay-{{ $i + 1 }}"
                    role="listitem"
                    style="
                        background:#1A1A1A;
                        border:1px solid rgba(176,176,176,0.2);
                        border-radius:16px;
                        padding:32px 28px;
                        transition: all 200ms ease-out;
                        position:relative;
                        overflow:hidden;
                    "
                    onmouseover="
                        this.style.borderColor='rgba(192,192,192,0.45)';
                        this.style.transform='translateY(-4px)';
                        this.style.boxShadow='0 16px 48px rgba(0,0,0,0.6)';
                    "
                    onmouseout="
                        this.style.borderColor='rgba(176,176,176,0.2)';
                        this.style.transform='';
                        this.style.boxShadow='';
                    "
                >
                    {{-- Top accent line --}}
                    <div style="
                        position:absolute; top:0; left:24px; right:24px; height:1px;
                        background: linear-gradient(90deg, transparent, rgba(192,192,192,0.4), transparent);
                    " aria-hidden="true"></div>

                    <div class="icon-silver" style="margin-bottom:20px; font-size:24px;">
                        {{ $feature['icon'] }}
                    </div>

                    <h3 style="font-size:18px; font-weight:700; color:#FFFFFF; margin:0 0 12px; line-height:1.3;">
                        {{ $feature['title'] }}
                    </h3>

                    <p style="font-size:14px; color:#A3A3A3; line-height:1.7; margin:0 0 20px;">
                        {{ $feature['desc'] }}
                    </p>

                    <div style="display:flex; gap:8px; flex-wrap:wrap;">
                        @foreach($feature['tags'] as $tag)
                            <span style="
                                font-size:11px; font-weight:600;
                                color:#A3A3A3;
                                background:rgba(176,176,176,0.08);
                                border:1px solid rgba(176,176,176,0.18);
                                border-radius:9999px;
                                padding:3px 10px;
                                letter-spacing:0.04em;
                            ">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- =========================================================
     SECTION 3: ABOUT COACH AGAM
     ========================================================= --}}
<section
    id="about"
    aria-labelledby="about-title"
    style="
        padding: 96px 0;
        background: linear-gradient(180deg, #0F0F0F 0%, #111111 100%);
        position: relative;
        overflow: hidden;
    "
>
    {{-- Decorative --}}
    <div aria-hidden="true" style="
        position:absolute; top:50%; right:-100px; transform:translateY(-50%);
        width:400px; height:400px;
        background: radial-gradient(circle, rgba(192,192,192,0.04) 0%, transparent 70%);
        border-radius:50%;
    "></div>

    <div style="max-width:1140px; margin:0 auto; padding:0 24px;">
        <div style="
            display:grid;
            grid-template-columns:1fr 1fr;
            gap:72px;
            align-items:center;
        " class="about-grid">

            {{-- Image Side --}}
            <div class="fade-in" style="position:relative;">
                <div style="
                    width:100%;
                    aspect-ratio:4/5;
                    max-width:420px;
                    border-radius:24px;
                    overflow:hidden;
                    background: linear-gradient(135deg, #1A1A1A, #262626);
                    border:1px solid rgba(192,192,192,0.2);
                    box-shadow: 0 24px 80px rgba(0,0,0,0.6);
                    position:relative;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                ">
                    {{-- Placeholder illustration --}}
                    <div style="text-align:center; padding:40px;">
                        <div style="font-size:80px; margin-bottom:16px; line-height:1;" aria-hidden="true">👨‍🏫</div>
                        <div style="font-size:20px; font-weight:700; color:#FFFFFF; margin-bottom:8px;">Coach Agam</div>
                        <div style="font-size:13px; color:#A3A3A3;">Certified Strength & Conditioning</div>
                        <div style="font-size:13px; color:#A3A3A3;">Specialist — NSCA CSCS</div>
                    </div>

                    {{-- Corner accent --}}
                    <div style="
                        position:absolute; top:0; right:0;
                        width:80px; height:80px;
                        background: linear-gradient(135deg, rgba(240,240,240,0.08), transparent);
                        border-radius:0 24px 0 80px;
                    " aria-hidden="true"></div>
                </div>

                {{-- Floating certification badge --}}
                <div style="
                    position:absolute; bottom:24px; right:-12px;
                    background: #1A1A1A;
                    border: 1px solid rgba(192,192,192,0.3);
                    border-radius:14px;
                    padding:14px 18px;
                    box-shadow: 0 8px 32px rgba(0,0,0,0.5);
                " aria-hidden="true">
                    <div style="font-size:11px; color:#6B7280; text-transform:uppercase; letter-spacing:0.08em; margin-bottom:4px;">Certified By</div>
                    <div style="font-size:15px; font-weight:700; color:#FFFFFF;">NSCA CSCS</div>
                    <div style="font-size:11px; color:#A3A3A3;">Since 2018</div>
                </div>
            </div>

            {{-- Content Side --}}
            <div class="fade-in fade-in-delay-2">
                <x-section-title
                    label="Tentang Coach"
                    title="Berpengalaman. Terukur. Berdedikasi."
                />

                <p style="font-size:16px; color:#A3A3A3; line-height:1.8; margin:0 0 20px;">
                    Coach Agam adalah pelatih kekuatan dan kondisi fisik bersertifikat internasional dengan pengalaman lebih dari 10 tahun dalam mengembangkan atlet berbagai cabang olahraga.
                </p>

                <p style="font-size:16px; color:#A3A3A3; line-height:1.8; margin:0 0 32px;">
                    Dengan metodologi AHP (Analytic Hierarchy Process), setiap program latihan dirancang secara ilmiah, personal, dan terukur — memastikan atlet mencapai puncak performa dengan aman dan efisien.
                </p>

                {{-- Expertise Points --}}
                <div style="display:flex; flex-direction:column; gap:14px; margin-bottom:36px;">
                    @foreach([
                        ['icon' => '🎯', 'text' => 'Strength & Conditioning — NSCA CSCS Certified'],
                        ['icon' => '📊', 'text' => 'Data-driven training dengan analitik performa'],
                        ['icon' => '🏅', 'text' => 'Membina lebih dari 200 atlet profesional'],
                        ['icon' => '🔬', 'text' => 'Penelitian performa atletik berbasis bukti ilmiah'],
                    ] as $point)
                        <div style="display:flex; align-items:flex-start; gap:12px;">
                            <span style="
                                width:36px; height:36px; border-radius:8px;
                                background:rgba(192,192,192,0.08);
                                border:1px solid rgba(192,192,192,0.18);
                                display:flex; align-items:center; justify-content:center;
                                font-size:16px; flex-shrink:0;
                            " aria-hidden="true">{{ $point['icon'] }}</span>
                            <span style="font-size:15px; color:#D3D3D3; line-height:1.5; padding-top:8px;">{{ $point['text'] }}</span>
                        </div>
                    @endforeach
                </div>

                <x-button href="{{ route('kontak') }}" variant="secondary" size="md">
                    Hubungi Coach Agam
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                </x-button>
            </div>
        </div>
    </div>
</section>

{{-- =========================================================
     SECTION 4: AHP TRAINING HIGHLIGHT
     ========================================================= --}}
<section
    id="ahp-training"
    aria-labelledby="ahp-title"
    style="
        padding: 96px 0;
        background: #0F0F0F;
        position: relative;
        overflow: hidden;
    "
>
    {{-- Background accent --}}
    <div aria-hidden="true" style="
        position:absolute; inset:0;
        background: radial-gradient(ellipse 80% 50% at 50% 50%, rgba(192,192,192,0.03) 0%, transparent 70%);
        pointer-events:none;
    "></div>

    <div style="max-width:1140px; margin:0 auto; padding:0 24px; position:relative; z-index:1;">

        <div style="text-align:center; margin-bottom:64px;" class="fade-in">
            <span class="section-label" style="justify-content:center;">Sistem Pelatihan</span>
            <h2 id="ahp-title" style="
                font-size:clamp(28px,4vw,44px); font-weight:700; color:#FFFFFF;
                margin:0 0 16px; letter-spacing:-0.02em; line-height:1.2;
            ">
                The <span style="
                    background: linear-gradient(135deg, #F0F0F0, #C0C0C0, #A8A8A8);
                    -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
                ">AHP Training</span> System
            </h2>
            <p style="font-size:17px; color:#A3A3A3; max-width:540px; margin:0 auto; line-height:1.7;">
                Proses terstruktur 4 tahap yang memastikan setiap atlet mendapatkan program latihan paling optimal dan personal.
            </p>
        </div>

        {{-- Process Cards --}}
        <div style="
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:20px;
            margin-bottom:56px;
        " class="ahp-grid" role="list">

            @foreach([
                [
                    'step'  => 'Step 01',
                    'icon'  => '🔍',
                    'title' => 'Pre-Test Assessment',
                    'desc'  => 'Evaluasi menyeluruh kondisi fisik awal atlet — kekuatan, kecepatan, ketahanan, fleksibilitas.',
                    'color' => '#F0F0F0',
                ],
                [
                    'step'  => 'Step 02',
                    'icon'  => '📋',
                    'title' => 'Program Volume & Intensitas',
                    'desc'  => 'Desain program latihan berdasarkan hasil AHP — volume, intensitas, dan periodisasi yang optimal.',
                    'color' => '#D3D3D3',
                ],
                [
                    'step'  => 'Step 03',
                    'icon'  => '⚡',
                    'title' => 'Monitoring & Evaluasi',
                    'desc'  => 'Pemantauan harian beban latihan, RPE, recovery, dan penyesuaian program secara real-time.',
                    'color' => '#C0C0C0',
                ],
                [
                    'step'  => 'Step 04',
                    'icon'  => '🏆',
                    'title' => 'Post-Test & Laporan',
                    'desc'  => 'Tes akhir dan analisis komprehensif — seberapa jauh atlet berkembang dengan laporan visual.',
                    'color' => '#A8A8A8',
                ],
            ] as $i => $step)
                <div
                    class="process-card fade-in fade-in-delay-{{ $i + 1 }}"
                    role="listitem"
                >
                    {{-- Connector line (not last) --}}
                    @if(!$loop->last)
                        <div style="
                            position:absolute;
                            top:40px; right:-20px;
                            width:20px; height:2px;
                            background: linear-gradient(90deg, rgba(192,192,192,0.4), transparent);
                            z-index:2;
                        " aria-hidden="true"></div>
                    @endif

                    <div class="process-step-number">{{ $step['step'] }}</div>

                    <div style="
                        width:52px; height:52px; border-radius:14px;
                        background: linear-gradient(135deg, rgba(240,240,240,0.12), rgba(192,192,192,0.06));
                        border: 1px solid rgba(192,192,192,0.25);
                        display:flex; align-items:center; justify-content:center;
                        font-size:24px;
                        margin-bottom:16px;
                    " aria-hidden="true">{{ $step['icon'] }}</div>

                    <h3 style="font-size:16px; font-weight:700; color:#FFFFFF; margin:0 0 10px; line-height:1.3;">
                        {{ $step['title'] }}
                    </h3>

                    <p style="font-size:13px; color:#A3A3A3; line-height:1.65; margin:0;">
                        {{ $step['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>

        {{-- CTA --}}
        <div style="text-align:center;" class="fade-in">
            <x-button href="#" variant="primary" size="lg" id="access-report-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                Akses Laporan Anda
            </x-button>
            <p style="font-size:13px; color:#6B7280; margin-top:14px;">
                Sudah memiliki akun? <a href="/login" style="color:#C0C0C0; font-weight:600; text-decoration:none;" onmouseover="this.style.color='#F0F0F0'" onmouseout="this.style.color='#C0C0C0'">Masuk ke Dashboard →</a>
            </p>
        </div>
    </div>
</section>

{{-- =========================================================
     SECTION 5: BLOG PREVIEW
     ========================================================= --}}
<section
    id="blog"
    aria-labelledby="blog-title"
    style="padding:96px 0; background:#0F0F0F; border-top:1px solid rgba(176,176,176,0.1);"
>
    <div style="max-width:1140px; margin:0 auto; padding:0 24px;">

        <div style="display:flex; align-items:flex-end; justify-content:space-between; margin-bottom:48px; flex-wrap:wrap; gap:20px;" class="fade-in">
            <div>
                <span class="section-label" style="font-family:'Montserrat',sans-serif;">Artikel & Tips</span>
                <h2 id="blog-title" style="font-size:clamp(26px,3.5vw,40px); font-weight:700; color:#FFFFFF; margin:0; letter-spacing:-0.02em; font-family:'Montserrat',sans-serif;">
                    Blog Coach Agam
                </h2>
            </div>
            <a href="/blog" style="
                font-size:14px; font-weight:600; color:#C0C0C0; text-decoration:none;
                display:flex; align-items:center; gap:6px;
                transition: color 150ms ease-out;
                font-family:'Montserrat',sans-serif;
            "
            onmouseover="this.style.color='#F0F0F0'"
            onmouseout="this.style.color='#C0C0C0'"
            >
                Lihat Semua Artikel
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>

        <div style="
            display:grid;
            grid-template-columns:repeat(3,1fr);
            gap:24px;
        " class="blog-grid">

            @php
                $defaultBlogs = [
                    [
                        'title'    => 'Panduan Lengkap RPE untuk Atlet Pemula',
                        'excerpt'  => 'Rating of Perceived Exertion (RPE) adalah alat monitoring intensitas latihan yang sederhana namun sangat efektif. Pelajari cara menggunakannya dengan benar.',
                        'category' => 'Training Tips',
                        'date'     => now()->subDays(3)->format('d M Y'),
                        'readTime' => '5 min baca',
                        'slug'     => 'panduan-rpe-atlet-pemula',
                        'image'    => null,
                    ],
                    [
                        'title'    => 'Periodisasi Latihan: Kunci Program yang Efektif',
                        'excerpt'  => 'Periodisasi adalah strategi perencanaan latihan jangka panjang yang memastikan atlet mencapai puncak performa pada waktu yang tepat.',
                        'category' => 'Program Design',
                        'date'     => now()->subDays(7)->format('d M Y'),
                        'readTime' => '8 min baca',
                        'slug'     => 'periodisasi-latihan-efektif',
                        'image'    => null,
                    ],
                    [
                        'title'    => 'Nutrisi Olahraga: Apa yang Harus Dimakan Sebelum Latihan?',
                        'excerpt'  => 'Nutrisi pra-latihan yang tepat dapat meningkatkan performa dan mempercepat pemulihan. Temukan panduan lengkap makanan terbaik untuk atlet.',
                        'category' => 'Nutrisi',
                        'date'     => now()->subDays(12)->format('d M Y'),
                        'readTime' => '6 min baca',
                        'slug'     => 'nutrisi-pra-latihan-atlet',
                        'image'    => null,
                    ],
                ];
            @endphp

            @foreach(isset($blogs) && $blogs->count() > 0 ? $blogs : collect($defaultBlogs) as $post)
                <div class="fade-in fade-in-delay-{{ $loop->index + 1 }}">
                    <x-blog-card
                        :title="is_array($post) ? $post['title'] : $post->title"
                        :excerpt="is_array($post) ? $post['excerpt'] : $post->excerpt"
                        :category="is_array($post) ? $post['category'] : $post->category"
                        :date="is_array($post) ? $post['date'] : $post->published_at"
                        :image="is_array($post) ? $post['image'] : $post->featured_image"
                        :slug="is_array($post) ? $post['slug'] : $post->slug"
                        :readTime="is_array($post) ? $post['readTime'] : null"
                    />
                </div>
            @endforeach
        </div>
    </div>
</section>



<style>
    /* Responsive Grids */
    @media (max-width: 1024px) {
        .ahp-grid { grid-template-columns: repeat(2, 1fr) !important; }
    }
    @media (max-width: 768px) {
        .hero-grid { grid-template-columns: 1fr !important; gap: 48px !important; }
        .about-grid { grid-template-columns: 1fr !important; gap: 40px !important; }
        .features-grid { grid-template-columns: 1fr !important; }
        .blog-grid { grid-template-columns: 1fr !important; }
        .ahp-grid { grid-template-columns: 1fr 1fr !important; }
    }
    @media (max-width: 480px) {
        .ahp-grid { grid-template-columns: 1fr !important; }
        .hero-image-col { display: none; }
    }
</style>

@endsection
