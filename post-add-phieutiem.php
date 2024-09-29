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
    $PhieuKhamSangLocID = $_POST['PhieuKhamSangLocID'] ?? null;
    $NgayHenTiem = $_POST['NgayHenTiem'] ?? null;
    $GioHenTiem = $_POST['GioHenTiem'] ?? null;
    $TinhTrangXacNhan = $_POST['TinhTrangXacNhan'] ?? 0;
    $NgayCheckin = $_POST['NgayCheckin'] ?? null;

    $errors = [];

    if (empty($PhieuKhamSangLocID)) {
        $errors['PhieuKhamSangLocID'] = "Chọn phiếu khám sàng lọc.";
    }

    if (empty($NgayHenTiem)) {
        $errors['NgayHenTiem'] = "Ngày hẹn tiêm không được để trống.";
    }

    if (empty($GioHenTiem)) {
        $errors['GioHenTiem'] = "Giờ hẹn tiêm không được để trống.";
    }


    if (empty($NgayCheckin)) {
        $errors['NgayCheckin'] = "Ngày check-in không được để trống.";
    }


    if (empty($errors)) { 

       
        $stmt = $conn->prepare("INSERT INTO phieutiemchung (PhieuKhamSangLocID, NgayHenTiem, GioHenTiem, TinhTrangXacNhan, NgayCheckin) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issis", $PhieuKhamSangLocID, $NgayHenTiem, $GioHenTiem, $TinhTrangXacNhan, $NgayCheckin);
        if($stmt->execute()){
            $_SESSION['alert'] = 'Dữ liệu đã được thêm thành công!';
            header("Location: phieutiem.php");
            exit;
        }
    } else {
        $_SESSION['errors'] = $errors; 
        $_SESSION['form_data'] = $_POST; 
        header("Location: add-phieutiem.php?id=" . $PhieuKhamSangLocID); 
        exit;
    }

    $_SESSION['alert'] = 'Error';     
    header("Location: add-phieutiem.php?id=" . $PhieuKhamSangLocID);
    exit;
}
?>