@extends('admin.layouts.admin')
@section('title', 'Site Settings — General')

@section('breadcrumb')
    <span class="breadcrumb-sep" aria-hidden="true">/</span>
    <span class="breadcrumb-current">Site Settings</span>
    <span class="breadcrumb-sep" aria-hidden="true">/</span>
    <span class="breadcrumb-current">General</span>
@endsection

@section('content')

<div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:24px;gap:14px;flex-wrap:wrap;">
    <div>
        <h1 class="page-title">General Settings</h1>
        <p class="page-subtitle">Logo, Favicon, Open Graph, SEO Global, dan Tracking Code.</p>
    </div>
    <a href="{{ route('home') }}" target="_blank" rel="noopener" class="btn-outline" style="font-size:13px;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
        </svg>
        Preview Website
    </a>
</div>

<form action="{{ route('admin.settings.general.update') }}" method="POST" enctype="multipart/form-data" id="general-settings-form">
@csrf

{{-- Tab Navigation --}}
<div class="tab-nav" role="tablist" x-data="{ tab: 'branding' }">
    @foreach([
        ['branding', 'Branding', '<path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/>'],
        ['seo',      'SEO',      '<circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>'],
        ['tracking', 'Tracking', '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>'],
    ] as [$id, $label, $iconPath])
    <button
        type="button"
        @click="tab = '{{ $id }}'"
        :class="tab === '{{ $id }}' ? 'active' : ''"
        class="tab-btn"
        role="tab"
        :aria-selected="tab === '{{ $id }}'"
    >
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $iconPath !!}</svg>
        {{ $label }}
    </button>
    @endforeach

{{-- ═══════════════ TAB 1 — BRANDING ═══════════════ --}}
<div x-show="tab === 'branding'" id="tab-branding" role="tabpanel" style="padding-top:24px; width:100%;">
    
    <div style="display:grid; grid-template-columns: 1fr 1fr 1fr; gap:24px;">

        {{-- Logo --}}
        <div class="admin-card" style="border-radius:0;">
            <div class="admin-card-header">
                <h2>Logo Website</h2>
            </div>
            <div class="admin-card-body">
                @if(!empty($settings['general.logo']->value ?? null))
                    <div style="margin-bottom:16px; padding:12px; background:#F9FAFB; border:1px solid #E5E7EB; display:flex; align-items:center; justify-content:center; min-height:80px;">
                        <img src="{{ asset('storage/'.$settings['general.logo']->value) }}" style="max-height:60px; max-width:100%; object-fit:contain;" alt="Logo">
                    </div>
                @else
                    <div style="margin-bottom:16px; padding:20px; background:#F9FAFB; border:1px dashed #D1D5DB; text-align:center; color:#9CA3AF; font-size:12px;">
                        Belum ada logo
                    </div>
                @endif
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="logo">Upload Logo</label>
                    <input type="file" id="logo" name="logo" class="form-input" accept="image/*">
                    <p class="hint">PNG/SVG transparan, max 2MB. Ideal: lebar 300px.</p>
                </div>
            </div>
        </div>

        {{-- Favicon --}}
        <div class="admin-card" style="border-radius:0;">
            <div class="admin-card-header">
                <h2>Favicon</h2>
            </div>
            <div class="admin-card-body">
                @if(!empty($settings['general.favicon']->value ?? null))
                    <div style="margin-bottom:16px; padding:20px; background:#F9FAFB; border:1px solid #E5E7EB; text-align:center;">
                        <img src="{{ asset('storage/'.$settings['general.favicon']->value) }}" style="width:32px; height:32px; object-fit:contain;" alt="Favicon">
                    </div>
                @else
                    <div style="margin-bottom:16px; padding:20px; background:#F9FAFB; border:1px dashed #D1D5DB; text-align:center; color:#9CA3AF; font-size:12px;">
                        Belum ada favicon
                    </div>
                @endif
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="favicon">Upload Favicon</label>
                    <input type="file" id="favicon" name="favicon" class="form-input" accept="image/*">
                    <p class="hint">ICO/PNG 32×32px atau 64×64px, max 512KB.</p>
                </div>
            </div>
        </div>

        {{-- Open Graph Image --}}
        <div class="admin-card" style="border-radius:0;">
            <div class="admin-card-header">
                <h2>Open Graph Image</h2>
            </div>
            <div class="admin-card-body">
                @if(!empty($settings['seo.og_image']->value ?? null))
                    <div style="margin-bottom:16px;">
                        <img src="{{ asset('storage/'.$settings['seo.og_image']->value) }}" style="width:100%; aspect-ratio:1200/630; object-fit:cover; border:1px solid #E5E7EB;" alt="OG Image">
                    </div>
                @else
                    <div style="margin-bottom:16px; padding:20px; background:#F9FAFB; border:1px dashed #D1D5DB; text-align:center; color:#9CA3AF; font-size:12px; aspect-ratio:1200/630; display:flex; align-items:center; justify-content:center;">
                        Belum ada gambar OG
                    </div>
                @endif
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="og_image">Upload OG Image</label>
                    <input type="file" id="og_image" name="og_image" class="form-input" accept="image/*">
                    <p class="hint">JPG/PNG. Ideal: 1200×630px. Tampil saat link dibagikan di WhatsApp/Facebook.</p>
                </div>
            </div>
        </div>

    </div>

    {{-- Contact & CTA Settings --}}
    <div style="margin-top:24px; padding-top:24px; border-top:1px solid #E5E7EB; display:grid; grid-template-columns: 1fr 1fr 2fr; gap:24px;">
        
        {{-- CTA Image --}}
        <div class="admin-card" style="border-radius:0;">
            <div class="admin-card-header">
                <h2>Background CTA Kerjasama</h2>
            </div>
            <div class="admin-card-body">
                @if(!empty($settings['general.cta_image']->value ?? null))
                    <div style="margin-bottom:16px;">
                        <img src="{{ asset('storage/'.$settings['general.cta_image']->value) }}" style="width:100%; aspect-ratio:16/9; object-fit:cover; border:1px solid #E5E7EB;" alt="CTA Image">
                    </div>
                @else
                    <div style="margin-bottom:16px; padding:20px; background:#F9FAFB; border:1px dashed #D1D5DB; text-align:center; color:#9CA3AF; font-size:12px; aspect-ratio:16/9; display:flex; align-items:center; justify-content:center;">
                        Belum ada gambar CTA
                    </div>
                @endif
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="cta_image">Upload Background CTA</label>
                    <input type="file" id="cta_image" name="cta_image" class="form-input" accept="image/*">
                    <p class="hint">JPG/PNG/WebP. Ideal: 1920x1080px. Tampil sebagai background section CTA di halaman.</p>
                </div>
            </div>
        </div>

        {{-- Breadcrumb / Banner Image (Global) --}}
        <div class="admin-card" style="border-radius:0;">
            <div class="admin-card-header">
                <h2>🖼️ Foto Breadcrumb (Global)</h2>
            </div>
            <div class="admin-card-body">
                @if(!empty($settings['general.breadcrumb_image']->value ?? null))
                    <div style="margin-bottom:16px;">
                        <img src="{{ asset('storage/'.$settings['general.breadcrumb_image']->value) }}" style="width:100%; aspect-ratio:16/6; object-fit:cover; border:1px solid #E5E7EB;" alt="Breadcrumb Image">
                    </div>
                @else
                    <div style="margin-bottom:16px; padding:20px; background:#F9FAFB; border:1px dashed #D1D5DB; text-align:center; color:#9CA3AF; font-size:12px; aspect-ratio:16/6; display:flex; align-items:center; justify-content:center;">
                        Belum ada gambar
                    </div>
                @endif
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="breadcrumb_image">Upload Foto Breadcrumb</label>
                    <input type="file" id="breadcrumb_image" name="breadcrumb_image" class="form-input" accept="image/*">
                    <p class="hint">Satu foto ini tampil di <strong>semua</strong> header halaman (Blog, Galeri, Profil, Kontak, dll). JPG/PNG. Ideal: 1920×600px.</p>
                </div>
            </div>
        </div>

        {{-- Contact Info --}}
        <div class="admin-card" style="border-radius:0;">
            <div class="admin-card-header">
                <h2>Info Kontak Utama</h2>
                <span style="font-size:12px;color:#94A3B8;">Digunakan untuk tombol CTA dan link Footer</span>
            </div>
            <div class="admin-card-body" style="display:flex;flex-direction:column;gap:20px;">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="general_whatsapp">Nomor WhatsApp</label>
                    <input type="text" id="general_whatsapp" name="general_whatsapp" class="form-input"
                           value="{{ old('general_whatsapp', $settings['general.whatsapp']->value ?? '') }}"
                           placeholder="081234567890">
                    <p class="form-hint">Digunakan untuk link tombol WhatsApp. Gunakan format angka penuh.</p>
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="general_email">Email</label>
                    <input type="email" id="general_email" name="general_email" class="form-input"
                           value="{{ old('general_email', $settings['general.email']->value ?? '') }}"
                           placeholder="coachagam@gmail.com">
                    <p class="form-hint">Digunakan jika ada fitur kontak email.</p>
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="general_address">Alamat Kantor</label>
                    <textarea id="general_address" name="general_address" class="form-textarea" rows="2"
                              placeholder="Jl. Sudirman No. 1, Jakarta">{{ old('general_address', $settings['general.address']->value ?? '') }}</textarea>
                    <p class="form-hint">Digunakan untuk informasi lokasi di box kontak CTA.</p>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ═══════════════ TAB 2 — SEO ═══════════════ --}}
<div x-show="tab === 'seo'" id="tab-seo" role="tabpanel" style="padding-top:24px; width:100%;">
    <div class="admin-card" style="border-radius:0;">
        <div class="admin-card-header">
            <h2>SEO Global</h2>
            <span style="font-size:12px;color:#94A3B8;">Berlaku di semua halaman jika halaman tidak mengaturnya sendiri</span>
        </div>
        <div class="admin-card-body" style="display:flex;flex-direction:column;gap:20px;">
            <div class="form-group" style="margin:0;">
                <label class="form-label" for="seo_meta_title">Meta Title</label>
                <input type="text" id="seo_meta_title" name="seo_meta_title" class="form-input"
                       value="{{ old('seo_meta_title', $settings['seo.meta_title']->value ?? '') }}"
                       placeholder="Coach Agam — Pelatih Sepakbola Profesional Indonesia" maxlength="70">
                <p class="form-hint">Ideal: 50–70 karakter. Muncul di tab browser dan hasil Google.</p>
            </div>
            <div class="form-group" style="margin:0;">
                <label class="form-label" for="seo_meta_desc">Meta Description</label>
                <textarea id="seo_meta_desc" name="seo_meta_description" class="form-textarea" rows="3"
                          placeholder="Coach Agam adalah pelatih sepakbola profesional..." maxlength="165">{{ old('seo_meta_description', $settings['seo.meta_description']->value ?? '') }}</textarea>
                <p class="form-hint">Ideal: 120–160 karakter. Muncul di deskripsi hasil pencarian Google.</p>
            </div>
            <div class="form-group" style="margin:0;">
                <label class="form-label" for="seo_meta_kw">Meta Keywords</label>
                <input type="text" id="seo_meta_kw" name="seo_meta_keywords" class="form-input"
                       value="{{ old('seo_meta_keywords', $settings['seo.meta_keywords']->value ?? '') }}"
                       placeholder="coach agam, pelatih sepakbola, football coach indonesia">
                <p class="form-hint">Pisahkan dengan koma. Tidak terlalu berpengaruh ke Google, tapi berguna untuk Bing.</p>
            </div>

            {{-- SERP Preview --}}
            <div style="border:1px solid #E2E8F0; padding:18px; background:#FAFAFA;">
                <p style="font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#94A3B8;margin-bottom:12px;">Pratinjau di Google</p>
                <p id="serp-title" style="font-size:18px;color:#1A0DAB;margin:0 0 3px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-family:Arial,sans-serif;">
                    {{ $settings['seo.meta_title']->value ?? 'Coach Agam — Pelatih Sepakbola Profesional Indonesia' }}
                </p>
                <p style="font-size:13px;color:#006621;margin:0 0 4px;font-family:Arial,sans-serif;">{{ config('app.url') }}</p>
                <p id="serp-desc" style="font-size:13px;color:#545454;margin:0;line-height:1.5;font-family:Arial,sans-serif;">
                    {{ $settings['seo.meta_description']->value ?? 'Deskripsi website Coach Agam...' }}
                </p>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════ TAB 3 — TRACKING ═══════════════ --}}
<div x-show="tab === 'tracking'" id="tab-tracking" role="tabpanel" style="padding-top:24px; width:100%;">
    <div style="display:grid; grid-template-columns:1fr 1fr; gap:24px;">

        <div class="admin-card" style="border-radius:0;">
            <div class="admin-card-header">
                <h2>Google Search Console (GSC)</h2>
            </div>
            <div class="admin-card-body">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="gsc_tag">GSC Verification Tag</label>
                    <textarea id="gsc_tag" name="integrations_gsc_tag" class="form-textarea" rows="4"
                              placeholder='&lt;meta name="google-site-verification" content="YOUR_CODE_HERE" /&gt;'>{{ old('integrations_gsc_tag', $settings['integrations.gsc_tag']->value ?? '') }}</textarea>
                    <p class="form-hint">Paste tag verifikasi Google Search Console. Tag ini akan ditambahkan ke &lt;head&gt;.</p>
                </div>
            </div>
        </div>

        <div class="admin-card" style="border-radius:0;">
            <div class="admin-card-header">
                <h2>Google Tag Manager (GTM)</h2>
            </div>
            <div class="admin-card-body" style="display:flex;flex-direction:column;gap:16px;">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="gtm_head">GTM — Kode &lt;head&gt;</label>
                    <textarea id="gtm_head" name="integrations_gtm_head" class="form-textarea" rows="4"
                              placeholder="&lt;!-- Google Tag Manager --&gt; ...">{{ old('integrations_gtm_head', $settings['integrations.gtm_head']->value ?? '') }}</textarea>
                    <p class="form-hint">Paste script GTM untuk &lt;head&gt;.</p>
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="gtm_body">GTM — Kode &lt;body&gt; (noscript)</label>
                    <textarea id="gtm_body" name="integrations_gtm_body" class="form-textarea" rows="4"
                              placeholder="&lt;!-- Google Tag Manager (noscript) --&gt; ...">{{ old('integrations_gtm_body', $settings['integrations.gtm_body']->value ?? '') }}</textarea>
                    <p class="form-hint">Paste noscript GTM untuk tepat setelah tag &lt;body&gt;.</p>
                </div>
            </div>
        </div>

    </div>
</div>

</div>{{-- end tab-nav x-data --}}

{{-- Sticky Save Bar --}}
<div style="
    position:sticky;bottom:0;
    background:rgba(255,255,255,0.97);
    backdrop-filter:blur(8px);
    border-top:1px solid #E2E8F0;
    padding:14px 0;
    margin-top:28px;
    display:flex;align-items:center;justify-content:space-between;
    gap:14px;flex-wrap:wrap;
    box-shadow:0 -4px 16px rgba(0,0,0,0.04);
">
    <p style="font-size:12.5px;color:#94A3B8;margin:0;display:flex;align-items:center;gap:6px;">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
        Perubahan akan langsung terlihat di website setelah disimpan.
    </p>
    <button type="submit" class="btn-silver" style="font-size:13px;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
            <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
        </svg>
        Simpan Semua Perubahan
    </button>
</div>

</form>

@endsection
