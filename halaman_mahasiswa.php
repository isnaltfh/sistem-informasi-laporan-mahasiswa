<?php
if (isset($_GET['url']))
{
    $url=$_GET['url'];

    switch($url)
    {
        case 'tulis_laporan';
        include 'tulis_laporan.php';
        break;

        case 'lihat_laporan';
        include 'lihat_laporan.php';
        break;

    }
}
else
{
    ?>
    Selamat Datang di Website Sistem Informasi Pelaporan Mahasiswa (SIMPEL)
    yang di buat untuk melaporkan pelanggarann atau keluhan mengenai fasilitas di kampus <br><br>
    Anda Login Sebagai : <h2><b> <?php echo $_SESSION['nama']; 
}
?>
