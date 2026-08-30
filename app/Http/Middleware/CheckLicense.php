<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class CheckLicense
{
    /**
     * License expiry date — update this to renew.
     * Format: Y-m-d
     */
    const EXPIRY_DATE = '2027-06-26';

    public function handle(Request $request, Closure $next): Response
    {
        // Skip admin routes, SEO routes, and static assets
        if (
            $request->is('admin*') ||
            $request->is('sitemap.xml') ||
            $request->is('robots.txt') ||
            $request->is('llms.txt') ||
            $request->is('api/*') ||
            $request->is('storage/*') ||
            $request->is('favicon*')
        ) {
            return $next($request);
        }

        $expiry = Carbon::parse(self::EXPIRY_DATE)->endOfDay();

        if (now()->greaterThan($expiry)) {
            // Return a minimal, SEO-safe "under maintenance" page
            return response()->view('errors.license_expired', [
                'expiry' => $expiry->format('d F Y'),
            ], 503)->header('Retry-After', 3600)
              ->header('X-Robots-Tag', 'noindex, nofollow');
        }

        return $next($request);
    }

    public static function getExpiryDate(): Carbon
    {
        return Carbon::parse(self::EXPIRY_DATE)->endOfDay();
    }

    public static function isActive(): bool
    {
        return now()->lessThanOrEqualTo(self::getExpiryDate());
    }

    public static function daysRemaining(): int
    {
        return (int) max(0, now()->diffInDays(self::getExpiryDate(), false));
    }
}
