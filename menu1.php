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
// Kueri SQL untuk mendapatkan nama jabatan
$sql = "SELECT nama_jabatan FROM tb_jabatan WHERE id_jabatan = $id_jabatan";


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
// Tutup koneksi ke database
$conn->close();
?>

<!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo $row_data_pegawai['foto']; ?>" class="img-circle elevation-2"alt="User Image" style="width: 35px;height: 35px;">
        </div>
        <div class="info">
          <a  class="d-block" style="font-size:16px;"><?php echo $row_data_pegawai['nama']; ?></a>
          <?php echo '<span class="badge btn-success ">' . $row['nama_jabatan'] . '</span>'; ?>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
      <?php
            // Struktur kendali IF untuk menentukan menu berdasarkan id_jabatan
            if ($row['nama_jabatan'] == 'Administrator') {
            ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="index.php?hal=dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa fa-user fa-lg"></i>
              <p>
                Profil Admin
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?hal=profil_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tampilkan Profil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?hal=edit_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Edit Profil</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Aktivitas</li>
          <li class="nav-item">
            <a href="index.php?hal=absen_admin" class="nav-link">
              <i class="nav-icon far fa-edit fa-lg"></i>
              <p>
              Absen Administrator
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Izin
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?hal=izin_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buat Izin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?hal=daftarizin_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Izin</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="index.php?hal=gaji_admin" class="nav-link">
            <i class="fas fa-arrow-down fa-dollar-sign nav-icon"></i>
              <p>
              Tarik Gaji
              </p>
            </a>
          </li>
          <li class="nav-header">Data Dokumen</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Data Pegawai
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?hal=data_pegawai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?hal=data_absen_pegawai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Absen Pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?hal=data_izin_pegawai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Izin Pegawai</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?hal=data_gaji_pegawai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Gaji Pegawai</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Data Admin
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?hal=data_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?hal=data_absen_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Absen Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?hal=data_izin_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Izin Admin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?hal=data_gaji_admin" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Gaji Admin</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Tentang</li>
          <li class="nav-item">
            <a href="index.php?hal=profil_perusahaan" class="nav-link">
              <i class="nav-icon fas fa-briefcase fa-lg"></i>
              <p>Profil Perusahaan</p>
            </a>
          </li>
          <li class="nav-header">Aksi</li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">LOGOUT</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?hal=delete_akun" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>DELETE AKUN</p>
            </a>
          </li>
        </ul>
        <?php
            } elseif ($row['nama_jabatan'] == 'Pegawai') {
        ?>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="index.php?hal=dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa fa-user fa-lg"></i>
              <p>
                Profil Pegawai
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?hal=profil_pegawai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tampilkan Profil</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?hal=edit_pegawai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Edit Profil</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">Aktivitas</li>
          <li class="nav-item">
            <a href="index.php?hal=absen_pegawai" class="nav-link">
              <i class="nav-icon far fa-edit fa-lg"></i>
              <p>
              Absen Pegawai
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Izin
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php?hal=izin_pegawai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buat Izin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="index.php?hal=daftarizin_pegawai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Daftar Izin</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="index.php?hal=gaji_pegawai" class="nav-link">
            <i class="fas fa-arrow-down fa-dollar-sign nav-icon"></i>
              <p>
              Tarik Gaji
              </p>
            </a>
          </li>
          <li class="nav-header">Tentang</li>
          <li class="nav-item">
            <a href="index.php?hal=profil_perusahaan" class="nav-link">
              <i class="nav-icon fas fa-briefcase fa-lg"></i>
              <p>Profil Perusahaan</p>
            </a>
          </li>
          <li class="nav-header">Aksi</li>
          <li class="nav-item">
            <a href="logout.php" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">LOGOUT</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="index.php?hal=delete_akun" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>DELETE AKUN</p>
            </a>
          </li>
        </ul>
        <?php
            }
            ?>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->