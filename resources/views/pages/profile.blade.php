@extends('layouts.app')

@section('title', $settings['page_profile.meta_title']->value ?? 'Coach Agam — Pelatih Sepakbola Profesional')
@section('meta_description', $settings['page_profile.meta_description']->value ?? 'Profil lengkap Coach Agam, pelatih sepakbola profesional dengan lisensi kepelatihan tinggi di Indonesia.')

@section('schema_extra')
@php
    $profileImg = $settings['page_profile.image']->value ?? null;
    $profileImgUrl = $profileImg ? asset('storage/'.$profileImg) : asset('images/og-default.jpg');
    $profileSocials = json_decode($settings['page_profile.socials']->value ?? '[]', true);
    $profileSameAs = collect($profileSocials)->pluck('link')->filter()->values()->all();
    array_unshift($profileSameAs, 'https://www.transfermarkt.co.id/agam-pambudi/profil/trainer/105024');
@endphp

{{-- 1. PERSON SCHEMA — Lengkap untuk Knowledge Panel Google --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org/",
  "@@type": "Person",
  "name": "Agam Haris Pambudi, S.Pd., M.Kes.",
  "alternateName": "Coach Agam",
  "birthDate": "1993-07-18",
  "birthPlace": {
    "@@type": "Place",
    "name": "Lamongan, Jawa Timur, Indonesia"
  },
  "jobTitle": "Pelatih Fisik Sepakbola Profesional",
  "image": "{{ $profileImgUrl }}",
  "url": "{{ url('/profil-coach-agam') }}",
  "sameAs": {!! json_encode($profileSameAs) !!},
  "hasCredential": {
    "@@type": "EducationalOccupationalCredential",
    "credentialCategory": "Lisensi Kepelatihan",
    "name": "Lisensi A — AFC"
  },
  "worksFor": {
    "@@type": "SportsTeam",
    "name": "Garudayaksa FC"
  },
  "description": "{{ addslashes($settings['page_profile.meta_description']->value ?? 'Coach Agam adalah pelatih sepakbola profesional berlisensi AFC A asal Lamongan, Indonesia.') }}",
  "knowsAbout": [
    "Football Coaching", "Sport Science", "Youth Development",
    "Tactical Analysis", "Strength and Conditioning", "AHP Training"
  ],
  "nationality": {
    "@@type": "Country",
    "name": "Indonesia"
  }
}
</script>

{{-- 2. BREADCRUMB SCHEMA --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "BreadcrumbList",
  "itemListElement": [
    {"@@type": "ListItem", "position": 1, "name": "Beranda", "item": "{{ url('/') }}"},
    {"@@type": "ListItem", "position": 2, "name": "Profil Coach Agam", "item": "{{ url('/profil-coach-agam') }}"}
  ]
}
</script>

{{-- 3. FAQPAGE SCHEMA — Paling berdampak untuk AI & Featured Snippets --}}
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "FAQPage",
  "mainEntity": [
    {
      "@@type": "Question",
      "name": "Apa latar belakang kepelatihan Coach Agam?",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "Coach Agam adalah pelatih sepakbola bersertifikat dengan Lisensi A — AFC. Beliau telah berpengalaman lebih dari 10 tahun melatih pemain dari berbagai level, mulai dari akademi junior hingga tim senior profesional di Indonesia, sejak memulai karir di Perspin Pinrang pada 2019."
      }
    },
    {
      "@@type": "Question",
      "name": "Apakah Coach Agam tersedia untuk melatih tim atau klub saya?",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "Ya, Coach Agam membuka kesempatan kerjasama pelatihan untuk tim, akademi, maupun sekolah sepakbola. Hubungi kami melalui WhatsApp atau email untuk mendiskusikan program yang sesuai dengan kebutuhan Anda."
      }
    },
    {
      "@@type": "Question",
      "name": "Program latihan apa saja yang ditawarkan Coach Agam?",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "Tersedia berbagai program seperti: Program Individual Player Development, Program Tim Training (pre-season & in-season), AHP Training (Agility, Heading, Passing), dan Program Modul Kepelatihan untuk para pelatih muda yang ingin meningkatkan kualitas coaching mereka."
      }
    },
    {
      "@@type": "Question",
      "name": "Di mana Coach Agam aktif berlatih dan beroperasi?",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "Coach Agam berbasis di Indonesia dan aktif di berbagai kota. Saat ini aktif sebagai Pelatih Fisik Garudayaksa FC sejak 17 Maret 2026. Untuk program intensif atau kerjasama jangka panjang, lokasi dapat disesuaikan dengan kesepakatan bersama."
      }
    },
    {
      "@@type": "Question",
      "name": "Bagaimana cara bergabung dengan program pelatihan Coach Agam?",
      "acceptedAnswer": {
        "@@type": "Answer",
        "text": "Cara termudah adalah dengan menghubungi Coach Agam langsung melalui WhatsApp yang tertera di halaman ini. Tim kami akan segera merespons dan membantu Anda memilih program yang paling sesuai."
      }
    }
  ]
}
</script>
@endsection

@section('content')
    <x-breadcrumb 
        title="{{ $settings['page_profile.headline']->value ?? 'Profil Coach Agam' }}"
        subtitle="{{ $settings['page_profile.subheadline']->value ?? 'Lebih dekat dengan karir dan pengalaman' }}"
        image="{{ $__globalBreadcrumbImage }}"
        :links="['Beranda' => '/', 'Profil' => '']"
    />

    <div style="background-color:#FFFFFF;">
        <x-profile-section :settings="$settings" :fullPage="true" />
    </div>

    {{-- FAQ Section --}}
    <section style="background:#FFFFFF; padding:80px 0;" x-data="{ openFaq: null }">
        <div class="profile-container">
            
            {{-- Section Header (Uniform with Profile) --}}
            <div style="text-align:center; margin-bottom:40px;">
                <span style="display:inline-block; font-size:11px; font-weight:800; letter-spacing:4px; text-transform:uppercase; color:#6B7280; border-top:2px solid #1A1A1A; border-bottom:2px solid #1A1A1A; padding:6px 20px;">
                    FAQ
                </span>
            </div>
            
            {{-- Title & Description --}}
            <div style="text-align:center; max-width:860px; margin:0 auto 60px;">
                <h2 style="font-size:clamp(24px, 2.5vw, 38px); font-weight:800; line-height:1.2; color:#0D0D0D; letter-spacing:-0.5px; margin-bottom:20px;">
                    Pertanyaan yang Sering Diajukan
                </h2>
                <p style="font-size:15px; line-height:1.8; color:#4B5563; max-width:720px; margin:0 auto;">
                    Agam Haris Pambudi, S.Pd., M.Kes. atau dikenal sebagai <strong>Coach Agam</strong> adalah pelatih sepakbola profesional berlisensi <strong>Lisensi A — AFC</strong> asal Lamongan, Indonesia, lahir 18 Juli 1993. Memulai karir kepelatihan sejak 2019, beliau telah berpengalaman di berbagai level hingga kini aktif sebagai Pelatih Fisik Garudayaksa FC (2026).
                    Profil resminya tersedia di <a href="{{ $settings['page_profile.tm_link']->value ?? 'https://www.transfermarkt.co.id/agam-pambudi/profil/trainer/105024' }}" target="_blank" rel="noopener" style="color:#1A1A1A; font-weight:600;">transfermarkt.co.id</a>.
                </p>
            </div>

            @php
            $faqs = [
                [
                    'q' => 'Apa latar belakang kepelatihan Coach Agam?',
                    'a' => 'Coach Agam adalah pelatih sepakbola bersertifikat dengan Lisensi A — AFC. Beliau telah berpengalaman lebih dari 10 tahun melatih pemain dari berbagai level, mulai dari akademi junior hingga tim senior profesional di Indonesia, sejak memulai karir di Perspin Pinrang pada 2019.'
                ],
                [
                    'q' => 'Apakah Coach Agam tersedia untuk melatih tim atau klub saya?',
                    'a' => 'Ya, Coach Agam membuka kesempatan kerjasama pelatihan untuk tim, akademi, maupun sekolah sepakbola. Hubungi kami melalui WhatsApp atau email untuk mendiskusikan program yang sesuai dengan kebutuhan Anda.'
                ],
                [
                    'q' => 'Program latihan apa saja yang ditawarkan?',
                    'a' => 'Tersedia berbagai program seperti: Program Individual Player Development, Program Tim Training (pre-season & in-season), AHP Training (Agility, Heading, Passing), dan Program Modul Kepelatihan untuk para pelatih muda yang ingin meningkatkan kualitas coaching mereka.'
                ],
                [
                    'q' => 'Di mana Coach Agam aktif berlatih dan beroperasi?',
                    'a' => 'Coach Agam berbasis di Indonesia dan aktif di berbagai kota. Untuk program intensif atau kerjasama jangka panjang, lokasi dapat disesuaikan dengan kesepakatan bersama.'
                ],
                [
                    'q' => 'Bagaimana cara bergabung dengan program pelatihan Coach Agam?',
                    'a' => 'Cara termudah adalah dengan menghubungi Coach Agam langsung melalui WhatsApp yang tertera di halaman ini. Tim kami akan segera merespons dan membantu Anda memilih program yang paling sesuai.'
                ],
            ];
            @endphp

            <div style="display:flex; flex-direction:column; gap:0; max-width:860px; margin:0 auto;">
                @foreach($faqs as $i => $faq)
                <div
                    style="border-bottom: 1px solid #E5E7EB; overflow:hidden;"
                >
                    <button 
                        @click="openFaq = openFaq === {{ $i }} ? null : {{ $i }}"
                        style="width:100%; text-align:left; padding:24px 0; background:transparent; border:none; cursor:pointer; display:flex; align-items:flex-start; justify-content:space-between; gap:20px;"
                    >
                        <span 
                            style="font-size:clamp(15px, 2vw, 16px); font-weight:700; line-height:1.5; transition:color 200ms; text-align:left;"
                            :style="openFaq === {{ $i }} ? 'color:#6B7280' : 'color:#1A1A1A'"
                        >{{ $faq['q'] }}</span>
                        
                        {{-- Toggle Icon: plus/minus --}}
                        <span style="flex-shrink:0; display:flex; align-items:center; justify-content:center; margin-top:2px; width:24px; height:24px; background:#1A1A1A; border-radius:50%;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.5" stroke-linecap="round">
                                <line x1="12" y1="5" x2="12" y2="19" :style="openFaq === {{ $i }} ? 'display:none' : ''"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                    </button>
                    
                    <div x-show="openFaq === {{ $i }}" x-collapse>
                        <div style="padding:0 0 28px; padding-right:52px;">
                            <p style="font-size:15px; color:#4B5563; line-height:1.8; margin:0;">{{ $faq['a'] }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
    </section>

    <style>
    @media (max-width: 768px) {
        /* Profile page mobile fixes */
        .profile-grid {
            grid-template-columns: 1fr !important;
        }
        .profile-stats-row {
            grid-template-columns: 1fr 1fr !important;
        }
        .timeline-item {
            flex-direction: column !important;
            gap: 8px !important;
        }
    }
    </style>

    {{-- CTA Kerjasama --}}
    <x-cta-kerjasama />

@endsection
