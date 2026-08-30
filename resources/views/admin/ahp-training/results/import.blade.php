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
        <div>
            <a href="{{ route('admin.ahp.results.template') }}" class="btn-outline" style="font-size:12px;">⬇ Download Template CSV</a>
            <p class="hint" style="margin-top:6px;">Download template, isi datanya, lalu upload kembali.</p>
        </div>
        <form action="{{ route('admin.ahp.results.import.post', $session) }}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group" style="margin:0 0 16px;">
                <label class="form-label" for="file">Pilih File Excel (.xlsx / .xls)</label>
                <input type="file" id="file" name="file" class="form-input" accept=".xlsx,.xls" required>
                @error('file')<p style="color:#EF4444;font-size:11px;margin-top:4px;">{{ $message }}</p>@enderror
            </div>
            <button type="submit" class="btn-silver" style="font-size:13px;">📥 Import & Simpan</button>
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
                    @foreach(['NO REG','NAME','DATE OF BIRTH','AGE (years)','HEIGHT (cm)','WEIGHT (kg)','Body Mass Index (BMI)','Body Fat Percentage %','Skeletal Muscle Mass','Skor MoCA INA','Jumlah Total Passing','Passing Sukses','Passing Gagal','Jumlah Scanning (per 10 detik)','Initial Acceleration (0-10m)','Acceleration Phase (10-20m)','Maximal Speed/Velocity (20-30m)','RAST Test','Level (Yo-Yo)','Balikan','Distance'] as $col)
                    <th style="padding:8px 10px;text-align:left;font-weight:600;white-space:nowrap;color:#9E9E9E;letter-spacing:0.05em;">{{ $col }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom:1px solid #F0F0F0;">
                    @foreach(['AHP-03','MARIO KIDANG','22/01/2003','19','175','68.0','22.2','12.5','35.2','26','30','25','5','4.2','1.85','1.92','1.78','45.2','17','8','1120'] as $sample)
                    <td style="padding:8px 10px;color:#424242;font-family:monospace;white-space:nowrap;">{{ $sample }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
