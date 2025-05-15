<?php
// Include database connection
require '../koneksi.php';

// Set header content type to JSON
header('Content-Type: application/json');

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate and sanitize inputs
    if (isset($_POST['id']) && isset($_POST['status'])) {
        $id = intval($_POST['id']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        // Verify ID is valid
        if ($id <= 0) {
            echo json_encode(['success' => false, 'message' => 'ID laporan tidak valid']);
            exit;
        }

        // Verify status is one of the allowed values
        $allowed_statuses = ['Diajukan', 'Proses', 'Ditolak', 'Selesai'];
        if (!in_array($status, $allowed_statuses)) {
            echo json_encode(['success' => false, 'message' => 'Status tidak valid']);
            exit;
        }

        // Verify record exists
        $check_query = "SELECT id FROM laporan WHERE id = $id";
        $check_result = mysqli_query($conn, $check_query);

        if (!$check_result || mysqli_num_rows($check_result) === 0) {
            echo json_encode(['success' => false, 'message' => 'Laporan tidak ditemukan']);
            exit;
        }

        // Update the status in the database
        $query = "UPDATE laporan SET status = '$status' WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Status berhasil diperbarui']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Gagal memperbarui status: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Data tidak lengkap']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Metode request tidak valid']);
}
?>
