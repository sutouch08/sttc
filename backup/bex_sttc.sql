-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2023 at 06:08 AM
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
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `code` varchar(50) CHARACTER SET utf8 NOT NULL,
  `name` varchar(254) CHARACTER SET utf8 DEFAULT NULL,
  `value` varchar(250) CHARACTER SET utf8 NOT NULL,
  `group_code` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8 NOT NULL,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`code`, `name`, `value`, `group_code`, `description`, `date_upd`) VALUES
('CLOSE_SYSTEM', 'ปิดปรับปรุงระบบ', '0', 'System', '', '2023-04-17 15:11:57'),
('COMPANY_ADDRESS1', 'ที่อยู่', '68/1 ซอยประเสริฐมนูกิจ 29 ถนนประเสริฐมนูกิจ', 'Company', '', '2023-01-25 07:14:02'),
('COMPANY_ADDRESS2', NULL, 'แขวงลาดพร้าว เขตลาดพร้าว กรุงเทพฯ', 'Company', '', '2023-01-25 07:14:02'),
('COMPANY_CODE', 'รหัสบริษัท', '0001', 'Company', '', '2019-08-31 11:49:52'),
('COMPANY_EMAIL', 'อีเมล์', 'smartttc.1994@gmail.com', 'Company', '', '2023-01-25 07:14:02'),
('COMPANY_FACEBOOK', NULL, '', 'Company', '', '2022-07-14 03:04:00'),
('COMPANY_FAX', 'แฟกซ์', '02 157 0704', 'Company', '', '2023-01-25 07:14:02'),
('COMPANY_FULL_NAME', 'ชื่อเต็ม', 'บริษัท สมาร์ททีทีซี จำกัด', 'Company', '', '2023-01-25 07:14:02'),
('COMPANY_LINE', 'LINE', '', 'Company', '', '2022-07-01 03:23:33'),
('COMPANY_NAME', 'ชื่อย่อ', 'Smart TTC', 'Company', '', '2023-03-15 05:26:45'),
('COMPANY_PHONE', 'โทรศัพท์', '02 157 0701-3', 'Company', '', '2023-01-25 07:14:02'),
('COMPANY_POST_CODE', 'รหัสไปรษณีย์', '10230', 'Company', '', '2023-01-25 07:14:02'),
('COMPANY_TAX_ID', 'เลขที่ผู้เสียภาษี', '0105537087617', 'Company', '', '2023-01-25 07:14:02'),
('COMPANY_WEBSITE', NULL, 'https://www.smartttc.com', 'Company', '', '2023-01-25 07:14:02'),
('CREDIT_LIMIT', 'จำกัดวงเงินเครดิตหรือไม่', '1', 'Order', '', '2022-08-17 05:09:47'),
('CUSTOMER_ORDER_LIMIT_SKU', 'กำหนดจำนวน SKU สูงสุดใน 1 ออเดอร์ เกินกว่านี้ให้แยกออเดอร์\n(เฉพาะ Bp)', '5', 'Order', '', '2023-01-17 13:56:37'),
('DEFAULT_CURRENCY', '', 'THB', 'Company', '', '2019-08-31 11:49:52'),
('DEFAULT_WAREHOUSE', '', 'L4-G', 'Company', '', '2022-07-08 16:57:21'),
('GET_STOCK_ON_CUSTOMER_ORDER', 'ดึงสต็อกในหน้า Customer Order', '1', 'Order', '', '2022-09-27 08:06:45'),
('ITEM_TAX_TYPE', NULL, 'I', NULL, 'I = Include\r\nE = Exclude', '2022-07-03 07:18:17'),
('LOGS_JSON', NULL, '1', 'System', '', '2023-04-22 06:55:07'),
('PREFIX_RETURN', NULL, 'RT', 'Document', '', '2023-01-25 07:16:31'),
('PREFIX_TRANSFER', NULL, 'TR', 'Document', '', '2023-01-25 07:16:31'),
('RETURN_CHECKBOX', 'อนุญาติให้ติ๊ก checkbox เพื่อคืนสินค้าได้\r\n1 = อนุญาติ\r\n0 = ไม่อนุญาติ', '1', 'System', '', '2023-04-05 06:28:59'),
('RUN_DIGIT_RETURN', 'จำนวนหลัก', '4', 'Document', '', '2023-02-10 03:54:13'),
('RUN_DIGIT_TRANSFER', 'จำนวนหลัก', '6', 'Document', '', '2023-02-10 03:54:13'),
('SALE_VAT_CODE', NULL, 'S07', 'Company', '', '2022-07-06 06:21:53'),
('SALE_VAT_RATE', NULL, '7.00', 'Company', '', '2022-07-06 06:21:53'),
('SAP_API_HOST', '', 'http://stto-gctjkgtvbz.dynamic-m.com:83/sap/api/', 'System', '', '2023-04-22 06:54:45'),
('SCANTYPE', 'Scanner support format \r\nqrcode = QR Code\r\nbarcode = EAN13, Code39, Code93, Code128\r\nboth = qrcode and barcode support but performance drop', 'barcode', 'System', '', '2023-05-25 08:51:33'),
('SCS_PWD', NULL, 'CSPY', 'System', '', '2023-05-08 14:04:12'),
('SCS_TOKEN', 'SCS token ได้มาหลังจาก login', '1568947154_46262302_Tfbi6N7sx8', 'System', '', '2023-05-09 13:54:08'),
('SCS_URL', NULL, 'https://peacos.pea.co.th/services_v1/', 'System', '', '2023-05-08 14:05:06'),
('SCS_USER', NULL, '46262302', 'System', '', '2023-05-08 14:04:12'),
('START_YEAR', 'ปีที่เริ่มกิจการ', '2021', 'Company', 'ปีเริ่มต้นกิจการ', '2021-11-24 05:25:17'),
('TEST_MODE', NULL, '0', NULL, '', '2023-04-22 06:55:13'),
('USER_PASSWORD_AGE', NULL, '0', 'System', '', '2023-03-10 04:37:58'),
('USE_STRONG_PWD', NULL, '0', 'System', '', '2023-05-25 08:24:34');

-- --------------------------------------------------------

--
-- Table structure for table `config_group`
--

CREATE TABLE `config_group` (
  `code` varchar(20) CHARACTER SET utf8 NOT NULL,
  `name` varchar(254) CHARACTER SET utf8 NOT NULL,
  `position` tinyint(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config_group`
--

INSERT INTO `config_group` (`code`, `name`, `position`) VALUES
('Company', 'ข้อมูลบริษัท', 2),
('Document', 'เอกสาร', 3),
('General', 'ทั่วไป', 1),
('Inventory', 'คลัง', 5),
('Order', 'ออเดอร์', 4),
('System', 'ระบบ', 6);

-- --------------------------------------------------------

--
-- Table structure for table `damage_list`
--

CREATE TABLE `damage_list` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `damage_list`
--

INSERT INTO `damage_list` (`id`, `name`, `status`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(2, 'หน้าปัดแตกร้าว', 1, '2023-04-14 23:17:11', -1, NULL, NULL),
(3, 'สนิมกิน', 1, '2023-04-14 23:17:22', -1, NULL, NULL),
(4, 'น้ำเข้าด้านใน', 1, '2023-04-14 23:17:33', -1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `demo_item`
--

CREATE TABLE `demo_item` (
  `Serial` varchar(50) NOT NULL,
  `ItemCode` varchar(50) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `WhsCode` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `demo_item`
--

INSERT INTO `demo_item` (`Serial`, `ItemCode`, `ItemName`, `WhsCode`) VALUES
('2010281432-00001', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00002', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00003', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00004', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00005', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00006', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00007', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00008', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00009', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00010', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00011', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00012', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00013', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00014', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00015', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00016', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00017', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00018', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00019', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00020', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00021', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00022', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00023', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00024', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00025', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00026', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00027', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00028', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00029', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00030', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00031', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00032', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00033', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00034', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00035', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00036', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00037', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00038', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00039', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG'),
('2010281432-00040', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG');

-- --------------------------------------------------------

--
-- Table structure for table `dispose_reason`
--

CREATE TABLE `dispose_reason` (
  `pk_id` int(5) NOT NULL,
  `reason_id` varchar(5) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `is_break_down` tinyint(1) NOT NULL DEFAULT '1',
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dispose_reason`
--

INSERT INTO `dispose_reason` (`pk_id`, `reason_id`, `title`, `description`, `is_break_down`, `date_upd`) VALUES
(0, '0', 'สภาพปกติ', 'มิเตอร์ยังสามารถใช้งานได้ดี', 0, '2023-05-05 13:05:06'),
(1, '01', 'ที่ต่อสายไหม้', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(2, '02', 'ซีซีไหม้', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(3, '03', 'หมุนติดขัด', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(4, '04', 'หมุนถอยหลัง', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(5, '05', 'หมุนขณะไม่มีโหลด', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(6, '06', 'ไม่หมุนขณะมีโหลด', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(7, '07', 'ไหม้ทั้งเครื่อง', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(8, '08', 'พีซีขาด', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(9, '09', 'มดเข้า', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(10, '10', 'น้ำเข้า', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(11, '11', 'ฝาครอบแตก', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(12, '13', 'ปัญหาจากสกรู', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(13, '14', 'ยางฝาครอบชำรุด', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(14, '15', 'ขอบฝาครอบชำรุด', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(15, '16', 'ตราข้างขาด', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(16, '17', 'ละเมิดสิทธิ์ (ชำรุด)', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(17, '18', 'เพลิงไหม้', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(18, '20', 'เกิดอ๊อกไซด์ภายในมิเตอร์', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(19, '21', 'เฟสชำรุด', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(20, '22', 'ไฟรั่วลงมิเตอร์', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(21, '38', 'ชำรุดไม่ทราบสาเหตุ', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(22, '39', 'ชำรุดสาเหตุอื่น ๆ', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(23, 'H0', 'ค้างชำระค่าไฟ', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(24, 'I0', 'เพิ่มขนาด', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(25, 'J0', 'ลดขนาด', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(26, 'J3', 'เปลี่ยนประเภทการใช้ไฟ', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(27, 'J5', 'เปลี่ยนประเภทมิเตอร์', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(28, 'J6', 'เปลี่ยนมิเตอร์ AMR', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(29, 'K0', 'เลิกใช้ไฟ', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(30, 'L0', 'ตัดฝาก', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(31, 'M0', 'ย้ายสถานที่ใช้ไฟฟ้า', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(32, 'N0', 'สูญหาย', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(33, 'O0', 'บ้านรื้อถอน', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(34, 'P0', 'ติด Nameplate ผิด', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(35, 'P5', 'มิเตอร์เปรียบเทียบ', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(36, 'Q0', 'อื่น ๆ', 'ชำรุด', 1, '2023-05-05 13:05:06'),
(37, 'R0', 'ข้อมูลผิด', 'ชำรุด', 1, '2023-05-05 13:05:06');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `date_add` date NOT NULL,
  `code` varchar(20) NOT NULL,
  `ItemCode` varchar(50) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `InstallSerialNum` varchar(36) NOT NULL,
  `ReturnnedSerialNum` varchar(36) NOT NULL,
  `Qty` int(11) NOT NULL DEFAULT '1',
  `fromWhsCode` varchar(8) NOT NULL,
  `toWhsCode` varchar(8) NOT NULL,
  `install_image` text NOT NULL COMMENT 'image path',
  `returnned_image` text NOT NULL COMMENT 'image path',
  `sign_image` text COMMENT 'ภาพลายเซ็น',
  `installPeaNo` varchar(50) DEFAULT NULL,
  `peaNo` varchar(20) DEFAULT NULL COMMENT 'เลขที่มิเตอร์ของ PEA',
  `powerNo` varchar(10) DEFAULT NULL COMMENT 'หน่วยไฟที่ใช้ไป',
  `mYear` year(4) DEFAULT NULL COMMENT 'ปีของมิเตอร์',
  `reason_id` varchar(5) NOT NULL DEFAULT '0' COMMENT 'สภาพมิเตอร์ ดู table dispose_reason',
  `reson_title` varchar(100) DEFAULT NULL,
  `usageAge` int(2) NOT NULL DEFAULT '0' COMMENT 'อายุของมิเตอร์ (ใช้งานมาแล้วกี่ปี โดยใช้ปีที่อยู่บนมิเตอร์เป็นตัวระบุ',
  `approver` varchar(50) DEFAULT NULL,
  `docEntry` int(11) DEFAULT NULL,
  `docNum` varchar(20) DEFAULT NULL,
  `remark` varchar(254) DEFAULT NULL,
  `message` text,
  `team_id` int(11) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) NOT NULL,
  `fromDoc` varchar(20) DEFAULT NULL COMMENT 'สินค้าจากเอกสารโอนเลขที่',
  `status` set('P','I','A','R','W','S','U') NOT NULL DEFAULT 'P' COMMENT 'P = Pending, \r\nI = Installed,\r\n A = Sttc Approve, \r\nR = Sttc Rejected, \r\nW = Sent to Pea, \r\nS = PEA Accept, \r\nU = PEA Rejected'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `keys`
--

CREATE TABLE `keys` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `key` varchar(40) CHARACTER SET utf8 NOT NULL,
  `level` int(2) NOT NULL,
  `ignore_limits` tinyint(1) NOT NULL DEFAULT '0',
  `is_private_key` tinyint(1) NOT NULL DEFAULT '0',
  `ip_addresses` text CHARACTER SET utf8,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `keys`
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, '513bcfa2b82dc1735a07b97b7f870106', 1, 0, 0, NULL, 1549696881);

-- --------------------------------------------------------

--
-- Table structure for table `logs_scs`
--

CREATE TABLE `logs_scs` (
  `id` int(11) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs_scs`
--

INSERT INTO `logs_scs` (`id`, `code`, `status`, `date_upd`) VALUES
(1, 'init', 'success', '2023-05-05 13:05:06'),
(2, 'init', 'success', '2023-05-06 09:41:59'),
(3, 'init', 'success', '2023-05-10 03:35:07'),
(4, 'init', 'success', '2023-05-19 05:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `logs_transfer`
--

CREATE TABLE `logs_transfer` (
  `id` int(11) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `json` mediumint(9) DEFAULT NULL,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs_transfer`
--

INSERT INTO `logs_transfer` (`id`, `code`, `status`, `json`, `date_upd`) VALUES
(1, 'TR-2304000008', 'error', 0, '2023-04-22 07:00:11'),
(2, 'TR-2304000008', 'error', 0, '2023-04-22 07:03:10'),
(3, 'TR-2304000008', 'error', 0, '2023-04-22 07:03:45'),
(4, 'TR-2304000008', 'error', 0, '2023-04-22 07:04:06'),
(5, 'TR-2304000008', 'error', 0, '2023-04-22 07:05:25'),
(6, 'TR-2304000008', 'error', 0, '2023-04-22 07:06:53'),
(7, 'TR-2304000007', 'error', 0, '2023-04-22 07:07:23'),
(8, 'TR-2304000006', 'error', 0, '2023-04-22 07:09:17'),
(9, 'TR-2304000005', 'error', 0, '2023-04-22 07:09:38'),
(10, 'RT-23040001', 'error', 0, '2023-04-22 07:16:34'),
(11, 'RT-23040001', 'error', 0, '2023-04-22 07:33:04'),
(12, 'RT-23040001', 'error', 0, '2023-04-22 07:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `code` varchar(10) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `url` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `group_code` varchar(10) CHARACTER SET utf8 NOT NULL,
  `sub_group` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(3) NOT NULL DEFAULT '1',
  `valid` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = check permission'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`code`, `name`, `url`, `group_code`, `sub_group`, `active`, `position`, `valid`) VALUES
('HOME', 'Welcome', 'main', '', NULL, 1, 1, 0),
('OPUITM', 'รายการมิเตอร์', 'inventory/user_item', 'OP', NULL, 1, 4, 1),
('OPWHRT', 'คืนมิเตอร์', 'inventory/return_product', 'OP', NULL, 1, 2, 1),
('OPWHTR', 'การติดตั้ง', 'inventory/transfer', 'OP', NULL, 1, 1, 1),
('OPWOLS', 'ใบสั่งงาน', 'inventory/work_list', 'OP', NULL, 1, 3, 1),
('SCCONF', 'กำหนดค่า', 'admin/setting', 'SC', NULL, 1, 5, 1),
('SCDAMG', 'สภาพมิเตอร์', 'admin/meter_cond', 'SC', NULL, 1, 3, 1),
('SCGROUP', 'ทีมติดตั้ง', 'admin/group', 'SC', NULL, 1, 3, 1),
('SCOWHS', 'คลังสินค้า', 'admin/warehouse', 'SC', NULL, 1, 4, 1),
('SCPERM', 'กำหนดสิทธิ์', NULL, 'SC', NULL, 1, 6, 1),
('SCTEAM', 'เขต/พิ้นที่', 'admin/team', 'SC', NULL, 1, 3, 1),
('SCUSER', 'ผู้ใช้งาน', 'users/users', 'SC', NULL, 1, 2, 1),
('SCWOPL', 'Work Plan', 'admin/work_plan', 'SC', NULL, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE `menu_group` (
  `code` varchar(10) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `position` int(5) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `type` enum('side','top') CHARACTER SET utf8 NOT NULL DEFAULT 'side',
  `icon` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`code`, `name`, `position`, `active`, `type`, `icon`, `is_admin`) VALUES
('OP', 'Operation', 8, 1, 'side', 'fa-tasks', 0),
('SC', 'Administrator', 5, 1, 'side', 'fa-cogs', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menu_sub_group`
--

CREATE TABLE `menu_sub_group` (
  `code` varchar(20) CHARACTER SET utf8 NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `group_code` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `position` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pea_data`
--

CREATE TABLE `pea_data` (
  `id` int(11) NOT NULL,
  `pea_no` varchar(20) NOT NULL,
  `amp` int(2) DEFAULT NULL,
  `latitude` decimal(12,6) DEFAULT NULL,
  `longitude` decimal(12,6) DEFAULT NULL,
  `valid` tinyint(1) DEFAULT '0',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pea_data`
--

INSERT INTO `pea_data` (`id`, `pea_no`, `amp`, `latitude`, `longitude`, `valid`, `date_add`, `date_upd`) VALUES
(1, '123456', 5, '100.123456', '5.565444', 0, '2023-04-27 10:49:53', '2023-04-21 14:57:28'),
(2, '123457', 15, NULL, NULL, 0, '2023-04-27 10:49:53', '2023-04-21 14:57:28');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `user_id` int(8) NOT NULL,
  `menu` varchar(20) NOT NULL,
  `can_view` tinyint(1) NOT NULL DEFAULT '0',
  `can_add` tinyint(1) NOT NULL DEFAULT '0',
  `can_edit` tinyint(1) NOT NULL DEFAULT '0',
  `can_delete` tinyint(1) NOT NULL DEFAULT '0',
  `can_approve` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `user_id`, `menu`, `can_view`, `can_add`, `can_edit`, `can_delete`, `can_approve`) VALUES
(153, 16, 'SCWOPL', 1, 1, 1, 1, 1),
(154, 16, 'SCUSER', 1, 1, 1, 1, 1),
(155, 16, 'SCDAMG', 1, 1, 1, 1, 1),
(156, 16, 'SCTEAM', 1, 1, 1, 1, 1),
(157, 16, 'SCGROUP', 1, 1, 1, 1, 1),
(158, 16, 'SCOWHS', 1, 1, 1, 1, 1),
(159, 16, 'SCCONF', 1, 1, 1, 1, 1),
(160, 16, 'SCPERM', 1, 1, 1, 1, 1),
(161, 16, 'OPWHTR', 1, 1, 1, 1, 1),
(162, 16, 'OPWHRT', 1, 1, 1, 1, 1),
(163, 16, 'OPWOLS', 1, 1, 1, 1, 1),
(164, 16, 'OPUITM', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `return_product`
--

CREATE TABLE `return_product` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `date_add` date DEFAULT NULL,
  `whsCode` varchar(8) NOT NULL,
  `toWhsCode` varchar(8) DEFAULT NULL COMMENT 'กำหนดทีหลังว่าจะให้เข้าคลังไหน',
  `status` tinyint(1) NOT NULL DEFAULT '-1' COMMENT '-1 = draft\r\n0 = pending \r\n1 = received\r\n2 = cancel',
  `is_receive` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'หลังบ้านรับแล้วหรือยัง',
  `receive_at` datetime DEFAULT NULL,
  `receive_by` varchar(50) DEFAULT NULL,
  `is_approve` tinyint(1) NOT NULL DEFAULT '0',
  `approve_at` datetime DEFAULT NULL,
  `approve_by` int(11) DEFAULT NULL,
  `remark` varchar(254) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL,
  `DocEntry` int(11) DEFAULT NULL,
  `DocNum` varchar(15) DEFAULT NULL,
  `Message` text,
  `is_cancle` tinyint(1) NOT NULL DEFAULT '0',
  `cancle_at` datetime DEFAULT NULL,
  `cancle_by` int(11) DEFAULT NULL,
  `cancle_remark` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_product`
--

INSERT INTO `return_product` (`id`, `code`, `date_add`, `whsCode`, `toWhsCode`, `status`, `is_receive`, `receive_at`, `receive_by`, `is_approve`, `approve_at`, `approve_by`, `remark`, `create_at`, `create_by`, `update_at`, `update_by`, `team_id`, `DocEntry`, `DocNum`, `Message`, `is_cancle`, `cancle_at`, `cancle_by`, `cancle_remark`) VALUES
(1, 'RT-23030001', '2023-03-21', '2-PD', NULL, 2, 0, NULL, NULL, 0, NULL, NULL, 'ทดสอบ', '2023-03-21 16:20:35', 14, '2023-04-07 21:39:26', 14, 1, NULL, NULL, NULL, 1, '2023-04-07 21:39:26', 14, NULL),
(2, 'RT-23030002', '2023-03-21', '2-PD', '2-FG', 1, 1, '2023-04-07 21:42:58', '16', 1, '2023-04-07 21:43:37', 16, NULL, '2023-03-21 16:57:00', 14, '2023-04-07 21:42:58', 16, 1, 1, '22000001', NULL, 0, NULL, NULL, NULL),
(3, 'RT-23030003', '2023-03-21', '2-PD', NULL, 2, 0, NULL, NULL, 0, NULL, NULL, 'Test', '2023-03-21 16:57:52', 14, '2023-04-07 21:38:54', 14, 1, NULL, NULL, NULL, 1, '2023-04-07 21:38:54', 14, NULL),
(4, 'RT-23030004', '2023-03-25', '2-PD', '2-FG', 2, 1, '2023-04-06 23:06:21', '16', 1, '2023-04-07 11:14:29', 16, NULL, '2023-03-25 20:56:46', 14, '2023-04-07 21:35:50', 14, 1, 1, '22000001', NULL, 1, '2023-04-07 21:35:50', 14, NULL),
(5, 'RT-23040001', '2023-04-07', '2-PD', '2-FG', 3, 1, '2023-04-22 14:16:23', '-1', 1, '2023-04-22 14:16:34', -1, NULL, '2023-04-07 22:02:02', 14, '2023-04-22 14:16:23', -1, 1, NULL, NULL, '1320000147 - Item FG-5-01102-1A with serial number 2010281432-00010 does not exist in warehouse', 0, NULL, NULL, NULL),
(6, 'RT-23040002', '2023-04-07', '2-PD', NULL, 2, 0, NULL, NULL, 0, NULL, NULL, NULL, '2023-04-07 22:43:03', 14, '2023-04-27 13:07:57', 14, 1, NULL, NULL, NULL, 1, '2023-05-13 22:12:56', -1, NULL),
(7, 'RT-23040003', '2023-04-27', '2-PD', NULL, -1, 0, NULL, NULL, 0, NULL, NULL, NULL, '2023-04-27 13:09:25', 14, NULL, NULL, 1, NULL, NULL, NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `return_product_detail`
--

CREATE TABLE `return_product_detail` (
  `id` int(11) NOT NULL,
  `return_id` int(11) NOT NULL,
  `return_code` varchar(20) NOT NULL,
  `ItemCode` varchar(50) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `WhsCode` varchar(8) NOT NULL,
  `toWhsCode` varchar(8) DEFAULT NULL,
  `Qty` int(11) NOT NULL DEFAULT '1',
  `valid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = not valid, \r\n1 = valid,\r\n2 = cancelled',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `fromDoc` varchar(20) DEFAULT NULL,
  `Serial` varchar(36) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `return_product_detail`
--

INSERT INTO `return_product_detail` (`id`, `return_id`, `return_code`, `ItemCode`, `ItemName`, `WhsCode`, `toWhsCode`, `Qty`, `valid`, `date_add`, `date_upd`, `fromDoc`, `Serial`, `user_id`) VALUES
(2, 1, 'RT-23030001', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', NULL, 1, 2, '2023-03-21 23:22:47', '2023-04-07 14:39:26', '2301001', '2010281432-00003', 14),
(3, 1, 'RT-23030001', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', NULL, 1, 2, '2023-03-21 23:26:06', '2023-04-07 14:39:26', '2301001', '2010281432-00004', 14),
(4, 4, 'RT-23030001', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', '2-FG', 1, 2, '2023-03-25 20:56:49', '2023-04-07 05:10:52', '2301001', '2010281432-00009', 14),
(5, 4, 'RT-23030001', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', '2-FG', 1, 2, '2023-03-25 20:57:19', '2023-04-07 05:10:52', '2301001', '2010281432-00010', 14),
(6, 4, 'RT-23030004', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', '2-FG', 1, 2, '2023-03-25 21:06:48', '2023-04-07 05:10:52', '2301001', '2010281432-00011', 14),
(7, 4, 'RT-23030004', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', '2-FG', 1, 2, '2023-03-25 21:07:06', '2023-04-07 05:10:52', '2301001', '2010281432-00012', 14),
(9, 3, 'RT-23030003', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', NULL, 1, 2, '2023-04-07 19:09:43', '2023-04-07 14:38:54', '2301001', '2010281432-00010', 14),
(10, 3, 'RT-23030003', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', NULL, 1, 2, '2023-04-07 19:15:16', '2023-04-07 14:38:54', '2301001', '2010281432-00011', 14),
(11, 3, 'RT-23030003', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', NULL, 1, 2, '2023-04-07 19:16:58', '2023-04-07 14:38:54', '2301001', '2010281432-00012', 14),
(12, 3, 'RT-23030003', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', NULL, 1, 2, '2023-04-07 19:17:50', '2023-04-07 14:38:54', '2301001', '2010281432-00013', 14),
(13, 2, 'RT-23030002', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', '2-FG', 1, 1, '2023-04-07 21:40:25', '2023-04-07 14:41:16', '2301001', '2010281432-00003', 14),
(14, 2, 'RT-23030002', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', '2-FG', 1, 1, '2023-04-07 21:40:37', '2023-04-07 14:41:16', '2301001', '2010281432-00004', 14),
(15, 2, 'RT-23030002', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', '2-FG', 1, 1, '2023-04-07 21:40:48', '2023-04-07 14:41:16', '2301001', '2010281432-00009', 14),
(16, 5, 'RT-23040001', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', '2-FG', 1, 1, '2023-04-07 22:37:51', '2023-04-22 07:10:39', '2301001', '2010281432-00010', 14),
(17, 5, 'RT-23040001', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', '2-FG', 1, 1, '2023-04-07 22:37:54', '2023-04-22 07:10:39', '2301001', '2010281432-00011', 14),
(18, 6, 'RT-23040001', 'FG-5-01102-1A', 'Watthour Meter 1P2W 220 V 15(45) A', '2-FG', NULL, 1, 2, '2023-04-07 22:46:17', '2023-05-13 15:12:56', '2301001', '2010281432-00012', 14);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `status`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'เขต 1', 1, '2023-01-24 12:28:46', -1, '2023-05-07 16:11:22', -1),
(3, 'เขต 2', 1, '2023-01-24 15:56:05', -1, '2023-05-07 16:11:29', -1),
(4, 'เขต 3', 1, '2023-05-07 16:11:41', -1, NULL, NULL),
(5, 'เขต 4', 1, '2023-05-07 16:11:48', -1, NULL, NULL),
(6, 'เขต 5', 1, '2023-05-07 16:11:54', -1, NULL, NULL),
(7, 'เขต 6', 1, '2023-05-07 16:12:01', -1, NULL, NULL),
(8, 'เขต 7', 1, '2023-05-07 16:12:06', -1, NULL, NULL),
(9, 'เขต 8', 1, '2023-05-07 16:12:12', -1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `team_group`
--

CREATE TABLE `team_group` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `fromWhsCode` varchar(8) DEFAULT NULL,
  `toWhsCode` varchar(8) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `team_group`
--

INSERT INTO `team_group` (`id`, `name`, `team_id`, `fromWhsCode`, `toWhsCode`, `status`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'เขต 1 ทีม 1', 1, '1-FG', '2-FG', 1, '2023-05-16 12:23:17', 16, '2023-05-22 10:14:43', 16),
(2, 'เขต 1 ทีม 2', 1, '1-FG', '2-FG', 1, '2023-05-16 14:05:35', 16, '2023-05-22 10:34:58', 16),
(3, 'เขต 1 ทีม 3', 1, '1-FG', '2-FG', 1, '2023-05-16 14:05:49', 16, '2023-05-22 10:37:22', 16),
(4, 'เขต 2 ทีม 1', 3, '1-DS', '2-GT', 1, '2023-05-16 14:06:01', 16, '2023-05-22 10:56:33', 16),
(6, 'เขต 2 ทีม 2', 3, '1-DS', '2-EX', 1, '2023-05-16 14:15:14', 16, '2023-05-22 10:56:50', 16),
(8, 'เขต 1 ทีม 4', 1, '1-FG', '2-FG', 1, '2023-05-20 13:07:09', 16, '2023-05-22 12:14:40', 16),
(9, 'เขต 2 ทีม 3', 3, '1-FG', '2-FG', 1, '2023-05-22 10:29:34', 16, NULL, NULL),
(10, 'เขต 4 ทีม 1', 5, '1-FG', '2-FG', 1, '2023-05-22 10:45:03', 16, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` int(11) NOT NULL,
  `date_add` date NOT NULL,
  `code` varchar(20) NOT NULL,
  `ItemCode` varchar(50) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `InstallSerialNum` varchar(36) NOT NULL,
  `ReturnnedSerialNum` varchar(36) NOT NULL,
  `Qty` int(11) NOT NULL DEFAULT '1',
  `fromWhsCode` varchar(8) NOT NULL,
  `toWhsCode` varchar(8) NOT NULL,
  `install_image` text NOT NULL COMMENT 'image path',
  `returnned_image` text NOT NULL COMMENT 'image path',
  `peaNo` varchar(20) DEFAULT NULL COMMENT 'เลขที่มิเตอร์ของ PEA',
  `powerNo` varchar(10) DEFAULT NULL COMMENT 'หน่วยไฟที่ใช้ไป',
  `mYear` year(4) DEFAULT NULL COMMENT 'ปีของมิเตอร์',
  `cond` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'สภาพมิเตอร์ 1 = ดี 2 = ชำรุด',
  `damage_id` int(11) DEFAULT NULL,
  `usageAge` int(2) NOT NULL DEFAULT '0' COMMENT 'อายุของมิเตอร์ (ใช้งานมาแล้วกี่ปี โดยใช้ปีที่อยู่บนมิเตอร์เป็นตัวระบุ',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = pending 1 = success 2 = cancel 3 = export failed',
  `isApprove` tinyint(1) NOT NULL DEFAULT '0',
  `approver` varchar(50) DEFAULT NULL,
  `docEntry` int(11) DEFAULT NULL,
  `docNum` varchar(20) DEFAULT NULL,
  `remark` varchar(254) DEFAULT NULL,
  `message` text,
  `team_id` int(11) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) NOT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) NOT NULL,
  `fromDoc` varchar(20) DEFAULT NULL COMMENT 'สินค้าจากเอกสารโอนเลขที่',
  `orientation` tinyint(1) DEFAULT NULL,
  `pea_verify` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL COMMENT 'User Name',
  `pwd` varchar(100) NOT NULL COMMENT 'Password',
  `name` varchar(100) NOT NULL COMMENT 'Display name',
  `uid` varchar(32) NOT NULL COMMENT 'Unique id',
  `ugroup` int(2) DEFAULT '3',
  `team_id` int(11) DEFAULT NULL,
  `team_group_id` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `last_pass_change` date DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `can_get_meter` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `pwd`, `name`, `uid`, `ugroup`, `team_id`, `team_group_id`, `active`, `last_pass_change`, `force_reset`, `create_at`, `create_by`, `update_at`, `update_by`, `can_get_meter`) VALUES
(-1, 'superadmin', '$2y$10$s.Ey6n.SIYRGq5wW.q/sJefuYVOU7pkbnA3X0XEN2ezKiTn11qk6u', 'คุณสุทัศ สังข์สวัสดิ์', '08570ca60a31013193c644d3acd4077c', -987654321, NULL, NULL, 1, '2024-12-31', 0, '2023-01-25 12:24:10', NULL, NULL, NULL, 0),
(14, 'out1', '$2y$10$1vU.RlR1ZCXjPwH/4MHBsuMHoaEKHyVlnrjcNAuKtZ3T0euyXt0uK', 'นาย สมหมาย เขต 1', '9bdab36abd4002a5ba799112841e27ee', 3, 1, 1, 1, '2023-05-25', 0, '2023-01-25 12:45:22', -1, '2023-05-22 12:41:49', -1, 0),
(15, 'out2', '$2y$10$gvZii13QpXOYtl7uDPPqA.jOy.tng.Dq3LODsvmTsDCqL554mNVf2', 'นาย สุทัศ เขต 2', '93c3bbeffba9f812b4f648566a44cbf6', 3, 3, NULL, 1, '2023-02-03', 0, '2023-01-25 12:48:06', -1, '2023-01-31 10:36:36', -1, 0),
(16, 'Admin', '$2y$10$TlCc/bCYEzfsW6Gd7r3iBOFPyHBr/K1vJT4FMwhQ188VQp7VaMt1u', 'Admin', 'e3afed0047b08059d0fada10f400c1e5', 1, NULL, NULL, 1, '2023-02-09', 0, '2023-01-25 13:33:05', -1, '2023-04-05 19:30:03', -1, 0),
(18, 'sutouch', '$2y$10$0gtdgwB2dXKu3JZuvNcO.ulqQ9MmTPV7you.ftL1PBDJgXZq8mZbi', 'sutouch', '0cad6856a7f548db702daa045c5c07da', 3, 1, NULL, 1, '2023-02-10', 0, '2023-01-27 12:26:51', -1, '2023-02-10 11:06:19', 16, 0),
(19, 'someone', '$2y$10$mtdXXfzQB5AWvji.jTIal.vJvNlZQcOuEzX6Ikt0LfBuarlEphaYG', 'someone', '1f2bf2e032a11fec0ea5d7f9d6a5aa1d', 2, NULL, NULL, 1, '2023-02-03', 0, '2023-01-27 12:28:07', -1, '2023-05-20 13:59:04', -1, 0),
(20, 'out3', '$2y$10$HSr2LpP9YpNiKMv5VQ8uHeA2Zv..OwXj5Ygw3iOBkcGvJ6P.lVO7K', 'out3', 'fb3694a7b2eb439fa9d395e659e4e301', 3, 1, NULL, 1, '2023-02-03', 0, '2023-01-29 16:15:33', -1, NULL, NULL, 0),
(21, 'test2', '$2y$10$BEoYvJME2dD9oHwvotIGOurrqb7eoD7WXY5mjfMNHDEPq2m3Eu3iG', 'test2', 'ad0234829205b9033196ba818f7a872b', 3, 3, NULL, 1, '2023-02-23', 0, '2023-02-23 22:25:36', -1, NULL, NULL, 0),
(22, 'sutus', '$2y$10$3.Lviuug7tC.oBTUeFJjNO/O.kldaj2yultv.0ZobPPn110HrcOSm', 'สุทัศ สังข์สวัสดิ์', 'fc1728ca7008198b9b5b1ded132ee58d', 3, 1, 2, 1, '2023-05-16', 0, '2023-05-16 20:24:45', 16, '2023-05-16 21:26:08', 16, 1),
(23, 'out5', '$2y$10$gH/HU6lCKkhjHLPr3L.OyOS2zS/X1b1sMZy3/bXnvodrW3KXj/XQ6', 'OUTSOURCE 5', 'cf1bd881868a926cc3a68924dfde5e35', 3, 5, 10, 1, '2023-05-22', 0, '2023-05-22 11:18:48', 16, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` (`id`, `name`) VALUES
(-987654321, 'Superadmin'),
(1, 'Admin'),
(2, 'Manager'),
(3, 'Outsource');

-- --------------------------------------------------------

--
-- Table structure for table `user_item`
--

CREATE TABLE `user_item` (
  `id` int(11) NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `team_group_id` int(11) DEFAULT NULL,
  `pea_no` varchar(20) DEFAULT NULL,
  `serial` varchar(36) NOT NULL,
  `ItemCode` varchar(50) NOT NULL,
  `ItemName` varchar(100) NOT NULL,
  `DocNum` varchar(20) NOT NULL,
  `WhsCode` varchar(8) NOT NULL,
  `status` set('P','I','A','R','W','S','U') NOT NULL DEFAULT 'P' COMMENT 'P = Pending, \r\nI = Installed, \r\nA = Sttc Approve,\r\nR = Sttc Rejected,\r\nW = Sent to Pea,\r\nS = PEA Accept,\r\nU = PEA Rejected',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_upd` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_item`
--

INSERT INTO `user_item` (`id`, `team_id`, `team_group_id`, `pea_no`, `serial`, `ItemCode`, `ItemName`, `DocNum`, `WhsCode`, `status`, `date_add`, `date_upd`) VALUES
(41, 1, 1, '6500371000', '6500371000', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23040009', 'A-01', 'P', '2023-04-26 10:26:44', '2023-05-22 21:09:47'),
(42, 1, 1, '6500371001', '6500371001', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23040009', 'A-01', 'P', '2023-04-26 10:26:44', '2023-05-22 20:58:29'),
(43, 1, 1, '6500371002', '6500371002', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23040009', 'A-01', 'P', '2023-04-26 10:26:44', '2023-05-22 20:58:29'),
(44, 1, 1, '6500371003', '6500371003', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23040009', 'A-01', 'P', '2023-04-26 10:26:44', '2023-05-22 20:58:29'),
(45, 1, 1, '6500371004', '6500371004', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23040009', 'A-01', 'P', '2023-04-26 10:26:44', '2023-05-22 20:58:29'),
(47, 1, 1, '6500371006', '6500371006', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23040009', 'A-01', 'P', '2023-04-26 10:26:44', '2023-05-22 20:58:29'),
(48, 1, 1, '6500371007', '6500371007', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23040009', 'A-01', 'P', '2023-04-26 10:26:44', '2023-05-22 20:58:29'),
(52, 1, 1, '6500371005', '6500371005', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23040009', 'A-01', 'P', '2023-05-01 14:08:18', '2023-05-22 20:58:29'),
(216, 1, 1, '6500371031', '6500371031', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 21:22:37'),
(217, 1, 1, '6500371032', '6500371032', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(218, 1, 1, '6500371033', '6500371033', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(219, 1, 1, '6500371034', '6500371034', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(220, 1, 1, '6500371035', '6500371035', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(221, 1, 1, '6500371036', '6500371036', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(222, 1, 1, '6500371037', '6500371037', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(223, 1, 1, '6500371038', '6500371038', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(224, 1, 1, '6500371039', '6500371039', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(225, 1, 1, '6500371040', '6500371040', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(226, 1, 1, '6500371041', '6500371041', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(227, 1, 1, '6500371042', '6500371042', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(228, 1, 1, '6500371043', '6500371043', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(229, 1, 1, '6500371044', '6500371044', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(230, 1, 1, '6500371045', '6500371045', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(231, 1, 1, '6500371046', '6500371046', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(232, 1, 1, '6500371047', '6500371047', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(233, 1, 1, '6500371048', '6500371048', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(234, 1, 1, '6500371049', '6500371049', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(235, 1, 1, '6500371050', '6500371050', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(236, 1, 1, '6500371051', '6500371051', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(237, 1, 1, '6500371052', '6500371052', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(238, 1, 1, '6500371053', '6500371053', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(239, 1, 1, '6500371054', '6500371054', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(240, 1, 1, '6500371055', '6500371055', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(241, 1, 1, '6500371056', '6500371056', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(242, 1, 1, '6500371057', '6500371057', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(243, 1, 1, '6500371058', '6500371058', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(244, 1, 1, '6500371059', '6500371059', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(245, 1, 1, '6500371060', '6500371060', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(246, 1, 1, '6500371061', '6500371061', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(247, 1, 1, '6500371062', '6500371062', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(248, 1, 1, '6500371063', '6500371063', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(249, 1, 1, '6500371064', '6500371064', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(250, 1, 1, '6500371065', '6500371065', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(251, 1, 1, '6500371066', '6500371066', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(252, 1, 1, '6500371067', '6500371067', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(253, 1, 1, '6500371068', '6500371068', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(254, 1, 1, '6500371069', '6500371069', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29'),
(255, 1, 1, '6500371070', '6500371070', 'FG-5-01101', 'Watthour Meter 1P2W 220 V 5(15) A, Type DD862', '23050001', 'A-01', 'P', '2023-05-13 14:00:26', '2023-05-22 20:58:29');

-- --------------------------------------------------------

--
-- Table structure for table `user_team`
--

CREATE TABLE `user_team` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `team_role` set('Lead','Sales') NOT NULL DEFAULT 'Sales'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_team`
--

INSERT INTO `user_team` (`id`, `user_id`, `team_id`, `team_role`) VALUES
(8, 19, 1, 'Lead'),
(9, 19, 3, 'Lead');

-- --------------------------------------------------------

--
-- Table structure for table `user_warehouse`
--

CREATE TABLE `user_warehouse` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `warehouse_code` varchar(8) NOT NULL,
  `type` set('from','to') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_warehouse`
--

INSERT INTO `user_warehouse` (`id`, `user_id`, `warehouse_code`, `type`) VALUES
(15, 20, '1-FG', 'from'),
(16, 20, '2-SP', 'to'),
(17, 15, '1-FG', 'from'),
(18, 15, '2-FG', 'from'),
(19, 15, '2-RP', 'to'),
(20, 15, '2-SM', 'to'),
(28, 18, '2-FG', 'from'),
(29, 18, '2-FG', 'to'),
(33, 14, '2-PD', 'from'),
(34, 14, '2-FG', 'to');

-- --------------------------------------------------------

--
-- Table structure for table `violate`
--

CREATE TABLE `violate` (
  `id` int(11) NOT NULL,
  `pea_no` varchar(20) NOT NULL,
  `latitude` decimal(10,6) DEFAULT NULL,
  `longitude` decimal(10,6) DEFAULT NULL,
  `case_id` int(11) NOT NULL COMMENT 'ชนิดการละเมิด',
  `description` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = pending,\r\n1 = closed,\r\n2 = cancle',
  `create_by` int(11) DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `voilate_images`
--

CREATE TABLE `voilate_images` (
  `id` int(11) NOT NULL,
  `peaNo` varchar(20) NOT NULL,
  `imageName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `code` varchar(8) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `listed` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `last_sync` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `code`, `name`, `listed`, `status`, `create_at`, `update_at`, `last_sync`) VALUES
(1, '1-DS', 'คลัง Drop ship', 0, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(2, '1-EX', '1-EX-SYSTEM-BIN-LOCATION', 0, 0, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(3, '1-FG', 'คลังสินค้าสำเร็จรูป', 1, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(4, '1-RC', 'คลัง RM Smart Meter และ Part ที่ต้องควบคุมอุณหภูมิ', 0, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(5, '1-RT', 'คลังรอคืน/เคลมผู้ขาย', 0, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(6, '1-SL', 'คลังยืม', 0, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(7, '2-EX', 'คลังสินค้าตัวอย่าง', 0, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(8, '2-FG', 'คลังสินค้าสำเร็จรูป', 1, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(9, '2-GT', 'คลังประกันคุณภาพ', 0, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(10, '2-PD', 'คลังผลิต', 1, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(11, '2-QC', 'คลัง QC ตรวจสอบ', 0, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(12, '2-RC', 'คลัง RM Smart Meter และ Part ที่ต้องควบคุมอุณหภูมิ', 0, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(13, '2-RP', 'คลังซ่อม', 1, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(14, '2-RT', 'คลังรอคืน/เคลมผู้ขาย', 0, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(15, '2-RU', 'คลัง RM Mechanical และ Part ไม่ต้องควบคุมอุณหภูมิ รวมทั้ง PK,FS', 0, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(16, '2-SC', 'คลังสินค้ารอทำลาย', 0, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(17, '2-SL', 'คลังยืม', 0, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(18, '2-SM', 'คลัง Semi', 1, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19'),
(19, '2-SP', 'คลัง Spare Part', 1, 1, '2023-01-27 10:17:42', '2023-05-19 12:53:19', '2023-05-19 12:53:19');

-- --------------------------------------------------------

--
-- Table structure for table `work_list`
--

CREATE TABLE `work_list` (
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
  `CreatedDate` date DEFAULT NULL,
  `remark` varchar(100) DEFAULT NULL,
  `batch_id` varchar(32) DEFAULT NULL,
  `date_add` datetime DEFAULT CURRENT_TIMESTAMP,
  `date_upd` datetime DEFAULT CURRENT_TIMESTAMP,
  `team_id` int(11) DEFAULT NULL,
  `team_group_id` int(11) DEFAULT NULL,
  `is_loaded` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'โหลดงานไปแล้วหรือไม่',
  `status` set('P','I','A','R','W','S','U') NOT NULL DEFAULT 'P' COMMENT 'P = Pending,\r\nI = Installed,\r\nA = Sttc Approve \r\nR = Sttc Rejected\r\nW = Sent to Pea\r\nS = PEA Accept\r\nU = PEA Rejected\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_list`
--

INSERT INTO `work_list` (`id`, `cust_no`, `pea_no`, `pea_no_full`, `mat_code_full`, `ca_no`, `cust_name`, `cust_address`, `cust_tel`, `cust_route`, `age_meter`, `Plan_TableName`, `CreatedDate`, `remark`, `batch_id`, `date_add`, `date_upd`, `team_id`, `team_group_id`, `is_loaded`, `status`) VALUES
(1, 'ไม่พบข้อมู', '15999643', '000000000015999643', '000000001060050001', '020006797233', 'นายสมบัติ ยิ้มแย้ม', '57/1 ม.7 ต.สรรพยา อ.สรรพยา', NULL, 'CSPY0001', 21, 'PLAN_C_2565_10_31_0959', '2022-11-08', NULL, '64574b41a7d8a', '2023-05-07 13:52:31', '2023-05-07 13:54:57', 1, NULL, 0, 'P'),
(2, '006603', '16187476', '000000000016187476', '000000001060050001', '020006804895', 'นายสำรวย วิมานทอง', '105/1 ม.7 ต.สรรพยา อ.สรรพยา', NULL, 'CSPY0001', 20, 'PLAN_C_2565_10_31_0959', '2022-11-08', NULL, '64574b41a7d8a', '2023-05-07 13:52:31', '2023-05-07 13:54:57', 1, NULL, 0, 'P'),
(3, '006603', '16187477', '000000000016187477', '106001', '200068048961', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, 1, 0, 'I'),
(4, '006604', '16187478', '000000000016187478', '106002', '200068048962', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(5, '006605', '16187479', '000000000016187479', '106003', '200068048963', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(6, '006606', '16187480', '000000000016187480', '106004', '200068048964', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(7, '006607', '16187481', '000000000016187481', '106005', '200068048965', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 1, 3, 0, 'P'),
(8, '006608', '16187482', '000000000016187482', '106006', '200068048966', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 1, 3, 0, 'P'),
(9, '006609', '16187483', '000000000016187483', '106007', '200068048967', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 1, 3, 0, 'P'),
(10, '006610', '16187484', '000000000016187484', '106008', '200068048968', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 2, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 1, 1, 0, 'P'),
(11, '006611', '16187485', '000000000016187485', '106009', '200068048969', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 1, 1, 0, 'P'),
(12, '006612', '16187486', '000000000016187486', '106010', '2000680489610', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 1, 1, 0, 'P'),
(13, '006613', '16187487', '000000000016187487', '106011', '2000680489611', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0001', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 1, NULL, 0, 'P'),
(14, '006614', '16187488', '000000000016187488', '106012', '2000680489612', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, 6, 0, 'P'),
(15, '006615', '16187489', '000000000016187489', '106013', '2000680489613', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, 6, 0, 'P'),
(16, '006616', '16187490', '000000000016187490', '106014', '2000680489614', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, 6, 0, 'P'),
(17, '006617', '16187491', '000000000016187491', '106015', '2000680489615', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(18, '006618', '16187492', '000000000016187492', '106016', '2000680489616', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(19, '006619', '16187493', '000000000016187493', '106017', '2000680489617', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(20, '006620', '16187494', '000000000016187494', '106018', '2000680489618', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(21, '006621', '16187495', '000000000016187495', '106019', '2000680489619', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(22, '006622', '16187496', '000000000016187496', '106020', '2000680489620', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(23, '006623', '16187497', '000000000016187497', '106021', '2000680489621', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(24, '006624', '16187498', '000000000016187498', '106022', '2000680489622', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(25, '006625', '16187499', '000000000016187499', '106023', '2000680489623', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(26, '006626', '16187500', '000000000016187500', '106024', '2000680489624', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(27, '006627', '16187501', '000000000016187501', '106025', '2000680489625', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(28, '006628', '16187502', '000000000016187502', '106026', '2000680489626', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(29, '006629', '16187503', '000000000016187503', '106027', '2000680489627', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(30, '006630', '16187504', '000000000016187504', '106028', '2000680489628', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(31, '006631', '16187505', '000000000016187505', '106029', '2000680489629', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0002', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 3, NULL, 0, 'P'),
(32, '006632', '16187506', '000000000016187506', '106030', '2000680489630', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0003', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 4, NULL, 0, 'P'),
(33, '006633', '16187507', '000000000016187507', '106031', '2000680489631', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0003', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 4, NULL, 0, 'P'),
(34, '006634', '16187508', '000000000016187508', '106032', '2000680489632', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0003', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 4, NULL, 0, 'P'),
(35, '006635', '16187509', '000000000016187509', '106033', '2000680489633', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0003', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 4, NULL, 0, 'P'),
(36, '006636', '16187510', '000000000016187510', '106034', '2000680489634', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0003', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 4, NULL, 0, 'P'),
(37, '006637', '16187511', '000000000016187511', '106035', '2000680489635', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0003', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 4, NULL, 0, 'P'),
(38, '006638', '16187512', '000000000016187512', '106036', '2000680489636', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0003', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 4, NULL, 0, 'P'),
(39, '006639', '16187513', '000000000016187513', '106037', '2000680489637', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0003', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 4, NULL, 0, 'P'),
(40, '006640', '16187514', '000000000016187514', '106038', '2000680489638', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0003', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 4, NULL, 0, 'P'),
(41, '006641', '16187515', '000000000016187515', '106039', '2000680489639', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0003', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 4, NULL, 0, 'P'),
(42, '006642', '16187516', '000000000016187516', '106040', '2000680489640', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0003', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 4, NULL, 0, 'P'),
(43, '006643', '16187517', '000000000016187517', '106041', '2000680489641', 'นายทดสอบ', '123/456 ทดสอบ', NULL, 'CSPY0003', 12, 'PLAN_C_2565_10_31_0959', '2022-11-30', NULL, '123456', '2023-05-10 14:03:37', '2023-05-10 14:03:37', 4, NULL, 0, 'P');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`code`),
  ADD KEY `group_code` (`group_code`);

--
-- Indexes for table `config_group`
--
ALTER TABLE `config_group`
  ADD PRIMARY KEY (`code`),
  ADD KEY `position` (`position`);

--
-- Indexes for table `damage_list`
--
ALTER TABLE `damage_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `demo_item`
--
ALTER TABLE `demo_item`
  ADD PRIMARY KEY (`Serial`);

--
-- Indexes for table `dispose_reason`
--
ALTER TABLE `dispose_reason`
  ADD PRIMARY KEY (`pk_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date_add` (`date_add`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `docNum` (`docNum`),
  ADD KEY `docEntry` (`docEntry`),
  ADD KEY `approver` (`approver`),
  ADD KEY `cond` (`reason_id`),
  ADD KEY `mYear` (`mYear`),
  ADD KEY `powerNo` (`powerNo`),
  ADD KEY `peaNo` (`peaNo`),
  ADD KEY `usageAge` (`usageAge`),
  ADD KEY `damage_id` (`reson_title`),
  ADD KEY `installPeaNo` (`installPeaNo`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs_scs`
--
ALTER TABLE `logs_scs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs_transfer`
--
ALTER TABLE `logs_transfer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`code`),
  ADD KEY `groupCode` (`group_code`),
  ADD KEY `active` (`active`),
  ADD KEY `sub_group` (`sub_group`),
  ADD KEY `valid` (`valid`);

--
-- Indexes for table `menu_group`
--
ALTER TABLE `menu_group`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `position` (`position`),
  ADD KEY `isActive` (`active`),
  ADD KEY `type` (`type`),
  ADD KEY `is_admin` (`is_admin`);

--
-- Indexes for table `menu_sub_group`
--
ALTER TABLE `menu_sub_group`
  ADD PRIMARY KEY (`code`),
  ADD KEY `group_code` (`group_code`);

--
-- Indexes for table `pea_data`
--
ALTER TABLE `pea_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pea_no` (`pea_no`),
  ADD KEY `valid` (`valid`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `menu_code` (`menu`);

--
-- Indexes for table `return_product`
--
ALTER TABLE `return_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `status` (`status`),
  ADD KEY `isApprove` (`is_receive`),
  ADD KEY `date_add` (`date_add`),
  ADD KEY `toWhsCode` (`toWhsCode`),
  ADD KEY `DocNum` (`DocNum`),
  ADD KEY `is_approve` (`is_approve`);

--
-- Indexes for table `return_product_detail`
--
ALTER TABLE `return_product_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `return_id` (`return_id`),
  ADD KEY `return_code` (`return_code`),
  ADD KEY `ItemCode` (`ItemCode`),
  ADD KEY `fromDoc` (`fromDoc`),
  ADD KEY `Serial` (`Serial`),
  ADD KEY `toWhsCode` (`toWhsCode`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `team_group`
--
ALTER TABLE `team_group`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date_add` (`date_add`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `docNum` (`docNum`),
  ADD KEY `docEntry` (`docEntry`),
  ADD KEY `isApprove` (`isApprove`),
  ADD KEY `approver` (`approver`),
  ADD KEY `cond` (`cond`),
  ADD KEY `mYear` (`mYear`),
  ADD KEY `powerNo` (`powerNo`),
  ADD KEY `peaNo` (`peaNo`),
  ADD KEY `usageAge` (`usageAge`),
  ADD KEY `damage_id` (`damage_id`),
  ADD KEY `pea_verify` (`pea_verify`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uname` (`uname`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD KEY `active` (`active`),
  ADD KEY `fk_profile_id` (`ugroup`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `can_get_meter` (`can_get_meter`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_item`
--
ALTER TABLE `user_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `team_group_id` (`team_group_id`),
  ADD KEY `pea_no` (`pea_no`),
  ADD KEY `status_2` (`status`);

--
-- Indexes for table `user_team`
--
ALTER TABLE `user_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `team_role` (`team_role`);

--
-- Indexes for table `user_warehouse`
--
ALTER TABLE `user_warehouse`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `warehouse_code` (`warehouse_code`),
  ADD KEY `type` (`type`);

--
-- Indexes for table `violate`
--
ALTER TABLE `violate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pea_no` (`pea_no`),
  ADD KEY `case_id` (`case_id`);

--
-- Indexes for table `voilate_images`
--
ALTER TABLE `voilate_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peaNo` (`peaNo`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `status` (`status`),
  ADD KEY `last_sync` (`last_sync`),
  ADD KEY `listed` (`listed`);

--
-- Indexes for table `work_list`
--
ALTER TABLE `work_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pea_no` (`pea_no`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `user_id` (`team_group_id`),
  ADD KEY `is_loaded` (`is_loaded`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `damage_list`
--
ALTER TABLE `damage_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs_scs`
--
ALTER TABLE `logs_scs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logs_transfer`
--
ALTER TABLE `logs_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pea_data`
--
ALTER TABLE `pea_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT for table `return_product`
--
ALTER TABLE `return_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `return_product_detail`
--
ALTER TABLE `return_product_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `team_group`
--
ALTER TABLE `team_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_item`
--
ALTER TABLE `user_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;

--
-- AUTO_INCREMENT for table `user_team`
--
ALTER TABLE `user_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_warehouse`
--
ALTER TABLE `user_warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `violate`
--
ALTER TABLE `violate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voilate_images`
--
ALTER TABLE `voilate_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `work_list`
--
ALTER TABLE `work_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `config`
--
ALTER TABLE `config`
  ADD CONSTRAINT `fk_config_group` FOREIGN KEY (`group_code`) REFERENCES `config_group` (`code`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
