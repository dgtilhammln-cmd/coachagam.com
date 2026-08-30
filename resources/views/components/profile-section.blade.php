@props(['settings' => [], 'fullPage' => false])

@php
    // Safe getter: works whether $settings is a Collection or plain array
    $s = function($key, $default = null) use ($settings) {
        if (is_object($settings) && method_exists($settings, 'get')) {
            $item = $settings->get($key);
            return $item ? ($item->value ?? $default) : $default;
        }
        return isset($settings[$key]) ? ($settings[$key]->value ?? $default) : $default;
    };

    $headline    = $s('page_profile.headline',    'Membentuk Karakter & Mental Juara di Lapangan Hijau');
    $subheadline = $s('page_profile.subheadline', 'PROFIL PELATIH');
    $desc1       = $s('page_profile.description_1', '');
    $desc2       = $s('page_profile.description_2', '');
    $image       = $s('page_profile.image', null);
    $tm_link     = $s('page_profile.tm_link', 'https://www.transfermarkt.co.id/agam-pambudi/profil/trainer/105024');
    $tm_logo     = $s('page_profile.tm_logo', null);
    $timelines   = json_decode($s('page_profile.timelines', '[]'), true) ?: [];
    $socials     = json_decode($s('page_profile.socials',   '[]'), true) ?: [];
    $infos          = json_decode($s('page_profile.infos',          '[]'), true) ?: [];
    $educations     = json_decode($s('page_profile.educations',     '[]'), true) ?: [];
    $certifications = json_decode($s('page_profile.certifications', '[]'), true) ?: [];
    $organizations  = json_decode($s('page_profile.organizations',  '[]'), true) ?: [];
    $achievements   = json_decode($s('page_profile.achievements',   '[]'), true) ?: [];

    // Social media SVG icons map
    $socialIcons = [
        'instagram' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
        'youtube'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
        'linkedin'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
        'twitter'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
        'facebook'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
        'tiktok'    => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>',
        'telegram'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>',
        'whatsapp'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>',
    ];

    // Helper to get icon by platform name (case-insensitive)
    $getSocialIcon = function(string $platform) use ($socialIcons): string {
        $key = strtolower(trim($platform));
        $key = str_replace([' ', '-', '_'], '', $key);
        // Normalize common variants
        $key = match($key) {
            'x', 'twitter', 'twitterx' => 'twitter',
            'ig'                        => 'instagram',
            'yt'                        => 'youtube',
            'fb'                        => 'facebook',
            'wa'                        => 'whatsapp',
            'tg'                        => 'telegram',
            default                     => $key,
        };
        return $socialIcons[$key] ?? '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm1 15H11v-2h2zm0-4H11V7h2z"/></svg>';
    };
@endphp

{{-- ═══════════════════════════════════════════════════════════════════════════
     PROFILE SECTION — COACH AGAM
     ═══════════════════════════════════════════════════════════════════════════ --}}
<section id="profil-coach-agam" aria-label="Profil Coach Agam" itemscope itemtype="https://schema.org/Person"
         x-data="{ shown: false }" 
         x-intersect.once="shown = true"
         style="background:#F8F8F8; color:#1A1A1A; padding:60px 0 60px;">

    <div class="profile-container">

        {{-- Section Label --}}
        <div style="text-align:center; margin-bottom:40px;"
             :style="shown ? 'opacity:1;transform:translateY(0);transition:opacity 2.5s cubic-bezier(0.16,1,0.3,1) 0ms,transform 2.5s cubic-bezier(0.16,1,0.3,1) 0ms' : 'opacity:0;transform:translateY(32px)'">
            <span style="display:inline-block; font-size:11px; font-weight:800; letter-spacing:4px; text-transform:uppercase; color:#6B7280; border-top:2px solid #1A1A1A; border-bottom:2px solid #1A1A1A; padding:6px 20px;">
                {{ $subheadline }}
            </span>
        </div>

        {{-- ═══ MAIN GRID: LEFT (Photo) + RIGHT (Content) ═══ --}}
        <div class="profile-main-grid">

            {{-- ─── LEFT COLUMN: Photo Card ─────────────────────────────── --}}
            <div class="profile-photo-col"
                 :style="shown ? 'opacity:1;transform:translateX(0);transition:opacity 2.5s cubic-bezier(0.16,1,0.3,1) 200ms,transform 2.5s cubic-bezier(0.16,1,0.3,1) 200ms' : 'opacity:0;transform:translateX(-40px)'">

                <x-profile-card />

            </div>

            {{-- ─── RIGHT COLUMN: All Content ───────────────────────────── --}}
            <div class="profile-content-col" style="display:flex; flex-direction:column; gap:28px;">

                {{-- Headline & Description --}}
                <div :style="shown ? 'opacity:1;transform:translateX(0);transition:opacity 2.5s cubic-bezier(0.16,1,0.3,1) 350ms,transform 2.5s cubic-bezier(0.16,1,0.3,1) 350ms' : 'opacity:0;transform:translateX(40px)'">
                    <h2 style="font-size:clamp(24px, 2.5vw, 38px); font-weight:800; line-height:1.2; color:#0D0D0D; letter-spacing:-0.5px; margin-bottom:20px;">
                        {!! nl2br(e($headline)) !!}
                    </h2>
                    <div itemprop="description" style="font-size:15px; line-height:1.8; color:#4B5563; max-width:640px;">
                        <p style="margin-bottom:14px;">{!! nl2br(e($desc1)) !!}</p>
                        @if($desc2)
                            <p>{!! nl2br(e($desc2)) !!}</p>
                        @endif
                    </div>

                    {{-- Transfermarkt External Verification — SEO Authority Signal --}}
                    <div style="display:flex; align-items:center; gap:12px; margin-top:20px; flex-wrap:wrap;">
                        <a href="{{ $tm_link }}"
                           target="_blank"
                           rel="noopener"
                           title="Verifikasi profil Coach Agam di Transfermarkt"
                           style="display:inline-flex; align-items:center; gap:10px; background:linear-gradient(135deg, #B0B8C1 0%, #8E9BA8 100%); color:#fff; text-decoration:none; padding:10px 18px; font-size:12px; font-weight:700; letter-spacing:0.5px; transition:all 200ms;"
                           onmouseover="this.style.background='linear-gradient(135deg, #9AA4AF 0%, #7A8896 100%)'"
                           onmouseout="this.style.background='linear-gradient(135deg, #B0B8C1 0%, #8E9BA8 100%)'">
                            @if($tm_logo)
                                <img src="{{ asset('storage/'.$tm_logo) }}" style="width:28px; height:28px; object-fit:contain; flex-shrink:0;" alt="Authority Logo">
                            @else
                                {{-- TM SVG logo --}}
                                <svg viewBox="0 0 48 48" width="28" height="28" xmlns="http://www.w3.org/2000/svg" style="flex-shrink:0;">
                                    <rect width="48" height="48" fill="#1D7A3A"/>
                                    <text x="50%" y="58%" dominant-baseline="middle" text-anchor="middle"
                                          font-family="Arial Black, sans-serif" font-size="18" font-weight="900"
                                          fill="#FFFFFF" letter-spacing="-1">TM</text>
                                </svg>
                            @endif
                            Lihat Profil di Transfermarkt
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.85)" stroke-width="2.5" stroke-linecap="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        </a>
                        <span style="font-size:11px; color:#9CA3AF; font-style:italic;">Profil terverifikasi di database sepakbola internasional</span>
                    </div>
                </div>

                {{-- Info Pribadi Grid --}}
                @if(count($infos) > 0)
                <div :style="shown ? 'opacity:1;transform:translateY(0);transition:opacity 2.5s cubic-bezier(0.16,1,0.3,1) 550ms,transform 2.5s cubic-bezier(0.16,1,0.3,1) 550ms' : 'opacity:0;transform:translateY(32px)'">
                    <div style="border-top:2px solid #1A1A1A; padding-top:16px; margin-top:4px;">
                        <div style="display:grid; grid-template-columns:repeat(2, 1fr); gap:0; border:1px solid #E5E7EB; border-bottom:none;">
                            @foreach($infos as $inf)
                                <div style="padding:14px 20px; border-bottom:1px solid #E5E7EB; border-right:1px solid #E5E7EB; {{ ($loop->even) ? 'border-right:none;' : '' }} background:{{ $loop->index % 4 < 2 ? '#FFFFFF' : '#F9FAFB' }};">
                                    <div style="font-size:10px; font-weight:700; letter-spacing:1.5px; color:#6B7280; text-transform:uppercase; margin-bottom:5px;">
                                        {{ $inf['label'] }}
                                    </div>
                                    <div style="font-size:14px; font-weight:600; color:#1A1A1A;">
                                        {{ $inf['value'] }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- Riwayat Karir Timeline --}}
                @if(count($timelines) > 0)
                <div :style="shown ? 'opacity:1;transform:translateY(0);transition:opacity 2.5s cubic-bezier(0.16,1,0.3,1) 750ms,transform 2.5s cubic-bezier(0.16,1,0.3,1) 750ms' : 'opacity:0;transform:translateY(32px)'">
                    <div style="border-top:2px solid #1A1A1A; padding-top:16px;">
                        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:20px;">
                            <h3 style="font-size:13px; font-weight:800; letter-spacing:3px; text-transform:uppercase; color:#1A1A1A;">Riwayat Karir</h3>
                            @if(!$fullPage)
                            <a href="{{ url('/profil-coach-agam') }}" style="font-size:12px; font-weight:600; color:#6B7280; text-decoration:none; display:flex; align-items:center; gap:6px;"
                               onmouseover="this.style.color='#1A1A1A';" onmouseout="this.style.color='#6B7280';">
                                Lihat Semua
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="9 18 15 12 9 6"/></svg>
                            </a>
                            @endif
                        </div>

                        {{-- Timeline List --}}
                        <div class="profile-grid-list">
                            @foreach(($fullPage ? $timelines : array_slice($timelines, 0, 5)) as $tl)
                                <div style="background:#FFFFFF; padding:16px 20px; display:grid; grid-template-columns:auto 1fr auto; gap:16px; align-items:center; transition:background 150ms;"
                                     onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='#FFFFFF';">

                                    {{-- Club Logo / Initial --}}
                                    <div style="width:44px; height:44px; background:#F3F4F6; border-radius:0; display:flex; align-items:center; justify-content:center; flex-shrink:0; overflow:hidden; border:none;">
                                        @if(!empty($tl['club_logo']))
                                            <img src="{{ asset('storage/'.$tl['club_logo']) }}" alt="{{ $tl['club_name'] ?? '' }}" width="44" height="44" loading="lazy" style="width:100%; height:100%; object-fit:cover;">
                                        @else
                                            <span style="font-size:14px; font-weight:800; color:#9CA3AF;">
                                                {{ strtoupper(substr($tl['club_name'] ?? '?', 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Name & Title --}}
                                    <div style="min-width:0; word-wrap:break-word;">
                                        <div style="font-size:14px; font-weight:700; color:#1A1A1A; line-height:1.3;">{{ $tl['title'] }}</div>
                                        <div style="font-size:12px; color:#6B7280; margin-top:2px; font-weight:500;">{{ $tl['club_name'] ?? '' }}</div>
                                        @if(!empty($tl['description']))
                                            <div style="font-size:11px; color:#9CA3AF; margin-top:3px; font-style:italic;">{{ $tl['description'] }}</div>
                                        @endif
                                    </div>

                                    {{-- Year Badge --}}
                                    <div style="font-size:11px; font-weight:600; color:#6B7280; background:#F3F4F6; padding:4px 10px; border-radius:0; text-align:right; flex-shrink:0;">
                                        {{ $tl['year'] }}
                                    </div>
                                </div>
                            @endforeach

                            @if(!$fullPage && count($timelines) > 5)
                                <a href="{{ url('/profil-coach-agam') }}"
                                   style="background:#F9FAFB; padding:14px 20px; text-align:center; font-size:12px; font-weight:700; color:#6B7280; text-decoration:none; letter-spacing:1px; text-transform:uppercase; display:block; transition:all 200ms;"
                                   onmouseover="this.style.background='#1A1A1A'; this.style.color='#FFFFFF';"
                                   onmouseout="this.style.background='#F9FAFB'; this.style.color='#6B7280';">
                                    + {{ count($timelines) - 5 }} Riwayat Lainnya &rarr;
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                {{-- Pendidikan Formal --}}
                @if($fullPage && count($educations) > 0)
                <div :style="shown ? 'opacity:1;transform:translateY(0);transition:all 0.8s cubic-bezier(0.16,1,0.3,1) 0.5s' : 'opacity:0;transform:translateY(24px)'">
                    <div style="border-top:2px solid #1A1A1A; padding-top:16px;">
                        <h3 style="font-size:13px; font-weight:800; letter-spacing:3px; text-transform:uppercase; color:#1A1A1A; margin-bottom:20px;">Pendidikan Formal</h3>
                        <div class="profile-grid-list">
                            @foreach($educations as $edu)
                                <div style="background:#FFFFFF; padding:16px 20px; display:grid; grid-template-columns:auto 1fr auto; gap:16px; align-items:center; transition:background 150ms;" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='#FFFFFF';">
                                    <div style="width:44px; height:44px; background:#F3F4F6; border-radius:0; display:flex; align-items:center; justify-content:center; flex-shrink:0; overflow:hidden; border:none;">
                                        @if(!empty($edu['logo']))
                                            <img src="{{ asset('storage/'.$edu['logo']) }}" alt="{{ $edu['institution'] ?? '' }}" width="44" height="44" loading="lazy" style="width:100%; height:100%; object-fit:cover;">
                                        @else
                                            <span style="font-size:14px; font-weight:800; color:#9CA3AF;">
                                                {{ strtoupper(substr($edu['institution'] ?? '?', 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div style="min-width:0; word-wrap:break-word;">
                                        <div style="font-size:14px; font-weight:700; color:#1A1A1A; line-height:1.3;">{{ $edu['institution'] ?? '' }}</div>
                                        <div style="font-size:12px; color:#6B7280; margin-top:2px; font-weight:500;">{{ $edu['degree'] ?? '' }}</div>
                                    </div>
                                    @if(!empty($edu['year']))
                                    <div style="font-size:11px; font-weight:600; color:#6B7280; background:#F3F4F6; padding:4px 10px; border-radius:0; text-align:right; flex-shrink:0;">
                                        {{ $edu['year'] }}
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- Sertifikasi & Non Formal --}}
                @if($fullPage && count($certifications) > 0)
                <div :style="shown ? 'opacity:1;transform:translateY(0);transition:all 0.8s cubic-bezier(0.16,1,0.3,1) 0.6s' : 'opacity:0;transform:translateY(24px)'">
                    <div style="border-top:2px solid #1A1A1A; padding-top:16px;">
                        <h3 style="font-size:13px; font-weight:800; letter-spacing:3px; text-transform:uppercase; color:#1A1A1A; margin-bottom:20px;">Sertifikasi & Non Formal</h3>
                        <div class="profile-grid-list">
                            @foreach($certifications as $cert)
                                <div style="background:#FFFFFF; padding:16px 20px; display:grid; grid-template-columns:auto 1fr auto; gap:16px; align-items:center; transition:background 150ms;" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='#FFFFFF';">
                                    <div style="width:44px; height:44px; background:#F3F4F6; border-radius:0; display:flex; align-items:center; justify-content:center; flex-shrink:0; overflow:hidden; border:none;">
                                        @if(!empty($cert['logo']))
                                            <img src="{{ asset('storage/'.$cert['logo']) }}" alt="{{ $cert['title'] ?? '' }}" width="44" height="44" loading="lazy" style="width:100%; height:100%; object-fit:cover;">
                                        @else
                                            <span style="font-size:14px; font-weight:800; color:#9CA3AF;">
                                                {{ strtoupper(substr($cert['title'] ?? '?', 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div style="min-width:0; word-wrap:break-word;">
                                        <div style="font-size:14px; font-weight:700; color:#1A1A1A; line-height:1.3;">{{ $cert['title'] ?? '' }}</div>
                                    </div>
                                    @if(!empty($cert['year']))
                                    <div style="font-size:11px; font-weight:600; color:#6B7280; background:#F3F4F6; padding:4px 10px; border-radius:0; text-align:right; flex-shrink:0;">
                                        {{ $cert['year'] }}
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- Pengalaman Organisasi --}}
                @if($fullPage && count($organizations) > 0)
                <div :style="shown ? 'opacity:1;transform:translateY(0);transition:all 0.8s cubic-bezier(0.16,1,0.3,1) 0.7s' : 'opacity:0;transform:translateY(24px)'">
                    <div style="border-top:2px solid #1A1A1A; padding-top:16px;">
                        <h3 style="font-size:13px; font-weight:800; letter-spacing:3px; text-transform:uppercase; color:#1A1A1A; margin-bottom:20px;">Pengalaman Organisasi</h3>
                        <div class="profile-grid-list">
                            @foreach($organizations as $org)
                                <div style="background:#FFFFFF; padding:16px 20px; display:grid; grid-template-columns:auto 1fr auto; gap:16px; align-items:center; transition:background 150ms;" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='#FFFFFF';">
                                    <div style="width:44px; height:44px; background:#F3F4F6; border-radius:0; display:flex; align-items:center; justify-content:center; flex-shrink:0; overflow:hidden; border:none;">
                                        @if(!empty($org['logo']))
                                            <img src="{{ asset('storage/'.$org['logo']) }}" alt="{{ $org['organization'] ?? '' }}" width="44" height="44" loading="lazy" style="width:100%; height:100%; object-fit:cover;">
                                        @else
                                            <span style="font-size:14px; font-weight:800; color:#9CA3AF;">
                                                {{ strtoupper(substr($org['organization'] ?? '?', 0, 1)) }}
                                            </span>
                                        @endif
                                    </div>
                                    <div style="min-width:0; word-wrap:break-word;">
                                        <div style="font-size:14px; font-weight:700; color:#1A1A1A; line-height:1.3;">{{ $org['organization'] ?? '' }}</div>
                                        <div style="font-size:12px; color:#6B7280; margin-top:2px; font-weight:500;">{{ $org['role'] ?? '' }}</div>
                                    </div>
                                    @if(!empty($org['year']))
                                    <div style="font-size:11px; font-weight:600; color:#6B7280; background:#F3F4F6; padding:4px 10px; border-radius:0; text-align:right; flex-shrink:0;">
                                        {{ $org['year'] }}
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                {{-- Pencapaian / Prestasi --}}
                @if($fullPage && count($achievements) > 0)
                <div :style="shown ? 'opacity:1;transform:translateY(0);transition:all 0.8s cubic-bezier(0.16,1,0.3,1) 0.8s' : 'opacity:0;transform:translateY(24px)'">
                    <div style="border-top:2px solid #1A1A1A; padding-top:16px;">
                        <h3 style="font-size:13px; font-weight:800; letter-spacing:3px; text-transform:uppercase; color:#1A1A1A; margin-bottom:20px;">Pencapaian & Prestasi</h3>
                        <div class="profile-grid-list">
                            @foreach($achievements as $ach)
                                <div style="background:#FFFFFF; padding:16px 20px; display:grid; grid-template-columns:auto 1fr auto; gap:16px; align-items:center; transition:background 150ms;" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='#FFFFFF';">
                                    <div style="width:24px; height:24px; background:#F3F4F6; border-radius:0; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#F59E0B" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path><path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path><path d="M4 22h16"></path><path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path><path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path><path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path></svg>
                                    </div>
                                    <div style="min-width:0; word-wrap:break-word;">
                                        <div style="font-size:14px; font-weight:700; color:#1A1A1A; line-height:1.3;">{{ $ach['title'] ?? '' }}</div>
                                    </div>
                                    @if(!empty($ach['year']))
                                    <div style="font-size:11px; font-weight:600; color:#6B7280; background:#F3F4F6; padding:4px 10px; border-radius:0; text-align:right; flex-shrink:0;">
                                        {{ $ach['year'] }}
                                    </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

            </div>
            {{-- END RIGHT COLUMN --}}

        </div>
        {{-- END MAIN GRID --}}

    </div>
</section>

<style>
    .profile-container {
        width: 100%;
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 24px;
        box-sizing: border-box;
    }
    .profile-main-grid {
        display: flex;
        flex-direction: column;
        gap: 40px;
        width: 100%;
    }
    .profile-photo-col {
        position: static;
        width: 100%;
        max-width: 420px; /* Restored to a sensible width so it fills mobile screen proportionally */
        margin: 0 auto;
    }
    .profile-content-col {
        width: 100%;
    }
    .profile-grid-list {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1px;
        background: #E5E7EB;
    }

    @media (min-width: 768px) {
        .profile-container {
            padding: 0 40px;
        }
        .profile-grid-list {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (min-width: 900px) {
        .profile-main-grid {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 56px;
            align-items: start;
        }
        .profile-photo-col {
            position: sticky;
            top: 90px;
            max-width: none;
            margin: 0;
            align-self: start;
        }
    }
</style>
