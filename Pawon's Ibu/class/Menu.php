<?php
require_once 'config/db.php';

class Menu {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }
     
    // Tambah menu
    public function addMenu($nama_menu, $harga, $stock, $detail, $Foto) {
        $stmt = $this->db->prepare("INSERT INTO Menu (nama_menu, harga, stock, detail, Foto) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nama_menu, $harga, $stock, $detail, $Foto]);
    }

    // Ambil semua data
    public function getAllMenu() {
        $stmt = $this->db->prepare("SELECT * FROM Menu");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil 1 data
    public function getMenuById($id) {
        $stmt = $this->db->prepare("SELECT * FROM Menu WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update menu
    public function updateMenu($id, $nama_menu, $harga, $stock, $detail, $Foto) {
        $stmt = $this->db->prepare("UPDATE Menu 
                                    SET nama_menu = ?, harga = ?, stock = ?, detail = ?, Foto = ? 
                                    WHERE id = ?");
        return $stmt->execute([$nama_menu, $harga, $stock, $detail, $Foto, $id]);
    }

    // Hapus menu
    public function deleteMenu($id) {
        $stmt = $this->db->prepare("DELETE FROM Menu WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
