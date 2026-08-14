<x-admin-layout>
    <div class="space-y-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
            Database Klien (CRM)
        </h2>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b dark:border-gray-600">
                            <tr>
                                <th class="px-6 py-3">Nama</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3">WhatsApp</th>
                                <th class="px-6 py-3">Terdaftar Pada</th>
                                <th class="px-6 py-3">Status</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($clients as $client)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $client->name }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $client->email }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $client->whatsapp ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    {{ $client->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($client->is_active)
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">Aktif</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-semibold">Diblokir</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('admin.clients.toggle', $client->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="text-sm font-semibold {{ $client->is_active ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }}">
                                            {{ $client->is_active ? 'Blokir' : 'Aktifkan' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                                    Belum ada klien yang terdaftar.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $clients->links() }}
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
