@php
    $s = function($key, $default = null) use ($settings) {
        if (is_object($settings) && method_exists($settings, 'get')) {
            $item = $settings->get($key);
            return $item ? ($item->value ?? $default) : $default;
        }
        return isset($settings[$key]) ? ($settings[$key]->value ?? $default) : $default;
    };

    $headline    = $s('page_profile.headline', 'Membentuk Karakter & Mental Juara di Lapangan Hijau');
    $desc1       = $s('page_profile.description_1', '');
    $image       = $s('page_profile.image', null);
    $timelines   = json_decode($s('page_profile.timelines', '[]'), true) ?: [];
    $infos       = json_decode($s('page_profile.infos', '[]'), true) ?: [];
    $educations     = json_decode($s('page_profile.educations', '[]'), true) ?: [];
    $certifications = json_decode($s('page_profile.certifications', '[]'), true) ?: [];
    $organizations  = json_decode($s('page_profile.organizations', '[]'), true) ?: [];
    $achievements   = json_decode($s('page_profile.achievements', '[]'), true) ?: [];
    $socials        = json_decode($s('page_profile.socials', '[]'), true) ?: [];
    $tm_link        = $s('page_profile.tm_link', 'https://www.transfermarkt.co.id/agam-pambudi/profil/trainer/105024');

    // Social media SVG icons map
    $socialIcons = [
        'instagram' => '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>',
        'youtube'   => '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>',
        'linkedin'  => '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>',
        'twitter'   => '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>',
        'facebook'  => '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>',
        'tiktok'    => '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/></svg>',
        'telegram'  => '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>',
        'whatsapp'  => '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413z"/></svg>',
    ];

    $getSocialIcon = function($platform) use ($socialIcons) {
        $key = strtolower(trim($platform));
        $key = str_replace([' ', '-', '_'], '', $key);
        $key = match($key) {
            'x', 'twitter', 'twitterx' => 'twitter',
            'ig' => 'instagram',
            'yt' => 'youtube',
            'fb' => 'facebook',
            'wa' => 'whatsapp',
            'tg' => 'telegram',
            default => $key,
        };
        return $socialIcons[$key] ?? '<svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm1 15H11v-2h2zm0-4H11V7h2z"/></svg>';
    };
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV / Resume - {{ collect($infos)->firstWhere('label', 'Nama Lengkap')['value'] ?? 'Coach Agam' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #FFFFFF;
            --text: #1A1A1A;
            --gray: #6B7280;
            --light-gray: #F3F4F6;
            --border: #E5E7EB;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Montserrat', sans-serif;
            background: #F8F8F8;
            color: var(--text);
            line-height: 1.6;
        }
        .action-bar {
            position: fixed;
            top: 0; left: 0; right: 0;
            background: #1A1A1A;
            color: #FFFFFF;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 100;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn-download {
            background: #FFFFFF;
            color: #1A1A1A;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 200ms;
        }
        .btn-download:hover {
            background: #E5E7EB;
        }
        .cv-container {
            width: 210mm; /* A4 width */
            min-height: 297mm; /* A4 height */
            background: var(--bg);
            margin: 80px auto 40px;
            padding: 20mm;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }
        .header {
            display: flex;
            gap: 30px;
            border-bottom: 2px solid var(--text);
            padding-bottom: 24px;
            margin-bottom: 24px;
        }
        .photo {
            width: 140px;
            height: 140px;
            object-fit: cover;
            object-position: top center;
            border-radius: 0;
            background: var(--light-gray);
            border: none;
        }
        .header-content { flex: 1; }
        .name {
            font-size: 32px;
            font-weight: 700;
            letter-spacing: -0.5px;
            line-height: 1.1;
            margin-bottom: 8px;
        }
        .job-title {
            font-size: 15px;
            font-weight: 500;
            color: var(--gray);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 20px;
        }
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px 16px;
            font-size: 11px;
            line-height: 1.4;
        }
        .contact-item {
            display: flex;
            flex-direction: column;
            gap: 2px;
        }
        .contact-item-label {
            color: var(--gray); 
            font-weight: 500;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .contact-item-value {
            font-weight: 600;
            color: var(--text);
            word-break: break-word;
        }
        
        .section {
            margin-bottom: 28px;
        }
        .section-title {
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--text);
            background: var(--light-gray);
            padding: 10px 14px;
            margin-bottom: 16px;
        }
        .about-text {
            font-size: 12px;
            line-height: 1.8;
            font-weight: 400;
            text-align: justify;
        }
        
        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }

        .list-item {
            margin-bottom: 14px;
            page-break-inside: avoid;
        }
        .item-year {
            font-size: 11px;
            font-weight: 600;
            color: var(--gray);
            margin-bottom: 2px;
        }
        .item-title {
            font-size: 13px;
            font-weight: 600;
            line-height: 1.4;
        }
        .item-subtitle {
            font-size: 12px;
            font-weight: 400;
            color: var(--gray);
            margin-top: 2px;
        }

        /* Minimalist Social Styles */
        .social-row {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            page-break-inside: avoid;
        }
        .social-icon {
            width: 24px;
            height: 24px;
            background: var(--light-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0;
            color: var(--text);
        }
        .social-link {
            font-size: 12px;
            font-weight: 600;
            color: var(--text);
            text-decoration: none;
        }
        .social-label {
            font-size: 10px;
            color: var(--gray);
            font-weight: 500;
            display: block;
        }

        @media print {
            @page {
                size: A4;
                margin: 0;
            }
            body {
                background: none;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
            .action-bar { display: none !important; }
            .cv-container {
                margin: 0;
                padding: 15mm;
                box-shadow: none;
                width: 100%;
                min-height: 100vh;
            }
        }
        
        @media screen and (max-width: 768px) {
            .cv-container {
                width: 100%;
                padding: 20px;
                margin: 70px 0 0 0;
            }
            .header { flex-direction: column; }
            .grid-2 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

    <div class="action-bar">
        <div style="font-size:14px; font-weight:700;">Profil Coach Agam</div>
        <button class="btn-download" onclick="window.print()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Download PDF
        </button>
    </div>

    <div class="cv-container">
        
        {{-- HEADER --}}
        <div class="header">
            @if($image)
                <img src="{{ asset('storage/'.$image) }}" alt="Photo" class="photo">
            @else
                <div class="photo" style="display:flex;align-items:center;justify-content:center;font-size:40px;font-weight:900;color:#9CA3AF;">CA</div>
            @endif
            <div class="header-content">
                <div class="name">{{ collect($infos)->firstWhere('label', 'Nama Lengkap')['value'] ?? 'Agam Haris Pambudi' }}</div>
                <div class="job-title">Professional Football Coach</div>
                
                <div class="contact-grid">
                    @foreach($infos as $inf)
                        @if(in_array($inf['label'], ['Tempat/Tanggal Lahir', 'Kewarganegaraan', 'Domisili', 'Kontak', 'Lisensi Kepelatihan']))
                            <div class="contact-item">
                                <span class="contact-item-label">{{ $inf['label'] }}</span>
                                <span class="contact-item-value">{{ $inf['value'] }}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        {{-- TENTANG SAYA --}}
        @if($desc1)
        <div class="section">
            <div class="section-title">Profil Profesional</div>
            <div class="about-text">
                {!! nl2br(e($desc1)) !!}
            </div>
        </div>
        @endif

        <div class="grid-2">
            
            {{-- KOLOM KIRI --}}
            <div>
                {{-- RIWAYAT KARIR --}}
                @if(count($timelines) > 0)
                <div class="section">
                    <div class="section-title">Riwayat Karir & Kepelatihan</div>
                    @foreach($timelines as $tl)
                        <div class="list-item">
                            <div class="item-year">{{ $tl['year'] }}</div>
                            <div class="item-title">{{ $tl['title'] }}</div>
                            <div class="item-subtitle">{{ $tl['club_name'] ?? '' }}</div>
                        </div>
                    @endforeach
                </div>
                @endif
                
                {{-- PENGALAMAN ORGANISASI --}}
                @if(count($organizations) > 0)
                <div class="section">
                    <div class="section-title">Pengalaman Organisasi</div>
                    @foreach($organizations as $org)
                        <div class="list-item">
                            @if(!empty($org['year']))<div class="item-year">{{ $org['year'] }}</div>@endif
                            <div class="item-title">{{ $org['role'] }}</div>
                            <div class="item-subtitle">{{ $org['organization'] }}</div>
                        </div>
                    @endforeach
                </div>
                @endif

                {{-- SOSIAL MEDIA & LINK --}}
                @if(count($socials) > 0 || $tm_link)
                <div class="section">
                    <div class="section-title">Sosial Media & Portofolio</div>
                    @if($tm_link)
                    <div class="social-row">
                        <div class="social-icon">
                            <svg viewBox="0 0 48 48" width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                <rect width="48" height="48" rx="0" fill="#1D7A3A"/>
                                <text x="50%" y="58%" dominant-baseline="middle" text-anchor="middle" font-family="Arial Black, sans-serif" font-size="22" font-weight="900" fill="#FFFFFF" letter-spacing="-1">TM</text>
                            </svg>
                        </div>
                        <div>
                            <span class="social-label">Transfermarkt</span>
                            <a href="{{ $tm_link }}" class="social-link" target="_blank">{{ str_replace(['https://www.', 'http://www.', 'https://', 'http://'], '', $tm_link) }}</a>
                        </div>
                    </div>
                    @endif
                    @foreach($socials as $soc)
                        <div class="social-row">
                            <div class="social-icon">
                                {!! $getSocialIcon($soc['platform']) !!}
                            </div>
                            <div>
                                <span class="social-label">{{ ucfirst($soc['platform']) }}</span>
                                <a href="{{ $soc['link'] }}" class="social-link" target="_blank">{{ str_replace(['https://www.', 'http://www.', 'https://', 'http://'], '', $soc['link']) }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- KOLOM KANAN --}}
            <div>
                {{-- PENDIDIKAN FORMAL --}}
                @if(count($educations) > 0)
                <div class="section">
                    <div class="section-title">Pendidikan Formal</div>
                    @foreach($educations as $edu)
                        <div class="list-item">
                            @if(!empty($edu['year']))<div class="item-year">{{ $edu['year'] }}</div>@endif
                            <div class="item-title">{{ $edu['institution'] }}</div>
                            <div class="item-subtitle">{{ $edu['degree'] }}</div>
                        </div>
                    @endforeach
                </div>
                @endif

                {{-- SERTIFIKASI --}}
                @if(count($certifications) > 0)
                <div class="section">
                    <div class="section-title">Sertifikasi & Non Formal</div>
                    @foreach($certifications as $cert)
                        <div class="list-item">
                            @if(!empty($cert['year']))<div class="item-year">{{ $cert['year'] }}</div>@endif
                            <div class="item-title">{{ $cert['title'] }}</div>
                        </div>
                    @endforeach
                </div>
                @endif

                {{-- PRESTASI --}}
                @if(count($achievements) > 0)
                <div class="section">
                    <div class="section-title">Pencapaian & Prestasi</div>
                    @foreach($achievements as $ach)
                        <div class="list-item">
                            @if(!empty($ach['year']))<div class="item-year">{{ $ach['year'] }}</div>@endif
                            <div class="item-title">{{ $ach['title'] }}</div>
                        </div>
                    @endforeach
                </div>
                @endif
            </div>

        </div>
    </div>
</body>
</html>
