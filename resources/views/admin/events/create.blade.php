<x-admin-layout>
    <div class="mb-6">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100">Tambah Event & Webinar Baru</h2>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Buat jadwal agenda eksklusif untuk disajikan pada portal Klien & landing page.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 dark:bg-red-900/40 dark:border-red-800 dark:text-red-300 text-sm">
            <strong class="font-bold">Terjadi kesalahan input!</strong>
            <ul class="list-disc list-inside mt-2 space-y-1 text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" id="event-form" class="bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 dark:border-gray-700 space-y-6">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Title -->
            <div class="md:col-span-2">
                <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Judul Event / Webinar <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Webinar Eksklusif: Mitigasi Risiko AI dalam Bisnis" class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
            </div>

            <!-- Date -->
            <div>
                <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                <input type="date" name="event_date" value="{{ old('event_date', date('Y-m-d', strtotime('+7 days'))) }}" required class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
            </div>

            <!-- Time -->
            <div>
                <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Jam Pelaksanaan (WIB) <span class="text-red-500">*</span></label>
                <input type="text" name="event_time" value="{{ old('event_time', '13:30 - 16:00 WIB') }}" required placeholder="Contoh: 09:00 - 12:00 WIB" class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
            </div>

            <!-- Location Type -->
            <div>
                <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Tipe Acara (Location Type) <span class="text-red-500">*</span></label>
                <select name="location_type" required class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
                    <option value="online" {{ old('location_type') === 'online' ? 'selected' : '' }}>Online (Zoom / Meet)</option>
                    <option value="offline" {{ old('location_type') === 'offline' ? 'selected' : '' }}>Offline (In-Person / Gedung)</option>
                    <option value="hybrid" {{ old('location_type') === 'hybrid' ? 'selected' : '' }}>Hybrid (Offline + Live Streaming)</option>
                </select>
            </div>

            <!-- Location Details / Link -->
            <div>
                <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Tempat / Platform (Zoom / Nama Hotel)</label>
                <input type="text" name="location" value="{{ old('location') }}" placeholder="Contoh: Zoom VIP Room / Hotel Grand Hyatt Jakarta" class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
            </div>

            <!-- Status & External Link -->
            <div>
                <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Status Acara <span class="text-red-500">*</span></label>
                <select name="status" required class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
                    <option value="upcoming" {{ old('status', 'upcoming') === 'upcoming' ? 'selected' : '' }}>Upcoming (Mendatang - Terbuka Pendaftaran)</option>
                    <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed (Selesai - Ditampilkan sebagai Arsip & Galeri)</option>
                    <option value="cancelled" {{ old('status') === 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Tautan Pendaftaran Eksternal (Opsi Tambahan)</label>
                <input type="url" name="registration_link" value="{{ old('registration_link') }}" placeholder="https://zoom.us/webinar/register/..." class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
                <p class="text-[11px] text-gray-400 mt-1">Jika diisi, setelah klien mendaftar di sistem LexaLink, tombol daftar juga diarahkan ke tautan ini.</p>
            </div>

            <!-- Cover Image -->
            <div>
                <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Upload Poster / Banner Event (Max 2MB)</label>
                <input type="file" name="cover_image" accept="image/*" class="w-full text-xs text-gray-600 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 dark:file:bg-blue-900/30 dark:file:text-blue-400 hover:file:bg-blue-100">
            </div>

            <div>
                <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Atau Gunakan URL Gambar Poster</label>
                <input type="url" name="cover_image_url" value="{{ old('cover_image_url') }}" placeholder="https://images.unsplash.com/..." class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
            </div>

            <!-- Description with WYSIWYG -->
            <div class="md:col-span-2">
                <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Deskripsi Lengkap, Pembicara & Susunan Acara</label>
                <input type="hidden" name="description" id="description_input" value="{{ old('description') }}">
                <div id="editor-container" class="h-64 rounded-lg bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200">
                    {!! old('description') !!}
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3">
            <a href="{{ route('admin.events.index') }}" class="px-5 py-2.5 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-bold text-xs hover:bg-gray-300 transition">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md transition">
                Simpan & Terbitkan Event
            </button>
        </div>
    </form>

    <!-- Quill WYSIWYG Editor Integration -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#editor-container', {
                theme: 'snow',
                placeholder: 'Tuliskan deskripsi lengkap event, nama pembicara, materi pokok, dan keuntungan mengikuti acara...',
                modules: {
                    toolbar: [
                        [{ 'header': [2, 3, 4, false] }],
                        ['bold', 'italic', 'underline'],
                        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                        ['link', 'blockquote'],
                        ['clean']
                    ]
                }
            });

            var form = document.getElementById('event-form');
            var descInput = document.getElementById('description_input');

            form.onsubmit = function() {
                descInput.value = quill.root.innerHTML;
            };
        });
    </script>
</x-admin-layout>
