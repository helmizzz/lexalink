<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Dashboard Utama (Command Center)
        </h2>
    </div>

    <!-- METRICS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Total Klien -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border-l-4 border-indigo-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-indigo-100 dark:bg-indigo-900 bg-opacity-75">
                    <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Total Klien Terdaftar</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalClientsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Pekerjaan Aktif -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border-l-4 border-blue-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 bg-opacity-75">
                    <svg class="h-8 w-8 text-blue-600 dark:text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Pekerjaan Aktif</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $activeJobsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Mendekati Deadline -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border-l-4 border-yellow-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 dark:bg-yellow-900 bg-opacity-75">
                    <svg class="h-8 w-8 text-yellow-600 dark:text-yellow-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Mendekati Deadline (7 Hari)</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $nearDeadlineJobsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Terlambat -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border-l-4 border-red-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 dark:bg-red-900 bg-opacity-75">
                    <svg class="h-8 w-8 text-red-600 dark:text-red-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Pekerjaan Terlambat</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $overdueJobsCount }}</p>
                </div>
            </div>
        </div>

        <!-- Surat Masuk -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border-l-4 border-emerald-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-emerald-100 dark:bg-emerald-900 bg-opacity-75">
                    <svg class="h-8 w-8 text-emerald-600 dark:text-emerald-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Surat Masuk</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalIncomingMails }}</p>
                </div>
            </div>
        </div>

        <!-- Surat Keluar -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border-l-4 border-orange-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-orange-100 dark:bg-orange-900 bg-opacity-75">
                    <svg class="h-8 w-8 text-orange-600 dark:text-orange-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Surat Keluar</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $totalOutgoingMails }}</p>
                </div>
            </div>
        </div>
        
        <!-- Pesanan Online Baru -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border-l-4 border-purple-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 bg-opacity-75">
                    <svg class="h-8 w-8 text-purple-600 dark:text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Pesanan Portal Baru</p>
                    <p class="text-3xl font-bold text-gray-800 dark:text-white">{{ $newOrdersCount }}</p>
                </div>
            </div>
        </div>

        <!-- Total Pendapatan Portal -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border-l-4 border-green-500">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 dark:bg-green-900 bg-opacity-75">
                    <span class="text-green-600 dark:text-green-300 text-xl font-bold">Rp</span>
                </div>
                <div class="ml-4">
                    <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">Pendapatan Portal</p>
                    <p class="text-xl font-bold text-gray-800 dark:text-white">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>

    </div>

    <!-- MAIN TWO COLUMN SECTION -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        
        <!-- Pekerjaan Terbaru -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Pekerjaan Terbaru</h3>
            </div>
            <div class="p-0">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($recentJobs as $job)
                        <li class="p-6 hover:bg-gray-50 dark:hover:bg-gray-750 transition duration-150">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-md font-bold text-gray-900 dark:text-gray-100">{{ $job->name }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">Klien: <span class="font-semibold">{{ $job->clientData ? $job->clientData->name : '-' }}</span></p>
                                </div>
                                <div>
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
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="p-6 text-center text-gray-500 dark:text-gray-400">Belum ada data pekerjaan terbaru.</li>
                    @endforelse
                </ul>
            </div>
            <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 rounded-b-lg text-center">
                <a href="{{ route('admin.monitoring-jobs.index') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">Lihat Semua Pekerjaan &rarr;</a>
            </div>
        </div>

        <!-- Pekerjaan Prioritas -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-red-200 dark:border-red-900">
            <div class="p-6 border-b border-red-100 dark:border-red-900 bg-red-50 dark:bg-red-900/20 rounded-t-lg flex justify-between items-center">
                <h3 class="text-lg font-semibold text-red-800 dark:text-red-400 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    Pekerjaan Prioritas Tinggi
                </h3>
            </div>
            <div class="p-0">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @forelse($priorityJobs as $job)
                        <li class="p-6 hover:bg-gray-50 dark:hover:bg-gray-750 transition duration-150">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h4 class="text-md font-bold text-gray-900 dark:text-gray-100">{{ $job->name }}</h4>
                                    <p class="text-sm text-gray-500 mt-1">Klien: <span class="font-semibold">{{ $job->clientData ? $job->clientData->name : '-' }}</span></p>
                                    @if($job->due_date)
                                        <p class="text-xs mt-2 font-medium {{ \Carbon\Carbon::parse($job->due_date)->isPast() ? 'text-red-600' : 'text-gray-500' }}">
                                            Deadline: {{ \Carbon\Carbon::parse($job->due_date)->format('d M Y') }}
                                        </p>
                                    @endif
                                </div>
                                <div>
                                    @php
                                        $statusColor = match($job->status) {
                                            'To Do' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                            'In Progress' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                            'Review' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
                                            default => 'bg-gray-100 text-gray-800',
                                        };
                                    @endphp
                                    <span class="px-2 py-1 text-xs font-semibold rounded {{ $statusColor }}">
                                        {{ $job->status }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="p-6 text-center text-gray-500 dark:text-gray-400">Tidak ada pekerjaan prioritas tinggi aktif.</li>
                    @endforelse
                </ul>
            </div>
        </div>

    </div>
</x-admin-layout>
