<?php
include 'koneksi.php'; // Memasukkan file koneksi.php

// Query untuk menghitung jumlah pegawai dengan jabatan 1 (Admin)
$queryAdmin = "SELECT COUNT(*) AS totalAdmin FROM tb_pegawai WHERE tb_jabatan_id_jabatan = 1";
$resultAdmin = $conn->query($queryAdmin);
$rowAdmin = $resultAdmin->fetch_assoc();
$totalAdmin = $rowAdmin['totalAdmin'];

// Query untuk menghitung jumlah pegawai dengan jabatan 2 (Manager)
$queryManager = "SELECT COUNT(*) AS totalPegawai FROM tb_pegawai WHERE tb_jabatan_id_jabatan = 2";
$resultManager = $conn->query($queryManager);
$rowManager = $resultManager->fetch_assoc();
$totalPegawai = $rowManager['totalPegawai'];

function getCountOfPermissions($jobTitleId)
{
    global $conn;

    $query = "SELECT COUNT(*) AS totalPermissions FROM tb_cuti_izin
              JOIN tb_pegawai ON tb_cuti_izin.tb_pegawai_id_pegawai = tb_pegawai.id_pegawai
              WHERE tb_pegawai.tb_jabatan_id_jabatan = $jobTitleId";

    $result = $conn->query($query);
    $row = $result->fetch_assoc();
    return $row['totalPermissions'];
}

// Query to get the count of administrators (job title id = 1)
$totalizinAdmin = getCountOfPermissions(1);

// Query to get the count of employees (job title id = 2)
$totalizinPegawai = getCountOfPermissions(2);
?>
<!-- Content Header (Page header) -->
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard Admin</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header --> 
 <!-- Main content -->
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
        <!-- /.row -->
        <div class="row">
          <!-- Tampilkan jumlah pegawai dengan jabatan 1 -->
          <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                  <div class="inner">
                      <h3><?php echo $totalAdmin; ?></h3>
                      <p>Administrator</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-bag"></i>
                  </div>
                  <a href="index.php?hal=data_admin" class="small-box-footer">Tampilkan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- ./col -->
          <!-- Tampilkan jumlah pegawai dengan jabatan 2 -->
          <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                  <div class="inner">
                      <h3><?php echo $totalPegawai; ?></h3>
                      <p>Pegawai</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="index.php?hal=data_pegawai" class="small-box-footer">Tampilkan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- ./col -->
          <!-- Display the count of permissions for administrators -->
          <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                  <div class="inner">
                      <h3><?php echo $totalizinAdmin; ?></h3>
                      <p>Izin/Cuti Administrator</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-bag"></i>
                  </div>
                  <a href="index.php?hal=data_izin_admin" class="small-box-footer">Tampilkan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- ./col -->
          <!-- Display the count of permissions for employees -->
          <div class="col-lg-3 col-6">
              <div class="small-box bg-danger">
                  <div class="inner">
                      <h3><?php echo $totalizinPegawai; ?></h3>
                      <p>Izin/Cuti Pegawai</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="index.php?hal=data_izin_pegawai" class="small-box-footer">Tampilkan <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- ./col -->
        </div>
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->