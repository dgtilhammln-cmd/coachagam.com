<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\View\View;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama Coach Agam.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        // Ambil 3 artikel terbaru yang sudah dipublikasikan.
        // Jika tabel posts belum ada, gunakan koleksi kosong agar homepage
        // tetap tampil dengan konten fallback.
        try {
            $posts = Schema::hasTable('posts')
                ? Post::published()
                      ->select([
                          'id', 'title', 'slug', 'excerpt',
                          'category', 'featured_image',
                          'author_name', 'published_at', 'read_time',
                      ])
                      ->orderByDesc('published_at')
                      ->limit(3)
                      ->get()
                : collect();
        } catch (\Throwable $e) {
            // Catch any DB error gracefully — homepage never breaks
            $posts = collect();
        }

        return view('home', compact('posts'));
    }
}
