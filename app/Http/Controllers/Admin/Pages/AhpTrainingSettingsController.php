<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AhpTrainingSettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::where('group', 'page_ahp_training')->pluck('value', 'key');

        $heroTitle    = $settings->get('page_ahp_training.hero_title', 'AHP Training');
        $heroSubtitle = $settings->get('page_ahp_training.hero_subtitle', 'Program Pelatihan Sepakbola Profesional');
        $aboutText    = $settings->get('page_ahp_training.about_text', '');
        $aboutImage   = $settings->get('page_ahp_training.about_image', '');
        $playerBg     = $settings->get('page_ahp_training.player_bg', '');

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
        $pretestTitle    = $settings->get('page_ahp_training.pretest_title', 'Pre Test');
        $pretestDesc     = $settings->get('page_ahp_training.pretest_desc', '');
        $pretestImage    = $settings->get('page_ahp_training.pretest_image', '');
        $pretestItems    = implode("\n", json_decode($settings->get('page_ahp_training.pretest_items', '[]'), true) ?: []);

        // Section 2: Program Latihan
        $programTitle    = $settings->get('page_ahp_training.program_title', 'Program Latihan');
        $programSubtitle = $settings->get('page_ahp_training.program_subtitle', 'Tahunan · Bulanan · Mingguan · Harian');
        $programDesc     = $settings->get('page_ahp_training.program_desc', '');
        $programCards    = json_decode($settings->get('page_ahp_training.program_cards', '[]'), true) ?: [
            ['title' => 'Tahunan',  'desc' => '', 'icon' => ''],
            ['title' => 'Bulanan',  'desc' => '', 'icon' => ''],
            ['title' => 'Mingguan', 'desc' => '', 'icon' => ''],
            ['title' => 'Harian',   'desc' => '', 'icon' => ''],
        ];

        // Section 3: Volume & Intensitas
        $volumeTitle = $settings->get('page_ahp_training.volume_title', 'Volume dan Intensitas Latihan');
        $volumeDesc  = $settings->get('page_ahp_training.volume_desc', '');
        $volumeImage = $settings->get('page_ahp_training.volume_image', '');
        $volumeStats = json_decode($settings->get('page_ahp_training.volume_stats', '[]'), true) ?: [
            ['value' => '8',   'label' => 'Minggu Program'],
            ['value' => '5x',  'label' => 'Sesi Per Minggu'],
            ['value' => '90m', 'label' => 'Durasi Per Sesi'],
        ];

        // Section 4: Evaluation
        $evalTitle  = $settings->get('page_ahp_training.eval_title', 'Evaluation Training Load');
        $evalDesc   = $settings->get('page_ahp_training.eval_desc', '');
        $evalImage  = $settings->get('page_ahp_training.eval_image', '');
        $evalPoints = implode("\n", json_decode($settings->get('page_ahp_training.eval_points', '[]'), true) ?: []);

        // Section 5: Post Test
        $posttestTitle = $settings->get('page_ahp_training.posttest_title', 'Post Test');
        $posttestDesc  = $settings->get('page_ahp_training.posttest_desc', '');
        $posttestImage = $settings->get('page_ahp_training.posttest_image', '');
        $posttestItems = implode("\n", json_decode($settings->get('page_ahp_training.posttest_items', '[]'), true) ?: []);

        // Section 6: Report
        $reportTitle = $settings->get('page_ahp_training.report_title', 'Report Individual Players');
        $reportDesc  = $settings->get('page_ahp_training.report_desc', '');
        $reportImage = $settings->get('page_ahp_training.report_image', '');

        return view('admin.pages.ahp-training', compact(
            'heroTitle', 'heroSubtitle', 'aboutText', 'aboutImage', 'playerBg',
            'introHeadlineBold', 'introHeadlineThin', 'introEyebrowLabel', 'introBadgeText',
            'stat1Value', 'stat1Label', 'stat2Value', 'stat2Label', 'stat3Value', 'stat3Label',
            'pretestTitle', 'pretestDesc', 'pretestImage', 'pretestItems',
            'programTitle', 'programSubtitle', 'programDesc', 'programCards',
            'volumeTitle', 'volumeDesc', 'volumeImage', 'volumeStats',
            'evalTitle', 'evalDesc', 'evalImage', 'evalPoints',
            'posttestTitle', 'posttestDesc', 'posttestImage', 'posttestItems',
            'reportTitle', 'reportDesc', 'reportImage'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_title'     => 'required|string|max:255',
            'hero_subtitle'  => 'nullable|string|max:255',
            'about_text'     => 'nullable|string',
            'about_image'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'player_bg'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'pretest_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'volume_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'eval_image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'posttest_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'report_image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

        // ── Intro ──────────────────────────────────────────────────────────
        $this->saveSetting('page_ahp_training.hero_title',          $request->input('hero_title'));
        $this->saveSetting('page_ahp_training.hero_subtitle',       $request->input('hero_subtitle', ''));
        $this->saveSetting('page_ahp_training.about_text',          $request->input('about_text', ''));
        $this->saveSetting('page_ahp_training.intro_headline_bold', $request->input('intro_headline_bold', 'Agility. Heading.'));
        $this->saveSetting('page_ahp_training.intro_headline_thin', $request->input('intro_headline_thin', 'Training Terstruktur'));
        $this->saveSetting('page_ahp_training.intro_eyebrow_label', $request->input('intro_eyebrow_label', 'Overview Program'));
        $this->saveSetting('page_ahp_training.intro_badge_text',    $request->input('intro_badge_text', "Program\nEksklusif"));

        // ── Stats ──────────────────────────────────────────────────────────
        $this->saveSetting('page_ahp_training.stat1_value', $request->input('stat1_value', '6'));
        $this->saveSetting('page_ahp_training.stat1_label', $request->input('stat1_label', 'Tahapan Terstruktur'));
        $this->saveSetting('page_ahp_training.stat2_value', $request->input('stat2_value', '100%'));
        $this->saveSetting('page_ahp_training.stat2_label', $request->input('stat2_label', 'Berbasis Data'));
        $this->saveSetting('page_ahp_training.stat3_value', $request->input('stat3_value', 'AFC'));
        $this->saveSetting('page_ahp_training.stat3_label', $request->input('stat3_label', 'Lisensi Pelatih'));

        // ── Images ─────────────────────────────────────────────────────────
        $this->handleImageUpload($request, 'about_image',    'page_ahp_training.about_image');
        $this->handleImageUpload($request, 'player_bg',      'page_ahp_training.player_bg');
        $this->handleImageUpload($request, 'pretest_image',  'page_ahp_training.pretest_image');
        $this->handleImageUpload($request, 'volume_image',   'page_ahp_training.volume_image');
        $this->handleImageUpload($request, 'eval_image',     'page_ahp_training.eval_image');
        $this->handleImageUpload($request, 'posttest_image', 'page_ahp_training.posttest_image');
        $this->handleImageUpload($request, 'report_image',   'page_ahp_training.report_image');

        // ── Section 1: Pre Test ────────────────────────────────────────────
        $this->saveSetting('page_ahp_training.pretest_title', $request->input('pretest_title', ''));
        $this->saveSetting('page_ahp_training.pretest_desc',  $request->input('pretest_desc', ''));
        $pretestItems = array_filter(array_map('trim', explode("\n", $request->input('pretest_items', ''))));
        $this->saveSetting('page_ahp_training.pretest_items', json_encode(array_values($pretestItems)));

        // ── Section 2: Program Latihan ─────────────────────────────────────
        $this->saveSetting('page_ahp_training.program_title',    $request->input('program_title', 'Program Latihan'));
        $this->saveSetting('page_ahp_training.program_subtitle', $request->input('program_subtitle', 'Tahunan · Bulanan · Mingguan · Harian'));
        $this->saveSetting('page_ahp_training.program_desc',     $request->input('program_desc', ''));
        $this->saveSetting('page_ahp_training.program_cards',    json_encode(array_values($request->input('program_cards', []))));

        // ── Section 3: Volume & Intensitas ─────────────────────────────────
        $this->saveSetting('page_ahp_training.volume_title', $request->input('volume_title', ''));
        $this->saveSetting('page_ahp_training.volume_desc',  $request->input('volume_desc', ''));
        $this->saveSetting('page_ahp_training.volume_stats', json_encode(array_values($request->input('volume_stats', []))));

        // ── Section 4: Evaluation ──────────────────────────────────────────
        $this->saveSetting('page_ahp_training.eval_title', $request->input('eval_title', ''));
        $this->saveSetting('page_ahp_training.eval_desc',  $request->input('eval_desc', ''));
        $evalPoints = array_filter(array_map('trim', explode("\n", $request->input('eval_points', ''))));
        $this->saveSetting('page_ahp_training.eval_points', json_encode(array_values($evalPoints)));

        // ── Section 5: Post Test ───────────────────────────────────────────
        $this->saveSetting('page_ahp_training.posttest_title', $request->input('posttest_title', ''));
        $this->saveSetting('page_ahp_training.posttest_desc',  $request->input('posttest_desc', ''));
        $posttestItems = array_filter(array_map('trim', explode("\n", $request->input('posttest_items', ''))));
        $this->saveSetting('page_ahp_training.posttest_items', json_encode(array_values($posttestItems)));

        // ── Section 6: Report ──────────────────────────────────────────────
        $this->saveSetting('page_ahp_training.report_title', $request->input('report_title', ''));
        $this->saveSetting('page_ahp_training.report_desc',  $request->input('report_desc', ''));

        return redirect()->route('admin.pages.ahp-training')->with('success', 'Pengaturan AHP Training berhasil disimpan!');
    }

    private function handleImageUpload(Request $request, string $inputName, string $settingKey): void
    {
        if ($request->hasFile($inputName)) {
            $path = $request->file($inputName)->store('uploads/ahp', 'public');
            $this->saveSetting($settingKey, $path);
        } elseif ($request->input('remove_' . $inputName) == '1') {
            $oldImage = SiteSetting::where('key', $settingKey)->value('value');
            if ($oldImage) Storage::disk('public')->delete($oldImage);
            $this->saveSetting($settingKey, '');
        }
    }

    private function saveSetting(string $key, ?string $value): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => (string) $value, 'group' => 'page_ahp_training']
        );
    }
}
