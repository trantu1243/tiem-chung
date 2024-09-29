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

    $sql = "UPDATE vaccinations SET `delete` = 1 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if($stmt->execute()){
        $_SESSION['alert'] = 'Dữ liệu đã được xóa thành công!';
        header("Location: index.php");
        exit;
    }

    $_SESSION['alert'] = 'Error'; 
    header("Location: index.php");
    exit;
}
?>