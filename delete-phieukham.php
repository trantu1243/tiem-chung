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

    $sql = "UPDATE phieukhamsangloc SET `delete` = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if($stmt->execute()){
        $_SESSION['alert'] = 'Dữ liệu đã được xóa thành công!';
        header("Location: phieukham.php");
        exit;
    }

    $_SESSION['alert'] = 'Error'; 
    header("Location: phieukham.php");
    exit;
}
?>