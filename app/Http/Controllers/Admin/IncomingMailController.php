<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncomingMail;
use App\Models\ClientData;
use App\Models\User;
use Illuminate\Http\Request;

class IncomingMailController extends Controller
{
    public function index(Request $request)
    {
        $query = IncomingMail::with(['clientData', 'pic']);

        if ($request->filled('search')) {
            $query->where('reference_number', 'like', '%' . $request->search . '%')
                  ->orWhere('sender', 'like', '%' . $request->search . '%')
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

        return view('admin.incoming-mails.index', compact('mails'));
    }

    public function create()
    {
        $clients = ClientData::orderBy('name')->get();
        $pics = User::whereIn('role', ['admin', 'superadmin'])->get();
        return view('admin.incoming-mails.create', compact('clients', 'pics'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference_number' => 'required|string|max:255',
            'mail_date' => 'required|date',
            'type' => 'required|string|max:255',
            'sender' => 'required|string|max:255',
            'client_data_id' => 'nullable|exists:client_data,id',
            'case_category' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'document_url' => 'nullable|url|max:255'
        ]);

        IncomingMail::create($validated);

        return redirect()->route('admin.incoming-mails.index')->with('success', 'Surat Masuk berhasil ditambahkan.');
    }

    public function edit(IncomingMail $incomingMail)
    {
        $clients = ClientData::orderBy('name')->get();
        $pics = User::whereIn('role', ['admin', 'superadmin'])->get();
        return view('admin.incoming-mails.edit', ['mail' => $incomingMail, 'clients' => $clients, 'pics' => $pics]);
    }

    public function update(Request $request, IncomingMail $incomingMail)
    {
        $validated = $request->validate([
            'reference_number' => 'required|string|max:255',
            'mail_date' => 'required|date',
            'type' => 'required|string|max:255',
            'sender' => 'required|string|max:255',
            'client_data_id' => 'nullable|exists:client_data,id',
            'case_category' => 'nullable|string|max:255',
            'user_id' => 'nullable|exists:users,id',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'document_url' => 'nullable|url|max:255'
        ]);

        $incomingMail->update($validated);

        return redirect()->route('admin.incoming-mails.index')->with('success', 'Surat Masuk berhasil diperbarui.');
    }

    public function destroy(IncomingMail $incomingMail)
    {
        $incomingMail->delete();
        return redirect()->route('admin.incoming-mails.index')->with('success', 'Surat Masuk berhasil dihapus.');
    }
}
