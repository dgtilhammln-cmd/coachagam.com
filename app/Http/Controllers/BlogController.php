<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $search = $request->query('search');
        
        // Default sort for modul-kepelatihan is 'terlama' (oldest), otherwise 'terbaru' (newest)
        $defaultSort = ($category === 'modul-kepelatihan') ? 'terlama' : 'terbaru';
        $sort = $request->query('sort', $defaultSort);
        
        $query = Post::published();
        
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }
        
        if ($category) {
            $query->byCategory($category);
        }

        switch ($sort) {
            case 'terlama':
                $query->orderBy('published_at', 'asc');
                break;
            case 'terpopuler':
                $query->orderBy('views', 'desc')->orderBy('published_at', 'desc');
                break;
            case 'terbaru':
            default:
                $query->orderBy('published_at', 'desc');
                break;
        }

        $posts = $query->paginate(9);
        $categories = $this->getCategories();

        return view('pages.blog.index', compact('posts', 'categories', 'category', 'search', 'sort'));
    }

    public function show($slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();
        
        // Increment views
        $post->increment('views');

        // Get related posts from same category
        $relatedPosts = Post::published()
            ->where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('pages.blog.show', compact('post', 'relatedPosts'));
    }

    private function getCategories()
    {
        $setting = SiteSetting::where('key', 'blog.categories')->first();
        return $setting ? json_decode($setting->value, true) : [
            ['id' => uniqid(), 'name' => 'Sport Science', 'slug' => 'sport-science'],
            ['id' => uniqid(), 'name' => 'Materi Kepelatihan', 'slug' => 'materi-kepelatihan'],
            ['id' => uniqid(), 'name' => 'Filosofi & Spiritualitas', 'slug' => 'filosofi-spiritualitas'],
        ];
    }
}
