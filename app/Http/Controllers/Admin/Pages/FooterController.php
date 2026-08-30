<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::where('group', 'page_footer')->pluck('value', 'key');

        $navLinks     = json_decode($settings->get('page_footer.nav_links', '[]'), true) ?: [
            ['label' => 'Beranda',           'href' => '/'],
            ['label' => 'Tentang',           'href' => '/profil-coach-agam'],
            ['label' => 'Galeri',            'href' => '/gallery'],
            ['label' => 'Modul Kepelatihan', 'href' => '/modul-kepelatihan'],
            ['label' => 'Blog',              'href' => '/blog'],
            ['label' => 'Kontak',            'href' => '/kontak'],
        ];
        $serviceLinks = json_decode($settings->get('page_footer.service_links', '[]'), true) ?: [
            ['label' => 'Pelatihan Privat', 'href' => '#'],
            ['label' => 'Pelatihan Tim',    'href' => '#'],
            ['label' => 'Analisis Taktik',  'href' => '#'],
            ['label' => 'Pemateri Seminar', 'href' => '#'],
        ];
        $copyrightText = $settings->get('page_footer.copyright', '&copy; ' . date('Y') . ' Coach Agam. All rights reserved.');
        $privacyLink   = $settings->get('page_footer.privacy_link', '#');
        $termsLink     = $settings->get('page_footer.terms_link', '#');

        return view('admin.pages.footer', compact(
            'navLinks', 'serviceLinks', 'copyrightText', 'privacyLink', 'termsLink'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'nav_links'        => 'nullable|array',
            'nav_links.*.label' => 'required|string|max:100',
            'nav_links.*.href'  => 'required|string|max:500',
            'service_links'          => 'nullable|array',
            'service_links.*.label'  => 'required|string|max:100',
            'service_links.*.href'   => 'required|string|max:500',
            'copyright_text'   => 'nullable|string|max:500',
            'privacy_link'     => 'nullable|string|max:500',
            'terms_link'       => 'nullable|string|max:500',
        ]);

        $this->saveSetting('page_footer.nav_links', json_encode($request->input('nav_links', [])));
        $this->saveSetting('page_footer.service_links', json_encode($request->input('service_links', [])));
        $this->saveSetting('page_footer.copyright', $request->input('copyright_text', '&copy; ' . date('Y') . ' Coach Agam. All rights reserved.'));
        $this->saveSetting('page_footer.privacy_link', $request->input('privacy_link', '#'));
        $this->saveSetting('page_footer.terms_link', $request->input('terms_link', '#'));

        return redirect()->route('admin.pages.footer')->with('success', 'Pengaturan Footer berhasil disimpan!');
    }

    private function saveSetting(string $key, string $value): void
    {
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => 'page_footer']
        );
    }
}
