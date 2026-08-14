<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Service;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function create()
    {
        $services = Service::all();
        return view('orders.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'files.*' => 'nullable|file|mimes:pdf,jpg,png,jpeg|max:5120',
        ]);

        // Build JSON payload
        $payload = $request->except(['_token', 'service_id', 'files']);

        $order = Order::create([
            'ref_number' => 'ORD-' . strtoupper(Str::random(8)),
            'user_id' => auth()->id(),
            'service_id' => $request->service_id,
            'payload' => $payload,
            'status' => 'draft',
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $key => $file) {
                $path = $file->store('private/documents');
                Document::create([
                    'order_id' => $order->id,
                    'original_name' => $file->getClientOriginalName(),
                    'stored_name' => $path,
                    'file_type' => $key,
                ]);
            }
        }

        return redirect()->route('dashboard')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function show(Order $order)
    {
        // Ensure user owns order
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }
        
        return view('orders.show', compact('order'));
    }
}
