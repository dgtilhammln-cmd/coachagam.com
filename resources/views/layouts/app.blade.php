<!DOCTYPE html>
<html lang="id" prefix="og: https://ogp.me/ns#">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    {{-- CSRF Token for AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- =============================================
         PRIMARY META
         ============================================= --}}
@php
    $__gs = \App\Models\SiteSetting::whereIn('key', [
        'general.logo', 'general.favicon', 'general.breadcrumb_image',
        'seo.og_image', 'seo.meta_title', 'seo.meta_description', 'seo.meta_keywords',
        'integrations.gsc_tag', 'integrations.gtm_head', 'integrations.gtm_body',
        'contact.whatsapp_number',
    ])->pluck('value', 'key');

    $__ft_socials = json_decode(\App\Models\SiteSetting::where('key', 'page_profile.socials')->value('value') ?? '[]', true) ?: [];
    $__ft_wa_raw  = \App\Models\SiteSetting::where('key', 'general.whatsapp')->value('value') ?? '';
    $__ft_email   = \App\Models\SiteSetting::where('key', 'general.email')->value('value') ?? 'info@coachagam.com';
    $__ft_addr    = \App\Models\SiteSetting::where('key', 'general.address')->value('value') ?? 'Jakarta, Indonesia';
    $__ft_wa_num  = preg_replace('/[^0-9]/', '', $__ft_wa_raw);
    if($__ft_wa_num && str_starts_with($__ft_wa_num, '0')) $__ft_wa_num = '62' . substr($__ft_wa_num, 1);
    $__ft_wa_url  = $__ft_wa_num ? 'https://wa.me/' . $__ft_wa_num : '#';
    $__ft_icons   = [
        'instagram' => '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>',
        'youtube'   => '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22.54 6.42a2.78 2.78 0 0 0-1.94-2C18.88 4 12 4 12 4s-6.88 0-8.6.46a2.78 2.78 0 0 0-1.94 2A29 29 0 0 0 1 11.75a29 29 0 0 0 .46 5.33 2.78 2.78 0 0 0 1.94 2C5.12 19.5 12 19.5 12 19.5s6.88 0 8.6-.46a2.78 2.78 0 0 0 1.94-2 29 29 0 0 0 .46-5.33z"/><polygon points="9.75 15.02 15.5 11.75 9.75 8.48 9.75 15.02"/></svg>',
        'linkedin'  => '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="12"/><circle cx="4" cy="4" r="2"/></svg>',
        'default'   => '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/></svg>',
    ];
    $__getIcon = function($p) use($__ft_icons) {
        $p = strtolower($p);
        if(str_contains($p,'ig')||str_contains($p,'insta')) return $__ft_icons['instagram'];
        if(str_contains($p,'yt')||str_contains($p,'you'))   return $__ft_icons['youtube'];
        if(str_contains($p,'in')||str_contains($p,'link'))  return $__ft_icons['linkedin'];
        return $__ft_icons['default'];
    };
@endphp
    <title>@yield('title', $__gs->get('seo.meta_title', 'Coach Agam — Pelatih Sepakbola Profesional Indonesia'))</title>
    <meta name="description" content="@yield('meta_description', $__gs->get('seo.meta_description', 'Coach Agam adalah pelatih sepakbola profesional berpengalaman di Indonesia.'))">
    <meta name="keywords" content="@yield('meta_keywords', $__gs->get('seo.meta_keywords', 'coach agam, pelatih sepakbola, football coach indonesia'))">
    <meta name="author" content="Coach Agam">
    <meta name="robots" content="@yield('robots', 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1')">
    <meta name="revisit-after" content="7 days">
    <meta name="language" content="Indonesian">
    <meta name="geo.region" content="ID">
    <meta name="geo.placename" content="Indonesia">

    {{-- Canonical URL --}}
    <link rel="canonical" href="@yield('canonical', url()->current())">

    {{-- Hreflang - Language targeting --}}
    <link rel="alternate" hreflang="id" href="{{ url()->current() }}" />
    <link rel="alternate" hreflang="x-default" href="{{ url()->current() }}" />

    {{-- =============================================
         OPEN GRAPH (Facebook / WhatsApp / LinkedIn)
         ============================================= --}}
    <meta property="og:type"        content="@yield('og_type', 'website')">
    <meta property="og:title"       content="@yield('og_title', 'Coach Agam — Pelatih Sepakbola Profesional Indonesia')">
    <meta property="og:description" content="@yield('og_description', 'Pelatih sepakbola profesional Indonesia. Program latihan terstruktur, analisis taktik, dan pengembangan pemain berbasis data ilmiah.')">
    <meta property="og:url"         content="@yield('og_url', url()->current())">
    <meta property="og:image"       content="@yield('og_image', $__gs->get('seo.og_image') ? url('storage/'.$__gs->get('seo.og_image')) : url('/images/og-default.jpg'))">
    <meta property="og:image:width"  content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt"   content="@yield('og_image_alt', 'Coach Agam — Pelatih Sepakbola Profesional')">
    <meta property="og:site_name"   content="Coach Agam">
    <meta property="og:locale"      content="id_ID">
    <meta property="og:locale:alternate" content="en_US">

    {{-- =============================================
         TWITTER CARD
         ============================================= --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:site"        content="@coachagam">
    <meta name="twitter:creator"     content="@coachagam">
    <meta name="twitter:title"       content="@yield('twitter_title', 'Coach Agam — Pelatih Sepakbola Profesional')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Pelatih sepakbola profesional Indonesia. Program latihan terstruktur dan pengembangan pemain berbasis ilmu olahraga.')">
    <meta name="twitter:image"       content="@yield('twitter_image', url('/images/og-default.jpg'))">
    <meta name="twitter:image:alt"   content="@yield('twitter_image_alt', 'Coach Agam')">

    {{-- =============================================
         ARTICLE META (untuk halaman blog)
         ============================================= --}}
    @if(View::hasSection('article_published_time'))
    <meta property="article:published_time" content="@yield('article_published_time')">
    <meta property="article:modified_time"  content="@yield('article_modified_time')">
    <meta property="article:author"         content="Coach Agam">
    <meta property="article:section"        content="@yield('article_section', 'Sepakbola')">
    @endif

    {{-- =============================================
         JSON-LD STRUCTURED DATA
         ============================================= --}}
    @yield('schema_extra')
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@graph": [
            {
                "@@type": "Organization",
                "@@id": "{{ config('app.url') }}/#organization",
                "name": "Coach Agam",
                "alternateName": "Coach Agam Football",
                "url": "{{ config('app.url') }}",
                "logo": {
                    "@@type": "ImageObject",
                    "url": "{{ config('app.url') }}/images/logo.png",
                    "width": 300,
                    "height": 100
                },
                "image": "{{ config('app.url') }}/images/og-default.jpg",
                "description": "Pelatih sepakbola profesional Indonesia dengan keahlian pengembangan pemain muda, analisis taktik, dan program latihan berbasis data ilmiah.",
                "foundingDate": "2015",
                "foundingLocation": {
                    "@@type": "Place",
                    "addressCountry": "ID",
                    "addressLocality": "Indonesia"
                },
                "areaServed": {
                    "@@type": "Country",
                    "name": "Indonesia"
                },
                "contactPoint": [
                    {
                        "@@type": "ContactPoint",
                        "contactType": "customer service",
                        "availableLanguage": ["Indonesian", "English"],
                        "url": "{{ config('app.url') }}/kontak"
                    }
                ],
                "sameAs": [
                    "https://www.instagram.com/coachagam",
                    "https://www.youtube.com/@coachagam",
                    "https://www.facebook.com/coachagam",
                    "https://twitter.com/coachagam",
                    "https://www.tiktok.com/@coachagam"
                ]
            },
            {
                "@@type": "WebSite",
                "@@id": "{{ config('app.url') }}/#website",
                "url": "{{ config('app.url') }}",
                "name": "Coach Agam",
                "description": "Website resmi Coach Agam — Pelatih Sepakbola Profesional Indonesia",
                "publisher": {
                    "@@id": "{{ config('app.url') }}/#organization"
                },
                "inLanguage": "id-ID",
                "potentialAction": {
                    "@@type": "SearchAction",
                    "target": {
                        "@@type": "EntryPoint",
                        "urlTemplate": "{{ config('app.url') }}/blog?q={search_term_string}"
                    },
                    "query-input": "required name=search_term_string"
                }
            },
            {
                "@@type": "WebPage",
                "@@id": "{{ url()->current() }}#webpage",
                "url": "{{ url()->current() }}",
                "name": "@yield('title', 'Coach Agam — Pelatih Sepakbola Profesional Indonesia')",
                "description": "@yield('meta_description', 'Coach Agam adalah pelatih sepakbola profesional berpengalaman di Indonesia.')",
                "isPartOf": {
                    "@@id": "{{ config('app.url') }}/#website"
                },
                "about": {
                    "@@id": "{{ config('app.url') }}/#organization"
                },
                "inLanguage": "id-ID",
                "datePublished": "@yield('webpage_date_published', now()->startOfYear()->toIso8601String())",
                "dateModified": "@yield('webpage_date_modified', now()->toIso8601String())",
                "breadcrumb": {
                    "@@type": "BreadcrumbList",
                    "itemListElement": [
                        {
                            "@@type": "ListItem",
                            "position": 1,
                            "name": "Beranda",
                            "item": "{{ config('app.url') }}"
                        }
                        @if(View::hasSection('breadcrumb_extra'))
                        ,@yield('breadcrumb_extra')
                        @endif
                    ]
                }
            },
            {
                "@@type": "Person",
                "@@id": "{{ config('app.url') }}/#coach",
                "name": "Coach Agam",
                "jobTitle": "Pelatih Sepakbola Profesional",
                "worksFor": {
                    "@@id": "{{ config('app.url') }}/#organization"
                },
                "url": "{{ config('app.url') }}",
                "image": "{{ config('app.url') }}/images/coach-agam.jpg",
                "sameAs": [
                    "https://www.instagram.com/coachagam",
                    "https://www.youtube.com/@coachagam",
                    "https://www.linkedin.com/in/agam-haris-pambudi",
                    "https://www.facebook.com/coachagam",
                    "https://twitter.com/coachagam",
                    "https://www.transfermarkt.com/agam-haris-pambudi/profil/trainer/99999"
                ],
                "knowsAbout": [
                    "Sepakbola",
                    "Pelatihan Atlet",
                    "Analisis Taktik",
                    "Pengembangan Pemain Muda",
                    "Strength and Conditioning"
                ]
            }
        ]
    }
    </script>

    {{-- LocalBusiness / ProfessionalService Schema --}}
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": ["LocalBusiness", "ProfessionalService", "SportsActivityLocation"],
        "@@id": "{{ config('app.url') }}/#localbusiness",
        "name": "Coach Agam | Pelatih Sepakbola Profesional",
        "alternateName": "AHP Training Coach Agam",
        "description": "Layanan pelatihan sepakbola profesional yang mencakup pelatihan privat, pelatihan tim, analisis taktik, dan program AHP Training terstruktur.",
        "url": "{{ config('app.url') }}",
        "logo": "{{ config('app.url') }}/images/logo.png",
        "image": "{{ config('app.url') }}/images/og-default.jpg",
        "priceRange": "IDR",
        "currenciesAccepted": "IDR",
        "paymentAccepted": "Cash, Bank Transfer",
        "address": {
            "@@type": "PostalAddress",
            "addressCountry": "ID",
            "addressRegion": "Jawa Timur",
            "addressLocality": "Sidoarjo"
        },
        "geo": {
            "@@type": "GeoCoordinates",
            "latitude": -7.447463826105748,
            "longitude": 112.72861619817387
        },
        "areaServed": [
            { "@@type": "Country", "name": "Indonesia" },
            { "@@type": "City", "name": "Lamongan" },
            { "@@type": "City", "name": "Surabaya" },
            { "@@type": "City", "name": "Sidoarjo" }
        ],
        "hasOfferCatalog": {
            "@@type": "OfferCatalog",
            "name": "Layanan Pelatihan Sepakbola",
            "itemListElement": [
                {
                    "@@type": "Offer",
                    "itemOffered": {
                        "@@type": "Service",
                        "name": "AHP Training Program",
                        "description": "Program latihan terstruktur 5 tahap dari Pre Test hingga Report Individual Players.",
                        "url": "{{ url('/ahp-training') }}"
                    }
                },
                {
                    "@@type": "Offer",
                    "itemOffered": {
                        "@@type": "Service",
                        "name": "Pelatihan Privat",
                        "description": "Sesi latihan 1-on-1 bersama Coach Agam."
                    }
                },
                {
                    "@@type": "Offer",
                    "itemOffered": {
                        "@@type": "Service",
                        "name": "Pelatihan Tim",
                        "description": "Program latihan untuk tim sepakbola dengan pendekatan taktik modern."
                    }
                }
            ]
        },
        "founder": {
            "@@type": "Person",
            "name": "Agam Haris Pambudi, S.Pd., M.Kes.",
            "alternateName": "Coach Agam",
            "url": "{{ url('/profil-coach-agam') }}"
        },
        "sameAs": [
            "https://www.instagram.com/coachagam",
            "https://www.youtube.com/@coachagam"
        ]
    }
    </script>

    {{-- Favicon --}}
    @if($__gs->get('general.favicon'))
    <link rel="icon" href="{{ asset('storage/'.$__gs->get('general.favicon')) }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/'.$__gs->get('general.favicon')) }}">
    @else
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><rect x='15' y='15' width='70' height='70' fill='%231A1A1A'/><rect x='35' y='35' width='30' height='30' fill='%23FFFFFF'/></svg>">
    @endif
    <meta name="theme-color" content="#FFFFFF">

    {{-- GSC Tag --}}
    @if($__gs->get('integrations.gsc_tag'))
    {!! $__gs->get('integrations.gsc_tag') !!}
    @endif

    {{-- GTM Head --}}
    @if($__gs->get('integrations.gtm_head'))
    {!! $__gs->get('integrations.gtm_head') !!}
    @endif

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="dns-prefetch" href="https://fonts.bunny.net">

    {{-- Alpine.js — intersect plugin MUST load before main Alpine --}}
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.14.3/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.3/dist/cdn.min.js" defer></script>

    {{-- Vite Assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Extra head --}}
    @stack('head')
</head>
<body
    x-data="{ mobileMenuOpen: false }"
    class="min-h-screen antialiased"
    style="background-color:#FFFFFF; color:#1A1A1A; font-family:'Montserrat', sans-serif;"
>
{{-- GTM Body (noscript) --}}
@if($__gs->get('integrations.gtm_body'))
{!! $__gs->get('integrations.gtm_body') !!}
@endif

{{-- ════════════════════════════════════════════════════════════════
     PREMIUM LOADING SCREEN — COACH AGAM
     ════════════════════════════════════════════════════════════════ --}}
@php $__logo = \App\Models\SiteSetting::where('key','general.logo')->value('value'); @endphp
<div id="page-loader" aria-hidden="true" style="
    position: fixed; inset: 0; z-index: 99999;
    background: #FFFFFF;
    display: flex; flex-direction: column; align-items: center; justify-content: center;
    transition: opacity 0.5s ease, visibility 0.5s;
">
    {{-- Center Content --}}
    <div style="text-align:center; position:relative; z-index:2; display:flex; flex-direction:column; align-items:center; justify-content:center;">

        {{-- Logo with Elegant Pulse --}}
        <div id="loader-logo" style="opacity: 0; animation: elegant-pulse 2s ease-in-out infinite alternate;">
            @if($__logo)
                <img src="{{ asset('storage/'.$__logo) }}" alt="Coach Agam"
                     style="height:56px; object-fit:contain; filter:drop-shadow(0 4px 12px rgba(0,0,0,0.05));">
            @else
                <div style="font-size:28px; font-weight:900; letter-spacing:-1.5px; color:#1A1A1A;">COACH AGAM</div>
            @endif
        </div>
    </div>
</div>

<style>
    @keyframes elegant-pulse {
        0% { opacity: 0.6; transform: scale(0.98); }
        100% { opacity: 1; transform: scale(1.05); }
    }
</style>

<script>
    (function() {
        var loader = document.getElementById('page-loader');
        var logo   = document.getElementById('loader-logo');

        // Fade in logo shortly after load starts
        setTimeout(function() {
            if(logo) logo.style.opacity = '1';
        }, 50);

        function hideLoader() {
            if(loader) {
                loader.style.opacity = '0';
                loader.style.visibility = 'hidden';
                setTimeout(function() { loader.style.display = 'none'; }, 500);
            }
        }

        if (document.readyState === 'complete') {
            hideLoader();
        } else {
            window.addEventListener('load', hideLoader);
            // Safety fallback: hide after 3s max
            setTimeout(hideLoader, 3000);
        }
    })();
</script>



{{-- ======================== NAVBAR ======================== --}}
<style>
    @keyframes vertical-ticker {
        0%, 25% { transform: translateY(0); }
        33%, 58% { transform: translateY(-32px); }
        66%, 91% { transform: translateY(-64px); }
        100% { transform: translateY(-96px); }
    }
    .ticker-wrapper {
        height: 32px;
        overflow: hidden;
        position: relative;
    }
    .ticker-content {
        animation: vertical-ticker 12s cubic-bezier(0.25, 1, 0.5, 1) infinite;
    }
    .ticker-item {
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 600;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: #9CA3AF;
    }
    @media (max-width: 768px) {
        .ticker-wrapper { display: none !important; }
        .top-bar-left { display: flex !important; }
        .top-bar-left span { display: inline !important; }
    }
</style>

<header
    id="navbar"
    role="banner"
    style="
        position:absolute;top:0;left:0;right:0;z-index:1000;
        display:flex;flex-direction:column;
    "
>
    {{-- TOP BAR --}}
    <div style="background:#050505; height:32px; border-bottom:1px solid rgba(255,255,255,0.05); display:flex; align-items:center;">
        <div style="max-width:1140px;margin:0 auto;padding:0 24px;width:100%;display:flex;align-items:center;justify-content:space-between;">
            
            {{-- Left: Icon + Address --}}
            <div class="top-bar-left" style="display:flex; align-items:center; gap:8px; color:#9CA3AF; font-size:10px; font-weight:600; letter-spacing:1px; text-transform:uppercase;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                <span>{{ $__ft_addr ?? 'Semarang, Indonesia' }}</span>
            </div>

            @php
                $__tickerData = \App\Models\SiteSetting::where('key', 'header.ticker')->value('value');
                $__tickers = $__tickerData ? json_decode($__tickerData, true) : [
                    'Jadwal Latihan: Senin - Jumat, 15.00 - 18.00 WIB',
                    'Konsultasi Program Latihan Fisik? Hubungi WA!',
                    'Pendaftaran Kelas Privat Sedang Dibuka!'
                ];
                // Agar animasi mulus, kita gandakan array-nya jika itemnya sedikit
                if (count($__tickers) > 0) {
                    $__tickers = array_merge($__tickers, $__tickers);
                }
            @endphp
            {{-- Middle: Ticker --}}
            <div class="ticker-wrapper" style="flex:1; max-width:400px; margin:0 20px;">
                <div class="ticker-content">
                    @forelse($__tickers as $ticker)
                        <div class="ticker-item">{{ $ticker }}</div>
                    @empty
                        <div class="ticker-item">Jadwal Latihan: Senin - Jumat, 15.00 - 18.00 WIB</div>
                    @endforelse
                </div>
            </div>

            {{-- Right: Social + WA --}}
            <div style="display:flex; align-items:center; gap:16px;">
                @foreach($__ft_socials as $soc)
                    <a href="{{ $soc['link'] }}" target="_blank" rel="noopener noreferrer" style="color:#9CA3AF; transition:color 150ms; display:flex; align-items:center;" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#9CA3AF'" title="{{ $soc['platform'] }}">
                        {!! str_replace('width="15"', 'width="12"', str_replace('height="15"', 'height="12"', $__getIcon($soc['platform']))) !!}
                    </a>
                @endforeach
                <a href="{{ $__ft_wa_url }}" target="_blank" rel="noopener" style="color:#9CA3AF; transition:color 150ms; display:flex; align-items:center;" onmouseover="this.style.color='#25D366'" onmouseout="this.style.color='#9CA3AF'" title="WhatsApp" x-data @click.prevent="$dispatch('open-wa-popup', { url: '{{ $__ft_wa_url }}' })">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
                </a>
            </div>
        </div>
    </div>

    {{-- MAIN NAV (DARK MODE) --}}
    <style>
        .main-nav-container {
            height:70px; 
            background:rgba(15,15,15,0.98); 
            backdrop-filter:blur(20px); 
            -webkit-backdrop-filter:blur(20px); 
            border-bottom:1px solid rgba(255,255,255,0.05); 
            display:flex; 
            align-items:center; 
            z-index:1000; 
            width:100%;
        }
        .main-nav-sticky {
            position:fixed !important; 
            top:0; left:0; right:0; 
            box-shadow:0 4px 20px rgba(0,0,0,0.5); 
            animation:slideDown 0.3s ease-out;
        }
        @keyframes slideDown {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }
        .nav-dropdown-wrapper:hover .nav-dropdown-menu { display:flex !important; }
        .nav-dropdown-wrapper:hover .nav-dropdown-trigger { color:#FFFFFF !important; }
        .hamburger-toggle { display: none !important; }
        
        @media (max-width: 768px) {
            .desktop-nav-menu { display: none !important; }
            .hamburger-toggle { display: flex !important; }
        }
    </style>
    <div x-data="{ scrolled: false }"
         @scroll.window="scrolled = (window.pageYOffset > 32)"
         class="main-nav-container"
         :class="{ 'main-nav-sticky': scrolled }">
        <div style="max-width:1140px;margin:0 auto;padding:0 24px;width:100%;display:flex;align-items:center;justify-content:space-between;">

            {{-- Logo --}}
            <a href="{{ route('home') }}" aria-label="Beranda" style="display:flex;align-items:center;gap:12px;text-decoration:none;flex-shrink:0;">
                @if($__gs->get('general.logo'))
                    <img src="{{ asset('storage/'.$__gs->get('general.logo')) }}" alt="Logo" style="max-height:100px; max-width:220px; object-fit:contain; display:block;">
                @else
                    <div style="width:40px;height:40px;background:#FFFFFF;display:flex;align-items:center;justify-content:center;color:#0F0F0F;" aria-hidden="true">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="square" stroke-linejoin="miter"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                @endif
            </a>

            {{-- Desktop Nav --}}
            <nav aria-label="Navigasi utama" style="display:flex;align-items:center;gap:32px;" class="desktop-nav-menu">
                @foreach([
                    ['Beranda',    '/'],
                    ['Profil Coach Agam',    '/profil-coach-agam'],
                    ['Gallery',     '/gallery'],
                    ['Modul Kepelatihan',       '/blog?category=modul-kepelatihan'],
                ] as [$label, $href])
                <a href="{{ $href }}" style="color:#9CA3AF;font-size:9px;font-weight:600;text-transform:uppercase;letter-spacing:1px;text-decoration:none;transition:color 150ms;" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#9CA3AF'">{{ $label }}</a>
                @endforeach

                {{-- Blog Dropdown --}}
                <div class="nav-dropdown-wrapper" style="position:relative; height:100%; display:flex; align-items:center; cursor:pointer;" onclick="window.location.href='/blog'">
                    <a href="/blog" class="nav-dropdown-trigger" style="color:#9CA3AF;font-size:9px;font-weight:600;text-transform:uppercase;letter-spacing:1px;text-decoration:none;transition:color 150ms; display:flex; align-items:center; gap:4px; padding:20px 0;" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#9CA3AF'">
                        BLOG
                        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <div class="nav-dropdown-menu" style="
                        position:absolute; top:100%; left:50%; transform:translateX(-50%);
                        background:#0A0A0A; border:1px solid #333333; border-radius:4px;
                        display:none; flex-direction:row; gap:8px; padding:8px;
                        box-shadow:0 10px 25px rgba(0,0,0,0.5); margin-top:-5px;
                    " onclick="event.stopPropagation()">
                        {{-- triangle pointer --}}
                        <div style="position:absolute; top:-6px; left:50%; transform:translateX(-50%) rotate(45deg); width:10px; height:10px; background:#0A0A0A; border-left:1px solid #333333; border-top:1px solid #333333;"></div>
                        
                        @php
                            $navCatSetting = \App\Models\SiteSetting::where('key', 'blog.categories')->first();
                            $navCats = $navCatSetting ? json_decode($navCatSetting->value, true) : [];
                            $navHeads = array_filter($navCats, fn($c) => empty($c['parent_id']));
                        @endphp
                        @foreach($navHeads as $navHead)
                        <a href="/blog?category={{ $navHead['slug'] }}" style="white-space:nowrap; padding:12px 24px; color:#9CA3AF; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1px; text-decoration:none; border:1px solid #222222; background:#111111; transition:all 150ms;" onmouseover="this.style.background='#1A1A1A'; this.style.borderColor='#444444'; this.style.color='#FFFFFF';" onmouseout="this.style.background='#111111'; this.style.borderColor='#222222'; this.style.color='#9CA3AF';">{{ $navHead['name'] }}</a>
                        @endforeach
                    </div>
                </div>

                <a href="/kontak" style="color:#9CA3AF;font-size:9px;font-weight:600;text-transform:uppercase;letter-spacing:1px;text-decoration:none;transition:color 150ms;" onmouseover="this.style.color='#FFFFFF'" onmouseout="this.style.color='#9CA3AF'">KONTAK</a>
            </nav>

            {{-- CTA + Hamburger --}}
            <div style="display:flex;align-items:center;gap:12px;">
                
                {{-- AHP Training Dropdown CTA --}}
                <div class="ahp-dropdown-wrapper desktop-nav-menu" style="position:relative; height:100%; display:flex; align-items:center; cursor:pointer;" onclick="window.location.href='{{ route('ahp-training') }}'">
                    <a href="{{ route('ahp-training') }}" class="ahp-dropdown-trigger"
                       style="display:flex;align-items:center;gap:8px;background:#FFFFFF;color:#1A1A1A;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:1px;padding:12px 24px;text-decoration:none;transition:all 200ms;border:1px solid #FFFFFF;"
                       onmouseover="this.style.background='transparent';this.style.color='#FFFFFF';"
                       onmouseout="this.style.background='#FFFFFF';this.style.color='#1A1A1A';"
                    >
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20"/><path d="M2 12h20"/></svg>
                        AHP TRAINING
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    
                    <div class="ahp-dropdown-menu" style="
                        position:absolute; top:100%; right:0;
                        background:#0A0A0A; border:1px solid #333333; border-radius:4px;
                        display:none; flex-direction:column; gap:6px; padding:8px;
                        box-shadow:0 10px 25px rgba(0,0,0,0.5); margin-top:0px; min-width:180px; z-index:1000;
                    " onclick="event.stopPropagation()">
                        <div style="position:absolute; top:-6px; right:30px; transform:rotate(45deg); width:10px; height:10px; background:#0A0A0A; border-left:1px solid #333333; border-top:1px solid #333333;"></div>
                        
                        <a href="{{ route('ahp-training') }}" style="white-space:nowrap; padding:12px 20px; color:#9CA3AF; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1px; text-decoration:none; border:1px solid #222222; background:#111111; transition:all 150ms; display:flex; align-items:center; gap:8px;" onmouseover="this.style.background='#1A1A1A'; this.style.borderColor='#444444'; this.style.color='#FFFFFF';" onmouseout="this.style.background='#111111'; this.style.borderColor='#222222'; this.style.color='#9CA3AF';">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                            Program Info
                        </a>
                        <a href="{{ route('ahp.players') }}" style="white-space:nowrap; padding:12px 20px; color:#9CA3AF; font-size:10px; font-weight:700; text-transform:uppercase; letter-spacing:1px; text-decoration:none; border:1px solid #222222; background:#111111; transition:all 150ms; display:flex; align-items:center; gap:8px;" onmouseover="this.style.background='#1A1A1A'; this.style.borderColor='#444444'; this.style.color='#FFFFFF';" onmouseout="this.style.background='#111111'; this.style.borderColor='#222222'; this.style.color='#9CA3AF';">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                            All Players
                        </a>
                    </div>
                </div>

                <style>
                    .ahp-dropdown-wrapper:hover .ahp-dropdown-menu { display:flex !important; }
                    /* ensure hover doesn't break inline color style */
                    .ahp-dropdown-wrapper:hover .ahp-dropdown-trigger { background:transparent !important; color:#FFFFFF !important; }
                </style>

                {{-- Hamburger --}}
                <button
                    id="hamburger-btn"
                    onclick="toggleMobileMenu(this)"
                    aria-controls="mobile-nav"
                    aria-expanded="false"
                    aria-label="Buka / tutup menu"
                    class="hamburger-toggle"
                    style="flex-direction:column;justify-content:center;align-items:center;gap:6px;width:44px;height:44px;background:transparent;border:2px solid rgba(255,255,255,0.5);cursor:pointer;padding:0;border-radius:6px;"
                >
                    <span id="ham-line1" style="display:block;width:22px;height:2px;background:#FFFFFF;transition:all 300ms;"></span>
                    <span id="ham-line2" style="display:block;width:22px;height:2px;background:#FFFFFF;transition:all 300ms;"></span>
                    <span id="ham-line3" style="display:block;width:22px;height:2px;background:#FFFFFF;transition:all 300ms;"></span>
                </button>
            </div>
        </div>
    </div>
</header>

{{-- Mobile Nav: pure CSS + JS approach, no Alpine dependency --}}
<nav
    id="mobile-nav"
    aria-label="Menu mobile"
    style="display:none; position:fixed;top:0;left:0;right:0;bottom:0;z-index:999;background:#0F0F0F;padding:120px 24px 24px;overflow-y:auto;"
>
    <ul role="list" style="list-style:none;margin:0;padding:0;display:flex;flex-direction:column;gap:4px;">
        @foreach([
            ['Beranda',    '/'],
            ['Profil Coach Agam',    '/profil-coach-agam'],
            ['Gallery',     '/gallery'],
            ['Modul Kepelatihan',       '/blog?category=modul-kepelatihan'],
            ['Blog',       '/blog'],
            ['Kontak',     '/kontak'],
        ] as [$label, $href])
        <li>
            <a href="{{ $href }}"
               onclick="closeMobileMenu()"
               style="display:block;padding:14px;color:#FFFFFF;text-decoration:none;font-size:14px;font-weight:600;text-transform:uppercase;letter-spacing:1px;border-bottom:1px solid rgba(255,255,255,0.05);"
            >{{ $label }}</a>
        </li>
        @endforeach
    </ul>
    <div style="margin-top:24px;">
        <a href="{{ url('/ahp-training') }}"
           onclick="closeMobileMenu()"
           style="display:flex;align-items:center;justify-content:center;background:#FFFFFF;color:#1A1A1A;font-weight:600;font-size:13px;letter-spacing:1px;padding:16px;text-decoration:none;"
        >
            AHP TRAINING
        </a>
    </div>
</nav>

<script>
function toggleMobileMenu(btn) {
    var nav = document.getElementById('mobile-nav');
    var isOpen = nav.style.display === 'block';
    if (isOpen) {
        nav.style.display = 'none';
        btn.setAttribute('aria-expanded', 'false');
        document.getElementById('ham-line1').style.transform = '';
        document.getElementById('ham-line2').style.opacity = '1';
        document.getElementById('ham-line3').style.transform = '';
    } else {
        nav.style.display = 'block';
        btn.setAttribute('aria-expanded', 'true');
        document.getElementById('ham-line1').style.transform = 'rotate(45deg) translate(6px, 6px)';
        document.getElementById('ham-line2').style.opacity = '0';
        document.getElementById('ham-line3').style.transform = 'rotate(-45deg) translate(5px, -5px)';
    }
}
function closeMobileMenu() {
    var nav = document.getElementById('mobile-nav');
    var btn = document.getElementById('hamburger-btn');
    nav.style.display = 'none';
    if (btn) btn.setAttribute('aria-expanded', 'false');
    document.getElementById('ham-line1').style.transform = '';
    document.getElementById('ham-line2').style.opacity = '1';
    document.getElementById('ham-line3').style.transform = '';
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeMobileMenu();
});
</script>

{{-- ======================== MAIN CONTENT ======================== --}}
<main id="konten-utama" tabindex="-1" style="padding-top:102px;">
    @yield('content')
</main>

{{-- ======================== FOOTER ======================== --}}
{{-- Variables moved to top --}}

<style>
    .ft-eyebrow2 { display:flex; align-items:center; gap:12px; margin-bottom:24px; }
    .ft-eyebrow2 span { font-size:10px; font-weight:700; letter-spacing:3px; text-transform:uppercase; color:#4B5563; }
    .ft-eyebrow2 .ft-line2 { width:32px; height:1px; background:rgba(255,255,255,0.1); flex-shrink:0; }
    .ft-lnk { color:#4B5563; font-size:13px; text-decoration:none; display:block; padding:5px 0; transition:color 150ms; }
    .ft-lnk:hover { color:#fff; }
    .ft-col-hd { font-size:10px; font-weight:800; letter-spacing:3px; text-transform:uppercase; color:rgba(255,255,255,0.2); margin:0 0 18px; display:flex; align-items:center; gap:10px; }
    .ft-col-hd::after { content:''; flex:1; height:1px; background:rgba(255,255,255,0.06); }
    .ft-soc { width:34px; height:34px; border:1px solid rgba(255,255,255,0.08); display:flex; align-items:center; justify-content:center; color:#4B5563; text-decoration:none; transition:all 180ms; }
    .ft-soc:hover { background:#fff; color:#0D0D0D; border-color:#fff; }
    @media(max-width:900px){ .ft-grid { grid-template-columns:1fr 1fr!important; } }
    @media(max-width:560px){ .ft-grid { grid-template-columns:1fr!important; gap:36px!important; } }
</style>

<footer role="contentinfo" style="background:#0D0D0D; border-top:1px solid rgba(255,255,255,0.05); position:relative; overflow:hidden;">

    <div style="border-bottom:1px solid rgba(255,255,255,0.05); padding:64px 0 56px;">
        <div style="max-width:1200px; margin:0 auto; padding:0 40px; box-sizing:border-box; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:40px;">
            <div>
                <div class="ft-eyebrow2">
                    <span>Coach Agam</span>
                    <div class="ft-line2"></div>
                    <span>Pelatih Profesional</span>
                </div>
                <h2 style="font-size:clamp(22px, 2.5vw, 36px); line-height:1.1; letter-spacing:-1px; margin:0 0 16px;">
                    <span style="font-weight:900; color:#FFFFFF; display:block;">Tingkatkan</span>
                    <span style="font-weight:300; font-style:italic; color:#4B5563; display:block;">Kualitas Bermainmu</span>
                </h2>
                <p style="font-size:13px; color:#4B5563; line-height:1.8; max-width:480px; margin:0;">
                    Pelatih sepakbola profesional berdedikasi untuk mengembangkan potensi setiap pemain melalui pendekatan modern dan terpadu.
                </p>
            </div>
            <div>
                <a href="{{ route('kontak') }}"
                   style="display:inline-flex; align-items:center; gap:12px; background:transparent; border:1px solid rgba(255,255,255,0.2); color:#FFFFFF; padding:16px 28px; font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase; text-decoration:none; transition:all 300ms; border-radius:0;"
                   onmouseover="this.style.background='#FFFFFF'; this.style.color='#000000'" 
                   onmouseout="this.style.background='transparent'; this.style.color='#FFFFFF'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>

    <div style="padding:52px 0; border-bottom:1px solid rgba(255,255,255,0.05);">
        <div style="max-width:1200px; margin:0 auto; padding:0 40px; box-sizing:border-box;">
            <div class="ft-grid" style="display:grid; grid-template-columns:2fr 1fr 1fr 1.5fr; gap:40px;">
                <div>
                    <div class="ft-col-hd">Tentang</div>
                    <a href="{{ route('home') }}" style="display:inline-block; margin-bottom:16px; text-decoration:none;">
                        @if($__gs->get('general.logo'))
                            <img src="{{ asset('storage/'.$__gs->get('general.logo')) }}" alt="Coach Agam" style="height:70px; object-fit:contain; max-width:260px;">
                        @else
                            <span style="font-size:24px; font-weight:900; color:rgba(255,255,255,0.7); letter-spacing:-0.5px;">COACH AGAM</span>
                        @endif
                    </a>
                    <p style="font-size:13px; color:#4B5563; line-height:1.8; margin:0;">Pelatih sepakbola profesional berdedikasi untuk mengembangkan potensi setiap pemain melalui pendekatan modern.</p>
                </div>
                <div>
                    <div class="ft-col-hd">Navigasi</div>
                    <ul style="list-style:none; margin:0; padding:0;">
                        @foreach(['Beranda'=>route('home'),'Profil'=>route('profil'),'Galeri'=>route('gallery'),'AHP Training'=>route('ahp-training'),'Blog'=>route('blog.index'),'Kontak'=>route('kontak')] as $lbl=>$href)
                        <li><a href="{{ $href }}" class="ft-lnk">{{ $lbl }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <div class="ft-col-hd">Layanan</div>
                    <ul style="list-style:none; margin:0; padding:0;">
                        @foreach(['Pelatihan Privat'=>route('kontak'),'Pelatihan Tim'=>route('kontak'),'Analisis Taktik'=>route('kontak'),'Pemateri Seminar'=>route('kontak')] as $lbl=>$href)
                        <li><a href="{{ $href }}" class="ft-lnk">{{ $lbl }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div>
                    <div class="ft-col-hd">Kontak</div>
                    <ul style="list-style:none; margin:0; padding:0; display:flex; flex-direction:column; gap:13px;">
                        @if($__ft_wa_raw)
                        <li>
                            <a href="{{ $__ft_wa_url }}" target="_blank" rel="noopener" class="ft-lnk" style="display:flex; align-items:center; gap:9px;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.11 12 19.79 19.79 0 0 1 1.04 3.4 2 2 0 0 1 3 1.04h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91A16 16 0 0 0 14.09 16l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                {{ $__ft_wa_raw }}
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="mailto:{{ $__ft_email }}" class="ft-lnk" style="display:flex; align-items:center; gap:9px;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                                {{ $__ft_email }}
                            </a>
                        </li>
                        <li>
                            <div style="display:flex; align-items:flex-start; gap:9px; color:#4B5563; font-size:13px; line-height:1.7;">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="flex-shrink:0; margin-top:2px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                <span>{!! nl2br(e($__ft_addr)) !!}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div style="padding:24px 0;">
        <div style="max-width:1200px; margin:0 auto; padding:0 40px; box-sizing:border-box; display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
            <p style="font-size:12px; color:#6B7280; margin:0;">
                &copy; {{ date('Y') }} Coach Agam.
            </p>
            <div style="display:flex; align-items:center; gap:24px; font-size:12px;">
                <div style="color:#6B7280;">
                    Developed by <a href="https://hvmdigital.id" target="_blank" rel="noopener" style="color:#E5E7EB; text-decoration:none; font-weight:600; transition:color 150ms;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#E5E7EB'">HVM DIGITAL</a>
                </div>
            </div>
        </div>
    </div>
</footer>


{{-- Styles responsive --}}
<style>
@media(max-width:640px){
    .desktop-nav-menu{display:none!important;}
    #hamburger-btn{display:flex!important;}
    .footer-grid-cols{grid-template-columns:1fr 1fr!important;gap:32px!important;}
}
@media(max-width:480px){
    .footer-grid-cols{grid-template-columns:1fr!important;}
}

/* Sembunyikan elemen x-cloak sebelum Alpine siap */
[x-cloak] { display: none !important; }

/* Gallery lightbox layout - tanpa display, biarkan x-show yang handle */
.gallery-lightbox {
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 999999;
    background: rgba(0,0,0,0.92);
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 24px;
    box-sizing: border-box;
}
</style>

<x-wa-popup />

<!-- Global Lightbox for Gallery -->
<div x-data="{ open: false, imgSrc: '', caption: '' }" 
     @open-lightbox.window="imgSrc = $event.detail.src; caption = $event.detail.caption; open = true"
     @keydown.escape.window="open = false"
     x-show="open"
     x-cloak
     class="gallery-lightbox"
     style="display:none; flex-direction:column; align-items:center; justify-content:center; position:fixed; top:0; left:0; right:0; bottom:0; z-index:999999; background:rgba(0,0,0,0.92); padding:24px; box-sizing:border-box;"
     x-effect="$el.style.display = open ? 'flex' : 'none'"
     @click="open = false">
    
    <!-- Close button -->
    <button @click.stop="open = false" style="position:absolute; top:24px; right:24px; width:44px; height:44px; background:rgba(255,255,255,0.1); border:1px solid rgba(255,255,255,0.2); border-radius:50%; color:white; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:all 0.2s; backdrop-filter:blur(4px);"
            onmouseover="this.style.background='rgba(255,255,255,0.25)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    </button>
    
    <!-- Image -->
    <img :src="imgSrc" alt="Gallery Popup"
         style="max-width:90vw; max-height:80vh; object-fit:contain; border-radius:6px; box-shadow:0 20px 60px rgba(0,0,0,0.7);"
         @click.stop>
    
    <!-- Caption -->
    <p x-show="caption" x-text="caption"
       style="color:rgba(255,255,255,0.8); margin-top:20px; font-size:14px; text-align:center; max-width:700px; font-weight:400; letter-spacing:0.5px;"
       @click.stop></p>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intercept clicks on any link containing wa.me or api.whatsapp.com
    document.addEventListener('click', function(e) {
        // Cari element a terdekat yang diklik
        const link = e.target.closest('a');
        if (!link) return;
        
        const href = link.getAttribute('href');
        if (!href) return;
        
        if (href.includes('wa.me') || href.includes('api.whatsapp.com')) {
            e.preventDefault();
            // Dispatch event to open Alpine popup
            window.dispatchEvent(new CustomEvent('open-wa-popup', { 
                detail: { url: href } 
            }));
        }
    });
});
</script>

<!-- Floating Action Buttons -->
<style>
    .fab-container {
        position: fixed;
        bottom: 50px;
        right: 30px;
        z-index: 9999;
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .fab-button {
        position: relative;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background-color: #000000;
        color: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.5);
        text-decoration: none;
        border: 1px solid #333333;
        cursor: pointer;
        padding: 0;
        outline: none;
        transition: all 0.3s ease;
    }
    .fab-button:hover {
        background-color: #222222;
        border-color: #FFFFFF;
        transform: scale(1.1) !important;
    }
    .fab-button svg {
        color: #FFFFFF;
    }
</style>

<div x-data="{ 
        scrolled: false, 
        scrollPercent: 0,
        calculateScroll() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            if (height <= 0) {
                this.scrollPercent = 0;
            } else {
                this.scrollPercent = Math.round((winScroll / height) * 100);
            }
            this.scrolled = winScroll > 300;
        }
     }"
     @scroll.window="calculateScroll()"
     x-init="calculateScroll()"
     class="fab-container">
    
    <!-- WhatsApp FAB -->
    <a href="{{ $__ft_wa_url ?? '#' }}" 
       @click.prevent="$dispatch('open-wa-popup', { url: '{{ $__ft_wa_url ?? '#' }}' })"
       title="Hubungi via WhatsApp"
       class="fab-button"
       :style="scrolled ? 'opacity:1; transform:translateY(0); pointer-events:auto;' : 'opacity:0; transform:translateY(20px); pointer-events:none;'">
        <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/>
        </svg>
    </a>

    <!-- Scroll to Top FAB -->
    <button @click="window.scrollTo({top: 0, behavior: 'smooth'})"
            title="Kembali ke atas"
            class="fab-button"
            :style="scrolled ? 'opacity:1; transform:translateY(0); pointer-events:auto;' : 'opacity:0; transform:translateY(20px); pointer-events:none;'">
        
        <!-- Progress Ring SVG -->
        <svg style="position:absolute; inset:0; width:50px; height:50px; transform:rotate(-90deg);" viewBox="0 0 50 50">
            <!-- Background circle -->
            <circle cx="25" cy="25" r="22" fill="none" stroke="#333333" stroke-width="3"></circle>
            <!-- Progress circle -->
            <circle cx="25" cy="25" r="22" fill="none" stroke="#FFFFFF" stroke-width="3" 
                    stroke-dasharray="138.2" 
                    :stroke-dashoffset="138.2 - (138.2 * scrollPercent / 100)"
                    style="transition: stroke-dashoffset 0.1s; stroke-linecap: round;"></circle>
        </svg>
        
        <!-- Percentage Text -->
        <span x-text="scrollPercent + '%'" style="color:#FFFFFF; font-size:11px; font-weight:700; position:relative; z-index:2; font-family:sans-serif;"></span>
    </button>
</div>

<!-- AlpineJS -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@stack('scripts')
</body>
</html>
