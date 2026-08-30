@extends('admin.layouts.admin')
@section('title', 'Dashboard')

@section('content')

{{-- Page Header --}}
<div style="margin-bottom:32px;" class="anim-fade-up">
    <h1 class="page-title">Dashboard</h1>
    <p class="page-subtitle">Selamat datang, {{ auth()->user()->name }}</p>
</div>

{{-- ── KPI CARDS ──────────────────────────────────────────────────── --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:0;margin-bottom:28px;border:1px solid #E0E0E0;" class="stats-grid">

    {{-- Card 1: Hitam (Highlight) --}}
    <div class="stat-card dark anim-fade-up anim-delay-1" style="border:none;border-right:1px solid rgba(255,255,255,0.07);">
        <div style="font-size:10px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:rgba(255,255,255,0.45);margin-bottom:12px;">Artikel Terbit</div>
        <div class="stat-value dark" id="kpi-published" data-value="{{ $stats['posts_published'] }}">0</div>
        <div style="margin-top:12px;display:flex;align-items:center;gap:6px;">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="rgba(255,255,255,0.5)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/>
            </svg>
            <span style="font-size:10px;color:rgba(255,255,255,0.4);">Blog Posts</span>
        </div>
    </div>

    {{-- Card 2 --}}
    <div class="stat-card anim-fade-up anim-delay-2" style="border:none;border-right:1px solid #E0E0E0;">
        <div style="font-size:10px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;margin-bottom:12px;">Artikel Draft</div>
        <div class="stat-value" id="kpi-draft" data-value="{{ $stats['posts_draft'] }}">0</div>
        <div style="margin-top:12px;display:flex;align-items:center;gap:6px;">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#BDBDBD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
            </svg>
            <span style="font-size:10px;color:#BDBDBD;">Belum Terbit</span>
        </div>
    </div>

    {{-- Card 3 --}}
    <div class="stat-card anim-fade-up anim-delay-3" style="border:none;border-right:1px solid #E0E0E0;">
        <div style="font-size:10px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;margin-bottom:12px;">Total Artikel</div>
        <div class="stat-value" id="kpi-total" data-value="{{ $stats['posts_total'] }}">0</div>
        <div style="margin-top:12px;display:flex;align-items:center;gap:6px;">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#BDBDBD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="8" y1="6" x2="21" y2="6"/><line x1="8" y1="12" x2="21" y2="12"/><line x1="8" y1="18" x2="21" y2="18"/>
                <line x1="3" y1="6" x2="3.01" y2="6"/><line x1="3" y1="12" x2="3.01" y2="12"/><line x1="3" y1="18" x2="3.01" y2="18"/>
            </svg>
            <span style="font-size:10px;color:#BDBDBD;">Semua Konten</span>
        </div>
    </div>

    {{-- Card 4 --}}
    <div class="stat-card anim-fade-up anim-delay-4" style="border:none;">
        <div style="font-size:10px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;margin-bottom:12px;">Setting Aktif</div>
        <div class="stat-value" id="kpi-settings" data-value="{{ $stats['settings_total'] }}">0</div>
        <div style="margin-top:12px;display:flex;align-items:center;gap:6px;">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#BDBDBD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/>
            </svg>
            <span style="font-size:10px;color:#BDBDBD;">Konfigurasi</span>
        </div>
    </div>

</div>

{{-- ── MAIN CONTENT GRID ────────────────────────────────────────── --}}
<div style="display:grid;grid-template-columns:1fr 360px;gap:20px;" class="dash-grid">

    {{-- Quick Actions --}}
    <div class="admin-card anim-fade-up anim-delay-2">
        <div class="admin-card-header">
            <h2>Aksi Cepat</h2>
        </div>
        <div class="admin-card-body" style="padding:0;">
            @foreach([
                [
                    'href'  => route('admin.settings.homepage'),
                    'title' => 'Edit Homepage',
                    'desc'  => 'Hero slider, About, CTA section',
                    'icon'  => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
                ],
                [
                    'href'  => route('admin.blog.posts.index'),
                    'title' => 'Semua Artikel',
                    'desc'  => 'Kelola blog dan konten',
                    'icon'  => '<path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/>',
                ],
                [
                    'href'  => route('admin.pages.gallery'),
                    'title' => 'Kelola Galeri',
                    'desc'  => 'Upload dan atur foto',
                    'icon'  => '<rect x="3" y="3" width="18" height="18"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>',
                ],
                [
                    'href'   => route('home'),
                    'title'  => 'Preview Website',
                    'desc'   => 'Tampilan halaman publik',
                    'icon'   => '<path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>',
                    'target' => '_blank',
                ],
            ] as $action)
            <a
                href="{{ $action['href'] }}"
                @if(isset($action['target'])) target="{{ $action['target'] }}" rel="noopener" @endif
                style="
                    display:flex;align-items:center;gap:16px;
                    padding:16px 22px;text-decoration:none;
                    border-bottom:1px solid #F0F0F0;
                    transition:background 200ms cubic-bezier(0.22,1,0.36,1);
                "
                onmouseover="this.style.background='#F5F5F5';"
                onmouseout="this.style.background='transparent';"
            >
                <div style="width:36px;height:36px;background:#F5F5F5;border:1px solid #E0E0E0;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#1A1A1A" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $action['icon'] !!}</svg>
                </div>
                <div>
                    <div style="font-size:13px;font-weight:500;color:#212121;margin-bottom:2px;">{{ $action['title'] }}</div>
                    <div style="font-size:11px;color:#9E9E9E;font-weight:400;">{{ $action['desc'] }}</div>
                </div>
                <svg style="margin-left:auto;flex-shrink:0;" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#BDBDBD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
            @endforeach
        </div>
    </div>

    {{-- System Info --}}
    <div class="admin-card anim-fade-up anim-delay-3">
        <div class="admin-card-header">
            <h2>Informasi Sistem</h2>
        </div>
        <div class="admin-card-body" style="padding:0;">
            @foreach([
                ['Laravel',          app()->version()],
                ['PHP',              phpversion()],
                ['Environment',      ucfirst(app()->environment())],
                ['Database',         config('database.default')],
                ['Login Terakhir',   auth()->user()->last_login_at
                    ? \Carbon\Carbon::parse(auth()->user()->last_login_at)->locale('id')->diffForHumans()
                    : 'Pertama kali'],
            ] as [$label, $value])
            <div style="display:flex;justify-content:space-between;align-items:center;padding:12px 22px;border-bottom:1px solid #F0F0F0;">
                <span style="font-size:11px;font-weight:400;color:#9E9E9E;text-transform:uppercase;letter-spacing:0.06em;">{{ $label }}</span>
                <span style="font-size:12px;color:#212121;font-weight:500;font-family:monospace;">{{ $value }}</span>
            </div>
            @endforeach

            <div style="padding:16px 22px;">
                <a href="{{ route('admin.settings.homepage') }}" class="btn-primary" style="width:100%;justify-content:center;font-size:11px;">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
                    Kelola Pengaturan
                </a>
            </div>
        </div>
    </div>

</div>

{{-- ── HVM DIGITAL LICENSE CARD ──────────────────────────────────── --}}
<div style="margin-top: 20px;" class="anim-fade-up anim-delay-4">
    <div class="admin-card" style="border-left: 3px solid {{ $license['is_active'] ? '#22C55E' : '#EF4444' }};">
        <div class="admin-card-body" style="padding: 20px 22px;">
            <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 16px; flex-wrap: wrap;">
                <div style="display: flex; align-items: center; gap: 16px;">
                    <div style="width: 42px; height: 42px; background: #1A1A1A; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-linecap="round">
                            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                        </svg>
                    </div>
                    <div>
                        <div style="font-size: 11px; font-weight: 700; color: #9E9E9E; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 4px;">Developed by HVM Digital</div>
                        <div style="font-size: 13px; font-weight: 600; color: #212121; margin-bottom: 3px;">
                            Lisensi Website
                            @if($license['is_active'])
                                <span style="background:#F0FDF4;color:#22C55E;border:1px solid #BBF7D0;font-size:10px;font-weight:700;padding:2px 8px;text-transform:uppercase;letter-spacing:0.06em;margin-left:6px;">Aktif</span>
                            @else
                                <span style="background:#FEF2F2;color:#EF4444;border:1px solid #FCA5A5;font-size:10px;font-weight:700;padding:2px 8px;text-transform:uppercase;letter-spacing:0.06em;margin-left:6px;">Expired</span>
                            @endif
                        </div>
                        <div style="font-size:12px;color:#9E9E9E;">
                            Berakhir: <strong style="color:#212121;">{{ $license['expiry']->translatedFormat('d F Y') }}</strong>
                            &nbsp;·&nbsp;
                            @if($license['days_remaining'] > 0)
                                <span style="color:{{ $license['days_remaining'] <= 30 ? '#B45309' : '#2E7D32' }};font-weight:600;">{{ $license['days_remaining'] }} hari lagi</span>
                            @else
                                <span style="color:#EF4444;font-weight:600;">Lisensi expired</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            @php
                $pct = $license['days_remaining'] > 0 ? min(100, round($license['days_remaining'] / 365 * 100)) : 0;
                $barColor = $license['days_remaining'] <= 30 ? '#EF4444' : ($license['days_remaining'] <= 90 ? '#F59E0B' : '#22C55E');
            @endphp
            <div style="margin-top:16px;background:#F5F5F5;height:3px;width:100%;overflow:hidden;">
                <div style="height:100%;width:{{$pct}}%;background:{{$barColor}};transition:width 1s ease;"></div>
            </div>
            <div style="display:flex;justify-content:space-between;margin-top:6px;font-size:10px;color:#BDBDBD;font-weight:500;text-transform:uppercase;letter-spacing:0.06em;">
                <span>Sisa: {{ $license['days_remaining'] }} hari</span>
                <a href="https://hvmdigital.id" target="_blank" rel="noopener" style="color:#BDBDBD;text-decoration:none;">hvmdigital.id</a>
            </div>
        </div>
    </div>
</div>

<style>
@media(max-width:1200px) { .stats-grid { grid-template-columns: repeat(2,1fr) !important; } }
@media(max-width:900px)  { .dash-grid { grid-template-columns: 1fr !important; } }
@media(max-width:640px)  { .stats-grid { grid-template-columns: 1fr !important; } }
</style>

{{-- Slow-Motion Counter Animation --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const easeOutQuint = t => 1 - Math.pow(1 - t, 5);
    const animateCounter = (el, target, duration = 1500, delay = 0) => {
        setTimeout(() => {
            const start = performance.now();
            const update = now => {
                const elapsed = now - start;
                const progress = Math.min(elapsed / duration, 1);
                el.textContent = Math.round(easeOutQuint(progress) * target);
                if (progress < 1) requestAnimationFrame(update);
            };
            requestAnimationFrame(update);
        }, delay);
    };

    document.querySelectorAll('[data-value]').forEach((el, i) => {
        animateCounter(el, parseInt(el.dataset.value), 1800, i * 120);
    });
});
</script>

@endsection
