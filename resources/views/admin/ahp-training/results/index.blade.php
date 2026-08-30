@extends('admin.layouts.admin')
@section('title', 'Input Hasil Test — ' . $session->label)

@section('breadcrumb')
    <span class="breadcrumb-sep">/</span>
    <a href="{{ route('admin.ahp.sessions.index') }}" style="color:#9E9E9E;text-decoration:none;font-size:12px;">Sesi Test</a>
    <span class="breadcrumb-sep">/</span>
    <span class="breadcrumb-current">{{ $session->label }}</span>
@endsection

@push('head')
<style>
.result-table th, .result-table td { white-space:nowrap; }
.result-table input[type=number], .result-table input[type=text] {
    width:80px; padding:4px 6px; border:1px solid #E0E0E0; font-size:11px;
    font-family:'Montserrat',sans-serif; text-align:right;
    background:#FAFAFA; color:#212121;
}
.result-table input[type=number]:focus { outline:none; border-color:#1A1A1A; background:#FFF; }
.result-table tr:hover td { background:#FEFEFE; }
</style>
@endpush

@section('content')
<div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
    <div>
        <h1 class="page-title">Input Hasil Test: {{ $session->label }}</h1>
        <p class="page-subtitle">
            {{ $session->test_date->format('d M Y') }}
            @if($session->location) · {{ $session->location }} @endif
            @if($session->temperature) · {{ $session->temperature }} @endif
        </p>
    </div>
    <div style="display:flex;gap:8px;">
        <a href="{{ route('admin.ahp.results.template') }}" class="btn-outline" style="font-size:12px; display:inline-flex; align-items:center; gap:6px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Template CSV
        </a>
        <a href="{{ route('admin.ahp.results.import', $session) }}" class="btn-outline" style="font-size:12px; display:inline-flex; align-items:center; gap:6px;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
            Import Excel
        </a>
    </div>
</div>

@if(session('success'))
<div style="background:#F0FDF4;border:1px solid #BBF7D0;padding:12px 16px;margin-bottom:16px;font-size:12px;color:#166534;">{{ session('success') }}</div>
@endif

<div style="background:#FFFBEB;border:1px solid #FEF3C7;padding:12px 16px;margin-bottom:16px;font-size:12px;color:#92400E;display:flex;align-items:center;gap:8px;">
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
    <span><strong>Informasi:</strong> Nilai <b>AGE (years)</b> akan dihitung dan diperbarui secara otomatis oleh sistem berdasarkan <b>DATE OF BIRTH</b> (Tanggal Lahir) setiap pemain.</span>
</div>

<form action="{{ route('admin.ahp.results.update', $session) }}" method="POST" id="results-form">
@csrf

<div style="overflow-x:auto;margin-bottom:16px;">
<table class="result-table" style="width:100%;border-collapse:collapse;font-size:11px;">
<thead>
<tr style="background:#1A1A1A;color:#FFFFFF;">
    <th style="padding:8px 10px;text-align:left;position:sticky;left:0;background:#1A1A1A;min-width:160px;z-index:2;">Pemain</th>
    <th style="padding:8px 6px;text-align:center;min-width:80px;">AGE (years)</th>
    <th style="padding:8px 6px;text-align:center;min-width:80px;">HEIGHT (cm)</th>
    <th style="padding:8px 6px;text-align:center;min-width:80px;">WEIGHT (kg)</th>
    <th style="padding:8px 6px;text-align:center;min-width:130px;">Body Mass Index (BMI)</th>
    <th style="padding:8px 6px;text-align:center;min-width:140px;">Body Fat Percentage2</th>
    <th style="padding:8px 6px;text-align:center;min-width:140px;">Skeletal Muscle Mass</th>
    <th style="padding:8px 6px;text-align:center;min-width:100px;">Skor MoCA INA</th>
    <th style="padding:8px 6px;text-align:center;min-width:140px;">Jumlah Total Passing</th>
    <th style="padding:8px 6px;text-align:center;min-width:100px;">Passing Sukses</th>
    <th style="padding:8px 6px;text-align:center;min-width:100px;">Passing Gagal</th>
    <th style="padding:8px 6px;text-align:center;min-width:180px;">Jumlah Scaning (per 10 detik)</th>
    <th style="padding:8px 6px;text-align:center;min-width:160px;">Initial Acceleration (0-10m)2</th>
    <th style="padding:8px 6px;text-align:center;min-width:180px;">Acceleration Phase (10-20m)3</th>
    <th style="padding:8px 6px;text-align:center;min-width:210px;">Maximal Speed/ Velocity (20-30m)4</th>
    <th style="padding:8px 6px;text-align:center;min-width:80px;">RAST Test</th>
    <th style="padding:8px 6px;text-align:center;min-width:80px;">Level</th>
    <th style="padding:8px 6px;text-align:center;min-width:80px;">Balikan</th>
    <th style="padding:8px 6px;text-align:center;min-width:80px;">Distance</th>
    <th style="padding:8px 6px;text-align:center;min-width:80px;">Vo2max</th>
</tr>
</thead>
<tbody>
@foreach($players as $player)
@php
    $r = $results[$player->id] ?? null;
    $calculatedAge = $player->date_of_birth ? \Carbon\Carbon::parse($player->date_of_birth)->age : ($r ? $r->age : '');
@endphp
<tr style="border-bottom:1px solid #F0F0F0;" id="row-{{ $player->id }}">
    <td style="padding:6px 10px;position:sticky;left:0;background:#FFFFFF;border-right:1px solid #E0E0E0;">
        <div style="display:flex;align-items:center;gap:8px;">
            <img src="{{ $player->photo_url }}" style="width:28px;height:28px;object-fit:cover;border:1px solid #E0E0E0;flex-shrink:0;">
            <div>
                <p style="font-size:11px;font-weight:600;color:#212121;max-width:110px;overflow:hidden;text-overflow:ellipsis;">{{ $player->name }}</p>
                <p style="font-size:9px;color:#9E9E9E;font-family:monospace;">{{ $player->no_reg }}</p>
            </div>
        </div>
    </td>
    @foreach(['age'=>'integer','height_cm'=>'decimal','weight_kg'=>'decimal','bmi'=>'decimal','body_fat_percentage'=>'decimal','skeletal_muscle_mass'=>'decimal','moca_score'=>'integer','total_passing'=>'integer','passing_sukses'=>'integer','passing_gagal'=>'integer','scanning_per_10sec'=>'decimal','initial_acceleration'=>'decimal','acceleration_phase'=>'decimal','maximal_speed'=>'decimal','rast_test'=>'decimal','yo_yo_level'=>'integer','yo_yo_balikan'=>'integer','yo_yo_distance'=>'decimal','vo2max'=>'decimal'] as $field => $type)
    <td style="padding:4px 4px;text-align:center;">
        <input type="number"
               name="results[{{ $player->id }}][{{ $field }}]"
               value="{{ $field === 'age' ? $calculatedAge : ($r ? $r->$field : '') }}"
               step="{{ $type === 'integer' ? '1' : '0.01' }}"
               min="0"
               @if(in_array($field, ['bmi','passing_gagal'])) class="auto-calc" data-field="{{ $field }}" @endif
               @if($field === 'bmi' || $field === 'passing_gagal' || $field === 'age') readonly style="width:100%;min-width:60px;padding:4px 6px;border:1px solid #E0E0E0;font-size:11px;font-family:'Montserrat',sans-serif;text-align:center;background:#F0F0F0;color:#9E9E9E;" @endif
               @if(!in_array($field, ['bmi','passing_gagal','age'])) style="width:100%;min-width:60px;padding:4px 6px;border:1px solid #E0E0E0;font-size:11px;font-family:'Montserrat',sans-serif;text-align:center;" @endif
        >
    </td>
    @endforeach
</tr>
@endforeach
</tbody>
</table>
</div>

<div style="position:sticky;bottom:0;background:rgba(255,255,255,0.97);backdrop-filter:blur(8px);border-top:1px solid #E0E0E0;padding:12px 0;display:flex;align-items:center;justify-content:space-between;gap:12px;">
    <p style="font-size:11px;color:#9E9E9E;">AGE, BMI dan Passing Gagal otomatis dikalkulasi. Scroll ke kanan untuk lihat semua kolom.</p>
    <button type="submit" class="btn-silver" style="display:inline-flex;align-items:center;gap:6px;">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
        Simpan Semua Data
    </button>
</div>
</form>

<script>
// Auto-calculate BMI and Passing Gagal per row
document.querySelectorAll('#results-form tr[id^="row-"]').forEach(row => {
    const pid = row.id.replace('row-','');
    const inputs = row.querySelectorAll('input[type=number]');
    
    // Field order matches the foreach: age,height,weight,bmi,fat,muscle,moca,tot,sukses,gagal,...
    const heightInput = row.querySelector(`[name="results[${pid}][height_cm]"]`);
    const weightInput = row.querySelector(`[name="results[${pid}][weight_kg]"]`);
    const bmiInput    = row.querySelector(`[name="results[${pid}][bmi]"]`);
    const totInput    = row.querySelector(`[name="results[${pid}][total_passing]"]`);
    const sukInput    = row.querySelector(`[name="results[${pid}][passing_sukses]"]`);
    const gagInput    = row.querySelector(`[name="results[${pid}][passing_gagal]"]`);
    
    function calcBmi() {
        const h = parseFloat(heightInput?.value);
        const w = parseFloat(weightInput?.value);
        if (h > 0 && w > 0 && bmiInput) {
            bmiInput.value = (w / Math.pow(h/100, 2)).toFixed(2);
        }
    }
    function calcGagal() {
        const tot = parseInt(totInput?.value || 0);
        const suk = parseInt(sukInput?.value || 0);
        if (gagInput && tot >= 0) {
            gagInput.value = Math.max(0, tot - suk);
        }
    }
    
    heightInput?.addEventListener('input', calcBmi);
    weightInput?.addEventListener('input', calcBmi);
    totInput?.addEventListener('input', calcGagal);
    sukInput?.addEventListener('input', calcGagal);
});
</script>
@endsection
