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
    $NgayHenTiem = $_POST['NgayHenTiem'] ?? null;
    $GioHenTiem = $_POST['GioHenTiem'] ?? null;
    $TinhTrangXacNhan = $_POST['TinhTrangXacNhan'] ?? 0;
    $NgayCheckin = $_POST['NgayCheckin'] ?? null;

    $errors = [];

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
        $stmt = $conn->prepare("UPDATE phieutiemchung SET NgayHenTiem = ?, GioHenTiem = ?, TinhTrangXacNhan = ?, NgayCheckin = ? WHERE id = ?");
        $stmt->bind_param("ssisi", $NgayHenTiem, $GioHenTiem, $TinhTrangXacNhan, $NgayCheckin, $id);
        if($stmt->execute()){
            $_SESSION['alert'] = 'Dữ liệu đã được sửa thành công!';
            header("Location: edit-phieutiem.php?id=" . $id);
            exit;
        }
    } else {
        $_SESSION['errors'] = $errors; 
        $_SESSION['form_data'] = $_POST; 
        header("Location: edit-phieutiem.php.php?id=" . $id); 
        exit;
    }

    $_SESSION['alert'] = 'Error';     
    header("Location: edit-phieutiem.php.php?id=" . $id);
    exit;
}
?>