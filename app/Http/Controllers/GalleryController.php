<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::where('group', 'page_gallery')->get()->keyBy('key');
        
        $meta_title = $settings['page_gallery.meta_title']->value ?? 'Galeri | Coach Agam';
        $meta_description = $settings['page_gallery.meta_description']->value ?? 'Koleksi momen dan kegiatan Coach Agam dalam dunia sepakbola profesional.';
        $headline = $settings['page_gallery.headline']->value ?? 'Galeri Foto';
        $subheadline = $settings['page_gallery.subheadline']->value ?? 'Momen Berharga di Lapangan';
        $breadcrumb_image = $settings['page_gallery.breadcrumb_image']->value ?? '';
        $items = json_decode($settings['page_gallery.items']->value ?? '[]', true);

        // Reverse items so newest are first
        $items = array_reverse($items);

        return view('pages.gallery', compact(
            'meta_title', 
            'meta_description', 
            'headline', 
            'subheadline', 
            'breadcrumb_image',
            'items'
        ));
    }
}
