<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->comment('Kunci unik setting, e.g. homepage.hero_slides');
            $table->string('group')->default('general')->index()->comment('Kelompok: general, homepage, seo, contact');
            $table->text('value')->nullable()->comment('Nilai setting (teks / JSON)');
            $table->string('type')->default('text')->comment('Tipe: text, textarea, json, boolean, image');
            $table->string('label')->nullable()->comment('Label untuk tampilan admin');
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(true)->comment('Apakah setting bisa diakses publik via helper');
            $table->timestamps();
        });

        // Seed default homepage settings
        $defaults = [
            // ── Hero ──────────────────────────────────────────────────────
            [
                'key'   => 'homepage.hero_slides',
                'group' => 'homepage',
                'type'  => 'json',
                'label' => 'Hero Slides',
                'description' => 'Array slide hero (JSON). Setiap slide: tagline, title, subtitle, cta_label, cta_href, cta2_label, cta2_href, image_icon, image_text.',
                'value' => json_encode([
                    [
                        'tagline'    => '⚽ Pelatih Sepakbola Profesional',
                        'title'      => 'Kembangkan Bakat Sepakbola Anda',
                        'subtitle'   => 'Program latihan terstruktur berbasis ilmu olahraga modern untuk mengoptimalkan potensi setiap pemain dari semua level.',
                        'cta_label'  => 'Mulai Latihan',
                        'cta_href'   => '/#kerjasama',
                        'cta2_label' => 'Pelajari Metode',
                        'cta2_href'  => '/#tentang',
                        'image_icon' => '🏟️',
                        'image_text' => 'Lapangan Latihan Profesional',
                    ],
                    [
                        'tagline'    => '🏆 Spesialis Pengembangan Pemain Muda',
                        'title'      => 'Cetak Generasi Pesepakbola Unggul',
                        'subtitle'   => 'Metodologi pengembangan pemain muda usia 8–18 tahun yang telah terbukti menghasilkan atlet berprestasi nasional.',
                        'cta_label'  => 'Program Usia Dini',
                        'cta_href'   => '/layanan',
                        'cta2_label' => 'Lihat Galeri',
                        'cta2_href'  => '/#galeri',
                        'image_icon' => '👦',
                        'image_text' => 'Pembinaan Pemain Muda Berbakat',
                    ],
                    [
                        'tagline'    => '📊 Analisis Taktik Berbasis Data',
                        'title'      => 'Strategi Cerdas, Kemenangan Pasti',
                        'subtitle'   => 'Analisis video mendalam, perencanaan taktik tim, dan sesi debriefing interaktif untuk meningkatkan performa kolektif.',
                        'cta_label'  => 'Konsultasi Taktik',
                        'cta_href'   => '/#kerjasama',
                        'cta2_label' => 'Baca Blog',
                        'cta2_href'  => '/blog',
                        'image_icon' => '📊',
                        'image_text' => 'Analisis Data dan Taktik Pertandingan',
                    ],
                    [
                        'tagline'    => '💪 Strength & Conditioning',
                        'title'      => 'Fisik Prima, Performa Maksimal',
                        'subtitle'   => 'Program kebugaran fisik khusus pemain sepakbola — kecepatan, kekuatan, ketahanan, dan pencegahan cedera.',
                        'cta_label'  => 'Program Fisik',
                        'cta_href'   => '/layanan',
                        'cta2_label' => 'Hubungi Kami',
                        'cta2_href'  => '/kontak',
                        'image_icon' => '⚡',
                        'image_text' => 'Program Fisik dan Kondisi Atlet',
                    ],
                    [
                        'tagline'    => '🌐 Tersedia Online & Offline',
                        'title'      => 'Latih Bersama Coach di Mana Saja',
                        'subtitle'   => 'Sesi pelatihan langsung maupun virtual. Program online personal dengan feedback video dan laporan progres mingguan.',
                        'cta_label'  => 'Daftar Sekarang',
                        'cta_href'   => '/register',
                        'cta2_label' => 'Tanya via WhatsApp',
                        'cta2_href'  => 'https://wa.me/6281234567890',
                        'image_icon' => '💻',
                        'image_text' => 'Pelatihan Online dan Offline Fleksibel',
                    ],
                ]),
            ],
            // ── About ─────────────────────────────────────────────────────
            [
                'key'   => 'homepage.about_tagline',
                'group' => 'homepage',
                'type'  => 'text',
                'label' => 'About — Tagline / Heading Utama',
                'value' => 'Membangun Juara Dari Dalam Lapangan',
            ],
            [
                'key'   => 'homepage.about_bio_1',
                'group' => 'homepage',
                'type'  => 'textarea',
                'label' => 'About — Bio Paragraf 1',
                'value' => 'Coach Agam adalah pelatih sepakbola profesional bersertifikat dengan rekam jejak lebih dari satu dekade dalam mengembangkan pemain dari berbagai tingkatan — dari junior hingga profesional.',
            ],
            [
                'key'   => 'homepage.about_bio_2',
                'group' => 'homepage',
                'type'  => 'textarea',
                'label' => 'About — Bio Paragraf 2 / Filosofi',
                'value' => 'Dengan filosofi "Develop the Player, Build the Character", Coach Agam tidak hanya melatih teknik sepakbola, tetapi juga membangun mentalitas juara, kedisiplinan, dan kerja sama tim yang solid.',
            ],
            [
                'key'   => 'homepage.about_years_exp',
                'group' => 'homepage',
                'type'  => 'text',
                'label' => 'About — Tahun Pengalaman',
                'value' => '10+',
            ],
            [
                'key'   => 'homepage.about_athletes_count',
                'group' => 'homepage',
                'type'  => 'text',
                'label' => 'About — Jumlah Atlet Dibina',
                'value' => '500+',
            ],
            [
                'key'   => 'homepage.about_certifications',
                'group' => 'homepage',
                'type'  => 'text',
                'label' => 'About — Sertifikasi (pisah koma)',
                'value' => 'AFC B License,PSSI Level II,UEFA Pro Certified,S&C Specialist',
            ],
            // ── CTA Section ───────────────────────────────────────────────
            [
                'key'   => 'homepage.cta_heading',
                'group' => 'homepage',
                'type'  => 'text',
                'label' => 'CTA — Judul Utama',
                'value' => 'Siap Membawa Tim Anda ke Level Berikutnya?',
            ],
            [
                'key'   => 'homepage.cta_description',
                'group' => 'homepage',
                'type'  => 'textarea',
                'label' => 'CTA — Deskripsi',
                'value' => 'Apakah Anda tim sepakbola, akademi, atau sponsor yang ingin berkolaborasi? Coach Agam terbuka untuk berbagai bentuk kerjasama profesional.',
            ],
            // ── Kontak Global ─────────────────────────────────────────────
            [
                'key'   => 'contact.whatsapp_number',
                'group' => 'contact',
                'type'  => 'text',
                'label' => 'Nomor WhatsApp (format internasional)',
                'value' => '6281234567890',
            ],
            [
                'key'   => 'contact.whatsapp_message',
                'group' => 'contact',
                'type'  => 'textarea',
                'label' => 'Pesan Default WhatsApp',
                'value' => 'Halo Coach Agam, saya ingin mengetahui lebih lanjut tentang program pelatihan.',
            ],
            [
                'key'   => 'contact.email',
                'group' => 'contact',
                'type'  => 'text',
                'label' => 'Email Kontak',
                'value' => 'info@coachagam.com',
            ],
            [
                'key'   => 'contact.location',
                'group' => 'contact',
                'type'  => 'text',
                'label' => 'Lokasi',
                'value' => 'Sidoarjo, Jawa Timur, Indonesia',
            ],
            // ── SEO Global ────────────────────────────────────────────────
            [
                'key'   => 'seo.site_title',
                'group' => 'seo',
                'type'  => 'text',
                'label' => 'Site Title (untuk meta title)',
                'value' => 'Coach Agam - Pelatih Sepakbola Profesional Indonesia',
            ],
            [
                'key'   => 'seo.site_description',
                'group' => 'seo',
                'type'  => 'textarea',
                'label' => 'Site Meta Description',
                'value' => 'Coach Agam adalah pelatih sepakbola profesional berpengalaman di Indonesia. Spesialisasi pengembangan pemain muda, analisis taktik, dan program latihan berbasis data ilmiah.',
            ],
        ];

        foreach ($defaults as $setting) {
            \DB::table('site_settings')->insertOrIgnore(array_merge($setting, [
                'is_public'  => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
