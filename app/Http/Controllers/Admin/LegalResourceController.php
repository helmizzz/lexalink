<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LegalResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LegalResourceController extends Controller
{
    /**
     * Display a listing of the legal resources.
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

        $resources = $query->latest('year')->latest('id')->paginate(10)->withQueryString();

        return view('admin.resources.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.resources.create');
    }

    /**
     * Store a newly created legal resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'document_number' => 'required|string|max:100|unique:legal_resources,document_number',
            'category' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:2100',
            'effective_date' => 'nullable|date',
            'abstract' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'file_url' => 'nullable|url|max:255',
            'tags_input' => 'nullable|string',
        ]);

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $count = 1;
        while (LegalResource::where('slug', $slug)->exists()) {
            $slug = "{$originalSlug}-{$count}";
            $count++;
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('resources', 'public');
            $filePath = asset('storage/' . $path);
        } elseif (!empty($validated['file_url'])) {
            $filePath = $validated['file_url'];
        }

        $tags = [];
        if (!empty($validated['tags_input'])) {
            $tags = array_map('trim', explode(',', strtolower($validated['tags_input'])));
        }

        LegalResource::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'document_number' => $validated['document_number'],
            'category' => $validated['category'],
            'year' => $validated['year'],
            'effective_date' => $validated['effective_date'] ?? null,
            'abstract' => $validated['abstract'],
            'file_path' => $filePath,
            'tags' => $tags,
        ]);

        return redirect()->route('admin.legal-resources.index')->with('success', 'Dokumen regulasi/riset berhasil ditambahkan ke Database Riset!');
    }

    /**
     * Display the specified resource.
     */
    public function show(LegalResource $legalResource)
    {
        return view('admin.resources.show', compact('legalResource'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LegalResource $legalResource)
    {
        return view('admin.resources.edit', compact('legalResource'));
    }

    /**
     * Update the specified legal resource in storage.
     */
    public function update(Request $request, LegalResource $legalResource)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'document_number' => 'required|string|max:100|unique:legal_resources,document_number,' . $legalResource->id,
            'category' => 'required|string|max:100',
            'year' => 'required|integer|min:1900|max:2100',
            'effective_date' => 'nullable|date',
            'abstract' => 'required|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'file_url' => 'nullable|url|max:255',
            'tags_input' => 'nullable|string',
        ]);

        $slug = Str::slug($validated['title']);
        if ($slug !== $legalResource->slug) {
            $originalSlug = $slug;
            $count = 1;
            while (LegalResource::where('slug', $slug)->where('id', '!=', $legalResource->id)->exists()) {
                $slug = "{$originalSlug}-{$count}";
                $count++;
            }
        } else {
            $slug = $legalResource->slug;
        }

        $filePath = $legalResource->file_path;
        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('resources', 'public');
            $filePath = asset('storage/' . $path);
        } elseif (!empty($validated['file_url'])) {
            $filePath = $validated['file_url'];
        }

        $tags = [];
        if (!empty($validated['tags_input'])) {
            $tags = array_map('trim', explode(',', strtolower($validated['tags_input'])));
        }

        $legalResource->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'document_number' => $validated['document_number'],
            'category' => $validated['category'],
            'year' => $validated['year'],
            'effective_date' => $validated['effective_date'] ?? null,
            'abstract' => $validated['abstract'],
            'file_path' => $filePath,
            'tags' => $tags,
        ]);

        return redirect()->route('admin.legal-resources.index')->with('success', 'Dokumen regulasi/riset berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LegalResource $legalResource)
    {
        $legalResource->delete();

        return redirect()->route('admin.legal-resources.index')->with('success', 'Dokumen regulasi berhasil dihapus dari perpustakaan.');
    }
}
