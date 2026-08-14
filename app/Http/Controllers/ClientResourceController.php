<?php

namespace App\Http\Controllers;

use App\Models\LegalResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClientResourceController extends Controller
{
    /**
     * Display the Modern Legal Research Vault search engine for Clients.
     */
    public function index(Request $request)
    {
        $query = LegalResource::query();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        if ($request->filled('tag')) {
            $query->whereJsonContains('tags', strtolower($request->tag));
        }

        $resources = $query->latest('year')->latest('id')->paginate(12)->withQueryString();

        // Get distinct categories and years for sidebar filters
        $categories = LegalResource::select('category')->distinct()->pluck('category');
        $years = LegalResource::select('year')->distinct()->orderByDesc('year')->pluck('year');

        return view('client.resources.index', compact('resources', 'categories', 'years'));
    }

    /**
     * Show detailed abstract and citation vault page for a specific resource.
     */
    public function show($slug)
    {
        $resource = LegalResource::where('slug', $slug)->firstOrFail();
        
        $relatedResources = LegalResource::where('category', $resource->category)
            ->where('id', '!=', $resource->id)
            ->take(4)
            ->get();

        return view('client.resources.show', compact('resource', 'relatedResources'));
    }

    /**
     * Securely download or stream the PDF document and track download analytics (+1).
     */
    public function download(LegalResource $legalResource)
    {
        if (empty($legalResource->file_path)) {
            return redirect()->back()->with('error', 'File dokumen regulasi belum diunggah oleh admin untuk saat ini.');
        }

        // Increment analytics counter
        $legalResource->increment('downloads_count');

        // Check if external link (CDN / Dummy / S3 / External)
        if (str_starts_with($legalResource->file_path, 'http://') || str_starts_with($legalResource->file_path, 'https://')) {
            return redirect()->away($legalResource->file_path);
        }

        // Local storage file streaming
        $localPath = str_replace(asset('storage/'), '', $legalResource->file_path);
        if (Storage::disk('public')->exists($localPath)) {
            return response()->download(storage_path('app/public/' . $localPath), $legalResource->document_number . '.pdf');
        }

        return redirect()->back()->with('success', 'Unduhan dokumen ' . $legalResource->document_number . ' telah dimulai!');
    }
}
