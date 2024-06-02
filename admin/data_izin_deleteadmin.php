<?php
include "koneksi.php";
if (isset($_GET['id_izin'])) {
  // Dapatkan id_cuti_izin dari URL
  $id_cuti_izin = $_GET['id_izin'];

  // Query untuk menampilkan data yang akan dihapus (gunakan untuk debug)
  $sql_select = "SELECT * FROM tb_cuti_izin WHERE id_cuti_izin = $id_cuti_izin";
  $result_select = mysqli_query($conn, $sql_select);

  // Query untuk menghapus data dari tb_cuti_izin berdasarkan id_cuti_izin
  $sql_delete_izin = "DELETE FROM tb_cuti_izin WHERE id_cuti_izin = $id_cuti_izin";

  // Eksekusi query
  if (mysqli_query($conn, $sql_delete_izin)) {
      // Redirect kembali ke halaman daftar izin setelah menghapus
      echo '<script>window.location = "index.php?hal=data_izin_admin"</script>';
      exit();
  } else {
      echo "Error: " . mysqli_error($conn); // Pesan ini akan muncul jika terjadi kesalahan
  }
}
?>