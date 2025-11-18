<?php
session_start();

include 'db.php';
include 'ProductManager.php';
include 'CategoryManager.php';
include 'SizeManager.php';

$db = new Database();
$pdo = $db->getConnection();

$productManager = new ProductManager($pdo);
$categoryManager = new CategoryManager($pdo);
$sizeManager = new SizeManager($pdo);

$categories = $categoryManager->getAll();
$sizes = $sizeManager->getAll();

$error = '';
$success = '';
$idlsp = $ten = $mota = $giaban = $image_url = '';
$idsize = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idlsp  = $_POST['idlsp'] ?? '';
    $ten    = $_POST['ten'] ?? '';
    $mota   = $_POST['mota'] ?? '';
    $giaban = $_POST['giaban'] ?? '';
    $idsize = $_POST['idsize'] ?? [];
    $image_source = $_POST['image_source'] ?? '';
    $image_url = '';

    if (empty($idsize)) {
        $error = "❌ Vui lòng chọn ít nhất một size!";
    }

    if (!$error) {
        if ($image_source === 'file' && !empty($_FILES['image']['name'])) {
            $target_dir = "img/shop/";
            if (!is_dir($target_dir)) mkdir($target_dir, 0755, true);
            $image_name = basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $image_name;
            if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $error = "❌ Không thể tải ảnh lên.";
            } else {
                $image_url = $target_file;
            }
        } elseif ($image_source === 'url' && !empty($_POST['image_url'])) {
            $image_url = $_POST['image_url'];
        } else {
            $error = "❌ Bạn cần cung cấp ảnh sản phẩm.";
        }
    }

    if (!$error && !$categoryManager->exists($idlsp)) {
        $error = "❌ Loại sản phẩm không hợp lệ!";
    }

    if (!$error) {
        $productManager->add($idlsp, $ten, $mota, $giaban, $idsize, $image_url);
        header("Location: Qlsp.php"); // ✅ redirect ngay sau khi thêm
        exit;
    }

}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<section class="shop spad">
    <div class="container">
        <h2>Thêm sản phẩm</h2>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <?php if (!empty($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Phân loại</label>
                <select name="idlsp" class="form-control" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['IDLOAI']; ?>" <?= $category['IDLOAI'] == $idlsp ? 'selected' : '' ?>>
                            <?= $category['TENLOAI']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" name="ten" class="form-control" required value="<?= htmlspecialchars($ten) ?>">
            </div>

            <div class="form-group">
                <label>Loại Size</label><br>
                <?php foreach ($sizes as $size): ?>
                    <label style="margin-right: 10px;">
                        <input 
                            type="checkbox" 
                            name="idsize[]" 
                            value="<?= $size['IDSIZE']; ?>" 
                            <?= in_array($size['IDSIZE'], $idsize) ? 'checked' : '' ?>
                        >
                        <?= $size['TENSIZE']; ?>
                    </label>
                <?php endforeach; ?>
            </div>

            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="mota" class="form-control" required><?= htmlspecialchars($mota) ?></textarea>
            </div>

            <div class="form-group">
                <label>Giá bán</label>
                <input type="number" name="giaban" class="form-control" required value="<?= htmlspecialchars($giaban) ?>">
            </div>

            <div class="form-group">
                <label>Hình ảnh</label>
                <div>
                    <input type="radio" name="image_source" value="file" checked onchange="toggleImageInput()"> Tải file
                    <input type="radio" name="image_source" value="url" onchange="toggleImageInput()"> Nhập URL
                </div>
                <div id="file-input" style="display: block;">
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                </div>
                <div id="url-input" style="display: none;">
                    <input type="url" name="image_url" id="image_url" class="form-control" placeholder="Nhập URL ảnh" value="<?= htmlspecialchars($image_url) ?>">
                </div>
                <img id="image-preview" style="max-width: 200px; margin-top: 10px; display: none;" />
            </div>

            <button type="submit" class="btn btn-primary">Thêm</button>
            <a href="Qlsp.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</section>

<script>
    function toggleImageInput() {
        const fileInput = document.getElementById('file-input');
        const urlInput = document.getElementById('url-input');
        const imagePreview = document.getElementById('image-preview');
        if (document.querySelector('input[name="image_source"]:checked').value === 'file') {
            fileInput.style.display = 'block';
            urlInput.style.display = 'none';
            imagePreview.src = '';
            imagePreview.style.display = 'none';
        } else {
            fileInput.style.display = 'none';
            urlInput.style.display = 'block';
            const url = document.getElementById('image_url').value;
            if (url) {
                imagePreview.src = url;
                imagePreview.style.display = 'block';
            }
        }
    }

    function previewImage(event) {
        const imagePreview = document.getElementById('image-preview');
        const reader = new FileReader();
        reader.onload = function() {
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }

    document.getElementById('image_url').addEventListener('input', function() {
        const imagePreview = document.getElementById('image-preview');
        imagePreview.src = this.value;
        imagePreview.style.display = this.value ? 'block' : 'none';
    });
</script>
</body>
</html>
