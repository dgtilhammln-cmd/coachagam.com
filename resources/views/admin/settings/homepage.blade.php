@extends('admin.layouts.admin')
@section('title', 'Site Settings — Homepage')

@section('breadcrumb')
    <span class="breadcrumb-sep" aria-hidden="true">/</span>
    <span class="breadcrumb-current">Site Settings</span>
    <span class="breadcrumb-sep" aria-hidden="true">/</span>
    <span class="breadcrumb-current">Homepage</span>
@endsection

@section('content')

{{-- Page Header --}}
<div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:24px;gap:14px;flex-wrap:wrap;">
    <div>
        <h1 class="page-title">Homepage Settings</h1>
        <p class="page-subtitle">Kelola seluruh konten yang tampil di halaman utama website.</p>
    </div>
    <a href="{{ route('home') }}" target="_blank" rel="noopener" class="btn-outline" style="font-size:13px;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
            <polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>
        </svg>
        Preview Homepage
    </a>
</div>

{{-- ── MAIN FORM ─────────────────────────────────────────────── --}}
<form action="{{ route('admin.settings.homepage.update') }}" method="POST" id="homepage-form" enctype="multipart/form-data" x-data="{ tab: 'hero' }">
@csrf

{{-- Tab Navigation --}}
<div class="tab-nav" role="tablist">
    @foreach([
        ['hero',    'Hero Section',   '<path d="M5 3l14 9-14 9V3z"/>'],
        ['about',   'About',         '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>'],
        ['cta',     'CTA Section',   '<path d="M22 16.92v3a2 2 0 0 1-2.18 2A19.79 19.79 0 0 1 11.19 18a19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.6 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L7.91 9a16 16 0 0 0 6 6z"/>'],
        ['contact', 'Kontak & SEO',  '<circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>'],
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
</div>

{{-- ═══════════════════════════════════
     TAB 1 — HERO SECTION
═══════════════════════════════════ --}}
<div x-show="tab === 'hero'" id="tab-hero" role="tabpanel">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
        <div>
            <h2 style="font-size:15px;font-weight:700;color:#1E293B;margin:0 0 2px;">Hero Slides & Tampilan</h2>
            <p style="font-size:12px;color:#64748B;margin:0;">{{ count($heroSlides) }} slide aktif. Maksimum 10 slide.</p>
        </div>
        @if(count($heroSlides) < 10)
        <a href="{{ route('admin.settings.homepage.add-slide') }}" 
           onclick="event.preventDefault(); document.getElementById('add-slide-form').submit();"
           class="btn-outline" style="font-size:13px; text-decoration:none;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah Slide
        </a>
        @endif
    </div>

    {{-- Global Hero Settings --}}
    <div class="card" style="border-radius:0; margin-bottom:24px; padding:20px; background:#FFFFFF;">
        <h3 style="font-size:14px; font-weight:700; margin:0 0 16px;">Pengaturan Warna Elemen Hero</h3>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
            <div class="form-group">
                <label class="form-label" for="hero_shape_color1">Warna Shape Lingkaran (Gradasi 2 Warna)</label>
                <div style="display:flex; align-items:center; gap:12px; margin-bottom: 8px;">
                    <div style="display:flex; align-items:center; gap:4px;">
                        <input type="color" id="hero_shape_color1_picker" 
                               value="{{ old('homepage.hero_shape_color1', \App\Models\SiteSetting::where('key', 'homepage.hero_shape_color1')->value('value') ?? '#F4F4F5') }}"
                               oninput="document.getElementById('hero_shape_color1').value = this.value"
                               style="width:30px; height:30px; padding:0; border:1px solid #E5E7EB; border-radius:4px; cursor:pointer;">
                        <input type="text" id="hero_shape_color1" name="homepage.hero_shape_color1" 
                               value="{{ old('homepage.hero_shape_color1', \App\Models\SiteSetting::where('key', 'homepage.hero_shape_color1')->value('value') ?? '#F4F4F5') }}"
                               oninput="document.getElementById('hero_shape_color1_picker').value = this.value"
                               class="form-input" style="width:100px; padding:4px 8px; font-size:12px; font-family:monospace;" placeholder="#FFFFFF">
                    </div>
                    <span style="font-size:12px; color:#6B7280;">(Warna Kiri/Atas)</span>
                </div>
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="display:flex; align-items:center; gap:4px;">
                        <input type="color" id="hero_shape_color2_picker" 
                               value="{{ old('homepage.hero_shape_color2', \App\Models\SiteSetting::where('key', 'homepage.hero_shape_color2')->value('value') ?? '#E5E7EB') }}"
                               oninput="document.getElementById('hero_shape_color2').value = this.value"
                               style="width:30px; height:30px; padding:0; border:1px solid #E5E7EB; border-radius:4px; cursor:pointer;">
                        <input type="text" id="hero_shape_color2" name="homepage.hero_shape_color2" 
                               value="{{ old('homepage.hero_shape_color2', \App\Models\SiteSetting::where('key', 'homepage.hero_shape_color2')->value('value') ?? '#E5E7EB') }}"
                               oninput="document.getElementById('hero_shape_color2_picker').value = this.value"
                               class="form-input" style="width:100px; padding:4px 8px; font-size:12px; font-family:monospace;" placeholder="#FFFFFF">
                    </div>
                    <span style="font-size:12px; color:#6B7280;">(Warna Kanan/Bawah)</span>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label" for="hero_star_color">Warna Bintang (Rating)</label>
                <div style="display:flex; align-items:center; gap:12px;">
                    <div style="display:flex; align-items:center; gap:4px;">
                        <input type="color" id="hero_star_color_picker" 
                               value="{{ old('homepage.hero_star_color', \App\Models\SiteSetting::where('key', 'homepage.hero_star_color')->value('value') ?? '#84cc16') }}"
                               oninput="document.getElementById('hero_star_color').value = this.value"
                               style="width:30px; height:30px; padding:0; border:1px solid #E5E7EB; border-radius:4px; cursor:pointer;">
                        <input type="text" id="hero_star_color" name="homepage.hero_star_color" 
                               value="{{ old('homepage.hero_star_color', \App\Models\SiteSetting::where('key', 'homepage.hero_star_color')->value('value') ?? '#84cc16') }}"
                               oninput="document.getElementById('hero_star_color_picker').value = this.value"
                               class="form-input" style="width:100px; padding:4px 8px; font-size:12px; font-family:monospace;" placeholder="#FFFFFF">
                    </div>
                    <span style="font-size:12px; color:#6B7280;">Warna 5 bintang di sebelah kanan.</span>
                </div>
            </div>
        </div>
    </div>

    @forelse($heroSlides as $i => $slide)
    <div class="card" style="border-radius:0; margin-bottom:24px;" x-data="{ open: {{ $i === 0 ? 'true' : 'false' }} }">
        <div style="display:flex; align-items:center; justify-content:space-between; padding:16px 20px; border-bottom:1px solid #E5E7EB; background:#F9FAFB; cursor:pointer;" @click="open = !open">
            <div style="display:flex; align-items:center; gap:12px;">
                <span style="width:24px;height:24px;background:#1A1A1A;color:#FFFFFF;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:bold;">{{ $i + 1 }}</span>
                <span style="font-weight:600;font-size:14px;">Slide {{ $i + 1 }}</span>
            </div>
            <div style="display:flex; gap:12px; align-items:center;" @click.stop>
                <a href="{{ route('admin.settings.homepage.delete-slide', $i) }}"
                   onclick="event.preventDefault(); if(confirm('Hapus slide ini?')) document.getElementById('delete-slide-form-{{$i}}').submit();"
                   style="color:#DC2626; font-size:12px; font-weight:600; text-decoration:none;">
                   Hapus
                </a>
            </div>
        </div>

        <div x-show="open" style="padding:20px;">
            <div class="form-group">
                <label class="form-label" for="sl_{{ $i }}_headline">Headline / Judul Utama</label>
                <input type="text" id="sl_{{ $i }}_headline" name="slides[{{ $i }}][headline]" class="form-input" 
                       value="{{ old('slides.'.$i.'.headline', $slide['headline'] ?? '') }}" 
                       placeholder="Pelatihan Sepakbola<br><b>Profesional & Berdedikasi</b>">
                <p class="hint">Gunakan &lt;br&gt; untuk baris baru. Gunakan &lt;b&gt;teks&lt;/b&gt; untuk menebalkan kata.</p>
            </div>

            <div class="form-group">
                <label class="form-label" for="sl_{{ $i }}_subheadline">Subheadline / Deskripsi</label>
                <textarea id="sl_{{ $i }}_subheadline" name="slides[{{ $i }}][subheadline]" class="form-textarea" rows="3">{{ old('slides.'.$i.'.subheadline', $slide['subheadline'] ?? '') }}</textarea>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div class="form-group">
                    <label class="form-label" for="sl_{{ $i }}_cta_text">Teks Tombol CTA</label>
                    <input type="text" id="sl_{{ $i }}_cta_text" name="slides[{{ $i }}][cta_text]" class="form-input" 
                           value="{{ old('slides.'.$i.'.cta_text', $slide['cta_text'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="sl_{{ $i }}_cta_link">Link Tombol CTA</label>
                    <input type="text" id="sl_{{ $i }}_cta_link" name="slides[{{ $i }}][cta_link]" class="form-input" 
                           value="{{ old('slides.'.$i.'.cta_link', $slide['cta_link'] ?? '') }}">
                </div>
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:16px;">
                <div class="form-group">
                    <label class="form-label" for="sl_{{ $i }}_trusted_text">Teks "Trusted By" (Bawah Tombol)</label>
                    <input type="text" id="sl_{{ $i }}_trusted_text" name="slides[{{ $i }}][trusted_text]" class="form-input" 
                           value="{{ old('slides.'.$i.'.trusted_text', $slide['trusted_text'] ?? '') }}"
                           placeholder="Trusted by Over 21 Million Clients">
                </div>
                <div class="form-group">
                    <label class="form-label">Gambar Avatar (Maksimal 3)</label>
                    <div style="display:grid;grid-template-columns:repeat(3, 1fr);gap:12px;">
                        {{-- Avatar 1 --}}
                        <div>
                            @if(!empty($slide['trusted_image_1']))
                                <div style="position:relative; display:inline-block; margin-bottom:12px;" x-data="{ removed_{{ $i }}_t1: false }">
                                    <img src="{{ asset('storage/'.$slide['trusted_image_1']) }}" 
                                         style="height:40px; width:40px; object-fit:cover; border-radius:50%; border:1px solid #E5E7EB; display:block;"
                                         x-show="!removed_{{ $i }}_t1" alt="Avatar 1">
                                    <button type="button" x-show="!removed_{{ $i }}_t1" @click="removed_{{ $i }}_t1 = true"
                                            style="position:absolute;top:-4px;right:-4px;width:16px;height:16px;background:#EF4444;border:none;border-radius:50%;color:#FFFFFF;cursor:pointer;font-size:10px;font-weight:bold;display:flex;align-items:center;justify-content:center;line-height:1;"
                                            title="Hapus gambar">&times;</button>
                                    <input type="hidden" name="slides[{{ $i }}][remove_trusted_image_1]" x-bind:value="removed_{{ $i }}_t1 ? '1' : '0'">
                                </div>
                            @endif
                            <input type="file" id="sl_{{ $i }}_trusted_image_1" name="slides[{{ $i }}][trusted_image_1]" class="form-input" accept="image/*" style="font-size:11px;padding:8px;">
                        </div>

                        {{-- Avatar 2 --}}
                        <div>
                            @if(!empty($slide['trusted_image_2']))
                                <div style="position:relative; display:inline-block; margin-bottom:12px;" x-data="{ removed_{{ $i }}_t2: false }">
                                    <img src="{{ asset('storage/'.$slide['trusted_image_2']) }}" 
                                         style="height:40px; width:40px; object-fit:cover; border-radius:50%; border:1px solid #E5E7EB; display:block;"
                                         x-show="!removed_{{ $i }}_t2" alt="Avatar 2">
                                    <button type="button" x-show="!removed_{{ $i }}_t2" @click="removed_{{ $i }}_t2 = true"
                                            style="position:absolute;top:-4px;right:-4px;width:16px;height:16px;background:#EF4444;border:none;border-radius:50%;color:#FFFFFF;cursor:pointer;font-size:10px;font-weight:bold;display:flex;align-items:center;justify-content:center;line-height:1;"
                                            title="Hapus gambar">&times;</button>
                                    <input type="hidden" name="slides[{{ $i }}][remove_trusted_image_2]" x-bind:value="removed_{{ $i }}_t2 ? '1' : '0'">
                                </div>
                            @endif
                            <input type="file" id="sl_{{ $i }}_trusted_image_2" name="slides[{{ $i }}][trusted_image_2]" class="form-input" accept="image/*" style="font-size:11px;padding:8px;">
                        </div>

                        {{-- Avatar 3 --}}
                        <div>
                            @if(!empty($slide['trusted_image_3']))
                                <div style="position:relative; display:inline-block; margin-bottom:12px;" x-data="{ removed_{{ $i }}_t3: false }">
                                    <img src="{{ asset('storage/'.$slide['trusted_image_3']) }}" 
                                         style="height:40px; width:40px; object-fit:cover; border-radius:50%; border:1px solid #E5E7EB; display:block;"
                                         x-show="!removed_{{ $i }}_t3" alt="Avatar 3">
                                    <button type="button" x-show="!removed_{{ $i }}_t3" @click="removed_{{ $i }}_t3 = true"
                                            style="position:absolute;top:-4px;right:-4px;width:16px;height:16px;background:#EF4444;border:none;border-radius:50%;color:#FFFFFF;cursor:pointer;font-size:10px;font-weight:bold;display:flex;align-items:center;justify-content:center;line-height:1;"
                                            title="Hapus gambar">&times;</button>
                                    <input type="hidden" name="slides[{{ $i }}][remove_trusted_image_3]" x-bind:value="removed_{{ $i }}_t3 ? '1' : '0'">
                                </div>
                            @endif
                            <input type="file" id="sl_{{ $i }}_trusted_image_3" name="slides[{{ $i }}][trusted_image_3]" class="form-input" accept="image/*" style="font-size:11px;padding:8px;">
                        </div>
                    </div>
                </div>
            </div>

            <hr style="border:none; border-top:1px solid #E5E7EB; margin:24px 0;">

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">
                <div class="form-group">
                    <label class="form-label" for="sl_{{ $i }}_image">Foto Kanan</label>
                    @if(!empty($slide['image']))
                        <div style="position:relative; display:inline-block; margin-bottom:12px;" x-data="{ removed_{{ $i }}_img: false }">
                            <img src="{{ asset('storage/'.$slide['image']) }}" 
                                 style="height:120px; width:auto; object-fit:contain; border:1px solid #E5E7EB; background:#F9FAFB; padding:4px; display:block;"
                                 x-show="!removed_{{ $i }}_img"
                                 alt="Foto Kanan">
                            <button type="button"
                                    x-show="!removed_{{ $i }}_img"
                                    @click="removed_{{ $i }}_img = true"
                                    style="position:absolute;top:-8px;right:-8px;width:22px;height:22px;background:#EF4444;border:none;color:#FFFFFF;cursor:pointer;font-size:12px;font-weight:bold;display:flex;align-items:center;justify-content:center;line-height:1;"
                                    title="Hapus gambar">&times;</button>
                            <input type="hidden" name="slides[{{ $i }}][remove_image]" x-bind:value="removed_{{ $i }}_img ? '1' : '0'">
                        </div>
                    @endif
                    <input type="file" id="sl_{{ $i }}_image" name="slides[{{ $i }}][image]" class="form-input" accept="image/*">
                    <p class="hint">Kosongkan jika tidak ingin mengubah foto. Upload PNG transparan.</p>
                </div>

                <div class="form-group">
                    <label class="form-label" for="sl_{{ $i }}_background">Gambar Background (Opsional)</label>
                    @if(!empty($slide['background']))
                        <div style="position:relative; display:inline-block; margin-bottom:12px;" x-data="{ removed_{{ $i }}_bg: false }">
                            <img src="{{ asset('storage/'.$slide['background']) }}" 
                                 style="height:120px; width:auto; object-fit:cover; border:1px solid #E5E7EB; display:block;"
                                 x-show="!removed_{{ $i }}_bg"
                                 alt="Background">
                            <button type="button"
                                    x-show="!removed_{{ $i }}_bg"
                                    @click="removed_{{ $i }}_bg = true"
                                    style="position:absolute;top:-8px;right:-8px;width:22px;height:22px;background:#EF4444;border:none;color:#FFFFFF;cursor:pointer;font-size:12px;font-weight:bold;display:flex;align-items:center;justify-content:center;line-height:1;"
                                    title="Hapus background">&times;</button>
                            <input type="hidden" name="slides[{{ $i }}][remove_background]" x-bind:value="removed_{{ $i }}_bg ? '1' : '0'">
                        </div>
                    @endif
                    <input type="file" id="sl_{{ $i }}_background" name="slides[{{ $i }}][background]" class="form-input" accept="image/*">
                    <p class="hint">Kosong = background putih. Ada gambar = akan ada overlay putih tipis.</p>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div style="padding:40px;text-align:center;background:#F8FAFC;border:1px dashed #CBD5E1;border-radius:12px;color:#64748B;">
        Belum ada slide hero. Klik tombol <strong>Tambah Slide</strong> di atas.
    </div>
    @endforelse
</div>

{{-- ═══════════════════════════════════
     TAB 2 — ABOUT
═══════════════════════════════════ --}}
<div x-show="tab === 'about'" id="tab-about" role="tabpanel" style="display:none;">
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>Konten Seksi About Coach</h2>
            <span style="font-size:12px;color:#94A3B8;">Tampil di bawah hero section</span>
        </div>
        <div class="admin-card-body" style="display:grid;grid-template-columns:1fr 1fr;gap:18px;">

            <div class="form-group" style="grid-column:1/-1;margin:0;">
                <label class="form-label" for="about_tagline">Heading Utama</label>
                <input type="text" id="about_tagline" name="homepage.about_tagline" class="form-input"
                       value="{{ $settings['homepage.about_tagline']->value ?? '' }}"
                       placeholder="Membangun Juara Dari Dalam Lapangan">
            </div>

            <div class="form-group" style="grid-column:1/-1;margin:0;">
                <label class="form-label" for="about_bio_1">Bio — Paragraf 1 <span class="hint">perkenalan & rekam jejak</span></label>
                <textarea id="about_bio_1" name="homepage.about_bio_1" class="form-textarea" rows="3"
                          placeholder="Coach Agam adalah pelatih sepakbola profesional...">{{ $settings['homepage.about_bio_1']->value ?? '' }}</textarea>
            </div>

            <div class="form-group" style="grid-column:1/-1;margin:0;">
                <label class="form-label" for="about_bio_2">Bio — Paragraf 2 <span class="hint">filosofi & pendekatan</span></label>
                <textarea id="about_bio_2" name="homepage.about_bio_2" class="form-textarea" rows="3"
                          placeholder="Dengan filosofi...">{{ $settings['homepage.about_bio_2']->value ?? '' }}</textarea>
            </div>

            <div class="form-group" style="margin:0;">
                <label class="form-label" for="about_years">Tahun Pengalaman <span class="hint">badge foto</span></label>
                <input type="text" id="about_years" name="homepage.about_years_exp" class="form-input"
                       value="{{ $settings['homepage.about_years_exp']->value ?? '' }}" placeholder="10+">
            </div>

            <div class="form-group" style="margin:0;">
                <label class="form-label" for="about_athletes">Jumlah Atlet Dibina <span class="hint">badge foto</span></label>
                <input type="text" id="about_athletes" name="homepage.about_athletes_count" class="form-input"
                       value="{{ $settings['homepage.about_athletes_count']->value ?? '' }}" placeholder="500+">
            </div>

            <div class="form-group" style="grid-column:1/-1;margin:0;">
                <label class="form-label" for="about_certs">Sertifikasi <span class="hint">pisahkan dengan koma (,)</span></label>
                <input type="text" id="about_certs" name="homepage.about_certifications" class="form-input"
                       value="{{ $settings['homepage.about_certifications']->value ?? '' }}"
                       placeholder="Lisensi A - AFC,PSSI Level II,UEFA Pro Certified">
                <p class="form-hint">Setiap item dipisahkan koma. Contoh: Lisensi A - AFC,PSSI Level II</p>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════
     TAB 3 — CTA
═══════════════════════════════════ --}}
<div x-show="tab === 'cta'" id="tab-cta" role="tabpanel" style="display:none;">
    <div class="admin-card">
        <div class="admin-card-header">
            <h2>Konten Seksi CTA — Kerjasama</h2>
            <span style="font-size:12px;color:#94A3B8;">Bagian form kontak sebelum footer</span>
        </div>
        <div class="admin-card-body" style="display:flex;flex-direction:column;gap:18px;">
            <div class="form-group" style="margin:0;">
                <label class="form-label" for="cta_heading">Judul CTA</label>
                <input type="text" id="cta_heading" name="homepage.cta_heading" class="form-input"
                       value="{{ $settings['homepage.cta_heading']->value ?? '' }}"
                       placeholder="Hubungi Kami Untuk Kebutuhan Pelatihan Anda">
            </div>
            <div class="form-group" style="margin:0;">
                <label class="form-label" for="cta_desc">Deskripsi CTA</label>
                <textarea id="cta_desc" name="homepage.cta_description" class="form-textarea" rows="3"
                          placeholder="Ajakan kerjasama...">{{ $settings['homepage.cta_description']->value ?? '' }}</textarea>
            </div>

            {{-- Background Image CTA --}}
            <div class="form-group" style="margin:0;">
                <label class="form-label" for="cta_bg_image">Background Image CTA <span class="hint">(gambar di belakang box CTA)</span></label>
                @if(!empty($settings['homepage.cta_bg_image']->value ?? null))
                    <div style="position:relative; display:inline-block; margin-bottom:12px;" x-data="{ removedCtaBg: false }">
                        <img src="{{ asset('storage/'.$settings['homepage.cta_bg_image']->value) }}"
                             style="height:120px; width:auto; max-width:300px; object-fit:cover; border:1px solid #E5E7EB; display:block;"
                             x-show="!removedCtaBg" alt="Background CTA">
                        <button type="button" x-show="!removedCtaBg" @click="removedCtaBg = true"
                                style="position:absolute;top:-8px;right:-8px;width:22px;height:22px;background:#EF4444;border:none;color:#FFFFFF;cursor:pointer;font-size:12px;font-weight:bold;display:flex;align-items:center;justify-content:center;"
                                title="Hapus background">✕</button>
                        <input type="hidden" name="remove_cta_bg_image" x-bind:value="removedCtaBg ? '1' : '0'">
                    </div>
                @endif
                <input type="file" id="cta_bg_image" name="cta_bg_image" class="form-input" accept="image/*">
                <p class="form-hint">Gambar akan ditampilkan di belakang box CTA dengan opacity rendah. Rekomendasi: 1920×600px.</p>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════
     TAB 4 — KONTAK & SEO
═══════════════════════════════════ --}}
<div x-show="tab === 'contact'" id="tab-contact" role="tabpanel" style="display:none;">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

        {{-- Kontak --}}
        <div class="admin-card">
            <div class="admin-card-header">
                <h2>Info Kontak</h2>
            </div>
            <div class="admin-card-body" style="display:flex;flex-direction:column;gap:16px;">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="wa_number">
                        Nomor WhatsApp
                        <span class="hint">tanpa tanda + atau spasi</span>
                    </label>
                    <input type="text" id="wa_number" name="contact.whatsapp_number" class="form-input"
                           value="{{ $settings['contact.whatsapp_number']->value ?? '' }}"
                           placeholder="6281234567890">
                    <p class="form-hint">Format: kode negara + nomor. Contoh: 6281234567890</p>
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="wa_msg">Pesan Default WhatsApp</label>
                    <textarea id="wa_msg" name="contact.whatsapp_message" class="form-textarea" rows="2"
                              placeholder="Halo Coach Agam...">{{ $settings['contact.whatsapp_message']->value ?? '' }}</textarea>
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="contact_email">Email</label>
                    <input type="email" id="contact_email" name="contact.email" class="form-input"
                           value="{{ $settings['contact.email']->value ?? '' }}"
                           placeholder="info@coachagam.com">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="contact_loc">Lokasi</label>
                    <input type="text" id="contact_loc" name="contact.location" class="form-input"
                           value="{{ $settings['contact.location']->value ?? '' }}"
                           placeholder="Jakarta, Indonesia">
                </div>
            </div>
        </div>

        {{-- SEO --}}
        <div class="admin-card">
            <div class="admin-card-header">
                <h2>SEO Global</h2>
            </div>
            <div class="admin-card-body" style="display:flex;flex-direction:column;gap:16px;">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="seo_title">
                        Site Title <span class="hint">meta title</span>
                    </label>
                    <input type="text" id="seo_title" name="seo.site_title" class="form-input"
                           value="{{ $settings['seo.site_title']->value ?? '' }}"
                           placeholder="Coach Agam — Pelatih Sepakbola Profesional"
                           maxlength="70" id="seo-title-input">
                    <p class="form-hint" id="seo-title-hint">Ideal: 50–70 karakter</p>
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="seo_desc">
                        Meta Description <span class="hint">ringkasan untuk mesin pencari</span>
                    </label>
                    <textarea id="seo_desc" name="seo.site_description" class="form-textarea" rows="4"
                              maxlength="165"
                              placeholder="Deskripsi singkat website...">{{ $settings['seo.site_description']->value ?? '' }}</textarea>
                    <p class="form-hint">Ideal: 120–160 karakter</p>
                </div>

                {{-- SERP Preview --}}
                <div style="border:1px solid #E2E8F0;border-radius:8px;padding:14px;background:#FAFAFA;">
                    <p style="font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#94A3B8;margin-bottom:10px;">Pratinjau di Google</p>
                    <p style="font-size:17px;color:#1A0DAB;margin:0 0 3px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;font-family:Arial,sans-serif;">
                        {{ $settings['seo.site_title']->value ?? 'Coach Agam — Pelatih Sepakbola Profesional' }}
                    </p>
                    <p style="font-size:13px;color:#006621;margin:0 0 5px;font-family:Arial,sans-serif;">{{ config('app.url') }}</p>
                    <p style="font-size:13px;color:#545454;margin:0;line-height:1.5;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;font-family:Arial,sans-serif;">
                        {{ $settings['seo.site_description']->value ?? 'Deskripsi website Coach Agam di sini...' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Sticky Save Bar ──────────────────────────────────────────── --}}
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
    <div style="display:flex;gap:10px;align-items:center;">
        <a href="{{ route('admin.settings.homepage') }}" class="btn-outline" style="font-size:13px;">
            Reset
        </a>
        <button type="submit" class="btn-silver" style="font-size:13px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                <polyline points="17 21 17 13 7 13 7 21"/>
                <polyline points="7 3 7 8 15 8"/>
            </svg>
            Simpan Semua Perubahan
        </button>
    </div>
</div>

</form>

{{-- Hidden forms for Add/Delete slides --}}
<form id="add-slide-form" action="{{ route('admin.settings.homepage.add-slide') }}" method="POST" style="display:none;">
    @csrf
</form>

@if(!empty($heroSlides))
    @foreach($heroSlides as $i => $slide)
        <form id="delete-slide-form-{{$i}}" action="{{ route('admin.settings.homepage.delete-slide', $i) }}" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
    @endforeach
@endif

<style>
@media(max-width:900px) {
    div[id="tab-contact"] > div { grid-template-columns: 1fr !important; }
}
@media(max-width:640px) {
    .slide-card-body > div { grid-template-columns: 1fr !important; }
}
</style>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Live character count for SEO title
    const titleInput = document.getElementById('seo-title-input');
    const titleHint  = document.getElementById('seo-title-hint');
    if (titleInput && titleHint) {
        const base = titleHint.textContent;
        const update = () => {
            const len = titleInput.value.length;
            const warn = len > 65;
            titleHint.textContent = `${base} — ${len}/70 karakter`;
            titleHint.style.color = warn ? '#D97706' : '#9CA3AF';
        };
        titleInput.addEventListener('input', update);
        update();
    }
});
</script>
@endpush

@endsection
