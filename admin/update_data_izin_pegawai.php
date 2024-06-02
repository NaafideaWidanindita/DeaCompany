<?php
include "koneksi.php";

if (isset($_GET['id_izin']) && !empty($_GET['id_izin'])) {
    $id_izin = $_GET['id_izin'];
    $sql_edit = "SELECT * FROM tb_cuti_izin WHERE id_cuti_izin = $id_izin";
    $result_edit = mysqli_query($conn, $sql_edit);

    if ($result_edit && mysqli_num_rows($result_edit) > 0) {
        $row_edit = mysqli_fetch_assoc($result_edit);
    } else {
        // Redirect or handle the case where no data is found
        header("Location: index.php?hal=data_izin_pegawai");
        exit();
    }
} else {
    // Redirect or handle the case where id_izin is not set or empty
    header("Location: index.php?hal=data_izin_pegawai");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Izin</title>
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
            <h1>Edit Izin Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Izin Pegawai</li>
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
                    <h3 class="card-title">Edit Izin</h3>
                </div>
                <form role="form" enctype="multipart/form-data" action="" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tgl_range">Rentang Tanggal:</label>
                            <input type="text" class="form-control" name="tgl_range" id="reservation" value="<?= $row_edit['tgl_range']; ?>" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jenis_cuti_izin">Jenis Izin </label>
                                    <input type="text" class="form-control" name="jenis_cuti_izin" id="jenis_cuti_izin" value="<?= $row_edit['jenis_cuti_izin']; ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="file_pendukung">File Pendukung</label>
                                    <input type="text" class="form-control" name="file_pendukung" value="<?= $row_edit['file_pendukung']; ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="box">
                            <label for="keterangan">Keterangan </label>
                            <textarea id="keterangan" name="keterangan" style="width: 100%; height: 30px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" readonly><?= $row_edit['keterangan']; ?></textarea>
                        </div>

                        <!-- Status hanya dapat diubah jika izin diajukan -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <?php
                            if ($row_edit['status'] == '') {
                                // Jika status Diajukan, tampilkan dropdown untuk mengubah status
                                ?>
                                <select class="form-control" name="status" id="status" required>
                                    <option value="">Pilih</option>
                                    <option value="Diterima" <?php echo ($row_edit['status'] == 'Diterima') ? 'selected' : ''; ?>>Diterima</option>
                                    <option value="Ditolak" <?php echo ($row_edit['status'] == 'Ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                                </select>
                            <?php } else {
                                // Jika status selain Diajukan, tampilkan label saja
                                echo '<input type="text" class="form-control" value="' . $row_edit['status'] . '" readonly>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-warning btn-block btn-flat" name="btnUpdate">
                            <b>Update</b>
                        </button>
                    </div>
                </form>
            </div>
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
</body>
</html>
<?php
// Check if the form is submitted
if (isset($_POST['btnUpdate'])) {
    // Check if status is empty (belum terisi)
    if (isset($row_edit['status']) && !empty($row_edit['status'])) {
        // Display SweetAlert notification that status is already filled
        echo "<script>
            Swal.fire({
                title: 'Status Sudah Terisi',
                text: 'Status sudah terisi dan tidak dapat diubah kembali.',
                icon: 'warning',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.value) {
                    window.location = 'index.php?hal=data_izin_pegawai';
                }
            });
        </script>";
    } else {
        $updatedStatus = $_POST['status'];
        // Update the status in the database
        $sql_update = "UPDATE tb_cuti_izin SET status = '$updatedStatus' WHERE id_cuti_izin = $id_izin";
        $result_update = mysqli_query($conn, $sql_update);
    
        // Check if the update was successful
        if ($result_update) {
            // Display SweetAlert notification for successful update
            echo "<script>
                Swal.fire({
                    title: 'Status Berhasil Diedit',
                    text: 'FILE BERHASIL DI EDIT',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'index.php?hal=data_izin_pegawai';
                    }
                });
            </script>";
        } else {
            // Display SweetAlert notification for update failure
            echo "<script>
                Swal.fire({
                    title: 'Gagal Mengedit Status.',
                    text: 'Terjadi kesalahan saat memperbarui status.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    }
    
}
?>
