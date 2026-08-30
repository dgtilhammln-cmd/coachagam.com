<nav
    id="main-nav"
    aria-label="Main navigation"
    style="
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        height: 64px;
        background-color: rgba(15,15,15,0.95);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border-bottom: 1px solid rgba(176,176,176,0.2);
        display: flex;
        align-items: center;
    "
>
    <div style="
        width: 100%;
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    ">

        {{-- Logo --}}
        <a
            href="{{ route('home') }}"
            aria-label="Coach Agam - Home"
            style="
                display: flex;
                align-items: center;
                gap: 10px;
                text-decoration: none;
                flex-shrink: 0;
            "
        >
            <span style="
                width: 36px;
                height: 36px;
                border-radius: 8px;
                background: linear-gradient(135deg, #F0F0F0, #C0C0C0, #A8A8A8);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 18px;
                box-shadow: 0 2px 8px rgba(192,192,192,0.3);
            " aria-hidden="true">🏋️</span>
            <span style="
                font-size: 18px;
                font-weight: 700;
                background: linear-gradient(135deg, #F0F0F0, #C0C0C0, #A8A8A8);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
                letter-spacing: -0.02em;
            ">Coach Agam</span>
        </a>

        {{-- Desktop Navigation --}}
        <ul
            role="list"
            style="
                display: flex;
                align-items: center;
                gap: 32px;
                list-style: none;
                margin: 0;
                padding: 0;
            "
            class="desktop-nav"
        >
            @php
                $navLinks = [
                    ['label' => 'Home',         'route' => 'home',    'href' => '/'],
                    ['label' => 'About',        'route' => 'about',   'href' => '#about'],
                    ['label' => 'AHP Training', 'route' => 'ahp',     'href' => '#ahp-training'],
                    ['label' => 'Blog',         'route' => 'blog',    'href' => '#blog'],
                    ['label' => 'Contact',      'route' => 'contact', 'href' => '#contact'],
                ];
            @endphp

            @foreach($navLinks as $link)
                <li>
                    <a
                        href="{{ $link['href'] }}"
                        class="nav-link {{ request()->routeIs($link['route']) ? 'active' : '' }}"
                        @if($link['route'] === 'home' && request()->routeIs('home')) aria-current="page" @endif
                    >
                        {{ $link['label'] }}
                    </a>
                </li>
            @endforeach
        </ul>

        {{-- Right Side: Auth + Hamburger --}}
        <div style="display: flex; align-items: center; gap: 16px;">

            {{-- Auth Buttons --}}
            <div class="desktop-nav" style="display: flex; align-items: center; gap: 10px;">
                @auth
                    <div style="position: relative;" id="profile-dropdown-container">
                        <button
                            id="profile-btn"
                            aria-haspopup="true"
                            aria-expanded="false"
                            aria-controls="profile-menu"
                            onclick="toggleProfileMenu()"
                            style="
                                display: flex;
                                align-items: center;
                                gap: 8px;
                                background: #262626;
                                border: 1px solid rgba(176,176,176,0.3);
                                border-radius: 9999px;
                                padding: 6px 14px 6px 8px;
                                cursor: pointer;
                                color: #D3D3D3;
                                font-size: 14px;
                                font-weight: 500;
                                transition: all 150ms ease-out;
                            "
                            onmouseover="this.style.borderColor='rgba(192,192,192,0.6)'; this.style.color='#F0F0F0'"
                            onmouseout="this.style.borderColor='rgba(176,176,176,0.3)'; this.style.color='#D3D3D3'"
                        >
                            <span style="
                                width: 28px;
                                height: 28px;
                                border-radius: 50%;
                                background: linear-gradient(135deg, #F0F0F0, #C0C0C0);
                                display: flex;
                                align-items: center;
                                justify-content: center;
                                color: #0F0F0F;
                                font-size: 12px;
                                font-weight: 700;
                            " aria-hidden="true">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                            {{ auth()->user()->name }}
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>

                        <div
                            id="profile-menu"
                            role="menu"
                            aria-labelledby="profile-btn"
                            style="
                                display: none;
                                position: absolute;
                                right: 0;
                                top: calc(100% + 8px);
                                background: #1A1A1A;
                                border: 1px solid rgba(176,176,176,0.25);
                                border-radius: 12px;
                                padding: 8px;
                                min-width: 180px;
                                box-shadow: 0 8px 32px rgba(0,0,0,0.6);
                                z-index: 100;
                            "
                        >
                            <a href="/profile" role="menuitem" class="footer-link" style="display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:8px;font-size:14px;transition:background 150ms;" onmouseover="this.style.background='#262626'" onmouseout="this.style.background='transparent'">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                                My Profile
                            </a>
                            <a href="/dashboard" role="menuitem" class="footer-link" style="display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:8px;font-size:14px;transition:background 150ms;" onmouseover="this.style.background='#262626'" onmouseout="this.style.background='transparent'">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
                                Dashboard
                            </a>
                            <hr style="border:none;border-top:1px solid rgba(176,176,176,0.15);margin:6px 0;">
                            <form method="POST" action="/logout">
                                @csrf
                                <button type="submit" role="menuitem" style="width:100%;display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:8px;font-size:14px;background:transparent;border:none;color:#A3A3A3;cursor:pointer;transition:all 150ms;" onmouseover="this.style.background='rgba(239,68,68,0.1)';this.style.color='#EF4444'" onmouseout="this.style.background='transparent';this.style.color='#A3A3A3'">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="/login" class="btn btn-ghost btn-xs" style="font-size:13px; padding:8px 18px;">Login</a>
                    <a href="/register" class="btn btn-primary btn-xs" style="font-size:13px; padding:8px 18px;">Get Started</a>
                @endauth
            </div>

            {{-- Hamburger Button --}}
            <button
                id="hamburger-btn"
                aria-label="Toggle mobile menu"
                aria-expanded="false"
                aria-controls="mobile-menu"
                onclick="toggleMobileMenu()"
                class="hamburger-toggle"
                style="
                    display: none;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    gap: 5px;
                    width: 40px;
                    height: 40px;
                    background: #262626;
                    border: 1px solid rgba(176,176,176,0.25);
                    border-radius: 8px;
                    cursor: pointer;
                    padding: 0;
                "
            >
                <span class="hamburger-line" id="ham-line-1"></span>
                <span class="hamburger-line" id="ham-line-2"></span>
                <span class="hamburger-line" id="ham-line-3"></span>
            </button>
        </div>
    </div>
</nav>

{{-- Mobile Menu --}}
<div id="mobile-menu" class="mobile-menu" role="dialog" aria-modal="false" aria-label="Mobile navigation">
    <nav aria-label="Mobile navigation links">
        <ul role="list" style="list-style:none; margin:0; padding:0; display:flex; flex-direction:column; gap:4px;">
            @foreach($navLinks as $link)
                <li>
                    <a
                        href="{{ $link['href'] }}"
                        onclick="closeMobileMenu()"
                        style="
                            display: block;
                            padding: 12px 16px;
                            color: {{ request()->routeIs($link['route']) ? '#F0F0F0' : '#A3A3A3' }};
                            text-decoration: none;
                            font-size: 15px;
                            font-weight: {{ request()->routeIs($link['route']) ? '600' : '400' }};
                            border-radius: 8px;
                            background: {{ request()->routeIs($link['route']) ? 'rgba(192,192,192,0.08)' : 'transparent' }};
                            border-left: 2px solid {{ request()->routeIs($link['route']) ? '#C0C0C0' : 'transparent' }};
                            transition: all 150ms ease-out;
                        "
                        @if(request()->routeIs($link['route'])) aria-current="page" @endif
                    >{{ $link['label'] }}</a>
                </li>
            @endforeach
        </ul>

        <div style="margin-top:20px; display:flex; gap:10px;">
            @auth
                <a href="/dashboard" class="btn btn-secondary btn-xs" style="flex:1; justify-content:center;">Dashboard</a>
            @else
                <a href="/login" class="btn btn-ghost btn-xs" style="flex:1; justify-content:center;">Login</a>
                <a href="/register" class="btn btn-primary btn-xs" style="flex:1; justify-content:center;">Get Started</a>
            @endauth
        </div>
    </nav>
</div>

<style>
    @media (max-width: 640px) {
        .desktop-nav { display: none !important; }
        .hamburger-toggle { display: flex !important; }
    }
</style>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const btn = document.getElementById('hamburger-btn');
        const isOpen = menu.classList.contains('open');

        if (isOpen) {
            closeMobileMenu();
        } else {
            menu.classList.add('open');
            btn.setAttribute('aria-expanded', 'true');
            animateHamburger(true);
        }
    }

    function closeMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        const btn = document.getElementById('hamburger-btn');
        menu.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
        animateHamburger(false);
    }

    function animateHamburger(open) {
        const l1 = document.getElementById('ham-line-1');
        const l2 = document.getElementById('ham-line-2');
        const l3 = document.getElementById('ham-line-3');
        if (open) {
            l1.style.transform = 'rotate(45deg) translate(5px, 5px)';
            l2.style.opacity = '0';
            l3.style.transform = 'rotate(-45deg) translate(5px, -5px)';
        } else {
            l1.style.transform = '';
            l2.style.opacity = '';
            l3.style.transform = '';
        }
    }

    function toggleProfileMenu() {
        const menu = document.getElementById('profile-menu');
        const btn = document.getElementById('profile-btn');
        const isHidden = menu.style.display === 'none' || menu.style.display === '';
        menu.style.display = isHidden ? 'block' : 'none';
        btn.setAttribute('aria-expanded', isHidden ? 'true' : 'false');
    }

    // Close profile menu on outside click
    document.addEventListener('click', function(e) {
        const container = document.getElementById('profile-dropdown-container');
        if (container && !container.contains(e.target)) {
            const menu = document.getElementById('profile-menu');
            const btn = document.getElementById('profile-btn');
            if (menu) { menu.style.display = 'none'; btn.setAttribute('aria-expanded', 'false'); }
        }
    });

    // Close mobile menu on Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeMobileMenu();
    });

    // Close mobile menu on outside click
    document.addEventListener('click', function(e) {
        const menu = document.getElementById('mobile-menu');
        const btn = document.getElementById('hamburger-btn');
        if (menu && menu.classList.contains('open') && !menu.contains(e.target) && !btn.contains(e.target)) {
            closeMobileMenu();
        }
    });
</script>
