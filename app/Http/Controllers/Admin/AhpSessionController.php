<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AhpTestSession;
use Illuminate\Http\Request;

class AhpSessionController extends Controller
{
    public function index()
    {
        $sessions = AhpTestSession::withCount('results')->orderBy('test_date', 'desc')->get();
        return view('admin.ahp-training.sessions.index', compact('sessions'));
    }

    public function create()
    {
        $labels = ['Pre Test', 'Program Latihan', 'Volume dan Intensitas', 'Evaluation Training Load', 'Post Test', 'Report Individual Players'];
        return view('admin.ahp-training.sessions.create', compact('labels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label'       => 'required|string|max:100',
            'location'    => 'nullable|string|max:255',
            'test_date'   => 'required|date',
            'test_time'   => 'nullable',
            'temperature' => 'nullable|string|max:50',
            'period_week' => 'nullable|integer|min:0',
            'coach_notes' => 'nullable|string',
        ]);
        AhpTestSession::create($data);
        return redirect()->route('admin.ahp.sessions.index')->with('success', 'Sesi test berhasil dibuat!');
    }

    public function show(AhpTestSession $session)
    {
        $results = $session->results()->with('player')->get()->keyBy('player_id');
        return view('admin.ahp-training.sessions.show', compact('session', 'results'));
    }

    public function destroy(AhpTestSession $session)
    {
        $session->delete();
        return redirect()->route('admin.ahp.sessions.index')->with('success', 'Sesi berhasil dihapus.');
    }
}
