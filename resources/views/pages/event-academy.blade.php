@extends('layouts.frontend')
@section('content')
<section class="relative min-h-screen pt-32 pb-24 bg-gray-50 dark:bg-[#020508] overflow-hidden">
    <!-- Background Accents -->
    <div class="absolute top-1/4 left-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/3 right-10 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-12">
        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4 tracking-tight">
                Event Mendatang & Academy
            </h1>
            <p class="text-base md:text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                Tingkatkan wawasan kepatuhan dan kompetensi hukum korporat Anda melalui webinar eksklusif, workshop tatap muka, dan kelas sertifikasi LexaLink Academy.
            </p>
        </div>

        <!-- Full Width Gated Warning Banner (Sejajar dengan Konten) -->
        <!-- <div class="w-full p-4 sm:p-5 rounded-2xl bg-amber-50 dark:bg-amber-950/40 border border-amber-200 dark:border-amber-800 text-amber-900 dark:text-amber-200 shadow-sm transition hover:shadow">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 text-xs sm:text-sm">
                <div class="p-2.5 rounded-xl bg-amber-500/20 text-amber-600 dark:text-amber-400 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                </div>
                <div class="flex-1 leading-relaxed">
                    <span class="font-black tracking-wide uppercase text-[11px] text-amber-600 dark:text-amber-400 block mb-0.5">Sistem Eksklusif (Gated CRM Protection)</span>
                    Rincian penuh ruang Zoom/VIP, alamat lokasi gedung, materi lampiran, serta pendaftaran event hanya dapat diakses dan dilakukan secara resmi dari dalam <strong class="font-extrabold underline decoration-amber-500 underline-offset-2">Portal Dashboard Klien</strong>.
                </div>
                <a href="{{ route('login') }}" class="px-4 py-2.5 rounded-xl bg-amber-600 hover:bg-amber-700 text-white font-bold text-xs whitespace-nowrap shadow-md hover:shadow-lg transition-all transform active:scale-95">
                    Login Portal &rarr;
                </a>
            </div>
        </div> -->

        <!-- Section 1: Upcoming Events (CMS Driven) -->
        <div class="py-15 pt-12 sm:pt-14 mt-5">
            <div class="flex items-center justify-between mb-6 pb-3 border-b border-gray-200 dark:border-gray-800">
                <div>
                    <h2 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2.5">
                        <span class="w-3 h-3 rounded-full bg-green-500 animate-pulse"></span>
                    </h2>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Agenda terdekat yang saat ini membuka reservasi pendaftaran bagi para Klien LexaLink.</p>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                    {{ $upcomingEvents->count() }} Agenda Tersedia
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($upcomingEvents as $event)
                    <div class="bg-white dark:bg-[#0b1320] rounded-2xl border border-gray-200 dark:border-white/10 overflow-hidden shadow-md flex flex-col hover:-translate-y-1 transition-all duration-300">
                        <div class="h-48 w-full relative overflow-hidden bg-gray-900">
                            @if($event->cover_image)
                                <img src="{{ $event->cover_image }}" alt="{{ $event->title }}" class="w-full h-full object-cover opacity-95">
                            @endif
                            <div class="absolute top-3 left-3 px-2.5 py-1 rounded bg-black/70 backdrop-blur-md text-amber-400 font-extrabold text-[10px] uppercase tracking-wider">
                                {{ strtoupper($event->location_type) }}
                            </div>
                            <div class="absolute bottom-3 left-3 bg-white/90 dark:bg-gray-900/90 px-3 py-1 rounded-lg text-xs font-black text-blue-600 dark:text-blue-400 shadow">
                                📅 {{ $event->event_date ? $event->event_date->translatedFormat('d M Y') : '' }} &bull; {{ $event->event_time }}
                            </div>
                        </div>
                        
                        <div class="p-6 flex flex-col flex-1">
                            <h3 class="font-extrabold text-gray-900 dark:text-white text-lg mb-3 line-clamp-2 leading-snug">
                                {{ $event->title }}
                            </h3>
                            <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-3 mb-6 leading-relaxed flex-1">
                                {{ strip_tags($event->description) }}
                            </p>

                            <!-- Gated Action CTA -->
                            <div class="pt-4 border-t border-gray-100 dark:border-white/10 mt-auto">
                                <a href="{{ route('client.events.show', $event->slug) }}" class="w-full py-3 px-4 rounded-xl bg-blue-600 hover:bg-blue-700 text-white font-extrabold text-xs shadow hover:shadow-lg transition flex items-center justify-center gap-2 group">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-300 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" /></svg>
                                    <span>Klik Disini</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-12 text-center text-gray-400 bg-white dark:bg-[#0b1320] rounded-2xl border border-gray-200 dark:border-white/10">
                        Saat ini tidak ada event mendatang yang dipersiapkan.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Section 2: Arsip & Galeri Event Selesai (Completed) -->
        @if($completedEvents->count() > 0)
        <div class="pt-12 sm:pt-16 mt-6 border-t border-gray-200 dark:border-gray-800">
            <div class="mb-8 pb-4">
                <h2 class="text-2xl font-black text-gray-900 dark:text-white flex items-center gap-2.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                    <span>Arsip & Galeri Dokumentasi Kegiatan Selesai</span>
                </h2>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Saksikan antusiasme dan rekam jejak kolaborasi para praktisi dalam berbagai seminar & workshop LexaLink sebelumnya.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($completedEvents as $arc)
                    <div class="bg-white dark:bg-[#0b1320] rounded-xl border border-gray-200 dark:border-white/10 overflow-hidden shadow-sm hover:shadow-md transition">
                        <div class="h-44 relative overflow-hidden bg-gray-900">
                            @if($arc->cover_image)
                                <img src="{{ $arc->cover_image }}" class="w-full h-full object-cover opacity-90" alt="Archive">
                            @endif
                            <div class="absolute bottom-2 left-2 px-2 py-1 rounded bg-black/60 text-white text-[10px] font-mono">
                                ✅ Selesai: {{ $arc->event_date ? $arc->event_date->translatedFormat('d M Y') : '' }}
                            </div>
                        </div>
                        <div class="p-5">
                            <h4 class="font-bold text-gray-900 dark:text-white text-base mb-2 line-clamp-1">{{ $arc->title }}</h4>
                            <p class="text-xs text-gray-500 line-clamp-2 mb-4">{{ strip_tags($arc->description) }}</p>
                            
                            @if(is_array($arc->gallery) && count($arc->gallery) > 0)
                                <div class="flex gap-2 items-center mb-4 overflow-x-auto pb-1">
                                    @foreach(array_slice($arc->gallery, 0, 3) as $photo)
                                        <img src="{{ $photo }}" class="w-12 h-12 rounded-lg object-cover border border-white/20 shadow-sm flex-shrink-0" alt="Gal">
                                    @endforeach
                                    @if(count($arc->gallery) > 3)
                                        <span class="text-[11px] font-extrabold text-gray-500 pl-1">+{{ count($arc->gallery) - 3 }} Foto</span>
                                    @endif
                                </div>
                            @endif

                            <a href="{{ route('client.events.show', $arc->slug) }}" class="text-xs font-bold text-blue-600 dark:text-blue-400 inline-flex items-center gap-1 hover:underline">
                                <span>Lihat Dokumentasi Penuh (Portal)</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Section 3: LexaLink Academy Teaser (Prepared for Phase 4) -->
        <div class="py-20 sm:pt-10 border-t border-gray-200 dark:border-gray-800">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-8 gap-4">
                <div>
                    <span class="text-xs font-extrabold text-blue-600 dark:text-blue-400 uppercase tracking-widest">Sertifikasi & Kursus Hukum</span>
                    <h2 class="text-3xl font-black text-gray-900 dark:text-white mt-1">LexaLink Academy</h2>
                    <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-2 max-w-2xl">Program pelatihan hukum intensif berbasis modul dengan sertifikasi resmi terakreditasi dan dukungan tutor interaktif.</p>
                </div>
                <span class="px-3.5 py-1.5 rounded-lg bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-300 font-bold text-xs self-start md:self-auto">
                    🚀 LMS Upgrade: Segera Hadir
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Course 1 -->
                <div class="bg-white dark:bg-[#0b1320] rounded-2xl p-6 border border-gray-200 dark:border-white/10 shadow-sm flex flex-col">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&q=80&w=200" class="w-16 h-16 rounded-2xl object-cover shadow" alt="C1">
                        <div>
                            <span class="px-2 py-0.5 rounded bg-blue-100 text-blue-800 dark:bg-blue-900/40 dark:text-blue-300 font-extrabold text-[10px]">Corporate Law</span>
                            <div class="flex items-center gap-1 mt-1 text-xs text-yellow-500 font-bold">
                                <span>★★★★★</span>
                                <span class="text-gray-600 dark:text-gray-400 font-normal">(236 Ulasan)</span>
                            </div>
                        </div>
                    </div>
                    <h4 class="font-extrabold text-gray-900 dark:text-white text-base mb-2">Legal Drafting Masterclass</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-6 flex-1">Pelajar trik membedah klausul arbitrase, menyusun kontrak komersial rawan sengketa, dan standar draf hukum internasional.</p>
                    <div class="pt-4 border-t border-gray-100 dark:border-white/10 flex items-center justify-between text-xs font-bold">
                        <span class="text-gray-500">8 Modul &bull; Sertifikat</span>
                        <span class="text-blue-600 dark:text-blue-400">Siap Diakses Klien</span>
                    </div>
                </div>

                <!-- Course 2 -->
                <div class="bg-white dark:bg-[#0b1320] rounded-2xl p-6 border border-gray-200 dark:border-white/10 shadow-sm flex flex-col">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&q=80&w=200" class="w-16 h-16 rounded-2xl object-cover shadow" alt="C2">
                        <div>
                            <span class="px-2 py-0.5 rounded bg-green-100 text-green-800 dark:bg-green-900/40 dark:text-green-300 font-extrabold text-[10px]">Perizinan</span>
                            <div class="flex items-center gap-1 mt-1 text-xs text-yellow-500 font-bold">
                                <span>★★★★★</span>
                                <span class="text-gray-600 dark:text-gray-400 font-normal">(312 Ulasan)</span>
                            </div>
                        </div>
                    </div>
                    <h4 class="font-extrabold text-gray-900 dark:text-white text-base mb-2">Perizinan Berusaha (NIB & OSS RBA)</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-6 flex-1">Panduan praktis mitigasi kendala sistem OSS RBA, pengurusan kepatuhan lingkungan, dan persetujuan bangunan gedung (PBG).</p>
                    <div class="pt-4 border-t border-gray-100 dark:border-white/10 flex items-center justify-between text-xs font-bold">
                        <span class="text-gray-500">6 Modul &bull; Sertifikat</span>
                        <span class="text-blue-600 dark:text-blue-400">Siap Diakses Klien</span>
                    </div>
                </div>

                <!-- Course 3 -->
                <div class="bg-white dark:bg-[#0b1320] rounded-2xl p-6 border border-gray-200 dark:border-white/10 shadow-sm flex flex-col">
                    <div class="flex items-center gap-4 mb-4">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32b7?auto=format&fit=crop&q=80&w=200" class="w-16 h-16 rounded-2xl object-cover shadow" alt="C3">
                        <div>
                            <span class="px-2 py-0.5 rounded bg-purple-100 text-purple-800 dark:bg-purple-900/40 dark:text-purple-300 font-extrabold text-[10px]">Cyber Law</span>
                            <div class="flex items-center gap-1 mt-1 text-xs text-yellow-500 font-bold">
                                <span>★★★★★</span>
                                <span class="text-gray-600 dark:text-gray-400 font-normal">(198 Ulasan)</span>
                            </div>
                        </div>
                    </div>
                    <h4 class="font-extrabold text-gray-900 dark:text-white text-base mb-2">Corporate AI & UU PDP Compliance</h4>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mb-6 flex-1">Strategi merancang tata kelola kepatuhan data pribadi (UU No. 27/2022) dan protokol pengawasan sistem kecerdasan buatan.</p>
                    <div class="pt-4 border-t border-gray-100 dark:border-white/10 flex items-center justify-between text-xs font-bold">
                        <span class="text-gray-500">10 Modul &bull; Sertifikat</span>
                        <span class="text-blue-600 dark:text-blue-400">Siap Diakses Klien</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
