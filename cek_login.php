<?php
require 'koneksi.php';
session_start();

// Ambil input dari form login
$user = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Debugging (bisa dihapus jika sudah tidak perlu)
echo "Username: $user <br>";
echo "Password: $password <br>";

// Cek di tabel mahasiswa
$sql_mahasiswa = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE username='$user' AND password='$password'");

// Cek di tabel admin
$sql_admin = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$password'");

if (!$sql_mahasiswa || !$sql_admin) {
    die("Query error: " . mysqli_error($conn));
}

if (mysqli_num_rows($sql_mahasiswa) > 0) {
    // Login sebagai mahasiswa
    $data = mysqli_fetch_assoc($sql_mahasiswa);
    $_SESSION['nama'] = $data['username'];
    $_SESSION['nim'] = $data['nim'];
    $_SESSION['level'] = 'mahasiswa';
    header('Location: mahasiswa.php');
    exit;

} elseif (mysqli_num_rows($sql_admin) > 0) {
    // Login sebagai admin
    $data = mysqli_fetch_assoc($sql_admin);
    $_SESSION['nama'] = $data['username'];
    $_SESSION['level'] = 'admin';
    header('Location: admin/admin.php');
    exit;

} else {
    // Gagal login
    echo "<script>alert('Username atau Password salah!'); window.location='index.php';</script>";
}
?>
