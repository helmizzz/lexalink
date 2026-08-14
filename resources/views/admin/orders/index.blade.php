<x-admin-layout>
    <div class="space-y-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
            Manajemen Pesanan
        </h2>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b dark:border-gray-600">
                            <tr>
                                <th class="px-6 py-3">No. Order</th>
                                <th class="px-6 py-3">Klien</th>
                                <th class="px-6 py-3">Layanan</th>
                                <th class="px-6 py-3">Tanggal</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $order->ref_number }}
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-semibold">{{ $order->user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $order->user->email }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $order->service->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-block px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700 text-xs font-semibold">Proses</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada data pesanan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
