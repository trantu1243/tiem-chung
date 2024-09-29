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
    $serviceId = $_POST['serviceId'] ?? '';
    $HoVaTen = $_POST['HoVaTen'] ?? '';
    $NgaySinh = $_POST['NgaySinh'] ?? '';
    $GioiTinh = $_POST['GioiTinh'] ?? 0;
    $CMTCCCD = $_POST['CMTCCCD'] ?? '';
    $SoDienThoai = $_POST['SoDienThoai'] ?? '';
    $Email = $_POST['Email'] ?? '';
    $SoTheBHYT = $_POST['SoTheBHYT'] ?? '';
    $DiaChiNoiO = $_POST['DiaChiNoiO'] ?? '';
    $GhiChu = $_POST['GhiChu'] ?? '';
    $KetLuan = $_POST['KetLuan'] ?? 0;

    $errors = [];

    if (empty($serviceId)) {
        $errors['serviceId'] = "Dịch vụ không được để trống.";
    }

    if (empty($HoVaTen)) {
        $errors['HoVaTen'] = "Họ và tên không được để trống.";
    }

    if (empty($NgaySinh)) {
        $errors['NgaySinh'] = "Ngày sinh không được để trống.";
    }

    if (empty($CMTCCCD)) {
        $errors['CMTCCCD'] = "CMT/CCCD không được để trống.";
    }

    if (empty($SoDienThoai)) {
        $errors['SoDienThoai'] = "Số điện thoại không được để trống.";
    } elseif (!preg_match("/^(\+84|0)[0-9]{9}$/", $SoDienThoai)) { 
        $errors['SoDienThoai'] = "Số điện thoại không đúng định dạng.";
    }

    if (empty($Email)) {
        $errors['Email'] = "Email không được để trống.";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $errors['Email'] = "Email không đúng định dạng.";
    }

    if (empty($SoTheBHYT)) {
        $errors['SoTheBHYT'] = "Số thẻ BHYT không được để trống.";
    } elseif (!preg_match("/^[A-Z0-9]{10,15}$/", $SoTheBHYT)) {
        $errors['SoTheBHYT'] = "Số thẻ BHYT không đúng định dạng.";
    }

    if (empty($DiaChiNoiO)) {
        $errors['DiaChiNoiO'] = "Địa chỉ nơi ở không được để trống.";
    }

    if (!isset($KetLuan)) {
        $errors['KetLuan'] = "Kết luận không được để trống.";
    }

    if (empty($errors)) { 

        $file_name = $_FILES['file']['name'];
        if ($file_name) {
            $unique_file_name = time() . '_' . uniqid() . '_' . $file_name;
            $target_directory = 'uploads/';
            $target_file = $target_directory . $unique_file_name;

            move_uploaded_file($_FILES['file']['tmp_name'], $target_file);
        } else {
            $stmt = $conn->prepare("SELECT file FROM phieukhamsangloc WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $old_file = $result->fetch_assoc();
            $unique_file_name = $old_file['file'];
        }

        move_uploaded_file($file_tmp, $file_path);

        $stmt = $conn->prepare("UPDATE phieukhamsangloc SET serviceId = ?, HoVaTen = ?, NgaySinh = ?, GioiTinh = ?, CMTCCCD = ?, SoDienThoai = ?, Email = ?, SoTheBHYT = ?, DiaChiNoiO = ?, GhiChu = ?, file = ?, KetLuan = ? WHERE id = ?");
        $stmt->bind_param("ississssssssi", $serviceId, $HoVaTen, $NgaySinh, $GioiTinh, $CMTCCCD, $SoDienThoai, $Email, $SoTheBHYT, $DiaChiNoiO, $GhiChu, $unique_file_name, $KetLuan, $id);
        if($stmt->execute()){
            $_SESSION['alert'] = 'Dữ liệu đã được sửa thành công!';
            header("Location: edit-phieukham.php?id=" . $id);
            exit;
        }
    } else {
        $_SESSION['errors'] = $errors; 
        header("Location: edit-phieukham.php?id=" . $id); 
        exit;
    }

    $_SESSION['alert'] = 'Error'; 
    header("Location: edit-phieukham.php?id=" . $id);
    exit;
}
?>