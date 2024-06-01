-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 05:55 AM
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
-- Database: `essu_admissiondb`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `ay_ID` int(5) NOT NULL,
  `code` int(5) NOT NULL,
  `acad_year` varchar(10) NOT NULL,
  `sem` varchar(10) NOT NULL,
  `status` int(5) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`ay_ID`, `code`, `acad_year`, `sem`, `status`) VALUES
(1, 231, '2023-2024', '1st sem', 0),
(2, 232, '2023-2024', '2nd sem', 0),
(3, 241, '2024-2025', '1st sem', 1),
(4, 242, '2024-2025', '2nd sem', 0);

-- --------------------------------------------------------

--
-- Table structure for table `account_tab`
--

CREATE TABLE `account_tab` (
  `accID` int(10) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `pob` varchar(50) NOT NULL,
  `civstat` varchar(20) NOT NULL,
  `brgy` varchar(50) NOT NULL,
  `mun` varchar(30) NOT NULL,
  `prov` varchar(30) NOT NULL,
  `pword` varchar(50) NOT NULL,
  `usertype` varchar(10) NOT NULL DEFAULT 'user',
  `code` varchar(30) DEFAULT NULL,
  `verify` int(2) DEFAULT NULL,
  `apprefno` varchar(20) DEFAULT NULL,
  `sy` int(5) NOT NULL,
  `campus` varchar(30) NOT NULL,
  `tsite` varchar(60) NOT NULL,
  `fchoice` longtext NOT NULL,
  `schoice` longtext NOT NULL,
  `tchoice` longtext NOT NULL,
  `lschool` varchar(50) NOT NULL,
  `lsaddress` varchar(50) NOT NULL,
  `lsy` year(4) NOT NULL,
  `genave` varchar(10) DEFAULT NULL,
  `q1` varchar(5) NOT NULL,
  `q1a` varchar(20) DEFAULT NULL,
  `q2` varchar(5) NOT NULL,
  `q2a` varchar(20) DEFAULT NULL,
  `idPic` varchar(100) NOT NULL,
  `rCard` varchar(100) NOT NULL,
  `gMoral` varchar(100) NOT NULL,
  `tsched` datetime NOT NULL,
  `relresult` date DEFAULT NULL,
  `stat` int(2) NOT NULL DEFAULT 0,
  `stat1` int(5) NOT NULL DEFAULT 0,
  `stat2` int(5) NOT NULL,
  `accYear` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_tab`
--

INSERT INTO `account_tab` (`accID`, `lname`, `fname`, `mname`, `email`, `contact`, `sex`, `dob`, `pob`, `civstat`, `brgy`, `mun`, `prov`, `pword`, `usertype`, `code`, `verify`, `apprefno`, `sy`, `campus`, `tsite`, `fchoice`, `schoice`, `tchoice`, `lschool`, `lsaddress`, `lsy`, `genave`, `q1`, `q1a`, `q2`, `q2a`, `idPic`, `rCard`, `gMoral`, `tsched`, `relresult`, `stat`, `stat1`, `stat2`, `accYear`) VALUES
(1, 'testing', 'essu', 'admission', 'essuadmissionandtesting0@gmail.com', '09123456789', 'Female', '2013-03-11', 'Borongan City', 'Single', 'Maypangdan', 'Borongan City', 'Eastern Samar', 'a422cef1514127096adfb54a7d39109c', 'admin', 'myXHdMoThsFO', 1, '', 0, '', '', '', '', '', '', '', 0000, '', '', '', '', '', '', '', '', '0000-00-00 00:00:00', '0000-00-00', 0, 0, 0, 2023),
(2, 'Tangara', 'Ruth Ella', 'Dulfo', 'ruth.tangara07@gmail.com', '09454392890', 'Female', '0000-00-00', 'Borongan City', '', '', '', '', '0192023a7bbd73250516f069df18b500', 'admin', 'myXHdMoThsFO', 1, NULL, 0, '', '', '', '', '', '', '', 0000, NULL, '', NULL, '', NULL, '', '', '', '2024-05-23 04:18:26', NULL, 0, 0, 0, 2024),
(3, 'Tangara', 'Ruth Ella', 'Dulfo', 'ruth.tangara7@gmail.com', '09454392890', 'Female', '2000-09-18', 'Borongan City', 'Single', 'Alang-Alang', 'Borongan', 'Eastern Samar', '9a3b74765cf4c5558c817edb70ea457f', 'user', 'syCqf2W3xViv', 1, NULL, 0, '', '', '', '', '', '', '', 0000, NULL, '', NULL, '', NULL, '', '', '', '0000-00-00 00:00:00', NULL, 0, 0, 0, 2024),
(4, 'Tangara', 'Ruth Ella', 'Dulfo', 'ruth.tangara7@gmail.com', '09454392890', 'Female', '2000-09-18', 'Borongan City', 'Single', 'Alang-Alang', 'Borongan', 'Eastern Samar', '9a3b74765cf4c5558c817edb70ea457f', 'user', 'PkAe3Yrz46RG', NULL, NULL, 0, '', '', '', '', '', '', '', 0000, NULL, '', NULL, '', NULL, '', '', '', '0000-00-00 00:00:00', NULL, 0, 0, 0, 2024);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `email` varchar(50) NOT NULL,
  `keyy` varchar(60) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_reset_temp`
--

INSERT INTO `password_reset_temp` (`email`, `keyy`, `expDate`) VALUES
('essuadmissionandtesting0@gmail.com', 'f6b2e810e1cd6e27de6b7f898fa45982b3be2dec4a', '2024-05-24 04:46:59');

-- --------------------------------------------------------

--
-- Table structure for table `program_tab`
--

CREATE TABLE `program_tab` (
  `progID` int(5) NOT NULL,
  `college` varchar(50) NOT NULL,
  `program` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_tab`
--

INSERT INTO `program_tab` (`progID`, `college`, `program`) VALUES
(1, 'CCS', 'Associate in Computer Technology'),
(2, 'CAS', 'Bachelor Of Arts In Communication'),
(3, 'CAS', 'Bachelor Of Arts In Political Science'),
(4, 'COED', 'Bachelor Of Elementary Education'),
(5, 'COED', 'Bachelor Of Secondary Education Major In English'),
(6, 'COED', 'Bachelor Of Secondary Education Major In Filipino'),
(7, 'COED', 'Bachelor Of Secondary Education Major In Mathematics'),
(8, 'COED', 'Bachelor Of Secondary Education Major In Science'),
(9, 'COED', 'Bachelor Of Secondary Education Major In Social Studies'),
(10, 'COE', 'Bachelor Of Science In Electrical Engineering'),
(11, 'COHM', 'Bachelor Of Science In Hospitality Management'),
(12, 'CBMA', 'Bachelor Of Science In Accountancy'),
(13, 'CBMA', 'Bachelor Of Science In Accounting Information System'),
(14, 'CANS', 'Bachelor of Science in Agriculture '),
(15, 'CONAS', 'Bachelor of Science in Biology'),
(16, 'CBMA', 'Bachelor Of Science In Business Administration Major In Business Economics'),
(17, 'CBMA', 'Bachelor Of Science In Business Administration Major In Financial Management'),
(18, 'CBMA', 'Bachelor Of Science In Business Administration Major In Human Resource Development Management'),
(19, 'CBMA', 'Bachelor Of Science In Business Administration Major In Marketing Management'),
(20, 'COE', 'Bachelor Of Science In Civil Engineering'),
(21, 'COE', 'Bachelor Of Science In Computer Engineering'),
(22, 'CCS', 'Bachelor Of Science In Computer Science'),
(23, 'CCJE', 'Bachelor Of Science In Criminology'),
(24, 'CCS', 'Bachelor Of Science In Entertainment And Multimedia Computing Major In Digital Animation Technology'),
(25, 'CANS', 'Bachelor of Science in Environmental Science'),
(26, 'CCS', 'Bachelor Of Science In Information Technology'),
(27, 'CANS', 'Bachelor of Science in Fisheries'),
(28, 'CONAS', 'Bachelor of Science in Nursing'),
(29, 'CONAS', 'Bachelor of Science in Nutrition & Dietetics'),
(30, 'COHM', 'Bachelor Of Science In Tourism Management'),
(31, 'CAS', 'Bachelor Of Science In Social Work'),
(32, 'CONAS', 'Diploma in Midwifery'),
(33, 'COL', 'Juris Doctor'),
(34, 'COT', 'BS in Industrial Technology - Automotive Technology'),
(35, 'COT', 'BS in Industrial Technology - Drafting Technology'),
(36, 'COT', 'BS in Industrial Technology - Electronics Technology'),
(37, 'COT', 'BS in Industrial Technology - Electrical Technology'),
(38, 'CBMA', 'Bachelor of Science in Entrepreneurship');

-- --------------------------------------------------------

--
-- Table structure for table `province_tab`
--

CREATE TABLE `province_tab` (
  `provNo` int(5) NOT NULL,
  `provName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `province_tab`
--

INSERT INTO `province_tab` (`provNo`, `provName`) VALUES
(1, 'Eastern Samar'),
(2, 'Northern Samar'),
(3, 'Leyte'),
(4, '');

-- --------------------------------------------------------

--
-- Table structure for table `result_tab`
--

CREATE TABLE `result_tab` (
  `resultNo` int(10) NOT NULL,
  `stuID` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `vcscore` int(5) NOT NULL,
  `vrscore` int(5) NOT NULL,
  `frscore` int(5) NOT NULL,
  `qrscore` int(5) NOT NULL,
  `scaledscore` int(5) NOT NULL,
  `sai` int(5) NOT NULL,
  `perrank` varchar(10) NOT NULL,
  `stanine` int(5) NOT NULL,
  `stat` int(5) NOT NULL DEFAULT 0,
  `resYear` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_archive`
--

CREATE TABLE `student_archive` (
  `archiveID` int(5) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `pob` varchar(50) NOT NULL,
  `civstat` varchar(15) NOT NULL,
  `brgy` varchar(50) NOT NULL,
  `mun` varchar(30) NOT NULL,
  `prov` varchar(30) NOT NULL,
  `apprefno` varchar(20) NOT NULL,
  `sy` int(5) NOT NULL,
  `campus` varchar(30) NOT NULL,
  `tsite` varchar(70) NOT NULL,
  `fchoice` longtext NOT NULL,
  `schoice` longtext NOT NULL,
  `tchoice` longtext NOT NULL,
  `lschool` varchar(50) NOT NULL,
  `lsaddress` varchar(50) NOT NULL,
  `lsy` varchar(20) NOT NULL,
  `genave` varchar(10) DEFAULT NULL,
  `q1` varchar(5) NOT NULL,
  `q1a` varchar(20) DEFAULT NULL,
  `q2` varchar(5) NOT NULL,
  `q2a` varchar(20) DEFAULT NULL,
  `idPic` varchar(90) NOT NULL,
  `rCard` varchar(90) NOT NULL,
  `gMoral` varchar(90) NOT NULL,
  `tsched` datetime NOT NULL,
  `relresult` date DEFAULT NULL,
  `vcscore` int(5) NOT NULL,
  `vrscore` int(5) NOT NULL,
  `frscore` int(5) NOT NULL,
  `qrscore` int(5) NOT NULL,
  `scaledscr` int(5) NOT NULL,
  `sai` int(5) NOT NULL,
  `perrank` varchar(10) NOT NULL,
  `stanine` int(5) NOT NULL,
  `accYear` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tcenter_tab`
--

CREATE TABLE `tcenter_tab` (
  `tcenterID` int(5) NOT NULL,
  `tcenter` varchar(50) NOT NULL,
  `tcenterAdd` varchar(50) NOT NULL,
  `tcenterYear` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tcenter_tab`
--

INSERT INTO `tcenter_tab` (`tcenterID`, `tcenter`, `tcenterAdd`, `tcenterYear`) VALUES
(1, 'Arteche National High School', 'Arteche Eastern Samar', 2023),
(2, 'Southern Samar National Comprehensive High School', 'Balangiga Eastern Samar', 2023),
(3, 'Dolores National High School', 'Dolores Eastern Samar', 2023),
(4, 'ESSU Main', 'Borongan Eastern Samar', 2023),
(5, 'Llorente National High School', 'Llorente Eastern Samar', 2023),
(6, 'Taft National High School', 'Taft Eastern Samar', 2023);

-- --------------------------------------------------------

--
-- Table structure for table `tsched_tab`
--

CREATE TABLE `tsched_tab` (
  `schedID` int(5) NOT NULL,
  `code` int(5) NOT NULL,
  `sched` datetime NOT NULL,
  `stat` int(2) NOT NULL DEFAULT 0,
  `schedYear` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tsched_tab`
--

INSERT INTO `tsched_tab` (`schedID`, `code`, `sched`, `stat`, `schedYear`) VALUES
(1, 231, '2023-03-31 08:00:00', 0, 2023),
(2, 231, '2023-03-31 10:00:00', 0, 2023),
(3, 231, '2023-03-31 13:00:00', 0, 2023),
(4, 231, '2023-03-31 15:00:00', 0, 2023),
(5, 231, '2023-04-07 08:00:00', 0, 2023);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
  ADD PRIMARY KEY (`ay_ID`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `account_tab`
--
ALTER TABLE `account_tab`
  ADD PRIMARY KEY (`accID`),
  ADD UNIQUE KEY `apprefno` (`apprefno`);

--
-- Indexes for table `program_tab`
--
ALTER TABLE `program_tab`
  ADD PRIMARY KEY (`progID`);

--
-- Indexes for table `province_tab`
--
ALTER TABLE `province_tab`
  ADD PRIMARY KEY (`provNo`);

--
-- Indexes for table `result_tab`
--
ALTER TABLE `result_tab`
  ADD PRIMARY KEY (`resultNo`),
  ADD KEY `stuNo` (`stuID`);

--
-- Indexes for table `student_archive`
--
ALTER TABLE `student_archive`
  ADD PRIMARY KEY (`archiveID`);

--
-- Indexes for table `tcenter_tab`
--
ALTER TABLE `tcenter_tab`
  ADD PRIMARY KEY (`tcenterID`);

--
-- Indexes for table `tsched_tab`
--
ALTER TABLE `tsched_tab`
  ADD PRIMARY KEY (`schedID`),
  ADD KEY `fk_code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_year`
--
ALTER TABLE `academic_year`
  MODIFY `ay_ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `account_tab`
--
ALTER TABLE `account_tab`
  MODIFY `accID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `program_tab`
--
ALTER TABLE `program_tab`
  MODIFY `progID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `province_tab`
--
ALTER TABLE `province_tab`
  MODIFY `provNo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `result_tab`
--
ALTER TABLE `result_tab`
  MODIFY `resultNo` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_archive`
--
ALTER TABLE `student_archive`
  MODIFY `archiveID` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tcenter_tab`
--
ALTER TABLE `tcenter_tab`
  MODIFY `tcenterID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tsched_tab`
--
ALTER TABLE `tsched_tab`
  MODIFY `schedID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `result_tab`
--
ALTER TABLE `result_tab`
  ADD CONSTRAINT `stuNo` FOREIGN KEY (`stuID`) REFERENCES `account_tab` (`apprefno`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tsched_tab`
--
ALTER TABLE `tsched_tab`
  ADD CONSTRAINT `fk_code` FOREIGN KEY (`code`) REFERENCES `academic_year` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
