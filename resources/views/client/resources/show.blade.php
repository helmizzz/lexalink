<x-admin-layout>
    <div class="space-y-6">
        
        <div>
            <a href="{{ route('client.resources.index') }}" class="text-xs font-bold text-blue-600 dark:text-blue-400 hover:underline inline-flex items-center gap-1.5 mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                <span>Kembali ke Pusat Legal Research Vault</span>
            </a>
            
            <div class="flex flex-wrap items-center gap-2 mb-3">
                <span class="px-3 py-1 rounded-lg font-mono font-black text-xs bg-blue-600 text-white shadow-sm">
                    {{ $resource->document_number }}
                </span>
                <span class="px-3 py-1 rounded-lg font-extrabold text-xs bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                    {{ $resource->category }} &bull; Tahun {{ $resource->year }}
                </span>
                @if($resource->effective_date)
                    <span class="px-3 py-1 rounded-lg font-extrabold text-xs bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                        ✓ Berlaku: {{ $resource->effective_date->translatedFormat('d F Y') }}
                    </span>
                @endif
            </div>

            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 dark:text-gray-100 tracking-tight leading-tight">
                {{ $resource->title }}
            </h1>
        </div>

        @if(session('success'))
            <div class="p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 text-xs font-bold flex items-center gap-2">
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content: Abstract & Analysis -->
            <div class="lg:col-span-2 space-y-6">
                <div class="p-6 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-sm space-y-6">
                    <h3 class="text-xs font-bold uppercase tracking-widest text-blue-600 dark:text-blue-400 border-b pb-3 border-gray-100 dark:border-gray-700 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span>Abstrak & Intisari Substansi Hukum</span>
                    </h3>

                    <div class="prose dark:prose-invert max-w-none text-sm leading-relaxed text-gray-700 dark:text-gray-300 font-normal">
                        {!! $resource->abstract !!}
                    </div>

                    @if(is_array($resource->tags) && count($resource->tags) > 0)
                        <div class="pt-6 border-t border-gray-100 dark:border-gray-700">
                            <span class="text-[11px] font-extrabold text-gray-400 uppercase tracking-wider block mb-2.5">Topik Kunci & Indeks Tags:</span>
                            <div class="flex flex-wrap gap-2">
                                @foreach($resource->tags as $tag)
                                    <a href="{{ route('client.resources.index', ['tag' => $tag]) }}" class="px-3 py-1 rounded-lg text-xs font-bold bg-blue-500/10 hover:bg-blue-600 hover:text-white text-blue-600 dark:text-blue-400 transition">#{{ $tag }}</a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Citation Suggestion -->
                <div class="p-5 rounded-xl bg-gray-900 text-gray-200 border border-blue-500/30 shadow-md space-y-2">
                    <span class="text-[10px] font-bold uppercase tracking-widest text-blue-400 flex items-center gap-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span>Format Sitasi Resmi (LexaLink Citation Standard)</span>
                    </span>
                    <p class="text-xs font-mono select-all bg-black/40 p-3 rounded-lg text-gray-300 border border-white/10 leading-relaxed">
                        LexaLink Legal Research Database. ({{ $resource->year }}). <em>{{ $resource->title }}</em> ({{ $resource->document_number }}). Diunduh dari Portal Vault Klien LexaLink.
                    </p>
                </div>
            </div>

            <!-- Sidebar Action: Download PDF Vault & Metadata -->
            <div class="space-y-6">
                <div class="p-6 rounded-xl bg-gray-900 text-white border border-blue-500/30 shadow-xl space-y-6">
                    <div class="space-y-2 text-center">
                        <div class="w-12 h-12 bg-blue-600/20 text-blue-400 border border-blue-500/30 rounded-xl mx-auto flex items-center justify-center mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <h4 class="text-base font-bold text-white">Unduh Dokumen Orisinal</h4>
                        <p class="text-xs text-gray-300">File dokumen berkekuatan hukum otentik siap diunduh dan dipantau enkripsinya oleh portal Klien Anda.</p>
                    </div>

                    <div class="p-4 rounded-lg bg-white/5 border border-white/10 text-xs space-y-2.5 font-medium">
                        <div class="flex justify-between">
                            <span class="text-gray-400">Nomor Registrasi:</span>
                            <span class="font-mono font-bold text-blue-400">{{ $resource->document_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Total Diunduh:</span>
                            <span class="font-bold text-white">{{ number_format($resource->downloads_count) }} Kali</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-400">Akses Lisensi:</span>
                            <span class="font-bold text-emerald-400">✅ Active Vault Client</span>
                        </div>
                    </div>

                    <a href="{{ route('client.resources.download', $resource->id) }}" class="w-full py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs rounded-lg text-center flex items-center justify-center gap-2 shadow-md transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                        <span>Unduh Dokumen (.PDF) Sekarang</span>
                    </a>
                </div>

                <!-- Related Regulations -->
                @if($relatedResources->count() > 0)
                <div class="p-5 rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-sm space-y-4">
                    <h4 class="text-xs font-bold uppercase tracking-wider text-gray-800 dark:text-gray-100 border-b pb-2.5 border-gray-100 dark:border-gray-700">
                        Regulasi & Riset Terkait
                    </h4>
                    <div class="space-y-3">
                        @foreach($relatedResources as $rel)
                        <a href="{{ route('client.resources.show', $rel->slug) }}" class="block p-3 rounded-lg bg-gray-50 dark:bg-gray-900 hover:bg-blue-50 dark:hover:bg-gray-700 transition group border border-transparent">
                            <span class="text-[10px] font-mono font-bold text-blue-600 dark:text-blue-400 block mb-0.5">{{ $rel->document_number }}</span>
                            <h5 class="text-xs font-bold text-gray-800 dark:text-gray-100 group-hover:text-blue-600 transition line-clamp-2 leading-snug">{{ $rel->title }}</h5>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>

    </div>
</x-admin-layout>
