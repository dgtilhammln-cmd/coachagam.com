<?php

namespace App\Http\Controllers;

use App\Helpers\AhpRatingHelper;
use App\Models\AhpPlayer;
use App\Models\AhpTestResult;
use App\Models\AhpTestSession;
use App\Models\SiteSetting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AhpTrainingController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::where('group', 'page_ahp_training')->pluck('value', 'key');

        $heroTitle    = $settings->get('page_ahp_training.hero_title', 'AHP Training');
        $heroSubtitle = $settings->get('page_ahp_training.hero_subtitle', 'Program Pelatihan Sepakbola Profesional');
        $aboutText    = $settings->get('page_ahp_training.about_text', '<p>AHP Training adalah program pelatihan eksklusif yang dirancang untuk meningkatkan atribut teknis dan fisik pemain sepakbola modern secara terukur.</p>');
        $aboutImage   = $settings->get('page_ahp_training.about_image', '');

        $introHeadlineBold = $settings->get('page_ahp_training.intro_headline_bold', 'Agility. Heading.');
        $introHeadlineThin = $settings->get('page_ahp_training.intro_headline_thin', 'Training Terstruktur');
        $introEyebrowLabel = $settings->get('page_ahp_training.intro_eyebrow_label', 'Overview Program');
        $introBadgeText    = $settings->get('page_ahp_training.intro_badge_text', "Program\nEksklusif");

        $stat1Value = $settings->get('page_ahp_training.stat1_value', '6');
        $stat1Label = $settings->get('page_ahp_training.stat1_label', 'Tahapan Terstruktur');
        $stat2Value = $settings->get('page_ahp_training.stat2_value', '100%');
        $stat2Label = $settings->get('page_ahp_training.stat2_label', 'Berbasis Data');
        $stat3Value = $settings->get('page_ahp_training.stat3_value', 'AFC');
        $stat3Label = $settings->get('page_ahp_training.stat3_label', 'Lisensi Pelatih');

        // Section 1: Pre Test
        $preTestTitle = $settings->get('page_ahp_training.pretest_title', 'Pre Test');
        $preTestDesc  = $settings->get('page_ahp_training.pretest_desc', 'Sebelum memulai program, setiap pemain menjalani serangkaian tes awal untuk mengukur kondisi fisik dan kemampuan dasar sebagai baseline pengembangan.');
        $preTestImage = $settings->get('page_ahp_training.pretest_image', '');
        $preTestItems = $settings->get('page_ahp_training.pretest_items', json_encode(['Pengukuran BMI & Komposisi Tubuh', 'Tes MoCA (Kognitif)', 'Tes Passing & Scanning', 'Tes Akselerasi & Kecepatan Maksimal', 'Tes Yo-Yo Endurance']));

        // Section 2: Program Latihan
        $programTitle    = $settings->get('page_ahp_training.program_title', 'Program Latihan');
        $programSubtitle = $settings->get('page_ahp_training.program_subtitle', 'Tahunan · Bulanan · Mingguan · Harian');
        $programDesc     = $settings->get('page_ahp_training.program_desc', 'Menu latihan intensif yang distrukturisasi untuk mengembangkan setiap elemen permainan secara spesifik dan terukur.');
        $programCards    = $settings->get('page_ahp_training.program_cards', json_encode([
            ['title' => 'Tahunan',  'desc' => 'Perencanaan jangka panjang satu tahun penuh mencakup fase preseason, kompetisi, dan pemulihan.', 'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>'],
            ['title' => 'Bulanan',  'desc' => 'Siklus latihan bulanan dengan variasi intensitas untuk mencegah plateau dan overtraining.',     'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>'],
            ['title' => 'Mingguan', 'desc' => 'Penyesuaian beban latihan per minggu berdasarkan respons tubuh dan jadwal pertandingan.',        'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>'],
            ['title' => 'Harian',   'desc' => 'Sesi latihan harian yang terstruktur dengan warm-up, core session, dan cool-down.',               'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>'],
        ]));

        // Section 3: Volume & Intensitas
        $volumeTitle = $settings->get('page_ahp_training.volume_title', 'Volume dan Intensitas Latihan');
        $volumeDesc  = $settings->get('page_ahp_training.volume_desc', 'Latihan dirancang dengan sistem periodisasi yang ketat — memadukan volume dan intensitas secara progresif untuk hasil maksimal.');
        $volumeImage = $settings->get('page_ahp_training.volume_image', '');
        $volumeStats = $settings->get('page_ahp_training.volume_stats', json_encode([
            ['value' => '8',    'label' => 'Minggu Program'],
            ['value' => '5x',   'label' => 'Sesi Per Minggu'],
            ['value' => '90m',  'label' => 'Durasi Per Sesi'],
        ]));

        // Section 4: Evaluation Training Load
        $evalTitle  = $settings->get('page_ahp_training.eval_title', 'Evaluation Training Load');
        $evalDesc   = $settings->get('page_ahp_training.eval_desc', 'Setiap sesi dipantau dengan ketat untuk memastikan beban latihan optimal sesuai kapasitas masing-masing pemain.');
        $evalImage  = $settings->get('page_ahp_training.eval_image', '');
        $evalPoints = $settings->get('page_ahp_training.eval_points', json_encode(['Monitoring RPE (Rate of Perceived Exertion)', 'Analisis Heart Rate Zone', 'Evaluasi Kualitas Gerak', 'Data Tracking Per Sesi']));

        // Section 5: Post Test
        $postTestTitle = $settings->get('page_ahp_training.posttest_title', 'Post Test');
        $postTestDesc  = $settings->get('page_ahp_training.posttest_desc', 'Setelah menyelesaikan program, pemain mengikuti Post Test untuk mengukur peningkatan secara objektif dan terukur dibandingkan baseline awal.');
        $postTestImage = $settings->get('page_ahp_training.posttest_image', '');
        $postTestItems = $settings->get('page_ahp_training.posttest_items', json_encode(['Re-tes seluruh parameter Pre Test', 'Perbandingan data Pre vs Post', 'Analisis peningkatan performa', 'Rekomendasi program lanjutan']));

        // Section 6: Report Individual
        $reportTitle = $settings->get('page_ahp_training.report_title', 'Report Individual Players');
        $reportDesc  = $settings->get('page_ahp_training.report_desc', 'Seluruh data dirangkum menjadi laporan individu komprehensif yang dapat diakses pemain menggunakan nomor registrasi.');
        $reportImage = $settings->get('page_ahp_training.report_image', '');

        return view('pages.ahp-training', compact(
            'heroTitle', 'heroSubtitle', 'aboutText', 'aboutImage',
            'introHeadlineBold', 'introHeadlineThin', 'introEyebrowLabel', 'introBadgeText',
            'stat1Value', 'stat1Label', 'stat2Value', 'stat2Label', 'stat3Value', 'stat3Label',
            'preTestTitle', 'preTestDesc', 'preTestImage', 'preTestItems',
            'programTitle', 'programSubtitle', 'programDesc', 'programCards',
            'volumeTitle', 'volumeDesc', 'volumeImage', 'volumeStats',
            'evalTitle', 'evalDesc', 'evalImage', 'evalPoints',
            'postTestTitle', 'postTestDesc', 'postTestImage', 'postTestItems',
            'reportTitle', 'reportDesc', 'reportImage'
        ));
    }

    public function search(Request $request)
    {
        return view('pages.ahp.search');
    }

    public function resolve(Request $request)
    {
        $request->validate(['no_reg' => 'required|string|max:20']);
        $noReg = strtoupper(trim($request->input('no_reg')));

        $player = AhpPlayer::where('no_reg', $noReg)->first();

        if (!$player) {
            return redirect()->route('ahp.search')->with('error', "Pemain dengan kode \"$noReg\" tidak ditemukan.");
        }

        $slug = strtolower($player->no_reg . '-' . \Illuminate\Support\Str::slug($player->name));
        return redirect()->route('ahp.player', ['slug' => $slug]);
    }

    public function playersList()
    {
        $players = AhpPlayer::where('is_active', true)
            // Sort by raw numeric value extracted from no_reg using raw SQL or collection sort.
            // Since no_reg format is 'AHP-01', we can order by it as string if zero-padded,
            // or simply order by DB raw length then string, or fetch and sort in collection.
            ->orderByRaw('LENGTH(no_reg) ASC')
            ->orderBy('no_reg', 'asc')
            ->get();

        // Load latest result for each player for comparison
        $playersWithStats = $players->map(function ($player) {
            $latest = $player->results()->with('session')->latest('id')->first();
            return [
                'player' => $player,
                'latest' => $latest,
            ];
        });

        $meta = [
            'title'       => 'Daftar Pemain AHP Training — Coach Agam',
            'description' => 'Direktori lengkap pemain sepakbola yang tergabung dalam program AHP Training Coach Agam. Temukan profil lengkap atlet berdasarkan posisi bermain (Goalkeeper, Defender, Midfield, Attacker).',
            'keywords'    => 'ahp training, profil pemain, atlet sepakbola, skuad, daftar pemain, coach agam',
            'og_image'    => asset('storage/default-player.png'),
            'url'         => route('ahp.players'),
        ];

        // Schema.org for CollectionPage/ItemList
        $itemListElement = $players->map(function ($player, $index) {
            $slug = strtolower($player->no_reg . '-' . \Illuminate\Support\Str::slug($player->name));
            return [
                '@type'    => 'ListItem',
                'position' => $index + 1,
                'url'      => route('ahp.player', $slug),
                'name'     => $player->name,
                'image'    => $player->photo_url,
            ];
        })->toArray();

        $schema = [
            '@context'   => 'https://schema.org',
            '@type'      => 'CollectionPage',
            'name'       => $meta['title'],
            'description'=> $meta['description'],
            'url'        => $meta['url'],
            'mainEntity' => [
                '@type'           => 'ItemList',
                'itemListElement' => $itemListElement
            ]
        ];

        return view('pages.ahp.players-list', compact('players', 'playersWithStats', 'meta', 'schema'));
    }

    public function player($slug)
    {
        $parts = explode('-', $slug);
        if (count($parts) >= 2) {
            $noReg = strtoupper($parts[0] . '-' . $parts[1]);
            $player = AhpPlayer::where('no_reg', $noReg)->first();
        } else {
            $player = null;
        }

        if (!$player) {
            return redirect()->route('ahp.search')->with('error', "Pemain tidak ditemukan.");
        }

        $results = $player->results()->with('session')->orderBy('session_id')->get();

        // Build comparison data (first & last session)
        $preResult  = $results->first();
        $postResult = $results->last();

        // Radar chart normalized scores
        $radarMetrics = ['BMI', 'MoCA', 'Passing', 'Scanning', 'Acceleration', 'Speed', 'Yo-Yo'];
        $preRadar  = $preResult  ? $this->buildRadar($preResult)  : array_fill(0, 7, 0);
        $postRadar = $postResult ? $this->buildRadar($postResult) : array_fill(0, 7, 0);

        // Line chart per metric over all sessions
        $sessionLabels = $results->map(fn($r) => $r->session->label)->values()->toArray();

        $lineData = [
            'bmi'                  => $results->pluck('bmi')->toArray(),
            'moca_score'           => $results->pluck('moca_score')->toArray(),
            'passing_sukses'       => $results->pluck('passing_sukses')->toArray(),
            'initial_acceleration' => $results->pluck('initial_acceleration')->toArray(),
            'yo_yo_distance'       => $results->pluck('yo_yo_distance')->toArray(),
        ];

        // 1. Build Meta Tags
        $meta = [
            'title'       => 'Profil & Statistik ' . $player->name . ' - AHP Training',
            'description' => 'Lihat profil lengkap, statistik fisik, teknis, dan evaluasi performa dari ' . $player->name . ' di AHP Training Program.',
            'keywords'    => strtolower($player->name) . ', ahp training, profil atlet, sepakbola, statistik pemain, ' . strtolower($player->position ?? 'pemain sepakbola'),
            'og_image'    => $player->og_image_url ?? $player->photo_url,
            'url'         => route('ahp.player', $slug),
        ];

        // 2. Build Schema.org (JSON-LD)
        $schema = [
            '@context' => 'https://schema.org',
            '@type'    => 'ProfilePage',
            'mainEntity' => [
                '@type'       => 'Person',
                'name'        => $player->name,
                'identifier'  => $player->no_reg,
                'jobTitle'    => $player->position ?? 'Pemain Sepakbola',
                'description' => 'Atlet AHP Training Program',
                'image'       => $player->photo_url,
                'url'         => route('ahp.player', $slug),
            ]
        ];

        return view('pages.ahp.player', compact(
            'player', 'results', 'preResult', 'postResult',
            'radarMetrics', 'preRadar', 'postRadar',
            'sessionLabels', 'lineData', 'meta', 'schema'
        ));
    }

    public function downloadPdf($slug, Request $request)
    {
        $parts = explode('-', $slug);
        if (count($parts) >= 2) {
            $noReg = strtoupper($parts[0] . '-' . $parts[1]);
            $player = AhpPlayer::where('no_reg', $noReg)->firstOrFail();
        } else {
            abort(404);
        }

        // If a specific session is requested, load only that session's result
        $sessionId = $request->query('session');

        if ($sessionId) {
            $sessionResult = AhpTestResult::where('player_id', $player->id)
                ->where('session_id', $sessionId)
                ->with('session')
                ->first();

            if (!$sessionResult) abort(404);

            $session    = $sessionResult->session;
            $results    = collect([$sessionResult]);
            $preResult  = $sessionResult;
            $postResult = null;
        } else {
            // Default: all sessions, compare first vs last
            $results    = $player->results()->with('session')->orderBy('session_id')->get();
            $preResult  = $results->first();
            $postResult = $results->count() > 1 ? $results->last() : null;
            $session    = null;
        }

        // Generate QuickChart URL for Bar Chart
        $sessionLabels = $results->map(fn($r) => $r->session->label)->values()->toArray();
        $chartConfig = [
            'type' => 'bar',
            'data' => [
                'labels' => $sessionLabels,
                'datasets' => [
                    ['label' => 'BMI', 'data' => $results->pluck('bmi')->toArray(), 'backgroundColor' => '#333333'],
                    ['label' => 'MoCA Score', 'data' => $results->pluck('moca_score')->toArray(), 'backgroundColor' => '#777777'],
                    ['label' => 'Passing Sukses', 'data' => $results->pluck('passing_sukses')->toArray(), 'backgroundColor' => '#DDDDDD'],
                ]
            ],
            'options' => [
                'plugins' => [
                    'legend' => ['labels' => ['color' => '#333333']]
                ]
            ]
        ];
        $chartUrl = 'https://quickchart.io/chart?v=3&w=700&h=300&bkg=white&c=' . urlencode(json_encode($chartConfig));

        $pdf = Pdf::loadView('pages.ahp.pdf', compact('player', 'results', 'preResult', 'postResult', 'session', 'chartUrl'));
        $pdf->setPaper('A4');

        $filename = $session
            ? 'laporan-' . $player->no_reg . '-' . \Illuminate\Support\Str::slug($session->label) . '.pdf'
            : 'laporan-' . $player->no_reg . '.pdf';

        return $pdf->download($filename);
    }

    public function verifyCertificate(Request $request)
    {
        $request->validate(['certificate_code' => 'required|string|max:100']);
        $code = strtoupper(trim($request->input('certificate_code')));
        return back()->with('verify_error', "Kode sertifikat \"$code\" tidak ditemukan.");
    }

    private function buildRadar($result): array
    {
        return [
            AhpRatingHelper::normalize('bmi',                  $result->bmi),
            AhpRatingHelper::normalize('moca_score',           $result->moca_score),
            AhpRatingHelper::normalize('passing_sukses',       $result->passing_sukses),
            AhpRatingHelper::normalize('scanning_per_10sec',   $result->scanning_per_10sec),
            AhpRatingHelper::normalize('initial_acceleration', $result->initial_acceleration),
            AhpRatingHelper::normalize('maximal_speed',        $result->maximal_speed),
            AhpRatingHelper::normalize('yo_yo_level',          $result->yo_yo_level),
        ];
    }
}
