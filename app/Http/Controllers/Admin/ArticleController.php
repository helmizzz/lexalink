<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Article::with('author')->latest();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $articles = $query->paginate(12)->withQueryString();

        return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url|max:255',
            'gallery_urls' => 'nullable|array',
            'gallery_urls.*' => 'nullable|url',
            'status' => 'required|in:draft,published',
        ]);

        $slug = Str::slug($request->title);
        $count = Article::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $coverImagePath = null;
        if ($request->hasFile('cover_image')) {
            $coverImagePath = '/storage/' . $request->file('cover_image')->store('articles', 'public');
        }

        $gallery = null;
        if ($request->filled('gallery_urls')) {
            $gallery = array_values(array_filter($request->gallery_urls));
        }

        Article::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'cover_image' => $coverImagePath,
            'gallery' => $gallery,
            'video_url' => $request->video_url,
            'status' => $request->status,
            'published_at' => $request->status === 'published' ? now() : null,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article = Article::findOrFail($id);
        return redirect()->route('opini-berita.show', $article->slug);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|max:2048',
            'video_url' => 'nullable|url|max:255',
            'gallery_urls' => 'nullable|array',
            'gallery_urls.*' => 'nullable|url',
            'status' => 'required|in:draft,published',
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'video_url' => $request->video_url,
            'status' => $request->status,
        ];

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = '/storage/' . $request->file('cover_image')->store('articles', 'public');
        }

        if ($request->has('gallery_urls')) {
            $data['gallery'] = array_values(array_filter($request->gallery_urls ?? []));
        }

        if ($request->status === 'published' && !$article->published_at) {
            $data['published_at'] = now();
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus!');
    }
}
