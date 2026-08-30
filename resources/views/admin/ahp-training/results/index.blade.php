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
        <a href="{{ route('admin.ahp.results.template') }}" class="btn-outline" style="font-size:12px;">⬇ Template CSV</a>
        <a href="{{ route('admin.ahp.results.import', $session) }}" class="btn-outline" style="font-size:12px;">📥 Import Excel</a>
    </div>
</div>

@if(session('success'))
<div style="background:#F0FDF4;border:1px solid #BBF7D0;padding:12px 16px;margin-bottom:16px;font-size:12px;color:#166534;">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.ahp.results.update', $session) }}" method="POST" id="results-form">
@csrf

<div style="overflow-x:auto;margin-bottom:16px;">
<table class="result-table" style="width:100%;border-collapse:collapse;font-size:11px;">
<thead>
<tr style="background:#1A1A1A;color:#FFFFFF;">
    <th style="padding:8px 10px;text-align:left;position:sticky;left:0;background:#1A1A1A;min-width:160px;">Pemain</th>
    <th style="padding:8px 6px;text-align:center;">Usia</th>
    <th style="padding:8px 6px;text-align:center;">TB (cm)</th>
    <th style="padding:8px 6px;text-align:center;">BB (kg)</th>
    <th style="padding:8px 6px;text-align:center;">BMI</th>
    <th style="padding:8px 6px;text-align:center;">Fat %</th>
    <th style="padding:8px 6px;text-align:center;">Muscle</th>
    <th style="padding:8px 6px;text-align:center;">MoCA</th>
    <th style="padding:8px 6px;text-align:center;">Tot.Pass</th>
    <th style="padding:8px 6px;text-align:center;">Sukses</th>
    <th style="padding:8px 6px;text-align:center;">Gagal</th>
    <th style="padding:8px 6px;text-align:center;">Scan/10s</th>
    <th style="padding:8px 6px;text-align:center;">0-10m</th>
    <th style="padding:8px 6px;text-align:center;">10-20m</th>
    <th style="padding:8px 6px;text-align:center;">20-30m</th>
    <th style="padding:8px 6px;text-align:center;">RAST</th>
    <th style="padding:8px 6px;text-align:center;">Yo-Yo Lv</th>
    <th style="padding:8px 6px;text-align:center;">Balikan</th>
    <th style="padding:8px 6px;text-align:center;">Jarak (m)</th>
</tr>
</thead>
<tbody>
@foreach($players as $player)
@php $r = $results[$player->id] ?? null; @endphp
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
    @foreach(['age'=>'integer','height_cm'=>'decimal','weight_kg'=>'decimal','bmi'=>'decimal','body_fat_percentage'=>'decimal','skeletal_muscle_mass'=>'decimal','moca_score'=>'integer','total_passing'=>'integer','passing_sukses'=>'integer','passing_gagal'=>'integer','scanning_per_10sec'=>'decimal','initial_acceleration'=>'decimal','acceleration_phase'=>'decimal','maximal_speed'=>'decimal','rast_test'=>'decimal','yo_yo_level'=>'integer','yo_yo_balikan'=>'integer','yo_yo_distance'=>'decimal'] as $field => $type)
    <td style="padding:4px 4px;text-align:center;">
        <input type="number"
               name="results[{{ $player->id }}][{{ $field }}]"
               value="{{ $r ? $r->$field : '' }}"
               step="{{ $type === 'integer' ? '1' : '0.01' }}"
               min="0"
               @if(in_array($field, ['bmi','passing_gagal'])) class="auto-calc" data-field="{{ $field }}" @endif
               @if($field === 'bmi') readonly style="width:80px;padding:4px 6px;border:1px solid #E0E0E0;font-size:11px;font-family:'Montserrat',sans-serif;text-align:right;background:#F0F0F0;color:#9E9E9E;" @endif
               @if($field === 'passing_gagal') readonly style="width:80px;padding:4px 6px;border:1px solid #E0E0E0;font-size:11px;font-family:'Montserrat',sans-serif;text-align:right;background:#F0F0F0;color:#9E9E9E;" @endif
        >
    </td>
    @endforeach
</tr>
@endforeach
</tbody>
</table>
</div>

<div style="position:sticky;bottom:0;background:rgba(255,255,255,0.97);backdrop-filter:blur(8px);border-top:1px solid #E0E0E0;padding:12px 0;display:flex;align-items:center;justify-content:space-between;gap:12px;">
    <p style="font-size:11px;color:#9E9E9E;">BMI dan Passing Gagal otomatis dikalkulasi. Scroll ke kanan untuk lihat semua kolom.</p>
    <button type="submit" class="btn-silver">💾 Simpan Semua Data</button>
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
