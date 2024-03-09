-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 18, 2023 at 09:19 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocmmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

DROP TABLE IF EXISTS `tbladmin`;
CREATE TABLE IF NOT EXISTS `tbladmin` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 8979555589, 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2019-10-11 04:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `tblclass`
--

DROP TABLE IF EXISTS `tblclass`;
CREATE TABLE IF NOT EXISTS `tblclass` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Class` varchar(50) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Class_fee` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblclass`
--

INSERT INTO `tblclass` (`ID`, `Class`, `CreationDate`, `Class_fee`) VALUES
(18, '1st year', '2023-08-27 13:24:43', 10000),
(19, '12th', '2023-09-01 18:45:34', 0),
(20, '12th', '2023-09-04 08:24:41', 5000),
(24, '10th', '2023-09-11 17:50:47', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `tblcourse`
--

DROP TABLE IF EXISTS `tblcourse`;
CREATE TABLE IF NOT EXISTS `tblcourse` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Class` varchar(50) DEFAULT NULL,
  `Subject` varchar(50) DEFAULT NULL,
  `CourseTitle` varchar(250) DEFAULT NULL,
  `CourseDecription` mediumtext,
  `File1` varchar(250) DEFAULT NULL,
  `File2` varchar(250) DEFAULT NULL,
  `File3` varchar(250) DEFAULT NULL,
  `File4` varchar(250) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcourse`
--

INSERT INTO `tblcourse` (`ID`, `Class`, `Subject`, `CourseTitle`, `CourseDecription`, `File1`, `File2`, `File3`, `File4`, `CreationDate`) VALUES
(11, '1', '16', 'Chapter - 1', 'Basic of marketing', 'd41d8cd98f00b204e9800998ecf8427e1693063009.pdf', '', '', '', '2023-08-26 15:16:49'),
(12, '18', '17', 'Benefits of Digital Marketing', 'Index \r\ntopic - 1\r\ntopic - 2', 'd41d8cd98f00b204e9800998ecf8427e1693594067.pdf', '', '', '', '2023-09-01 18:47:47'),
(14, '18', '18', 'Chapter - 1 Cybersec', 'eindex ', 'd41d8cd98f00b204e9800998ecf8427e1693815936.pdf', '', '', '', '2023-09-04 08:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `tblquery`
--

DROP TABLE IF EXISTS `tblquery`;
CREATE TABLE IF NOT EXISTS `tblquery` (
  `sr_no` int NOT NULL AUTO_INCREMENT,
  `stu_id` int NOT NULL,
  `stu_class` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stu_sub` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stu_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stu_query` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `stu_querypic` varchar(250) NOT NULL,
  PRIMARY KEY (`sr_no`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tblquery`
--

INSERT INTO `tblquery` (`sr_no`, `stu_id`, `stu_class`, `stu_sub`, `stu_email`, `stu_query`, `stu_querypic`) VALUES
(1, 4, '18', '17', 'hetkhatusuriya@gmail.com', 'hhh', 'WhatsApp Image 2023-08-13 at 4.41.52 PM.jpeg'),
(2, 4, '18', '18', 'hetkhatusuriya@gmail.com', 'hh', 'd41d8cd98f00b204e9800998ecf8427e1694719403.jpg'),
(3, 4, '18', '17', 'hetkhatusuriya@gmail.com', 'ch-1', 'd41d8cd98f00b204e9800998ecf8427e1694719448.jpg'),
(4, 4, '18', '17', 'hetkhatusuriya@gmail.com', 'hhhhh', 'd41d8cd98f00b204e9800998ecf8427e1694719566.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubject`
--

DROP TABLE IF EXISTS `tblsubject`;
CREATE TABLE IF NOT EXISTS `tblsubject` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `ClassID` int DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubject`
--

INSERT INTO `tblsubject` (`ID`, `ClassID`, `Subject`, `CreationDate`) VALUES
(15, 16, 'english', '2023-07-31 17:11:11'),
(16, 1, 'digital marketing', '2023-08-26 15:14:13'),
(17, 18, 'Digital marketing', '2023-09-01 18:45:50'),
(18, 18, 'cybersecurity', '2023-09-01 18:46:02'),
(19, 19, 'science', '2023-09-01 18:46:28'),
(20, 19, 'Maths', '2023-09-01 18:46:38'),
(21, 19, 'SS', '2023-09-01 18:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

DROP TABLE IF EXISTS `tbluser`;
CREATE TABLE IF NOT EXISTS `tbluser` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `FullName` varchar(250) DEFAULT NULL,
  `MobileNumber` bigint DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `ClassID` int DEFAULT NULL,
  `Password` varchar(250) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `validation` tinyint(1) DEFAULT '0',
  `Paid_fee` int NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FullName`, `MobileNumber`, `Email`, `ClassID`, `Password`, `RegDate`, `validation`, `Paid_fee`) VALUES
(4, 'HET KHATUSURIYA', 6351532048, 'hetkhatusuriya@gmail.com', 18, 'c66133177cd4d5050a02ff2bb947475c', '2023-08-26 15:17:38', 1, 1000),
(7, 'vaibhav1', 9825874666, 'jdj@gmail.com', 19, '310a87565a48526e9d096f917007dbfe', '2023-09-04 17:05:42', 0, 0),
(8, 'user1', 5534567896, 'user1@gmail.com', 18, 'ee11cbb19052e40b07aac0ca060c23ee', '2023-09-04 17:38:21', 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
