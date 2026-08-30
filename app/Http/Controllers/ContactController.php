<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
            'service' => 'nullable|string|max:100',
            'message' => 'required|string|max:1000',
        ]);

        Lead::create($validated);

        $waNumber = \App\Models\SiteSetting::where('key', 'contact.whatsapp_number')->value('value') ?? '6281234567890';
        $waNumber = preg_replace('/[^0-9]/', '', $waNumber); // Bersihkan nomor
        if (str_starts_with($waNumber, '0')) {
            $waNumber = '62' . substr($waNumber, 1);
        }

        $text = "Halo Coach Agam,\n\nNama: {$validated['name']}\nEmail: {$validated['email']}\nNo HP: {$validated['phone']}\n";
        if (!empty($validated['service'])) {
            $text .= "Layanan: {$validated['service']}\n";
        }
        $text .= "\nPesan:\n{$validated['message']}";

        $waUrl = "https://wa.me/{$waNumber}?text=" . urlencode($text);

        return redirect()->away($waUrl);
    }

    public function submitWaLead(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:50',
            'kebutuhan' => 'nullable|string|max:1000',
            'target_url' => 'nullable|string',
        ]);

        Lead::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'message' => $validated['kebutuhan'] ?? null,
            'source' => 'WhatsApp Popup',
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil direkam',
            'redirect_url' => $validated['target_url'] ?? 'https://wa.me/6281234567890'
        ], 201);
    }
}
