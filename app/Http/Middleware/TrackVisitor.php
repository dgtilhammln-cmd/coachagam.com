<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\AnalyticsLog;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Ignore admin routes
        if ($request->is('admin*') || $request->is('admin/*')) {
            return $next($request);
        }

        try {
            // Check if visitor has already been tracked today based on IP
            $ip = $request->ip();
            $today = now()->startOfDay();

            $alreadyTracked = AnalyticsLog::where('type', 'visitor')
                ->where('ip_address', $ip)
                ->where('created_at', '>=', $today)
                ->exists();

            if (!$alreadyTracked) {
                AnalyticsLog::create([
                    'type' => 'visitor',
                    'ip_address' => $ip,
                    'user_agent' => substr($request->userAgent(), 0, 500),
                    'url' => substr($request->fullUrl(), 0, 255),
                ]);
            }
        } catch (\Exception $e) {
            // Ignore if table does not exist or database is down
        }

        return $next($request);
    }
}
