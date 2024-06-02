<?php
include "koneksi.php";

// Query to fetch izin data for the logged-in pegawai with jabatan_id_jabatannya = 2
$sql_fetch_izin = "SELECT c.*, p.tb_jabatan_id_jabatan FROM tb_cuti_izin c
                   INNER JOIN tb_pegawai p ON c.tb_pegawai_id_pegawai = p.id_pegawai
                   WHERE p.tb_jabatan_id_jabatan = 2";
$result_fetch_izin = mysqli_query($conn, $sql_fetch_izin);

// Function untuk mendapatkan nama pegawai berdasarkan id_pegawai
function getNamaPegawai($conn, $id_pegawai) {
    $sql = "SELECT nama FROM tb_pegawai WHERE id_pegawai = $id_pegawai";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['nama'];
    } else {
        return "Nama tidak ditemukan";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rekap Izin Pegawai</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    .table td, .table th {
      font-size: small;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rekap Izin Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rekap Izin Pegawai</li>
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
                <h3 class="card-title">Rekap Izin Pegawai</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nama Pegawai</th>
                    <th>Rentang Tanggal</th>
                    <th>Jenis</th>
                    <th>Keterangan</th>
                    <th>File</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $no = 1;
                    while ($row_izin = mysqli_fetch_assoc($result_fetch_izin)) {
                        $id_pegawai = $row_izin['tb_pegawai_id_pegawai'];
                        // Panggil fungsi untuk mendapatkan nama pegawai
                        $nama_pegawai = getNamaPegawai($conn, $id_pegawai);
                    ?>
                    <tr>
                        <td><?= $id_pegawai; ?></td>
                        <td><?= $nama_pegawai; ?></td>
                        <td><?= $row_izin['tgl_range']; ?></td>
                        <td><?= $row_izin['jenis_cuti_izin']; ?></td>
                        <td><?= $row_izin['keterangan']; ?></td>
                        <td>
                            <?php
                            // Display the file_pendukung as a link
                            echo '<a href="' . $row_izin['file_pendukung'] . '" target="_blank">' . $row_izin['file_pendukung'] . '</a>';
                            ?>
                        </td>
                        <td><?= $row_izin['status']; ?></td>
                        <td>
                            <!-- Tombol Edit menggunakan ikon Font Awesome -->
                            <a href="index.php?hal=update_data_izin_pegawai&id_izin=<?= $row_izin['id_cuti_izin']; ?>"><i class="fas fa-edit"></i></a>
                            <a href="index.php?hal=data_izin_delete&id_izin=<?= $row_izin['id_cuti_izin']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
                        </td>
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

