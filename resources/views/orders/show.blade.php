<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Detail Pesanan: {{ $order->ref_number }}
        </h2>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Progress Tracker -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-6">Status Pesanan</h3>
                    
                    @php
                        $statuses = ['draft', 'waiting_approval', 'processing', 'client_review', 'completed'];
                        $currentIndex = array_search($order->status, $statuses);
                        if($order->status == 'revision') $currentIndex = 3;
                    @endphp

                    <div class="relative after:absolute after:inset-x-0 after:top-1/2 after:block after:h-0.5 after:-translate-y-1/2 after:rounded-lg after:bg-gray-200 dark:after:bg-gray-700">
                        <ol class="relative z-10 flex justify-between text-sm font-medium text-gray-500 dark:text-gray-400">
                            @foreach(['Pembayaran', 'Verifikasi', 'Diproses', 'Review', 'Selesai'] as $index => $label)
                                <li class="flex items-center gap-2 bg-white dark:bg-gray-800 p-2">
                                    <span class="h-6 w-6 rounded-full flex items-center justify-center text-xs 
                                        @if($index < $currentIndex) bg-blue-600 text-white 
                                        @elseif($index == $currentIndex) bg-blue-600 text-white ring-4 ring-blue-100 dark:ring-blue-900
                                        @else bg-gray-200 dark:bg-gray-700 @endif">
                                        {{ $index + 1 }}
                                    </span>
                                    <span class="hidden sm:block @if($index <= $currentIndex) text-blue-600 dark:text-blue-500 font-bold @endif">{{ $label }}</span>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Pesanan -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-bold mb-4">Informasi Layanan</h3>
                        <div class="space-y-3 text-sm">
                            <p><span class="font-semibold text-gray-500 dark:text-gray-400">Layanan:</span> {{ $order->service->name }}</p>
                            <p><span class="font-semibold text-gray-500 dark:text-gray-400">Tanggal Pesan:</span> {{ $order->created_at->format('d M Y H:i') }}</p>
                            <hr class="border-gray-200 dark:border-gray-700 my-2">
                            
                            @if($order->payload)
                                <h4 class="font-semibold mt-4 mb-2">Data Formulir:</h4>
                                @foreach($order->payload as $key => $value)
                                    @if(!empty($value) && !is_array($value))
                                        <p><span class="font-semibold text-gray-500 dark:text-gray-400">{{ ucwords(str_replace('_', ' ', $key)) }}:</span> {{ $value }}</p>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Dokumen -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-lg font-bold mb-4">Dokumen & Berkas</h3>
                        
                        <div class="space-y-4">
                            @forelse($order->documents as $doc)
                                <div class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-700 rounded-lg">
                                    <div class="flex items-center gap-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium">{{ $doc->original_name }}</p>
                                            <p class="text-xs text-gray-500 uppercase">{{ $doc->file_type }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('documents.download', $doc->id) }}" class="text-blue-600 hover:text-blue-800 dark:hover:text-blue-400" title="Unduh">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">Belum ada dokumen yang diunggah.</p>
                            @endforelse
                        </div>

                        @if($order->status == 'completed')
                            <div class="mt-6 p-4 bg-green-50 dark:bg-green-900/30 rounded-lg border border-green-200 dark:border-green-800">
                                <h4 class="font-bold text-green-800 dark:text-green-300 mb-2">Pesanan Selesai!</h4>
                                <p class="text-sm text-green-700 dark:text-green-400 mb-4">Dokumen legalitas Anda sudah terbit dan siap diunduh.</p>
                                <button class="w-full py-2 bg-green-600 hover:bg-green-700 text-white rounded-md font-semibold text-sm transition-colors shadow">
                                    Unduh Dokumen Final
                                </button>
                            </div>
                        @endif

                    </div>
                </div>
            </div>

            <!-- Log Aktivitas (Dummy for now) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Riwayat Aktivitas</h3>
                    <ul class="space-y-4 border-l-2 border-gray-200 dark:border-gray-700 ml-3">
                        <li class="pl-4 relative">
                            <span class="absolute w-3 h-3 bg-blue-600 rounded-full -left-[7px] top-1"></span>
                            <p class="text-sm font-medium">Pesanan Dibuat</p>
                            <p class="text-xs text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</p>
                        </li>
                        <li class="pl-4 relative">
                            <span class="absolute w-3 h-3 bg-gray-300 dark:bg-gray-600 rounded-full -left-[7px] top-1"></span>
                            <p class="text-sm font-medium text-gray-500">Menunggu Verifikasi Admin</p>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
