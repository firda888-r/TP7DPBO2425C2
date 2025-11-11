## Janji

Saya Firda Ridzki Utami dengan Nim 2401626 mengerjakan TP7 dalam praktikum mata kuliah DPBO untuk keberkahannya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aammin

## Diagram
<img width="1230" height="532" alt="Screenshot 2025-11-11 211318" src="https://github.com/user-attachments/assets/354a7bb7-4063-4169-a080-47dd02029c76" />

## Alur Kode Program

Program ini menggunakan tiga kelas utama, yaitu **Menu**, **Pesanan**, dan **Karyawan**, yang masing-masing mewakili tabel dalam database dan menangani proses CRUD (Create, Read, Update, Delete). Setiap kelas melakukan koneksi ke database melalui file `db.php` dan menyimpan koneksi tersebut dalam atribut `$this->db`. Untuk setiap operasi database, program menggunakan **Prepared Statement** agar lebih aman dan sesuai ketentuan tugas. Class **Menu** mengelola data menu seperti nama menu, harga, stok, detail, dan foto. Class **Pesanan** mengelola transaksi pemesanan dan memiliki **relasi** ke tabel Menu melalui kolom `id`, sehingga pada method `getAllPesanan()` dilakukan JOIN agar nama menu yang dipesan dapat ditampilkan. Sedangkan class **Karyawan** mengelola data karyawan seperti nama, jabatan, dan email. Dengan struktur seperti ini, program memiliki alur yang jelas: data dikirim dari form, diproses oleh method dalam class sesuai kebutuhan, kemudian hasilnya dikembalikan untuk ditampilkan ke halaman antarmuka pengguna.

## Dokumentasi
## Menu




