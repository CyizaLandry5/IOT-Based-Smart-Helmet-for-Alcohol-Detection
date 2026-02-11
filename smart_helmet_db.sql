-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2026 at 02:56 PM
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
-- Database: `smart_helmet_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `helmets`
--

CREATE TABLE `helmets` (
  `id` int(11) NOT NULL,
  `helmet_uid` varchar(50) NOT NULL,
  `plate_number` varchar(20) NOT NULL,
  `owner_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `helmets`
--

INSERT INTO `helmets` (`id`, `helmet_uid`, `plate_number`, `owner_name`, `phone_number`, `created_at`, `status`) VALUES
(1, 'HELM-001', '', 'UWIMPAYE Michel', '0787869883', '2026-01-17 18:10:57', 'inactive'),
(2, 'HELM-002', '', 'KWIZERA Ildephonse', '078386666', '2026-01-17 18:12:38', 'inactive'),
(3, '1', '', '1', '1', '2026-01-26 20:31:49', 'inactive'),
(4, 'amina', '', 'HELM-002', '	UWIMPAYE Michel', '2026-01-26 20:32:41', 'inactive'),
(5, '2026-01-26 22:32:41', '', '0787869883', 'HELM-001', '2026-01-26 20:33:15', 'inactive'),
(7, 'HELM-100', 'RA 123 A', 'MICHEL', '+250780105612', '2026-02-11 13:44:42', 'active'),
(8, 'HELM-400', 'RA 133 A', 'ILDEPHONSE', '+250780105613', '2026-02-11 13:45:36', 'active'),
(9, 'HELM-500', 'RA 222 A', 'UWIMPAYE', '+250780105614', '2026-02-11 13:46:22', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int(11) NOT NULL,
  `helmet_uid` varchar(50) NOT NULL,
  `alcohol_level` decimal(5,2) NOT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `detected_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', 'admin123', '2026-01-17 17:44:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `helmets`
--
ALTER TABLE `helmets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `helmet_uid` (`helmet_uid`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `helmet_uid` (`helmet_uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `helmets`
--
ALTER TABLE `helmets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`helmet_uid`) REFERENCES `helmets` (`helmet_uid`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
