-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2024 at 02:21 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `RoomSystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `Department`
--

CREATE TABLE `Department` (
  `id` int(11) NOT NULL,
  `deptName` varchar(100) NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Department`
--

INSERT INTO `Department` (`id`, `deptName`, `location`) VALUES
(1, 'CCS-College of Computing Science', 'Campus B'),
(2, 'CSM', 'campus-b'),
(3, 'CLA-', 'campus a');

-- --------------------------------------------------------

--
-- Table structure for table `Room`
--

CREATE TABLE `Room` (
  `id` int(11) NOT NULL,
  `RoomName` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` enum('unavailable','available') NOT NULL DEFAULT 'unavailable',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Room`
--

INSERT INTO `Room` (`id`, `RoomName`, `department`, `status`, `timestamp`) VALUES
(1, 'LR-1', 'CCS', 'unavailable', '2024-11-27 01:08:59'),
(2, 'LR-2', 'CCS', 'unavailable', '2024-11-27 01:09:31'),
(3, 'LR-3', 'CCS', 'unavailable', '2024-11-27 01:09:31'),
(4, 'CLA-6', 'CLA', 'unavailable', '2024-11-27 01:10:07'),
(5, 'CSM-11', 'CSM', 'unavailable', '2024-11-27 01:10:07'),
(6, '[value-1]', '[value-2]', 'unavailable', '2024-12-01 10:30:35'),
(7, 'd-7', 'CCS', 'unavailable', '2024-12-01 10:45:58'),
(8, 'd-7', 'CCS', 'unavailable', '2024-12-01 10:46:40'),
(9, 'd-72', 'CCS', 'unavailable', '2024-12-01 10:46:55'),
(10, 'sqw-45', 'Engineering', 'unavailable', '2024-12-01 10:47:07'),
(11, 'ds-22', 'CLA', 'unavailable', '2024-12-01 10:55:28'),
(12, 'ds-22', 'CCS', 'unavailable', '2024-12-01 10:55:40');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  `DayOfWeek` enum('moday','tuesday','wednesday','thursday','friday','saturday','sunday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `roomid`, `DayOfWeek`, `start_time`, `end_time`, `subject`) VALUES
(1, 1, 'moday', '07:00:00', '08:00:00', 'webdev'),
(2, 1, 'moday', '10:00:00', '11:30:00', 'programming 1');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `SubName` varchar(100) NOT NULL,
  `subcode` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `course` varchar(100) NOT NULL,
  `section` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('Admin','SuperAdmin','Staff','Student') NOT NULL DEFAULT 'Student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `course`, `section`, `password`, `role`) VALUES
(3, 'winston123', 'cntmaster79@gmail.com', '', '', '$2y$10$Fi0uXyOewcWau0ZanQ3SwuxOdgBZUiWQAiYS01SAIgAXMYdvpXlVm', 'Admin'),
(4, 'tonton', 'tabotabowinston@gmail.com', '', '', '123456789', 'Admin'),
(5, 'alken', 'alken@email.com', 'BSIT', 'C', '$2y$10$fUJjy7wEneqI4I86Urzq5.Ey8sEnpPplC.wBcDOi8JNz4E/hG/TSe', 'Student'),
(6, 'rashid', 'rashid@email.com', 'BSIT', 'A', '$2y$10$RvHYWtavjhLbjrHEmhrHEe2olNdRkwVndE02xZ9yX0gGa1Pg6mME.', 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Department`
--
ALTER TABLE `Department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Room`
--
ALTER TABLE `Room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_ibfk_1` (`roomid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Department`
--
ALTER TABLE `Department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Room`
--
ALTER TABLE `Room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`roomid`) REFERENCES `Room` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
