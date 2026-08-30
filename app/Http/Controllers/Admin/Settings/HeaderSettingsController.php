<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class HeaderSettingsController extends Controller
{
    public function index()
    {
        $tickerData = SiteSetting::where('key', 'header.ticker')->value('value');
        $tickers = $tickerData ? json_decode($tickerData, true) : [
            'Jadwal Latihan: Senin - Jumat, 15.00 - 18.00 WIB',
            'Konsultasi Program Latihan Fisik? Hubungi WA!',
            'Pendaftaran Kelas Privat Sedang Dibuka!'
        ];

        return view('admin.settings.header', compact('tickers'));
    }

    public function update(Request $request)
    {
        $tickers = array_values(array_filter($request->input('tickers', [])));
        SiteSetting::set('header.ticker', json_encode($tickers));

        return redirect()->route('admin.settings.header')->with('success', 'Header running text berhasil disimpan!');
    }
}
