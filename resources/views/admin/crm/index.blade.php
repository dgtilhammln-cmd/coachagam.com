@extends('admin.layouts.admin')
@section('title', 'CRM Lite — Leads')

@section('breadcrumb')
    <span class="breadcrumb-sep" aria-hidden="true">/</span>
    <span class="breadcrumb-current">CRM Lite</span>
@endsection

@section('content')

<div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:24px;gap:14px;flex-wrap:wrap;">
    <div>
        <h1 class="page-title">CRM Lite (Leads)</h1>
        <p class="page-subtitle">Kelola pesan dan prospek yang masuk dari website.</p>
    </div>
</div>

@if(session('success'))
    <div style="margin-bottom:24px; padding:16px 20px; background:#ECFDF5; border:1px solid #10B981; color:#065F46; border-radius:8px; font-size:14px; display:flex; align-items:center; gap:10px;">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
        {{ session('success') }}
    </div>
@endif

<div class="admin-card">
    <div class="admin-card-body" style="padding:0; overflow-x:auto;">
        <table style="width:100%; text-align:left; border-collapse:collapse; min-width:800px;">
            <thead>
                <tr style="border-bottom:1px solid #E5E7EB; background:#F9FAFB;">
                    <th style="padding:16px 20px; font-size:12px; font-weight:700; color:#6B7280; text-transform:uppercase; letter-spacing:1px; width:50px;">ID</th>
                    <th style="padding:16px 20px; font-size:12px; font-weight:700; color:#6B7280; text-transform:uppercase; letter-spacing:1px;">Tanggal</th>
                    <th style="padding:16px 20px; font-size:12px; font-weight:700; color:#6B7280; text-transform:uppercase; letter-spacing:1px;">Nama & Kontak</th>
                    <th style="padding:16px 20px; font-size:12px; font-weight:700; color:#6B7280; text-transform:uppercase; letter-spacing:1px;">Layanan</th>
                    <th style="padding:16px 20px; font-size:12px; font-weight:700; color:#6B7280; text-transform:uppercase; letter-spacing:1px;">Status</th>
                    <th style="padding:16px 20px; font-size:12px; font-weight:700; color:#6B7280; text-transform:uppercase; letter-spacing:1px; width:120px; text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($leads as $lead)
                <tr style="border-bottom:1px solid #E5E7EB; transition:background 150ms;" onmouseover="this.style.background='#F9FAFB';" onmouseout="this.style.background='transparent';">
                    <td style="padding:16px 20px; font-size:14px; color:#6B7280;">#{{ $lead->id }}</td>
                    <td style="padding:16px 20px; font-size:14px; color:#1A1A1A;">
                        <div style="font-weight:600;">{{ $lead->created_at->format('d M Y') }}</div>
                        <div style="font-size:12px; color:#9CA3AF;">{{ $lead->created_at->format('H:i') }} WIB</div>
                    </td>
                    <td style="padding:16px 20px;">
                        <div style="font-size:14px; font-weight:700; color:#1A1A1A;">{{ $lead->name }}</div>
                        <div style="font-size:13px; color:#6B7280; margin-top:2px;">{{ $lead->email }}</div>
                        <div style="font-size:13px; color:#6B7280;">{{ $lead->phone }}</div>
                    </td>
                    <td style="padding:16px 20px; font-size:14px; color:#4B5563;">
                        {{ $lead->service ?: '-' }}
                    </td>
                    <td style="padding:16px 20px;">
                        @if($lead->status === 'new')
                            <span style="display:inline-flex; align-items:center; padding:4px 10px; background:#FEE2E2; color:#DC2626; font-size:12px; font-weight:700; border-radius:999px; letter-spacing:0.5px;">BARU</span>
                        @elseif($lead->status === 'contacted')
                            <span style="display:inline-flex; align-items:center; padding:4px 10px; background:#FEF3C7; color:#D97706; font-size:12px; font-weight:700; border-radius:999px; letter-spacing:0.5px;">DIHUBUNGI</span>
                        @else
                            <span style="display:inline-flex; align-items:center; padding:4px 10px; background:#D1FAE5; color:#059669; font-size:12px; font-weight:700; border-radius:999px; letter-spacing:0.5px;">SELESAI</span>
                        @endif
                    </td>
                    <td style="padding:16px 20px; text-align:right;">
                        <div style="display:flex; justify-content:flex-end; gap:8px;">
                            <a href="{{ route('admin.crm.show', $lead->id) }}" title="Lihat Detail"
                               style="width:32px; height:32px; display:flex; align-items:center; justify-content:center; background:#F3F4F6; color:#4B5563; border-radius:6px; transition:all 150ms;"
                               onmouseover="this.style.background='#1A1A1A'; this.style.color='#FFFFFF';"
                               onmouseout="this.style.background='#F3F4F6'; this.style.color='#4B5563';">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </a>
                            
                            <form action="{{ route('admin.crm.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus prospek ini?');" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" title="Hapus"
                                        style="width:32px; height:32px; display:flex; align-items:center; justify-content:center; background:#FEE2E2; color:#DC2626; border:none; border-radius:6px; cursor:pointer; transition:all 150ms;"
                                        onmouseover="this.style.background='#DC2626'; this.style.color='#FFFFFF';"
                                        onmouseout="this.style.background='#FEE2E2'; this.style.color='#DC2626';">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding:40px 20px; text-align:center; color:#9CA3AF; font-size:14px;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:12px; opacity:0.5;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><line x1="9" y1="21" x2="9" y2="9"></line></svg><br>
                        Belum ada prospek atau pesan yang masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@if($leads->hasPages())
<div style="margin-top:24px;">
    {{ $leads->links('pagination::bootstrap-5') }}
</div>
@endif

@endsection
