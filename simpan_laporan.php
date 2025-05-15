<?php
require 'koneksi.php';

// Konversi format tanggal ke format MySQL (YYYY-MM-DD)
$tgl_laporan = $_POST['tgl_laporan'];
$tgl_laporan = date('Y-m-d', strtotime(str_replace('/', '-', $tgl_laporan)));

$nim = $_POST['nim'];
$isi_laporan = $_POST['isi_laporan'];
$foto = $_FILES['foto']['name'];
$status = 'Diajukan'; // Status default saat diajukan

// Upload file foto terlebih dahulu
$upload_dir = "foto/";
$upload_path = $upload_dir . basename($foto);

if (move_uploaded_file($_FILES['foto']['tmp_name'], $upload_path)) {
    // INSERT termasuk kolom status
    $sql = "INSERT INTO laporan (tgl_laporan, nim, isi_laporan, foto, status) 
            VALUES ('$tgl_laporan', '$nim', '$isi_laporan', '$foto', '$status')";

    $sqli = mysqli_query($conn, $sql);

    if ($sqli) {
        echo <<<HTML
<script>
    alert('Data berhasil disimpan. Terima kasih sudah menulis laporan');
    window.location='mahasiswa.php';
</script>
HTML;
    } else {
        echo "Gagal menyimpan: " . mysqli_error($conn);
    }
} else {
    echo "Gagal upload foto.";
}
?>
