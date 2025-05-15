<?php
require '../koneksi.php';

if (isset($_GET['url'])) {
    $url = $_GET['url'];

    switch ($url) {
        case 'verifikasi_laporan':
            include 'verifikasi_laporan.php';
            break;
    }
} else {
    ?>
    Selamat Datang di Website Sistem Informasi Pelaporan Mahasiswa (SIMPEL)
    yang dibuat untuk melaporkan pelanggaran atau keluhan mengenai fasilitas di kampus.<br><br>
    Anda Login Sebagai : <h2><b> <?php echo $_SESSION['nama']; ?> </b></h2>

    <?php
    $sqli = mysqli_query($conn, "SELECT * FROM laporan WHERE status='Diajukan'");
    $cek = mysqli_num_rows($sqli);

    if ($cek > 0) {
        ?>
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Laporan Pengaduan:</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Ada <?php echo $cek; ?> Laporan dari Mahasiswa
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                            <span class="badge badge-danger badge-counter"><?php echo $cek; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>
