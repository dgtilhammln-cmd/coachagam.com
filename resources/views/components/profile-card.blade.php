@php
    // Fetch profile settings
    $settings = \App\Models\SiteSetting::where('group', 'page_profile')->pluck('value', 'key');
    
    $image   = $settings['page_profile.image'] ?? null;
    $name    = $settings['page_profile.name'] ?? 'Agam Haris Pambudi, S.Pd., M.Kes.';
    $job     = $settings['page_profile.job_title'] ?? 'Assistant Coach — PSIS Semarang';
    $tm_link = $settings['page_profile.tm_link'] ?? 'https://www.transfermarkt.co.id/agam-pambudi/profil/trainer/105024';
    $tm_logo = $settings['page_profile.tm_logo'] ?? null;
    $socials = json_decode($settings['page_profile.socials'] ?? '[]', true) ?: [];

    // Social media SVG icons map
    $socialIcons = [
        'instagram' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
        'youtube'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
        'linkedin'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
        'twitter'   => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
        'facebook'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
        'tiktok'    => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>',
        'whatsapp'  => '<svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>',
    ];

    $getSocialIcon = function(string $platform) use ($socialIcons): string {
        $key = strtolower(trim($platform));
        $key = str_replace([' ', '-', '_'], '', $key);
        $key = match($key) {
            'x', 'twitter', 'twitterx' => 'twitter',
            'ig'                        => 'instagram',
            'yt'                        => 'youtube',
            'fb'                        => 'facebook',
            'wa'                        => 'whatsapp',
            'in'                        => 'linkedin',
            default                     => $key,
        };
        return $socialIcons[$key] ?? '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>';
    };
@endphp

{{-- Card Wrapper --}}
<div style="background:#FFFFFF; border:1px solid #E5E7EB; border-radius:0; box-shadow:0 20px 40px rgba(0,0,0,0.08); overflow:hidden; position:relative; width:100%;">
    
    {{-- Photo with top-right icon bar overlay --}}
    <div style="position:relative; aspect-ratio:3/4; background:#E5E7EB; overflow:hidden; margin-bottom:0;">
        @if($image)
            <img itemprop="image" src="{{ asset('storage/'.$image) }}" alt="Coach Agam — {{ $name }}"
                 width="300" height="400"
                 fetchpriority="high"
                 style="width:100%; height:100%; object-fit:cover; object-position:top; filter:contrast(1.05) saturate(0.95);">
        @else
            {{-- Placeholder --}}
            <div style="width:100%; height:100%; display:flex; align-items:center; justify-content:center; background:linear-gradient(160deg, #1A1A1A 0%, #3A3A3A 100%);">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="1" stroke-linecap="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
        @endif

        {{-- TOP-RIGHT: Social Icons + Download — Silver box bar --}}
        <div style="position:absolute; top:0; right:0; display:flex; flex-direction:column; gap:1px; background:#C0C0C0;">
            {{-- Download CV icon --}}
            <a href="{{ route('profil.cv') }}" target="_blank" rel="noopener"
               title="Download CV / Resume"
               style="width:40px; height:40px; display:flex; align-items:center; justify-content:center; background:#1A1A1A; color:#FFFFFF; text-decoration:none; transition:background 200ms; flex-shrink:0;"
               onmouseover="this.style.background='#374151'"
               onmouseout="this.style.background='#1A1A1A'">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line x1="12" y1="15" x2="12" y2="3"></line>
                </svg>
            </a>
            {{-- Social icons --}}
            @foreach($socials as $soc)
                <a href="{{ $soc['link'] }}" target="_blank" rel="noopener noreferrer"
                   title="{{ $soc['platform'] }}"
                   style="width:40px; height:40px; display:flex; align-items:center; justify-content:center; background:#D0D0D0; color:#1A1A1A; text-decoration:none; transition:all 200ms; flex-shrink:0;"
                   onmouseover="this.style.background='#1A1A1A'; this.style.color='#FFFFFF';"
                   onmouseout="this.style.background='#D0D0D0'; this.style.color='#1A1A1A';">
                    {!! $getSocialIcon($soc['platform']) !!}
                </a>
            @endforeach
            {{-- WA CRM Icon --}}
            <a href="{{ $__ft_wa_url ?? '#' }}" target="_blank" rel="noopener"
               title="WhatsApp"
               x-data
               @click.prevent="$dispatch('open-wa-popup', { url: '{{ $__ft_wa_url ?? '' }}' })"
               style="width:40px; height:40px; display:flex; align-items:center; justify-content:center; background:#D0D0D0; color:#1A1A1A; text-decoration:none; transition:all 200ms; flex-shrink:0;"
               onmouseover="this.style.background='#1A1A1A'; this.style.color='#FFFFFF';"
               onmouseout="this.style.background='#D0D0D0'; this.style.color='#1A1A1A';">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>
            </a>
        </div>

        {{-- Overlay badge — name bottom --}}
        <div style="position:absolute; bottom:0; left:0; right:0; padding:20px 20px 16px; background:linear-gradient(to top, rgba(0,0,0,0.85), transparent);">
            <div itemprop="name" style="font-size:18px; font-weight:800; color:#FFFFFF; line-height:1.2; letter-spacing:-0.3px;">{{ $name }}</div>
            <div itemprop="jobTitle" style="font-size:12px; color:rgba(255,255,255,0.65); margin-top:4px; font-weight:500;">{{ $job }}</div>
        </div>
    </div>

    {{-- Lisensi Badge --}}
    <div style="background:#1A1A1A; padding:14px 20px; display:flex; align-items:center; gap:12px;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#C0C0C0" stroke-width="1.5" stroke-linecap="round"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
        <div>
            <div style="font-size:10px; color:#6B7280; font-weight:700; letter-spacing:1px; text-transform:uppercase;">Lisensi Kepelatihan</div>
            <div style="font-size:13px; color:#FFFFFF; font-weight:700; margin-top:2px;">Lisensi A — AFC</div>
        </div>
    </div>

    {{-- Formasi Badge --}}
    <div style="background:#FFFFFF; border:1px solid #E5E7EB; border-top:none; padding:12px 20px; display:flex; align-items:center; justify-content:space-between;">
        <div style="font-size:10px; font-weight:700; letter-spacing:1px; color:#9CA3AF; text-transform:uppercase;">Formasi Favorit</div>
        <div style="font-size:13px; font-weight:800; color:#1A1A1A; background:#F3F4F6; padding:4px 12px; border-radius:0;">4-3-3 Attacking</div>
    </div>

    {{-- Transfermarkt Authority Badge — SEO/GEO Signal --}}
    <a href="{{ $tm_link }}"
       target="_blank"
       rel="noopener"
       title="Profil {{ $name }} di Transfermarkt"
       style="display:flex; align-items:center; justify-content:space-between; gap:12px; background:linear-gradient(135deg, #B0B8C1 0%, #8E9BA8 100%); border:none; padding:14px 20px; text-decoration:none; transition:all 200ms; cursor:pointer;"
       onmouseover="this.style.background='linear-gradient(135deg, #9AA4AF 0%, #7A8896 100%)'"
       onmouseout="this.style.background='linear-gradient(135deg, #B0B8C1 0%, #8E9BA8 100%)'">

        {{-- Left: TM Logo + Label --}}
        <div style="display:flex; align-items:center; gap:10px;">
            @if($tm_logo)
                <img src="{{ asset('storage/'.$tm_logo) }}" style="width:36px; height:36px; object-fit:contain; flex-shrink:0;" alt="Authority Logo">
            @else
                <svg viewBox="0 0 48 48" width="36" height="36" xmlns="http://www.w3.org/2000/svg" style="flex-shrink:0;">
                    <rect width="48" height="48" rx="0" fill="#1D7A3A"/>
                    <text x="50%" y="58%" dominant-baseline="middle" text-anchor="middle"
                          font-family="Arial Black, sans-serif" font-size="18" font-weight="900"
                          fill="#FFFFFF" letter-spacing="-1">TM</text>
                </svg>
            @endif
            <div>
                <div style="font-size:9px; font-weight:700; letter-spacing:2px; text-transform:uppercase; color:rgba(255,255,255,0.75); margin-bottom:2px;">Profil Resmi</div>
                <div style="font-size:13px; font-weight:800; color:#FFFFFF; line-height:1;">Transfermarkt</div>
            </div>
        </div>

        {{-- Right: Arrow --}}
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.8)" stroke-width="2" stroke-linecap="round">
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
            <polyline points="15 3 21 3 21 9"/>
            <line x1="10" y1="14" x2="21" y2="3"/>
        </svg>
    </a>
</div>
