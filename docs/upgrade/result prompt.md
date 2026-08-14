Viewed upgrade.md:1-16
Edited upgrade.md
Viewed upgrade.md:1-27

Saya telah membaca dengan teliti rancangan upgrade Anda pada file [upgrade.md](file:///c:/laragon/www/lexalinkv2/docs/upgrade/upgrade.md). Konsep ini luar biasa! Transformasi dari website profile + basic CRM menjadi **Platform Ekosistem Hukum Modern (CMS + Semi-LMS + Database Riset)** akan memberikan nilai eksklusivitas tinggi bagi User/Client Anda, di mana Dasbor Klien berfungsi sebagai _Gated Member Area_ untuk ilmu dan literasi hukum.

Berikut adalah **Analisis, Blueprint Teknikal, & Peta Kebutuhan Pengembangan** sebagai bahan diskusi kita untuk mewujudkan rancangan ini:

---

### 🏛️ 1. Arsitektur Database & Model Baru (Migration & Model)

Kita butuh menambahkan **4 Entitas (Tabel) Utama** baru di database:

1. **`Article` (Opini / Berita)**
    - `id`, `title`, `slug`, `author_name` / `user_id`, `content` (Rich Text), `published_at`
    - `cover_image` (Foto Utama)
    - `gallery` _(JSON/Text: untuk menampung link atau array foto/video tambahan)_
    - `video_url` _(Link YouTube/Vimeo jika ada)_
    - `views_count` _(Default: 0, otomatis nambah saat dibaca)_

2. **`Event` (Event Mendatang)**
    - `id`, `title`, `slug`, `event_date`, `time`, `location` (Tempat / Link Zoom), `description`
    - `registration_url` _(Link pendaftaran eksternal ATAU sistem pendaftaran internal)_
    - `cover_image`, `gallery` _(JSON)_

3. **`Academy` (Kelas / Semi-LMS)**
    - `id`, `title`, `slug`, `description`, `event_date`, `time`, `location`
    - `modules_count` _(Jumlah modul, misal: "6 Modul")_
    - `benefits` _(JSON/Text: misal ["Sertifikat Resmi", "Akses Materi Selamanya", "Live Mentorship"])_
    - `registration_url`, `cover_image`, `gallery` _(JSON)_

4. **`LegalResource` (Database Riset Hukum & Regulasi)**
    - `id`, `title`, `document_number` (Nomor UU / Putusan), `category` _(misal: Putusan MA, UU, Peraturan OJK, Kajian AI)_
    - `year` / `effective_date`, `abstract` (Ringkasan/Deskripsi)
    - `file_path` (File PDF Regulasi / Riset untuk diunduh)

---

### 🔐 2. Pembagian Hak Akses & Role (Authorization)

Sesuai rancangan Anda di [upgrade.md](file:///c:/laragon/www/lexalinkv2/docs/upgrade/upgrade.md), kita akan menerapkan alur kontrol seperti berikut:

| Modul / Fitur          | Role: Admin & Superadmin               | Role: Client (Di Dashboard)                      | Tamu / Publik (Landing Page)    |
| :--------------------- | :------------------------------------- | :----------------------------------------------- | :------------------------------ |
| **Opini / Berita**     | 🛠️ CRUD (Create, Read, Update, Delete) | 📖 Baca & Lihat Detail                           | 📖 Baca & Lihat Detail          |
| **Event Mendatang**    | 🛠️ CRUD (Kelola Event & Galeri)        | 🎯 **Lihat Detail + Pendaftaran Event**          | 👀 Teaser / Card View saja      |
| **Academy (Semi-LMS)** | 🛠️ CRUD (Kelola Kelas & Modul)         | 🎓 **Lihat Detail + Benefit & Materi**           | 👀 Teaser / Card View saja      |
| **Resource Regulasi**  | 🛠️ CRUD (Unggah Riset / Hukum)         | 📚 **Akses Penuh Mesin Pencari & Unduh Dokumen** | 👀 Teaser / Katalog Tanpa Unduh |

_(Strategi di atas sangat bagus karena memaksa pengunjung biasa untuk **Login/Mendaftar menjadi Client** agar bisa melihat detail Event, mengakses Academy, dan mencari database regulasi hukum)._

---

### 🚀 3. Apa Saja yang Perlu Kita Tambahkan & Modifikasi?

1. **Backend & Logic (Laravel)**:
    - **4 Controller Admin**: `AdminArticleController`, `AdminEventController`, `AdminAcademyController`, `AdminResourceController`.
    - **Controller Klien / Publik**: Mengupdate Controller untuk menampilkan data asli dari database ke Landing Page ([welcome.blade.php](file:///c:/laragon/www/lexalinkv2/resources/views/welcome.blade.php)) dan halaman Dashboard Client.
    - **Router Baru di [web.php](file:///c:/laragon/www/lexalinkv2/routes/web.php)**: Memisahkan route admin (`/admin/articles/...`), client (`/dashboard/events/...`), dan public (`/opini/{slug}`).

2. **Frontend UI & Views (Blade + Tailwind)**:
    - **Menu Admin Sidebar**: Menambahkan menu baru di [admin-sidebar.blade.php](file:///c:/laragon/www/lexalinkv2/resources/views/layouts/admin-sidebar.blade.php) untuk mengelola keempat modul CMS ini.
    - **Form CRUD Admin**: Desain form yang modern dengan dukungan _File Upload_ (gambar/PDF) serta **Rich Text Editor** agar tulisan Opini & deskripsi Academy rapi (bisa ter-formatting _bold_, _italic_, _bullet numbers_).
    - **Dashboard Klien UI**: Menambahkan navigasi & halaman baru di area Klien untuk menjelajah Event, Academy, serta mesin pencari (_Search & Filter Bar_) untuk Database Riset Hukum.

---

### 💡 Pertanyaan Diskusi untuk Memantapkan Langkah

Before kita mulai mengetikan kode (bikin _Migration_ dan lain-lain), ada 2 hal menarik yang ingin saya diskusikan dengan Anda:

1. **Sistem Pendaftaran Event & Academy (Semi-LMS):**
   Apakah saat ini untuk _Link Pendaftaran_ kita cukup menggunakan input teks biasa (misal Admin memasukkan link **Google Form / Zoom / WhatsApp**), **ATAU** kita ingin membuat tombol **"Daftar / Enroll Sekarang"** di dalam Dashboard Client di mana sistem langsung menyimpan riwayat pendaftaran Klien tersebut ke dalam database kita (sehingga Admin tahu siapa saja Client yang ikut)?
2. **Text Editor untuk Opini & Deskripsi:**
   Agar Admin mudah menulis artikel hukum yang panjang dan bergaya rapi, apakah Anda setuju jika kita pasangkan **WYSIWYG Editor** ringan (seperti _Quill.js_, _Trix_, atau _TinyMCE_) pada Form Admin?

Bagaimana tanggapan Anda mengenai struktur di atas? Apakah pemahamannya sudah sejajar dengan bayangan Anda, atau ada yang ingin distel lagi sebelum kita susun _Implementation Plan_ dan eksekusinya?
