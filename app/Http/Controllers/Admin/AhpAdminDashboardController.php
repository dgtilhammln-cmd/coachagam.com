<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AhpPlayer;
use App\Models\AhpTestSession;
use App\Models\AhpTestResult;

class AhpAdminDashboardController extends Controller
{
    public function index()
    {
        $totalPlayers  = AhpPlayer::where('is_active', true)->count();
        $totalSessions = AhpTestSession::count();
        $totalResults  = AhpTestResult::count();

        $avgBmi   = AhpTestResult::whereNotNull('bmi')->avg('bmi');
        $avgMoca  = AhpTestResult::whereNotNull('moca_score')->avg('moca_score');

        $recentPlayers = AhpPlayer::latest()->take(8)->get();
        $sessions      = AhpTestSession::withCount('results')->orderBy('test_date', 'desc')->get();

        return view('admin.ahp-training.dashboard', compact(
            'totalPlayers', 'totalSessions', 'totalResults',
            'avgBmi', 'avgMoca', 'recentPlayers', 'sessions'
        ));
    }
}
