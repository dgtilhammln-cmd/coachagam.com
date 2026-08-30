<?php

use App\Models\Post;
use Illuminate\Support\Str;

$articles = [
    [
        'title' => 'Filosofi dan Peran Pelatih',
        'body' => 'Sebagai seorang pelatih sepakbola, memiliki filosofi yang jelas adalah fondasi utama. Filosofi ini tidak hanya mencakup gaya bermain di atas lapangan (seperti possession-based, counter-attack, dll), tetapi juga mencakup nilai-nilai, etos kerja, dan bagaimana seorang pelatih berinteraksi dengan pemainnya. Peran pelatih melampaui sekadar menyusun taktik; pelatih adalah mentor, psikolog, manajer, dan pemimpin. Pelatih harus mampu menginspirasi pemain, membangun karakter, dan menciptakan lingkungan belajar yang positif.',
    ],
    [
        'title' => 'Karakteristik dan Kebutuhan Pemain',
        'body' => 'Setiap pemain sepakbola adalah individu yang unik dengan karakteristik fisik, teknis, taktis, dan psikologis yang berbeda. Memahami kebutuhan individu pemain sangat penting dalam kepelatihan modern. Pemain usia dini membutuhkan pendekatan yang berfokus pada kegembiraan dan penguasaan teknik dasar, sementara pemain senior lebih membutuhkan pendekatan berorientasi pada hasil dan taktik kompleks. Pelatih yang baik harus mampu mengidentifikasi kekuatan dan kelemahan setiap pemain serta menyesuaikan pendekatan komunikasi dan pelatihan untuk memaksimalkan potensi mereka.',
    ],
    [
        'title' => 'Prinsip Dasar Kepelatihan Sepakbola',
        'body' => 'Kepelatihan sepakbola dibangun di atas prinsip-prinsip dasar yang universal. Hal ini mencakup prinsip bertahan (defending) seperti compactness, delay, cover, dan balance, serta prinsip menyerang (attacking) seperti penetration, support, width, dan mobility. Pelatih harus memastikan setiap sesi latihan dirancang untuk melatih prinsip-prinsip ini dalam situasi yang menyerupai pertandingan (game-like situations). Pemahaman yang mendalam tentang prinsip-prinsip ini memungkinkan tim untuk beradaptasi dengan berbagai formasi dan taktik lawan.',
    ],
    [
        'title' => 'Coaching Behavior dan Komunikasi',
        'body' => 'Perilaku pelatih (coaching behavior) memiliki dampak langsung pada motivasi dan performa pemain. Komunikasi yang efektif bukan hanya tentang apa yang dikatakan, tetapi juga bagaimana hal itu disampaikan (bahasa tubuh, intonasi, momen yang tepat). Pelatih harus menguasai berbagai gaya komunikasi, dari otokratis hingga demokratis, tergantung pada situasi dan kedewasaan tim. Memberikan umpan balik (feedback) yang konstruktif dan spesifik sangat krusial agar pemain memahami apa yang perlu diperbaiki tanpa merasa dijatuhkan.',
    ],
    [
        'title' => 'Pelatih Dasar Sports Science',
        'body' => 'Di era sepakbola modern, penerapan sports science tidak bisa diabaikan. Pelatih dituntut untuk memahami dasar-dasar fisiologi olahraga, biomekanika, nutrisi, dan psikologi olahraga. Memahami sistem energi manusia membantu pelatih merancang sesi latihan fisik yang tepat (aerobik vs anaerobik). Pengetahuan tentang recovery (pemulihan), pencegahan cedera, dan periodisasi latihan memastikan pemain berada pada kondisi puncak saat pertandingan. Sports science membantu pengambilan keputusan berdasarkan data, bukan sekadar intuisi.',
    ],
    [
        'title' => 'Perencanaan Program Latihan',
        'body' => 'Keberhasilan sebuah tim seringkali ditentukan jauh sebelum pertandingan dimulai, yaitu pada fase perencanaan. Perencanaan program latihan (periodisasi) harus disusun secara sistematis, mulai dari rencana tahunan (macrocycle), bulanan (mesocycle), hingga mingguan dan harian (microcycle). Perencanaan ini harus menyeimbangkan antara beban kerja (workload) dan pemulihan, serta menyelaraskan aspek fisik, teknik, taktik, dan mental. Rencana yang baik bersifat terstruktur namun cukup fleksibel untuk beradaptasi dengan dinamika musim kompetisi.',
    ],
    [
        'title' => 'Proses Melatih (Sebelum Latihan, Saat Latihan, & Setelah Latihan)',
        'body' => 'Proses kepelatihan adalah sebuah siklus yang berkesinambungan. **Sebelum Latihan**: Pelatih harus menyusun rencana sesi latihan (session plan) yang detail, menetapkan tujuan latihan, dan menyiapkan peralatan. **Saat Latihan**: Pelatih bertindak sebagai fasilitator, mengobservasi jalannya latihan, memberikan instruksi yang tepat sasaran (coaching points), dan mengatur intensitas. **Setelah Latihan**: Dilakukan pendinginan (cooling down) dan debriefing singkat untuk mengevaluasi apakah tujuan latihan hari itu tercapai.',
    ],
    [
        'title' => 'Refleksi dan Evaluasi',
        'body' => 'Refleksi diri adalah alat pembelajaran terpenting bagi seorang pelatih. Setelah sesi latihan atau pertandingan, pelatih harus mampu mengevaluasi kinerjanya sendiri dan kinerja tim secara objektif. Apa yang berjalan baik? Apa yang gagal? Mengapa taktik tertentu tidak berhasil? Proses evaluasi ini bisa melibatkan analisis video, statistik pertandingan, dan diskusi dengan staf kepelatihan. Pelatih yang hebat adalah pelatih yang tidak pernah berhenti belajar dan bersedia mengadaptasi pendekatannya berdasarkan hasil evaluasi.',
    ]
];

$category = 'modul-kepelatihan';
$authorId = 1; // Assuming default admin is 1
$authorName = 'Coach Agam';

foreach ($articles as $index => $article) {
    $slug = Str::slug($article['title']);
    
    // Check if post already exists
    $existing = Post::where('slug', $slug)->first();
    
    if (!$existing) {
        Post::create([
            'title' => $article['title'],
            'slug' => $slug,
            'excerpt' => Str::limit(strip_tags($article['body']), 150),
            'body' => "<p>" . $article['body'] . "</p>",
            'category' => $category,
            'author_name' => $authorName,
            'author_id' => $authorId,
            'status' => 'published',
            'published_at' => now()->addMinutes($index), // stagger publish time slightly
            'read_time' => 3,
            'views' => rand(10, 100),
            'is_featured' => false
        ]);
        echo "Created: " . $article['title'] . "\n";
    } else {
        echo "Already exists: " . $article['title'] . "\n";
    }
}

echo "Done seeding Modul Kepelatihan articles!\n";
