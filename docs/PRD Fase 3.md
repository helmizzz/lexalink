Mari kita lanjutkan pembedahan sistemnya. Berikut adalah spesifikasi detail untuk **FASE 3: Core System - Klien Portal & Formulir Dinamis**, tempat di mana klien mulai bertransaksi denganmu.

---

### FASE 3: CORE SYSTEM - KLIEN PORTAL & FORMULIR DINAMIS

Fase ini berfokus pada ruang pribadi klien (_Client Area_) setelah mereka berhasil login. Tujuan utama desain di fase ini adalah **kemudahan penggunaan (User-Friendly)** dan **transparansi**. Klien yang mengurus legalitas sering kali cemas, jadi sistem ini harus bisa membuat mereka merasa aman dan terinformasi.

#### 3.1. Dashboard Utama Klien (Pusat Kendali Pengguna)

Saat klien pertama kali masuk, mereka tidak boleh kebingungan harus klik apa. Dashboard ini harus merangkum seluruh aktivitas mereka.

- **Panel Sapaan & Ringkasan:** Menampilkan sapaan ("Halo, [Nama Klien]") dan tiga kotak ringkasan:

1. _Dokumen Aktif:_ Jumlah order yang sedang kamu kerjakan.
2. _Menunggu Pembayaran:_ Jumlah invoice yang belum mereka bayar.
3. _Dokumen Selesai:_ Jumlah order yang sudah rampung.

- **Tabel Riwayat Pemesanan (Recent Orders):** Menampilkan daftar singkat pesanan terakhir mereka, mencakup Nomor Order, Nama Layanan, Tanggal, dan Status Terkini. Ada tombol "Lihat Detail" di setiap barisnya.
- **Navigasi Sidebar:** Menu di samping kiri yang bersih, berisi: Dashboard, Buat Pesanan Baru, Tagihan (Invoice), dan Pengaturan Profil.

#### 3.2. Mesin Formulir Dinamis (_Dynamic Form Engine_)

Ini adalah fitur paling kompleks di sisi klien. Karena kebutuhan data NIB berbeda dengan kebutuhan Legal Drafting, formulirnya tidak boleh disamakan. Sistem akan membaca ID Layanan yang dipilih dan menampilkan form yang relevan.

- **Skenario A: Form Perizinan (NIB & Halal)**
- _Fokus:_ Pengumpulan berkas (Upload-heavy).
- _Input Teks:_ Nama Perusahaan/Usaha, Alamat Lengkap, Skala Usaha, Bidang Usaha (KBLI).
- _Area Upload:_ Sistem menyediakan kotak unggah terpisah untuk KTP, NPWP, dan Dokumen Lama (jika ada).

- **Skenario B: Form Produk Hukum (Legal Drafting / Aturan Internal)**
- _Fokus:_ Penggalian informasi (_Text-heavy_).
- _Input Teks:_ Pihak-pihak yang terlibat (Pihak 1, Pihak 2), Nilai Kontrak (jika ada), dan Kotak Teks Besar (_Textarea_) untuk menceritakan latar belakang masalah atau poin-poin yang wajib ada di dalam kontrak.
- _Area Upload:_ Hanya satu kotak unggah opsional (misal klien punya draf mentah atau dokumen referensi).

- **Validasi File Unggahan (Sangat Krusial):**
- Sistem PHP di belakang layar akan menolak otomatis jika file bukan PDF, JPG, atau PNG.
- Batas maksimal ukuran file dikunci (misalnya maksimal 5MB per file) agar _storage_ hosting kamu tidak cepat penuh.

#### 3.3. Sistem Pelacakan Real-Time (_Progress Tracker_)

Ini fitur untuk mengurangi klien yang terus-terusan _chat_ WhatsApp sekadar bertanya "Mas/Mbak, dokumen saya sudah sampai mana?".

- **Visualisasi Stepper:** Saat klien mengklik "Lihat Detail" pada pesanannya, di bagian atas layar akan muncul ilustrasi garis waktu (_timeline bar_) dengan 5 titik status:

1. **Menunggu Pembayaran** (Warna Merah/Kuning).
2. **Verifikasi Berkas** (Berkas sedang kamu cek).
3. **Sedang Diproses** (Kamu sedang menyusun draf atau memproses di OSS/SIHALAL).
4. **Revisi/Review Klien** (Khusus pembuatan kontrak, berhenti di sini menunggu klien membaca draf).
5. **Selesai** (Warna Hijau).

- **Jejak Aktivitas (_Activity Log_):** Di bawah garis waktu, ada riwayat detail seperti resi paket pengiriman (Contoh: _"12 Agustus 09:00 - Pembayaran divalidasi oleh Admin"_, _"14 Agustus 14:00 - Draf kontrak pertama diunggah untuk direview"_).

#### 3.4. Ruang Berbagi File yang Aman (_Secure File Exchange_)

Klien akan menyerahkan dokumen sensitif dan mengunduh hasil final di sini.

- **Manajemen File Klien:** Klien bisa melihat KTP/dokumen yang sudah mereka unggah sebelumnya di rincian order, tapi mereka tidak bisa menghapusnya jika status order sudah masuk ke tahap "Sedang Diproses" (agar bukti kerja kamu tidak hilang).
- **Tombol Unduh Final:** Jika status order sudah "Selesai", sebuah tombol hijau besar ("Unduh Dokumen Final") akan muncul secara otomatis.
- **Mekanisme Pengamanan Unduhan:** Seperti yang disinggung di Fase 1, file tidak diakses dari URL langsung. Saat klien klik tombol unduh, sistem mengecek ID sesi (apakah dia benar-benar pemilik dokumen ini?). Jika ya, PHP akan melakukan _force download_ dokumen tersebut dari folder rahasia.
