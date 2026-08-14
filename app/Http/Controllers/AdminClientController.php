<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminClientController extends Controller
{
    public function index()
    {
        $clients = User::where('role', 'client')->latest()->paginate(20);
        return view('admin.clients.index', compact('clients'));
    }

    public function toggleStatus(User $user)
    {
        if ($user->role !== 'client') {
            return back()->with('error', 'Hanya dapat mengubah status klien.');
        }

        $user->update(['is_active' => !$user->is_active]);
        $statusText = $user->is_active ? 'diaktifkan' : 'dinonaktifkan';

        return back()->with('success', "Akun {$user->name} berhasil {$statusText}.");
    }
}
