@extends('layouts.frontend')
@section('content')

<!-- Tentang Kami Section -->
<section class="relative min-h-[70vh] flex items-center justify-center pt-32 pb-24 bg-gray-50 dark:bg-[#020508]">
    <div class="max-w-[1000px] mx-auto px-margin-mobile md:px-12 text-center z-10">
        <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 dark:text-white mb-6">Tentang Kami</h1>
        <p class="text-md md:text-md text-gray-600 dark:text-gray-400 leading-relaxed mb-16 max-w-3xl mx-auto">
            LexaLink berdedikasi untuk merevolusi industri hukum dengan teknologi <b>Artificial Intelligence</b>. Kami percaya bahwa akses terhadap informasi hukum, analisis regulasi, dan riset perundangan harus menjadi lebih cepat, akurat, dan transparan.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
            <!-- Visi -->
            <div class="bg-white dark:bg-white/5 rounded-xl p-8 shadow-sm border border-gray-100 dark:border-white/10 hover:shadow-md transition-all duration-300">
                <!-- <div class="w-16 h-16 rounded-2xl bg-blue-100 text-blue-600 dark:bg-blue-900/30 dark:text-blue-400 flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-4xl">visibility</span>
                </div> -->
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Visi Kami</h3>
                <p class="text-gray-600 dark:text-gray-400 leading-relaxed text-body-md">
                    Menjadi pionir dan standar utama dalam platform infrastruktur hukum cerdas di Asia Tenggara, memberdayakan setiap profesional hukum, korporasi, dan institusi dengan insight yang presisi di era digital.
                </p>
            </div>

            <!-- Misi -->
            <div class="bg-white dark:bg-white/5 rounded-xl p-8 shadow-sm border border-gray-100 dark:border-white/10 hover:shadow-md transition-all duration-300">
                <!-- <div class="w-16 h-16 rounded-2xl bg-green-100 text-green-600 dark:bg-green-900/30 dark:text-green-400 flex items-center justify-center mb-6">
                    <span class="material-symbols-outlined text-4xl">rocket_launch</span>
                </div> -->
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Misi Kami</h3>
                <ul class="text-gray-600 dark:text-gray-400 leading-relaxed space-y-4 text-body-md">
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-xl mt-0.5">check_circle</span>
                        <span>Menyediakan database hukum yang komprehensif, terintegrasi, dan terus diperbarui secara <i>real-time</i>.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-xl mt-0.5">check_circle</span>
                        <span>Mengembangkan teknologi AI generatif untuk mereduksi waktu riset hukum hingga 80%.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-xl mt-0.5">check_circle</span>
                        <span>Mendorong transparansi dan kepatuhan (<i>compliance</i>) dengan menyediakan alat analisis risiko yang akurat.</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->


@endsection
