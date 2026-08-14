<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Document;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'service')->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'service', 'documents', 'invoice');
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:draft,waiting_approval,processing,client_review,revision,completed',
            'admin_notes' => 'nullable|string'
        ]);

        $order->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function uploadFinalDocument(Request $request, Order $order)
    {
        $request->validate([
            'file' => 'required|file|mimes:pdf,zip,jpg,png,jpeg|max:10240',
            'is_final' => 'nullable|boolean'
        ]);

        $path = $request->file('file')->store('private/documents');
        
        $fileType = $request->has('is_final') ? 'final' : 'draft_admin';

        Document::create([
            'order_id' => $order->id,
            'original_name' => $request->file('file')->getClientOriginalName(),
            'stored_name' => $path,
            'file_type' => $fileType,
        ]);

        if ($request->has('is_final')) {
            $order->update(['status' => 'completed']);
        } else {
            $order->update(['status' => 'client_review']);
        }

        return back()->with('success', 'Dokumen berhasil diunggah.');
    }
}
