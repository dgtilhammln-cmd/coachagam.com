@extends('admin.layouts.admin')
@section('title', 'Profil — ' . $player->name)

@section('breadcrumb')
    <span class="breadcrumb-sep">/</span>
    <a href="{{ route('admin.ahp.players.index') }}" style="color:#9E9E9E;text-decoration:none;font-size:12px;">Pemain</a>
    <span class="breadcrumb-sep">/</span>
    <span class="breadcrumb-current">{{ $player->no_reg }}</span>
@endsection

@push('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('content')
<div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:14px;">
    <div style="display:flex;align-items:center;gap:16px;">
        <img src="{{ $player->photo_url }}" alt="{{ $player->name }}" style="width:60px;height:60px;object-fit:cover;border:2px solid #E0E0E0;">
        <div>
            <p style="font-size:10px;color:#9E9E9E;font-family:monospace;letter-spacing:0.1em;">{{ $player->no_reg }}</p>
            <h1 class="page-title" style="margin:0;">{{ $player->name }}</h1>
            <p style="font-size:12px;color:#9E9E9E;">{{ $player->position }} · Lahir {{ $player->date_of_birth?->format('d M Y') }}</p>
        </div>
    </div>
    <a href="{{ route('admin.ahp.players.edit', $player) }}" class="btn-outline" style="font-size:13px;">Edit Pemain</a>
</div>

@if($results->isEmpty())
<div class="admin-card" style="border-radius:0;">
    <div class="admin-card-body" style="text-align:center;padding:40px;">
        <p style="color:#9E9E9E;font-size:13px;">Belum ada data test untuk pemain ini.</p>
        <a href="{{ route('admin.ahp.sessions.index') }}" style="color:#212121;font-size:12px;border-bottom:1px solid #E0E0E0;text-decoration:none;">Buka sesi test →</a>
    </div>
</div>
@else

{{-- Radar Chart --}}
@php
    $metrics = ['BMI','MoCA','Passing','Scanning','Init.Acc','Speed','Yo-Yo'];
    $pre = $results->first();
    $post = $results->count() > 1 ? $results->last() : null;
    $preRadar  = [\App\Helpers\AhpRatingHelper::normalize('bmi',$pre->bmi),\App\Helpers\AhpRatingHelper::normalize('moca_score',$pre->moca_score),\App\Helpers\AhpRatingHelper::normalize('passing_sukses',$pre->passing_sukses),\App\Helpers\AhpRatingHelper::normalize('scanning_per_10sec',$pre->scanning_per_10sec),\App\Helpers\AhpRatingHelper::normalize('initial_acceleration',$pre->initial_acceleration),\App\Helpers\AhpRatingHelper::normalize('maximal_speed',$pre->maximal_speed),\App\Helpers\AhpRatingHelper::normalize('yo_yo_level',$pre->yo_yo_level)];
    $postRadar = $post ? [\App\Helpers\AhpRatingHelper::normalize('bmi',$post->bmi),\App\Helpers\AhpRatingHelper::normalize('moca_score',$post->moca_score),\App\Helpers\AhpRatingHelper::normalize('passing_sukses',$post->passing_sukses),\App\Helpers\AhpRatingHelper::normalize('scanning_per_10sec',$post->scanning_per_10sec),\App\Helpers\AhpRatingHelper::normalize('initial_acceleration',$post->initial_acceleration),\App\Helpers\AhpRatingHelper::normalize('maximal_speed',$post->maximal_speed),\App\Helpers\AhpRatingHelper::normalize('yo_yo_level',$post->yo_yo_level)] : null;
@endphp

<div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:20px;">
    <div class="admin-card" style="border-radius:0;">
        <div class="admin-card-header"><h2>Radar Performa</h2></div>
        <div class="admin-card-body" style="display:flex;justify-content:center;">
            <canvas id="radarChart" width="300" height="300" style="max-width:300px;"></canvas>
        </div>
    </div>
    <div class="admin-card" style="border-radius:0;">
        <div class="admin-card-header"><h2>Perkembangan BMI & MoCA</h2></div>
        <div class="admin-card-body">
            <canvas id="lineChart" height="260"></canvas>
        </div>
    </div>
</div>

{{-- Comparison Table --}}
<div class="admin-card" style="border-radius:0;">
    <div class="admin-card-header"><h2>Perbandingan Hasil Test</h2></div>
    <div class="admin-card-body" style="padding:0;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#F9F9F9;border-bottom:2px solid #E0E0E0;">
                    <th style="padding:10px 16px;text-align:left;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Sesi</th>
                    <th style="padding:10px 16px;text-align:center;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">BB (kg)</th>
                    <th style="padding:10px 16px;text-align:center;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">BMI</th>
                    <th style="padding:10px 16px;text-align:center;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">MoCA</th>
                    <th style="padding:10px 16px;text-align:center;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Passing</th>
                    <th style="padding:10px 16px;text-align:center;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Speed</th>
                    <th style="padding:10px 16px;text-align:center;font-size:10px;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#9E9E9E;">Yo-Yo</th>
                </tr>
            </thead>
            <tbody>
            @foreach($results as $r)
            <tr style="border-bottom:1px solid #F5F5F5;">
                <td style="padding:10px 16px;">
                    <p style="font-size:12px;font-weight:600;color:#212121;">{{ $r->session->label }}</p>
                    <p style="font-size:10px;color:#9E9E9E;">{{ $r->session->test_date->format('d M Y') }}</p>
                </td>
                <td style="padding:10px 16px;text-align:center;font-size:12px;font-family:monospace;">{{ $r->weight_kg }}</td>
                <td style="padding:10px 16px;text-align:center;font-size:12px;font-family:monospace;">{{ $r->bmi }}</td>
                <td style="padding:10px 16px;text-align:center;font-size:12px;font-family:monospace;">{{ $r->moca_score }}</td>
                <td style="padding:10px 16px;text-align:center;font-size:12px;font-family:monospace;">{{ $r->passing_sukses }}/{{ $r->total_passing }}</td>
                <td style="padding:10px 16px;text-align:center;font-size:12px;font-family:monospace;">{{ $r->maximal_speed }}s</td>
                <td style="padding:10px 16px;text-align:center;font-size:12px;font-family:monospace;">Lv{{ $r->yo_yo_level }}</td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
const metrics = @json($metrics);
const preData  = @json($preRadar);
const postData = @json($postRadar);

// Radar
new Chart(document.getElementById('radarChart'), {
    type: 'radar',
    data: {
        labels: metrics,
        datasets: [
            { label: '{{ $pre->session->label }}', data: preData, borderColor:'#1A1A1A', backgroundColor:'rgba(26,26,26,0.08)', borderWidth:2, pointBackgroundColor:'#1A1A1A' },
            @if($post)
            { label: '{{ $post->session->label }}', data: postData, borderColor:'#EF4444', backgroundColor:'rgba(239,68,68,0.08)', borderWidth:2, pointBackgroundColor:'#EF4444' }
            @endif
        ]
    },
    options: { scales: { r: { min:0, max:100, ticks:{font:{size:9}}, pointLabels:{font:{size:10,family:'Montserrat'}} } }, plugins: { legend: { labels: { font:{size:10,family:'Montserrat'} } } } }
});

// Line Chart
const sessionLabels = @json($results->map(fn($r) => $r->session->label)->values());
new Chart(document.getElementById('lineChart'), {
    type: 'line',
    data: {
        labels: sessionLabels,
        datasets: [
            { label: 'BMI', data: @json($results->pluck('bmi')), borderColor:'#1A1A1A', tension:0.3, yAxisID:'y' },
            { label: 'MoCA', data: @json($results->pluck('moca_score')), borderColor:'#EF4444', tension:0.3, yAxisID:'y2' }
        ]
    },
    options: {
        responsive:true,
        scales: {
            y: { type:'linear', position:'left', title:{display:true,text:'BMI',font:{size:9}} },
            y2: { type:'linear', position:'right', title:{display:true,text:'MoCA',font:{size:9}}, grid:{drawOnChartArea:false} }
        },
        plugins: { legend: { labels: { font:{size:10,family:'Montserrat'} } } }
    }
});
</script>
@endif
@endsection
