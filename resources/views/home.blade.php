@extends('layouts.app')

@section('title', 'Coach Agam — Pelatih Sepakbola Profesional Indonesia | coachagam.com')
@section('meta_description', 'Coach Agam adalah pelatih sepakbola profesional berpengalaman di Indonesia. Spesialis pengembangan pemain muda, analisis taktik modern, dan program latihan berbasis data ilmiah.')

@section('content')

@php
    $settings = \App\Models\SiteSetting::pluck('value', 'key')->toArray();
    $slides = json_decode($settings['homepage.hero_slides'] ?? '[]', true);
    
    // Fallback jika belum ada slide
    if (empty($slides)) {
        $slides = [
            [
                'headline'    => 'Pelatihan Sepakbola<br><b>Profesional & Berdedikasi</b>',
                'subheadline' => 'Kembangkan potensi terbaik Anda melalui pendekatan taktik modern dan latihan berbasis data ilmiah bersama Coach Agam.',
                'cta_text'    => 'Mulai Latihan',
                'cta_link'    => '/layanan',
                'image'       => null,
                'background'  => null,
            ]
        ];
    }
@endphp

<style>
@import url('https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600&display=swap');

.hero-bg-fallback {
    background: #FFFFFF !important;
    position: relative;
}
@media (max-width: 1024px) {
    .hero-main-layout {
        flex-direction: column !important;
        gap: 32px !important;
        min-height: auto !important;
    }
    .hero-center-visual {
        position: relative !important;
        left: auto !important;
        top: auto !important;
        transform: none !important;
        order: -1 !important;
        width: 100% !important;
        max-width: 320px !important;
        margin: 0 auto !important;
        margin-top: 10px !important;
    }
    .hero-shape-bg {
        width: 100% !important;
        height: auto !important;
        aspect-ratio: 1/1 !important;
        max-width: 320px !important;
        border-radius: 50% !important;
    }
    .hero-slide-image {
        max-height: 380px !important;
        object-position: bottom !important;
    }
    .hero-left-col, .hero-right-col {
        max-width: 100% !important;
        text-align: center !important;
        align-items: center !important;
    }
    .hero-left-col > div {
        justify-content: center !important;
    }
    .hero-right-col {
        margin-top: 24px !important;
    }
    .hero-right-col > div, .hero-right-col > div > img {
        justify-content: center !important;
        text-align: center !important;
    }
}

/* Super Premium Slow-Motion Animations */
@keyframes heroSlideDown {
    from { opacity: 0; transform: translateY(-30px); }
    to { opacity: 1; transform: translateY(0); }
}
@keyframes heroSlideUpCenter {
    from { opacity: 0; transform: translate(-50%, 0px) scale(0.95); }
    to { opacity: 1; transform: translate(-50%, -50%) scale(1); }
}
@keyframes heroSlideRight {
    from { opacity: 0; transform: translateX(-30px); }
    to { opacity: 1; transform: translateX(0); }
}
@keyframes heroSlideLeft {
    from { opacity: 0; transform: translateX(30px); }
    to { opacity: 1; transform: translateX(0); }
}

.hero-anim-top {
    animation: heroSlideDown 2.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}
.hero-anim-left {
    animation: heroSlideRight 2.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    animation-delay: 0.3s;
    opacity: 0;
}
.hero-anim-bottom {
    animation: heroSlideUpCenter 2.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    animation-delay: 0.5s;
    opacity: 0;
}
.hero-anim-right {
    animation: heroSlideLeft 2.5s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    animation-delay: 0.7s;
    opacity: 0;
}
</style>

<section 
    x-data="{ 
        activeSlide: 0, 
        totalSlides: {{ count($slides) }},
        next() { this.activeSlide = (this.activeSlide + 1) % this.totalSlides },
        prev() { this.activeSlide = (this.activeSlide - 1 + this.totalSlides) % this.totalSlides },
        init() {
            if(this.totalSlides > 1) {
                setInterval(() => { this.next() }, 7500);
            }
        }
    }"
    style="display: grid; min-height: calc(100vh - 102px); overflow: hidden; position: relative;"
>
    
    @foreach($slides as $index => $slide)
    @php
        $hasBg = !empty($slide['background']);
        $bgStyle = $hasBg 
            ? "background-image: url('".asset('storage/'.$slide['background'])."'); background-size: cover; background-position: center;" 
            : "";
    @endphp
    
    <div 
        class="{{ !$hasBg ? 'hero-bg-fallback' : '' }}"
        x-show="activeSlide === {{ $index }}"
        x-transition:enter="transition ease-in-out duration-700"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-700"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        style="grid-area: 1 / 1; width: 100%; display: flex; align-items: center; {{ $bgStyle }};"
    >
        @if(!empty($slide['background']))
        <div style="position:absolute; top:0; left:0; right:0; bottom:0; background:linear-gradient(90deg, rgba(255,255,255,0.82) 0%, rgba(255,255,255,0.5) 50%, rgba(255,255,255,0.05) 100%); z-index:0;"></div>
        @endif

        <div style="max-width:1080px; margin:0 auto; padding:80px 24px 60px; position:relative; z-index:2; width:100%; display:flex; flex-direction:column; align-items:center;">
            
            {{-- TOP: Centered Headline --}}
            <div class="hero-anim-top" style="text-align:center; margin-bottom:40px; z-index:20; width:100%;">
                <h1 style="font-family: 'Oswald', sans-serif; font-size:clamp(28px, 3.5vw, 42px); font-weight:300; font-stretch:condensed; text-transform:uppercase; color:#1A1A1A; line-height:1.2; margin:0; letter-spacing:-0.5px;">
                    {!! $slide['headline'] ?? '' !!}
                </h1>
            </div>

            {{-- MIDDLE: Layout Container --}}
            <div class="hero-main-layout" style="display:flex; justify-content:space-between; align-items:center; width:100%; position:relative; min-height:480px;">
                
                {{-- LEFT: Subheadline & CTAs --}}
                <div class="hero-left-col hero-anim-left" style="flex:1; max-width:320px; z-index:10; display:flex; flex-direction:column;">
                    <p style="font-size:1rem; font-weight:400; color:#4B5563; line-height:1.7; margin:0 0 24px;">
                        {{ $slide['subheadline'] ?? '' }}
                    </p>
                    <div style="display:flex; gap:12px; flex-wrap:wrap;">
                        @if(!empty($slide['cta_text']))
                        <a href="{{ $slide['cta_link'] ?? '#' }}" 
                           style="display:inline-flex;align-items:center;justify-content:center;background:#1A1A1A;color:#FFFFFF;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:13px 30px;border-radius:0;text-decoration:none;border:1px solid #1A1A1A;transition:all 200ms;"
                           onmouseover="this.style.background='#333333';this.style.borderColor='#333333';"
                           onmouseout="this.style.background='#1A1A1A';this.style.borderColor='#1A1A1A';">
                            {{ $slide['cta_text'] }}
                        </a>
                        @endif
                        <a href="{{ route('kontak') }}" 
                           style="display:inline-flex;align-items:center;justify-content:center;background:transparent;color:#6B7280;font-size:11px;font-weight:600;letter-spacing:2px;text-transform:uppercase;padding:13px 30px;border-radius:0;text-decoration:none;border:1px solid #D1D5DB;transition:all 200ms;"
                           onmouseover="this.style.borderColor='#1A1A1A';this.style.color='#1A1A1A';"
                           onmouseout="this.style.borderColor='#D1D5DB';this.style.color='#6B7280';">
                            Hubungi Kami
                        </a>
                    </div>
                </div>

                {{-- CENTER: Image --}}
                <div class="hero-center-visual hero-anim-bottom" style="position:absolute; left:50%; top:50%; transform:translate(-50%, -50%); z-index:1; width:100%; max-width:500px; display:flex; justify-content:center; align-items:center; pointer-events:none;">
                    {{-- Solid Light Gray Circle Background like Image 1 --}}
                    <div class="hero-shape-bg" style="position:absolute; width:520px; height:520px; background:linear-gradient(135deg, {{ $settings['homepage.hero_shape_color1'] ?? '#F4F4F5' }}, {{ $settings['homepage.hero_shape_color2'] ?? '#E5E7EB' }}); border-radius:50%; z-index:-1; left:50%; top:50%; transform:translate(-50%, -48%);"></div>
                    
                    @if(!empty($slide['image']))
                        <img src="{{ asset('storage/'.$slide['image']) }}" 
                             alt="Hero Slide" 
                             class="hero-slide-image"
                             style="width:100%; height:auto; display:block; object-fit:contain; max-height:580px; position:relative; z-index:2; pointer-events:auto;">
                    @endif
                </div>

                {{-- RIGHT: Trusted Section & Extras --}}
                <div class="hero-right-col hero-anim-right" style="flex:1; max-width:320px; z-index:10; display:flex; flex-direction:column; align-items:flex-end; text-align:right;">
                    
                    {{-- 5 Stars (Like Image 1) --}}
                    <div style="color:{{ $settings['homepage.hero_star_color'] ?? '#84cc16' }}; font-size:20px; margin-bottom:8px; letter-spacing:4px; display:flex; gap:4px;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    </div>

                    {{-- Trusted Section as the right side text --}}
                    @php
                        $hasTrustedImage = !empty($slide['trusted_image_1']) || !empty($slide['trusted_image_2']) || !empty($slide['trusted_image_3']);
                        $trustedText = $slide['trusted_text'] ?? '10 Years Experience';
                        $trustedParts = explode(' ', $trustedText, 2);
                        $trustedBig = $trustedParts[0] ?? '10';
                        $trustedSmall = $trustedParts[1] ?? 'Years Experience';
                    @endphp
                    
                    <div style="font-size:36px;font-weight:600;color:#1A1A1A;margin-bottom:2px;font-family: 'Oswald', sans-serif;">
                        {{ $trustedBig }}
                    </div>
                    <div style="font-size:13px;color:#6B7280; margin-bottom: 24px; max-width: 140px; text-align:right;">
                        {{ $trustedSmall }}
                    </div>

                    @if($hasTrustedImage)
                        <div style="display:flex; align-items:center; justify-content:flex-end;">
                            @if(!empty($slide['trusted_image_1']))
                                <img src="{{ asset('storage/'.$slide['trusted_image_1']) }}" alt="Client 1" style="width:36px; height:36px; border-radius:50%; object-fit:cover; border:2px solid #FFFFFF; box-shadow:0 2px 4px rgba(0,0,0,0.1); position:relative; z-index:3;">
                            @endif
                            @if(!empty($slide['trusted_image_2']))
                                <img src="{{ asset('storage/'.$slide['trusted_image_2']) }}" alt="Client 2" style="width:36px; height:36px; border-radius:50%; object-fit:cover; border:2px solid #FFFFFF; box-shadow:0 2px 4px rgba(0,0,0,0.1); margin-left:-12px; position:relative; z-index:2;">
                            @endif
                            @if(!empty($slide['trusted_image_3']))
                                <img src="{{ asset('storage/'.$slide['trusted_image_3']) }}" alt="Client 3" style="width:36px; height:36px; border-radius:50%; object-fit:cover; border:2px solid #FFFFFF; box-shadow:0 2px 4px rgba(0,0,0,0.1); margin-left:-12px; position:relative; z-index:1;">
                            @endif
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{-- Slider Controls — hanya tampil jika lebih dari 1 slide --}}
    @if(count($slides) > 1)
    <div class="hero-slider-controls" style="position:absolute; bottom:40px; right:48px; z-index:10; display:flex; gap:0; align-items:center;">
        <button @click="prev()" aria-label="Previous Slide" 
                style="width:44px;height:44px;display:flex;align-items:center;justify-content:center;background:#FFFFFF;border:1px solid #D1D5DB;border-right:none;cursor:pointer;color:#1A1A1A;transition:all 150ms;"
                onmouseover="this.style.background='#C0C0C0';this.style.borderColor='#C0C0C0';"
                onmouseout="this.style.background='#FFFFFF';this.style.borderColor='#D1D5DB';">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        {{-- Slide counter --}}
        <div style="height:44px;padding:0 16px;display:flex;align-items:center;background:#FFFFFF;border:1px solid #D1D5DB;border-right:none;">
            <span style="font-size:11px;font-weight:700;letter-spacing:2px;color:#1A1A1A;" x-text="(activeSlide+1) + ' / ' + totalSlides"></span>
        </div>
        <button @click="next()" aria-label="Next Slide" 
                style="width:44px;height:44px;display:flex;align-items:center;justify-content:center;background:#1A1A1A;border:1px solid #1A1A1A;cursor:pointer;color:#FFFFFF;transition:all 150ms;"
                onmouseover="this.style.background='#C0C0C0';this.style.borderColor='#C0C0C0';this.style.color='#1A1A1A';"
                onmouseout="this.style.background='#1A1A1A';this.style.borderColor='#1A1A1A';this.style.color='#FFFFFF';">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>
    </div>
    @endif
</section>

<style>
@media(max-width: 768px) {
    .hero-slider-controls { display: none !important; }
}
</style>

<style>
/* ── LUXURY SCROLL ANIMATION SYSTEM ────────────────────────────── */
.lx-hidden {
    opacity: 0;
}
.lx-fade-up    { transform: translateY(40px); }
.lx-fade-left  { transform: translateX(-40px); }
.lx-fade-right { transform: translateX(40px); }
.lx-fade-down  { transform: translateY(-40px); }
.lx-scale      { transform: scale(0.94); }

/* When visible — transition is applied only here for safety */
.lx-visible {
    opacity: 1 !important;
    transform: none !important;
}
</style>

<script>
(function() {
    const DURATIONS = [2500, 2500, 2500, 2500, 2500];
    const DELAYS    = [0, 200, 400, 600, 800];

    const easing = 'cubic-bezier(0.16, 1, 0.3, 1)';

    function applyTransition(el, delay) {
        el.style.transition = `opacity 2.5s ${easing} ${delay}ms, transform 2.5s ${easing} ${delay}ms`;
    }

    const io = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                var el = entry.target;
                var delay = parseInt(el.dataset.lxDelay || 0, 10);
                applyTransition(el, delay);
                // Small rAF to ensure transition is applied before class
                requestAnimationFrame(function() {
                    requestAnimationFrame(function() {
                        el.classList.add('lx-visible');
                    });
                });
                io.unobserve(el);
            }
        });
    }, { threshold: 0.12, rootMargin: '0px 0px -60px 0px' });

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.lx-hidden').forEach(function(el) {
            io.observe(el);
        });
    });
})();
</script>


{{-- ── SECTION PROFIL COACH AGAM ────────────────────────────────────────── --}}
@php
    $profileSettings = \App\Models\SiteSetting::where('group', 'page_profile')->get()->keyBy('key');
@endphp
<x-profile-section :settings="$profileSettings" />

{{-- ── SECTION GALLERY (HOMEPAGE) ────────────────────────────────────────── --}}
@php
    $gallerySettings = \App\Models\SiteSetting::where('group', 'page_gallery')->get()->keyBy('key');
    $galleryItems = json_decode($gallerySettings['page_gallery.items']->value ?? '[]', true) ?? [];

    // Dummy data untuk visual yang mirip referensi (gambar fashion/lifestyle)
    $dummyGallery = [
        ['image' => null, 'caption' => ''],
        ['image' => null, 'caption' => ''],
        ['image' => null, 'caption' => ''],
        ['image' => null, 'caption' => ''],
        ['image' => null, 'caption' => ''],
    ];

    $displayItems = count($galleryItems) > 0 ? array_reverse($galleryItems) : $dummyGallery;
@endphp

<section id="gallery" style="background:#0F0F0F; padding:80px 0; overflow:hidden; color:#FFFFFF; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">

    {{-- Top Header --}}
    <div class="lx-hidden lx-fade-up" data-lx-delay="0" style="text-align:center; margin-bottom:60px; padding:0 20px;">
        <div style="margin-bottom:24px;">
            <span style="display:inline-block; font-size:11px; font-weight:800; letter-spacing:4px; text-transform:uppercase; color:#9CA3AF; border-top:2px solid rgba(255,255,255,0.2); border-bottom:2px solid rgba(255,255,255,0.2); padding:6px 20px;">
                {{ $gallerySettings['page_gallery.subheadline']->value ?? 'DOKUMENTASI' }}
            </span>
        </div>
        <h2 style="font-size:clamp(2rem, 3.5vw, 3.5rem); font-weight:300; letter-spacing:-1px; line-height:1.05; color:#FFFFFF; margin:0;">
            {{ $gallerySettings['page_gallery.headline']->value ?? 'Galeri Foto' }}
        </h2>
    </div>

    {{-- Draggable Carousel --}}
    <div id="gl-wrap" class="lx-hidden lx-fade-up hide-scroll" data-lx-delay="300" style="width:100%; overflow-x:auto; overflow-y:hidden; cursor:grab; padding:20px 0; -webkit-overflow-scrolling:touch; display:flex;">
        <div id="gl-track" style="display:flex; gap:24px; padding:0 24px; margin:0 auto; width:max-content; align-items:center;">
            
            @foreach($displayItems as $index => $item)
            <div class="gl-card" 
                 @if(!empty($item['image']))
                     @click="$dispatch('open-lightbox', { src: '{{ asset('storage/'.$item['image']) }}', caption: '{{ addslashes($item['caption'] ?? '') }}' })"
                     style="width:280px; height:360px; background:#1A1A1A; flex-shrink:0; overflow:hidden; position:relative; transform-origin:center; transition:transform 0.4s ease; cursor:pointer;"
                 @else
                     style="width:280px; height:360px; background:#1A1A1A; flex-shrink:0; overflow:hidden; position:relative; transform-origin:center; transition:transform 0.4s ease;"
                 @endif
                 >
                @if(!empty($item['image']))
                <img src="{{ asset('storage/'.$item['image']) }}" style="width:100%; height:100%; object-fit:cover; pointer-events:none; user-select:none; display:block;">
                @else
                <div style="width:100%; height:100%; background:#1A1A1A; display:flex; align-items:center; justify-content:center; pointer-events:none; user-select:none;">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#444" stroke-width="1"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
                @endif
                
                {{-- Text Overlay --}}
                @if(!empty($item['caption']))
                <div style="position:absolute; bottom:0; left:0; right:0; padding:40px 24px 24px; background:linear-gradient(to top, rgba(0,0,0,0.8), transparent); pointer-events:none;">
                    <h3 style="color:#FFF; font-size:16px; font-weight:600; margin:0; line-height:1.3; letter-spacing:-0.2px;">{{ $item['caption'] }}</h3>
                </div>
                @endif
            </div>
            @endforeach

        </div>
    </div>

</section>

<style>
.hide-scroll::-webkit-scrollbar { display: none; }
.hide-scroll { -ms-overflow-style: none; scrollbar-width: none; }
#gl-wrap.is-dragging { cursor: grabbing !important; }
#gl-wrap.is-dragging .gl-card { transform: scale(0.98); }

@media (max-width: 768px) {
    .gl-card { width: 75vw !important; height: 100vw !important; min-width: 0 !important; }
    #gl-track { padding: 0 12vw !important; gap: 4vw !important; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.getElementById('gl-wrap');
    let isDown = false;
    let startX;
    let scrollLeft;
    let velX = 0;
    let momentumID;

    // Desktop Mouse Drag
    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('is-dragging');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
        cancelAnimationFrame(momentumID);
    });

    slider.addEventListener('mouseleave', () => {
        if(!isDown) return;
        isDown = false;
        slider.classList.remove('is-dragging');
        beginMomentum();
    });

    slider.addEventListener('mouseup', () => {
        if(!isDown) return;
        isDown = false;
        slider.classList.remove('is-dragging');
        beginMomentum();
    });

    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 1.5; // Drag speed
        const prevScrollLeft = slider.scrollLeft;
        slider.scrollLeft = scrollLeft - walk;
        velX = slider.scrollLeft - prevScrollLeft;
    });

    // Touch events for mobile (let native scroll handle it, but we can capture velocity for fun, though native momentum is better)
    // We will rely on -webkit-overflow-scrolling: touch for mobile, it's much smoother natively.

    function beginMomentum() {
        momentumID = requestAnimationFrame(momentumLoop);
    }

    function momentumLoop() {
        if(Math.abs(velX) > 0.5) {
            slider.scrollLeft += velX;
            velX *= 0.92; // Friction
            momentumID = requestAnimationFrame(momentumLoop);
        }
    }
});
</script>




<style>
.hero-headline b, .hero-headline strong {
    font-weight: 800;
}
@media(max-width: 900px) {
    .hero-grid {
        grid-template-columns: 1fr !important;
        text-align: center;
        gap: 40px !important;
    }
    .hero-grid > div:last-child {
        justify-content: center !important;
    }
    .hero-grid h1 {
        font-size: 2.25rem !important;
    }
    .hero-grid > div:first-child > p {
        max-width: 100% !important;
        margin-left: auto;
        margin-right: auto;
    }
    .hero-grid > div:first-child > div {
        justify-content: center;
    }
}
</style>

{{-- ── SECTION LATEST BLOG ────────────────────────────────────────── --}}
@php
    $latestPosts = \App\Models\Post::published()->orderBy('published_at', 'desc')->take(3)->get();
@endphp

@if($latestPosts->count() > 0)
<section id="latest-blog" style="background:#FFFFFF; padding:100px 0; border-top:1px solid #E5E7EB; color:#000; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;">
    <div style="max-width:1140px; margin:0 auto; padding:0 40px;">
        
        {{-- Top Header --}}
        <div class="lx-hidden lx-fade-up" data-lx-delay="0" style="text-align:center; margin-bottom:60px;">
            <div style="margin-bottom:24px;">
                <span style="display:inline-block; font-size:11px; font-weight:800; letter-spacing:4px; text-transform:uppercase; color:#6B7280; border-top:2px solid #1A1A1A; border-bottom:2px solid #1A1A1A; padding:6px 20px;">
                    BLOG & ARTIKEL
                </span>
            </div>
            <h2 style="font-size:clamp(2rem, 3.5vw, 3.5rem); font-weight:300; letter-spacing:-1px; line-height:1.05; color:#111827; margin:0;">
                Wawasan Terbaru
            </h2>
        </div>

        {{-- Grid (Swipeable on Mobile) --}}
        <style>
            .home-blog-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                gap: 32px;
            }
            @media (max-width: 768px) {
                .home-blog-grid {
                    display: flex;
                    flex-wrap: nowrap;
                    overflow-x: auto;
                    overflow-y: hidden;
                    -webkit-overflow-scrolling: touch;
                    gap: 16px;
                    padding-bottom: 24px; /* for scrollbar spacing */
                    margin-left: -40px; /* pull out of container padding */
                    margin-right: -40px;
                    padding-left: 40px;
                    padding-right: 40px;
                    scroll-snap-type: x mandatory;
                }
                .home-blog-grid::-webkit-scrollbar {
                    display: none;
                }
                .home-blog-grid {
                    -ms-overflow-style: none;
                    scrollbar-width: none;
                }
                .home-blog-grid > div {
                    flex: 0 0 85%;
                    scroll-snap-align: center;
                }
            }
            @media (max-width: 480px) {
                .home-blog-grid {
                    margin-left: -20px;
                    margin-right: -20px;
                    padding-left: 20px;
                    padding-right: 20px;
                }
            }
        </style>
        <div class="home-blog-grid lx-hidden lx-fade-up" data-lx-delay="250">
            @foreach($latestPosts as $post)
                <div style="height:100%;">
                    <x-blog-card :post="$post" />
                </div>
            @endforeach
        </div>

        {{-- View All --}}
        <div class="lx-hidden lx-fade-up" data-lx-delay="500" style="text-align:center; margin-top:40px;">
            <a href="{{ route('blog.index') }}" 
               style="display:inline-flex; align-items:center; gap:12px; font-size:12px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:#1A1A1A; border-bottom:2px solid #1A1A1A; padding-bottom:4px; text-decoration:none; transition:all 300ms;"
               onmouseover="this.style.opacity='0.6'"
               onmouseout="this.style.opacity='1'">
                Lihat Semua Artikel
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </a>
        </div>
        
    </div>
</section>
@endif

<x-cta-kerjasama />

@endsection
