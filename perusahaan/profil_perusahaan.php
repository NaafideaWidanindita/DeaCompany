<?php
    //KONEKSI DB
	include "koneksi.php";
	
	$sql = $conn->query("SELECT * from tb_perusahaan");
	while ($data= $sql->fetch_assoc()) {
	
	$nama_perusahaan=$data['nama_perusahaan'];
    $bidang=$data['bidang'];
    $pendiri=$data['pendiri'];
    $tahun=$data['tahun_berdiri'];
    $alamat=$data['alamat'];
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Profil Perusahaan</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href=".plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile Perusahaan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile Perusahaan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">

            <!-- Profile Image -->
            <div class="card card-yellow card-outline">
              <div class="card-body">
                <div class="text-center">
                  <img class="profile-user-img img-circle"
                       src="dist/img/dea.jpg"
                       alt="">
                </div>
                <h3 class="profile-username text-center"><?php echo $pendiri; ?></h3>
                <p class="text-muted text-center">Pendiri</p>
                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>Perusahaan</b> <a class="float-right"><?php echo $nama_perusahaan; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Sejak</b> <a class="float-right"><?php echo $tahun; ?></a>
                  </li>
                  <li class="list-group-item">
                    <b>Bidang</b> <a class="float-right"><?php echo $bidang; ?></a>
                  </li>
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- About Me Box -->
            <div class="card card-yellow">
              <div class="card-header">
                <h3 class="card-title">About <?php echo $nama_perusahaan; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                <p class="text-muted"><?php echo $alamat; ?></p>
                <hr>
                <strong><i class="fas fa-pencil-alt mr-1"></i> Visi</strong>
                <p class="text-muted">Inovasi Terpercaya Solusi Unggul</p>
                <hr>
                <strong><i class="fas fa-book mr-1"></i> Misi</strong>
                <p class="text-muted">
                    1. Menyediakan layanan arsitektur yang berkualitas tinggi dan sesuai dengan standar terbaik industri. <br>
                    2. Menciptakan desain yang inovatif dan fungsional untuk setiap proyek. <br>
                    3. Menjaga hubungan baik dengan klien, memahami kebutuhan mereka, dan memberikan solusi yang sesuai.
                </p>

                <hr>
                <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card">
              <div class="card card-yellow card-outline">
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane">
                    <div class="post clearfix">
                        <center><img src="dist/img/logo.png" alt="logo_perusahaan" style="width:210px;height:210px;"></center>
                    </div>
                    <!-- Post -->
                    <div class="post clearfix">
                        <span class="user-block username"><a href="#"><b>Pendirian dan Sejarah Singkat</b></a></span>
                      <!-- /.user-block -->
                      <p>
                      Perusahaan arsitektur DEA COMPANY didirikan oleh Naafi'dea Widanindita pada tahun 2020. Sejak pendiriannya, perusahaan ini telah tumbuh menjadi pemimpin di industri arsitektur dengan kantor pusat yang berlokasi di jalan Batu Raya. Dengan visi dan dedikasi Naafi'dea Widanindita, perusahaan ini telah berhasil meraih reputasi yang solid dalam menyediakan layanan arsitektur berkualitas tinggi.
                      </p>
                    </div>
                    <!-- /.post -->
                    <!-- Post -->
                    <div class="post clearfix">
                        <span class="user-block username"><a href="#"><b>Layanan Perusahaan</b></a></span>
                      <!-- /.user-block -->
                      <p>
                      Perusahaan arsitektur Naafi'dea Widanindita menyediakan berbagai layanan arsitektur untuk memenuhi kebutuhan klien mereka. Beberapa layanan utama meliputi:
                        <ol type="1">
                            <li>Desain Arsitektur: <br>
                                Mencakup perencanaan dan desain untuk berbagai jenis proyek, mulai dari rumah tinggal hingga proyek komersial.
                            </li>
                            <li>Konsultasi Arsitektur: <br>
                                Menyediakan konsultasi ahli untuk membantu klien dalam mengembangkan konsep dan merencanakan proyek arsitektur mereka.
                            </li>
                            <li>Manajemen Proyek: <br>
                                Menangani pengelolaan penuh proyek, mulai dari perencanaan hingga pelaksanaan, untuk memastikan proyek berjalan sesuai jadwal dan anggaran.
                            </li>
                        </ol>
                      </p>
                    </div>
                    <!-- /.post -->
                    <!-- Post -->
                    <div class="post clearfix">
                        <span class="user-block username"><a href="#"><b>Nilai Perusahaan</b></a></span>
                      <!-- /.user-block -->
                      <p>
                      Perusahaan Naafi'dea Widanindita memiliki komitmen terhadap nilai-nilai tertentu yang membimbing setiap aspek operasional dan pelayanannya. Beberapa nilai inti perusahaan meliputi:
                        <ol type="1">
                            <li>Inovasi: <br>
                                 Berkomitmen untuk terus menciptakan desain yang inovatif dan berpikir di luar batas konvensional.
                            </li>
                            <li>Kualitas: <br>
                                 Memberikan layanan dan hasil kerja dengan standar kualitas tertinggi.
                            </li>
                            <li>Kepuasan Pelanggan:  <br>
                                Menempatkan kebutuhan dan kepuasan pelanggan sebagai prioritas utama.
                            </li>
                        </ol>
                      </p>
                    </div>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
