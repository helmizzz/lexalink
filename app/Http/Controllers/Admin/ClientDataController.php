<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClientData;
use App\Models\User;
use Illuminate\Http\Request;

class ClientDataController extends Controller
{
    public function index(Request $request)
    {
        $query = ClientData::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('contact_person', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sort = $request->get('sort', 'desc'); // default desc
        $query->orderBy('name', $sort);

        $clients = $query->paginate(15)->withQueryString();

        return view('admin.client-data.index', compact('clients'));
    }

    public function create()
    {
        $users = User::where('role', 'client')->get();
        return view('admin.client-data.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Perorangan,Perusahaan,Institusi',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'case_category' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Non-Aktif,Selesai',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id'
        ]);

        ClientData::create($validated);

        return redirect()->route('admin.client-data.index')->with('success', 'Data Klien berhasil ditambahkan.');
    }

    public function edit(ClientData $clientDatum)
    {
        $users = User::where('role', 'client')->get();
        return view('admin.client-data.edit', ['client' => $clientDatum, 'users' => $users]);
    }

    public function update(Request $request, ClientData $clientDatum)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:Perorangan,Perusahaan,Institusi',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'case_category' => 'nullable|string|max:255',
            'status' => 'required|in:Aktif,Non-Aktif,Selesai',
            'address' => 'nullable|string',
            'notes' => 'nullable|string',
            'user_id' => 'nullable|exists:users,id'
        ]);

        $clientDatum->update($validated);

        return redirect()->route('admin.client-data.index')->with('success', 'Data Klien berhasil diperbarui.');
    }

    public function destroy(ClientData $clientDatum)
    {
        $clientDatum->delete();
        return redirect()->route('admin.client-data.index')->with('success', 'Data Klien berhasil dihapus.');
    }
}
