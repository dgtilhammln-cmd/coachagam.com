@extends('admin.layouts.admin')
@section('title', 'AHP Training — Pemain')

@section('breadcrumb')
    <span class="breadcrumb-sep">/</span>
    <a href="{{ route('admin.ahp.dashboard') }}" style="color:#9E9E9E;text-decoration:none;font-size:12px;">AHP Training</a>
    <span class="breadcrumb-sep">/</span>
    <span class="breadcrumb-current">Pemain</span>
@endsection

@section('content')
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;">
    <div>
        <h1 class="page-title">Manajemen Pemain</h1>
        <p class="page-subtitle">{{ $players->total() }} pemain terdaftar.</p>
    </div>
    <a href="{{ route('admin.ahp.players.create') }}" class="btn-silver" style="font-size:13px;">+ Tambah Pemain</a>
</div>

@if(session('success'))
<div style="background:#F0FDF4;border:1px solid #BBF7D0;padding:12px 16px;margin-bottom:20px;font-size:12px;color:#166534;">
    {{ session('success') }}
</div>
@endif

<div class="admin-card" style="border-radius:0;">
    <div class="admin-card-body" style="padding:0;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#F9F9F9;border-bottom:2px solid #E0E0E0;">
                    <th style="padding:10px 16px;text-align:left;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Pemain</th>
                    <th style="padding:10px 16px;text-align:left;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Posisi</th>
                    <th style="padding:10px 16px;text-align:left;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Lahir</th>
                    <th style="padding:10px 16px;text-align:center;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Status</th>
                    <th style="padding:10px 16px;text-align:right;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @forelse($players as $p)
            <tr style="border-bottom:1px solid #F5F5F5;" onmouseover="this.style.background='#FAFAFA'" onmouseout="this.style.background='transparent'">
                <td style="padding:10px 16px;">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <img src="{{ $p->photo_url }}" alt="{{ $p->name }}" style="width:40px;height:40px;object-fit:cover;border:1px solid #E0E0E0;flex-shrink:0;">
                        <div>
                            <p style="font-size:13px;font-weight:600;color:#212121;">{{ $p->name }}</p>
                            <p style="font-size:10px;color:#9E9E9E;font-family:monospace;letter-spacing:0.05em;">{{ $p->no_reg }}</p>
                        </div>
                    </div>
                </td>
                <td style="padding:10px 16px;font-size:12px;color:#424242;">{{ $p->position ?? '—' }}</td>
                <td style="padding:10px 16px;font-size:12px;color:#424242;">{{ $p->date_of_birth ? $p->date_of_birth->format('d M Y') : '—' }}</td>
                <td style="padding:10px 16px;text-align:center;">
                    <span style="font-size:10px;font-weight:600;padding:3px 8px;{{ $p->is_active ? 'background:#F0FDF4;color:#166534;' : 'background:#FEF2F2;color:#991B1B;' }}">
                        {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </td>
                <td style="padding:10px 16px;text-align:right;">
                    <div style="display:flex;gap:8px;justify-content:flex-end;">
                        <a href="{{ route('admin.ahp.players.show', $p) }}" style="font-size:11px;color:#424242;text-decoration:none;border-bottom:1px solid #E0E0E0;padding-bottom:1px;">Profil</a>
                        <a href="{{ route('admin.ahp.players.edit', $p) }}" style="font-size:11px;color:#424242;text-decoration:none;border-bottom:1px solid #E0E0E0;padding-bottom:1px;">Edit</a>
                        <form method="POST" action="{{ route('admin.ahp.players.destroy', $p) }}" style="display:inline;" onsubmit="return confirm('Hapus pemain ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" style="font-size:11px;color:#DC2626;background:none;border:none;border-bottom:1px solid #FCA5A5;cursor:pointer;font-family:inherit;padding:0 0 1px;">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" style="padding:40px 16px;text-align:center;color:#9E9E9E;font-size:12px;">Belum ada pemain. <a href="{{ route('admin.ahp.players.create') }}" style="color:#212121;">Tambah sekarang →</a></td></tr>
            @endforelse
            </tbody>
        </table>
        @if($players->hasPages())
        <div style="padding:14px 16px;border-top:1px solid #F5F5F5;">{{ $players->links() }}</div>
        @endif
    </div>
</div>
@endsection
