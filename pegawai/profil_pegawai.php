<?php
include "koneksi.php";
?>
<?php
  // Ambil data pegawai dari sesi
  $username = $_SESSION["ses_username"];
  $sql_data_pegawai = "SELECT * FROM tb_pegawai WHERE username = '$username'";
  $result_data_pegawai = mysqli_query($conn, $sql_data_pegawai);
  $row_data_pegawai = mysqli_fetch_assoc($result_data_pegawai);
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pegawai</title>
    <link rel="stylesheet" href="path/to/bootstrap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha256-jUc24M/IMxmEn8+Ay6F3k5V7sxtLFu80F+fy9B9eBpk=" crossorigin="anonymous" />
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Include your CSS files or stylesheets here -->
    <style>
        .list-group-item {
            position: relative;
        }

        .separator {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>

<body >
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile Pegawai</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
            <div class="card card-warning card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                    <img src="<?php echo $row_data_pegawai['foto']; ?>" class="profile-user-img img-responsive img-circle" style="height:100px; width:100px;" alt="profil">
                </div>
                <h3 class="profile-username text-center"><?php echo $row_data_pegawai['nama']; ?></h3>
                <p class="text-muted text-center"><?php echo $row['nama_jabatan'] . '<span> ~ </span>'. $row1['nama_departemen']; ?></p>
                <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>ID Pegawai</b> <b class="separator">:</b> <a class="float-right"><?php echo $row_data_pegawai['id_pegawai']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Nama </b> <b class="separator">:</b> <a class="float-right"><?php echo $row_data_pegawai['nama']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Alamat</b> <b class="separator">:</b> <a class="float-right"><?php echo $row_data_pegawai['alamat']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>No Telpon</b> <b class="separator">:</b> <a class="float-right"><?php echo $row_data_pegawai['no_telp']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Tanggal Lahir</b> <b class="separator">:</b> <a class="float-right"><?php echo $row_data_pegawai['tgl_lahir']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jenis Kelamin</b> <b class="separator">:</b> <a class="float-right"><?php echo $row_data_pegawai['jenis_kelamin']; ?></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul  class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <b>Tanggal Masuk</b> <b class="separator">:</b> <a class="float-right"><?php echo $row_data_pegawai['tgl_masuk']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Jabatan</b><b class="separator">:</b> <a class="float-right"><?php echo $row['nama_jabatan']?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Departemen</b> <b class="separator">:</b> <a class="float-right"><?php echo $row1['nama_departemen']?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Gaji</b> <b class="separator">:</b> <a class="float-right"><?php echo $row_gaji['gaji_bulan']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Username</b> <b class="separator">:</b> <a class="float-right"><?php echo $row_data_pegawai['username']; ?></a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Password</b> <b class="separator">:</b> <a class="float-right"><?php echo $row_data_pegawai['password']; ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
              </div>
        </div>

    </section>
<script src="path/to/your/js/file.js"></script>
</body>

</html>











