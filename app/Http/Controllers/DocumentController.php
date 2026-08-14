<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function download(Document $document)
    {
        // Check if user owns the document's order or is an admin
        if ($document->order->user_id !== auth()->id() && !in_array(auth()->user()->role, ['admin', 'superadmin'])) {
            abort(403, 'Unauthorized access to document.');
        }

        if (!Storage::exists($document->stored_name)) {
            abort(404, 'File not found.');
        }

        return Storage::download($document->stored_name, $document->original_name);
    }
}
