<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnalyticsLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->input('period', '7');
        
        $startDate = null;
        $endDate = now();

        if ($period == 'custom') {
            $startDate = $request->input('start_date') ? Carbon::parse($request->input('start_date'))->startOfDay() : now()->subDays(7)->startOfDay();
            $endDate = $request->input('end_date') ? Carbon::parse($request->input('end_date'))->endOfDay() : now()->endOfDay();
        } elseif (is_numeric($period)) {
            $startDate = now()->subDays((int)$period - 1)->startOfDay();
        } else {
            $startDate = now()->subDays(6)->startOfDay();
        }

        $logs = AnalyticsLog::whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $visitors = $logs->where('type', 'visitor')->count();
        $waClicks = $logs->where('type', 'wa_click')->count();
        $leads = $logs->where('type', 'lead')->count();

        // Group by day for charts/tables
        $dailyData = [];
        $current = $startDate->copy();
        while ($current <= $endDate) {
            $dateString = $current->format('Y-m-d');
            $dailyData[$dateString] = [
                'visitor' => 0,
                'wa_click' => 0,
                'lead' => 0,
            ];
            $current->addDay();
        }

        foreach ($logs as $log) {
            $dateString = $log->created_at->format('Y-m-d');
            if (isset($dailyData[$dateString])) {
                $dailyData[$dateString][$log->type]++;
            }
        }

        return view('admin.analytics.index', compact('visitors', 'waClicks', 'leads', 'dailyData', 'period', 'startDate', 'endDate'));
    }
}
