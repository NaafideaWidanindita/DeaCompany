<?php
include 'koneksi.php'; // Memasukkan file koneksi.php
?>
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard Pegawai</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard Pegawai</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- Tampilkan jumlah pegawai dengan jabatan 1 -->
          <div class="col-lg-12 col-6">
              <div class="small-box bg-danger">
                  <div class="inner">
                    <center>
                      <img src="dist/img/logo.png" alt="Logo Perusahaan" style="width:200px;height:190px;">
                      <h4>Profil Perusahaan</h4>
                    </center>
                  </div>
                  <a href="index.php?hal=profil_perusahaan" class="small-box-footer">Tampilkan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
        </div>
        <div class="row">
          <!-- Tampilkan jumlah pegawai dengan jabatan 1 -->
          <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                  <div class="inner">
                      <p>Lihat Profil</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-person"></i>
                  </div>
                  <a href="index.php?hal=profil_pegawai" class="small-box-footer">Tampilkan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- Tampilkan jumlah pegawai dengan jabatan 2 -->
          <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                  <div class="inner">
                      <p>Absen Harian</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="index.php?hal=absen_pegawai" class="small-box-footer">Tampilkan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- Display the count of permissions for administrators -->
          <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                  <div class="inner">
                      <p>Buat Cuti/Izin</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-bag"></i>
                  </div>
                  <a href="index.php?hal=izin_pegawai" class="small-box-footer">Tampilkan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- Display the count of permissions for employees -->
          <div class="col-lg-3 col-6">
              <div class="small-box bg-danger">
                  <div class="inner">
                      <p>Tarik Gaji</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="index.php?hal=gaji_pegawai" class="small-box-footer">Tampilkan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
        </div>
          </section>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->