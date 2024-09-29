<?php
$title = "Thêm phiếu khám";
include 'layouts/header.php';
?>

<?php
include('db.php');

$sql = "SELECT id, name FROM vaccinations WHERE `delete` = 0";
$result = $conn->query($sql);

$services = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
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
                <form action="post-add-phieukham.php" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="HoVaTen">Họ và tên</label>
                                    <input type="text" class="form-control" id="HoVaTen" name="HoVaTen" value="<?= htmlspecialchars($form_data['HoVaTen'] ?? '') ?>" required>
                                    <?php if (isset($errors['HoVaTen'])): ?>
                                        <div class="alert alert-danger"><?= $errors['HoVaTen']; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="NgaySinh">Ngày sinh</label>
                                    <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" value="<?= htmlspecialchars($form_data['NgaySinh'] ?? '') ?>">
                                    <?php if (isset($errors['NgaySinh'])): ?>
                                        <div class="alert alert-danger"><?= $errors['NgaySinh']; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="CMTCCCD">CMT/CCCD</label>
                                    <input type="text" class="form-control" id="CMTCCCD" name="CMTCCCD" value="<?= htmlspecialchars($form_data['CMTCCCD'] ?? '') ?>">
                                    <?php if (isset($errors['CMTCCCD'])): ?>
                                        <div class="alert alert-danger"><?= $errors['CMTCCCD']; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="GioiTinh">Giới tính</label>
                                    <select class="form-control" id="GioiTinh" name="GioiTinh">
                                        <option value="0" <?= ($form_data['GioiTinh'] ?? '') == 0 ? 'selected' : ''; ?>>Nam</option>
                                        <option value="1" <?= ($form_data['GioiTinh'] ?? '') == 1 ? 'selected' : ''; ?>>Nữ</option>
                                    </select>
                                    <?php if (isset($errors['GioiTinh'])): ?>
                                        <div class="alert alert-danger"><?= $errors['GioiTinh']; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="SoDienThoai">Số điện thoại</label>
                                    <input type="text" class="form-control" id="SoDienThoai" name="SoDienThoai" value="<?= htmlspecialchars($form_data['SoDienThoai'] ?? '') ?>">
                                    <?php if (isset($errors['SoDienThoai'])): ?>
                                        <div class="alert alert-danger"><?= $errors['SoDienThoai']; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="Email">Email</label>
                                    <input type="email" class="form-control" id="Email" name="Email" value="<?= htmlspecialchars($form_data['Email'] ?? '') ?>">
                                    <?php if (isset($errors['Email'])): ?>
                                        <div class="alert alert-danger"><?= $errors['Email']; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="SoTheBHYT">Số thẻ BHYT</label>
                            <input type="text" class="form-control" id="SoTheBHYT" name="SoTheBHYT" value="<?= htmlspecialchars($form_data['SoTheBHYT'] ?? '') ?>" required>
                            <?php if (isset($errors['SoTheBHYT'])): ?>
                                <div class="alert alert-danger"><?= $errors['SoTheBHYT']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="DiaChiNoiO">Địa chỉ nơi ở</label>
                            <input type="text" class="form-control" id="DiaChiNoiO" name="DiaChiNoiO" value="<?= htmlspecialchars($form_data['DiaChiNoiO'] ?? '') ?>" required>
                            <?php if (isset($errors['DiaChiNoiO'])): ?>
                                <div class="alert alert-danger"><?= $errors['DiaChiNoiO']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="GhiChu">Ghi chú</label>
                            <textarea class="form-control" id="GhiChu" name="GhiChu"><?= htmlspecialchars($form_data['GhiChu'] ?? '') ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="serviceId">Chọn dịch vụ</label>
                            <select class="form-control" id="serviceId" name="serviceId" required>
                                <option value="">-- Chọn dịch vụ --</option>
                                <?php foreach ($services as $service): ?>
                                    <option value="<?= $service['id']; ?>" <?= ($form_data['serviceId'] ?? '') == $service['id'] ? 'selected' : ''; ?>><?= htmlspecialchars($service['name']); ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($errors['serviceId'])): ?>
                                <div class="alert alert-danger"><?= $errors['serviceId']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="file">Tệp đính kèm</label>
                            <input type="file" class="form-control" id="file" name="file" required>
                            <?php if (isset($errors['file'])): ?>
                                <div class="alert alert-danger"><?= $errors['file']; ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="KetLuan">Kết luận</label>
                            <select class="form-control" id="KetLuan" name="KetLuan" required>
                                <option value="1" <?= ($form_data['KetLuan'] ?? '') == 1 ? 'selected' : ''; ?>>Chấp nhận</option>
                                <option value="0" <?= ($form_data['KetLuan'] ?? '') == 0 ? 'selected' : ''; ?>>Không chấp nhận</option>
                            </select>
                            <?php if (isset($errors['KetLuan'])): ?>
                                <div class="alert alert-danger"><?= $errors['KetLuan']; ?></div>
                            <?php endif; ?>
                        </div>
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
