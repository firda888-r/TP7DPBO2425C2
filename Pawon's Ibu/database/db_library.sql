CREATE DATABASE db_library;
USE db_library;

-- Tabel Menu
CREATE TABLE Menu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_menu VARCHAR(255) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    detail TEXT NOT NULL,
    Foto VARCHAR(255) NOT NULL
);

-- Tabel Pesanan (relasi ke Menu)
CREATE TABLE Pesanan (
    id_pesanan INT AUTO_INCREMENT PRIMARY KEY,
    id INT NOT NULL,
    nama_pelanggan VARCHAR(255) NOT NULL,
    tanggal DATETIME NOT NULL,
    jumlah INT NOT NULL,
    subtotal DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id) REFERENCES Menu(id)
);

-- Tabel Karyawan
CREATE TABLE Karyawan (
    id_karyawan INT AUTO_INCREMENT PRIMARY KEY,
    nama_karyawan VARCHAR(255) NOT NULL,
    jabatan VARCHAR(255) NOT NULL,
    gmail VARCHAR(255) NOT NULL
);

-- Data contoh Menu
INSERT INTO Menu (nama_menu, harga, stock, detail, Foto) VALUES
('Soto', 30000, 5, 'Soto khas Jawa Timur yang memiliki rasa segar dan kaya rempah.', 'soto.jpeg');

-- Data contoh Karyawan
INSERT INTO Karyawan (nama_karyawan, jabatan, gmail) VALUES
('Saka', 'Koki', 'saka.koki@gmail.com');

-- Data contoh Pesanan
INSERT INTO Pesanan (id, nama_pelanggan, tanggal, jumlah, subtotal)
VALUES (1, 'Puti', '2025-11-09 00:00:00', 2, 69000.00);
