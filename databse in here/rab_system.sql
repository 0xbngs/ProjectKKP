-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2025 at 09:14 AM
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
(4, 6, 'semen', 'kaki roda', 'sak', 9, 80000);

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
  `jumlahTotal` int(11) DEFAULT 0,
  `pembulatan` int(11) DEFAULT 0,
  `permeterpersegi` int(11) DEFAULT 0,
  `timestamps` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rab`
--

INSERT INTO `rab` (`id_rab`, `id_user`, `project_name`, `unit`, `type`, `location`, `jumlahTotal`, `pembulatan`, `permeterpersegi`, `timestamps`, `created_at`) VALUES
('RAB-68edf61698053', 1, 'testing', 1, 'a2', 'jakarte', 0, 0, 0, '2025-10-14 07:04:54', '2025-10-14 07:04:54'),
('RAB-68edf68eb5487', 1, 'Tester cuyys', 1, 'a22', 'jakartea', 0, 0, 0, '2025-10-14 07:06:54', '2025-10-14 07:06:54'),
('RAB-68edf7f12326d', 1, 'tester1', 1, '3', 'bandung', 0, 0, 0, '2025-10-14 07:12:49', '2025-10-14 07:12:49');

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
(7, 'RAB-68edf7f12326d', NULL, 'modern', 'baja ringan', 'batang', 15, 50000, 6000000, '2025-10-14 07:12:49');

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
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rab_detail`
--
ALTER TABLE `rab_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
