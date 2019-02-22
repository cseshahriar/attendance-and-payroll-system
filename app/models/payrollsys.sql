-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 21, 2019 at 10:29 AM
-- Server version: 5.7.25-0ubuntu0.18.04.2
-- PHP Version: 7.2.15-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payrollsys`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(60) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(60) CHARACTER SET latin1 NOT NULL,
  `photo` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `photo`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@me.com', '$2y$10$Psf8jax3gaCPX0T44GfUiOItTcD4IPQw/9ZdhQQIZp49Y1yHlPBka', 'default.png', 'superadmin', '2019-01-30 19:52:11', NULL),
(2, 'Md. Shahriar Hosen', 'admin@me.com', '$2y$10$Psf8jax3gaCPX0T44GfUiOItTcD4IPQw/9ZdhQQIZp49Y1yHlPBka', '2019-02-15_16-32-48_5c6695505da45.jpg', 'admin', '2019-01-30 19:56:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(30) NOT NULL,
  `created_at` date NOT NULL,
  `in_time` time NOT NULL,
  `status` tinyint(1) DEFAULT '0' COMMENT 'Is present right time?',
  `out_time` time DEFAULT NULL,
  `num_hr` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `employee_id`, `created_at`, `in_time`, `status`, `out_time`, `num_hr`) VALUES
(1, '5c56c7a359e66', '2019-02-10', '09:15:00', 1, '17:00:00', '07:45:00'),
(4, '5c5832432f3da', '2019-02-10', '09:15:00', 1, '17:15:00', '07:45:00'),
(5, '5c5a7c86a90f7', '2019-02-10', '09:15:00', 1, '16:00:00', '07:45:00'),
(6, '5c56c7a359e66', '2019-02-11', '08:38:00', 1, '17:00:00', '08:00:00'),
(7, '5c5832432f3da', '2019-02-11', '08:00:00', 1, '17:00:00', '08:00:00'),
(8, '5c56c7a359e66', '2019-02-12', '09:00:00', 1, '12:00:00', '03:00:00'),
(9, '5c5a7c86a90f7', '2019-02-12', '09:00:00', 1, '18:00:00', '08:00:00'),
(11, '5c56c7a359e66', '2019-02-13', '09:00:00', 1, '17:00:00', '08:00:00'),
(14, '5c5a7c86a90f7', '2019-02-13', '08:45:00', 0, '16:45:00', '07:45:00'),
(15, '5c5832432f3da', '2019-02-13', '08:45:00', 1, '03:00:00', '06:00:00'),
(16, '5c56c7a359e66', '2019-02-15', '08:57:53', 1, '12:02:31', '03:02:31'),
(17, '5c56c7a359e66', '2019-02-17', '10:45:00', 0, '17:00:00', '06:15:00'),
(18, '5c5832432f3da', '2019-02-17', '11:00:00', 0, '16:30:00', '05:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `cashadvances`
--

CREATE TABLE `cashadvances` (
  `id` int(11) NOT NULL,
  `date_advance` date NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `amount` float UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashadvances`
--

INSERT INTO `cashadvances` (`id`, `date_advance`, `employee_id`, `amount`, `created_at`) VALUES
(1, '2019-02-09', '5c56c7a359e66', 1000, '2019-02-09 15:34:24'),
(4, '2019-02-15', '5c5832432f3da', 1001, '2019-02-09 17:20:43'),
(5, '2019-02-10', '5c5a7c86a90f7', 2000.12, '2019-02-09 17:31:20'),
(6, '2019-02-09', '5c5a7c86a90f7', 1000.11, '2019-02-09 18:35:18'),
(7, '2019-02-09', '5c56c7a359e66', 101.11, '2019-02-11 07:08:29');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(80) DEFAULT NULL,
  `description` varchar(100) NOT NULL,
  `amount` decimal(10,3) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `employee_id`, `description`, `amount`, `created_at`) VALUES
(1, '5c56c7a359e66', 'Health', '1000.000', '2019-02-10 04:46:17'),
(2, '5c5832432f3da', 'Project Issues', '1000.000', '2019-02-10 04:46:56'),
(3, '5c5a7c86a90f7', 'Others', '500.000', '2019-02-10 04:47:08'),
(4, '5c56c7a359e66', 'description', '500.000', '2019-02-21 09:14:59');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(60) NOT NULL,
  `firstname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `lastname` varchar(50) CHARACTER SET latin1 NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(80) NOT NULL,
  `address` text CHARACTER SET latin1 NOT NULL,
  `birthdate` date NOT NULL,
  `contact_info` varchar(100) CHARACTER SET latin1 NOT NULL,
  `gender` varchar(10) CHARACTER SET latin1 NOT NULL,
  `position_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `photo` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `firstname`, `lastname`, `email`, `password`, `address`, `birthdate`, `contact_info`, `gender`, `position_id`, `schedule_id`, `photo`, `created_at`) VALUES
(1, '5c56c7a359e66', 'Md. Shahriar', 'Hosen', 'demo1@me.com', '$2y$10$H1topAEwDk.ce9fuQjctduzAr0GcADJz9VQQizGV90rbct/KOyv/G', 'House #1074, Road #5, Sector #7, Mirpur', '2019-02-26', '1710835653', 'Male', 1, 1, '2019-02-15_12-40-48_5c665ef079d22.jpg', '2019-01-31 07:36:05'),
(5, '5c5832432f3da', 'Md. Shahriar', 'Alam', 'demo2@me.com', '$2y$10$H1topAEwDk.ce9fuQjctduzAr0GcADJz9VQQizGV90rbct/KOyv/G', 'House #1074, Road #5, Sector #7, Mirpur', '2019-02-26', '1710835653', 'Male', 2, 1, '2019-02-06_17-00-20_5c5abe4496c09.jpg', '2019-02-04 12:38:27'),
(10, '5c5a7c86a90f7', 'Salpin', 'Murol', 'demo3@me.com', '$2y$10$H1topAEwDk.ce9fuQjctduzAr0GcADJz9VQQizGV90rbct/KOyv/G', 'dhaka', '2019-01-01', '01710835653', 'Female', 3, 1, '2019-02-06_17-00-46_5c5abe5e788b1.jpg', '2019-02-06 06:19:50'),
(11, '5c64fcb42f671', 'Demo', '4', 'demo4@me.com', 'shahriar', 'Dhaka', '2019-01-26', '01710835653', 'Male', 1, 1, '2019-02-21_16-28-11_5c6e7d3bb91ab.jpg', '2019-02-14 05:29:24');

-- --------------------------------------------------------

--
-- Table structure for table `overtime`
--

CREATE TABLE `overtime` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(15) NOT NULL,
  `hours` time NOT NULL,
  `rate` double NOT NULL,
  `overtime_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overtime`
--

INSERT INTO `overtime` (`id`, `employee_id`, `hours`, `rate`, `overtime_date`, `created_at`) VALUES
(3, '5c56c7a359e66', '12:00:00', 120, '2019-02-10', '2019-02-08 17:51:09'),
(4, '5c5832432f3da', '12:00:00', 120, '2019-02-11', '2019-02-08 17:51:25'),
(5, '5c5a7c86a90f7', '12:00:00', 120, '2019-02-12', '2019-02-08 17:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `description` varchar(150) NOT NULL,
  `rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `description`, `rate`) VALUES
(1, 'Graphics Designer', 80),
(2, 'Front End Developer', 100),
(3, 'BackEnd Developer', 150);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` int(11) NOT NULL,
  `in_time` time NOT NULL,
  `out_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `in_time`, `out_time`, `created_at`) VALUES
(1, '09:00:00', '17:00:00', '2019-02-10 07:35:05'),
(2, '10:00:00', '18:00:00', '2019-02-10 07:35:05'),
(3, '11:00:00', '19:00:00', '2019-02-10 07:35:05'),
(4, '12:00:00', '20:00:00', '2019-02-10 07:35:05'),
(5, '13:00:00', '23:00:00', '2019-02-10 07:35:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cashadvances`
--
ALTER TABLE `cashadvances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`);

--
-- Indexes for table `overtime`
--
ALTER TABLE `overtime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `cashadvances`
--
ALTER TABLE `cashadvances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `overtime`
--
ALTER TABLE `overtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
