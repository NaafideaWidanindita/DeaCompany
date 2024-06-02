<?php
include "koneksi.php";

if (isset($_GET['id_pegawai'])) {
    $id_pegawai = $_GET['id_pegawai'];
    $id_pegawai_from_session = $_SESSION['ses_id'];

    $sql_delete_izin_cuti = "DELETE FROM tb_cuti_izin WHERE tb_pegawai_id_pegawai = $id_pegawai";
    $sql_delete_absensi = "DELETE FROM tb_absensi WHERE tb_pegawai_id_pegawai = $id_pegawai";
    $sql_delete_gaji = "DELETE FROM tb_ambil_gaji WHERE tb_pegawai_id_pegawai = $id_pegawai";
    $sql_delete_pegawai = "DELETE FROM tb_pegawai WHERE id_pegawai = $id_pegawai";

    mysqli_begin_transaction($conn);
    // Periksa apakah $id_pegawai_from_url sama dengan yang disimpan dalam sesi
    if ($id_pegawai == $id_pegawai_from_session) {
        $deleteSuccess = true;

        // Delete tb_cuti_izin
        if (!mysqli_query($conn, $sql_delete_izin_cuti)) {
            $deleteSuccess = false;
        }
        // Delete tb_absensi
        if (!mysqli_query($conn, $sql_delete_absensi)) {
            $deleteSuccess = false;
        }
        // Delete tb_pegawai
        if (!mysqli_query($conn, $sql_delete_gaji)) {
            $deleteSuccess = false;
        }
        // Delete tb_pegawai
        if (!mysqli_query($conn, $sql_delete_pegawai)) {
            $deleteSuccess = false;
        }
        if ($deleteSuccess) {
            // Commit the transaction if all queries are successful
            mysqli_commit($conn);
            echo '<script>window.location = "login.php"</script>';
            exit();
        } else {
            // Jika ada kesalahan, rollback transaksi
            mysqli_rollback($conn);
            // Kirim respons ke JavaScript untuk menampilkan SweetAlert
            echo "<script>
                    Swal.fire({
                        title: 'Gagal Menghapus Akun',
                        text: 'Terjadi kesalahan saat menghapus akun',
                        icon: 'error'
                    }).then(() => {
                        window.location = 'index.php?hal=data_pegawai'; // Sesuaikan dengan halaman logout atau tindakan lainnya
                    });
                </script>";
        }
    }
    $deleteSuccess = true;
    // Delete tb_cuti_izin
    if (!mysqli_query($conn, $sql_delete_izin_cuti)) {
        $deleteSuccess = false;
    }
    // Delete tb_absensi
    if (!mysqli_query($conn, $sql_delete_absensi)) {
        $deleteSuccess = false;
    }
    // Delete tb_pegawai
    if (!mysqli_query($conn, $sql_delete_gaji)) {
        $deleteSuccess = false;
    }
    // Delete tb_pegawai
    if (!mysqli_query($conn, $sql_delete_pegawai)) {
        $deleteSuccess = false;
    }
    if ($deleteSuccess) {
        // Commit the transaction if all queries are successful
        mysqli_commit($conn);
        echo '<script>window.location = "index.php?hal=data_pegawai"</script>';
        exit();
    } else {
        // Jika ada kesalahan, rollback transaksi
        mysqli_rollback($conn);

        echo "<script>
                Swal.fire({
                    title: 'Gagal Menghapus Akun',
                    text: 'Terjadi kesalahan saat menghapus akun',
                    icon: 'error'
                }).then(() => {
                    window.location = 'index.php?hal=data_pegawai'; // Sesuaikan dengan halaman logout atau tindakan lainnya
                });
            </script>";
    }
}
?>
