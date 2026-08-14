Mari kita bedah **FASE 4: Back-Office / Dashboard Superadmin**. Ini adalah "dapur" tempat kamu bekerja. Desainnya tidak perlu terlalu cantik atau banyak animasi seperti Landing Page, yang penting **cepat diakses, datanya jelas, dan navigasinya minim klik**.

---

### FASE 4: BACK-OFFICE - DASHBOARD SUPERADMIN (COMMAND CENTER)

Di fase ini, kita membangun alat kerja utamamu. Seluruh pesanan, berkas, dan uang yang masuk dari klien (di Fase 3) bermuara di sini.

#### 4.1. Dashboard Utama (Ringkasan Operasional)

Saat kamu login, halaman ini langsung memberikan rangkuman apa saja yang harus kamu kerjakan hari ini agar tidak ada tenggat waktu (_deadline_) yang terlewat.

- **Panel Metrik Cepat:** Kotak angka ringkasan di bagian atas layar:
- Pesanan Baru (Belum diproses).
- Menunggu Verifikasi Pembayaran.
- Proyek Berjalan (_In Progress_).
- Total Pendapatan Bulan Ini (Rupiah).

- **Tabel Prioritas Hari Ini:** Daftar pesanan yang butuh tindakan segera (misalnya, klien yang baru saja mengunggah bukti bayar atau pesanan yang statusnya masih "Draft").

#### 4.2. Modul Manajemen Pesanan & Pemrosesan

Ini adalah halaman detail untuk mengeksekusi setiap pesanan yang masuk.

- **Halaman Detail Order:** Saat kamu mengklik satu pesanan klien, kamu akan melihat seluruh informasi dalam satu layar penuh:
- Data profil klien (Nama, Perusahaan, Kontak WA).
- Kebutuhan atau _brief_ dari klien.
- Tombol "Unduh Semua Syarat" (sistem menggabungkan file KTP, NPWP, dll. milik klien ke dalam satu file `.zip` agar kamu tidak perlu mengunduhnya satu-satu).

- **Panel Kontrol Status (State Manager):**
- Sebuah _dropdown_ sederhana bagi kamu untuk mengubah status order (Contoh: dari `Waiting Approval` menjadi `Processing`).
- Setiap kali kamu mengubah status dan menekan "Simpan", sistem di belakang layar otomatis memperbarui _Progress Tracker_ di dashboard klien.

- **Catatan Internal (_Private Note_):** Kolom teks rahasia di halaman order yang hanya bisa dilihat olehmu. Berguna untuk mencatat progres di instansi pemerintah (misal: "NIB tertahan karena KBLI salah, sedang diurus ulang").

#### 4.3. Modul Keuangan & Penagihan (Invoicing)

Sistem ini memastikan kamu dibayar sebelum mulai bekerja keras.

- **Generator Tagihan Otomatis:** Ketika ada pesanan masuk, sistem PHP otomatis membuat halaman Invoice dengan nomor urut rapi (misal: `INV-2026-0001`).
- **Validasi Pembayaran Manual:** \* Klien akan mengunggah foto bukti transfer.
- Kamu membuka modul ini, mencocokkan mutasi di rekening bankmu dengan foto bukti transfer.
- Jika uang sudah masuk, kamu cukup klik tombol **"Tandai Lunas"** (_Mark as Paid_). Status pesanan klien otomatis melaju ke tahap "Sedang Diproses".

- **Tabel Laporan Keuangan:** Daftar seluruh invoice yang pernah diterbitkan, lengkap dengan filter status Lunas atau Belum Lunas.

#### 4.4. Sistem Manajemen Dokumen Final (Ruang Serah Terima)

Ini adalah fitur untuk mengirimkan hasil kerjamu (baik berupa draf kontrak maupun sertifikat NIB/Halal) secara aman ke klien.

| Jenis Aksi                             | Fitur yang Disediakan untuk Superadmin                                                                                         |
| -------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------ |
| **Kirim Draf (Khusus Legal Drafting)** | Form unggah `.docx` atau `.pdf` dengan tombol centang "Butuh Review Klien". Status akan berubah menjadi _Client Review_.       |
| **Kirim Dokumen Final**                | Form unggah file PDF (Sertifikat NIB/Halal/Kontrak Final). Setelah diunggah, status otomatis menjadi _Completed_.              |
| **Manajemen File**                     | Daftar semua file yang pernah kamu unggah untuk order tertentu. Kamu bisa menghapus atau menggantinya jika ada salah _upload_. |

#### 4.5. Database Klien (CRM Mini)

Ingat fitur pencarian JDIH di Fase 2 yang mewajibkan orang mendaftar? Semua data mereka akan masuk ke halaman ini.

- **Tabel Daftar Pengguna:** Berisi seluruh nama, email, dan nomor WhatsApp orang yang pernah mendaftar di website kamu.
- **Fitur Blokir/Hapus:** Tombol untuk memblokir akun yang terdeteksi _spam_ atau _fake account_.
- **Ekspor Data (Opsional tapi Penting):** Tombol "Export to Excel/CSV" agar kamu bisa mengunduh daftar kontak klien jika suatu saat ingin melakukan promosi via _email blast_ atau _WhatsApp blast_.

---

### FASE 5: PENGUJIAN AKHIR & PELUNCURAN (DEPLOYMENT)

Karena ini menggunakan PHP Native, tahap akhir sebelum website bisa dipakai oleh publik sangat bergantung pada keamanan dan konfigurasi server.

- **Keamanan Input (Sanitasi):** Memastikan semua form di sisi Klien (Fase 3) dan Superadmin (Fase 4) tidak bisa disusupi _script_ peretas menggunakan `htmlspecialchars()` dan PDO `prepare()`.
- **Uji Coba Alur Keseluruhan:** Kamu bertindak sebagai Klien (memesan layanan, isi form) di satu browser, dan bertindak sebagai Superadmin (terima order, validasi, unggah hasil) di browser lain untuk memastikan data mengalir dengan benar.
- **Persiapan Hosting (cPanel/VPS):** * Mengunggah *source code* (.zip) ke server *hosting\*.
- Mengimpor database `schema.sql` (dari Fase 1) ke _phpMyAdmin_ server.
- Menyesuaikan file `config/database.php` dengan _username_ dan _password_ dari _hosting_.

- **Aktivasi SSL (Gembok Hijau):** Memastikan domain menggunakan HTTPS agar pengiriman data login, KTP, dan dokumen sensitif tetap terenkripsi dan tidak bisa disadap di jaringan internet publik.
