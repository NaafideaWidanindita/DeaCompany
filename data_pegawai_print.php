<?php
// Panggil file FPDF
session_start();
require('library/fpdf.php');
include 'koneksi.php';

// Buat objek PDF
$pdf = new FPDF();
$pdf->AddPage();
// Set font
$pdf->SetFont('Arial', 'B', 10);
// Tambahkan judul
$pdf->Cell(0, 10, 'Rekap Data Pegawai', 0, 1, 'C');

// Set font untuk header tabel
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(8, 7, 'ID', 1, 0, 'C'); // Mengatur posisi ke tengah
$pdf->Cell(35, 7, 'Nama', 1, 0, 'C'); // Mengatur posisi ke tengah
$pdf->Cell(25, 7, 'Alamat', 1, 0, 'C'); // Mengatur posisi ke tengah
$pdf->Cell(25, 7, 'No Telp', 1, 0, 'C'); // Mengatur posisi ke tengah
$pdf->Cell(20, 7, 'Tgl Lahir', 1, 0, 'C'); // Mengatur posisi ke tengah
$pdf->Cell(20, 7, 'Tgl Masuk', 1, 0, 'C'); // Mengatur posisi ke tengah
$pdf->Cell(20, 7, 'Gender', 1, 0, 'C'); // Mengatur posisi ke tengah
$pdf->Cell(40, 7, 'Departemen', 1, 1, 'C'); // Mengatur posisi ke tengah dan pindah ke baris baru


// Set font untuk isi tabel
$pdf->SetFont('Arial', '', 8);
// Query untuk mendapatkan data pegawai
$sql_data_pegawai = "SELECT * FROM tb_pegawai WHERE tb_jabatan_id_jabatan = 2";
$result_data_pegawai = mysqli_query($conn, $sql_data_pegawai);

// Tampilkan data dalam tabel
while ($row_data_pegawai = mysqli_fetch_assoc($result_data_pegawai)) {
    $id_jabatan = $row_data_pegawai['tb_jabatan_id_jabatan'];
    $id_departemen = $row_data_pegawai['tb_departemen_id_departemen'];
    $id_gaji = $row_data_pegawai['tb_gaji_id_gaji'];

    // Kueri SQL untuk mendapatkan nama jabatan
    $sql_jabatan = "SELECT nama_jabatan FROM tb_jabatan WHERE id_jabatan = $id_jabatan";
    $sql_departemen = "SELECT nama_departemen FROM tb_departemen WHERE id_departemen = $id_departemen";
    $sql_gaji = "SELECT gaji_bulan FROM tb_gaji WHERE id_gaji = $id_gaji";

    // Eksekusi kueri
    $result_jabatan = $conn->query($sql_jabatan);
    $result_departemen = $conn->query($sql_departemen);
    $result_gaji = $conn->query($sql_gaji);

    // Periksa apakah kueri berhasil dieksekusi
    if ($result_jabatan && $result_departemen && $result_gaji) {
        // Ambil data hasil kueri
        $row_jabatan = $result_jabatan->fetch_assoc();
        $row_departemen = $result_departemen->fetch_assoc();
        $row_gaji = $result_gaji->fetch_assoc();

        // Tambahkan baris dalam tabel PDF
        $pdf->Cell(8, 6, $row_data_pegawai['id_pegawai'], 1);
        $pdf->Cell(35, 6, $row_data_pegawai['nama'], 1);
        $pdf->Cell(25, 6, $row_data_pegawai['alamat'], 1);
        $pdf->Cell(25, 6, $row_data_pegawai['no_telp'], 1);
        $pdf->Cell(20, 6, $row_data_pegawai['tgl_lahir'], 1);
        $pdf->Cell(20, 6, $row_data_pegawai['tgl_masuk'], 1);
        $pdf->Cell(20, 6, $row_data_pegawai['jenis_kelamin'], 1);
        $pdf->Cell(40, 6, $row_departemen['nama_departemen'], 1);
        $pdf->Ln();
    } else {
        // Jika kueri gagal dieksekusi, tampilkan pesan kesalahan
        echo "Error: " . $sql_jabatan . " " . $sql_departemen . " " . $sql_gaji . "<br>" . $conn->error;
    }
}
// Output PDF ke browser
$pdf->Output();
?>
