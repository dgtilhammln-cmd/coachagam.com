<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\ImageProcessor;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    /** Tampilkan form pengaturan homepage */
    public function index()
    {
        // Ambil semua setting group homepage + contact + seo + general
        $settings = SiteSetting::whereIn('group', ['homepage', 'contact', 'seo', 'general'])
            ->orderBy('group')
            ->orderBy('id')
            ->get()
            ->keyBy('key');

        $heroSlides = json_decode($settings['homepage.hero_slides']->value ?? '[]', true);
        return view('admin.settings.homepage', compact('settings', 'heroSlides'));
    }

    /** Simpan pengaturan homepage */
    public function update(Request $request)
    {
        $request->validate([
            'slides' => 'nullable|array',
        ]);

        // Existing slides from DB
        $existingSlides = json_decode(SiteSetting::where('key', 'homepage.hero_slides')->value('value') ?? '[]', true);

        // Process slide file uploads and data
        $slides = [];
        $inputSlides = $request->input('slides', []);
        $fileSlides = $request->file('slides', []);

        foreach ($inputSlides as $index => $slideData) {
            if (empty($slideData['headline'])) continue; // Skip empty
            
            // Retain old images if not overwritten
            $slideData['image']           = $existingSlides[$index]['image'] ?? null;
            $slideData['background']      = $existingSlides[$index]['background'] ?? null;
            $slideData['trusted_image_1'] = $existingSlides[$index]['trusted_image_1'] ?? null;
            $slideData['trusted_image_2'] = $existingSlides[$index]['trusted_image_2'] ?? null;
            $slideData['trusted_image_3'] = $existingSlides[$index]['trusted_image_3'] ?? null;

            // Handle new file uploads — use hasFile with dot notation
            if ($request->hasFile("slides.{$index}.image")) {
                $slideData['image'] = ImageProcessor::processAndStore($request->file("slides.{$index}.image"), 'slides');
            }
            if ($request->hasFile("slides.{$index}.background")) {
                $slideData['background'] = ImageProcessor::processAndStore($request->file("slides.{$index}.background"), 'slides');
            }
            if ($request->hasFile("slides.{$index}.trusted_image_1")) {
                $slideData['trusted_image_1'] = ImageProcessor::processAndStore($request->file("slides.{$index}.trusted_image_1"), 'slides');
            }
            if ($request->hasFile("slides.{$index}.trusted_image_2")) {
                $slideData['trusted_image_2'] = ImageProcessor::processAndStore($request->file("slides.{$index}.trusted_image_2"), 'slides');
            }
            if ($request->hasFile("slides.{$index}.trusted_image_3")) {
                $slideData['trusted_image_3'] = ImageProcessor::processAndStore($request->file("slides.{$index}.trusted_image_3"), 'slides');
            }

            $slides[] = $slideData;
        }

        // Save up to 10 slides
        $slides = array_slice($slides, 0, 10);
        
        // Handle removing images/backgrounds based on hidden checkboxes
        $finalSlides = [];
        foreach ($slides as $i => $s) {
            if (isset($s['remove_image']) && $s['remove_image'] == '1') {
                $s['image'] = null;
            }
            if (isset($s['remove_background']) && $s['remove_background'] == '1') {
                $s['background'] = null;
            }
            if (isset($s['remove_trusted_image_1']) && $s['remove_trusted_image_1'] == '1') {
                $s['trusted_image_1'] = null;
            }
            if (isset($s['remove_trusted_image_2']) && $s['remove_trusted_image_2'] == '1') {
                $s['trusted_image_2'] = null;
            }
            if (isset($s['remove_trusted_image_3']) && $s['remove_trusted_image_3'] == '1') {
                $s['trusted_image_3'] = null;
            }
            // Cleanup hidden fields
            unset($s['remove_image'], $s['remove_background'], $s['remove_trusted_image_1'], $s['remove_trusted_image_2'], $s['remove_trusted_image_3']);
            $finalSlides[] = $s;
        }

        SiteSetting::set('homepage.hero_slides', json_encode($finalSlides, JSON_UNESCAPED_UNICODE));

        // Save general text fields (about, cta text, seo)
        $textFields = [
            'homepage.hero_shape_color1', 'homepage.hero_shape_color2', 'homepage.hero_star_color',
            'homepage.about_tagline', 'homepage.about_bio_1', 'homepage.about_bio_2',
            'homepage.about_years_exp', 'homepage.about_athletes_count', 'homepage.about_certifications',
            'homepage.cta_heading', 'homepage.cta_description',
            'seo.site_title', 'seo.site_description',
            'contact.whatsapp_number', 'contact.whatsapp_message', 'contact.email', 'contact.location',
        ];
        foreach ($textFields as $field) {
            $inputKey = str_replace('.', '_', $field); // blade uses underscores for nested
            // Support both dot and original name
            $val = $request->input($field) ?? $request->input($inputKey);
            if ($val !== null) {
                SiteSetting::set($field, $val);
            }
        }
        // Also support flat input names (name="homepage.about_tagline" works directly)
        foreach ($request->except(['_token', 'slides', 'cta_bg_image', 'remove_cta_bg_image']) as $key => $val) {
            if (str_contains($key, '.') && is_string($val)) {
                SiteSetting::set($key, $val);
            }
        }

        // Handle CTA background image
        if ($request->hasFile('cta_bg_image')) {
            $ctaBg = ImageProcessor::processAndStore($request->file('cta_bg_image'), 'cta');
            SiteSetting::set('homepage.cta_bg_image', $ctaBg);
        } elseif ($request->input('remove_cta_bg_image') == '1') {
            SiteSetting::set('homepage.cta_bg_image', null);
        }

        return redirect()->route('admin.settings.homepage')
            ->with('success', '✅ Pengaturan homepage berhasil disimpan!');
    }

    public function addSlide()
    {
        $slides = json_decode(SiteSetting::where('key', 'homepage.hero_slides')->value('value') ?? '[]', true);

        if (count($slides) >= 10) {
            return back()->withErrors(['error' => 'Maksimal 10 slide.']);
        }

        $slides[] = [
            'headline'        => 'Slide Baru<br><b>Edit Di Sini</b>',
            'subheadline'     => 'Deskripsi slide baru.',
            'cta_text'        => 'Lihat Detail',
            'cta_link'        => '/',
            'image'           => null,
            'background'      => null,
            'trusted_text'    => '',
            'trusted_image_1' => null,
            'trusted_image_2' => null,
            'trusted_image_3' => null,
        ];

        SiteSetting::set('homepage.hero_slides', json_encode($slides, JSON_UNESCAPED_UNICODE));

        return redirect()->route('admin.settings.homepage')->with('success', '✅ Slide baru ditambahkan!');
    }

    public function deleteSlide($index)
    {
        $slides = json_decode(SiteSetting::where('key', 'homepage.hero_slides')->value('value') ?? '[]', true);

        if (isset($slides[$index])) {
            array_splice($slides, $index, 1);
            SiteSetting::set('homepage.hero_slides', json_encode(array_values($slides), JSON_UNESCAPED_UNICODE));
        }

        return redirect()->route('admin.settings.homepage')->with('success', '🗑️ Slide dihapus.');
    }
}
