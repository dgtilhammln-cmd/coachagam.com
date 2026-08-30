{{--
    Admin Sidebar — Brutalism-Minimalist Design
    Tema: Light (Putih Mutlak), Font Montserrat, 0px border-radius
--}}

@php
    $__sidebarLogo = \App\Models\SiteSetting::where('key','general.logo')->value('value');
    $isSettings    = request()->routeIs('admin.settings.*');
    $isPages       = request()->routeIs('admin.pages.*');
    $isAhp         = request()->routeIs('admin.ahp.*');
@endphp

<aside
    id="admin-sidebar"
    aria-label="Navigasi admin"
    style="
        position:fixed; top:0; left:0; bottom:0; width:256px; z-index:100;
        background:#121212;
        border-right:1px solid #333333;
        display:flex; flex-direction:column;
        overflow-y:auto; overflow-x:hidden;
        scrollbar-width:thin;
        scrollbar-color:#E0E0E0 transparent;
        font-family:'Montserrat', sans-serif;
    "
>

{{-- ═══ BRAND ══════════════════════════════════════════════════ --}}
<div style="padding:20px 18px 16px; border-bottom:1px solid #333333; flex-shrink:0;">
    <a href="{{ route('admin.dashboard') }}" style="display:flex;align-items:center;gap:11px;text-decoration:none;">
        @if($__sidebarLogo)
            <img src="{{ asset('storage/'.$__sidebarLogo) }}" alt="Logo"
                 style="height:30px;max-width:130px;object-fit:contain;">
        @else
            <div style="width:32px;height:32px;background:#1A1A1A;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
                </svg>
            </div>
            <div>
                <div style="font-size:13px;font-weight:600;color:#FFFFFF;letter-spacing:-0.01em;line-height:1.2;">Coach Agam</div>
                <div style="font-size:9px;color:#A0A0A0;letter-spacing:0.1em;text-transform:uppercase;margin-top:1px;font-weight:500;">Admin Panel</div>
            </div>
        @endif
    </a>
</div>

{{-- ═══ NAVIGATION ═══════════════════════════════════════════════ --}}
<nav style="flex:1;padding:10px 0;overflow-y:auto;" aria-label="Menu navigasi admin">

@php
    /* helper macro — defines a single nav link */
    function sidebarLink($href, $label, $iconSvg, $isActive, $extraAttrs = '') {
        $activeStyle = $isActive
            ? 'color:#FFFFFF;font-weight:600;background:#2A2A2A;border-left:3px solid #FFFFFF;padding-left:13px;'
            : 'color:#A0A0A0;font-weight:400;border-left:3px solid transparent;padding-left:13px;';
        return ""; // Handled inline below
    }
@endphp

    {{-- ── SECTION LABEL ─── --}}
    <p style="font-size:9px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:#777777;padding:8px 18px 4px;">Main</p>

    {{-- Dashboard --}}
    @php $isDash = request()->routeIs('admin.dashboard'); @endphp
    <a href="{{ route('admin.dashboard') }}"
       style="
           display:flex;align-items:center;gap:10px;
           padding:8px 16px;margin-bottom:1px;
           text-decoration:none;font-size:12.5px;
           {{ $isDash ? 'color:#FFFFFF;font-weight:600;background:#2A2A2A;border-left:3px solid #FFFFFF;' : 'color:#A0A0A0;font-weight:400;border-left:3px solid transparent;' }}
           transition:all 200ms cubic-bezier(0.22,1,0.36,1);
       "
       onmouseover="if(!{{ $isDash ? 'true' : 'false' }}){this.style.color='#FFFFFF';this.style.background='#1F1F1F';}"
       onmouseout="if(!{{ $isDash ? 'true' : 'false' }}){this.style.color='#A0A0A0';this.style.background='transparent';}"
    >
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="{{ $isDash ? '#FFFFFF' : '#777777' }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/>
            <rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/>
        </svg>
        Dashboard
    </a>

    {{-- Lihat Website --}}
    <a href="{{ route('home') }}" target="_blank" rel="noopener"
       style="
           display:flex;align-items:center;gap:10px;
           padding:8px 16px;margin-bottom:1px;
           text-decoration:none;font-size:12.5px;
           color:#A0A0A0;font-weight:400;border-left:3px solid transparent;
           transition:all 200ms;
       "
       onmouseover="this.style.color='#FFFFFF';this.style.background='#1F1F1F';"
       onmouseout="this.style.color='#A0A0A0';this.style.background='transparent';"
    >
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#777777" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
            <polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
        </svg>
        <span style="flex:1;">Lihat Website</span>
        <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#777777" stroke-width="2.2" aria-hidden="true">
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
        </svg>
    </a>

    <div style="height:1px;background:#333333;margin:10px 0;"></div>

    {{-- ── SECTION LABEL AHP ─── --}}
    <p style="font-size:9px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:#777777;padding:8px 18px 4px;">AHP Training</p>

    {{-- AHP Training CMS --}}
    <div x-data="{ open_ahp: {{ $isAhp ? 'true' : 'false' }} }">
        <button @click="open_ahp = !open_ahp" :aria-expanded="open_ahp"
            style="
                width:100%;display:flex;align-items:center;gap:10px;
                padding:8px 16px;
                {{ $isAhp ? 'background:#2A2A2A;border-left:3px solid #FFFFFF;color:#FFFFFF;font-weight:600;' : 'border-left:3px solid transparent;color:#A0A0A0;font-weight:400;' }}
                border-top:none;border-right:none;border-bottom:none;
                text-align:left;cursor:pointer;
                font-size:12.5px;font-family:'Montserrat',sans-serif;
                transition:all 200ms;
            ">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="{{ $isAhp ? '#FFFFFF' : '#777777' }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
            </svg>
            <span style="flex:1;">AHP Training CMS</span>
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#777777" stroke-width="2.5"
                 :style="open_ahp ? 'transform:rotate(180deg)' : ''" style="transition:transform 250ms;flex-shrink:0;">
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </button>
        <div x-show="open_ahp" x-collapse style="background:#1A1A1A;border-left:3px solid #333333;">
            @php $isAhpDash = request()->routeIs('admin.ahp.dashboard'); @endphp
            <a href="{{ route('admin.ahp.dashboard') }}"
               style="display:flex;align-items:center;padding:7px 16px 7px 32px;font-size:12px;text-decoration:none;{{ $isAhpDash ? 'color:#FFFFFF;font-weight:600;' : 'color:#A0A0A0;font-weight:400;' }} transition:color 150ms;">
               Dashboard
            </a>
            @php $isAhpPlayers = request()->routeIs('admin.ahp.players.*'); @endphp
            <a href="{{ route('admin.ahp.players.index') }}"
               style="display:flex;align-items:center;padding:7px 16px 7px 32px;font-size:12px;text-decoration:none;{{ $isAhpPlayers ? 'color:#FFFFFF;font-weight:600;' : 'color:#A0A0A0;font-weight:400;' }} transition:color 150ms;">
               Pemain
            </a>
            @php $isAhpSessions = request()->routeIs('admin.ahp.sessions.*') || request()->routeIs('admin.ahp.results.*'); @endphp
            <a href="{{ route('admin.ahp.sessions.index') }}"
               style="display:flex;align-items:center;padding:7px 16px 7px 32px;font-size:12px;text-decoration:none;{{ $isAhpSessions ? 'color:#FFFFFF;font-weight:600;' : 'color:#A0A0A0;font-weight:400;' }} transition:color 150ms;">
               Sesi & Test
            </a>
            <a href="{{ route('ahp.search') }}" target="_blank" rel="noopener"
               style="display:flex;align-items:center;padding:7px 16px 7px 32px;font-size:12px;text-decoration:none;color:#A0A0A0;font-weight:400;transition:color 150ms;">
               Lihat Halaman Publik ↗
            </a>
        </div>
    </div>

    <div style="height:1px;background:#333333;margin:10px 0;"></div>

    {{-- ── SECTION LABEL ─── --}}
    <p style="font-size:9px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:#777777;padding:8px 18px 4px;">Konten</p>

    {{-- ── CRM MODULE ─────────────────────────────────── --}}
    @php $isCrm = request()->routeIs('admin.crm.*'); @endphp
    <a href="{{ route('admin.crm.index') }}"
       style="
           display:flex;align-items:center;gap:10px;
           padding:8px 16px;margin-bottom:1px;
           text-decoration:none;font-size:12.5px;
           {{ $isCrm ? 'color:#FFFFFF;font-weight:600;background:#2A2A2A;border-left:3px solid #FFFFFF;' : 'color:#A0A0A0;font-weight:400;border-left:3px solid transparent;' }}
           transition:all 200ms;
       "
       onmouseover="if(!{{ $isCrm ? 'true' : 'false' }}){this.style.color='#FFFFFF';this.style.background='#1F1F1F';}"
       onmouseout="if(!{{ $isCrm ? 'true' : 'false' }}){this.style.color='#A0A0A0';this.style.background='transparent';}"
    >
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="{{ $isCrm ? '#FFFFFF' : '#777777' }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
        </svg>
        <span style="flex:1;">CRM Lite</span>
        @php $newLeads = \App\Models\Lead::where('status', 'new')->count(); @endphp
        @if($newLeads > 0)
            <span style="background:#1A1A1A;color:#FFFFFF;font-size:9px;font-weight:700;padding:2px 6px;letter-spacing:0.04em;">{{ $newLeads }}</span>
        @endif
    </a>

    {{-- ── BLOG MODULE ─────────────────────────────────── --}}
    <div x-data="{ open_blog: {{ request()->is('admin/blog*') ? 'true' : 'false' }} }">
        <button @click="open_blog = !open_blog"
            style="
                width:100%; display:flex; align-items:center; gap:10px;
                padding:8px 16px; border:none; background:transparent; cursor:pointer;
                font-size:12.5px; font-weight:400; color:#A0A0A0;
                font-family:'Montserrat',sans-serif;
                border-left:3px solid {{ request()->is('admin/blog*') ? '#1A1A1A' : 'transparent' }};
                {{ request()->is('admin/blog*') ? 'color:#FFFFFF;font-weight:600;background:#2A2A2A;' : '' }}
                transition:all 200ms;
                text-align:left;
            "
            onmouseover="if(!{{ request()->is('admin/blog*') ? 'true' : 'false' }}){this.style.color='#FFFFFF';this.style.background='#1F1F1F';}"
            onmouseout="if(!{{ request()->is('admin/blog*') ? 'true' : 'false' }}){this.style.color='#A0A0A0';this.style.background='transparent';}"
        >
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="{{ request()->is('admin/blog*') ? '#FFFFFF' : '#777777' }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>
            </svg>
            <span style="flex:1;">Blog</span>
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#777777" stroke-width="2.5"
                 :style="open_blog ? 'transform:rotate(180deg)' : ''" style="transition:transform 250ms;flex-shrink:0;">
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </button>

        <div x-show="open_blog" x-collapse style="background:#1A1A1A;border-left:3px solid #333333;margin-left:0;">
            @php $isPosts = request()->routeIs('admin.blog.posts.*'); @endphp
            <a href="{{ route('admin.blog.posts.index') }}"
               style="display:flex;align-items:center;padding:7px 16px 7px 32px;font-size:12px;text-decoration:none;{{ $isPosts ? 'color:#FFFFFF;font-weight:600;' : 'color:#A0A0A0;font-weight:400;' }} transition:color 150ms;">
               Semua Artikel
            </a>
            @php $isCats = request()->routeIs('admin.blog.categories.*'); @endphp
            <a href="{{ route('admin.blog.categories.index') }}"
               style="display:flex;align-items:center;padding:7px 16px 7px 32px;font-size:12px;text-decoration:none;{{ $isCats ? 'color:#FFFFFF;font-weight:600;' : 'color:#A0A0A0;font-weight:400;' }} transition:color 150ms;">
               Kategori
            </a>
        </div>
    </div>

    <div style="height:1px;background:#333333;margin:10px 0;"></div>

    {{-- ── SECTION LABEL ─── --}}
    <p style="font-size:9px;font-weight:600;letter-spacing:0.14em;text-transform:uppercase;color:#777777;padding:8px 18px 4px;">Pengaturan</p>

    {{-- ── SETTINGS ─────────────────────────────────── --}}
    <div x-data="{ open: {{ $isSettings ? 'true' : 'false' }} }">
        <button @click="open = !open" :aria-expanded="open"
            style="
                width:100%;display:flex;align-items:center;gap:10px;
                padding:8px 16px;
                {{ $isSettings ? 'background:#2A2A2A;border-left:3px solid #FFFFFF;color:#FFFFFF;font-weight:600;' : 'border-left:3px solid transparent;color:#A0A0A0;font-weight:400;' }}
                border-top:none;border-right:none;border-bottom:none;
                text-align:left;cursor:pointer;
                font-size:12.5px;font-family:'Montserrat',sans-serif;
                transition:all 200ms;
            "
            onmouseover="if(!{{ $isSettings ? 'true' : 'false' }}){this.style.color='#FFFFFF';this.style.background='#1F1F1F';}"
            onmouseout="if(!{{ $isSettings ? 'true' : 'false' }}){this.style.color='#A0A0A0';this.style.background='transparent';}"
        >
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="{{ $isSettings ? '#FFFFFF' : '#777777' }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <circle cx="12" cy="12" r="3"/>
                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>
            </svg>
            <span style="flex:1;">Site Settings</span>
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#777777" stroke-width="2.5"
                 :style="open ? 'transform:rotate(180deg)' : ''" style="transition:transform 250ms;flex-shrink:0;">
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </button>

        <div x-show="open" x-collapse style="background:#1A1A1A;border-left:3px solid #333333;">
            @php $isGen = request()->routeIs('admin.settings.general'); @endphp
            <a href="{{ route('admin.settings.general') }}"
               style="display:flex;align-items:center;padding:7px 16px 7px 32px;font-size:12px;text-decoration:none;{{ $isGen ? 'color:#FFFFFF;font-weight:600;' : 'color:#A0A0A0;font-weight:400;' }} transition:color 150ms;">
               General
            </a>
            @php $isHdr = request()->routeIs('admin.settings.header'); @endphp
            <a href="{{ route('admin.settings.header') }}"
               style="display:flex;align-items:center;padding:7px 16px 7px 32px;font-size:12px;text-decoration:none;{{ $isHdr ? 'color:#FFFFFF;font-weight:600;' : 'color:#A0A0A0;font-weight:400;' }} transition:color 150ms;">
               Header
            </a>
        </div>
    </div>

    {{-- ── PAGE MANAGEMENT ─────────────────────────── --}}
    <div x-data="{ open_pm: {{ $isPages ? 'true' : 'false' }} }">
        <button @click="open_pm = !open_pm" :aria-expanded="open_pm"
            style="
                width:100%;display:flex;align-items:center;gap:10px;
                padding:8px 16px;
                {{ $isPages ? 'background:#2A2A2A;border-left:3px solid #FFFFFF;color:#FFFFFF;font-weight:600;' : 'border-left:3px solid transparent;color:#A0A0A0;font-weight:400;' }}
                border-top:none;border-right:none;border-bottom:none;
                text-align:left;cursor:pointer;
                font-size:12.5px;font-family:'Montserrat',sans-serif;
                transition:all 200ms;
            "
            onmouseover="if(!{{ $isPages ? 'true' : 'false' }}){this.style.color='#FFFFFF';this.style.background='#1F1F1F';}"
            onmouseout="if(!{{ $isPages ? 'true' : 'false' }}){this.style.color='#A0A0A0';this.style.background='transparent';}"
        >
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="{{ $isPages ? '#FFFFFF' : '#777777' }}" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/>
            </svg>
            <span style="flex:1;">Halaman</span>
            <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="#777777" stroke-width="2.5"
                 :style="open_pm ? 'transform:rotate(180deg)' : ''" style="transition:transform 250ms;flex-shrink:0;">
                <polyline points="6 9 12 15 18 9"/>
            </svg>
        </button>

        <div x-show="open_pm" x-collapse style="background:#1A1A1A;border-left:3px solid #333333;">
            @foreach([
                ['admin.settings.homepage', 'Homepage'],
                ['admin.pages.profile',     'Profile Coach'],
                ['admin.pages.gallery',     'Gallery'],
                ['admin.pages.ahp-training','AHP Training'],
                ['admin.pages.footer',      'Footer'],
            ] as [$routeName, $pageLabel])
            @php $isActive = request()->routeIs($routeName); @endphp
            <a href="{{ route($routeName) }}"
               style="display:flex;align-items:center;padding:7px 16px 7px 32px;font-size:12px;text-decoration:none;{{ $isActive ? 'color:#FFFFFF;font-weight:600;' : 'color:#A0A0A0;font-weight:400;' }} transition:color 150ms;">
               {{ $pageLabel }}
            </a>
            @endforeach
            @foreach([
                ['admin.pages.generic', ['page' => 'modul'], 'Modul Kepelatihan'],
                ['admin.pages.generic', ['page' => 'kontak'], 'Kontak'],
            ] as [$routeName, $routeParams, $pageLabel])
            @php $isActive = request()->routeIs($routeName) && request()->is('admin/pages/'.($routeParams['page'] ?? '')); @endphp
            <a href="{{ route($routeName, $routeParams) }}"
               style="display:flex;align-items:center;padding:7px 16px 7px 32px;font-size:12px;text-decoration:none;{{ $isActive ? 'color:#FFFFFF;font-weight:600;' : 'color:#A0A0A0;font-weight:400;' }} transition:color 150ms;">
               {{ $pageLabel }}
            </a>
            @endforeach
        </div>
    </div>

</nav>

{{-- ═══ USER FOOTER ═══════════════════════════════════════════════ --}}
<div style="padding:12px 16px;border-top:1px solid #333333;flex-shrink:0;">

    {{-- User info --}}
    <div style="display:flex;align-items:center;gap:10px;padding:10px 0;margin-bottom:8px;">
        <div style="
            width:30px;height:30px;
            background:#1A1A1A;
            display:flex;align-items:center;justify-content:center;
            font-size:11px;font-weight:700;color:#FFFFFF;
            font-family:'Montserrat',sans-serif;
            flex-shrink:0;
        " aria-hidden="true">
            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
        </div>
        <div style="min-width:0;flex:1;">
            <div style="font-size:12px;font-weight:500;color:#FFFFFF;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                {{ auth()->user()->name ?? 'Administrator' }}
            </div>
            <div style="font-size:10px;color:#A0A0A0;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;margin-top:1px;">
                {{ auth()->user()->email ?? '' }}
            </div>
        </div>
    </div>

    {{-- Logout --}}
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit"
            style="
                width:100%;display:flex;align-items:center;justify-content:center;gap:8px;
                padding:8px 12px;
                background:transparent;border:1px solid #444444;
                color:#A0A0A0;font-size:11px;font-weight:600;
                font-family:'Montserrat',sans-serif;letter-spacing:0.06em;text-transform:uppercase;
                cursor:pointer;transition:all 200ms;
            "
            onmouseover="this.style.background='#1A1A1A';this.style.borderColor='#1A1A1A';this.style.color='#FFFFFF';"
            onmouseout="this.style.background='transparent';this.style.borderColor='#444444';this.style.color='#A0A0A0';"
        >
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                <polyline points="16 17 21 12 16 7"/>
                <line x1="21" y1="12" x2="9" y2="12"/>
            </svg>
            Keluar
        </button>
    </form>
</div>

</aside>
