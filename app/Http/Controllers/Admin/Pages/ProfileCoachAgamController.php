<?php

namespace App\Http\Controllers\Admin\Pages;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use App\Services\ImageProcessor;
use Illuminate\Http\Request;

class ProfileCoachAgamController extends Controller
{
    /** Tampilkan form pengaturan Profile Coach Agam */
    public function index()
    {
        // Ambil semua setting group page_profile
        $settings = SiteSetting::where('group', 'page_profile')
            ->orderBy('id')
            ->get()
            ->keyBy('key');

        $timelines      = json_decode($settings['page_profile.timelines']->value ?? '[]', true);
        $socials        = json_decode($settings['page_profile.socials']->value ?? '[]', true);
        $infos          = json_decode($settings['page_profile.infos']->value ?? '[]', true);
        $educations     = json_decode($settings['page_profile.educations']->value ?? '[]', true);
        $certifications = json_decode($settings['page_profile.certifications']->value ?? '[]', true);
        $organizations  = json_decode($settings['page_profile.organizations']->value ?? '[]', true);
        $achievements   = json_decode($settings['page_profile.achievements']->value ?? '[]', true);

        return view('admin.pages.profile', compact(
            'settings', 'timelines', 'socials', 'infos',
            'educations', 'certifications', 'organizations', 'achievements'
        ));
    }

    /** Simpan pengaturan Profile Coach Agam */
    public function update(Request $request)
    {
        $request->validate([
            'timelines' => 'nullable|array',
            'socials'   => 'nullable|array',
        ]);

        $group = 'page_profile';

        // 1. Simpan Text Fields
        $textKeys = [
            'page_profile.name',
            'page_profile.job_title',
            'page_profile.headline',
            'page_profile.subheadline',
            'page_profile.description_1',
            'page_profile.description_2',
            'page_profile.meta_title',
            'page_profile.meta_description',
            'page_profile.tm_link',
        ];

        foreach ($textKeys as $key) {
            $parts = explode('.', $key, 2);
            $value = $request->input($key) ?? $request->input($parts[0] . '_' . $parts[1]);
            
            if ($value !== null) {
                SiteSetting::updateOrCreate(
                    ['key' => $key],
                    ['group' => $group, 'value' => $value, 'type' => 'text']
                );
            }
        }

        // 2. Simpan Foto Profil
        if ($request->hasFile('page_profile_image')) {
            $path = ImageProcessor::processAndStore($request->file('page_profile_image'), 'profile');
            SiteSetting::updateOrCreate(
                ['key' => 'page_profile.image'],
                ['group' => $group, 'value' => $path, 'type' => 'text']
            );
        }

        // Handle hapus foto profil
        if ($request->input('remove_profile_image') == '1') {
            SiteSetting::updateOrCreate(
                ['key' => 'page_profile.image'],
                ['group' => $group, 'value' => null, 'type' => 'text']
            );
        }

        // Simpan TM Logo
        if ($request->hasFile('page_profile_tm_logo')) {
            $path = ImageProcessor::processAndStore($request->file('page_profile_tm_logo'), 'profile');
            SiteSetting::updateOrCreate(
                ['key' => 'page_profile.tm_logo'],
                ['group' => $group, 'value' => $path, 'type' => 'text']
            );
        }

        // Handle hapus TM logo
        if ($request->input('remove_tm_logo') == '1') {
            SiteSetting::updateOrCreate(
                ['key' => 'page_profile.tm_logo'],
                ['group' => $group, 'value' => null, 'type' => 'text']
            );
        }

        // 3. Simpan Timelines (JSON)
        $timelines = [];
        $existingTimelines = json_decode(SiteSetting::where('key', 'page_profile.timelines')->value('value') ?? '[]', true);
        $inputTimelines = $request->input('timelines', []);
        
        foreach ($inputTimelines as $index => $tl) {
            if (!empty($tl['year']) && !empty($tl['title'])) {
                // Retain old logo
                $tl['club_logo'] = $existingTimelines[$index]['club_logo'] ?? null;
                
                // Handle new logo upload
                if ($request->hasFile("timelines.{$index}.club_logo")) {
                    $tl['club_logo'] = ImageProcessor::processAndStore($request->file("timelines.{$index}.club_logo"), 'profile');
                }
                
                // Handle remove logo
                if (isset($tl['remove_club_logo']) && $tl['remove_club_logo'] == '1') {
                    $tl['club_logo'] = null;
                }
                unset($tl['remove_club_logo']);
                
                $timelines[] = $tl;
            }
        }
        SiteSetting::updateOrCreate(
            ['key' => 'page_profile.timelines'],
            ['group' => $group, 'value' => json_encode($timelines, JSON_UNESCAPED_UNICODE), 'type' => 'json']
        );

        // 4. Simpan Socials (JSON)
        $socials = [];
        $inputSocials = $request->input('socials', []);
        foreach ($inputSocials as $soc) {
            if (!empty($soc['platform']) && !empty($soc['link'])) {
                $socials[] = $soc;
            }
        }
        SiteSetting::updateOrCreate(
            ['key' => 'page_profile.socials'],
            ['group' => $group, 'value' => json_encode($socials, JSON_UNESCAPED_UNICODE), 'type' => 'json']
        );

        // 5. Simpan Info Pribadi (JSON)
        $infos = [];
        $inputInfos = $request->input('infos', []);
        foreach ($inputInfos as $inf) {
            if (!empty($inf['label']) && !empty($inf['value'])) {
                $infos[] = $inf;
            }
        }
        SiteSetting::updateOrCreate(
            ['key' => 'page_profile.infos'],
            ['group' => $group, 'value' => json_encode($infos, JSON_UNESCAPED_UNICODE), 'type' => 'json']
        );

        // 7. Simpan Riwayat Lainnya (JSON)
        $jsonKeys = ['educations', 'certifications', 'organizations', 'achievements'];
        foreach ($jsonKeys as $jkey) {
            $data = [];
            $existingData = json_decode(SiteSetting::where('key', 'page_profile.' . $jkey)->value('value') ?? '[]', true);
            $inputData = $request->input($jkey, []);
            
            foreach ($inputData as $index => $item) {
                if (!empty($item['year']) || !empty($item['title']) || !empty($item['institution']) || !empty($item['organization'])) {
                    // Retain old logo if it exists
                    $item['logo'] = $existingData[$index]['logo'] ?? null;
                    
                    // Handle new logo upload
                    if ($request->hasFile("{$jkey}.{$index}.logo")) {
                        $item['logo'] = ImageProcessor::processAndStore($request->file("{$jkey}.{$index}.logo"), 'profile');
                    }
                    
                    // Handle remove logo
                    if (isset($item['remove_logo']) && $item['remove_logo'] == '1') {
                        $item['logo'] = null;
                    }
                    unset($item['remove_logo']);
                    
                    $data[] = $item;
                }
            }
            SiteSetting::updateOrCreate(
                ['key' => 'page_profile.' . $jkey],
                ['group' => $group, 'value' => json_encode($data, JSON_UNESCAPED_UNICODE), 'type' => 'json']
            );
        }

        // 6. Simpan Breadcrumb Image
        if ($request->hasFile('breadcrumb_image')) {
            $imagePath = ImageProcessor::processAndStore($request->file('breadcrumb_image'), 'pages');
            SiteSetting::updateOrCreate(
                ['key' => 'page_profile.breadcrumb_image'],
                ['value' => $imagePath, 'group' => $group, 'type' => 'image']
            );
        }

        return redirect()->route('admin.pages.profile')
            ->with('success', 'Pengaturan Profile Coach Agam berhasil disimpan!');
    }

    public function addTimeline()
    {
        $existing = json_decode(SiteSetting::where('key', 'page_profile.timelines')->value('value') ?? '[]', true);
        $existing[] = ['year' => 'Tahun', 'title' => 'Posisi', 'club_name' => 'Nama Klub', 'description' => '', 'club_logo' => null];
        SiteSetting::updateOrCreate(
            ['key' => 'page_profile.timelines'],
            ['group' => 'page_profile', 'value' => json_encode($existing, JSON_UNESCAPED_UNICODE), 'type' => 'json']
        );
        return back()->with('success', 'Timeline baru ditambahkan.');
    }

    public function deleteTimeline($index)
    {
        $existing = json_decode(SiteSetting::where('key', 'page_profile.timelines')->value('value') ?? '[]', true);
        if (isset($existing[$index])) {
            array_splice($existing, $index, 1);
            SiteSetting::updateOrCreate(
                ['key' => 'page_profile.timelines'],
                ['group' => 'page_profile', 'value' => json_encode($existing, JSON_UNESCAPED_UNICODE), 'type' => 'json']
            );
        }
        return back()->with('success', 'Timeline dihapus.');
    }

    public function addSocial()
    {
        $existing = json_decode(SiteSetting::where('key', 'page_profile.socials')->value('value') ?? '[]', true);
        $existing[] = ['platform' => 'Instagram', 'link' => 'https://'];
        SiteSetting::updateOrCreate(
            ['key' => 'page_profile.socials'],
            ['group' => 'page_profile', 'value' => json_encode($existing, JSON_UNESCAPED_UNICODE), 'type' => 'json']
        );
        return back()->with('success', 'Sosial media baru ditambahkan.');
    }

    public function deleteSocial($index)
    {
        $existing = json_decode(SiteSetting::where('key', 'page_profile.socials')->value('value') ?? '[]', true);
        if (isset($existing[$index])) {
            array_splice($existing, $index, 1);
            SiteSetting::updateOrCreate(
                ['key' => 'page_profile.socials'],
                ['group' => 'page_profile', 'value' => json_encode($existing, JSON_UNESCAPED_UNICODE), 'type' => 'json']
            );
        }
        return back()->with('success', 'Sosial media dihapus.');
    }

    public function addInfo()
    {
        $existing = json_decode(SiteSetting::where('key', 'page_profile.infos')->value('value') ?? '[]', true);
        $existing[] = ['label' => 'Label Data', 'value' => 'Nilai Data'];
        SiteSetting::updateOrCreate(
            ['key' => 'page_profile.infos'],
            ['group' => 'page_profile', 'value' => json_encode($existing, JSON_UNESCAPED_UNICODE), 'type' => 'json']
        );
        return back()->with('success', 'Info pribadi baru ditambahkan.');
    }

    public function deleteInfo($index)
    {
        $existing = json_decode(SiteSetting::where('key', 'page_profile.infos')->value('value') ?? '[]', true);
        if (isset($existing[$index])) {
            array_splice($existing, $index, 1);
            SiteSetting::updateOrCreate(
                ['key' => 'page_profile.infos'],
                ['group' => 'page_profile', 'value' => json_encode($existing, JSON_UNESCAPED_UNICODE), 'type' => 'json']
            );
        }
        return back()->with('success', 'Info pribadi dihapus.');
    }

    // Add/Delete helper for new arrays
    private function addArrayItem($key, $defaultItem, $message)
    {
        $existing = json_decode(SiteSetting::where('key', $key)->value('value') ?? '[]', true);
        $existing[] = $defaultItem;
        SiteSetting::updateOrCreate(
            ['key' => $key],
            ['group' => 'page_profile', 'value' => json_encode($existing, JSON_UNESCAPED_UNICODE), 'type' => 'json']
        );
        return back()->with('success', $message);
    }

    private function deleteArrayItem($key, $index, $message)
    {
        $existing = json_decode(SiteSetting::where('key', $key)->value('value') ?? '[]', true);
        if (isset($existing[$index])) {
            array_splice($existing, $index, 1);
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['group' => 'page_profile', 'value' => json_encode($existing, JSON_UNESCAPED_UNICODE), 'type' => 'json']
            );
        }
        return back()->with('success', $message);
    }

    public function addEducation() { return $this->addArrayItem('page_profile.educations', ['year' => '', 'institution' => '', 'degree' => ''], 'Pendidikan baru ditambahkan.'); }
    public function deleteEducation($index) { return $this->deleteArrayItem('page_profile.educations', $index, 'Pendidikan dihapus.'); }

    public function addCertification() { return $this->addArrayItem('page_profile.certifications', ['year' => '', 'title' => ''], 'Sertifikasi baru ditambahkan.'); }
    public function deleteCertification($index) { return $this->deleteArrayItem('page_profile.certifications', $index, 'Sertifikasi dihapus.'); }

    public function addOrganization() { return $this->addArrayItem('page_profile.organizations', ['year' => '', 'role' => '', 'organization' => ''], 'Pengalaman Organisasi baru ditambahkan.'); }
    public function deleteOrganization($index) { return $this->deleteArrayItem('page_profile.organizations', $index, 'Pengalaman Organisasi dihapus.'); }

    public function addAchievement() { return $this->addArrayItem('page_profile.achievements', ['year' => '', 'title' => ''], 'Prestasi baru ditambahkan.'); }
    public function deleteAchievement($index) { return $this->deleteArrayItem('page_profile.achievements', $index, 'Prestasi dihapus.'); }
}
