<?php
session_start();
if (!isset($_SESSION['nama'])) {
  die("Anda belum login");
}

$conn = mysqli_connect("localhost", "root", "", "simpel");

// Ambil data status untuk Donut Chart
$queryStatus = "SELECT status, COUNT(*) AS jumlah FROM laporan GROUP BY status";
$resultStatus = mysqli_query($conn, $queryStatus);
$data_status = [];
while ($row = mysqli_fetch_assoc($resultStatus)) {
  $data_status[] = $row;
}

// Ambil data laporan per bulan untuk Area Chart
$queryPerBulan = "SELECT DATE_FORMAT(tgl_laporan, '%Y-%m') AS bulan, COUNT(*) AS jumlah 
                  FROM laporan 
                  GROUP BY bulan 
                  ORDER BY bulan";
$resultBulan = mysqli_query($conn, $queryPerBulan);
$data_bulan = [];
while ($row = mysqli_fetch_assoc($resultBulan)) {
  $data_bulan[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Halo Admin</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,700,900" rel="stylesheet">
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-keyboard"></i></div>
        <div class="sidebar-brand-text mx-3">SIMPEL</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item"><a class="nav-link" href="admin.php"><i
            class="fas fa-fw fa-tachometer-alt"></i><span>Dashboard</span></a></li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">Interface</div>
      <li class="nav-item"><a class="nav-link" href="?url=verifikasi_laporan"><i
            class="fas fa-edit"></i><span>Verifikasi Laporan</span></a></li>
      <hr class="sidebar-divider d-none d-md-block">
      <li class="nav-item"><a class="nav-link" href="../logout.php"><i
            class="fas fa-sign-out-alt"></i><span>Keluar</span></a></li>
      <div class="text-center d-none d-md-inline"><button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End Sidebar -->

    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3"><i
              class="fa fa-bars"></i></button>
          <h1>Website Sistem Informasi Pelaporan Mahasiswa</h1>
        </nav>
        <!-- End Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php include 'halaman_admin.php'; ?>
        </div>

        <div style="display: flex;" class="charts">
          <!-- Area Chart -->
          <div style="width: 900px; margin-left: 35px;" class="charts">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Area Chart</h6>
              </div>
              <div class="card-body">
                <div class="chart-area"><canvas id="myAreaChart"></canvas></div>
                <hr>Styling for the area chart can be found in the <code>/js/demo/chart-area-demo.js</code> file.
              </div>
            </div>
          </div>

          <!-- Donut Chart -->
          <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
              </div>
              <div class="card-body">
                <div class="chart-pie pt-4"><canvas id="myPieChart"></canvas></div>
                <hr>Styling for the donut chart can be found in the <code>/js/demo/chart-pie-demo.js</code> file.
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto"><span>Copyright &copy; UIN Jakarta 2025</span></div>
        </div>
      </footer>
    </div>
  </div>

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top"><i class="fas fa-angle-up"></i></a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ready to Leave?</h5><button class="close" type="button"
            data-dismiss="modal"><span></span></button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- JS Scripts -->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="../js/sb-admin-2.min.js"></script>
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <script>
    // Data untuk Donut Chart
    const dataStatus = <?php echo json_encode($data_status); ?>;
    const statusLabels = dataStatus.map(item => item.status);
    const statusCounts = dataStatus.map(item => item.jumlah);
    const backgroundColors = statusLabels.map(() => '#' + Math.floor(Math.random() * 16777215).toString(16));

    new Chart(document.getElementById("myPieChart"), {
      type: 'doughnut',
      data: {
        labels: statusLabels,
        datasets: [{
          data: statusCounts,
          backgroundColor: backgroundColors,
          hoverBackgroundColor: backgroundColors,
          hoverBorderColor: "rgba(234, 236, 244, 1)"
        }]
      },
      options: {
        maintainAspectRatio: false,
        responsive: true,
        plugins: {
          legend: { position: 'bottom' },
          tooltip: {
            backgroundColor: "#fff",
            bodyColor: "#858796",
            borderColor: "#ddd",
            borderWidth: 1
          }
        },
        cutout: '60%'
      }
    });

    // Data untuk Area Chart Per Bulan
    const dataBulan = <?php echo json_encode($data_bulan); ?>;
    const labelsBulan = dataBulan.map(item => item.bulan);
    const jumlahPerBulan = dataBulan.map(item => item.jumlah);

    new Chart(document.getElementById("myAreaChart"), {
      type: "line",
      data: {
        labels: labelsBulan,
        datasets: [{
          label: "Jumlah Laporan per Bulan",
          data: jumlahPerBulan,
          backgroundColor: "rgba(78, 115, 223, 0.2)",
          borderColor: "rgba(78, 115, 223, 1)",
          pointBackgroundColor: "rgba(78, 115, 223, 1)",
          pointBorderColor: "#fff",
          pointHoverBackgroundColor: "#fff",
          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
          fill: true,
          tension: 0.4
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: true }
        },
        scales: {
          x: {
            title: { display: true, text: 'Bulan' }
          },
          y: {
            beginAtZero: true,
            title: { display: true, text: 'Jumlah Laporan' }
          }
        }
      }
    });
  </script>
</body>

</html>
