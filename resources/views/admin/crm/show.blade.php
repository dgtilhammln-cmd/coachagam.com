@extends('admin.layouts.admin')
@section('title', 'CRM Lite — Detail Prospek')

@section('breadcrumb')
    <span class="breadcrumb-sep" aria-hidden="true">/</span>
    <a href="{{ route('admin.crm.index') }}" class="breadcrumb-link">CRM Lite</a>
    <span class="breadcrumb-sep" aria-hidden="true">/</span>
    <span class="breadcrumb-current">#{{ $lead->id }}</span>
@endsection

@section('content')

<div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:24px;gap:14px;flex-wrap:wrap;">
    <div>
        <h1 class="page-title">Detail Prospek #{{ $lead->id }}</h1>
        <p class="page-subtitle">Diterima pada {{ $lead->created_at->format('d M Y, H:i') }} WIB.</p>
    </div>
    <a href="{{ route('admin.crm.index') }}" class="btn-outline" style="font-size:13px;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
        Kembali
    </a>
</div>

<div style="display:grid; grid-template-columns: 2fr 1fr; gap:24px;">
    
    {{-- Main Info --}}
    <div style="display:flex; flex-direction:column; gap:24px;">
        <div class="admin-card">
            <div class="admin-card-header">
                <h2>Isi Pesan</h2>
            </div>
            <div class="admin-card-body">
                <div style="background:#F9FAFB; padding:24px; border:1px solid #E5E7EB; border-radius:8px; font-size:15px; color:#1A1A1A; line-height:1.7; white-space:pre-wrap;">{{ $lead->message }}</div>
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-card-header">
                <h2>Informasi Pengirim</h2>
            </div>
            <div class="admin-card-body" style="padding:0;">
                <table style="width:100%; text-align:left; border-collapse:collapse;">
                    <tr style="border-bottom:1px solid #E5E7EB;">
                        <th style="padding:16px 20px; font-size:13px; color:#6B7280; width:150px; background:#F9FAFB;">Nama Lengkap</th>
                        <td style="padding:16px 20px; font-size:14px; font-weight:600; color:#1A1A1A;">{{ $lead->name }}</td>
                    </tr>
                    <tr style="border-bottom:1px solid #E5E7EB;">
                        <th style="padding:16px 20px; font-size:13px; color:#6B7280; width:150px; background:#F9FAFB;">Email</th>
                        <td style="padding:16px 20px; font-size:14px; color:#1A1A1A;">
                            <a href="mailto:{{ $lead->email }}" style="color:#2563EB; text-decoration:none;">{{ $lead->email }}</a>
                        </td>
                    </tr>
                    <tr style="border-bottom:1px solid #E5E7EB;">
                        <th style="padding:16px 20px; font-size:13px; color:#6B7280; width:150px; background:#F9FAFB;">Nomor Telepon</th>
                        <td style="padding:16px 20px; font-size:14px; color:#1A1A1A;">
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $lead->phone) }}" target="_blank" rel="noopener" style="display:inline-flex; align-items:center; gap:6px; color:#10B981; text-decoration:none; font-weight:600;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/></svg>
                                {{ $lead->phone }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <th style="padding:16px 20px; font-size:13px; color:#6B7280; width:150px; background:#F9FAFB;">Minat Layanan</th>
                        <td style="padding:16px 20px; font-size:14px; font-weight:600; color:#1A1A1A;">{{ $lead->service ?: 'Tidak spesifik' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    {{-- Sidebar Info --}}
    <div style="display:flex; flex-direction:column; gap:24px;">
        <div class="admin-card">
            <div class="admin-card-header">
                <h2>Update Status</h2>
            </div>
            <div class="admin-card-body">
                <form action="{{ route('admin.crm.update', $lead->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="form-label" for="status">Status Prospek</label>
                        <select name="status" id="status" class="form-input">
                            <option value="new" {{ $lead->status == 'new' ? 'selected' : '' }}>Baru (New)</option>
                            <option value="contacted" {{ $lead->status == 'contacted' ? 'selected' : '' }}>Sedang Dihubungi (Contacted)</option>
                            <option value="closed" {{ $lead->status == 'closed' ? 'selected' : '' }}>Selesai / Deal (Closed)</option>
                        </select>
                    </div>
                    <button type="submit" class="btn-primary" style="width:100%; justify-content:center;">Update Status</button>
                </form>
            </div>
        </div>

        <div class="admin-card">
            <div class="admin-card-header">
                <h2 style="color:#DC2626;">Danger Zone</h2>
            </div>
            <div class="admin-card-body">
                <form action="{{ route('admin.crm.destroy', $lead->id) }}" method="POST" onsubmit="return confirm('Tindakan ini tidak dapat dibatalkan. Yakin hapus prospek ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-outline" style="width:100%; justify-content:center; color:#DC2626; border-color:#FCA5A5;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                        Hapus Prospek
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>

@endsection
