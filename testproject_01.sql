-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2020 at 12:02 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testproject_01`
--

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `CAR_ID` varchar(3) NOT NULL,
  `CAR_TYPE` varchar(50) DEFAULT NULL,
  `CAR_PRICE` varchar(50) DEFAULT NULL,
  `CAR_NUMBER_P` varchar(50) DEFAULT NULL,
  `CAR_SEAT_MAX` varchar(50) DEFAULT NULL,
  `CAR_STATUS` varchar(3) DEFAULT NULL,
  `CAR_SERVICE_CHARGE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`CAR_ID`, `CAR_TYPE`, `CAR_PRICE`, `CAR_NUMBER_P`, `CAR_SEAT_MAX`, `CAR_STATUS`, `CAR_SERVICE_CHARGE`) VALUES
('1', 'รถกระบะ', '10', 'CJ-001', '7', '1', '50'),
('2', 'รถตู้-พัดลม', '10', 'TU-001', '10', '1', '100'),
('3', 'รถตู้-แอร์', '15', 'TU-002', '10', '4', '150'),
('4', 'รถบัส-พัดลม', '10', 'BUS-001', '30', '4', '200'),
('5', 'รถบัส-แอร์', '10', 'BUS-002', '30', '1', '250'),
('6', 'รถกระบะ', '10', 'CJ-002', '7', '1', '50');

-- --------------------------------------------------------

--
-- Table structure for table `car_status_detail`
--

CREATE TABLE `car_status_detail` (
  `CAR_STATUS` varchar(3) NOT NULL,
  `CAR_STATUS_DETAIL` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_status_detail`
--

INSERT INTO `car_status_detail` (`CAR_STATUS`, `CAR_STATUS_DETAIL`) VALUES
('1', 'รถพร้อมใช้งาน'),
('2', 'รถกำลังให้บริการ'),
('3', 'รถถูกจอง'),
('4', 'รถไม่พร้อมให้บริการ');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `DRI_ID` varchar(3) NOT NULL,
  `DRI_NAME` varchar(50) DEFAULT NULL,
  `DRI_LNAME` varchar(50) DEFAULT NULL,
  `OT` varchar(3) NOT NULL,
  `STA` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`DRI_ID`, `DRI_NAME`, `DRI_LNAME`, `OT`, `STA`) VALUES
('1', 'พงศธร', 'พุทธา', '50', '1'),
('2', 'ณัฐวุฒิ', 'คำเสียง', '50', '1'),
('3', 'วราวุธ', 'ทองโชติ', '50', '0'),
('4', 'ทองดี', 'ผลงาม', '50', '1'),
('5', 'มนัสวี', 'นพลิต', '60', '1');

-- --------------------------------------------------------

--
-- Table structure for table `queues`
--

CREATE TABLE `queues` (
  `QUEUES_ID` varchar(3) NOT NULL,
  `START_DATE` date DEFAULT NULL,
  `START_TIME` time DEFAULT NULL,
  `END_DATE` date DEFAULT NULL,
  `END_TIME` time DEFAULT NULL,
  `Q_LOCATION` varchar(50) DEFAULT NULL,
  `NUM_SEAT` varchar(50) DEFAULT NULL,
  `DISTANCE` varchar(50) DEFAULT NULL,
  `USER_ID` varchar(3) NOT NULL,
  `CAR_ID` varchar(3) NOT NULL,
  `DRI_ID` varchar(3) NOT NULL,
  `QUEUES_STA_ID` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `queues`
--

INSERT INTO `queues` (`QUEUES_ID`, `START_DATE`, `START_TIME`, `END_DATE`, `END_TIME`, `Q_LOCATION`, `NUM_SEAT`, `DISTANCE`, `USER_ID`, `CAR_ID`, `DRI_ID`, `QUEUES_STA_ID`) VALUES
('1', '2019-07-01', '05:00:00', '2019-07-02', '21:00:00', 'BUU-BANGSAEN', '4', '400', '1', '3', '1', '3'),
('2', '2019-07-01', '05:20:00', '2019-07-02', '21:00:00', 'BUU-BANGSAEN', '4', '400', '2', '3', '1', '4'),
('3', '2019-08-12', '08:00:00', '2019-08-12', '17:15:00', 'CENTRAL-CHAN', '8', '70', '5', '1', '1', '4'),
('4', '2019-07-10', '13:00:00', '2019-07-11', '14:00:00', 'Lotus', '4', '20', '1', '2', '1', '3'),
('5', '2019-11-05', '11:44:00', '2019-11-05', '11:44:00', 'ท่าทรายเมืองจัน', '3', '40', '1', '1', '1', '3');

-- --------------------------------------------------------

--
-- Table structure for table `queues_detail`
--

CREATE TABLE `queues_detail` (
  `queues_id` varchar(3) CHARACTER SET utf8 NOT NULL,
  `queues_detail_text` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `queues_detail`
--

INSERT INTO `queues_detail` (`queues_id`, `queues_detail_text`) VALUES
('1', 'ศึกษาดูงาน'),
('2', 'ศึกษาดูงาน'),
('3', 'ซื้อของมาทำกิจกรรมที่มหาลัย'),
('4', 'ซื้อของทำกิจกรรม'),
('5', 'ขนทราย');

-- --------------------------------------------------------

--
-- Table structure for table `queues_status`
--

CREATE TABLE `queues_status` (
  `QUEUES_STA_ID` varchar(3) NOT NULL,
  `QUEUES_STA_DETAIL` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `queues_status`
--

INSERT INTO `queues_status` (`QUEUES_STA_ID`, `QUEUES_STA_DETAIL`) VALUES
('1', 'รออนุมัติ'),
('2', 'รอชำระเงิน'),
('3', 'รอเดินทาง'),
('4', 'เรียบร้อยแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `queues_user`
--

CREATE TABLE `queues_user` (
  `QUEUES_ID` varchar(3) NOT NULL,
  `USER_ID` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `queues_user`
--

INSERT INTO `queues_user` (`QUEUES_ID`, `USER_ID`) VALUES
('1', '3'),
('1', '4'),
('1', '5'),
('2', '6'),
('2', '7'),
('2', '8'),
('2', '9'),
('3', '1'),
('3', '2'),
('4', '1'),
('5', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USER_ID` varchar(3) NOT NULL,
  `USER_NAME` varchar(50) DEFAULT NULL,
  `USER_RANK` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USER_ID`, `USER_NAME`, `USER_RANK`) VALUES
('1', 'พงศธร', 'นิสิต'),
('2', 'ณัฐวุฒิ', 'นิสิต'),
('3', 'วราวุธิ', 'นิสิต'),
('4', 'ธนาธร', 'นิสิต'),
('5', 'เกตุชัย', 'นิสิต'),
('6', 'ยิ่งลักษ์', 'นิสิต'),
('7', 'ภีรภัทธ์', 'นิสิต'),
('8', 'สุชาติ', 'นิสิต'),
('9', 'ชัชชาติ', 'นิสิต');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`CAR_ID`),
  ADD KEY `car_status_detail` (`CAR_STATUS`);

--
-- Indexes for table `car_status_detail`
--
ALTER TABLE `car_status_detail`
  ADD PRIMARY KEY (`CAR_STATUS`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`DRI_ID`);

--
-- Indexes for table `queues`
--
ALTER TABLE `queues`
  ADD PRIMARY KEY (`QUEUES_ID`),
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `queues_ibfk_2` (`CAR_ID`),
  ADD KEY `queues_ibfk_3` (`DRI_ID`);

--
-- Indexes for table `queues_detail`
--
ALTER TABLE `queues_detail`
  ADD PRIMARY KEY (`queues_id`);

--
-- Indexes for table `queues_status`
--
ALTER TABLE `queues_status`
  ADD PRIMARY KEY (`QUEUES_STA_ID`);

--
-- Indexes for table `queues_user`
--
ALTER TABLE `queues_user`
  ADD KEY `queues_user_fk` (`QUEUES_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USER_ID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_status_detail` FOREIGN KEY (`CAR_STATUS`) REFERENCES `car_status_detail` (`CAR_STATUS`);

--
-- Constraints for table `queues`
--
ALTER TABLE `queues`
  ADD CONSTRAINT `queues_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`),
  ADD CONSTRAINT `queues_ibfk_2` FOREIGN KEY (`CAR_ID`) REFERENCES `car` (`CAR_ID`),
  ADD CONSTRAINT `queues_ibfk_3` FOREIGN KEY (`DRI_ID`) REFERENCES `driver` (`DRI_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
