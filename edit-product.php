<?php
include 'db.php';
include 'ProductManager.php';

$db = new Database();
$pdo = $db->getConnection();

$productManager = new ProductManager($pdo);

$error = "";
$id = $_GET['id'] ?? null;

if (!$id) die("❌ Không có ID sản phẩm.");

$product = $productManager->getById($id);
if (!$product) die("❌ Sản phẩm không tồn tại.");

// LẤY SIZE HIỆN CÓ
$stmt = $pdo->prepare("SELECT IDSIZE FROM ao_size WHERE IDAO = ?");
$stmt->execute([$product['IDAO']]);
$product_sizes = $stmt->fetchAll(PDO::FETCH_COLUMN);

// ========================= ❗ POST UPDATE =========================
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (empty($_POST['idsize'])) {
        $error = "❌ Vui lòng chọn ít nhất một size!";
    }

    if (!$error) {
        $data = [
            'idlsp'   => $_POST['idlsp'],
            'ten'     => $_POST['ten'],
            'mota'    => $_POST['mota'],
            'giaban'  => $_POST['giaban'],
            'idsize'  => $_POST['idsize'],
            'image_source' => $_POST['image_source'],
            'image'   => $_FILES['image'],
            'image_url' => $_POST['image_url'] ?? '',
        ];

        $productManager->update($id, $data);
        header("Location: Qlsp.php");
        exit;
    }

    // GIỮ LẠI DỮ LIỆU CŨ NẾU LỖI
    $product['TEN']  = $_POST['ten'];
    $product['MOTA'] = $_POST['mota'];
    $product['GIA']  = $_POST['giaban'];
    $product_sizes = $_POST['idsize'] ?? [];// GIỮ LẠI CHECKBOX
}

// GỌI SIZE & LOẠI
include 'headerad.php';
include 'SizeManager.php';
include 'CategoryManager.php';

$sizes = (new SizeManager($pdo))->getAll();
$categories = (new CategoryManager($pdo))->getAll();
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
<meta charset="UTF-8">
<title>Sửa sản phẩm</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>

<section class="shop spad">
<div class="container">
<h2>Sửa sản phẩm</h2>

<?php if ($error): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label>Phân loại</label>
        <select name="idlsp" class="form-control">
            <?php foreach ($categories as $c): ?>
                <option value="<?= $c['IDLOAI'] ?>" <?= $product['IDLOAI']==$c['IDLOAI']?'selected':'' ?>>
                    <?= $c['TENLOAI'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label>Tên sản phẩm</label>
        <input type="text" name="ten" class="form-control"
               value="<?= htmlspecialchars($product['TEN']) ?>">
    </div>

    <div class="form-group">
        <label>Loại Size</label><br>
        <?php foreach ($sizes as $s): ?>
            <label style="margin-right:10px;">
                <input type="checkbox" name="idsize[]"
                       value="<?= $s['IDSIZE'] ?>"
                       <?= in_array($s['IDSIZE'], $product_sizes) ? "checked" : "" ?>>
                <?= $s['TENSIZE'] ?>
            </label>
        <?php endforeach; ?>
    </div>

    <div class="form-group">
        <label>Mô tả</label>
        <textarea name="mota" class="form-control"><?= htmlspecialchars($product['MOTA']) ?></textarea>
    </div>

    <div class="form-group">
        <label>Giá bán</label>
        <input type="number" name="giaban" class="form-control"
               value="<?= $product['GIA'] ?>">
    </div>

    <div class="form-group">
        <label>Hình ảnh hiện tại</label><br>
        <img src="<?= $product['URL'] ?>" width="160">

        <br><label>Thay đổi hình ảnh</label><br>
        <input type="radio" name="image_source" value="file" checked> File
        <input type="radio" name="image_source" value="url"> URL

        <div>
            <input type="file" name="image" class="form-control mt-2">
            <input type="text" name="image_url" class="form-control mt-2"
                   placeholder="Nhập URL ảnh nếu chọn URL">
        </div>
    </div>

    <button class="btn btn-primary">Lưu</button>
    <a href="Qlsp.php" class="btn btn-secondary">Hủy</a>

</form>
</div>
</section>

</body>
</html>
