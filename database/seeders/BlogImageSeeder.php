<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class BlogImageSeeder extends Seeder
{
    public function run(): void
    {
        Post::where('slug', 'pentingnya-periodisasi-latihan-untuk-pemain-muda')
            ->update(['featured_image' => 'uploads/blog/blog-sport-science.png']);

        Post::where('slug', 'membangun-pressing-tinggi-yang-efektif-prinsip-dasar-dan-implementasi')
            ->update(['featured_image' => 'uploads/blog/blog-pressing.png']);

        Post::where('slug', 'mental-juara-membangun-ketangguhan-psikologis-atlet-dari-dalam')
            ->update(['featured_image' => 'uploads/blog/blog-mental.png']);

        $this->command->info('Blog images updated!');
    }
}
