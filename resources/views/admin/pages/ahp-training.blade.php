@extends('admin.layouts.admin')

@section('title', 'AHP Training — Page Management')

@section('content')
<div style="max-width: 960px; margin: 0 auto; padding: 40px 32px;">

    {{-- Header --}}
    <div style="margin-bottom: 32px;">
        <div style="display:flex; align-items:center; gap:12px; margin-bottom:8px;">
            <div style="width:36px; height:36px; background:rgba(255,255,255,0.07); display:flex; align-items:center; justify-content:center;">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#aaa" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
            </div>
            <div>
                <h1 style="font-size:20px; font-weight:700; color:#F5F5F5; margin:0; letter-spacing:-0.3px;">Pengaturan AHP Training</h1>
                <p style="font-size:13px; color:#555; margin:0;">Kelola 6 section halaman /ahp-training.</p>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div style="background:rgba(52,211,153,0.1); border:1px solid rgba(52,211,153,0.3); color:#6EE7B7; padding:14px 18px; font-size:13px; font-weight:600; margin-bottom:28px; display:flex; align-items:center; gap:10px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.pages.ahp-training.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- ─── INTRO / HERO ─────────────────────────────────────────── --}}
        <div class="admin-section">
            <div class="admin-section-header">
                <h2>Intro & Hero</h2>
                <p>Breadcrumb, judul besar, deskripsi, gambar, dan statistik overview.</p>
            </div>
            <div class="admin-section-body">
                <div class="grid-2">
                    <div>
                        <label class="field-label">Judul Breadcrumb</label>
                        <input type="text" name="hero_title" value="{{ old('hero_title', $heroTitle) }}" required class="field-input" placeholder="AHP Training">
                    </div>
                    <div>
                        <label class="field-label">Subjudul Breadcrumb</label>
                        <input type="text" name="hero_subtitle" value="{{ old('hero_subtitle', $heroSubtitle) }}" class="field-input" placeholder="Program Pelatihan Sepakbola Profesional">
                    </div>
                </div>
                <div class="grid-2">
                    <div>
                        <label class="field-label">Label Eyebrow</label>
                        <input type="text" name="intro_eyebrow_label" value="{{ old('intro_eyebrow_label', $introEyebrowLabel) }}" class="field-input" placeholder="Overview Program">
                    </div>
                    <div>
                        <label class="field-label">Badge Pojok Gambar</label>
                        <input type="text" name="intro_badge_text" value="{{ old('intro_badge_text', $introBadgeText) }}" class="field-input" placeholder="Program Eksklusif">
                    </div>
                </div>
                <div class="grid-2">
                    <div>
                        <label class="field-label">Judul Besar — Bold</label>
                        <input type="text" name="intro_headline_bold" value="{{ old('intro_headline_bold', $introHeadlineBold) }}" class="field-input" placeholder="Agility. Heading.">
                    </div>
                    <div>
                        <label class="field-label">Judul Besar — Tipis/Italic</label>
                        <input type="text" name="intro_headline_thin" value="{{ old('intro_headline_thin', $introHeadlineThin) }}" class="field-input" placeholder="Training Terstruktur">
                    </div>
                </div>
                <div>
                    <label class="field-label">Deskripsi (HTML diperbolehkan)</label>
                    <textarea name="about_text" rows="4" class="field-textarea">{{ old('about_text', $aboutText) }}</textarea>
                </div>
                <div class="grid-2">
                    <div>
                        <label class="field-label">Gambar Intro (kanan)</label>
                        @if($aboutImage)
                            <div class="img-preview"><img src="{{ asset('storage/'.$aboutImage) }}" alt="Preview"></div>
                            <label class="remove-label"><input type="checkbox" name="remove_about_image" value="1"> Hapus gambar</label>
                        @endif
                        <input type="file" name="about_image" accept="image/*" class="field-file">
                        <p class="field-hint">Rekomendasi: 800×600px.</p>
                    </div>
                    <div>
                        <label class="field-label">Background Halaman Player</label>
                        @if($playerBg)
                            <div class="img-preview"><img src="{{ asset('storage/'.$playerBg) }}" alt="Preview"></div>
                            <label class="remove-label"><input type="checkbox" name="remove_player_bg" value="1"> Hapus gambar</label>
                        @endif
                        <input type="file" name="player_bg" accept="image/*" class="field-file">
                    </div>
                </div>
                {{-- Stats --}}
                <div class="grid-3">
                    <div>
                        <label class="field-label">Angka 1</label>
                        <input type="text" name="stat1_value" value="{{ old('stat1_value', $stat1Value) }}" class="field-input" placeholder="6">
                        <label class="field-label" style="margin-top:8px;">Label 1</label>
                        <input type="text" name="stat1_label" value="{{ old('stat1_label', $stat1Label) }}" class="field-input" placeholder="Tahapan Terstruktur">
                    </div>
                    <div>
                        <label class="field-label">Angka 2</label>
                        <input type="text" name="stat2_value" value="{{ old('stat2_value', $stat2Value) }}" class="field-input" placeholder="100%">
                        <label class="field-label" style="margin-top:8px;">Label 2</label>
                        <input type="text" name="stat2_label" value="{{ old('stat2_label', $stat2Label) }}" class="field-input" placeholder="Berbasis Data">
                    </div>
                    <div>
                        <label class="field-label">Angka 3</label>
                        <input type="text" name="stat3_value" value="{{ old('stat3_value', $stat3Value) }}" class="field-input" placeholder="AFC">
                        <label class="field-label" style="margin-top:8px;">Label 3</label>
                        <input type="text" name="stat3_label" value="{{ old('stat3_label', $stat3Label) }}" class="field-input" placeholder="Lisensi Pelatih">
                    </div>
                </div>
            </div>
        </div>

        {{-- ─── SECTION 1: PRE TEST ─────────────────────────────────── --}}
        <div class="admin-section">
            <div class="admin-section-header">
                <h2>🟢 Section 1 — Pre Test</h2>
                <p>Judul, deskripsi, gambar, dan daftar item tes awal.</p>
            </div>
            <div class="admin-section-body">
                <div class="grid-2">
                    <div>
                        <label class="field-label">Judul Section</label>
                        <input type="text" name="pretest_title" value="{{ old('pretest_title', $pretestTitle) }}" class="field-input" placeholder="Pre Test">
                    </div>
                    <div>
                        <label class="field-label">Gambar</label>
                        @if($pretestImage)
                            <div class="img-preview"><img src="{{ asset('storage/'.$pretestImage) }}" alt="Preview"></div>
                            <label class="remove-label"><input type="checkbox" name="remove_pretest_image" value="1"> Hapus gambar</label>
                        @endif
                        <input type="file" name="pretest_image" accept="image/*" class="field-file">
                    </div>
                </div>
                <div>
                    <label class="field-label">Deskripsi</label>
                    <textarea name="pretest_desc" rows="3" class="field-textarea">{{ old('pretest_desc', $pretestDesc) }}</textarea>
                </div>
                <div>
                    <label class="field-label">Daftar Item Tes <span style="color:#555; font-weight:400; text-transform:none; letter-spacing:0;">(satu per baris — tampil sebagai bullet list)</span></label>
                    <textarea name="pretest_items" rows="6" class="field-textarea" placeholder="Pengukuran BMI & Komposisi Tubuh&#10;Tes MoCA (Kognitif)&#10;Tes Passing & Scanning">{{ old('pretest_items', $pretestItems) }}</textarea>
                </div>
            </div>
        </div>

        {{-- ─── SECTION 2: PROGRAM LATIHAN ─────────────────────────── --}}
        <div class="admin-section">
            <div class="admin-section-header">
                <h2>⚫ Section 2 — Program Latihan (Tahunan · Bulanan · Mingguan · Harian)</h2>
                <p>4 kartu program yang tampil di section gelap.</p>
            </div>
            <div class="admin-section-body">
                <div class="grid-2">
                    <div>
                        <label class="field-label">Judul Section</label>
                        <input type="text" name="program_title" value="{{ old('program_title', $programTitle) }}" class="field-input" placeholder="Program Latihan">
                    </div>
                    <div>
                        <label class="field-label">Subjudul</label>
                        <input type="text" name="program_subtitle" value="{{ old('program_subtitle', $programSubtitle) }}" class="field-input" placeholder="Tahunan · Bulanan · Mingguan · Harian">
                    </div>
                </div>
                <div>
                    <label class="field-label">Deskripsi Section</label>
                    <textarea name="program_desc" rows="2" class="field-textarea">{{ old('program_desc', $programDesc) }}</textarea>
                </div>
                {{-- 4 Program Cards --}}
                @foreach($programCards as $ci => $card)
                <div style="background:#1A1A1A; border:1px solid rgba(255,255,255,0.07); padding:18px; display:flex; flex-direction:column; gap:12px;">
                    <div style="font-size:10px; font-weight:800; letter-spacing:3px; color:#555; text-transform:uppercase;">Kartu {{ $ci + 1 }}</div>
                    <div class="grid-2">
                        <div>
                            <label class="field-label-sm">Judul Kartu</label>
                            <input type="text" name="program_cards[{{ $ci }}][title]" value="{{ old('program_cards.'.$ci.'.title', $card['title'] ?? '') }}" class="field-input" placeholder="Tahunan">
                        </div>
                        <div>
                            <label class="field-label-sm">Icon (SVG HTML)</label>
                            <input type="text" name="program_cards[{{ $ci }}][icon]" value="{{ old('program_cards.'.$ci.'.icon', $card['icon'] ?? '') }}" class="field-input-mono" placeholder="<svg>...</svg>">
                        </div>
                    </div>
                    <div>
                        <label class="field-label-sm">Deskripsi Kartu</label>
                        <textarea name="program_cards[{{ $ci }}][desc]" rows="2" class="field-textarea">{{ old('program_cards.'.$ci.'.desc', $card['desc'] ?? '') }}</textarea>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ─── SECTION 3: VOLUME & INTENSITAS ───────────────────────── --}}
        <div class="admin-section">
            <div class="admin-section-header">
                <h2>⚪ Section 3 — Volume dan Intensitas Latihan</h2>
                <p>Judul, deskripsi, gambar, dan 3 statistik angka.</p>
            </div>
            <div class="admin-section-body">
                <div class="grid-2">
                    <div>
                        <label class="field-label">Judul Section</label>
                        <input type="text" name="volume_title" value="{{ old('volume_title', $volumeTitle) }}" class="field-input" placeholder="Volume dan Intensitas Latihan">
                    </div>
                    <div>
                        <label class="field-label">Gambar</label>
                        @if($volumeImage)
                            <div class="img-preview"><img src="{{ asset('storage/'.$volumeImage) }}" alt="Preview"></div>
                            <label class="remove-label"><input type="checkbox" name="remove_volume_image" value="1"> Hapus gambar</label>
                        @endif
                        <input type="file" name="volume_image" accept="image/*" class="field-file">
                    </div>
                </div>
                <div>
                    <label class="field-label">Deskripsi</label>
                    <textarea name="volume_desc" rows="3" class="field-textarea">{{ old('volume_desc', $volumeDesc) }}</textarea>
                </div>
                {{-- Volume stats 3 items --}}
                <div style="display:flex; flex-direction:column; gap:10px;">
                    <label class="field-label">Statistik (3 angka)</label>
                    @foreach($volumeStats as $vi => $vs)
                    <div class="grid-2" style="background:#1A1A1A; border:1px solid rgba(255,255,255,0.06); padding:12px; gap:12px;">
                        <div>
                            <label class="field-label-sm">Angka/Nilai</label>
                            <input type="text" name="volume_stats[{{ $vi }}][value]" value="{{ old('volume_stats.'.$vi.'.value', $vs['value'] ?? '') }}" class="field-input" placeholder="8">
                        </div>
                        <div>
                            <label class="field-label-sm">Label</label>
                            <input type="text" name="volume_stats[{{ $vi }}][label]" value="{{ old('volume_stats.'.$vi.'.label', $vs['label'] ?? '') }}" class="field-input" placeholder="Minggu Program">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ─── SECTION 4: EVALUATION TRAINING LOAD ───────────────── --}}
        <div class="admin-section">
            <div class="admin-section-header">
                <h2>🟢 Section 4 — Evaluation Training Load</h2>
                <p>Judul, deskripsi, gambar, dan poin evaluasi.</p>
            </div>
            <div class="admin-section-body">
                <div class="grid-2">
                    <div>
                        <label class="field-label">Judul Section</label>
                        <input type="text" name="eval_title" value="{{ old('eval_title', $evalTitle) }}" class="field-input" placeholder="Evaluation Training Load">
                    </div>
                    <div>
                        <label class="field-label">Gambar</label>
                        @if($evalImage)
                            <div class="img-preview"><img src="{{ asset('storage/'.$evalImage) }}" alt="Preview"></div>
                            <label class="remove-label"><input type="checkbox" name="remove_eval_image" value="1"> Hapus gambar</label>
                        @endif
                        <input type="file" name="eval_image" accept="image/*" class="field-file">
                    </div>
                </div>
                <div>
                    <label class="field-label">Deskripsi</label>
                    <textarea name="eval_desc" rows="3" class="field-textarea">{{ old('eval_desc', $evalDesc) }}</textarea>
                </div>
                <div>
                    <label class="field-label">Poin Evaluasi <span style="color:#555; font-weight:400; text-transform:none; letter-spacing:0;">(satu per baris)</span></label>
                    <textarea name="eval_points" rows="5" class="field-textarea" placeholder="Monitoring RPE (Rate of Perceived Exertion)&#10;Analisis Heart Rate Zone&#10;Evaluasi Kualitas Gerak&#10;Data Tracking Per Sesi">{{ old('eval_points', $evalPoints) }}</textarea>
                </div>
            </div>
        </div>

        {{-- ─── SECTION 5: POST TEST ───────────────────────────────── --}}
        <div class="admin-section">
            <div class="admin-section-header">
                <h2>⚪ Section 5 — Post Test</h2>
                <p>Judul, deskripsi, gambar, dan daftar item tes akhir.</p>
            </div>
            <div class="admin-section-body">
                <div class="grid-2">
                    <div>
                        <label class="field-label">Judul Section</label>
                        <input type="text" name="posttest_title" value="{{ old('posttest_title', $posttestTitle) }}" class="field-input" placeholder="Post Test">
                    </div>
                    <div>
                        <label class="field-label">Gambar</label>
                        @if($posttestImage)
                            <div class="img-preview"><img src="{{ asset('storage/'.$posttestImage) }}" alt="Preview"></div>
                            <label class="remove-label"><input type="checkbox" name="remove_posttest_image" value="1"> Hapus gambar</label>
                        @endif
                        <input type="file" name="posttest_image" accept="image/*" class="field-file">
                    </div>
                </div>
                <div>
                    <label class="field-label">Deskripsi</label>
                    <textarea name="posttest_desc" rows="3" class="field-textarea">{{ old('posttest_desc', $posttestDesc) }}</textarea>
                </div>
                <div>
                    <label class="field-label">Daftar Item Tes <span style="color:#555; font-weight:400; text-transform:none; letter-spacing:0;">(satu per baris)</span></label>
                    <textarea name="posttest_items" rows="5" class="field-textarea" placeholder="Re-tes seluruh parameter Pre Test&#10;Perbandingan data Pre vs Post&#10;Analisis peningkatan performa">{{ old('posttest_items', $posttestItems) }}</textarea>
                </div>
            </div>
        </div>

        {{-- ─── SECTION 6: REPORT INDIVIDUAL PLAYERS ──────────────── --}}
        <div class="admin-section">
            <div class="admin-section-header">
                <h2>⚫ Section 6 — Report Individual Players</h2>
                <p>Judul, deskripsi, dan gambar opsional. Search box sudah otomatis terhubung ke database AHP.</p>
            </div>
            <div class="admin-section-body">
                <div class="grid-2">
                    <div>
                        <label class="field-label">Judul Section</label>
                        <input type="text" name="report_title" value="{{ old('report_title', $reportTitle) }}" class="field-input" placeholder="Report Individual Players">
                    </div>
                    <div>
                        <label class="field-label">Gambar Opsional</label>
                        @if($reportImage)
                            <div class="img-preview"><img src="{{ asset('storage/'.$reportImage) }}" alt="Preview"></div>
                            <label class="remove-label"><input type="checkbox" name="remove_report_image" value="1"> Hapus gambar</label>
                        @endif
                        <input type="file" name="report_image" accept="image/*" class="field-file">
                        <p class="field-hint">Gambar opsional, tampil di bawah deskripsi (jika diupload).</p>
                    </div>
                </div>
                <div>
                    <label class="field-label">Deskripsi</label>
                    <textarea name="report_desc" rows="3" class="field-textarea">{{ old('report_desc', $reportDesc) }}</textarea>
                </div>
                <div style="background:#111; border:1px solid rgba(255,255,255,0.06); padding:14px 18px; font-size:12px; color:#555; display:flex; align-items:center; gap:10px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#555" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    Search box (pencarian No. Registrasi pemain) sudah otomatis tampil di halaman publik. Kelola data pemain di menu <strong style="color:#aaa;">AHP Training → Pemain</strong>.
                </div>
            </div>
        </div>

        {{-- Save --}}
        <div style="display:flex; justify-content:flex-end; margin-bottom:60px; gap:12px; align-items:center;">
            <a href="{{ url('/ahp-training') }}" target="_blank" style="display:inline-flex; align-items:center; gap:7px; padding:13px 20px; background:transparent; border:1px solid rgba(255,255,255,0.1); color:#888; font-size:13px; font-weight:600; text-decoration:none; transition:all 150ms;"
               onmouseover="this.style.borderColor='rgba(255,255,255,0.3)';this.style.color='#fff'"
               onmouseout="this.style.borderColor='rgba(255,255,255,0.1)';this.style.color='#888'">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                Preview Halaman
            </a>
            <button type="submit" class="btn-primary-submit">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                Simpan Semua Pengaturan
            </button>
        </div>
    </form>
</div>

<style>
    .admin-section { background:#161616; border:1px solid rgba(255,255,255,0.07); overflow:hidden; margin-bottom:20px; }
    .admin-section-header { padding:18px 24px; border-bottom:1px solid rgba(255,255,255,0.05); }
    .admin-section-header h2 { font-size:14px; font-weight:700; color:#E5E5E5; margin:0 0 2px; }
    .admin-section-header p  { font-size:12px; color:#555; margin:0; }
    .admin-section-body { padding:24px; display:flex; flex-direction:column; gap:20px; }
    .grid-2 { display:grid; grid-template-columns:1fr 1fr; gap:20px; }
    .grid-3 { display:grid; grid-template-columns:1fr 1fr 1fr; gap:20px; }
    .field-label { display:block; font-size:11px; font-weight:700; color:#666; text-transform:uppercase; letter-spacing:0.8px; margin-bottom:7px; }
    .field-label-sm { display:block; font-size:11px; color:#555; margin-bottom:4px; }
    .field-input, .field-textarea, .field-input-mono {
        width:100%; box-sizing:border-box;
        background:#1A1A1A; border:1px solid rgba(255,255,255,0.08);
        padding:10px 13px; font-size:13px; color:#ddd; outline:none;
        font-family:'Montserrat', sans-serif; transition:border-color 150ms;
    }
    .field-input:focus, .field-textarea:focus, .field-input-mono:focus { border-color:rgba(255,255,255,0.25); }
    .field-textarea { resize:vertical; line-height:1.6; }
    .field-input-mono { font-family:monospace; font-size:12px; }
    .field-file { width:100%; box-sizing:border-box; background:#1A1A1A; border:1px dashed rgba(255,255,255,0.15); padding:10px; font-size:12px; color:#888; cursor:pointer; }
    .field-hint { font-size:11px; color:#444; margin:5px 0 0; }
    .img-preview { margin-bottom:8px; border:1px solid rgba(255,255,255,0.08); overflow:hidden; }
    .img-preview img { display:block; max-height:140px; width:100%; object-fit:cover; }
    .remove-label { display:inline-flex; align-items:center; gap:6px; font-size:11px; color:#ef4444; cursor:pointer; margin-bottom:10px; }
    .btn-primary-submit {
        display:inline-flex; align-items:center; gap:8px;
        padding:13px 32px; background:#fff; color:#111; border:none;
        font-weight:700; font-size:14px; cursor:pointer;
        transition:all 150ms; font-family:'Montserrat', sans-serif; letter-spacing:0.04em;
    }
    .btn-primary-submit:hover { background:#E5E5E5; }
    @media(max-width:640px){ .grid-2, .grid-3 { grid-template-columns:1fr; } }
</style>
@endsection
