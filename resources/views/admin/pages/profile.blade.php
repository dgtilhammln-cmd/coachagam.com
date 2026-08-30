@extends('admin.layouts.admin')

@section('title', 'Page Management - Profile Coach Agam')

@section('content')
<div style="max-width:900px; margin:0 auto; padding-bottom:100px;">

    <x-section-title 
        title="Profile Coach Agam" 
        subtitle="Atur konten halaman /profil-coach-agam dan section Profil di Homepage."
    />

    @if(session('success'))
        <div style="background:#D1FAE5; color:#065F46; padding:12px 16px; border-radius:6px; margin-bottom:20px; font-weight:500; font-size:14px; border:1px solid #A7F3D0;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.pages.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ── 1. SEO & META ──────────────────────────────────────────────── --}}
        <div class="admin-card">
            <h2 class="card-title">1. Pengaturan SEO (Khusus Halaman Profil)</h2>
            <div style="display:grid; gap:16px;">
                <div class="form-group">
                    <label class="form-label" for="meta_title">Meta Title</label>
                    <input type="text" id="meta_title" name="page_profile.meta_title" class="form-input" 
                           value="{{ old('page_profile.meta_title', $settings['page_profile.meta_title']->value ?? 'Coach Agam — Pelatih Sepakbola Profesional') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="meta_description">Meta Description</label>
                    <textarea id="meta_description" name="page_profile.meta_description" class="form-input" rows="2">{{ old('page_profile.meta_description', $settings['page_profile.meta_description']->value ?? 'Profil lengkap Coach Agam, pelatih sepakbola profesional dengan lisensi kepelatihan tinggi di Indonesia.') }}</textarea>
                </div>
            </div>
            <div style="margin-top:20px; padding-top:20px; border-top:1px solid #eee;">
                <div style="padding:14px 16px; border:1px solid #D1FAE5; border-radius:8px; background:#ECFDF5; display:flex; align-items:center; gap:12px;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <p style="font-size:13px; color:#065F46; margin:0;">Foto Breadcrumb/Banner kini dikelola secara <strong>global</strong> di <a href="{{ route('admin.settings.general') }}" style="color:#047857; font-weight:700;">General Settings → Foto Breadcrumb</a>. Upload di sana untuk mengubah header semua halaman sekaligus.</p>
                </div>
            </div>
        </div>

        {{-- ── 2. PROFIL UTAMA ──────────────────────────────────────────────── --}}
        <div class="admin-card" style="margin-top:24px;">
            <h2 class="card-title">2. Profil Utama</h2>
            
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:16px;">
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="name">Nama Lengkap & Gelar (Bawah Foto)</label>
                    <input type="text" id="name" name="page_profile.name" class="form-input" 
                           value="{{ old('page_profile.name', $settings['page_profile.name']->value ?? 'Agam Haris Pambudi, S.Pd., M.Kes.') }}">
                </div>
                <div class="form-group" style="margin:0;">
                    <label class="form-label" for="job_title">Posisi / Jabatan (Bawah Foto)</label>
                    <input type="text" id="job_title" name="page_profile.job_title" class="form-input" 
                           value="{{ old('page_profile.job_title', $settings['page_profile.job_title']->value ?? 'Assistant Coach — PSIS Semarang') }}">
                </div>
            </div>
            
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div class="form-group">
                    <label class="form-label" for="headline">Headline (Teks Besar)</label>
                    <input type="text" id="headline" name="page_profile.headline" class="form-input" 
                           value="{{ old('page_profile.headline', $settings['page_profile.headline']->value ?? 'Dedikasi, Disiplin, & Pengembangan Berkelanjutan') }}">
                </div>
                <div class="form-group">
                    <label class="form-label" for="subheadline">Subheadline (Teks Kecil di Atas)</label>
                    <input type="text" id="subheadline" name="page_profile.subheadline" class="form-input" 
                           value="{{ old('page_profile.subheadline', $settings['page_profile.subheadline']->value ?? 'TENTANG COACH AGAM') }}">
                </div>
            </div>

            <div class="form-group" style="margin-top:16px;">
                <label class="form-label" for="description_1">Paragraf Deskripsi 1</label>
                <textarea id="description_1" name="page_profile.description_1" class="form-input" rows="4">{{ old('page_profile.description_1', $settings['page_profile.description_1']->value ?? 'Coach Agam telah mendedikasikan hidupnya untuk sepakbola...') }}</textarea>
            </div>

            <div class="form-group" style="margin-top:16px;">
                <label class="form-label" for="description_2">Paragraf Deskripsi 2</label>
                <textarea id="description_2" name="page_profile.description_2" class="form-input" rows="4">{{ old('page_profile.description_2', $settings['page_profile.description_2']->value ?? 'Fokus utama dari setiap sesi latihan yang disusun...') }}</textarea>
            </div>

            <div class="form-group" style="margin-top:16px;" x-data="{ removeImage: false }">
                <label class="form-label" for="page_profile_image">Foto Profil (Bisa Transparan / Biasa)</label>
                @php $profileImage = $settings['page_profile.image']->value ?? null; @endphp
                @if($profileImage)
                    <div style="margin-bottom:12px; display:inline-block; position:relative;">
                        <img src="{{ asset('storage/'.$profileImage) }}" style="max-width:200px; max-height:200px; object-fit:contain; border:1px solid #E5E7EB; background:#F9FAFB; border-radius:4px;" x-show="!removeImage">
                        <button type="button" x-show="!removeImage" @click="removeImage = true"
                                style="position:absolute;top:-10px;right:-10px;width:24px;height:24px;background:#EF4444;border:none;border-radius:50%;color:#FFFFFF;cursor:pointer;font-weight:bold;">&times;</button>
                        <input type="hidden" name="remove_profile_image" x-bind:value="removeImage ? '1' : '0'">
                    </div>
                @endif
                <input type="file" id="page_profile_image" name="page_profile_image" class="form-input" accept="image/*">
            </div>
        </div>

        {{-- ── 2.5. TRANSFERMARKT AUTHORITY ────────────────────────────────────────── --}}
        <div class="admin-card" style="margin-top:24px;">
            <h2 class="card-title">Transfermarkt / Authority Link</h2>
            <div style="display:grid; grid-template-columns:1fr; gap:20px;">
                <div class="form-group">
                    <label class="form-label" for="tm_link">URL Transfermarkt Lengkap</label>
                    <input type="text" id="tm_link" name="page_profile.tm_link" class="form-input" 
                           value="{{ old('page_profile.tm_link', $settings['page_profile.tm_link']->value ?? 'https://www.transfermarkt.co.id/agam-pambudi/profil/trainer/105024') }}">
                </div>
                <div class="form-group" style="margin-top:16px;" x-data="{ removeTmLogo: false }">
                    <label class="form-label" for="page_profile_tm_logo">Logo Authority (Jika kosong pakai SVG bawaan Transfermarkt)</label>
                    @php $tmLogo = $settings['page_profile.tm_logo']->value ?? null; @endphp
                    @if($tmLogo)
                        <div style="margin-bottom:12px; display:inline-block; position:relative;">
                            <img src="{{ asset('storage/'.$tmLogo) }}" style="max-height:80px; object-fit:contain; border:1px solid #E5E7EB; background:#F9FAFB; border-radius:4px;" x-show="!removeTmLogo">
                            <button type="button" x-show="!removeTmLogo" @click="removeTmLogo = true"
                                    style="position:absolute;top:-10px;right:-10px;width:24px;height:24px;background:#EF4444;border:none;border-radius:50%;color:#FFFFFF;cursor:pointer;font-weight:bold;">&times;</button>
                            <input type="hidden" name="remove_tm_logo" x-bind:value="removeTmLogo ? '1' : '0'">
                        </div>
                    @endif
                    <input type="file" id="page_profile_tm_logo" name="page_profile_tm_logo" class="form-input" accept="image/*">
                </div>
            </div>
        </div>

        {{-- ── 3. INFO PRIBADI ─────────────────────────────────────────────── --}}
        <div class="admin-card" style="margin-top:24px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <h2 class="card-title" style="margin:0;">3. Info Pribadi (Data Diri)</h2>
                <button type="submit" formaction="{{ route('admin.pages.profile.add-info') }}" class="btn-secondary" style="font-size:12px; padding:6px 12px;">+ Tambah Info</button>
            </div>

            @forelse($infos as $i => $inf)
                <div style="background:#F9FAFB; padding:16px; border:1px solid #E5E7EB; border-radius:6px; margin-bottom:12px; display:grid; grid-template-columns:1fr 2fr auto; gap:16px; align-items:end;">
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">Label (Contoh: Nama Lengkap)</label>
                        <input type="text" name="infos[{{$i}}][label]" class="form-input" value="{{ $inf['label'] ?? '' }}">
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">Nilai Data</label>
                        <input type="text" name="infos[{{$i}}][value]" class="form-input" value="{{ $inf['value'] ?? '' }}">
                    </div>
                    <button type="submit" formmethod="POST" formaction="{{ route('admin.pages.profile.delete-info', $i) }}"
                            class="btn-secondary" style="background:#FEF2F2; color:#EF4444; border-color:#FCA5A5;">
                        Hapus
                    </button>
                </div>
            @empty
                <p style="color:#6B7280; font-size:13px; font-style:italic;">Belum ada info pribadi.</p>
            @endforelse
        </div>

        {{-- ── 4. TIMELINE KARIR ────────────────────────────────────────────── --}}
        <div class="admin-card" style="margin-top:24px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <h2 class="card-title" style="margin:0;">4. Riwayat Karir (Timeline)</h2>
                <button type="submit" formaction="{{ route('admin.pages.profile.add-timeline') }}" class="btn-secondary" style="font-size:12px; padding:6px 12px;">+ Tambah Timeline</button>
            </div>

            @forelse($timelines as $i => $tl)
                <div style="background:#F9FAFB; padding:16px; border:1px solid #E5E7EB; border-radius:6px; margin-bottom:12px; position:relative;">
                    <button type="submit" formmethod="POST" formaction="{{ route('admin.pages.profile.delete-timeline', $i) }}"
                            style="position:absolute;top:12px;right:12px;color:#EF4444;background:transparent;border:none;cursor:pointer;font-weight:600;font-size:12px;">
                        Hapus
                    </button>
                    
                    <div style="display:grid; grid-template-columns:120px 1fr 1fr; gap:16px;">
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Tahun/Periode</label>
                            <input type="text" name="timelines[{{$i}}][year]" class="form-input" value="{{ $tl['year'] ?? '' }}">
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Posisi / Jabatan</label>
                            <input type="text" name="timelines[{{$i}}][title]" class="form-input" value="{{ $tl['title'] ?? '' }}">
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Nama Klub/Tim</label>
                            <input type="text" name="timelines[{{$i}}][club_name]" class="form-input" value="{{ $tl['club_name'] ?? '' }}">
                        </div>
                    </div>
                    
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-top:12px;">
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Logo Klub (Opsional)</label>
                            @if(!empty($tl['club_logo']))
                                <div style="position:relative; display:inline-block; margin-bottom:12px;" x-data="{ remove_{{$i}}: false }">
                                    <img src="{{ asset('storage/'.$tl['club_logo']) }}" style="height:40px; object-fit:contain;" x-show="!remove_{{$i}}">
                                    <button type="button" x-show="!remove_{{$i}}" @click="remove_{{$i}} = true" style="position:absolute;top:-8px;right:-8px;width:20px;height:20px;background:#EF4444;border:none;border-radius:50%;color:#FFFFFF;cursor:pointer;">&times;</button>
                                    <input type="hidden" name="timelines[{{$i}}][remove_club_logo]" x-bind:value="remove_{{$i}} ? '1' : '0'">
                                </div>
                            @endif
                            <input type="file" name="timelines[{{$i}}][club_logo]" class="form-input" accept="image/*">
                        </div>
                        
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Keterangan Singkat</label>
                            <input type="text" name="timelines[{{$i}}][description]" class="form-input" value="{{ $tl['description'] ?? '' }}">
                        </div>
                    </div>
                </div>
            @empty
                <p style="color:#6B7280; font-size:13px; font-style:italic;">Belum ada riwayat karir.</p>
            @endforelse
        </div>

        {{-- ── 5. PENDIDIKAN FORMAL ─────────────────────────────────────────── --}}
        <div class="admin-card" style="margin-top:24px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <h2 class="card-title" style="margin:0;">5. Pendidikan Formal</h2>
                <button type="submit" formaction="{{ route('admin.pages.profile.add-education') }}" class="btn-secondary" style="font-size:12px; padding:6px 12px;">+ Tambah Pendidikan</button>
            </div>

            @forelse($educations as $i => $edu)
                <div style="background:#F9FAFB; padding:16px; border:1px solid #E5E7EB; border-radius:6px; margin-bottom:12px; position:relative;">
                    <button type="submit" formmethod="POST" formaction="{{ route('admin.pages.profile.delete-education', $i) }}"
                            style="position:absolute;top:12px;right:12px;color:#EF4444;background:transparent;border:none;cursor:pointer;font-weight:600;font-size:12px;">
                        Hapus
                    </button>
                    
                    <div style="display:grid; grid-template-columns:120px 1fr 1fr; gap:16px; align-items:end;">
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Tahun</label>
                            <input type="text" name="educations[{{$i}}][year]" class="form-input" value="{{ $edu['year'] ?? '' }}">
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Institusi</label>
                            <input type="text" name="educations[{{$i}}][institution]" class="form-input" value="{{ $edu['institution'] ?? '' }}">
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Gelar / Jurusan</label>
                            <input type="text" name="educations[{{$i}}][degree]" class="form-input" value="{{ $edu['degree'] ?? '' }}">
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin-top:12px;">
                        <label class="form-label">Logo Institusi (Opsional)</label>
                        @if(!empty($edu['logo']))
                            <div style="position:relative; display:inline-block; margin-bottom:12px;" x-data="{ remove_edu_{{$i}}: false }">
                                <img src="{{ asset('storage/'.$edu['logo']) }}" style="height:40px; object-fit:contain;" x-show="!remove_edu_{{$i}}">
                                <button type="button" x-show="!remove_edu_{{$i}}" @click="remove_edu_{{$i}} = true" style="position:absolute;top:-8px;right:-8px;width:20px;height:20px;background:#EF4444;border:none;border-radius:50%;color:#FFFFFF;cursor:pointer;">&times;</button>
                                <input type="hidden" name="educations[{{$i}}][remove_logo]" x-bind:value="remove_edu_{{$i}} ? '1' : '0'">
                            </div>
                        @endif
                        <input type="file" name="educations[{{$i}}][logo]" class="form-input" accept="image/*">
                    </div>
                </div>
            @empty
                <p style="color:#6B7280; font-size:13px; font-style:italic;">Belum ada riwayat pendidikan.</p>
            @endforelse
        </div>

        {{-- ── 6. SERTIFIKASI & NON FORMAL ──────────────────────────────────── --}}
        <div class="admin-card" style="margin-top:24px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <h2 class="card-title" style="margin:0;">6. Sertifikasi & Non Formal</h2>
                <button type="submit" formaction="{{ route('admin.pages.profile.add-certification') }}" class="btn-secondary" style="font-size:12px; padding:6px 12px;">+ Tambah Sertifikasi</button>
            </div>

            @forelse($certifications as $i => $cert)
                <div style="background:#F9FAFB; padding:16px; border:1px solid #E5E7EB; border-radius:6px; margin-bottom:12px; position:relative;">
                    <button type="submit" formmethod="POST" formaction="{{ route('admin.pages.profile.delete-certification', $i) }}"
                            style="position:absolute;top:12px;right:12px;color:#EF4444;background:transparent;border:none;cursor:pointer;font-weight:600;font-size:12px;">
                        Hapus
                    </button>
                    
                    <div style="display:grid; grid-template-columns:120px 1fr; gap:16px; align-items:end;">
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Tahun</label>
                            <input type="text" name="certifications[{{$i}}][year]" class="form-input" value="{{ $cert['year'] ?? '' }}">
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Nama Sertifikasi / Lembaga</label>
                            <input type="text" name="certifications[{{$i}}][title]" class="form-input" value="{{ $cert['title'] ?? '' }}">
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin-top:12px;">
                        <label class="form-label">Logo (Opsional)</label>
                        @if(!empty($cert['logo']))
                            <div style="position:relative; display:inline-block; margin-bottom:12px;" x-data="{ remove_cert_{{$i}}: false }">
                                <img src="{{ asset('storage/'.$cert['logo']) }}" style="height:40px; object-fit:contain;" x-show="!remove_cert_{{$i}}">
                                <button type="button" x-show="!remove_cert_{{$i}}" @click="remove_cert_{{$i}} = true" style="position:absolute;top:-8px;right:-8px;width:20px;height:20px;background:#EF4444;border:none;border-radius:50%;color:#FFFFFF;cursor:pointer;">&times;</button>
                                <input type="hidden" name="certifications[{{$i}}][remove_logo]" x-bind:value="remove_cert_{{$i}} ? '1' : '0'">
                            </div>
                        @endif
                        <input type="file" name="certifications[{{$i}}][logo]" class="form-input" accept="image/*">
                    </div>
                </div>
            @empty
                <p style="color:#6B7280; font-size:13px; font-style:italic;">Belum ada riwayat sertifikasi.</p>
            @endforelse
        </div>

        {{-- ── 7. PENGALAMAN ORGANISASI ─────────────────────────────────────── --}}
        <div class="admin-card" style="margin-top:24px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <h2 class="card-title" style="margin:0;">7. Pengalaman Organisasi</h2>
                <button type="submit" formaction="{{ route('admin.pages.profile.add-organization') }}" class="btn-secondary" style="font-size:12px; padding:6px 12px;">+ Tambah Organisasi</button>
            </div>

            @forelse($organizations as $i => $org)
                <div style="background:#F9FAFB; padding:16px; border:1px solid #E5E7EB; border-radius:6px; margin-bottom:12px; position:relative;">
                    <button type="submit" formmethod="POST" formaction="{{ route('admin.pages.profile.delete-organization', $i) }}"
                            style="position:absolute;top:12px;right:12px;color:#EF4444;background:transparent;border:none;cursor:pointer;font-weight:600;font-size:12px;">
                        Hapus
                    </button>
                    
                    <div style="display:grid; grid-template-columns:120px 1fr 1fr; gap:16px; align-items:end;">
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Tahun</label>
                            <input type="text" name="organizations[{{$i}}][year]" class="form-input" value="{{ $org['year'] ?? '' }}">
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Jabatan</label>
                            <input type="text" name="organizations[{{$i}}][role]" class="form-input" value="{{ $org['role'] ?? '' }}">
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Nama Organisasi</label>
                            <input type="text" name="organizations[{{$i}}][organization]" class="form-input" value="{{ $org['organization'] ?? '' }}">
                        </div>
                    </div>
                    
                    <div class="form-group" style="margin-top:12px;">
                        <label class="form-label">Logo Organisasi (Opsional)</label>
                        @if(!empty($org['logo']))
                            <div style="position:relative; display:inline-block; margin-bottom:12px;" x-data="{ remove_org_{{$i}}: false }">
                                <img src="{{ asset('storage/'.$org['logo']) }}" style="height:40px; object-fit:contain;" x-show="!remove_org_{{$i}}">
                                <button type="button" x-show="!remove_org_{{$i}}" @click="remove_org_{{$i}} = true" style="position:absolute;top:-8px;right:-8px;width:20px;height:20px;background:#EF4444;border:none;border-radius:50%;color:#FFFFFF;cursor:pointer;">&times;</button>
                                <input type="hidden" name="organizations[{{$i}}][remove_logo]" x-bind:value="remove_org_{{$i}} ? '1' : '0'">
                            </div>
                        @endif
                        <input type="file" name="organizations[{{$i}}][logo]" class="form-input" accept="image/*">
                    </div>
                </div>
            @empty
                <p style="color:#6B7280; font-size:13px; font-style:italic;">Belum ada riwayat organisasi.</p>
            @endforelse
        </div>

        {{-- ── 8. PENCAPAIAN & PRESTASI ─────────────────────────────────────── --}}
        <div class="admin-card" style="margin-top:24px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <h2 class="card-title" style="margin:0;">8. Pencapaian / Prestasi</h2>
                <button type="submit" formaction="{{ route('admin.pages.profile.add-achievement') }}" class="btn-secondary" style="font-size:12px; padding:6px 12px;">+ Tambah Prestasi</button>
            </div>

            @forelse($achievements as $i => $ach)
                <div style="background:#F9FAFB; padding:16px; border:1px solid #E5E7EB; border-radius:6px; margin-bottom:12px; position:relative;">
                    <button type="submit" formmethod="POST" formaction="{{ route('admin.pages.profile.delete-achievement', $i) }}"
                            style="position:absolute;top:12px;right:12px;color:#EF4444;background:transparent;border:none;cursor:pointer;font-weight:600;font-size:12px;">
                        Hapus
                    </button>
                    
                    <div style="display:grid; grid-template-columns:120px 1fr; gap:16px; align-items:end;">
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Tahun</label>
                            <input type="text" name="achievements[{{$i}}][year]" class="form-input" value="{{ $ach['year'] ?? '' }}">
                        </div>
                        <div class="form-group" style="margin:0;">
                            <label class="form-label">Pencapaian</label>
                            <input type="text" name="achievements[{{$i}}][title]" class="form-input" value="{{ $ach['title'] ?? '' }}">
                        </div>
                    </div>
                </div>
            @empty
                <p style="color:#6B7280; font-size:13px; font-style:italic;">Belum ada riwayat prestasi.</p>
            @endforelse
        </div>

        {{-- ── 9. SOCIAL MEDIA ──────────────────────────────────────────────── --}}
        <div class="admin-card" style="margin-top:24px;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px;">
                <h2 class="card-title" style="margin:0;">9. Media Sosial Khusus Profil</h2>
                <button type="submit" formaction="{{ route('admin.pages.profile.add-social') }}" class="btn-secondary" style="font-size:12px; padding:6px 12px;">+ Tambah Sosmed</button>
            </div>

            @forelse($socials as $i => $soc)
                <div style="background:#F9FAFB; padding:16px; border:1px solid #E5E7EB; border-radius:6px; margin-bottom:12px; display:grid; grid-template-columns:1fr 2fr auto; gap:16px; align-items:end;">
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">Platform Sosial Media</label>
                        <select name="socials[{{$i}}][platform]" class="form-input" style="background:#FFFFFF;">
                            @php
                                $platforms = ['Instagram','YouTube','LinkedIn','Facebook','Twitter / X','TikTok','Telegram','WhatsApp'];
                                $cur = $soc['platform'] ?? '';
                            @endphp
                            @foreach($platforms as $pl)
                                <option value="{{ $pl }}" {{ $cur == $pl ? 'selected' : '' }}>{{ $pl }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" style="margin:0;">
                        <label class="form-label">URL Lengkap (https://...)</label>
                        <input type="text" name="socials[{{$i}}][link]" class="form-input" value="{{ $soc['link'] ?? '' }}" placeholder="https://">
                    </div>
                    <button type="submit" formmethod="POST" formaction="{{ route('admin.pages.profile.delete-social', $i) }}"
                            class="btn-secondary" style="background:#FEF2F2; color:#EF4444; border-color:#FCA5A5;">
                        Hapus
                    </button>
                </div>
            @empty
                <p style="color:#6B7280; font-size:13px; font-style:italic;">Belum ada social media.</p>
            @endforelse
        </div>

        {{-- Sticky Save Button --}}
        <div style="position:fixed; bottom:0; left:260px; right:0; background:#FFFFFF; padding:16px 40px; border-top:1px solid #E5E7EB; display:flex; justify-content:flex-end; z-index:90; box-shadow:0 -4px 6px -1px rgba(0,0,0,0.05);">
            <button type="submit" class="btn-primary" style="padding:12px 32px; font-size:15px; width:200px;">Simpan Perubahan</button>
        </div>
    </form>
</div>
@endsection
