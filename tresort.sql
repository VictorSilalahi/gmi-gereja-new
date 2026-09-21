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
-- Table structure for table `tresort`
--

CREATE TABLE `tresort` (
  `resort_id` bigint(20) UNSIGNED NOT NULL,
  `nama_resort` varchar(100) NOT NULL,
  `distrik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tresort`
--

INSERT INTO `tresort` (`resort_id`, `nama_resort`, `distrik_id`) VALUES
(1, 'Resort Hang Tuah', 6),
(2, 'Resort Gloria', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tresort`
--
ALTER TABLE `tresort`
  ADD UNIQUE KEY `resort_id` (`resort_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tresort`
--
ALTER TABLE `tresort`
  MODIFY `resort_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
