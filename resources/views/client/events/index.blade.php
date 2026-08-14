<x-admin-layout>
    <div class="mb-6 flex flex-col md:flex-row justify-between md:items-center gap-4">
        <div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100">Katalog Event & Webinar Eksklusif</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Daftar secara gratis ke berbagai masterclass hukum eksekutif, klinik regulasi, dan webinar korporat.</p>
        </div>
        
        <!-- Filter & Search -->
        <div class="flex flex-wrap items-center gap-3">
            <form method="GET" action="{{ route('client.events.index') }}" class="flex items-center gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari event atau topik..." class="text-xs py-2 px-3 rounded-lg border-gray-200 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm w-48 sm:w-60">
                <button type="submit" class="px-3 py-2 bg-blue-600 text-white font-bold text-xs rounded-lg hover:bg-blue-700 transition"><svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg></button>
            </form>
            <div class="flex gap-1 bg-gray-200 dark:bg-gray-700 p-1 rounded-lg text-xs font-semibold">
                <a href="{{ route('client.events.index') }}" class="px-3 py-1 rounded-md {{ !request('filter') ? 'bg-white dark:bg-gray-800 text-blue-600 shadow-sm' : 'text-gray-600 dark:text-gray-300' }}">Semua</a>
                <a href="{{ route('client.events.index', ['filter' => 'upcoming']) }}" class="px-3 py-1 rounded-md {{ request('filter') === 'upcoming' ? 'bg-white dark:bg-gray-800 text-green-600 shadow-sm' : 'text-gray-600 dark:text-gray-300' }}">Mendatang</a>
                <!-- <a href="{{ route('client.events.index', ['filter' => 'completed']) }}" class="px-3 py-1 rounded-md {{ request('filter') === 'completed' ? 'bg-white dark:bg-gray-800 text-purple-600 shadow-sm' : 'text-gray-600 dark:text-gray-300' }}">Arsip / Galeri</a> -->
            </div>
        </div>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($events as $event)
            <article class="group bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300 flex flex-col hover:-translate-y-1">
                <!-- Cover Image -->
                <a href="{{ route('client.events.show', $event->slug) }}" class="block h-44 w-full relative overflow-hidden bg-gray-900">
                    @if($event->cover_image)
                        <img src="{{ $event->cover_image }}" alt="{{ $event->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 opacity-95 group-hover:opacity-100" />
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-[#0c182c] via-[#13253F] to-blue-900 flex items-center justify-center p-6 text-center">
                            <div class="w-12 h-12 rounded-xl bg-amber-500/10 border border-amber-500/30 flex items-center justify-center mx-auto text-amber-400 font-bold text-lg">EV</div>
                        </div>
                    @endif

                    <!-- Location Type Badge -->
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-0.5 rounded bg-black/70 backdrop-blur-md text-amber-400 font-extrabold text-[10px] tracking-wider uppercase border border-white/10 flex items-center gap-1">
                            @if($event->location_type === 'online')
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3 text-amber-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            @endif
                            {{ strtoupper($event->location_type) }}
                        </span>
                    </div>

                    <!-- Status Badge Top Right -->
                    <div class="absolute top-3 right-3">
                        @if($event->status === 'upcoming')
                            <span class="px-2 py-0.5 rounded bg-green-500 text-white font-extrabold text-[9px] uppercase tracking-wider shadow">Upcoming</span>
                        @elseif($event->status === 'completed')
                            <span class="px-2 py-0.5 rounded bg-gray-700 text-gray-200 font-extrabold text-[9px] uppercase tracking-wider shadow">Arsip</span>
                        @endif
                    </div>
                </a>

                <!-- Card Body -->
                <div class="p-5 flex flex-col flex-1">
                    <!-- Date & Time Meta -->
                    <div class="flex items-center gap-2 mb-2 text-xs text-blue-600 dark:text-blue-400 font-bold">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>{{ $event->event_date ? $event->event_date->translatedFormat('l, d M Y') : '-' }}</span>
                    </div>

                    <h3 class="font-bold text-gray-900 dark:text-white text-base mb-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2 leading-snug">
                        <a href="{{ route('client.events.show', $event->slug) }}">
                            {{ $event->title }}
                        </a>
                    </h3>

                    <!-- Location info -->
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-4 flex items-center gap-1.5 truncate">
                        <span class="font-semibold text-gray-600 dark:text-gray-300">Tempat:</span> {{ $event->location ?? 'Platform Portal Eksklusif' }}
                    </p>

                    <!-- Footer CTA -->
                    <div class="pt-3.5 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between mt-auto">
                        <span class="text-xs font-medium text-gray-500 dark:text-gray-400">Jam: {{ $event->event_time }}</span>
                        <a href="{{ route('client.events.show', $event->slug) }}" class="text-xs font-extrabold px-3 py-1.5 rounded-lg bg-blue-50 text-blue-700 hover:bg-blue-600 hover:text-white dark:bg-blue-900/40 dark:text-blue-300 dark:hover:bg-blue-600 dark:hover:text-white transition shadow-sm">
                            @if($event->status === 'upcoming')
                                Daftar Event &rarr;
                            @else
                                Lihat Arsip & Galeri &rarr;
                            @endif
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full bg-white dark:bg-gray-800 rounded-2xl p-16 text-center text-gray-500 border border-gray-100 dark:border-gray-700 shadow-sm">
                <div class="w-16 h-16 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center mx-auto mb-4 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                </div>
                <p class="text-base font-bold text-gray-800 dark:text-gray-200">Belum Ada Jadwal Event Ditampilkan</p>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Nantikan pembaruan jadwal webinar hukum dan klinik konsultasi regulasi dalam waktu dekat.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $events->links() }}
    </div>
</x-admin-layout>
