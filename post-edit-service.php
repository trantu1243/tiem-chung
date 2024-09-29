<?php

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

?>

<?php
require 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $id = intval($id);
    $name = $_POST['name'] ?? '';
    $vaccine = $_POST['vaccine'] ?? '';
    $country = $_POST['country'] ?? '';
    $price = $_POST['price'] ?? null;
    $quantity = $_POST['quantity'] ?? null;
    $status = $_POST['status'] ?? 1;

    $errors = [];

    if (empty($name)) {
        $errors['name'] = "Tên không được để trống.";
    }
    if (empty($vaccine)) {
        $errors['vaccine'] = "Tên vaccine không được để trống.";
    }
    if (empty($country)) {
        $errors['country'] = "Quốc gia không được để trống.";
    }
    if (!is_numeric($price) || $price < 0) {
        $errors['price'] = "Giá phải là số dương.";
    }
    if (!is_numeric($quantity) || $quantity < 0) {
        $errors['quantity'] = "Số lượng phải là số dương.";
    }
    if (!in_array($status, [0, 1])) {
        $errors['status'] = "Trạng thái không hợp lệ.";
    }

    if (empty($errors)) { 

        $sql = "UPDATE vaccinations SET name = ?, vaccine = ?, country = ?, price = ?, quantity = ?, status = ? WHERE id = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sssiiii", $name, $vaccine, $country, $price, $quantity, $status, $id);
        if($stmt->execute()){
            $_SESSION['alert'] = 'Dữ liệu đã được sửa thành công!';
            header("Location: edit-service.php?id=" . $id);
            exit;
        }
    } else {
        $_SESSION['errors'] = $errors; 
        header("Location: edit-service.php?id=" . $id); 
        exit;
    }

    $_SESSION['alert'] = 'Error'; 
    header("Location: edit-service.php?id=" . $id);
    exit;
}
?>