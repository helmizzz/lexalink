<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Tambah Monitoring Pekerjaan
        </h2>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <form method="POST" action="{{ route('admin.monitoring-jobs.store') }}" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Pekerjaan -->
                    <div class="md:col-span-2">
                        <x-input-label for="name" :value="__('Nama Pekerjaan / Judul Tugas')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Klien Terkait -->
                    <div>
                        <x-input-label for="client_data_id" :value="__('Klien Terkait (opsional)')" />
                        <select id="client_data_id" name="client_data_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">-- Tidak Ditautkan --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_data_id') == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('client_data_id')" class="mt-2" />
                    </div>

                    <!-- PIC -->
                    <div>
                        <x-input-label for="user_id" :value="__('Penanggung Jawab / PIC')" />
                        <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            <option value="">-- Pilih PIC --</option>
                            @foreach($pics as $pic)
                                <option value="{{ $pic->id }}" {{ old('user_id') == $pic->id ? 'selected' : '' }}>{{ $pic->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div>
                        <x-input-label for="status" :value="__('Status Pekerjaan')" />
                        <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            <option value="To Do" {{ old('status') == 'To Do' ? 'selected' : '' }}>To Do</option>
                            <option value="In Progress" {{ old('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Review" {{ old('status') == 'Review' ? 'selected' : '' }}>Review</option>
                            <option value="Done" {{ old('status') == 'Done' ? 'selected' : '' }}>Done</option>
                            <option value="Cancelled" {{ old('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <!-- Prioritas -->
                    <div>
                        <x-input-label for="priority" :value="__('Tingkat Prioritas')" />
                        <select id="priority" name="priority" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            <option value="Rendah" {{ old('priority') == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                            <option value="Sedang" {{ old('priority', 'Sedang') == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                            <option value="Tinggi" {{ old('priority') == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                        </select>
                        <x-input-error :messages="$errors->get('priority')" class="mt-2" />
                    </div>

                    <!-- Start Date -->
                    <div>
                        <x-input-label for="start_date" :value="__('Tanggal Mulai (opsional)')" />
                        <x-text-input id="start_date" class="block mt-1 w-full" type="date" name="start_date" :value="old('start_date')" />
                        <x-input-error :messages="$errors->get('start_date')" class="mt-2" />
                    </div>

                    <!-- Due Date -->
                    <div>
                        <x-input-label for="due_date" :value="__('Tenggat Waktu / Deadline (opsional)')" />
                        <x-text-input id="due_date" class="block mt-1 w-full" type="date" name="due_date" :value="old('due_date')" />
                        <x-input-error :messages="$errors->get('due_date')" class="mt-2" />
                    </div>
                </div>

                <!-- Keterangan -->
                <div>
                    <x-input-label for="description" :value="__('Deskripsi Pekerjaan / Catatan')" />
                    <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description') }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4 space-x-4">
                    <a href="{{ route('admin.monitoring-jobs.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        Batal
                    </a>
                    <x-primary-button>
                        {{ __('Simpan Pekerjaan') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
