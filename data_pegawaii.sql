-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2024 at 06:27 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_pegawaii`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_absensi`
--

CREATE TABLE `tb_absensi` (
  `id_absensi` int NOT NULL,
  `tgl_absensi` date NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_keluar` time DEFAULT NULL,
  `keterangan` varchar(20) NOT NULL,
  `tb_pegawai_id_pegawai` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_absensi`
--

INSERT INTO `tb_absensi` (`id_absensi`, `tgl_absensi`, `jam_masuk`, `jam_keluar`, `keterangan`, `tb_pegawai_id_pegawai`) VALUES
(1, '2024-01-15', '08:36:03', '16:00:00', 'Absen Hadir\r\n', 101),
(2, '2024-01-15', '08:37:09', '16:10:00', 'Absen Hadir\r\n', 102),
(3, '2024-01-15', '08:38:09', '17:00:00', 'Absen Hadir', 103),
(4, '2024-01-15', '08:38:58', NULL, 'Absen masuk', 105),
(5, '2024-01-15', '08:43:27', NULL, 'Absen masuk', 106),
(6, '2024-01-15', '08:44:27', NULL, 'Absen masuk', 109),
(7, '2024-01-15', '08:56:11', NULL, 'Absen masuk', 107),
(8, '2024-01-15', '09:03:07', NULL, 'Absen masuk', 108),
(9, '2024-01-15', '08:20:00', NULL, 'Absen masuk', 104),
(10, '2024-01-15', '14:17:57', '14:18:05', 'Absen Hadir', 110),
(11, '2024-01-16', '08:50:29', '16:54:31', 'Absen Hadir', 101);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ambil_gaji`
--

CREATE TABLE `tb_ambil_gaji` (
  `id_ambil` int NOT NULL,
  `tb_pegawai_id_pegawai` int NOT NULL,
  `bulan` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bank` varchar(20) NOT NULL,
  `no_rekening` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_ambil_gaji`
--

INSERT INTO `tb_ambil_gaji` (`id_ambil`, `tb_pegawai_id_pegawai`, `bulan`, `bank`, `no_rekening`, `status`) VALUES
(1, 105, 'January 2024', 'MANDIRI', '123456789', 'telah diambil'),
(2, 102, 'January 2024', 'BNI', '7489324783', 'telah diambil'),
(3, 101, 'January 2024', 'BRI', '314432534', 'telah diambil'),
(4, 103, 'January 2024', 'BRI', '675758789', 'telah diambil'),
(5, 104, 'January 2024', 'BCA', '87669868', 'telah diambil'),
(6, 106, 'January 2024', 'BCA', '76268399', 'telah diambil'),
(7, 109, 'January 2024', 'MANDIRI', '7587869', 'telah diambil'),
(8, 108, 'January 2024', 'BCA', '345325325', 'telah diambil'),
(9, 107, 'January 2024', 'MANDIRI', '672542896', 'telah diambil'),
(10, 110, 'January 2024', 'BNI', '5367476', 'telah diambil'),
(11, 101, 'May 2024', 'BNI', '123124234', 'telah diambil'),
(12, 110, 'May 2024', 'BNI', '34242', 'telah diambil');

-- --------------------------------------------------------

--
-- Table structure for table `tb_cuti_izin`
--

CREATE TABLE `tb_cuti_izin` (
  `id_cuti_izin` int NOT NULL,
  `tgl_range` varchar(50) NOT NULL,
  `jenis_cuti_izin` varchar(45) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `tb_pegawai_id_pegawai` int NOT NULL,
  `file_pendukung` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_cuti_izin`
--

INSERT INTO `tb_cuti_izin` (`id_cuti_izin`, `tgl_range`, `jenis_cuti_izin`, `keterangan`, `tb_pegawai_id_pegawai`, `file_pendukung`, `status`) VALUES
(1, '01/15/2024 - 01/15/2024', 'Izin', 'Sakit', 105, 'file_izin/105_izin1.png', 'Diterima'),
(2, '01/15/2024 - 01/18/2024', 'Izin', 'Acara Keluarga', 101, 'file_izin/101_izin2.png', 'Diterima'),
(3, '01/01/2024 - 01/31/2024', 'Cuti', 'Cuti ', 101, 'file_izin/101_izin3.png', NULL),
(4, '01/15/2024 - 01/15/2024', 'Izin', 'Jalan jalan', 103, 'file_izin/103_izin5.png', NULL),
(5, '01/16/2024 - 01/16/2024', 'Izin', 'Ada acara', 102, 'file_izin/102_izin6.png', NULL),
(6, '01/27/2024 - 01/27/2024', 'Izin', 'Reuni sekolah', 104, 'file_izin/104_izin4.png', NULL),
(7, '01/03/2024 - 01/05/2024', 'Cuti', 'cuti izin', 106, 'file_izin/106_izin6.png', NULL),
(8, '02/03/2024 - 03/09/2024', 'Cuti', 'Izin Cuti', 107, 'file_izin/107_izin4.png', NULL),
(9, '01/23/2024 - 02/10/2024', 'Cuti', 'Cuti melahirkan', 108, 'file_izin/108_izin2.png', NULL),
(10, '01/15/2024 - 01/27/2024', 'Cuti', 'Cuti bersama', 105, 'file_izin/105_izin1.png', 'Diterima'),
(11, '01/15/2024 - 01/15/2024', 'Izin', 'sakit', 110, 'file_izin/110_izin3.png', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_departemen`
--

CREATE TABLE `tb_departemen` (
  `id_departemen` int NOT NULL,
  `nama_departemen` varchar(50) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_departemen`
--

INSERT INTO `tb_departemen` (`id_departemen`, `nama_departemen`, `keterangan`) VALUES
(1, 'Sumber Daya Manusia', 'Manajemen sumber daya manusia, perekrutan, pelatihan, pengembangan karyawan, manajemen kinerja, dan kebijakan karyawan.'),
(2, 'Keuangan dan Akuntansi', 'Menangani aspek keuangan perusahaan, termasuk akuntansi, pengelolaan anggaran, pelaporan keuangan, dan pajak.'),
(3, 'Teknologi Informasi', 'Menangani infrastruktur teknologi informasi, pengembangan perangkat lunak, keamanan IT, dukungan teknologi, dan manajemen data.'),
(4, 'Pemasaran dan Penjualan', 'Fokus pada pengembangan strategi pemasaran, promosi produk atau layanan, penelitian pasar, dan interaksi dengan pelanggan.Serta melibatkan tim penjualan yang bertugas menjual produk atau layanan perusahaan kepada pelanggan atau mitra bisnis.');

-- --------------------------------------------------------

--
-- Table structure for table `tb_gaji`
--

CREATE TABLE `tb_gaji` (
  `id_gaji` int NOT NULL,
  `gaji_bulan` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_gaji`
--

INSERT INTO `tb_gaji` (`id_gaji`, `gaji_bulan`) VALUES
(1, '4000000'),
(2, '5000000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jabatan`
--

CREATE TABLE `tb_jabatan` (
  `id_jabatan` int NOT NULL,
  `nama_jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_jabatan`
--

INSERT INTO `tb_jabatan` (`id_jabatan`, `nama_jabatan`) VALUES
(1, 'Administrator'),
(2, 'Pegawai');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id_pegawai` int NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `tb_departemen_id_departemen` int NOT NULL,
  `tb_jabatan_id_jabatan` int NOT NULL,
  `tb_gaji_id_gaji` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id_pegawai`, `nama`, `alamat`, `no_telp`, `tgl_lahir`, `jenis_kelamin`, `tgl_masuk`, `username`, `password`, `foto`, `tb_departemen_id_departemen`, `tb_jabatan_id_jabatan`, `tb_gaji_id_gaji`) VALUES
(101, 'Auliazizah', 'Jl.Uluwatu', '087788996688', '2001-02-28', 'Perempuan', '2024-01-02', 'aul', 'aul123', 'foto/Auliazizah_profil.png', 3, 2, 2),
(102, 'Muhammad Rijal', 'Jl.Rambutan', '087654321908', '2000-11-16', 'Laki-laki', '2024-01-02', 'rjl', 'rjl123', 'foto/Muhammad Rijal_profil.png', 1, 2, 2),
(103, 'Naafidea W.', 'Jl.Mecutan', '088883332221', '1999-07-07', 'Perempuan', '2024-01-02', 'ndw', 'ndw123', 'foto/Naafidea W._profil.png', 3, 2, 2),
(104, 'Nadzirotul Maula', 'Jl.Angsa', '086666777122', '2000-12-16', 'Perempuan', '2024-01-09', 'nad', 'nad123', 'foto/Nadzirotul Maula_profil.png', 1, 1, 1),
(105, 'Nayla Khoirunnisa', 'Jl.Buntu', '087654321908', '2001-07-11', 'Perempuan', '2024-01-13', 'nay', 'nay123', 'foto/Nayla Khoirunnisa_profil.png', 3, 1, 1),
(106, 'Nur Sabilla', 'Jl.Padang', '0877766688856', '2003-03-06', 'Perempuan', '2024-01-02', 'bil', 'bil123', 'foto/Nur Sabilla_profil.png', 2, 1, 1),
(107, 'Bella Nur', 'bel', '081111444666', '2001-08-15', 'Perempuan', '2024-01-04', 'bel', 'bel123', 'foto/Bella Nur_profil.png', 1, 2, 2),
(108, 'Zahra Amaila', 'Jl.Pasar', '087777333564', '2003-12-19', 'Perempuan', '2024-01-02', 'zah', 'zah123', 'foto/Zahra Amaila_profil.png', 3, 2, 2),
(109, 'Gibran Raka', 'Jl.Sekolah', '084444666778', '2000-12-05', 'Laki-laki', '2024-01-04', 'gib', 'gib123', 'foto/Gibran Raka_profil.png', 2, 1, 1),
(110, 'Alsya Bunadina', 'Jl.Rambutan', '085333050912', '2023-12-31', 'Perempuan', '2024-01-02', 'alsya', 'alsya123', 'foto/Alsya Bunadina_profil.png', 3, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tb_perusahaan`
--

CREATE TABLE `tb_perusahaan` (
  `id_perusahaan` int NOT NULL,
  `nama_perusahaan` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `bidang` varchar(50) NOT NULL,
  `pendiri` varchar(50) NOT NULL,
  `tahun_berdiri` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_perusahaan`
--

INSERT INTO `tb_perusahaan` (`id_perusahaan`, `nama_perusahaan`, `alamat`, `bidang`, `pendiri`, `tahun_berdiri`) VALUES
(16, 'DEA COMPANY', 'JL.BATU RAYA', 'ARSITEKTUR', 'Naafi\'dea Widanindita', 2020);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD PRIMARY KEY (`id_absensi`,`tb_pegawai_id_pegawai`),
  ADD KEY `fk_tb_absensi_tb_pegawai1_idx` (`tb_pegawai_id_pegawai`);

--
-- Indexes for table `tb_ambil_gaji`
--
ALTER TABLE `tb_ambil_gaji`
  ADD PRIMARY KEY (`id_ambil`,`tb_pegawai_id_pegawai`) USING BTREE,
  ADD KEY `fk_tb_ambil_gaji_tb_pegawai3_idx` (`tb_pegawai_id_pegawai`) USING BTREE;

--
-- Indexes for table `tb_cuti_izin`
--
ALTER TABLE `tb_cuti_izin`
  ADD PRIMARY KEY (`id_cuti_izin`,`tb_pegawai_id_pegawai`),
  ADD KEY `fk_tb_cuti_izin_tb_pegawai1_idx` (`tb_pegawai_id_pegawai`);

--
-- Indexes for table `tb_departemen`
--
ALTER TABLE `tb_departemen`
  ADD PRIMARY KEY (`id_departemen`);

--
-- Indexes for table `tb_gaji`
--
ALTER TABLE `tb_gaji`
  ADD PRIMARY KEY (`id_gaji`);

--
-- Indexes for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id_pegawai`,`tb_departemen_id_departemen`,`tb_jabatan_id_jabatan`,`tb_gaji_id_gaji`),
  ADD KEY `fk_tb_pegawai_tb_departemen_idx` (`tb_departemen_id_departemen`),
  ADD KEY `fk_tb_pegawai_tb_jabatan1_idx` (`tb_jabatan_id_jabatan`),
  ADD KEY `fk_tb_pegawai_tb_gaji1_idx` (`tb_gaji_id_gaji`),
  ADD KEY `id_pegawai` (`id_pegawai`);

--
-- Indexes for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  MODIFY `id_absensi` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_ambil_gaji`
--
ALTER TABLE `tb_ambil_gaji`
  MODIFY `id_ambil` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_cuti_izin`
--
ALTER TABLE `tb_cuti_izin`
  MODIFY `id_cuti_izin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_departemen`
--
ALTER TABLE `tb_departemen`
  MODIFY `id_departemen` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_gaji`
--
ALTER TABLE `tb_gaji`
  MODIFY `id_gaji` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_jabatan`
--
ALTER TABLE `tb_jabatan`
  MODIFY `id_jabatan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id_pegawai` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `tb_perusahaan`
--
ALTER TABLE `tb_perusahaan`
  MODIFY `id_perusahaan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_absensi`
--
ALTER TABLE `tb_absensi`
  ADD CONSTRAINT `fk_tb_absensi_tb_pegawai1` FOREIGN KEY (`tb_pegawai_id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`);

--
-- Constraints for table `tb_ambil_gaji`
--
ALTER TABLE `tb_ambil_gaji`
  ADD CONSTRAINT `fk_tb_ambil_gaji_tb_pegawai3_idx	` FOREIGN KEY (`tb_pegawai_id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tb_cuti_izin`
--
ALTER TABLE `tb_cuti_izin`
  ADD CONSTRAINT `fk_tb_cuti_izin_tb_pegawai1` FOREIGN KEY (`tb_pegawai_id_pegawai`) REFERENCES `tb_pegawai` (`id_pegawai`);

--
-- Constraints for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD CONSTRAINT `fk_tb_pegawai_tb_departemen` FOREIGN KEY (`tb_departemen_id_departemen`) REFERENCES `tb_departemen` (`id_departemen`),
  ADD CONSTRAINT `fk_tb_pegawai_tb_gaji1` FOREIGN KEY (`tb_gaji_id_gaji`) REFERENCES `tb_gaji` (`id_gaji`),
  ADD CONSTRAINT `fk_tb_pegawai_tb_jabatan1` FOREIGN KEY (`tb_jabatan_id_jabatan`) REFERENCES `tb_jabatan` (`id_jabatan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
