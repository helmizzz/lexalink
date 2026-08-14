<x-admin-layout>
    <div class="mb-6 flex flex-col md:flex-row justify-between md:items-center gap-4">
        <div>
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                Opini & Insight Hukum Eklusive
            </h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                Kajian hukum terkini untuk mendampingi keputusan bisnis Anda.
            </p>
        </div>
        
        <!-- Search -->
        <div class="flex flex-wrap items-center gap-3">
            <form method="GET" action="{{ route('client.opini.index') }}" class="flex items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari event atau topik..." class="text-xs py-2 px-3 rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm w-48 sm:w-60">
                <button type="submit" class="px-3 py-2 bg-blue-600 text-white font-bold text-xs rounded-lg hover:bg-blue-700 transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></button>
            </form>
        </div>
    </div>

    <!-- Articles Grid inside Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($articles as $article)
            <a href="{{ route('opini-berita.show', $article->slug) }}" class="group bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition flex flex-col h-full">
                @if($article->cover_image)
                    <div class="h-44 w-full overflow-hidden bg-gray-100 dark:bg-gray-900">
                        <img src="{{ $article->cover_image }}" alt="{{ $article->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                    </div>
                @else
                    <div class="h-44 w-full bg-gradient-to-br from-slate-800 via-[#13253F] to-blue-900 flex items-center justify-center text-white p-6 text-center font-bold text-sm">
                        <span class="opacity-80">LEGALPRO INSIGHTS</span>
                    </div>
                @endif

                <div class="p-5 flex flex-col flex-1">
                    <div class="flex items-center gap-2 mb-2 text-xs text-gray-500 dark:text-gray-400">
                        <span class="px-2 py-0.5 rounded bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 font-semibold">
                            Analisis
                        </span>
                        <span>&bull;</span>
                        <span>{{ $article->published_at ? $article->published_at->format('d M Y') : '' }}</span>
                        <span class="ml-auto flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            {{ number_format($article->views_count) }}
                        </span>
                    </div>

                    <h3 class="font-bold text-gray-900 dark:text-white text-base mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2">
                        {{ $article->title }}
                    </h3>

                    <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2 mb-4 leading-relaxed flex-1">
                        {{ \Illuminate\Support\Str::limit(strip_tags($article->content), 105, '...') }}
                    </p>

                    <div class="pt-3 border-t border-gray-100 dark:border-gray-700 flex items-center gap-2 mt-auto">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name ?? 'Tim Hukum') }}&background=0284c7&color=fff" class="w-5 h-5 rounded-full" />
                        <span class="text-xs font-semibold text-gray-700 dark:text-gray-300 truncate">
                            {{ $article->author->name ?? 'Tim Analis Hukum' }}
                        </span>
                        <span class="ml-auto text-blue-600 dark:text-blue-400 text-xs font-bold group-hover:translate-x-1 transition-transform inline-flex items-center">
                            Baca &rarr;
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="col-span-full bg-white dark:bg-gray-800 rounded-xl p-12 text-center text-gray-500 border border-gray-100 dark:border-gray-700">
                <p class="text-base font-medium">Belum ada artikel atau kajian hukum saat ini.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $articles->links() }}
    </div>
</x-admin-layout>
