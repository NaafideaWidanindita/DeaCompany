<?php
include "koneksi.php";

//absensi data for the logged-in pegawai with jabatan_id_jabatannya = 2
$sql_fetch_absensi = "SELECT * FROM tb_absensi a
                     INNER JOIN tb_pegawai p ON a.tb_pegawai_id_pegawai = p.id_pegawai
                     WHERE p.tb_jabatan_id_jabatan = 1";
$result_fetch_absensi = mysqli_query($conn, $sql_fetch_absensi);

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Absen Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
</head>
<body>
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rekap Absen Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rekap Absen Admin</li>
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
                <h3 class="card-title">Rekap Absen Admin</h3>
              </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Admin</th>
                    <th>Tanggal Absensi</th>
                    <th>Jam Masuk</th>
                    <th>Jam Keluar</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                    $no = 1;
                    while ($row_absensi = mysqli_fetch_assoc($result_fetch_absensi)) {
                        $id_pegawai = $row_absensi['tb_pegawai_id_pegawai'];
                        // Panggil fungsi untuk mendapatkan nama pegawai
                        $nama_pegawai = getNamaPegawai($conn, $id_pegawai);
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $nama_pegawai; ?></td>
                        <td><?= $row_absensi['tgl_absensi']; ?></td>
                        <td><?= $row_absensi['jam_masuk']; ?></td>
                        <td><?= $row_absensi['jam_keluar']; ?></td>
                        <td><?= $row_absensi['keterangan']; ?></td>
                        <td>
                          <a href="index.php?hal=update_data_absen_admin&id_absensi=<?= $row_absensi['id_absensi']; ?>"><i class="fas fa-edit"></i></a>
                          <a href="index.php?hal=delete_data_absen_admin&id_absensi=<?= $row_absensi['id_absensi']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a>
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
</div>
</body>
</html>
