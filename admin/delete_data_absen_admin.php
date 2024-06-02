<?php
include "koneksi.php";

if(isset($_GET['id_absensi']) && is_numeric($_GET['id_absensi'])) {
    $id_absensi = $_GET['id_absensi'];

    // Perform the deletion query
    $sql_delete = "DELETE FROM tb_absensi WHERE id_absensi = $id_absensi";
    $result_delete = mysqli_query($conn, $sql_delete);

    if ($result_delete) {
        // Redirect to the page where you display the list of absen admin
        echo '<script>window.location = "index.php?hal=data_absen_admin"</script>';
        exit();
    } else {
        "<script>
        Swal.fire({
            title: 'Gagal Menghapus Data',
            text: 'Terjadi kesalahan saat menghapus data',
            icon: 'error'
        }).then(() => {
            window.location = 'index.php?hal=data_absen_admin'; // Sesuaikan dengan halaman logout atau tindakan lainnya
        });
        </script>";
    }
} else {
    "<script>
        Swal.fire({
            title: 'Gagal Menghapus Data',
            text: 'Terjadi kesalahan saat menghapus data',
            icon: 'error'
        }).then(() => {
            window.location = 'index.php?hal=data_absen_admin'; // Sesuaikan dengan halaman logout atau tindakan lainnya
        });
    </script>";
}
?>
