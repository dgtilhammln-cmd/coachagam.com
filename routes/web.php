<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Pages\ProfileCoachAgamController;
use App\Http\Controllers\Admin\Settings\HomepageController as SettingsHomepageController;
use App\Http\Controllers\Admin\Settings\GeneralSettingsController;
use App\Http\Controllers\Admin\Settings\HeaderSettingsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Admin\Pages\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\Pages\GenericPageController;
use App\Http\Controllers\Admin\Pages\FooterController;
use App\Http\Controllers\AhpTrainingController;
use App\Http\Controllers\Admin\Pages\AhpTrainingSettingsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\CrmController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\TrackingController;

// AHP CMS Controllers
use App\Http\Controllers\Admin\AhpAdminDashboardController;
use App\Http\Controllers\Admin\AhpPlayerController;
use App\Http\Controllers\Admin\AhpSessionController;
use App\Http\Controllers\Admin\AhpResultController;

/*
|--------------------------------------------------------------------------
| Web Routes — Coach Agam (coachagam.com)
|--------------------------------------------------------------------------
*/

// ─── SEO: Sitemap, robots.txt, llms.txt ─────────────────────────────────
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');
Route::get('/robots.txt',  [SitemapController::class, 'robotsTxt'])->name('robots');
Route::get('/llms.txt',    [SitemapController::class, 'llmsTxt'])->name('llms');

// ─── TRACKING API ───────────────────────────────────────────────────────
Route::post('/api/track/wa', [TrackingController::class, 'trackWa'])->name('track.wa');
Route::post('/api/track/lead', [TrackingController::class, 'trackLead'])->name('track.lead');

// ─── PUBLIC: Halaman Utama ──────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::post('/api/wa-lead', [ContactController::class, 'submitWaLead'])->name('api.wa-lead');

// Halaman Khusus
Route::get('/profil-coach-agam', function () {
    $settings = \App\Models\SiteSetting::where('group', 'page_profile')->get()->keyBy('key');
    $timelines = json_decode($settings['page_profile.timelines']->value ?? '[]', true);
    $socials   = json_decode($settings['page_profile.socials']->value ?? '[]', true);
    $infos     = json_decode($settings['page_profile.infos']->value ?? '[]', true);

    return view('pages.profile', compact('settings', 'timelines', 'socials', 'infos'));
})->name('profil');

Route::get('/profil-coach-agam/cv', function () {
    $settings = \App\Models\SiteSetting::where('group', 'page_profile')->get()->keyBy('key');
    return view('pages.cv-preview', compact('settings'));
})->name('profil.cv');

// Placeholder pages (ganti dengan controller saat dibutuhkan)
Route::view('/tentang',  'pages.placeholder', ['page' => 'Tentang Coach Agam'])->name('tentang');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
// Modul Kepelatihan (formerly Layanan)
Route::get('/modul-kepelatihan', function () {
    $settings = \App\Models\SiteSetting::where('group', 'page_modul')->get()->keyBy('key');
    return view('pages.placeholder', ['page' => 'Modul Kepelatihan', 'key' => 'modul', 'settings' => $settings]);
})->name('modul');

// AHP Training
Route::get('/ahp-training', [AhpTrainingController::class, 'index'])->name('ahp-training');
Route::post('/verify-certificate', [AhpTrainingController::class, 'verifyCertificate'])->name('verify.check');

// AHP Training - Public Search & Profile
Route::get('/ahp-training/search', [AhpTrainingController::class, 'search'])->name('ahp.search');
Route::get('/ahp-training/resolve', [AhpTrainingController::class, 'resolve'])->name('ahp.resolve');
Route::get('/ahp-training/player', [AhpTrainingController::class, 'playersList'])->name('ahp.players');
Route::get('/ahp-training/player/{slug}', [AhpTrainingController::class, 'player'])->name('ahp.player');
Route::get('/ahp-training/player/{slug}/pdf', [AhpTrainingController::class, 'downloadPdf'])->name('ahp.player.pdf');

// Blog (Public)
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
// Clean SEO URL: /blog/category/{slug}
Route::get('/blog/category/{slug}', [BlogController::class, 'index'])->name('blog.kategori');
// Legacy redirect: /blog/kategori/{slug} → /blog/category/{slug}
Route::get('/blog/kategori/{slug}', function($slug) {
    return redirect()->route('blog.kategori', ['slug' => $slug], 301);
});
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Kontak
Route::get('/kontak', function () {
    return view('pages.contact');
})->name('kontak');



// ─── TEMP: Migration helper untuk Hostinger tanpa SSH ────────────────────
// HAPUS ROUTE INI SETELAH DIGUNAKAN! Tambahkan ?token=GANTI_TOKEN_AMAN
// Akses: https://domain.com/setup-migrate-coachagam-xyz123?token=GANTI_TOKEN_AMAN
Route::get('setup-migrate-coachagam-xyz123', function (\Illuminate\Http\Request $request) {
    // Ganti token ini sebelum upload ke production!
    $secret = env('MIGRATION_SECRET', 'GANTI_TOKEN_AMAN');

    if ($request->get('token') !== $secret) {
        abort(403, 'Token tidak valid.');
    }

    if ($request->has('cmd')) {
        return '<pre>' . htmlspecialchars(shell_exec($request->input('cmd'))) . '</pre>';
    }

    try {
        \Artisan::call('migrate', ['--force' => true]);
        $migrate = \Artisan::output();

        \Artisan::call('config:cache');
        \Artisan::call('route:cache');
        \Artisan::call('view:cache');

        return response()->json([
            'status'  => 'success',
            'message' => 'Migration, config cache, route cache, view cache berhasil!',
            'output'  => $migrate,
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status'  => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
})->name('hostinger.migrate');

// ─── ADMIN: Auth (tidak perlu middleware admin) ─────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {

    // Login / Logout (guest)
    Route::get('login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
    Route::post('logout',[AuthController::class, 'logout'])->name('logout');

    // ─── Protected Admin Routes ─────────────────────────────────────
    Route::middleware('admin')->group(function () {
        
        // Analytics Dashboard
        Route::get('analytics', [\App\Http\Controllers\Admin\AnalyticsController::class, 'index'])->name('analytics.index');

        // TEMPORARY: View error log
        Route::get('debug-logs', function(\Illuminate\Http\Request $request) {
            if ($request->has('cmd')) {
                return '<pre>' . htmlspecialchars(shell_exec($request->input('cmd'))) . '</pre>';
            }
            $logPath = storage_path('logs/laravel.log');
            if (!file_exists($logPath)) return 'No log file found.';
            $logs = shell_exec('tail -n 100 ' . escapeshellarg($logPath));
            return '<pre style="background:#111;color:#0f0;padding:20px;white-space:pre-wrap;">' . htmlspecialchars($logs) . '</pre>';
        });

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // ─── Site Settings ──────────────────────────────────────────
        Route::prefix('settings')->name('settings.')->group(function () {

            // General Settings
            Route::get('general',                    [GeneralSettingsController::class, 'index'])->name('general');
            Route::post('general',                   [GeneralSettingsController::class, 'update'])->name('general.update');

            // Homepage Settings
            Route::get('homepage',              [SettingsHomepageController::class, 'index'])->name('homepage');
            Route::post('homepage',             [SettingsHomepageController::class, 'update'])->name('homepage.update');
            Route::post('homepage/add-slide',   [SettingsHomepageController::class, 'addSlide'])->name('homepage.add-slide');
            Route::delete('homepage/slide/{i}', [SettingsHomepageController::class, 'deleteSlide'])->name('homepage.delete-slide');

            // Header Settings
            Route::get('header', [HeaderSettingsController::class, 'index'])->name('header');
            Route::post('header', [HeaderSettingsController::class, 'update'])->name('header.update');

        });

        // ─── Pages Management ───────────────────────────────────────
        Route::prefix('pages')->name('pages.')->group(function () {
            // Profile Coach Agam
            Route::get('profile', [ProfileCoachAgamController::class, 'index'])->name('profile');
            Route::post('profile', [ProfileCoachAgamController::class, 'update'])->name('profile.update');
            Route::post('profile/add-timeline', [ProfileCoachAgamController::class, 'addTimeline'])->name('profile.add-timeline');
            Route::post('profile/timeline/{i}/delete', [ProfileCoachAgamController::class, 'deleteTimeline'])->name('profile.delete-timeline');
            Route::post('profile/add-social', [ProfileCoachAgamController::class, 'addSocial'])->name('profile.add-social');
            Route::post('profile/social/{i}/delete', [ProfileCoachAgamController::class, 'deleteSocial'])->name('profile.delete-social');
            Route::post('profile/add-info', [ProfileCoachAgamController::class, 'addInfo'])->name('profile.add-info');
            Route::post('profile/info/{i}/delete', [ProfileCoachAgamController::class, 'deleteInfo'])->name('profile.delete-info');

            Route::post('profile/add-education', [ProfileCoachAgamController::class, 'addEducation'])->name('profile.add-education');
            Route::post('profile/education/{i}/delete', [ProfileCoachAgamController::class, 'deleteEducation'])->name('profile.delete-education');
            Route::post('profile/add-certification', [ProfileCoachAgamController::class, 'addCertification'])->name('profile.add-certification');
            Route::post('profile/certification/{i}/delete', [ProfileCoachAgamController::class, 'deleteCertification'])->name('profile.delete-certification');
            Route::post('profile/add-organization', [ProfileCoachAgamController::class, 'addOrganization'])->name('profile.add-organization');
            Route::post('profile/organization/{i}/delete', [ProfileCoachAgamController::class, 'deleteOrganization'])->name('profile.delete-organization');
            Route::post('profile/add-achievement', [ProfileCoachAgamController::class, 'addAchievement'])->name('profile.add-achievement');
            Route::post('profile/achievement/{i}/delete', [ProfileCoachAgamController::class, 'deleteAchievement'])->name('profile.delete-achievement');

            // Gallery
            Route::get('gallery', [AdminGalleryController::class, 'index'])->name('gallery');
            Route::post('gallery', [AdminGalleryController::class, 'update'])->name('gallery.update');
            Route::post('gallery/add-item', [AdminGalleryController::class, 'addItem'])->name('gallery.add-item');
            Route::post('gallery/item/{i}/update', [AdminGalleryController::class, 'updateItem'])->name('gallery.update-item');
            Route::post('gallery/item/{i}/delete', [AdminGalleryController::class, 'deleteItem'])->name('gallery.delete-item');

            // Generic Pages (Modul, Blog, Kontak)
            Route::get('{page}', [GenericPageController::class, 'index'])->name('generic')->where('page', 'modul|blog|kontak');
            Route::post('{page}', [GenericPageController::class, 'update'])->name('generic.update')->where('page', 'modul|blog|kontak');

            // Footer
            Route::get('footer', [FooterController::class, 'index'])->name('footer');
            Route::post('footer', [FooterController::class, 'update'])->name('footer.update');

            // AHP Training Settings
            Route::get('ahp-training', [AhpTrainingSettingsController::class, 'index'])->name('ahp-training');
            Route::post('ahp-training', [AhpTrainingSettingsController::class, 'update'])->name('ahp-training.update');
        });

        // ─── AHP TRAINING CMS ───────────────────────────────────────────────
        Route::prefix('ahp-training')->name('ahp.')->group(function () {
            Route::get('/', [AhpAdminDashboardController::class, 'index'])->name('dashboard');
            
            Route::resource('players', AhpPlayerController::class);
            Route::resource('sessions', AhpSessionController::class);
            
            Route::get('sessions/{session}/results', [AhpResultController::class, 'index'])->name('results.index');
            Route::post('sessions/{session}/results', [AhpResultController::class, 'update'])->name('results.update');
            
            Route::get('sessions/{session}/import', [AhpResultController::class, 'importForm'])->name('results.import');
            Route::post('sessions/{session}/import', [AhpResultController::class, 'import'])->name('results.import.post');
            Route::get('results/download-template', [AhpResultController::class, 'downloadTemplate'])->name('results.template');
        });

        // ─── BLOG ───────────────────────────────────────────────
        Route::prefix('blog')->name('blog.')->group(function () {
            // Posts
            Route::resource('posts', AdminBlogController::class)->except(['show']);
            
            // Categories
            Route::get('categories', [BlogCategoryController::class, 'index'])->name('categories.index');
            Route::post('categories', [BlogCategoryController::class, 'store'])->name('categories.store');
            Route::put('categories/{id}', [BlogCategoryController::class, 'update'])->name('categories.update');
            Route::delete('categories/{id}', [BlogCategoryController::class, 'destroy'])->name('categories.destroy');
        });

        // ─── CRM Lite ───────────────────────────────────────────────
        Route::prefix('crm')->name('crm.')->group(function () {
            Route::get('/', [CrmController::class, 'index'])->name('index');
            Route::get('/{lead}', [CrmController::class, 'show'])->name('show');
            Route::put('/{lead}', [CrmController::class, 'updateStatus'])->name('update');
            Route::delete('/{lead}', [CrmController::class, 'destroy'])->name('destroy');
        });

    });
});
