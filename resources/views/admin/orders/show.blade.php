<x-admin-layout>
    <div class="space-y-6 pb-12">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
                Detail Pesanan: {{ $order->ref_number }}
            </h2>
            <a href="{{ route('admin.orders.index') }}" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                &larr; Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Column: Details -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Client Brief -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold border-b pb-3 mb-4 text-gray-900 dark:text-white dark:border-gray-700">Profil & Kebutuhan Klien</h3>
                        
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Nama Klien</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $order->user->name }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Kontak WA</p>
                                <p class="font-medium text-gray-900 dark:text-gray-100">{{ $order->user->whatsapp ?? '-' }}</p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-xs text-gray-500 uppercase tracking-wider">Layanan Dipesan</p>
                                <p class="font-medium text-blue-600">{{ $order->service->name }}</p>
                            </div>
                        </div>

                        <div class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                            <h4 class="text-sm font-bold mb-3 text-gray-700 dark:text-gray-300">Data Formulir (Payload):</h4>
                            @if($order->payload)
                                <div class="space-y-2 text-sm">
                                    @foreach($order->payload as $key => $value)
                                        @if(!empty($value) && !is_array($value))
                                            <div class="grid grid-cols-3">
                                                <span class="text-gray-500 capitalize">{{ str_replace('_', ' ', $key) }}</span>
                                                <span class="col-span-2 font-medium text-gray-900 dark:text-white">{{ $value }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @else
                                <p class="text-sm text-gray-500">Tidak ada data formulir dinamis.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Client Documents -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-center border-b pb-3 mb-4 dark:border-gray-700">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white">Berkas dari Klien</h3>
                            <!-- Dummy button to download all as zip -->
                            <button class="text-xs font-semibold text-blue-600 bg-blue-50 px-3 py-1 rounded hover:bg-blue-100 transition">
                                Unduh Semua (.zip)
                            </button>
                        </div>
                        
                        <div class="space-y-3">
                            @forelse($order->documents->whereNotIn('file_type', ['final', 'draft_admin']) as $doc)
                                <div class="flex items-center justify-between p-3 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-900">
                                    <div class="flex items-center gap-3">
                                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                        </svg>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $doc->original_name }}</p>
                                            <p class="text-xs text-gray-500 uppercase">{{ $doc->file_type }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ route('documents.download', $doc->id) }}" class="text-blue-600 hover:text-blue-800">Unduh</a>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500">Klien tidak mengunggah berkas apapun.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Admin Upload Final Document -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border-l-4 border-green-500">
                    <div class="p-6">
                        <h3 class="text-lg font-bold border-b pb-3 mb-4 text-gray-900 dark:text-white dark:border-gray-700">Ruang Serah Terima (Final)</h3>
                        
                        <!-- List uploaded final docs -->
                        <div class="mb-4 space-y-2">
                            @foreach($order->documents->whereIn('file_type', ['final', 'draft_admin']) as $doc)
                                <div class="flex items-center justify-between p-2 bg-green-50 dark:bg-green-900/20 text-green-800 dark:text-green-300 rounded text-sm">
                                    <span>{{ $doc->original_name }} ({{ strtoupper($doc->file_type) }})</span>
                                    <a href="{{ route('documents.download', $doc->id) }}" class="font-bold underline">Cek File</a>
                                </div>
                            @endforeach
                        </div>

                        <form action="{{ route('admin.orders.upload_document', $order->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-50 dark:bg-gray-900 p-4 rounded-lg">
                            @csrf
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Unggah Dokumen Baru</label>
                                <input type="file" name="file" required accept=".pdf,.zip,.jpg,.png" class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            </div>
                            <div class="flex items-center justify-between">
                                <label class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                                    <input type="checkbox" name="is_final" value="1" class="rounded border-gray-300 text-green-600 shadow-sm focus:border-green-300 focus:ring focus:ring-green-200 focus:ring-opacity-50 mr-2">
                                    Ini adalah Dokumen Final (Tandai pesanan Selesai)
                                </label>
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded font-semibold text-sm hover:bg-green-700">Unggah Berkas</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <!-- Right Column: State Manager -->
            <div class="space-y-6">
                
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4 flex items-center gap-2 text-gray-900 dark:text-white">
                            <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            State Manager
                        </h3>
                        
                        <form action="{{ route('admin.orders.update_status', $order->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status Progres Klien</label>
                                <select name="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white sm:text-sm">
                                    <option value="draft" @if($order->status == 'draft') selected @endif>Draft (Isi Form)</option>
                                    <option value="waiting_approval" @if($order->status == 'waiting_approval') selected @endif>Menunggu Pembayaran</option>
                                    <option value="processing" @if($order->status == 'processing') selected @endif>Diproses (In Progress)</option>
                                    <option value="client_review" @if($order->status == 'client_review') selected @endif>Review Klien</option>
                                    <option value="revision" @if($order->status == 'revision') selected @endif>Revisi</option>
                                    <option value="completed" @if($order->status == 'completed') selected @endif>Selesai (Completed)</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1 flex justify-between">
                                    Catatan Internal 
                                    <span class="text-xs text-red-500 font-normal">*Rahasia</span>
                                </label>
                                <textarea name="admin_notes" rows="6" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white sm:text-sm" placeholder="Ketik catatan progres di sini... (Misal: Berkas tersangkut di OSS)">{{ $order->admin_notes }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Hanya bisa dilihat oleh admin.</p>
                            </div>

                            <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Simpan Perubahan
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Keuangan Widget -->
                @if(Auth::user()->role === 'superadmin')
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold mb-4 text-gray-900 dark:text-white">Status Keuangan</h3>
                        @if($order->invoice)
                            <div class="mb-2">
                                <p class="text-sm text-gray-500">No. Invoice</p>
                                <p class="font-medium text-gray-900 dark:text-white">{{ $order->invoice->invoice_number }}</p>
                            </div>
                            <div class="mb-2">
                                <p class="text-sm text-gray-500">Nominal</p>
                                <p class="font-bold text-gray-900 dark:text-white text-xl">Rp {{ number_format($order->invoice->total_amount, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500 mb-1">Status</p>
                                @if($order->invoice->status == 'paid')
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-bold uppercase tracking-wider">Lunas</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-bold uppercase tracking-wider">Belum Lunas</span>
                                    <form action="{{ route('admin.invoices.mark_paid', $order->invoice->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full text-center px-2 py-1 bg-green-600 text-white hover:bg-green-700 rounded text-xs font-bold uppercase tracking-wider">Tandai Lunas</button>
                                    </form>
                                @endif
                            </div>
                        @else
                            <p class="text-sm text-gray-500 mb-4">Tagihan belum dibuat untuk pesanan ini.</p>
                            <!-- Form to generate invoice -->
                            <form action="{{ route('admin.invoices.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="order_id" value="{{ $order->id }}">
                                <div class="mb-3">
                                    <label class="text-xs text-gray-500">Nominal Tagihan (Rp)</label>
                                    <input type="number" name="total_amount" required min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-900 dark:border-gray-700 dark:text-white sm:text-sm" placeholder="Contoh: 1500000">
                                </div>
                                <button type="submit" class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                                    Buat Tagihan Sekarang
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
</x-admin-layout>
