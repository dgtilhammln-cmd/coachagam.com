$timelines = [
    ["year" => "17 Mar 2026 - Sekarang", "title" => "Pelatih Fisik", "club_name" => "Garudayaksa FC", "description" => "Menggantikan Widodo Cahyono Putro", "club_logo" => null],
    ["year" => "6 Feb 2026 - 16 Mar 2026", "title" => "Direktur Akademi", "club_name" => "Deltras FC", "description" => "", "club_logo" => null],
    ["year" => "13 Jun 2025 - 25 Mar 2026", "title" => "Pelatih Fisik", "club_name" => "Deltras FC", "description" => "Menggantikan Widodo Cahyono Putro", "club_logo" => null],
    ["year" => "22 Okt 2024 - 31 Mei 2025", "title" => "Pelatih Kepala", "club_name" => "Borneo FC Samarinda U20", "description" => "18 Pertandingan, PPP 1.17", "club_logo" => null],
    ["year" => "1 Jun 2024 - 30 Sep 2024", "title" => "Assisten Pelatih", "club_name" => "PON Jawa Timur", "description" => "", "club_logo" => null],
    ["year" => "18 Sep 2023 - 31 Mar 2024", "title" => "Pelatih Kepala", "club_name" => "Women\'s football", "description" => "", "club_logo" => null],
    ["year" => "13 Jun 2022 - 17 Sep 2023", "title" => "Assisten Pelatih", "club_name" => "Persewar Waropen", "description" => "Assisten Pelatih dari: Eduard Ivakdalam", "club_logo" => null],
    ["year" => "2 Sep 2020 - 31 Des 2021", "title" => "Assisten Pelatih", "club_name" => "Hizbul Wathan FC", "description" => "Assisten Pelatih dari: Herrie Setyawan, Freddy Muli", "club_logo" => null],
    ["year" => "17 Jun 2019 - 27 Nov 2019", "title" => "Pelatih Kepala", "club_name" => "Perspin Pinrang", "description" => "", "club_logo" => null]
];

$infos = [
    ["label" => "Nama Lengkap", "value" => "Ahmad Agam Haris Pambudi"],
    ["label" => "Tanggal lahir / Usia", "value" => "18 Jul 1993 (32)"],
    ["label" => "Tempat kelahiran", "value" => "Lamongan, Jawa Timur"],
    ["label" => "Kewarganegaraan", "value" => "Indonesia"],
    ["label" => "Periode rerata sebagai pelatih", "value" => "0,53 Tahun"],
    ["label" => "Lisensi Kepelatihan", "value" => "Lisensi A - AFC"],
    ["label" => "Formasi yang disukai", "value" => "4-3-3 Attacking"],
    ["label" => "Agen", "value" => "Tidak ada agen"]
];

\App\Models\SiteSetting::updateOrCreate(["key" => "page_profile.timelines"], ["group" => "page_profile", "value" => json_encode($timelines), "type" => "json"]);
\App\Models\SiteSetting::updateOrCreate(["key" => "page_profile.infos"], ["group" => "page_profile", "value" => json_encode($infos), "type" => "json"]);
