<?php
// Tambah Menu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_menu') {
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];
    $detail = $_POST['detail'];
    $Foto = null;

    // Upload Foto
    if (!empty($_FILES['Foto']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir);
        $target_file = $target_dir . basename($_FILES["Foto"]["name"]);
        if (move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file)) {
            $Foto = basename($_FILES["Foto"]["name"]);
        }
    }

    $menu->addMenu($nama_menu, $harga, $stock, $detail, $Foto);
    header("Location: index.php?page=menu");
    exit;
}

// Update Menu
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_menu') {
    $id = $_POST['id'];
    $nama_menu = $_POST['nama_menu'];
    $harga = $_POST['harga'];
    $stock = $_POST['stock'];
    $detail = $_POST['detail'];
    $Foto = $_POST['Foto_lama'];

    if (!empty($_FILES['Foto']['name'])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) mkdir($target_dir);
        $target_file = $target_dir . basename($_FILES["Foto"]["name"]);
        if (move_uploaded_file($_FILES["Foto"]["tmp_name"], $target_file)) {
            $Foto = basename($_FILES["Foto"]["name"]);
        }
    }

    $menu->updateMenu($id, $nama_menu, $harga, $stock, $detail, $Foto);
    header("Location: index.php?page=menu");
    exit;
}

// Hapus Menu
if (isset($_GET['action']) && $_GET['action'] === 'delete_menu' && !empty($_GET['id'])) {
    $id = intval($_GET['id']);
    $menu->deleteMenu($id);
    header("Location: index.php?page=menu");
    exit;
}

// Cek apakah user sedang di halaman menu
$showMenuPage = (isset($_GET['page']) && $_GET['page'] === 'menu');

$isEdit = (isset($_GET['action']) && $_GET['action'] === 'edit_menu' && isset($_GET['id']));
$data_menu = $menu->getAllMenu();
?>

<?php if ($showMenuPage): ?>
    <!-- Bagian ini hanya muncul jika user menekan "Daftar Menu" -->
    <?php if ($isEdit): ?>
        <?php $data = $menu->getMenuById($_GET['id']); ?>
        <?php if ($data): ?>
            <h3>Edit Menu</h3>
            <form method="post" enctype="multipart/form-data" style="margin-bottom:20px;">
                <input type="hidden" name="action" value="update_menu">
                <input type="hidden" name="id" value="<?= $data['id']; ?>">
                <input type="hidden" name="Foto_lama" value="<?= htmlspecialchars($data['Foto']); ?>">

                <label>Nama Menu:</label><br>
                <input type="text" name="nama_menu" value="<?= htmlspecialchars($data['nama_menu']); ?>" required><br><br>

                <label>Harga:</label><br>
                <input type="number" name="harga" value="<?= htmlspecialchars($data['harga']); ?>" required><br><br>

                <label>Stok:</label><br>
                <input type="number" name="stock" value="<?= htmlspecialchars($data['stock']); ?>" required><br><br>

                <label>Detail:</label><br>
                <textarea name="detail" rows="3" cols="30"><?= htmlspecialchars($data['detail']); ?></textarea><br><br>

                <label>Foto Menu (opsional):</label><br>
                <?php if (!empty($data['Foto'])): ?>
                    <img src="uploads/<?= htmlspecialchars($data['Foto']); ?>" width="120" alt="Foto Lama"><br>
                <?php endif; ?>
                <input type="file" name="Foto"><br><br>

                <button type="submit">Update Menu</button>
            </form>
        <?php endif; ?>
    <?php else: ?>
        <h3>Tambah Menu Baru</h3>
        <form method="post" enctype="multipart/form-data" style="margin-bottom:20px;">
            <input type="hidden" name="action" value="create_menu">
            <label>Nama Menu:</label><br>
            <input type="text" name="nama_menu" required><br><br>
            <label>Harga:</label><br>
            <input type="number" name="harga" required><br><br>
            <label>Stok:</label><br>
            <input type="number" name="stock" required><br><br>
            <label>Detail:</label><br>
            <textarea name="detail" rows="3" cols="30"></textarea><br><br>
            <label>Foto Menu:</label><br>
            <input type="file" name="Foto"><br><br>
            <button type="submit">Tambah Menu</button>
        </form>
    <?php endif; ?>

    <h3>Daftar Menu</h3>
    <div class="menu-container">
    <?php if (!empty($data_menu)): ?>
    <?php foreach ($data_menu as $m): ?>
        <div class="menu-card">
            <?php if (!empty($m['Foto'])): ?>
                <img src="uploads/<?= htmlspecialchars($m['Foto']); ?>" alt="Foto <?= htmlspecialchars($m['nama_menu']); ?>">
            <?php else: ?>
                <img src="https://via.placeholder.com/220x150?text=No+Image" alt="No Image">
            <?php endif; ?>

            <div class="menu-info">
                <h4><?= htmlspecialchars($m['nama_menu']); ?></h4>
                <p><strong>Harga:</strong> Rp <?= htmlspecialchars($m['harga']); ?></p>
                <p><strong>Stok:</strong> <?= htmlspecialchars($m['stock']); ?></p>
                <p><strong>Detail:</strong><br><?= htmlspecialchars($m['detail']); ?></p>

                <div class="menu-buttons">
                    <form method="get" action="index.php">
                        <input type="hidden" name="page" value="menu">
                        <input type="hidden" name="action" value="edit_menu">
                        <input type="hidden" name="id" value="<?= $m['id']; ?>">
                        <button type="submit" class="btn-edit">Edit</button>
                    </form>

                    <form method="get" action="index.php">
                        <input type="hidden" name="page" value="menu">
                        <input type="hidden" name="action" value="delete_menu">
                        <input type="hidden" name="id" value="<?= $m['id']; ?>">
                        <button type="submit" class="btn-delete" onclick="return confirm('Yakin ingin menghapus menu ini?')">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php else: ?>
        <p>Belum ada data menu.</p>
    <?php endif; ?>
    </div>
<?php endif; ?>

    <!--STYLE-->
<style>
.menu-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}
.menu-card {
    width: 220px;
    border: 1px solid #ccc;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    background-color: #fff;
    text-align: center;
    transition: 0.2s;
}
.menu-card:hover {
    transform: scale(1.03);
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}
.menu-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}
.menu-info {
    padding: 10px;
}
.menu-info h4 {
    margin: 8px 0;
    font-size: 18px;
    color: #333;
}
.menu-info p {
    margin: 4px 0;
    color: #555;
    font-size: 14px;
}
.menu-buttons {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 12px;
}
.btn-edit, .btn-delete {
    background-color: #3B1A0E;
    color: white;
    border: none;
    padding: 6px 14px;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
    transition: background-color 0.2s;
}
.menu-buttons form {
    background: transparent;
    border: none;
    padding: 0;
    margin: 0;
}
.btn-edit:hover { background-color: #5b2a18; }
.btn-delete:hover { background-color: #9b2c1e; }
</style>
