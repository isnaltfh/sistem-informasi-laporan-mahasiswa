<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Tables</title>

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-keyboard"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SIMPEL<sup></sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="mahasiswa.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>


      <!-- Nav Item - Tulis Laporan -->
      <li class="nav-item">
        <!-- <a class="nav-link" href="tulis_laporan.php"> -->
        <a class="nav-link" href="tulis_laporan.php">
          <i class="fas fa-edit"></i>
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

    </ul>
    <!-- End of Sidebar -->


    <!-- DataTales Example -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Laporan Anda</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Tanggal</th>
                <th>NIM</th>
                <th>Isi Laporan</th>
                <th>Foto</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              session_start();
              require 'koneksi.php';

              if (!isset($_SESSION['nim'])) {
                echo "<tr><td colspan='5'>Silakan login terlebih dahulu.</td></tr>";
                exit;
              }

              $nim = $_SESSION['nim'];
              $query = "SELECT * FROM laporan WHERE nim = '$nim'";
              $result = mysqli_query($conn, $query);

              if (!$result) {
                echo "<tr><td colspan='5'>Gagal mengambil data: " . mysqli_error($conn) . "</td></tr>";
              } elseif (mysqli_num_rows($result) === 0) {
                echo "<tr><td colspan='5'>Belum ada laporan.</td></tr>";
              } else {
                while ($data = mysqli_fetch_assoc($result)) {
                  ?>
                  <tr>
                    <td><?php echo htmlspecialchars($data['tgl_laporan']); ?></td>
                    <td><?php echo htmlspecialchars($data['nim']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($data['isi_laporan'])); ?></td>
                    <td>
                      <?php if (!empty($data['foto'])): ?>
                        <img src="foto/<?php echo htmlspecialchars($data['foto']); ?>" width="100">
                      <?php else: ?>
                        Tidak ada foto
                      <?php endif; ?>
                    </td>
                    <td>
                      <a href="detail_tanggapan.php?id=<?php echo $data['id']; ?>" class="btn btn-info btn-sm">
                        <?php echo htmlspecialchars($data['status']); ?>
                      </a>
                    </td>
                  </tr>
                  <?php
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>


  </div>
  <!-- /.container-fluid -->

  </div>
  <!-- End of Main Content -->

  <!-- Footer -->
  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; Uin Jakarta 2025</span>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->

  </div>
  <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
