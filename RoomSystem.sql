-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 26, 2024 at 04:55 PM
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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `UserID`) VALUES
(1, 13);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `coursename` varchar(100) NOT NULL,
  `coursecode` varchar(50) NOT NULL,
  `deptID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `coursename`, `coursecode`, `deptID`) VALUES
(4, 'Computer Science', 'BSCS', 8),
(5, 'Information Technology', 'BSIT', 8),
(6, 'Associate in Computer Technology', 'BS-ACT', 8),
(7, 'Bachelor of Elementary Education', 'BEED', 19),
(8, 'Bachelor of Secondary Education', 'BSED', 19),
(9, 'Bachelor of Special Needs Education', 'BSNEd', 19),
(10, 'Bachelor of Early Childhood Education', 'BECEd', 19),
(11, 'Bachelor of Physical Education', 'BPEd', 19),
(12, 'Bachelor of Science in Civil Engineering', 'BSCE', 20),
(13, 'Bachelor of Science in Mechanical Engineering', 'BSME', 20),
(14, 'Bachelor of Science in Electrical Engineering', 'BSEE', 20),
(15, 'Bachelor of Science in Computer Engineering', 'BSCpE', 20),
(16, 'Bachelor of Science in Electronics Engineering', 'BSECE', 20),
(17, 'Bachelor of Science in Criminology', 'BSCrim', 24),
(18, 'Bachelor of Forensic Science', 'BFS', 24),
(19, 'Bachelor of Science in Industrial Security Management', 'BSISM', 24),
(20, 'Bachelor of Science in Public Safety', 'BSPS', 24),
(21, 'Bachelor of Arts in Criminal Justice', 'BACJ', 24);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `deptName` varchar(100) NOT NULL,
  `deptCode` varchar(50) NOT NULL,
  `Campus` enum('A','B','C','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `deptName`, `deptCode`, `Campus`) VALUES
(8, 'College Of Computing Studies', 'CCS', 'B'),
(9, 'College Of Nursing', 'CON', 'A'),
(18, 'College of Business Administration', 'CBA', 'A'),
(19, 'College of Education', 'COE', 'A'),
(20, 'College of Engineering', 'CE', 'A'),
(21, 'College of Arts and Sciences', 'CAS', 'A'),
(22, 'College of Law', 'COL', 'A'),
(23, 'College of Architecture', 'CArch', 'A'),
(24, 'College of Criminal Justice Education', 'CCJE', 'B');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(11) NOT NULL,
  `UserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `UserID`) VALUES
(1, 14),
(2, 15),
(3, 18),
(6, 19);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `request_id` int(11) NOT NULL,
  `RequestedBy` int(11) NOT NULL,
  `RespondedBy` int(11) NOT NULL,
  `schedID` int(11) NOT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `DateRequested` datetime NOT NULL,
  `DateResponded` datetime DEFAULT NULL,
  `DateOfUse` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`request_id`, `RequestedBy`, `RespondedBy`, `schedID`, `status`, `DateRequested`, `DateResponded`, `DateOfUse`) VALUES
(29, 2, 3, 182, 'Approved', '2024-12-26 16:42:06', '2024-12-26 23:42:06', '2024-12-26');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(11) NOT NULL,
  `RoomName` varchar(100) NOT NULL,
  `department` int(11) NOT NULL,
  `floor` varchar(200) NOT NULL,
  `RoomType` enum('Lab','Lec') NOT NULL,
  `Building` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `RoomName`, `department`, `floor`, `RoomType`, `Building`) VALUES
(15, 'LR-1', 8, '2nd floor', 'Lec', ''),
(16, 'LR-4', 8, '2nd floor', 'Lec', ''),
(17, 'LAB-1', 8, '1st floor', 'Lab', ''),
(18, 'LAB-2', 8, '1st floor', 'Lab', ''),
(19, 'LR-3', 8, '2nd floor', 'Lec', '');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` int(11) NOT NULL,
  `roomid` int(11) NOT NULL,
  `DayOfWeek` enum('monday','tuesday','wednesday','thursday','friday','saturday','sunday') NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subjectid` int(11) NOT NULL,
  `profid` int(11) NOT NULL,
  `status` enum('available','unavailable') NOT NULL,
  `semester` varchar(50) NOT NULL,
  `schoolYear` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `roomid`, `DayOfWeek`, `start_time`, `end_time`, `subjectid`, `profid`, `status`, `semester`, `schoolYear`) VALUES
(180, 15, 'monday', '08:00:00', '09:30:00', 9, 1, 'available', '1st', '2024'),
(181, 15, 'wednesday', '10:00:00', '11:30:00', 10, 2, 'available', '1st', '2024'),
(182, 15, 'friday', '01:00:00', '02:30:00', 11, 3, 'available', '1st', '2024'),
(183, 16, 'tuesday', '08:00:00', '09:30:00', 12, 6, 'available', '1st', '2024'),
(184, 16, 'thursday', '09:30:00', '11:00:00', 13, 1, 'available', '1st', '2024'),
(185, 16, 'friday', '02:30:00', '04:00:00', 14, 2, 'available', '1st', '2024'),
(186, 17, 'monday', '11:00:00', '12:30:00', 15, 3, 'available', '1st', '2024'),
(187, 17, 'wednesday', '02:30:00', '04:00:00', 16, 6, 'available', '1st', '2024'),
(188, 17, 'friday', '08:00:00', '09:30:00', 17, 1, 'available', '1st', '2024'),
(189, 18, 'tuesday', '09:00:00', '10:30:00', 18, 2, 'available', '1st', '2024'),
(190, 18, 'thursday', '01:00:00', '02:30:00', 9, 3, 'available', '1st', '2024'),
(191, 18, 'friday', '10:00:00', '11:30:00', 10, 6, 'available', '1st', '2024'),
(192, 19, 'monday', '02:30:00', '04:00:00', 11, 1, 'available', '1st', '2024'),
(193, 19, 'tuesday', '08:00:00', '09:30:00', 12, 2, 'available', '1st', '2024'),
(194, 19, 'thursday', '11:00:00', '12:30:00', 13, 3, 'available', '1st', '2024'),
(195, 15, 'tuesday', '09:30:00', '11:00:00', 14, 6, 'available', '2nd', '2024'),
(196, 15, 'wednesday', '01:00:00', '02:30:00', 15, 1, 'available', '2nd', '2024'),
(197, 15, 'friday', '08:00:00', '09:30:00', 16, 2, 'available', '2nd', '2024'),
(198, 16, 'monday', '10:30:00', '12:00:00', 17, 3, 'available', '2nd', '2024'),
(199, 16, 'wednesday', '08:00:00', '09:30:00', 18, 6, 'available', '2nd', '2024'),
(200, 16, 'friday', '01:00:00', '02:30:00', 9, 1, 'available', '2nd', '2024'),
(201, 17, 'tuesday', '11:30:00', '01:00:00', 10, 2, 'available', '2nd', '2024'),
(202, 17, 'thursday', '09:00:00', '10:30:00', 11, 3, 'available', '2nd', '2024'),
(203, 17, 'friday', '02:00:00', '03:30:00', 12, 6, 'available', '2nd', '2024'),
(204, 18, 'monday', '11:00:00', '12:30:00', 13, 1, 'available', '2nd', '2024'),
(205, 18, 'wednesday', '09:00:00', '10:30:00', 14, 2, 'available', '2nd', '2024'),
(206, 18, 'thursday', '02:30:00', '04:00:00', 15, 3, 'available', '2nd', '2024'),
(207, 19, 'tuesday', '08:30:00', '10:00:00', 16, 6, 'available', '2nd', '2024'),
(208, 19, 'thursday', '11:30:00', '01:00:00', 17, 1, 'available', '2nd', '2024'),
(209, 19, 'friday', '03:30:00', '05:00:00', 18, 2, 'available', '2nd', '2024'),
(210, 15, 'monday', '09:00:00', '10:30:00', 9, 1, 'available', '3rd', '2024'),
(211, 15, 'tuesday', '01:00:00', '02:30:00', 10, 2, 'available', '3rd', '2024'),
(212, 15, 'thursday', '02:00:00', '03:30:00', 11, 3, 'available', '3rd', '2024'),
(213, 16, 'monday', '02:30:00', '04:00:00', 12, 6, 'available', '3rd', '2024'),
(214, 16, 'tuesday', '09:30:00', '11:00:00', 13, 1, 'available', '3rd', '2024'),
(215, 16, 'thursday', '11:00:00', '12:30:00', 14, 2, 'available', '3rd', '2024'),
(216, 17, 'wednesday', '01:00:00', '02:30:00', 15, 3, 'available', '3rd', '2024'),
(217, 17, 'friday', '09:30:00', '11:00:00', 16, 6, 'available', '3rd', '2024'),
(218, 17, 'monday', '11:30:00', '01:00:00', 17, 1, 'available', '3rd', '2024'),
(219, 18, 'tuesday', '09:00:00', '10:30:00', 18, 2, 'available', '3rd', '2024'),
(220, 18, 'wednesday', '02:30:00', '04:00:00', 9, 3, 'available', '3rd', '2024'),
(221, 18, 'friday', '01:00:00', '02:30:00', 10, 6, 'available', '3rd', '2024'),
(222, 19, 'monday', '02:00:00', '03:30:00', 11, 1, 'available', '3rd', '2024'),
(223, 19, 'tuesday', '11:30:00', '01:00:00', 12, 2, 'available', '3rd', '2024'),
(224, 19, 'thursday', '09:30:00', '11:00:00', 13, 3, 'available', '3rd', '2024');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `Section` enum('A','B','C','') NOT NULL,
  `yearLevel` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `UserID`, `CourseID`, `Section`, `yearLevel`) VALUES
(5, 16, 4, 'A', NULL),
(6, 17, 4, 'A', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `SubName` varchar(100) NOT NULL,
  `subcode` varchar(50) NOT NULL,
  `UnitLec` int(11) NOT NULL,
  `UnitLab` int(11) NOT NULL,
  `courseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `SubName`, `subcode`, `UnitLec`, `UnitLab`, `courseID`) VALUES
(9, 'Introduction to Computing', 'IT101', 3, 1, 5),
(10, 'Programming Fundamentals', 'IT102', 3, 1, 5),
(11, 'Database Management Systems', 'IT103', 3, 1, 5),
(12, 'Web Development', 'IT104', 2, 2, 5),
(13, 'Software Engineering', 'IT105', 3, 0, 5),
(14, 'Data Structures and Algorithms', 'CS101', 3, 1, 4),
(15, 'Operating Systems', 'CS102', 3, 1, 4),
(16, 'Artificial Intelligence', 'CS103', 3, 1, 4),
(17, 'Computer Networks', 'CS104', 3, 1, 4),
(18, 'Compiler Design', 'CS105', 3, 0, 4),
(19, 'Engineering Mechanics', 'CE101', 3, 1, 12),
(20, 'Structural Analysis', 'CE102', 3, 1, 12),
(21, 'Construction Materials and Testing', 'CE103', 3, 1, 12),
(22, 'Fluid Mechanics', 'CE104', 3, 1, 12),
(23, 'Hydraulics Engineering', 'CE105', 3, 1, 12),
(24, 'Introduction to Public Safety', 'PS101', 3, 0, 20),
(25, 'Police Organization and Administration', 'PS102', 3, 0, 20),
(26, 'Criminal Investigation', 'PS103', 3, 1, 20),
(27, 'Forensic Science', 'PS104', 3, 1, 20),
(28, 'Crime Scene Investigation', 'PS105', 3, 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` enum('Admin','Faculty','Student') NOT NULL DEFAULT 'Student',
  `DeptID` int(11) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `firstName` varchar(200) NOT NULL,
  `middleName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `DeptID`, `lastName`, `firstName`, `middleName`) VALUES
(13, 'winston123', 'tabotabowinston@gmail.com', '$2y$10$PWTNMsI4iR7Xl5tMQhTG2OFvprUEWc2F98uSblJhjkLk/RX06kopO', 'Admin', 8, 'tabotabo', 'winston', 'trinidad'),
(14, 'faculty#1', 'alken@email.com', '$2y$10$vxSR9.IOMQaLoc61uq4hFOMsYIYZJFiy9oOYf95hvQVfZTQ.x63Aa', 'Faculty', 8, 'valledor', 'alken', 'pdo'),
(15, 'rashid123', 'rashid@email.com', '$2y$10$tlhbrNK372D/fSJmeWb3H.bPrqsxADbAehMoBGOtVpzMfh/Qb57Bi', 'Faculty', 8, 'remigio', 'rashid', 'lubut'),
(16, 'username', 'Franco123@gmail.com', '$2y$10$Ub4wRVX2YXT5xbr.0VYBIeo7K532B4O7Dt72XGNtoa.R0eyHp.LJ.', 'Student', 8, 'Franco', 'Ceniza', 'Rivera'),
(17, 'user1', 'testuser123@gmail.com', '$2y$10$3yBmhFi0znkVtoZV2HOUMeBS0YzvyMn.qGhnwzz6N2VuV5yeL4WZC', 'Student', 8, 'Darunday', 'Yan Mark', 'Villas'),
(18, 'Faculty#2', 'john@gmail.com', '$2y$10$hnGTgvDE4nXvPxhK7O/OEuwh9a5kszycK6vwg3bdEZmUn7DeHjCyu', 'Faculty', 8, 'smith', 'john', 'lakuping'),
(19, 'faculty#3', 'james@gmail.com', '$2y$10$Wf4HSjghG1G11u.00Xs/L.3CJC86pkdTCQNB58euzP4d0CqSbI/.i', 'Faculty', 8, 'Bond', 'James', 'lakuping');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deptID` (`deptID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `schedID` (`schedID`),
  ADD KEY `RespondedBy` (`RespondedBy`),
  ADD KEY `RequestedBy` (`RequestedBy`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department` (`department`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_ibfk_1` (`roomid`),
  ADD KEY `subjectid` (`subjectid`),
  ADD KEY `profid` (`profid`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CourseID` (`CourseID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courseID` (`courseID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `DeptID` (`DeptID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`deptID`) REFERENCES `department` (`id`);

--
-- Constraints for table `faculty`
--
ALTER TABLE `faculty`
  ADD CONSTRAINT `faculty_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_3` FOREIGN KEY (`schedID`) REFERENCES `schedule` (`id`),
  ADD CONSTRAINT `requests_ibfk_4` FOREIGN KEY (`RespondedBy`) REFERENCES `faculty` (`id`),
  ADD CONSTRAINT `requests_ibfk_5` FOREIGN KEY (`RequestedBy`) REFERENCES `faculty` (`id`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `Room_ibfk_1` FOREIGN KEY (`department`) REFERENCES `department` (`id`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`roomid`) REFERENCES `room` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`subjectid`) REFERENCES `subject` (`id`),
  ADD CONSTRAINT `schedule_ibfk_3` FOREIGN KEY (`profid`) REFERENCES `faculty` (`id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`CourseID`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`courseID`) REFERENCES `course` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`DeptID`) REFERENCES `department` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
