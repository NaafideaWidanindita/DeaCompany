<?php
include "koneksi.php";

$username = $_SESSION["ses_username"];
$sql_fetch = "SELECT * FROM tb_pegawai WHERE username = '$username'";
$result_fetch = mysqli_query($conn, $sql_fetch);
$row_data_pegawai = mysqli_fetch_assoc($result_fetch);

$id_pegawai = $row_data_pegawai['id_pegawai'];
$id_gaji = $row_data_pegawai['tb_gaji_id_gaji'];

$sql_gaji = "SELECT gaji_bulan FROM tb_gaji WHERE id_gaji = $id_gaji"; // Sesuaikan dengan struktur tabel Anda
$result_gaji = $conn->query($sql_gaji);

// Periksa apakah kueri berhasil dieksekusi
if ($result_gaji) {
    // Ambil data hasil kueri
    $row_gaji = $result_gaji->fetch_assoc();
    $result_gaji->free();
} else {
    // Jika kueri gagal dieksekusi, tampilkan pesan kesalahan
    echo "Error: " . $sql_gaji . "<br>" . $conn->error;
}
$sql_data_gaji = "SELECT * FROM tb_ambil_gaji WHERE tb_pegawai_id_pegawai = '$id_pegawai'";
$result_data_gaji = $conn->query($sql_data_gaji);
// Tutup koneksi ke database
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarik Gaji Admin</title>
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tarik Gaji Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tarik Gaji Admin</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <div class="card card-yellow">
              <div class="card-header">
                <h3 class="card-title">Tarik Gaji Admin</h3>
              </div>
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" onsubmit="return validateForm();" action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="tb_pegawai_id_pegawai">ID Admin </label>
                    <input type="text" class="form-control" id="tb_pegawai_id_pegawai" value="<?php echo $row_data_pegawai['id_pegawai']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama </label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row_data_pegawai['nama']; ?>" readonly>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="gaji_bulan">Gaji</label>
                        <input type="text" class="form-control" id="gaji_bulan" name="gaji_bulan"  value="<?php echo $row_gaji['gaji_bulan']?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="bulan">Bulan</label>
                        <input type="text" class="form-control" id="bulan" name="bulan"  value="<?php echo date('F Y'); ?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                  <label for="bank">Pilih Bank</label> <small id="bankError" style="color: red;"></small>
                    <select class="form-control" name="bank" id="bank" name="bank" >
                        <option value="">Pilih</option>
                        <option value="BCA">BCA</option>
                        <option value="BNI">BNI</option>
                        <option value="BRI">BRI</option>
                        <option value="MANDIRI">MANDIRI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="no_rekening">No Rekening</label> <small id="noRekeningError" style="color: red;"></small>
                    <input type="text" class="form-control" id="no_rekening" name="no_rekening">
                  </div>
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-warning btn-block btn-flat" name="btnGaji" >
                    <b>Ambil Gaji</b>
                </button>
              </div>
              </form>
            </div>
        </div>
        <div class="col-md-6">
          <div class="card card-yellow">
              <div class="card-header">
                  <h3 class="card-title">Data Gaji Yang Telah Diambil</h3>
              </div>
              <div class="card-body">
                  <?php
                  // Fetch and display data from tb_ambil_gaji

                  if ($result_data_gaji->num_rows > 0) {
                      echo '<table class="table table-bordered">
                              <thead>
                                  <tr>
                                      <th>Bulan</th>
                                      <th>Bank</th>
                                      <th>No Rekening</th>
                                      <th>Status</th>
                                  </tr>
                              </thead>
                              <tbody>';

                      while ($row_data_gaji = $result_data_gaji->fetch_assoc()) {
                          echo '<tr>
                                  <td>' . $row_data_gaji['bulan'] . '</td>
                                  <td>' . $row_data_gaji['bank'] . '</td>
                                  <td>' . $row_data_gaji['no_rekening'] . '</td>
                                  <td>' . $row_data_gaji['status'] . '</td>
                              </tr>';
                      }

                      echo '</tbody></table>';
                  } else {
                      echo '<p>Belum ada data gaji yang telah diambil.</p>';
                  }
                  ?>
              </div>
          </div>
      </div>
      </div>
</section> 
</div>
<script>
        function validateForm() {
            // Validate Bank
            var bank = document.getElementById('bank').value;
            if (bank === "") {
                document.getElementById('bankError').innerText = "*Wajib diisi";
                return false;
            } else {
                document.getElementById('bankError').innerText = "";
            }

            // Validate No Rekening
            var noRekening = document.getElementById('no_rekening').value;
            if (noRekening === "") {
                document.getElementById('noRekeningError').innerText = "*Wajib diisi";
                return false;
            } else {
                document.getElementById('noRekeningError').innerText = "";
            }

            // Check if No Rekening contains only numeric values
            if (!/^\d+$/.test(noRekening)) {
                document.getElementById('noRekeningError').innerText = "*Masukkan nomor rekening yang benar";
                return false;
            } else {
                document.getElementById('noRekeningError').innerText = "";
            }

            return true; // Form is valid
        }
    </script>
</body>
</html>

<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["btnGaji"])) {
  $bank = $_POST["bank"];
  $no_rekening = $_POST["no_rekening"];
  $bulan = $_POST["bulan"];
  // Check if the salary for the current month has already been taken
  $sql_check_gaji = "SELECT * FROM tb_ambil_gaji WHERE tb_pegawai_id_pegawai = '$id_pegawai' AND bulan = '$bulan'";
  $result_check_gaji = $conn->query($sql_check_gaji);

  $gaji_already_taken = $result_check_gaji->num_rows > 0;

    // Check if the salary for the current month has already been taken
    if ($gaji_already_taken) {
        echo "<script>
            Swal.fire({
                title: 'Gaji Telah Diambil!',
                text: 'Anda telah mengambil gaji bulan ini.',
                icon: 'warning',
                confirmButtonText: 'OK'
            });
            </script>";
    } else {
        // Insert data into tb_ambil_gaji
        $sql_insert = "INSERT INTO tb_ambil_gaji (`tb_pegawai_id_pegawai`, `bank`, `no_rekening`, `bulan`, `status`)
                       VALUES ('$id_pegawai', '$bank', '$no_rekening', '$bulan', 'telah diambil')";

        if ($conn->query($sql_insert) === TRUE) {
            echo "<script>
                Swal.fire({
                    title: 'Gaji Diambil!',
                    text: 'Gaji bulan ini telah diambil.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.value) {
                      window.location = 'index.php?hal=gaji_admin';
                  }
              });
                </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Gagal mengambil gaji.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                </script>";
        }
    }
}
?>





