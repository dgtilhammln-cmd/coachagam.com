@extends('admin.layouts.admin')
@section('title', 'AHP Training — Dashboard')

@section('breadcrumb')
    <span class="breadcrumb-sep">/</span>
    <span class="breadcrumb-current">AHP Training</span>
    <span class="breadcrumb-sep">/</span>
    <span class="breadcrumb-current">Dashboard</span>
@endsection

@section('content')
<div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:24px;gap:14px;flex-wrap:wrap;">
    <div>
        <h1 class="page-title">AHP Training Dashboard</h1>
        <p class="page-subtitle">Ringkasan data program latihan dan hasil test pemain.</p>
    </div>
    <div style="display:flex;gap:8px;">
        <a href="{{ route('admin.ahp.players.create') }}" class="btn-silver" style="font-size:13px;">+ Tambah Pemain</a>
        <a href="{{ route('admin.ahp.sessions.create') }}" class="btn-outline" style="font-size:13px;">+ Sesi Test</a>
    </div>
</div>

{{-- Stat Cards --}}
<div style="display:grid;grid-template-columns:repeat(4,1fr);gap:16px;margin-bottom:28px;">
    @foreach([
        ['Pemain Aktif', $totalPlayers, '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
        ['Total Sesi Test', $totalSessions, '<rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/>'],
        ['Rata-rata BMI', number_format($avgBmi, 1), '<path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>'],
        ['Rata-rata MoCA', number_format($avgMoca, 1), '<circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>'],
    ] as [$label, $val, $icon])
    <div class="admin-card" style="border-radius:0;border-left:3px solid #1A1A1A;">
        <div class="admin-card-body" style="padding:18px;">
            <div style="display:flex;align-items:center;justify-content:space-between;">
                <div>
                    <p style="font-size:10px;font-weight:600;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;margin-bottom:6px;">{{ $label }}</p>
                    <p style="font-size:28px;font-weight:700;color:#212121;letter-spacing:-0.02em;">{{ $val }}</p>
                </div>
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#BDBDBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">{!! $icon !!}</svg>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;">

{{-- Recent Players --}}
<div class="admin-card" style="border-radius:0;">
    <div class="admin-card-header" style="display:flex;align-items:center;justify-content:space-between;">
        <h2>Pemain Terbaru</h2>
        <a href="{{ route('admin.ahp.players.index') }}" style="font-size:11px;color:#9E9E9E;text-decoration:none;">Lihat Semua →</a>
    </div>
    <div class="admin-card-body" style="padding:0;">
        <table style="width:100%;border-collapse:collapse;">
            <tbody>
            @forelse($recentPlayers as $p)
            <tr style="border-bottom:1px solid #F5F5F5;">
                <td style="padding:10px 16px;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <img src="{{ $p->photo_url }}" alt="{{ $p->name }}" style="width:32px;height:32px;object-fit:cover;border:1px solid #E0E0E0;">
                        <div>
                            <p style="font-size:12px;font-weight:600;color:#212121;">{{ $p->name }}</p>
                            <p style="font-size:10px;color:#9E9E9E;font-family:monospace;">{{ $p->no_reg }}</p>
                        </div>
                    </div>
                </td>
                <td style="padding:10px 16px;text-align:right;">
                    <span style="font-size:10px;color:#9E9E9E;">{{ $p->position }}</span>
                </td>
                <td style="padding:10px 16px;text-align:right;">
                    <a href="{{ route('admin.ahp.players.show', $p) }}" style="font-size:11px;color:#212121;text-decoration:none;border-bottom:1px solid #E0E0E0;">Lihat</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="3" style="padding:20px 16px;text-align:center;color:#9E9E9E;font-size:12px;">Belum ada pemain</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Sessions List --}}
<div class="admin-card" style="border-radius:0;">
    <div class="admin-card-header" style="display:flex;align-items:center;justify-content:space-between;">
        <h2>Sesi Test</h2>
        <a href="{{ route('admin.ahp.sessions.create') }}" style="font-size:11px;color:#9E9E9E;text-decoration:none;">+ Buat Sesi →</a>
    </div>
    <div class="admin-card-body" style="padding:0;">
        <table style="width:100%;border-collapse:collapse;">
            <tbody>
            @forelse($sessions as $s)
            <tr style="border-bottom:1px solid #F5F5F5;">
                <td style="padding:10px 16px;">
                    <p style="font-size:12px;font-weight:600;color:#212121;">{{ $s->label }}</p>
                    <p style="font-size:10px;color:#9E9E9E;">{{ $s->test_date->format('d M Y') }} · {{ $s->results_count }} pemain</p>
                </td>
                <td style="padding:10px 16px;text-align:right;">
                    <a href="{{ route('admin.ahp.results.index', $s) }}" style="font-size:11px;color:#212121;text-decoration:none;border-bottom:1px solid #E0E0E0;">Input Data</a>
                </td>
            </tr>
            @empty
            <tr><td colspan="2" style="padding:20px 16px;text-align:center;color:#9E9E9E;font-size:12px;">Belum ada sesi</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

</div>
@endsection
