-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 18, 2023 at 04:47 AM
-- Server version: 5.7.39
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adas`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appid` int(3) NOT NULL,
  `appDate` date NOT NULL,
  `appTime` time NOT NULL,
  `icPatient` bigint(20) NOT NULL,
  `staffid` int(11) DEFAULT NULL,
  `treatID` int(11) NOT NULL,
  `schedid` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appid`, `appDate`, `appTime`, `icPatient`, `staffid`, `treatID`, `schedid`) VALUES
(600, '2023-07-30', '09:30:00', 123456666, NULL, 408, 600),
(612, '2023-07-25', '10:00:00', 123456666, NULL, 406, 612);

-- --------------------------------------------------------

--
-- Table structure for table `cancellation`
--

CREATE TABLE `cancellation` (
  `cancelid` int(3) NOT NULL,
  `appid` int(11) NOT NULL,
  `comment` text NOT NULL,
  `cancelstatus` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cancellation`
--

INSERT INTO `cancellation` (`cancelid`, `appid`, `comment`, `cancelstatus`) VALUES
(11, 600, 'other', 'approve'),
(14, 612, 'other', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `icPatient` bigint(12) NOT NULL,
  `password` varchar(20) NOT NULL,
  `patientFirstName` varchar(20) NOT NULL,
  `patientLastName` varchar(20) NOT NULL,
  `patientMaritialStatus` varchar(10) NOT NULL,
  `patientDOB` date NOT NULL,
  `patientGender` varchar(10) NOT NULL,
  `patientAddress` varchar(100) NOT NULL,
  `patientPhone` varchar(15) NOT NULL,
  `patientEmail` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`icPatient`, `password`, `patientFirstName`, `patientLastName`, `patientMaritialStatus`, `patientDOB`, `patientGender`, `patientAddress`, `patientPhone`, `patientEmail`) VALUES
(123456666, 'isya01', 'nor', 'isya', 'single', '2003-01-01', 'female', 'jalan 1', '0198765432', 'isya@gmail.com'),
(123456789, 'afaf99', 'afaf', 'afifah', 'single', '1999-04-02', 'female', 'tanah merah, kelantan', '0123456789', 'afaf@gmail.com'),
(1234567899, 'ahmad01', 'ahmad', 'albab', 'single', '2000-01-01', 'male', 'kuala lumpur', '01122379999', 'ab@gmail.com'),
(10505140678, '123', 'hani', 'dzul', 'single', '2001-05-05', 'female', 'jalan 1 taman', '122239676', 'hani@mail.com');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedid` int(3) NOT NULL,
  `schedDate` date NOT NULL,
  `schedDay` varchar(10) NOT NULL,
  `startTime` time NOT NULL,
  `endTime` time NOT NULL,
  `bookAvail` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedid`, `schedDate`, `schedDay`, `startTime`, `endTime`, `bookAvail`) VALUES
(405, '2023-07-05', 'Wednesday', '09:30:00', '10:00:00', 'notAvail'),
(406, '2023-07-05', 'Wednesday', '11:00:00', '11:30:00', 'notAvail'),
(420, '2023-07-06', 'Thursday', '09:00:00', '10:00:00', 'notAvail'),
(421, '2023-07-06', 'Thursday', '10:30:00', '11:30:00', 'notAvail'),
(600, '2023-07-30', 'Sunday', '09:30:00', '10:00:00', 'notAvail'),
(612, '2023-07-25', 'Tuesday', '10:00:00', '10:00:00', 'notAvail');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staffid` int(3) NOT NULL,
  `staffEmail` varchar(50) NOT NULL,
  `staffFirstName` varchar(50) NOT NULL,
  `staffLastName` varchar(50) NOT NULL,
  `staffType` varchar(20) NOT NULL,
  `staffAddress` varchar(255) NOT NULL,
  `staffIC` bigint(14) NOT NULL,
  `staffPass` varchar(14) NOT NULL,
  `staffPhone` varchar(14) NOT NULL,
  `staffTypeName` varchar(10) NOT NULL,
  `staffDOB` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staffid`, `staffEmail`, `staffFirstName`, `staffLastName`, `staffType`, `staffAddress`, `staffIC`, `staffPass`, `staffPhone`, `staffTypeName`, `staffDOB`) VALUES
(100, 'hani@amandental.com', 'Hani', 'puteri', '1', 'No.38 Jalan Enggang Timur 6, Taman Keramat', 10505140674, '0192023a7bbd73', '0122239676', 'clerk', '2001-05-05'),
(101, 'izzati@mail.com', 'Nur Izzati', 'Alias', '2', 'Taman 1, Jalan 2', 10410031966, '0192023a7bbd73', '0123456768', 'dentist', '2001-04-10'),
(102, 'afaf@gmail.com', 'Norafaf Afifah', 'Hanazilah', '2', 'Jalan 1, Taman 3', 990105140674, '0192023a7bbd73', '0122239676', 'dentist', '1999-01-05'),
(202, 'admin@mail.com', 'Sarah', 'Aliessa', '1', 'Jalan taman', 991004140674, 'admin123', '0122239676', 'clerk', '2023-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `treatID` int(5) NOT NULL,
  `treatName` varchar(50) NOT NULL,
  `treatDesc` text NOT NULL,
  `treatPrice` decimal(10,0) NOT NULL,
  `treatImg` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`treatID`, `treatName`, `treatDesc`, `treatPrice`, `treatImg`) VALUES
(406, 'Dental Checkup', 'Get your teeth thoroughly examined by our dentist!', '60', 'checkup.jpg'),
(408, 'Scaling', 'Get your teeth scaled every 6 months!', '85', 'scaling.jpg'),
(409, 'Whitening', 'Teeth whitening can be the solution you need to achieve a brighter and more confident smile', '200', 'Teeth-Whitening-Prices-Malaysia.jpg.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appid`),
  ADD KEY `fk_icPatient` (`icPatient`),
  ADD KEY `fk_staffid` (`staffid`),
  ADD KEY `fk_treatID` (`treatID`),
  ADD KEY `fk_schedid` (`schedid`);

--
-- Indexes for table `cancellation`
--
ALTER TABLE `cancellation`
  ADD PRIMARY KEY (`cancelid`),
  ADD KEY `fk_appid` (`appid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`icPatient`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedid`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staffid`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`treatID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cancellation`
--
ALTER TABLE `cancellation`
  MODIFY `cancelid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=613;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staffid` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `treatID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=410;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `fk_icPatient` FOREIGN KEY (`icPatient`) REFERENCES `patient` (`icPatient`),
  ADD CONSTRAINT `fk_schedid` FOREIGN KEY (`schedid`) REFERENCES `schedule` (`schedid`),
  ADD CONSTRAINT `fk_staffid` FOREIGN KEY (`staffid`) REFERENCES `staff` (`staffid`),
  ADD CONSTRAINT `fk_treatID` FOREIGN KEY (`treatID`) REFERENCES `treatment` (`treatID`);

--
-- Constraints for table `cancellation`
--
ALTER TABLE `cancellation`
  ADD CONSTRAINT `fk_appid` FOREIGN KEY (`appid`) REFERENCES `appointment` (`appid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
