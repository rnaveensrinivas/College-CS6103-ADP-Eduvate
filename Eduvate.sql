-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/

-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2021 at 04:31 PM
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
  `FirstName` text NOT NULL,
  `LastName` text NOT NULL,
  `College` text NOT NULL,
  `Category` text NOT NULL,
  `CollegeID` bigint(100) NOT NULL,
  `Department` text NOT NULL,
  `Password1` text NOT NULL,
  `Vkey` varchar(45) NOT NULL,
  `Verified` tinyint(1) NOT NULL,
  `CreatedDate` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`Email`, `FirstName`, `LastName`, `College`, `Category`, `CollegeID`, `Department`, `Password1`, `Vkey`, `Verified`, `CreatedDate`) VALUES
('rnaveensrinivas@gmail.com', 'Naveen', 'Srinivas', 'CEG', 'student', 1000000000, 'CSE', '0cc175b9c0f1b6a831c399e269772661', '3a49de4d0f791d14c1258452209cdaf3', 1, '2021-07-02 13:53:37.424893');

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
