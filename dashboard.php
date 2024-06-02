<?php
include "koneksi.php";
$username = $_SESSION["ses_username"];
$sql_data_pegawai = "SELECT * FROM tb_pegawai WHERE username = '$username'";
$result_data_pegawai = mysqli_query($conn, $sql_data_pegawai);
$row_data_pegawai = mysqli_fetch_assoc($result_data_pegawai);

$tb_jabatan_id_jabatan = $row_data_pegawai["tb_jabatan_id_jabatan"];
?>

<section class="content">
    <div class="container-fluid">
        <?php
        // Check the user's role and display content accordingly
        if ($tb_jabatan_id_jabatan == 1) {
            include 'dashboard_admin.php'; // File untuk jabatan 1 (Admin)
        } elseif ($tb_jabatan_id_jabatan == 2) {
            include 'dashboard_pegawai.php'; // File untuk jabatan 2 (Manager)
        }
        ?>
    </div><!-- /.container-fluid -->
</section>