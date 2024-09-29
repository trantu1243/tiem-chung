<?php
$title = "Thêm hóa đơn";
include 'layouts/header.php';
?>

<?php
include('db.php');

$id = $_GET["id"];
$id = intval($id);

$sql = "
    SELECT 
        v.price
    FROM phieutiemchung pt
    JOIN phieukhamsangloc p ON p.id = pt.PhieuKhamSangLocID
    JOIN vaccinations v ON p.serviceId = v.id
    WHERE pt.id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $hoadon = $result->fetch_assoc();
}

$errors = $_SESSION['errors'] ?? [];
$form_data = $_SESSION['form_data'] ?? [];

unset($_SESSION['errors']);
unset($_SESSION['form_data']);
?>

<?php
echo isset($_SESSION['alert']);
if (isset($_SESSION['alert'])) {
    echo "<script>alert('" . $_SESSION['alert'] . "');</script>";
    unset($_SESSION['alert']);
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Thêm</h3>
                </div>
                <form action="post-add-hoadon.php" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="NgayThanhToan">Ngày thanh toán</label>
                            <input type="date" class="form-control" id="NgayThanhToan" name="NgayThanhToan" value="<?= htmlspecialchars($form_data['NgayThanhToan'] ?? '') ?>">
                            <?php if (isset($errors['NgayThanhToan'])): ?>
                                <div class="alert alert-danger"><?= $errors['NgayThanhToan']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="price">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($hoadon['price'] ?? '') ?>">
                            <?php if (isset($errors['price'])): ?>
                                <div class="alert alert-danger"><?= $errors['price']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="XacNhan">Tình trạng xác nhận</label>
                            <select class="form-control" id="XacNhan" name="XacNhan" required>
                                <option value="1">Đã xác nhận</option>
                                <option value="0">>Chưa xác nhận</option>
                            </select>
                            <?php if (isset($errors['XacNhan'])): ?>
                                <div class="alert alert-danger"><?= $errors['XacNhan']; ?></div>
                            <?php endif; ?>
                        </div>

                        <input type="hidden" name="PhieuTiemChungID" value="<?= htmlspecialchars($id ?? '') ?>">
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
