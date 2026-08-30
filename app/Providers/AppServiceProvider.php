<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share global breadcrumb image to ALL views (including child sections)
        View::composer('*', function ($view) {
            static $breadcrumbImage = null;
            if ($breadcrumbImage === null) {
                $breadcrumbImage = SiteSetting::where('key', 'general.breadcrumb_image')
                    ->value('value') ?? '';
            }
            $view->with('__globalBreadcrumbImage', $breadcrumbImage);
        });
    }
}
