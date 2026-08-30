<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AhpTestSession extends Model
{
    protected $table = 'ahp_test_sessions';

    protected $fillable = [
        'label', 'location', 'test_date', 'test_time',
        'temperature', 'period_week', 'coach_notes',
    ];

    protected $casts = [
        'test_date' => 'date',
    ];

    public function results(): HasMany
    {
        return $this->hasMany(AhpTestResult::class, 'session_id');
    }

    public function getFullLabelAttribute(): string
    {
        return $this->label . ' ' . $this->test_date->translatedFormat('d F Y');
    }

    public function getResultCountAttribute(): int
    {
        return $this->results()->count();
    }
}
