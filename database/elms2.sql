-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2022 at 08:41 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elms2`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', 'admin', '2022-07-27 12:08:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbborrow`
--

CREATE TABLE `tbborrow` (
  `BorrowId` int(11) NOT NULL,
  `Work1` varchar(150) NOT NULL,
  `Work2` varchar(150) NOT NULL,
  `BorrowAmount` int(4) NOT NULL,
  `BorrowRequest` date NOT NULL,
  `BorrowReturn` date NOT NULL,
  `Other` varchar(150) NOT NULL,
  `StatusBorrow` int(2) NOT NULL,
  `id` int(11) NOT NULL,
  `TypePercelIdAuto` int(8) NOT NULL,
  `TimeRequest` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `NoteBorrow` varchar(150) NOT NULL,
  `refuseAmount` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbborrow`
--

INSERT INTO `tbborrow` (`BorrowId`, `Work1`, `Work2`, `BorrowAmount`, `BorrowRequest`, `BorrowReturn`, `Other`, `StatusBorrow`, `id`, `TypePercelIdAuto`, `TimeRequest`, `NoteBorrow`, `refuseAmount`) VALUES
(37, 'sad', 'asd', 0, '2022-07-08', '2022-08-03', '-', 2, 7, 2, '2022-07-30 11:09:27', '', 0),
(38, 'ฤ', 'ฺb', 0, '2022-07-14', '2022-07-21', '-', 2, 7, 2, '2022-07-30 11:25:24', '-', 0),
(40, 'A', 'B', 0, '2022-07-30', '2022-08-03', '-', 2, 7, 2, '2022-07-30 11:34:40', '', 4),
(41, 'ฟหก', 'ฟหก', 0, '2022-07-18', '2022-08-03', 'หฟก', 2, 7, 2, '2022-07-30 11:36:51', '', 4),
(42, 'sad', 'sad', 0, '2022-07-15', '2022-07-14', 'sad', 2, 7, 2, '2022-07-30 11:38:35', '', 7),
(43, 'asd', 'asd', 0, '2022-07-30', '2022-08-05', '-', 2, 7, 3, '2022-07-30 11:55:45', '', 3),
(46, 'หฟก', 'หฟก', 0, '2022-07-08', '2022-08-07', '-', 2, 7, 3, '2022-07-30 11:59:11', '', 10),
(47, 'asd', 'sad', 0, '2022-07-26', '2022-08-06', '-', 2, 7, 3, '2022-07-30 12:14:13', '', 15),
(48, 'หฟก', 'ฟหก', 0, '2022-07-01', '2022-07-03', '-', 2, 7, 3, '2022-07-30 15:12:47', 'รับของได้เลย', 15),
(49, '49', '49', 3, '2022-07-01', '2022-07-28', '-', 2, 7, 2, '2022-07-30 17:55:09', '', 0),
(50, '50', '50', 5, '2022-07-30', '2022-08-03', '-', 2, 7, 3, '2022-07-30 17:54:46', '-', 0),
(51, 'sad', 'sad', 3, '2022-07-08', '2022-07-31', '-', 3, 7, 2, '2022-07-30 16:52:09', '', 0),
(52, 'asd', 'sad', 1, '2022-07-07', '2022-08-07', '', 1, 7, 2, '2022-07-30 16:51:57', '', 0),
(53, 'สงขลา', 'ยะลา', 2, '2022-07-22', '2022-07-23', '-', 2, 4, 2, '2022-07-30 18:37:30', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblemployees`
--

CREATE TABLE `tblemployees` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblemployees`
--

INSERT INTO `tblemployees` (`id`, `FirstName`, `LastName`, `EmailId`, `Password`, `Gender`, `Address`, `Phonenumber`, `RegDate`) VALUES
(4, 'ซูไอมี', 'ยะโกะ', 'suhaimee@gmail.com', '11501150', 'ชาย', 'ยะลา', '0936164981', '2022-07-27 17:22:14'),
(7, 'นายมูฮำหมัด', 'ปูตีล่า', 'mazikdot@rmutsvmail.com', '0836530374', 'ชาย', 'บ้านเลขที่ 90 หมู่ 11 ต.ท่าช้าง อ.บางกล่ำ จ.สงขลา 90110', '0834016682', '2022-07-28 16:04:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbpercel`
--

CREATE TABLE `tbpercel` (
  `PercelName` varchar(80) NOT NULL,
  `PercelIdAuto` int(4) NOT NULL,
  `PercelId` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbpercel`
--

INSERT INTO `tbpercel` (`PercelName`, `PercelIdAuto`, `PercelId`) VALUES
('แบบ', 5, 'A'),
('นั่งร้าน', 7, 'B'),
('PRE-B', 8, 'C'),
('เครื่องมือช่าง', 9, 'D'),
('อื่น ๆ', 10, 'E');

-- --------------------------------------------------------

--
-- Table structure for table `tbstatusborrow`
--

CREATE TABLE `tbstatusborrow` (
  `StatusBorrow` int(11) NOT NULL,
  `StatusBorrowName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbstatusborrow`
--

INSERT INTO `tbstatusborrow` (`StatusBorrow`, `StatusBorrowName`) VALUES
(1, 'รอการอนุมัติ'),
(2, 'อนุมัติการเบิก'),
(3, 'ปฎิเสธการเบิก');

-- --------------------------------------------------------

--
-- Table structure for table `tbtypepercel`
--

CREATE TABLE `tbtypepercel` (
  `TypePercelIdAuto` int(8) NOT NULL,
  `TypePercelId` varchar(15) NOT NULL,
  `TypePercelName` varchar(255) NOT NULL,
  `typePercelAmount` int(11) NOT NULL,
  `PercelIdAuto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbtypepercel`
--

INSERT INTO `tbtypepercel` (`TypePercelIdAuto`, `TypePercelId`, `TypePercelName`, `typePercelAmount`, `PercelIdAuto`) VALUES
(2, 'B01', 'ขานั่งร้าน', 0, 7),
(3, 'C01', 'แบบเหล็ก (แบบข้าง PRE-B) น้ำเงิน 60*120', 10, 8),
(4, 'D01', 'เครื่องปั้นหน้าคอนกรีต', 0, 9),
(5, 'E01', 'เซี้ยม PVC ', 0, 10),
(8, 'B02', 'ฝาครอบ', 0, 7);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbborrow`
--
ALTER TABLE `tbborrow`
  ADD PRIMARY KEY (`BorrowId`),
  ADD KEY `id` (`id`),
  ADD KEY `StatusBorrow` (`StatusBorrow`),
  ADD KEY `TypePercelIdAuto` (`TypePercelIdAuto`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbpercel`
--
ALTER TABLE `tbpercel`
  ADD PRIMARY KEY (`PercelIdAuto`);

--
-- Indexes for table `tbstatusborrow`
--
ALTER TABLE `tbstatusborrow`
  ADD PRIMARY KEY (`StatusBorrow`);

--
-- Indexes for table `tbtypepercel`
--
ALTER TABLE `tbtypepercel`
  ADD PRIMARY KEY (`TypePercelIdAuto`),
  ADD KEY `PercelIdAuto` (`PercelIdAuto`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbborrow`
--
ALTER TABLE `tbborrow`
  MODIFY `BorrowId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbpercel`
--
ALTER TABLE `tbpercel`
  MODIFY `PercelIdAuto` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbstatusborrow`
--
ALTER TABLE `tbstatusborrow`
  MODIFY `StatusBorrow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbtypepercel`
--
ALTER TABLE `tbtypepercel`
  MODIFY `TypePercelIdAuto` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbborrow`
--
ALTER TABLE `tbborrow`
  ADD CONSTRAINT `tbborrow_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tblemployees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbborrow_ibfk_2` FOREIGN KEY (`StatusBorrow`) REFERENCES `tbstatusborrow` (`StatusBorrow`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbborrow_ibfk_3` FOREIGN KEY (`TypePercelIdAuto`) REFERENCES `tbtypepercel` (`TypePercelIdAuto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tbtypepercel`
--
ALTER TABLE `tbtypepercel`
  ADD CONSTRAINT `tbtypepercel_ibfk_1` FOREIGN KEY (`PercelIdAuto`) REFERENCES `tbpercel` (`PercelIdAuto`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
