<?php
$title = "Thêm phiếu tiêm chủng";
include 'layouts/header.php';
?>

<?php
include('db.php');

$id = $_GET["id"];
$id = intval($id);

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
                <form action="post-add-phieutiem.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="NgayHenTiem">Ngày hẹn tiêm</label>
                            <input type="date" class="form-control" id="NgayHenTiem" name="NgayHenTiem" value="<?= htmlspecialchars($form_data['NgayHenTiem'] ?? '') ?>">
                            <?php if (isset($errors['NgayHenTiem'])): ?>
                                <div class="alert alert-danger"><?= $errors['NgayHenTiem']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="GioHenTiem">Giờ hẹn tiêm</label>
                            <input type="time" class="form-control" id="GioHenTiem" name="GioHenTiem" value="<?= htmlspecialchars($form_data['GioHenTiem'] ?? '') ?>">
                            <?php if (isset($errors['GioHenTiem'])): ?>
                                <div class="alert alert-danger"><?= $errors['GioHenTiem']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="TinhTrangXacNhan">Tình trạng xác nhận</label>
                            <select class="form-control" id="TinhTrangXacNhan" name="TinhTrangXacNhan" required>
                                <option value="1" <?= ($form_data['TinhTrangXacNhan'] ?? 0) == 1 ? 'selected' : ''; ?>>Đã xác nhận</option>
                                <option value="0" <?= ($form_data['TinhTrangXacNhan'] ?? 0) == 0 ? 'selected' : ''; ?>>Chưa xác nhận</option>             
                            </select>
                            <?php if (isset($errors['TinhTrangXacNhan'])): ?>
                                <div class="alert alert-danger"><?= $errors['TinhTrangXacNhan']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="NgayCheckin">Ngày check-in</label>
                            <input type="date" class="form-control" id="NgayCheckin" name="NgayCheckin" value="<?= htmlspecialchars($form_data['NgayCheckin'] ?? '') ?>">
                            <?php if (isset($errors['NgayCheckin'])): ?>
                                <div class="alert alert-danger"><?= $errors['NgayCheckin']; ?></div>
                            <?php endif; ?>
                        </div>

                        <input type="hidden" name="PhieuKhamSangLocID" value="<?= htmlspecialchars($id ?? '') ?>">
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
