<?php
// Start the session if not already started
session_start();

require('library/fpdf.php');
include 'koneksi.php';

// Check if the session variable is set
if (isset($_SESSION["ses_id"])) {
    // Retrieve the pegawai ID from the session
    $tb_pegawai_id_pegawai = $_SESSION["ses_id"];

    $sql = "SELECT nama FROM tb_pegawai WHERE id_pegawai = $tb_pegawai_id_pegawai";
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
    date_default_timezone_set('Asia/Makassar');
    // Instantiate FPDF and set page settings
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();

    // Set font and add title
    $pdf->SetFont('Times', 'B', 13);
    $pdf->Cell(200, 10, 'DAFTAR IZIN PEGAWAI', 0, 0, 'C');

    // Add some spacing
    $pdf->Cell(10, 15, '', 0, 1);

    // Set font for additional information
    $pdf->SetFont('Times', '', 10);
        // Print additional information with fixed width
        $pdf->Cell(30, 7, 'Tanggal Cetak', 0, 0, 'L');
        $pdf->Cell(30, 7, ': '.date('Y-m-d'), 0, 1, 'L');
        $pdf->Cell(30, 7, 'Jam Cetak', 0, 0, 'L');
        $pdf->Cell(30, 7, ': '.date('H:i:s'), 0, 1, 'L');
        $pdf->Cell(30, 7, 'Nama Pegawai', 0, 0, 'L');
        $pdf->Cell(30, 7, ': '. $row['nama'], 0, 1, 'L');
    
    // Add some spacing before the table
    $pdf->Cell(5, 5, '', 0, 1);


    // Set font for table header
    $pdf->SetFont('Times', 'B', 9);
    $pdf->Cell(10, 7, 'NO', 1, 0, 'C');
    $pdf->Cell(45, 7, 'RENTANG TANGGAL', 1, 0, 'C');
    $pdf->Cell(25, 7, 'JENIS', 1, 0, 'C');
    $pdf->Cell(90, 7, 'KETERANGAN', 1, 0, 'C');
    $pdf->Cell(20, 7, 'STATUS', 1, 1, 'C');

    // Set font for table data
    $pdf->SetFont('Times', '', 10);
    $no = 1;

    // Query to fetch izin data for the logged-in pegawai
    $sql_fetch_izin = "SELECT * FROM tb_cuti_izin WHERE tb_pegawai_id_pegawai = $tb_pegawai_id_pegawai";
    $result_fetch_izin = mysqli_query($conn, $sql_fetch_izin);

    while ($row_izin = mysqli_fetch_assoc($result_fetch_izin)) {
        $pdf->Cell(10, 6, $no++, 1, 0, 'C');
        $pdf->Cell(45, 6, $row_izin['tgl_range'], 1, 0);
        $pdf->Cell(25, 6, $row_izin['jenis_cuti_izin'], 1, 0);
        $pdf->Cell(90, 6, $row_izin['keterangan'], 1, 0);
        $pdf->Cell(20, 6, $row_izin['status'], 1, 1, 'C');
    }

    // Output the PDF to the browser
    $pdf->Output();
} else {
    // Handle the case where the session variable is not set
    echo "Session variable 'ses_id' is not set.";
    exit;
}
?>
