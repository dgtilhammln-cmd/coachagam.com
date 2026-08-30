use App\Models\Post;

// Seed default blog categories
\App\Models\SiteSetting::updateOrCreate(
    ['key' => 'blog.categories'],
    [
        'group' => 'blog',
        'value' => json_encode([
            ['id' => uniqid(), 'name' => 'Sport Science', 'slug' => 'sport-science'],
            ['id' => uniqid(), 'name' => 'Materi Kepelatihan', 'slug' => 'materi-kepelatihan'],
            ['id' => uniqid(), 'name' => 'Filosofi & Spiritualitas', 'slug' => 'filosofi-spiritualitas'],
        ]),
        'type' => 'json'
    ]
);

// Article 1 - Sport Science
Post::updateOrCreate(
    ['slug' => 'pentingnya-periodisasi-latihan-untuk-pemain-muda'],
    [
        'title' => 'Pentingnya Periodisasi Latihan untuk Pemain Muda',
        'excerpt' => 'Periodisasi adalah kunci untuk mengoptimalkan performa atlet muda. Tanpa perencanaan siklus latihan yang tepat, risiko cedera dan overtraining akan meningkat drastis.',
        'body' => '<h2>Apa Itu Periodisasi Latihan?</h2>
<p>Periodisasi latihan adalah metode perencanaan program latihan yang membagi siklus latihan menjadi periode-periode yang berbeda, masing-masing dengan fokus dan intensitas yang berbeda. Konsep ini bukan hanya berlaku untuk atlet profesional, tetapi sangat krusial juga untuk diterapkan pada pemain muda.</p>
<h2>Mengapa Pemain Muda Membutuhkan Periodisasi?</h2>
<p>Tubuh pemain muda masih dalam tahap perkembangan. Tulang, ligamen, dan otot mereka belum mencapai kematangan penuh. Oleh karena itu, beban latihan yang terlalu tinggi secara konsisten dapat menghambat pertumbuhan dan meningkatkan risiko cedera.</p>
<blockquote>
"Latihan yang baik bukan yang paling keras, melainkan yang paling tepat pada waktu yang tepat." — Coach Agam
</blockquote>
<h2>Fase-fase dalam Periodisasi</h2>
<ul>
    <li><strong>Fase Persiapan Umum:</strong> Fokus pada peningkatan kapasitas aerobik, kekuatan dasar, dan teknik fundamental.</li>
    <li><strong>Fase Persiapan Khusus:</strong> Latihan lebih spesifik ke tuntutan fisik sepakbola, termasuk sprint pendek, agility, dan power.</li>
    <li><strong>Fase Kompetisi:</strong> Mempertahankan kondisi puncak sambil mengelola kelelahan. Volume latihan dikurangi, intensitas dipertahankan.</li>
    <li><strong>Fase Transisi:</strong> Pemulihan aktif pasca musim. Menjaga kebugaran umum sambil memberikan waktu istirahat mental dan fisik.</li>
</ul>
<h2>Kesimpulan</h2>
<p>Periodisasi yang tepat adalah investasi jangka panjang bagi karier seorang pemain. Pelatih dan orang tua harus memahami bahwa lebih banyak latihan tidak selalu berarti lebih baik. Kuncinya adalah program yang <strong>terstruktur, progresif, dan disesuaikan dengan usia biologis</strong> sang atlet.</p>',
        'category' => 'sport-science',
        'author_name' => 'Coach Agam',
        'status' => 'published',
        'published_at' => now()->subDays(7),
        'meta_title' => 'Periodisasi Latihan Pemain Muda — Coach Agam',
        'meta_description' => 'Pelajari pentingnya periodisasi latihan untuk mengoptimalkan performa dan mencegah cedera pada pemain sepakbola muda.',
        'is_featured' => true,
        'views' => 142,
    ]
);

// Article 2 - Materi Kepelatihan
Post::updateOrCreate(
    ['slug' => 'membangun-pressing-tinggi-yang-efektif-prinsip-dasar-dan-implementasi'],
    [
        'title' => 'Membangun Pressing Tinggi yang Efektif: Prinsip Dasar & Implementasi',
        'excerpt' => 'High pressing bukan sekadar berlari kencang mengejar bola. Dibutuhkan koordinasi taktik, pemahaman posisi, dan kondisi fisik yang prima. Berikut panduan implementasinya.',
        'body' => '<h2>Mengapa High Pressing?</h2>
<p>Dalam sepakbola modern, high pressing telah menjadi salah satu senjata paling efektif untuk merebut bola di zona berbahaya lawan. Tim-tim seperti Liverpool era Klopp, RB Leipzig, dan Napoli era Sarri membuktikan betapa dahsyatnya pressing yang terorganisir.</p>
<h2>5 Prinsip Dasar High Pressing</h2>
<ol>
    <li><strong>Pemicu Pressing (Trigger):</strong> Tentukan momen yang tepat untuk memulai pressing — bisa saat umpan balik ke kiper, saat menerima bola dengan punggung menghadap gawang, atau saat kontrol bola yang buruk.</li>
    <li><strong>Kepadatan Zona (Compactness):</strong> Semua lini harus bergerak bersama untuk mempersempit ruang lawan. Jarak antar lini tidak boleh lebih dari 25 meter.</li>
    <li><strong>Memotong Passing Lane:</strong> Pemain yang pressing harus memaksa lawan ke arah tertentu, bukan hanya mengejar bola.</li>
    <li><strong>Counter-press Setelah Kehilangan Bola:</strong> Dalam 5 detik pertama setelah kehilangan bola, lakukan pressing agresif sebelum lawan mengorganisir serangan.</li>
    <li><strong>Recovering Position:</strong> Jika pressing gagal, seluruh tim harus mundur dengan cepat dan terorganisir.</li>
</ol>
<h2>Latihan untuk Membangun Pressing</h2>
<p>Mulailah dengan <strong>rondo 4v2 dan 6v3</strong> untuk melatih intensitas dan kepadatan. Kemudian progresikan ke skenario pressing 11v11 di lapangan kecil (60x40 meter) dengan aturan: tim yang kehilangan bola langsung melakukan counter-press.</p>
<h2>Kesalahan Umum yang Harus Dihindari</h2>
<ul>
    <li>Pressing individual tanpa koordinasi tim</li>
    <li>Tidak memiliki pemicu pressing yang jelas</li>
    <li>Kebugaran yang tidak mendukung intensitas pressing</li>
</ul>',
        'category' => 'materi-kepelatihan',
        'author_name' => 'Coach Agam',
        'status' => 'published',
        'published_at' => now()->subDays(14),
        'meta_title' => 'High Pressing Efektif: Prinsip & Implementasi — Coach Agam',
        'meta_description' => 'Panduan lengkap membangun sistem pressing tinggi yang efektif dalam sepakbola modern. Dari prinsip dasar hingga implementasi latihan.',
        'is_featured' => false,
        'views' => 287,
    ]
);

// Article 3 - Filosofi & Spiritualitas
Post::updateOrCreate(
    ['slug' => 'mental-juara-membangun-ketangguhan-psikologis-atlet-dari-dalam'],
    [
        'title' => 'Mental Juara: Membangun Ketangguhan Psikologis Atlet dari Dalam',
        'excerpt' => 'Teknik dan fisik yang prima tidak cukup tanpa fondasi mental yang kuat. Inilah filosofi yang selalu saya tanamkan kepada setiap atlet yang saya latih.',
        'body' => '<h2>Fisik Kelas Dunia, Mental Biasa-biasa Saja</h2>
<p>Saya telah menyaksikan banyak pemain berbakat yang gagal mencapai potensi terbaik mereka bukan karena kekurangan fisik atau teknik, melainkan karena mental yang tidak kuat. Ketangguhan psikologis adalah pembeda antara pemain yang baik dan pemain yang hebat.</p>
<blockquote>
"Champions are made in the moments when they want to quit, but they don't." — Herb Brooks
</blockquote>
<h2>Tiga Pilar Mental Juara</h2>
<p>Dalam filosofi kepelatihan saya, ada tiga pilar yang selalu saya bangun bersama setiap atlet:</p>
<h3>1. Ketenangan di Bawah Tekanan</h3>
<p>Kemampuan untuk tetap tenang ketika situasi kritis adalah keterampilan yang bisa dilatih. Melalui simulasi tekanan dalam latihan — seperti latihan dengan kondisi defisit skor, waktu tersisa sedikit, atau dengan penonton yang memberikan tekanan — pemain belajar mengelola adrenalin dan tetap fokus pada tugasnya.</p>
<h3>2. Growth Mindset</h3>
<p>Pemain dengan growth mindset melihat kegagalan sebagai pelajaran, bukan sebagai cerminan kemampuan permanen mereka. Saya selalu mengajarkan: <strong>tidak ada gagal, yang ada hanya belum berhasil</strong>. Setiap kesalahan adalah data, bukan hukuman.</p>
<h3>3. Kolektivisme di Atas Egoisme</h3>
<p>Sepakbola adalah olahraga kolektif. Pemain yang menempatkan tim di atas ego pribadi akan jauh lebih berharga daripada pemain yang memiliki kemampuan individual brilian tetapi sulit bekerja sama. Nilai ini saya tanamkan sejak hari pertama latihan.</p>
<h2>Peran Spiritualitas</h2>
<p>Sebagai seorang Muslim, saya percaya bahwa kedamaian batin yang berasal dari spiritualitas adalah fondasi terkuat dari ketangguhan mental. Keyakinan bahwa setiap usaha terbaik yang kita lakukan tidak akan sia-sia memberikan ketenangan yang tidak bisa diberikan oleh teknik mental mana pun.</p>
<p>Kombinasi antara latihan psikologis terstruktur dan nilai-nilai spiritual adalah resep yang saya percaya untuk mencetak tidak hanya atlet terbaik, tetapi juga manusia terbaik.</p>',
        'category' => 'filosofi-spiritualitas',
        'author_name' => 'Coach Agam',
        'status' => 'published',
        'published_at' => now()->subDays(21),
        'meta_title' => 'Mental Juara: Ketangguhan Psikologis Atlet — Coach Agam',
        'meta_description' => 'Filosofi Coach Agam tentang membangun mental juara dan ketangguhan psikologis atlet. Tiga pilar yang menjadi fondasi keberhasilan.',
        'is_featured' => false,
        'views' => 398,
    ]
);

echo "3 artikel dummy berhasil dibuat!";
