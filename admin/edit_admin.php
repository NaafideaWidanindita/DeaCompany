<?php
include "koneksi.php";

$username = $_SESSION["ses_username"];
$sql_fetch = "SELECT * FROM tb_pegawai WHERE username = '$username'";
$result_fetch = mysqli_query($conn, $sql_fetch);
$row_data_pegawai = mysqli_fetch_assoc($result_fetch);

// Set nilai awal untuk setiap input
$nama = $row_data_pegawai['nama'];
$alamat = $row_data_pegawai['alamat'];
$no_telp = $row_data_pegawai['no_telp'];
$tgl_lahir = $row_data_pegawai['tgl_lahir'];
$jenis_kelamin = $row_data_pegawai['jenis_kelamin'];
$tgl_masuk = $row_data_pegawai['tgl_masuk'];
$username = $row_data_pegawai['username'];
$password = $row_data_pegawai['password'];
$tb_jabatan_id_jabatan = $row_data_pegawai['tb_jabatan_id_jabatan'];
$tb_departemen_id_departemen = $row_data_pegawai['tb_departemen_id_departemen'];
$foto_lama=$row_data_pegawai['foto'];

$id_pegawai=$row_data_pegawai['id_pegawai'];
?>

<?php
include "koneksi.php";
// ID jabatan dari $data_tb_jabatan_id_jabatan
$id_jabatan = $row_data_pegawai['tb_jabatan_id_jabatan']; 
$id_departemen = $row_data_pegawai['tb_departemen_id_departemen'];
$id_gaji = $row_data_pegawai['tb_gaji_id_gaji'];
// Kueri SQL untuk mendapatkan nama jabatan
$sql = "SELECT nama_jabatan FROM tb_jabatan WHERE id_jabatan = $id_jabatan";
$sql1 = "SELECT nama_departemen FROM tb_departemen WHERE id_departemen = $id_departemen";

// Eksekusi kueri
$result = $conn->query($sql);
// Periksa apakah kueri berhasil dieksekusi
if ($result) {
	// Ambil data hasil kueri
	$row = $result->fetch_assoc();
	$result->free();
} else {
	// Jika kueri gagal dieksekusi, tampilkan pesan kesalahan
	echo "Error: " . $sql . "<br>" . $conn->error;
}
$result1 = $conn->query($sql1);
// Periksa apakah kueri berhasil dieksekusi
if ($result1) {
	// Ambil data hasil kueri
	$row1 = $result1->fetch_assoc();
	$result1->free();
} else {
	// Jika kueri gagal dieksekusi, tampilkan pesan kesalahan
	echo "Error: " . $sql1 . "<br>" . $conn->error;
}

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
// Tutup koneksi ke database
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>
<body>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Profil Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Profil Data</li>
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
                <h3 class="card-title">Edit Profil Admin</h3>
              </div>
              <!-- form start -->
              <form role="form" enctype="multipart/form-data" onsubmit="return validateForm();" action="" method="post">
                <div class="card-body">
                  <div class="form-group">
                    <label for="id_pegawai">ID Admin </label>
                    <input type="text" class="form-control" id="id_pegawai" value="<?php echo $row_data_pegawai['id_pegawai']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama </label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row_data_pegawai['nama']; ?>" >
                  </div>
                  <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?php echo $row_data_pegawai['alamat']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="no_telp">Nomor Telpon</label>
                    <input type="text" class="form-control" id="no_telp" name="no_telp"  value="<?php echo $row_data_pegawai['no_telp']; ?>" >
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="tgl_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"  value="<?php echo $row_data_pegawai['tgl_lahir']; ?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                          <label for="jenis_kelamin">Jenis Kelamin</label>
                          <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                              <option value="">Pilih Jenis Kelamin</option>
                              <option value="Laki-laki" <?php if ($jenis_kelamin == 'Laki-laki') echo 'selected'; ?>>Laki-laki</option>
                              <option value="Perempuan" <?php if ($jenis_kelamin == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="tgl_masuk">Tanggal Masuk</label>
                    <input type="date" class="form-control" id="tgl_masuk" name="tgl_masuk"  value="<?php echo $row_data_pegawai['tgl_masuk']; ?>">
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="nama_jabatan">Jabatan</label>
                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan"  value="<?php echo $row['nama_jabatan']?>" readonly>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="nama_departemen">Departemen</label>
                        <input type="text" class="form-control" id="nama_departemen" name="nama_departemen"  value="<?php echo $row1['nama_departemen']?>" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gaji_bulan">Gaji</label>
                    <input type="text" class="form-control" id="gaji_bulan" name="gaji_bulan"  value="<?php echo $row_gaji['gaji_bulan']?>" readonly>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="username" class="form-control" id="username" name="username"  value="<?php echo $row_data_pegawai['username']; ?>">
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label>Password </label>
                        <input type="text" class="form-control" name="password" id="password"value="<?php echo $row_data_pegawai['password']; ?>" >
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Foto Admin</label>
                    <div class="col-sm-6">
                      <img src="<?php echo $row_data_pegawai['foto']; ?>" width="160px" />
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="profil">Ubah Foto</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="foto" name="profil" accept="image/*" onchange="updateFileNameLabel()" >
                        <label class="custom-file-label" for="profil">Choose file</label>
                      </div>
                    </div>
                    <p class="help-block">
                      <font color="red">Format file Jpg/Png</font> <br>
                      <font color="red">foto tidak wajib di ubah</font>
                    </p>
                  </div>

                  <div class="checkbox">
                    <label>
                        <input type="checkbox" id="confirmationCheckbox"> Apakah anda yakin ingin mengubah data?
                    </label>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-warning btn-block btn-flat" name="btnUpdate" title="Update Data">
                    <b>Update</b>
                </button>
              </div>
              </form>
            </div>
            <!-- /.card -->
      </div>
</section> 
</div>
<script>
    function validateForm() {
        var confirmationCheckbox = document.getElementById("confirmationCheckbox");

        if (!confirmationCheckbox.checked) {
            alert("Anda harus mencentang kotak konfirmasi untuk mengubah data.");
            return false; // Prevent form submission
        }
        return true;
    }
</script>
<script>
    function updateFileNameLabel() {
      var inputElement = document.getElementById('foto');
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
include "koneksi.php";
if (isset($_POST['btnUpdate'])) {
    // Mendapatkan nilai dari form
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
$no_telp = mysqli_real_escape_string($conn, $_POST['no_telp']);
$tgl_lahir = mysqli_real_escape_string($conn, $_POST['tgl_lahir']);
$jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
$tgl_masuk = mysqli_real_escape_string($conn, $_POST['tgl_masuk']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']); // Ini perlu dihash

// File foto profil
$profil_name = $_FILES['profil']['name'];
$profil_tmp = $_FILES['profil']['tmp_name'];
$profil_size = $_FILES['profil']['size'];
$profil_ext = pathinfo($profil_name, PATHINFO_EXTENSION);

$profil_dir = "foto/";
$profil_edit = $profil_dir . $nama . "_profil." . $profil_ext;


// Query untuk memperbarui data pegawai
if (!empty($profil_name)) {
    // Jika ada file foto yang diunggah
    $sql_update = "UPDATE tb_pegawai SET 
    nama = '$nama', 
    alamat = '$alamat', 
    no_telp = '$no_telp', 
    tgl_lahir = '$tgl_lahir', 
    jenis_kelamin = '$jenis_kelamin', 
    tgl_masuk = '$tgl_masuk', 
    username = '$username', 
    password = '$password', 
    foto = '$profil_edit' 
    WHERE id_pegawai = '$id_pegawai'";
} else {
    // Jika tidak ada file foto yang diunggah
    $sql_update = "UPDATE tb_pegawai SET 
    nama = '$nama', 
    alamat = '$alamat', 
    no_telp = '$no_telp', 
    tgl_lahir = '$tgl_lahir', 
    jenis_kelamin = '$jenis_kelamin', 
    tgl_masuk = '$tgl_masuk', 
    username = '$username', 
    password = '$password' 
    WHERE id_pegawai = '$id_pegawai'";
}
$query_update = mysqli_query($conn, $sql_update) or die(mysqli_error($conn));
if ($query_update) {
      // Cek apakah foto lama ada
      $foto_lama = $row_data_pegawai['foto']; // Sesuaikan dengan nama kolom di tabel Anda
      if (!empty($foto_lama) && file_exists($foto_lama)) {
          // Hapus foto lama dari folder
          unlink($foto_lama);
      }
    // Pindahkan file foto profil ke lokasi penyimpanan jika ada file yang diunggah
    if (!empty($profil_name) && move_uploaded_file($profil_tmp, $profil_edit)) {
      echo "<script>
          Swal.fire({
              title: 'Ubah Data Berhasil',
              text: 'DATA BERHASIL DIUBAH',
              icon: 'success',
              confirmButtonText: 'OK'
          }).then((result) => {
              if (result.value) {
                  window.location = 'index.php?hal=profil_pegawai';
              }
          });
      </script>";
  } else {
      echo "<script>
          Swal.fire({
              title: 'Data Berhasil Diubah',
              text: 'Namun, Anda tidak merubah foto',
              icon: 'warning',
              confirmButtonText: 'OK'
          }).then((result) => {
              if (result.value) {
                  window.location = 'index.php?hal=profil_pegawai';
              }
          });
      </script>";
  }
} else {
    echo "<script>
        Swal.fire({
            title: 'Ubah Data Gagal',
            text: '',
            icon: 'error',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.value) {
                window.location = 'index.php?hal=edit_pegawai';
            }
        });
    </script>";
}
}
?>

