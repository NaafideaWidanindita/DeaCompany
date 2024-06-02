<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
<link rel="stylesheet" href="dist/css/adminlte.min.css">
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .hapus {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            background-color: #f8f9fa; /* Set your background color */
        }

        .container {
            text-align: center;
            background-color: #ffffff; /* Set your container background color */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .delete-heading {
            font-size: 24px;
            font-weight: bold;
            color: #dc3545; /* Set your delete heading color */
            margin-bottom: 20px;
        }

        .checkbox {
            margin-bottom: 20px;
        }

        .checkbox label {
            display: block;
            color: #dc3545; /* Set your checkbox label color */
        }

        #confirmationCheckbox:invalid {
            border: 2px solid #dc3545; /* Set your border color for invalid checkbox */
        }

        .delete-button {
            background-color: #dc3545; /* Set your delete button background color */
            color: #ffffff; /* Set your delete button text color */
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #c82333; /* Set your delete button background color on hover */
        }
    </style>
</head>
<body>
    <div class="hapus">
        <div class="container">
            <p class="delete-heading"><b>HALAMAN HAPUS AKUN!</b></p>
            <div class="checkbox">
                <label>
                    <input type="checkbox" id="confirmationCheckbox" required> Apakah anda yakin ingin menghapus akun? <br>
                    setelah klik hapus maka semua data pada akun anda akan hilang
                </label>
            </div>
            <form id="deleteForm" action="" method="post">
                <button class="delete-button" name="delete_akun" id="delete_akun">DELETE AKUN</button>
                <input type="hidden" name="delete_akun" value="1">
            </form>
        </div>
    </div>

    <script>
        document.getElementById("deleteForm").addEventListener("submit", function (event) {
            var confirmationCheckbox = document.getElementById("confirmationCheckbox");

            if (!confirmationCheckbox.checked) {
                alert("Anda harus mencentang kotak konfirmasi untuk menghapus akun.");
                event.preventDefault(); // Prevent form submission
            }
        });
    </script>
</body>
</html>

<?php
include "koneksi.php";

if (isset($_POST['delete_akun'])) {
    $username = $_SESSION["ses_username"];
    $sql_data_pegawai = "SELECT * FROM tb_pegawai WHERE username = '$username'";
    $result_data_pegawai = mysqli_query($conn, $sql_data_pegawai);
    $row_data_pegawai = mysqli_fetch_assoc($result_data_pegawai);

    $id_pegawai = $row_data_pegawai['id_pegawai'];
    $sql_delete_izin_cuti = "DELETE FROM tb_cuti_izin WHERE tb_pegawai_id_pegawai = $id_pegawai";
    $sql_delete_absensi = "DELETE FROM tb_absensi WHERE tb_pegawai_id_pegawai = $id_pegawai";
    $sql_delete_gaji = "DELETE FROM tb_ambil_gaji WHERE tb_pegawai_id_pegawai = $id_pegawai";
    $sql_delete_pegawai = "DELETE FROM tb_pegawai WHERE id_pegawai = $id_pegawai";

    mysqli_begin_transaction($conn);
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

        // Setelah penghapusan berhasil, kirim respons ke JavaScript untuk menampilkan SweetAlert
        echo "<script>
            Swal.fire({
                title: 'Akun Berhasil Dihapus',
                text: '',
                icon: 'success'
            }).then(() => {
                window.location = 'login.php'; // Sesuaikan dengan halaman logout atau tindakan lainnya
            });
        </script>";
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
                    window.location = 'index.php?hal=dashboard'; // Sesuaikan dengan halaman logout atau tindakan lainnya
                });
            </script>";
    }
}

$conn->close();
?>
