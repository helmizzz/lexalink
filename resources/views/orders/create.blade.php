<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Buat Pesanan Baru
        </h2>
    </div>

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data" x-data="{ serviceType: '' }">
                        @csrf
                        
                        <!-- Pilihan Layanan -->
                        <div class="mb-6">
                            <label for="service_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pilih Layanan</label>
                            <select id="service_id" name="service_id" required 
                                x-model="serviceType"
                                class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                <option value="" disabled>-- Pilih Jenis Layanan --</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">{{ $service->name }} (Rp {{ number_format($service->base_price, 0, ',', '.') }})</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Area Form Dinamis -->
                        <div x-show="serviceType !== ''" class="space-y-6 mt-6 p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                            <h3 class="text-lg font-bold mb-4">Detail Pesanan</h3>
                            
                            <!-- Asumsi ID 1 adalah Perizinan/NIB, sisanya Legal Drafting -->
                            <template x-if="serviceType == '1'">
                                <div class="space-y-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Formulir Pendaftaran Perizinan (NIB/Halal)</p>
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Perusahaan / Usaha</label>
                                        <input type="text" name="company_name" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Alamat Lengkap</label>
                                        <textarea name="company_address" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm"></textarea>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Bidang Usaha (KBLI)</label>
                                        <input type="text" name="kbli" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm">
                                    </div>
                                    
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <h4 class="font-medium text-gray-900 dark:text-gray-100 mb-2">Unggah Berkas</h4>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">KTP Penanggung Jawab</label>
                                                <input type="file" name="files[ktp]" accept=".pdf,.jpg,.png" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">NPWP (Opsional)</label>
                                                <input type="file" name="files[npwp]" accept=".pdf,.jpg,.png" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </template>

                            <template x-if="serviceType != '1' && serviceType != ''">
                                <div class="space-y-4">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Formulir Legal Drafting / Pembuatan Kontrak</p>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pihak Pertama</label>
                                            <input type="text" name="party_1" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm" placeholder="Nama entitas/orang">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pihak Kedua</label>
                                            <input type="text" name="party_2" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm" placeholder="Nama entitas/orang">
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Latar Belakang / Poin Wajib</label>
                                        <textarea name="background_notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm" placeholder="Jelaskan secara singkat apa saja yang harus diatur dalam kontrak ini..."></textarea>
                                    </div>
                                    
                                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Dokumen Referensi / Draf Kasar (Opsional)</label>
                                        <input type="file" name="files[reference]" accept=".pdf,.jpg,.png" class="block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 shadow-lg transition ease-in-out duration-150">
                                Buat Pesanan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
