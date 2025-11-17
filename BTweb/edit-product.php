<?php

include 'db.php';
include 'ProductManager.php';

$db = new Database();
$pdo = $db->getConnection();

$productManager = new ProductManager($pdo);

// Nếu là POST thì cập nhật
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_GET['id'];
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

// ✅ Nếu là GET, cần lấy sản phẩm để hiển thị
$id = $_GET['id'] ?? null;
if (!$id) {
    die("❌ Không có ID sản phẩm.");
}
$product = $productManager->getById($id);
if (!$product) {
    die("❌ Sản phẩm không tồn tại.");
}

// Gọi giao diện
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
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
<section class="shop spad">
    <div class="container">
        <h2>Sửa sản phẩm</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Phân loại</label>
                <select name="idlsp" class="form-control" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['IDLOAI']; ?>" <?php if ($category['IDLOAI'] == $product['IDLOAI']) echo 'selected'; ?>><?php echo $category['TENLOAI']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" name="ten" class="form-control" value="<?php echo htmlspecialchars($product['TEN']); ?>" required>
            </div>
            <div class="form-group">
                <label>Loại Size</label>
                <select name="idsize" class="form-control" required>
                    <?php foreach ($sizes as $size): ?>
                        <option value="<?= $size['IDSIZE']; ?>" <?php if ($size['IDSIZE'] == $product['IDSIZE']) echo 'selected'; ?>>
                            <?= $size['TENSIZE']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <label>Loại Size</label><br>
                    <?php foreach ($sizes as $size): ?>
                        <label style="margin-right: 10px;">
                            <input 
                                type="checkbox" 
                                name="idsize[]" 
                                value="<?= $size['IDSIZE']; ?>" 
                                <?php if (($size['IDSIZE'] == )) echo 'checked'; ?>
                            >
                            <?= $size['TENSIZE']; ?>
                        </label>
                    <?php endforeach; ?>
            </div>
            <div class="form-group">
                <label>Mô tả</label>
                <textarea name="mota" class="form-control" required><?php echo htmlspecialchars($product['MOTA']); ?></textarea>
            </div>
            <div class="form-group">
                <label>Giá bán</label>
                <input type="number" name="giaban" class="form-control" value="<?php echo $product['GIA']; ?>" required>
            </div>
            <div class="form-group">
                <label>Hình ảnh hiện tại</label>
                <img src="<?php echo htmlspecialchars($product['URL']); ?>" style="max-width: 200px; height: auto; object-fit: contain;" />
                <label>Thay đổi hình ảnh</label>
                <div>
                    <input type="radio" name="image_source" value="file" checked onchange="toggleImageInput()"> Tải file
                    <input type="radio" name="image_source" value="url" onchange="toggleImageInput()"> Nhập URL
                </div>
                <div id="file-input" style="display: block;">
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" onchange="previewImage(event)">
                </div>
                <div id="url-input" style="display: none;">
                    <input type="url" name="image_url" id="image_url" class="form-control" placeholder="Nhập URL ảnh">
                </div>
                <img id="image-preview" style="max-width: 200px; margin-top: 10px; display: none;" />
            </div>
            <button type="submit" class="btn btn-primary">Lưu</button>
            <a href="Qlsp.php" class="btn btn-secondary">Hủy</a>
        </form>
    </div>
</section>

<script src="js/jquery-3.3.1.min.js"></script>
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