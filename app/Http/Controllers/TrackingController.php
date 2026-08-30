<?php

namespace App\Http\Controllers;

use App\Models\AnalyticsLog;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function trackWa(Request $request)
    {
        AnalyticsLog::create([
            'type' => 'wa_click',
            'ip_address' => $request->ip(),
            'user_agent' => substr($request->userAgent(), 0, 500),
            'url' => substr($request->headers->get('referer') ?? $request->url(), 0, 255),
            'source' => $request->input('source', 'unknown'),
        ]);

        return response()->json(['success' => true]);
    }

    public function trackLead(Request $request)
    {
        AnalyticsLog::create([
            'type' => 'lead',
            'ip_address' => $request->ip(),
            'user_agent' => substr($request->userAgent(), 0, 500),
            'url' => substr($request->headers->get('referer') ?? $request->url(), 0, 255),
            'source' => $request->input('source', 'contact_form'),
        ]);

        return response()->json(['success' => true]);
    }
}
