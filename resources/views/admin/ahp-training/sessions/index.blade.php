@extends('admin.layouts.admin')
@section('title', 'Sesi Test')

@section('breadcrumb')
    <span class="breadcrumb-sep">/</span>
    <a href="{{ route('admin.ahp.dashboard') }}" style="color:#9E9E9E;text-decoration:none;font-size:12px;">AHP Training</a>
    <span class="breadcrumb-sep">/</span>
    <span class="breadcrumb-current">Sesi Test</span>
@endsection

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
    <div>
        <h1 class="page-title">Manajemen Sesi Test</h1>
        <p class="page-subtitle">{{ $sessions->count() }} sesi terdaftar.</p>
    </div>
    <a href="{{ route('admin.ahp.sessions.create') }}" class="btn-silver" style="font-size:13px;">+ Buat Sesi</a>
</div>

@if(session('success'))
<div style="background:#F0FDF4;border:1px solid #BBF7D0;padding:12px 16px;margin-bottom:20px;font-size:12px;color:#166534;">{{ session('success') }}</div>
@endif

<div class="admin-card" style="border-radius:0;">
    <div class="admin-card-body" style="padding:0;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#F9F9F9;border-bottom:2px solid #E0E0E0;">
                    <th style="padding:10px 16px;text-align:left;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Sesi</th>
                    <th style="padding:10px 16px;text-align:left;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Lokasi</th>
                    <th style="padding:10px 16px;text-align:center;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Tanggal</th>
                    <th style="padding:10px 16px;text-align:center;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Pemain</th>
                    <th style="padding:10px 16px;text-align:right;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($sessions as $s)
            <tr style="border-bottom:1px solid #F5F5F5;" onmouseover="this.style.background='#FAFAFA'" onmouseout="this.style.background='transparent'">
                <td style="padding:12px 16px;">
                    <p style="font-size:13px;font-weight:600;color:#212121;">{{ $s->label }}</p>
                    @if($s->period_week)
                    <p style="font-size:10px;color:#9E9E9E;">Minggu ke-{{ $s->period_week }}</p>
                    @endif
                </td>
                <td style="padding:12px 16px;font-size:12px;color:#424242;">{{ $s->location ?? '—' }}</td>
                <td style="padding:12px 16px;text-align:center;font-size:12px;color:#424242;font-family:monospace;">{{ $s->test_date->format('d M Y') }}</td>
                <td style="padding:12px 16px;text-align:center;">
                    <span style="font-size:12px;font-weight:600;color:#212121;">{{ $s->results_count }}</span>
                    <span style="font-size:10px;color:#9E9E9E;"> pemain</span>
                </td>
                <td style="padding:12px 16px;text-align:right;">
                    <div style="display:flex;gap:10px;justify-content:flex-end;">
                        <a href="{{ route('admin.ahp.results.index', $s) }}" style="font-size:11px;color:#424242;text-decoration:none;border-bottom:1px solid #E0E0E0;padding-bottom:1px;">Input Data</a>
                        <a href="{{ route('admin.ahp.results.import', $s) }}" style="font-size:11px;color:#424242;text-decoration:none;border-bottom:1px solid #E0E0E0;padding-bottom:1px;">Import Excel</a>
                        <a href="{{ route('admin.ahp.sessions.edit', $s) }}" style="font-size:11px;color:#424242;text-decoration:none;border-bottom:1px solid #E0E0E0;padding-bottom:1px;">Edit</a>
                        <form method="POST" action="{{ route('admin.ahp.sessions.destroy', $s) }}" style="display:inline;" onsubmit="return confirm('Hapus sesi ini? Semua data hasil test akan terhapus!')">
                            @csrf @method('DELETE')
                            <button type="submit" style="font-size:11px;color:#DC2626;background:none;border:none;border-bottom:1px solid #FCA5A5;cursor:pointer;font-family:inherit;padding:0 0 1px;">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="padding:40px;text-align:center;color:#9E9E9E;font-size:12px;">Belum ada sesi. <a href="{{ route('admin.ahp.sessions.create') }}" style="color:#212121;">Buat sekarang →</a></td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
