<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            CMS: Opini & Berita Hukum
        </h2>
        <a href="{{ route('admin.articles.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold text-sm transition shadow-sm">
            + Tulis Artikel Baru
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6 border border-gray-100 dark:border-gray-700">
        <form method="GET" action="{{ route('admin.articles.index') }}" class="flex flex-wrap gap-4 mb-6">
            <div class="flex-1 min-w-[250px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul artikel..." class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm">
            </div>
            <div class="w-48">
                <select name="status" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 rounded-md shadow-sm">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <button type="submit" class="px-5 py-2 bg-gray-800 dark:bg-gray-700 text-white rounded-md hover:bg-gray-900 font-semibold text-sm transition">
                Filter
            </button>
            @if(request()->hasAny(['search', 'status']))
                <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-semibold text-sm transition flex items-center">
                    Reset
                </a>
            @endif
        </form>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-900">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul & Penulis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Terbit</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($articles as $article)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-900 dark:text-white text-sm mb-1">{{ $article->title }}</div>
                                <div class="text-xs text-gray-500">Oleh: {{ $article->author->name ?? 'Admin' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($article->status === 'published')
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                                        Published
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">
                                        Draft
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 dark:text-gray-300 font-mono">
                                {{ number_format($article->views_count) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                {{ $article->published_at ? $article->published_at->format('d M Y, H:i') : '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end gap-2">
                                    @if($article->status === 'published')
                                        <a href="{{ route('opini-berita.show', $article->slug) }}" target="_blank" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 text-xs font-semibold px-2 py-1 bg-indigo-50 dark:bg-indigo-900/20 rounded">
                                            Preview
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.articles.edit', $article->id) }}" class="text-blue-600 hover:text-blue-900 dark:text-blue-400 text-xs font-semibold px-2 py-1 bg-blue-50 dark:bg-blue-900/20 rounded">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 text-xs font-semibold px-2 py-1 bg-red-50 dark:bg-red-900/20 rounded">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400 text-sm">
                                Belum ada artikel atau opini yang diterbitkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    </div>
</x-admin-layout>
