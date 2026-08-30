<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Individual Pemain - {{ $player->name }}</title>
    <style>
        @page { margin: 30px 40px; }
        body { font-family: Arial, Helvetica, sans-serif; font-size: 9px; color: #000; background: #FFF; line-height: 1.2; }
        
        /* Layout Grid for Top Section */
        .top-section { width: 100%; margin-bottom: 8px; }
        .top-left { width: 25%; float: left; }
        .top-right { width: 75%; float: left; padding-top: 15px; }
        
        /* Photo Box */
        .photo-box { width: 120px; height: 120px; background: #808080; text-align: center; overflow: hidden; margin-bottom: 5px; }
        .photo-img { width: 100%; height: 100%; object-fit: contain; object-position: top; }
        
        /* Top Right Info */
        .info-table { width: 100%; font-size: 9px; font-weight: bold; border-collapse: collapse; }
        .info-table td { padding: 3px 2px; vertical-align: top; }
        .info-lbl { width: 160px; }
        .info-col { width: 10px; }
        
        /* Title Banner */
        .banner { background: #000; color: #FFF; text-align: center; font-weight: bold; font-size: 12px; padding: 4px 0; margin-bottom: 8px; clear: both; }
        
        /* Profile Table */
        .data-table { width: 100%; border-collapse: collapse; font-size: 9px; font-weight: bold; }
        .data-table td { border: 1px solid #000; padding: 4px 6px; vertical-align: middle; }
        
        .lbl-col { width: 45%; font-weight: bold; }
        .val-col { width: 40%; text-align: center; }
        .rat-col { width: 15%; text-align: center; }
        
        /* Vertical Rating Text */
        .rating-vert { font-size: 10px; font-weight: bold; letter-spacing: 2px; line-height: 1.4; text-align: center; }
        
        /* Clearfix */
        .clearfix::after { content: ""; display: table; clear: both; }
    </style>
</head>
<body>

@php
    $displaySession = $session ?? $results->first()?->session;
    $photoPath = $player->photo ? public_path('storage/' . $player->photo) : null;

    $ratingFn = function($field, $val) {
        if (is_null($val) || $val === '' || $val == 0) return '';
        if ($field === 'moca_score') {
            if ($val >= 26) return 'Excellent'; if ($val >= 22) return 'Good';
            if ($val >= 18) return 'Average'; if ($val >= 14) return 'Fair'; return 'Poor';
        }
        if ($field === 'passing_sukses') {
            if ($val >= 20) return 'Excellent'; if ($val >= 15) return 'Good';
            if ($val >= 10) return 'Average'; if ($val >= 5) return 'Fair'; return 'Poor';
        }
        if ($field === 'yo_yo_level') {
            if ($val >= 15) return 'Excellent'; if ($val >= 12) return 'Good';
            if ($val >= 9) return 'Average'; if ($val >= 6) return 'Fair'; return 'Poor';
        }
        if ($field === 'yo_yo_distance') {
            if ($val >= 1200) return 'Excellent'; if ($val >= 900) return 'Good';
            if ($val >= 600) return 'Average'; if ($val >= 300) return 'Fair'; return 'Poor';
        }
        if ($field === 'scanning_per_10sec') {
            if ($val >= 5) return 'Excellent'; if ($val >= 4) return 'Good';
            if ($val >= 3) return 'Average'; if ($val >= 2) return 'Fair'; return 'Poor';
        }
        if (in_array($field, ['initial_acceleration','acceleration_phase','maximal_speed'])) {
            if ($val <= 1.5) return 'Excellent'; if ($val <= 1.8) return 'Good';
            if ($val <= 2.2) return 'Average'; if ($val <= 2.6) return 'Fair'; return 'Poor';
        }
        return '';
    };

    // Since we only want to show 1 session, we get the latest Result or the requested Session.
    $latest = $session ? $results->first() : ($results->count() > 0 ? $results->last() : null);

    // Get value safely
    $val = function($field) use ($latest) {
        return $latest ? ($latest->{$field} ?? '') : '';
    };

    // Calculate age if not in model
    $age = $player->age ?? '-';

@endphp

<div class="top-section clearfix">
    <div class="top-left">
        <div class="photo-box">
            @if($photoPath && file_exists($photoPath))
                <img src="{{ $photoPath }}" class="photo-img" alt="Foto">
            @endif
        </div>
    </div>
    <div class="top-right">
        <table class="info-table">
            <tr>
                <td class="info-lbl">Location *</td>
                <td class="info-col">:</td>
                <td>{{ $displaySession?->location ?: '-' }}</td>
            </tr>
            <tr>
                <td class="info-lbl">Physical Fitness Test Date *</td>
                <td class="info-col">:</td>
                <td>{{ $displaySession?->test_date?->format('d-M-y') ?: '-' }}</td>
            </tr>
            <tr>
                <td class="info-lbl">Physical Fitness Test Time *</td>
                <td class="info-col">:</td>
                <td>{{ $displaySession?->test_time ? date('H.i', strtotime($displaySession->test_time)) . ' WIB' : '-' }}</td>
            </tr>
            <tr>
                <td class="info-lbl">Temperature *</td>
                <td class="info-col">:</td>
                <td>{{ $displaySession?->temperature ?: '-' }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="banner">PLAYER PROFILE</div>

<table class="data-table">
    <tr>
        <td class="lbl-col">NO REG</td>
        <td colspan="2" style="background: #000; color: #FFF; text-align: center;">{{ $player->no_reg }}</td>
    </tr>
    <tr>
        <td class="lbl-col">NAME</td>
        <td colspan="2" style="text-align: center;">{{ strtoupper($player->name) }}</td>
    </tr>
    
    {{-- VERTICAL RATING LABEL --}}
    <tr>
        <td class="lbl-col">DATE OF BIRTH</td>
        <td class="val-col">{{ $player->date_of_birth ? $player->date_of_birth->format('j/n/Y') : '-' }}</td>
        <td rowspan="6" class="rat-col" style="vertical-align: middle; padding: 0;">
            <div class="rating-vert">
                R<br>A<br>T<br>I<br>N<br>G
            </div>
        </td>
    </tr>
    <tr>
        <td class="lbl-col">AGE (Years)</td>
        <td class="val-col">{{ $age }}</td>
    </tr>
    <tr>
        <td class="lbl-col">HEIGHT (cm)</td>
        <td class="val-col">{{ $val('height_cm') }}</td>
    </tr>
    <tr>
        <td class="lbl-col">WEIGHT (kg)</td>
        <td class="val-col">{{ $val('weight_kg') }}</td>
    </tr>
    <tr>
        <td class="lbl-col">Body Mass Index (BMI)</td>
        <td class="val-col">{{ $val('bmi') }}</td>
    </tr>
    <tr>
        <td class="lbl-col">Body Fat Percentage2</td>
        <td class="val-col">{{ $val('body_fat_percentage') }}</td>
    </tr>
    
    {{-- ACTUAL RATINGS --}}
    @php
        $metrics = [
            ['Skeletal Muscle Mass', 'skeletal_muscle_mass'],
            ['Skor MoCA INA', 'moca_score'],
            ['Jumlah Total Passing', 'total_passing'],
            ['Passing Sukses', 'passing_sukses'],
            ['Passing Gagal', 'passing_gagal'],
            ['Jumlah Scaning (per 10 detik)', 'scanning_per_10sec'],
            ['Initial Acceleration (0-10m)2', 'initial_acceleration'],
            ['Acceleration Phase (10-20m)3', 'acceleration_phase'],
            ['Maximal Speed/ Velocity (20-30m)4', 'maximal_speed'],
            ['RAST Test', 'rast_test'],
            ['Level', 'yo_yo_level'],
            ['Balikan', 'yo_yo_balikan'],
            ['Distance', 'yo_yo_distance'],
            ['Vo2max', 'vo2max'],
        ];
    @endphp

    @foreach($metrics as $m)
    @php
        $field = $m[1];
        $v = $val($field);
        
        $r = $ratingFn($field, $v);
        
        // Manual override for reference matching logic
        if ($v !== '') {
            if ($field === 'total_passing') $r = ($v < 20) ? 'Poor' : 'Excellent';
            if ($field === 'passing_gagal') $r = ($v > 5) ? 'Poor' : 'Excellent';
            if ($field === 'rast_test') $r = ($v > 0) ? 'Poor' : '';
            if ($field === 'yo_yo_distance') {
                if ($v >= 1200) $r = 'Excellent'; elseif ($v >= 900) $r = 'Good'; elseif ($v >= 600) $r = 'Average'; elseif ($v >= 300) $r = 'Fair'; else $r = 'Poor';
            }
        }
    @endphp
    <tr>
        <td class="lbl-col">{{ $m[0] }}</td>
        <td class="val-col">{{ $v }}</td>
        <td class="rat-col">{{ $r }}</td>
    </tr>
    @endforeach
</table>

</body>
</html>