@props([
    'slides' => [],
])

@php
$defaultSlides = [
    [
        'tagline'    => '⚽ Pelatih Sepakbola Profesional',
        'title'      => 'Kembangkan Bakat\nSepakbola Anda',
        'subtitle'   => 'Program latihan terstruktur berbasis ilmu olahraga modern untuk mengoptimalkan potensi setiap pemain dari semua level.',
        'cta_label'  => 'Mulai Latihan',
        'cta_href'   => '/#kerjasama',
        'cta2_label' => 'Pelajari Metode',
        'cta2_href'  => '/#tentang',
        'bg_color'   => 'radial-gradient(ellipse 80% 60% at 30% 50%, rgba(192,192,192,0.07) 0%, transparent 70%)',
        'image_icon' => '🏟️',
        'image_text' => 'Lapangan Latihan Profesional',
    ],
    [
        'tagline'    => '🏆 Spesialis Pengembangan Pemain Muda',
        'title'      => 'Cetak Generasi\nPesepakbola Unggul',
        'subtitle'   => 'Metodologi pengembangan pemain muda usia 8–18 tahun yang telah terbukti menghasilkan atlet berprestasi nasional.',
        'cta_label'  => 'Program Usia Dini',
        'cta_href'   => '/layanan',
        'cta2_label' => 'Lihat Galeri',
        'cta2_href'  => '/#galeri',
        'bg_color'   => 'radial-gradient(ellipse 80% 60% at 70% 50%, rgba(168,168,168,0.06) 0%, transparent 70%)',
        'image_icon' => '👦',
        'image_text' => 'Pembinaan Pemain Muda Berbakat',
    ],
    [
        'tagline'    => '📊 Analisis Taktik Berbasis Data',
        'title'      => 'Strategi Cerdas,\nKemenangan Pasti',
        'subtitle'   => 'Analisis video mendalam, perencanaan taktik tim, dan sesi debriefing interaktif untuk meningkatkan performa kolektif.',
        'cta_label'  => 'Konsultasi Taktik',
        'cta_href'   => '/#kerjasama',
        'cta2_label' => 'Baca Blog',
        'cta2_href'  => '/blog',
        'bg_color'   => 'radial-gradient(ellipse 80% 60% at 20% 60%, rgba(211,211,211,0.05) 0%, transparent 70%)',
        'image_icon' => '📊',
        'image_text' => 'Analisis Data dan Taktik Pertandingan',
    ],
    [
        'tagline'    => '💪 Strength & Conditioning',
        'title'      => 'Fisik Prima,\nPerforma Maksimal',
        'subtitle'   => 'Program kebugaran fisik khusus pemain sepakbola — kecepatan, kekuatan, ketahanan, dan pencegahan cedera.',
        'cta_label'  => 'Program Fisik',
        'cta_href'   => '/layanan',
        'cta2_label' => 'Hubungi Kami',
        'cta2_href'  => '/kontak',
        'bg_color'   => 'radial-gradient(ellipse 80% 60% at 80% 30%, rgba(192,192,192,0.06) 0%, transparent 70%)',
        'image_icon' => '⚡',
        'image_text' => 'Program Fisik dan Kondisi Atlet',
    ],
    [
        'tagline'    => '🌐 Tersedia Online & Offline',
        'title'      => 'Latih Bersama Coach\ndi Mana Saja',
        'subtitle'   => 'Sesi pelatihan langsung maupun virtual. Program online personal dengan feedback video dan laporan progres mingguan.',
        'cta_label'  => 'Daftar Sekarang',
        'cta_href'   => '/register',
        'cta2_label' => 'Tanya via WhatsApp',
        'cta2_href'  => 'https://wa.me/6281234567890',
        'bg_color'   => 'radial-gradient(ellipse 80% 60% at 50% 70%, rgba(176,176,176,0.06) 0%, transparent 70%)',
        'image_icon' => '💻',
        'image_text' => 'Pelatihan Online dan Offline Fleksibel',
    ],
];

$slides = count($slides) ? $slides : $defaultSlides;
$slideCount = count($slides);
@endphp

<section
    id="hero"
    aria-label="Hero — Slider Utama Coach Agam"
    x-data="{
        current: 0,
        total: {{ $slideCount }},
        autoPlay: null,
        startAutoPlay() {
            this.autoPlay = setInterval(() => { this.next(); }, 6000);
        },
        stopAutoPlay() {
            clearInterval(this.autoPlay);
        },
        next() {
            this.current = (this.current + 1) % this.total;
        },
        prev() {
            this.current = (this.current - 1 + this.total) % this.total;
        },
        goTo(i) {
            this.current = i;
            this.stopAutoPlay();
            this.startAutoPlay();
        }
    }"
    x-init="startAutoPlay()"
    style="
        position:relative;
        width:100%;
        min-height:100vh;
        background:#0F0F0F;
        overflow:hidden;
        display:flex;
        align-items:center;
        padding-top:64px;
    "
>
    <style>
        .hero-font-title {
            font-family: 'Organetto-Variable Thin Condensed', 'Oswald', 'Arial Narrow', sans-serif;
            font-weight: 300;
            font-stretch: condensed;
            text-transform: uppercase;
            font-size: clamp(40px, 6vw, 80px);
            color: #FFFFFF;
            line-height: 1.1;
            letter-spacing: 1px;
            margin: 0;
            white-space: pre-line;
        }
        .hero-main-layout {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            position: relative;
            min-height: 480px;
        }
        .hero-center-visual {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }

        /* ===== MOBILE HERO ===== */
        @media (max-width: 768px) {
            .hero-font-title {
                font-size: clamp(36px, 10vw, 56px);
                text-align: center;
            }
            .hero-main-layout {
                flex-direction: column;
                gap: 0;
                min-height: auto;
            }
            /* Sembunyikan elemen yang berantakan di mobile */
            .hero-center-visual,
            .hero-right-col {
                display: none !important;
            }
            .hero-left-col {
                max-width: 100% !important;
                text-align: center !important;
                align-items: center !important;
                width: 100%;
            }
            .hero-buttons {
                align-items: center !important;
                flex-direction: row !important;
                flex-wrap: wrap !important;
                justify-content: center !important;
            }
            .hero-tagline-mobile {
                display: flex !important;
            }
            .hero-subtitle {
                font-size: 14px !important;
                line-height: 1.65 !important;
                margin-bottom: 24px !important;
            }
        }
        @media (min-width: 769px) {
            .hero-tagline-mobile {
                display: none !important;
            }
        }
    </style>

    {{-- Background grid pattern --}}
    <div aria-hidden="true" style="position:absolute;inset:0;background-image:linear-gradient(rgba(176,176,176,0.025) 1px,transparent 1px),linear-gradient(90deg,rgba(176,176,176,0.025) 1px,transparent 1px);background-size:60px 60px;pointer-events:none;"></div>

    {{-- SLIDES --}}
    @foreach($slides as $i => $slide)
    <div
        x-show="current === {{ $i }}"
        x-transition:enter="transition-opacity ease-in-out duration-700"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in-out duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        style="position:{{ $i === 0 ? 'relative' : 'absolute' }};inset:0;display:flex;align-items:center;width:100%;min-height:100vh;padding-top:64px;"
        @if($i !== 0) aria-hidden="true" @endif
    >
        {{-- Slide background glow --}}
        <div aria-hidden="true" style="position:absolute;inset:0;background:{{ $slide['bg_color'] }};pointer-events:none;"></div>

        <div style="max-width:1140px;margin:0 auto;padding:40px 24px;width:100%;position:relative;z-index:1;display:flex;flex-direction:column;align-items:center;">
            
            {{-- Mobile-only tagline badge --}}
            <div class="hero-tagline-mobile" style="display:none; align-items:center; gap:8px; margin-bottom:16px;">
                <span style="display:inline-block; width:28px; height:1px; background:rgba(255,255,255,0.3);"></span>
                <span style="font-size:11px; font-weight:700; color:#9CA3AF; letter-spacing:2px; text-transform:uppercase;">
                    {{ strip_tags(trim(preg_replace('/^[^\s]+\s/', '', $slide['tagline']))) }}
                </span>
                <span style="display:inline-block; width:28px; height:1px; background:rgba(255,255,255,0.3);"></span>
            </div>

            {{-- TOP: Huge Centered Title --}}
            <div style="text-align:center;margin-bottom:32px;z-index:20;">
                @if($i === 0)
                    <h1 class="hero-font-title">{{ str_replace('\n', "\n", $slide['title']) }}</h1>
                @else
                    <p role="heading" aria-level="2" class="hero-font-title">{{ str_replace('\n', "\n", $slide['title']) }}</p>
                @endif
            </div>

            {{-- MIDDLE: Layout Container (Left Text, Center Image, Right Text) --}}
            <div class="hero-main-layout">
                
                {{-- LEFT: Subtitle & CTA --}}
                <div class="hero-left-col" style="flex:1;max-width:340px;z-index:10;display:flex;flex-direction:column;">
                    <p style="font-size:16px;color:#A3A3A3;line-height:1.75;margin:0 0 32px;" class="hero-subtitle">
                        {{ $slide['subtitle'] }}
                    </p>
                    <div style="display:flex;flex-direction:column;gap:14px;align-items:flex-start;" class="hero-buttons">
                        <a href="{{ $slide['cta_href'] }}" style="display:inline-flex;align-items:center;justify-content:center;background:transparent;color:#F0F0F0;font-size:13px;font-weight:600;padding:12px 32px;border-radius:9999px;text-decoration:none;border:1px solid rgba(255,255,255,0.2);text-transform:uppercase;letter-spacing:1px;transition:all 200ms;" onmouseover="this.style.background='#F0F0F0';this.style.color='#1A1A1A'" onmouseout="this.style.background='transparent';this.style.color='#F0F0F0'">
                            {{ $slide['cta_label'] }}
                        </a>
                        <a href="{{ $slide['cta2_href'] }}" style="display:inline-flex;align-items:center;justify-content:center;background:transparent;color:#A3A3A3;font-size:12px;font-weight:600;padding:12px 32px;border-radius:9999px;text-decoration:none;text-transform:uppercase;letter-spacing:1px;transition:all 200ms;" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#A3A3A3'">
                            {{ $slide['cta2_label'] }}
                        </a>
                    </div>
                </div>

                {{-- CENTER: Visual (Image placeholder) --}}
                <div class="hero-center-visual">
                    <div style="width:100%;max-width:380px;aspect-ratio:4/5;border-radius:190px 190px 0 0;background:linear-gradient(135deg,#1A1A1A,#262626);border:1px solid rgba(192,192,192,0.2);box-shadow:0 24px 80px rgba(0,0,0,0.7);display:flex;flex-direction:column;align-items:center;justify-content:center;position:relative;overflow:hidden;margin:0 auto;">
                        <div style="font-size:80px;line-height:1;margin-bottom:20px;" aria-hidden="true">{{ $slide['image_icon'] }}</div>
                        <div style="font-size:15px;font-weight:600;color:#D3D3D3;text-align:center;padding:0 24px;line-height:1.4;">
                            {{ $slide['image_text'] }}
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Extras (Tagline & Counter) --}}
                <div class="hero-right-col" style="flex:1;max-width:340px;z-index:10;display:flex;flex-direction:column;align-items:flex-end;text-align:right;">
                    {{-- 5 Stars (Like Image 1) --}}
                    <div style="color:#a5d848;font-size:24px;margin-bottom:12px;letter-spacing:4px;">
                        ★★★★★
                    </div>
                    <div style="font-size:24px;font-weight:700;color:#FFFFFF;margin-bottom:4px;text-transform:uppercase;font-family: 'Oswald', sans-serif;">
                        {{ explode(' ', $slide['tagline'])[1] ?? '10' }} {{ explode(' ', $slide['tagline'])[2] ?? 'Years' }}
                    </div>
                    <div style="font-size:14px;color:#A3A3A3;text-transform:uppercase;letter-spacing:1px;">
                        {{ implode(' ', array_slice(explode(' ', $slide['tagline']), 3)) ?: 'Experience' }}
                    </div>

                    {{-- Counter --}}
                    <div style="margin-top:64px;display:flex;align-items:center;gap:12px;" class="hero-counter-box">
                        <span style="font-size:13px;color:#6B7280;font-variant-numeric:tabular-nums;">
                            <span style="color:#D3D3D3;font-weight:700;" x-text="String(current+1).padStart(2,'0')">01</span>
                            / {{ str_pad($slideCount, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <div style="width:80px;height:2px;background:#262626;border-radius:2px;" aria-hidden="true">
                            <div style="height:100%;background:linear-gradient(90deg,#a5d848,#7eb326);border-radius:2px;transition:width 200ms;" :style="`width:${((current+1)/total)*100}%`"></div>
                        </div>
                    </div>
                </div>
                
            </div>
            
            {{-- Slide Indicator Dots --}}
            <div style="margin-top:60px;display:flex;gap:6px;z-index:20;" role="tablist" aria-label="Pilih slide">
                @for($d = 0; $d < $slideCount; $d++)
                <button
                    @click="goTo({{ $d }})"
                    :aria-selected="current === {{ $d }}"
                    role="tab"
                    :aria-label="'Slide ' + {{ $d + 1 }}"
                    style="border:none;cursor:pointer;border-radius:9999px;transition:all 200ms;padding:0;"
                    :style="current === {{ $d }} ? 'width:24px;height:6px;background:linear-gradient(90deg,#a5d848,#7eb326)' : 'width:6px;height:6px;background:#3F3F3F'"
                ></button>
                @endfor
            </div>

        </div>
    </div>
    @endforeach

    {{-- Navigation Arrows --}}
    <button
        @click="prev(); stopAutoPlay(); startAutoPlay()"
        aria-label="Slide sebelumnya"
        style="
            position:absolute;left:20px;top:50%;transform:translateY(-50%);z-index:10;
            width:44px;height:44px;border-radius:50%;
            background:rgba(26,26,26,0.8);backdrop-filter:blur(8px);
            border:1px solid rgba(176,176,176,0.25);
            color:#D3D3D3;cursor:pointer;display:flex;align-items:center;justify-content:center;
            transition:all 150ms;
        "
        onmouseover="this.style.borderColor='rgba(192,192,192,0.6)';this.style.color='#F0F0F0'"
        onmouseout="this.style.borderColor='rgba(176,176,176,0.25)';this.style.color='#D3D3D3'"
    >
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="15 18 9 12 15 6"/></svg>
    </button>

    <button
        @click="next(); stopAutoPlay(); startAutoPlay()"
        aria-label="Slide berikutnya"
        style="
            position:absolute;right:20px;top:50%;transform:translateY(-50%);z-index:10;
            width:44px;height:44px;border-radius:50%;
            background:rgba(26,26,26,0.8);backdrop-filter:blur(8px);
            border:1px solid rgba(176,176,176,0.25);
            color:#D3D3D3;cursor:pointer;display:flex;align-items:center;justify-content:center;
            transition:all 150ms;
        "
        onmouseover="this.style.borderColor='rgba(192,192,192,0.6)';this.style.color='#F0F0F0'"
        onmouseout="this.style.borderColor='rgba(176,176,176,0.25)';this.style.color='#D3D3D3'"
    >
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
    </button>

    {{-- Pause on hover --}}
    <div
        style="position:absolute;inset:0;z-index:5;pointer-events:none;"
        @mouseenter="stopAutoPlay()"
        @mouseleave="startAutoPlay()"
        style="pointer-events:auto;"
    ></div>

    {{-- Scroll Down Indicator --}}
    <a
        href="#tentang"
        aria-label="Gulir ke bagian tentang"
        style="
            position:absolute;bottom:32px;left:50%;transform:translateX(-50%);
            display:flex;flex-direction:column;align-items:center;gap:6px;
            color:#6B7280;text-decoration:none;font-size:11px;letter-spacing:0.08em;
            text-transform:uppercase;z-index:10;
            animation:bounce 2s ease-in-out infinite;
        "
    >
        Scroll
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><polyline points="6 9 12 15 18 9"/></svg>
    </a>
</section>

<style>
@keyframes bounce {
    0%, 100% { transform: translateX(-50%) translateY(0); }
    50%       { transform: translateX(-50%) translateY(6px); }
}
@media(max-width:768px) {
    .hero-inner-grid { grid-template-columns: 1fr !important; gap: 40px !important; }
    .hero-visual-col { display: none !important; }
}
</style>
