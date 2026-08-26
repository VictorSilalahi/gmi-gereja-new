-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 26, 2026 at 06:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g-dnja1q`
--

-- --------------------------------------------------------

--
-- Table structure for table `tanggotajemaat`
--

CREATE TABLE `tanggotajemaat` (
  `anggotajemaat_id` bigint(20) UNSIGNED NOT NULL,
  `super_id` varchar(100) DEFAULT NULL,
  `jemaat_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `golongan_darah` varchar(6) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `is_baptis` tinyint(1) NOT NULL,
  `tanggal_baptis` date NOT NULL,
  `posisi` varchar(10) NOT NULL,
  `pendidikan_terakhir` varchar(20) NOT NULL,
  `pekerjaan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tanggotajemaat`
--

INSERT INTO `tanggotajemaat` (`anggotajemaat_id`, `super_id`, `jemaat_id`, `nama`, `jk`, `golongan_darah`, `tanggal_lahir`, `is_baptis`, `tanggal_baptis`, `posisi`, `pendidikan_terakhir`, `pekerjaan`) VALUES
(8, NULL, 4, 'Henry XYZ', 'L', 'A', '2026-08-01', 1, '0000-00-00', 'Suami', 'SD', 'ASN'),
(9, NULL, 4, 'Merbau', 'P', 'B', '2026-08-02', 1, '2026-08-16', 'Istri', 'SMP', 'TNI-Polri'),
(10, NULL, 4, 'Kempas', 'L', 'AB', '2026-08-03', 0, '0000-00-00', 'Anak', 'SMA-SMK', 'Karyawan-Swasta'),
(21, NULL, 4, 'XX Tobing', 'L', 'None', '2026-08-03', 0, '0000-00-00', 'Mandiri', 'None', 'None'),
(22, NULL, 4, 'CCC', 'L', 'B', '2026-08-02', 1, '2026-08-12', 'Anak', 'S3', 'Pendeta');

-- --------------------------------------------------------

--
-- Table structure for table `tanggotaorganisasi`
--

CREATE TABLE `tanggotaorganisasi` (
  `anggotaorganisasi_id` bigint(20) UNSIGNED NOT NULL,
  `anggotajemaat_id` int(11) NOT NULL,
  `organisasi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tanggotaorganisasi`
--

INSERT INTO `tanggotaorganisasi` (`anggotaorganisasi_id`, `anggotajemaat_id`, `organisasi_id`) VALUES
(1, 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tdatakebaktian`
--

CREATE TABLE `tdatakebaktian` (
  `datakebaktian_id` bigint(20) UNSIGNED NOT NULL,
  `kebaktian_id` int(11) NOT NULL,
  `no_ibadah` varchar(20) NOT NULL,
  `kehadiran` int(11) NOT NULL,
  `persembahan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tdatakebaktian`
--

INSERT INTO `tdatakebaktian` (`datakebaktian_id`, `kebaktian_id`, `no_ibadah`, `kehadiran`, `persembahan`) VALUES
(1, 1, 'Ibadah I', 20, 1000000),
(2, 1, 'Ibadah II', 40, 500000);

-- --------------------------------------------------------

--
-- Table structure for table `thistoryapp`
--

CREATE TABLE `thistoryapp` (
  `historyapp_id` bigint(20) UNSIGNED NOT NULL,
  `operasi` varchar(50) NOT NULL,
  `tujuan` varchar(20) NOT NULL,
  `tanggal_operasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thistoryapp`
--

INSERT INTO `thistoryapp` (`historyapp_id`, `operasi`, `tujuan`, `tanggal_operasi`) VALUES
(1, 'tambah', 'pejabat', '2026-08-16'),
(2, 'hapus', 'pejabat', '2026-08-16'),
(3, 'tambah', 'pejabat', '2026-08-16'),
(4, 'tambah', 'pejabat', '2026-08-16'),
(5, 'hapus', 'kegiatan', '2026-08-16'),
(6, 'tambah', 'jemaat', '2026-08-16'),
(7, 'tambah', 'jemaat', '2026-08-25'),
(8, 'tambah', 'jemaat-anggota', '2026-08-26'),
(9, 'tambah', 'jemaat-anggota', '2026-08-26'),
(10, 'tambah', 'jemaat-anggota', '2026-08-26'),
(11, 'tambah', 'jemaat-anggota', '2026-08-26'),
(12, 'hapus', 'jemaat-anggota', '2026-08-26'),
(13, 'tambah', 'jemaat-anggota', '2026-08-26'),
(14, 'hapus', 'jemaat-anggota', '2026-08-26'),
(15, 'tambah', 'jemaat-anggota', '2026-08-26'),
(16, 'hapus', 'jemaat-anggota', '2026-08-26'),
(17, 'hapus', 'jemaat-anggota', '2026-08-26'),
(18, 'tambah', 'jemaat-anggota', '2026-08-26'),
(19, 'tambah', 'jemaat-anggota', '2026-08-26'),
(20, 'ubah', 'jemaat-anggota', '2026-08-26'),
(21, 'ubah', 'jemaat-anggota', '2026-08-26'),
(22, 'ubah', 'jemaat-anggota', '2026-08-26'),
(23, 'ubah', 'jemaat-anggota', '2026-08-26'),
(24, 'ubah', 'jemaat-anggota', '2026-08-26'),
(25, 'ubah', 'jemaat-anggota', '2026-08-26'),
(26, 'ubah', 'jemaat-anggota', '2026-08-26'),
(27, 'ubah', 'jemaat-anggota', '2026-08-26'),
(28, 'ubah', 'jemaat-anggota', '2026-08-26'),
(29, 'ubah', 'jemaat-anggota', '2026-08-26'),
(30, 'ubah', 'jemaat-anggota', '2026-08-26');

-- --------------------------------------------------------

--
-- Table structure for table `thistorypejabat`
--

CREATE TABLE `thistorypejabat` (
  `historypejabat_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `tanggal_pengangkatan` date NOT NULL,
  `tanggal_berhenti` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thistorypejabat`
--

INSERT INTO `thistorypejabat` (`historypejabat_id`, `nama`, `jabatan_id`, `tanggal_pengangkatan`, `tanggal_berhenti`) VALUES
(1, 'Tina', 3, '2026-08-04', '2026-08-07'),
(2, 'Wati Siburian', 1, '2026-08-01', '0000-00-00'),
(3, 'Tina', 1, '2026-08-05', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `tjabatan`
--

CREATE TABLE `tjabatan` (
  `jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tjabatan`
--

INSERT INTO `tjabatan` (`jabatan_id`, `jabatan`) VALUES
(1, 'Majelis'),
(3, 'Guru Injil');

-- --------------------------------------------------------

--
-- Table structure for table `tjemaat`
--

CREATE TABLE `tjemaat` (
  `jemaat_id` bigint(20) UNSIGNED NOT NULL,
  `nik` varchar(20) NOT NULL,
  `status_keanggotaan` varchar(20) NOT NULL,
  `sektor_id` int(11) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `mobile_phone` varchar(200) NOT NULL,
  `tanggal_terdaftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tjemaat`
--

INSERT INTO `tjemaat` (`jemaat_id`, `nik`, `status_keanggotaan`, `sektor_id`, `alamat`, `mobile_phone`, `tanggal_terdaftar`) VALUES
(4, '01-002', 'Aktif', 1, 'Jl Setia Budi Pasar III no 600', '222333', '2026-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `tkebaktian`
--

CREATE TABLE `tkebaktian` (
  `kebaktian_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tkebaktian`
--

INSERT INTO `tkebaktian` (`kebaktian_id`, `tanggal`) VALUES
(1, '2026-08-23'),
(3, '2026-08-16');

-- --------------------------------------------------------

--
-- Table structure for table `tkegiatan`
--

CREATE TABLE `tkegiatan` (
  `kegiatan_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `judul_kegiatan` varchar(200) NOT NULL,
  `deskripsi` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tkeluar`
--

CREATE TABLE `tkeluar` (
  `keluar_id` bigint(20) UNSIGNED NOT NULL,
  `anggotajemaat_id` int(11) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `alasan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tmenikah`
--

CREATE TABLE `tmenikah` (
  `menikah_id` bigint(20) UNSIGNED NOT NULL,
  `anggotajemaat_id` int(11) NOT NULL,
  `tanggal_menikah` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tmenikah`
--

INSERT INTO `tmenikah` (`menikah_id`, `anggotajemaat_id`, `tanggal_menikah`) VALUES
(8, 9, '2026-08-26'),
(9, 10, '2026-08-27'),
(10, 11, '2026-08-28'),
(11, 22, '2026-09-01'),
(12, 22, '2026-09-01'),
(13, 22, '2026-09-01'),
(14, 22, '2026-09-01');

-- --------------------------------------------------------

--
-- Table structure for table `torganisasi`
--

CREATE TABLE `torganisasi` (
  `organisasi_id` bigint(20) UNSIGNED NOT NULL,
  `organisasi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `torganisasi`
--

INSERT INTO `torganisasi` (`organisasi_id`, `organisasi`) VALUES
(2, 'PWMI'),
(4, 'P3MI');

-- --------------------------------------------------------

--
-- Table structure for table `tpejabat`
--

CREATE TABLE `tpejabat` (
  `pejabat_id` bigint(20) UNSIGNED NOT NULL,
  `anggotajemaat_id` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tpejabat`
--

INSERT INTO `tpejabat` (`pejabat_id`, `anggotajemaat_id`, `jabatan_id`) VALUES
(7, 2, 1),
(8, 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tsektor`
--

CREATE TABLE `tsektor` (
  `sektor_id` bigint(20) UNSIGNED NOT NULL,
  `no_sektor` varchar(10) NOT NULL,
  `nama_sektor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tsektor`
--

INSERT INTO `tsektor` (`sektor_id`, `no_sektor`, `nama_sektor`) VALUES
(1, '01', 'Sektor 01'),
(2, '02', 'Sektor 02'),
(3, '03', 'Sektor 03');

-- --------------------------------------------------------

--
-- Table structure for table `tsidi`
--

CREATE TABLE `tsidi` (
  `sidi_id` bigint(20) UNSIGNED NOT NULL,
  `anggotajemaat_id` int(11) NOT NULL,
  `is_sidi` tinyint(1) NOT NULL,
  `tanggal_sidi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tsidi`
--

INSERT INTO `tsidi` (`sidi_id`, `anggotajemaat_id`, `is_sidi`, `tanggal_sidi`) VALUES
(8, 9, 0, '0000-00-00'),
(9, 10, 1, '2026-08-17'),
(10, 11, 1, '2026-08-19'),
(14, 21, 0, '0000-00-00'),
(15, 22, 1, '2026-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `twafat`
--

CREATE TABLE `twafat` (
  `wafat_id` bigint(20) UNSIGNED NOT NULL,
  `anggotajemaat_id` int(11) NOT NULL,
  `tanggal_wafat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tanggotajemaat`
--
ALTER TABLE `tanggotajemaat`
  ADD UNIQUE KEY `anggotajemaat_id` (`anggotajemaat_id`);

--
-- Indexes for table `tanggotaorganisasi`
--
ALTER TABLE `tanggotaorganisasi`
  ADD UNIQUE KEY `anggotaorganisasi_id` (`anggotaorganisasi_id`);

--
-- Indexes for table `tdatakebaktian`
--
ALTER TABLE `tdatakebaktian`
  ADD UNIQUE KEY `datakebaktian_id` (`datakebaktian_id`);

--
-- Indexes for table `thistoryapp`
--
ALTER TABLE `thistoryapp`
  ADD UNIQUE KEY `historyapp_id` (`historyapp_id`);

--
-- Indexes for table `thistorypejabat`
--
ALTER TABLE `thistorypejabat`
  ADD UNIQUE KEY `historypejabat_id` (`historypejabat_id`);

--
-- Indexes for table `tjabatan`
--
ALTER TABLE `tjabatan`
  ADD UNIQUE KEY `jabatan_id` (`jabatan_id`);

--
-- Indexes for table `tjemaat`
--
ALTER TABLE `tjemaat`
  ADD UNIQUE KEY `jemaat_id` (`jemaat_id`);

--
-- Indexes for table `tkebaktian`
--
ALTER TABLE `tkebaktian`
  ADD UNIQUE KEY `kebaktian_id` (`kebaktian_id`);

--
-- Indexes for table `tkegiatan`
--
ALTER TABLE `tkegiatan`
  ADD UNIQUE KEY `kegiatan_id` (`kegiatan_id`);

--
-- Indexes for table `tkeluar`
--
ALTER TABLE `tkeluar`
  ADD UNIQUE KEY `keluar_id` (`keluar_id`);

--
-- Indexes for table `tmenikah`
--
ALTER TABLE `tmenikah`
  ADD UNIQUE KEY `menikah_id` (`menikah_id`);

--
-- Indexes for table `torganisasi`
--
ALTER TABLE `torganisasi`
  ADD UNIQUE KEY `organisasi_id` (`organisasi_id`);

--
-- Indexes for table `tpejabat`
--
ALTER TABLE `tpejabat`
  ADD UNIQUE KEY `pejabat_id` (`pejabat_id`);

--
-- Indexes for table `tsektor`
--
ALTER TABLE `tsektor`
  ADD UNIQUE KEY `sektor_id` (`sektor_id`);

--
-- Indexes for table `tsidi`
--
ALTER TABLE `tsidi`
  ADD UNIQUE KEY `sidi_id` (`sidi_id`);

--
-- Indexes for table `twafat`
--
ALTER TABLE `twafat`
  ADD UNIQUE KEY `wafat_id` (`wafat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tanggotajemaat`
--
ALTER TABLE `tanggotajemaat`
  MODIFY `anggotajemaat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tanggotaorganisasi`
--
ALTER TABLE `tanggotaorganisasi`
  MODIFY `anggotaorganisasi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tdatakebaktian`
--
ALTER TABLE `tdatakebaktian`
  MODIFY `datakebaktian_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `thistoryapp`
--
ALTER TABLE `thistoryapp`
  MODIFY `historyapp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `thistorypejabat`
--
ALTER TABLE `thistorypejabat`
  MODIFY `historypejabat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tjabatan`
--
ALTER TABLE `tjabatan`
  MODIFY `jabatan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tjemaat`
--
ALTER TABLE `tjemaat`
  MODIFY `jemaat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tkebaktian`
--
ALTER TABLE `tkebaktian`
  MODIFY `kebaktian_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tkegiatan`
--
ALTER TABLE `tkegiatan`
  MODIFY `kegiatan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tkeluar`
--
ALTER TABLE `tkeluar`
  MODIFY `keluar_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmenikah`
--
ALTER TABLE `tmenikah`
  MODIFY `menikah_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `torganisasi`
--
ALTER TABLE `torganisasi`
  MODIFY `organisasi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tpejabat`
--
ALTER TABLE `tpejabat`
  MODIFY `pejabat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tsektor`
--
ALTER TABLE `tsektor`
  MODIFY `sektor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tsidi`
--
ALTER TABLE `tsidi`
  MODIFY `sidi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `twafat`
--
ALTER TABLE `twafat`
  MODIFY `wafat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
