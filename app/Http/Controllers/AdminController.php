<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $now = \Carbon\Carbon::today();
        
        // CRM / Internal Metrics
        $totalIncomingMails = \App\Models\IncomingMail::count();
        $totalOutgoingMails = \App\Models\OutgoingMail::count();
        $totalClientsCount = \App\Models\ClientData::count();
        
        $activeJobsCount = \App\Models\MonitoringJob::whereIn('status', ['To Do', 'In Progress', 'Review'])->count();
        $completedJobsCount = \App\Models\MonitoringJob::where('status', 'Done')->count();
        
        $nearDeadlineJobsCount = \App\Models\MonitoringJob::whereNotIn('status', ['Done', 'Cancelled'])
            ->whereNotNull('due_date')
            ->whereDate('due_date', '>=', $now)
            ->whereDate('due_date', '<=', $now->copy()->addDays(7))
            ->count();
            
        $overdueJobsCount = \App\Models\MonitoringJob::whereNotIn('status', ['Done', 'Cancelled'])
            ->whereNotNull('due_date')
            ->whereDate('due_date', '<', $now)
            ->count();

        $recentJobs = \App\Models\MonitoringJob::with('clientData')->latest()->take(5)->get();
        $priorityJobs = \App\Models\MonitoringJob::with('clientData')
            ->where('priority', 'Tinggi')
            ->whereNotIn('status', ['Done', 'Cancelled'])
            ->latest()->take(5)->get();

        // Portal / Online Orders Metrics
        $newOrdersCount = \App\Models\Order::whereIn('status', ['draft', 'waiting_approval'])->count();
        $inProgressCount = \App\Models\Order::whereIn('status', ['processing', 'client_review', 'revision'])->count();
        $totalIncome = \App\Models\Invoice::where('status', 'paid')->sum('total_amount');

        return view('admin.dashboard', compact(
            'totalIncomingMails', 'totalOutgoingMails', 'totalClientsCount',
            'activeJobsCount', 'completedJobsCount', 'nearDeadlineJobsCount', 'overdueJobsCount',
            'recentJobs', 'priorityJobs',
            'newOrdersCount', 'inProgressCount', 'totalIncome'
        ));
    }
}
