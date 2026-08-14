# Fase Upgrade 1: CMS Modul Opini & Berita (Article Engine)

## 📌 Tujuan & Ruang Lingkup
Mengubah bagian Opini & Insight Hukum dari yang sebelumnya statis (hardcoded) menjadi sistem CMS dinamis yang dapat dikelola sepenuhnya oleh **Admin & Superadmin**, serta dapat dibaca oleh **User/Client** di Landing Page maupun di area Dashboard Client.

---

## 🏛 1. Struktur Database (Migration & Model)

### Model: `Article`
Tabel: `articles`

| Kolom | Tipe Data | Keterangan / Aturan |
| :--- | :--- | :--- |
| `id` | BigInteger (PK) | Primary Key, Auto Increment |
| `user_id` | Foreign Key | Relasi ke tabel `users` (Penulis / Author) |
| `title` | String (255) | Judul Opini / Artikel Hukum |
| `slug` | String (255) | Unique slug untuk URL yang SEO-friendly |
| `content` | LongText | Isi lengkap artikel (mendukung formatting dari Rich Text Editor) |
| `cover_image`| String (Nullable)| Path foto sampul utama / thumbnail |
| `gallery` | JSON (Nullable) | Array URL foto & video tambahan (Galeri Dokumentasi) |
| `video_url` | String (Nullable)| Link video YouTube/Vimeo atau file lokal jika ada |
| `views_count`| UnsignedInteger | Default: `0`. Menghitung statistik pembaca |
| `status` | Enum | `'draft'`, `'published'` (Default: `'draft'`) |
| `published_at`| Timestamp (Null)| Tanggal diterbitkan |
| `timestamps` | Timestamp | `created_at` & `updated_at` standar Laravel |

---

## 🔐 2. Hak Akses & Role Implementation

* **Admin & Superadmin:**
  - Hak penuh CRUD (Create, Read, Update, Delete) di dasbor Admin.
  - Mampu mengubah status `draft` menjadi `published`.
* **User / Client (Member):**
  - Read (Membaca artikel lengkap & menonton video tautan) baik di Landing Page maupun di menu Dashboard Klien.
* **Tamu / Publik (Non-Login):**
  - Read (Membaca di Landing Page & Halaman Khusus `/opini-berita`).

---

## 🚀 3. Detail Rencana Pengembangan (Step-by-Step)

### A. Backend & Logic
1. **Migration & Model:**
   - Jalankan perintah pembuatan model dan migrasi: `php artisan make:model Article -m`
   - Isi file migrasi sesuai skema tabel `articles` di atas.
   - Buat relasi di `Article.php` ke `User::class` (author).
2. **Controller & Routes:**
   - Buat controller untuk Admin: `App\Http\Controllers\Admin\ArticleController`.
   - Daftarkan resource route admin di `routes/web.php` dalam grup middleware `['auth', 'admin']`:
     ```php
     Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
     ```
   - Buat atau perluas public/client controller untuk menampilkan opini di `/opini-berita` dan dasbor klien.

### B. Frontend & Views (UI/UX)
1. **Admin CRUD Views (`resources/views/admin/articles/`):**
   - `index.blade.php`: Tabel daftar opini dengan badge status, statistik `views_count`, dan tombol aksi (Edit, Hapus, Preview).
   - `create.blade.php` & `edit.blade.php`: Form modern dilengkapi:
     - **WYSIWYG Text Editor** (Quill.js atau TinyMCE) agar Admin mudah menulis format paragraf hukum, bold, list, dll.
     - Upload file gambar untuk `cover_image`.
     - Input dynamic (tambah baris) untuk URL galeri foto & link video.
2. **Landing Page Integrations:**
   - **Beranda (`welcome.blade.php`)**: Update section *"Opini & Insight Hukum"* agar melakukan query 3 artikel terbaru (`Article::where('status', 'published')->latest()->take(3)->get()`).
   - **Halaman Khusus (`pages/opini-berita.blade.php`)**: Tampilkan grid artikel lengkap dengan fitur pagination dan pencarian (search title/author).
   - **Halaman Baca Detail (`pages/opini-detail.blade.php`)**: Menampilkan isi lengkap artikel, tanggal terbit, penulis, embed video jika ada, dan galeri foto. Setiap kali dibuka, increment `views_count`.
3. **Dashboard Client Integration:**
   - Tambahkan menu **"Opini & Insight Hukum"** pada navigation di Dashboard Klien (`/dashboard/opini`) agar Klien bisa menyimak pemutakhiran artikel langsung dari dalam portal.

---

## ✅ 4. Checklist Eksekusi Fase 1
- [ ] Buat Migration & Model `Article`.
- [ ] Buat Seeder `ArticleSeeder` (data dummy berganda untuk pengujian visual).
- [ ] Buat & implementasikan `Admin\ArticleController`.
- [ ] Buat tampilan CRUD Admin + integrasi Editor Teks.
- [ ] Tambahkan menu "Opini & Berita" di `admin-sidebar.blade.php`.
- [ ] Update `welcome.blade.php` & `opini-berita.blade.php` untuk menampilkan data dinamis.
- [ ] Buat halaman detail opini (`opini-detail.blade.php`).
- [ ] Pengujian keseluruhan fitur CRUD, validasi form, dan responsif peramban.
