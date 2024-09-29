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
    $form_data['serviceId'] = $_POST['serviceId'] ?? '';
    $form_data['HoVaTen'] = $_POST['HoVaTen'] ?? '';
    $form_data['NgaySinh'] = $_POST['NgaySinh'] ?? '';
    $form_data['GioiTinh'] = $_POST['GioiTinh'] ?? 0;
    $form_data['CMTCCCD'] = $_POST['CMTCCCD'] ?? '';
    $form_data['SoDienThoai'] = $_POST['SoDienThoai'] ?? '';
    $form_data['Email'] = $_POST['Email'] ?? '';
    $form_data['SoTheBHYT'] = $_POST['SoTheBHYT'] ?? '';
    $form_data['DiaChiNoiO'] = $_POST['DiaChiNoiO'] ?? '';
    $form_data['GhiChu'] = $_POST['GhiChu'] ?? '';
    $form_data['KetLuan'] = $_POST['KetLuan'] ?? 0;

    $errors = [];

    if (empty($form_data['serviceId'])) {
        $errors['serviceId'] = "Dịch vụ không được để trống.";
    }

    if (empty($form_data['HoVaTen'])) {
        $errors['HoVaTen'] = "Họ và tên không được để trống.";
    }

    if (empty($form_data['NgaySinh'])) {
        $errors['NgaySinh'] = "Ngày sinh không được để trống.";
    }

    if (empty($form_data['CMTCCCD'])) {
        $errors['CMTCCCD'] = "CMT/CCCD không được để trống.";
    }

    if (empty($form_data['SoDienThoai'])) {
        $errors['SoDienThoai'] = "Số điện thoại không được để trống.";
    } elseif (!preg_match("/^(\+84|0)[0-9]{9}$/", $form_data['SoDienThoai'])) { 
        $errors['SoDienThoai'] = "Số điện thoại không đúng định dạng.";
    }

    if (empty($form_data['Email'])) {
        $errors['Email'] = "Email không được để trống.";
    } elseif (!filter_var($form_data['Email'], FILTER_VALIDATE_EMAIL)) {
        $errors['Email'] = "Email không đúng định dạng.";
    }

    if (empty($form_data['SoTheBHYT'])) {
        $errors['SoTheBHYT'] = "Số thẻ BHYT không được để trống.";
    } elseif (!preg_match("/^[A-Z0-9]{10,15}$/", $form_data['SoTheBHYT'])) {
        $errors['SoTheBHYT'] = "Số thẻ BHYT không đúng định dạng.";
    }

    if (empty($form_data['DiaChiNoiO'])) {
        $errors['DiaChiNoiO'] = "Địa chỉ nơi ở không được để trống.";
    }

    if (!isset($form_data['KetLuan'])) {
        $errors['KetLuan'] = "Kết luận không được để trống.";
    }

    if (empty($_FILES['file']['name'])) {
        $errors['file'] = "Tệp đính kèm không được để trống.";
    } elseif ($_FILES['file']['size'] > 2 * 1024 * 1024) {
        $errors['file'] = "Tệp đính kèm không được vượt quá 2MB.";
    }

    if (empty($errors)) { 

        $file_name = time() . '_' . uniqid() . '_' . $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        $file_path = "uploads/" . $file_name;

        move_uploaded_file($file_tmp, $file_path);

        $stmt = $conn->prepare("INSERT INTO phieukhamsangloc (serviceId, HoVaTen, NgaySinh, GioiTinh, CMTCCCD, SoDienThoai, Email, SoTheBHYT, DiaChiNoiO, GhiChu, file, KetLuan) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "ississsssssi",
            $form_data['serviceId'],
            $form_data['HoVaTen'],
            $form_data['NgaySinh'],
            $form_data['GioiTinh'],
            $form_data['CMTCCCD'],
            $form_data['SoDienThoai'],
            $form_data['Email'],
            $form_data['SoTheBHYT'],
            $form_data['DiaChiNoiO'],
            $form_data['GhiChu'],
            $file_name,
            $form_data['KetLuan']
        );
        if($stmt->execute()){
            $_SESSION['alert'] = 'Dữ liệu đã được thêm thành công!';
            header("Location: phieukham.php");
            exit;
        }
    } else {
        $_SESSION['errors'] = $errors; 
        $_SESSION['form_data'] = $_POST; 
        header("Location: add-phieukham.php"); 
        exit;
    }

    $_SESSION['alert'] = 'Error';     
    header("Location: add-phieukham.php");
    exit;
}
?>