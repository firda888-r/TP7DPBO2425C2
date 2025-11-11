## Janji

Saya Firda Ridzki Utami dengan Nim 2401626 mengerjakan TP7 dalam praktikum mata kuliah DPBO untuk keberkahannya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamin

## Diagram
<img width="1230" height="532" alt="Screenshot 2025-11-11 211318" src="https://github.com/user-attachments/assets/354a7bb7-4063-4169-a080-47dd02029c76" />

## Alur Kode Program

Terdapat tiga class utama yaitu **Menu**, **Pesanan**, dan **Karyawan**. Masing-masing class diawali dengan melakukan pemanggilan file `db.php` menggunakan `require_once`, yang berfungsi untuk membangun **koneksi ke database**. Koneksi ini kemudian disimpan ke dalam variabel `$this->db`, sehingga dapat digunakan pada seluruh method dalam class tersebut. Penggunaan koneksi terpusat seperti ini memudahkan pengelolaan serta menjaga agar struktur program tetap rapi.

Setiap class memiliki seperangkat method CRUD (Create, Read, Update, dan Delete). Pada class **Menu**, method `addMenu()` digunakan untuk menambahkan menu baru ke database, `getAllMenu()` mengambil semua data menu, `getMenuById()` mengambil satu menu berdasarkan ID, `updateMenu()` mengubah data menu, dan `deleteMenu()` menghapus menu dari tabel. Semua query ditulis menggunakan **Prepared Statement** dengan `prepare()` dan `execute()` untuk meningkatkan keamanan dari serangan seperti SQL Injection. Pada class **Pesanan**, fungsi dan alur kerjanya hampir sama, namun lebih kompleks karena melibatkan **relasi antar tabel**. Pada tabel `Pesanan`, kolom `id` berfungsi sebagai **foreign key** yang mengarah ke `Menu.id`. Hal ini membuat suatu pesanan selalu terhubung dengan menu yang dipesan. Pada method `getAllPesanan()`, hal ini terlihat dari penggunaan **JOIN** antara tabel `Pesanan` dan `Menu`, sehingga ketika data pesanan ditampilkan, nama menu yang terkait dapat ikut muncul. Dengan demikian, relasi database dimanfaatkan secara optimal.

Sementara itu, class Karyawan bertugas mengelola data pegawai restoran, seperti nama karyawan, jabatan, dan email. Method `addKaryawan()`, `getAllKaryawan()`, `getKaryawanById()`, `updateKaryawan()`, dan `deleteKaryawan()` bekerja dengan cara yang sama seperti dua tabel lainnya, sehingga struktur kode tetap konsisten dan mudah dipahami. 

## Dokumentasi 

**Menu**


##
https://github.com/user-attachments/assets/75ef3a7f-dbc7-4420-8462-28812681a612



##




https://github.com/user-attachments/assets/89ad8509-78ba-41d6-9223-196f97ab9f59





##





**Pesanan**
<img width="1854" height="881" alt="AddPesanan" src="https://github.com/user-attachments/assets/d8a0ac36-8d38-403c-86b5-a8e64da58236" />






##



<img width="1892" height="878" alt="BeforeUpdatePesanan" src="https://github.com/user-attachments/assets/5debd4f2-216e-4bd0-8690-fcfcd79a506b" />






##



<img width="1896" height="580" alt="AfterUpdatePesanan" src="https://github.com/user-attachments/assets/2c469e40-003b-47f9-88b5-44bb78de12a8" />






##


<img width="1893" height="925" alt="DeletePesanan" src="https://github.com/user-attachments/assets/462cfaf8-9abb-4c25-af4d-bb263f7797fb" />





##



**Karyawan**

<img width="1880" height="875" alt="BeforeAddKaryawan" src="https://github.com/user-attachments/assets/1cec1fe4-429c-4a89-9401-40f23a7eb3c7" />



##




<img width="1888" height="569" alt="AfterAddKaryawan" src="https://github.com/user-attachments/assets/e3cd83b1-3dbc-4bc8-970e-d2ac3ad32b26" />




##


<img width="1885" height="585" alt="BeforeEditKaryawan" src="https://github.com/user-attachments/assets/94d49b35-27eb-44e6-be8e-e2cfbb0b3a05" />



##



<img width="1894" height="929" alt="BeforeDeleteKaryawan" src="https://github.com/user-attachments/assets/df47cd3c-67f0-4db2-af1a-bfc711b4281c" />








