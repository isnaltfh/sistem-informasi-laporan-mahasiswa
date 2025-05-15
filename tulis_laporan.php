<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tulis Laporan</title>
    <!-- SB Admin 2 CSS -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-flag"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Pelaporan</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Tulis Laporan -->
            <li class="nav-item active">
                <a class="nav-link" href="tulis_laporan.php">
                    <i class="fas fa-fw fa-pen"></i>
                    <span>Tulis Laporan</span></a>
            </li>
                
                <!-- Nav Item - Lihat Laporan -->
            <li class="nav-item">
            <a class="nav-link" href="lihat_laporan.php">
                <i class="fas fa-search"></i>
                <span>Lihat Laporan</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
            <a class="nav-link" href="logout.php">
                <i class="fas fa-singn-out-alt"></i>
                <span>Keluar</span></a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h4 class="m-0 font-weight-bold text-primary">Form Tulis Laporan</h4>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Silakan isi laporan</h6>
                        </div>
                        <div class="card-body">
                            <form action="simpan_laporan.php" method="post" enctype="multipart/form-data">
                                  <div class="form-group cols-sm-6">
                                    <label>Tanggal Simpan laporan</label>
                                    <input type="text" name="tgl_laporan" id="tgl_laporan" value="<?php echo date('d/m/Y'); ?>" class="form-control">
                                <div class="form-group">
                                    <label for="judul">NIM</label>
                                    <input type="text" name="nim" id="nim" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="isi">Isi Laporan</label>
                                    <textarea name="isi_laporan" id="isi_laporan" class="form-control" rows="5" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="gambar">Upload Gambar</label>
                                    <input type="file" name="foto" id="foto" class="form-control-file">
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
