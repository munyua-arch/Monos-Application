-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 01:08 PM
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
-- Database: `leave_mngt`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `uniid` varchar(32) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'active',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `password`, `uniid`, `status`, `updated_at`) VALUES
(3, '', 'dmurimi919@gmail.com', '$2y$10$rhstGk/BfcXrK4zMnin7E.lVSYRrEQX.ZL7UQDX7xR1q2xIg0qXe2', '3ff561d71a314b3739cc603ca4651bd9', 'active', '2024-04-23 06:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `approved_requests`
--

CREATE TABLE `approved_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `applied_on` datetime NOT NULL DEFAULT current_timestamp(),
  `approval_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approved_requests`
--

INSERT INTO `approved_requests` (`id`, `name`, `leave_type`, `start_date`, `end_date`, `applied_on`, `approval_timestamp`) VALUES
(1, 'Dennis Murimi', 'Study', '2024-04-19', '2024-04-30', '2024-04-22 15:35:47', '2024-04-22 07:40:32'),
(2, 'Dennis Murimi', 'Study', '2024-04-05', '2024-04-25', '2024-04-23 09:53:12', '2024-04-23 07:02:46'),
(3, 'Peter Muthuri', 'Study', '2024-04-09', '2024-04-27', '2024-04-23 10:10:02', '2024-04-23 07:13:18');

-- --------------------------------------------------------

--
-- Table structure for table `declined_requests`
--

CREATE TABLE `declined_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `applied_on` datetime NOT NULL DEFAULT current_timestamp(),
  `declined_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `declined_requests`
--

INSERT INTO `declined_requests` (`id`, `name`, `leave_type`, `start_date`, `end_date`, `applied_on`, `declined_timestamp`) VALUES
(1, 'Dennis Murimi', 'Sick', '2024-04-05', '2024-04-30', '2024-04-23 09:16:03', '2024-04-22 07:45:44'),
(2, 'Dennis Murimi', 'Study', '2024-04-12', '2024-04-27', '2024-04-23 09:21:30', '2024-04-23 06:21:30'),
(3, 'Cevin Ochieng', 'Study', '2024-04-08', '2024-04-25', '2024-04-23 10:06:31', '2024-04-23 07:06:31'),
(4, 'Dennis Murimi', 'Study', '2024-04-11', '2024-04-26', '2024-04-23 10:20:16', '2024-04-23 07:20:16');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department` varchar(100) NOT NULL,
  `shortform` varchar(100) NOT NULL,
  `HOD` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `shortform`, `HOD`, `created_at`) VALUES
(1, 'Security', 'Sec1', 'George Kimathi ', '2024-04-12 12:02:48'),
(2, 'Finance', 'F1nce', 'Sharon Makena', '2024-04-15 17:37:48');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(200) NOT NULL,
  `uniid` varchar(32) NOT NULL,
  `department` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `gender`, `phone`, `dob`, `password`, `uniid`, `department`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(14, 'Leon', 'Murithi', 'Leon@gmail.com', 'Male', '0712456765', '2012-07-13', '$2y$10$4Yth6cDaX4Oxy', '742913b54cc5530a144e954b430e66cd', 'IT', '2024-04-17 03:49:15', '2024-04-17 03:49:15', '2024-04-17 06:49:15', 'active'),
(15, 'John', 'Kinyua', 'kinyua@gmail.com', 'Male', '1234567890', '2024-04-23', '$2y$10$RgTBX1dqvlFlK', '9e8204e61afed2dfbc072282e48825f4', 'Finance', '2024-04-17 04:09:45', '2024-04-17 04:09:45', '2024-04-17 07:09:45', 'active'),
(16, 'Cotran', 'Mabeya', 'mabeyadynasty@gmail.com', 'Male', '1234567890', '2024-04-23', '$2y$10$k7lFakgdXRVQo', 'dceedc5b27357e4aa068a84ffb7e1ac5', 'IT', '2024-04-17 04:10:25', '2024-04-17 04:10:25', '2024-04-17 07:10:25', 'active'),
(19, 'Dennis', 'Murimi', 'dmurimi919@gmail.com', 'Male', '1234567890', '2024-04-11', '$2y$10$6hM93SBUeTjM8uZrPcuZLuTjxqlgkFrkKqpJR30LOAyPaiqpdYo1O', '604b935b98e9c5e6a4f353111e7265a2', 'IT', '2024-04-23 09:30:03', '2024-04-23 06:03:16', '2024-04-20 08:36:41', 'active'),
(20, 'Kakashi', 'Murimi', '123@gmail.com', 'Male', '1234567890', '2024-04-02', '$2y$10$oDTFoxG43YHiz2K4XavaIuiKJOxGlAuOZNHO9P.svbAVn4biVLuwa', '6c60ef391ee5e12b8bc8535a6b35ab60', 'Finance', '2024-04-21 06:38:42', '2024-04-21 06:38:42', '2024-04-21 09:38:42', 'active'),
(21, 'cevin ', 'Ochieng', 'cevinbrian13@gmail.com', 'Male', '1234567890', '2024-04-10', '$2y$10$jHuP94v1IJNOUszo6b945e32W.UJSphDOxXc0uJEf.Wz6g20ba3F2', 'c7277899ff916a0cf3f149bd17dea62c', 'IT', '2024-04-23 04:05:00', '2024-04-23 04:05:00', '2024-04-23 07:05:00', 'active'),
(22, 'Peter', 'Muthuri', 'peterkebs@gmail.com', 'Male', '0715024420', '1994-02-17', '$2y$10$6nFCOFOmzZikL6X5XEgFkuzUWyiV8srOmyJtrClomOc2fbBBEBYRu', 'd4965ae11c47afbb95e6b089c7e13e5a', 'IT', '2024-04-23 04:09:17', '2024-04-23 04:09:17', '2024-04-23 07:09:17', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `leave_type`, `description`, `created_at`) VALUES
(1, '', 'an individual temporarily puts their academic studies on hold to focus on other aspects of their professional life, personal development', '2024-04-12 12:01:15');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `admin_remark` varchar(100) NOT NULL,
  `isRead` tinyint(4) NOT NULL DEFAULT 0,
  `remark_date` varchar(100) CHARACTER SET latin7 COLLATE latin7_general_ci DEFAULT NULL,
  `applied_on` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'pending...'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `name`, `email`, `start_date`, `end_date`, `leave_type`, `reason`, `admin_remark`, `isRead`, `remark_date`, `applied_on`, `status`) VALUES
(1, 'Peter Muthuri', '', '2024-04-15', '2024-04-30', 'Leave Type', 'sdVfvdbv', '', 0, '0000-00-00 00:00:00', '2024-04-16 09:26:57', 'pending...'),
(2, 'Peter Muthuri', '', '2024-04-15', '2024-04-30', 'Sick', 'sdvafdvfvfv', '', 0, '0000-00-00 00:00:00', '2024-04-16 09:26:57', 'pending...'),
(3, 'Erustus Rucha', '', '2024-04-12', '2024-05-16', 'Study', 'sdafvabsfr ndxfn', 'No comment...', 0, '2024-05-16', '2024-04-16 09:26:57', 'Approved'),
(4, 'Erustus Rucha', '', '2024-04-12', '2024-05-16', 'Leave Type', 'dfavdfavbv', '', 1, '0000-00-00 00:00:00', '2024-04-16 09:26:57', 'Approved'),
(5, 'Dennis Murimi', '', '2024-04-23', '2024-05-09', 'Study', 'Time to chase my master&#39;s', '', 0, '2024-04-18', '2024-04-16 10:15:44', 'declined'),
(7, 'Dennis Murimi', '', '2024-04-19', '2024-04-30', 'Study', 'test reason', 'No comment...', 1, NULL, '2024-04-22 10:36:17', 'Approved');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `approved_requests`
--
ALTER TABLE `approved_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `declined_requests`
--
ALTER TABLE `declined_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `approved_requests`
--
ALTER TABLE `approved_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `declined_requests`
--
ALTER TABLE `declined_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;