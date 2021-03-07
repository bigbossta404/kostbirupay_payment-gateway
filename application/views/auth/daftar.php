<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Daftar Baru</title>

  <!-- Custom fonts for this template-->
  <link href="<?= base_url('asset/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="<?= base_url('asset/css/styles.css') ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?= base_url('asset/css/sb-admin-2.min.css') ?>" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container" id="containerlogin">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row rowregis">
              <div class="col-lg">
                <div class="p-5">
                  <div class="logologin">
                    <img src="<?= base_url('asset/image/loginlogo.png') ?>" alt="" height="100">
                  </div>
                  <form class="user" action="<?= base_url('daftar') ?>" method="POST">

                    <div class="form-group">
                      <input name="nama" type="text" class="form-control form-control-user" id="nama" aria-describedby="emailHelp" placeholder="Nama Lengkap" value="<?= set_value('nama'); ?>">
                      <?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                      <input name="email" type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Email">
                      <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                      <input name="username" type="text" class="form-control form-control-user" id="username" aria-describedby="emailHelp" placeholder="Username">
                      <?= form_error('username', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input name="password" type="password" class="form-control form-control-user" id="password" placeholder="Password">
                        <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                      <div class="col-sm-6">
                        <input name="repassword" type="password" class="form-control form-control-user" id="repassword" placeholder="Ulang Password">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Inget-inget</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block btndaftar">
                      Daftar!
                    </button>
                    <hr>
                  </form>
                  <div class="text-center">
                    <a class="small" href="<?= base_url('/') ?>">Sudah punya akun?</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php base_url('asset/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?php base_url('asset/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php base_url('asset/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php base_url('asset/js/sb-admin-2.min.js') ?>"></script>

</body>

</html>