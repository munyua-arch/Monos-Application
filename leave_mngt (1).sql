-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2024 at 08:48 AM
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
  `phone` varchar(32) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `dob` date NOT NULL DEFAULT current_timestamp(),
  `password` varchar(200) NOT NULL,
  `uniid` varchar(32) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'active',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `phone`, `gender`, `department`, `dob`, `password`, `uniid`, `status`, `updated_at`, `created_at`, `deleted_at`) VALUES
(9, 'Peter Muthuri ', 'peterkebs@gmail.com', '0715024420', 'Male', 'IT', '2024-08-06', '$2y$10$FJ69bSgo2q/6x8b2e4JMb.31Gxmf6ygY/WcvOzAw4kfDdVA54e/gS', '1711df4c7649d64d8348b92f7ccb1ff3', 'active', '2024-08-20 16:02:18', '2024-08-20 16:02:18', '2024-08-20 19:02:18'),
(10, 'Saif Kinyori', 'saifkinyori@gmail.com', '0729456159', 'Male', 'IT', '2024-08-01', '$2y$10$AlRFKESTWERzFGc7JUMLpeKRS20euqaSYgrj55BhgPi4EVtxYNz5u', 'e075730e3cf66e38371dfacfcdde0e12', 'active', '2024-08-20 16:09:16', '2024-08-20 16:09:16', '2024-08-20 19:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `approved_requests`
--

CREATE TABLE `approved_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `applied_on` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(32) NOT NULL DEFAULT 'approved',
  `approval_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approved_requests`
--

INSERT INTO `approved_requests` (`id`, `name`, `employee_id`, `email`, `leave_type`, `start_date`, `end_date`, `applied_on`, `status`, `approval_timestamp`) VALUES
(1, 'Dennis Murimi', 0, '', 'Study', '2024-04-19', '2024-04-30', '2024-04-22 15:35:47', 'approved', '2024-04-22 07:40:32'),
(2, 'Dennis Murimi', 0, '', 'Study', '2024-04-05', '2024-04-25', '2024-04-23 09:53:12', 'approved', '2024-04-23 07:02:46'),
(3, 'Peter Muthuri', 0, '', 'Study', '2024-04-09', '2024-04-27', '2024-04-23 10:10:02', 'approved', '2024-04-23 07:13:18'),
(4, 'Dennis Murimi', 0, '', 'Personal Time Off', '2024-04-24', '2024-05-02', '2024-04-24 10:21:15', 'approved', '2024-04-24 07:22:03'),
(5, 'Dennis Murimi', 0, '', 'Casual leave', '2024-05-02', '2024-05-09', '2024-04-24 11:27:05', 'approved', '2024-04-24 08:36:25'),
(6, 'Cevin Ochieng', 0, '', 'Religious Holiday', '2024-04-25', '2024-05-11', '2024-04-24 11:39:12', 'approved', '2024-04-24 08:41:22'),
(7, 'Cevin Ochieng', 0, '', 'Sick', '2024-05-08', '2024-05-17', '2024-05-09 00:59:55', 'approved', '2024-05-08 19:02:48'),
(8, 'Faith Gakii', 0, '', 'Maternity Leave', '2024-05-07', '2024-05-18', '2024-05-09 01:20:11', 'approved', '2024-05-08 19:23:40'),
(9, 'Dennis Murimi', 0, '', 'Paternity Leave', '2024-05-09', '2024-05-24', '2024-05-17 14:40:17', 'approved', '2024-05-17 11:41:28');

-- --------------------------------------------------------

--
-- Table structure for table `declined_requests`
--

CREATE TABLE `declined_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `applied_on` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(32) NOT NULL DEFAULT 'declined',
  `declined_timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `declined_requests`
--

INSERT INTO `declined_requests` (`id`, `name`, `employee_id`, `email`, `leave_type`, `start_date`, `end_date`, `applied_on`, `status`, `declined_timestamp`) VALUES
(1, 'Dennis Murimi', 0, '', 'Sick', '2024-04-05', '2024-04-30', '2024-04-23 09:16:03', 'declined', '2024-04-22 07:45:44'),
(2, 'Dennis Murimi', 0, '', 'Study', '2024-04-12', '2024-04-27', '2024-04-23 09:21:30', 'declined', '2024-04-23 06:21:30'),
(3, 'Cevin Ochieng', 0, '', 'Study', '2024-04-08', '2024-04-25', '2024-04-23 10:06:31', 'declined', '2024-04-23 07:06:31'),
(4, 'Dennis Murimi', 0, '', 'Study', '2024-04-11', '2024-04-26', '2024-04-23 10:20:16', 'declined', '2024-04-23 07:20:16'),
(5, 'Dennis Murimi', 0, '', 'Religious Holiday', '2024-04-26', '2024-04-29', '2024-04-27 09:55:43', 'declined', '2024-04-27 06:55:43'),
(6, 'Dennis Murimi', 0, '', 'Personal Time Off', '2024-04-17', '2024-05-02', '2024-05-01 13:15:27', 'declined', '2024-05-01 10:15:27'),
(7, 'Dennis Murimi', 0, '', 'Casual leave', '2024-05-08', '2024-05-15', '2024-05-15 22:19:47', 'declined', '2024-05-15 16:19:47');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department` varchar(100) NOT NULL,
  `shortform` varchar(100) NOT NULL,
  `HOD` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `shortform`, `HOD`, `created_at`, `updated_at`) VALUES
(1, 'Security', 'Sec1', 'George Kimathi ', '2024-04-12 12:02:48', '2024-04-26 09:50:29'),
(2, 'Finance', 'F1nce', 'Sharon Makena', '2024-04-15 17:37:48', '2024-04-26 09:50:29'),
(3, 'Devops Engineering', 'devops', 'Saif Kinyori', '2024-04-26 09:52:14', '2024-04-26 06:52:14'),
(5, 'Cybersecurity', 'cbsec', 'Dennis Murimi', '2024-04-26 06:58:55', '2024-04-26 06:58:55'),
(6, 'Catering', 'CTR12', 'Juliet Karimi', '2024-05-15 10:13:31', '2024-05-15 10:13:31');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `employee_id` varchar(32) NOT NULL,
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

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `employee_id`, `gender`, `phone`, `dob`, `password`, `uniid`, `department`, `created_at`, `updated_at`, `deleted_at`, `status`) VALUES
(16, 'Cotran', 'Mabeya', 'mabeyadynasty@gmail.com', '', 'Male', '1234567890', '2024-04-23', '$2y$10$k7lFakgdXRVQo', 'dceedc5b27357e4aa068a84ffb7e1ac5', 'IT', '2024-04-17 04:10:25', '2024-04-17 04:10:25', '2024-04-17 07:10:25', 'active'),
(21, 'Cevin ', 'Ochieng', 'cevinbrian13@gmail.com', '', 'Male', '1234567890', '2024-04-10', '$2y$10$jHuP94v1IJNOUszo6b945e32W.UJSphDOxXc0uJEf.Wz6g20ba3F2', 'c7277899ff916a0cf3f149bd17dea62c', 'IT', '2024-04-24 09:08:55', '2024-04-23 04:05:00', '2024-04-23 07:05:00', 'active'),
(22, 'Peter', 'Muthuri', 'peterkebs@gmail.com', '', 'Male', '0715024420', '1994-02-17', '$2y$10$6nFCOFOmzZikL6X5XEgFkuzUWyiV8srOmyJtrClomOc2fbBBEBYRu', 'd4965ae11c47afbb95e6b089c7e13e5a', 'IT', '2024-04-23 04:09:17', '2024-04-23 04:09:17', '2024-04-23 07:09:17', 'active'),
(24, 'Dennis', 'Murimi', 'dmurimi919@gmail.com', 'IT001', 'Male', '0740289746', '2001-06-14', '$2y$10$isW0cz6B/QT0m74qVA6V7OyJu./qdCr5t4ZHWZ.MpumGRoB7dAvS6', '8338cb06c634b2cbcd0ad59a5aed835e', 'IT', '2024-08-20 18:35:15', '2024-08-20 03:34:36', '2024-04-24 10:02:23', 'active'),
(25, 'Leon', 'muhepa', 'Leon@gmail.com', 'IT002', 'Male', '1234567890', '2024-05-02', '$2y$10$cpKz1fhxpSPm21dJickjouI1pTGxS5W7WuzhymMHrQkjcKscl9LE6', 'd7db4ec2ccb1d5b3596339ce96fea390', 'Finance', '2024-05-02 05:48:44', '2024-05-02 05:48:44', '2024-05-02 08:48:44', 'active'),
(26, 'Brian ', 'Murithi', 'bmurithi@gmail.com', 'FNCE001', 'Male', '1234567890', '2024-05-06', '$2y$10$b4n7r6KanyDuWBKSLRspu.TTl0PCgUGaILpH2.VE9t04j9pYZYplO', '21a302bf0614ce7d19dae014903799e6', 'Finance', '2024-05-08 04:03:35', '2024-05-08 04:03:35', '2024-05-08 07:03:35', 'active'),
(27, 'Faith', 'Gakii', '123@gmail.com', 'FNCE002', 'Female', '1234567890', '2000-07-21', '$2y$10$wJZqnZrSXbDMq.2QxYW/PubWe5gEV8Hj33y8aX.Ah.OxO60xXr.BS', '6230fbda6e4049dc9ad45f80d17e2831', 'Finance', '2024-05-08 13:17:08', '2024-05-08 13:17:08', '2024-05-08 19:17:08', 'active'),
(28, 'kevin', 'Mutuma', 'mutuma@gmail.com', 'FNCE003', 'Male', '0700000000', '2024-05-14', '$2y$10$.bRXbHt/17wGdeI42fMswe1XK98jdjdAuOzH7O2cnoCt7wTKv0GIC', '504449a80294968249043a3df5e30ed7', 'Finance', '2024-05-15 10:12:21', '2024-05-15 10:12:21', '2024-05-15 16:12:22', 'active'),
(29, 'Leon', 'Kimathi', 'leonkimathi@gmail.com', 'Dev001', 'Male', '1234567890', '2007-02-07', '$2y$10$VUTh1wCngTHvMMjmwsF/8OkKaUFwQDl5bBzDYAI0v2L9v9Ti8A9QC', '514c46db430cb8e83b072773ef85a5a9', 'Devops Engineering', '2024-08-21 03:43:13', '2024-08-21 03:43:13', '2024-08-21 06:43:13', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `leave_type` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `leave_type`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Study Leave', 'Study leave description', '2024-04-26 09:10:35', '2024-04-26 06:10:35'),
(2, 'Personal Time Off', 'short description', '2024-04-26 05:47:17', '2024-04-26 05:47:17'),
(4, 'Travel Leave', 'short description', '2024-05-15 10:14:32', '2024-05-15 10:14:32');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `gender` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `employee_id` varchar(32) NOT NULL,
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `approved_requests`
--
ALTER TABLE `approved_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `declined_requests`
--
ALTER TABLE `declined_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
