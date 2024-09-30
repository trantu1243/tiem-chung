<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
        <span class="brand-text font-weight-light">Admin Page</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item <?php echo ($current_page == 'index.php' || $current_page == 'add-service.php') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?php echo ($current_page == 'index.php' || $current_page == 'add-service.php') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dịch vụ tiêm chủng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tất cả</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add-service.php" class="nav-link <?php echo ($current_page == 'add-service.php') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm dịch vụ</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?php echo ($current_page == 'phieukham.php' || $current_page == 'add-phieukham.php') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?php echo ($current_page == 'phieukham.php' || $current_page == 'add-phieukham.php') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Phiếu khám sàng lọc
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="phieukham.php" class="nav-link <?php echo ($current_page == 'phieukham.php') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tất cả</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="add-phieukham.php" class="nav-link <?php echo ($current_page == 'add-phieukham.php') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thêm phiếu khám</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?php echo ($current_page == 'phieutiem.php') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?php echo ($current_page == 'phieutiem.php') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Phiếu tiêm chủng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="phieutiem.php" class="nav-link <?php echo ($current_page == 'phieutiem.php') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tất cả</p>
                            </a>
                        </li>
                       
                    </ul>
                </li>

                <li class="nav-item <?php echo ($current_page == 'hoadon.php') ? 'menu-open' : ''; ?>">
                    <a href="#" class="nav-link <?php echo ($current_page == 'hoadon.php') ? 'active' : ''; ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Hóa đơn
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="hoadon.php" class="nav-link <?php echo ($current_page == 'hoadon.php') ? 'active' : ''; ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tất cả</p>
                            </a>
                        </li>
                       
                    </ul>
                </li>
                
                <li class="nav-header">ACTIONS</li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="nav-icon fa fa-sign-out"></i>
                        <p>Đăng xuất</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>