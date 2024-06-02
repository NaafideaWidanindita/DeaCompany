<?php
date_default_timezone_set('Asia/Makassar');
include "koneksi.php";
$username = $_SESSION["ses_username"];
$sql_data_pegawai = "SELECT * FROM tb_pegawai WHERE username = '$username'";
$result_data_pegawai = mysqli_query($conn, $sql_data_pegawai);
$row_data_pegawai = mysqli_fetch_assoc($result_data_pegawai);

$tb_pegawai_id_pegawai = $row_data_pegawai["id_pegawai"];

function sudahAbsenMasuk($conn, $tb_pegawai_id_pegawai)
{
    $tgl_sekarang = date('Y-m-d');
    $sql = "SELECT * FROM tb_absensi WHERE tb_pegawai_id_pegawai = $tb_pegawai_id_pegawai AND tgl_absensi = '$tgl_sekarang'";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function sudahAbsenKeluar($conn, $tb_pegawai_id_pegawai)
{
    $tgl_sekarang = date('Y-m-d');
    $sql = "SELECT * FROM tb_absensi WHERE tb_pegawai_id_pegawai = $tb_pegawai_id_pegawai AND tgl_absensi = '$tgl_sekarang' AND jam_keluar IS NOT NULL";
    $result = mysqli_query($conn, $sql);
    return mysqli_num_rows($result) > 0;
}

function tambahAbsensi($conn, $tb_pegawai_id_pegawai, $keterangan)
{
    $tgl_sekarang = date('Y-m-d');
    $jam_sekarang = date('H:i:s');
    if ($keterangan === 'Absen keluar') {
        // Update jam_keluar dan keterangan saat Absen Keluar
        $sql = "UPDATE tb_absensi SET jam_keluar = '$jam_sekarang', keterangan = 'Absen Hadir' WHERE tb_pegawai_id_pegawai = $tb_pegawai_id_pegawai AND tgl_absensi = '$tgl_sekarang'";
    } else {
        // Insert data baru saat Absen Masuk
        $sql = "INSERT INTO tb_absensi (tgl_absensi, jam_masuk, tb_pegawai_id_pegawai, keterangan) VALUES ('$tgl_sekarang', '$jam_sekarang', $tb_pegawai_id_pegawai, 'Absen masuk')";
    }
    mysqli_query($conn, $sql);
}

function getDataAbsensiHariIni($conn, $tb_pegawai_id_pegawai)
{
    $tgl_sekarang = date('Y-m-d');
    $sql = "SELECT * FROM tb_absensi WHERE tb_pegawai_id_pegawai = $tb_pegawai_id_pegawai AND tgl_absensi = '$tgl_sekarang'";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}

// if (isset($_POST['btnMasuk'])) {
//     if (!sudahAbsenMasuk($conn, $tb_pegawai_id_pegawai)) {
//         tambahAbsensi($conn, $tb_pegawai_id_pegawai, 'Absen masuk');
//         echo "<script>window.location = 'index.php?hal=absen_admin';</script>";
//         exit();
//     } else {
//         echo "<script>
//         Swal.fire({
//           title: 'Info',
//           text: 'Anda sudah membuka absen hari ini.',
//           icon: 'info',
//           confirmButtonText: 'OK'
//         }).then(() => {
//           window.location = 'index.php?hal=absen_admin';
//         });
//       </script>";
//     }
// }

// if (isset($_POST['btnKeluar'])) {
//     if (!sudahAbsenKeluar($conn, $tb_pegawai_id_pegawai)) {
//         tambahAbsensi($conn, $tb_pegawai_id_pegawai, 'Absen keluar');
//         echo "<script>window.location = 'index.php?hal=absen_admin';</script>";
//         exit();
//     } else {
//         echo "<script>
//         Swal.fire({
//           title: 'Info',
//           text: 'Anda sudah menutup absen hari ini.',
//           icon: 'info',
//           confirmButtonText: 'OK'
//         }).then(() => {
//           window.location = 'index.php?hal=absen_admin';
//         });
//       </script>";
//     }
// }

// $dataAbsensiHariIni = getDataAbsensiHariIni($conn, $tb_pegawai_id_pegawai);

function isWithinTimeRange($startTime, $endTime)
{
    $currentTime = date('H:i:s');
    return ($currentTime >= $startTime && $currentTime <= $endTime);
}

// time ranges for Absen Masuk and Absen Keluar
$allowedAbsenMasukStartTime = '08:00:00';
$allowedAbsenMasukEndTime = '09:15:00';

if (isset($_POST['btnMasuk'])) {
    // Check time range for Absen Masuk
    if (!sudahAbsenMasuk($conn, $tb_pegawai_id_pegawai) && isWithinTimeRange($allowedAbsenMasukStartTime, $allowedAbsenMasukEndTime)) {
        tambahAbsensi($conn, $tb_pegawai_id_pegawai, 'Absen masuk');
        echo "<script>window.location = 'index.php?hal=absen_pegawai';</script>";
        exit();
    } elseif (sudahAbsenMasuk($conn, $tb_pegawai_id_pegawai)) {
        echo "<script>
        Swal.fire({
          title: 'Info',
          text: 'Anda sudah melakukan Absen Masuk hari ini.',
          icon: 'info',
          confirmButtonText: 'OK'
        }).then(() => {
          window.location = 'index.php?hal=absen_pegawai';
        });
      </script>";
    } else {
        echo "<script>
        Swal.fire({
          title: 'Info',
          text: 'Absen Masuk belum dibuka atau sudah ditutup.',
          icon: 'info',
          confirmButtonText: 'OK'
        }).then(() => {
          window.location = 'index.php?hal=absen_pegawai';
        });
      </script>";
    }
}

$allowedAbsenKeluarStartTime = '16:00:00';
$allowedAbsenKeluarEndTime = '17:15:00';

if (isset($_POST['btnKeluar'])) {
    // Check time range for Absen Keluar
    if (!sudahAbsenKeluar($conn, $tb_pegawai_id_pegawai) && isWithinTimeRange($allowedAbsenKeluarStartTime, $allowedAbsenKeluarEndTime)) {
        tambahAbsensi($conn, $tb_pegawai_id_pegawai, 'Absen keluar');
        echo "<script>window.location = 'index.php?hal=absen_pegawai';</script>";
        exit();
    } elseif (sudahAbsenKeluar($conn, $tb_pegawai_id_pegawai)) {
        echo "<script>
        Swal.fire({
          title: 'Info',
          text: 'Anda sudah melakukan Absen Keluar hari ini.',
          icon: 'info',
          confirmButtonText: 'OK'
        }).then(() => {
          window.location = 'index.php?hal=absen_pegawai';
        });
      </script>";
    } else {
        echo "<script>
        Swal.fire({
          title: 'Info',
          text: 'Absen Keluar belum dibuka atau sudah ditutup.',
          icon: 'info',
          confirmButtonText: 'OK'
        }).then(() => {
          window.location = 'index.php?hal=absen_pegawai';
        });
      </script>";
    }
}

$dataAbsensiHariIni = getDataAbsensiHariIni($conn, $tb_pegawai_id_pegawai);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/fullcalendar.css" />
    <script src="path/to/fullcalendar.js"></script>
    <script src="path/to/custom.js"></script>
    <title>Absen Admin</title>
</head>

<body>
<section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Absen Admin</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Absen Admin</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
        <section class="content">
            <div class="row">
            <div class="col-md-6">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">ABSENSI ADMINISTRATOR</h3>
                    </div>
                    <div class="card-body">
                        <center>
                         <p><?php echo date('l, Y-m-d'); ?></p>
                        </center>
                        <table class="table">
                            <tbody>
                                <?php
                                if ($dataAbsensiHariIni) {
                                    echo "<tr><td>Tanggal Absensi</td><td>" . $dataAbsensiHariIni['tgl_absensi'] . "</td></tr>";
                                    echo "<tr><td>Jam Masuk</td><td>" . $dataAbsensiHariIni['jam_masuk'] . "</td></tr>";
                                    echo "<tr><td>Jam Keluar</td><td>" . $dataAbsensiHariIni['jam_keluar'] . "</td></tr>";
                                    echo "<tr><td>Keterangan</td><td>" . $dataAbsensiHariIni['keterangan'] . "</td></tr>";
                                } else {
                                    echo "<tr><td>Tanggal Absensi</td><td></td></tr>";
                                    echo "<tr><td>Jam Masuk</td><td></td></tr>";
                                    echo "<tr><td>Jam Keluar</td><td></td></tr>";
                                    echo "<tr><td>Keterangan</td><td></td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <hr>
                        <center>
                            <form method="post">
                                <button type="submit" name="btnMasuk" class="btn btn-success">Absen Masuk</button>
                                <button type="submit" name="btnKeluar" class="btn btn-danger">Absen Keluar</button>
                            </form>
                        </center>
                    </div>
                </div>
            </div>

                <div class="col-md-6">
                <div class="container-fluid">
                    <div class="row">
                    <section class="col-lg-12">
                        <div class="card bg-gradient-success">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                            <i class="far fa-calendar-alt"></i>
                            Calendar
                            </h3>
                            <div class="card-tools">
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div>
                        <div class="row">
                            <div class="col-4 text-center">
                                <div id="sparkline-1"></div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-2"></div>
                            </div>
                            <!-- ./col -->
                            <div class="col-4 text-center">
                                <div id="sparkline-3"></div>
                            </div>
                            </div>
                        </div>
                    </section>
                    </div>
                </div>
        </div>
        </section>
    <script src="path/to/your/js/file.js"></script>
    
</body>
</html>
