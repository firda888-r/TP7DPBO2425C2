<?php
require_once 'class/Karyawan.php';
$karyawan = new Karyawan();

// === CREATE ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'create_karyawan') {
    $karyawan->addKaryawan($_POST['nama_karyawan'], $_POST['jabatan'], $_POST['gmail']);
    header("Location: index.php?page=karyawan");
    exit;
}

// === UPDATE ===
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update_karyawan') {
    $karyawan->updateKaryawan($_POST['id_karyawan'], $_POST['nama_karyawan'], $_POST['jabatan'], $_POST['gmail']);
    header("Location: index.php?page=karyawan");
    exit;
}

// === DELETE ===
if (isset($_GET['action']) && $_GET['action'] === 'delete_karyawan' && !empty($_GET['id'])) {
    $karyawan->deleteKaryawan($_GET['id']);
    header("Location: index.php?page=karyawan");
    exit;
}

// === DATA ===
$data_karyawan = $karyawan->getAllKaryawan();
$isEdit = (isset($_GET['action']) && $_GET['action'] === 'edit_karyawan' && isset($_GET['id']));
?>

<!--FORM TAMBAH / EDIT-->
<?php if ($isEdit): ?>
    <?php $data = $karyawan->getKaryawanById($_GET['id']); ?>
    <?php if ($data): ?>
        <h3>Edit Karyawan</h3>
        <form method="post" style="margin-bottom: 20px;">
            <input type="hidden" name="action" value="update_karyawan">
            <input type="hidden" name="id_karyawan" value="<?= $data['id_karyawan']; ?>">

            <label>Nama Karyawan:</label><br>
            <input type="text" name="nama_karyawan" value="<?= htmlspecialchars($data['nama_karyawan']); ?>" required><br><br>

            <label>Jabatan:</label><br>
            <input type="text" name="jabatan" value="<?= htmlspecialchars($data['jabatan']); ?>" required><br><br>

            <label>Email Gmail:</label><br>
            <input type="text" name="gmail" value="<?= htmlspecialchars($data['gmail']); ?>" required><br><br>

            <button type="submit">Update</button>
            <a href="index.php?page=karyawan">Batal</a>
        </form>
    <?php endif; ?>
<?php else: ?>
    <h3>Tambah Data Karyawan</h3>
    <form method="post" style="margin-bottom: 20px;">
        <input type="hidden" name="action" value="create_karyawan">

        <label>Nama Karyawan:</label><br>
        <input type="text" name="nama_karyawan" required><br><br>

        <label>Jabatan:</label><br>
        <input type="text" name="jabatan" required><br><br>

        <label>Email Gmail:</label><br>
        <input type="text" name="gmail" required><br><br>

        <button type="submit">Tambah</button>
    </form>
<?php endif; ?>

<!--TABEL DATA KARYAWAN-->
<h3>Daftar Karyawan</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Jabatan</th>
        <th>Gmail</th>
        <th>Aksi</th>
    </tr>
    <?php if (!empty($data_karyawan)): ?>
        <?php foreach ($data_karyawan as $row): ?>
            <tr>
                <td><?= $row['id_karyawan']; ?></td>
                <td><?= htmlspecialchars($row['nama_karyawan']); ?></td>
                <td><?= htmlspecialchars($row['jabatan']); ?></td>
                <td><?= htmlspecialchars($row['gmail']); ?></td>
                <td>
                    <!-- Tombol Edit -->
                    <form method="get" action="index.php">
                        <input type="hidden" name="page" value="karyawan">
                        <input type="hidden" name="action" value="edit_karyawan">
                        <input type="hidden" name="id" value="<?= $row['id_karyawan']; ?>">
                        <button type="submit">Edit</button>
                    </form>

                    <!-- Tombol Hapus -->
                    <form method="get" action="index.php" onsubmit="return confirm('Hapus karyawan ini?')">
                        <input type="hidden" name="page" value="karyawan">
                        <input type="hidden" name="action" value="delete_karyawan">
                        <input type="hidden" name="id" value="<?= $row['id_karyawan']; ?>">
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr><td colspan="5" style="text-align:center;">Belum ada data.</td></tr>
    <?php endif; ?>
</table>

<!--STYLE-->
<style>
/* Gaya umum tabel */
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

/* Aksi tombol sejajar dan tanpa latar putih */
td form {
    display: inline-block;
    margin: 0 4px;
    background: none;
    padding: 0;
}

td form button {
    background-color: #3b180a;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 500;
}

td form button:hover {
    background-color: #5a2912;
}
</style>
