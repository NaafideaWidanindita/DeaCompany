<?php
include "koneksi.php";
$tb_pegawai_id_pegawai = $_SESSION["ses_id"];
// Query to fetch izin data for the logged-in pegawai
$sql_fetch_izin = "SELECT * FROM tb_cuti_izin WHERE tb_pegawai_id_pegawai = $tb_pegawai_id_pegawai";
$result_fetch_izin = mysqli_query($conn, $sql_fetch_izin);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Izin Admin</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Izin Admin</h1>
            <a href="daftarizin_print.php" target="_blank" class="btn btn-success" name="btnPrint" onclick="printData()"><i class="fa fa-file-pdf"></i> &nbsp PRINT</a>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Izin Admin</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-yellow">
              <div class="card-header">
                <h3 class="card-title">Data Izin Admin</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Rentang Tanggal</th>
                    <th>Jenis Cuti/Izin</th>
                    <th>Keterangan</th>
                    <th>File</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                       $no = 1;
                       while ($row_izin = mysqli_fetch_assoc($result_fetch_izin)) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row_izin['tgl_range']; ?></td>
                        <td><?= $row_izin['jenis_cuti_izin']; ?></td>
                        <td><?= $row_izin['keterangan']; ?></td>
                        <td>
                            <?php
                            echo '<a href="' . $row_izin['file_pendukung'] . '" target="_blank">' . $row_izin['file_pendukung'] . '</a>';
                            ?>
                        </td>
                        <td><?= $row_izin['status']; ?></td>
                    </tr>
                    <?php
                     }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

</body>
</html>
