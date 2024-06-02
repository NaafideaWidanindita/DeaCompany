<?php
include "koneksi.php";
  $sql_data_pegawai = "SELECT * FROM tb_pegawai";
  $result_data_pegawai = mysqli_query($conn, $sql_data_pegawai);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rekap Data Admin</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
    .table td, .table th {
      font-size: small; /* Atur ukuran teks menjadi kecil */
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">

  <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rekap Data Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rekap Data Admin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-yellow">
              <div class="card-header">
                <h3 class="card-title">Rekap Data Admin</h3>
              </div>
              
              <div class="row">
                    <div class="col-sm-4"> <br>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><strong>Jabatan</strong></td>
                                <td>: Administrator</td>
                            </tr>
                            <tr>
                                <td><strong>Gaji</strong></td>
                                <td>: 4000000</td>
                            </tr>
                            <tr>
                                <td><a href="data_admin_print.php" target="_blank" class="btn btn-success" name="btnPrint" onclick="printData()"><i class="fa fa-file-pdf"></i> &nbsp PRINT</a></td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID </th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No Telp</th>
                    <th>Tgl Lahir</th>
                    <th>Tgl Masuk</th>
                    <th>Gender</th>
                    <th>Departemen</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                     while ($row_data_pegawai = mysqli_fetch_assoc($result_data_pegawai)) {
                        // ID jabatan dari $data_tb_jabatan_id_jabatan
                        $id_jabatan = $row_data_pegawai['tb_jabatan_id_jabatan']; 
                        $id_departemen = $row_data_pegawai['tb_departemen_id_departemen'];
                        $id_gaji = $row_data_pegawai['tb_gaji_id_gaji'];
                        // Kueri SQL untuk mendapatkan nama jabatan
                        $sql = "SELECT nama_jabatan FROM tb_jabatan WHERE id_jabatan = $id_jabatan";
                        $sql1 = "SELECT nama_departemen FROM tb_departemen WHERE id_departemen = $id_departemen";
                        $sql_gaji = "SELECT gaji_bulan FROM tb_gaji WHERE id_gaji = $id_gaji"; // Sesuaikan dengan struktur tabel Anda
                        // Eksekusi kueri
                        $result = $conn->query($sql);
                        $result1 = $conn->query($sql1);
                        $result_gaji = $conn->query($sql_gaji);
                        // Periksa apakah kueri berhasil dieksekusi
                        if ($result && $result1 && $result_gaji) {
                            // Ambil data hasil kueri
                            $row = $result->fetch_assoc();
                            $row1 = $result1->fetch_assoc();
                            $row_gaji = $result_gaji->fetch_assoc();
                            // Bebaskan memori hasil kueri
                            $result->free();
                            $result1->free();
                            $result_gaji->free();
                        } else {
                            // Jika kueri gagal dieksekusi, tampilkan pesan kesalahan
                            echo "Error: " . $sql . " " . $sql1 . " " . $sql_gaji . "<br>" . $conn->error;
                        }
                         // Tampilkan hanya pegawai dengan nama_jabatan == "pegawai"
                         if ($row['nama_jabatan'] == "Administrator") {
                    ?>
                            <tr>
                                <td><?= $row_data_pegawai['id_pegawai']; ?></td>
                                <td><?= $row_data_pegawai['nama']; ?></td>
                                <td><?= $row_data_pegawai['alamat']; ?></td>
                                <td><?= $row_data_pegawai['no_telp']; ?></td>
                                <td><?= $row_data_pegawai['tgl_lahir']; ?></td>
                                <td><?= $row_data_pegawai['tgl_masuk']; ?></td>
                                <td><?= $row_data_pegawai['jenis_kelamin']; ?></td>
                                <td><?php echo $row1['nama_departemen']?></td>
                                <td><a href="index.php?hal=data_pegawaiadmin_delete&id_pegawai=<?= $row_data_pegawai['id_pegawai']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fas fa-trash"></i></a></td>
                            </tr>
                            <?php
                                }}
                                ?>
                    </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
<!-- jQuery
<script src="plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

</body>
</html>


