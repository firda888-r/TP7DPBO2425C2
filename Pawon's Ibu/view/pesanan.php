<?php
require_once 'class/Pesanan.php';
require_once 'class/Menu.php';

$pesanan = new Pesanan();
$menu = new Menu();

// === CREATE ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'create_pesanan') {
    $id = $_POST['id'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];

    $menuData = $menu->getMenuById($id);
    $subtotal = $menuData ? $menuData['harga'] * $jumlah : 0;

    $pesanan->addPesanan(null, $id, $nama_pelanggan, $tanggal, $jumlah, $subtotal);
    header("Location: index.php?page=pesanan");
    exit;
}

// === UPDATE ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update_pesanan') {
    $id_pesanan = $_POST['id_pesanan'];
    $id = $_POST['id'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];

    $menuData = $menu->getMenuById($id);
    $subtotal = $menuData ? $menuData['harga'] * $jumlah : 0;

    $pesanan->updatePesanan($id_pesanan, $id, $nama_pelanggan, $tanggal, $jumlah, $subtotal);
    header("Location: index.php?page=pesanan");
    exit;
}

// === DELETE ===
if (isset($_GET['action']) && $_GET['action'] === 'delete_pesanan' && !empty($_GET['id_pesanan'])) {
    $id_pesanan = intval($_GET['id_pesanan']);
    $pesanan->deletePesanan($id_pesanan);
    header("Location: index.php?page=pesanan");
    exit;
}

// === CEK MODE EDIT ===
$isEdit = (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id_pesanan']));

$menu_list = $menu->getAllMenu();
$data_pesanan = $pesanan->getAllPesanan();
?>

<!--FORM TAMBAH / EDIT-->
<?php if ($isEdit): ?>
    <?php $data = $pesanan->getPesananById($_GET['id_pesanan']); ?>
    <?php if ($data): ?>
        <h3>Edit Pesanan</h3>
        <form method="post" style="margin-bottom:20px;">
            <input type="hidden" name="action" value="update_pesanan">
            <input type="hidden" name="id_pesanan" value="<?= $data['id_pesanan']; ?>">

            <label>Menu:</label><br>
            <select name="id" required>
                <option value="">-- Pilih Menu --</option>
                <?php foreach ($menu_list as $m): ?>
                    <option value="<?= $m['id']; ?>" <?= $data['id'] == $m['id'] ? 'selected' : ''; ?>>
                        <?= htmlspecialchars($m['nama_menu']); ?> (Rp <?= htmlspecialchars($m['harga']); ?>)
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label>Nama Pelanggan:</label><br>
            <input type="text" name="nama_pelanggan" value="<?= htmlspecialchars($data['nama_pelanggan']); ?>" required><br><br>

            <label>Tanggal:</label><br>
            <input type="datetime-local" name="tanggal"
                value="<?= date('Y-m-d\TH:i', strtotime($data['tanggal'])); ?>" required><br><br>

            <label>Jumlah:</label><br>
            <input type="number" name="jumlah" min="1" value="<?= htmlspecialchars($data['jumlah']); ?>" required><br><br>

            <button type="submit">Update Pesanan</button>
        </form>
    <?php endif; ?>
<?php else: ?>
    <h3>Tambah Pesanan</h3>
    <form method="post" style="margin-bottom:20px;">
        <input type="hidden" name="action" value="create_pesanan">

        <label>Menu:</label><br>
        <select name="id" required>
            <option value="">-- Pilih Menu --</option>
            <?php foreach ($menu_list as $m): ?>
                <option value="<?= $m['id']; ?>"><?= htmlspecialchars($m['nama_menu']); ?> (Rp <?= htmlspecialchars($m['harga']); ?>)</option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Nama Pelanggan:</label><br>
        <input type="text" name="nama_pelanggan" required><br><br>

        <label>Tanggal:</label><br>
        <input type="datetime-local" name="tanggal" required><br><br>

        <label>Jumlah:</label><br>
        <input type="number" name="jumlah" min="1" required><br><br>

        <button type="submit">Tambah Pesanan</button>
    </form>
<?php endif; ?>

<!--TABEL PESANAN-->
<h3>Daftar Pesanan</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Nama Menu</th>
        <th>Nama Pelanggan</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
        <th>Aksi</th>
    </tr>
    <?php if (!empty($data_pesanan)): ?>
        <?php foreach ($data_pesanan as $p): ?>
            <tr>
                <td><?= $p['id_pesanan']; ?></td>
                <td><?= htmlspecialchars($p['nama_menu']); ?></td>
                <td><?= htmlspecialchars($p['nama_pelanggan']); ?></td>
                <td><?= htmlspecialchars($p['tanggal']); ?></td>
                <td><?= htmlspecialchars($p['jumlah']); ?></td>
                <td>Rp <?= number_format($p['subtotal'], 0, ',', '.'); ?></td>
                <td>
                    <form method="get" action="index.php">
                        <input type="hidden" name="page" value="pesanan">
                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" name="id_pesanan" value="<?= $p['id_pesanan']; ?>">
                        <button type="submit">Edit</button>
                    </form>

                    <form method="get" action="index.php" onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">
                        <input type="hidden" name="page" value="pesanan">
                        <input type="hidden" name="action" value="delete_pesanan">
                        <input type="hidden" name="id_pesanan" value="<?= $p['id_pesanan']; ?>">
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="7" style="text-align:center;">Belum ada pesanan.</td></tr>
    <?php endif; ?>
</table>

<!--STYLE-->
<style>
/* Tabel umum */
table {
    border-collapse: collapse;
    width: 100%;
    text-align: left;
}

th, td {
    padding: 10px;
    border: 1px solid #ccc;
}

/* Header tabel */
th {
    background-color: #3b180a;
    color: white;
}

/* Baris selang-seling */
tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Aksi tombol */
td form {
    display: inline-block; /* agar sejajar horizontal */
    margin: 0 4px; /* beri jarak antar tombol */
    background: none; /* hilangkan latar putih */
    padding: 0;
}

td form button {
    background-color: #3b180a; /* warna coklat tombol */
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
}

td form button:hover {
    background-color: #5a2912; /* efek hover */
}
</style>