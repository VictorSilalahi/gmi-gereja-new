-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2026 at 02:33 PM
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
-- Table structure for table `tanggotaresort`
--

CREATE TABLE `tanggotaresort` (
  `anggotaresort_id` bigint(20) UNSIGNED NOT NULL,
  `resort_id` int(11) NOT NULL,
  `gereja_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tanggotaresort`
--

INSERT INTO `tanggotaresort` (`anggotaresort_id`, `resort_id`, `gereja_id`) VALUES
(1, 1, 'e2946a7f-fc77-459b-82de-d6c544529f4e'),
(2, 1, '7cbcd34a-af7d-48b7-9efa-1a41d441154c');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tanggotaresort`
--
ALTER TABLE `tanggotaresort`
  ADD UNIQUE KEY `anggotaresort_id` (`anggotaresort_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tanggotaresort`
--
ALTER TABLE `tanggotaresort`
  MODIFY `anggotaresort_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
