<?php
require 'koneksi.php'; // pastikan koneksi ini mengisi $koneksi

// Ambil data dari form
$nim = $_POST['nim'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];

// Upload file foto (jika ada)


// Simpan data ke database
$sql = mysqli_query($conn, "INSERT INTO mahasiswa ( nim, nama, username, password)
VALUES ( '$nim', '$nama', '$username', '$password')");

// Cek hasil
if ($sql) {
    echo "<script>
        alert('Data berhasil disimpan. Terima kasih sudah menulis laporan');
        window.location='index.php';
    </script>";
} else {
    echo "Gagal menyimpan: " . mysqli_error($conn);
}
?>
