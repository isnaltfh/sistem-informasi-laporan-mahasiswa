<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Data Pengaduan</title>

  <!-- Custom fonts -->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">

  <!-- Custom styles -->
  <link href="../css/sb-admin-2.min.css" rel="stylesheet">
  <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
        <div class="container-fluid mt-4">
          <!-- Page Heading -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Data Pengaduan</h6>
            </div>

            <div class="card-body">
              <!-- Status update message container -->
              <div id="status-update-message" class="alert alert-success" style="display: none;">
                Status berhasil diperbarui!
              </div>

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>NIM</th>
                      <th>Isi Laporan</th>
                      <th>Foto</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    require '../koneksi.php';
                    $sql = mysqli_query($conn, "SELECT * FROM laporan ORDER BY tgl_laporan DESC");
                    if (!$sql) {
                      echo "<tr><td colspan='6'>Gagal mengambil data: " . mysqli_error($conn) . "</td></tr>";
                    } elseif (mysqli_num_rows($sql) === 0) {
                      echo "<tr><td colspan='6'>Belum ada laporan.</td></tr>";
                    } else {
                      while ($data = mysqli_fetch_array($sql)) {
                        ?>
                        <tr>
                          <td><?= htmlspecialchars($data['tgl_laporan']) ?></td>
                          <td><?= htmlspecialchars($data['nim']) ?></td>
                          <td><?= nl2br(htmlspecialchars($data['isi_laporan'])) ?></td>
                          <td>
                            <?php if (!empty($data['foto'])): ?>
                              <img src="../foto/<?= htmlspecialchars($data['foto']) ?>" width="100" class="img-thumbnail">
                            <?php else: ?>
                              <span class="text-muted">Tidak ada foto</span>
                            <?php endif; ?>
                          </td>
                          <td>
                            <form class="status-form" method="post">
                              <input type="hidden" name="id" value="<?= $data['id'] ?>">
                              <select class="form-control status-select" name="status" data-id="<?= $data['id'] ?>">
                                <option value="Diajukan" <?= $data['status'] === 'Diajukan' ? 'selected' : '' ?>>Diajukan
                                </option>
                                <option value="Proses" <?= $data['status'] === 'Proses' ? 'selected' : '' ?>>Proses</option>
                                <option value="Ditolak" <?= $data['status'] === 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                <option value="Selesai" <?= $data['status'] === 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                              </select>
                            </form>
                          </td>
                          <td>
                            <button class="btn btn-primary btn-sm update-btn" data-id="<?= $data['id'] ?>">
                              Update Status
                            </button>
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
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; UIN Jakarta 2025</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div> <!-- End Content Wrapper -->

  </div> <!-- End Page Wrapper -->

  <!-- Scroll to Top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">Klik logout jika kamu ingin keluar.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- JAVASCRIPT -->
  <!-- jQuery (harus duluan!) -->
  <script src="../vendor/jquery/jquery.min.js"></script>

  <!-- Bootstrap -->
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- jQuery Easing -->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- DataTables plugin -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- SB Admin 2 scripts -->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Inisialisasi DataTables dan Event Handler -->
  <script>
    $(document).ready(function () {
      // Inisialisasi DataTables
      $('#dataTable').DataTable({
        "language": {
          "search": "Cari:",
          "lengthMenu": "Tampilkan _MENU_ data per halaman",
          "zeroRecords": "Data tidak ditemukan",
          "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
          "infoEmpty": "Tidak ada data tersedia",
          "infoFiltered": "(difilter dari _MAX_ total data)",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Selanjutnya",
            "previous": "Sebelumnya"
          }
        }
      });

      // Event handler untuk tombol update
      $('.update-btn').click(function () {
        const id = $(this).data('id');
        const form = $('form.status-form').has(`input[value="${id}"]`);
        const status = form.find('.status-select').val();

        // Nonaktifkan tombol selama update
        $(this).prop('disabled', true).php('<i class="fas fa-spinner fa-spin"></i> Proses...');

        $.ajax({
          url: 'update_status.php',
          method: 'POST',
          dataType: 'json',
          data: {
            id: id,
            status: status
          },
          success: function (response) {
            if (response.success) {
              // Tampilkan pesan sukses
              $('#status-update-message').text('Status berhasil diperbarui!').slideDown();
              setTimeout(function () {
                $('#status-update-message').slideUp();
              }, 3000);
            } else {
              // Tampilkan pesan error
              alert('Gagal memperbarui status: ' + response.message);
            }
          },
          error: function () {
            alert('Terjadi kesalahan. Gagal mengupdate status.');
          },
          complete: function () {
            // Aktifkan kembali tombol
            $('.update-btn').prop('disabled', false).php('Update Status');
          }
        });
      });
    });
  </script>
</body>

</html>
