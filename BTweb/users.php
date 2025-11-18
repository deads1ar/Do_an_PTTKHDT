<?php
session_start();

include 'db.php';
include 'UserManager.php';

header('Content-Type: application/json; charset=utf-8');

try {
    $db = new Database();
    $pdo = $db->getConnection();
    $userManager = new UserManager($pdo);

    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'list':
            echo json_encode($userManager->listUsers());
            break;

        case 'add':
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($userManager->addUser($data));
            break;

        case 'edit':
            $data = json_decode(file_get_contents('php://input'), true);
            echo json_encode($userManager->editUser($data));
            break;

        case 'toggle':
            $id = $_GET['id'] ?? 0;
            echo json_encode($userManager->toggleUser($id));
            break;

        default:
            echo json_encode(['message' => 'Hành động không hợp lệ!']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>
