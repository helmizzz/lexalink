<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Halo, {{ Auth::user()->name }}! 👋
        </h2>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Summary Panels -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Active Documents -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-blue-500">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium uppercase">Dokumen Aktif</p>
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ $activeCount }}</p>
                        </div>
                        <div class="text-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Unpaid Invoices -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-red-500">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium uppercase">Menunggu Pembayaran</p>
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ $unpaidCount }}</p>
                        </div>
                        <div class="text-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Completed Documents -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500">
                    <div class="p-6 text-gray-900 dark:text-gray-100 flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 dark:text-gray-400 font-medium uppercase">Dokumen Selesai</p>
                            <p class="text-3xl font-bold text-gray-800 dark:text-gray-200">{{ $completedCount }}</p>
                        </div>
                        <div class="text-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end mb-4">
                <a href="{{ route('orders.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150 shadow">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Buat Pesanan Baru
                </a>
            </div>

            <!-- Recent Orders -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-bold mb-4">Riwayat Pemesanan</h3>
                    
                    @if($orders->isEmpty())
                        <div class="text-center py-8 text-gray-500 dark:text-gray-400">
                            <p>Belum ada pesanan.</p>
                            <a href="{{ route('orders.create') }}" class="text-blue-500 hover:underline mt-2 inline-block">Pesan layanan pertama Anda</a>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b dark:border-gray-600">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">No. Order</th>
                                        <th scope="col" class="px-6 py-3">Layanan</th>
                                        <th scope="col" class="px-6 py-3">Tanggal</th>
                                        <th scope="col" class="px-6 py-3">Status</th>
                                        <th scope="col" class="px-6 py-3">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $order->ref_number }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $order->service->name ?? 'Layanan' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $order->created_at->format('d M Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 rounded text-xs font-semibold
                                                @if($order->status == 'completed') bg-green-100 text-green-800
                                                @elseif($order->status == 'draft' || $order->status == 'waiting_approval') bg-yellow-100 text-yellow-800
                                                @else bg-blue-100 text-blue-800 @endif
                                            ">
                                                {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('orders.show', $order->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Lihat Detail</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
