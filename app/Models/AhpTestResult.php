<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AhpTestResult extends Model
{
    protected $table = 'ahp_test_results';

    protected $fillable = [
        'player_id', 'session_id', 'age', 'height_cm', 'weight_kg', 'bmi',
        'body_fat_percentage', 'skeletal_muscle_mass', 'moca_score',
        'total_passing', 'passing_sukses', 'passing_gagal', 'scanning_per_10sec',
        'initial_acceleration', 'acceleration_phase', 'maximal_speed',
        'rast_test', 'yo_yo_level', 'yo_yo_balikan', 'yo_yo_distance', 'vo2max',
        'rating_notes',
    ];

    protected $casts = [
        'bmi'                    => 'float',
        'body_fat_percentage'    => 'float',
        'skeletal_muscle_mass'   => 'float',
        'height_cm'              => 'float',
        'weight_kg'              => 'float',
        'scanning_per_10sec'     => 'float',
        'initial_acceleration'   => 'float',
        'acceleration_phase'     => 'float',
        'maximal_speed'          => 'float',
        'rast_test'              => 'float',
        'yo_yo_distance'         => 'float',
        'vo2max'                 => 'float',
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(AhpPlayer::class, 'player_id');
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(AhpTestSession::class, 'session_id');
    }

    public function getCalculatedBmiAttribute(): float
    {
        if ($this->height_cm && $this->weight_kg) {
            $h = $this->height_cm / 100;
            return round($this->weight_kg / ($h * $h), 2);
        }
        return 0;
    }
}
