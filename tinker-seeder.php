$slides = [
    [
        "headline" => "Dedikasi, Disiplin,<br><b>& Pengembangan Berkelanjutan</b>",
        "subheadline" => "TENTANG COACH AGAM",
        "cta_text" => "Lihat Profil",
        "cta_link" => "/profil-coach-agam",
        "image" => null,
        "background" => null,
        "trusted_text" => "Trusted by Over 21 Million Clients",
        "trusted_image_1" => null,
        "trusted_image_2" => null,
        "trusted_image_3" => null
    ]
];

$timelines = [
    ["year" => "2020 - 2023", "title" => "Head Coach - Tim Nasional U-19", "description" => "Membawa tim meraih posisi runner-up pada ajang kejuaraan Asia Tenggara."],
    ["year" => "2018 - 2020", "title" => "Assistant Coach - Klub Liga 1", "description" => "Fokus pada pengembangan taktik pertahanan dan transisi serangan."],
    ["year" => "2015 - 2018", "title" => "Pelatih Akademi Elite", "description" => "Mencetak 5 pemain muda yang kini bermain di liga profesional."]
];

$socials = [
    ["platform" => "Instagram", "link" => "https://instagram.com/coachagam"],
    ["platform" => "LinkedIn", "link" => "https://linkedin.com/in/coachagam"],
    ["platform" => "YouTube", "link" => "https://youtube.com/coachagam"]
];

\App\Models\SiteSetting::updateOrCreate(["key" => "homepage.hero_slides"], ["group" => "homepage", "value" => json_encode($slides), "type" => "json"]);

\App\Models\SiteSetting::updateOrCreate(["key" => "page_profile.headline"], ["group" => "page_profile", "value" => "Membentuk Karakter &<br>Mental Juara di Lapangan Hijau", "type" => "text"]);
\App\Models\SiteSetting::updateOrCreate(["key" => "page_profile.subheadline"], ["group" => "page_profile", "value" => "PROFIL PELATIH", "type" => "text"]);
\App\Models\SiteSetting::updateOrCreate(["key" => "page_profile.description_1"], ["group" => "page_profile", "value" => "Coach Agam adalah pelatih sepakbola profesional dengan lisensi kepelatihan tingkat tinggi. Memulai karir dari bawah, dedikasi dan kecintaannya pada taktik sepakbola modern telah membawanya menukangi berbagai klub elit nasional.", "type" => "text"]);
\App\Models\SiteSetting::updateOrCreate(["key" => "page_profile.description_2"], ["group" => "page_profile", "value" => "Filosofi permainan yang diusungnya adalah penguasaan bola progresif, kedisiplinan tingkat tinggi, dan pembentukan karakter pemain yang tidak mudah menyerah dalam kondisi apapun.", "type" => "text"]);
\App\Models\SiteSetting::updateOrCreate(["key" => "page_profile.timelines"], ["group" => "page_profile", "value" => json_encode($timelines), "type" => "json"]);
\App\Models\SiteSetting::updateOrCreate(["key" => "page_profile.socials"], ["group" => "page_profile", "value" => json_encode($socials), "type" => "json"]);
