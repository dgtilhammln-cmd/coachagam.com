<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\ImageProcessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::where('group', 'page_gallery')->get()->keyBy('key');
        return view('admin.pages.gallery', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'headline' => 'nullable|string|max:255',
            'subheadline' => 'nullable|string|max:255',
            'breadcrumb_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $settings = [
            'page_gallery.meta_title' => $request->meta_title,
            'page_gallery.meta_description' => $request->meta_description,
            'page_gallery.headline' => $request->headline,
            'page_gallery.subheadline' => $request->subheadline,
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value, 'group' => 'page_gallery', 'type' => 'text']
            );
        }

        if ($request->hasFile('breadcrumb_image')) {
            $imagePath = ImageProcessor::processAndStore($request->file('breadcrumb_image'), 'pages');
            SiteSetting::updateOrCreate(
                ['key' => 'page_gallery.breadcrumb_image'],
                ['value' => $imagePath, 'group' => 'page_gallery', 'type' => 'image']
            );
        }

        return redirect()->back()->with('success', 'Pengaturan galeri berhasil diperbarui.');
    }

    public function addItem(Request $request)
    {
        $request->validate([
            'image'   => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'caption' => 'nullable|string|max:255',
            'alt'     => 'required|string|max:255',
        ]);

        $setting = SiteSetting::firstOrCreate(
            ['key' => 'page_gallery.items'],
            ['group' => 'page_gallery', 'type' => 'json', 'value' => '[]']
        );

        $items = json_decode($setting->value, true) ?? [];

        $imagePath = ImageProcessor::processAndStore($request->file('image'), 'gallery');

        $items[] = [
            'image'   => $imagePath,
            'alt'     => $request->alt,
            'caption' => $request->caption,
        ];

        $setting->update(['value' => json_encode($items)]);

        return redirect()->back()->with('success', 'Gambar galeri berhasil ditambahkan.');
    }

    public function deleteItem($index)
    {
        $setting = SiteSetting::where('key', 'page_gallery.items')->first();
        if (!$setting) return redirect()->back()->with('error', 'Data tidak ditemukan.');

        $items = json_decode($setting->value, true) ?? [];

        if (isset($items[$index])) {
            $imagePath = $items[$index]['image'];
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            array_splice($items, $index, 1);
            $setting->update(['value' => json_encode($items)]);
        }

        return redirect()->back()->with('success', 'Gambar galeri berhasil dihapus.');
    }

    public function updateItem(Request $request, $index)
    {
        $request->validate([
            'alt'     => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:255',
        ]);

        $setting = SiteSetting::where('key', 'page_gallery.items')->first();
        if (!$setting) return redirect()->back()->with('error', 'Data tidak ditemukan.');

        $items = json_decode($setting->value, true) ?? [];

        if (isset($items[$index])) {
            $items[$index]['alt']     = $request->alt;
            $items[$index]['caption'] = $request->caption;
            $setting->update(['value' => json_encode($items)]);
        }

        return redirect()->back()->with('success', 'Foto berhasil diperbarui.');
    }
}
