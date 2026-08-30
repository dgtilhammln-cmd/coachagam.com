@extends('admin.layouts.admin')
@section('title', 'Import Excel — ' . $session->label)

@section('breadcrumb')
    <span class="breadcrumb-sep">/</span>
    <a href="{{ route('admin.ahp.results.index', $session) }}" style="color:#9E9E9E;text-decoration:none;font-size:12px;">{{ $session->label }}</a>
    <span class="breadcrumb-sep">/</span>
    <span class="breadcrumb-current">Import Excel</span>
@endsection

@section('content')
<div style="margin-bottom:24px;">
    <h1 class="page-title">Import Excel — {{ $session->label }}</h1>
    <p class="page-subtitle">{{ $session->test_date->format('d M Y') }}</p>
</div>

@if(session('error'))
<div style="background:#FEF2F2;border:1px solid #FECACA;padding:12px 16px;margin-bottom:16px;font-size:12px;color:#991B1B;">{{ session('error') }}</div>
@endif

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

{{-- Upload Form --}}
<div class="admin-card" style="border-radius:0;">
    <div class="admin-card-header"><h2>Upload File Excel</h2></div>
    <div class="admin-card-body" style="display:flex;flex-direction:column;gap:16px;">
        <div style="background:#FFFBEB;border:1px solid #FEF3C7;padding:12px 16px;font-size:12px;color:#92400E;display:flex;align-items:center;gap:8px;">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
            <span><strong>Catatan Penting:</strong> Kolom <b>AGE (years)</b> tidak perlu diisi secara manual. Sistem akan otomatis menghitung umur berdasarkan kolom <b>DATE OF BIRTH</b>.</span>
        </div>
        <div>
            <a href="{{ route('admin.ahp.results.template') }}" class="btn-outline" style="font-size:12px; display:inline-flex; align-items:center; gap:6px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                Download Template CSV
            </a>
            <p class="hint" style="margin-top:6px;">Download template, isi datanya, lalu upload kembali.</p>
        </div>
        <form action="{{ route('admin.ahp.results.import.post', $session) }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group" style="margin:0 0 16px;">
                <label class="form-label" for="file">Pilih File Excel (.xlsx / .xls)</label>
                <input type="file" id="file" name="file" class="form-input" accept=".xlsx,.xls,.csv" required>
                @error('file')<p style="color:#EF4444;font-size:11px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="btn-silver" style="font-size:13px; display:inline-flex; align-items:center; gap:6px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                Import & Simpan
            </button>
        </form>
    </div>
</div>

{{-- Guidelines --}}
<div class="admin-card" style="border-radius:0;">
    <div class="admin-card-header"><h2>Panduan Import TES MASTER</h2></div>
    <div class="admin-card-body">
        <ol style="font-size:11px;color:#424242;line-height:2;padding-left:16px;">
            <li>File harus berformat <strong>.xlsx</strong> atau <strong>.csv</strong> yang diexport dari Excel.</li>
            <li>Sistem akan otomatis membaca data pemain mulai dari <strong>Baris ke-5</strong> (Sesuai format TES MASTER).</li>
            <li>Kolom <strong>NO REG</strong> adalah acuan utama. Jika NO REG belum terdaftar, sistem otomatis <strong>membuatkan profil pemain baru</strong>.</li>
            <li>Kolom <strong>DATE OF BIRTH</strong> akan otomatis disesuaikan (mendukung format angka excel maupun teks dd/mm/yyyy).</li>
            <li>Kolom hasil tes bisa dibiarkan kosong, maka tidak akan dicatat skornya.</li>
            <li>Jika baris kosong pada file, sistem akan mengabaikannya secara otomatis.</li>
        </ol>
    </div>
</div>

</div>

{{-- Column Reference --}}
<div class="admin-card" style="border-radius:0;margin-top:20px;">
    <div class="admin-card-header"><h2>Urutan Kolom Excel (Sesuai TES MASTER Client)</h2></div>
    <div class="admin-card-body" style="padding:0;overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;font-size:10px;">
            <thead>
                <tr style="background:#F9F9F9;border-bottom:2px solid #E0E0E0;">
                    @foreach(['NO REG','NAME','DATE OF BIRTH','AGE (years)','HEIGHT (cm)','WEIGHT (kg)','Body Mass Index (BMI)','Body Fat Percentage2','Skeletal Muscle Mass','Skor MoCA INA','Jumlah Total Passing','Passing Sukses','Passing Gagal','Jumlah Scaning (per 10 detik)','Initial Acceleration (0-10m)2','Acceleration Phase (10-20m)3','Maximal Speed/ Velocity (20-30m)4','RAST Test','Level','Balikan','Distance', 'Vo2max'] as $col)
                    <th style="padding:8px 10px;text-align:left;font-weight:600;white-space:nowrap;color:#9E9E9E;letter-spacing:0.05em;">{{ $col }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #F0F0F0;">
                    @foreach(['AHP-03','MARIO KIDANG','22/01/2003','21','175','68.0','22.2','12.5','35.2','26','30','25','5','4.2','1.85','1.92','1.78','45.2','17','8','1120', '52.4'] as $sample)
                    <td style="padding:8px 10px;color:#424242;font-family:monospace;white-space:nowrap;">{{ $sample }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
