-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2025 at 05:13 AM
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
-- Database: `personal history statement`
--

-- --------------------------------------------------------

--
-- Table structure for table `addressdetails`
--

CREATE TABLE `addressdetails` (
  `addr_id` int(11) NOT NULL,
  `street` varchar(255) DEFAULT NULL,
  `barangay` varchar(255) DEFAULT NULL,
  `municipality` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `birthdetails`
--

CREATE TABLE `birthdetails` (
  `birth_id` int(11) NOT NULL,
  `b_date` date DEFAULT NULL,
  `b_month` int(11) DEFAULT NULL,
  `b_year` int(11) DEFAULT NULL,
  `b_place` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `militaryrank`
--

CREATE TABLE `militaryrank` (
  `rank_id` int(11) NOT NULL,
  `rank` varchar(50) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `namedetails`
--

CREATE TABLE `namedetails` (
  `name_id` int(11) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `nickname` varchar(50) DEFAULT NULL,
  `name_extension` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `phs_stat` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `role`, `created_by`, `is_active`, `phs_stat`) VALUES
('arlllena', 'arllena@00002', 'APPLICANT', 'ghdelpilar', 1, 'active'),
('ghdelpilar', 'ghdelpilar@0001', 'ADMINISTRATOR', 'system', 1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `username` varchar(50) NOT NULL,
  `name` int(11) NOT NULL,
  `profile_pic` text DEFAULT NULL,
  `home_addr` int(11) NOT NULL,
  `birth` int(11) NOT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `tin` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `mobile_num` varchar(15) DEFAULT NULL,
  `email_addr` varchar(100) DEFAULT NULL,
  `passport_num` varchar(50) DEFAULT NULL,
  `passport_exp` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addressdetails`
--
ALTER TABLE `addressdetails`
  ADD PRIMARY KEY (`addr_id`);

--
-- Indexes for table `birthdetails`
--
ALTER TABLE `birthdetails`
  ADD PRIMARY KEY (`birth_id`),
  ADD KEY `b_place` (`b_place`);

--
-- Indexes for table `militaryrank`
--
ALTER TABLE `militaryrank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `namedetails`
--
ALTER TABLE `namedetails`
  ADD PRIMARY KEY (`name_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`username`),
  ADD KEY `name` (`name`),
  ADD KEY `home_addr` (`home_addr`),
  ADD KEY `birth` (`birth`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addressdetails`
--
ALTER TABLE `addressdetails`
  MODIFY `addr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `birthdetails`
--
ALTER TABLE `birthdetails`
  MODIFY `birth_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `militaryrank`
--
ALTER TABLE `militaryrank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `namedetails`
--
ALTER TABLE `namedetails`
  MODIFY `name_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `birthdetails`
--
ALTER TABLE `birthdetails`
  ADD CONSTRAINT `birthdetails_ibfk_1` FOREIGN KEY (`b_place`) REFERENCES `addressdetails` (`addr_id`) ON UPDATE CASCADE;

--
-- Constraints for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD CONSTRAINT `userdetails_ibfk_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `userdetails_ibfk_2` FOREIGN KEY (`name`) REFERENCES `namedetails` (`name_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `userdetails_ibfk_3` FOREIGN KEY (`home_addr`) REFERENCES `addressdetails` (`addr_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `userdetails_ibfk_4` FOREIGN KEY (`birth`) REFERENCES `birthdetails` (`birth_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
