@extends('layouts.frontend')
@section('content')
<section class="relative min-h-screen pt-32 pb-24 bg-gray-50 dark:bg-[#020508] overflow-hidden">
    <!-- Background Glass Accents -->
    <div class="absolute top-1/4 right-10 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute bottom-1/3 left-10 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 space-y-12">
        <!-- Header Section -->
        <div class="text-center max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-4 tracking-tight">
                Database Riset & Regulasi Hukum
            </h1>
            <p class="text-base md:text-lg text-gray-600 dark:text-gray-400 leading-relaxed">
                Jelajahi perpustakaan digital Undang-Undang, Peraturan Pemerintah, Putusan Mahkamah Agung, serta jurnal kajian strategis kepatuhan AI dan bisnis korporat Indonesia.
            </p>
        </div>

        <!-- Full Width Gated Vault Banner (Sejajar dengan Konten) -->
        <!-- <div class="w-full p-5 sm:p-6 rounded-3xl bg-gradient-to-r from-[#0a1118] via-[#111c2a] to-[#1e1a38] text-white border border-purple-500/30 shadow-xl transition">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4 text-xs sm:text-sm">
                <div class="p-3 rounded-2xl bg-purple-500/20 text-purple-400 border border-purple-500/30 flex-shrink-0 shadow-inner">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <div class="flex-1 leading-relaxed">
                    <span class="font-black tracking-wide uppercase text-xs text-purple-400 block mb-1">Sistem Proteksi Eksklusif (Gated Research Vault)</span>
                    Pengunjung publik dapat menelusuri katalog nomor undang-undang dan membaca intisari abstrak hukum. Pengunduhan dokumen orisinal berkekuatan hukum lengkap (.PDF / Word) <strong class="text-white underline decoration-purple-500 underline-offset-2">HANYA dibuka secara eksklusif bagi Klien terdaftar</strong> di Portal Dasbor LexaLink.
                </div>
                <a href="{{ route('login') }}" class="px-5 py-3 rounded-2xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-extrabold text-xs uppercase tracking-wider whitespace-nowrap shadow-lg shadow-purple-500/20 transition-all transform active:scale-95 flex-shrink-0">
                    🔒 Login Portal Klien &rarr;
                </a>
            </div>
        </div> -->

        <!-- Interactive Search & Filter Directory -->
        <div class="p-4 sm:p-5 rounded-2xl bg-white dark:bg-[#0b1320] border border-gray-200 dark:border-white/10 shadow-sm">
            <form action="{{ route('resources.page') }}" method="GET" class="flex flex-col md:flex-row gap-3">
                <div class="flex-1 relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor undang-undang (contoh: UU-27/2022), judul putusan, atau kata kunci topik..." class="w-full pl-11 pr-4 py-3 text-xs sm:text-sm rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-[#0e1726] text-gray-900 dark:text-white font-medium focus:outline-none focus:ring-2 focus:ring-purple-500/50 shadow-inner">
                </div>

                <select name="category" class="px-4 py-3 text-xs font-bold rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-[#0e1726] text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500/50">
                    <option value="">-- Semua Kategori --</option>
                    @if(isset($categories))
                        @foreach($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    @endif
                </select>

                <select name="year" class="px-4 py-3 text-xs font-bold rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-[#0e1726] text-gray-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500/50">
                    <option value="">-- Semua Tahun --</option>
                    @if(isset($years))
                        @foreach($years as $yr)
                            <option value="{{ $yr }}" {{ request('year') == $yr ? 'selected' : '' }}>{{ $yr }}</option>
                        @endforeach
                    @endif
                </select>

                <button type="submit" class="px-2 py-3 bg-purple-600 hover:bg-purple-700 font-black text-xs uppercase tracking-wider rounded-xl shadow-lg shadow-purple-500/20 transition flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </button>
                @if(request()->hasAny(['search', 'category', 'year']))
                    <a href="{{ route('resources.page') }}" class="px-4 py-3 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 text-gray-700 dark:text-gray-300 font-bold text-xs rounded-xl transition text-center flex items-center justify-center whitespace-nowrap">
                        Reset
                    </a>
                @endif
            </form>
        </div>

        <!-- Resources Cards Directory -->
        <div class="space-y-6 py-20">
            <div class="flex items-center justify-between px-1">
                <span class="px-3.5 py-1 rounded-full text-xs font-extrabold bg-purple-50 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300">
                    {{ isset($resources) ? $resources->total() : 0 }} Dokumen Terverifikasi
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(isset($resources))
                    @forelse($resources as $item)
                        <div class="bg-white dark:bg-[#0b1320] rounded-2xl border border-gray-200 dark:border-white/10 p-6 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-5">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="px-2.5 py-1 rounded-md font-mono font-black text-xs bg-purple-500/10 text-purple-600 dark:text-purple-400 border border-purple-500/20">
                                        {{ $item->document_number }}
                                    </span>
                                    <span class="text-xs font-black text-gray-400 dark:text-gray-500">
                                        Tahun {{ $item->year }}
                                    </span>
                                </div>

                                <h3 class="text-base font-extrabold text-gray-900 dark:text-white line-clamp-2 leading-snug hover:text-purple-600 transition">
                                    {{ $item->title }}
                                </h3>

                                <div class="inline-block px-2.5 py-1 rounded font-extrabold text-[10px] uppercase tracking-wider
                                    @if($item->category == 'Undang-Undang') bg-blue-50 text-blue-600 dark:bg-blue-900/30 dark:text-blue-300
                                    @elseif($item->category == 'Putusan MA') bg-amber-50 text-amber-600 dark:bg-amber-900/30 dark:text-amber-300
                                    @elseif($item->category == 'Regulasi AI') bg-purple-50 text-purple-600 dark:bg-purple-900/30 dark:text-purple-300
                                    @else bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-300 @endif">
                                    {{ $item->category }}
                                </div>

                                <p class="text-xs text-gray-600 dark:text-gray-400 line-clamp-3 leading-relaxed border-l-2 border-purple-500/30 pl-3">
                                    {{ strip_tags($item->abstract) }}
                                </p>

                                @if(is_array($item->tags) && count($item->tags) > 0)
                                    <div class="flex flex-wrap gap-1 pt-2">
                                        @foreach(array_slice($item->tags, 0, 4) as $tag)
                                            <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400">#{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Lead Gen Gated Download Button -->
                            <div class="pt-4 border-t border-gray-100 dark:border-white/5 space-y-2">
                                <div class="flex items-center justify-between text-xs font-bold text-gray-400 px-1">
                                    <span>Format: Digital PDF</span>
                                    <span>Diunduh {{ number_format($item->downloads_count) }}x</span>
                                </div>

                                @auth
                                    <a href="{{ route('client.resources.show', $item->slug) }}" class="w-full py-3 rounded-xl bg-purple-600 hover:bg-purple-700 font-black text-xs text-center flex items-center justify-center gap-2 shadow-md hover:shadow-lg transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                        <span>Unduh PDF</span>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="w-full py-3 rounded-xl bg-gradient-to-r from-gray-900 to-purple-900 hover:from-black hover:to-purple-800 dark:from-purple-900/80 dark:to-indigo-900/80 dark:hover:from-purple-800 dark:hover:to-indigo-800 text-white font-extrabold text-xs text-center flex items-center justify-center gap-2 shadow-md hover:shadow-xl border border-white/10 transition group">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-amber-400 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        <span>Login Klien untuk Unduh PDF</span>
                                    </a>
                                @endauth
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full p-12 text-center rounded-2xl bg-white dark:bg-[#0b1320] border border-gray-200 dark:border-white/10 text-gray-500">
                            <h4 class="text-base font-black text-gray-900 dark:text-white">Tidak Ada Regulasi yang Cocok dengan Filter</h4>
                            <p class="text-xs text-gray-400 mt-1">Silahkan reset kata kunci pencarian Anda atau cek kembali secara berkala.</p>
                        </div>
                    @endforelse
                @endif
            </div>

            @if(isset($resources) && $resources->hasPages())
                <div class="pt-6">
                    {{ $resources->links() }}
                </div>
            @endif
        </div>

        <!-- Conversion Lead Banner at Bottom -->
        <!-- <div class="p-8 rounded-3xl bg-gradient-to-r from-purple-600 via-indigo-600 to-blue-600 text-white text-center sm:text-left flex flex-col sm:flex-row items-center justify-between gap-6 shadow-2xl">
            <div class="space-y-2 max-w-2xl">
                <h3 class="text-2xl sm:text-3xl font-black">Butuh Riset Hukum Spesifik atau Analisis Kepatuhan Custom?</h3>
                <p class="text-sm text-purple-100 leading-relaxed">Tim ahli hukum LexaLink siap membantu merajut kajian mendalam dan drafting kontrak hukum bersertifikasi untuk kemajuan bisnis Anda.</p>
            </div>
            <a href="{{ route('kontak') }}" class="px-7 py-4 bg-white text-gray-900 hover:bg-gray-100 rounded-2xl font-black text-sm whitespace-nowrap shadow-lg transform active:scale-95 transition">
                Konsultasi Tim Riset &rarr;
            </a>
        </div> -->
    </main>
</section>
@endsection
