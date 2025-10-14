-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2025 at 11:57 AM
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rab`
--

INSERT INTO `rab` (`id_rab`, `id_user`, `project_name`, `unit`, `type`, `location`, `notes`, `additional_info`, `jumlahTotal`, `pembulatan`, `permeterpersegi`, `timestamps`, `created_at`) VALUES
('RAB-68edf61698053', 1, 'testing', 1, 'a2', 'jakarte', NULL, NULL, 0, 0, 0, '2025-10-14 07:04:54', '2025-10-14 07:04:54'),
('RAB-68edf68eb5487', 1, 'Tester cuyys', 1, 'a22', 'jakartea', NULL, NULL, 0, 0, 0, '2025-10-14 07:06:54', '2025-10-14 07:06:54'),
('RAB-68edf7f12326d', 1, 'tester1', 1, '3', 'bandung', NULL, NULL, 0, 0, 0, '2025-10-14 07:12:49', '2025-10-14 07:12:49'),
('RAB-68ee16b599025', 1, 'testing3', 1, '9', 'medan', 'maling besi', 'aobvuabov', 0, 0, 0, '2025-10-14 09:24:05', '2025-10-14 09:24:05'),
('RAB-68ee177f009e1', 1, 'TestingBambang', 1, '19', 'Jajargenjang', 'tambahin aja', 'aovniavav', 0, 0, 0, '2025-10-14 09:27:27', '2025-10-14 09:27:27'),
('RAB-68ee1db488d3a', 1, 'testerrrrr90', 1, '45', 'jajargenjangdua', 'dimana aja', 'advdavav', 0, 0, 0, '2025-10-14 09:53:56', '2025-10-14 09:53:56');

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
(23, 'RAB-68ee1db488d3a', NULL, '', 'Cat Nippon Paint', 'kaleng', 1, 145000, 145000, '2025-10-14 09:53:56');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
