@extends('layouts.frontend')
@section('content')
<section class="relative min-h-screen pt-32 pb-24 bg-gray-50 dark:bg-[#020508]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-12">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4 tracking-tight">
                Opini & Insight Hukum
            </h1>
            <p class="text-base md:text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                Analisis hukum mendalam, perkembangan regulasi, dan kepatuhan korporasi dari tim pakar & praktisi LexaLink
            </p>
        </div>

        <!-- Search Bar -->


        <!-- Modern Cards Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($articles as $article)
                <article class="group bg-white dark:bg-[#0b1320] rounded-xl border border-gray-200/80 dark:border-white/10 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col hover:-translate-y-1">
                    <!-- Thumbnail / Cover (Compact Height) -->
                    <a href="{{ route('opini-berita.show', $article->slug) }}" class="block h-44 w-full relative overflow-hidden bg-gray-900">
                        @if($article->cover_image)
                            <img src="{{ $article->cover_image }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-95 group-hover:opacity-100" />
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-[#0c182c] via-[#13253F] to-blue-900 flex items-center justify-center p-6 text-center">
                                <div class="w-10 h-10 rounded-lg bg-amber-500/10 border border-amber-500/30 flex items-center justify-center mx-auto text-amber-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                                </div>
                            </div>
                        @endif

                        <!-- Badge Top -->
                        <div class="absolute top-3 left-3">
                            <span class="px-2 py-0.5 rounded bg-white/90 dark:bg-gray-900/85 backdrop-blur-md text-gray-900 dark:text-white font-bold text-[9px] tracking-wider uppercase shadow-sm border border-gray-100 dark:border-gray-700">
                                Kajian Hukum
                            </span>
                        </div>

                        <!-- Views Counter Bottom Right -->
                        <div class="absolute bottom-2.5 right-2.5 px-2 py-0.5 rounded bg-black/60 backdrop-blur-sm text-white text-[10px] font-medium flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            {{ number_format($article->views_count) }}
                        </div>
                    </a>

                    <!-- Card Body -->
                    <div class="p-5 flex flex-col flex-1">
                        <!-- Date & Author Meta -->
                        <div class="flex items-center gap-2 py-2 mb-2.5 text-sm text-gray-500 dark:text-gray-400">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name ?? 'Tim Analis Hukum') }}&background=0284c7&color=fff" class="w-6 h-6 rounded-full object-cover flex-shrink-0 shadow-sm border border-blue-500/10" alt="Author" />
                            <span class="font-bold text-gray-700 dark:text-gray-300 truncate max-w-[130px]">{{ $article->author->name ?? 'Tim Analis' }}</span>
                            <span class="ml-auto text-sm text-gray-400">{{ $article->published_at ? $article->published_at->translatedFormat('d M Y') : '' }}</span>
                        </div>

                        <!-- Title (Compact & Clamped) -->
                        <h2 class="text-base font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            <a href="{{ route('opini-berita.show', $article->slug) }}">
                                {{ $article->title }}
                            </a>
                        </h2>

                        <!-- Excerpt (Strictly Trimmed to ~100 characters for balance) -->
                        <p class="text-xs text-gray-500 dark:text-gray-400 leading-relaxed mb-4 flex-1">
                            {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 105, '...') }}
                        </p>

                        <!-- Footer Link -->
                        <div class="pt-3 border-t border-gray-100 dark:border-white/5 flex items-center justify-between mt-auto">
                            <a href="{{ route('opini-berita.show', $article->slug) }}" class="text-[11px] font-bold text-blue-600 dark:text-blue-400 inline-flex items-center gap-1 group-hover:gap-1.5 transition-all">
                                <span>Baca Selengkapnya</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full bg-white dark:bg-[#0b1320] rounded-2xl p-16 text-center text-gray-500 border border-gray-200 dark:border-white/10 shadow-sm">
                    <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mx-auto mb-4 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-1">Belum Ada Analisis Diterbitkan</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Saat ini tim analis kami sedang mempersiapkan artikel dan opini hukum terbaru.</p>
                    @if(request('search'))
                        <a href="{{ route('opini-berita') }}" class="mt-5 px-5 py-2 rounded-lg bg-blue-600 text-white font-semibold text-xs inline-block hover:bg-blue-700 transition">Reset Kata Kunci Pencarian</a>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $articles->links() }}
        </div>
    </div>
</section>
@endsection
