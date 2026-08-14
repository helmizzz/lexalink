<x-admin-layout>
    <div class="mb-6 flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100">CMS: Event Mendatang & Webinar</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Kelola jadwal webinar hukum, masterclass offline, serta pantau pendaftaran klien.</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="inline-flex items-center px-4 py-2.5 bg-blue-600 border border-transparent rounded-lg font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 transition shadow-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Event Baru
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 dark:bg-green-900/30 dark:border-green-800 dark:text-green-300 text-sm font-medium flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <!-- Filter Bar -->
        <div class="p-4 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50 flex flex-wrap gap-4 justify-between items-center">
            <form method="GET" action="{{ route('admin.events.index') }}" class="flex items-center gap-2 w-full sm:w-80">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama event atau lokasi..." class="w-full text-xs py-2 px-3.5 rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-blue-500 shadow-sm">
                <button type="submit" class="px-3.5 py-2 bg-gray-900 dark:bg-gray-700 text-white rounded-lg text-xs font-semibold hover:bg-gray-800">Cari</button>
            </form>
            <div class="flex gap-2 text-xs font-semibold">
                <a href="{{ route('admin.events.index') }}" class="px-3 py-1.5 rounded-lg {{ !request('status') ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">Semua</a>
                <a href="{{ route('admin.events.index', ['status' => 'upcoming']) }}" class="px-3 py-1.5 rounded-lg {{ request('status') === 'upcoming' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">Upcoming</a>
                <a href="{{ route('admin.events.index', ['status' => 'completed']) }}" class="px-3 py-1.5 rounded-lg {{ request('status') === 'completed' ? 'bg-blue-600 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">Completed (Arsip)</a>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-700/50 border-b border-gray-100 dark:border-gray-700 text-[11px] font-bold uppercase text-gray-500 dark:text-gray-400 tracking-wider">
                        <th class="py-3.5 px-4">Event Info</th>
                        <th class="py-3.5 px-4">Jadwal & Tipe</th>
                        <th class="py-3.5 px-4">Lokasi / Platform</th>
                        <th class="py-3.5 px-4 text-center">Pendaftar (Client)</th>
                        <th class="py-3.5 px-4">Status</th>
                        <th class="py-3.5 px-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700 text-sm">
                    @forelse($events as $event)
                        <tr class="hover:bg-gray-50/75 dark:hover:bg-gray-700/30 transition">
                            <td class="py-4 px-4 max-w-sm">
                                <div class="flex items-center gap-3">
                                    @if($event->cover_image)
                                        <img src="{{ $event->cover_image }}" class="w-14 h-10 object-cover rounded-lg shadow-sm flex-shrink-0" alt="Cover" />
                                    @else
                                        <div class="w-14 h-10 rounded-lg bg-blue-900 text-white font-bold text-xs flex items-center justify-center flex-shrink-0">EV</div>
                                    @endif
                                    <div>
                                        <div class="font-bold text-gray-900 dark:text-gray-100 line-clamp-1 text-sm">{{ $event->title }}</div>
                                        <div class="text-[11px] text-gray-400 mt-0.5">Slug: {{ $event->slug }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4 text-xs">
                                <div class="font-bold text-gray-800 dark:text-gray-200">{{ $event->event_date ? $event->event_date->translatedFormat('d M Y') : '-' }}</div>
                                <div class="text-gray-500 dark:text-gray-400 mt-0.5">{{ $event->event_time }} &bull; <span class="uppercase font-semibold text-blue-600 dark:text-blue-400">{{ $event->location_type }}</span></div>
                            </td>
                            <td class="py-4 px-4 text-xs text-gray-600 dark:text-gray-400 truncate max-w-[200px]">
                                {{ $event->location ?? '-' }}
                            </td>
                            <td class="py-4 px-4 text-center">
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-extrabold bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                                    {{ $event->attendees_count }} Klien
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                @if($event->status === 'upcoming')
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300 border border-green-200">Upcoming</span>
                                @elseif($event->status === 'completed')
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-300 border border-gray-300">Completed</span>
                                @else
                                    <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300">Cancelled</span>
                                @endif
                            </td>
                            <td class="py-4 px-4 text-right space-x-2 text-xs">
                                <a href="{{ route('client.events.show', $event->slug) }}" target="_blank" class="font-bold text-blue-600 dark:text-blue-400 hover:underline">Preview</a>
                                <a href="{{ route('admin.events.edit', $event) }}" class="font-bold text-indigo-600 dark:text-indigo-400 hover:underline">Edit</a>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Hapus event ini secara permanen?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-bold text-red-600 dark:text-red-400 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-gray-400 font-medium">Belum ada data event atau webinar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-gray-100 dark:border-gray-700">
            {{ $events->links() }}
        </div>
    </div>
</x-admin-layout>
