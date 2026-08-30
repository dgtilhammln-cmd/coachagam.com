<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $settings = [
            // Hero
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.hero_title', 'value' => 'AHP Training', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.hero_subtitle', 'value' => 'Program Pelatihan Sepakbola Profesional', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.about_text', 'value' => '<p>AHP Training adalah program pelatihan eksklusif yang dirancang untuk meningkatkan atribut teknis dan fisik pemain sepakbola modern secara terukur.</p>', 'type' => 'textarea'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.intro_headline_bold', 'value' => 'Agility. Heading.', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.intro_headline_thin', 'value' => 'Training Terstruktur', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.intro_eyebrow_label', 'value' => 'Overview Program', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.intro_badge_text', 'value' => "Program\nEksklusif", 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.stat1_value', 'value' => '6', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.stat1_label', 'value' => 'Tahapan Terstruktur', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.stat2_value', 'value' => '100%', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.stat2_label', 'value' => 'Berbasis Data', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.stat3_value', 'value' => 'AFC', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.stat3_label', 'value' => 'Lisensi Pelatih', 'type' => 'text'],

            // Section 1
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.pretest_title', 'value' => 'Pre Test', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.pretest_desc', 'value' => 'Sebelum memulai program, setiap pemain menjalani serangkaian tes awal untuk mengukur kondisi fisik dan kemampuan dasar sebagai baseline pengembangan.', 'type' => 'textarea'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.pretest_items', 'value' => json_encode(['Pengukuran BMI & Komposisi Tubuh', 'Tes MoCA (Kognitif)', 'Tes Passing & Scanning', 'Tes Akselerasi & Kecepatan Maksimal', 'Tes Yo-Yo Endurance']), 'type' => 'json'],

            // Section 2
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.program_title', 'value' => 'Program Latihan', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.program_subtitle', 'value' => 'Tahunan · Bulanan · Mingguan · Harian', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.program_desc', 'value' => 'Menu latihan intensif yang distrukturisasi untuk mengembangkan setiap elemen permainan secara spesifik dan terukur.', 'type' => 'textarea'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.program_cards', 'value' => json_encode([
                ['title' => 'Tahunan',  'desc' => 'Perencanaan jangka panjang satu tahun penuh mencakup fase preseason, kompetisi, dan pemulihan.', 'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>'],
                ['title' => 'Bulanan',  'desc' => 'Siklus latihan bulanan dengan variasi intensitas untuk mencegah plateau dan overtraining.',     'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 3v18h18"/><path d="m19 9-5 5-4-4-3 3"/></svg>'],
                ['title' => 'Mingguan', 'desc' => 'Penyesuaian beban latihan per minggu berdasarkan respons tubuh dan jadwal pertandingan.',        'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>'],
                ['title' => 'Harian',   'desc' => 'Sesi latihan harian yang terstruktur dengan warm-up, core session, dan cool-down.',               'icon' => '<svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>'],
            ]), 'type' => 'json'],

            // Section 3
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.volume_title', 'value' => 'Volume dan Intensitas Latihan', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.volume_desc', 'value' => 'Latihan dirancang dengan sistem periodisasi yang ketat — memadukan volume dan intensitas secara progresif untuk hasil maksimal.', 'type' => 'textarea'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.volume_stats', 'value' => json_encode([
                ['value' => '8',    'label' => 'Minggu Program'],
                ['value' => '5x',   'label' => 'Sesi Per Minggu'],
                ['value' => '90m',  'label' => 'Durasi Per Sesi'],
            ]), 'type' => 'json'],

            // Section 4
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.eval_title', 'value' => 'Evaluation Training Load', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.eval_desc', 'value' => 'Setiap sesi dipantau dengan ketat untuk memastikan beban latihan optimal sesuai kapasitas masing-masing pemain.', 'type' => 'textarea'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.eval_points', 'value' => json_encode(['Monitoring RPE (Rate of Perceived Exertion)', 'Analisis Heart Rate Zone', 'Evaluasi Kualitas Gerak', 'Data Tracking Per Sesi']), 'type' => 'json'],

            // Section 5
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.posttest_title', 'value' => 'Post Test', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.posttest_desc', 'value' => 'Setelah menyelesaikan program, pemain mengikuti Post Test untuk mengukur peningkatan secara objektif dan terukur dibandingkan baseline awal.', 'type' => 'textarea'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.posttest_items', 'value' => json_encode(['Re-tes seluruh parameter Pre Test', 'Perbandingan data Pre vs Post', 'Analisis peningkatan performa', 'Rekomendasi program lanjutan']), 'type' => 'json'],

            // Section 6
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.report_title', 'value' => 'Report Individual Players', 'type' => 'text'],
            ['group' => 'page_ahp_training', 'key' => 'page_ahp_training.report_desc', 'value' => 'Seluruh data dirangkum menjadi laporan individu komprehensif yang dapat diakses pemain menggunakan nomor registrasi.', 'type' => 'textarea'],
        ];

        foreach ($settings as $setting) {
            \Illuminate\Support\Facades\DB::table('site_settings')->updateOrInsert(
                ['key' => $setting['key']],
                [
                    'group' => $setting['group'],
                    'value' => $setting['value'],
                    'type'  => $setting['type'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \Illuminate\Support\Facades\DB::table('site_settings')->where('group', 'page_ahp_training')->delete();
    }
};
