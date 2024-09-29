<?php
$title = "Danh sách hóa đơn";
include 'layouts/header.php';
?>

<?php

require 'db.php';

$sql = "
    SELECT 
        hh.id,
        p.HoVaTen,
        p.CMTCCCD,
        v.vaccine,
        hh.NgayThanhToan,
        hh.price,
        hh.XacNhan
    FROM hoadontiemchung hh
    JOIN phieutiemchung pt ON pt.id = hh.PhieuTiemChungID
    JOIN phieukhamsangloc p ON p.id = pt.PhieuKhamSangLocID
    JOIN vaccinations v ON p.serviceId = v.id
";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$rows = array();
while ($row = $result->fetch_assoc()) {
    $rows[] = $row;
}

?>

<?php
echo isset($_SESSION['alert']);
if (isset($_SESSION['alert'])) {
    echo "<script>alert('" . $_SESSION['alert'] . "');</script>";
    unset($_SESSION['alert']);
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
                        <h3 class="card-title">Hóa đơn</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Họ tên</th>
                            <th>CMTCCCD</th>
                            <th>Vaccine</th>
                            <th>Ngày thanh toán</th>
                            <th>Giá</th>
                            <th>Xác nhận</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($rows as $row): ?>
                            <tr>
                                <td><?= $row['id']; ?></td>
                                <td class="break-word" ><?= $row['HoVaTen']; ?></td>
                                <td><?= $row['CMTCCCD']; ?></td>
                                <td><?= $row['vaccine']; ?></td>
                                <td><?= $row['NgayThanhToan']; ?></td>
                                <td><?= $row['price']; ?></td>
                                <td><?= $row['XacNhan'] ? 'confirmed' : 'not confirmed'; ?></td>
                                <td class="project-actions text-right">
                                    <a class="btn btn-warning btn-sm" href="edit-phieutiem.php?id=<?= $row['id']; ?>">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                    </a>

                                    <form action="delete-phieukham.php" method="POST" style="display: inline-block;">
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

