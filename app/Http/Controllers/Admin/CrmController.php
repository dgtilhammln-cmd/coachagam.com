<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class CrmController extends Controller
{
    public function index()
    {
        $leads = Lead::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.crm.index', compact('leads'));
    }

    public function show(Lead $lead)
    {
        // Update status to contacted if it's new
        if ($lead->status === 'new') {
            $lead->update(['status' => 'contacted']);
        }
        return view('admin.crm.show', compact('lead'));
    }

    public function updateStatus(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,contacted,closed'
        ]);

        $lead->update(['status' => $validated['status']]);

        return redirect()->route('admin.crm.index')->with('success', 'Status prospek berhasil diperbarui.');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return redirect()->route('admin.crm.index')->with('success', 'Data prospek berhasil dihapus.');
    }
}
