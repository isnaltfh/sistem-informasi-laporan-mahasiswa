<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Register</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">

        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12 d-none d-lg-block bg-login-image"></div>
          <div class="col-lg-12">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-grey-900 mb-4">Registrasi Akun</h1><h2>Website Sistem Informasi Pelaporan Mahasiswa</h2>
                </div>

              <form class="user" method="post" action="simpan_mahasiswa.php">

                <div class="form-group">
                  <input type="text" name="nim" class="form-control form-control-user" placeholder="Masukan NIM">
                </div>

                <div class="form-group">
                    <input type="text" name="nama" class="form-control form-control-user" placeholder="Masukan Nama">
                </div>

                <div class="form-group">
                    <input type="text" name="username" class="form-control form-control-user" placeholder="Masukan Username">
                </div>

                <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-user" placeholder="Masukan Password">
                </div>

                
                <div class="form-group">

                </div>
                <input type="submit" class="btn btn-primary btn-user btn-block" value="Daftar!">

                <hr>
               
              </form>
              <div class="text-center">
                Sudah Punya Akun <br>
                <a class="small" href="index.php">Silahkan Login</a>
              </div>
              </div>
            </div>
          </div>
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

</body>

</html>
