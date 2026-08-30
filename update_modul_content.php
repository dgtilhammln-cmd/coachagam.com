<?php

use App\Models\Post;
use Illuminate\Support\Str;

$articles = [
    'filosofi-dan-peran-pelatih' => '
        <h2>1. Pengantar Filosofi Kepelatihan</h2>
        <p>Filosofi kepelatihan adalah fondasi dari setiap keputusan yang diambil oleh seorang pelatih, baik di dalam maupun di luar lapangan. Ini bukan sekadar tentang formasi 4-3-3 atau taktik menekan (pressing), melainkan cerminan dari nilai-nilai inti, keyakinan, dan visi pelatih terhadap sepakbola.</p>
        
        <h3>Membangun Filosofi Sepakbola</h3>
        <ul>
            <li><strong>Gaya Bermain (Playing Style):</strong> Menentukan identitas tim. Apakah Anda lebih menyukai penguasaan bola progresif (possession-based), serangan balik cepat (counter-attacking), atau gaya direct?</li>
            <li><strong>Prinsip Inti:</strong> Apa yang tidak bisa ditawar dalam tim Anda? Misalnya: disiplin tinggi, transisi cepat, atau kerja keras tanpa bola.</li>
            <li><strong>Adaptabilitas:</strong> Filosofi yang baik harus cukup fleksibel untuk disesuaikan dengan materi pemain yang ada.</li>
        </ul>

        <h2>2. Peran Multidimensional Pelatih</h2>
        <p>Di era sepakbola modern, peran pelatih telah jauh melampaui batas-batas lapangan hijau. Seorang pelatih adalah pemimpin yang harus memakai banyak "topi" secara bersamaan.</p>
        
        <h3>A. Sebagai Pemimpin (Leader) & Manajer</h3>
        <p>Pelatih bertugas menyatukan berbagai individu dengan ego dan latar belakang berbeda menuju satu tujuan bersama. Kepemimpinan yang kuat membutuhkan empati, ketegasan, dan kemampuan komunikasi yang luar biasa.</p>
        
        <h3>B. Sebagai Pendidik (Educator)</h3>
        <p>Terutama pada tingkat akar rumput (grassroots) dan pengembangan usia muda, pelatih adalah seorang guru. Tugas utamanya adalah mengajarkan pemahaman taktis dan keterampilan teknis dengan metode pedagogi yang tepat.</p>
        
        <h3>C. Sebagai Psikolog Praktis</h3>
        <p>Pelatih harus memahami aspek psikologis pemain. Bagaimana membangkitkan motivasi pemain yang sedang turun performanya? Bagaimana mengatasi kecemasan sebelum pertandingan besar? Ini membutuhkan kecerdasan emosional (EQ) yang tinggi.</p>

        <h2>3. Etika dan Kode Etik Kepelatihan</h2>
        <p>Pelatih adalah *role model*. Perilaku pelatih di pinggir lapangan akan dicontoh oleh pemain dan dinilai oleh publik. Menghormati wasit, staf lawan, dan menjunjung tinggi *fair play* adalah nilai mutlak yang harus tertanam dalam filosofi pelatih profesional.</p>
    ',

    'karakteristik-dan-kebutuhan-pemain' => '
        <h2>1. Pemahaman Individu dalam Tim</h2>
        <p>Sebuah tim sepakbola terdiri dari individu-individu dengan karakteristik unik. Pelatih yang sukses adalah mereka yang tidak memaksakan satu pendekatan untuk semua pemain (one-size-fits-all), melainkan mampu menyesuaikan pendekatannya dengan kebutuhan spesifik masing-masing individu.</p>
        
        <h2>2. Klasifikasi Karakteristik Pemain</h2>
        <p>Untuk memahami pemain, pelatih harus menganalisis mereka dari empat dimensi utama (Model 4 Corner):</p>
        
        <h3>A. Dimensi Fisik (Physical)</h3>
        <ul>
            <li><strong>Pemain Bertipe Kuat/Fisikal:</strong> Membutuhkan latihan pemeliharaan kekuatan dan pencegahan cedera akibat benturan.</li>
            <li><strong>Pemain Bertipe Cepat/Eksplosif:</strong> Membutuhkan manajemen beban latihan (load management) yang ketat untuk mencegah cedera otot hamstring.</li>
            <li><strong>Daya Tahan (Endurance):</strong> Kapasitas VO2Max yang berbeda menuntut penyesuaian volume latihan lari.</li>
        </ul>

        <h3>B. Dimensi Teknis (Technical)</h3>
        <p>Kebutuhan teknis bervariasi sesuai posisi. Seorang bek tengah membutuhkan penguasaan teknik *heading* dan *tackling* yang presisi, sementara seorang gelandang serang membutuhkan *first touch* yang sempurna dan visi *passing* di ruang sempit.</p>

        <h3>C. Dimensi Taktikal (Tactical)</h3>
        <p>Beberapa pemain memiliki *game intelligence* yang luar biasa dan mampu memahami instruksi taktis kompleks dengan cepat. Pemain lain mungkin membutuhkan instruksi yang lebih sederhana dan spesifik (task-oriented). Pelatih harus mengenali gaya belajar kognitif setiap pemain.</p>

        <h3>D. Dimensi Psikologis dan Mental (Psychological)</h3>
        <ul>
            <li><strong>Introvert vs Ekstrovert:</strong> Pemain introvert mungkin lebih merespons kritik empat mata di ruangan tertutup, sementara pemain ekstrovert mungkin tidak masalah dikritik secara konstruktif di depan tim.</li>
            <li><strong>Manajemen Tekanan:</strong> Beberapa pemain berkembang di bawah tekanan tinggi, sementara yang lain membutuhkan ketenangan dan afirmasi positif untuk tampil optimal.</li>
        </ul>

        <h2>3. Pendekatan Berbasis Usia (Age-Specific Needs)</h2>
        <p>Kebutuhan pemain sangat dipengaruhi oleh fase perkembangan biologis dan psikologis mereka:</p>
        <ul>
            <li><strong>Fase Usia Dini (6-12 tahun):</strong> Fokus utama adalah kegembiraan (fun), kebebasan berekspresi, dan penguasaan teknik dasar. Hasil pertandingan tidak boleh menjadi prioritas.</li>
            <li><strong>Fase Remaja (13-17 tahun):</strong> Masa pertumbuhan (growth spurt). Pemahaman taktis mulai diperkenalkan lebih dalam. Sangat rentan terhadap masalah mental dan cedera fisik (seperti Osgood-Schlatter).</li>
            <li><strong>Fase Senior (18+ tahun):</strong> Fokus pada optimalisasi performa (performance-oriented), hasil pertandingan, penyempurnaan detail taktik, dan manajemen karir.</li>
        </ul>
    ',

    'prinsip-dasar-kepelatihan-sepakbola' => '
        <h2>1. Pengantar Prinsip Sepakbola</h2>
        <p>Prinsip sepakbola adalah hukum-hukum fundamental yang berlaku terlepas dari formasi apa yang digunakan (baik itu 4-3-3, 3-5-2, atau 4-4-2). Pemahaman akan prinsip ini membantu tim merespons berbagai situasi di lapangan secara seragam.</p>
        
        <h2>2. Prinsip Menyerang (Attacking Principles)</h2>
        <p>Tujuan utama menyerang adalah menciptakan peluang dan mencetak gol, dengan tetap meminimalkan risiko terkena serangan balik.</p>
        <ul>
            <li><strong>Penetrasi (Penetration):</strong> Upaya mematahkan garis pertahanan lawan melalui umpan terobosan (through pass), dribbling membelah pertahanan, atau tembakan jarak jauh.</li>
            <li><strong>Dukungan (Support):</strong> Memberikan opsi passing (sudut dan jarak yang tepat) bagi pemain yang sedang menguasai bola. Tanpa support, penetrasi tidak mungkin terjadi.</li>
            <li><strong>Lebar Lapangan (Width):</strong> Merentangkan formasi lawan ke sisi sayap lapangan untuk menciptakan ruang di area tengah (poros).</li>
            <li><strong>Mobilitas (Mobility):</strong> Pergerakan tanpa bola (off-the-ball movement) yang dinamis untuk menarik pemain lawan keluar dari posisinya dan merusak struktur pertahanan mereka.</li>
            <li><strong>Kreativitas & Improvisasi:</strong> Penggunaan skill individu tingkat tinggi di sepertiga akhir lapangan untuk menembus pertahanan rapat (deep block).</li>
        </ul>

        <h2>3. Prinsip Bertahan (Defending Principles)</h2>
        <p>Fokus utama bertahan adalah memutus aliran serangan lawan, melindungi area gawang, dan merebut kembali penguasaan bola.</p>
        <ul>
            <li><strong>Menunda Serangan (Delay):</strong> Tindakan orang pertama (first defender) yang menekan pembawa bola agar serangan lawan melambat, memberi waktu bagi tim untuk membentuk struktur pertahanan.</li>
            <li><strong>Kerapatan (Compactness):</strong> Mempersempit jarak antar pemain dan antar lini (vertikal dan horizontal) agar lawan tidak memiliki ruang untuk melakukan umpan daerah (through pass).</li>
            <li><strong>Perlindungan (Cover):</strong> Penempatan posisi pemain kedua (second defender) di belakang pemain pertama untuk mengantisipasi jika pemain pertama berhasil dilewati lawan.</li>
            <li><strong>Keseimbangan (Balance):</strong> Menjaga bentuk formasi di area yang jauh dari bola (weak side) agar tidak mudah dieksploitasi jika lawan melakukan perpindahan arah serangan (switch play).</li>
        </ul>

        <h2>4. Fase Transisi (Transition)</h2>
        <p>Di sepakbola modern, momen paling krusial adalah saat bola berpindah penguasaan.</p>
        <ul>
            <li><strong>Transisi Positif (Bertahan ke Menyerang):</strong> Bereaksi secepat mungkin setelah merebut bola. Pilihannya: melakukan counter-attack cepat ke depan, atau mengamankan penguasaan bola terlebih dahulu.</li>
            <li><strong>Transisi Negatif (Menyerang ke Bertahan):</strong> Respon langsung setelah kehilangan bola. Pilihannya: melakukan pressing tinggi seketika (Gegenpressing), atau segera mundur membentuk blok pertahanan (drop deep).</li>
        </ul>
    ',

    'coaching-behavior-dan-komunikasi' => '
        <h2>1. Pentingnya Perilaku Pelatih (Coaching Behavior)</h2>
        <p>Apa yang pelatih lakukan di pinggir lapangan dan saat sesi latihan jauh lebih berbicara daripada apa yang ia katakan. Perilaku pelatih membentuk budaya tim, mempengaruhi tingkat stres pemain, dan menentukan kualitas penyerapan materi latihan.</p>
        
        <h2>2. Gaya Kepelatihan (Coaching Styles)</h2>
        <p>Pelatih yang adaptif tidak hanya berpegang pada satu gaya. Mereka menyesuaikan gaya kepemimpinan dengan situasi yang dihadapi:</p>
        <ul>
            <li><strong>Otokratis (Command Style):</strong> Pelatih membuat semua keputusan. Sangat efektif digunakan saat situasi genting di pertandingan, atau ketika memberikan instruksi teknis yang sangat spesifik dan berkaitan dengan keamanan/keselamatan. Namun, jika digunakan terus-menerus, ini akan mematikan kreativitas dan inisiatif pemain.</li>
            <li><strong>Demokratis (Co-operative Style):</strong> Melibatkan pemain dalam pengambilan keputusan (misalnya membahas taktik atau peraturan tim). Gaya ini membangun rasa memiliki (ownership) yang kuat pada pemain senior.</li>
            <li><strong>Laissez-Faire (Submissive Style):</strong> Pelatih memberikan kebebasan penuh kepada pemain. Sangat berguna dalam fase permainan bebas (free play) saat latihan untuk mendorong ekspresi dan observasi natural, namun buruk jika tim butuh arahan struktural.</li>
        </ul>

        <h2>3. Teknik Komunikasi Efektif</h2>
        <p>Komunikasi adalah kunci mentransfer visi pelatih ke kepala para pemain.</p>
        
        <h3>A. Verbal dan Non-Verbal</h3>
        <p>Bahasa tubuh (postur, kontak mata, ekspresi wajah) menyumbang porsi terbesar dalam komunikasi. Pelatih yang berdiri tegak dengan sikap terbuka memancarkan kepercayaan diri. Nada suara (intonasi) harus bervariasi: tenang saat menjelaskan taktik, dan penuh energi saat memotivasi.</p>
        
        <h3>B. Seni Memberikan Umpan Balik (Feedback)</h3>
        <ul>
            <li><strong>Metode Sandwich:</strong> Mulai dengan pujian spesifik -> Berikan koreksi yang diperlukan -> Tutup dengan kalimat motivasi positif.</li>
            <li><strong>Guided Discovery (Penemuan Terbimbing):</strong> Alih-alih berteriak "Umpan ke kanan!", cobalah bertanya "Di mana ruang kosong yang bisa kamu manfaatkan tadi?". Ini melatih kemampuan pengambilan keputusan (*decision making*) pemain.</li>
            <li><strong>Waktu yang Tepat (Timing):</strong> Jangan menghentikan latihan (*freeze*) terlalu sering. Berikan instruksi sambil latihan berjalan (coaching in the flow) kecuali ada kesalahan prinsipil yang berulang.</li>
        </ul>

        <h2>4. Mendengarkan Aktif (Active Listening)</h2>
        <p>Pelatih hebat adalah pendengar yang baik. Mereka memperhatikan keluhan pemain, membaca bahasa tubuh yang menunjukkan kelelahan atau frustrasi, dan meresponsnya dengan empati.</p>
    ',

    'pelatih-dasar-sports-science' => '
        <h2>1. Mengapa Pelatih Butuh Sports Science?</h2>
        <p>Sepakbola modern ditandai dengan intensitas yang sangat tinggi. Perbedaan antara kemenangan dan kekalahan seringkali ditentukan oleh detail kecil pada menit ke-89. Pengetahuan dasar *Sports Science* (Ilmu Keolahragaan) memungkinkan pelatih merancang program yang mengoptimalkan fisik pemain tanpa mengorbankan kesehatan mereka.</p>
        
        <h2>2. Fisiologi dan Sistem Energi</h2>
        <p>Sepakbola adalah olahraga olahraga interval (berhenti-jalan) yang menggunakan berbagai sistem energi tubuh:</p>
        <ul>
            <li><strong>Sistem Aerobik:</strong> Menyediakan energi untuk lari santai (jogging) dan daya tahan dasar (stamina) sepanjang 90 menit. Dilatih dengan lari jarak jauh atau *Small Sided Games* (SSG) durasi panjang.</li>
            <li><strong>Sistem Anaerobik Alaktik (ATP-PC):</strong> Energi instan untuk sprint pendek intensitas maksimal (1-10 detik), seperti saat mengejar bola terobosan. Membutuhkan waktu istirahat yang cukup antar set untuk pemulihan optimal.</li>
            <li><strong>Sistem Anaerobik Laktat:</strong> Energi untuk aksi intensitas tinggi berulang (10-60 detik) yang menghasilkan asam laktat (rasa pegal/terbakar di otot).</li>
        </ul>
        <p>Pelatih harus memadukan latihan teknik dengan beban fisik yang tepat (misalnya: latihan pressing intens menggunakan sistem anaerobik).</p>

        <h2>3. Nutrisi dan Hidrasi</h2>
        <p>Pelatih harus mengedukasi pemain mengenai bahan bakar tubuh:</p>
        <ul>
            <li><strong>Karbohidrat:</strong> Sumber energi utama. Pemain butuh asupan tinggi karbohidrat (pasta, nasi, roti) 1-2 hari sebelum hari pertandingan (carbo-loading).</li>
            <li><strong>Protein:</strong> Esensial untuk perbaikan serat otot yang rusak setelah latihan keras atau pertandingan (ayam, ikan, telur, susu).</li>
            <li><strong>Hidrasi:</strong> Kehilangan cairan 2% dari berat badan bisa menurunkan performa fisik dan kognitif hingga 20%. Pemain wajib minum sebelum merasa haus.</li>
        </ul>

        <h2>4. Pencegahan Cedera (Injury Prevention)</h2>
        <p>Tugas utama pelatih kebugaran adalah menjaga pemain tetap tersedia untuk dipilih (available).</p>
        <ul>
            <li><strong>Pemanasan Dinamis (Dynamic Warm-up):</strong> Menggantikan peregangan statis jadul. Fokus pada mobilitas sendi, aktivasi otot *core*, dan protokol FIFA 11+ terbukti secara sains mengurangi risiko cedera ACL dan hamstring secara signifikan.</li>
            <li><strong>Monitoring Beban (Load Monitoring):</strong> Mengawasi intensitas latihan pemain melalui *Rate of Perceived Exertion* (RPE) harian atau teknologi GPS tracker untuk mencegah *Overtraining Syndrome*.</li>
        </ul>

        <h2>5. Recovery (Pemulihan)</h2>
        <p>Adaptasi fisik (peningkatan kebugaran) tidak terjadi saat latihan, melainkan **saat masa istirahat**. Protokol pemulihan pasca-tanding yang efektif meliputi tidur berkualitas (8-10 jam), *ice bath* (cryotherapy), *active recovery* (bersepeda statis), dan asupan nutrisi jendela 30-60 menit pasca-pertandingan.</p>
    ',

    'perencanaan-program-latihan' => '
        <h2>1. Konsep Periodisasi</h2>
        <p>Perencanaan program latihan (periodisasi) adalah seni dan sains dalam membagi waktu latihan ke dalam fase-fase spesifik (siklus) dengan tujuan memanipulasi beban (volume dan intensitas) agar tim mencapai *peak performance* (performa puncak) pada waktu yang tepat (hari pertandingan kompetisi).</p>
        
        <h2>2. Struktur Siklus Latihan</h2>
        <p>Periodisasi disusun dalam tiga tingkatan waktu:</p>
        <ul>
            <li><strong>Makrosiklus (Macrocycle):</strong> Rencana jangka panjang (biasanya 1 musim penuh atau 1 tahun). Terdiri dari fase Persiapan (Pre-season), fase Kompetisi (In-season), dan fase Transisi (Off-season).</li>
            <li><strong>Mesosiklus (Mesocycle):</strong> Rencana jangka menengah (biasanya 3-6 minggu). Memiliki target spesifik, misalnya: "Mesosiklus Blok 1 fokus pada peningkatan kapasitas aerobik dasar dan pemahaman prinsip bertahan area (zonal marking)."</li>
            <li><strong>Mikrosiklus (Microcycle):</strong> Rencana harian dalam kurun waktu 1 minggu (7 hari). Ini adalah rencana operasional yang paling detail, mengatur persis apa yang dilakukan tim dari Senin hingga Minggu menjelang *Matchday*.</li>
        </ul>

        <h2>3. Tactical Periodization (Periodisasi Taktikal)</h2>
        <p>Dipopulerkan oleh pelatih asal Portugal (seperti Jose Mourinho), metodologi ini menolak pemisahan antara latihan fisik, teknik, dan taktik. Semua aspek latihan **harus** berpusat pada Modul Taktikal (Game Model) tim.</p>
        <p>Misalnya, jika tim ingin bermain menekan di area lawan (high pressing), kapasitas fisik (anaerobik) dilatih melalui simulasi taktis ruang sempit, bukan dengan berlari mengelilingi lapangan tanpa bola.</p>

        <h2>4. Komponen Sesi Latihan (Session Plan)</h2>
        <p>Setiap sesi harian wajib memiliki struktur baku:</p>
        <ol>
            <li><strong>Warm-up (Pemanasan):</strong> Aktivasi suhu tubuh dan sendi, disisipkan elemen kognitif (misal: rondo ringan). Durasi: 15-20 menit.</li>
            <li><strong>Main Theme (Materi Inti):</strong> Fase latihan terstruktur (drill teknikal menuju taktikal) dan Small Sided Games (SSG) yang intensitasnya disesuaikan dengan topik hari itu. Durasi: 50-70 menit.</li>
            <li><strong>Match Condition:</strong> Bermain 11v11 atau di area besar untuk mengaplikasikan topik latihan dalam situasi nyata. Durasi: 20-30 menit.</li>
            <li><strong>Cool-down (Pendinginan):</strong> Peregangan statis ringan dan *briefing* evaluasi singkat. Durasi: 10 menit.</li>
        </ol>

        <h2>5. Manajemen Beban Mingguan (Tapering)</h2>
        <p>Pelatih harus mengatur "ombak" intensitas. Puncak latihan berat (High Intensity) biasanya berada di tengah minggu (Matchday -4 atau -3). Menjelang hari pertandingan (Matchday -1), beban dan volume harus diturunkan secara drastis (Tapering) agar pemain merasa segar dan bertenaga penuh (fresh) saat bertanding.</p>
    ',

    'proses-melatih-sebelum-latihan-saat-latihan-setelah-latihan' => '
        <h2>1. Siklus Kepelatihan Paripurna</h2>
        <p>Kepelatihan bukan hanya tentang apa yang diteriakkan pelatih selama 90 menit di lapangan. Ini adalah sebuah siklus panjang yang menuntut persiapan matang, eksekusi presisi, dan evaluasi mendalam.</p>
        
        <h2>2. Fase SEBELUM Latihan (Preparation)</h2>
        <p>Persiapan yang buruk adalah persiapan untuk gagal. Langkah-langkah krusial sebelum peluit dibunyikan:</p>
        <ul>
            <li><strong>Menentukan Tujuan (Objective):</strong> Apa fokus utama hari ini? (Contoh: "Meningkatkan kemampuan penetrasi melalui sayap kanan").</li>
            <li><strong>Membuat Rencana Sesi (Session Plan):</strong> Mencatat detail durasi, ukuran lapangan, jumlah pemain, batasan sentuhan (rules/constraints), dan intensitas (work:rest ratio).</li>
            <li><strong>Menyiapkan Peralatan (Equipment):</strong> Memastikan bola cukup dan dipompa dengan benar, cone (kun), rompi (bibs) warna-warni sudah tersusun rapi di lapangan **sebelum** pemain tiba.</li>
            <li><strong>Briefing Staf:</strong> Berdiskusi dengan asisten pelatih dan pelatih fisik mengenai peran masing-masing selama sesi.</li>
        </ul>

        <h2>3. Fase SAAT Latihan (Execution)</h2>
        <p>Fase di mana rencana diterjemahkan menjadi tindakan nyata.</p>
        <ul>
            <li><strong>Ice Breaking & Pengarahan (Briefing):</strong> Mengumpulkan pemain (dalam formasi setengah lingkaran), sampaikan tujuan latihan hari itu dengan singkat dan padat (maksimal 2 menit).</li>
            <li><strong>Observasi & Fasilitasi:</strong> Pelatih mundur selangkah (step back) untuk mengamati pergerakan makro. Biarkan permainan mengalir. Jangan terlalu sering meniup peluit jika tidak darurat.</li>
            <li><strong>Intervensi (Coaching Points):</strong> Jika terjadi kesalahan prinsipil secara berulang, bekukan latihan (*freeze!*). Tunjukkan posisi yang salah, tunjukkan posisi yang benar, peragakan (rehearse), lalu lanjutkan (*play!*).</li>
            <li><strong>Manajemen Dinamika:</strong> Menjaga tempo latihan tetap tinggi, menyemangati pemain yang lesu, dan menenangkan pemain yang terlalu emosional.</li>
        </ul>

        <h2>4. Fase SETELAH Latihan (Evaluation & Recovery)</h2>
        <p>Latihan tidak selesai saat bola terakhir ditendang.</p>
        <ul>
            <li><strong>Debriefing Singkat:</strong> Sembari pemain melakukan peregangan statis (cooling down), pelatih merangkum esensi latihan hari itu. Ucapkan terima kasih atas usaha mereka.</li>
            <li><strong>Recovery Fisik:</strong> Memastikan pemain mengonsumsi suplemen/nutrisi pasca latihan atau menuju fasilitas *ice bath* jika diperlukan.</li>
            <li><strong>Evaluasi Staf (Post-Mortem):</strong> Duduk bersama staf pelatih. Apakah tujuan tercapai? Apakah area latihan terlalu sempit? Pemain mana yang menonjol dan mana yang butuh perhatian ekstra besok? Evaluasi ini menjadi dasar untuk merencanakan latihan berikutnya.</li>
        </ul>
    ',

    'refleksi-dan-evaluasi' => '
        <h2>1. Signifikansi Refleksi Diri</h2>
        <p>Pengalaman selama 20 tahun melatih tidak akan ada gunanya jika pelatih mengulangi kesalahan yang sama setiap tahunnya. Refleksi dan evaluasi adalah motor penggerak perbaikan berkelanjutan (continuous improvement). Pelatih hebat selalu memiliki kerendahan hati untuk mengakui bahwa pendekatan mereka mungkin tidak selalu sempurna.</p>
        
        <h2>2. Evaluasi Sesi Latihan (Self-Reflection)</h2>
        <p>Setelah selesai memimpin latihan, seorang pelatih profesional wajib meluangkan waktu 10-15 menit untuk merefleksikan proses pedagoginya:</p>
        <ul>
            <li><strong>Keselarasan Tujuan:</strong> Apakah aktivitas yang dirancang benar-benar mencapai target pembelajaran yang ditetapkan sebelumnya?</li>
            <li><strong>Rasio Berbicara vs Bermain:</strong> Apakah saya terlalu banyak bicara hari ini? (Jika pemain berdiri terlalu lama mendengarkan instruksi, detak jantung mereka akan turun dan latihan menjadi tidak efisien).</li>
            <li><strong>Ketepatan Intervensi:</strong> Apakah *coaching points* yang saya berikan sudah jelas, ringkas, dan tepat sasaran? Apakah bahasa tubuh saya menunjukkan energi positif?</li>
        </ul>

        <h2>3. Evaluasi Pertandingan (Match Analysis)</h2>
        <p>Emosi sesaat pasca-pertandingan (baik saat menang besar maupun kalah telak) seringkali mengaburkan penilaian objektif. Proses evaluasi yang benar melibatkan data dan objektivitas.</p>
        <ul>
            <li><strong>Analisis Video (Video Review):</strong> Menonton ulang pertandingan dengan pikiran tenang keesokan harinya. Memotong momen-momen kunci (baik positif maupun negatif) untuk dipertontonkan kepada tim dalam sesi analisis taktik kelas.</li>
            <li><strong>Analisis Data & Statistik:</strong> Menggunakan data seperti *Expected Goals* (xG), jumlah *key passes*, duel udara yang dimenangkan, hingga jarak tempuh berlari pemain. Data ini melengkapi pengamatan mata (eye-test).</li>
            <li><strong>Evaluasi Game Model:</strong> Menilai apakah implementasi taktik dan filosofi tim berjalan di lapangan, tanpa terdistraksi sepenuhnya oleh hasil akhir (skor). Kadang tim bermain luar biasa sesuai rencana, namun kalah karena ketidakberuntungan (margin error kecil).</li>
        </ul>

        <h2>4. Umpan Balik dari Pemain (Player Feedback)</h2>
        <p>Evaluasi tidak hanya berjalan top-down (dari pelatih ke pemain), tapi juga bottom-up. Membuka saluran komunikasi (misalnya melalui kuesioner anonim atau pertemuan empat mata kapten tim) untuk mengetahui apa yang dirasakan pemain tentang intensitas latihan, kejelasan instruksi, dan suasana ruang ganti. Pemain yang merasa suaranya didengar akan memberikan komitmen ekstra di lapangan.</p>
    '
];

foreach ($articles as $slug => $htmlBody) {
    $post = Post::where('slug', $slug)->first();
    if ($post) {
        $post->body = $htmlBody;
        $post->excerpt = Str::limit(strip_tags($htmlBody), 180);
        
        // Add a placeholder featured image based on category if missing
        if (empty($post->featured_image)) {
            // we leave it empty, or we could set a default
        }
        
        $post->save();
        echo "Updated: {$slug}\n";
    }
}
echo "Full articles content updated successfully!\n";
