<x-admin-layout>
    <div class="mb-6 flex justify-between items-center">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Surat Keluar
        </h2>
        <a href="{{ route('admin.outgoing-mails.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-semibold text-sm transition">
            + Tambah Surat Keluar
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
        <form method="GET" action="{{ route('admin.outgoing-mails.index') }}" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari No Surat, Penerima..." class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            </div>
            
            <div class="w-48">
                <select name="status" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="">Semua Status</option>
                    <option value="Draft" {{ request('status') === 'Draft' ? 'selected' : '' }}>Draft</option>
                    <option value="Dikirim" {{ request('status') === 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                    <option value="Diterima" {{ request('status') === 'Diterima' ? 'selected' : '' }}>Diterima</option>
                </select>
            </div>

            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 font-semibold text-sm transition">
                Filter
            </button>
            <a href="{{ route('admin.outgoing-mails.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300 font-semibold text-sm transition">
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
                        <th scope="col" class="px-6 py-3">No. & Tanggal Surat</th>
                        <th scope="col" class="px-6 py-3">Penerima</th>
                        <th scope="col" class="px-6 py-3">Klien & Kasus</th>
                        <th scope="col" class="px-6 py-3">PIC</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mails as $mail)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4">
                                <div class="font-medium text-gray-900 dark:text-white">{{ $mail->reference_number }}</div>
                                <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($mail->mail_date)->format('d M Y') }}</div>
                                <span class="px-2 py-1 mt-1 inline-block bg-blue-100 text-blue-800 text-[10px] font-semibold rounded dark:bg-blue-900 dark:text-blue-300">
                                    {{ $mail->type }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-medium">{{ $mail->recipient }}</td>
                            <td class="px-6 py-4">
                                <div class="font-semibold">{{ $mail->clientData ? $mail->clientData->name : '-' }}</div>
                                <div class="text-xs text-gray-500">{{ $mail->case_category ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-4">{{ $mail->pic ? $mail->pic->name : '-' }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColor = match($mail->status) {
                                        'Draft' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
                                        'Dikirim' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
                                        'Diterima' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
                                        default => 'bg-gray-100 text-gray-800',
                                    };
                                @endphp
                                <span class="px-2 py-1 text-xs font-semibold rounded {{ $statusColor }}">
                                    {{ $mail->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 space-x-2 whitespace-nowrap">
                                @if($mail->document_url)
                                    <a href="{{ $mail->document_url }}" target="_blank" class="font-medium text-indigo-600 dark:text-indigo-500 hover:underline">File</a> | 
                                @endif
                                <a href="{{ route('admin.outgoing-mails.edit', $mail) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a> | 
                                <form action="{{ route('admin.outgoing-mails.destroy', $mail) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat keluar ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="font-medium text-red-600 dark:text-red-500 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center">Belum ada surat keluar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($mails->hasPages())
            <div class="px-6 py-4 border-t dark:border-gray-700">
                {{ $mails->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
