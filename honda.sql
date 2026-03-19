-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 19, 2026 at 04:40 AM
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
-- Database: `honda`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `access_id` int(11) NOT NULL,
  `access_code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`access_id`, `access_code`) VALUES
(1, 'honda'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `honda_units`
--

CREATE TABLE `honda_units` (
  `unit_id` int(5) NOT NULL,
  `units` varchar(50) NOT NULL,
  `lcp` int(10) DEFAULT NULL,
  `ppd` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `honda_units`
--

INSERT INTO `honda_units` (`unit_id`, `units`, `lcp`, `ppd`) VALUES
(1, 'NAVI', 63939, 0),
(2, 'BEAT 110 PLAYFUL', 76907, 0),
(3, 'BEAT 110 PREMIUM', 78479, 0),
(4, 'CLICK 125 V4', 88557, 0),
(5, 'CLICK 125 V4 SE', 91271, 0),
(6, 'CLICK 160', 120130, 0),
(7, 'AIRBLADE 160', 0, 0),
(8, 'ADV 160 2022', 176429, 0),
(9, 'ADV 160 2026', 176953, 0),
(10, 'ADV 160 ROADSYNC', 184810, 0),
(11, 'ADV 350', 308235, 0),
(12, 'PCX 160 CBS', 132033, 0),
(13, 'PCX 160 ABS', 150889, 0),
(14, 'PCX 160 ROADSYNC', 0, 0),
(15, 'WINNER X PREMIUM', 0, 0),
(16, 'WINNER X RACING', 0, 0),
(17, 'TMX 125', 0, 0),
(18, 'TMX 155 SUPREMO', 0, 0),
(19, 'XR 155', 0, 0),
(20, 'XRM 125', 0, 0),
(21, 'RS 125', 0, 0),
(22, 'RSX 110 WAVE', 0, 0),
(23, 'NAVI', 63939, 0),
(24, 'BEAT 110 PLAYFUL', 76907, 0),
(25, 'BEAT 110 PREMIUM', 78479, 0),
(26, 'CLICK 125 V4', 88557, 0),
(27, 'CLICK 125 V4 SE', 91271, 0),
(28, 'CLICK 160', 120130, 0),
(29, 'AIRBLADE 160', NULL, 0),
(30, 'ADV 160 2022', 176429, 0),
(31, 'ADV 160 2026', 176953, 0),
(32, 'ADV 160 ROADSYNC', 184810, 0),
(33, 'ADV 350', 308235, 0),
(34, 'PCX 160 CBS', 132033, 0),
(35, 'PCX 160 ABS', 150889, 0),
(36, 'PCX 160 ROADSYNC', NULL, 0),
(37, 'WINNER X PREMIUM', NULL, 0),
(38, 'WINNER X RACING', NULL, 0),
(39, 'TMX 125', NULL, 0),
(40, 'TMX 155 SUPREMO', NULL, 0),
(41, 'XR 155', NULL, 0),
(42, 'XRM 125', NULL, 0),
(43, 'RS 125', NULL, 0),
(44, 'RSX 110 WAVE', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`access_id`);

--
-- Indexes for table `honda_units`
--
ALTER TABLE `honda_units`
  ADD PRIMARY KEY (`unit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access`
--
ALTER TABLE `access`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `honda_units`
--
ALTER TABLE `honda_units`
  MODIFY `unit_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
