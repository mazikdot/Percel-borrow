SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS elms CHARACTER SET utf8 COLLATE utf8_general_ci;

/*---------admin-----------*/
CREATE TABLE IF NOT EXISTS admin(
 	  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
)CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Dumping data for table `admin`
INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2021-09-06 05:55:30');


/*--------tbldepartments-----------*/
CREATE TABLE IF NOT EXISTS tbldepartments(
  `id` int(11) NOT NULL,
  `DepartmentName` varchar(150) DEFAULT NULL,
  `DepartmentShortName` varchar(100) NOT NULL,
  `DepartmentCode` varchar(50) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
)CHARACTER SET utf8 COLLATE utf8_general_ci;


INSERT INTO `tbldepartments` (`id`, `DepartmentName`, `DepartmentShortName`, `DepartmentCode`, `CreationDate`) VALUES
(1, 'ฝ่ายทะเบียน', 'RD', 'RD000', '2021-09-06 07:16:25'),
(2, 'ฝ่ายอำนวยการ', 'AM', 'AM000', '2021-09-06 07:19:37'),
(3, 'ฝ่ายรังวัด', 'SY', 'SY000', '2021-09-06 07:19:37'),
(4, 'ฝ่ายการเงิน', 'OP', 'OP000', '2021-09-06 07:28:56');


/*----------tblemployees----------*/
CREATE TABLE IF NOT EXISTS tblemployees(
 `id` int(11) NOT NULL,
  `EmpId` varchar(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `EmailId` varchar(200) NOT NULL,
  `Password` varchar(180) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `Dob` varchar(100) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `City` varchar(200) NOT NULL,
  `Country` varchar(150) NOT NULL,
  `Phonenumber` char(11) NOT NULL,
  `Status` int(1) NOT NULL,
  `RegDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
)CHARACTER SET utf8 COLLATE utf8_general_ci;


-- Dumping data for table `tblemployees`
INSERT INTO `tblemployees` (`id`, `EmpId`, `FirstName`, `LastName`, `EmailId`, `Password`, `Gender`, `Dob`, `Department`, `Address`, `City`, `Country`, `Phonenumber`, `Status`, `RegDate`) VALUES
(1, 'RD001', 'นายทวีศักดิ์  ', 'นิลประเสริฐ', 'twisak@gmail.com', '36d59e2369f00c4d9f336acf4408bae9', 'ชาย', '3 February, 1990', 'ฝ่ายทะเบียน', 'จ.ปัตตานี', 'อ.เมือง', 'ไทย', '0123456789', 1, '2021-09-06 11:29:59'),
(2, 'AM001', 'นายจักรกฤษณ์', 'วัชรวรานนท์', 'james@gmail.com', 'f925916e2754e5e03f75dd58a5733251', 'ชาย', '3 February, 1990', 'ฝ่ายอำนวยการ', 'จ.สงขลา', 'อ.เมือง', 'ไทย', '9876543210', 1, '2021-09-06 13:40:02');


/*-------------tblleaves-----------*/
CREATE TABLE IF NOT EXISTS tblleaves(
  `id` int(11) NOT NULL,
  `LeaveType` varchar(110) NOT NULL,
  `ToDate` varchar(120) NOT NULL,
  `FromDate` varchar(120) NOT NULL,
  `Description` mediumtext NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `AdminRemark` mediumtext,
  `AdminRemarkDate` varchar(120) DEFAULT NULL,
  `Status` int(1) NOT NULL,
  `IsRead` int(1) NOT NULL,
  `empid` int(11) DEFAULT NULL
)CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Dumping data for table `tblleaves`
--

INSERT INTO `tblleaves` (`id`, `LeaveType`, `ToDate`, `FromDate`, `Description`, `PostingDate`, `AdminRemark`, `AdminRemarkDate`, `Status`, `IsRead`, `empid`) VALUES
(1, 'มีเหตุจำเป็น', '07/09/2021', '09/10/2017', 'พ่อไม่สบาย', '2021-09-06 13:11:21', 'ถ้าหากมีเหตุจำเป็นให้พนักงานทำการเก็บหลักฐานต่างๆแล้วเอามายื่นวันที่มาทำงาน', '2021-09-06 23:26:27 ', 2, 1, 1),
(2, 'มีอาการไม่สบายกระทันหัน', '07/09/2021', '09/10/2017', 'ตัวร้อนหนัก', '2021-09-06 13:11:21', 'ถ้ามีอาการไม่สบายกระทันหันให้พนักทำการไปขอใบรับรองแพทน์และมาทำการยื่นในวันที่มาทำงาน', '2021-09-06 23:24:39 ', 1, 1, 1);

/*-------------tblleavetype-----------*/
CREATE TABLE IF NOT EXISTS tblleavetype(
  `id` int(11) NOT NULL,
  `LeaveType` varchar(200) DEFAULT NULL,
  `Description` mediumtext,
  `CreationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
)CHARACTER SET utf8 COLLATE utf8_general_ci;
-- Dumping data for table `tblleavetype`
--

INSERT INTO `tblleavetype` (`id`, `LeaveType`, `Description`, `CreationDate`) VALUES
(1, 'มีเหตุจำเป็น', 'ถ้าหากมีเหตุจำเป็นให้พนักงานทำการเก็บหลักฐานต่างๆแล้วเอามายื่นวันที่มาทำงาน ', '2021-09-06 12:07:56'),
(2, 'มีอาการไม่สบายกระทันหัน', 'ถ้ามีอาการไม่สบายกระทันหันให้พนักทำการไปขอใบรับรองแพทน์และมาทำการยื่นในวันที่มาทำงาน', '2021-09-06 13:16:09'),
(3, 'เนื่องจากเป็นวันหยุด', 'วันหยุดปกติ', '2021-09-06 13:16:09'),
(4, 'เกิดอุบัติเหตุระหว่างทาง', 'ทำการถ่ายรูปหรือหลักฐานต่าง', '2021-09-06 13:16:09'),
(5, 'ไม่มียานพาหนะในการเดินทาง', 'กรุณาระบุเหตุผล', '2021-09-06 13:16:09'),
(6, 'ลาอื่น', 'โปรดระบุ', '2021-09-06 13:16:38');

-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblleaves`
--
ALTER TABLE `tblleaves`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserEmail` (`empid`);

--
-- Indexes for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbldepartments`
--
ALTER TABLE `tbldepartments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblleaves`
--
ALTER TABLE `tblleaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--

-- setAUTO_INCREMENT
alter table tblleaves AUTO_INCREMENT=3;
alter table tbldepartments AUTO_INCREMENT=5;
alter table tblemployees AUTO_INCREMENT=3;
alter table tblleavetype AUTO_INCREMENT=7;


-- AUTO_INCREMENT for table `tblleavetype`
--
ALTER TABLE `tblleavetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;