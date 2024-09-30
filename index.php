<?php
$title = "Trang chủ";
include 'layouts/header.php';
?>

<?php

require 'db.php';

$name = isset($_GET['name']) ? $_GET['name'] : null;
$vaccine = isset($_GET['vaccine']) ? $_GET['vaccine'] : null;
$price = isset($_GET['price']) ? $_GET['price'] : null;

$conditions = [];
if (!empty($name)) {
    $conditions[] = "name LIKE '%" . mysqli_real_escape_string($conn, $name) . "%'";
}
if (!empty($vaccine)) {
    $conditions[] = "vaccine LIKE '%" . mysqli_real_escape_string($conn, $vaccine) . "%'";
}
if (!empty($price)) {
    switch ($price) {
        case 1:
            $conditions[] = "price BETWEEN 0 AND 500000";
            break;
        case 2:
            $conditions[] = "price BETWEEN 500000 AND 1000000";
            break;
        case 3:
            $conditions[] = "price BETWEEN 1000000 AND 1500000";
            break;
        case 4:
            $conditions[] = "price BETWEEN 1500000 AND 2000000";
            break;
        case 5:
            $conditions[] = "price > 2000000";
            break;
    }
}

$sql = "SELECT * FROM vaccinations WHERE `delete` = 0";
if (count($conditions) > 0) {
    $sql .= " AND " . implode(' AND ', $conditions);
}

$stmt = $conn->prepare($sql);

$stmt->execute();
$result = $stmt->get_result();

$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Danh sách dịch vụ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dịch vụ</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="get">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="name">Tìm theo bệnh</label>
                                            <input name="name" type="text" class="form-control" id="name" value="<?= htmlspecialchars($name ?? '') ?>" placeholder="Search" autocomplete="none">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="vaccine">Tìm theo vắc xin</label>
                                            <input name="vaccine" type="text" class="form-control" id="vaccine" value="<?= htmlspecialchars($vaccine ?? '') ?>" placeholder="Search" autocomplete="none">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="price">Giá</label>
                                            <select class="form-control" name="price">
                                                <option value="">-- Lựa chọn giá --</option>
                                                <option value="1" <?= ($price ?? 0) == 1 ? 'selected' : ''; ?>>0 - 500.000</option>
                                                <option value="2" <?= ($price ?? 0) == 2 ? 'selected' : ''; ?>>500.000 - 1.000.000 </option>
                                                <option value="3" <?= ($price ?? 0) == 3 ? 'selected' : ''; ?>>1.000.000 - 1.500.000</option>
                                                <option value="4" <?= ($price ?? 0) == 4 ? 'selected' : ''; ?>>1.500.000 - 2.000.000</option>
                                                <option value="5" <?= ($price ?? 0) == 5 ? 'selected' : ''; ?>> > 2.000.000 </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary float-right">Filter</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tiêm chủng</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Phòng bệnh</th>
                            <th>Tên vắc xin</th>
                            <th>Quốc gia</th>
                            <th>Giá bán lẻ(VND)</th>
                            <th>Kho</th>
                            <th>Tình trạng</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rows as $row): ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td class="break-word" ><?= $row['name']; ?></td>
                                <td><?= $row['vaccine']; ?></td>
                                <td><?= $row['country']; ?></td>
                                <td><?= $row['price']; ?></td>
                                <td><?= $row['quantity']; ?></td>
                                <td><?= $row['status'] ? 'Active' : 'Inactive'; ?></td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-warning btn-sm" href="edit-service.php?id=<?= $row['id']; ?>">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>

                                    <form action="delete-service.php" method="POST" style="display: inline-block;">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id'] ?? '') ?>">
                                        <button type="submit" class="btn btn-danger btn-sm delete-button">
                                            <i class="fas fa-trash">
                                            </i>
                                        </button>
                                    </form>
                                   

                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->


<?php include 'layouts/footer.php'; ?>

