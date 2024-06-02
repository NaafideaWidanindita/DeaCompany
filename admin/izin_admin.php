<?php
include "koneksi.php";
$username = $_SESSION["ses_username"];
$sql_fetch = "SELECT * FROM tb_pegawai WHERE username = '$username'";
$result_fetch = mysqli_query($conn, $sql_fetch);
$row = mysqli_fetch_assoc($result_fetch);
$tb_pegawai_id_pegawai = $row['id_pegawai'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Izin Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- date-range-picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">  
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">


</head>
<style>
  .box {
    border: 1px solid #dddddd; /* Warna border abu-abu */
  }

  .box-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #dddddd; /* Garis pemisah antara header dan body */
    padding: 10px;
  }

  .box-tools {
    display: flex;
    align-items: center;
    justify-content: flex-end; /* Menempatkan box-tools di sebelah kanan */
  }

  .box-body {
    padding: 10px;
  }
</style>


<body>
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Buat Izin Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Buat Izin Admin</li>
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
                <h3 class="card-title">Buat Izin Admin</h3>
              </div>
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" action="" method="post">
                <div class="card-body">
                <div class="form-group">
                <label for="tgl_range">Rentang Tanggal:</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="far fa-calendar-alt"></i>
                    </span>
                  </div>
                  <input type="text" class="form-control float-right" name="tgl_range" id="reservation">
                </div>
              </div>

              <div class="form-group">
                <label for="jenis_cuti_izin">Pilih </label>
                  <select class="form-control" name="jenis_cuti_izin" id="jenis_cuti_izin" name="jenis_cuti_izin" >
                      <option value="">Pilih</option>
                      <option value="Cuti">Cuti</option>
                      <option value="Izin">Izin</option>
                  </select>
              </div>
              <div class="form-group">
                <label for="file_pendukung">File Pendukung</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file_pendukung" name="file_pendukung" accept="image/*" onchange="updateFileNameLabel()" >
                    <label class="custom-file-label" for="file_pendukung">Choose file</label>
                  </div>
                </div>
                <font color="red">Upload scan surat izin Jpg/Png</font> <br>
              </div>
              <div class="box">
                <div class="box-header">
                  <div>
                    <label for="keterangan">Keterangan </label>
                  </div>
                  <div class="box-tools">
                    <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse" onclick="toggleCollapse()">
                      <i class="fa fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body">
                  <textarea id="keterangan" name="keterangan" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
              </div>

              </div>
              <!-- /.box-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-warning btn-block btn-flat" name="btnIzin">
                    <b>Ajukan</b>
                </button>
              </div>
              </form>
            </div>
            <!-- /.card -->
      </div>
</section> 
</div>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="plugins/alert.js"></script>
    <!-- Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.id.min.js"></script>
<!-- Date range picker -->
<script>
  $(function () {
    // Date range picker
    $('#reservation').daterangepicker();
  });
</script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
  function toggleCollapse() {
    var textarea = document.getElementById('keterangan');
    var button = document.querySelector('.box-tools [data-widget="collapse"]');
    
    if (textarea.style.display === 'none') {
      textarea.style.display = 'block';
      button.innerHTML = '<i class="fa fa-minus"></i>';
    } else {
      textarea.style.display = 'none';
      button.innerHTML = '<i class="fa fa-plus"></i>';
    }
  }
</script>

<script>
    function updateFileNameLabel() {
      var inputElement = document.getElementById('file_pendukung');
      var labelElement = document.querySelector('.custom-file-label');

      // Periksa apakah file telah dipilih
      if (inputElement.files.length > 0) {
        // Perbarui label dengan nama file
        labelElement.textContent = inputElement.files[0].name;
      } else {
        // Jika tidak ada file yang dipilih, kembalikan label ke teks awal
        labelElement.textContent = 'Choose file';
      }
    }
  </script>

</body>
</html>
<?php
if (isset($_POST['btnIzin'])) {
    // Validate input fields
    if (empty($_POST['tgl_range']) || empty($_POST['jenis_cuti_izin']) || empty($_FILES['file_pendukung']['name']) || empty($_POST['keterangan'])) {
        echo "<script>
            Swal.fire({
                title: 'Form belum lengkap!',
                text: 'Silakan isi semua kolom',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            </script>";
    } else {
        // Mendapatkan nilai dari form
        $tgl_range = mysqli_real_escape_string($conn, $_POST['tgl_range']);
        $jenis_cuti_izin = mysqli_real_escape_string($conn, $_POST['jenis_cuti_izin']);
        $file_pendukung_name = $_FILES['file_pendukung']['name'];
        $file_pendukung_tmp = $_FILES['file_pendukung']['tmp_name'];
        $file_pendukung_size = $_FILES['file_pendukung']['size'];
        $file_pendukung_ext = pathinfo($file_pendukung_name, PATHINFO_EXTENSION);
        $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);

        // File foto profil
        $profil_dir = "file_izin/"; // Ganti sesuai dengan nama folder yang Anda inginkan
        $profil_path = $profil_dir . $tb_pegawai_id_pegawai . "_" . $file_pendukung_name;

        // Check if file is uploaded
        if (empty($file_pendukung_name) || $file_pendukung_size == 0) {
            echo "<script>
                Swal.fire({
                    title: 'File Pendukung belum diunggah!',
                    text: 'Silakan pilih file pendukung',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
                </script>";
        } else {
            // Query untuk memasukkan data ke dalam tabel pegawai
            $sql_izin = "INSERT INTO tb_cuti_izin (tgl_range, jenis_cuti_izin, file_pendukung, keterangan, tb_pegawai_id_pegawai) 
            VALUES ('$tgl_range', '$jenis_cuti_izin', '$profil_path', '$keterangan', '$tb_pegawai_id_pegawai')";
            $query_izin = mysqli_query($conn, $sql_izin) or die(mysqli_error($conn));

            if ($query_izin) {
                // Pindahkan file foto profil ke lokasi penyimpanan
                if (move_uploaded_file($file_pendukung_tmp, $profil_path)) {
                    echo "<script>
                        Swal.fire({
                            title: 'Izin Berhasil Diajukan.',
                            text: 'FILE BERHASIL DI INPUT',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.value) {
                                window.location = 'index.php?hal=daftarizin_admin';
                            }
                        });
                        </script>";
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Izin Gagal Diajukan',
                            text: 'Silahkan coba lagi',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.value) {
                                window.location = 'index.php?hal=izin_admin';
                            }
                        });
                    </script>";
                }
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Izin Gagal Diajukan',
                        text: '',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.value) {
                            window.location = 'index.php?hal=izin_admin';
                        }
                    });
                </script>";
            }
        }
    }
}
?>
