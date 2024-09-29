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
    $PhieuTiemChungID = $_POST['PhieuTiemChungID'] ?? null;
    $NgayThanhToan = $_POST['NgayThanhToan'] ?? null;
    $price = $_POST['price'] ?? 0;
    $XacNhan = $_POST['XacNhan'] ?? 0;

    $errors = [];

    if (empty($PhieuTiemChungID)) {
        $errors['PhieuTiemChungID'] = "Chọn phiếu tiêm chủng.";
    }

    if (empty($NgayThanhToan)) {
        $errors['NgayThanhToan'] = "Ngày thanh toán không được để trống.";
    }

    if (!is_numeric($price) || $price < 0) {
        $errors['price'] = "Giá phải là số dương.";
    }


    if (empty($errors)) { 
        $stmt = $conn->prepare("INSERT INTO hoadontiemchung (PhieuTiemChungID, NgayThanhToan, price, XacNhan) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isii", $PhieuTiemChungID, $NgayThanhToan, $price, $XacNhan);
        if($stmt->execute()){
            $_SESSION['alert'] = 'Dữ liệu đã được thêm thành công!';
            header("Location: hoadon.php");
            exit;
        }
    } else {
        $_SESSION['errors'] = $errors; 
        $_SESSION['form_data'] = $_POST; 
        header("Location: add-hoadon.php?id=" . $PhieuTiemChungID); 
        exit;
    }

    $_SESSION['alert'] = 'Error';     
    header("Location: add-hoadon.php?id=" . $PhieuTiemChungID);
    exit;
}
?>