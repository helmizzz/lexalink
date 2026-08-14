FASE 1: FONDASI SISTEM & ARSITEKTUR DATA
Fase ini adalah "cetak biru" dari seluruh website. Jika struktur datanya salah di awal, ke depannya sistem akan sulit dikembangkan.

1.1. Definisi Logika Bisnis & State Machine (Alur Status)
Sebelum mendesain database, kita harus mengunci bagaimana sebuah "Pesanan (Order)" bergerak dari awal sampai akhir. Kita sebut ini State Machine.

Alur Status Pesanan yang Disepakati:

- Draft/Unpaid: Klien sudah mengisi form dan memilih jasa, tapi belum membayar.

- Paid/Waiting Approval: Klien sudah bayar, menunggu Superadmin memvalidasi pembayaran.

- Processing: Pembayaran valid. Dokumen sedang dikerjakan oleh kamu (Superadmin/Admin).

- Client Review: (Opsional, khusus Legal Drafting) Draf awal dikirim kembali ke klien untuk dibaca.

- Revision: Klien meminta perbaikan (jika ada).

- Completed: Dokumen final (NIB/Halal/Kontrak Hukum) sudah diunggah dan siap diunduh oleh klien.

    1.2. Arsitektur Database Secara Rinci (Tanpa Coding)
    Kita akan membagi database ke dalam beberapa tabel utama yang saling berelasi. Berikut rincian isi datanya:

- Tabel Users (Data Pengguna)

Fungsi: Menyimpan data semua orang yang login ke sistem.

Kolom yang dibutuhkan: ID unik, Nama Lengkap, Email, Nomor WhatsApp, Password (dalam bentuk acak/hashing, bukan teks asli), dan Role (Klien, Admin, Superadmin).

- Tabel Services (Katalog Layanan)

Fungsi: Menyimpan daftar jasa yang kamu tawarkan agar harga dan deskripsi bisa diubah dinamis tanpa membongkar kode.

Kolom yang dibutuhkan: ID unik, Nama Layanan (misal: "Sertifikasi Halal Reguler"), Kategori, Deskripsi Singkat, dan Harga Dasar.

- Tabel Orders (Pusat Transaksi)

Fungsi: Jantung utama aplikasi. Menghubungkan Klien dengan Jasa yang dipesan.

Kolom yang dibutuhkan: ID unik, Nomor Referensi Order (misal: ORD-001), ID User (siapa yang pesan), ID Service (jasa apa yang dipesan), Catatan/Brief dari klien, dan Status Order (sesuai State Machine di atas).

- Tabel Invoices (Data Keuangan)

Fungsi: Mencatat tagihan agar rapi dan bisa dilacak.

Kolom yang dibutuhkan: ID unik, ID Order (merujuk ke pesanan mana), Nomor Invoice, Total Tagihan, Tanggal Jatuh Tempo, dan Status Pembayaran (Lunas/Belum Lunas).

- Tabel Documents (Manajemen Berkas)

Fungsi: Mencatat nama file secara sistematis agar tidak tertukar antara KTP Klien A dan KTP Klien B.

Kolom yang dibutuhkan: ID unik, ID Order, Nama File Asli, Nama File Tersimpan (nama file yang sudah dienkripsi oleh sistem), Tipe File (Syarat Klien atau Hasil Final), dan Tanggal Unggah.

1.3. Struktur Direktori Folder (Keamanan Ekstrim)
Karena kita memakai PHP Native dan menyimpan data sensitif seperti KTP, NPWP, atau draf kontrak rahasia perusahaan, struktur foldernya tidak boleh disatukan dengan file publik.

- Folder Publik (/public):

Hanya berisi file CSS, JavaScript, gambar logo, dan file Landing Page awal. Siapa pun bisa mengakses folder ini melalui internet.

- Folder Sistem (/core & /controllers):

Berisi logika PHP untuk memproses login, menyimpan data ke database, dan menghitung tagihan. Folder ini tidak boleh bisa diakses langsung via URL browser.

- Folder Penyimpanan Berkas (/storage/secure_documents/):

Ini paling krusial. Folder tempat KTP atau dokumen final disimpan harus dilindungi. File di dalam sini tidak bisa dibuka hanya dengan mengetik [www.websitekamu.com/storage/ktp_klien.pdf](https://www.websitekamu.com/storage/ktp_klien.pdf). File hanya bisa diunduh melalui sistem setelah Klien/Superadmin berhasil login (menggunakan paksaan PHP download stream).

1.4. Strategi Integrasi API (JDIH Kejaksaan Agung)
Untuk fitur pencarian dokumen hukum, kita tidak menyimpan datanya di database kita sendiri (karena datanya ribuan dan terus di-update oleh pemerintah). Kita akan mengambil data secara live dari API Kejaksaan.

- Mekanisme Request: Saat pengunjung mengetik "Undang-Undang Korupsi" di kolom pencarian website kamu, sistem PHP akan menjadi perantara (proxy) yang menembak ke server API JDIH Kejaksaan.

- Pemetaan Data: Dari ribuan data yang dibalas oleh server Kejaksaan, sistem kita hanya akan menyaring dan menampilkan:

* Judul Peraturan.

* Nomor dan Tahun Peraturan.

* Tautan langsung untuk mengunduh PDF peraturan tersebut.

- Skenario Gagal (Error Handling): Jika server JDIH Kejaksaan sedang mati atau maintenance, website kita tidak boleh ikut error/crash. Kita harus menyiapkan desain tampilan fallback yang memunculkan pesan ramah: "Maaf, server database nasional sedang sibuk. Silakan coba beberapa saat lagi."
