-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2022 at 09:04 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `babysitter`
--

CREATE TABLE `babysitter` (
  `UserId` int(10) NOT NULL,
  `FirstName` varchar(126) NOT NULL,
  `LastName` varchar(126) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Passwrd` varchar(256) NOT NULL,
  `NationalId` int(10) NOT NULL,
  `Age` tinyint(3) NOT NULL,
  `Phone` int(10) NOT NULL,
  `City` varchar(191) NOT NULL,
  `Gender` varchar(191) NOT NULL,
  `Bio` text NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `child`
--

CREATE TABLE `child` (
  `childName` varchar(256) NOT NULL,
  `childAge` int(2) NOT NULL,
  `childId` int(10) NOT NULL,
  `ReqId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `offer1`
--

CREATE TABLE `offer1` (
  `OfferId` int(10) NOT NULL,
  `BabysitterName` varchar(256) NOT NULL,
  `Price` decimal(5,0) NOT NULL,
  `BSId` int(10) NOT NULL,
  `ReqId` int(10) NOT NULL,
  `check` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `ParentId` int(10) NOT NULL,
  `FirstName` varchar(126) NOT NULL,
  `LastName` varchar(126) NOT NULL,
  `Email` varchar(256) NOT NULL,
  `Passwrd` varchar(256) NOT NULL,
  `City` varchar(191) NOT NULL,
  `StreetName` varchar(256) NOT NULL,
  `BuildungNum` int(5) NOT NULL,
  `Area` varchar(256) NOT NULL,
  `photo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `IdReq` int(10) NOT NULL,
  `checkParent` tinyint(1) NOT NULL,
  `TypeOfService` varchar(256) NOT NULL,
  `SitterDate` date NOT NULL,
  `SessionDurationStart` time NOT NULL,
  `SessionDurationEnd` time NOT NULL,
  `ParentId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `ReviewId` int(10) NOT NULL,
  `Rate` int(1) NOT NULL,
  `Review` text NOT NULL,
  `UserId` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `babysitter`
--
ALTER TABLE `babysitter`
  ADD PRIMARY KEY (`UserId`) USING BTREE;

--
-- Indexes for table `child`
--
ALTER TABLE `child`
  ADD PRIMARY KEY (`childId`),
  ADD KEY `ReqId` (`ReqId`);

--
-- Indexes for table `offer1`
--
ALTER TABLE `offer1`
  ADD PRIMARY KEY (`OfferId`),
  ADD KEY `BSId` (`BSId`),
  ADD KEY `ReqId` (`ReqId`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`ParentId`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`IdReq`),
  ADD KEY `ParentId` (`ParentId`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`ReviewId`),
  ADD KEY `review_ibfk_1` (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `babysitter`
--
ALTER TABLE `babysitter`
  MODIFY `UserId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `child`
--
ALTER TABLE `child`
  MODIFY `childId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `offer1`
--
ALTER TABLE `offer1`
  MODIFY `OfferId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `ParentId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `IdReq` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `ReviewId` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `child`
--
ALTER TABLE `child`
  ADD CONSTRAINT `child_ibfk_1` FOREIGN KEY (`ReqId`) REFERENCES `request` (`IdReq`);

--
-- Constraints for table `offer1`
--
ALTER TABLE `offer1`
  ADD CONSTRAINT `offer1_ibfk_1` FOREIGN KEY (`BSId`) REFERENCES `babysitter` (`UserId`),
  ADD CONSTRAINT `offer1_ibfk_2` FOREIGN KEY (`ReqId`) REFERENCES `request` (`IdReq`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`ParentId`) REFERENCES `parent` (`ParentId`);

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`UserId`) REFERENCES `babysitter` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
