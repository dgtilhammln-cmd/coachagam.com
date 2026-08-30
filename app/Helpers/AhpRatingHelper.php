<?php

namespace App\Helpers;

class AhpRatingHelper
{
    // Returns: ['label' => 'Excellent', 'color' => 'green', 'score' => 4]
    public static function bmi(float $bmi): array
    {
        if ($bmi >= 18.5 && $bmi <= 24.9) return ['label' => 'Normal',      'color' => '#10B981', 'score' => 4];
        if ($bmi >= 25   && $bmi <= 29.9) return ['label' => 'Overweight',  'color' => '#F59E0B', 'score' => 2];
        if ($bmi < 18.5)                  return ['label' => 'Underweight', 'color' => '#EF4444', 'score' => 1];
        return                                   ['label' => 'Obese',       'color' => '#EF4444', 'score' => 1];
    }

    public static function moca(int $score): array
    {
        if ($score >= 26) return ['label' => 'Excellent', 'color' => '#10B981', 'score' => 4];
        if ($score >= 22) return ['label' => 'Good',      'color' => '#60A5FA', 'score' => 3];
        if ($score >= 18) return ['label' => 'Average',   'color' => '#F59E0B', 'score' => 2];
        return                   ['label' => 'Poor',      'color' => '#EF4444', 'score' => 1];
    }

    public static function passingAccuracy(int $sukses, int $total): array
    {
        if ($total <= 0) return ['label' => 'N/A', 'color' => '#6B7280', 'score' => 0];
        $pct = ($sukses / $total) * 100;
        if ($pct >= 85) return ['label' => 'Excellent', 'color' => '#10B981', 'score' => 4];
        if ($pct >= 70) return ['label' => 'Good',      'color' => '#60A5FA', 'score' => 3];
        if ($pct >= 55) return ['label' => 'Average',   'color' => '#F59E0B', 'score' => 2];
        return                 ['label' => 'Poor',      'color' => '#EF4444', 'score' => 1];
    }

    public static function scanning(float $val): array
    {
        if ($val >= 4.5) return ['label' => 'Excellent', 'color' => '#10B981', 'score' => 4];
        if ($val >= 3.5) return ['label' => 'Good',      'color' => '#60A5FA', 'score' => 3];
        if ($val >= 2.5) return ['label' => 'Average',   'color' => '#F59E0B', 'score' => 2];
        return                  ['label' => 'Poor',      'color' => '#EF4444', 'score' => 1];
    }

    // Lower = better for speed metrics
    public static function speed(float $seconds): array
    {
        if ($seconds < 1.70) return ['label' => 'Excellent', 'color' => '#10B981', 'score' => 4];
        if ($seconds < 1.90) return ['label' => 'Good',      'color' => '#60A5FA', 'score' => 3];
        if ($seconds < 2.10) return ['label' => 'Average',   'color' => '#F59E0B', 'score' => 2];
        return                      ['label' => 'Poor',      'color' => '#EF4444', 'score' => 1];
    }

    public static function rast(float $val): array
    {
        if ($val <= 40)  return ['label' => 'Excellent', 'color' => '#10B981', 'score' => 4];
        if ($val <= 50)  return ['label' => 'Good',      'color' => '#60A5FA', 'score' => 3];
        if ($val <= 58)  return ['label' => 'Average',   'color' => '#F59E0B', 'score' => 2];
        return                  ['label' => 'Poor',      'color' => '#EF4444', 'score' => 1];
    }

    public static function yoyo(int $level): array
    {
        if ($level >= 19) return ['label' => 'Excellent', 'color' => '#10B981', 'score' => 4];
        if ($level >= 17) return ['label' => 'Good',      'color' => '#60A5FA', 'score' => 3];
        if ($level >= 15) return ['label' => 'Average',   'color' => '#F59E0B', 'score' => 2];
        return                   ['label' => 'Poor',      'color' => '#EF4444', 'score' => 1];
    }

    // Normalize a value to 0-100 scale for radar chart
    // For speed metrics, invert (lower = better)
    public static function normalize(string $metric, $value): float
    {
        if ($value === null) return 0;
        return match($metric) {
            'bmi'                  => $value >= 18.5 && $value <= 24.9 ? 100 : max(0, 100 - abs($value - 21.7) * 8),
            'moca_score'           => round(($value / 30) * 100, 1),
            'passing_sukses'       => round(min($value / 30, 1) * 100, 1),
            'scanning_per_10sec'   => round(min($value / 5.5, 1) * 100, 1),
            'initial_acceleration' => round(max(0, (2.2 - $value) / (2.2 - 1.6)) * 100, 1),
            'acceleration_phase'   => round(max(0, (2.3 - $value) / (2.3 - 1.7)) * 100, 1),
            'maximal_speed'        => round(max(0, (2.1 - $value) / (2.1 - 1.6)) * 100, 1),
            'yo_yo_level'          => round(min($value / 20, 1) * 100, 1),
            default                => 50,
        };
    }
}
