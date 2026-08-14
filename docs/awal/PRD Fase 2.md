Fase 2 ini adalah momen di mana website kamu mulai memiliki "wajah". Fokus utamanya adalah membangun _Landing Page_ untuk menarik klien, memamerkan katalog layanan, dan membuat pintu masuk (sistem _login/register_) yang super aman.

Berikut adalah detail rincian untuk **FASE 2: Frontend, Katalog Layanan, & Sistem Autentikasi**.

---

### FASE 2: FRONTEND, KATALOG LAYANAN, & SISTEM AUTENTIKASI

Fase ini bertujuan mengubah pengunjung biasa menjadi calon klien yang terdaftar di sistem kamu. Desain harus terlihat sangat profesional, bersih, dan tepercaya layaknya firma hukum digital.

#### 2.1. Arsitektur Landing Page (Membangun Kepercayaan)

Karena ini bisnis B2B dan legalitas, halaman depan tidak boleh terlihat seperti toko online biasa. Elemen yang harus ada di _Landing Page_:

- **Hero Section (Bagian Paling Atas):** \* _Headline_ yang kuat (contoh: "Solusi Legal & Perizinan Terpercaya untuk Bisnis Anda").
- Tombol _Call-to-Action_ (CTA) utama, misalnya "Konsultasi Sekarang" atau "Cari Dokumen Hukum".

- **Bagian "Mengapa Memilih Kami" (Trust Signals):** \* Ikon dan teks singkat yang menonjolkan keamanan data, pengerjaan tepat waktu, dan keahlian tim hukum.
- **Alur Kerja (_How it Works_):** \* Infografis 4 langkah sederhana: 1. Pilih Layanan $\rightarrow$ 2. Konsultasi/Isi Form $\rightarrow$ 3. Proses Pembayaran $\rightarrow$ 4. Terima Dokumen Legal.

#### 2.2. Modul Katalog Layanan Dinamis

Kita tidak akan mengetik (hardcode) nama layanan satu per satu di HTML. Tampilan layanan ini akan ditarik langsung dari Tabel `Services` yang sudah kita buat di Fase 1.

- **Tampilan Kartu (Card Grid):** Layanan NIB, Halal, dan _Legal Drafting_ ditampilkan dalam bentuk kotak/kartu.
- **Isi Kartu:** Menampilkan nama layanan, deskripsi singkat (misal: "Cocok untuk UMKM"), dan Estimasi Harga Dasar.
- **Tombol "Pesan Sekarang":** Jika tombol ini diklik, sistem akan mengecek:
- Jika user _belum_ login $\rightarrow$ Diarahkan ke halaman Register/Login.
- Jika user _sudah_ login $\rightarrow$ Langsung diarahkan ke Form Pemesanan (Masuk ke Fase 3 nantinya).

#### 2.3. Antarmuka Pencarian JDIH (Fitur Daya Tarik)

Ini adalah "wajah" dari fungsi API Kejaksaan Agung yang kita rancang di Fase 1. Fitur ini akan menjadi daya tarik utama (_lead magnet_) agar orang mau berkunjung ke website kamu.

- **Kolom Pencarian (_Search Bar_):** Diletakkan di bagian yang strategis di Landing Page. Pengguna tinggal mengetikkan kata kunci (misal: "Peraturan Pajak").
- **Halaman Hasil Pencarian (_Search Results_):** * Saat tombol cari ditekan, sistem menampilkan *Loading Spinner\* (animasi berputar) karena server kita sedang menunggu balasan dari server Kejaksaan Agung.
- Setelah data masuk, hasilnya ditampilkan dalam bentuk tabel atau daftar (Judul Aturan, Tahun, dan Tombol "Unduh PDF").

- **Batasan (Rate Limiting):** Untuk mencegah orang iseng (_spam_) yang membuat API kita diblokir oleh Kejaksaan, kita batasi pencarian (misalnya 1 IP address maksimal 20 pencarian per jam).

#### 2.4. Sistem Autentikasi & Keamanan Sesi (Pintu Gerbang Utama)

Ini adalah sistem "Satpam" dari website kamu. Kita akan menggunakan fitur bawaan PHP yaitu _PHP Session_.

- **Form Registrasi (Sign Up):**
- Data yang diminta: Nama Lengkap, Email, Nomor WhatsApp, Password, dan Konfirmasi Password.
- _Sistem Keamanan:_ Password **tidak boleh** disimpan dalam bentuk teks biasa (seperti "password123") di database. Sistem akan menggunakan fungsi `password_hash()` dari PHP agar password berubah menjadi karakter acak (misal: `$2y$10$abcdefg...`).

- **Form Login (Sign In):**
- Hanya meminta Email dan Password.

- **Sistem Pengatur Lalu Lintas (_Role-Based Routing_):**
- Setelah pengguna mengklik "Login", sistem PHP mencocokkan email dan password. Jika benar, sistem akan membaca kolom `Role` di database.
- **Lampu Hijau ke Client Area:** Jika role = `user`, arahkan mereka ke halaman _Dashboard Klien_.
- **Lampu Hijau ke Back-Office:** Jika role = `admin` atau `superadmin`, arahkan mereka langsung ke _Dashboard Operasional_ (tempat kamu bekerja).

- **Proteksi Halaman (Session Check):**
- Sistem akan memasang "gembok" pada setiap halaman _Dashboard_. Jika ada pengunjung asing yang iseng mengetikkan `websitekamu.com/dashboard_admin.php` di browser tanpa login, sistem akan langsung "menendang" mereka kembali ke halaman Login.

---
