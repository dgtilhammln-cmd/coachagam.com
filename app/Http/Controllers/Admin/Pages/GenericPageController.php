<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\ImageProcessor;
use Illuminate\Http\Request;

class GenericPageController extends Controller
{
    private $allowedPages = [
        'modul'  => 'Modul Kepelatihan',
        'blog'   => 'Blog / Artikel',
        'kontak' => 'Kontak'
    ];

    public function index($page)
    {
        if (!array_key_exists($page, $this->allowedPages)) abort(404);

        $pageTitle = $this->allowedPages[$page];
        $settings = SiteSetting::where('group', 'page_' . $page)->get()->keyBy('key');

        return view('admin.pages.generic', compact('page', 'pageTitle', 'settings'));
    }

    public function update(Request $request, $page)
    {
        if (!array_key_exists($page, $this->allowedPages)) abort(404);

        $request->validate([
            'breadcrumb_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'headline' => 'nullable|string|max:255',
            'subheadline' => 'nullable|string|max:255',
        ]);

        $group = 'page_' . $page;

        $textKeys = [
            'meta_title',
            'meta_description',
            'headline',
            'subheadline',
        ];

        foreach ($textKeys as $key) {
            SiteSetting::updateOrCreate(
                ['key' => $group . '.' . $key],
                ['value' => $request->input($key), 'group' => $group, 'type' => 'text']
            );
        }

        if ($request->hasFile('breadcrumb_image')) {
            $imagePath = ImageProcessor::processAndStore($request->file('breadcrumb_image'), 'pages');
            SiteSetting::updateOrCreate(
                ['key' => $group . '.breadcrumb_image'],
                ['value' => $imagePath, 'group' => $group, 'type' => 'image']
            );
        }

        return redirect()->back()->with('success', 'Pengaturan halaman ' . $this->allowedPages[$page] . ' berhasil diperbarui.');
    }
}
