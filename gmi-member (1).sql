-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 13, 2026 at 04:36 PM
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
-- Database: `gmi-member`
--

-- --------------------------------------------------------

--
-- Table structure for table `tgereja`
--

CREATE TABLE `tgereja` (
  `gereja_id` varchar(100) NOT NULL,
  `distrik` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama_gereja` varchar(200) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kondisi_bangunan` varchar(20) NOT NULL,
  `kepemilikan` varchar(20) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tgereja`
--

INSERT INTO `tgereja` (`gereja_id`, `distrik`, `email`, `password`, `nama_gereja`, `alamat`, `kondisi_bangunan`, `kepemilikan`, `created_at`, `updated_at`) VALUES
('e71830f5-d7e6-4961-a545-fc5034167f3d', 'D-II', 'silalahitotok@gmail.com', 'vBQz0dIf', 'GMI Kasih Karunia', '', 'Permanan', 'Milik Sendiri', '2026-06-13', '2026-06-13');

-- --------------------------------------------------------

--
-- Table structure for table `tpendeta`
--

CREATE TABLE `tpendeta` (
  `pendeta_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tpendeta`
--

INSERT INTO `tpendeta` (`pendeta_id`, `nama`, `email`) VALUES
(7, 'Pdt Lubis', 'silalahitotok@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tresort`
--

CREATE TABLE `tresort` (
  `resort_id` varchar(100) NOT NULL,
  `nama_resort` varchar(200) NOT NULL,
  `alamat` varchar(500) NOT NULL,
  `distrik` varchar(5) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_operator` varchar(100) NOT NULL,
  `mobile_phone` varchar(50) NOT NULL,
  `path_sk` varchar(500) NOT NULL,
  `tanggal_daftar` date NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tresort`
--

INSERT INTO `tresort` (`resort_id`, `nama_resort`, `alamat`, `distrik`, `email`, `password`, `nama_operator`, `mobile_phone`, `path_sk`, `tanggal_daftar`, `created_at`, `updated_at`) VALUES
('f1437180-c178-4c6c-9c72-db6dbc7ac536', 'Resort Hang Tuah', 'Jl Hang Tuah', 'D-II', 'silalahitotok@gmail.com', '72J0y4fR', 'Totok', '7777', 'public/uploads/1781256406_11d1936afdf910689d04.jpg', '2026-06-12', '2026-06-12', '2026-06-12');

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
  MODIFY `pendeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
