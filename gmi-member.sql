-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2026 at 02:46 PM
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
-- Table structure for table `tgereja`
--

CREATE TABLE `tgereja` (
  `gereja_id` varchar(100) NOT NULL,
  `distrik` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama_gereja` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kondisi_bangunan` varchar(20) NOT NULL,
  `kepemilikan` varchar(20) NOT NULL,
  `db_id` varchar(20) NOT NULL,
  `identity_link` varchar(20) NOT NULL,
  `path_sk` varchar(200) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tgereja`
--

INSERT INTO `tgereja` (`gereja_id`, `distrik`, `email`, `password`, `nama_gereja`, `alamat`, `kondisi_bangunan`, `kepemilikan`, `db_id`, `identity_link`, `path_sk`, `created_at`, `updated_at`) VALUES
('2d97d516-3182-4aad-9c02-5046677aa5e9', 'D-II', 'silalahitotok@gmail.com', 'jDbqMziv', 'GMI Kasih Karunia', 'Jl Hang Tuah no 2 Medan', 'Permanen', 'Milik Sendiri', 'g-f9kyfz', 'voNhTxpsowz6', 'public/uploads/sk/1781601474_0fd50c703e234421cb90.jpg', '2026-06-16', '2026-06-16');

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
(6, 'Pdt Lubis', 'silalahitotok@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tpendeta`
--
ALTER TABLE `tpendeta`
  ADD UNIQUE KEY `pendeta_id` (`pendeta_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tpendeta`
--
ALTER TABLE `tpendeta`
  MODIFY `pendeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
