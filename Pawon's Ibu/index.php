<?php
require_once 'class/Menu.php';
require_once 'class/Karyawan.php';
require_once 'class/Pesanan.php';
// jika nanti kamu sudah punya relasi antar menu & pesanan
// require_once 'class/Detail_Pesanan.php';

$menu = new Menu();
$karyawan = new Karyawan();
$pesanan = new Pesanan();
// $detail_pesanan = new Detail_Pesanan();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restoran Pawon Ibu</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'view/header.php'; ?>

    <main>
        <h2>𝑺𝒆𝒍𝒂𝒎𝒂𝒕 𝑫𝒂𝒕𝒂𝒏𝒈 𝒅𝒊 𝑨𝒅𝒎𝒊𝒏 𝑷𝒂𝒘𝒐𝒏 𝑰𝒃𝒖
        </h2>

        <nav>
            <a href="?page=menu">Daftar Menu</a> |
            <a href="?page=pesanan">Data Pesanan</a> |
            <a href="?page=karyawan">Data Karyawan</a>
            <!-- kalau sudah ada -->
            <!-- | <a href="?page=detail_pesanan">Detail Pesanan</a> -->
        </nav>

        <hr>

        <?php
        if (isset($_GET['page'])) {
            $page = $_GET['page'];

            if ($page == 'menu') {
                include 'view/menu.php';
            } elseif ($page == 'pesanan') {
                include 'view/pesanan.php';
            } elseif ($page == 'karyawan') {
                include 'view/karyawan.php';
            } elseif ($page == 'detail_pesanan') {
                include 'view/detail_pesanan.php';
            } else {
                echo "<p>Halaman tidak ditemukan.</p>";
            }

        } 
        ?>
    </main>

    <?php include 'view/footer.php'; ?>
</body>
</html>
