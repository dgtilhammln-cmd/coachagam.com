<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\AhpResultImport;
use App\Models\AhpPlayer;
use App\Models\AhpTestResult;
use App\Models\AhpTestSession;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AhpResultController extends Controller
{
    public function index(AhpTestSession $session)
    {
        $players = AhpPlayer::where('is_active', true)->orderBy('no_reg')->get();
        $results = $session->results()->with('player')->get()->keyBy('player_id');
        return view('admin.ahp-training.results.index', compact('session', 'players', 'results'));
    }

    public function update(Request $request, AhpTestSession $session)
    {
        $rows = $request->input('results', []);
        foreach ($rows as $playerId => $data) {
            $height = (float)($data['height_cm'] ?? 0);
            $weight = (float)($data['weight_kg'] ?? 0);
            $bmi = ($height > 0 && $weight > 0) ? round($weight / (($height / 100) ** 2), 2) : null;

            $totPass = (int)($data['total_passing'] ?? 0);
            $sukses  = (int)($data['passing_sukses'] ?? 0);

            AhpTestResult::updateOrCreate(
                ['player_id' => $playerId, 'session_id' => $session->id],
                [
                    'age'                  => $data['age'] ?? null,
                    'height_cm'            => $height ?: null,
                    'weight_kg'            => $weight ?: null,
                    'bmi'                  => $bmi,
                    'body_fat_percentage'  => $data['body_fat_percentage'] ?? null,
                    'skeletal_muscle_mass' => $data['skeletal_muscle_mass'] ?? null,
                    'moca_score'           => $data['moca_score'] ?? null,
                    'total_passing'        => $totPass ?: null,
                    'passing_sukses'       => $sukses ?: null,
                    'passing_gagal'        => ($totPass && $sukses) ? max(0, $totPass - $sukses) : null,
                    'scanning_per_10sec'   => $data['scanning_per_10sec'] ?? null,
                    'initial_acceleration' => $data['initial_acceleration'] ?? null,
                    'acceleration_phase'   => $data['acceleration_phase'] ?? null,
                    'maximal_speed'        => $data['maximal_speed'] ?? null,
                    'rast_test'            => $data['rast_test'] ?? null,
                    'yo_yo_level'          => $data['yo_yo_level'] ?? null,
                    'yo_yo_balikan'        => $data['yo_yo_balikan'] ?? null,
                    'yo_yo_distance'       => $data['yo_yo_distance'] ?? null,
                    'rating_notes'         => $data['rating_notes'] ?? null,
                ]
            );
        }

        return redirect()->route('admin.ahp.results.index', $session)->with('success', 'Data hasil test berhasil disimpan!');
    }

    public function importForm(AhpTestSession $session)
    {
        return view('admin.ahp-training.results.import', compact('session'));
    }

    public function import(Request $request, AhpTestSession $session)
    {
        $request->validate(['file' => 'required|mimes:xlsx,xls,csv|max:5120']);

        try {
            $import = new \App\Imports\AhpTestResultImport($session->id);
            Excel::import($import, $request->file('file'));
            return redirect()->route('admin.ahp.results.index', $session)
                ->with('success', "Berhasil mengimpor data hasil tes!");
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal import: ' . $e->getMessage());
        }
    }

    public function downloadTemplate()
    {
        $headers = [
            'NO REG', 'NAME', 'AGE', 'HEIGHT (cm)', 'WEIGHT (kg)', 'BMI',
            'Body Fat %', 'Skeletal Muscle Mass', 'MoCA Score',
            'Total Passing', 'Passing Sukses', 'Passing Gagal',
            'Scanning/10s', 'Initial Acc (0-10m)', 'Acc Phase (10-20m)',
            'Max Speed (20-30m)', 'RAST Test', 'Yo-Yo Level', 'Balikan', 'Distance',
        ];

        $callback = function () use ($headers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $headers);
            fputcsv($file, ['AHP-03', 'MARIO KIDANG', 19, 175, 68, 22.2, 12.5, 35.2, 26, 30, 25, 5, 4.2, 1.85, 1.92, 1.78, 45.2, 17, 8, 1120]);
            fclose($file);
        };

        return response()->streamDownload($callback, 'template_ahp_import.csv', [
            'Content-Type' => 'text/csv',
        ]);
    }
}
