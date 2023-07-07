-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2023 at 04:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csc-mis`
--

-- --------------------------------------------------------

--
-- Table structure for table `changeshift_csc`
--

CREATE TABLE `changeshift_csc` (
  `cs_id` int(11) NOT NULL,
  `cs_company` varchar(50) NOT NULL,
  `cs_dept` varchar(50) NOT NULL,
  `cs_firstname` varchar(30) NOT NULL,
  `cs_middlename` varchar(30) DEFAULT NULL,
  `cs_lastname` varchar(30) NOT NULL,
  `cs_shiftorigin` varchar(50) NOT NULL,
  `cs_shiftnew` varchar(50) NOT NULL,
  `cs_reason` varchar(150) NOT NULL,
  `cs_approved` varchar(100) DEFAULT NULL,
  `cs_noted` varchar(100) NOT NULL,
  `cs_date` date NOT NULL,
  `cs_datecreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `officialbusiness_csc`
--

CREATE TABLE `officialbusiness_csc` (
  `ob_id` int(11) NOT NULL,
  `ob_company` varchar(50) NOT NULL,
  `ob_dept` varchar(50) NOT NULL,
  `ob_firstname` varchar(30) NOT NULL,
  `ob_middlename` varchar(30) DEFAULT NULL,
  `ob_lastname` varchar(30) NOT NULL,
  `ob_date` date NOT NULL,
  `ob_client` varchar(100) NOT NULL,
  `ob_status` varchar(30) NOT NULL,
  `ob_reason` varchar(150) NOT NULL,
  `ob_noted` varchar(100) NOT NULL,
  `ob_datecreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `officialbusiness_csc`
--

INSERT INTO `officialbusiness_csc` (`ob_id`, `ob_company`, `ob_dept`, `ob_firstname`, `ob_middlename`, `ob_lastname`, `ob_date`, `ob_client`, `ob_status`, `ob_reason`, `ob_noted`, `ob_datecreate`) VALUES
(4, 'CSC', 'Accounts', 'ccccccccccccccccccccc', 'wer', 'qewr', '2023-05-02', 'qwer', 'Both', 'qwer', 'qwer', '2023-05-25 02:49:04'),
(7, 'ESCO', 'PID', 'sdklvjgnsuioladfghjilawkedjmfi', '', 'aaaaaa', '2023-06-02', 'bbbbbbbbbb', 'Both', 'bbbbbbbbb', 'bbbbbbbb', '2023-05-30 07:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `overtime_csc`
--

CREATE TABLE `overtime_csc` (
  `ot_id` int(11) NOT NULL,
  `ot_company` varchar(50) NOT NULL,
  `ot_dept` varchar(50) NOT NULL,
  `ot_firstname` varchar(30) NOT NULL,
  `ot_middlename` varchar(30) DEFAULT NULL,
  `ot_lastname` varchar(30) NOT NULL,
  `ot_position` varchar(30) NOT NULL,
  `ot_from` time NOT NULL,
  `ot_to` time NOT NULL,
  `ot_hours` decimal(5,2) NOT NULL,
  `ot_task` varchar(150) DEFAULT NULL,
  `ot_designation` varchar(50) DEFAULT NULL,
  `ot_approved` varchar(100) DEFAULT NULL,
  `ot_noted` varchar(100) NOT NULL,
  `ot_datecreate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `overtime_csc`
--

INSERT INTO `overtime_csc` (`ot_id`, `ot_company`, `ot_dept`, `ot_firstname`, `ot_middlename`, `ot_lastname`, `ot_position`, `ot_from`, `ot_to`, `ot_hours`, `ot_task`, `ot_designation`, `ot_approved`, `ot_noted`, `ot_datecreate`) VALUES
(32, 'Comfac', 'PID', 'adf', '', 'gacad', 'asdf', '18:54:00', '08:55:00', '14.02', '', 'asdf', 'asdf', 'asdf', '2023-05-24 00:06:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_csc`
--

CREATE TABLE `user_csc` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(30) NOT NULL,
  `user_lastname` varchar(30) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(70) NOT NULL,
  `user_company` varchar(50) NOT NULL,
  `user_dept` varchar(50) NOT NULL,
  `user_password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_csc`
--

INSERT INTO `user_csc` (`user_id`, `user_firstname`, `user_lastname`, `user_name`, `user_email`, `user_company`, `user_dept`, `user_password`) VALUES
(1, 'sean', 'gomez', 'seangomez123', 'sean@gmail.com', 'CSC', 'HR', 'test12345'),
(2, 'sean', 'gomezadfa', 'seangomez123', 'adfadsf@gmail.com', 'Comfac', 'PID', 'asdf1234'),
(3, 'sdfadf', 'asdfsdfadfsd', 'sdfasd', 'hello@email.com', 'CSC', 'HR', 'test1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `changeshift_csc`
--
ALTER TABLE `changeshift_csc`
  ADD PRIMARY KEY (`cs_id`);

--
-- Indexes for table `officialbusiness_csc`
--
ALTER TABLE `officialbusiness_csc`
  ADD PRIMARY KEY (`ob_id`);

--
-- Indexes for table `overtime_csc`
--
ALTER TABLE `overtime_csc`
  ADD PRIMARY KEY (`ot_id`);

--
-- Indexes for table `user_csc`
--
ALTER TABLE `user_csc`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `changeshift_csc`
--
ALTER TABLE `changeshift_csc`
  MODIFY `cs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `officialbusiness_csc`
--
ALTER TABLE `officialbusiness_csc`
  MODIFY `ob_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `overtime_csc`
--
ALTER TABLE `overtime_csc`
  MODIFY `ot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `user_csc`
--
ALTER TABLE `user_csc`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
