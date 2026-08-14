Dashboard :
Card berisi barisan :

- Menampilkan Jumlah surat masuk
- Menampilkan jumlah surat keluar
- Menampilkan pekerjaan aktif
- Menampilkan pekerjaan selesai
- menampilkan pekerjaan yang mendekati tanggal
- menampilkan pekerjaan yang lewat tanggal
- total klien
  lalu dibawahnya ada card besar dibagi 2
  1 berisi list pekerjaan terbaru
- Nama Pekerjaan
- Nama perusahaan, Nama Klien
- Status pekerjaan
  1 lagi berisi pekerjaan prioritas
- Nama Pekerjaan
- Nama perusahaan, Nama Klien
- Status
  sama saja cuman menampilkan yang prioritas dan terbaru saja

Surat Masuk
Fitur ini digunakan oleh admin dan super admin untuk menambahkan surat masuk
ada kolom pencarian, filter jenis surat, status surat, dan tanggal dan tambah surat masuk
serta ada list surat masuk berupa seperti table, dan menampilkan kolom :

- Nomor & tanggal surat
- Jenis Surat
- Nama pengirim
- Nama client
- Kasus/Perkara
- Penanggung jawab /PIC (Karyawan tadi)
- Status
- dan aksi CRUD

tambah surat masuk berisi :

- Nomor surat
- tanggal surat
- jenis surat
- nama pengirim
- nama client
- kategori perkara
- Karyawan/Penanggung Jawab/PIC
- Status surat
- Keterangan
- Tautan dokumen/File

Surat Keluar
Hampir sama dengan surat masuk, cuman ditambah dan dirubah tujuan surat, Nama penerima

Monitoring Pekerjaan
ada fitur pencarian, filter status pekerjaan, filter prioritas, filter tanggal, tambah pekerjaan
Menampilkan card Total pekerjaan, Dalam proses, Selesai, Terlambat
Menampilkan list pekerjaan yang dibungkus card panjang, dan setiap card itu menampilkan detail pekerjaan
isi dari card :

- menampilkan perkara/kasus/judul pekerjaan
- menampilkan client, kategori
- PIC, Deadline, dan status pekerjaan
- aksi CRUD
  dan ada toggle tahapan (comming soon)
  Tambah pekerjaan berisi :
- Nama client
- Nama Perkara/Pekerjaan/kasus
- Jenis Pekerjaan
- PIC / Penanggung jawab
- Tanggal dimulai
- Tanggal berakhir
- Prioritas
- status
- Tahapan (tahapan ini memakai metode slider, jadi sifatnya parsial, bisa digeser antar tahapan berapa persen, kalau sudah selesai di slide ke tahap selesai, tapi pada setiap menggeser tahapan harus di isi nama tahapan)

Data Klien
fitur ini digunakan oleh admin dan superadmin untuk melakukan pendataan klien, beda dengan user, karena ini klien offline, klien yang ditangani oleh perusahaan, jadi klien ini juga berfungsi untuk pendataan siapa saja yang pernah ditangani, sedang ditangani, dan akan ditangani
berisi fitur pencarian, filter jenis client, status, Asc/Dsc, tambah client
Tambah client berisi :

- nama client
- jenis client
- kontak person
- telepon
- email
- kategori perkara
- status
- alamat
- catatan

Invoice
fitur ini digunakan oleh admin dan superadmin untuk melakukan invoice untuk klien
memiliki fitur search, filter status, dan tambah invoice
berisi list invoice yang dibungkus dengan table dan memuat komponen:

- nomor/tanggal
- klien
- perkara
- total
- status
- aksi CRUD

Tanda terima
fitur ini untuk membuat tanda terima untuk klien, user menyusul
Tanda terima ini masih belum terfikirkan, karena ini seperti invoice, mungkin semacam perjanjian, atau hasil akhir, dan bukti bahwa dokumen sudah diserahkan
