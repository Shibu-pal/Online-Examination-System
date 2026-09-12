-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 05:01 PM
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
-- Database: `majorproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `user_name` varchar(144) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `user_name`, `password`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `question_id` int(11) NOT NULL,
  `question` varchar(5000) NOT NULL,
  `option1` varchar(500) NOT NULL,
  `option2` varchar(500) NOT NULL,
  `option3` varchar(500) NOT NULL,
  `option4` varchar(500) NOT NULL,
  `correct_option` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_id`, `question`, `option1`, `option2`, `option3`, `option4`, `correct_option`) VALUES
(1, 'What does PHP stand for?', 'Personal Home Page', 'PHP: Hypertext Preprocessor', 'Private Hypertext Processor', 'Programming Home Page', '2'),
(2, 'Which SQL statement is used to extract data from a database?', 'GET', 'OPEN', 'SELECT', 'EXTRACT', '3'),
(3, 'What is the default port number for HTTP?', '21', '80', '443', '3306', '2'),
(4, 'Which of the following is not a PHP superglobal?', '$_GET', '$_POST', '$_SESSION', '$_DOCUMENT', '4'),
(5, 'Which MySQL command is used to create a new database?', 'MAKE DATABASE', 'CREATE DATABASE', 'NEW DATABASE', 'BUILD DATABASE', '2'),
(6, 'HTML stands for?', 'Hyper Text Markup Language', 'High Text Markup Language', 'Hyperlinks and Text Markup Language', 'Home Tool Markup Language', '1'),
(7, 'Which symbol starts a single-line comment in PHP?', '<!--', '**', '//', '/*', '3'),
(8, 'CSS stands for?', 'Computer Style Sheets', 'Creative Style System', 'Colorful Style Sheets', 'Cascading Style Sheets', '4');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `user_name`, `password`, `email`, `status`) VALUES
(1, 'Demo Student', 'student', '81dc9bdb52d04dc20036dbd8313ed055', 'student@example.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
