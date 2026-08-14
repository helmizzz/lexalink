# Rencana Implementasi: Upgrade Besar (Sistem Manajemen Firma Hukum)

Berdasarkan dokumen `Upgrade Besar.md`, ini adalah pembaruan masif yang akan mengubah LexaLink dari sekadar portal klien menjadi **Sistem Manajemen Firma Hukum (Law Firm Practice Management System)** yang utuh. 

Mengingat skala perubahannya yang sangat besar (melibatkan banyak tabel database baru, relasi kompleks, dan puluhan halaman antarmuka), pengerjaannya **wajib dipecah menjadi beberapa fase terpisah** agar tidak tumpang tindih dan mudah dikontrol (diuji coba).

## Open Questions
> [!IMPORTANT]
> **Pertanyaan Desain & Konsep untuk Anda:**
> 1. **Data Klien:** Apakah `Data Klien` (offline) ini nantinya bisa ditautkan dengan akun User/Client (online) yang sudah ada, atau benar-benar terpisah 100% secara database?
> 2. **Karyawan/PIC:** Pada tabel Surat Masuk dan Pekerjaan terdapat "Karyawan / PIC". Apakah kita akan menggunakan data dari tabel `Users` yang memiliki role `admin`/`superadmin`, atau kita perlu membuat tabel `Karyawan` tersendiri?
> 3. **Tanda Terima:** Karena fitur ini masih konseptual, apakah kita bisa menunda pembuatannya (masuk ke Fase Backlog) sampai alur kerjanya benar-benar jelas?

---

## Usulan Pembagian Fase

Berikut adalah usulan saya untuk memecah "Upgrade Besar" ini menjadi 4 fase yang berurutan. Setiap fase akan kita selesaikan satu per satu dari awal sampai akhir.

### Fase 7: Fondasi Database & Manajemen Klien (Client Data)
Fase ini berfokus pada pembuatan struktur *database* utama dan fitur manajemen klien *offline*. Semua modul lain akan bergantung pada data klien ini.
*   **Database:** Membuat *migration* dan *model* untuk `ClientData`, `IncomingMail`, `OutgoingMail`, `Job`, `Invoice`, `Receipt`.
*   **Fitur:** CRUD lengkap untuk **Data Klien**.
*   **UI:** Halaman daftar klien offline, *form* tambah/edit klien, dan filter pencarian.

### Fase 8: Sistem Persuratan (Mail Tracking)
Fase ini mengimplementasikan pencatatan lalu lintas dokumen fisik maupun digital firma hukum.
*   **Fitur:** CRUD untuk **Surat Masuk** dan **Surat Keluar**.
*   **UI:** Halaman *table list* surat masuk & keluar, filter jenis/tanggal/status, dan integrasi tautan dokumen (*file upload*).
*   **Relasi:** Menautkan surat dengan entitas *ClientData* dan *PIC* (Admin).

### Fase 9: Monitoring Pekerjaan & Invoicing
Ini adalah jantung dari manajemen operasional.
*   **Fitur:** CRUD untuk **Monitoring Pekerjaan**.
*   **UI:** 
    *   Halaman daftar pekerjaan dengan kartu ringkasan (Total, Proses, Selesai, Terlambat).
    *   *Slider* parsial interaktif untuk menggeser persentase tahapan (*progress*).
*   **Fitur:** CRUD untuk **Invoice** yang merujuk ke data Klien dan Pekerjaan.

### Fase 10: Revamp Dashboard Admin & Tanda Terima
Setelah semua data terkumpul dari fase 7, 8, dan 9, kita tampilkan rangkumannya di *Dashboard*.
*   **Fitur:** Mengubah total halaman **Dashboard Admin**.
*   **UI:** Menambahkan kartu metrik (Surat masuk/keluar, Pekerjaan aktif/selesai/terlambat, dll).
*   **UI:** Membagi layar utama menjadi 2: **Pekerjaan Terbaru** dan **Pekerjaan Prioritas**.
*   **Fitur:** Implementasi awal **Tanda Terima** (jika konsep sudah matang).

---

## Bagaimana Selanjutnya?
Jika Anda setuju dengan pembagian fase dan desain alur di atas, tolong konfirmasikan dan jawab pertanyaan di bagian **Open Questions**. Setelah itu, kita bisa langsung **memulai pengerjaan Fase 7** hari ini!
