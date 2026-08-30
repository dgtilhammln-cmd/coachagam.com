@extends('admin.layouts.admin')
@section('title', 'Site Settings — Header')

@section('breadcrumb')
    <span class="breadcrumb-sep" aria-hidden="true">/</span>
    <span class="breadcrumb-current">Site Settings</span>
    <span class="breadcrumb-sep" aria-hidden="true">/</span>
    <span class="breadcrumb-current">Header</span>
@endsection

@section('content')

<div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:24px;gap:14px;flex-wrap:wrap;">
    <div>
        <h1 class="page-title">Header Settings</h1>
        <p class="page-subtitle">Kelola running text (ticker) di top bar.</p>
    </div>
</div>

<form action="{{ route('admin.settings.header.update') }}" method="POST">
@csrf

<div class="admin-card" style="border-radius:0;" x-data="{
    items: {{ json_encode($tickers) }},
    addItem() { this.items.push(''); },
    removeItem(index) { this.items.splice(index, 1); }
}">
    <div class="admin-card-header">
        <h2>Running Text (Ticker)</h2>
        <span style="font-size:12px;color:#94A3B8;">Teks yang berjalan di atas header.</span>
    </div>
    <div class="admin-card-body">
        
        <template x-for="(item, index) in items" :key="index">
            <div style="display:flex; gap:10px; margin-bottom:12px;">
                <input type="text" :name="'tickers['+index+']'" x-model="items[index]" class="form-input" style="flex:1;" placeholder="Masukkan teks...">
                <button type="button" @click="removeItem(index)" class="btn-outline" style="padding:0 12px; border-color:#EF4444; color:#EF4444;" title="Hapus">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                </button>
            </div>
        </template>

        <button type="button" @click="addItem()" class="btn-outline" style="margin-top:10px; font-size:12px;">+ Tambah Teks</button>
    </div>
</div>

{{-- Sticky Save Bar --}}
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
    <button type="submit" class="btn-silver" style="font-size:13px;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
            <polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/>
        </svg>
        Simpan Perubahan
    </button>
</div>

</form>

@endsection
