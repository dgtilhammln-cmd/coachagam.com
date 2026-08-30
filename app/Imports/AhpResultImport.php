<?php

namespace App\Imports;

use App\Models\AhpPlayer;
use App\Models\AhpTestResult;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class AhpResultImport implements ToCollection, WithHeadingRow
{
    protected int $sessionId;
    protected int $rowCount = 0;

    public function __construct(int $sessionId)
    {
        $this->sessionId = $sessionId;
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $noReg = strtoupper(trim($row['no_reg'] ?? ''));
            if (!$noReg) continue;

            $player = AhpPlayer::where('no_reg', $noReg)->first();
            if (!$player) continue;

            $height = (float)($row['height_cm'] ?? 0);
            $weight = (float)($row['weight_kg'] ?? 0);
            $bmi    = ($height > 0 && $weight > 0)
                ? round($weight / (($height / 100) ** 2), 2)
                : (float)($row['bmi'] ?? 0) ?: null;

            $totPass = (int)($row['total_passing'] ?? 0);
            $sukses  = (int)($row['passing_sukses'] ?? 0);

            AhpTestResult::updateOrCreate(
                ['player_id' => $player->id, 'session_id' => $this->sessionId],
                [
                    'age'                  => (int)($row['age'] ?? 0) ?: null,
                    'height_cm'            => $height ?: null,
                    'weight_kg'            => $weight ?: null,
                    'bmi'                  => $bmi,
                    'body_fat_percentage'  => (float)($row['body_fat'] ?? 0) ?: null,
                    'skeletal_muscle_mass' => (float)($row['skeletal_muscle_mass'] ?? 0) ?: null,
                    'moca_score'           => (int)($row['moca_score'] ?? 0) ?: null,
                    'total_passing'        => $totPass ?: null,
                    'passing_sukses'       => $sukses ?: null,
                    'passing_gagal'        => ($totPass && $sukses) ? max(0, $totPass - $sukses) : null,
                    'scanning_per_10sec'   => (float)($row['scanning10s'] ?? 0) ?: null,
                    'initial_acceleration' => (float)($row['initial_acc_010m'] ?? 0) ?: null,
                    'acceleration_phase'   => (float)($row['acc_phase_1020m'] ?? 0) ?: null,
                    'maximal_speed'        => (float)($row['max_speed_2030m'] ?? 0) ?: null,
                    'rast_test'            => (float)($row['rast_test'] ?? 0) ?: null,
                    'yo_yo_level'          => (int)($row['yo_yo_level'] ?? 0) ?: null,
                    'yo_yo_balikan'        => (int)($row['balikan'] ?? 0) ?: null,
                    'yo_yo_distance'       => (float)($row['distance'] ?? 0) ?: null,
                ]
            );
            $this->rowCount++;
        }
    }

    public function getRowCount(): int
    {
        return $this->rowCount;
    }
}
