<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MonitoringJob;
use App\Models\ClientData;
use App\Models\User;
use Illuminate\Http\Request;

class MonitoringJobController extends Controller
{
    public function index(Request $request)
    {
        $query = MonitoringJob::with(['clientData', 'pic']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->filled('date')) {
            $query->whereDate('due_date', $request->date)
                  ->orWhereDate('start_date', $request->date);
        }

        $sort = $request->get('sort', 'desc');
        $query->orderBy('due_date', $sort);

        $jobs = $query->paginate(15)->withQueryString();

        return view('admin.monitoring-jobs.index', compact('jobs'));
    }

    public function create()
    {
        $clients = ClientData::orderBy('name')->get();
        $pics = User::whereIn('role', ['admin', 'superadmin'])->get();
        return view('admin.monitoring-jobs.create', compact('clients', 'pics'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_data_id' => 'nullable|exists:client_data,id',
            'user_id' => 'nullable|exists:users,id',
            'priority' => 'required|string|in:Rendah,Sedang,Tinggi',
            'status' => 'required|string|in:To Do,In Progress,Review,Done,Cancelled',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date'
        ]);

        MonitoringJob::create($validated);

        return redirect()->route('admin.monitoring-jobs.index')->with('success', 'Pekerjaan berhasil ditambahkan.');
    }

    public function edit(MonitoringJob $monitoringJob)
    {
        $clients = ClientData::orderBy('name')->get();
        $pics = User::whereIn('role', ['admin', 'superadmin'])->get();
        return view('admin.monitoring-jobs.edit', ['job' => $monitoringJob, 'clients' => $clients, 'pics' => $pics]);
    }

    public function update(Request $request, MonitoringJob $monitoringJob)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'client_data_id' => 'nullable|exists:client_data,id',
            'user_id' => 'nullable|exists:users,id',
            'priority' => 'required|string|in:Rendah,Sedang,Tinggi',
            'status' => 'required|string|in:To Do,In Progress,Review,Done,Cancelled',
            'start_date' => 'nullable|date',
            'due_date' => 'nullable|date|after_or_equal:start_date'
        ]);

        $monitoringJob->update($validated);

        return redirect()->route('admin.monitoring-jobs.index')->with('success', 'Pekerjaan berhasil diperbarui.');
    }

    public function destroy(MonitoringJob $monitoringJob)
    {
        $monitoringJob->delete();
        return redirect()->route('admin.monitoring-jobs.index')->with('success', 'Pekerjaan berhasil dihapus.');
    }
}
