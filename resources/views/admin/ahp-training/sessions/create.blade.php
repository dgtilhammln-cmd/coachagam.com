@extends('admin.layouts.admin')
@section('title', 'Buat Sesi Test')

@section('breadcrumb')
    <span class="breadcrumb-sep">/</span>
    <a href="{{ route('admin.ahp.sessions.index') }}" style="color:#9E9E9E;text-decoration:none;font-size:12px;">Sesi Test</a>
    <span class="breadcrumb-sep">/</span>
    <span class="breadcrumb-current">Buat Baru</span>
@endsection

@section('content')
<div style="margin-bottom:24px;">
    <h1 class="page-title">Buat Sesi Test Baru</h1>
</div>

<form action="{{ route('admin.ahp.sessions.store') }}" method="POST">
@csrf
<div class="admin-card" style="border-radius:0;max-width:700px;">
    <div class="admin-card-header"><h2>Detail Sesi</h2></div>
    <div class="admin-card-body" style="display:flex;flex-direction:column;gap:18px;">

        <div class="form-group" style="margin:0;">
            <label class="form-label" for="label">Label Sesi <span style="color:#EF4444;">*</span></label>
            <select id="label" name="label" class="form-input" required>
                <option value="">— Pilih Label —</option>
                @foreach($labels as $l)
                <option value="{{ $l }}" {{ old('label') == $l ? 'selected' : '' }}>{{ $l }}</option>
                @endforeach
            </select>
            <p class="hint">Atau ketik manual di bawah jika tidak ada:</p>
            <input type="text" name="label_custom" class="form-input" value="{{ old('label_custom') }}" placeholder="Label custom (opsional, akan menimpa pilihan di atas)" style="margin-top:6px;" oninput="if(this.value){document.getElementById('label').value=''}">
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div class="form-group" style="margin:0;">
                <label class="form-label" for="test_date">Tanggal Test <span style="color:#EF4444;">*</span></label>
                <input type="date" id="test_date" name="test_date" class="form-input" value="{{ old('test_date') }}" required>
            </div>
            <div class="form-group" style="margin:0;">
                <label class="form-label" for="test_time">Jam Test</label>
                <input type="time" id="test_time" name="test_time" class="form-input" value="{{ old('test_time') }}">
            </div>
        </div>

        <div style="display:grid;grid-template-columns:2fr 1fr 1fr;gap:16px;">
            <div class="form-group" style="margin:0;">
                <label class="form-label" for="location">Lokasi</label>
                <input type="text" id="location" name="location" class="form-input" value="{{ old('location') }}" placeholder="Training Ground RNA">
            </div>
            <div class="form-group" style="margin:0;">
                <label class="form-label" for="temperature">Suhu</label>
                <input type="text" id="temperature" name="temperature" class="form-input" value="{{ old('temperature') }}" placeholder="26°C">
            </div>
            <div class="form-group" style="margin:0;">
                <label class="form-label" for="period_week">Minggu Ke-</label>
                <input type="number" id="period_week" name="period_week" class="form-input" value="{{ old('period_week', 0) }}" min="0" placeholder="0">
            </div>
        </div>

        <div class="form-group" style="margin:0;">
            <label class="form-label" for="coach_notes">Catatan Coach</label>
            <textarea id="coach_notes" name="coach_notes" class="form-textarea" rows="3" placeholder="Catatan kondisi cuaca, kondisi lapangan, dll.">{{ old('coach_notes') }}</textarea>
        </div>
    </div>
</div>

<div style="display:flex;gap:10px;margin-top:20px;">
    <button type="submit" class="btn-silver">Buat Sesi</button>
    <a href="{{ route('admin.ahp.sessions.index') }}" class="btn-outline">Batal</a>
</div>
</form>

<script>
// If custom label is filled, use it (override select)
document.querySelector('form').addEventListener('submit', function(e) {
    const custom = document.querySelector('[name="label_custom"]').value.trim();
    if (custom) {
        let select = document.getElementById('label');
        select.removeAttribute('required');
        select.disabled = true;
        // Create hidden input with custom label value
        const hidden = document.createElement('input');
        hidden.type = 'hidden';
        hidden.name = 'label';
        hidden.value = custom;
        this.appendChild(hidden);
    }
});
</script>
@endsection
