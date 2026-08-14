<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminInvoiceController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'total_amount' => 'required|numeric|min:1'
        ]);

        $order = Order::findOrFail($request->order_id);

        Invoice::create([
            'order_id' => $order->id,
            'invoice_number' => 'INV-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT),
            'total_amount' => $request->total_amount,
            'status' => 'unpaid'
        ]);

        $order->update(['status' => 'waiting_approval']);

        return back()->with('success', 'Tagihan berhasil dibuat.');
    }

    public function markAsPaid(Invoice $invoice)
    {
        $invoice->update(['status' => 'paid']);
        $invoice->order->update(['status' => 'processing']);

        return back()->with('success', 'Tagihan ditandai Lunas. Status pesanan berubah menjadi Diproses.');
    }
}
