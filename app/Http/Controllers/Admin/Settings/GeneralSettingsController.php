<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\ImageProcessor;
use Illuminate\Http\Request;

class GeneralSettingsController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::whereIn('group', ['general', 'seo', 'integrations'])
            ->get()
            ->keyBy('key');

        return view('admin.settings.general', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo'              => 'nullable|image|max:2048',
            'favicon'           => 'nullable|image|max:512',
            'og_image'          => 'nullable|image|max:4096',
            'cta_image'         => 'nullable|image|max:4096',
            'breadcrumb_image'  => 'nullable|image|max:4096',
        ]);

        // File uploads
        if ($request->hasFile('logo')) {
            $path = ImageProcessor::processAndStore($request->file('logo'), 'settings');
            SiteSetting::set('general.logo', $path);
        }

        if ($request->hasFile('favicon')) {
            $path = ImageProcessor::processAndStore($request->file('favicon'), 'settings', true);
            SiteSetting::set('general.favicon', $path);
        }

        if ($request->hasFile('og_image')) {
            $path = ImageProcessor::processAndStore($request->file('og_image'), 'settings');
            SiteSetting::set('seo.og_image', $path);
        }

        if ($request->hasFile('cta_image')) {
            $path = ImageProcessor::processAndStore($request->file('cta_image'), 'settings');
            SiteSetting::set('general.cta_image', $path);
        }

        if ($request->hasFile('breadcrumb_image')) {
            $path = ImageProcessor::processAndStore($request->file('breadcrumb_image'), 'settings');
            SiteSetting::set('general.breadcrumb_image', $path);
        }

        // Text / code settings
        // CATATAN: PHP mengubah titik (.) dalam name="key.subkey" menjadi underscore (key_subkey)
        // Solusi: baca dari raw POST input menggunakan str_replace
        $raw = $request->all();

        $textKeyMap = [
            'seo_meta_title'         => 'seo.meta_title',
            'seo_meta_description'   => 'seo.meta_description',
            'seo_meta_keywords'      => 'seo.meta_keywords',
            'general_whatsapp'       => 'general.whatsapp',
            'general_email'          => 'general.email',
            'general_address'        => 'general.address',
            'integrations_gsc_tag'   => 'integrations.gsc_tag',
            'integrations_gtm_head'  => 'integrations.gtm_head',
            'integrations_gtm_body'  => 'integrations.gtm_body',
        ];

        foreach ($textKeyMap as $postKey => $settingKey) {
            if (array_key_exists($postKey, $raw) && $raw[$postKey] !== null) {
                SiteSetting::set($settingKey, $raw[$postKey]);
            }
        }

        return redirect()->route('admin.settings.general')
            ->with('success', 'Pengaturan General berhasil disimpan!');
    }
}
