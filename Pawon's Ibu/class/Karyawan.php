<?php
require_once 'config/db.php';

class Karyawan {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Tambah karyawan baru
    public function addKaryawan($nama, $jabatan, $gmail) {
        $sql = "INSERT INTO karyawan (nama_karyawan, jabatan, gmail) VALUES (:nama, :jabatan, :gmail)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':nama' => $nama,
            ':jabatan' => $jabatan,
            ':gmail' => $gmail
        ]);
    }

    // Ambil semua karyawan
    public function getAllKaryawan() {
        $stmt = $this->db->prepare("SELECT * FROM karyawan ORDER BY id_karyawan ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil 1 karyawan berdasarkan ID
    public function getKaryawanById($id) {
        $stmt = $this->db->prepare("SELECT * FROM karyawan WHERE id_karyawan = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update karyawan
    public function updateKaryawan($id_karyawan, $nama, $jabatan, $gmail) {
        $sql = "UPDATE karyawan SET nama_karyawan = ?, jabatan = ?, gmail = ? WHERE id_karyawan = ?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$nama, $jabatan, $gmail, $id_karyawan]);
    }

    // Hapus karyawan
    public function deleteKaryawan($id_karyawan) {
        $stmt = $this->db->prepare("DELETE FROM karyawan WHERE id_karyawan = ?");
        return $stmt->execute([$id_karyawan]);
    }
}
?>
