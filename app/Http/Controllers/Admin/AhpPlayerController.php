<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AhpPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AhpPlayerController extends Controller
{
    public function index()
    {
        $players = AhpPlayer::orderBy('no_reg')->paginate(20);
        return view('admin.ahp-training.players.index', compact('players'));
    }

    public function create()
    {
        return view('admin.ahp-training.players.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'no_reg'        => 'required|string|max:20|unique:ahp_players',
            'name'          => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'position'      => 'nullable|string|max:100',
            'photo'         => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'og_image'      => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'is_active'     => 'boolean',
        ], [
            'photo.max' => 'Ukuran maksimal foto adalah 5MB.',
            'photo.mimes' => 'Format foto harus berupa JPG, JPEG, PNG, atau WEBP.',
            'og_image.max' => 'Ukuran maksimal OG image adalah 5MB.',
            'og_image.mimes' => 'Format OG image harus berupa JPG, JPEG, PNG, atau WEBP.',
        ]);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('ahp-players', 'public_uploads');
        }

        if ($request->hasFile('og_image')) {
            $data['og_image'] = $request->file('og_image')->store('ahp-players', 'public_uploads');
        }

        $data['is_active'] = $request->boolean('is_active', true);
        AhpPlayer::create($data);

        return redirect()->route('admin.ahp.players.index')->with('success', 'Pemain berhasil ditambahkan!');
    }

    public function show(AhpPlayer $player)
    {
        $results = $player->results()->with('session')->orderBy('session_id')->get();
        return view('admin.ahp-training.players.show', compact('player', 'results'));
    }

    public function edit(AhpPlayer $player)
    {
        return view('admin.ahp-training.players.edit', compact('player'));
    }

    public function update(Request $request, AhpPlayer $player)
    {
        $data = $request->validate([
            'no_reg'        => 'required|string|max:20|unique:ahp_players,no_reg,' . $player->id,
            'name'          => 'required|string|max:255',
            'date_of_birth' => 'nullable|date',
            'position'      => 'nullable|string|max:100',
            'photo'         => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'og_image'      => 'nullable|file|mimes:jpg,jpeg,png,webp|max:5120',
            'is_active'     => 'boolean',
        ], [
            'photo.max' => 'Ukuran maksimal foto adalah 5MB.',
            'photo.mimes' => 'Format foto harus berupa JPG, JPEG, PNG, atau WEBP.',
            'og_image.max' => 'Ukuran maksimal OG image adalah 5MB.',
            'og_image.mimes' => 'Format OG image harus berupa JPG, JPEG, PNG, atau WEBP.',
        ]);

        if ($request->hasFile('photo')) {
            if ($player->photo) {
                Storage::disk('public_uploads')->delete($player->photo);
                Storage::disk('public')->delete($player->photo); // fallback for old uploads
            }
            $data['photo'] = $request->file('photo')->store('ahp-players', 'public_uploads');
        }

        if ($request->hasFile('og_image')) {
            if ($player->og_image) {
                Storage::disk('public_uploads')->delete($player->og_image);
                Storage::disk('public')->delete($player->og_image); // fallback for old uploads
            }
            $data['og_image'] = $request->file('og_image')->store('ahp-players', 'public_uploads');
        }

        $data['is_active'] = $request->boolean('is_active', true);
        $player->update($data);

        return redirect()->route('admin.ahp.players.index')->with('success', 'Data pemain berhasil diperbarui!');
    }

    public function destroy(AhpPlayer $player)
    {
        if ($player->photo) {
            Storage::disk('public_uploads')->delete($player->photo);
            Storage::disk('public')->delete($player->photo); // fallback for old uploads
        }
        if ($player->og_image) {
            Storage::disk('public_uploads')->delete($player->og_image);
            Storage::disk('public')->delete($player->og_image); // fallback for old uploads
        }
        $player->delete();
        return redirect()->route('admin.ahp.players.index')->with('success', 'Pemain berhasil dihapus.');
    }
}
