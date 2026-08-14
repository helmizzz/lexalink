@extends('layouts.frontend')
@section('content')
<section class="relative min-h-screen pt-32 pb-24 bg-gray-50 dark:bg-[#020508]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="mb-6 text-xs md:text-sm text-gray-500 dark:text-gray-400 flex items-center gap-2">
            <a href="{{ route('home') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Beranda</a>
            <span>/</span>
            <a href="{{ route('opini-berita') }}" class="hover:text-blue-600 dark:hover:text-blue-400 transition">Opini & Insight</a>
            <span>/</span>
            <span class="text-gray-800 dark:text-gray-200 font-semibold truncate max-w-xs">{{ $article->title }}</span>
        </nav>

        <!-- Main Article Container -->
        <article class="bg-white dark:bg-white/5 rounded-2xl p-6 md:p-10 shadow-sm border border-gray-100 dark:border-white/10">
            <!-- Header -->
            <header class="mb-8">
                <div class="flex items-center gap-3 mb-4">
                    <span class="px-3 py-1 rounded-full bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 font-bold text-xs">
                        Analisis Hukum
                    </span>
                    <span class="text-xs text-gray-500 flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        {{ number_format($article->views_count) }} Kali Dilihat
                    </span>
                </div>
                
                <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900 dark:text-white leading-tight mb-6">
                    {{ $article->title }}
                </h1>

                <!-- Author Info -->
                <div class="flex items-center gap-3.5 pt-4 border-t border-gray-100 dark:border-white/10">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($article->author->name ?? 'Tim Analis Hukum') }}&background=0284c7&color=fff" class="w-11 h-11 rounded-full shadow-sm" alt="Author" />
                    <div>
                        <div class="font-bold text-gray-900 dark:text-white text-sm">
                            {{ $article->author->name ?? 'Tim Analis Hukum LexaLink' }}
                        </div>
                        <div class="text-xs text-gray-500 dark:text-gray-400">
                            Diterbitkan pada {{ $article->published_at ? $article->published_at->translatedFormat('d F Y, H:i') : 'Draft' }} WIB
                        </div>
                    </div>
                </div>
            </header>

            <!-- Cover Image -->
            @if($article->cover_image)
                <div class="mb-8 overflow-hidden rounded-xl bg-gray-100 dark:bg-gray-800">
                    <img src="{{ $article->cover_image }}" alt="{{ $article->title }}" class="w-full max-h-[420px] object-cover" />
                </div>
            @endif

            <!-- Video Embed (Jika Ada) -->
            @if($article->video_url)
                <div class="mb-8">
                    <h4 class="font-bold text-gray-800 dark:text-gray-200 mb-3 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-red-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                        Video Liputan & Penjelasan
                    </h4>
                    <div class="aspect-w-16 aspect-h-9 rounded-xl overflow-hidden shadow-md">
                        <iframe src="{{ $article->video_url }}" title="Video Player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="w-full h-80 rounded-xl"></iframe>
                    </div>
                </div>
            @endif

            <!-- Article Content (Prose Tailwind) -->
            <div class="prose prose-blue dark:prose-invert max-w-none text-gray-800 dark:text-gray-200 leading-relaxed space-y-4 font-normal">
                {!! $article->content !!}
            </div>

            <!-- Galeri Dokumentasi (Jika Ada) -->
            @if($article->gallery && is_array($article->gallery) && count($article->gallery) > 0)
                <div class="mt-12 pt-8 border-t border-gray-100 dark:border-white/10">
                    <h4 class="font-bold text-gray-900 dark:text-white text-lg mb-4">Galeri Dokumentasi & Data</h4>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($article->gallery as $imgUrl)
                            <div class="overflow-hidden rounded-lg bg-gray-100 dark:bg-gray-800 shadow-sm group">
                                <img src="{{ $imgUrl }}" alt="Galeri" class="w-full h-36 object-cover group-hover:scale-105 transition duration-300" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Share / Footer -->
            <footer class="mt-10 pt-6 border-t border-gray-100 dark:border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4">
                <span class="text-xs font-semibold text-gray-500">Bagikan pandangan hukum ini:</span>
                <div class="flex items-center gap-2">
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . url()->current()) }}" target="_blank" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-xs font-bold transition shadow-sm flex items-center gap-1.5">
                        <span>WhatsApp</span>
                    </a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}" target="_blank" class="px-4 py-2 bg-blue-700 hover:bg-blue-800 text-white rounded-lg text-xs font-bold transition shadow-sm">
                        LinkedIn
                    </a>
                    <button onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Tautan tersalin ke papan klip!');" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white rounded-lg text-xs font-bold transition">
                        Salin Link
                    </button>
                </div>
            </footer>
        </article>

        <!-- Related Articles -->
        @if($relatedArticles->count() > 0)
            <div class="mt-12">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6">Opini & Analisis Terkait Lainnya</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedArticles as $related)
                        <a href="{{ route('opini-berita.show', $related->slug) }}" class="group block bg-white dark:bg-white/5 rounded-xl p-5 shadow-sm border border-gray-100 dark:border-white/10 hover:border-blue-500/50 transition">
                            <h4 class="font-bold text-gray-900 dark:text-white text-sm group-hover:text-blue-600 dark:group-hover:text-blue-400 transition line-clamp-2 mb-3">
                                {{ $related->title }}
                            </h4>
                            <div class="flex items-center gap-2 mt-auto text-xs text-gray-500">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($related->author->name ?? 'Analis') }}&background=random" class="w-4 h-4 rounded-full" />
                                <span class="truncate">{{ $related->author->name ?? 'LexaLink' }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
