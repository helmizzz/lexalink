# Fase Upgrade 3: CMS Modul Academy & Ekosistem Semi-LMS

## 📌 Tujuan & Ruang Lingkup
Mengolah fitur Academy menjadi platform pelatihan hukum berbasis Semi-LMS (Learning Management System). Admin/Superadmin dapat merancang kelas edukasi, menentukan jumlah modul, memapar benefit pengayaan, dan mempromosikan galeri. **Akses detail kelas & materi/pendalaman dilakukan secara khusus oleh Client di Dashboard Klien**.

---

## 🏛 1. Struktur Database (Migration & Model)

### Model: `Academy`
Tabel: `academies`

| Kolom | Tipe Data | Keterangan / Aturan |
| :--- | :--- | :--- |
| `id` | BigInteger (PK) | Primary Key, Auto Increment |
| `title` | String (255) | Judul Academy (misal: "Masterclass Regulasi AI & Kepatuhan Hukum") |
| `slug` | String (255) | Unique slug untuk URL |
| `description`| LongText | Penjelasan komprehensif silabus & target pembelajaran |
| `event_date` | Date (Nullable)| Tanggal mulai kelas / bootcamp |
| `event_time` | String (100) | Waktu belajar / Jadwal live sessions |
| `location` | String (255) | Tempat atau Platform (Zoom / E-Learning Portal) |
| `modules_count`| String (100)| Jumlah modul pelajaran (misal: `"8 Modul Komprehensif"`) |
| `benefits` | JSON | Daftar benefit pelajaran (misal: `["Sertifikat Kelulusan", "Draft Perjanjian AI", "Live Q&A"]`) |
| `cover_image`| String (Nullable)| Poster / Banner Academy |
| `video_url` | String (Nullable)| Video trailer atau introductory materi |
| `gallery` | JSON (Nullable) | Galeri foto & video suasana kelas sebelumnya |
| `registration_url`| String (Nullable)| Link pendaftaran / form enrollment |
| `timestamps` | Timestamp | `created_at` & `updated_at` |

*(Persiapan Ekspansi LMS Asli)*: Di masa depan, kita dapat dengan mudah menyambungkan tabel ini ke tabel `academy_modules` untuk menaruh video materi bab per bab yang dapat diklik & di-play satu-persatu di Dashboard Klien.

---

## 🔐 2. Hak Akses & Role Implementation

* **Admin & Superadmin:**
  - Full CRUD pembuatan kelas Academy, konfigurasi modul, benefit, & galeri di Dasbor Admin.
* **User / Client (Dashboard Client - Area Siswa / Peserta):**
  - **Akses Semi-LMS Eksklusif:** Klien berhak melirik rincian bedahh silabus dari tiap modul, menonton video trailer/pengantar kelas, melihat dokumentasi kelas, dan menekan tombol Pendaftaran/Enrollment Academy.
* **Tamu / Publik (Landing Page):**
  - Pada halaman publik (Beranda dan `/event-academy`), hanya bisa melihat Katalog Preview (Judul, Jumlah Modul, Benefit Utama, & Gambar). Fitur detail dikunci dengan instruksi **"Akses Kelas Melalui Dasbor Klien"**.

---

## 🚀 3. Detail Rencana Pengembangan (Step-by-Step)

### A. Backend & Logic
1. **Migration & Model:**
   - `php artisan make:model Academy -m`
   - Pada `Academy.php`, konfigurasikan `$casts` untuk field `benefits` dan `gallery` menjadi `array`/`json`.
2. **Controller & Routes:**
   - `App\Http\Controllers\Admin\AcademyController` (Admin Dashboard).
   - Route Klien di `routes/web.php` (Middleware `auth`):
     ```php
     Route::get('/dashboard/academies', [\App\Http\Controllers\ClientAcademyController::class, 'index'])->name('client.academies.index');
     Route::get('/dashboard/academies/{academy:slug}', [\App\Http\Controllers\ClientAcademyController::class, 'show'])->name('client.academies.show');
     ```

### B. Frontend & Views (UI/UX)
1. **Admin CRUD Views (`resources/views/admin/academies/`):**
   - Form pembuatan Academy dilengkapi UI *Dynamic Input Tags/List* sehingga Admin dapat menambah atau mengurangi butir-butir *Benefit* (Sertifikat, Materi PDF, dll) dengan klik tombol sederhana.
2. **Landing Page Integrations:**
   - Update halaman [event-academy.blade.php](file:///c:/laragon/www/lexalinkv2/resources/views/pages/event-academy.blade.php) yang saat ini statis menjadi dinamis melahap data langsung dari database Academy dan Event terbaru.
3. **Dashboard Client Integration (Semi-LMS Hub):**
   - Halaman **Academy & Kelas Hukum** di Dasbor Client yang menyajikan pengalaman layaknya e-learning modern (Terdapat badge jumlah modul, rincian benefit bergaya centang hijau / checkmarks, embed player YouTube untuk video kelas/trailer, dan galeri foto materi).

---

## ✅ 4. Checklist Eksekusi Fase 3
- [ ] Buat Migration & Model `Academy`.
- [ ] Buat Seeder `AcademySeeder` dengan kelas hukum bergengsi & daftar benefit lengkap.
- [ ] Implementasikan `Admin\AcademyController` dan file panduan Admin View.
- [ ] Tambahkan menu "Academy & Semi-LMS" di sidebar Admin.
- [ ] Rombak total halaman publik `/event-academy` agar dinamis & terintegrasi dengan data baru.
- [ ] Bangun antarmuka Semi-LMS pada Dashboard Klien (`/dashboard/academies`).
- [ ] Pengujian visualisasi benefit JSON, embed video, dan layout responsif.
