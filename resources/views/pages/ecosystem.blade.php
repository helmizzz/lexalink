@extends('layouts.frontend')

@section('content')
<section class="relative min-h-screen pt-32 pb-24 bg-gray-50 dark:bg-[#020508] overflow-hidden">
    <!-- Background Decor Accent -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-gradient-to-tr from-blue-500/10 to-indigo-500/10 dark:from-blue-600/10 dark:to-cyan-500/10 blur-[100px] pointer-events-none -z-10"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Title Section -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-3xl md:text-5xl font-black text-gray-900 dark:text-white tracking-tight mb-4">
                Satu Ecosystem. Banyak Solusi.
            </h1>
            <p class="text-sm md:text-base font-medium text-gray-600 dark:text-gray-400">
                Semua kebutuhan hukum dan legalitas terintegrasi dalam satu platform.
            </p>
        </div>

        <!-- 4-Column Ecosystem Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-7 items-stretch">
            
            <!-- Card 1: LexaLink -->
            <div class="bg-white dark:bg-white/5 rounded-xl p-8 shadow-sm border border-gray-100 dark:border-white/10 hover:shadow-md transition-all duration-300">
                <div>
                    <!-- ======================================================================
                         TUTORIAL MEMASUKKAN LOGO 1:
                         1. Taruh file foto/logo Anda di dalam folder: resources/img/ (misal: logo-lexalink.png)
                         2. Ganti blok <div> bergaris putus-putus di bawah ini dengan kode image ini:
                            <img src="{{ asset('resources/img/logo-lexalink.png') }}" alt="LexaLink" class="h-12 w-auto object-contain mb-6">
                         ====================================================================== -->
                    <div class="h-14 flex items-center mb-6 border-2 border-dashed border-blue-200 dark:border-blue-800 rounded-xl px-4 bg-blue-50/50 dark:bg-blue-950/20 text-blue-800 dark:text-blue-300 font-extrabold tracking-wider">
                        <span class="text-xl">LEXALINK</span>
                    </div>

                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed font-normal">
                        AI Legal Intelligence Platform untuk analisis hukum, regulasi, dan monitoring secara real-time.
                    </p>
                </div>

                <div class="mt-10 pt-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300 transition-colors">
                        <span>Jelajahi LexaLink</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:translate-x-1.5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card 2: Perizinankami.id -->
            <div class="bg-white dark:bg-white/5 rounded-xl p-8 shadow-sm border border-gray-100 dark:border-white/10 hover:shadow-md transition-all duration-300">
                <div>
                    <!-- ======================================================================
                         TUTORIAL MEMASUKKAN LOGO 2:
                         Ganti blok <div> di bawah ini dengan:
                         <img src="{{ asset('resources/img/logo-perizinan.png') }}" alt="perizinankami.id" class="h-12 w-auto object-contain mb-6">
                         ====================================================================== -->
                    <div class="h-14 flex items-center mb-6 border-2 border-dashed border-emerald-200 dark:border-emerald-800 rounded-xl px-4 bg-emerald-50/50 dark:bg-emerald-950/20 text-emerald-800 dark:text-emerald-300 font-extrabold tracking-tight">
                        <span class="text-lg">perizinankami<span class="font-normal">.id</span></span>
                    </div>

                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed font-normal">
                        Legalitas usaha & perizinan lebih mudah, cepat, dan 100% online.
                    </p>
                </div>

                <div class="mt-10 pt-4">
                    <a href="#" class="inline-flex items-center gap-1.5 text-sm font-bold text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300 transition-colors">
                        <span>Kunjungi Perizinankami.id</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:translate-x-1.5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card 3: Salman & Co -->
            <div class="bg-white dark:bg-white/5 rounded-xl p-8 shadow-sm border border-gray-100 dark:border-white/10 hover:shadow-md transition-all duration-300">
                <div>
                    <!-- ======================================================================
                         TUTORIAL MEMASUKKAN LOGO 3:
                         Ganti blok <div> di bawah ini dengan:
                         <img src="{{ asset('resources/img/logo-salman.png') }}" alt="Salman & Co" class="h-12 w-auto object-contain mb-6">
                         ====================================================================== -->
                    <div class="h-14 flex items-center mb-6 border-2 border-dashed border-amber-200 dark:border-amber-800 rounded-xl px-4 bg-amber-50/50 dark:bg-amber-950/20 text-amber-800 dark:text-amber-300 font-bold tracking-tight">
                        <span class="text-base font-serif">SALMAN & CO</span>
                    </div>

                    <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed font-normal">
                        Konsultasi & pendampingan hukum profesional untuk bisnis, korporasi, dan individu.
                    </p>
                </div>

                <div class="mt-10 pt-4">
                    <a href="#" class="inline-flex items-center gap-1.5 text-sm font-bold text-blue-600 dark:text-blue-400 group-hover:text-blue-700 dark:group-hover:text-blue-300 transition-colors">
                        <span>Lihat Layanan</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 transform group-hover:translate-x-1.5 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Card 4: Why LexaLink Ecosystem? (Feature Card) -->
            <div class="bg-[#000b2d] text-white border border-blue-900/50 rounded-xl p-8 shadow-xl relative overflow-hidden flex flex-col justify-between group" style="background-color: #000b2d;">
                
                <!-- Watermark Background Graphic (Scales of Justice) -->
                <div class="absolute -bottom-8 -right-8 text-white/[0.06] pointer-events-none transform -rotate-12 transition-all duration-700 group-hover:scale-110 group-hover:-rotate-3">
                </div>
                
                <!-- Soft Glow Effect in Card -->
                <div class="absolute -top-12 -right-12 w-32 h-32 bg-blue-500/20 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10">
                    <h3 class="text-xl font-extrabold text-white tracking-tight mb-8 flex items-center justify-between">
                        <span>Why LexaLink Ecosystem?</span>
                        <span class="w-2.5 h-2.5 rounded-full bg-blue-400 animate-pulse block sm:hidden"></span>
                    </h3>

                    <ul class="space-y-5 text-sm font-medium text-gray-200">
                        <li class="flex items-center gap-3.5 group/item">
                            <div class="w-6 h-6 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 flex-shrink-0 group-hover/item:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[16px]">key</span>
                            </div>
                            <span class="text-gray-100 font-semibold">AI & Data-Driven Insight</span>
                        </li>
                        <li class="flex items-center gap-3.5 group/item">
                            <div class="w-6 h-6 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 flex-shrink-0 group-hover/item:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[16px]">check</span>
                            </div>
                            <span class="text-gray-300">Kepatuhan & Regulasi Terpadu</span>
                        </li>
                        <li class="flex items-center gap-3.5 group/item">
                            <div class="w-6 h-6 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 flex-shrink-0 group-hover/item:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[16px]">check</span>
                            </div>
                            <span class="text-gray-300">Efisiensi & Akurasi Tinggi</span>
                        </li>
                        <li class="flex items-center gap-3.5 group/item">
                            <div class="w-6 h-6 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 flex-shrink-0 group-hover/item:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[16px]">check</span>
                            </div>
                            <span class="text-gray-300">Keamanan Data Terjamin</span>
                        </li>
                        <li class="flex items-center gap-3.5 group/item">
                            <div class="w-6 h-6 rounded-full bg-blue-500/20 flex items-center justify-center text-blue-400 flex-shrink-0 group-hover/item:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-[16px]">check</span>
                            </div>
                            <span class="text-gray-300">Tim Profesional & Berpengalaman</span>
                        </li>
                    </ul>
                </div>

                <div class="mt-12 pt-4 relative z-10 border-t border-white/10 text-[11px] text-gray-400 font-mono flex items-center justify-between">
                    <span>INTEGRATED PLATFORM</span>
                    <span class="text-blue-400 font-bold">100% ONLINE</span>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
