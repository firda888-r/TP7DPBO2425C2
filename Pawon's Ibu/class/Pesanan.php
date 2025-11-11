<?php
require_once 'config/db.php';

class Pesanan {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }
    // Tambah Pesanan
    public function addPesanan($id_pesanan, $id, $nama_pelanggan, $tanggal, $jumlah, $subtotal) {
        $query = "INSERT INTO Pesanan (id_pesanan, id, nama_pelanggan, tanggal, jumlah, subtotal)
                  VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id_pesanan, $id, $nama_pelanggan, $tanggal, $jumlah, $subtotal]);
    }

    // Ambil semua data
     public function getAllPesanan() {
        // Ambil semua pesanan, join dengan nama menu
        $query = "SELECT p.*, m.nama_menu 
                  FROM Pesanan p 
                  JOIN Menu m ON p.id = m.id
                  ORDER BY p.id_pesanan ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil 1 data
     public function getPesananById($id_pesanan) {
        $query = "SELECT * FROM Pesanan WHERE id_pesanan = ?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id_pesanan]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update pesanan
     public function updatePesanan($id_pesanan, $id, $nama_pelanggan, $tanggal, $jumlah, $subtotal) {
        $query = "UPDATE Pesanan 
                  SET id = ?, nama_pelanggan = ?, tanggal = ?, jumlah = ?, subtotal = ?
                  WHERE id_pesanan = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id, $nama_pelanggan, $tanggal, $jumlah, $subtotal, $id_pesanan]);
    }

    // Hapus pesanan
    public function deletePesanan($id_pesanan) {
        $query = "DELETE FROM Pesanan WHERE id_pesanan = ?";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$id_pesanan]);
    }
}
?>