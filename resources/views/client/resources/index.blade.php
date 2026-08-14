<x-admin-layout>
    <div class="space-y-6">
        
        <!-- Header Banner -->
        <div class="bg-white dark:bg-gray-800 rounded-xl border-l-4 border-blue-500 shadow-sm p-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 leading-tight mb-2">
                Pusat Unduhan Regulasi, Putusan & Database Kajian Hukum AI
            </h1>
            <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-300 leading-relaxed max-w-4xl">
                Akses eksklusif berlisensi Klien untuk mengunduh dokumen orisinal (.PDF), membaca intisari pasal kepatuhan, serta menelusuri literatur yuridis terlengkap yang dikurasi oleh tim peneliti hukum korporat LexaLink.
            </p>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-xs font-bold flex items-center gap-3 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 text-xs font-bold flex items-center gap-3 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0 text-rose-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- Interactive Legal Search Engine Bar -->
        <div class="p-4 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-sm">
            <form action="{{ route('client.resources.index') }}" method="GET" class="flex flex-col md:flex-row gap-3 items-stretch md:items-center">
                <div class="flex-1">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Ketik nomor regulasi (misal: UU-27/2022), judul undang-undang, atau kata kunci..." class="w-full text-xs py-2.5 px-4 rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white focus:ring-blue-500 shadow-sm">
                </div>

                <select name="category" class="py-2.5 px-3.5 text-xs font-semibold rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white focus:ring-blue-500 shadow-sm">
                    <option value="">-- Semua Kategori Dokumen --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>

                <select name="year" class="py-2.5 px-3.5 text-xs font-semibold rounded-lg border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-white focus:ring-blue-500 shadow-sm">
                    <option value="">-- Semua Tahun --</option>
                    @foreach($years as $yr)
                        <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                    @endforeach
                </select>

                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-lg transition shadow-sm whitespace-nowrap flex items-center justify-center gap-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    <span>Cari</span>
                </button>
                @if(request()->hasAny(['search', 'category', 'year', 'tag']))
                    <a href="{{ route('client.resources.index') }}" class="px-4 py-2.5 bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 text-gray-700 dark:text-gray-200 font-bold text-xs rounded-lg transition whitespace-nowrap text-center flex items-center justify-center">
                        Reset Filter
                    </a>
                @endif
            </form>
        </div>

        <!-- Resources Grid / List Display -->
        <div class="space-y-4">
            <div class="px-1">
                <span class="text-xs font-extrabold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Menampilkan {{ $resources->total() }} Dokumen Regulasi & Riset</span>
            </div>

            <div class="grid grid-cols-1 gap-4">
                @forelse($resources as $item)
                    <div class="p-5 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-sm hover:shadow-md transition-all flex flex-col md:flex-row md:items-center justify-between gap-6 group">
                        <div class="space-y-2 flex-1">
                            <div class="flex flex-wrap items-center gap-2">
                                <span class="px-3 py-1 rounded-md font-mono font-black text-xs bg-blue-500/10 text-blue-600 dark:text-blue-400 border border-blue-500/20">
                                    {{ $item->document_number }}
                                </span>
                                <span class="px-3 py-1 rounded-md font-extrabold text-xs
                                    @if($item->category == 'Undang-Undang') bg-blue-500/10 text-blue-600 border border-blue-500/20
                                    @elseif($item->category == 'Putusan MA') bg-amber-500/10 text-amber-600 border border-amber-500/20
                                    @elseif($item->category == 'Regulasi AI') bg-purple-500/10 text-purple-600 border border-purple-500/20
                                    @else bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 @endif">
                                    {{ $item->category }} &bull; {{ $item->year }}
                                </span>
                                @if($item->effective_date)
                                    <span class="text-xs font-semibold text-gray-400">Berlaku: {{ $item->effective_date->translatedFormat('d M Y') }}</span>
                                @endif
                            </div>

                            <h3 class="text-base font-bold text-gray-800 dark:text-gray-100 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition leading-snug">
                                <a href="{{ route('client.resources.show', $item->slug) }}" class="hover:underline">{{ $item->title }}</a>
                            </h3>

                            <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-2 leading-relaxed">
                                {{ strip_tags($item->abstract) }}
                            </p>

                            @if(is_array($item->tags) && count($item->tags) > 0)
                                <div class="flex flex-wrap gap-1.5 pt-1">
                                    @foreach($item->tags as $tag)
                                        <a href="{{ route('client.resources.index', ['tag' => $tag]) }}" class="px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 dark:bg-gray-700 hover:bg-blue-100 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 hover:text-blue-600 transition">#{{ $tag }}</a>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <!-- Actions and Downloads -->
                        <div class="flex flex-row md:flex-col items-center md:items-end justify-between md:justify-center gap-3 pt-4 md:pt-0 border-t md:border-t-0 border-gray-100 dark:border-gray-700 flex-shrink-0">
                            <span class="text-xs text-gray-400 flex items-center gap-1">
                                <span>{{ number_format($item->downloads_count) }} x Diunduh</span>
                            </span>

                            <div class="flex items-center gap-2">
                                <a href="{{ route('client.resources.show', $item->slug) }}" class="px-4 py-2 rounded-lg bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 text-gray-800 dark:text-gray-200 font-bold text-xs transition whitespace-nowrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>    
                                </a>
                                <a href="{{ route('client.resources.download', $item->id) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-lg shadow-sm transition flex items-center gap-1.5 whitespace-nowrap">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 mx-auto mb-3 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <h4 class="text-base font-bold text-gray-800 dark:text-gray-100">Tidak Ada Dokumen Regulasi Ditemukan</h4>
                        <p class="text-xs text-gray-400 mt-1">Coba sesuaikan kata kunci filter pencarian atau reset parameter kueri Anda.</p>
                    </div>
                @endforelse
            </div>
        </div>

        @if($resources->hasPages())
            <div class="pt-2">
                {{ $resources->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
