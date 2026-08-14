<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OutgoingMail;
use App\Models\ClientData;
use App\Models\User;
use Illuminate\Http\Request;

class OutgoingMailController extends Controller
{
    public function index(Request $request)
    {
        $query = OutgoingMail::with(['clientData', 'pic']);

        if ($request->filled('search')) {
            $query->where('reference_number', 'like', '%' . $request->search . '%')
                  ->orWhere('recipient', 'like', '%' . $request->search . '%')
                  ->orWhere('case_category', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sort = $request->get('sort', 'desc');
        $query->orderBy('mail_date', $sort);

        $mails = $query->paginate(15)->withQueryString();

        return view('admin.outgoing-mails.index', compact('mails'));
    }

    public function create()
    {
        $clients = ClientData::orderBy('name')->get();
        $pics = User::whereIn('role', ['admin', 'superadmin'])->get();
        return view('admin.outgoing-mails.create', compact('clients', 'pics'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference_number' => 'required|string|max:255',
            'mail_date' => 'required|date',
            'type' => 'required|string|max:255',
            'recipient' => 'required|string|max:255',
            'client_data_id' => 'nullable|exists:client_data,id',
            'case_category' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'document_url' => 'nullable|url|max:255'
        ]);

        OutgoingMail::create($validated);

        return redirect()->route('admin.outgoing-mails.index')->with('success', 'Surat Keluar berhasil ditambahkan.');
    }

    public function edit(OutgoingMail $outgoingMail)
    {
        $clients = ClientData::orderBy('name')->get();
        $pics = User::whereIn('role', ['admin', 'superadmin'])->get();
        return view('admin.outgoing-mails.edit', ['mail' => $outgoingMail, 'clients' => $clients, 'pics' => $pics]);
    }

    public function update(Request $request, OutgoingMail $outgoingMail)
    {
        $validated = $request->validate([
            'reference_number' => 'required|string|max:255',
            'mail_date' => 'required|date',
            'type' => 'required|string|max:255',
            'recipient' => 'required|string|max:255',
            'client_data_id' => 'nullable|exists:client_data,id',
            'case_category' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'document_url' => 'nullable|url|max:255'
        ]);

        $outgoingMail->update($validated);

        return redirect()->route('admin.outgoing-mails.index')->with('success', 'Surat Keluar berhasil diperbarui.');
    }

    public function destroy(OutgoingMail $outgoingMail)
    {
        $outgoingMail->delete();
        return redirect()->route('admin.outgoing-mails.index')->with('success', 'Surat Keluar berhasil dihapus.');
    }
}
