<x-admin-layout>
    <div class="mb-6 flex flex-col md:flex-row justify-between md:items-center gap-4">
        <div>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100">Edit Event & Webinar</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Perbarui informasi jadwal, unggah galeri hasil acara, atau pantau peserta terdaftar.</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('client.events.show', $event->slug) }}" target="_blank" class="px-4 py-2 rounded-lg bg-indigo-50 text-indigo-700 font-bold text-xs hover:bg-indigo-100 transition inline-flex items-center gap-1">
                <span>Preview di Portal Client</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
            </a>
        </div>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 dark:bg-red-900/40 dark:border-red-800 text-sm">
            <strong class="font-bold">Terjadi kesalahan input!</strong>
            <ul class="list-disc list-inside mt-2 text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Form -->
        <div class="lg:col-span-2 space-y-6">
            <form action="{{ route('admin.events.update', $event) }}" method="POST" enctype="multipart/form-data" id="event-form" class="bg-white dark:bg-gray-800 rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 dark:border-gray-700 space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Judul Event / Webinar <span class="text-red-500">*</span></label>
                        <input type="text" name="title" value="{{ old('title', $event->title) }}" required class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
                    </div>

                    <div>
                        <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Tanggal Pelaksanaan <span class="text-red-500">*</span></label>
                        <input type="date" name="event_date" value="{{ old('event_date', $event->event_date ? $event->event_date->format('Y-m-d') : '') }}" required class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
                    </div>

                    <div>
                        <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Jam Pelaksanaan (WIB) <span class="text-red-500">*</span></label>
                        <input type="text" name="event_time" value="{{ old('event_time', $event->event_time) }}" required class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
                    </div>

                    <div>
                        <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Tipe Acara <span class="text-red-500">*</span></label>
                        <select name="location_type" required class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
                            <option value="online" {{ old('location_type', $event->location_type) === 'online' ? 'selected' : '' }}>Online (Zoom / Meet)</option>
                            <option value="offline" {{ old('location_type', $event->location_type) === 'offline' ? 'selected' : '' }}>Offline (In-Person / Gedung)</option>
                            <option value="hybrid" {{ old('location_type', $event->location_type) === 'hybrid' ? 'selected' : '' }}>Hybrid (Offline + Live Streaming)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Tempat / Platform (Zoom / Alamat)</label>
                        <input type="text" name="location" value="{{ old('location', $event->location) }}" class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
                    </div>

                    <div>
                        <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Status Acara <span class="text-red-500">*</span></label>
                        <select name="status" required class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
                            <option value="upcoming" {{ old('status', $event->status) === 'upcoming' ? 'selected' : '' }}>Upcoming (Mendatang - Terbuka Pendaftaran)</option>
                            <option value="completed" {{ old('status', $event->status) === 'completed' ? 'selected' : '' }}>Completed (Selesai - Ditampilkan di Arsip/Galeri)</option>
                            <option value="cancelled" {{ old('status', $event->status) === 'cancelled' ? 'selected' : '' }}>Cancelled (Dibatalkan)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Tautan Pendaftaran Eksternal</label>
                        <input type="url" name="registration_link" value="{{ old('registration_link', $event->registration_link) }}" placeholder="https://..." class="w-full text-sm py-2.5 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white focus:ring-blue-500 shadow-sm">
                    </div>

                    <!-- Cover -->
                    <div class="md:col-span-2">
                        <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Poster / Banner Event</label>
                        @if($event->cover_image)
                            <div class="mb-3 w-48 h-28 rounded-lg overflow-hidden border border-gray-200">
                                <img src="{{ $event->cover_image }}" class="w-full h-full object-cover" alt="Cover">
                            </div>
                        @endif
                        <input type="file" name="cover_image" accept="image/*" class="w-full text-xs text-gray-600 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700">
                        <input type="url" name="cover_image_url" value="{{ old('cover_image_url') }}" placeholder="Atau ganti dengan URL Gambar Baru (Opsional)" class="w-full mt-2 text-sm py-2 px-4 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white">
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-2">Deskripsi Lengkap Event & Susunan Acara</label>
                        <input type="hidden" name="description" id="description_input" value="{{ old('description', $event->description) }}">
                        <div id="editor-container" class="h-72 rounded-lg bg-white dark:bg-gray-900 border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200">
                            {!! old('description', $event->description) !!}
                        </div>
                    </div>

                    <!-- Gallery URLs for Completed Events -->
                    <div class="md:col-span-2 pt-4 border-t border-gray-100 dark:border-gray-700">
                        <label class="block font-semibold text-xs uppercase text-gray-700 dark:text-gray-300 mb-1">Galeri Dokumentasi (Daftar URL Gambar / Foto Acara)</label>
                        <p class="text-[11px] text-gray-400 mb-2">Masukkan satu URL gambar per baris. Bagus untuk melampirkan bukti dokumentasi pasca event (status Completed).</p>
                        <textarea name="gallery_urls" rows="3" placeholder="https://images.unsplash.com/...&#10;https://images.unsplash.com/..." class="w-full text-xs py-2 px-3 rounded-lg border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white font-mono">{{ is_array($event->gallery) ? implode("\n", $event->gallery) : '' }}</textarea>
                    </div>
                </div>

                <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3">
                    <a href="{{ route('admin.events.index') }}" class="px-5 py-2.5 rounded-lg bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-bold text-xs hover:bg-gray-300 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs shadow-md transition">
                        Perbarui Data Event
                    </button>
                </div>
            </form>
        </div>

        <!-- CRM Section: Client Registrations List -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-800 rounded-2xl p-6 shadow-sm border border-gray-100 dark:border-gray-700">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-gray-100 dark:border-gray-700">
                    <h3 class="font-extrabold text-gray-800 dark:text-white text-base flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        <span>Daftar Klien Mendaftar</span>
                    </h3>
                    <span class="px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 text-xs font-extrabold">
                        {{ $event->attendees->count() }} Orang
                    </span>
                </div>

                @if($event->attendees->count() > 0)
                    <ul class="divide-y divide-gray-100 dark:divide-gray-700 space-y-3 max-h-96 overflow-y-auto pr-1">
                        @foreach($event->attendees as $attendee)
                            <li class="pt-3 first:pt-0 flex items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($attendee->name) }}&background=0284c7&color=fff" class="w-9 h-9 rounded-full shadow-sm" alt="Avatar" />
                                <div class="flex-1 min-w-0">
                                    <div class="font-bold text-gray-900 dark:text-gray-100 text-sm truncate">{{ $attendee->name }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $attendee->email }} &bull; {{ $attendee->whatsapp ?? 'No WA' }}</div>
                                    <div class="text-[10px] font-mono text-gray-400">Daftar: {{ \Carbon\Carbon::parse($attendee->pivot->registered_at)->format('d M Y, H:i') }}</div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="py-8 text-center text-gray-400 text-xs">
                        Belum ada klien yang melakukan registrasi mandiri via portal untuk event ini.
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quill WYSIWYG Editor Integration -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill = new Quill('#editor-container', {
                theme: 'snow',
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
