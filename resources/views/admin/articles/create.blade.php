<x-admin-layout>
    <!-- Include Quill.js CDN for aesthetic WYSIWYG editing -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />

    <div class="mb-6 flex justify-between items-center">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            Tulis Opini & Berita Baru
        </h2>
        <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 font-semibold text-sm transition">
            &larr; Kembali ke Daftar
        </a>
    </div>

    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-xl p-6 md:p-8 border border-gray-100 dark:border-gray-700 max-w-4xl mx-auto">
        <form id="article-form" action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Judul -->
            <div>
                <label for="title" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Judul Artikel / Opini <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required placeholder="Contoh: Analisis UU PDP terhadap Bisnis Digital di Indonesia" class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500">
                @error('title') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- Editor Isi Konten (WYSIWYG) -->
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Isi Artikel / Analisis Hukum <span class="text-red-500">*</span></label>
                <div id="editor" class="bg-white dark:bg-gray-900 dark:text-white min-h-[300px] rounded-lg border border-gray-300 dark:border-gray-700"></div>
                <input type="hidden" name="content" id="hidden_content" value="{{ old('content') }}">
                @error('content') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Foto Sampul (Cover) -->
                <div>
                    <label for="cover_image" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Foto Sampul (Cover Image)</label>
                    <input type="file" name="cover_image" id="cover_image" accept="image/*" class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 dark:file:bg-gray-700 dark:file:text-gray-200">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (Max: 2MB). Opsional.</p>
                </div>

                <!-- Status Publikasi -->
                <div>
                    <label for="status" class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Status Publikasi <span class="text-red-500">*</span></label>
                    <select name="status" id="status" required class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-lg shadow-sm focus:border-blue-500">
                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Langsung Tayang)</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Simpan Sementara)</option>
                    </select>
                </div>
            </div>

            <!-- Video URL & Galeri Opsional -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 space-y-4">
                <h4 class="font-bold text-gray-800 dark:text-gray-200 text-sm">Media Tambahan & Galeri (Opsional)</h4>
                
                <div>
                    <label for="video_url" class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-1">Link Video (YouTube / Embed URL)</label>
                    <input type="url" name="video_url" id="video_url" value="{{ old('video_url') }}" placeholder="https://www.youtube.com/embed/..." class="w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-lg shadow-sm">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 dark:text-gray-400 mb-2">Link Foto Galeri Dokumentasi (Satu URL per baris/kotak)</label>
                    <div id="gallery-container" class="space-y-2">
                        <input type="url" name="gallery_urls[]" placeholder="https://images.unsplash.com/..." class="w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-lg shadow-sm">
                    </div>
                    <button type="button" onclick="addGalleryInput()" class="mt-2 text-xs font-semibold text-blue-600 dark:text-blue-400 hover:underline flex items-center gap-1">
                        + Tambah URL Gambar Galeri Lainnya
                    </button>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-6 flex justify-end gap-3">
                <button type="reset" class="px-5 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-lg font-semibold text-sm hover:bg-gray-300 transition">
                    Reset
                </button>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg font-semibold text-sm hover:bg-blue-700 transition shadow-md">
                    Simpan & Terbitakan
                </button>
            </div>
        </form>
    </div>

    <!-- Quill.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
    <script>
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Tuliskan opini atau kajian hukum mendalam di sini...',
            modules: {
                toolbar: [
                    [{ 'header': [2, 3, 4, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    ['link', 'blockquote', 'code-block'],
                    ['clean']
                ]
            }
        });

        if (document.getElementById('hidden_content').value) {
            quill.root.innerHTML = document.getElementById('hidden_content').value;
        }

        document.getElementById('article-form').onsubmit = function() {
            document.getElementById('hidden_content').value = quill.root.innerHTML;
        };

        function addGalleryInput() {
            const container = document.getElementById('gallery-container');
            const input = document.createElement('input');
            input.type = 'url';
            input.name = 'gallery_urls[]';
            input.placeholder = 'https://...';
            input.className = 'w-full text-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-white rounded-lg shadow-sm';
            container.appendChild(input);
        }
    </script>
</x-admin-layout>
