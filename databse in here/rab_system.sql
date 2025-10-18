-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2025 at 09:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rab_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `id_material` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `specification` text DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`id_material`, `id_user`, `name`, `specification`, `unit`, `quantity`, `price`) VALUES
(1, 1, 'baja ringan banget', '8 mili', '10 meter', 100, 75000),
(2, 3, 'pasir', 'pasir pantai', '5 sak', 5, 100000),
(3, 3, 'Genteng', 'buat latihan silat', 'pcs', 16, 90000),
(4, 6, 'semen', 'kaki roda', 'sak', 9, 80000),
(85, 1, 'Besi Beton', 'Diameter 10mm', 'batang', 200, 60000),
(86, 1, 'Paku', 'Ukuran 5cm galvanis', 'kg', 50, 25000),
(87, 2, 'Cat Tembok', 'Dulux warna putih 5L', 'kaleng', 30, 150000),
(88, 2, 'Kawat Bendrat', 'Kawat baja 1mm', 'kg', 100, 18000),
(89, 3, 'Batu Bata Merah', 'Ukuran standar 5x10x20 cm', 'buah', 10000, 800),
(90, 3, 'Keramik Lantai', '40x40 Motif Marmer', 'dus', 150, 95000),
(91, 5, 'Kayu Balok', 'Ukuran 5x10x400 cm', 'batang', 70, 95000),
(92, 5, 'Triplek', 'Tebal 12mm', 'lembar', 80, 65000),
(93, 6, 'Cat Kayu', 'Warna coklat glossy 2.5L', 'kaleng', 25, 120000),
(94, 6, 'Genteng Beton', 'Warna abu-abu', 'buah', 600, 7500),
(95, 1, 'Batu Kali', 'Batu pondasi ukuran besar', 'truk', 5, 850000),
(96, 1, 'Besi Hollow', 'Hollow galvanis 4x4cm', 'batang', 120, 78000),
(97, 1, 'Semen Tiga Roda', 'Semen portland 40kg', 'sak', 100, 79000),
(98, 1, 'Cat Nippon Paint', 'Warna putih interior 5L', 'kaleng', 20, 145000),
(99, 2, 'Paku Beton', 'Ukuran 7 cm galvanis', 'kg', 80, 30000),
(100, 2, 'Triplek 9mm', 'Triplek meranti tebal 9mm', 'lembar', 60, 75000),
(101, 2, 'Pintu Kayu', 'Kayu jati ukuran 90x210 cm', 'unit', 10, 950000),
(102, 2, 'Engsel Pintu', 'Engsel stainless ukuran 4 inch', 'buah', 200, 10000),
(103, 3, 'Kabel NYM', 'Kabel listrik 3x1.5mm 50 meter', 'roll', 25, 280000),
(104, 3, 'Stop Kontak', 'Stop kontak tanam Panasonic', 'buah', 150, 18000),
(105, 3, 'Pipa PVC 3 inch', 'Rucika tipe AW', 'batang', 80, 45000),
(106, 3, 'Kran Taman', 'Kran kuningan ¾ inch', 'buah', 50, 75000),
(107, 5, 'Keramik Dinding', '25x40 Motif Batu Alam', 'dus', 100, 85000),
(108, 5, 'Granit Tile', '60x60 Motif Marmer', 'dus', 60, 145000),
(109, 5, 'Cat Eksterior', 'Nippon Weatherguard 5L', 'kaleng', 15, 180000),
(110, 5, 'Lem Fox', 'Lem kuning kaleng 1L', 'kaleng', 40, 35000),
(111, 6, 'Besi Siku', 'Ukuran 4x4x4mm panjang 6 meter', 'batang', 70, 120000),
(112, 6, 'Plat Besi', 'Plat baja tebal 3mm', 'lembar', 50, 260000),
(113, 6, 'Las Listrik', 'Elektroda las 3.2mm 20kg', 'kotak', 30, 340000),
(114, 6, 'Cat Anti Karat', 'Warna abu-abu 5L', 'kaleng', 25, 160000);

-- --------------------------------------------------------

--
-- Table structure for table `rab`
--

CREATE TABLE `rab` (
  `id_rab` varchar(50) NOT NULL,
  `parent_id` varchar(50) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `project_name` varchar(100) DEFAULT NULL,
  `unit` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `additional_info` text DEFAULT NULL,
  `jumlahTotal` int(11) DEFAULT 0,
  `pembulatan` int(11) DEFAULT 0,
  `permeterpersegi` int(11) DEFAULT 0,
  `timestamps` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `version_created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rab`
--

INSERT INTO `rab` (`id_rab`, `parent_id`, `id_user`, `project_name`, `unit`, `type`, `location`, `notes`, `additional_info`, `jumlahTotal`, `pembulatan`, `permeterpersegi`, `timestamps`, `created_at`, `version_created_at`) VALUES
('RAB-68edf61698053', 'RAB-68edf61698053', 1, 'testing', 1, 'a2', 'jakarte', NULL, NULL, 0, 0, 0, '2025-10-14 07:04:54', '2025-10-14 07:04:54', '2025-10-18 12:10:51'),
('RAB-68edf68eb5487', 'RAB-68edf68eb5487', 1, 'Tester cuyys', 1, 'a22', 'jakartea', NULL, NULL, 0, 0, 0, '2025-10-14 07:06:54', '2025-10-14 07:06:54', '2025-10-18 12:10:51'),
('RAB-68edf7f12326d', 'RAB-68edf7f12326d', 1, 'tester1', 1, '3', 'bandung', NULL, NULL, 0, 0, 0, '2025-10-14 07:12:49', '2025-10-14 07:12:49', '2025-10-18 12:10:51'),
('RAB-68ee16b599025', 'RAB-68ee16b599025', 1, 'testing3', 1, '9', 'medan', 'maling besi', 'aobvuabov', 0, 0, 0, '2025-10-14 09:24:05', '2025-10-14 09:24:05', '2025-10-18 12:10:51'),
('RAB-68ee177f009e1', 'RAB-68ee177f009e1', 1, 'TestingBambang', 1, '19', 'Jajargenjang', 'tambahin aja', 'aovniavav', 0, 0, 0, '2025-10-14 09:27:27', '2025-10-14 09:27:27', '2025-10-18 12:10:51'),
('RAB-68ee1db488d3a', 'RAB-68ee1db488d3a', 1, 'testerrrrr90', 1, '45', 'jajargenjangdua', 'dimana aja', 'advdavav', 0, 0, 0, '2025-10-14 09:53:56', '2025-10-14 09:53:56', '2025-10-18 12:10:51'),
('RAB-68ee2495c7fa8', 'RAB-68ee2495c7fa8', 1, 'RABADIK', 1, '67', 'layanglayang', 'mana ada ko repoo', '', 0, 0, 0, '2025-10-14 10:23:17', '2025-10-14 10:23:17', '2025-10-18 12:10:51'),
('RAB-68ee28ce31b76', 'RAB-68ee28ce31b76', 1, 'teeessscuyy', 1, '123', 'layanglayanggenjang', 'kumala', 'vabarbar', 0, 0, 0, '2025-10-14 10:41:18', '2025-10-14 10:41:18', '2025-10-18 12:10:51'),
('RAB-68f2fd8dbb03f', 'RAB-68f2fd8dbb03f', 1, 'Testing', 1, '300', 'Bandung', 'test', '', 0, 0, 0, '2025-10-18 02:38:05', '2025-10-18 02:38:05', '2025-10-18 12:10:51'),
('RAB-68f30409a2bf4', 'RAB-68f30409a2bf4', 1, 'testingg', 67, '120', 'condet', 'Rumah Modern', '', 0, 0, 0, '2025-10-18 03:05:45', '2025-10-18 03:05:45', '2025-10-18 12:10:51'),
('RAB-68f3126aaa0b4', 'RAB-68f3126aaa0b4', 1, 'Perumahan Kalibaru permai', 1, '34', 'Depok, Jawa Barat, Indonesia', '', '', 0, 0, 0, '2025-10-18 04:07:06', '2025-10-18 04:07:06', '2025-10-18 12:10:51'),
('RAB-68f318d2b4991', 'RAB-68f318d2b4991', 1, 'Finalproject', 1, '120', 'Condet', 'Rumah modern', '', 0, 0, 0, '2025-10-18 04:34:26', '2025-10-18 04:34:26', '2025-10-18 12:10:51'),
('RAB-68f318d2b4991-REV-20251018-065144', 'RAB-68f318d2b4991-REV-20251018-065144', 1, 'Finalproject', 1, '120', 'Condet', 'Rumah modern', NULL, 0, 0, 0, '2025-10-18 04:51:44', '2025-10-18 04:51:44', '2025-10-18 12:10:51'),
('RAB-68f323e97062d', NULL, 1, 'Contohmasroy', 1, '90', 'Condet', 'Modern home', '', 0, 0, 0, '2025-10-18 05:21:45', '2025-10-18 05:21:45', '2025-10-18 12:21:45'),
('RAB-68f32824bef2e', NULL, 1, 'bikin baru', 1, '3', 'bogor', 'testing rab type 3 number 10 location bogot', '', 0, 0, 0, '2025-10-18 05:39:48', '2025-10-18 05:39:48', '2025-10-18 12:39:48'),
('RAB-68f32c4c74c94', NULL, 1, 'abiyu', 1, '9', 'cibinong', 'bogor', '', 0, 0, 0, '2025-10-18 05:57:32', '2025-10-18 05:57:32', '2025-10-18 12:57:32'),
('RAB-68f334cf4b95a', NULL, 1, 'Testerfix', 1, '120', 'bandung', 'modern home', '', 0, 0, 0, '2025-10-18 06:33:51', '2025-10-18 06:33:51', '2025-10-18 13:33:51'),
('RAB-68f334cf4b95a-REV-20251018-091514', 'RAB-68f334cf4b95a', 1, 'Testerfixxxx', 1, '120', 'bandung', 'modern home', NULL, 1239044, 1239000, 10325, '2025-10-18 07:15:14', '2025-10-18 07:15:14', '2025-10-18 14:15:14'),
('RAB-68f334cf4b95a-REV-20251018-091514-REV-20251018', 'RAB-68f334cf4b95a-REV-20251018-091514', 1, 'Testerfixxxxccc', 1, '120', 'bandung', 'modern home', NULL, 0, 0, 0, '2025-10-18 07:23:05', '2025-10-18 07:23:05', '2025-10-18 14:23:05'),
('RAB-68f337e29ca30', NULL, 1, 'coba1', 91, '76', 'depok', 'modern home', NULL, 5158000, 5158000, 67868, '2025-10-18 06:46:58', '2025-10-18 06:46:58', '2025-10-18 13:46:58'),
('RAB-68f337e29ca30-REV-20251018-090241', 'RAB-68f337e29ca30', 1, 'coba1', 91, '76', 'depok', 'modern home biyu', NULL, 5158000, 5158000, 67868, '2025-10-18 07:02:41', '2025-10-18 07:02:41', '2025-10-18 14:02:41'),
('RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', 'RAB-68f337e29ca30-REV-20251018-090241', 1, 'coba1', 92, '76', 'depok', 'modern home biyu', NULL, 0, 0, 0, '2025-10-18 07:03:06', '2025-10-18 07:03:06', '2025-10-18 14:03:06');

-- --------------------------------------------------------

--
-- Table structure for table `rab_detail`
--

CREATE TABLE `rab_detail` (
  `id` int(11) NOT NULL,
  `id_rab` varchar(50) DEFAULT NULL,
  `id_material` int(11) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `material_name` varchar(100) DEFAULT NULL,
  `unit` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unitPrice` int(11) DEFAULT NULL,
  `totalCost` int(11) DEFAULT NULL,
  `timestamps` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rab_detail`
--

INSERT INTO `rab_detail` (`id`, `id_rab`, `id_material`, `category`, `material_name`, `unit`, `quantity`, `unitPrice`, `totalCost`, `timestamps`) VALUES
(3, 'RAB-68edf61698053', NULL, 'modern', 'genteng', 'pcs', 50, 10003, 100000, '2025-10-14 07:04:54'),
(4, 'RAB-68edf68eb5487', NULL, 'moderna', 'semen', 'sak', 14, 100000, 10000000, '2025-10-14 07:06:54'),
(5, 'RAB-68edf68eb5487', NULL, 'moderna', 'baja', 'batang', 80, 81811, 8188111, '2025-10-14 07:06:54'),
(6, 'RAB-68edf7f12326d', NULL, 'modern', 'genteng', 'pcs', 11, 10000, 100000, '2025-10-14 07:12:49'),
(7, 'RAB-68edf7f12326d', NULL, 'modern', 'baja ringan', 'batang', 15, 50000, 6000000, '2025-10-14 07:12:49'),
(8, 'RAB-68ee16b599025', NULL, 'PONDASI', 'Batu Bata Merah', 'buah', 1, 800, 800, '2025-10-14 09:24:05'),
(9, 'RAB-68ee16b599025', NULL, 'TEMBOK', 'Batu Kali', 'truk', 1, 850000, 850000, '2025-10-14 09:24:05'),
(10, 'RAB-68ee16b599025', NULL, '', 'Besi Siku', 'batang', 1, 120000, 120000, '2025-10-14 09:24:05'),
(11, 'RAB-68ee177f009e1', NULL, 'PONDASIII', 'baja ringan banget', '10 meter', 1, 75000, 75000, '2025-10-14 09:27:27'),
(12, 'RAB-68ee177f009e1', NULL, 'TEMBOK', 'Stop Kontak', 'buah', 2, 18000, 18000, '2025-10-14 09:27:27'),
(13, 'RAB-68ee177f009e1', NULL, '', 'Cat Anti Karat', 'kaleng', 1, 160000, 160000, '2025-10-14 09:27:27'),
(14, 'RAB-68ee177f009e1', NULL, '', 'Engsel Pintu', 'buah', 1, 10000, 10000, '2025-10-14 09:27:27'),
(15, 'RAB-68ee177f009e1', NULL, '', 'Cat Kayu', 'kaleng', 1, 120000, 120000, '2025-10-14 09:27:27'),
(16, 'RAB-68ee177f009e1', NULL, '', 'Triplek 9mm', 'lembar', 1, 75000, 75000, '2025-10-14 09:27:27'),
(17, 'RAB-68ee177f009e1', NULL, '', 'Triplek', 'lembar', 1, 65000, 65000, '2025-10-14 09:27:27'),
(18, 'RAB-68ee177f009e1', NULL, '', 'Semen Tiga Roda', 'sak', 1, 79000, 79000, '2025-10-14 09:27:27'),
(19, 'RAB-68ee1db488d3a', NULL, 'vadvav', 'Batu Bata Merah banget', 'buah', 1, 800, 800, '2025-10-14 09:53:56'),
(20, 'RAB-68ee1db488d3a', NULL, 'aevavadv', 'baja ringan banget cuyyhh', '10 meter', 1, 75000, 75000, '2025-10-14 09:53:56'),
(21, 'RAB-68ee1db488d3a', NULL, '', 'Pipa PVC 3 inch', 'batang', 1, 45000, 45000, '2025-10-14 09:53:56'),
(22, 'RAB-68ee1db488d3a', NULL, '', 'Besi Beton', 'batang', 1, 60000, 60000, '2025-10-14 09:53:56'),
(23, 'RAB-68ee1db488d3a', NULL, '', 'Cat Nippon Paint', 'kaleng', 1, 145000, 145000, '2025-10-14 09:53:56'),
(24, 'RAB-68ee2495c7fa8', NULL, 'PONDASIII', 'Besi Beton', 'batang', 3, 60000, 60000, '2025-10-14 10:23:17'),
(25, 'RAB-68ee2495c7fa8', NULL, 'tembok', 'Besi Hollow', 'batang', 3, 78000, 78000, '2025-10-14 10:23:17'),
(26, 'RAB-68ee2495c7fa8', NULL, '', 'Kran Taman', 'buah', 5, 75000, 75000, '2025-10-14 10:23:17'),
(27, 'RAB-68ee2495c7fa8', NULL, '', 'Batu Bata Merah', 'buah', 6, 800, 800, '2025-10-14 10:23:17'),
(28, 'RAB-68ee2495c7fa8', NULL, '', 'Paku', 'kg', 6, 25000, 25000, '2025-10-14 10:23:17'),
(29, 'RAB-68ee2495c7fa8', NULL, '', 'semen', 'sak', 4, 80000, 80000, '2025-10-14 10:23:17'),
(30, 'RAB-68ee28ce31b76', NULL, 'PONDASIII', 'Batu Kali', 'truk', 2, 900000, 1800000, '2025-10-14 10:41:18'),
(31, 'RAB-68ee28ce31b76', NULL, 'tembok', 'Keramik Lantai', 'dus', 3, 95000, 285000, '2025-10-14 10:41:18'),
(32, 'RAB-68ee28ce31b76', NULL, '', 'Cat Eksterior', 'kaleng', 4, 180000, 720000, '2025-10-14 10:41:18'),
(33, 'RAB-68ee28ce31b76', NULL, '', 'baja ringan banget', '10 meter', 6, 75000, 450000, '2025-10-14 10:41:18'),
(34, 'RAB-68ee28ce31b76', NULL, '', 'Stop Kontak', 'buah', 11, 18000, 198000, '2025-10-14 10:41:18'),
(35, 'RAB-68ee28ce31b76', NULL, '', 'Las Listrik', 'kotak', 5, 34000, 170000, '2025-10-14 10:41:18'),
(36, 'RAB-68f2fd8dbb03f', NULL, 'Pondasi', 'Batu Kali', 'pcs', 6, 10000, 60000, '2025-10-18 02:38:05'),
(37, 'RAB-68f2fd8dbb03f', NULL, 'Lantai', 'Besi Hollow', 'batang', 1, 78003, 78003, '2025-10-18 02:38:05'),
(38, 'RAB-68f2fd8dbb03f', NULL, '', 'pasir', '5 sak', 1, 100000, 100000, '2025-10-18 02:38:05'),
(39, 'RAB-68f3126aaa0b4', NULL, 'Pembuatan Pintu', 'Cat Eksterior', 'kaleng', 3, 180000, 540000, '2025-10-18 04:07:06'),
(40, 'RAB-68f3126aaa0b4', NULL, 'Pembuatan Jendela', 'Besi Siku', 'batang', 2, 120000, 240000, '2025-10-18 04:07:06'),
(41, 'RAB-68f3126aaa0b4', NULL, '', 'Kawat Bendrat', 'kg', 4, 18000, 72000, '2025-10-18 04:07:06'),
(42, 'RAB-68f3126aaa0b4', NULL, '', 'Kayu Balok', 'batang', 3, 95000, 285000, '2025-10-18 04:07:06'),
(43, 'RAB-68f3126aaa0b4', NULL, '', 'Granit Tile', 'dus', 5, 145000, 11693, '2025-10-18 04:07:06'),
(44, 'RAB-68f3126aaa0b4', NULL, '', 'Besi Beton', 'batang', 1, 12000000, 193548, '2025-10-18 04:07:06'),
(45, 'RAB-68f318d2b4991', NULL, 'Atap', 'Batu Kali', 'truk', 1, 850000, 850000, '2025-10-18 04:34:26'),
(46, 'RAB-68f318d2b4991', NULL, 'lantai', 'Besi Beton', 'batang', 1, 60000, 60000, '2025-10-18 04:34:26'),
(47, 'RAB-68f318d2b4991', NULL, 'Pondasi', 'Batu Kali', 'truk', 1, 850000, 10625, '2025-10-18 04:34:26'),
(48, 'RAB-68f318d2b4991', NULL, 'lantai', 'Besi Hollow', 'batang', 1, 78000, 975, '2025-10-18 04:34:26'),
(49, 'RAB-68f318d2b4991', NULL, '', 'Cat Kayu', 'kaleng', 1, 120000, 1500, '2025-10-18 04:34:26'),
(50, 'RAB-68f318d2b4991-REV-20251018-065144', NULL, 'Atap', 'Batu Kali', 'truk', 1, 850000, 850000, '2025-10-18 04:51:44'),
(51, 'RAB-68f318d2b4991-REV-20251018-065144', NULL, 'lantai', 'Besi Beton', 'batang', 1, 60000, 60000, '2025-10-18 04:51:44'),
(52, 'RAB-68f318d2b4991-REV-20251018-065144', NULL, 'Pondasi', 'Batu Kali', 'truk', 1, 850000, 10625, '2025-10-18 04:51:44'),
(53, 'RAB-68f318d2b4991-REV-20251018-065144', NULL, 'lantai', 'Besi Hollow', 'batang', 1, 78000, 975, '2025-10-18 04:51:44'),
(54, 'RAB-68f318d2b4991-REV-20251018-065144', NULL, '', 'Cat Kayu', 'kaleng', 1, 120000, 1500, '2025-10-18 04:51:44'),
(55, 'RAB-68f323e97062d', NULL, 'Atap', 'Genteng', 'pcs', 2, 90000, 180000, '2025-10-18 05:21:45'),
(56, 'RAB-68f323e97062d', NULL, 'Tembok', 'Cat Anti Karat', 'kaleng', 3, 160000, 480000, '2025-10-18 05:21:45'),
(57, 'RAB-68f323e97062d', NULL, 'Kanopi', 'Paku', 'kg', 1, 25000, 25000, '2025-10-18 05:21:45'),
(58, 'RAB-68f323e97062d', NULL, 'pagar', 'Batu Bata Merah', 'buah', 106, 800, 84800, '2025-10-18 05:21:45'),
(59, 'RAB-68f323e97062d', NULL, '', 'Kayu Balok', 'batang', 4, 95000, 380000, '2025-10-18 05:21:45'),
(60, 'RAB-68f323e97062d', NULL, '', 'Besi Siku', 'batang', 5, 120000, 8955, '2025-10-18 05:21:45'),
(61, 'RAB-68f323e97062d', NULL, '', 'Plat Besi', 'lembar', 20, 260000, 77611, '2025-10-18 05:21:45'),
(62, 'RAB-68f323e97062d', NULL, '', 'baja ringan banget', '10 meter', 20, 75000, 22388, '2025-10-18 05:21:45'),
(63, 'RAB-68f32824bef2e', NULL, 'pintu', 'Pintu Kayu', 'unit', 1, 950000, 950000, '2025-10-18 05:39:48'),
(64, 'RAB-68f32824bef2e', NULL, 'pagar', 'Cat Kayu', 'kaleng', 1, 120000, 120000, '2025-10-18 05:39:48'),
(65, 'RAB-68f32824bef2e', NULL, '', 'Besi Hollow', 'batang', 1, 78000, 7800, '2025-10-18 05:39:48'),
(66, 'RAB-68f32c4c74c94', NULL, 'PONDASI', 'Besi Siku', 'batang', 1, 120000, 120000, '2025-10-18 05:57:32'),
(67, 'RAB-68f32c4c74c94', NULL, 'Atap', 'baja ringan banget', '10 meter', 1, 75000, 7500, '2025-10-18 05:57:32'),
(68, 'RAB-68f334cf4b95a', NULL, 'Pondasi', 'Batu Bata Merah', 'buah', 500, 800, 400000, '2025-10-18 06:33:51'),
(69, 'RAB-68f334cf4b95a', NULL, 'Kanopi', 'Keramik Lantai', 'dus', 5, 95000, 475000, '2025-10-18 06:33:51'),
(70, 'RAB-68f334cf4b95a', NULL, '', 'Cat Kayu', 'kaleng', 3, 120000, 360000, '2025-10-18 06:33:51'),
(71, 'RAB-68f334cf4b95a', NULL, '', 'Besi Siku', 'batang', 3, 120000, 4044, '2025-10-18 06:33:51'),
(72, 'RAB-68f337e29ca30', NULL, 'Aatap', 'Besi Siku', 'batang', 3, 120000, 360000, '2025-10-18 06:46:58'),
(73, 'RAB-68f337e29ca30', NULL, 'Aatap', 'Cat Kayu', 'kaleng', 4, 120000, 480000, '2025-10-18 06:46:58'),
(74, 'RAB-68f337e29ca30', NULL, 'lantai', 'semen', 'sak', 11, 80000, 880000, '2025-10-18 06:46:58'),
(75, 'RAB-68f337e29ca30', NULL, 'lantai', 'Plat Besi', 'lembar', 12, 260000, 3120000, '2025-10-18 06:46:58'),
(76, 'RAB-68f337e29ca30', NULL, 'kanopi', 'Cat Anti Karat', 'kaleng', 1, 160000, 160000, '2025-10-18 06:46:58'),
(77, 'RAB-68f337e29ca30', NULL, 'kanopi', 'Semen Tiga Roda', 'sak', 2, 79000, 158000, '2025-10-18 06:46:58'),
(78, 'RAB-68f337e29ca30-REV-20251018-090241', NULL, 'Aatap', 'Besi Siku', 'batang', 3, 120000, 360000, '2025-10-18 07:02:41'),
(79, 'RAB-68f337e29ca30-REV-20251018-090241', NULL, 'Aatap', 'Cat Kayu', 'kaleng', 4, 120000, 480000, '2025-10-18 07:02:41'),
(80, 'RAB-68f337e29ca30-REV-20251018-090241', NULL, 'lantai', 'semen', 'sak', 11, 80000, 880000, '2025-10-18 07:02:41'),
(81, 'RAB-68f337e29ca30-REV-20251018-090241', NULL, 'lantai', 'Plat Besi', 'lembar', 12, 260000, 3120000, '2025-10-18 07:02:41'),
(82, 'RAB-68f337e29ca30-REV-20251018-090241', NULL, 'kanopi', 'Cat Anti Karat', 'kaleng', 1, 160000, 160000, '2025-10-18 07:02:41'),
(83, 'RAB-68f337e29ca30-REV-20251018-090241', NULL, 'kanopi', 'Semen Tiga Roda', 'sak', 2, 79000, 158000, '2025-10-18 07:02:41'),
(84, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Besi Siku', 'batang', 3, 120000, 360000, '2025-10-18 07:03:06'),
(85, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Cat Kayu', 'kaleng', 4, 120000, 480000, '2025-10-18 07:03:06'),
(86, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'semen', 'sak', 11, 80000, 880000, '2025-10-18 07:03:06'),
(87, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'Plat Besi', 'lembar', 12, 260000, 3120000, '2025-10-18 07:03:06'),
(88, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Cat Anti Karat', 'kaleng', 1, 160000, 160000, '2025-10-18 07:03:06'),
(89, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Semen Tiga Roda', 'sak', 2, 79000, 158000, '2025-10-18 07:03:06'),
(90, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Besi Siku', 'batang', 3, 120000, 360000, '2025-10-18 07:10:40'),
(91, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Cat Kayu', 'kaleng', 4, 120000, 480000, '2025-10-18 07:10:40'),
(92, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'semen', 'sak', 11, 80000, 880000, '2025-10-18 07:10:40'),
(93, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'Plat Besi', 'lembar', 12, 260000, 3120000, '2025-10-18 07:10:40'),
(94, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Cat Anti Karat', 'kaleng', 1, 160000, 160000, '2025-10-18 07:10:40'),
(95, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Semen Tiga Roda', 'sak', 2, 79000, 158000, '2025-10-18 07:10:40'),
(96, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Besi Siku', 'batang', 3, 120000, 360000, '2025-10-18 07:10:53'),
(97, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Cat Kayu', 'kaleng', 4, 120000, 480000, '2025-10-18 07:10:53'),
(98, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'semen', 'sak', 11, 80000, 880000, '2025-10-18 07:10:53'),
(99, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'Plat Besi', 'lembar', 12, 260000, 3120000, '2025-10-18 07:10:53'),
(100, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Cat Anti Karat', 'kaleng', 1, 160000, 160000, '2025-10-18 07:10:53'),
(101, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Semen Tiga Roda', 'sak', 2, 79000, 158000, '2025-10-18 07:10:53'),
(102, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Besi Siku', 'batang', 3, 120000, 360000, '2025-10-18 07:10:53'),
(103, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Cat Kayu', 'kaleng', 4, 120000, 480000, '2025-10-18 07:10:53'),
(104, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'semen', 'sak', 11, 80000, 880000, '2025-10-18 07:10:53'),
(105, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'Plat Besi', 'lembar', 12, 260000, 3120000, '2025-10-18 07:10:53'),
(106, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Cat Anti Karat', 'kaleng', 1, 160000, 160000, '2025-10-18 07:10:53'),
(107, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Semen Tiga Roda', 'sak', 2, 79000, 158000, '2025-10-18 07:10:53'),
(108, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Besi Siku', 'batang', 3, 120000, 360000, '2025-10-18 07:11:20'),
(109, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Cat Kayu', 'kaleng', 4, 120000, 480000, '2025-10-18 07:11:20'),
(110, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'semen', 'sak', 11, 80000, 880000, '2025-10-18 07:11:20'),
(111, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'Plat Besi', 'lembar', 12, 260000, 3120000, '2025-10-18 07:11:20'),
(112, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Cat Anti Karat', 'kaleng', 1, 160000, 160000, '2025-10-18 07:11:20'),
(113, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Semen Tiga Roda', 'sak', 2, 79000, 158000, '2025-10-18 07:11:20'),
(114, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Besi Siku', 'batang', 3, 120000, 360000, '2025-10-18 07:11:20'),
(115, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Cat Kayu', 'kaleng', 4, 120000, 480000, '2025-10-18 07:11:20'),
(116, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'semen', 'sak', 11, 80000, 880000, '2025-10-18 07:11:20'),
(117, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'Plat Besi', 'lembar', 12, 260000, 3120000, '2025-10-18 07:11:20'),
(118, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Cat Anti Karat', 'kaleng', 1, 160000, 160000, '2025-10-18 07:11:20'),
(119, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Semen Tiga Roda', 'sak', 2, 79000, 158000, '2025-10-18 07:11:20'),
(120, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Besi Siku', 'batang', 3, 120000, 360000, '2025-10-18 07:11:20'),
(121, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Cat Kayu', 'kaleng', 4, 120000, 480000, '2025-10-18 07:11:20'),
(122, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'semen', 'sak', 11, 80000, 880000, '2025-10-18 07:11:20'),
(123, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'Plat Besi', 'lembar', 12, 260000, 3120000, '2025-10-18 07:11:20'),
(124, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Cat Anti Karat', 'kaleng', 1, 160000, 160000, '2025-10-18 07:11:20'),
(125, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Semen Tiga Roda', 'sak', 2, 79000, 158000, '2025-10-18 07:11:20'),
(126, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Besi Siku', 'batang', 3, 120000, 360000, '2025-10-18 07:11:20'),
(127, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'Aatap', 'Cat Kayu', 'kaleng', 4, 120000, 480000, '2025-10-18 07:11:20'),
(128, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'semen', 'sak', 11, 80000, 880000, '2025-10-18 07:11:20'),
(129, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'lantai', 'Plat Besi', 'lembar', 12, 260000, 3120000, '2025-10-18 07:11:20'),
(130, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Cat Anti Karat', 'kaleng', 1, 160000, 160000, '2025-10-18 07:11:20'),
(131, 'RAB-68f337e29ca30-REV-20251018-090241-REV-20251018', NULL, 'kanopi', 'Semen Tiga Roda', 'sak', 2, 79000, 158000, '2025-10-18 07:11:20'),
(132, 'RAB-68f334cf4b95a-REV-20251018-091514', NULL, 'Pondasi', 'Batu Bata Merah', 'buah', 500, 800, 400000, '2025-10-18 07:15:14'),
(133, 'RAB-68f334cf4b95a-REV-20251018-091514', NULL, 'Kanopi', 'Keramik Lantai', 'dus', 5, 95000, 475000, '2025-10-18 07:15:14'),
(134, 'RAB-68f334cf4b95a-REV-20251018-091514', NULL, '', 'Cat Kayu', 'kaleng', 3, 120000, 360000, '2025-10-18 07:15:14'),
(135, 'RAB-68f334cf4b95a-REV-20251018-091514', NULL, '', 'Besi Siku', 'batang', 3, 120000, 4044, '2025-10-18 07:15:14'),
(136, 'RAB-68f334cf4b95a-REV-20251018-091514-REV-20251018', NULL, 'Pondasi', 'Batu Bata Merah', 'buah', 500, 800, 400000, '2025-10-18 07:23:05'),
(137, 'RAB-68f334cf4b95a-REV-20251018-091514-REV-20251018', NULL, 'Kanopi', 'Keramik Lantai', 'dus', 5, 95000, 475000, '2025-10-18 07:23:05'),
(138, 'RAB-68f334cf4b95a-REV-20251018-091514-REV-20251018', NULL, '', 'Cat Kayu', 'kaleng', 3, 120000, 360000, '2025-10-18 07:23:05'),
(139, 'RAB-68f334cf4b95a-REV-20251018-091514-REV-20251018', NULL, '', 'Besi Siku', 'batang', 3, 120000, 4044, '2025-10-18 07:23:05'),
(140, 'RAB-68f334cf4b95a-REV-20251018-091514-REV-20251018', NULL, 'atap', 'Cat Kayu', 'kaleng', 5, 120000, 600000, '2025-10-18 07:25:49'),
(141, 'RAB-68f334cf4b95a-REV-20251018-091514-REV-20251018', NULL, 'atap', 'Besi Siku', 'batang', 5, 120000, 600000, '2025-10-18 07:25:49'),
(142, 'RAB-68f334cf4b95a-REV-20251018-091514-REV-20251018', NULL, 'Kanopi', 'Keramik Lantai', 'dus', 5, 95000, 475000, '2025-10-18 07:25:49'),
(143, 'RAB-68f334cf4b95a-REV-20251018-091514-REV-20251018', NULL, 'Pondasi', 'Batu Bata Merah', 'buah', 500, 800, 400000, '2025-10-18 07:25:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user_rba','supplier') DEFAULT 'user_rba'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`) VALUES
(1, 'Administrator', 'admin', '$2y$10$4UXRm6igUL6NsghE130kRu/B88GMpk..OYxB4qbV32dCkq2Wm7rAy', 'admin'),
(2, 'RBA User', 'userrba', '$2y$10$4UXRm6igUL6NsghE130kRu/B88GMpk..OYxB4qbV32dCkq2Wm7rAy', 'user_rba'),
(3, 'Supplier A', 'supplier', '$2y$10$9cezUmwRu0ilQKXTQVc.kuMpJDL/UWKwYLuHuPxdFQOh.yir7/uee', 'supplier'),
(5, 'abiyusofyan', 'abiyuoke', '$2y$10$BLzg6Bovd3IHh3pJBKqf1eFZfs./stbyFLGfOmDLg72KNIntD7vNO', 'user_rba'),
(6, 'supplier 2', 'supplier2a', '$2y$10$e89pvPSyDOVKO4.ArsM43O/4LHZvpRypAIjwe8lYxyuAIK1wEGWx2', 'supplier');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `rab`
--
ALTER TABLE `rab`
  ADD PRIMARY KEY (`id_rab`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `rab_detail`
--
ALTER TABLE `rab_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rab` (`id_rab`),
  ADD KEY `id_material` (`id_material`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `rab_detail`
--
ALTER TABLE `rab_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `rab`
--
ALTER TABLE `rab`
  ADD CONSTRAINT `rab_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;

--
-- Constraints for table `rab_detail`
--
ALTER TABLE `rab_detail`
  ADD CONSTRAINT `rab_detail_ibfk_1` FOREIGN KEY (`id_rab`) REFERENCES `rab` (`id_rab`) ON DELETE CASCADE,
  ADD CONSTRAINT `rab_detail_ibfk_2` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
