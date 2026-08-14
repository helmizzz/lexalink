<x-admin-layout>
<div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50 dark:bg-[#020508]">
    <main class="p-6 max-w-5xl mx-auto">
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <a href="{{ route('admin.legal-resources.index') }}" class="text-xs font-bold text-purple-600 dark:text-purple-400 hover:underline inline-flex items-center gap-1.5 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    <span>Kembali ke Katalog Regulasi</span>
                </a>
                <h1 class="text-2xl font-black text-gray-900 dark:text-white">Edit Dokumen: <span class="text-purple-600 font-mono">{{ $legalResource->document_number }}</span></h1>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Perbarui data regulasi, abstrak, atau ganti file lampiran yang ada di arsip digital.</p>
            </div>
            <div class="px-4 py-2 rounded-xl bg-purple-500/10 border border-purple-500/20 text-purple-600 dark:text-purple-400 font-extrabold text-xs flex items-center gap-2">
                <span>Diunduh Klien: <strong>{{ number_format($legalResource->downloads_count) }}x</strong></span>
            </div>
        </div>

        @if($errors->any())
            <div class="mb-6 p-4 rounded-xl bg-rose-500/10 border border-rose-500/20 text-rose-600 dark:text-rose-400 text-xs font-bold">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.legal-resources.update', $legalResource->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            <div class="bg-white dark:bg-[#0b1320] rounded-2xl border border-gray-200 dark:border-white/10 p-6 shadow-sm space-y-6">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Nomor Dokumen Resmi *</label>
                        <input type="text" name="document_number" value="{{ old('document_number', $legalResource->document_number) }}" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-[#0e1726] text-gray-900 dark:text-white text-xs font-mono font-bold focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Kategori Regulasi / Riset *</label>
                        <select name="category" required class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-[#0e1726] text-gray-900 dark:text-white text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="Undang-Undang" {{ old('category', $legalResource->category) == 'Undang-Undang' ? 'selected' : '' }}>Undang-Undang (UU)</option>
                            <option value="Peraturan Pemerintah" {{ old('category', $legalResource->category) == 'Peraturan Pemerintah' ? 'selected' : '' }}>Peraturan Pemerintah (PP)</option>
                            <option value="Putusan MA" {{ old('category', $legalResource->category) == 'Putusan MA' ? 'selected' : '' }}>Putusan Mahkamah Agung (MA)</option>
                            <option value="Regulasi AI" {{ old('category', $legalResource->category) == 'Regulasi AI' ? 'selected' : '' }}>Regulasi AI & Teknologi Digital</option>
                            <option value="Jurnal Kajian" {{ old('category', $legalResource->category) == 'Jurnal Kajian' ? 'selected' : '' }}>Jurnal Kajian & Riset Mendalam</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Judul Dokumen / Regulasi *</label>
                    <input type="text" name="title" value="{{ old('title', $legalResource->title) }}" required class="w-full px-4 py-3 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-[#0e1726] text-gray-900 dark:text-white text-sm font-extrabold focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Tahun Penetapan *</label>
                        <input type="number" name="year" value="{{ old('year', $legalResource->year) }}" required min="1900" max="2100" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-[#0e1726] text-gray-900 dark:text-white text-xs font-bold focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Tanggal Mulai Berlaku / Diputus</label>
                        <input type="date" name="effective_date" value="{{ old('effective_date', $legalResource->effective_date ? $legalResource->effective_date->format('Y-m-d') : '') }}" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-[#0e1726] text-gray-900 dark:text-white text-xs focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Kata Kunci / Tags (Pisahkan dengan Koma)</label>
                    <input type="text" name="tags_input" value="{{ old('tags_input', is_array($legalResource->tags) ? implode(', ', $legalResource->tags) : '') }}" placeholder="Contoh: cyberlaw, pdp, privasi, komersial, ai" class="w-full px-4 py-2.5 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-[#0e1726] text-gray-900 dark:text-white text-xs font-semibold focus:outline-none focus:ring-2 focus:ring-purple-500">
                </div>

                <div>
                    <label class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Abstrak & Ringkasan Eksklusif Dokumen *</label>
                    <textarea name="abstract" required rows="6" class="w-full p-4 rounded-xl border border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-[#0e1726] text-gray-800 dark:text-white text-xs leading-relaxed focus:outline-none focus:ring-2 focus:ring-purple-500">{{ old('abstract', $legalResource->abstract) }}</textarea>
                </div>

                <div class="p-5 rounded-2xl bg-purple-50/50 dark:bg-purple-900/10 border border-purple-200 dark:border-purple-500/20 space-y-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-xs font-black uppercase tracking-wider text-purple-600 dark:text-purple-400 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                            <span>Perbarui File Dokumen Asli (.PDF / Word)</span>
                        </h3>
                        @if($legalResource->file_path)
                            <span class="px-2.5 py-1 rounded bg-emerald-500/10 border border-emerald-500/20 text-emerald-600 text-[11px] font-bold">✓ File Saat Ini Aktif</span>
                        @endif
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-2">Ganti File Lokal (Maks 10MB)</label>
                            <input type="file" name="file" accept=".pdf,.doc,.docx" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-extrabold file:bg-purple-600 file:text-white hover:file:bg-purple-700 transition">
                            <p class="text-[10px] text-gray-400 mt-1">Biarkan kosong jika tidak ingin mengganti file yang ada.</p>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-2">Atau Perbarui Tautan Eksternal</label>
                            <input type="url" name="file_url" value="{{ old('file_url', str_starts_with($legalResource->file_path ?? '', 'http') ? $legalResource->file_path : '') }}" placeholder="https://cdn.example.com/dokumen/uu-pdp.pdf" class="w-full px-4 py-2 text-xs rounded-xl border border-gray-200 dark:border-white/10 bg-white dark:bg-[#0e1726] text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-200 dark:border-white/10 flex justify-end gap-3">
                    <a href="{{ route('admin.legal-resources.index') }}" class="px-5 py-2.5 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-xs font-bold hover:bg-gray-200 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2.5 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-700 text-white font-extrabold text-xs shadow-lg shadow-purple-500/20 transition transform active:scale-95">
                        Simpan Perubahan Vault &rarr;
                    </button>
                </div>

            </div>
        </form>
    </main>
</div>
</x-admin-layout>
