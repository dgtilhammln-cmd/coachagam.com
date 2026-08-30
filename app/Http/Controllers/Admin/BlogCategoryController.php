<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('seed_mindmap')) {
            $this->seedMindMapCategories();
            return redirect()->route('admin.blog.categories.index')->with('success', 'Kategori berhasil direset ke struktur Mind Map! Total ' . $this->getCategoryCount() . ' kategori dimuat.');
        }

        $categories = $this->getCategories();
        return view('admin.blog.categories', compact('categories'));
    }

    private function getCategoryCount()
    {
        $setting = SiteSetting::where('key', 'blog.categories')->first();
        if (!$setting) return 0;
        return count(json_decode($setting->value, true) ?: []);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'parent_id' => 'nullable|string'
        ]);

        $name = trim($request->input('name'));
        $slug = Str::slug($name);

        $categories = $this->getCategories();

        // Check if slug exists
        foreach ($categories as $cat) {
            if ($cat['slug'] === $slug) {
                return redirect()->back()->with('error', 'Kategori tersebut sudah ada.');
            }
        }

        $categories[] = [
            'id' => uniqid(),
            'name' => $name,
            'slug' => $slug,
            'parent_id' => $request->input('parent_id') ?: null,
        ];

        $this->saveCategories($categories);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'parent_id' => 'nullable|string'
        ]);

        $name = trim($request->input('name'));
        $slug = Str::slug($name);

        $categories = $this->getCategories();
        $updated = false;

        foreach ($categories as &$cat) {
            if ($cat['id'] === $id) {
                $cat['name'] = $name;
                $cat['slug'] = $slug;
                $cat['parent_id'] = $request->input('parent_id') ?: null;
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
        // Cek apakah punya child
        $hasChild = false;
        foreach ($categories as $cat) {
            if (isset($cat['parent_id']) && $cat['parent_id'] == $id) {
                $hasChild = true;
                break;
            }
        }

        if ($hasChild) {
            return redirect()->back()->with('error', 'Kategori tidak dapat dihapus karena memiliki sub-kategori.');
        }

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
            $this->seedMindMapCategories();
            $setting = SiteSetting::where('key', 'blog.categories')->first();
        }
        
        $cats = json_decode($setting->value, true) ?: [];
        
        // Backward compatibility: add parent_id if not exist
        foreach ($cats as &$cat) {
            if (!array_key_exists('parent_id', $cat)) {
                $cat['parent_id'] = null;
            }
        }
        
        return $cats;
    }

    private function saveCategories(array $categories)
    {
        SiteSetting::updateOrCreate(
            ['key' => 'blog.categories'],
            ['group' => 'blog', 'value' => json_encode($categories), 'type' => 'json']
        );
    }

    private function seedMindMapCategories()
    {
        $data = [
            'Sports Science' => [
                'Fisiologi Olahraga', 'Biomekanika Olahraga', 'Psikologi Olahraga', 'Strength & Conditioning', 
                'Nutrisi Olahraga', 'Kedokteran Olahraga', 'Analisis Performa', 'Motor Learning & Skill Acquisition', 
                'Recovery & Regeneration', 'Sports Technology & Data Science'
            ],
            'Materi Tentang Kepelatihan Sepakbola & Keilmuan Sepakbola' => [
                'Kepelatihan Sepakbola', 'Keilmuan Sepakbola'
            ],
            'Filosofi Hidup & Spiritualitas' => [
                'Menjaga Hubungan dengan Tuhan dan Sesama', 'Memiliki Tujuan Hidup', 'Memahami Baik dan Buruk', 
                'Membentuk Karakter yang Kuat', 'Menjalani Hidup dengan Tenang dan Bermakna'
            ],
            'About' => [
                'Profil Umum', 'Histori Tumbuh Kembang', 'Educational Background', 'Coaching Experience', 'Awards & Achievements'
            ],
            'Modul Kepelatihan Sepakbola' => [
                'Filosofi dan Peran Pelatih', 'Karakteristik dan Kebutuhan Pemain', 'Prinsip Dasar Kepelatihan Sepakbola', 
                'Coaching Behavior dan Komunikasi Pelatih', 'Dasar Sports Science', 'Perencanaan Program Latihan', 
                'Proses Melatih', 'Refleksi dan Evaluasi'
            ]
        ];

        $categories = [];
        foreach ($data as $head => $subs) {
            $headId = uniqid();
            $categories[] = [
                'id' => $headId,
                'name' => $head,
                'slug' => Str::slug($head),
                'parent_id' => null
            ];
            foreach ($subs as $sub) {
                $categories[] = [
                    'id' => uniqid(),
                    'name' => $sub,
                    'slug' => Str::slug($sub),
                    'parent_id' => $headId
                ];
            }
        }

        $this->saveCategories($categories);
    }
}
