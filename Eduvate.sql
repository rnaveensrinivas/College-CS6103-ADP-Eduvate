-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2021 at 05:08 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eduvate`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Email` text NOT NULL,
  `FullName` text NOT NULL,
  `College` text NOT NULL,
  `Category` text NOT NULL,
  `CollegeID` bigint(100) NOT NULL,
  `Password1` text NOT NULL,
  `Vkey` varchar(45) NOT NULL,
  `Verified` tinyint(1) NOT NULL,
  `CreatedDate` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Email`, `FullName`, `College`, `Category`, `CollegeID`, `Password1`, `Vkey`, `Verified`, `CreatedDate`) VALUES
('rnaveensrinivas@gmail.com', 'Naveen Srinivas', 'College Of Engineering, Guindy', 'Teacher', 1000000000, '6eea9b7ef19179a06954edd0f6c05ceb', 'ee9c6871e556de65130a03dff0adcdbd', 1, '2021-07-06 14:55:35.412644'),
('naveensrinivas@protonmail.com', 'Rithvik Senthil', 'College Of Engineering, Guindy', 'Student', 1000000001, '6eea9b7ef19179a06954edd0f6c05ceb', '6035460eed12ff7e992a845f29112c5c', 1, '2021-07-06 15:01:57.302020');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`CollegeID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
