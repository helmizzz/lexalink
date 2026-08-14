# Fase Upgrade 2: CMS Modul Event Mendatang & Sistem Registrasi Client

## 📌 Tujuan & Ruang Lingkup
Mengupgrade sistem Event pada LexaLink v2 menjadi CMS yang dikelola Admin/Superadmin. Modul ini menjadi fondasi CRM & engagement, di mana Landing Page hanya menampilkan *Teaser/Card View*, sedangkan **detail mendalam dan pendaftaran event GATED (eksklusif) dilakukan hanya melalui Dashboard Client**.

---

## 🏛 1. Struktur Database (Migration & Model)

### Model: `Event`
Tabel: `events`

| Kolom | Tipe Data | Keterangan / Aturan |
| :--- | :--- | :--- |
| `id` | BigInteger (PK) | Primary Key, Auto Increment |
| `title` | String (255) | Nama / Judul Event (Webinar, Workshop Hukum, Seminar) |
| `slug` | String (255) | Unique slug untuk URL |
| `event_date` | Date | Tanggal pelaksanaan event |
| `event_time` | String (50) | Jam pelaksanaan (misal: `09:00 - 12:00 WIB`) |
| `location_type`| Enum | `'offline'`, `'online'` (Zoom / Google Meet), `'hybrid'` |
| `location` | String (255) | Tempat gedung atau Link Zoom / Platform |
| `description`| LongText | Deskripsi lengkap event & susunan acara |
| `cover_image`| String (Nullable)| Poster / Banner event |
| `gallery` | JSON (Nullable) | Galeri foto & video kegiatan event terkait / teaser |
| `registration_link` | String (Nullable) | Link pendaftaran eksternal (Zoom/GForm/WhatsApp) |
| `status` | Enum | `'upcoming'`, `'completed'`, `'cancelled'` (Default: `'upcoming'`) |
| `timestamps` | Timestamp | `created_at` & `updated_at` |

*(Opsi Tambahan Nilai CRM)*: Jika ingin sistem mendata siapa saja klien yang mendaftar langsung di dalam portal kita, kita bisa menyertakan tabel pivot `event_registrations` (`id`, `event_id`, `user_id`, `registered_at`).

---

## 🔐 2. Hak Akses & Role Implementation

* **Admin & Superadmin:**
  - Full CRUD atas data Event di dashboard Admin.
  - Memantau event yang sedang berlangsung, mengubah status menjadi `completed` dan melampirkan galeri hasil acara.
* **User / Client (Dashboard Client):**
  - **Akses Eksklusif:** Bisa membuka halaman Detail Event, menelaah galeri foto/video acara, serta mengklik tombol pendaftaran event di portal mereka.
* **Tamu / Publik (Landing Page):**
  - Hanya dapat memandang **Teaser Card** (Nama event, tanggal, jam, dan banner). Tombol detail/daftar akan mengarah ke perintah **"Login / Daftar Klien untuk Melihat Rincian"**.

---

## 🚀 3. Detail Rencana Pengembangan (Step-by-Step)

### A. Backend & Logic
1. **Migration & Model:**
   - `php artisan make:model Event -m`
   - Lengkapi schema migration dan tambahkan casting JSON untuk `gallery` dan Date casting untuk `event_date` di `Event.php`.
2. **Controller & Routes:**
   - `App\Http\Controllers\Admin\EventController` (Untuk CRUD admin).
   - Route Admin di `routes/web.php`:
     ```php
     Route::resource('admin/events', \App\Http\Controllers\Admin\EventController::class);
     ```
   - Route Client (Protected by `auth` middleware):
     ```php
     Route::get('/dashboard/events', [\App\Http\Controllers\ClientEventController::class, 'index'])->name('client.events.index');
     Route::get('/dashboard/events/{event:slug}', [\App\Http\Controllers\ClientEventController::class, 'show'])->name('client.events.show');
     ```

### B. Frontend & Views (UI/UX)
1. **Admin CRUD Views (`resources/views/admin/events/`):**
   - `index.blade.php`: Tabel daftar event dengan informasi jadwal dan badge status (`upcoming` / `completed`).
   - `create.blade.php` & `edit.blade.php`: Form input banner event, penetapan waktu, lokasi (offline/online), deskripsi, dan upload galeri video/foto.
2. **Landing Page Integrations:**
   - **Beranda (`welcome.blade.php`)**: Pada section *"Event Mendatang"* (Kolom kanan), panggil Event dengan status `upcoming` terdekat.
   - Pada tombol CTA di card, gunakan label seperti **"Daftar Event (Area Klien)"** yang mengarah ke rute login/dasbor.
3. **Dashboard Client Integration (`resources/views/dashboard/events/`):**
   - **Katalog Event Klien**: Grid view bergaya eksklusif menampung seluruh Event (Mendatang maupun Arsip Event Selesai).
   - **Halaman Detail & Pendaftaran (`show.blade.php`)**: Menampilkan poster beresolusi tinggi, jadwal countdown, rincian lokasi/link Zoom, galeri kegiatan, serta **Tombol Aksi Utama (CTA)** Pendaftaran Event.

---

## ✅ 4. Checklist Eksekusi Fase 2
- [ ] Buat Migration & Model `Event`.
- [ ] Buat Seeder `EventSeeder` dengan 4 contoh event hukum (offline & webinar AI).
- [ ] Buat `Admin\EventController` dan tampilan Blade CRUD Admin.
- [ ] Tambahkan tautan menu "Event Mendatang" di sidebar Admin.
- [ ] Update section Event pada `welcome.blade.php` (Landing Page Teaser).
- [ ] Buat Controller & Views eksklusif untuk Dashboard Client (`/dashboard/events`).
- [ ] Verifikasi alur gating: Tamu dipandu login -> Klien terautorisasi untuk registrasi event.
