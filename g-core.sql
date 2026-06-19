-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2026 at 02:45 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g-core`
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
  `tanggal_baptis` date NOT NULL,
  `posisi` varchar(10) NOT NULL,
  `pendidikan_terakhir` varchar(20) NOT NULL,
  `pekerjaan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tanggotaorganisasi`
--

CREATE TABLE `tanggotaorganisasi` (
  `anggotaorganisasi_id` bigint(20) UNSIGNED NOT NULL,
  `anggotajemaat_id` int(11) NOT NULL,
  `organisasi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thistoryapp`
--

CREATE TABLE `thistoryapp` (
  `historyapp_id` bigint(20) UNSIGNED NOT NULL,
  `operasi` varchar(50) NOT NULL,
  `tanggal_operasi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `thistorypejabat`
--

CREATE TABLE `thistorypejabat` (
  `historypejabat_id` bigint(20) UNSIGNED NOT NULL,
  `anggotajemaat_id` int(11) NOT NULL,
  `tanggal_pengangkatan` date NOT NULL,
  `tanggal_berhenti` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tjabatan`
--

CREATE TABLE `tjabatan` (
  `jabatan_id` bigint(20) UNSIGNED NOT NULL,
  `jabatan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `torganisasi`
--

CREATE TABLE `torganisasi` (
  `organisasi_id` bigint(20) UNSIGNED NOT NULL,
  `organisasi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tpejabat`
--

CREATE TABLE `tpejabat` (
  `pejabat_id` bigint(20) UNSIGNED NOT NULL,
  `anggotajemaat_id` int(11) NOT NULL,
  `jabatan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tsektor`
--

CREATE TABLE `tsektor` (
  `sektor_id` bigint(20) UNSIGNED NOT NULL,
  `no_sektor` varchar(10) NOT NULL,
  `nama_sektor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tsidi`
--

CREATE TABLE `tsidi` (
  `sidi_id` bigint(20) UNSIGNED NOT NULL,
  `anggotajemaat_id` int(11) NOT NULL,
  `tanggal_sidi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `anggotajemaat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tanggotaorganisasi`
--
ALTER TABLE `tanggotaorganisasi`
  MODIFY `anggotaorganisasi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thistoryapp`
--
ALTER TABLE `thistoryapp`
  MODIFY `historyapp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thistorypejabat`
--
ALTER TABLE `thistorypejabat`
  MODIFY `historypejabat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tjabatan`
--
ALTER TABLE `tjabatan`
  MODIFY `jabatan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tjemaat`
--
ALTER TABLE `tjemaat`
  MODIFY `jemaat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tkegiatan`
--
ALTER TABLE `tkegiatan`
  MODIFY `kegiatan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tkeluar`
--
ALTER TABLE `tkeluar`
  MODIFY `keluar_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tmenikah`
--
ALTER TABLE `tmenikah`
  MODIFY `menikah_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `torganisasi`
--
ALTER TABLE `torganisasi`
  MODIFY `organisasi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tpejabat`
--
ALTER TABLE `tpejabat`
  MODIFY `pejabat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tsektor`
--
ALTER TABLE `tsektor`
  MODIFY `sektor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tsidi`
--
ALTER TABLE `tsidi`
  MODIFY `sidi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `twafat`
--
ALTER TABLE `twafat`
  MODIFY `wafat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
