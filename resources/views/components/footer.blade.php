@php
    // Ambil data kontak dan logo dari SiteSetting
    $gs = \App\Models\SiteSetting::whereIn('key', [
        'general.logo',
        'general.whatsapp',
        'general.email',
        'general.address',
        'seo.meta_description'
    ])->pluck('value', 'key');

    $socials = json_decode(\App\Models\SiteSetting::where('key', 'page_profile.socials')->value('value') ?? '[]', true);

    $logo = $gs->get('general.logo');
    $whatsapp = $gs->get('general.whatsapp');
    $email = $gs->get('general.email');
    $address = $gs->get('general.address', 'Sidoarjo, Jawa Timur, Indonesia');
    $desc = $gs->get('seo.meta_description', 'Pelatih sepakbola profesional berdedikasi untuk mengembangkan potensi setiap pemain melalui pendekatan modern dan terpadu.');

    $footerSettings = \App\Models\SiteSetting::where('group', 'page_footer')->pluck('value', 'key');
    $navLinks = json_decode($footerSettings->get('page_footer.nav_links', '[]'), true) ?: [
        ['label' => 'Beranda', 'href' => '/'],
        ['label' => 'Tentang', 'href' => '/profil-coach-agam'],
        ['label' => 'Galeri', 'href' => '/gallery'],
        ['label' => 'AHP Training', 'href' => '/ahp-training'],
        ['label' => 'Blog', 'href' => '/blog'],
        ['label' => 'Kontak', 'href' => '/kontak'],
    ];
    $serviceLinks = json_decode($footerSettings->get('page_footer.service_links', '[]'), true) ?: [
        ['label' => 'Pelatihan Privat', 'href' => '#'],
        ['label' => 'Pelatihan Tim', 'href' => '#'],
        ['label' => 'Analisis Taktik', 'href' => '#'],
        ['label' => 'Pemateri Seminar', 'href' => '#'],
    ];
    $copyrightText = $footerSettings->get('page_footer.copyright', '&copy; ' . date('Y') . ' Coach Agam. All rights reserved.');
    $privacyLink = $footerSettings->get('page_footer.privacy_link', '#');
    $termsLink = $footerSettings->get('page_footer.terms_link', '#');

    // Format WhatsApp URL
    $waUrl = '';
    if ($whatsapp) {
        $waNum = preg_replace('/[^0-9]/', '', $whatsapp);
        if (str_starts_with($waNum, '0'))
            $waNum = '62' . substr($waNum, 1);
        $waUrl = "https://wa.me/" . $waNum;
    }

    // SVG Icons
    $socialIcons = [
        'instagram' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>',
        'youtube' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33 2.78 2.78 0 0 0 1.94 2C5.12 19.5 12 19.5 12 19.5s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.33 29 29 0 0 0-.46-5.33z"></path><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"></polygon></svg>',
        'linkedin' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>',
        'twitter' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>',
        'facebook' => '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>',
    ];
    $getIcon = function ($platform) use ($socialIcons) {
        $p = strtolower($platform);
        if (str_contains($p, 'ig') || str_contains($p, 'insta'))
            return $socialIcons['instagram'];
        if (str_contains($p, 'yt') || str_contains($p, 'you'))
            return $socialIcons['youtube'];
        if (str_contains($p, 'in') || str_contains($p, 'link'))
            return $socialIcons['linkedin'];
        if (str_contains($p, 'fb') || str_contains($p, 'face'))
            return $socialIcons['facebook'];
        if (str_contains($p, 'x') || str_contains($p, 'twit'))
            return $socialIcons['twitter'];
        return '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle></svg>';
    };
@endphp

<style>
    footer {
        font-family: 'Montserrat', sans-serif;
    }

    /* ── eyebrow (sama persis AHP) ── */
    .ft-eyebrow {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 28px;
    }

    .ft-eyebrow .ft-step-num {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #4B5563;
    }

    .ft-eyebrow .ft-step-line {
        width: 32px;
        height: 1px;
        background: rgba(255, 255, 255, 0.12);
    }

    .ft-eyebrow .ft-step-label {
        font-size: 10px;
        font-weight: 700;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: #4B5563;
    }

    /* headline mixed weight */
    .ft-headline {
        font-size: clamp(38px, 5vw, 72px);
        line-height: 1.0;
        letter-spacing: -2px;
        margin: 0 0 32px;
    }

    .ft-headline .hl-bold {
        font-weight: 900;
        color: #FFFFFF;
        display: block;
    }

    .ft-headline .hl-thin {
        font-weight: 300;
        font-style: italic;
        color: #4B5563;
        display: block;
    }

    .ft-wrap {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 40px;
        box-sizing: border-box;
    }

    @media(max-width:768px) {
        .ft-wrap {
            padding: 0 20px;
        }
    }

    /* column link hover */
    .ft-link {
        color: #4B5563;
        font-size: 13px;
        text-decoration: none;
        transition: color 150ms;
        display: block;
        padding: 5px 0;
        letter-spacing: 0.3px;
    }

    .ft-link:hover {
        color: #FFFFFF;
    }

    .ft-col-head {
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 3px;
        text-transform: uppercase;
        color: rgba(255, 255, 255, 0.25);
        margin: 0 0 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ft-col-head::after {
        content: '';
        flex: 1;
        height: 1px;
        background: rgba(255, 255, 255, 0.06);
    }

    /* social icon */
    .ft-social {
        width: 36px;
        height: 36px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #4B5563;
        text-decoration: none;
        transition: all 180ms;
    }

    .ft-social:hover {
        background: #FFFFFF;
        color: #0D0D0D;
        border-color: #FFFFFF;
    }

    /* watermark */
    .ft-watermark {
        position: absolute;
        right: 40px;
        bottom: 80px;
        font-size: 80px;
        font-weight: 900;
        letter-spacing: -3px;
        color: rgba(255, 255, 255, 0.018);
        pointer-events: none;
        user-select: none;
        line-height: 1;
        white-space: nowrap;
    }

    @media(max-width:768px) {
        .ft-watermark {
            font-size: 40px;
            right: 20px;
        }
    }

    @media(max-width:960px) {
        .ft-main-grid {
            grid-template-columns: 1fr 1fr !important;
        }
    }

    @media(max-width:576px) {
        .ft-main-grid {
            grid-template-columns: 1fr !important;
            gap: 40px !important;
        }
    }
</style>

<footer aria-label="Site footer"
    style="background-color:#0D0D0D; border-top:1px solid rgba(255,255,255,0.05); position:relative; overflow:hidden;">

    {{-- ── WATERMARK ──────────────────────────────────── --}}
    <div class="ft-watermark">HVM DIGITAL</div>

    {{-- ── HEADLINE BLOCK ──────────────────────────────── --}}
    <div style="border-bottom:1px solid rgba(255,255,255,0.05); padding:80px 0 64px;">
        <div class="ft-wrap"
            style="display:flex; align-items:flex-end; justify-content:space-between; flex-wrap:wrap; gap:40px;">

            {{-- Left: mixed headline --}}
            <div>
                <div class="ft-eyebrow">
                    <span class="ft-step-num">Coach Agam</span>
                    <span class="ft-step-line"></span>
                    <span class="ft-step-label">Pelatih Profesional</span>
                </div>
                <h2 class="ft-headline">
                    <span class="hl-bold">Tingkatkan</span>
                    <span class="hl-thin">Kualitas Bermainmu</span>
                </h2>
                <p style="font-size:14px; color:#4B5563; line-height:1.8; max-width:400px; margin:0;">
                    {{ \Illuminate\Support\Str::limit(strip_tags($desc), 110) }}
                </p>
            </div>

            {{-- Right: CTA --}}
            <div style="display:flex; flex-direction:column; align-items:flex-start; gap:16px;">
                <a href="{{ route('kontak') }}"
                    style="display:inline-flex; align-items:center; gap:14px; background:#FFFFFF; color:#0D0D0D; padding:16px 28px; font-size:12px; font-weight:800; letter-spacing:2px; text-transform:uppercase; text-decoration:none; transition:background 200ms;"
                    onmouseover="this.style.background='#E5E5E5'" onmouseout="this.style.background='#FFFFFF'">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    Hubungi Kami
                </a>
                @if($socials && count($socials) > 0)
                    <div style="display:flex; gap:8px;">
                        @foreach($socials as $soc)
                            <a href="{{ $soc['link'] }}" aria-label="{{ $soc['platform'] }}" target="_blank"
                                rel="noopener noreferrer" class="ft-social">
                                {!! $getIcon($soc['platform']) !!}
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- ── LINKS GRID ───────────────────────────────────── --}}
    <div style="padding:56px 0; border-bottom:1px solid rgba(255,255,255,0.05);">
        <div class="ft-wrap">
            <div class="ft-main-grid" style="display:grid; grid-template-columns:2fr 1fr 1fr 1.5fr; gap:40px;">

                {{-- Brand --}}
                <div>
                    <div class="ft-col-head">Tentang</div>
                    <a href="{{ route('home') }}"
                        style="display:inline-block; margin-bottom:20px; text-decoration:none;">
                        @if($logo)
                            <img src="{{ asset('storage/' . $logo) }}" alt="Coach Agam"
                                style="height:40px; object-fit:contain; filter:brightness(0) invert(1); opacity:0.6;">
                        @else
                            <span
                                style="font-size:18px; font-weight:900; color:rgba(255,255,255,0.6); letter-spacing:-0.5px;">COACH
                                AGAM</span>
                        @endif
                    </a>
                    <p style="font-size:13px; color:#4B5563; line-height:1.8; margin:0;">
                        {{ \Illuminate\Support\Str::limit(strip_tags($desc), 120) }}
                    </p>
                </div>

                {{-- Navigasi --}}
                <div>
                    <div class="ft-col-head">Navigasi</div>
                    <ul style="list-style:none; margin:0; padding:0;">
                        @foreach($navLinks as $link)
                            <li><a href="{{ $link['href'] }}" class="ft-link">{{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>

                {{-- Layanan --}}
                <div>
                    <div class="ft-col-head">Layanan</div>
                    <ul style="list-style:none; margin:0; padding:0;">
                        @foreach($serviceLinks as $link)
                            <li><a href="{{ $link['href'] }}" class="ft-link">{{ $link['label'] }}</a></li>
                        @endforeach
                    </ul>
                </div>

                {{-- Kontak --}}
                <div>
                    <div class="ft-col-head">Kontak</div>
                    <ul style="list-style:none; margin:0; padding:0; display:flex; flex-direction:column; gap:14px;">
                        @if($whatsapp)
                            <li>
                                <a href="{{ $waUrl }}" target="_blank" rel="noopener" class="ft-link"
                                    style="display:flex; align-items:center; gap:10px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round">
                                        <path
                                            d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.11 12 19.79 19.79 0 0 1 1.04 3.4 2 2 0 0 1 3 1.04h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91A16 16 0 0 0 14.09 16l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                                    </svg>
                                    {{ $whatsapp }}
                                </a>
                            </li>
                        @endif
                        @if($email)
                            <li>
                                <a href="mailto:{{ $email }}" class="ft-link"
                                    style="display:flex; align-items:center; gap:10px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round">
                                        <path
                                            d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                        <polyline points="22,6 12,13 2,6" />
                                    </svg>
                                    {{ $email }}
                                </a>
                            </li>
                        @endif
                        <li>
                            <div
                                style="display:flex; align-items:flex-start; gap:10px; color:#4B5563; font-size:13px; line-height:1.7;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" style="flex-shrink:0; margin-top:2px;">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                    <circle cx="12" cy="10" r="3" />
                                </svg>
                                <span>{!! nl2br(e($address)) !!}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- ── BOTTOM BAR ───────────────────────────────────── --}}
    <div style="padding:20px 0;">
        <div class="ft-wrap"
            style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:12px;">
            <p style="font-size:11px; color:rgba(255,255,255,0.15); margin:0; letter-spacing:0.5px;">
                {!! $copyrightText !!}
            </p>
            <p
                style="font-size:11px; color:rgba(255,255,255,0.15); margin:0; letter-spacing:0.5px; display:flex; align-items:center; gap:8px;">
                <span>Developed by</span>
                <a href="https://hvmdigital.id" target="_blank" rel="noopener noreferrer"
                    style="color:rgba(255,255,255,0.3); text-decoration:none; font-weight:700; letter-spacing:1px; transition:color 150ms;"
                    onmouseover="this.style.color='rgba(255,255,255,0.7)'"
                    onmouseout="this.style.color='rgba(255,255,255,0.3)'">
                    HVM DIGITAL
                </a>
            </p>
            <div style="display:flex; gap:24px;">
                <a href="{{ $privacyLink }}"
                    style="font-size:11px; color:rgba(255,255,255,0.15); text-decoration:none; letter-spacing:0.5px; transition:color 150ms;"
                    onmouseover="this.style.color='rgba(255,255,255,0.5)'"
                    onmouseout="this.style.color='rgba(255,255,255,0.15)'">Privacy</a>
                <a href="{{ $termsLink }}"
                    style="font-size:11px; color:rgba(255,255,255,0.15); text-decoration:none; letter-spacing:0.5px; transition:color 150ms;"
                    onmouseover="this.style.color='rgba(255,255,255,0.5)'"
                    onmouseout="this.style.color='rgba(255,255,255,0.15)'">Terms</a>
            </div>
        </div>
    </div>

</footer>