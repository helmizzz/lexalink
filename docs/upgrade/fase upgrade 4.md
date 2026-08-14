# Fase Upgrade 4: CMS Modul Resource Hukum, Regulasi, & Database Riset

## 📌 Tujuan & Ruang Lingkup
Membangun fondasi utama dari ekosistem *Riset Hukum Modern AI* LexaLink v2 melalui penciptaan perpustakaan regulasi dan kajian riset hukum. Admin dan Superadmin bertugas memutakhirkan dan mengunggah dokumen hukum ke dalam sistem. **Publik di Landing Page hanya dapat membaca indeks katalog dan abstrak singkat, sedangkan akses pengunduhan dokumen secara utuh HANYA dibuka di dalam Dashboard Client**.

---

## 🏛 1. Struktur Database (Migration & Model)

### Model: `LegalResource`
Tabel: `legal_resources`

| Kolom | Tipe Data | Keterangan / Aturan |
| :--- | :--- | :--- |
| `id` | BigInteger (PK) | Primary Key, Auto Increment |
| `title` | String (255) | Judul Regulasi / Riset (misal: "UU No. 27 Tahun 2022 tentang Pelindungan Data Pribadi") |
| `slug` | String (255) | Unique slug untuk URL |
| `document_number`| String (100) | Nomor Regulasi / Putusan (misal: `UU-27/2022`, `PUTUSAN-MA/1234/2023`) |
| `category` | String (100) | Kategori (misal: `'Undang-Undang'`, `'Putusan MA'`, `'Regulasi AI'`, `'Jurnal Kajian'`) |
| `year` | Integer | Tahun penetapan atau riset (misal: `2024`) |
| `effective_date` | Date (Nullable)| Tanggal mulai berlaku atau diputus |
| `abstract` | LongText | Ringkasan / Abstrak substansi dokumen riset |
| `file_path` | String (255) | Path file PDF regulasi di direktori server/storage |
| `downloads_count`| UnsignedInteger | Default: `0`. Mencatat seberapa sering regulasi diunduh klien |
| `tags` | JSON (Nullable) | Kata kunci pencarian (misal: `["cyberlaw", "pdp", "komersial"]`) |
| `timestamps` | Timestamp | `created_at` & `updated_at` |

---

## 🔐 2. Hak Akses & Role Implementation

* **Admin & Superadmin:**
  - Full CRUD untuk menambahkan, memperbarui, atau menghapus item regulasi dan mengunggah file PDF.
* **User / Client (Dashboard Client - Database Riset Eksklusif):**
  - **Akses Unduh & Pembaca Penuh (Full Vault):** Memperoleh hak akses terhadap Mesin Pencari Regulasi di portal Klien dengan filter spesifik, meneliti abstrak secara detail, serta **mengunduh file dokumen asli (.PDF)**.
* **Tamu / Publik (Landing Page / `/resources`):**
  - **Katalog Indeks Tanpa File:** Mampu melihat daftar judul regulasi, tahun, dan abstrak. Ketika mencoba memencet tombol "Unduh Dokumen PDF", akan memicu pop-up / navigasi menuju **"Daftar / Login sebagai Klien LexaLink untuk Mengunduh Regulasi"**.

---

## 🚀 3. Detail Rencana Pengembangan (Step-by-Step)

### A. Backend & Logic
1. **Migration & Model:**
   - `php artisan make:model LegalResource -m`
   - Atur guarded/fillable serta casting array pada kolom `tags`.
2. **Controller & Routes:**
   - `App\Http\Controllers\Admin\LegalResourceController` untuk dasbor Admin dengan fitur penyimpanan file PDF ke `storage/app/public/resources`.
   - Route Klien di `routes/web.php` (Protected by middleware `auth` & `verified`):
     ```php
     Route::get('/dashboard/resources', [\App\Http\Controllers\ClientResourceController::class, 'index'])->name('client.resources.index');
     Route::get('/dashboard/resources/{legalResource}/download', [\App\Http\Controllers\ClientResourceController::class, 'download'])->name('client.resources.download');
     ```
     *(Fungsi `download` akan menambah nilai `downloads_count` +1 dan meluncurkan streaming attachment PDF).*

### B. Frontend & Views (UI/UX)
1. **Admin CRUD Views (`resources/views/admin/resources/`):**
   - Form yang rapi untuk memasukkan Nomor Regulasi, Kategori, Abstrak hukum, input tags, dan kotak uploader dokumen (.pdf).
2. **Landing Page & Public View (`resources/views/pages/resources-page.blade.php`):**
   - Transformasi halaman `/resources` menjadi Direktori Katalog Riset Hukum berteknologi tinggi. Dilengkapi live filter (UI/Search).
   - Tombol pengunduhan diarahkan ke sistem konversi prospek (*lead gen / client conversion*).
3. **Dashboard Client Integration (Database Riset Vault):**
   - Fitur **"Database Riset Hukum"** di sidebar Dashboard Client.
   - Mengusung tampilan bilah pencarian modern (*Modern Legal Search Engine*): tabel atau kartu regulasi, filter kategori & tahun, hitungan jumlah diunduh, dan tombol **"Unduh Dokumen (.PDF)"** berdesain mewah.

---

## ✅ 4. Checklist Eksekusi Fase 4 & Finalization
- [ ] Buat Migration, Model, & Storage Folder untuk `LegalResource`.
- [ ] Buat Seeder `LegalResourceSeeder` dengan 5 regulasi & putusan hukum aktual di Indonesia.
- [ ] Bangun `Admin\LegalResourceController` beserta file view admin CRUD.
- [ ] Tambahkan tautan navigasi "Database Regulasi / Resource" di sidebar Admin.
- [ ] Rombak halaman `/resources` publik ([resources-page.blade.php](file:///c:/laragon/www/lexalinkv2/resources/views/pages/resources-page.blade.php)) menjadi dinamis dengan proteksi download.
- [ ] Buat Mesin Pencari Regulasi di dalam Dashboard Client (`/dashboard/resources`).
- [ ] Uji coba sistem download PDF dan perhitungan `downloads_count`.
- [ ] Uji regresi seluruh alur ekosistem CMS LexaLink dari awal sampai akhir!
