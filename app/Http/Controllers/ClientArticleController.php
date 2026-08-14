<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ClientArticleController extends Controller
{
    /**
     * Public page listing (Landing Page /opini-berita)
     */
    public function publicIndex(Request $request)
    {
        $query = Article::with('author')->where('status', 'published')->latest('published_at');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $articles = $query->paginate(6)->withQueryString();

        return view('pages.opini-berita', compact('articles'));
    }

    /**
     * Public detail reading page (/opini-berita/{slug})
     */
    public function publicShow($slug)
    {
        $article = Article::with('author')->where('slug', $slug)->firstOrFail();

        // Only published or author/admin can see
        if ($article->status !== 'published' && (!auth()->check() || auth()->user()->role === 'client')) {
            abort(404);
        }

        // Increment views
        $article->increment('views_count');

        $relatedArticles = Article::where('status', 'published')
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.opini-detail', compact('article', 'relatedArticles'));
    }

    /**
     * Client Dashboard reading hub (/dashboard/opini)
     */
    public function dashboardIndex(Request $request)
    {
        $query = Article::with('author')->where('status', 'published')->latest('published_at');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $articles = $query->paginate(10)->withQueryString();

        return view('client.opini.index', compact('articles'));
    }
}
