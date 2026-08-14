<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Surat Keluar: {{ $mail->reference_number }}
        </h2>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            <form method="POST" action="{{ route('admin.outgoing-mails.update', $mail) }}" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nomor Surat -->
                    <div>
                        <x-input-label for="reference_number" :value="__('Nomor Surat')" />
                        <x-text-input id="reference_number" class="block mt-1 w-full" type="text" name="reference_number" :value="old('reference_number', $mail->reference_number)" required autofocus />
                        <x-input-error :messages="$errors->get('reference_number')" class="mt-2" />
                    </div>

                    <!-- Tanggal Surat -->
                    <div>
                        <x-input-label for="mail_date" :value="__('Tanggal Surat')" />
                        <x-text-input id="mail_date" class="block mt-1 w-full" type="date" name="mail_date" :value="old('mail_date', $mail->mail_date)" required />
                        <x-input-error :messages="$errors->get('mail_date')" class="mt-2" />
                    </div>

                    <!-- Jenis Surat -->
                    <div>
                        <x-input-label for="type" :value="__('Jenis Surat')" />
                        <x-text-input id="type" class="block mt-1 w-full" type="text" name="type" :value="old('type', $mail->type)" required />
                        <x-input-error :messages="$errors->get('type')" class="mt-2" />
                    </div>

                    <!-- Nama Penerima -->
                    <div>
                        <x-input-label for="recipient" :value="__('Nama Penerima')" />
                        <x-text-input id="recipient" class="block mt-1 w-full" type="text" name="recipient" :value="old('recipient', $mail->recipient)" required />
                        <x-input-error :messages="$errors->get('recipient')" class="mt-2" />
                    </div>

                    <!-- Klien Terkait -->
                    <div>
                        <x-input-label for="client_data_id" :value="__('Klien Terkait (opsional)')" />
                        <select id="client_data_id" name="client_data_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">-- Pilih Klien --</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('client_data_id', $mail->client_data_id) == $client->id ? 'selected' : '' }}>{{ $client->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('client_data_id')" class="mt-2" />
                    </div>

                    <!-- Kategori Perkara -->
                    <div>
                        <x-input-label for="case_category" :value="__('Kasus / Perkara (opsional)')" />
                        <x-text-input id="case_category" class="block mt-1 w-full" type="text" name="case_category" :value="old('case_category', $mail->case_category)" />
                        <x-input-error :messages="$errors->get('case_category')" class="mt-2" />
                    </div>

                    <!-- PIC -->
                    <div>
                        <x-input-label for="user_id" :value="__('Penanggung Jawab / PIC (opsional)')" />
                        <select id="user_id" name="user_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value="">-- Pilih Karyawan/PIC --</option>
                            @foreach($pics as $pic)
                                <option value="{{ $pic->id }}" {{ old('user_id', $mail->user_id) == $pic->id ? 'selected' : '' }}>{{ $pic->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                    </div>

                    <!-- Status -->
                    <div>
                        <x-input-label for="status" :value="__('Status Surat')" />
                        <select id="status" name="status" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm" required>
                            <option value="Draft" {{ old('status', $mail->status) == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Dikirim" {{ old('status', $mail->status) == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                            <option value="Diterima" {{ old('status', $mail->status) == 'Diterima' ? 'selected' : '' }}>Diterima (Delivered)</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                </div>

                <!-- Tautan Dokumen -->
                <div>
                    <x-input-label for="document_url" :value="__('Tautan Dokumen / File (Google Drive dll - opsional)')" />
                    <x-text-input id="document_url" class="block mt-1 w-full" type="url" name="document_url" :value="old('document_url', $mail->document_url)" />
                    <x-input-error :messages="$errors->get('document_url')" class="mt-2" />
                </div>

                <!-- Keterangan -->
                <div>
                    <x-input-label for="description" :value="__('Keterangan / Isi Ringkas')" />
                    <textarea id="description" name="description" rows="3" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('description', $mail->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4 space-x-4">
                    <a href="{{ route('admin.outgoing-mails.index') }}" class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                        Batal
                    </a>
                    <x-primary-button>
                        {{ __('Update Surat Keluar') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
