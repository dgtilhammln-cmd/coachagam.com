<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'posts_published' => 0,
            'posts_draft'     => 0,
            'posts_total'     => 0,
            'settings_total'  => 0,
        ];

        try {
            if (Schema::hasTable('posts')) {
                $stats['posts_published'] = Post::where('status', 'published')->count();
                $stats['posts_draft']     = Post::where('status', 'draft')->count();
                $stats['posts_total']     = Post::count();
            }
            if (Schema::hasTable('site_settings')) {
                $stats['settings_total'] = SiteSetting::count();
            }
        } catch (\Throwable) {}

        return view('admin.dashboard', compact('stats'));
    }
}
