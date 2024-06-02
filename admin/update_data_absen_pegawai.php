<?php
include "koneksi.php";

if (isset($_GET['id_absensi']) && !empty($_GET['id_absensi'])) {
    $id_absensi = $_GET['id_absensi'];
    $sql_edit = "SELECT a.*, p.nama FROM tb_absensi a
                 INNER JOIN tb_pegawai p ON a.tb_pegawai_id_pegawai = p.id_pegawai
                 WHERE a.id_absensi = $id_absensi";
    $result_edit = mysqli_query($conn, $sql_edit);

    if ($result_edit && mysqli_num_rows($result_edit) > 0) {
        $row_edit = mysqli_fetch_assoc($result_edit);
    } else {
        // Redirect or handle the case where no data is found
        header("Location: index.php?hal=data_absensi");
        exit();
    }
} else {
    // Redirect or handle the case where id_absensi is not set or empty
    header("Location: index.php?hal=data_absensi");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Your CSS styles and other head elements go here -->

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Absensi Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Absensi Pegawai</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
            <div class="card card-yellow">
              <div class="card-header">
                <h3 class="card-title">Edit Absensi Pegawai</h3>
              </div>
                <form action="" method="post">
                  <div class="card-body">
                    <div class="form-group">
                        <label for="tb_pegawai_id_pegawai">ID Pegawai:</label>
                        <input type="text" class="form-control" name="tb_pegawai_id_pegawai" id="tb_pegawai_id_pegawai" value="<?= $row_edit['tb_pegawai_id_pegawai']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Pegawai:</label>
                        <input type="text" class="form-control" name="nama" id="nama" value="<?= $row_edit['nama']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tgl_absensi">Tanggal Absensi:</label>
                        <input type="date" class="form-control" name="tgl_absensi" id="tgl_absensi" value="<?= $row_edit['tgl_absensi']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_masuk">Jam Masuk:</label>
                        <input type="time" class="form-control" name="jam_masuk" id="jam_masuk" value="<?= $row_edit['jam_masuk']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_keluar">Jam Keluar:</label>
                        <input type="time" class="form-control" name="jam_keluar" id="jam_keluar" value="<?= $row_edit['jam_keluar']; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan:</label>
                        <textarea class="form-control" name="keterangan" id="keterangan" rows="3"><?= $row_edit['keterangan']; ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btnUpdate">Update</button>
                </form>
              </div>
        </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    </div>

    <!-- Your JavaScript files and other scripts go here -->

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Check if the form is submitted
if (isset($_POST['btnUpdate'])) {
    // Get the updated data from the form
    $tgl_absensi = $_POST['tgl_absensi'];
    $jam_masuk = $_POST['jam_masuk'];
    $jam_keluar = $_POST['jam_keluar'];
    $keterangan = $_POST['keterangan'];
    $tb_pegawai_id_pegawai = $_POST['tb_pegawai_id_pegawai'];

    // Update the data in the database
    $sql_update = "UPDATE tb_absensi SET tgl_absensi = '$tgl_absensi', jam_masuk = '$jam_masuk', jam_keluar = '$jam_keluar', keterangan = '$keterangan' WHERE id_absensi = $id_absensi";
    $result_update = mysqli_query($conn, $sql_update);

    // Check if the update was successful
    if ($result_update) {
        // Redirect using JavaScript
        echo '<script>window.location.href = "index.php?hal=data_absen_pegawai";</script>';
        exit();
    } else {
        // Display an error message
        echo "Error updating record: " . mysqli_error($conn);
    }
    
}
?>
