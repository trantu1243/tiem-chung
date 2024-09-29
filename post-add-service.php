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

        $sql = "INSERT INTO vaccinations (name, vaccine, country, price, quantity, status) 
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("sssiii", $name, $vaccine, $country, $price, $quantity, $status);
        if($stmt->execute()){
            $_SESSION['alert'] = 'Dữ liệu đã được thêm thành công!';
            header("Location: index.php");
            exit;
        }
    } else {
        $_SESSION['errors'] = $errors; 
        $_SESSION['form_data'] = $_POST; 
        header("Location: add-service.php"); 
        exit;
    }

    $_SESSION['alert'] = 'Error'; 
    header("Location: add-service.php");
    exit;
}
?>