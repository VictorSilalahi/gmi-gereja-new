-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2026 at 02:52 PM
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
-- Database: `g-f9kyfz`
--

-- --------------------------------------------------------

--
-- Table structure for table `tanggotajemaat`
--

CREATE TABLE `tanggotajemaat` (
  `anggotajemaat_id` bigint(20) UNSIGNED NOT NULL,
  `jemaat_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `golongan_darah` varchar(2) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `telah_baptis` tinyint(1) NOT NULL,
  `tanggal_baptis` date DEFAULT NULL,
  `posisi` varchar(10) NOT NULL,
  `pendidikan_terakhir` varchar(20) NOT NULL,
  `pekerjaan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tanggotajemaat`
--

INSERT INTO `tanggotajemaat` (`anggotajemaat_id`, `jemaat_id`, `nama`, `jk`, `golongan_darah`, `tanggal_lahir`, `telah_baptis`, `tanggal_baptis`, `posisi`, `pendidikan_terakhir`, `pekerjaan`) VALUES
(12, 7, 'Andi', 'L', 'A', '2026-06-21', 0, '2026-06-22', 'Suami', 'S1', 'TNI-Polri'),
(13, 7, 'Deby', 'P', 'B', '2026-06-24', 0, '2026-08-14', 'Istri', 'S1', 'ASN'),
(14, 7, 'Indra', 'P', 'O', '2026-06-28', 0, '2026-08-15', 'Anak', 'S3', 'Dokter'),
(18, 8, 'Hendry', 'L', 'A', '2026-07-01', 0, '2026-07-02', 'Suami', 'S1', 'TNI-Polri'),
(19, 8, 'Tuty', 'P', 'AB', '2026-07-05', 0, '2026-07-06', 'Istri', 'S1', 'ASN'),
(20, 8, 'Dian', 'P', 'B', '2026-07-12', 0, '2026-07-13', 'Anak', 'D3', 'Pedagang'),
(21, 9, 'Andre', 'L', 'A', '2026-07-26', 0, '2026-07-27', 'Suami', 'S1', 'ASN'),
(22, 9, 'Fitri', 'P', 'B', '2026-07-19', 0, '2026-07-20', 'Suami', 'S1', 'Pedagang'),
(23, 7, 'XXX', 'L', 'A', '2026-08-13', 0, '2026-08-14', 'Anak', 'SMA-SMK', 'None');

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
(1, 20, 3),
(4, 21, 3),
(5, 21, 4),
(6, 14, 3),
(7, 18, 3);

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
(1, 'tambah', 'jemaat', '2026-07-07'),
(2, 'ubah', 'jemaat-anggota', '2026-08-15'),
(3, 'ubah', 'jemaat-anggota', '2026-08-15'),
(4, 'ubah', 'jemaat-anggota', '2026-08-15'),
(5, 'tambah', 'jemaat-anggota', '2026-08-15'),
(6, 'ubah', 'sektor', '2026-08-15'),
(7, 'ubah', 'sektor', '2026-08-15'),
(8, 'tambah', 'pejabat', '2026-08-15'),
(9, 'tambah', 'organisasi', '2026-08-15'),
(10, 'hapus', 'organisasi', '2026-08-15'),
(11, 'tambah', 'organisasi', '2026-08-15'),
(12, 'tambah', 'organisasi', '2026-08-15'),
(13, 'tambah', 'anggota-organisasi', '2026-08-15'),
(14, 'tambah', 'anggota-organisasi', '2026-08-15'),
(15, 'tambah', 'anggota-organisasi', '2026-08-15'),
(16, 'tambah', 'anggota-organisasi', '2026-08-15'),
(17, 'tambah', 'organisasi', '2026-08-15'),
(18, 'tambah', 'anggota-organisasi', '2026-08-15'),
(19, 'tambah', 'anggota-organisasi', '2026-08-15'),
(20, 'tambah', 'anggota-organisasi', '2026-08-15'),
(21, 'hapus', 'anggota-organisasi', '2026-08-15'),
(22, 'hapus', 'anggota-organisasi', '2026-08-15'),
(23, 'tambah', 'kegiatan', '2026-08-15'),
(24, 'tambah', 'pejabat', '2026-08-15');

-- --------------------------------------------------------

--
-- Table structure for table `thistorypejabat`
--

CREATE TABLE `thistorypejabat` (
  `historypejabat_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jabatan_id` int(11) NOT NULL,
  `tanggal_pengangkatan` date NOT NULL,
  `tanggal_berhenti` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thistorypejabat`
--

INSERT INTO `thistorypejabat` (`historypejabat_id`, `nama`, `jabatan_id`, `tanggal_pengangkatan`, `tanggal_berhenti`) VALUES
(13, 'Indra', 1, '2026-08-18', NULL),
(14, 'Fitri', 2, '2026-08-17', NULL);

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
(2, 'Guru Injil');

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
(7, '001-001', 'Aktif', 1, 'Jl Test test test', '876760806', '2026-06-19'),
(8, '001-002', 'Aktif', 1, 'Jl Test test test', '7777', '2026-07-01'),
(9, '001-003', 'Aktif', 1, 'xxxx', '111', '2026-07-07');

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

--
-- Dumping data for table `tkegiatan`
--

INSERT INTO `tkegiatan` (`kegiatan_id`, `tanggal`, `judul_kegiatan`, `deskripsi`) VALUES
(1, '2026-08-15', 'dvdvd', 'b vrfebtnbrtn');

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
(5, 12, '2026-06-24'),
(6, 13, '2026-06-24'),
(7, 14, '2026-07-01'),
(10, 18, '2026-07-04'),
(11, 19, '2026-07-08'),
(12, 20, '2026-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `torganisasi`
--

CREATE TABLE `torganisasi` (
  `organisasi_id` bigint(20) UNSIGNED NOT NULL,
  `organisasi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `torganisasi`
--

INSERT INTO `torganisasi` (`organisasi_id`, `organisasi`) VALUES
(3, 'PWMI'),
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
(16, 14, 1),
(17, 22, 2);

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
(1, '001', 'Sektor 001'),
(2, '002', 'Sektor 002'),
(4, '003', 'Sektor 003');

-- --------------------------------------------------------

--
-- Table structure for table `tsidi`
--

CREATE TABLE `tsidi` (
  `sidi_id` bigint(20) UNSIGNED NOT NULL,
  `anggotajemaat_id` int(11) NOT NULL,
  `telah_sidi` tinyint(1) NOT NULL,
  `tanggal_sidi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tsidi`
--

INSERT INTO `tsidi` (`sidi_id`, `anggotajemaat_id`, `telah_sidi`, `tanggal_sidi`) VALUES
(6, 12, 0, '2026-06-23'),
(7, 13, 0, '2026-06-23'),
(8, 14, 0, '2026-06-30'),
(9, 17, 0, '2026-06-21'),
(10, 18, 0, '2026-07-03'),
(11, 19, 0, '2026-07-07'),
(12, 20, 0, '2026-07-14');

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
-- Dumping data for table `twafat`
--

INSERT INTO `twafat` (`wafat_id`, `anggotajemaat_id`, `tanggal_wafat`) VALUES
(2, 14, '2026-08-01');

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
  MODIFY `anggotajemaat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tanggotaorganisasi`
--
ALTER TABLE `tanggotaorganisasi`
  MODIFY `anggotaorganisasi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `thistoryapp`
--
ALTER TABLE `thistoryapp`
  MODIFY `historyapp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `thistorypejabat`
--
ALTER TABLE `thistorypejabat`
  MODIFY `historypejabat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tjabatan`
--
ALTER TABLE `tjabatan`
  MODIFY `jabatan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tjemaat`
--
ALTER TABLE `tjemaat`
  MODIFY `jemaat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tkegiatan`
--
ALTER TABLE `tkegiatan`
  MODIFY `kegiatan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tkeluar`
--
ALTER TABLE `tkeluar`
  MODIFY `keluar_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmenikah`
--
ALTER TABLE `tmenikah`
  MODIFY `menikah_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `torganisasi`
--
ALTER TABLE `torganisasi`
  MODIFY `organisasi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tpejabat`
--
ALTER TABLE `tpejabat`
  MODIFY `pejabat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tsektor`
--
ALTER TABLE `tsektor`
  MODIFY `sektor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tsidi`
--
ALTER TABLE `tsidi`
  MODIFY `sidi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `twafat`
--
ALTER TABLE `twafat`
  MODIFY `wafat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
