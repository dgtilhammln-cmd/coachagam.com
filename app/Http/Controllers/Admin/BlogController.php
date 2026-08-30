<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $posts = $query->orderBy('created_at', 'desc')->paginate(10)->appends($request->all());
        $categories = $this->getCategories();

        return view('admin.blog.posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        $categories = $this->getCategories();
        return view('admin.blog.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'category' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'body' => 'required|string',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'faq' => 'nullable|array',
            'author_name' => 'nullable|string|max:255',
            'read_time' => 'nullable|string|max:50',
        ]);

        $data = $request->except(['featured_image']);
        
        $slug = Str::slug($request->slug ?: $request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        $data['slug'] = $slug;
        
        if (!$request->author_name) {
            $data['author_name'] = 'Coach Agam';
        }

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('uploads/blog', 'public');
        }

        if ($request->status == 'published' && !$request->published_at) {
            $data['published_at'] = now();
        }

        Post::create($data);

        return redirect()->route('admin.blog.posts.index')->with('success', 'Artikel berhasil diterbitkan!');
    }

    public function edit(Post $post)
    {
        $categories = $this->getCategories();
        return view('admin.blog.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'category' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'body' => 'required|string',
            'status' => 'required|in:draft,published,archived',
            'published_at' => 'nullable|date',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'faq' => 'nullable|array',
            'author_name' => 'nullable|string|max:255',
            'read_time' => 'nullable|string|max:50',
        ]);

        $data = $request->except(['featured_image']);
        
        $slug = Str::slug($request->slug ?: $request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        $data['slug'] = $slug;

        if ($request->hasFile('featured_image')) {
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('uploads/blog', 'public');
        }

        if ($request->status == 'published' && !$post->published_at && !$request->published_at) {
            $data['published_at'] = now();
        }

        $post->update($data);

        return redirect()->route('admin.blog.posts.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    public function destroy(Post $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        $post->delete();
        return redirect()->route('admin.blog.posts.index')->with('success', 'Artikel berhasil dihapus!');
    }

    private function getCategories()
    {
        $setting = SiteSetting::where('key', 'blog.categories')->first();
        if (!$setting) return [];

        $cats = json_decode($setting->value, true) ?: [];
        
        // Group them: Head categories (parent_id = null) and their children
        $heads = array_filter($cats, function($c) { return empty($c['parent_id']); });
        
        $structured = [];
        foreach ($heads as $head) {
            $subs = array_filter($cats, function($c) use ($head) { 
                return isset($c['parent_id']) && $c['parent_id'] == $head['id']; 
            });
            $structured[] = [
                'id' => $head['id'],
                'name' => $head['name'],
                'slug' => $head['slug'],
                'subs' => array_values($subs)
            ];
        }

        return $structured;
    }
}
