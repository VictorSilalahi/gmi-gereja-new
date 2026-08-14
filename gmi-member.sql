-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2026 at 04:11 PM
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
(4, 'D-II', 'test', 'silalahitotok@gmail.com', '2026-07-29'),
(5, 'D-III', 'test', 'silalahitotok@gmail.com', '2026-08-04');

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
  `kabupaten_id` int(11) NOT NULL,
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

INSERT INTO `tgereja` (`gereja_id`, `distrik`, `email`, `password`, `nama_gereja`, `alamat`, `kabupaten_id`, `lat`, `lng`, `kondisi_bangunan`, `kepemilikan`, `db_id`, `identity_link`, `path_sk`, `created_at`, `updated_at`) VALUES
('9beaf151-63ee-4d4a-8520-8918f74db30b', 'D-II', 'silalahitotok@gmail.com', 'testing', 'GMI Kasih Karunia', 'Jl Hang Tuah', 1077, '', '', 'Permanen', 'Milik Sendiri', 'g-dnja1q', 'QBPh9aPWLoUv', 'public/uploads/sk/1781845451_629fb7490b55adac04f9.jpg', '2026-06-19', '2026-06-19'),
('6158f1d6-9e21-4c3e-9a54-2dcda0078e32', 'D-II', 'victorbiz766hi@gmail.com', 'MvBf6xEy', 'gmixxx', 'Jl Madong Lubis no 9 Medan', 1077, '3.6097084012021723', '98.64418029785158', 'Permanen', 'Milik Sendiri', 'g-nlvrul', 'YDJWGALoYfR0', 'public/uploads/sk/1786700508_f509d22cb2cb4ccfddb8.jpg', '2026-08-14', '2026-08-14');

-- --------------------------------------------------------

--
-- Table structure for table `tkabupaten`
--

CREATE TABLE `tkabupaten` (
  `kabupaten_id` bigint(20) UNSIGNED NOT NULL,
  `provinsi_id` int(11) NOT NULL,
  `kabupaten` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tkabupaten`
--

INSERT INTO `tkabupaten` (`kabupaten_id`, `provinsi_id`, `kabupaten`, `id`) VALUES
(1029, 117, 'Kabupaten Aceh Selatan', 11),
(1030, 117, 'Kabupaten Aceh Tenggara', 11),
(1031, 117, 'Kabupaten Aceh Timur', 11),
(1032, 117, 'Kabupaten Aceh Tengah', 11),
(1033, 117, 'Kabupaten Aceh Barat', 11),
(1034, 117, 'Kabupaten Aceh Besar', 11),
(1035, 117, 'Kabupaten Pidie', 11),
(1036, 117, 'Kabupaten Aceh Utara', 11),
(1037, 117, 'Kabupaten Simeulue', 11),
(1038, 117, 'Kabupaten Aceh Singkil', 11),
(1039, 117, 'Kabupaten Bireuen', 11),
(1040, 117, 'Kabupaten Aceh Barat Daya', 11),
(1041, 117, 'Kabupaten Gayo Lues', 11),
(1042, 117, 'Kabupaten Aceh Jaya', 11),
(1043, 117, 'Kabupaten Nagan Raya', 11),
(1044, 117, 'Kabupaten Aceh Tamiang', 11),
(1045, 117, 'Kabupaten Bener Meriah', 11),
(1046, 117, 'Kabupaten Pidie Jaya', 11),
(1047, 117, 'Kota Banda Aceh', 12),
(1048, 117, 'Kota Sabang', 12),
(1049, 117, 'Kota Lhokseumawe', 12),
(1050, 117, 'Kota Langsa', 12),
(1051, 117, 'Kota Subulussalam', 12),
(1052, 118, 'Kabupaten Tapanuli Tengah', 12),
(1053, 118, 'Kabupaten Tapanuli Utara', 12),
(1054, 118, 'Kabupaten Tapanuli Selatan', 12),
(1055, 118, 'Kabupaten Nias', 12),
(1056, 118, 'Kabupaten Langkat', 12),
(1057, 118, 'Kabupaten Karo', 12),
(1058, 118, 'Kabupaten Deli Serdang', 12),
(1059, 118, 'Kabupaten Simalungun', 12),
(1060, 118, 'Kabupaten Asahan', 12),
(1061, 118, 'Kabupaten Labuhanbatu', 12),
(1062, 118, 'Kabupaten Dairi', 12),
(1063, 118, 'Kabupaten Toba', 12),
(1064, 118, 'Kabupaten Mandailing Natal', 12),
(1065, 118, 'Kabupaten Nias Selatan', 12),
(1066, 118, 'Kabupaten Pakpak Bharat', 12),
(1067, 118, 'Kabupaten Humbang Hasundutan', 12),
(1068, 118, 'Kabupaten Samosir', 12),
(1069, 118, 'Kabupaten Serdang Bedagai', 12),
(1070, 118, 'Kabupaten Batu Bara', 12),
(1071, 118, 'Kabupaten Padang Lawas Utara', 12),
(1072, 118, 'Kabupaten Padang Lawas', 12),
(1073, 118, 'Kabupaten Labuhanbatu Selatan', 12),
(1074, 118, 'Kabupaten Labuhanbatu Utara', 12),
(1075, 118, 'Kabupaten Nias Utara', 12),
(1076, 118, 'Kabupaten Nias Barat', 12),
(1077, 118, 'Kota Medan', 13),
(1078, 118, 'Kota Pematangsiantar', 13),
(1079, 118, 'Kota Sibolga', 13),
(1080, 118, 'Kota Tanjungbalai', 13),
(1081, 118, 'Kota Binjai', 13),
(1082, 118, 'Kota Tebing Tinggi', 13),
(1083, 118, 'Kota Padangsidimpuan', 13),
(1084, 118, 'Kota Gunungsitoli', 13),
(1085, 119, 'Kabupaten Pesisir Selatan', 13),
(1086, 119, 'Kabupaten Solok', 13),
(1087, 119, 'Kabupaten Sijunjung', 13),
(1088, 119, 'Kabupaten Tanah Datar', 13),
(1089, 119, 'Kabupaten Padang Pariaman', 13),
(1090, 119, 'Kabupaten Agam', 13),
(1091, 119, 'Kabupaten Lima Puluh Kota', 13),
(1092, 119, 'Kabupaten Pasaman', 13),
(1093, 119, 'Kabupaten Kepulauan Mentawai', 13),
(1094, 119, 'Kabupaten Dharmasraya', 13),
(1095, 119, 'Kabupaten Solok Selatan', 13),
(1096, 119, 'Kabupaten Pasaman Barat', 13),
(1097, 119, 'Kota Padang', 14),
(1098, 119, 'Kota Solok', 14),
(1099, 119, 'Kota Sawahlunto', 14),
(1100, 119, 'Kota Padang Panjang', 14),
(1101, 119, 'Kota Bukittinggi', 14),
(1102, 119, 'Kota Payakumbuh', 14),
(1103, 119, 'Kota Pariaman', 14),
(1104, 120, 'Kabupaten Kampar', 14),
(1105, 120, 'Kabupaten Indragiri Hulu', 14),
(1106, 120, 'Kabupaten Bengkalis', 14),
(1107, 120, 'Kabupaten Indragiri Hilir', 14),
(1108, 120, 'Kabupaten Pelalawan', 14),
(1109, 120, 'Kabupaten Rokan Hulu', 14),
(1110, 120, 'Kabupaten Rokan Hilir', 14),
(1111, 120, 'Kabupaten Siak', 14),
(1112, 120, 'Kabupaten Kuantan Singingi', 14),
(1113, 120, 'Kabupaten Kepulauan Meranti', 14),
(1114, 120, 'Kota Pekanbaru', 15),
(1115, 120, 'Kota Dumai', 15),
(1116, 121, 'Kabupaten Kerinci', 15),
(1117, 121, 'Kabupaten Merangin', 15),
(1118, 121, 'Kabupaten Sarolangun', 15),
(1119, 121, 'Kabupaten Batanghari', 15),
(1120, 121, 'Kabupaten Muaro Jambi', 15),
(1121, 121, 'Kabupaten Tanjung Jabung Barat', 15),
(1122, 121, 'Kabupaten Tanjung Jabung Timur', 15),
(1123, 121, 'Kabupaten Bungo', 15),
(1124, 121, 'Kabupaten Tebo', 15),
(1125, 121, 'Kota Jambi', 16),
(1126, 121, 'Kota Sungai Penuh', 16),
(1127, 122, 'Kabupaten Ogan Komering Ulu', 16),
(1128, 122, 'Kabupaten Ogan Komering Ilir', 16),
(1129, 122, 'Kabupaten Muara Enim', 16),
(1130, 122, 'Kabupaten Lahat', 16),
(1131, 122, 'Kabupaten Musi Rawas', 16),
(1132, 122, 'Kabupaten Musi Banyuasin', 16),
(1133, 122, 'Kabupaten Banyuasin', 16),
(1134, 122, 'Kabupaten Ogan Komering Ulu Timur', 16),
(1135, 122, 'Kabupaten Ogan Komering Ulu Selatan', 16),
(1136, 122, 'Kabupaten Ogan Ilir', 16),
(1137, 122, 'Kabupaten Empat Lawang', 16),
(1138, 122, 'Kabupaten Penukal Abab Lematang Ilir', 16),
(1139, 122, 'Kabupaten Musi Rawas Utara', 16),
(1140, 122, 'Kota Palembang', 17),
(1141, 122, 'Kota Pagar Alam', 17),
(1142, 122, 'Kota Lubuk Linggau', 17),
(1143, 122, 'Kota Prabumulih', 17),
(1144, 123, 'Kabupaten Bengkulu Selatan', 17),
(1145, 123, 'Kabupaten Rejang Lebong', 17),
(1146, 123, 'Kabupaten Bengkulu Utara', 17),
(1147, 123, 'Kabupaten Kaur', 17),
(1148, 123, 'Kabupaten Seluma', 17),
(1149, 123, 'Kabupaten Mukomuko', 17),
(1150, 123, 'Kabupaten Lebong', 17),
(1151, 123, 'Kabupaten Kepahiang', 17),
(1152, 123, 'Kabupaten Bengkulu Tengah', 17),
(1153, 123, 'Kota Bengkulu', 18),
(1154, 124, 'Kabupaten Lampung Selatan', 18),
(1155, 124, 'Kabupaten Lampung Tengah', 18),
(1156, 124, 'Kabupaten Lampung Utara', 18),
(1157, 124, 'Kabupaten Lampung Barat', 18),
(1158, 124, 'Kabupaten Tulang Bawang', 18),
(1159, 124, 'Kabupaten Tanggamus', 18),
(1160, 124, 'Kabupaten Lampung Timur', 18),
(1161, 124, 'Kabupaten Way Kanan', 18),
(1162, 124, 'Kabupaten Pesawaran', 18),
(1163, 124, 'Kabupaten Pringsewu', 18),
(1164, 124, 'Kabupaten Mesuji', 18),
(1165, 124, 'Kabupaten Tulang Bawang Barat', 18),
(1166, 124, 'Kabupaten Pesisir Barat', 18),
(1167, 124, 'Kota Bandar Lampung', 19),
(1168, 124, 'Kota Metro', 19),
(1169, 125, 'Kabupaten Bangka', 19),
(1170, 125, 'Kabupaten Belitung', 19),
(1171, 125, 'Kabupaten Bangka Selatan', 19),
(1172, 125, 'Kabupaten Bangka Tengah', 19),
(1173, 125, 'Kabupaten Bangka Barat', 19),
(1174, 125, 'Kabupaten Belitung Timur', 19),
(1175, 125, 'Kota Pangkal Pinang', 20),
(1176, 126, 'Kabupaten Bintan', 21),
(1177, 126, 'Kabupaten Karimun', 21),
(1178, 126, 'Kabupaten Natuna', 21),
(1179, 126, 'Kabupaten Lingga', 21),
(1180, 126, 'Kabupaten Kepulauan Anambas', 21),
(1181, 126, 'Kota Batam', 22),
(1182, 126, 'Kota Tanjung Pinang', 22),
(1183, 127, 'Kabupaten Administrasi Kepulauan Seribu', 31),
(1184, 127, 'Kota Administrasi Jakarta Pusat', 32),
(1185, 127, 'Kota Administrasi Jakarta Utara ', 32),
(1186, 127, 'Kota Administrasi Jakarta Barat', 32),
(1187, 127, 'Kota Administrasi Jakarta Selatan', 32),
(1188, 127, 'Kota Administrasi Jakarta Timur', 32),
(1189, 128, 'Kabupaten Bogor', 32),
(1190, 128, 'Kabupaten Sukabumi', 32),
(1191, 128, 'Kabupaten Cianjur', 32),
(1192, 128, 'Kabupaten Bandung', 32),
(1193, 128, 'Kabupaten Garut', 32),
(1194, 128, 'Kabupaten Tasikmalaya', 32),
(1195, 128, 'Kabupaten Ciamis', 32),
(1196, 128, 'Kabupaten Kuningan', 32),
(1197, 128, 'Kabupaten Cirebon', 32),
(1198, 128, 'Kabupaten Majalengka', 32),
(1199, 128, 'Kabupaten Sumedang', 32),
(1200, 128, 'Kabupaten Indramayu', 32),
(1201, 128, 'Kabupaten Subang', 32),
(1202, 128, 'Kabupaten Purwakarta', 32),
(1203, 128, 'Kabupaten Karawang', 32),
(1204, 128, 'Kabupaten Bekasi', 32),
(1205, 128, 'Kabupaten Bandung Barat', 32),
(1206, 128, 'Kabupaten Pangandaran', 32),
(1207, 128, 'Kota Bogor', 33),
(1208, 128, 'Kota Sukabumi', 33),
(1209, 128, 'Kota Bandung', 33),
(1210, 128, 'Kota Cirebon', 33),
(1211, 128, 'Kota Bekasi', 33),
(1212, 128, 'Kota Depok', 33),
(1213, 128, 'Kota Cimahi', 33),
(1214, 128, 'Kota Tasikmalaya', 33),
(1215, 128, 'Kota Banjar', 33),
(1216, 129, 'Kabupaten Cilacap', 33),
(1217, 129, 'Kabupaten Banyumas', 33),
(1218, 129, 'Kabupaten Purbalingga', 33),
(1219, 129, 'Kabupaten Banjarnegara', 33),
(1220, 129, 'Kabupaten Kebumen', 33),
(1221, 129, 'Kabupaten Purworejo', 33),
(1222, 129, 'Kabupaten Wonosobo', 33),
(1223, 129, 'Kabupaten Magelang', 33),
(1224, 129, 'Kabupaten Boyolali', 33),
(1225, 129, 'Kabupaten Klaten', 33),
(1226, 129, 'Kabupaten Sukoharjo', 33),
(1227, 129, 'Kabupaten Wonogiri', 33),
(1228, 129, 'Kabupaten Karanganyar', 33),
(1229, 129, 'Kabupaten Sragen', 33),
(1230, 129, 'Kabupaten Grobogan', 33),
(1231, 129, 'Kabupaten Blora', 33),
(1232, 129, 'Kabupaten Rembang', 33),
(1233, 129, 'Kabupaten Pati', 33),
(1234, 129, 'Kabupaten Kudus', 33),
(1235, 129, 'Kabupaten Jepara', 33),
(1236, 129, 'Kabupaten Demak', 33),
(1237, 129, 'Kabupaten Semarang', 33),
(1238, 129, 'Kabupaten Temanggung', 33),
(1239, 129, 'Kabupaten Kendal', 33),
(1240, 129, 'Kabupaten Batang', 33),
(1241, 129, 'Kabupaten Pekalongan', 33),
(1242, 129, 'Kabupaten Pemalang', 33),
(1243, 129, 'Kabupaten Tegal', 33),
(1244, 129, 'Kabupaten Brebes', 33),
(1245, 129, 'Kota Magelang', 34),
(1246, 129, 'Kota Surakarta', 34),
(1247, 129, 'Kota Salatiga', 34),
(1248, 129, 'Kota Semarang', 34),
(1249, 129, 'Kota Pekalongan', 34),
(1250, 129, 'Kota Tegal', 34),
(1251, 130, 'Kabupaten Kulon Progo', 34),
(1252, 130, 'Kabupaten Bantul', 34),
(1253, 130, 'Kabupaten Gunungkidul', 34),
(1254, 130, 'Kabupaten Sleman', 34),
(1255, 130, 'Kota Yogyakarta', 35),
(1256, 131, 'Kabupaten Pacitan', 35),
(1257, 131, 'Kabupaten Ponorogo', 35),
(1258, 131, 'Kabupaten Trenggalek', 35),
(1259, 131, 'Kabupaten Tulungagung', 35),
(1260, 131, 'Kabupaten Blitar', 35),
(1261, 131, 'Kabupaten Kediri', 35),
(1262, 131, 'Kabupaten Malang', 35),
(1263, 131, 'Kabupaten Lumajang', 35),
(1264, 131, 'Kabupaten Jember', 35),
(1265, 131, 'Kabupaten Banyuwangi', 35),
(1266, 131, 'Kabupaten Bondowoso', 35),
(1267, 131, 'Kabupaten Situbondo', 35),
(1268, 131, 'Kabupaten Probolinggo', 35),
(1269, 131, 'Kabupaten Pasuruan', 35),
(1270, 131, 'Kabupaten Sidoarjo', 35),
(1271, 131, 'Kabupaten Mojokerto', 35),
(1272, 131, 'Kabupaten Jombang', 35),
(1273, 131, 'Kabupaten Nganjuk', 35),
(1274, 131, 'Kabupaten Madiun', 35),
(1275, 131, 'Kabupaten Magetan', 35),
(1276, 131, 'Kabupaten Ngawi', 35),
(1277, 131, 'Kabupaten Bojonegoro', 35),
(1278, 131, 'Kabupaten Tuban', 35),
(1279, 131, 'Kabupaten Lamongan', 35),
(1280, 131, 'Kabupaten Gresik', 35),
(1281, 131, 'Kabupaten Bangkalan', 35),
(1282, 131, 'Kabupaten Sampang', 35),
(1283, 131, 'Kabupaten Pamekasan', 35),
(1284, 131, 'Kabupaten Sumenep', 35),
(1285, 131, 'Kota Kediri', 36),
(1286, 131, 'Kota Blitar', 36),
(1287, 131, 'Kota Malang', 36),
(1288, 131, 'Kota Probolinggo', 36),
(1289, 131, 'Kota Pasuruan', 36),
(1290, 131, 'Kota Mojokerto', 36),
(1291, 131, 'Kota Madiun', 36),
(1292, 131, 'Kota Surabaya', 36),
(1293, 131, 'Kota Batu', 36),
(1294, 132, 'Kabupaten Pandeglang', 36),
(1295, 132, 'Kabupaten Lebak', 36),
(1296, 132, 'Kabupaten Tangerang', 36),
(1297, 132, 'Kabupaten Serang', 36),
(1298, 132, 'Kota Tangerang', 37),
(1299, 132, 'Kota Cilegon', 37),
(1300, 132, 'Kota Serang', 37),
(1301, 132, 'Kota Tangerang Selatan', 37),
(1302, 133, 'Kabupaten Jembrana', 51),
(1303, 133, 'Kabupaten Tabanan', 51),
(1304, 133, 'Kabupaten Badung', 51),
(1305, 133, 'Kabupaten Gianyar', 51),
(1306, 133, 'Kabupaten Klungkung', 51),
(1307, 133, 'Kabupaten Bangli', 51),
(1308, 133, 'Kabupaten Karangasem', 51),
(1309, 133, 'Kabupaten Buleleng', 51),
(1310, 133, 'Kota Denpasar', 52),
(1311, 134, 'Kabupaten Lombok Barat', 52),
(1312, 134, 'Kabupaten Lombok Tengah', 52),
(1313, 134, 'Kabupaten Lombok Timur', 52),
(1314, 134, 'Kabupaten Sumbawa', 52),
(1315, 134, 'Kabupaten Dompu', 52),
(1316, 134, 'Kabupaten Bima', 52),
(1317, 134, 'Kabupaten Sumbawa Barat', 52),
(1318, 134, 'Kabupaten Lombok Utara', 52),
(1319, 134, 'Kota Mataram', 53),
(1320, 134, 'Kota Bima', 53),
(1321, 135, 'Kabupaten Kupang', 53),
(1322, 135, 'Kabupaten Timor Tengah Selatan', 53),
(1323, 135, 'Kabupaten Timor Tengah Utara', 53),
(1324, 135, 'Kabupaten Belu', 53),
(1325, 135, 'Kabupaten Alor', 53),
(1326, 135, 'Kabupaten Flores Timur', 53),
(1327, 135, 'Kabupaten Sikka', 53),
(1328, 135, 'Kabupaten Ende', 53),
(1329, 135, 'Kabupaten Ngada', 53),
(1330, 135, 'Kabupaten Manggarai', 53),
(1331, 135, 'Kabupaten Sumba Timur', 53),
(1332, 135, 'Kabupaten Sumba Barat', 53),
(1333, 135, 'Kabupaten Lembata', 53),
(1334, 135, 'Kabupaten Rote Ndao', 53),
(1335, 135, 'Kabupaten Manggarai Barat', 53),
(1336, 135, 'Kabupaten Nagekeo', 53),
(1337, 135, 'Kabupaten Sumba Tengah', 53),
(1338, 135, 'Kabupaten Sumba Barat Daya', 53),
(1339, 135, 'Kabupaten Manggarai Timur', 53),
(1340, 135, 'Kabupaten Sabu Raijua', 53),
(1341, 135, 'Kabupaten Malaka', 53),
(1342, 135, 'Kota Kupang', 54),
(1343, 136, 'Kabupaten Sambas', 61),
(1344, 136, 'Kabupaten Mempawah', 61),
(1345, 136, 'Kabupaten Sanggau', 61),
(1346, 136, 'Kabupaten Ketapang', 61),
(1347, 136, 'Kabupaten Sintang', 61),
(1348, 136, 'Kabupaten Kapuas Hulu', 61),
(1349, 136, 'Kabupaten Bengkayang', 61),
(1350, 136, 'Kabupaten Landak', 61),
(1351, 136, 'Kabupaten Sekadau', 61),
(1352, 136, 'Kabupaten Melawi', 61),
(1353, 136, 'Kabupaten Kayong Utara', 61),
(1354, 136, 'Kabupaten Kubu Raya', 61),
(1355, 136, 'Kota Pontianak', 62),
(1356, 136, 'Kota Singkawang', 62),
(1357, 137, 'Kabupaten Kotawaringin Barat', 62),
(1358, 137, 'Kabupaten Kotawaringin Timur', 62),
(1359, 137, 'Kabupaten Kapuas', 62),
(1360, 137, 'Kabupaten Barito Selatan', 62),
(1361, 137, 'Kabupaten Barito Utara', 62),
(1362, 137, 'Kabupaten Katingan', 62),
(1363, 137, 'Kabupaten Seruyan', 62),
(1364, 137, 'Kabupaten Sukamara', 62),
(1365, 137, 'Kabupaten Lamandau', 62),
(1366, 137, 'Kabupaten Gunung Mas', 62),
(1367, 137, 'Kabupaten Pulang Pisau', 62),
(1368, 137, 'Kabupaten Murung Raya', 62),
(1369, 137, 'Kabupaten Barito Timur', 62),
(1370, 137, 'Kota Palangkaraya', 63),
(1371, 138, 'Kabupaten Tanah Laut', 63),
(1372, 138, 'Kabupaten Kotabaru', 63),
(1373, 138, 'Kabupaten Banjar', 63),
(1374, 138, 'Kabupaten Barito Kuala', 63),
(1375, 138, 'Kabupaten Tapin', 63),
(1376, 138, 'Kabupaten Hulu Sungai Selatan', 63),
(1377, 138, 'Kabupaten Hulu Sungai Tengah', 63),
(1378, 138, 'Kabupaten Hulu Sungai Utara', 63),
(1379, 138, 'Kabupaten Tabalong', 63),
(1380, 138, 'Kabupaten Tanah Bumbu', 63),
(1381, 138, 'Kabupaten Balangan', 63),
(1382, 138, 'Kota Banjarmasin', 64),
(1383, 138, 'Kota Banjarbaru', 64),
(1384, 139, 'Kabupaten Paser', 64),
(1385, 139, 'Kabupaten Kutai Kartanegara', 64),
(1386, 139, 'Kabupaten Berau', 64),
(1387, 139, 'Kabupaten Kutai Barat', 64),
(1388, 139, 'Kabupaten Kutai Timur', 64),
(1389, 139, 'Kabupaten Penajam Paser Utara', 64),
(1390, 139, 'Kabupaten Mahakam Ulu', 64),
(1391, 139, 'Kota Balikpapan', 65),
(1392, 139, 'Kota Samarinda', 65),
(1393, 139, 'Kota Bontang', 65),
(1394, 140, 'Kabupaten Bulungan', 65),
(1395, 140, 'Kabupaten Malinau', 65),
(1396, 140, 'Kabupaten Nunukan', 65),
(1397, 140, 'Kabupaten Tana Tidung', 65),
(1398, 140, 'Kota Tarakan', 66),
(1399, 141, 'Kabupaten Bolaang Mongondow', 71),
(1400, 141, 'Kabupaten Minahasa', 71),
(1401, 141, 'Kabupaten Kepulauan Sangihe', 71),
(1402, 141, 'Kabupaten Kepulauan Talaud', 71),
(1403, 141, 'Kabupaten Minahasa Selatan', 71),
(1404, 141, 'Kabupaten Minahasa Utara', 71),
(1405, 141, 'Kabupaten Minahasa Tenggara', 71),
(1406, 141, 'Kabupaten Bolaang Mongondow Utara', 71),
(1407, 141, 'Kabupaten Kep. Siau Tagulandang Biaro', 71),
(1408, 141, 'Kabupaten Bolaang Mongondow Timur', 71),
(1409, 141, 'Kabupaten Bolaang Mongondow Selatan', 71),
(1410, 141, 'Kota Manado', 72),
(1411, 141, 'Kota Bitung', 72),
(1412, 141, 'Kota Tomohon', 72),
(1413, 141, 'Kota Kotamobagu', 72),
(1414, 142, 'Kabupaten Banggai', 72),
(1415, 142, 'Kabupaten Poso', 72),
(1416, 142, 'Kabupaten Donggala', 72),
(1417, 142, 'Kabupaten Toli-Toli', 72),
(1418, 142, 'Kabupaten Buol', 72),
(1419, 142, 'Kabupaten Morowali', 72),
(1420, 142, 'Kabupaten Banggai Kepulauan', 72),
(1421, 142, 'Kabupaten Parigi Moutong', 72),
(1422, 142, 'Kabupaten Tojo Una Una', 72),
(1423, 142, 'Kabupaten Sigi', 72),
(1424, 142, 'Kabupaten Banggai Laut', 72),
(1425, 142, 'Kabupaten Morowali Utara', 72),
(1426, 142, 'Kota Palu', 73),
(1427, 143, 'Kabupaten Kepulauan Selayar', 73),
(1428, 143, 'Kabupaten Bulukumba', 73),
(1429, 143, 'Kabupaten Bantaeng', 73),
(1430, 143, 'Kabupaten Jeneponto', 73),
(1431, 143, 'Kabupaten Takalar', 73),
(1432, 143, 'Kabupaten Gowa', 73),
(1433, 143, 'Kabupaten Sinjai', 73),
(1434, 143, 'Kabupaten Bone', 73),
(1435, 143, 'Kabupaten Maros', 73),
(1436, 143, 'Kabupaten Pangkajene dan Kepulauan', 73),
(1437, 143, 'Kabupaten Barru', 73),
(1438, 143, 'Kabupaten Soppeng', 73),
(1439, 143, 'Kabupaten Wajo', 73),
(1440, 143, 'Kabupaten Sidenreng Rappang', 73),
(1441, 143, 'Kabupaten Pinrang', 73),
(1442, 143, 'Kabupaten Enrekang', 73),
(1443, 143, 'Kabupaten Luwu', 73),
(1444, 143, 'Kabupaten Tana Toraja', 73),
(1445, 143, 'Kabupaten Luwu Utara', 73),
(1446, 143, 'Kabupaten Luwu Timur', 73),
(1447, 143, 'Kabupaten Toraja Utara', 73),
(1448, 143, 'Kota Makassar', 74),
(1449, 143, 'Kota Parepare', 74),
(1450, 143, 'Kota Palopo', 74),
(1451, 144, 'Kabupaten Kolaka', 74),
(1452, 144, 'Kabupaten Konawe', 74),
(1453, 144, 'Kabupaten Muna', 74),
(1454, 144, 'Kabupaten Buton', 74),
(1455, 144, 'Kabupaten Konawe Selatan', 74),
(1456, 144, 'Kabupaten Bombana', 74),
(1457, 144, 'Kabupaten Wakatobi', 74),
(1458, 144, 'Kabupaten Kolaka Utara', 74),
(1459, 144, 'Kabupaten Konawe Utara', 74),
(1460, 144, 'Kabupaten Buton Utara', 74),
(1461, 144, 'Kabupaten Kolaka Timur', 74),
(1462, 144, 'Kabupaten Konawe Kepulauan', 74),
(1463, 144, 'Kabupaten Muna Barat', 74),
(1464, 144, 'Kabupaten Buton Tengah', 74),
(1465, 144, 'Kabupaten Buton Selatan', 74),
(1466, 144, 'Kota Kendari', 75),
(1467, 144, 'Kota Bau Bau', 75),
(1468, 145, 'Kabupaten Gorontalo', 75),
(1469, 145, 'Kabupaten Boalemo', 75),
(1470, 145, 'Kabupaten Bone Bolango', 75),
(1471, 145, 'Kabupaten Pohuwato', 75),
(1472, 145, 'Kabupaten Gorontalo Utara', 75),
(1473, 145, 'Kota Gorontalo', 76),
(1474, 146, 'Kabupaten Pasangkayu', 76),
(1475, 146, 'Kabupaten Mamuju', 76),
(1476, 146, 'Kabupaten Mamasa', 76),
(1477, 146, 'Kabupaten Polewali Mandar', 76),
(1478, 146, 'Kabupaten Majene', 76),
(1479, 146, 'Kabupaten Mamuju Tengah', 76),
(1480, 147, 'Kabupaten Maluku Tengah', 81),
(1481, 147, 'Kabupaten Maluku Tenggara', 81),
(1482, 147, 'Kabupaten Kepulauan Tanimbar', 81),
(1483, 147, 'Kabupaten Buru', 81),
(1484, 147, 'Kabupaten Seram Bagian Timur', 81),
(1485, 147, 'Kabupaten Seram Bagian Barat', 81),
(1486, 147, 'Kabupaten Kepulauan Aru', 81),
(1487, 147, 'Kabupaten Maluku Barat Daya', 81),
(1488, 147, 'Kabupaten Buru Selatan', 81),
(1489, 147, 'Kota Ambon', 82),
(1490, 147, 'Kota Tual', 82),
(1491, 148, 'Kabupaten Halmahera Barat', 82),
(1492, 148, 'Kabupaten Halmahera Tengah', 82),
(1493, 148, 'Kabupaten Halmahera Utara', 82),
(1494, 148, 'Kabupaten Halmahera Selatan', 82),
(1495, 148, 'Kabupaten Kepulauan Sula', 82),
(1496, 148, 'Kabupaten Halmahera Timur', 82),
(1497, 148, 'Kabupaten Pulau Morotai', 82),
(1498, 148, 'Kabupaten Pulau Taliabu', 82),
(1499, 148, 'Kota Ternate', 83),
(1500, 148, 'Kota Tidore Kepulauan', 83),
(1501, 149, 'Kabupaten Jayapura', 91),
(1502, 149, 'Kabupaten Kepulauan Yapen', 91),
(1503, 149, 'Kabupaten Biak Numfor', 91),
(1504, 149, 'Kabupaten Sarmi', 91),
(1505, 149, 'Kabupaten Keerom', 91),
(1506, 149, 'Kabupaten Waropen', 91),
(1507, 149, 'Kabupaten Supiori', 91),
(1508, 149, 'Kabupaten Mamberamo Raya', 91),
(1509, 149, 'Kota Jayapura', 92),
(1510, 150, 'Kabupaten Manokwari', 92),
(1511, 150, 'Kabupaten Fak Fak', 92),
(1512, 150, 'Kabupaten Teluk Bintuni', 92),
(1513, 150, 'Kabupaten Teluk Wondama', 92),
(1514, 150, 'Kabupaten Kaimana', 92),
(1515, 150, 'Kabupaten Manokwari Selatan', 92),
(1516, 150, 'Kabupaten Pegunungan Arfak', 92),
(1517, 151, 'Kabupaten Merauke', 93),
(1518, 151, 'Kabupaten Boven Digoel', 93),
(1519, 151, 'Kabupaten Mappi', 93),
(1520, 151, 'Kabupaten Asmat', 93),
(1521, 152, 'Kabupaten Nabire', 94),
(1522, 152, 'Kabupaten Puncak Jaya', 94),
(1523, 152, 'Kabupaten Paniai', 94),
(1524, 152, 'Kabupaten Mimika', 94),
(1525, 152, 'Kabupaten Puncak', 94),
(1526, 152, 'Kabupaten Dogiyai', 94),
(1527, 152, 'Kabupaten Intan Jaya', 94),
(1528, 152, 'Kabupaten Deiyai', 94),
(1529, 153, 'Kabupaten Jayawijaya', 95),
(1530, 153, 'Kabupaten Pegunungan Bintang', 95),
(1531, 153, 'Kabupaten Yahukimo', 95),
(1532, 153, 'Kabupaten Tolikara', 95),
(1533, 153, 'Kabupaten Mamberamo Tengah', 95),
(1534, 153, 'Kabupaten Yalimo', 95),
(1535, 153, 'Kabupaten Lanny Jaya', 95),
(1536, 153, 'Kabupaten Nduga', 95),
(1537, 154, 'Kabupaten Sorong', 96),
(1538, 154, 'Kabupaten Sorong Selatan', 96),
(1539, 154, 'Kabupaten Raja Ampat', 96),
(1540, 154, 'Kabupaten Tambrauw', 96),
(1541, 154, 'Kabupaten Maybrat', 96),
(1542, 154, 'Kota Sorong', 97);

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
(3, 'Pdt Lubis', 'ilalahitotok@gmail.com'),
(4, 'Pdt Lubis', 'silalahitotok@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `tprovinsi`
--

CREATE TABLE `tprovinsi` (
  `provinsi_id` bigint(20) UNSIGNED NOT NULL,
  `provinsi` varchar(50) NOT NULL,
  `id` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tprovinsi`
--

INSERT INTO `tprovinsi` (`provinsi_id`, `provinsi`, `id`) VALUES
(117, 'Aceh', '11'),
(118, 'Sumatera Utara', '12'),
(119, 'Sumatera Barat', '13'),
(120, 'Riau', '14'),
(121, 'Jambi', '15'),
(122, 'Sumatera Selatan', '16'),
(123, 'Bengkulu', '17'),
(124, 'Lampung', '18'),
(125, 'Kepulauan Bangka Belitung', '19'),
(126, 'Kepulauan Riau', '21'),
(127, 'DKI Jakarta', '31'),
(128, 'Jawa Barat', '32'),
(129, 'Jawa Tengah', '33'),
(130, 'Daerah Istimewa Yogyakarta', '34'),
(131, 'Jawa Timur', '35'),
(132, 'Banten', '36'),
(133, 'Bali', '51'),
(134, 'Nusa Tenggara Barat', '52'),
(135, 'Nusa Tenggara Timur', '53'),
(136, 'Kalimantan Barat', '61'),
(137, 'Kalimantan Tengah', '62'),
(138, 'Kalimantan Selatan', '63'),
(139, 'Kalimantan Timur', '64'),
(140, 'Kalimantan Utara', '65'),
(141, 'Sulawesi Utara', '71'),
(142, 'Sulawesi Tengah', '72'),
(143, 'Sulawesi Selatan', '73'),
(144, 'Sulawesi Tenggara', '74'),
(145, 'Gorontalo', '75'),
(146, 'Sulawesi Barat', '76'),
(147, 'Maluku', '81'),
(148, 'Maluku Utara', '82'),
(149, 'Papua', '91'),
(150, 'Papua Barat', '92'),
(151, 'Papua Selatan', '93'),
(152, 'Papua Tengah', '94'),
(153, 'Papua Pegunungan', '95'),
(154, 'Papua Barat Daya', '96');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tdistrik`
--
ALTER TABLE `tdistrik`
  ADD UNIQUE KEY `distrik_id` (`distrik_id`);

--
-- Indexes for table `tkabupaten`
--
ALTER TABLE `tkabupaten`
  ADD UNIQUE KEY `kabupaten_id` (`kabupaten_id`);

--
-- Indexes for table `tpendeta`
--
ALTER TABLE `tpendeta`
  ADD UNIQUE KEY `pendeta_id` (`pendeta_id`);

--
-- Indexes for table `tprovinsi`
--
ALTER TABLE `tprovinsi`
  ADD UNIQUE KEY `provinsi_id` (`provinsi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tdistrik`
--
ALTER TABLE `tdistrik`
  MODIFY `distrik_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tkabupaten`
--
ALTER TABLE `tkabupaten`
  MODIFY `kabupaten_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1543;

--
-- AUTO_INCREMENT for table `tpendeta`
--
ALTER TABLE `tpendeta`
  MODIFY `pendeta_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tprovinsi`
--
ALTER TABLE `tprovinsi`
  MODIFY `provinsi_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
