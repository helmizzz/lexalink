<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Monitoring Pekerjaan
        </h2>
        <a href="{{ route('admin.monitoring-jobs.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold text-sm transition">
            + Tambah Pekerjaan
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
        <form method="GET" action="{{ route('admin.monitoring-jobs.index') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Pencarian</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama pekerjaan..." class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            </div>
            
            <div class="w-40">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                <select name="status" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Semua Status</option>
                    <option value="To Do" {{ request('status') === 'To Do' ? 'selected' : '' }}>To Do</option>
                    <option value="In Progress" {{ request('status') === 'In Progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="Review" {{ request('status') === 'Review' ? 'selected' : '' }}>Review</option>
                    <option value="Done" {{ request('status') === 'Done' ? 'selected' : '' }}>Done</option>
                    <option value="Cancelled" {{ request('status') === 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>

            <div class="w-32">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Prioritas</label>
                <select name="priority" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Semua</option>
                    <option value="Tinggi" {{ request('priority') === 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                    <option value="Sedang" {{ request('priority') === 'Sedang' ? 'selected' : '' }}>Sedang</option>
                    <option value="Rendah" {{ request('priority') === 'Rendah' ? 'selected' : '' }}>Rendah</option>
                </select>
            </div>

            <div class="w-40">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal</label>
                <input type="date" name="date" value="{{ request('date') }}" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            </div>

            <div class="flex space-x-2">
                <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 font-semibold text-sm transition">
                    Filter
                </button>
                <a href="{{ route('admin.monitoring-jobs.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-semibold text-sm transition">
                    Reset
                </a>
            </div>
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
                        <th scope="col" class="px-6 py-3">Nama Pekerjaan</th>
                        <th scope="col" class="px-6 py-3">Klien</th>
                        <th scope="col" class="px-6 py-3">PIC</th>
                        <th scope="col" class="px-6 py-3">Timeline</th>
                        <th scope="col" class="px-6 py-3">Prioritas</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jobs as $job)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900 dark:text-white">{{ $job->name }}</div>
                                <div class="text-xs text-gray-500 line-clamp-1">{{ Str::limit($job->description, 50) }}</div>
                            </td>
                            <td class="px-6 py-4 font-medium">{{ $job->clientData ? $job->clientData->name : '-' }}</td>
                            <td class="px-6 py-4">{{ $job->pic ? $job->pic->name : '-' }}</td>
                            <td class="px-6 py-4">
                                <div class="text-xs">
                                    <span class="text-gray-500">Mulai:</span> {{ $job->start_date ? \Carbon\Carbon::parse($job->start_date)->format('d/m/Y') : '-' }}<br>
                                    <span class="text-gray-500">Batas:</span> <span class="font-semibold {{ $job->due_date && \Carbon\Carbon::parse($job->due_date)->isPast() && $job->status != 'Done' ? 'text-red-600' : '' }}">{{ $job->due_date ? \Carbon\Carbon::parse($job->due_date)->format('d/m/Y') : '-' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $prioColor = match($job->priority) {
                                        'Tinggi' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                        'Sedang' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
                                        'Rendah' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="px-2 py-1 text-[10px] uppercase font-bold rounded {{ $prioColor }}">
                                    {{ $job->priority }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColor = match($job->status) {
                                        'To Do' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                        'In Progress' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                        'Review' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                                        'Done' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                        'Cancelled' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded {{ $statusColor }}">
                                    {{ $job->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.monitoring-jobs.edit', $job) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> | 
                                <form action="{{ route('admin.monitoring-jobs.destroy', $job) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pekerjaan ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center">Belum ada pekerjaan yang dimonitor.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($jobs->hasPages())
            <div class="px-6 py-4 border-t dark:border-gray-700">
                {{ $jobs->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
