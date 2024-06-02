<?php
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Registrasi | SI Registrasi</title>
    <link rel="icon" href="dist/img/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body class="hold-transition login-page" style="background-color: #da9c39;">
    <div class="login-box">
        <div style="margin-top:10px; margin-bottom:20px;">
            <div style="background-color: #faf4e6;width: 400px; border-radius: 10px; " class="card-body login-card-body">
                <center>
                    <img src="dist/img/logo.png" width=180px />
                    <br><br>
                </center>
                <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()" id="registrationForm">
                    <label for="nama">Nama <span id="namaError" class="text-danger" style="font-size: smaller; font-weight: normal;"></span></label> 
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama">
                    </div>

                    <label for="alamat">Alamat <span id="alamatError" class="text-danger" style="font-size: smaller; font-weight: normal;"></span></label> 
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat">
                    </div>

                    <label for="no_telp">Nomor Telepon <span id="noTelpError" class="text-danger" style="font-size: smaller; font-weight: normal;"></span></label> 
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="Nomor Telepon">
                    </div>

                    <div class="row">
                        <div class="col-6">
                        <label for="tgl_lahir">Tanggal Lahir <span id="tglLahirError" class="text-danger" style="font-size: smaller; font-weight: normal;"></span></label> 
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" name="tgl_lahir" id="tgl_lahir" placeholder="Tanggal Lahir">
                            </div>
                        </div>
                        <div class="col-6">
                        <label for="jenis_kelamin">Jenis Kelamin <span id="jenisKelaminError" class="text-danger" style="font-size: smaller; font-weight: normal;"></span></label>
                            <div class="input-group mb-3">
                                <select class="form-control" name="jenis_kelamin" id="jenis_kelamin">
                                    <option value="">Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                    </div>
                
                    <label for="tgl_masuk">Tanggal Masuk <span id="tglMasukError" class="text-danger" style="font-size: smaller; font-weight: normal;"></span></label>
                    <div class="input-group mb-3">
                        <input type="date" class="form-control" name="tgl_masuk" id="tgl_masuk" placeholder="Tanggal Masuk">
                    </div>

                    <label for="jabatan">Jabatan <span id="jabatanError" class="text-danger" style="font-size: smaller; font-weight: normal;"></span></label>
                    <div class="input-group mb-3">
                        <select class="form-control" name="tb_jabatan_id_jabatan" id="jabatan" onchange="updateSalaryOptions()">
                            <option value="">Pilih Jabatan</option>
                            <?php
                            $sql_jabatan = "SELECT * FROM tb_jabatan";
                            $result_jabatan = mysqli_query($conn, $sql_jabatan);
                            while ($row_jabatan = mysqli_fetch_assoc($result_jabatan)) {
                                echo "<option value='" . $row_jabatan['id_jabatan'] . "'>" . $row_jabatan['nama_jabatan'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <label for="departemen">Departemen <span id="departemenError" class="text-danger" style="font-size: smaller; font-weight: normal;"></span></label>
                    <div class="input-group mb-3">
                        <select class="form-control" name="tb_departemen_id_departemen" id="departemen">
                            <option value="">Pilih Departemen</option>
                            <?php
                            // Fetch departments from the database
                            $sql_departemen = "SELECT * FROM tb_departemen";
                            $result_departemen = mysqli_query($conn, $sql_departemen);
                            while ($row_departemen = mysqli_fetch_assoc($result_departemen)) {
                                echo "<option value='" . $row_departemen['id_departemen'] . "'>" . $row_departemen['nama_departemen'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label for="username">Buat Username <span id="usernameError" class="text-danger" style="font-size: smaller; font-weight: normal;"></span></label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="username" id="username" placeholder="Buat Username">
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="password">Buat Password <span class="text-danger" id="passwordError" style="font-size: smaller; font-weight: normal;"></span></label>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="password" id="password" placeholder="Buat Password">
                            </div>
                        </div>
                    </div>

                    <label for="profil">Foto <span class="text-danger" id="fotoError" style="font-size: smaller; font-weight: normal;"></span></label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="foto" name="profil" accept="image/*" onchange="updateFileName()">
                            <label class="custom-file-label" for="foto" id="fotoLabel">Pilih Foto</label>
                        </div>
                    </div>  
                       
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block btn-flat" name="btnRegister" title="Daftar Akun">
                                <b>Daftar</b>
                            </button>
                            <center><a href="login.php" style="font-size: smaller;">Sudah Punya Akun?</a></center>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.min.js"></script>
    <script src="plugins/alert.js"></script>
    
    <script>
    function updateFileName() {
        var fileName = document.getElementById("foto").files[0].name;
        document.getElementById("fotoLabel").innerHTML = fileName;
    }
    </script>
<script>

function validateForm() {
    var isValid = true;

    // Reset error messages
    $(".text-danger").html("");


    if ($("#nama").val() === "") {
        $("#namaError").html("  *Nama harus diisi");
        isValid = false;
    }

    if ($("#alamat").val() === "") {
        $("#alamatError").html("  *Alamat harus diisi");
        isValid = false;
    }

    if ($("#no_telp").val() === "") {
        $("#noTelpError").html("  *Nomor Telepon harus diisi");
        isValid = false;
    } else {
    var phoneNumber = $("#no_telp").val();
    // Validasi nomor telepon harus berupa angka dan tidak lebih dari 13 digit
    if (!/^\d{12,13}$/.test(phoneNumber)) {
        $("#noTelpError").html("  *Nomor Telepon Tidak Valid");
        isValid = false;
    }
    }

    if ($("#tgl_lahir").val() === "") {
        $("#tglLahirError").html("  *Harus diisi");
        isValid = false;
    }

    if ($("#jenis_kelamin").val() === "") {
        $("#jenisKelaminError").html("  *Wajib pilih");
        isValid = false;
    }

    if ($("#tgl_masuk").val() === "") {
        $("#tglMasukError").html("  *Tanggal Masuk harus diisi");
        isValid = false;
    }

    if ($("#jabatan").val() === "") {
        $("#jabatanError").html("  *Jabatan harus dipilih");
        isValid = false;
    }

    if ($("#departemen").val() === "") {
        $("#departemenError").html("  *Departemen harus dipilih");
        isValid = false;
    }

    if ($("#username").val() === "") {
        $("#usernameError").html("  *Kosong");
        isValid = false;
    }

    if ($("#password").val() === "") {
        $("#passwordError").html("  *Kosong");
        isValid = false;
    }
    // Validasi untuk foto
    var fotoInput = $("#foto");
    var fotoFileName = fotoInput.val();
    if (fotoFileName === "") {
        $("#fotoError").html("  *Foto harus diisi");
        isValid = false;
    }
    return isValid;

}
</script>
<script>
document.getElementById('btnSubmit').addEventListener('click', function (event) {
    if (!validateForm()) {
        event.preventDefault(); // Cegah pengiriman formulir jika tidak valid
    }
});
</script>

</body>

</html>
<?php
include "koneksi.php";

if (isset($_POST['btnRegister'])) {
    // Mendapatkan nilai dari form
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $no_telp = mysqli_real_escape_string($conn, $_POST['no_telp']);
    
    // Validasi Tanggal Lahir
    $tgl_lahir = isset($_POST['tgl_lahir']) ? mysqli_real_escape_string($conn, $_POST['tgl_lahir']) : '';
    if (empty($tgl_lahir)) {
        exit();
    }

    $jenis_kelamin = mysqli_real_escape_string($conn, $_POST['jenis_kelamin']);
    $tgl_masuk = mysqli_real_escape_string($conn, $_POST['tgl_masuk']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $tb_jabatan_id_jabatan = mysqli_real_escape_string($conn, $_POST['tb_jabatan_id_jabatan']);
    $tb_departemen_id_departemen = mysqli_real_escape_string($conn, $_POST['tb_departemen_id_departemen']);
    $tb_gaji_id_gaji = 0; // Default value jika tidak ada id_gaji yang sesuai
    $mapping_gaji = array(
        '1' => '1', // id_gaji untuk id_jabatan = 1
        '2' => '2', // id_gaji untuk id_jabatan = 2
    );

    if (isset($mapping_gaji[$tb_jabatan_id_jabatan])) {
        $tb_gaji_id_gaji = $mapping_gaji[$tb_jabatan_id_jabatan];
    }

    // Fetch data gaji dari tabel tb_gaji
    $gaji_bulan = '';
    $sql_gaji = "SELECT gaji_bulan FROM tb_gaji WHERE id_gaji = ?";
    $stmt = $conn->prepare($sql_gaji);
    $stmt->bind_param("i", $tb_gaji_id_gaji);
    $stmt->execute();
    $stmt->bind_result($gaji_bulan);
    $stmt->fetch();
    $stmt->close();

    // File foto profil
    $profil_name = $_FILES['profil']['name'];
    $profil_tmp = $_FILES['profil']['tmp_name'];
    $profil_size = $_FILES['profil']['size'];
    $profil_ext = pathinfo($profil_name, PATHINFO_EXTENSION);

    $profil_dir = "foto/";  // Ganti sesuai dengan nama folder yang Anda inginkan
    $profil_path = $profil_dir . $nama . "_profil." . $profil_ext;

    // Query untuk memasukkan data ke dalam tabel pegawai
    $sql_register = "INSERT INTO tb_pegawai (nama, alamat, no_telp, tgl_lahir, jenis_kelamin, tgl_masuk, username, password, tb_jabatan_id_jabatan, tb_departemen_id_departemen, tb_gaji_id_gaji, foto) VALUES ('$nama', '$alamat', '$no_telp', '$tgl_lahir', '$jenis_kelamin', '$tgl_masuk', '$username', '$password', '$tb_jabatan_id_jabatan', '$tb_departemen_id_departemen', '$tb_gaji_id_gaji', '$profil_path')";
    
    // Eksekusi query
    $query_register = mysqli_query($conn, $sql_register) or die(mysqli_error($conn));
    
    if ($query_register) {
        // Pindahkan file foto profil ke lokasi penyimpanan
        if (move_uploaded_file($profil_tmp, $profil_path)) {
            echo "<script>
                Swal.fire({
                    title: 'Berhasil Ditambahkan',
                    html: 'Akun berhasil ditambahkan. Silakan login.<br>Gaji Bulanan Anda: $gaji_bulan',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.value) {
                        window.location = 'login.php';
                    }
                });
            </script>";
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Gagal Unggah Foto Profil',
                    text: 'Gagal mengunggah foto profil. Silakan coba lagi.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }        
    } else {
        echo "<script>
            Swal.fire({
                title: 'Registrasi Gagal',
                text: 'Registrasi gagal. Silakan coba lagi.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        </script>";
    }
}
?>
