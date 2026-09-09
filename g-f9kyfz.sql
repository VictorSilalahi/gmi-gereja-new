-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2026 at 02:39 PM
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
(2, NULL, 1, 'Eviyensi Debora Siahaan', 'P', 'AB', '1994-09-22', 1, '1994-12-25', 'Istri', 'SMA-SMK', 'None'),
(3, NULL, 1, 'Yuehan Lukevyn Juara Sidabutar', 'L', 'AB', '2020-05-11', 1, '0000-00-00', 'Anak', 'None', 'None'),
(4, NULL, 1, 'Lukas MT. Sidabutar', 'L', 'None', '1987-11-05', 1, '1988-02-03', 'Suami', 'S2', 'Pendeta'),
(5, NULL, 2, 'Bangun Turnip', 'L', 'None', '1979-04-24', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(6, NULL, 2, 'Rippu br. Sinaga', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(7, NULL, 2, 'Lobak Febri Andrian', 'L', 'None', '0000-00-00', 0, '0000-00-00', 'Anak', 'SMA-SMK', 'Karyawan-Swasta'),
(8, NULL, 3, 'Kortiman Sihotang', 'L', 'None', '1981-08-28', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(9, NULL, 3, 'Chelsea Olivia Sihotang', 'P', 'None', '2008-12-19', 1, '0000-00-00', 'Anak', 'SMA-SMK', 'None'),
(10, NULL, 3, 'Rayhand Fransisco Sihotang', 'L', 'None', '2011-08-26', 1, '0000-00-00', 'Anak', 'SMP', 'None'),
(11, NULL, 3, 'Mika Karolina Sihotang', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'SMP', 'None'),
(12, NULL, 3, 'Michel Ourel Sihotang', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'SD', 'None'),
(13, NULL, 4, 'Betman Samosir', 'L', 'None', '1987-04-27', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(14, NULL, 4, 'Evrida br. Manurung', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(15, NULL, 4, 'Zefani br. Samosir', 'P', 'None', '2019-10-24', 1, '0000-00-00', 'Anak', 'None', 'None'),
(16, NULL, 4, 'Yuliani br. Samosir', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'None', 'None'),
(17, NULL, 4, 'Febrian Samosir', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'None', 'None'),
(18, NULL, 5, 'Kalara br. Sinaga', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Mandiri', 'SMA-SMK', 'Petani'),
(19, NULL, 6, 'Edi Rumapea', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(20, NULL, 6, 'Lisnawati br. Togatorop', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(21, NULL, 6, 'Putri Dwi Reza br. Rumapea', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'SMA-SMK', 'Karyawan-Swasta'),
(22, NULL, 6, 'Meytri br. Rumapea', 'P', 'None', '2012-05-28', 1, '0000-00-00', 'Anak', 'SMP', 'None'),
(23, NULL, 6, 'Nowela br. Rumapea', 'P', 'None', '2014-05-21', 0, '0000-00-00', 'Anak', 'SD', 'None'),
(24, NULL, 7, 'Made Hendra Situmorang', 'L', 'None', '1979-11-28', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Dokter'),
(25, NULL, 7, 'Santi Hariati br. Sidabutar', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(26, NULL, 7, 'Kevin Charisto Situmorang', 'L', 'None', '2007-11-21', 1, '0000-00-00', 'Anak', 'SMA-SMK', 'Wiraswasta'),
(27, NULL, 7, 'Angel Brace br. Situmorang', 'P', 'None', '0000-00-00', 0, '0000-00-00', 'Anak', 'SMP', 'None'),
(28, NULL, 7, 'Avika Yuni br. Situmorang', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'SD', 'None'),
(29, NULL, 7, 'Cris Raymond Situmorang', 'L', 'None', '2017-12-23', 0, '0000-00-00', 'Anak', 'None', 'None'),
(30, NULL, 7, 'Chiko Edoart Situmorang', 'L', 'None', '2020-04-26', 0, '0000-00-00', 'Anak', 'None', 'None'),
(31, NULL, 8, 'Manogu Haloho', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(32, NULL, 8, 'Rusli br. Sidabutar', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(33, NULL, 8, 'Sandi Albertus Haloho', 'L', 'None', '1991-03-24', 1, '0000-00-00', 'Anak', 'SMA-SMK', 'Petani'),
(34, NULL, 8, 'Talenta br. Haloho', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'SMA-SMK', 'Karyawan-Swasta'),
(35, NULL, 8, 'Rendi Haloho', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'SMA-SMK', 'Karyawan-Swasta'),
(36, NULL, 9, 'Sahat Martua Tambunan', 'L', 'None', '1980-02-27', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(37, NULL, 9, 'Nova Enjelina br. Simanjuntak', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(38, NULL, 9, 'Michael Tambunan', 'L', 'None', '2010-01-31', 1, '0000-00-00', 'Anak', 'SMP', 'None'),
(39, NULL, 9, 'Rehan Kelvin Tambunan', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'SD', 'None'),
(40, NULL, 9, 'Meilani br. Tambunan', 'P', 'None', '0000-00-00', 0, '0000-00-00', 'Anak', 'None', 'None'),
(41, NULL, 10, 'Tony Juliber Simanjuntak', 'L', 'None', '1983-07-24', 1, '0000-00-00', 'Suami', 'S1', 'Petani'),
(42, NULL, 10, 'Miur Dewanti br. Siringo-ringo', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(43, NULL, 10, 'Yohana Margareth Simanjuntak', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'None', 'Petani'),
(44, NULL, 10, 'Adrian Simanjuntak', 'L', 'None', '2016-02-21', 1, '0000-00-00', 'Anak', 'None', 'None'),
(45, NULL, 10, 'Adriel Simanjuntak', 'L', 'None', '2016-02-21', 1, '0000-00-00', 'Anak', 'None', 'None'),
(46, NULL, 11, 'Julpri Syahputra Napitupulu', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(47, NULL, 11, 'Lamminar br. Tamba', 'P', 'None', '1988-11-28', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(48, NULL, 11, 'Laira Arsinta Napitupulu', 'P', 'None', '2015-02-15', 1, '0000-00-00', 'Anak', 'None', 'None'),
(49, NULL, 11, 'Leoni Utari Napitupulu', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'None', 'None'),
(50, NULL, 11, 'Leontin Utrich Napitupulu', 'P', 'None', '0000-00-00', 0, '0000-00-00', 'Anak', 'None', 'None'),
(51, NULL, 11, 'Choky Aryan Napitupulu', 'P', 'None', '2021-08-22', 0, '0000-00-00', 'Anak', 'None', 'None'),
(52, NULL, 12, 'Dapot Sinaga', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(53, NULL, 12, 'Vivi Oktavia Sinaga', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'D3', 'Karyawan-Swasta'),
(54, NULL, 12, 'Hotlan Uli br. Sinaga', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'D3', 'Karyawan-Swasta'),
(55, NULL, 12, 'Samuel Lando Sinaga', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'S1', 'None'),
(56, NULL, 12, 'Nadia Florensia Sinaga', 'P', 'None', '2005-07-31', 1, '0000-00-00', 'Anak', 'SMA-SMK', 'None'),
(57, NULL, 12, 'Regina Insani Sinaga', 'P', 'None', '2010-10-21', 1, '0000-00-00', 'Anak', 'SMA-SMK', 'None'),
(58, NULL, 13, 'Meta Dumaria br. Samosir', 'P', 'None', '1985-08-30', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(59, NULL, 13, 'Eko Steven Simanjuntak', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'None', 'None'),
(60, NULL, 14, 'Juanda Nainggolan', 'L', 'None', '1992-08-09', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(61, NULL, 14, 'Jemina Mastianna br. Hutagaol', 'P', 'None', '1989-09-03', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(62, NULL, 14, 'Prilly Oktavia Nainggolan', 'P', 'None', '2023-06-03', 0, '0000-00-00', 'Anak', 'None', 'None'),
(63, NULL, 15, 'Gihon Purba', 'L', 'None', '1959-07-03', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(64, NULL, 15, 'Kesdi br. Nainggolan', 'P', 'None', '1955-02-10', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(65, NULL, 15, 'Lussianna br. Purba', 'P', 'None', '1989-12-05', 1, '0000-00-00', 'Anak', 'SMA-SMK', 'Karyawan-Swasta'),
(66, NULL, 15, 'Rahel br. PUrba', 'P', 'None', '2012-02-23', 1, '0000-00-00', 'AKL', 'SD', 'None'),
(67, NULL, 15, 'Verayanti br. Purba', 'P', 'None', '2013-03-08', 1, '0000-00-00', 'AKL', 'SD', 'None'),
(68, NULL, 16, 'Anggiat Silaban', 'L', 'None', '1957-09-28', 1, '0000-00-00', 'Suami', 'SMP', 'None'),
(69, NULL, 16, 'Marta br. Situmorang', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(70, NULL, 17, 'Abina br. Napitu', 'P', 'None', '1969-06-26', 1, '0000-00-00', 'Mandiri', 'SMA-SMK', 'Petani'),
(71, NULL, 18, 'Herli br. Tamba', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(72, NULL, 19, 'Rame br. Simanjuntak', 'P', 'None', '1952-11-27', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(73, NULL, 20, 'Kamisah br. Tamba', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(74, NULL, 21, 'Nurmaya br. Sihombing', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(75, NULL, 22, 'Nixon Silaban', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(76, NULL, 22, 'Hannauli br. Simanjuntak', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(77, NULL, 22, 'Novita Adelia br. Silaban', 'P', 'None', '2017-01-27', 1, '0000-00-00', 'Anak', 'None', 'None'),
(78, NULL, 22, 'Jonas Rivano Silaban', 'L', 'None', '2018-10-18', 1, '0000-00-00', 'Anak', 'None', 'None'),
(79, NULL, 23, 'Saut Hasiholan Siringo-ringo', 'L', 'None', '1978-10-28', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(80, NULL, 23, 'Juliana T. br. Sibarani', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(81, NULL, 23, 'Santa Karunia br. Siringo-ringo', 'P', 'None', '2014-02-26', 1, '0000-00-00', 'Istri', 'None', 'None'),
(82, NULL, 23, 'Greycia br. Siringo-ringo', 'P', 'None', '2016-11-18', 1, '0000-00-00', 'Anak', 'None', 'None'),
(83, NULL, 23, 'Giona Hotmarito br. Siringo-ringo', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'None', 'None'),
(84, NULL, 24, 'Doli Sortua Sinaga', 'L', 'None', '1971-09-29', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(85, NULL, 24, 'Menti br. Simanjuntak', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(86, NULL, 24, 'Dosmayanti Sinaga', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'SMA-SMK', 'Karyawan-Swasta'),
(87, NULL, 24, 'Julvinda Tiarulli Sinaga', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'SMA-SMK', 'Karyawan-Swasta'),
(88, NULL, 24, 'Immanuel Sinaga', 'L', 'None', '2007-12-23', 1, '0000-00-00', 'Anak', 'SMA-SMK', 'Karyawan-Swasta'),
(89, NULL, 25, 'Sopar Sihotang', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(90, NULL, 25, 'Sondang br. Simbolon', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(91, NULL, 25, 'Immanuel Sihotang', 'L', 'None', '2011-06-24', 0, '0000-00-00', 'Anak', 'SMP', 'None'),
(92, NULL, 25, 'Gabriel Jaya Sihotang', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'SD', 'None'),
(93, NULL, 25, 'Luis Raja Sihotang', 'L', 'None', '0000-00-00', 0, '0000-00-00', 'Anak', 'None', 'None'),
(102, NULL, 29, 'Bisker Sirait', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Suami', 'SMA-SMK', 'Petani'),
(103, NULL, 29, 'Tiolo br. Sinaga', 'P', 'None', '0000-00-00', 1, '0000-00-00', 'Istri', 'SMA-SMK', 'Petani'),
(104, NULL, 29, 'Anggun Enjelina br. Sirait', 'P', 'None', '1998-04-30', 1, '0000-00-00', 'Anak', 'S1', 'Karyawan-Swasta'),
(105, NULL, 29, 'Alfred Dayego Sirait', 'L', 'None', '0000-00-00', 1, '0000-00-00', 'Anak', 'S1', 'Karyawan-Swasta');

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
(1, 4, 1),
(2, 24, 1),
(3, 2, 2),
(4, 64, 2),
(5, 42, 2),
(6, 32, 2);

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
(1, 1, 'Ibadah I', 94, 330000),
(2, 1, 'Ibadah II', 0, 0),
(3, 1, 'Ibadah III', 0, 0),
(4, 1, 'Ibadah IV', 0, 0),
(5, 1, 'Ibadah V', 0, 0);

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
(1, 'tambah', 'sektor', '2026-08-31'),
(2, 'tambah', 'sektor', '2026-08-31'),
(3, 'tambah', 'sektor', '2026-08-31'),
(4, 'tambah', 'jemaat', '2026-08-31'),
(5, 'hapus', 'jemaat-anggota', '2026-08-31'),
(6, 'tambah', 'jemaat-anggota', '2026-08-31'),
(7, 'tambah', 'jemaat', '2026-08-31'),
(8, 'tambah', 'jemaat', '2026-08-31'),
(9, 'tambah', 'kebaktian', '2026-08-31'),
(10, 'tambah', 'jemaat', '2026-08-31'),
(11, 'tambah', 'jemaat', '2026-08-31'),
(12, 'tambah', 'jemaat', '2026-08-31'),
(13, 'tambah', 'jemaat', '2026-08-31'),
(14, 'tambah', 'jemaat', '2026-08-31'),
(15, 'tambah', 'jemaat', '2026-08-31'),
(16, 'tambah', 'jemaat', '2026-08-31'),
(17, 'tambah', 'jemaat', '2026-08-31'),
(18, 'tambah', 'jemaat', '2026-08-31'),
(19, 'tambah', 'jemaat', '2026-08-31'),
(20, 'tambah', 'jemaat', '2026-08-31'),
(21, 'tambah', 'jemaat', '2026-08-31'),
(22, 'tambah', 'jemaat', '2026-08-31'),
(23, 'tambah', 'jemaat', '2026-08-31'),
(24, 'tambah', 'jemaat', '2026-08-31'),
(25, 'tambah', 'jemaat', '2026-08-31'),
(26, 'tambah', 'jemaat', '2026-08-31'),
(27, 'tambah', 'jemaat', '2026-08-31'),
(28, 'tambah', 'jemaat', '2026-08-31'),
(29, 'tambah', 'jemaat', '2026-08-31'),
(30, 'tambah', 'kegiatan', '2026-08-31'),
(31, 'tambah', 'organisasi', '2026-08-31'),
(32, 'tambah', 'organisasi', '2026-08-31'),
(33, 'tambah', 'organisasi', '2026-08-31'),
(34, 'ubah', 'organisasi', '2026-08-31'),
(35, 'tambah', 'anggota-organisasi', '2026-08-31'),
(36, 'tambah', 'anggota-organisasi', '2026-08-31'),
(37, 'tambah', 'anggota-organisasi', '2026-08-31'),
(38, 'tambah', 'anggota-organisasi', '2026-08-31'),
(39, 'tambah', 'anggota-organisasi', '2026-08-31'),
(40, 'tambah', 'anggota-organisasi', '2026-08-31'),
(41, 'tambah', 'kegiatan', '2026-08-31'),
(42, 'tambah', 'kegiatan', '2026-08-31'),
(43, 'tambah', 'jemaat', '2026-08-31'),
(44, 'tambah', 'jemaat', '2026-08-31'),
(45, 'tambah', 'jemaat', '2026-08-31'),
(46, 'tambah', 'jemaat-anggota', '2026-08-31'),
(47, 'tambah', 'jemaat', '2026-08-31'),
(48, 'ubah', 'jemaat-anggota', '2026-08-31'),
(49, 'ubah', 'jemaat-anggota', '2026-09-01'),
(50, 'ubah', 'jemaat-anggota', '2026-09-01'),
(51, 'ubah', 'jemaat-anggota', '2026-09-01'),
(52, 'ubah', 'jemaat-anggota', '2026-09-01'),
(53, 'ubah', 'jemaat-anggota', '2026-09-01'),
(54, 'ubah', 'jemaat-anggota', '2026-09-01'),
(55, 'tambah', 'jabatan', '2026-09-01'),
(56, 'tambah', 'jabatan', '2026-09-01'),
(57, 'hapus', 'jabatan', '2026-09-01'),
(58, 'hapus', 'jabatan', '2026-09-01'),
(59, 'tambah', 'jabatan', '2026-09-01'),
(60, 'tambah', 'pejabat', '2026-09-01'),
(61, 'tambah', 'jabatan', '2026-09-01'),
(62, 'tambah', 'pejabat', '2026-09-01'),
(63, 'tambah', 'jabatan', '2026-09-01'),
(64, 'tambah', 'pejabat', '2026-09-01'),
(65, 'tambah', 'jemaat', '2026-09-01'),
(66, 'tambah', 'jemaat', '2026-09-01'),
(67, 'ubah', 'jemaat-anggota', '2026-09-02'),
(68, 'ubah', 'jemaat-anggota', '2026-09-02'),
(69, 'ubah', 'jemaat-anggota', '2026-09-02'),
(70, 'ubah', 'jemaat-anggota', '2026-09-02');

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
(1, 'Lukas MT. Sidabutar', 3, '2025-08-01', '0000-00-00'),
(2, 'Menti br. Simanjuntak', 4, '2026-02-01', '0000-00-00'),
(3, 'Sondang br. Simbolon', 5, '2026-02-01', '0000-00-00');

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
(3, 'Pimpinan Jemaat/ Ketua Majelis'),
(4, 'Lay Leader'),
(5, 'Sekretaris');

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
(1, '1-001', 'Aktif', 1, 'Jl. Kepiting III Blok DD, GM III, Medan Labuhan', '081361275358', '2026-08-31'),
(2, '1-002', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(3, '1-003', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(4, '1-004', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(5, '1-005', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(6, '1-006', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(7, '1-007', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(8, '1-008', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(9, '1-009', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(10, '1-010', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(11, '1-011', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(12, '1-012', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(13, '1-013', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(14, '1-014', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(15, '1-015', 'Aktif', 1, 'Huta II, Dolok Parmonangan, Kec. Bandar Huluan', '1', '2026-08-31'),
(16, '1-016', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(17, '1-017', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(18, '1-018', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(19, '1-019', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(20, '1-020', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(21, '1-021', 'Aktif', 1, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(22, '2-001', 'Aktif', 2, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(23, '2-002', 'Aktif', 2, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(24, '2-003', 'Aktif', 2, 'Pulau Batam', '1', '2026-08-31'),
(25, '2-004', 'Aktif', 2, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-08-31'),
(29, '2-005', 'Aktif', 2, 'Huta II Dolok Parmonangan, Kec. Bandar Huluan, Simalungun', '1', '2026-09-01');

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
(1, '2026-08-30');

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
(1, '2026-08-25', 'Retreat Keluarga Besar GMI Dolok Parmonangan', 'Pantai Salbe Tiga Ras'),
(2, '2026-12-25', 'Hari Natal', 'Natal Umum'),
(3, '2026-12-24', 'Natal Sekolah Minggu', 'Anak-anak');

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
(2, 2, '2013-02-19'),
(3, 4, '2013-02-19'),
(4, 84, '1997-06-25'),
(5, 85, '1997-06-25'),
(6, 4, '2013-02-19');

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
(1, 'P2MI'),
(2, 'PWMI'),
(3, 'P3MI');

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
(1, 4, 3),
(2, 85, 4),
(3, 90, 5);

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
(1, '1', 'Anugerah'),
(2, '2', 'Gloria'),
(3, '3', 'Maranatha');

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
(2, 2, 1, '0000-00-00'),
(3, 3, 0, '0000-00-00'),
(4, 4, 1, '2001-05-24'),
(5, 5, 1, '0000-00-00'),
(6, 6, 1, '0000-00-00'),
(7, 7, 0, '0000-00-00'),
(8, 8, 1, '0000-00-00'),
(9, 9, 0, '0000-00-00'),
(10, 10, 0, '0000-00-00'),
(11, 11, 0, '0000-00-00'),
(12, 12, 0, '0000-00-00'),
(13, 13, 1, '0000-00-00'),
(14, 14, 1, '0000-00-00'),
(15, 15, 0, '0000-00-00'),
(16, 16, 0, '0000-00-00'),
(17, 17, 0, '0000-00-00'),
(18, 18, 1, '0000-00-00'),
(19, 19, 1, '0000-00-00'),
(20, 20, 1, '0000-00-00'),
(21, 21, 1, '0000-00-00'),
(22, 22, 0, '0000-00-00'),
(23, 23, 0, '0000-00-00'),
(24, 24, 1, '0000-00-00'),
(25, 25, 1, '0000-00-00'),
(26, 26, 1, '0000-00-00'),
(27, 27, 0, '0000-00-00'),
(28, 28, 0, '0000-00-00'),
(29, 29, 0, '0000-00-00'),
(30, 30, 0, '0000-00-00'),
(31, 31, 1, '0000-00-00'),
(32, 32, 1, '0000-00-00'),
(33, 33, 1, '0000-00-00'),
(34, 34, 1, '0000-00-00'),
(35, 35, 1, '0000-00-00'),
(36, 36, 1, '0000-00-00'),
(37, 37, 1, '0000-00-00'),
(38, 38, 0, '0000-00-00'),
(39, 39, 0, '0000-00-00'),
(40, 40, 0, '0000-00-00'),
(41, 41, 1, '0000-00-00'),
(42, 42, 1, '0000-00-00'),
(43, 43, 0, '0000-00-00'),
(44, 44, 0, '0000-00-00'),
(45, 45, 0, '0000-00-00'),
(46, 46, 1, '0000-00-00'),
(47, 47, 1, '0000-00-00'),
(48, 48, 0, '0000-00-00'),
(49, 49, 0, '0000-00-00'),
(50, 50, 0, '0000-00-00'),
(51, 51, 0, '0000-00-00'),
(52, 52, 1, '0000-00-00'),
(53, 53, 1, '0000-00-00'),
(54, 54, 1, '0000-00-00'),
(55, 55, 1, '0000-00-00'),
(56, 56, 1, '0000-00-00'),
(57, 57, 0, '0000-00-00'),
(58, 58, 1, '0000-00-00'),
(59, 59, 0, '0000-00-00'),
(60, 60, 1, '0000-00-00'),
(61, 61, 1, '0000-00-00'),
(62, 62, 0, '0000-00-00'),
(63, 63, 1, '0000-00-00'),
(64, 64, 1, '0000-00-00'),
(65, 65, 1, '0000-00-00'),
(66, 66, 0, '0000-00-00'),
(67, 67, 0, '0000-00-00'),
(68, 68, 1, '0000-00-00'),
(69, 69, 0, '0000-00-00'),
(70, 70, 1, '0000-00-00'),
(71, 71, 1, '0000-00-00'),
(72, 72, 1, '0000-00-00'),
(73, 73, 1, '0000-00-00'),
(74, 74, 1, '0000-00-00'),
(75, 75, 1, '0000-00-00'),
(76, 76, 1, '0000-00-00'),
(77, 77, 0, '0000-00-00'),
(78, 78, 0, '0000-00-00'),
(79, 79, 1, '0000-00-00'),
(80, 80, 1, '0000-00-00'),
(81, 81, 0, '0000-00-00'),
(82, 82, 0, '0000-00-00'),
(83, 83, 0, '0000-00-00'),
(84, 84, 1, '0000-00-00'),
(85, 85, 1, '0000-00-00'),
(86, 86, 1, '0000-00-00'),
(87, 87, 1, '0000-00-00'),
(88, 88, 1, '0000-00-00'),
(89, 89, 1, '0000-00-00'),
(90, 90, 1, '0000-00-00'),
(91, 91, 0, '0000-00-00'),
(92, 92, 0, '0000-00-00'),
(93, 93, 0, '0000-00-00'),
(94, 94, 1, '0000-00-00'),
(95, 95, 0, '0000-00-00'),
(96, 96, 0, '0000-00-00'),
(97, 97, 0, '0000-00-00'),
(98, 98, 0, '0000-00-00'),
(99, 99, 1, '0000-00-00'),
(100, 100, 1, '2026-09-10'),
(101, 101, 1, '0000-00-00'),
(102, 102, 1, '0000-00-00'),
(103, 103, 1, '0000-00-00'),
(104, 104, 1, '0000-00-00'),
(105, 105, 1, '0000-00-00');

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
  MODIFY `anggotajemaat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tanggotaorganisasi`
--
ALTER TABLE `tanggotaorganisasi`
  MODIFY `anggotaorganisasi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tdatakebaktian`
--
ALTER TABLE `tdatakebaktian`
  MODIFY `datakebaktian_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `thistoryapp`
--
ALTER TABLE `thistoryapp`
  MODIFY `historyapp_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `thistorypejabat`
--
ALTER TABLE `thistorypejabat`
  MODIFY `historypejabat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tjabatan`
--
ALTER TABLE `tjabatan`
  MODIFY `jabatan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tjemaat`
--
ALTER TABLE `tjemaat`
  MODIFY `jemaat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tkebaktian`
--
ALTER TABLE `tkebaktian`
  MODIFY `kebaktian_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tkegiatan`
--
ALTER TABLE `tkegiatan`
  MODIFY `kegiatan_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `organisasi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tpejabat`
--
ALTER TABLE `tpejabat`
  MODIFY `pejabat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tsektor`
--
ALTER TABLE `tsektor`
  MODIFY `sektor_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tsidi`
--
ALTER TABLE `tsidi`
  MODIFY `sidi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `twafat`
--
ALTER TABLE `twafat`
  MODIFY `wafat_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
