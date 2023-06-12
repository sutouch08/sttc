-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2023 at 08:13 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bex_sttc`
--

-- --------------------------------------------------------

--
-- Table structure for table `inform`
--

CREATE TABLE `inform` (
  `id` int(11) NOT NULL,
  `cust_no` varchar(10) DEFAULT NULL,
  `pea_no` varchar(20) NOT NULL,
  `pea_no_full` varchar(20) DEFAULT NULL,
  `mat_code_full` varchar(20) DEFAULT NULL,
  `ca_no` varchar(20) NOT NULL,
  `cust_name` varchar(100) DEFAULT NULL,
  `cust_address` varchar(250) DEFAULT NULL,
  `cust_tel` varchar(20) DEFAULT NULL,
  `cust_route` varchar(15) DEFAULT NULL,
  `age_meter` int(11) NOT NULL DEFAULT '0',
  `Plan_TableName` varchar(250) DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `date_add` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_upd` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `team_group_id` int(11) DEFAULT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `longitude` decimal(9,6) DEFAULT NULL,
  `status` set('P','S','F') NOT NULL DEFAULT 'P' COMMENT 'P = Pending,\r\nS = Success\r\nF = Failed\r\n',
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `inform`
--

INSERT INTO `inform` (`id`, `cust_no`, `pea_no`, `pea_no_full`, `mat_code_full`, `ca_no`, `cust_name`, `cust_address`, `cust_tel`, `cust_route`, `age_meter`, `Plan_TableName`, `remark`, `date_add`, `date_upd`, `user_id`, `team_id`, `team_group_id`, `latitude`, `longitude`, `status`, `message`) VALUES
(1, '006603', '16187477', '000000000016187477', '106001', '200068048961', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 12, 'PLAN_C_2565_10_31_0959', '1111111', '2023-06-10 21:28:36', '2023-06-10 14:28:37', 14, 1, 1, '13.794886', '100.301131', 'F', 'Sorry, please try again later! ( S2 )'),
(2, '006607', '16187481', '000000000016187481', '106005', '200068048965', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 12, 'PLAN_C_2565_10_31_0959', '12121212', '2023-06-10 22:47:23', '2023-06-10 15:47:27', 14, 1, 1, '13.794885', '100.301127', 'F', 'Sorry, please try again later! ( S2 )'),
(3, '006603', '16187476', '000000000016187476', '000000001060050001', '020006804895', 'นายสำรวย วิมานทอง', '105/1 ม.7 ต.สรรพยา อ.สรรพยา', NULL, 'CSPY0001', 20, 'PLAN_C_2565_10_31_0959', '121212121', '2023-06-11 15:02:21', '2023-06-11 08:02:21', 14, 1, 1, '13.794890', '100.301126', 'F', 'Sorry, please try again later! ( S2 )'),
(4, '006608', '16187482', '000000000016187482', '106006', '200068048966', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 2, 'PLAN_C_2565_10_31_0959', '11111111111', '2023-06-11 15:14:16', '2023-06-11 08:14:16', 14, 1, 1, '13.794887', '100.301130', 'F', 'Sorry, please try again later! ( S2 )'),
(5, '006610', '16187484', '000000000016187484', '106008', '200068048968', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 2, 'PLAN_C_2565_10_31_0959', '1234564546', '2023-06-11 16:26:12', '2023-06-11 09:26:12', 14, 1, 1, '13.794883', '100.301131', 'F', 'Sorry, please try again later! ( S2 )'),
(6, '006611', '16187485', '000000000016187485', '106009', '200068048969', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 12, 'PLAN_C_2565_10_31_0959', '1122333444', '2023-06-11 21:17:08', '2023-06-11 14:17:08', 14, 1, 1, '13.794890', '100.301125', 'F', 'Sorry, please try again later! ( S2 )');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inform`
--
ALTER TABLE `inform`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pea_no` (`pea_no`) USING BTREE,
  ADD KEY `team_id` (`team_id`),
  ADD KEY `user_id` (`team_group_id`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inform`
--
ALTER TABLE `inform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
