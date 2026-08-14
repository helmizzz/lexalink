<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Data Klien (Offline)
        </h2>
        <a href="{{ route('admin.client-data.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold text-sm transition">
            + Tambah Klien Baru
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
        <form method="GET" action="{{ route('admin.client-data.index') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau kontak..." class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            </div>
            
            <div class="w-48">
                <select name="type" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Semua Jenis</option>
                    <option value="Perorangan" {{ request('type') === 'Perorangan' ? 'selected' : '' }}>Perorangan</option>
                    <option value="Perusahaan" {{ request('type') === 'Perusahaan' ? 'selected' : '' }}>Perusahaan</option>
                    <option value="Institusi" {{ request('type') === 'Institusi' ? 'selected' : '' }}>Institusi</option>
                </select>
            </div>

            <div class="w-48">
                <select name="status" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Semua Status</option>
                    <option value="Aktif" {{ request('status') === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="Non-Aktif" {{ request('status') === 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                    <option value="Selesai" {{ request('status') === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="w-48">
                <select name="sort" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="asc" {{ request('sort') === 'asc' ? 'selected' : '' }}>Nama (A-Z)</option>
                    <option value="desc" {{ request('sort') === 'desc' ? 'selected' : '' }}>Nama (Z-A)</option>
                </select>
            </div>

            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 font-semibold text-sm transition">
                Filter
            </button>
            <a href="{{ route('admin.client-data.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-semibold text-sm transition">
                Reset
            </a>
        </form>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Nama Klien</th>
                        <th scope="col" class="px-6 py-3">Jenis</th>
                        <th scope="col" class="px-6 py-3">Kontak</th>
                        <th scope="col" class="px-6 py-3">Telepon</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($clients as $client)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $client->name }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded dark:bg-blue-900 dark:text-blue-300">
                                    {{ $client->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $client->contact_person ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $client->phone }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColor = match($client->status) {
                                        'Aktif' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                        'Non-Aktif' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                        'Selesai' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded {{ $statusColor }}">
                                    {{ $client->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('admin.client-data.edit', $client) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('admin.client-data.destroy', $client) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus klien ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center">Belum ada data klien.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($clients->hasPages())
            <div class="px-6 py-4 border-t dark:border-gray-700">
                {{ $clients->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
