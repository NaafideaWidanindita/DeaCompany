<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Kepegawaian</title>
  <link rel="icon" href="dist/img/logo.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page"  style="background-color: #da9c39;">

<div class="login-box">
  <div class="card">
    <div class="card-body login-card-body" style="background-color: #faf4e6; width: 400px; border-radius: 10px;">
      <center>
        <img src="dist/img/logo.png" width=180px />
        <br>
      </center>
      <p class="login-box-msg">Sign in to start your session</p>
      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="username" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block"name="btnLogin">Login</button>
          </div>
        </div>
      </form>
      <p class="mb-1">
      <center><a href="registrasi.php" style="font-size: smaller;">Belum Ada Akun?</a></center>
      </p>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>

<?php
include "koneksi.php";

session_start(); // Mulai session
if (isset($_POST['btnLogin'])) {
    //anti inject sql
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    //query login
    $sql_login = "SELECT * FROM tb_pegawai WHERE BINARY username='$username' AND password='$password'";
    $query_login = mysqli_query($conn, $sql_login);
    $data_login = mysqli_fetch_array($query_login, MYSQLI_BOTH);
    $jumlah_login = mysqli_num_rows($query_login);

    if ($jumlah_login == 1) {
        // Simpan data ke sesi
        $_SESSION["ses_id"] = $data_login["id_pegawai"];
        $_SESSION["ses_nama"] = $data_login["nama"];
        $_SESSION["ses_username"] = $data_login["username"];
        $_SESSION["ses_password"] = $data_login["password"];
        $_SESSION["ses_alamat"] = $data_login["alamat"];
        $_SESSION["ses_no_telp"] = $data_login["no_telp"];
        $_SESSION["ses_tgl_lahir"] = $data_login["tgl_lahir"];
        $_SESSION["ses_jenis_kelamin"] = $data_login["jenis_kelamin"];
        $_SESSION["ses_tgl_masuk"] = $data_login["tgl_masuk"];
        $_SESSION["ses_tb_jabatan_id_jabatan"] = $data_login["tb_jabatan_id_jabatan"];
        $_SESSION["ses_tb_departemen_id_departemen"] = $data_login["tb_departemen_id_departemen"];
        $_SESSION["ses_tb_gaji_id_gaji"] = $data_login["tb_gaji_id_gaji"];
        $_SESSION["ses_foto"] = $data_login["foto"];

        echo "<script>
        setTimeout(function() {
            window.location = 'index.php';
        }, 500);
      </script>";
} else {
// Jika login gagal, tampilkan pesan kesalahan
echo "<div style='color: red;'>Login Gagal. Silakan coba lagi.</div>";
}
}
?>