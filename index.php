<?php
$title = "Trang chủ";
include 'layouts/header.php';
?>

<?php

require 'db.php';

$stmt = $conn->prepare("SELECT * FROM vaccinations WHERE `delete` = 0");
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

