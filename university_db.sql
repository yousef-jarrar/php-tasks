-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2026 at 08:30 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university_db`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `enroll_student` (IN `p_student_id` INT, IN `p_course_id` INT)   INSERT INTO Enrollments (student_id, course_id)
VALUES (p_student_id, p_course_id)$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `calculate_age` (`birth_date` DATE) RETURNS INT(11) DETERMINISTIC NO SQL RETURN TIMESTAMPDIFF(YEAR, birth_date, CURDATE())$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `course_code` varchar(20) DEFAULT NULL,
  `credits` int(11) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `capacity` int(11) DEFAULT 30
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_code`, `credits`, `department`, `capacity`) VALUES
(1, 'Database', 'CS101', 3, 'Computer Science', 30),
(2, 'Programming', 'CS102', 3, 'Computer Science', 30),
(3, 'Network Security', 'CY101', 3, 'Cybersecurity', 30),
(4, 'Web Development', 'SE101', 3, 'Software Engineering', 30),
(5, 'Data Structures', 'CS103', 3, 'Computer Science', 30);

-- --------------------------------------------------------

--
-- Table structure for table `course_assignments`
--

CREATE TABLE `course_assignments` (
  `assignment_id` int(11) NOT NULL,
  `instructor_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `semester` varchar(20) DEFAULT NULL,
  `year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_assignments`
--

INSERT INTO `course_assignments` (`assignment_id`, `instructor_id`, `course_id`, `semester`, `year`) VALUES
(1, 1, 1, 'Fall', 2026),
(2, 2, 3, 'Fall', 2026),
(3, 3, 4, 'Fall', 2026),
(4, 4, 2, 'Fall', 2026),
(5, 5, 5, 'Fall', 2026);

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `grade` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`enrollment_id`, `student_id`, `course_id`, `grade`) VALUES
(1, 1, 1, 'A'),
(2, 1, 2, 'B+'),
(3, 2, 2, 'A'),
(4, 2, 3, 'B'),
(5, 3, 3, 'A'),
(6, 3, 4, 'B+'),
(7, 4, 4, 'A'),
(8, 4, 5, 'B'),
(9, 5, 1, 'B+'),
(10, 5, 5, 'A'),
(11, 6, 2, 'A'),
(12, 6, 3, 'B'),
(13, 7, 1, 'A'),
(14, 7, 4, 'B+'),
(15, 8, 3, 'B'),
(16, 8, 5, 'A'),
(17, 9, 2, 'B+'),
(18, 9, 4, 'A'),
(19, 10, 1, 'A'),
(20, 10, 5, 'B'),
(21, 1, 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `instructor_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `hire_date` date DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`instructor_id`, `first_name`, `last_name`, `email`, `hire_date`, `department`) VALUES
(1, 'Mohammad', 'Ali', 'mohammad@university.edu', '2020-05-10', 'Computer Science'),
(2, 'Ahmad', 'Hassan', 'ahmad@university.edu', '2019-03-15', 'Cybersecurity'),
(3, 'Sara', 'Khaled', 'sara@university.edu', '2021-09-01', 'Software Engineering'),
(4, 'Omar', 'Saleh', 'omar@university.edu', '2018-02-20', 'Computer Science'),
(5, 'Lina', 'Nasser', 'lina@university.edu', '2022-06-12', 'Cybersecurity');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `major` varchar(100) DEFAULT NULL,
  `enrollment_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `first_name`, `last_name`, `email`, `date_of_birth`, `gender`, `major`, `enrollment_year`) VALUES
(1, 'Ahmad', 'Ali', 'ahmad@gmail.com', '2003-05-15', 'Male', 'Computer Science', 2022),
(2, 'Sara', 'Ahmad', 'sara@gmail.com', '2002-03-12', 'Female', 'Computer Science', 2021),
(3, 'Omar', 'Khaled', 'omar@gmail.com', '2003-07-20', 'Male', 'Cybersecurity', 2022),
(4, 'Lina', 'Hassan', 'lina@gmail.com', '2004-01-10', 'Female', 'Software Engineering', 2023),
(5, 'Ali', 'Saleh', 'ali@gmail.com', '2002-09-05', 'Male', 'Computer Science', 2021),
(6, 'Noor', 'Ibrahim', 'noor@gmail.com', '2003-11-15', 'Female', 'Cybersecurity', 2022),
(7, 'Yazan', 'Mahmoud', 'yazan@gmail.com', '2004-06-18', 'Male', 'Software Engineering', 2023),
(8, 'Huda', 'Nasser', 'huda@gmail.com', '2002-12-25', 'Female', 'Computer Science', 2021),
(9, 'Kareem', 'Adel', 'kareem@gmail.com', '2003-04-08', 'Male', 'Cybersecurity', 2022),
(10, 'Maya', 'Sami', 'maya@gmail.com', '2004-08-30', 'Female', 'Software Engineering', 2023);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `idx_course_code` (`course_code`);

--
-- Indexes for table `course_assignments`
--
ALTER TABLE `course_assignments`
  ADD PRIMARY KEY (`assignment_id`),
  ADD KEY `instructor_id` (`instructor_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`instructor_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `course_assignments`
--
ALTER TABLE `course_assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `instructor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course_assignments`
--
ALTER TABLE `course_assignments`
  ADD CONSTRAINT `course_assignments_ibfk_1` FOREIGN KEY (`instructor_id`) REFERENCES `instructors` (`instructor_id`),
  ADD CONSTRAINT `course_assignments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`student_id`),
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
