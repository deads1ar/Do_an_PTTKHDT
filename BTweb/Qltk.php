<?php
session_start();

include 'db.php';
include 'headerad.php';

$db = new Database();
$pdo = $db->getConnection();
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <style>
        .table { width: 100%; text-align: center; table-layout: fixed; }
        .table th, .table td { vertical-align: middle; border: 2px solid black; }
        .table th { font-weight: bold; }
        .add-product { font-size: 1.2em; padding: 10px 20px; border: none; background-color: #119206; color: #fff; cursor: pointer; border-radius: 5px; transition: background-color 0.3s; }
        .add-product:hover { background-color: #ff6347; }
        .btn-lock { background-color: #dc3545; color: white; }
        .btn-unlock { background-color: #28a745; color: white; }
        .modal { display: none; position: fixed; z-index: 1; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4); }
        .modal-content { background-color: #fefefe; margin: 15% auto; padding: 20px; border: 1px solid #888; width: 50%; }
        .close { color: #aaa; float: right; font-size: 28px; font-weight: bold; }
        .close:hover, .close:focus { color: black; text-decoration: none; cursor: pointer; }
    </style>
</head>
<body>
    <main class="dashboard-content">
        <div class="container-fluid">
            <div class="row mt-5" >
                <div class="col-lg-12">
                    <h2 class="text-center mb-4">Danh Sách Tài Khoản</h2>
                </div>
            </div>
            <div style="text-align: center;">
                <button class="add-product" onclick="openAddModal()">Thêm tài khoản</button>
            </div>
            <div class="row" style="border: 2px solid white; padding: 17px;">
                <div class="col-lg-12">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>SĐT</th>
                                <th>Mật khẩu</th>

                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="user-table"></tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </main>

    <!-- Modal Thêm -->
    <div id="addModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeAddModal()">×</span>
            <h2>Thêm Tài Khoản</h2>
            <form id="addUserForm" onsubmit="addUser(event)">
                <label>Tên:</label><input type="text" id="add-name" required><br><br>
                <label>SĐT:</label><input type="text" id="add-phone" required><br><br>
                <label>Mật khẩu:</label><input type="password" id="add-password"><br><br>
                <label>Địa chỉ:</label><input type="text" id="add-diachi" required><br><br>
                <button type="submit" class="add-product">Đăng ký</button>
            </form>
        </div>
    </div>

    <!-- Modal Sửa -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">×</span>
            <h2>Sửa Tài Khoản</h2>
            <form id="editUserForm" onsubmit="saveEdit(event)">
                <input type="hidden" id="edit-id">
                <label>Tên:</label><input type="text" id="edit-name" required><br><br>
                <label>SĐT:</label><input type="text" id="edit-phone" required><br><br>
                <label>Mật khẩu:</label><input type="password" id="edit-password" ><br><br>
                <label>Địa chỉ:</label><input type="text" id="edit-diachi" required><br><br>
                <button type="submit" class="add-product">Lưu</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; ?>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script>
        // Lấy danh sách users
        function loadUsers() {
            $.get("users.php?action=list", function(data) {
                renderTable(data);
            }, "json");
        }

        // Hiển thị bảng
        function renderTable(users) {
            const tableBody = $("#user-table");
            tableBody.empty();
            users.forEach((user, index) => {
                tableBody.append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${user.TEN}</td>
                        <td>${user.SDT}</td>
                       <td>************</td>
                        <td>${user.DIACHI}</td>
                        <td>${user.TRANGTHAI == '1' ? 'hoạt động' : 'đang khóa'}</td>
                        <td>
                            <button class="btn btn-primary btn-sm" onclick="openEditModal('${user.IDKH}')">Sửa</button>
                            <button class="btn ${user.TRANGTHAI == 1 ? 'btn-lock' : 'btn-unlock'} btn-sm" 
                                    onclick="toggleLock('${user.IDKH}')">${user.TRANGTHAI == 1 ? 'Khóa' : 'Mở'}</button>
                        </td>
                    </tr>
                `);
            });
        }

        // Thêm user
        function openAddModal() { $("#addModal").show(); }
        function closeAddModal() { $("#addModal").hide(); }
        function addUser(event) {
            event.preventDefault();
            const user = {
                name: $("#add-name").val(),
                phone: $("#add-phone").val(),
                password: $("#add-password").val(),
                diachi: $("#add-diachi").val()
            };
            $.ajax({
                url: "users.php?action=add",
                type: "POST",
                data: JSON.stringify(user),
                contentType: "application/json",
                success: function(response) {
                    alert(response.message);
                    loadUsers();
                    closeAddModal();
                },
                error: function(xhr, status, error) {
                    alert("Lỗi khi thêm tài khoản: " + xhr.responseText);
                }
            });
        }

        // Sửa user
        function openEditModal(id) {
            $.get("users.php?action=list", function(data) {
                const user = data.find(u => u.IDKH == id);
                $("#edit-id").val(user.IDKH);
                $("#edit-name").val(user.TEN);
                $("#edit-phone").val(user.SDT);
                $("#edit-password").val();
                $("#edit-diachi").val(user.DIACHI);
                $("#editModal").show();
            }, "json");
        }
        function closeEditModal() { $("#editModal").hide(); }
        function saveEdit(event) {
            event.preventDefault();
            const user = {
                id: $("#edit-id").val(),
                name: $("#edit-name").val(),
                phone: $("#edit-phone").val(),
                password: $("#edit-password").val(),
                diachi: $("#edit-diachi").val()
            };
            $.ajax({
                url: "users.php?action=edit",
                type: "POST",
                data: JSON.stringify(user),
                contentType: "application/json",
                success: function(response) {
                    alert(response.message);
                    loadUsers();
                    closeEditModal();
                },
                error: function(xhr, status, error) {
                    alert("Lỗi khi sửa tài khoản: " + xhr.responseText);
                }
            });
        }

        // Khóa/Mở user
        function toggleLock(id) {
            $.get("users.php?action=toggle&id=" + id, function(response) {
                alert(response.message);
                loadUsers();
            }, "json").fail(function(xhr, status, error) {
                alert("Lỗi khi cập nhật trạng thái: " + xhr.responseText);
            });
        }

        // Load ban đầu
        loadUsers();
    </script>
</body>
</html>