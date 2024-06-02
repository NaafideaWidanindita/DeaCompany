<?php
session_start();
    if (isset($_SESSION["ses_username"])==""){
	header("location: login.php");
    
    }else{
      include "koneksi.php";
      $username = $_SESSION["ses_username"];
      $sql_data_pegawai = "SELECT * FROM tb_pegawai WHERE username = '$username'";
      $result_data_pegawai = mysqli_query($conn, $sql_data_pegawai);
      $row_data_pegawai = mysqli_fetch_assoc($result_data_pegawai);
    }
include "koneksi.php";

$sql = $conn->query("SELECT * from tb_perusahaan");
while ($data= $sql->fetch_assoc()) {

$nama_perusahaan=$data['nama_perusahaan'];
}
?>
<?php
include "koneksi.php";
$id_jabatan = $row_data_pegawai['tb_jabatan_id_jabatan']; 
$id_departemen =  $row_data_pegawai['tb_departemen_id_departemen'];
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
// Tutup koneksi ke database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
<?php
include "preloader.php";
?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-yellow navbar-light text-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

    <li class="dropdown user user-menu">
        <a class="nav-link" data-toggle="dropdown" href="#">
            <img src="<?php echo $row_data_pegawai['foto']; ?>" class="user-image elevation-2" alt="User Image">
            <span class="hidden-xs"><?php echo $row_data_pegawai['nama']; ?></span>
        </a>
        <ul class="dropdown-menu">
            <li class="user-header navbar-yellow">
                <img src="<?php echo $row_data_pegawai['foto']; ?>" class="img-circle" alt="User Image"> <br>
                
                <p>
                    <?php echo '<span>' . $row['nama_jabatan'] . '</span>'; ?>
                    <?php echo  '<span> ~ </span>' ; ?>
                    <?php echo '<span>'. $row1['nama_departemen'] . '</span>'; ?>
                    <small>Member since <?php echo $row_data_pegawai['tgl_masuk']; ?></small>
                </p>
            </li>
            <li class="user-footer d-flex justify-content-between align-items-center border border-white p-3">
                <div>
                    <a href="index.php?hal=profil_pegawai" class="btn btn-primary btn-flat">Profile</a>
                </div>
                <div class="ml-auto">
                    <a href="logout.php" class="btn btn-danger btn-flat">Logout</a>
                </div>
            </li>
        </ul>
    </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
<?php
include "logo.php";
?>

<?php 
include "menu1.php";
?>
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

  <?php
if (isset($_GET['hal'])) {
    //Data Admin
    if ($_GET['hal']=='profil_admin') { include "admin/profil_admin.php";}
    elseif ($_GET['hal']=='print_admin') { include "admin/print_admin.php";} 
    elseif ($_GET['hal']=='edit_admin') { include "admin/edit_admin.php";}
    elseif ($_GET['hal']=='absen_admin') { include "admin/absen_admin.php";}
    elseif ($_GET['hal']=='izin_admin') { include "admin/izin_admin.php";}
    elseif ($_GET['hal']=='gaji_admin') { include "admin/gaji_admin.php";}
    elseif ($_GET['hal']=='daftarizin_admin') { include "admin/daftarizin_admin.php";}

    elseif ($_GET['hal']=='data_pegawai') { include "admin/data_pegawai.php";}
    elseif ($_GET['hal']=='data_absen_pegawai') { include "admin/data_absen_pegawai.php";}
    elseif ($_GET['hal']=='data_izin_pegawai') { include "admin/data_izin_pegawai.php";}
    elseif ($_GET['hal']=='data_gaji_pegawai') { include "admin/data_gaji_pegawai.php";}
    elseif ($_GET['hal']=='data_izin_delete') { include "admin/data_izin_delete.php";}
    elseif ($_GET['hal']=='update_data_izin_pegawai') { include "admin/update_data_izin_pegawai.php";}
    elseif ($_GET['hal']=='update_data_absen_pegawai') { include "admin/update_data_absen_pegawai.php";}
    elseif ($_GET['hal']=='delete_data_absen_pegawai') { include "admin/delete_data_absen_pegawai.php";}

    elseif ($_GET['hal']=='data_admin') { include "admin/data_admin.php";}
    elseif ($_GET['hal']=='data_gaji_admin') { include "admin/data_gaji_admin.php";}
    elseif ($_GET['hal']=='data_absen_admin') { include "admin/data_absen_admin.php";}
    elseif ($_GET['hal']=='data_izin_admin') { include "admin/data_izin_admin.php";}
    elseif ($_GET['hal']=='data_izin_deleteadmin') { include "admin/data_izin_deleteadmin.php";}
    elseif ($_GET['hal']=='update_data_izin_admin') { include "admin/update_data_izin_admin.php";}
    elseif ($_GET['hal']=='update_data_absen_admin') { include "admin/update_data_absen_admin.php";}
    elseif ($_GET['hal']=='delete_data_absen_admin') { include "admin/delete_data_absen_admin.php";}
    
    elseif ($_GET['hal']=='data_pegawaiadmin_delete') { include "admin/data_pegawaiadmin_delete.php";}


    // Data Pegawai
    elseif ($_GET['hal']=='dashboard') { include "dashboard.php";}
    elseif ($_GET['hal']=='profil_pegawai') { include "pegawai/profil_pegawai.php";}
    elseif ($_GET['hal']=='absen_pegawai') { include "pegawai/absen_pegawai.php";}
    elseif ($_GET['hal']=='izin_pegawai') { include "pegawai/izin_pegawai.php";}
    elseif ($_GET['hal']=='edit_pegawai') { include "pegawai/edit_pegawai.php";}
    elseif ($_GET['hal']=='gaji_pegawai') { include "pegawai/gaji_pegawai.php";}
    elseif ($_GET['hal']=='daftarizin_pegawai') { include "pegawai/daftarizin_pegawai.php";}


    elseif ($_GET['hal']=='delete_akun') { include "delete_akun.php";}

    elseif ($_GET['hal']=='profil_perusahaan') { include "perusahaan/profil_perusahaan.php";}
    else {
    include "dashboard.php";
  }
} else {
  include "dashboard.php";
}
  ?>
  </div>
<?php
include "footer.php";
?>
</body>
</html>
