<?php
$title = "Sửa dịch vụ";
include 'layouts/header.php';
?>

<?php
require 'db.php';

$id = $_GET["id"];
$id = intval($id);

$stmt = $conn->prepare("SELECT * FROM vaccinations WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $service = $result->fetch_assoc();
}
?>

<?php
$errors = $_SESSION['errors'] ?? [];

unset($_SESSION['errors']);
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
                    <h3 class="card-title">Sửa</h3>
                </div>
                <form action="post-edit-service.php" method="POST">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Tên</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($service['name'] ?? '') ?>" required>
                            <?php if (isset($errors['name'])): ?>
                                <div class="alert alert-danger"><?= $errors['name']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="vaccine">Vaccine</label>
                            <input type="text" class="form-control" id="vaccine" name="vaccine" value="<?= htmlspecialchars($service['vaccine'] ?? '') ?>" required>
                            <?php if (isset($errors['vaccine'])): ?>
                                <div class="alert alert-danger"><?= $errors['vaccine']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="country">Quốc gia</label>
                            <input type="text" class="form-control" id="country" name="country" value="<?= htmlspecialchars($service['country'] ?? '') ?>" required>
                            <?php if (isset($errors['country'])): ?>
                                <div class="alert alert-danger"><?= $errors['country']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="price">Giá</label>
                            <input type="number" class="form-control" id="price" name="price" value="<?= htmlspecialchars($service['price'] ?? '') ?>">
                            <?php if (isset($errors['price'])): ?>
                                <div class="alert alert-danger"><?= $errors['price']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="quantity">Số lượng</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" value="<?= htmlspecialchars($service['quantity'] ?? '') ?>">
                            <?php if (isset($errors['quantity'])): ?>
                                <div class="alert alert-danger"><?= $errors['quantity']; ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" <?= (isset($service['status']) && $service['status'] == 1) ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?= (isset($service['status']) && $service['status'] == 0) ? 'selected' : '' ?>>Inactive</option>
                            </select>
                            <?php if (isset($errors['status'])): ?>
                                <div class="alert alert-danger"><?= $errors['status']; ?></div>
                            <?php endif; ?>
                        </div>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($service['id'] ?? '') ?>">
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'layouts/footer.php'; ?>
