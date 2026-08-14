<x-admin-layout>
    <!-- Breadcrumb -->
    <div class="mb-6 flex items-center justify-between">
        <a href="{{ route('client.events.index') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-blue-600 dark:text-gray-400 dark:hover:text-blue-400 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            Kembali ke Katalog Event
        </a>

        <span class="px-3 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider {{ $event->status === 'upcoming' ? 'bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300' : 'bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300' }}">
            Status: {{ strtoupper($event->status) }}
        </span>
    </div>

    @if(session('success'))
        <div class="mb-6 p-5 rounded-2xl bg-green-50 border border-green-200 text-green-800 dark:bg-green-900/40 dark:border-green-700 dark:text-green-200 shadow-sm flex items-center gap-3">
            <div class="p-2 bg-green-500 text-white rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
            </div>
            <div>
                <h4 class="font-extrabold text-sm">Registrasi Berhasil!</h4>
                <p class="text-xs text-green-700 dark:text-green-300 mt-0.5">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Cover Poster -->
            <div class="rounded-2xl overflow-hidden bg-gray-900 shadow-lg border border-gray-100 dark:border-gray-700 relative">
                @if($event->cover_image)
                    <img src="{{ $event->cover_image }}" alt="{{ $event->title }}" class="w-full h-80 sm:h-96 object-cover opacity-95">
                @else
                    <div class="h-80 bg-gradient-to-br from-[#0c182c] via-[#13253F] to-blue-900 flex items-center justify-center text-amber-400 font-bold text-3xl">
                        {{ $event->title }}
                    </div>
                @endif
                <div class="absolute bottom-4 left-4 bg-black/70 backdrop-blur-md px-3.5 py-1.5 rounded-lg border border-white/10 text-white font-bold text-xs uppercase tracking-wide flex items-center gap-2">
                    <span class="w-2 h-2 rounded-full bg-blue-500 animate-pulse"></span>
                    Tipe Acara: {{ strtoupper($event->location_type) }}
                </div>
            </div>

            <!-- Title & Metadata -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 dark:border-gray-700">
                <h1 class="text-2xl sm:text-3xl font-black text-gray-900 dark:text-white leading-tight mb-4">
                    {{ $event->title }}
                </h1>

                <div class="flex flex-wrap items-center gap-4 py-3.5 border-y border-gray-100 dark:border-gray-700 text-xs sm:text-sm text-gray-600 dark:text-gray-300">
                    <div class="flex items-center gap-2 font-bold text-blue-600 dark:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        {{ $event->event_date ? $event->event_date->translatedFormat('l, d F Y') : '-' }}
                    </div>
                    <span>&bull;</span>
                    <div class="flex items-center gap-2 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Jam: <strong class="text-gray-800 dark:text-gray-100">{{ $event->event_time }}</strong>
                    </div>
                    <span>&bull;</span>
                    <div class="flex items-center gap-2 text-gray-500 truncate max-w-xs">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ $event->location ?? 'Platform Online / Portal' }}
                    </div>
                </div>

                <!-- Rich Text Content -->
                <div class="prose dark:prose-invert max-w-none text-sm sm:text-base text-gray-700 dark:text-gray-300 mt-6 leading-relaxed">
                    {!! $event->description !!}
                </div>
            </div>

            <!-- Gallery Documentation if available -->
            @if(is_array($event->gallery) && count($event->gallery) > 0)
                <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 dark:border-gray-700">
                    <h3 class="font-bold text-xl text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        <span>Galeri & Dokumentasi Kegiatan</span>
                    </h3>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach($event->gallery as $imgUrl)
                            <a href="{{ $imgUrl }}" target="_blank" class="block h-40 rounded-xl overflow-hidden group border border-gray-200 dark:border-gray-700 shadow-sm relative">
                                <img src="{{ $imgUrl }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300" alt="Gallery">
                                <div class="absolute inset-0 bg-black/30 opacity-0 group-hover:opacity-100 transition flex items-center justify-center text-white text-xs font-bold">
                                    Perbesar
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>

        <!-- Right Column: Registration CTA & GATED Actions -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700 sticky top-6">
                <div class="text-center pb-5 border-b border-gray-100 dark:border-gray-700">
                    <span class="inline-block px-3 py-1 bg-amber-500/10 border border-amber-500/30 text-amber-600 dark:text-amber-400 font-extrabold text-xs rounded-full uppercase tracking-wider mb-2">
                        Akses Eksklusif Klien
                    </span>
                    <h2 class="text-xl font-extrabold text-gray-900 dark:text-white">Pendaftaran Event</h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Khusus bagi Klien Resmi & Mitra Hukum LexaLink.</p>
                </div>

                <div class="py-5 space-y-4">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-gray-500 dark:text-gray-400 font-medium">Biaya Registrasi:</span>
                        <span class="font-extrabold text-green-600 text-sm">GRATIS (Benefit Klien)</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-gray-500 dark:text-gray-400 font-medium">Sertifikat e-Certificate:</span>
                        <span class="font-bold text-gray-800 dark:text-gray-200">Tersedia untuk Peserta</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-gray-500 dark:text-gray-400 font-medium">Materi & Deck Presentasi:</span>
                        <span class="font-bold text-gray-800 dark:text-gray-200">Bisa Diunduh Pasca Event</span>
                    </div>
                </div>

                @if($isRegistered)
                    <div class="p-4 rounded-xl bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-700 text-center space-y-3">
                        <div class="inline-flex p-2 bg-green-500 text-white rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <h4 class="font-extrabold text-sm text-green-900 dark:text-green-200">Anda Sudah Terdaftar!</h4>
                        <p class="text-xs text-green-700 dark:text-green-300">Tempat Anda dalam sesi ini sudah direservasi. Tim kami akan mengirimkan tautan akses ke Email dan WhatsApp Anda 24 jam sebelum acara.</p>
                        @if($event->registration_link)
                            <a href="{{ $event->registration_link }}" target="_blank" class="block w-full py-2 px-4 rounded-lg bg-green-600 hover:bg-green-700 text-white font-bold text-xs shadow transition">
                                Buka Ruang Pertemuan / Zoom &rarr;
                            </a>
                        @endif
                    </div>
                @elseif($event->status === 'upcoming')
                    <form action="{{ route('client.events.register', $event) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-3.5 px-4 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-extrabold text-sm rounded-xl shadow-lg hover:shadow-xl transition duration-300 transform active:scale-95 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-300 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            <span>Daftar Event Ini Sekarang (1-Click)</span>
                        </button>
                    </form>
                @else
                    <div class="p-4 rounded-xl bg-gray-100 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 text-center text-xs text-gray-500 dark:text-gray-400 font-medium">
                        Event ini telah berlangsung (Selesai). Pendaftaran saat ini sudah ditutup. Silakan pelajari ringkasan materi atau galeri di atas.
                    </div>
                @endif

                <div class="mt-6 pt-5 border-t border-gray-100 dark:border-gray-700 flex items-center justify-center gap-2 text-[11px] text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    <span>Dilindungi oleh Sistem Enkripsi Portal LexaLink</span>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
