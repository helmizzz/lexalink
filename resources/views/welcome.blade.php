@extends('layouts.frontend')
@section('content')

<!-- Hero Section -->
 <section class="relative w-full overflow-hidden bg-[#000b2d] md:bg-[#000b2d] md:dark:bg-[#000b2d]">
    <!-- Mobile Background is now a solid color (#000e29), handled by the section class above -->
    
    <!-- Desktop Background (Absolute to cover entire section) -->
    <div class="hidden md:block absolute inset-0 z-0">
        <img src="{{ asset('bg/edit_bg_hero3.png') }}" alt="" class="w-full object-cover object-center">
    </div>
    
    <!-- Content Overlay (Relative, dictates section height) -->
    <div class="relative z-10 w-full py-12 md:py-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-8 w-full max-w-[1400px] mx-auto px-margin-mobile md:px-12">
            <!-- Left Side: Text Content -->
            <div class="flex flex-col items-start text-left bg-transparent p-4 md:p-0">
                <!-- Badge -->
                <div class="flex items-center gap-2 px-3 py-1 mb-3 md:mb-4 bg-blue-100 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800/50 rounded-full shadow-sm">
                    <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-[12px] md:text-[14px]">bolt</span>
                    <span class="text-[10px] md:text-[11px] font-bold tracking-wider text-blue-700 dark:text-blue-300 uppercase">Solusi Terdepan</span>
                </div>
                
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-white dark:text-white mb-3 md:mb-4 leading-tight">
                    Integrasi Cerdas Untuk Semua Layanan Anda
                </h2>
                
                <p class="text-sm md:text-base text-white dark:text-gray-300 mb-6 md:mb-8 max-w-lg leading-relaxed font-medium md:font-normal">
                    Tingkatkan produktivitas tim Anda dengan sistem manajemen otomatis yang mengintegrasikan semua kebutuhan perizinan secara real-time.
                </p>
                
                <div class="flex flex-wrap items-center gap-4 w-full sm:w-auto">
                <button class="w-full sm:w-auto bg-blue-600 text-white font-bold px-8 py-3.5 rounded-xl hover:bg-blue-700 transition-all shadow-lg shadow-blue-500/30 text-sm">
                    Mulai Sekarang
                </button>
                <button class="w-full sm:w-auto bg-transparent border border-gray-300 dark:border-white/20 text-white dark:text-white font-bold px-8 py-3.5 rounded-xl hover:bg-gray-100 dark:hover:bg-white/5 transition-all text-sm">
                    Lihat Demo
                </button>
            </div>

                <!-- Mobile Floating Cards (Visible only on mobile) -->
                <div class="flex md:hidden flex-col gap-3 mt-10 w-full">
                    <!-- LexaLink Mobile -->
                    <div class="bg-white rounded-xl shadow-lg flex items-center p-3 gap-3 w-full border border-gray-100">
                        <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-lg bg-blue-50">
                            <span class="material-symbols-outlined text-blue-600">account_balance</span>
                        </div>
                        <div class="w-px h-8 bg-gray-200"></div>
                        <div class="flex flex-col">
                            <h4 class="text-sm font-bold text-blue-900 leading-tight">LexaLink</h4>
                            <p class="text-[10px] text-gray-500 leading-tight">Platform Legal & Compliance</p>
                        </div>
                    </div>
                    <!-- Perizinankami Mobile -->
                    <div class="bg-white rounded-xl shadow-lg flex items-center p-3 gap-3 w-full border border-gray-100">
                        <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-lg bg-green-50">
                            <span class="material-symbols-outlined text-green-600">verified_user</span>
                        </div>
                        <div class="w-px h-8 bg-gray-200"></div>
                        <div class="flex flex-col">
                            <h4 class="text-sm font-bold text-blue-900 leading-tight">Perizinankami.id</h4>
                            <p class="text-[10px] text-gray-500 leading-tight">Perizinan & Legalitas Bisnis</p>
                        </div>
                    </div>
                    <!-- Salman & CO Mobile -->
                    <div class="bg-white rounded-xl shadow-lg flex items-center p-3 gap-3 w-full border border-gray-100">
                        <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-lg bg-yellow-50">
                            <span class="material-symbols-outlined text-yellow-600">gavel</span>
                        </div>
                        <div class="w-px h-8 bg-gray-200"></div>
                        <div class="flex flex-col">
                            <h4 class="text-sm font-bold text-blue-900 leading-tight">Salman & CO</h4>
                            <p class="text-[10px] text-gray-500 leading-tight">Kantor Hukum Profesional</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side: Empty for Static Image Focus -->
            <div class="hidden md:block"></div>
        </div>
    </div>

    <!-- Desktop Floating Cards (Positioned over the background image) -->
    <div class="hidden md:block absolute inset-0 z-20 pointer-events-none">
        <!-- Card 1: LexaLink (Tengah atas) -->
        <!-- Ubah persentase top & left di bawah ini untuk menggeser posisi card -->
        <div class="absolute pointer-events-auto hover:-translate-y-1 transition-transform cursor-pointer bg-white rounded-2xl shadow-xl flex items-center p-3 gap-2 w-48 lg:w-56 border border-gray-100" style="top: 25%; left: 45%;">
            <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-lg bg-blue-50">
                <span class="material-symbols-outlined text-blue-600 text-[20px] lg:text-[24px]">account_balance</span>
            </div>
            <div class="w-px h-8 bg-gray-200"></div>
            <div class="flex flex-col">
                <h4 class="text-sm lg:text-base font-bold text-blue-900 leading-tight">LexaLink</h4>
                <p class="text-[9px] lg:text-[10px] text-gray-500 leading-tight">Platform Legal & Compliance</p>
            </div>
        </div>

        <!-- Card 2: Perizinankami (Bawah Kiri) -->
        <!-- Ubah persentase top & left di bawah ini untuk menggeser posisi card -->
        <div class="absolute pointer-events-auto hover:-translate-y-1 transition-transform cursor-pointer bg-white rounded-2xl shadow-xl flex items-center p-3 gap-2 w-48 lg:w-56 border border-gray-100" style="top: 65%; left: 54%;">
            <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-lg bg-green-50">
                <span class="material-symbols-outlined text-green-600 text-[20px] lg:text-[24px]">verified_user</span>
            </div>
            <div class="w-px h-8 bg-gray-200"></div>
            <div class="flex flex-col">
                <h4 class="text-sm lg:text-base font-bold text-blue-900 leading-tight">Perizinankami.id</h4>
                <p class="text-[9px] lg:text-[10px] text-gray-500 leading-tight">Perizinan & Legalitas Bisnis</p>
            </div>
        </div>

        <!-- Card 3: Salman & CO (Kanan Tengah) -->
        <!-- Ubah persentase top & left di bawah ini untuk menggeser posisi card -->
        <div class="absolute pointer-events-auto hover:-translate-y-1 transition-transform cursor-pointer bg-white rounded-2xl shadow-xl flex items-center p-3 gap-2 w-48 lg:w-56 border border-gray-100" style="top: 45%; left: 83%;">
            <div class="w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-lg bg-yellow-50">
                <span class="material-symbols-outlined text-yellow-600 text-[20px] lg:text-[24px]">gavel</span>
            </div>
            <div class="w-px h-8 bg-gray-200"></div>
            <div class="flex flex-col">
                <h4 class="text-sm lg:text-base font-bold text-blue-900 leading-tight">Salman & CO</h4>
                <p class="text-[9px] lg:text-[10px] text-gray-500 leading-tight">Kantor Hukum Profesional</p>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section (Modernized 3-Column Dashboard) -->


<!-- Extended Hero: LexaLink Ecosystem -->

<!-- Custom Hero Background Section -->


<!-- Features Bento Grid -->
<section class="px-margin-mobile py-16 max-w-container-max mx-auto dark:bg-[#020508]">
<div class="mb-12">
<h2 class="font-headline-lg-mobile text-headline-lg-mobile text-gray-900 dark:text-white mb-4">Platform Riset Hukum Terbaik</h2>
<p class="text-gray-600 dark:text-on-surface-variant max-w-2xl">
                    Nama PT adalah platform riset hukum berbasis AI dengan akses ke jutaan dokumen putusan pengadilan dan peraturan perundang-undangan.
                </p>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
<!-- Feature 1 -->
<div class="tonal-layer-1 ai-gradient-border p-8 rounded-xl flex flex-col gap-4">
<div class="w-12 h-12 bg-secondary-container rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined text-primary">psychology</span>
</div>
<h3 class="font-headline-md text-headline-md text-gray-900 dark:text-white">Riset Hukum AI</h3>
<p class="text-gray-600 dark:text-on-surface-variant text-body-md">Merespons pertanyaan seputar hukum dengan mengacu pada jutaan regulasi Indonesia yang terverifikasi.</p>
</div>
<!-- Feature 2 -->
<div class="tonal-layer-1 p-8 rounded-xl flex flex-col gap-4">
<div class="w-12 h-12 bg-secondary-container rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined text-primary">edit_note</span>
</div>
<h3 class="font-headline-md text-headline-md text-gray-900 dark:text-white">Legal Drafting</h3>
<p class="text-gray-600 dark:text-on-surface-variant text-body-md">Susun berbagai jenis dokumen dalam satu klik, mulai dari kontrak hingga MoU secara profesional.</p>
</div>
<!-- Feature 3 -->
<div class="tonal-layer-1 p-8 rounded-xl flex flex-col gap-4">
<div class="w-12 h-12 bg-secondary-container rounded-lg flex items-center justify-center">
<span class="material-symbols-outlined text-primary">security</span>
</div>
<h3 class="font-headline-md text-headline-md text-gray-900 dark:text-white">Document Review</h3>
<p class="text-gray-600 dark:text-on-surface-variant text-body-md">Identifikasi risiko hukum dan dapatkan rekomendasi perbaikan dalam hitungan detik.</p>
</div>
</div>
</section>
<!-- Data Sections with Mockups -->


<!-- Core Features Section -->
<section class="py-12 bg-white dark:bg-[#020508] border-b border-gray-100 dark:border-white/5 relative z-20">
    <div class="max-w-[1400px] mx-auto px-margin-mobile md:px-12">
        <!-- Header -->
        <div class="flex flex-col md:flex-row items-center justify-between mb-10 gap-4">
            <h2 class="text-xl md:text-2xl font-extrabold text-gray-900 dark:text-white">Core Features LexaLink Intelligence</h2>
            <a href="#" class="inline-flex items-center gap-2 px-4 py-2 text-sm font-bold text-primary bg-primary/5 hover:bg-primary/10 border border-primary/20 rounded-lg transition-colors whitespace-nowrap">
                Lihat Semua Fitur <span class="material-symbols-outlined text-sm">arrow_forward</span>
            </a>
        </div>

        <!-- Features Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 md:gap-0 lg:divide-x divide-gray-100 dark:divide-white/10">
            
            <!-- Feature 1 -->
            <div class="lg:px-5 first:pl-0 last:pr-0">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-xl">support_agent</span>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white leading-tight">AI Legal Assistant</h3>
                </div>
                <p class="text-[13px] text-gray-500 dark:text-gray-400 leading-relaxed">
                    Tanya jawab hukum, draft dokumen, dan ringkasan regulasi berbasis AI.
                </p>
            </div>

            <!-- Feature 2 -->
            <div class="lg:px-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-xl">search</span>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white leading-tight">Regulatory Search</h3>
                </div>
                <p class="text-[13px] text-gray-500 dark:text-gray-400 leading-relaxed">
                    Cari UU, peraturan, kebijakan, dan dokumen hukum dalam satu platform.
                </p>
            </div>

            <!-- Feature 3 -->
            <div class="lg:px-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-xl">account_balance</span>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white leading-tight">Court Monitoring</h3>
                </div>
                <p class="text-[13px] text-gray-500 dark:text-gray-400 leading-relaxed">
                    Monitoring perkara, tracking status kasus, update otomatis dan notifikasi real-time.
                </p>
            </div>

            <!-- Feature 4 -->
            <div class="lg:px-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-violet-50 dark:bg-violet-900/20 text-violet-600 dark:text-violet-400 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-xl">analytics</span>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white leading-tight">Legal Analytics</h3>
                </div>
                <p class="text-[13px] text-gray-500 dark:text-gray-400 leading-relaxed">
                    Insight prediktif, analisis risiko, dan visualisasi data hukum.
                </p>
            </div>

            <!-- Feature 5 -->
            <div class="lg:px-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-sky-50 dark:bg-sky-900/20 text-sky-600 dark:text-sky-400 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-xl">description</span>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white leading-tight">Document Center</h3>
                </div>
                <p class="text-[13px] text-gray-500 dark:text-gray-400 leading-relaxed">
                    Pusat dokumen hukum, template, kontrak, dan preseden terpercaya.
                </p>
            </div>

            <!-- Feature 6 -->
            <div class="lg:px-5">
                <div class="flex items-center gap-3 mb-3">
                    <div class="w-10 h-10 rounded-full bg-orange-50 dark:bg-orange-900/20 text-orange-500 dark:text-orange-400 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-xl">policy</span>
                    </div>
                    <h3 class="text-sm font-bold text-gray-900 dark:text-white leading-tight">Compliance Monitor</h3>
                </div>
                <p class="text-[13px] text-gray-500 dark:text-gray-400 leading-relaxed">
                    Pantau kepatuhan regulasi dan kelola risiko secara sistematis.
                </p>
            </div>

        </div>
        
        <!-- Stats Bar Container (Added mt-12 for spacing) -->
        <div class="max-w-[1400px] mx-auto px-margin-mobile md:px-0 mt-12 md:mt-16">
        <div class="bg-[#000b2d] md:bg-[#000b2d] dark:bg-[#020508] rounded-2xl py-6 px-4 md:p-8 flex flex-wrap lg:flex-nowrap items-center justify-between gap-8 lg:gap-0 lg:divide-x divide-white/10 shadow-2xl border border-white/5">
            
            <!-- Stat 1 -->
            <div class="flex items-center gap-4 w-full sm:w-[45%] lg:w-full lg:justify-center px-2 lg:px-4">
                <span class="material-symbols-outlined text-4xl text-blue-500 drop-shadow-[0_0_10px_rgba(59,130,246,0.5)]">group</span>
                <div>
                    <h3 class="text-white font-extrabold text-xl md:text-2xl leading-none mb-1">10K+</h3>
                    <p class="text-gray-400 text-xs md:text-sm font-medium m-0">Pengguna Terdaftar</p>
                </div>
            </div>

            <!-- Stat 2 -->
            <div class="flex items-center gap-4 w-full sm:w-[45%] lg:w-full lg:justify-center px-2 lg:px-4">
                <span class="material-symbols-outlined text-4xl text-blue-500 drop-shadow-[0_0_10px_rgba(59,130,246,0.5)]">assignment_turned_in</span>
                <div>
                    <h3 class="text-white font-extrabold text-xl md:text-2xl leading-none mb-1">2K+</h3>
                    <p class="text-gray-400 text-xs md:text-sm font-medium m-0">Perizinan Selesai</p>
                </div>
            </div>

            <!-- Stat 3 -->
            <div class="flex items-center gap-4 w-full sm:w-[45%] lg:w-full lg:justify-center px-2 lg:px-4">
                <span class="material-symbols-outlined text-4xl text-blue-500 drop-shadow-[0_0_10px_rgba(59,130,246,0.5)]">work</span>
                <div>
                    <h3 class="text-white font-extrabold text-xl md:text-2xl leading-none mb-1">500+</h3>
                    <p class="text-gray-400 text-xs md:text-sm font-medium m-0">Klien Perusahaan</p>
                </div>
            </div>

            <!-- Stat 4 -->
            <div class="flex items-center gap-4 w-full sm:w-[45%] lg:w-full lg:justify-center px-2 lg:px-4">
                <span class="material-symbols-outlined text-4xl text-blue-500 drop-shadow-[0_0_10px_rgba(59,130,246,0.5)]" style="font-variation-settings: 'FILL' 1">star</span>
                <div>
                    <h3 class="text-white font-extrabold text-xl md:text-2xl leading-none mb-1">98%</h3>
                    <p class="text-gray-400 text-xs md:text-sm font-medium m-0">Tingkat Kepuasan</p>
                </div>
            </div>

            <!-- Stat 5 -->
            <div class="flex items-center gap-4 w-full sm:w-[100%] lg:w-full lg:justify-center px-2 lg:px-4">
                <span class="material-symbols-outlined text-4xl text-blue-500 drop-shadow-[0_0_10px_rgba(59,130,246,0.5)]">support_agent</span>
                <div>
                    <h3 class="text-white font-extrabold text-xl md:text-2xl leading-none mb-1">24/7</h3>
                    <p class="text-gray-400 text-xs md:text-sm font-medium m-0">Customer Support</p>
                </div>
            </div>

        </div>
    </div>
    </div>
</section>

<section class="py-16 overflow-hidden dark:bg-[#020508]">
<div class="max-w-container-max mx-auto px-margin-mobile grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
<div class="order-2 md:order-1 relative">
<img class="w-full h-auto rounded-2xl shadow-2xl border border-gray-200 dark:border-white/10 transition duration-300 hover:scale-[1.01]" alt="Hero Regulasi LexaLink" src="{{ asset('img/hero-regulasi.png') }}"/>
</div>
<div class="order-1 md:order-2">
<span class="text-primary-fixed-variant dark:text-primary font-label-sm text-label-sm mb-4 block uppercase tracking-widest">Pusat Data Lengkap</span>
<h2 class="font-headline-lg-mobile text-headline-lg-mobile text-gray-900 dark:text-white mb-6">Akses 300.000+ Dokumen Peraturan Terbaru</h2>
<p class="text-gray-600 dark:text-on-surface-variant mb-8 text-body-lg">Temukan Undang-Undang, Peraturan Pemerintah, hingga Peraturan Daerah di satu tempat. Lengkap dengan ringkasan poin-poin kunci instan.</p>
<button class="bg-gray-100 dark:bg-surface-container-highest text-gray-900 dark:text-white px-6 py-3 rounded-lg font-label-md text-label-md flex items-center gap-2 border border-gray-300 dark:border-white/10 hover:border-primary dark:hover:border-primary transition-all">
                        Lihat Sekarang <span class="material-symbols-outlined text-sm">arrow_forward</span>
</button>
</div>
</div>
</section>
<!-- Pricing Section -->
<section id="pricing" class="dark:bg-[#020508] px-margin-mobile py-20 max-w-container-max mx-auto text-center">
<h2 class="font-headline-lg text-headline-lg text-gray-900 dark:text-white mb-4">Investasi Cerdas untuk Riset Hukum</h2>
<p class="text-gray-600 dark:text-on-surface-variant mb-12 max-w-xl mx-auto">Coba gratis atau pilih paket premium untuk akses tanpa hambatan dengan fitur AI tercanggih.</p>
<div class="flex flex-col md:flex-row justify-center gap-8 items-stretch">
<!-- Free Plan -->
<div class="tonal-layer-1 p-8 rounded-xl w-full max-w-sm flex flex-col text-left">
<h4 class="font-label-md text-label-md text-outline uppercase mb-2">FREE PLAN</h4>
<div class="text-gray-900 dark:text-white font-headline-lg text-headline-lg mb-6">Gratis</div>
<ul class="flex flex-col gap-4 mb-10 flex-grow">
<li class="flex items-center gap-2 text-gray-600 dark:text-on-surface-variant"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Akses database hukum</li>
<li class="flex items-center gap-2 text-gray-600 dark:text-on-surface-variant"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> 3 Pencarian per hari</li>
<li class="flex items-center gap-2 text-gray-600 dark:text-on-surface-variant"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> 3 Prompt AI per hari</li>
<li class="flex items-center gap-2 text-outline line-through"><span class="material-symbols-outlined text-outline text-sm">cancel</span> Download dokumen</li>
</ul>
<button class="w-full border border-outline text-outline py-3 rounded-lg font-bold">Paket Saat Ini</button>
</div>
<!-- Premium Plan -->
<div class="tonal-layer-2 ai-gradient-border p-8 rounded-xl w-full max-w-sm flex flex-col text-left relative scale-105">
<div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-primary text-on-primary px-4 py-1 rounded-full text-label-sm font-bold">BEST DEAL</div>
<h4 class="font-label-md text-label-md text-primary uppercase mb-2">PREMIUM</h4>
<div class="text-gray-900 dark:text-white font-headline-lg text-headline-lg mb-2">Rp 239,000<span class="text-body-md text-outline">/Bulan</span></div>
<div class="text-tertiary font-label-sm text-label-sm mb-6">Termasuk 5 Voucher Konsultasi Gratis!</div>
<ul class="flex flex-col gap-4 mb-10 flex-grow">
<li class="flex items-center gap-2 text-gray-900 dark:text-white"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Pencarian tidak terbatas</li>
<li class="flex items-center gap-2 text-gray-900 dark:text-white"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Prompt AI &amp; Drafting UNLIMITED</li>
<li class="flex items-center gap-2 text-gray-900 dark:text-white"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> 50 Download per hari</li>
<li class="flex items-center gap-2 text-gray-900 dark:text-white"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Prioritas pencarian klien</li>
</ul>
<button class="w-full bg-primary text-on-primary py-4 rounded-lg font-bold shadow-[0_0_15px_rgba(0,116,217,0.3)]">Pesan Sekarang</button>
</div>
</div>
</section>
<!-- Testimonials -->

<!-- Feed & Updates Section -->
<section class="py-20 bg-gray-50 dark:bg-[#020508] relative border-t border-gray-100 dark:border-white/5">
    <div class="max-w-[1400px] mx-auto px-margin-mobile md:px-12">
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-3">
            
            <!-- Column 1: Legal Intelligence Feed -->
            <div class="bg-white dark:bg-white/5 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-white/10 flex flex-col h-full">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-gray-900 dark:text-white text-lg">Legal Intelligence Feed</h3>
                    <a href="#" class="text-primary text-[10px] font-bold hover:underline flex items-center gap-1 whitespace-nowrap">Lihat Semua Berita <span class="material-symbols-outlined text-[10px]">arrow_forward_ios</span></a>
                </div>
                <p class="text-gray-500 dark:text-gray-400 text-xs mb-6">Update hukum dan regulasi terbaru untuk Anda</p>
                
                <div class="flex flex-col gap-5">
                    <!-- Feed Item 1 -->
                    <div class="flex gap-4 group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1589829085413-56de8ae18c73?auto=format&fit=crop&q=80&w=150&h=150" class="w-16 h-16 rounded-xl object-cover flex-shrink-0 group-hover:scale-105 transition-transform" alt="Feed 1" />
                        <div>
                            <span class="text-[8px] font-bold px-2 py-0.5 bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400 rounded-sm mb-1 inline-block uppercase">Regulasi</span>
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white leading-tight group-hover:text-primary transition-colors">PP No. 21/2024 tentang Penyelenggaraan Perizinan Berusaha Berbasis Risiko</h4>
                            <div class="text-[10px] text-gray-400 mt-1">19 Mei 2024</div>
                        </div>
                    </div>
                    <!-- Feed Item 2 -->
                    <div class="flex gap-4 group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1505664177941-10543e3eb238?auto=format&fit=crop&q=80&w=150&h=150" class="w-16 h-16 rounded-xl object-cover flex-shrink-0 group-hover:scale-105 transition-transform" alt="Feed 2" />
                        <div>
                            <span class="text-[8px] font-bold px-2 py-0.5 bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400 rounded-sm mb-1 inline-block uppercase">Putusan MA</span>
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white leading-tight group-hover:text-primary transition-colors">Putusan MA No. 1234 K/Pdt/2024 Terkait Wanprestasi dalam Perjanjian Komersial</h4>
                            <div class="text-[10px] text-gray-400 mt-1">18 Mei 2024</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Column 2: Opini & Insight Hukum -->
            <div class="bg-white dark:bg-white/5 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-white/10 flex flex-col h-full">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-gray-900 dark:text-white text-lg">Opini & Insight Hukum</h3>
                    <a href="{{ route('opini-berita') }}" class="text-primary text-[10px] font-bold hover:underline flex items-center gap-1 whitespace-nowrap">Lihat Semua <span class="material-symbols-outlined text-[10px]">arrow_forward_ios</span></a>
                </div>
                <p class="text-gray-500 dark:text-gray-400 text-xs mb-6">Analisis mendalam dari para ahli</p>
                
                <div class="flex flex-col gap-6">
                    @if(isset($latestArticles) && $latestArticles->count() > 0)
                        @foreach($latestArticles as $index => $item)
                            @if($index === 0)
                                <!-- Insight Featured -->
                                <a href="{{ route('opini-berita.show', $item->slug) }}" class="group block cursor-pointer">
                                    <div class="flex items-center gap-2 mb-2">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item->author->name ?? 'Dr Budi Raharjo') }}&background=0284c7&color=fff" class="w-6 h-6 rounded-full" alt="Author" />
                                        <span class="text-xs font-bold text-gray-700 dark:text-gray-300 truncate">{{ $item->author->name ?? 'Dr. Budi Raharjo, S.H., LL.M.' }}</span>
                                        <span class="text-[10px] text-gray-400 ml-auto">{{ $item->published_at ? $item->published_at->translatedFormat('d M Y') : '' }}</span>
                                    </div>
                                    <h4 class="text-base font-bold text-gray-900 dark:text-white leading-tight group-hover:text-blue-500 transition-colors">{{ $item->title }}</h4>
                                </a>
                            @else
                                <!-- Insight Item -->
                                <a href="{{ route('opini-berita.show', $item->slug) }}" class="flex gap-4 group cursor-pointer">
                                    @if($item->cover_image)
                                        <img src="{{ $item->cover_image }}" class="w-16 h-16 rounded-xl object-cover flex-shrink-0 group-hover:scale-105 transition-transform" alt="{{ $item->title }}" />
                                    @else
                                        <div class="w-16 h-16 rounded-xl bg-gradient-to-br from-[#13253F] to-blue-900 flex items-center justify-center text-white font-bold text-xs flex-shrink-0">
                                            <span>LP</span>
                                        </div>
                                    @endif
                                    <div>
                                        <h4 class="text-sm font-bold text-gray-900 dark:text-white leading-tight group-hover:text-blue-500 transition-colors mb-2 line-clamp-2">{{ $item->title }}</h4>
                                        <div class="flex items-center gap-2">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($item->author->name ?? 'Tim Hukum') }}&background=random" class="w-4 h-4 rounded-full" alt="Author" />
                                            <span class="text-[10px] text-gray-600 dark:text-gray-400 truncate">{{ $item->author->name ?? 'LexaLink Expert' }}</span>
                                        </div>
                                        <div class="text-[10px] text-gray-400 mt-1">{{ $item->published_at ? $item->published_at->translatedFormat('d M Y') : '' }} &bull; {{ number_format($item->views_count) }} views</div>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    @else
                        <!-- Insight Featured (Fallback) -->
                        <div class="group cursor-pointer">
                            <div class="flex items-center gap-2 mb-2">
                                <img src="https://ui-avatars.com/api/?name=Dr+Budi+Raharjo&background=random" class="w-6 h-6 rounded-full" alt="Author" />
                                <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Dr. Budi Raharjo, S.H., LL.M.</span>
                                <span class="text-[10px] text-gray-400 ml-auto">20 Mei 2024</span>
                            </div>
                            <h4 class="text-base font-bold text-gray-900 dark:text-white leading-tight group-hover:text-primary transition-colors">Analisis UU PDP terhadap Bisnis Digital di Indonesia</h4>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Column 3: Event Mendatang -->
            <div class="bg-white dark:bg-white/5 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-white/10 flex flex-col h-full">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-gray-900 dark:text-white text-lg">Event Mendatang</h3>
                    <a href="{{ route('event-academy') }}" class="text-primary text-[10px] font-bold hover:underline flex items-center gap-1 whitespace-nowrap">Lihat Semua Event <span class="material-symbols-outlined text-[10px]">arrow_forward_ios</span></a>
                </div>
                <p class="text-gray-500 dark:text-gray-400 text-xs mb-6">Ikuti webinar & masterclass hukum eksklusif (Gated CRM)</p>
                
                <div class="flex flex-col gap-4">
                    @if(isset($latestEvents) && $latestEvents->count() > 0)
                        @foreach($latestEvents as $event)
                            <a href="{{ route('client.events.show', $event->slug) }}" title="Klik untuk login & mendaftar event di Area Klien" class="flex gap-4 group p-2.5 -mx-2 hover:bg-blue-50/60 dark:hover:bg-blue-900/20 rounded-xl transition-all border border-transparent hover:border-blue-200 dark:hover:border-blue-800/50">
                                <div class="w-14 h-14 rounded-xl border border-gray-200 dark:border-white/10 flex flex-col items-center justify-center flex-shrink-0 bg-white dark:bg-[#020508] shadow-sm group-hover:scale-105 transition-transform">
                                    <span class="text-base font-extrabold text-gray-900 dark:text-white leading-none">{{ $event->event_date ? $event->event_date->format('d') : '01' }}</span>
                                    <span class="text-[9px] font-extrabold text-blue-600 dark:text-blue-400 uppercase mt-0.5">{{ $event->event_date ? $event->event_date->translatedFormat('M') : 'Jan' }}</span>
                                </div>
                                <div class="flex-grow min-w-0">
                                    <h4 class="text-xs sm:text-sm font-bold text-gray-900 dark:text-white leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors line-clamp-2">
                                        {{ $event->title }}
                                    </h4>
                                    <div class="flex items-center justify-between mt-2 text-[10px]">
                                        <span class="text-gray-500 dark:text-gray-400 truncate max-w-[120px] font-medium">{{ strtoupper($event->location_type) }} &bull; {{ $event->event_time }}</span>
                                        <span class="px-2 py-0.5 bg-amber-100 text-amber-800 dark:bg-amber-900/40 dark:text-amber-300 font-extrabold text-[9px] rounded uppercase tracking-wider">
                                            Daftar (Klien) &rarr;
                                        </span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    @else
                        <div class="p-6 text-center text-xs text-gray-400">Belum ada agenda event mendatang.</div>
                    @endif
                </div>
            </div>

            <!-- Column 4: LexaLink Academy -->
            <div class="bg-white dark:bg-white/5 rounded-xl p-6 shadow-sm border border-gray-100 dark:border-white/10 flex flex-col h-full">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="font-bold text-gray-900 dark:text-white text-lg">LexaLink Academy</h3>
                    <a href="#" class="text-primary text-[10px] font-bold hover:underline flex items-center gap-1 whitespace-nowrap">Lihat Semua Kursus <span class="material-symbols-outlined text-[10px]">arrow_forward_ios</span></a>
                </div>
                <p class="text-gray-500 dark:text-gray-400 text-xs mb-6">Tingkatkan kompetensi hukum Anda</p>
                
                <div class="flex flex-col gap-5">
                    <!-- Course 1 -->
                    <div class="flex gap-4 group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&q=80&w=150&h=150" class="w-16 h-16 rounded-xl object-cover flex-shrink-0 group-hover:scale-105 transition-transform" alt="Course 1" />
                        <div class="flex flex-col w-full">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white leading-tight group-hover:text-primary transition-colors">Legal Drafting Masterclass</h4>
                            <div class="text-[10px] text-gray-500 dark:text-gray-400 mt-1">8 Modul &bull; Sertifikat</div>
                            <div class="flex justify-end mt-auto">
                                <div class="flex items-center gap-1 text-[10px] text-gray-600 dark:text-gray-300">
                                    <span class="material-symbols-outlined text-yellow-400 text-[12px]">star</span>
                                    <span class="font-bold">4.9</span>
                                    <span>(236)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Course 2 -->
                    <div class="flex gap-4 group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&q=80&w=150&h=150" class="w-16 h-16 rounded-xl object-cover flex-shrink-0 group-hover:scale-105 transition-transform" alt="Course 2" />
                        <div class="flex flex-col w-full">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white leading-tight group-hover:text-primary transition-colors">Perizinan Berusaha (NIB, OSS)</h4>
                            <div class="text-[10px] text-gray-500 dark:text-gray-400 mt-1">6 Modul &bull; Sertifikat</div>
                            <div class="flex justify-end mt-auto">
                                <div class="flex items-center gap-1 text-[10px] text-gray-600 dark:text-gray-300">
                                    <span class="material-symbols-outlined text-yellow-400 text-[12px]">star</span>
                                    <span class="font-bold">4.8</span>
                                    <span>(312)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Course 3 -->
                    <div class="flex gap-4 group cursor-pointer">
                        <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32b7?auto=format&fit=crop&q=80&w=150&h=150" class="w-16 h-16 rounded-xl object-cover flex-shrink-0 group-hover:scale-105 transition-transform" alt="Course 3" />
                        <div class="flex flex-col w-full">
                            <h4 class="text-sm font-bold text-gray-900 dark:text-white leading-tight group-hover:text-primary transition-colors">Corporate & Business Law</h4>
                            <div class="text-[10px] text-gray-500 dark:text-gray-400 mt-1">10 Modul &bull; Sertifikat</div>
                            <div class="flex justify-end mt-auto">
                                <div class="flex items-center gap-1 text-[10px] text-gray-600 dark:text-gray-300">
                                    <span class="material-symbols-outlined text-yellow-400 text-[12px]">star</span>
                                    <span class="font-bold">4.9</span>
                                    <span>(198)</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="relative py-20 bg-gray-50 dark:bg-fixed dark:bg-cover dark:bg-center overflow-hidden dark:bg-hero-pattern">
<!-- Gradient Overlay -->
 <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-12">
        <div class="bg-white dark:bg-[#050B14] rounded-2xl p-8 md:p-10 flex flex-col md:flex-row items-center justify-between gap-8 shadow-sm dark:shadow-xl relative overflow-hidden border border-gray-200 dark:border-white/5">
            <!-- Decorative background -->
            <div class="absolute inset-0 bg-gradient-to-r from-primary/5 to-transparent pointer-events-none"></div>
            
            <div class="relative z-10 flex-1 text-center md:text-left">
                <h2 class="font-headline-md text-headline-md text-gray-900 dark:text-white mb-2">Bergabunglah dengan LexaLink Ecosystem</h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base max-w-xl mx-auto md:mx-0">Ribuan profesional hukum dan bisnis telah mempercayai LexaLink.</p>
            </div>
            
            <div class="relative z-10 w-full md:w-auto">
                <form class="flex flex-col sm:flex-row gap-3 w-full max-w-lg mx-auto md:mx-0" onsubmit="event.preventDefault();">
                    <input type="email" placeholder="Masukkan email Anda" class="w-full sm:w-80 px-4 py-3 rounded-xl border border-gray-200 dark:border-white/10 focus:ring-2 focus:ring-primary outline-none text-gray-900 dark:text-white bg-gray-50 dark:bg-[#020508] text-sm transition-colors" required>
                    <button type="submit" class="bg-blue-600 text-white font-bold px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 whitespace-nowrap text-sm shadow-lg shadow-blue-500/20">
                        Daftar Sekarang <span class="material-symbols-outlined text-sm font-bold">arrow_forward</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
<div class="absolute inset-0 dark:bg-gradient-to-b dark:from-[#050B10] dark:via-[#050B10]/80 dark:to-[#050B10] z-0"></div>
<div class="relative z-10 max-w-3xl mx-auto px-margin-mobile">
<!-- <h2 class="font-headline-lg text-headline-lg text-gray-900 dark:text-white mb-12 text-center">Pertanyaan Umum</h2>
<div class="space-y-4">
<details class="tonal-layer-1 backdrop-blur-md bg-white border border-gray-200 dark:bg-white/5 dark:border-white/10 rounded-lg group transition-colors hover:bg-gray-100 dark:hover:bg-white/10">
<summary class="p-6 cursor-pointer list-none flex justify-between items-center text-gray-900 dark:text-white font-bold hover:text-primary transition-colors">
                        Apa itu Nama PT?
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="p-6 pt-0 text-gray-600 dark:text-on-surface-variant">
                        Nama PT adalah platform kecerdasan buatan (AI) yang dirancang khusus untuk para praktisi hukum sebagai asisten hukum cerdas yang membantu riset hingga analisis dokumen.
                    </div>
</details>
<details class="tonal-layer-1 backdrop-blur-md bg-white border border-gray-200 dark:bg-white/5 dark:border-white/10 rounded-lg group transition-colors hover:bg-gray-100 dark:hover:bg-white/10">
<summary class="p-6 cursor-pointer list-none flex justify-between items-center text-gray-900 dark:text-white font-bold hover:text-primary transition-colors">
                        Apa yang membedakan Nama PT dengan ChatGPT?
                        <span class="material-symbols-outlined group-open:rotate-180 transition-transform">expand_more</span>
</summary>
<div class="p-6 pt-0 text-gray-600 dark:text-on-surface-variant">
                        Nama PT dilatih khusus dengan database hukum Indonesia yang terverifikasi, memberikan referensi langsung ke dokumen asli, dan memahami terminologi hukum lokal secara akurat.
                    </div>
</details>
</div>
</div> -->
</section>
<!-- <section class="py-12 bg-gray-50 dark:bg-[#020508]">
    <div class="max-w-[1200px] mx-auto px-margin-mobile md:px-12">
        <div class="bg-white dark:bg-[#050B14] rounded-2xl p-8 md:p-10 flex flex-col md:flex-row items-center justify-between gap-8 shadow-sm dark:shadow-xl relative overflow-hidden border border-gray-200 dark:border-white/5">
            ##Decorative background
            <div class="absolute inset-0 bg-gradient-to-r from-primary/5 to-transparent pointer-events-none"></div>
            
            <div class="relative z-10 flex-1 text-center md:text-left">
                <h2 class="font-headline-md text-headline-md text-gray-900 dark:text-white mb-2">Bergabunglah dengan LexaLink Ecosystem</h2>
                <p class="text-gray-600 dark:text-gray-400 text-sm md:text-base max-w-xl mx-auto md:mx-0">Ribuan profesional hukum dan bisnis telah mempercayai LexaLink.</p>
            </div>
            
            <div class="relative z-10 w-full md:w-auto">
                <form class="flex flex-col sm:flex-row gap-3 w-full max-w-lg mx-auto md:mx-0" onsubmit="event.preventDefault();">
                    <input type="email" placeholder="Masukkan email Anda" class="w-full sm:w-80 px-4 py-3 rounded-xl border border-gray-200 dark:border-white/10 focus:ring-2 focus:ring-primary outline-none text-gray-900 dark:text-white bg-gray-50 dark:bg-[#020508] text-sm transition-colors" required>
                    <button type="submit" class="bg-blue-600 text-white font-bold px-6 py-3 rounded-xl hover:bg-blue-700 transition-colors flex items-center justify-center gap-2 whitespace-nowrap text-sm shadow-lg shadow-blue-500/20">
                        Daftar Sekarang <span class="material-symbols-outlined text-sm font-bold">arrow_forward</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section> -->

@endsection
