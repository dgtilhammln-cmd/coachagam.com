<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithStartRow;
use App\Models\AhpPlayer;
use App\Models\AhpTestResult;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Exception;

class AhpTestResultImport implements ToCollection, WithStartRow
{
    protected $sessionId;

    public function __construct($sessionId)
    {
        $this->sessionId = $sessionId;
    }

    /**
     * Data pemain asli dimulai dari baris ke-5.
     * Baris 1-3 Header, Baris 4 baris "TARGET".
     */
    public function startRow(): int
    {
        return 5;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            $noReg = trim($row[0] ?? '');
            $name = trim($row[1] ?? '');

            // Jika kosong, abaikan baris ini (mungkin baris kosong di akhir file)
            if (empty($noReg) || empty($name)) {
                continue;
            }

            // Parsing tanggal lahir (Kolom C = index 2)
            $dob = null;
            if (!empty($row[2])) {
                try {
                    // Jika format excel date (angka)
                    if (is_numeric($row[2])) {
                        $dob = Date::excelToDateTimeObject($row[2])->format('Y-m-d');
                    } else {
                        // Coba parsing string biasa (contoh: 02/01/1900 atau 1900-01-02)
                        $dob = Carbon::parse($row[2])->format('Y-m-d');
                    }
                } catch (Exception $e) {
                    $dob = null;
                }
            }

            // Cari atau buat AhpPlayer berdasarkan NO REG
            $player = AhpPlayer::firstOrCreate(
                ['no_reg' => $noReg],
                [
                    'name' => $name,
                    'date_of_birth' => $dob,
                    'is_active' => true,
                ]
            );

            // Jika player sudah ada, update nama dan dob-nya jika berbeda (opsional, tapi biarkan saja untuk update jika ada koreksi nama)
            if (!$player->wasRecentlyCreated) {
                $player->update([
                    'name' => $name,
                    'date_of_birth' => $dob ?? $player->date_of_birth,
                ]);
            }

            // Update atau Create Test Result untuk session ini
            AhpTestResult::updateOrCreate(
                [
                    'player_id' => $player->id,
                    'session_id' => $this->sessionId,
                ],
                [
                    'age'                   => is_numeric($row[3]) ? $row[3] : null,
                    'height_cm'             => is_numeric($row[4]) ? $row[4] : null,
                    'weight_kg'             => is_numeric($row[5]) ? $row[5] : null,
                    'bmi'                   => is_numeric($row[6]) ? $row[6] : null,
                    'body_fat_percentage'   => is_numeric($row[7]) ? $row[7] : null,
                    'skeletal_muscle_mass'  => is_numeric($row[8]) ? $row[8] : null,
                    'moca_score'            => is_numeric($row[9]) ? $row[9] : null,
                    'total_passing'         => is_numeric($row[10]) ? $row[10] : null,
                    'passing_sukses'        => is_numeric($row[11]) ? $row[11] : null,
                    'passing_gagal'         => is_numeric($row[12]) ? $row[12] : null,
                    'scanning_per_10sec'    => is_numeric($row[13]) ? $row[13] : null,
                    'initial_acceleration'  => is_numeric($row[14]) ? $row[14] : null,
                    'acceleration_phase'    => is_numeric($row[15]) ? $row[15] : null,
                    'maximal_speed'         => is_numeric($row[16]) ? $row[16] : null,
                    'rast_test'             => is_numeric($row[17]) ? $row[17] : null,
                    'yo_yo_level'           => is_numeric($row[18]) ? $row[18] : null,
                    'yo_yo_balikan'         => is_numeric($row[19]) ? $row[19] : null,
                    'yo_yo_distance'        => is_numeric($row[20]) ? $row[20] : null,
                ]
            );
        }
    }
}
