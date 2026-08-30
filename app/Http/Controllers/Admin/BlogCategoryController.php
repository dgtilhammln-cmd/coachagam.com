<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = $this->getCategories();
        return view('admin.blog.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $name = trim($request->input('name'));
        $slug = Str::slug($name);

        $categories = $this->getCategories();

        // Check if exists
        foreach ($categories as $cat) {
            if ($cat['slug'] === $slug) {
                return redirect()->back()->with('error', 'Kategori tersebut sudah ada.');
            }
        }

        $categories[] = [
            'id' => uniqid(),
            'name' => $name,
            'slug' => $slug,
        ];

        $this->saveCategories($categories);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $name = trim($request->input('name'));
        $slug = Str::slug($name);

        $categories = $this->getCategories();
        $updated = false;

        foreach ($categories as &$cat) {
            if ($cat['id'] === $id) {
                $cat['name'] = $name;
                $cat['slug'] = $slug;
                $updated = true;
                break;
            }
        }

        if ($updated) {
            $this->saveCategories($categories);
            return redirect()->back()->with('success', 'Kategori berhasil diupdate.');
        }

        return redirect()->back()->with('error', 'Kategori tidak ditemukan.');
    }

    public function destroy($id)
    {
        $categories = $this->getCategories();
        $newCategories = array_filter($categories, function($cat) use ($id) {
            return $cat['id'] !== $id;
        });

        $this->saveCategories(array_values($newCategories));

        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }

    private function getCategories()
    {
        $setting = SiteSetting::where('key', 'blog.categories')->first();
        if (!$setting) {
            // Default 3 categories as requested
            $default = [
                ['id' => uniqid(), 'name' => 'Sport Science', 'slug' => Str::slug('Sport Science')],
                ['id' => uniqid(), 'name' => 'Materi Kepelatihan', 'slug' => Str::slug('Materi Kepelatihan')],
                ['id' => uniqid(), 'name' => 'Filosofi & Spiritualitas', 'slug' => Str::slug('Filosofi & Spiritualitas')],
            ];
            $this->saveCategories($default);
            return $default;
        }

        return json_decode($setting->value, true) ?: [];
    }

    private function saveCategories(array $categories)
    {
        SiteSetting::updateOrCreate(
            ['key' => 'blog.categories'],
            ['group' => 'blog', 'value' => json_encode($categories), 'type' => 'json']
        );
    }
}
