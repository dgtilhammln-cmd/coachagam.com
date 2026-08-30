<?php

namespace Database\Seeders;

use App\Models\AhpPlayer;
use App\Models\AhpTestSession;
use App\Models\AhpTestResult;
use Illuminate\Database\Seeder;

class AhpDatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing
        AhpTestResult::query()->delete();
        AhpTestSession::query()->delete();
        AhpPlayer::query()->delete();

        // ─── Players ────────────────────────────────────────────
        $playersData = [
            ['no_reg' => 'AHP-03', 'name' => 'MARIO KIDANG',              'date_of_birth' => '2005-03-15', 'position' => 'Forward'],
            ['no_reg' => 'AHP-04', 'name' => 'GIBRAN NUR AZIZ MUNAJID',   'date_of_birth' => '2004-07-22', 'position' => 'Midfielder'],
            ['no_reg' => 'AHP-05', 'name' => 'ALEX ALHABIBI',             'date_of_birth' => '2005-01-10', 'position' => 'Defender'],
            ['no_reg' => 'AHP-06', 'name' => 'ARKAN DAFFA SURYANA',       'date_of_birth' => '2004-11-05', 'position' => 'Midfielder'],
            ['no_reg' => 'AHP-07', 'name' => 'ANDISSHAFA MAULANA PUTRA',  'date_of_birth' => '2005-06-18', 'position' => 'Forward'],
            ['no_reg' => 'AHP-08', 'name' => 'GABRIEL EMPINDONTA',        'date_of_birth' => '2004-09-30', 'position' => 'Goalkeeper'],
            ['no_reg' => 'AHP-09', 'name' => 'DODIK WAHYU PRASTYO',       'date_of_birth' => '2005-02-14', 'position' => 'Defender'],
            ['no_reg' => 'AHP-10', 'name' => 'AHMAD LAKAL FAUZ FAWA',     'date_of_birth' => '2004-12-01', 'position' => 'Midfielder'],
            ['no_reg' => 'AHP-11', 'name' => 'ALVAREZA KINAN SADEWA',     'date_of_birth' => '2005-04-25', 'position' => 'Forward'],
            ['no_reg' => 'AHP-12', 'name' => 'FAHRI NUR FATIKH',          'date_of_birth' => '2004-08-17', 'position' => 'Midfielder'],
            ['no_reg' => 'AHP-13', 'name' => 'DIAN',                      'date_of_birth' => '2005-05-09', 'position' => 'Defender'],
            ['no_reg' => 'AHP-14', 'name' => 'DANU BAGUS FEBRIANO',       'date_of_birth' => '2004-10-22', 'position' => 'Forward'],
            ['no_reg' => 'AHP-15', 'name' => 'FADAUKAS MUHAMMAD HAQ',     'date_of_birth' => '2005-01-30', 'position' => 'Midfielder'],
            ['no_reg' => 'AHP-16', 'name' => 'M. AZIS SYAIFULLAH',        'date_of_birth' => '2004-06-12', 'position' => 'Defender'],
            ['no_reg' => 'AHP-17', 'name' => 'EXCEL ELRAHMANSYAH RIZAL',  'date_of_birth' => '2005-03-28', 'position' => 'Forward'],
            ['no_reg' => 'AHP-18', 'name' => 'MUHAMMAD ROBITH AL-HIKAM',  'date_of_birth' => '2004-11-14', 'position' => 'Midfielder'],
            ['no_reg' => 'AHP-19', 'name' => 'HUONE FIGO F. H',           'date_of_birth' => '2005-07-07', 'position' => 'Defender'],
            ['no_reg' => 'AHP-20', 'name' => 'BAMBANG PRASTYO AGUNG',     'date_of_birth' => '2004-02-19', 'position' => 'Forward'],
            ['no_reg' => 'AHP-21', 'name' => 'YOHANES S.KAKO',            'date_of_birth' => '2005-09-03', 'position' => 'Midfielder'],
            ['no_reg' => 'AHP-22', 'name' => 'RADITYA JOVAN P',           'date_of_birth' => '2004-04-16', 'position' => 'Defender'],
            ['no_reg' => 'AHP-23', 'name' => 'M. ROSYID M',               'date_of_birth' => '2005-08-11', 'position' => 'Forward'],
            ['no_reg' => 'AHP-24', 'name' => 'YANSA PRASETYA',            'date_of_birth' => '2004-12-27', 'position' => 'Midfielder'],
            ['no_reg' => 'AHP-25', 'name' => 'ERICK CAHYADI',             'date_of_birth' => '2005-02-05', 'position' => 'Defender'],
            ['no_reg' => 'AHP-26', 'name' => 'AHMAD RAFI C',              'date_of_birth' => '2004-07-31', 'position' => 'Forward'],
            ['no_reg' => 'AHP-27', 'name' => 'ABYAN RIZKY A',             'date_of_birth' => '2005-05-20', 'position' => 'Midfielder'],
            ['no_reg' => 'AHP-28', 'name' => 'JEKA MAYA MONTEIRO',        'date_of_birth' => '2004-09-08', 'position' => 'Defender'],
            ['no_reg' => 'AHP-29', 'name' => 'BAGAS NUR W',               'date_of_birth' => '2005-06-15', 'position' => 'Forward'],
        ];

        foreach ($playersData as $p) {
            AhpPlayer::create(array_merge($p, ['is_active' => true]));
        }

        // ─── Sessions ────────────────────────────────────────────
        $preTest = AhpTestSession::create([
            'label'       => 'Pre Test',
            'location'    => 'Training Ground RNA',
            'test_date'   => '2024-01-15',
            'test_time'   => '15:00:00',
            'temperature' => '26°C',
            'period_week' => 0,
        ]);

        $postTest = AhpTestSession::create([
            'label'       => 'Post Test',
            'location'    => 'Training Ground RNA',
            'test_date'   => '2024-03-11',
            'test_time'   => '15:00:00',
            'temperature' => '28°C',
            'period_week' => 8,
        ]);

        // ─── Pre Test data (realistic dummy) ─────────────────────
        $preData = [
            ['AHP-03', 19, 175, 68.0, 12.5, 35.2, 26, 30, 25, 4.2, 1.85, 1.92, 1.78, 45.2, 17, 8, 1120],
            ['AHP-04', 20, 172, 65.0, 14.0, 34.0, 24, 28, 22, 3.8, 1.92, 2.00, 1.88, 48.5, 16, 7, 1040],
            ['AHP-05', 19, 178, 72.0, 13.2, 37.5, 25, 25, 19, 3.5, 1.88, 1.95, 1.82, 50.1, 15, 6, 960],
            ['AHP-06', 20, 170, 63.0, 15.0, 33.0, 23, 32, 26, 4.0, 1.95, 2.02, 1.90, 52.3, 16, 9, 1080],
            ['AHP-07', 19, 168, 60.0, 11.5, 31.5, 27, 28, 24, 4.5, 1.78, 1.85, 1.72, 42.0, 18, 10, 1200],
            ['AHP-08', 20, 182, 78.0, 16.0, 40.0, 22, 20, 16, 3.0, 2.10, 2.15, 2.05, 58.0, 14, 5, 840],
            ['AHP-09', 19, 176, 70.0, 14.5, 36.8, 24, 27, 21, 3.7, 1.90, 1.98, 1.85, 49.8, 16, 7, 1000],
            ['AHP-10', 20, 171, 64.0, 13.8, 33.5, 25, 31, 25, 3.9, 1.93, 2.01, 1.89, 51.2, 16, 8, 1060],
            ['AHP-11', 19, 169, 61.0, 12.0, 32.0, 26, 29, 24, 4.3, 1.82, 1.90, 1.76, 44.5, 17, 9, 1140],
            ['AHP-12', 20, 173, 66.0, 14.2, 34.8, 24, 30, 23, 3.8, 1.91, 1.99, 1.87, 50.5, 16, 7, 1020],
            ['AHP-13', 19, 177, 71.0, 15.5, 37.0, 23, 26, 20, 3.4, 1.98, 2.05, 1.92, 53.0, 15, 6, 940],
            ['AHP-14', 20, 174, 67.0, 13.0, 35.5, 25, 28, 23, 3.9, 1.88, 1.96, 1.83, 47.8, 17, 8, 1080],
            ['AHP-15', 19, 167, 59.0, 11.8, 30.5, 27, 33, 28, 4.8, 1.75, 1.83, 1.70, 41.0, 18, 11, 1240],
            ['AHP-16', 20, 179, 73.0, 16.5, 38.5, 22, 24, 18, 3.2, 2.05, 2.12, 2.00, 56.5, 14, 5, 880],
            ['AHP-17', 19, 172, 65.5, 12.8, 34.2, 26, 30, 25, 4.1, 1.87, 1.94, 1.80, 46.0, 17, 8, 1100],
            ['AHP-18', 20, 174, 67.5, 14.8, 35.8, 24, 29, 23, 3.7, 1.94, 2.01, 1.88, 51.8, 16, 7, 1000],
            ['AHP-19', 19, 175, 69.0, 13.5, 36.0, 25, 27, 22, 3.9, 1.89, 1.97, 1.84, 48.2, 16, 7, 1020],
            ['AHP-20', 20, 176, 70.5, 15.2, 37.2, 23, 26, 21, 3.5, 1.97, 2.04, 1.91, 52.5, 15, 6, 940],
            ['AHP-21', 19, 170, 63.5, 13.0, 33.8, 26, 31, 26, 4.2, 1.86, 1.94, 1.80, 45.5, 17, 9, 1120],
            ['AHP-22', 20, 178, 72.5, 15.8, 38.0, 23, 25, 19, 3.3, 2.02, 2.08, 1.96, 54.8, 15, 6, 920],
            ['AHP-23', 19, 166, 58.0, 11.2, 29.8, 27, 32, 27, 4.6, 1.76, 1.84, 1.71, 42.5, 18, 10, 1180],
            ['AHP-24', 20, 173, 66.5, 14.5, 35.0, 24, 30, 24, 3.8, 1.93, 2.00, 1.87, 50.2, 16, 7, 1040],
            ['AHP-25', 19, 175, 68.5, 13.8, 35.5, 25, 28, 23, 3.9, 1.90, 1.97, 1.84, 48.8, 16, 8, 1060],
            ['AHP-26', 20, 171, 64.5, 12.5, 33.8, 26, 29, 24, 4.0, 1.88, 1.95, 1.82, 46.8, 17, 8, 1080],
            ['AHP-27', 19, 174, 67.0, 14.0, 35.2, 24, 31, 25, 3.8, 1.92, 2.00, 1.87, 50.0, 16, 7, 1020],
            ['AHP-28', 20, 177, 71.5, 15.0, 37.5, 23, 26, 20, 3.4, 1.99, 2.06, 1.93, 53.5, 15, 6, 960],
            ['AHP-29', 19, 168, 61.5, 12.2, 32.5, 26, 28, 23, 4.1, 1.84, 1.91, 1.78, 45.0, 17, 9, 1100],
        ];

        $players = AhpPlayer::all()->keyBy('no_reg');
        foreach ($preData as $row) {
            [$noReg, $age, $height, $weight, $fat, $muscle, $moca, $totPass, $sukses, $scan, $acc0, $acc10, $maxSpd, $rast, $yyLvl, $yyBal, $yyDist] = $row;
            $player = $players[$noReg] ?? null;
            if (!$player) continue;
            $h = $height / 100;
            $bmi = round($weight / ($h * $h), 2);
            AhpTestResult::create([
                'player_id'           => $player->id,
                'session_id'          => $preTest->id,
                'age'                 => $age,
                'height_cm'           => $height,
                'weight_kg'           => $weight,
                'bmi'                 => $bmi,
                'body_fat_percentage' => $fat,
                'skeletal_muscle_mass'=> $muscle,
                'moca_score'          => $moca,
                'total_passing'       => $totPass,
                'passing_sukses'      => $sukses,
                'passing_gagal'       => $totPass - $sukses,
                'scanning_per_10sec'  => $scan,
                'initial_acceleration'=> $acc0,
                'acceleration_phase'  => $acc10,
                'maximal_speed'       => $maxSpd,
                'rast_test'           => $rast,
                'yo_yo_level'         => $yyLvl,
                'yo_yo_balikan'       => $yyBal,
                'yo_yo_distance'      => $yyDist,
            ]);
        }

        // ─── Post Test (improved ~5-12%) ─────────────────────────
        foreach ($preData as $row) {
            [$noReg, $age, $height, $weight, $fat, $muscle, $moca, $totPass, $sukses, $scan, $acc0, $acc10, $maxSpd, $rast, $yyLvl, $yyBal, $yyDist] = $row;
            $player = $players[$noReg] ?? null;
            if (!$player) continue;
            // Improvements
            $newWeight = round($weight * 0.97, 1);
            $newFat    = round($fat * 0.92, 1);
            $newMuscle = round($muscle * 1.05, 1);
            $newMoca   = min(30, $moca + rand(1, 2));
            $newTotPass= $totPass + rand(1, 3);
            $newSukses = min($newTotPass, $sukses + rand(2, 4));
            $newScan   = round($scan * 1.08, 2);
            $newAcc0   = round($acc0 * 0.94, 3);
            $newAcc10  = round($acc10 * 0.94, 3);
            $newMaxSpd = round($maxSpd * 0.94, 3);
            $newRast   = round($rast * 0.92, 2);
            $newYyLvl  = min(20, $yyLvl + rand(1, 2));
            $newYyBal  = min(12, $yyBal + rand(1, 3));
            $newYyDist = round($yyDist * 1.10, 1);
            $h = $height / 100;
            $newBmi = round($newWeight / ($h * $h), 2);

            AhpTestResult::create([
                'player_id'           => $player->id,
                'session_id'          => $postTest->id,
                'age'                 => $age,
                'height_cm'           => $height,
                'weight_kg'           => $newWeight,
                'bmi'                 => $newBmi,
                'body_fat_percentage' => $newFat,
                'skeletal_muscle_mass'=> $newMuscle,
                'moca_score'          => $newMoca,
                'total_passing'       => $newTotPass,
                'passing_sukses'      => $newSukses,
                'passing_gagal'       => $newTotPass - $newSukses,
                'scanning_per_10sec'  => $newScan,
                'initial_acceleration'=> $newAcc0,
                'acceleration_phase'  => $newAcc10,
                'maximal_speed'       => $newMaxSpd,
                'rast_test'           => $newRast,
                'yo_yo_level'         => $newYyLvl,
                'yo_yo_balikan'       => $newYyBal,
                'yo_yo_distance'      => $newYyDist,
            ]);
        }
    }
}
