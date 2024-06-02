<?php
include "koneksi.php";

// Fetch data from tb_pegawai and tb_gaji based on id_pegawai
$sql_fetch = "SELECT tb_pegawai.*, tb_gaji.gaji_bulan FROM tb_pegawai
              LEFT JOIN tb_gaji ON tb_pegawai.tb_gaji_id_gaji = tb_gaji.id_gaji
              WHERE tb_pegawai.tb_jabatan_id_jabatan = 2 ";
$result_fetch = mysqli_query($conn, $sql_fetch);

// Pagination
$itemsPerPage = 3; // Set the number of items per page
$totalItems = mysqli_num_rows($result_fetch); // Use mysqli_num_rows to get the total number of items
$totalPages = ceil($totalItems / $itemsPerPage);

// Determine the current page
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the offset to determine which data to retrieve
$offset = ($currentPage - 1) * $itemsPerPage;

// Fetch data for the current page
$sql_limit = $sql_fetch . " LIMIT $offset, $itemsPerPage";
$result = mysqli_query($conn, $sql_limit);
?>
<!-- Rest of your HTML and PHP code -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Gaji Pegawai</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <style>
    .pagination {
        display: flex;
        list-style: none;
        padding: 0;
    }

    .pagination a {
        display: block;
        padding: 8px 16px;
        margin: 4px;
        border: 1px solid #ffc107;
        text-decoration: none;
        color: #333;
        background-color: #ffc107;
        border-radius: 4px;
    }

    .pagination a:hover {
        background-color: #ffca28;
    }

    .pagination .active {
        background-color: #007bff;
        color: #fff;
    }
    </style>
</head>
<body>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rekap Gaji Pegawai</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Rekap Gaji Pegawai</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-yellow">
                    <div class="card-header">
                        <h3 class="card-title">Rekap Gaji Pegawai Yang Telah Diambil</h3>
                    </div>
                    
                    <div class="card-body">
                        <?php
                        // Table header
                        echo '<table class=" table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Pegawai</th>
                                        <th>Gaji Bulan</th>
                                        <th>Bulan</th>
                                        <th>Bank</th>
                                        <th>No Rekening</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>';

                        // Loop through the results and display data from tb_ambil_gaji
                        while ($row_data_pegawai = mysqli_fetch_assoc($result)) {
                            $id_pegawai = $row_data_pegawai['id_pegawai'];

                            $sql_data_gaji = "SELECT * FROM tb_ambil_gaji WHERE tb_pegawai_id_pegawai = '$id_pegawai'";
                            $result_data_gaji = $conn->query($sql_data_gaji);

                            if ($result_data_gaji->num_rows > 0) {
                                while ($row_data_gaji = $result_data_gaji->fetch_assoc()) {
                                    echo '<tr>
                                            <td>' . $row_data_pegawai['id_pegawai'] . '</td>
                                            <td>' . $row_data_pegawai['nama'] . '</td>
                                            <td>' . $row_data_pegawai['gaji_bulan'] . '</td>
                                            <td>' . $row_data_gaji['bulan'] . '</td>
                                            <td>' . $row_data_gaji['bank'] . '</td>
                                            <td>' . $row_data_gaji['no_rekening'] . '</td>
                                            <td>' . $row_data_gaji['status'] . '</td>
                                        </tr>';
                                }
                            } 
                        }
                        echo '</tbody></table>';
                        
                        ?>
                        <!-- Tampilkan nomor halaman di bawah data -->
                        <div class='pagination' style="margin-top: 10px;">
                            <?php
                            for ($i = 1; $i <= $totalPages; $i++) {
                                $queryParams = $_GET;
                                $queryParams['page'] = $i;
                                $queryString = http_build_query($queryParams);
                        
                                echo "<a href='?" . $queryString . "'>$i</a>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</body>
</html>
