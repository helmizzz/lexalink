<x-admin-layout>
<div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-[#020508]">
    <main class="p-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 pb-6 border-b border-gray-200 dark:border-white/10">
            <div>
                <span class="text-xs font-black text-purple-600 dark:text-purple-400 uppercase tracking-wider block mb-1">CMS Legal Research Vault</span>
                <h1 class="text-2xl font-black text-gray-900 dark:text-white">Manajemen Regulasi & Kajian Hukum</h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Kelola arsip peraturan, undang-undang, putusan MA, dan file PDF perpustakaan digital LexaLink.</p>
            </div>
            <a href="{{ route('admin.legal-resources.create') }}" class="px-4 py-2.5 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl font-extrabold text-xs flex items-center gap-2 shadow-lg shadow-purple-500/20 hover:opacity-95 transition-all transform active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Dokumen Baru</span>
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 dark:text-emerald-400 text-xs font-bold flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Filter & Search Bar -->
        <div class="mb-6 p-4 rounded-2xl bg-white dark:bg-[#0b1320] border border-gray-200 dark:border-white/10 shadow-sm">
            <form action="{{ route('admin.legal-resources.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan judul, nomor undang-undang, atau kata kunci abstrak..." class="w-full pl-10 pr-4 py-2 text-xs rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-[#0e1726] text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500/50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400 absolute left-3.5 top-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <select name="category" class="px-3 py-2 text-xs rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-[#0e1726] text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500/50">
                    <option value="">-- Semua Kategori --</option>
                    <option value="Undang-Undang" {{ request('category') == 'Undang-Undang' ? 'selected' : '' }}>Undang-Undang (UU)</option>
                    <option value="Putusan MA" {{ request('category') == 'Putusan MA' ? 'selected' : '' }}>Putusan Mahkamah Agung</option>
                    <option value="Regulasi AI" {{ request('category') == 'Regulasi AI' ? 'selected' : '' }}>Regulasi AI & Teknologi</option>
                    <option value="Jurnal Kajian" {{ request('category') == 'Jurnal Kajian' ? 'selected' : '' }}>Jurnal Kajian & Riset</option>
                </select>
                <button type="submit" class="px-5 py-2 bg-gray-900 dark:bg-white text-white dark:text-gray-900 font-bold text-xs rounded-xl hover:opacity-90 transition">
                    Filter & Cari
                </button>
                @if(request()->hasAny(['search', 'category', 'year']))
                    <a href="{{ route('admin.legal-resources.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-800 text-gray-700 dark:text-gray-300 font-semibold text-xs rounded-xl hover:bg-gray-300 text-center flex items-center justify-center">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <div class="bg-white dark:bg-[#0b1320] rounded-2xl border border-gray-200 dark:border-white/10 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/[0.02] text-gray-500 dark:text-gray-400 text-[11px] font-extrabold tracking-wider uppercase">
                            <th class="p-4">Nomor Dokumen</th>
                            <th class="p-4">Judul Regulasi / Riset</th>
                            <th class="p-4">Kategori & Tahun</th>
                            <th class="p-4 text-center">Unduhan Klien</th>
                            <th class="p-4">Status File</th>
                            <th class="p-4 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-white/5 text-xs">
                        @forelse($resources as $item)
                        <tr class="hover:bg-purple-50/20 dark:hover:bg-white/[0.02] transition">
                            <td class="p-4 font-mono font-black text-purple-600 dark:text-purple-400 whitespace-nowrap">
                                {{ $item->document_number }}
                            </td>
                            <td class="p-4 max-w-sm">
                                <div class="font-extrabold text-gray-900 dark:text-white leading-snug">{{ $item->title }}</div>
                                <div class="text-[11px] text-gray-400 dark:text-gray-500 line-clamp-1 mt-1">{{ strip_tags($item->abstract) }}</div>
                                @if(is_array($item->tags) && count($item->tags) > 0)
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        @foreach(array_slice($item->tags, 0, 3) as $tag)
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400">#{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-black
                                    @if($item->category == 'Undang-Undang') bg-blue-500/10 text-blue-600 border border-blue-500/20
                                    @elseif($item->category == 'Putusan MA') bg-amber-500/10 text-amber-600 border border-amber-500/20
                                    @elseif($item->category == 'Regulasi AI') bg-purple-500/10 text-purple-600 border border-purple-500/20
                                    @else bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 @endif">
                                    {{ $item->category }}
                                </span>
                                <div class="text-[11px] font-mono font-bold text-gray-400 mt-1 text-center">Tahun: {{ $item->year }}</div>
                            </td>
                            <td class="p-4 text-center">
                                <span class="px-3 py-1 rounded-full text-xs font-black bg-purple-50 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300 inline-flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10"/></svg>
                                    <span>{{ number_format($item->downloads_count) }} x</span>
                                </span>
                            </td>
                            <td class="p-4 whitespace-nowrap">
                                @if($item->file_path)
                                    <span class="inline-flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 font-bold text-xs">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>PDF Tersedia</span>
                                    </span>
                                @else
                                    <span class="text-rose-500 font-bold text-xs inline-flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>Belum Upload</span>
                                    </span>
                                @endif
                            </td>
                            <td class="p-4 text-right whitespace-nowrap">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.legal-resources.edit', $item->id) }}" class="p-2 bg-blue-500/10 text-blue-600 rounded-lg hover:bg-blue-600 hover:text-white transition font-semibold" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.legal-resources.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus regulasi ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 bg-rose-500/10 text-rose-600 rounded-lg hover:bg-rose-600 hover:text-white transition font-semibold" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-12 text-center text-gray-500">
                                <div class="flex flex-col items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                    <span class="font-bold">Belum ada dokumen regulasi atau kajian yang terdaftar.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($resources->hasPages())
                <div class="p-4 border-t border-gray-200 dark:border-white/10">
                    {{ $resources->links() }}
                </div>
            @endif
        </div>
    </main>
</div>
</x-admin-layout>
