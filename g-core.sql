-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2026 at 06:24 AM
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

--
-- Dumping data for table `tanggotajemaat`
--

INSERT INTO `tanggotajemaat` (`anggotajemaat_id`, `jemaat_id`, `nama`, `jk`, `golongan_darah`, `tanggal_lahir`, `tanggal_baptis`, `posisi`, `pendidikan_terakhir`, `pekerjaan`) VALUES
(1, 1, 'Henry XYZ', 'L', 'A', '2026-06-21', '2026-06-22', 'Suami', 'S1', 'ASN'),
(2, 1, 'Wati Siburian', 'P', 'B', '2026-06-28', '2006-06-29', 'Istri', 'S1', 'Karyawan-Swasta'),
(3, 1, 'Tony', 'P', 'AB', '2026-06-07', '2026-06-08', 'Istri', 'D3', 'Pedagang'),
(4, 1, 'Tina', 'L', 'A', '2026-06-14', '2026-06-15', 'Anak', 'D3', 'Dokter'),
(5, 2, 'Dony', 'L', 'A', '2026-07-05', '2026-07-06', 'Suami', 'S2', 'ASN'),
(6, 2, 'Siti', 'P', 'B', '2026-06-29', '2026-06-22', 'Istri', 'D3', 'Pedagang');

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
-- Table structure for table `thistoryapp`
--

CREATE TABLE `thistoryapp` (
  `historyapp_id` bigint(20) UNSIGNED NOT NULL,
  `operasi` varchar(50) NOT NULL,
  `tujuan` varchar(20) NOT NULL,
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
  `tanggal_berhenti` date NOT NULL,
  `jabatan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '01-001', 'Aktif', 1, 'Jl Setia Budi Pasar III no 776', '2222222222', '2026-06-01'),
(2, '01-002', 'Aktif', 1, 'Jl Darusalam', '33332', '2026-06-01');

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
(4, '2026-06-03', 'Kongres GMI ke xx', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.');

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
(1, 1, '2026-06-24'),
(2, 2, '2026-07-01'),
(3, 3, '0000-00-00'),
(4, 4, '0000-00-00'),
(5, 5, '2026-07-08'),
(6, 6, '2026-06-30');

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
  `tanggal_sidi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tsidi`
--

INSERT INTO `tsidi` (`sidi_id`, `anggotajemaat_id`, `tanggal_sidi`) VALUES
(1, 1, '2026-06-23'),
(2, 2, '2026-06-30'),
(3, 3, '2026-06-09'),
(4, 4, '2026-06-16'),
(5, 5, '2026-07-07'),
(6, 6, '2026-06-24');

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
  MODIFY `anggotajemaat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tanggotaorganisasi`
--
ALTER TABLE `tanggotaorganisasi`
  MODIFY `anggotaorganisasi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `jabatan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tjemaat`
--
ALTER TABLE `tjemaat`
  MODIFY `jemaat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `menikah_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `torganisasi`
--
ALTER TABLE `torganisasi`
  MODIFY `organisasi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tpejabat`
--
ALTER TABLE `tpejabat`
  MODIFY `pejabat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tsektor`
--
ALTER TABLE `tsektor`
  MODIFY `sektor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tsidi`
--
ALTER TABLE `tsidi`
  MODIFY `sidi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `twafat`
--
ALTER TABLE `twafat`
  MODIFY `wafat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
