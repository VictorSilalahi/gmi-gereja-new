-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2026 at 03:28 PM
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
-- Database: `gmi-member`
--

-- --------------------------------------------------------

--
-- Table structure for table `tdistrik`
--

CREATE TABLE `tdistrik` (
  `distrik_id` bigint(20) UNSIGNED NOT NULL,
  `distrik` varchar(10) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `tanggal_terdaftar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tdistrik`
--

INSERT INTO `tdistrik` (`distrik_id`, `distrik`, `password`, `email`, `tanggal_terdaftar`) VALUES
(4, 'D-II', 'test', 'silalahitotok@gmail.com', '2026-07-29');

-- --------------------------------------------------------

--
-- Table structure for table `tgereja`
--

CREATE TABLE `tgereja` (
  `gereja_id` varchar(100) NOT NULL,
  `distrik` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_gereja` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `lat` varchar(100) NOT NULL,
  `lng` varchar(100) NOT NULL,
  `kondisi_bangunan` varchar(20) NOT NULL,
  `kepemilikan` varchar(100) NOT NULL,
  `db_id` varchar(10) NOT NULL,
  `identity_link` varchar(20) NOT NULL,
  `path_sk` varchar(100) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tgereja`
--

INSERT INTO `tgereja` (`gereja_id`, `distrik`, `email`, `password`, `nama_gereja`, `alamat`, `lat`, `lng`, `kondisi_bangunan`, `kepemilikan`, `db_id`, `identity_link`, `path_sk`, `created_at`, `updated_at`) VALUES
('9beaf151-63ee-4d4a-8520-8918f74db30b', 'D-II', 'silalahitotok@gmail.com', 'testing', 'GMI Kasih Karunia', 'Jl Hang Tuah', '3.5441744', '98.5976251', 'Permanen', 'Milik Sendiri', 'g-f9kyfz', 'QBPh9aPWLoUv', 'public/uploads/sk/1781845451_629fb7490b55adac04f9.jpg', '2026-06-19', '2026-06-19'),
('68151118-acfb-4285-9e01-681d56c2045e', 'D-II', 'victorbiz766hi@gmail.com', 'yW9YimFG', 'GMI XXX', 'Jl Madong Lubis no 9 Medan', '3.591858738825689', '98.67233008146287', 'Semi Permanen', 'Milik Sendiri', 'g-bqlgl2', 'EWu8KxyNsR2b', 'public/uploads/sk/1785480477_af130d7a021e720fe9f5.jpg', '2026-07-31', '2026-07-31');

-- --------------------------------------------------------

--
-- Table structure for table `tpendeta`
--

CREATE TABLE `tpendeta` (
  `pendeta_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tpendeta`
--

INSERT INTO `tpendeta` (`pendeta_id`, `nama`, `email`) VALUES
(3, 'Pdt Lubis', 'silalahitotok@gmail.com'),
(4, 'Pdt Lubis', 'jonathan@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tdistrik`
--
ALTER TABLE `tdistrik`
  ADD UNIQUE KEY `distrik_id` (`distrik_id`);

--
-- Indexes for table `tpendeta`
--
ALTER TABLE `tpendeta`
  ADD UNIQUE KEY `pendeta_id` (`pendeta_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tdistrik`
--
ALTER TABLE `tdistrik`
  MODIFY `distrik_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tpendeta`
--
ALTER TABLE `tpendeta`
  MODIFY `pendeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
