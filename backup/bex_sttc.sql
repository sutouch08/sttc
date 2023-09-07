-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2023 at 09:36 AM
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
('IMPORT_ROW_LIMIT', 'จำกัดจำนวนบรรทัดที่สามารถอัพโหลดได้ใน 1 ครั้ง', '1000', 'System', '', '2023-07-14 14:08:54'),
('ITEM_TAX_TYPE', NULL, 'I', NULL, 'I = Include\r\nE = Exclude', '2022-07-03 07:18:17'),
('LOGS_JSON', NULL, '1', 'System', '', '2023-04-22 06:55:07'),
('PACK_LIMIT_1_PHASE', 'จำกัดจำนวนที่สามารถแพ็คได้ต่อ 1 ลัง สำหรับมิเตอร์ 1 เฟส', '120', 'System', '', '2023-08-01 06:39:35'),
('PACK_LIMIT_3_PHASE', 'จำกัดจำนวนที่สามารถแพ็คได้ต่อ 1 ลัง สำหรับมิเตอร์ 3 เฟส', '50', 'System', '', '2023-08-01 05:46:55'),
('PEA_API', 'ส่งผลการติดตั้งไปที่ PEA', '1', NULL, ' 0 = off, 1= on', '2023-06-10 11:24:54'),
('PREFIX_PACK', NULL, 'PA', 'Document', '', '2023-07-24 05:37:03'),
('PREFIX_TRANSFER', NULL, 'TR', 'Document', '', '2023-01-25 07:16:31'),
('PRINT_SPLIT_ROWS', 'ซอยแบบฟอร์มพิมพ์มิเตอร์ 3 เฟส', '4', 'System', '', '2023-08-01 09:45:13'),
('RETURN_CHECKBOX', 'อนุญาติให้ติ๊ก checkbox เพื่อคืนสินค้าได้\r\n1 = อนุญาติ\r\n0 = ไม่อนุญาติ', '1', 'System', '', '2023-04-05 06:28:59'),
('RUN_DIGIT_PACK', 'จำนวนหลัก', '4', 'Document', '', '2023-07-24 05:37:20'),
('RUN_DIGIT_TRANSFER', 'จำนวนหลัก', '4', 'Document', '', '2023-07-20 06:46:52'),
('SALE_VAT_CODE', NULL, 'S07', 'Company', '', '2022-07-06 06:21:53'),
('SALE_VAT_RATE', NULL, '7.00', 'Company', '', '2022-07-06 06:21:53'),
('SAP_API_HOST', '', 'http://stto-gctjkgtvbz.dynamic-m.com:83/sap/api/', 'System', '', '2023-04-22 06:54:45'),
('SCANTYPE', 'Scanner support format \r\nqrcode = QR Code\r\nbarcode = EAN13, Code39, Code93, Code128\r\nboth = qrcode and barcode support but performance drop', 'barcode', 'System', '', '2023-05-30 06:48:59'),
('SCS_PWD', NULL, 'CSPY', 'System', '', '2023-05-08 14:04:12'),
('SCS_TOKEN', 'SCS token ได้มาหลังจาก login', '1568947154_46262302_Tfbi6N7sx8', 'System', '', '2023-05-09 13:54:08'),
('SCS_URL', NULL, 'https://peacos.pea.co.th/services_v1/', 'System', '', '2023-05-08 14:05:06'),
('SCS_USER', NULL, '46262302', 'System', '', '2023-05-08 14:04:12'),
('START_YEAR', 'ปีที่เริ่มกิจการ', '2021', 'Company', 'ปีเริ่มต้นกิจการ', '2021-11-24 05:25:17'),
('SYSTEM_DATE', NULL, '2023-08-31', NULL, '', '2023-08-07 04:43:16'),
('TEST_MODE', NULL, '1', NULL, '', '2023-06-01 16:51:35'),
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
-- Table structure for table `dispose_reason`
--

CREATE TABLE `dispose_reason` (
  `id` int(11) NOT NULL,
  `reason_id` varchar(5) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(100) NOT NULL,
  `is_break_down` tinyint(1) NOT NULL DEFAULT '1',
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dispose_reason`
--

INSERT INTO `dispose_reason` (`id`, `reason_id`, `title`, `description`, `is_break_down`, `date_upd`) VALUES
(1, '0', 'สภาพปกติ', 'มิเตอร์ยังสามารถใช้งานได้ดี', 0, '2023-07-22 06:39:43'),
(2, '1', 'ถ.ที่ต่อสายไหม้', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(3, '2', 'ถ.ซีซีไหม้', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(4, '3', 'ถ.หมุนติดขัด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(5, '4', 'ถ.หมุนถอยหลัง', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(6, '5', 'ถ.หมุนขณะไม่มีโหลด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(7, '6', 'ถ.ไม่หมุนขณะมีโหลด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(8, '7', 'ถ.ไหม้ทั้งเครื่อง', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(9, '8', 'ถ.พีซีขาด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(10, '9', 'ถ.มดเข้า', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(11, '01', 'ถ.ที่ต่อสายไหม้', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(12, '02', 'ถ.ซีซีไหม้', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(13, '03', 'ถ.หมุนติดขัด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(14, '04', 'ถ.หมุนถอยหลัง', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(15, '05', 'ถ.หมุนขณะไม่มีโหลด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(16, '06', 'ถ.ไม่หมุนขณะมีโหลด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(17, '07', 'ถ.ไหม้ทั้งเครื่อง', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(18, '08', 'ถ.พีซีขาด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(19, '09', 'ถ.มดเข้า', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(20, '10', 'ถ.น้ำเข้า', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(21, '11', 'ถ.ฝาครอบแตก', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(22, '12', 'ถ.ดีมานด์ชำรุด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(23, '13', 'ถ.ปัญหาจากสกรู', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(24, '14', 'ถ.ยางฝาครอบชำรุด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(25, '15', 'ถ.ขอบฝาครอบชำรุด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(26, '16', 'ถ.ตราข้างขาด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(27, '17', 'ถ.ละเมิดสิทธิ์ (ชำรุด)', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(28, '18', 'ถ.เพลิงไหม้', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(29, '19', 'ถ.จอไม่แสดงค่า', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(30, '20', 'ถ.เกิดอ๊อกไซด์ภายในมิเตอร์', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(31, '21', 'ถ.เฟสชำรุด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(32, '22', 'ถ.ไฟรั่วลงมิเตอร์', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(33, '23', 'ถ.แบตเตอรี่ Backup หมดอายุ', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(34, '24', 'ถ.หน่วยความจำ Error', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(35, '25', 'ถ.CT/VT บุชชิ่งแตกร้าว', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(36, '26', 'ถ.CT/VT FLASH OVER, LEAK', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(37, '27', 'ถ.CT/VT ถังน้ำมันรั่ว', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(38, '28', 'ถ.CT/VT ยางกันน้ำมันรั่ว', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(39, '29', 'ถ.CT/VT เทอร์มินอล ชำรุด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(40, '30', 'ถ.CT/VT  ขดลวดไหม้, ลงดิน', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(41, '31', 'ถ.CT/VT ไหม้ทั้งเครื่อง', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(42, '32', 'ถ.CT/VT ระเบิด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(43, '33', 'ถ.CT/VT ฟ้าลง', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(44, '34', 'ถ.CT/VT ขายึดฉีก, หลุด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(45, '35', 'ถ.CT/VT ไม่มีฝาครอบ', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(46, '36', 'ถ.CT/VT เคสแตก', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(47, '37', 'ถ.CT/VT เนมเพลทชำรุด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(48, '38', 'ถ.ชำรุดไม่ทราบสาเหตุ', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(49, '39', 'ถ.ชำรุดสาเหตุอื่น ๆ', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(50, 'H0', 'ถ.ค้างชำระค่าไฟ', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(51, 'I0', 'ถ.เพิ่มขนาด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(52, 'J0', 'ถ.ลดขนาด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(53, 'J3', 'ถ.เปลี่ยนประเภทการใช้ไฟ', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(54, 'J5', 'ถ.เปลี่ยนประเภทมิเตอร์', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(55, 'J6', 'ถ.เปลี่ยนมิเตอร์ AMR', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(56, 'K0', 'ถ.เลิกใช้ไฟ', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(57, 'L0', 'ถ.ตัดฝาก', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(58, 'M0', 'ถ.ย้ายสถานที่ใช้ไฟฟ้า', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(59, 'N0', 'ถ.สูญหาย', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(60, 'O0', 'ถ.บ้านรื้อถอน', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(61, 'P0', 'ถ.ติด Nameplate ผิด', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(62, 'P5', 'ถ.มิเตอร์เปรียบเทียบ', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(63, 'Q0', 'ถ.อื่น ๆ', 'ชำรุด', 1, '2023-07-22 06:39:43'),
(64, 'R0', 'ถ.ข้อมูลผิด', 'ชำรุด', 1, '2023-07-22 06:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `install_list`
--

CREATE TABLE `install_list` (
  `id` int(11) NOT NULL,
  `work_date` date DEFAULT NULL,
  `u_pea_no` varchar(20) NOT NULL,
  `i_pea_no` varchar(20) NOT NULL,
  `meter_age` int(11) NOT NULL DEFAULT '0',
  `meter_type` varchar(10) DEFAULT NULL COMMENT 'phase code',
  `phase` int(1) NOT NULL DEFAULT '1',
  `meter_size` varchar(10) DEFAULT NULL,
  `meter_size_name` varchar(50) DEFAULT NULL,
  `meter_read_end` int(11) NOT NULL DEFAULT '0' COMMENT 'หน่วยตัดกลับ',
  `dispose_reason` varchar(2) DEFAULT NULL,
  `route` varchar(20) DEFAULT NULL,
  `area` varchar(20) DEFAULT NULL,
  `worker` varchar(100) DEFAULT NULL,
  `status` set('O','L','S','C','E') NOT NULL DEFAULT 'O' COMMENT 'O = open\r\nL = Load to transfer\r\nS = Transfer success\r\nC = Manual Closed\r\nE = Error',
  `pack_code` varchar(20) DEFAULT NULL,
  `transfer_code` varchar(20) DEFAULT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` varchar(50) DEFAULT NULL,
  `ItemCode` varchar(50) DEFAULT NULL,
  `ItemName` varchar(100) DEFAULT NULL,
  `pack_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 = packed, 0 = pending',
  `message` text,
  `prev_status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `install_list`
--

INSERT INTO `install_list` (`id`, `work_date`, `u_pea_no`, `i_pea_no`, `meter_age`, `meter_type`, `phase`, `meter_size`, `meter_size_name`, `meter_read_end`, `dispose_reason`, `route`, `area`, `worker`, `status`, `pack_code`, `transfer_code`, `date_add`, `user`, `ItemCode`, `ItemName`, `pack_status`, `message`, `prev_status`) VALUES
(1, '2023-07-25', '5900110399', '6601482184', 5, 'M010', 1, 'M0100040', '15(45)', 11102, '0', 'CBPP0028', 'C', 'นายนัฐพล นิทาน', 'O', NULL, NULL, '2023-08-03 13:45:32', 'superadmin', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(2, '2023-07-25', '5901137220', '6601482183', 6, 'M010', 1, 'M0100020', '5(15)', 4498, '55', 'CBPP0028', 'C', 'นายนัฐพล นิทาน', 'O', NULL, NULL, '2023-08-03 13:45:32', 'superadmin', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(3, '2023-07-24', '5701341412', '6601479432', 8, 'M010', 1, 'M0100040', '15(45)', 12109, '0', 'CUTT0099', 'C', 'นายสมใจ จันทร์จินดา', 'O', NULL, NULL, '2023-08-03 13:45:32', 'superadmin', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(4, '2023-08-01', '6100683025', '6601489661', 4, 'M010', 1, 'M0100020', '5(15)', 5890, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:26', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(5, '2023-07-25', '5700951217', '6601489628', 7, 'M010', 1, 'M0100040', '15(45)', 29103, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:26', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(6, '2023-07-24', '20145397', '6601483438', 17, 'M010', 1, 'M0100020', '5(15)', 818, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(7, '2023-07-24', '16088461', '6601483478', 21, 'M010', 1, 'M0100020', '5(15)', 1713, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(8, '2023-07-25', '6200236033', '6601483348', 3, 'M010', 1, 'M0100020', '5(15)', 2936, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(9, '2023-08-01', '18380812', '6601489620', 19, 'M010', 1, 'M0100020', '5(15)', 291, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(10, '2023-08-01', '6001664975', '6601489684', 5, 'M010', 1, 'M0100020', '5(15)', 7462, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(11, '2023-07-25', '6200236002', '6601483328', 3, 'M010', 1, 'M0100020', '5(15)', 4851, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(12, '2023-07-28', '6100170146', '6601483607', 4, 'M010', 1, 'M0100020', '5(15)', 5123, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(13, '2023-08-01', '5901060276', '6601489675', 5, 'M010', 1, 'M0100020', '5(15)', 5146, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(14, '2023-07-28', '6300455795', '6601483565', 3, 'M010', 1, 'M0100040', '15(45)', 4377, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(15, '2023-07-28', '6100170145', '6601489514', 4, 'M010', 1, 'M0100020', '5(15)', 337, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(16, '2023-08-01', '5600256295', '6601489355', 9, 'M010', 1, 'M0100020', '5(15)', 3860, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(17, '2023-07-24', '24472209', '6601483379', 14, 'M010', 1, 'M0100020', '5(15)', 3013, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(18, '2023-07-24', '5700398128', '6601483459', 8, 'M010', 1, 'M0100020', '5(15)', 6423, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(19, '2023-08-01', '5700531259', '6601489668', 8, 'M010', 1, 'M0100020', '5(15)', 4780, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(20, '2023-07-24', '25337499', '6601483300', 13, 'M010', 1, 'M0100020', '5(15)', 2618, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(21, '2023-08-01', '26454726', '6601489329', 13, 'M010', 1, 'M0100040', '15(45)', 34264, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(22, '2023-07-28', '6100170142', '6601489510', 4, 'M010', 1, 'M0100020', '5(15)', 7125, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(23, '2023-07-24', '25337474', '6601483351', 13, 'M010', 1, 'M0100020', '5(15)', 1648, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(24, '2023-07-28', '6200763350', '6601489318', 1, 'M010', 1, 'M0100020', '5(15)', 128, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(25, '2023-07-28', '6200237324', '6601483528', 3, 'M010', 1, 'M0100020', '5(15)', 2, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(26, '2023-07-28', '6200236148', '6601483621', 3, 'M010', 1, 'M0100020', '5(15)', 135, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(27, '2023-07-24', '6200237382', '6601483479', 3, 'M010', 1, 'M0100020', '5(15)', 5144, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(28, '2023-07-24', '18126285', '6601483294', 19, 'M010', 1, 'M0100020', '5(15)', 181, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(29, '2023-08-01', '5800518023', '6601489644', 7, 'M010', 1, 'M0100020', '5(15)', 479, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(30, '2023-07-24', '17511022', '6601483359', 20, 'M010', 1, 'M0100020', '5(15)', 5089, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(31, '2023-07-24', '6200236000', '6601483295', 3, 'M010', 1, 'M0100020', '5(15)', 2103, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(32, '2023-08-01', '20072055', '6601489368', 17, 'M010', 1, 'M0100020', '5(15)', 7041, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(33, '2023-07-25', '6200236093', '6601483274', 3, 'M010', 1, 'M0100020', '5(15)', 1188, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(34, '2023-07-28', '5701539455', '6601489540', 8, 'M010', 1, 'M0100020', '5(15)', 2430, '55', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:27', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(35, '2023-07-28', '6000095232', '6601489570', 5, 'M010', 1, 'M0100020', '5(15)', 2400, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(36, '2023-07-28', '6100174288', '6601489579', 4, 'M010', 1, 'M0100020', '5(15)', 2228, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(37, '2023-08-01', '16047487', '6601489602', 21, 'M010', 1, 'M0100020', '5(15)', 8209, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(38, '2023-07-25', '6400305848', '6601483377', 1, 'M010', 1, 'M0100040', '15(45)', 2099, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(39, '2023-07-28', '6201029505', '6601489569', 2, 'M010', 1, 'M0100020', '5(15)', 318, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(40, '2023-07-25', '6200556538', '6601483341', 0, 'M010', 1, 'M0100020', '5(15)', 1802, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(41, '2023-07-24', '29610107', '6601483284', 10, 'M010', 1, 'M0100020', '5(15)', 4273, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(42, '2023-07-24', '20446628', '6601483374', 17, 'M010', 1, 'M0100020', '5(15)', 691, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(43, '2023-07-24', '28905185', '6601483278', 10, 'M010', 1, 'M0100020', '5(15)', 2764, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(44, '2023-08-01', '6201086270', '6601489609', 2, 'M010', 1, 'M0100020', '5(15)', 2463, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(45, '2023-08-01', '28467052', '6601489337', 10, 'M010', 1, 'M0100020', '5(15)', 4147, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(46, '2023-07-28', '6100710101', '6601483615', 4, 'M010', 1, 'M0100020', '5(15)', 6253, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(47, '2023-08-01', '6300847989', '6601489656', 1, 'M010', 1, 'M0100040', '15(45)', 2665, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(48, '2023-07-24', '5801454806', '6601483407', 6, 'M010', 1, 'M0100020', '5(15)', 4134, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(49, '2023-08-01', '28732936', '6601489615', 9, 'M010', 1, 'M0100040', '15(45)', 23703, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(50, '2023-07-24', '6100682974', '6601483383', 4, 'M010', 1, 'M0100020', '5(15)', 7223, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(51, '2023-07-24', '5801454405', '6601483488', 6, 'M010', 1, 'M0100020', '5(15)', 4973, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(52, '2023-07-28', '6100170151', '6601483563', 4, 'M010', 1, 'M0100020', '5(15)', 5109, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(53, '2023-07-24', '27494972', '6601483480', 11, 'M010', 1, 'M0100020', '5(15)', 9414, '13', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(54, '2023-07-28', '6200236145', '6601483540', 3, 'M010', 1, 'M0100020', '5(15)', 4363, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(55, '2023-07-24', '18769984', '6601483411', 19, 'M010', 1, 'M0100020', '5(15)', 5822, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(56, '2023-07-28', '6100170149', '6601483601', 4, 'M010', 1, 'M0100020', '5(15)', 6980, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(57, '2023-07-24', '29581774', '6601483404', 9, 'M010', 1, 'M0100020', '5(15)', 7872, '55', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(58, '2023-07-28', '5900083325', '6601483564', 6, 'M010', 1, 'M0100040', '15(45)', 18408, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(59, '2023-07-24', '23690988', '6601483415', 15, 'M010', 1, 'M0100020', '5(15)', 771, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(60, '2023-07-28', '5600310725', '6601483614', 9, 'M010', 1, 'M0100020', '5(15)', 1627, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(61, '2023-08-01', '6000095252', '6601489335', 5, 'M010', 1, 'M0100020', '5(15)', 7689, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(62, '2023-08-01', '6100170926', '6601489604', 4, 'M010', 1, 'M0100020', '5(15)', 23, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(63, '2023-08-01', '18126265', '6601489378', 19, 'M010', 1, 'M0100020', '5(15)', 2568, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:28', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(64, '2023-07-28', '25337477', '6601483589', 13, 'M010', 1, 'M0100020', '5(15)', 34, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(65, '2023-07-28', '5901295296', '6601483527', 5, 'M010', 1, 'M0100020', '5(15)', 8995, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(66, '2023-07-28', '6201030114', '6601483550', 2, 'M010', 1, 'M0100020', '5(15)', 4168, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(67, '2023-08-01', '6100170922', '6601489593', 4, 'M010', 1, 'M0100020', '5(15)', 1965, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(68, '2023-07-24', '6201029449', '6601483391', 3, 'M010', 1, 'M0100020', '5(15)', 7196, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(69, '2023-08-01', '5700948691', '6601489690', 7, 'M010', 1, 'M0100040', '15(45)', 4064, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(70, '2023-07-24', '6100710296', '6601483354', 3, 'M010', 1, 'M0100020', '5(15)', 3407, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(71, '2023-07-28', '5800915890', '6601483530', 6, 'M010', 1, 'M0100020', '5(15)', 5434, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(72, '2023-07-24', '5600310673', '6601483385', 9, 'M010', 1, 'M0100020', '5(15)', 6991, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(73, '2023-08-01', '6201083866', '6601489348', 2, 'M010', 1, 'M0100020', '5(15)', 8772, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(74, '2023-08-01', '30056610', '6601489677', 9, 'M010', 1, 'M0100040', '15(45)', 9078, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(75, '2023-07-24', '25337473', '6601483315', 13, 'M010', 1, 'M0100020', '5(15)', 7212, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(76, '2023-07-28', '25335937', '6601483554', 13, 'M010', 1, 'M0100020', '5(15)', 728, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(77, '2023-07-24', '5901296128', '6601483437', 5, 'M010', 1, 'M0100020', '5(15)', 7724, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(78, '2023-08-01', '5700762714', '6601489707', 8, 'M010', 1, 'M0100020', '5(15)', 217, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(79, '2023-07-24', '25337514', '6601483373', 13, 'M010', 1, 'M0100020', '5(15)', 2245, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(80, '2023-08-01', '28537111', '6601489590', 9, 'M010', 1, 'M0100040', '15(45)', 40184, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(81, '2023-08-01', '5700762292', '6601489379', 8, 'M010', 1, 'M0100020', '5(15)', 4720, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(82, '2023-08-01', '6100170920', '6601489341', 4, 'M010', 1, 'M0100020', '5(15)', 5098, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(83, '2023-07-24', '5901296127', '6601483422', 5, 'M010', 1, 'M0100020', '5(15)', 4954, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(84, '2023-07-24', '6200179393', '6601483442', 3, 'M010', 1, 'M0100020', '5(15)', 7368, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(85, '2023-08-01', '26716177', '6601489589', 12, 'M010', 1, 'M0100020', '5(15)', 7809, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(86, '2023-07-24', '26713528', '6601483277', 12, 'M010', 1, 'M0100020', '5(15)', 2006, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(87, '2023-07-28', '6200236152', '6601489530', 3, 'M010', 1, 'M0100020', '5(15)', 53, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(88, '2023-07-24', '5901061396', '6601483458', 5, 'M010', 1, 'M0100020', '5(15)', 6057, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:29', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(89, '2023-07-24', '5901137442', '6601483474', 6, 'M010', 1, 'M0100020', '5(15)', 9086, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(90, '2023-07-24', 'B033424', '6601483388', 28, 'M010', 1, 'M0100020', '5(15)', 4238, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(91, '2023-08-01', '19719961', '6601489617', 18, 'M010', 1, 'M0100020', '5(15)', 9171, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(92, '2023-07-28', '6200367895', '6601483558', 1, 'M010', 1, 'M0100020', '5(15)', 1428, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(93, '2023-07-28', '6001665910', '6601483526', 4, 'M010', 1, 'M0100020', '5(15)', 1115, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(94, '2023-07-24', '19304988', '6601483339', 18, 'M010', 1, 'M0100020', '5(15)', 8388, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(95, '2023-07-24', '6100710295', '6601483369', 4, 'M010', 1, 'M0100020', '5(15)', 9185, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(96, '2023-07-24', '6100710294', '6601483375', 4, 'M010', 1, 'M0100020', '5(15)', 9974, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(97, '2023-07-28', '28167292', '6601483396', 11, 'M010', 1, 'M0100020', '5(15)', 6777, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(98, '2023-07-28', '6300815713', '6601489525', 2, 'M010', 1, 'M0100040', '15(45)', 4867, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(99, '2023-07-28', '6200236179', '6601483599', 3, 'M010', 1, 'M0100020', '5(15)', 7403, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(100, '2023-07-24', '17295189', '6601483473', 19, 'M010', 1, 'M0100020', '5(15)', 5949, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(101, '2023-08-01', '5800571718', '6601489358', 7, 'M010', 1, 'M0100020', '5(15)', 817, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(102, '2023-07-28', '28467091', '6601489522', 10, 'M010', 1, 'M0100020', '5(15)', 2160, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(103, '2023-07-24', '23410845', '6601483482', 15, 'M010', 1, 'M0100040', '15(45)', 88168, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(104, '2023-07-24', '5901059851', '6601483389', 5, 'M010', 1, 'M0100020', '5(15)', 2570, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(105, '2023-07-28', '29581739', '6601489550', 9, 'M010', 1, 'M0100020', '5(15)', 4705, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(106, '2023-07-24', '6200367272', '6601483390', 1, 'M010', 1, 'M0100020', '5(15)', 5779, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(107, '2023-07-28', '23862338', '6601489577', 14, 'M010', 1, 'M0100020', '5(15)', 208, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(108, '2023-07-25', '6200236072', '6601483332', 3, 'M010', 1, 'M0100020', '5(15)', 410, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(109, '2023-07-28', '26317403', '6601489535', 12, 'M010', 1, 'M0100020', '5(15)', 3472, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(110, '2023-07-25', '26455158', '6601483263', 12, 'M010', 1, 'M0100040', '15(45)', 8155, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(111, '2023-07-28', '5800571709', '6601483576', 7, 'M010', 1, 'M0100020', '5(15)', 9276, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:30', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(112, '2023-07-28', '6100170125', '6601489508', 4, 'M010', 1, 'M0100020', '5(15)', 3422, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(113, '2023-07-28', '5600256477', '6601489322', 9, 'M010', 1, 'M0100020', '5(15)', 63, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(114, '2023-07-28', '20072051', '6601489509', 17, 'M010', 1, 'M0100020', '5(15)', 4246, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(115, '2023-07-24', '6200180759', '6601489631', 3, 'M010', 1, 'M0100020', '5(15)', 2, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(116, '2023-07-24', '6300177370', '6601483410', 3, 'M010', 1, 'M0100040', '15(45)', 332, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(117, '2023-07-28', '6100174295', '6601483536', 4, 'M010', 1, 'M0100020', '5(15)', 1128, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(118, '2023-07-24', '5600310575', '6601483439', 9, 'M010', 1, 'M0100020', '5(15)', 514, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(119, '2023-07-24', '23691804', '6601483272', 15, 'M010', 1, 'M0100020', '5(15)', 2653, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(120, '2023-07-24', '6100169882', '6601483345', 4, 'M010', 1, 'M0100020', '5(15)', 308, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(121, '2023-07-28', '16684641', '6601483593', 20, 'M010', 1, 'M0100020', '5(15)', 2093, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(122, '2023-07-28', '6200236154', '6601489317', 3, 'M010', 1, 'M0100020', '5(15)', 2471, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(123, '2023-07-24', '23691064', '6601483416', 15, 'M010', 1, 'M0100020', '5(15)', 5361, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(124, '2023-07-24', '25337550', '6601483409', 13, 'M010', 1, 'M0100020', '5(15)', 5912, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(125, '2023-07-24', '25337512', '6601483329', 13, 'M010', 1, 'M0100020', '5(15)', 1885, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(126, '2023-08-01', '5801454406', '6601489380', 6, 'M010', 1, 'M0100020', '5(15)', 2689, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(127, '2023-08-01', '6000095256', '6601489597', 5, 'M010', 1, 'M0100020', '5(15)', 3333, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(128, '2023-08-01', '6301007071', '6601489328', 1, 'M010', 1, 'M0100040', '15(45)', 3471, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(129, '2023-07-24', '5700398102', '6601483333', 8, 'M010', 1, 'M0100020', '5(15)', 4974, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(130, '2023-07-24', '27785780', '6601483269', 11, 'M010', 1, 'M0100020', '5(15)', 8081, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(131, '2023-07-25', '6200236021', '6601489637', 3, 'M010', 1, 'M0100020', '5(15)', 180, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(132, '2023-07-24', '26312817', '6601483366', 12, 'M010', 1, 'M0100020', '5(15)', 2752, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(133, '2023-08-01', '23691813', '6601489692', 15, 'M010', 1, 'M0100020', '5(15)', 3612, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(134, '2023-07-24', '6000800426', '6601483321', 4, 'M010', 1, 'M0100020', '5(15)', 1273, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(135, '2023-08-01', '6200559594', '6601489376', 0, 'M010', 1, 'M0100020', '5(15)', 1606, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(136, '2023-07-25', '6201083862', '6601489654', 2, 'M010', 1, 'M0100020', '5(15)', 4824, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(137, '2023-08-01', '15353809', '6601489685', 23, 'M010', 1, 'M0100020', '5(15)', 4821, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(138, '2023-07-28', '6200367887', '6601483500', 1, 'M010', 1, 'M0100020', '5(15)', 3, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:31', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(139, '2023-08-01', '25338810', '6601489667', 13, 'M010', 1, 'M0100020', '5(15)', 863, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(140, '2023-07-25', '6200559558', '6601483318', 1, 'M010', 1, 'M0100020', '5(15)', 842, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(141, '2023-08-01', '6000095255', '6601489584', 5, 'M010', 1, 'M0100020', '5(15)', 1472, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(142, '2023-08-01', '6100174397', '6601489633', 4, 'M010', 1, 'M0100020', '5(15)', 8027, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(143, '2023-08-01', '23691074', '6601489369', 15, 'M010', 1, 'M0100020', '5(15)', 5198, '13', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(144, '2023-07-28', '5600256467', '6601483582', 9, 'M010', 1, 'M0100020', '5(15)', 1324, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(145, '2023-07-24', '23757822', '6601483325', 14, 'M010', 1, 'M0100020', '5(15)', 8429, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(146, '2023-08-01', '6100170930', '6601489613', 4, 'M010', 1, 'M0100020', '5(15)', 13, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(147, '2023-08-01', '20145446', '6601489673', 17, 'M010', 1, 'M0100020', '5(15)', 9172, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(148, '2023-07-24', '5700477536', '6601483288', 9, 'M010', 1, 'M0100020', '5(15)', 8769, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(149, '2023-08-01', '6001664970', '6601489722', 5, 'M010', 1, 'M0100020', '5(15)', 3459, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(150, '2023-07-24', '16406315', '6601483287', 21, 'M010', 1, 'M0100020', '5(15)', 6701, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(151, '2023-08-01', '25338809', '6601489648', 13, 'M010', 1, 'M0100020', '5(15)', 1840, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(152, '2023-07-24', '6100682989', '6601483311', 4, 'M010', 1, 'M0100020', '5(15)', 6204, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(153, '2023-08-01', '6100710274', '6601489679', 4, 'M010', 1, 'M0100020', '5(15)', 3976, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(154, '2023-07-24', '6200179434', '6601483443', 3, 'M010', 1, 'M0100020', '5(15)', 3606, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(155, '2023-07-28', '5900492992', '6601489529', 6, 'M010', 1, 'M0100020', '5(15)', 9827, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(156, '2023-07-25', '6000360102', '6601483370', 5, 'M010', 1, 'M0100040', '15(45)', 14430, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(157, '2023-07-28', '6200236151', '6601489321', 3, 'M010', 1, 'M0100020', '5(15)', 2188, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(158, '2023-07-25', '6201083899', '6601489666', 2, 'M010', 1, 'M0100020', '5(15)', 803, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(159, '2023-07-24', '25337482', '6601483323', 13, 'M010', 1, 'M0100020', '5(15)', 5671, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(160, '2023-07-25', '6200236020', '6601489638', 3, 'M010', 1, 'M0100020', '5(15)', 202, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(161, '2023-07-24', '18434871', '6601483319', 19, 'M010', 1, 'M0100020', '5(15)', 5959, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(162, '2023-07-28', '17462178', '6601489515', 20, 'M010', 1, 'M0100020', '5(15)', 7995, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(163, '2023-07-28', '24472197', '6601483591', 14, 'M010', 1, 'M0100020', '5(15)', 6581, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(164, '2023-08-01', '27437799', '6601489327', 11, 'M010', 1, 'M0100020', '5(15)', 3178, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(165, '2023-08-01', '6100170927', '6601489606', 4, 'M010', 1, 'M0100020', '5(15)', 4948, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(166, '2023-07-24', '20356332', '6601483429', 17, 'M010', 1, 'M0100040', '15(45)', 11057, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(167, '2023-07-28', '6300708082', '6601483549', 2, 'M010', 1, 'M0100040', '15(45)', 517, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(168, '2023-07-28', '18381263', '6601489521', 19, 'M010', 1, 'M0100020', '5(15)', 8584, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(169, '2023-07-28', '5900631498', '6601489541', 6, 'M010', 1, 'M0100020', '5(15)', 8195, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(170, '2023-07-24', '6000096185', '6601483403', 5, 'M010', 1, 'M0100020', '5(15)', 8547, '13', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:32', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(171, '2023-07-25', '28730791', '6601483358', 8, 'M010', 1, 'M0100040', '15(45)', 48915, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL);
INSERT INTO `install_list` (`id`, `work_date`, `u_pea_no`, `i_pea_no`, `meter_age`, `meter_type`, `phase`, `meter_size`, `meter_size_name`, `meter_read_end`, `dispose_reason`, `route`, `area`, `worker`, `status`, `pack_code`, `transfer_code`, `date_add`, `user`, `ItemCode`, `ItemName`, `pack_status`, `message`, `prev_status`) VALUES
(172, '2023-07-24', '6001664932', '6601483381', 5, 'M010', 1, 'M0100020', '5(15)', 3266, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(173, '2023-07-28', '6200179151', '6601483543', 3, 'M010', 1, 'M0100020', '5(15)', 4163, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(174, '2023-07-24', '22798117', '6601483372', 15, 'M010', 1, 'M0100020', '5(15)', 3092, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(175, '2023-07-24', '6100710290', '6601489641', 4, 'M010', 1, 'M0100020', '5(15)', 1258, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(176, '2023-07-28', '6200236147', '6601489532', 3, 'M010', 1, 'M0100020', '5(15)', 5837, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(177, '2023-07-24', '17119162', '6601483262', 20, 'M010', 1, 'M0100020', '5(15)', 9548, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(178, '2023-07-24', '6201028557', '6601483485', 3, 'M010', 1, 'M0100020', '5(15)', 5534, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(179, '2023-07-24', '6100710297', '6601483326', 3, 'M010', 1, 'M0100020', '5(15)', 3391, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(180, '2023-07-24', '20749631', '6601483453', 17, 'M010', 1, 'M0100020', '5(15)', 6600, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(181, '2023-07-25', '6200236019', '6601489660', 3, 'M010', 1, 'M0100020', '5(15)', 5169, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(182, '2023-08-01', '6101100210', '6601489365', 3, 'M010', 1, 'M0100040', '15(45)', 8257, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(183, '2023-07-24', '25337502', '6601489626', 13, 'M010', 1, 'M0100020', '5(15)', 3071, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(184, '2023-08-01', '6100170953', '6601489349', 4, 'M010', 1, 'M0100020', '5(15)', 67, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(185, '2023-07-24', '5701581880', '6601483378', 7, 'M010', 1, 'M0100020', '5(15)', 3625, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(186, '2023-07-24', '6000801339', '6601483455', 4, 'M010', 1, 'M0100020', '5(15)', 2346, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(187, '2023-07-28', '6100710100', '6601483619', 4, 'M010', 1, 'M0100020', '5(15)', 7842, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(188, '2023-07-25', '30056609', '6601483363', 9, 'M010', 1, 'M0100040', '15(45)', 1108, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(189, '2023-08-01', '18126266', '6601489374', 19, 'M010', 1, 'M0100020', '5(15)', 4917, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(190, '2023-08-01', '6100176015', '6601489360', 4, 'M010', 1, 'M0100020', '5(15)', 1622, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(191, '2023-07-28', '5701539409', '6601483616', 8, 'M010', 1, 'M0100020', '5(15)', 3255, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(192, '2023-08-01', '5700948732', '6601489647', 7, 'M010', 1, 'M0100040', '15(45)', 26385, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(193, '2023-07-28', '5901295290', '6601483560', 5, 'M010', 1, 'M0100020', '5(15)', 9954, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(194, '2023-08-01', '6100170923', '6601489594', 4, 'M010', 1, 'M0100020', '5(15)', 7419, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(195, '2023-07-28', '6000097394', '6601483401', 5, 'M010', 1, 'M0100020', '5(15)', 1330, '55', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(196, '2023-07-28', '6100170140', '6601489531', 4, 'M010', 1, 'M0100020', '5(15)', 1921, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(197, '2023-08-01', '19623529', '6601489676', 18, 'M010', 1, 'M0100040', '15(45)', 51657, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(198, '2023-07-28', '18381305', '6601483529', 19, 'M010', 1, 'M0100020', '5(15)', 9728, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(199, '2023-07-24', '6200179196', '6601483337', 3, 'M010', 1, 'M0100020', '5(15)', 5197, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(200, '2023-07-24', '18710088', '6601483472', 19, 'M010', 1, 'M0100020', '5(15)', 304, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(201, '2023-07-28', '6000095233', '6601489571', 5, 'M010', 1, 'M0100020', '5(15)', 1386, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(202, '2023-07-25', '6200556522', '6601483350', 0, 'M010', 1, 'M0100020', '5(15)', 339, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:33', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(203, '2023-08-01', '16370351', '6601489585', 21, 'M010', 1, 'M0100020', '5(15)', 4430, '13', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(204, '2023-08-01', '18227772', '6601489717', 19, 'M010', 1, 'M0100040', '15(45)', 27476, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(205, '2023-07-24', '6001082992', '6601483336', 5, 'M010', 1, 'M0100020', '5(15)', 7740, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(206, '2023-07-28', '27504691', '6601489546', 11, 'M010', 1, 'M0100020', '5(15)', 6297, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(207, '2023-07-24', '17856955', '6601483286', 19, 'M010', 1, 'M0100020', '5(15)', 7811, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(208, '2023-07-24', '5901059852', '6601483387', 5, 'M010', 1, 'M0100020', '5(15)', 8251, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(209, '2023-07-25', '6500110884', '6601483270', 1, 'M010', 1, 'M0100040', '15(45)', 10494, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(210, '2023-07-24', '18681880', '6601483331', 19, 'M010', 1, 'M0100020', '5(15)', 6416, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(211, '2023-07-28', '23904860', '6601483557', 14, 'M010', 1, 'M0100020', '5(15)', 4795, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(212, '2023-07-25', '6100895307', '6601483347', 4, 'M010', 1, 'M0100040', '15(45)', 3769, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(213, '2023-07-28', '24472214', '6601483586', 14, 'M010', 1, 'M0100020', '5(15)', 2230, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(214, '2023-08-01', '23554726', '6601489375', 15, 'M010', 1, 'M0100020', '5(15)', 1847, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(215, '2023-08-01', '20145449', '6601489367', 17, 'M010', 1, 'M0100020', '5(15)', 6613, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(216, '2023-07-24', '5700948677', '6601483413', 7, 'M010', 1, 'M0100040', '15(45)', 20111, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(217, '2023-07-24', '5901296131', '6601483423', 5, 'M010', 1, 'M0100020', '5(15)', 5511, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(218, '2023-07-28', '24517866', '6601483572', 14, 'M010', 1, 'M0100040', '15(45)', 3500, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(219, '2023-07-28', '6200764141', '6601483562', 1, 'M010', 1, 'M0100020', '5(15)', 5103, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(220, '2023-07-28', '6200179200', '6601489580', 3, 'M010', 1, 'M0100020', '5(15)', 3158, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(221, '2023-07-24', '26317578', '6601483427', 12, 'M010', 1, 'M0100020', '5(15)', 8820, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(222, '2023-07-24', '5800915936', '6601483338', 6, 'M010', 1, 'M0100020', '5(15)', 4862, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(223, '2023-07-28', '6000095194', '6601483400', 5, 'M010', 1, 'M0100020', '5(15)', 3286, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(224, '2023-07-28', '5700531172', '6601489557', 8, 'M010', 1, 'M0100020', '5(15)', 367, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(225, '2023-08-01', '25189341', '6601489340', 13, 'M010', 1, 'M0100040', '15(45)', 10794, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(226, '2023-07-24', '16495972', '6601483309', 21, 'M010', 1, 'M0100020', '5(15)', 8753, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(227, '2023-07-28', '6100170153', '6601483568', 4, 'M010', 1, 'M0100020', '5(15)', 7151, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(228, '2023-08-01', '5900632876', '6601489587', 6, 'M010', 1, 'M0100020', '5(15)', 8427, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:34', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(229, '2023-07-28', '22198328', '6601483575', 16, 'M010', 1, 'M0100020', '5(15)', 5530, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(230, '2023-07-24', '5901296132', '6601483470', 5, 'M010', 1, 'M0100020', '5(15)', 1977, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(231, '2023-08-01', '6100170924', '6601489601', 4, 'M010', 1, 'M0100020', '5(15)', 2070, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(232, '2023-07-24', '5600310579', '6601483462', 9, 'M010', 1, 'M0100020', '5(15)', 2020, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(233, '2023-08-01', '5701581884', '6601489681', 7, 'M010', 1, 'M0100020', '5(15)', 204, '09', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(234, '2023-07-28', '5600256378', '6601483399', 9, 'M010', 1, 'M0100020', '5(15)', 1484, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(235, '2023-07-24', '6200559580', '6601483420', 0, 'M010', 1, 'M0100020', '5(15)', 1414, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(236, '2023-07-24', '18434890', '6601483361', 19, 'M010', 1, 'M0100020', '5(15)', 7649, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(237, '2023-07-24', '27797364', '6601483279', 11, 'M010', 1, 'M0100020', '5(15)', 5223, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(238, '2023-07-24', '6201086268', '6601483484', 2, 'M010', 1, 'M0100020', '5(15)', 2673, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(239, '2023-07-24', '28905151', '6601483330', 10, 'M010', 1, 'M0100020', '5(15)', 2299, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(240, '2023-07-28', '6201029503', '6601489504', 2, 'M010', 1, 'M0100020', '5(15)', 4218, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(241, '2023-07-24', '6300662225', '6601483449', 2, 'M010', 1, 'M0100040', '15(45)', 919, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(242, '2023-07-24', '16887321', '6601483457', 20, 'M010', 1, 'M0100020', '5(15)', 7823, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(243, '2023-08-01', '15944286', '6601489699', 21, 'M010', 1, 'M0100020', '5(15)', 3243, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(244, '2023-07-28', '5801453351', '6601489563', 6, 'M010', 1, 'M0100020', '5(15)', 24, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(245, '2023-07-24', '5901061405', '6601483408', 5, 'M010', 1, 'M0100020', '5(15)', 1579, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(246, '2023-07-25', '5700948766', '6601489655', 7, 'M010', 1, 'M0100040', '15(45)', 7495, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(247, '2023-07-28', '29610137', '6601489558', 10, 'M010', 1, 'M0100020', '5(15)', 6637, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(248, '2023-07-25', '6300978396', '6601483293', 2, 'M010', 1, 'M0100040', '15(45)', 1305, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(249, '2023-07-28', '6200236003', '6601489519', 3, 'M010', 1, 'M0100020', '5(15)', 27, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(250, '2023-07-24', '18681897', '6601489624', 19, 'M010', 1, 'M0100020', '5(15)', 4350, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(251, '2023-07-28', '28733693', '6601483523', 10, 'M010', 1, 'M0100040', '15(45)', 60606, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(252, '2023-07-25', '6200764136', '6601483299', 1, 'M010', 1, 'M0100020', '5(15)', 2111, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(253, '2023-07-24', '6100176090', '6601483486', 4, 'M010', 1, 'M0100020', '5(15)', 831, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(254, '2023-07-28', '6100169883', '6601483577', 4, 'M010', 1, 'M0100020', '5(15)', 1904, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(255, '2023-07-28', '5700945886', '6601483497', 8, 'M010', 1, 'M0100040', '15(45)', 7272, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(256, '2023-08-01', '5700945507', '6601489372', 8, 'M010', 1, 'M0100040', '15(45)', 26086, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(257, '2023-07-24', '5801454453', '6601483489', 6, 'M010', 1, 'M0100020', '5(15)', 7198, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(258, '2023-07-24', '6000927878', '6601483448', 4, 'M010', 1, 'M0100020', '5(15)', 7269, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(259, '2023-07-28', '6000096164', '6601483600', 5, 'M010', 1, 'M0100020', '5(15)', 2368, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(260, '2023-07-24', '19865309', '6601483280', 18, 'M010', 1, 'M0100020', '5(15)', 465, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:35', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(261, '2023-07-28', '6201028552', '6601483584', 3, 'M010', 1, 'M0100020', '5(15)', 2889, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(262, '2023-08-01', '27495067', '6601489599', 11, 'M010', 1, 'M0100020', '5(15)', 2942, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(263, '2023-07-24', '5700762713', '6601489630', 8, 'M010', 1, 'M0100020', '5(15)', 2474, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(264, '2023-08-01', '6200367290', '6601489347', 1, 'M010', 1, 'M0100020', '5(15)', 501, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(265, '2023-08-01', '6100170925', '6601489603', 4, 'M010', 1, 'M0100020', '5(15)', 72, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(266, '2023-08-01', '5700762681', '6601489611', 8, 'M010', 1, 'M0100020', '5(15)', 228, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(267, '2023-08-01', '6001664969', '6601489702', 5, 'M010', 1, 'M0100020', '5(15)', 2436, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(268, '2023-07-24', '5700477528', '6601483334', 9, 'M010', 1, 'M0100020', '5(15)', 4393, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(269, '2023-07-28', '18644799', '6601483532', 19, 'M010', 1, 'M0100020', '5(15)', 2717, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(270, '2023-07-24', '18791687', '6601483495', 19, 'M010', 1, 'M0100020', '5(15)', 4417, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(271, '2023-08-01', '6100777774', '6601489636', 4, 'M010', 1, 'M0100020', '5(15)', 704, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(272, '2023-07-28', '6100778019', '6601483587', 4, 'M010', 1, 'M0100020', '5(15)', 6113, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(273, '2023-07-24', '25337471', '6601483367', 13, 'M010', 1, 'M0100020', '5(15)', 2742, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(274, '2023-07-28', '19116843', '6601483611', 18, 'M010', 1, 'M0100040', '15(45)', 97648, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(275, '2023-07-24', '6000927915', '6601483289', 4, 'M010', 1, 'M0100020', '5(15)', 1242, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(276, '2023-07-24', '6200367328', '6601483419', 1, 'M010', 1, 'M0100020', '5(15)', 848, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(277, '2023-08-01', '6100169941', '6601489336', 4, 'M010', 1, 'M0100020', '5(15)', 1732, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(278, '2023-08-01', '26317562', '6601489350', 12, 'M010', 1, 'M0100020', '5(15)', 3877, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(279, '2023-07-28', '6400093071', '6601483603', 1, 'M010', 1, 'M0100040', '15(45)', 2632, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(280, '2023-07-28', '6000095280', '6601489576', 5, 'M010', 1, 'M0100020', '5(15)', 1834, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(281, '2023-07-28', '28467016', '6601483604', 10, 'M010', 1, 'M0100020', '5(15)', 9751, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(282, '2023-08-01', '6300436712', '6601489381', 3, 'M010', 1, 'M0100040', '15(45)', 4053, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(283, '2023-08-01', '23315431', '6601489727', 15, 'M010', 1, 'M0100040', '15(45)', 17856, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(284, '2023-07-28', '6200236199', '6601483579', 3, 'M010', 1, 'M0100020', '5(15)', 2874, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(285, '2023-07-24', '6300978373', '6601483464', 2, 'M010', 1, 'M0100040', '15(45)', 1986, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(286, '2023-07-28', '6200236150', '6601489544', 3, 'M010', 1, 'M0100020', '5(15)', 2394, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(287, '2023-08-01', '17978060', '6601489343', 19, 'M010', 1, 'M0100040', '15(45)', 77460, '13', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(288, '2023-07-24', '20073103', '6601483384', 17, 'M010', 1, 'M0100020', '5(15)', 9882, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(289, '2023-07-28', '28730090', '6601483524', 10, 'M010', 1, 'M0100040', '15(45)', 30649, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(290, '2023-07-28', '6300708124', '6601489559', 2, 'M010', 1, 'M0100040', '15(45)', 2, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(291, '2023-07-28', '6000095195', '6601489517', 5, 'M010', 1, 'M0100020', '5(15)', 7974, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:36', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(292, '2023-07-24', '5700691315', '6601483301', 9, 'M010', 1, 'M0100020', '5(15)', 3281, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(293, '2023-07-24', '29610159', '6601483360', 10, 'M010', 1, 'M0100020', '5(15)', 8737, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(294, '2023-07-25', '6200763254', '6601483283', 1, 'M010', 1, 'M0100020', '5(15)', 448, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(295, '2023-08-01', '6101100209', '6601489701', 3, 'M010', 1, 'M0100040', '15(45)', 7806, '13', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(296, '2023-07-28', '26317434', '6601483398', 12, 'M010', 1, 'M0100020', '5(15)', 5882, '55', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(297, '2023-07-25', '6200236092', '6601483292', 3, 'M010', 1, 'M0100020', '5(15)', 582, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(298, '2023-07-28', '6100174403', '6601489552', 4, 'M010', 1, 'M0100020', '5(15)', 143, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(299, '2023-08-01', '28730104', '6601489649', 10, 'M010', 1, 'M0100040', '15(45)', 6754, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(300, '2023-07-24', '25337527', '6601489642', 13, 'M010', 1, 'M0100020', '5(15)', 2, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(301, '2023-07-25', '6200557456', '6601489665', 0, 'M010', 1, 'M0100020', '5(15)', 596, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(302, '2023-07-24', '6101308580', '6601483382', 3, 'M010', 1, 'M0100040', '15(45)', 9602, '39', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(303, '2023-07-28', '6100710099', '6601483620', 4, 'M010', 1, 'M0100020', '5(15)', 7066, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(304, '2023-07-24', '21289680', '6601483371', 16, 'M010', 1, 'M0100020', '5(15)', 3850, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(305, '2023-08-01', '5800422665', '6601489632', 6, 'M010', 1, 'M0100040', '15(45)', 17958, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(306, '2023-07-24', '22856876', '6601483317', 15, 'M010', 1, 'M0100020', '5(15)', 7689, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(307, '2023-07-28', '6300455752', '6601489543', 3, 'M010', 1, 'M0100040', '15(45)', 14486, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(308, '2023-07-24', '29607249', '6601483430', 10, 'M010', 1, 'M0100020', '5(15)', 4704, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(309, '2023-08-01', '5900085448', '6601489697', 6, 'M010', 1, 'M0100040', '15(45)', 25168, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(310, '2023-07-28', '21152107', '6601489502', 16, 'M010', 1, 'M0100020', '5(15)', 3469, '55', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(311, '2023-07-25', '26453868', '6601489629', 13, 'M010', 1, 'M0100040', '15(45)', 15432, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(312, '2023-07-28', '19305006', '6601483590', 18, 'M010', 1, 'M0100020', '5(15)', 368, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(313, '2023-07-24', '26317600', '6601483467', 12, 'M010', 1, 'M0100020', '5(15)', 2422, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(314, '2023-07-28', '5901295309', '6601483535', 5, 'M010', 1, 'M0100020', '5(15)', 8104, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(315, '2023-07-28', '18049591', '6601489564', 20, 'M010', 1, 'M0100020', '5(15)', 729, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(316, '2023-07-28', '6200367354', '6601483595', 1, 'M010', 1, 'M0100020', '5(15)', 1454, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:37', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(317, '2023-08-01', '6100170921', '6601489338', 4, 'M010', 1, 'M0100020', '5(15)', 4459, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(318, '2023-07-24', '28905833', '6601483450', 10, 'M010', 1, 'M0100020', '5(15)', 8660, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(319, '2023-07-24', '16406367', '6601483266', 21, 'M010', 1, 'M0100020', '5(15)', 1801, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(320, '2023-08-01', '20145509', '6601489674', 17, 'M010', 1, 'M0100020', '5(15)', 8931, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(321, '2023-08-01', '6000095254', '6601489330', 5, 'M010', 1, 'M0100020', '5(15)', 3229, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(322, '2023-07-28', '6500115445', '6601483492', 1, 'M010', 1, 'M0100040', '15(45)', 2342, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(323, '2023-07-24', '25337480', '6601483346', 13, 'M010', 1, 'M0100020', '5(15)', 6228, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(324, '2023-07-28', '6000095277', '6601489566', 5, 'M010', 1, 'M0100020', '5(15)', 5155, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(325, '2023-07-24', '18829764', '6601483320', 18, 'M010', 1, 'M0100020', '5(15)', 81, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(326, '2023-07-24', '25339392', '6601483436', 13, 'M010', 1, 'M0100020', '5(15)', 5759, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(327, '2023-08-01', '6001664971', '6601489683', 5, 'M010', 1, 'M0100020', '5(15)', 5967, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(328, '2023-08-01', '6400331378', '6601489591', 1, 'M010', 1, 'M0100040', '15(45)', 9706, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(329, '2023-07-28', '6200764152', '6601489539', 1, 'M010', 1, 'M0100020', '5(15)', 3535, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(330, '2023-07-28', '21665702', '6601489316', 16, 'M010', 1, 'M0100020', '5(15)', 4676, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(331, '2023-07-28', '5600256479', '6601483609', 9, 'M010', 1, 'M0100020', '5(15)', 2530, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(332, '2023-07-24', '6000930199', '6601483273', 4, 'M010', 1, 'M0100020', '5(15)', 154, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(333, '2023-07-28', '19407242', '6601483539', 18, 'M010', 1, 'M0100020', '5(15)', 219, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(334, '2023-07-24', '24075337', '6601483275', 14, 'M010', 1, 'M0100020', '5(15)', 407, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(335, '2023-07-28', '6200236085', '6601483548', 3, 'M010', 1, 'M0100020', '5(15)', 4, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(336, '2023-07-28', '5700762372', '6601489556', 8, 'M010', 1, 'M0100020', '5(15)', 7750, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(337, '2023-07-28', '6000095275', '6601489568', 5, 'M010', 1, 'M0100020', '5(15)', 5767, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(338, '2023-07-24', '5901296129', '6601483434', 5, 'M010', 1, 'M0100020', '5(15)', 850, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(339, '2023-07-24', '18434863', '6601483393', 19, 'M010', 1, 'M0100020', '5(15)', 5630, '39', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(340, '2023-07-28', '18380818', '6601489582', 19, 'M010', 1, 'M0100020', '5(15)', 4080, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(341, '2023-08-01', 'C985174', '6601489339', 26, 'M010', 1, 'M0100070', '30(100)', 32911, '14', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(342, '2023-07-25', '6500110898', '6601489653', 1, 'M010', 1, 'M0100040', '15(45)', 2263, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL);
INSERT INTO `install_list` (`id`, `work_date`, `u_pea_no`, `i_pea_no`, `meter_age`, `meter_type`, `phase`, `meter_size`, `meter_size_name`, `meter_read_end`, `dispose_reason`, `route`, `area`, `worker`, `status`, `pack_code`, `transfer_code`, `date_add`, `user`, `ItemCode`, `ItemName`, `pack_status`, `message`, `prev_status`) VALUES
(343, '2023-07-24', '6200179421', '6601483418', 3, 'M010', 1, 'M0100020', '5(15)', 6092, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(344, '2023-07-28', '6200366244', '6601483394', 1, 'M010', 1, 'M0100020', '5(15)', 2521, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(345, '2023-07-24', '20399943', '6601483440', 17, 'M010', 1, 'M0100020', '5(15)', 3586, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:38', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(346, '2023-08-01', '6200367321', '6601489689', 1, 'M010', 1, 'M0100020', '5(15)', 2186, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(347, '2023-07-28', '6100895279', '6601483578', 4, 'M010', 1, 'M0100040', '15(45)', 10425, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(348, '2023-07-25', '6200236032', '6601483306', 3, 'M010', 1, 'M0100020', '5(15)', 5300, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(349, '2023-07-28', '6000360178', '6601483612', 4, 'M010', 1, 'M0100040', '15(45)', 9942, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(350, '2023-07-24', '16370925', '6601483344', 21, 'M010', 1, 'M0100020', '5(15)', 9406, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(351, '2023-07-28', '5600310626', '6601483588', 9, 'M010', 1, 'M0100020', '5(15)', 8283, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(352, '2023-08-01', '6000095251', '6601489333', 5, 'M010', 1, 'M0100020', '5(15)', 131, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(353, '2023-07-28', '6101308537', '6601489547', 3, 'M010', 1, 'M0100040', '15(45)', 1126, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(354, '2023-08-01', '6200367364', '6601489588', 1, 'M010', 1, 'M0100020', '5(15)', 2, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(355, '2023-07-24', '6300847304', '6601483460', 2, 'M010', 1, 'M0100040', '15(45)', 7647, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(356, '2023-07-24', '18381285', '6601483276', 19, 'M010', 1, 'M0100020', '5(15)', 847, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(357, '2023-07-28', '6000801434', '6601489545', 4, 'M010', 1, 'M0100020', '5(15)', 2774, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(358, '2023-07-28', '28905192', '6601489507', 10, 'M010', 1, 'M0100020', '5(15)', 6746, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(359, '2023-07-28', '19527153', '6601489542', 18, 'M010', 1, 'M0100020', '5(15)', 3980, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(360, '2023-07-25', '25147952', '6601489671', 13, 'M010', 1, 'M0100040', '15(45)', 17850, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(361, '2023-07-28', '6200236180', '6601483602', 3, 'M010', 1, 'M0100020', '5(15)', 8956, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(362, '2023-07-24', '5600256823', '6601483271', 9, 'M010', 1, 'M0100020', '5(15)', 8570, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(363, '2023-07-28', '6100170152', '6601483566', 4, 'M010', 1, 'M0100020', '5(15)', 389, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(364, '2023-08-01', '25338799', '6601489726', 13, 'M010', 1, 'M0100020', '5(15)', 7896, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(365, '2023-07-28', '5801452069', '6601489325', 7, 'M010', 1, 'M0100020', '5(15)', 5867, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(366, '2023-08-01', '6001664968', '6601489728', 5, 'M010', 1, 'M0100020', '5(15)', 4269, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(367, '2023-07-25', '6300847584', '6601483365', 2, 'M010', 1, 'M0100040', '15(45)', 12080, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(368, '2023-07-28', '6100683001', '6601489560', 4, 'M010', 1, 'M0100020', '5(15)', 462, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(369, '2023-07-28', '23861419', '6601489314', 14, 'M010', 1, 'M0100020', '5(15)', 5125, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(370, '2023-07-24', '6200366188', '6601483471', 1, 'M010', 1, 'M0100020', '5(15)', 3944, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(371, '2023-08-01', '18569857', '6601489680', 19, 'M010', 1, 'M0100040', '15(45)', 23744, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(372, '2023-08-01', '6100170952', '6601489357', 4, 'M010', 1, 'M0100020', '5(15)', 2158, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(373, '2023-07-24', '19305005', '6601483475', 18, 'M010', 1, 'M0100020', '5(15)', 2864, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(374, '2023-07-24', '5800518069', '6601483447', 7, 'M010', 1, 'M0100020', '5(15)', 893, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:39', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(375, '2023-07-25', '6200236094', '6601483267', 3, 'M010', 1, 'M0100020', '5(15)', 312, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(376, '2023-07-25', '27353146', '6601483342', 10, 'M010', 1, 'M0100040', '15(45)', 35128, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(377, '2023-07-25', '6200236034', '6601483296', 3, 'M010', 1, 'M0100020', '5(15)', 3140, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(378, '2023-07-24', '6300662224', '6601483461', 2, 'M010', 1, 'M0100040', '15(45)', 720, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(379, '2023-07-28', '6100174323', '6601483594', 4, 'M010', 1, 'M0100020', '5(15)', 2121, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(380, '2023-07-24', '18126267', '6601483364', 19, 'M010', 1, 'M0100020', '5(15)', 5984, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(381, '2023-08-01', '23691733', '6601489616', 15, 'M010', 1, 'M0100020', '5(15)', 53, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(382, '2023-07-24', '27785714', '6601489663', 11, 'M010', 1, 'M0100020', '5(15)', 1515, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(383, '2023-07-28', '6200236004', '6601489518', 3, 'M010', 1, 'M0100020', '5(15)', 6023, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(384, '2023-07-28', '27495041', '6601483544', 11, 'M010', 1, 'M0100020', '5(15)', 1622, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(385, '2023-08-01', '5801224184', '6601489326', 7, 'M010', 1, 'M0100020', '5(15)', 5924, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(386, '2023-08-01', '6001664973', '6601489686', 5, 'M010', 1, 'M0100020', '5(15)', 6176, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(387, '2023-07-28', '6200236182', '6601489324', 3, 'M010', 1, 'M0100020', '5(15)', 5470, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(388, '2023-07-24', '27631622', '6601483456', 11, 'M010', 1, 'M0100020', '5(15)', 4494, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(389, '2023-07-28', '15619596', '6601483608', 22, 'M010', 1, 'M0100020', '5(15)', 8223, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(390, '2023-08-01', '28730073', '6601489351', 10, 'M010', 1, 'M0100040', '15(45)', 22129, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(391, '2023-07-28', '6200236084', '6601483545', 3, 'M010', 1, 'M0100020', '5(15)', 2051, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(392, '2023-07-28', '5700951210', '6601483397', 7, 'M010', 1, 'M0100040', '15(45)', 19709, '55', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(393, '2023-07-28', '18793543', '6601483581', 17, 'M010', 1, 'M0100020', '5(15)', 1208, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(394, '2023-08-01', '24629674', '6601489369', 13, 'M010', 1, 'M0100020', '5(15)', 9390, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(395, '2023-08-01', '6000095258', '6601489608', 5, 'M010', 1, 'M0100020', '5(15)', 1931, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(396, '2023-08-01', '19304997', '6601489377', 18, 'M010', 1, 'M0100020', '5(15)', 5825, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(397, '2023-07-28', '6201028521', '6601483573', 3, 'M010', 1, 'M0100020', '5(15)', 2472, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(398, '2023-07-28', '5801451922', '6601489526', 7, 'M010', 1, 'M0100020', '5(15)', 977, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(399, '2023-07-24', '6300815658', '6601483445', 2, 'M010', 1, 'M0100040', '15(45)', 912, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(400, '2023-07-28', '28905193', '6601483559', 10, 'M010', 1, 'M0100020', '5(15)', 2570, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(401, '2023-07-28', '6200236146', '6601483596', 3, 'M010', 1, 'M0100020', '5(15)', 5599, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(402, '2023-07-25', '6200236031', '6601483310', 3, 'M010', 1, 'M0100020', '5(15)', 7262, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(403, '2023-08-01', '22334444', '6601489634', 15, 'M010', 1, 'M0100020', '5(15)', 4706, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:40', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(404, '2023-08-01', '25338794', '6601489678', 13, 'M010', 1, 'M0100020', '5(15)', 3964, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(405, '2023-07-24', '5800915194', '6601489646', 6, 'M010', 1, 'M0100020', '5(15)', 7544, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(406, '2023-08-01', '23691728', '6601489356', 15, 'M010', 1, 'M0100020', '5(15)', 5186, '09', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(407, '2023-07-24', '5700762740', '6601483312', 8, 'M010', 1, 'M0100020', '5(15)', 3827, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(408, '2023-08-01', '6100682680', '6601489669', 4, 'M010', 1, 'M0100020', '5(15)', 9172, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(409, '2023-07-24', '19555512', '6601483446', 18, 'M010', 1, 'M0100020', '5(15)', 5982, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(410, '2023-07-24', '21152138', '6601483431', 16, 'M010', 1, 'M0100020', '5(15)', 1364, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(411, '2023-07-24', '5801452049', '6601483494', 6, 'M010', 1, 'M0100020', '5(15)', 6424, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(412, '2023-08-01', '5801222940', '6601489373', 7, 'M010', 1, 'M0100020', '5(15)', 1126, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(413, '2023-07-28', '22198327', '6601489536', 16, 'M010', 1, 'M0100020', '5(15)', 112, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(414, '2023-07-24', '6100710292', '6601489639', 4, 'M010', 1, 'M0100020', '5(15)', 6920, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(415, '2023-07-24', '6200236001', '6601483314', 3, 'M010', 1, 'M0100020', '5(15)', 725, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(416, '2023-07-24', '23691037', '6601483435', 15, 'M010', 1, 'M0100020', '5(15)', 8031, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(417, '2023-07-24', '6200367861', '6601483444', 1, 'M010', 1, 'M0100020', '5(15)', 2404, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(418, '2023-07-24', '6201030071', '6601483476', 2, 'M010', 1, 'M0100020', '5(15)', 5081, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(419, '2023-08-01', '6001664967', '6601489700', 5, 'M010', 1, 'M0100020', '5(15)', 4725, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(420, '2023-07-24', '16684627', '6601483392', 20, 'M010', 1, 'M0100020', '5(15)', 5658, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(421, '2023-07-28', '6200236153', '6601489315', 3, 'M010', 1, 'M0100020', '5(15)', 5805, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(422, '2023-07-24', '5900631812', '6601483355', 6, 'M010', 1, 'M0100020', '5(15)', 6715, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(423, '2023-07-24', '6100169876', '6601483322', 4, 'M010', 1, 'M0100020', '5(15)', 5274, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(424, '2023-08-01', '19719960', '6601489607', 18, 'M010', 1, 'M0100020', '5(15)', 9385, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(425, '2023-07-28', '6200555416', '6601489524', 0, 'M010', 1, 'M0100020', '5(15)', 428, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(426, '2023-07-28', '5700762340', '6601489534', 8, 'M010', 1, 'M0100020', '5(15)', 4291, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(427, '2023-07-28', '6200236144', '6601483552', 3, 'M010', 1, 'M0100020', '5(15)', 4441, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(428, '2023-08-01', '6201029479', '6601489595', 3, 'M010', 1, 'M0100020', '5(15)', 1577, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(429, '2023-07-28', '6200236149', '6601489551', 3, 'M010', 1, 'M0100020', '5(15)', 37, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(430, '2023-07-28', '22960802', '6601489527', 15, 'M010', 1, 'M0100040', '15(45)', 36755, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(431, '2023-07-24', '18681882', '6601483268', 19, 'M010', 1, 'M0100020', '5(15)', 2939, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(432, '2023-07-24', '16495776', '6601483316', 21, 'M010', 1, 'M0100020', '5(15)', 7509, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:41', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(433, '2023-07-24', '6000927896', '6601489664', 4, 'M010', 1, 'M0100020', '5(15)', 1058, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(434, '2023-08-01', '6100170954', '6601489346', 4, 'M010', 1, 'M0100020', '5(15)', 1007, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(435, '2023-08-01', '16928059', '6601489592', 20, 'M010', 1, 'M0100020', '5(15)', 849, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(436, '2023-07-24', '6100710293', '6601483291', 4, 'M010', 1, 'M0100020', '5(15)', 7674, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(437, '2023-07-28', '19719947', '6601489503', 18, 'M010', 1, 'M0100020', '5(15)', 8920, '55', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(438, '2023-08-01', '6200180750', '6601489366', 3, 'M010', 1, 'M0100020', '5(15)', 5934, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(439, '2023-07-24', '16928087', '6601483468', 20, 'M010', 1, 'M0100020', '5(15)', 4389, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(440, '2023-08-01', '6000095250', '6601489332', 5, 'M010', 1, 'M0100020', '5(15)', 7682, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(441, '2023-07-24', '25338899', '6601483490', 13, 'M010', 1, 'M0100020', '5(15)', 2328, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(442, '2023-07-24', '20072427', '6601483264', 17, 'M010', 1, 'M0100020', '5(15)', 9793, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(443, '2023-07-24', '6300816367', '6601483426', 2, 'M010', 1, 'M0100040', '15(45)', 740, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(444, '2023-07-28', '6000095278', '6601489575', 5, 'M010', 1, 'M0100020', '5(15)', 3842, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(445, '2023-08-01', '6200559542', '6601489354', 1, 'M010', 1, 'M0100020', '5(15)', 275, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(446, '2023-07-28', '5900492996', '6601489573', 6, 'M010', 1, 'M0100020', '5(15)', 7705, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(447, '2023-07-28', '16238501', '6601489555', 20, 'M010', 1, 'M0100020', '5(15)', 5796, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(448, '2023-07-28', '5600310625', '6601483574', 9, 'M010', 1, 'M0100020', '5(15)', 8257, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(449, '2023-07-24', '28905414', '6601483307', 10, 'M010', 1, 'M0100020', '5(15)', 5392, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(450, '2023-07-28', '5801224191', '6601483617', 7, 'M010', 1, 'M0100020', '5(15)', 7226, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(451, '2023-07-28', '6100170147', '6601489319', 4, 'M010', 1, 'M0100020', '5(15)', 2450, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(452, '2023-07-28', '6000800450', '6601489583', 4, 'M010', 1, 'M0100020', '5(15)', 990, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(453, '2023-07-25', '6200236073', '6601489651', 3, 'M010', 1, 'M0100020', '5(15)', 2247, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(454, '2023-07-25', '6300847338', '6601483282', 2, 'M010', 1, 'M0100040', '15(45)', 8434, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(455, '2023-07-28', '6000369754', '6601489523', 5, 'M010', 1, 'M0100040', '15(45)', 158, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(456, '2023-08-01', '6300978365', '6601489635', 2, 'M010', 1, 'M0100040', '15(45)', 4416, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(457, '2023-07-24', '6200179420', '6601483487', 3, 'M010', 1, 'M0100020', '5(15)', 4054, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(458, '2023-08-01', '5901296098', '6601489691', 5, 'M010', 1, 'M0100020', '5(15)', 4597, '55', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(459, '2023-08-01', 'C477269', '6601489695', 27, 'M010', 1, 'M0100040', '15(45)', 53496, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(460, '2023-07-24', '5901137444', '6601483428', 6, 'M010', 1, 'M0100020', '5(15)', 19, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(461, '2023-07-28', '5900113018', '6601489581', 5, 'M010', 1, 'M0100040', '15(45)', 5289, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(462, '2023-08-01', '6001664966', '6601489719', 5, 'M010', 1, 'M0100020', '5(15)', 7603, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:42', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(463, '2023-08-01', '6100170933', '6601489618', 4, 'M010', 1, 'M0100020', '5(15)', 2949, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(464, '2023-08-01', '6300662200', '6601489353', 2, 'M010', 1, 'M0100040', '15(45)', 47, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(465, '2023-07-24', '21289713', '6601483327', 16, 'M010', 1, 'M0100020', '5(15)', 9191, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(466, '2023-07-28', '5700762308', '6601483585', 8, 'M010', 1, 'M0100020', '5(15)', 17, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(467, '2023-07-24', '23554663', '6601483417', 14, 'M010', 1, 'M0100020', '5(15)', 4021, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(468, '2023-07-25', '6101100207', '6601483298', 3, 'M010', 1, 'M0100040', '15(45)', 18732, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(469, '2023-08-01', '18791692', '6601489371', 19, 'M010', 1, 'M0100020', '5(15)', 4362, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(470, '2023-07-28', '6001665911', '6601483570', 4, 'M010', 1, 'M0100020', '5(15)', 1882, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(471, '2023-07-24', '21289689', '6601483477', 16, 'M010', 1, 'M0100020', '5(15)', 5247, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(472, '2023-07-28', '6000095276', '6601489567', 5, 'M010', 1, 'M0100020', '5(15)', 8792, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(473, '2023-07-28', '6100170138', '6601489578', 4, 'M010', 1, 'M0100020', '5(15)', 1808, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(474, '2023-08-01', '16887299', '6601489659', 20, 'M010', 1, 'M0100020', '5(15)', 5552, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(475, '2023-07-24', '20446594', '6601483433', 17, 'M010', 1, 'M0100020', '5(15)', 799, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(476, '2023-07-24', '16928047', '6601483452', 20, 'M010', 1, 'M0100020', '5(15)', 4240, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(477, '2023-07-24', '5801222926', '6601483481', 7, 'M010', 1, 'M0100020', '5(15)', 7706, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(478, '2023-08-01', '6001665962', '6601489693', 4, 'M010', 1, 'M0100020', '5(15)', 6123, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(479, '2023-08-01', '28487869', '6601489334', 10, 'M010', 1, 'M0100040', '15(45)', 92034, '13', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(480, '2023-07-28', '28730106', '6601483498', 10, 'M010', 1, 'M0100040', '15(45)', 37094, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(481, '2023-07-24', '5900630530', '6601483357', 6, 'M010', 1, 'M0100020', '5(15)', 1522, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(482, '2023-07-28', '6100170150', '6601483598', 4, 'M010', 1, 'M0100020', '5(15)', 5423, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(483, '2023-08-01', '23410834', '6601489345', 15, 'M010', 1, 'M0100040', '15(45)', 41478, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(484, '2023-07-28', '28902532', '6601483531', 10, 'M010', 1, 'M0100020', '5(15)', 9927, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(485, '2023-07-24', '5901296130', '6601483424', 5, 'M010', 1, 'M0100020', '5(15)', 6706, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(486, '2023-08-01', '25338792', '6601489698', 13, 'M010', 1, 'M0100020', '5(15)', 8654, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(487, '2023-07-28', '28733674', '6601489572', 10, 'M010', 1, 'M0100040', '15(45)', 44313, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(488, '2023-07-24', '21665654', '6601483356', 16, 'M010', 1, 'M0100020', '5(15)', 3156, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(489, '2023-08-01', '6001083032', '6601489696', 5, 'M010', 1, 'M0100020', '5(15)', 2689, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(490, '2023-07-28', '20356286', '6601489505', 16, 'M010', 1, 'M0100040', '15(45)', 2389, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(491, '2023-07-24', '6000096208', '6601483368', 5, 'M010', 1, 'M0100020', '5(15)', 535, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:43', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(492, '2023-07-24', '19738936', '6601483412', 18, 'M010', 1, 'M0100020', '5(15)', 848, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(493, '2023-07-28', '5701539385', '6601489561', 8, 'M010', 1, 'M0100020', '5(15)', 8918, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(494, '2023-08-01', '6000095253', '6601489331', 5, 'M010', 1, 'M0100020', '5(15)', 2943, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(495, '2023-07-24', '18381289', '6601483380', 19, 'M010', 1, 'M0100020', '5(15)', 1413, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(496, '2023-08-01', '6100778045', '6601489610', 4, 'M010', 1, 'M0100020', '5(15)', 1338, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(497, '2023-07-24', '5901137436', '6601483425', 6, 'M010', 1, 'M0100020', '5(15)', 8543, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(498, '2023-07-28', '6000930094', '6601483537', 4, 'M010', 1, 'M0100020', '5(15)', 6632, '15', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(499, '2023-07-28', '6200179153', '6601483561', 3, 'M010', 1, 'M0100020', '5(15)', 2, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(500, '2023-08-01', '18126264', '6601489363', 19, 'M010', 1, 'M0100020', '5(15)', 3035, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(501, '2023-08-01', '19623118', '6601489370', 18, 'M010', 1, 'M0100040', '15(45)', 60912, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(502, '2023-07-28', '6100170109', '6601483606', 4, 'M010', 1, 'M0100020', '5(15)', 3016, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(503, '2023-07-28', '6000801437', '6601483605', 4, 'M010', 1, 'M0100020', '5(15)', 1514, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(504, '2023-08-01', '6200367299', '6601489621', 1, 'M010', 1, 'M0100020', '5(15)', 662, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(505, '2023-07-28', '6001665929', '6601489565', 5, 'M010', 1, 'M0100020', '5(15)', 3050, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(506, '2023-08-01', '25338797', '6601489703', 13, 'M010', 1, 'M0100020', '5(15)', 767, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(507, '2023-08-01', '24472180', '6601489362', 14, 'M010', 1, 'M0100020', '5(15)', 2135, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(508, '2023-07-28', '5900630501', '6601483571', 6, 'M010', 1, 'M0100020', '5(15)', 2, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(509, '2023-07-28', '5600256491', '6601489520', 9, 'M010', 1, 'M0100020', '5(15)', 4377, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(510, '2023-07-24', '16928498', '6601483349', 20, 'M010', 1, 'M0100020', '5(15)', 2495, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(511, '2023-07-24', '6000801346', '6601489650', 4, 'M010', 1, 'M0100020', '5(15)', 8814, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(512, '2023-08-01', '23691740', '6601489605', 15, 'M010', 1, 'M0100020', '5(15)', 1387, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(513, '2023-08-01', '5800915123', '6601489723', 6, 'M010', 1, 'M0100020', '5(15)', 3565, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL);
INSERT INTO `install_list` (`id`, `work_date`, `u_pea_no`, `i_pea_no`, `meter_age`, `meter_type`, `phase`, `meter_size`, `meter_size_name`, `meter_read_end`, `dispose_reason`, `route`, `area`, `worker`, `status`, `pack_code`, `transfer_code`, `date_add`, `user`, `ItemCode`, `ItemName`, `pack_status`, `message`, `prev_status`) VALUES
(514, '2023-07-28', '6300662115', '6601483522', 2, 'M010', 1, 'M0100040', '15(45)', 1339, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(515, '2023-07-28', '25339386', '6601489548', 13, 'M010', 1, 'M0100020', '5(15)', 3065, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(516, '2023-07-28', '20220984', '6601483501', 17, 'M010', 1, 'M0100020', '5(15)', 7954, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(517, '2023-07-25', '28537047', '6601483297', 9, 'M010', 1, 'M0100040', '15(45)', 681, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(518, '2023-07-28', '18829834', '6601483541', 18, 'M010', 1, 'M0100020', '5(15)', 9358, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:44', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(519, '2023-07-24', '23904936', '6601483353', 14, 'M010', 1, 'M0100020', '5(15)', 134, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(520, '2023-07-24', '25337488', '6601483302', 13, 'M010', 1, 'M0100020', '5(15)', 5242, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(521, '2023-07-28', '6100170143', '6601489511', 4, 'M010', 1, 'M0100020', '5(15)', 353, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(522, '2023-08-01', '5901296099', '6601489694', 5, 'M010', 1, 'M0100020', '5(15)', 1477, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(523, '2023-07-24', '5901060282', '6601483451', 5, 'M010', 1, 'M0100020', '5(15)', 7456, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(524, '2023-07-24', '25337481', '6601483352', 13, 'M010', 1, 'M0100020', '5(15)', 5432, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(525, '2023-07-28', '26319601', '6601483610', 12, 'M010', 1, 'M0100020', '5(15)', 444, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(526, '2023-07-28', '6100170137', '6601489528', 4, 'M010', 1, 'M0100020', '5(15)', 2023, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(527, '2023-08-01', '5700951218', '6601489361', 7, 'M010', 1, 'M0100040', '15(45)', 3306, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(528, '2023-07-24', '6200367931', '6601483402', 1, 'M010', 1, 'M0100020', '5(15)', 3, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(529, '2023-07-25', '6200764159', '6601489622', 1, 'M010', 1, 'M0100020', '5(15)', 939, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(530, '2023-07-24', '5700762644', '6601483463', 8, 'M010', 1, 'M0100020', '5(15)', 7342, '16', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(531, '2023-07-24', '5700531170', '6601483340', 8, 'M010', 1, 'M0100020', '5(15)', 4028, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(532, '2023-08-01', '22797973', '6601489586', 15, 'M010', 1, 'M0100020', '5(15)', 8146, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(533, '2023-08-01', '6000095257', '6601489598', 5, 'M010', 1, 'M0100020', '5(15)', 3794, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(534, '2023-07-28', '19527160', '6601489562', 18, 'M010', 1, 'M0100020', '5(15)', 3624, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(535, '2023-07-28', '15100941', '6601483580', 24, 'M010', 1, 'M0100020', '5(15)', 3190, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(536, '2023-07-28', '6100170144', '6601489513', 4, 'M010', 1, 'M0100020', '5(15)', 9078, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(537, '2023-07-28', '23691758', '6601483534', 15, 'M010', 1, 'M0100020', '5(15)', 1948, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(538, '2023-08-01', '22249532', '6601489364', 16, 'M010', 1, 'M0100020', '5(15)', 2092, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(539, '2023-07-25', '6200237336', '6601489627', 3, 'M010', 1, 'M0100020', '5(15)', 386, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(540, '2023-07-24', '5900631821', '6601483376', 6, 'M010', 1, 'M0100020', '5(15)', 2029, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(541, '2023-07-28', '6200179152', '6601483547', 3, 'M010', 1, 'M0100020', '5(15)', 6368, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(542, '2023-07-28', '6100170141', '6601489553', 4, 'M010', 1, 'M0100020', '5(15)', 2850, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(543, '2023-08-01', '6000801377', '6601489352', 4, 'M010', 1, 'M0100020', '5(15)', 411, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(544, '2023-08-01', '19719962', '6601489619', 18, 'M010', 1, 'M0100020', '5(15)', 6413, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(545, '2023-08-01', '23904885', '6601489596', 14, 'M010', 1, 'M0100020', '5(15)', 7183, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(546, '2023-07-28', '6200236005', '6601489512', 3, 'M010', 1, 'M0100020', '5(15)', 3572, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(547, '2023-07-24', '5801454456', '6601483414', 6, 'M010', 1, 'M0100020', '5(15)', 3947, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(548, '2023-07-25', '6200236074', '6601489670', 3, 'M010', 1, 'M0100020', '5(15)', 3794, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(549, '2023-07-24', '20750225', '6601483290', 17, 'M010', 1, 'M0100020', '5(15)', 6466, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:45', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(550, '2023-07-28', '26716191', '6601483569', 12, 'M010', 1, 'M0100020', '5(15)', 5991, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(551, '2023-07-28', '5600256492', '6601489516', 9, 'M010', 1, 'M0100020', '5(15)', 4764, '55', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(552, '2023-07-28', '5600256468', '6601483567', 9, 'M010', 1, 'M0100020', '5(15)', 7727, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(553, '2023-07-24', '5600256386', '6601489658', 9, 'M010', 1, 'M0100020', '5(15)', 6039, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(554, '2023-07-28', '28167215', '6601489549', 11, 'M010', 1, 'M0100020', '5(15)', 550, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(555, '2023-07-28', '19378279', '6601483613', 18, 'M010', 1, 'M0100020', '5(15)', 5107, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(556, '2023-07-24', '28537092', '6601483432', 9, 'M010', 1, 'M0100040', '15(45)', 18416, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(557, '2023-07-28', '6200236181', '6601489323', 3, 'M010', 1, 'M0100020', '5(15)', 8190, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(558, '2023-07-25', '6200236071', '6601489640', 3, 'M010', 1, 'M0100020', '5(15)', 1881, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(559, '2023-07-28', '19527158', '6601483597', 18, 'M010', 1, 'M0100020', '5(15)', 685, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(560, '2023-07-24', '29610142', '6601483362', 10, 'M010', 1, 'M0100020', '5(15)', 4762, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(561, '2023-08-01', '18990789', '6601489600', 18, 'M010', 1, 'M0100020', '5(15)', 2947, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(562, '2023-07-28', '5801453321', '6601483533', 6, 'M010', 1, 'M0100020', '5(15)', 3, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(563, '2023-07-24', '22797948', '6601483421', 15, 'M010', 1, 'M0100020', '5(15)', 4223, '55', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(564, '2023-07-25', '6200237411', '6601483281', 3, 'M010', 1, 'M0100020', '5(15)', 1705, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(565, '2023-07-28', '6200236191', '6601489533', 3, 'M010', 1, 'M0100020', '5(15)', 2318, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(566, '2023-08-01', '6000095294', '6601489682', 5, 'M010', 1, 'M0100020', '5(15)', 8553, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(567, '2023-07-28', '28733688', '6601483493', 10, 'M010', 1, 'M0100040', '15(45)', 46516, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(568, '2023-07-24', '25337478', '6601489625', 13, 'M010', 1, 'M0100020', '5(15)', 396, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(569, '2023-07-24', '5801452001', '6601483313', 7, 'M010', 1, 'M0100020', '5(15)', 2261, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(570, '2023-07-24', '6100710291', '6601489657', 4, 'M010', 1, 'M0100020', '5(15)', 3708, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(571, '2023-07-28', '6300815674', '6601483395', 2, 'M010', 1, 'M0100040', '15(45)', 3071, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(572, '2023-07-24', '5700855203', '6601483469', 8, 'M010', 1, 'M0100020', '5(15)', 754, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(573, '2023-07-28', '5901295293', '6601483555', 5, 'M010', 1, 'M0100020', '5(15)', 2867, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(574, '2023-07-28', '5901295291', '6601483556', 5, 'M010', 1, 'M0100020', '5(15)', 3152, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(575, '2023-07-28', '18791673', '6601489506', 19, 'M010', 1, 'M0100020', '5(15)', 7572, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(576, '2023-07-24', '19304987', '6601483466', 18, 'M010', 1, 'M0100020', '5(15)', 1215, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(577, '2023-07-28', '6200236086', '6601483618', 3, 'M010', 1, 'M0100020', '5(15)', 2526, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(578, '2023-07-28', '5600256480', '6601489554', 9, 'M010', 1, 'M0100020', '5(15)', 402, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(579, '2023-07-28', '5801454813', '6601483583', 6, 'M010', 1, 'M0100020', '5(15)', 547, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(580, '2023-08-01', '6100170955', '6601489344', 4, 'M010', 1, 'M0100020', '5(15)', 5447, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:46', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(581, '2023-08-01', '16370431', '6601489342', 21, 'M010', 1, 'M0100020', '5(15)', 8771, '13', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(582, '2023-07-24', '16349719', '6601489623', 21, 'M010', 1, 'M0100020', '5(15)', 3226, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(583, '2023-07-24', '5901060286', '6601483343', 5, 'M010', 1, 'M0100020', '5(15)', 1085, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(584, '2023-08-01', '6001665036', '6601489687', 5, 'M010', 1, 'M0100020', '5(15)', 75, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(585, '2023-07-24', '21555362', '6601483285', 17, 'M010', 1, 'M0100020', '5(15)', 9090, '03', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(586, '2023-07-28', '6101100233', '6601483553', 3, 'M010', 1, 'M0100040', '15(45)', 13757, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(587, '2023-07-25', '28733607', '6601483335', 10, 'M010', 1, 'M0100040', '15(45)', 33633, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(588, '2023-07-24', '6201086267', '6601483441', 2, 'M010', 1, 'M0100020', '5(15)', 3166, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(589, '2023-07-24', '22384213', '6601483386', 15, 'M010', 1, 'M0100020', '5(15)', 101, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(590, '2023-07-28', '6500115431', '6601483499', 1, 'M010', 1, 'M0100040', '15(45)', 13251, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(591, '2023-07-24', '6200179394', '6601483491', 3, 'M010', 1, 'M0100020', '5(15)', 7856, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(592, '2023-07-25', '5900083364', '6601489652', 6, 'M010', 1, 'M0100040', '15(45)', 15840, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(593, '2023-08-01', '6001664972', '6601489688', 5, 'M010', 1, 'M0100020', '5(15)', 1975, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(594, '2023-07-28', '6000095279', '6601489574', 5, 'M010', 1, 'M0100020', '5(15)', 8614, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(595, '2023-07-28', '6500115448', '6601483496', 1, 'M010', 1, 'M0100040', '15(45)', 4289, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(596, '2023-08-01', '21176599', '6601489737', 17, 'M010', 1, 'M0100020', '5(15)', 1608, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(597, '2023-07-24', '6200180660', '6601483265', 3, 'M010', 1, 'M0100020', '5(15)', 7920, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(598, '2023-07-25', '6300455769', '6601483305', 3, 'M010', 1, 'M0100040', '15(45)', 330, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(599, '2023-08-01', '6100170931', '6601489612', 4, 'M010', 1, 'M0100020', '5(15)', 4600, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(600, '2023-07-28', '6100170148', '6601489320', 4, 'M010', 1, 'M0100020', '5(15)', 2180, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(601, '2023-07-28', '6000800484', '6601483525', 4, 'M010', 1, 'M0100020', '5(15)', 7004, '55', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(602, '2023-07-25', '6000360109', '6601483304', 5, 'M010', 1, 'M0100040', '15(45)', 24713, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(603, '2023-07-28', '6300978383', '6601483538', 2, 'M010', 1, 'M0100040', '15(45)', 1317, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(604, '2023-08-01', '24225028', '6601489672', 14, 'M010', 1, 'M0100040', '15(45)', 74667, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(605, '2023-07-24', '16928518', '6601483454', 20, 'M010', 1, 'M0100020', '5(15)', 3482, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(606, '2023-07-28', '6100895250', '6601489538', 4, 'M010', 1, 'M0100040', '15(45)', 10587, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:47', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(607, '2023-07-24', '26716266', '6601483465', 12, 'M010', 1, 'M0100020', '5(15)', 4292, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(608, '2023-07-28', '6000360180', '6601483542', 4, 'M010', 1, 'M0100040', '15(45)', 29808, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(609, '2023-07-24', '18681881', '6601483308', 19, 'M010', 1, 'M0100020', '5(15)', 4660, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(610, '2023-07-24', '5800915193', '6601483324', 6, 'M010', 1, 'M0100020', '5(15)', 2390, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(611, '2023-07-24', '5800517986', '6601483405', 7, 'M010', 1, 'M0100020', '5(15)', 451, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(612, '2023-07-28', '17482230', '6601489537', 20, 'M010', 1, 'M0100020', '5(15)', 1851, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(613, '2023-07-24', '6201030045', '6601483483', 2, 'M010', 1, 'M0100020', '5(15)', 4224, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(614, '2023-07-28', '5901295308', '6601483546', 5, 'M010', 1, 'M0100020', '5(15)', 3718, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(615, '2023-07-24', '5800422657', '6601483406', 6, 'M010', 1, 'M0100040', '15(45)', 13003, '0', 'CCUS0331', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(616, '2023-07-28', '26318663', '6601483592', 12, 'M010', 1, 'M0100020', '5(15)', 3542, '0', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(617, '2023-08-01', '16406363', '6601489645', 21, 'M010', 1, 'M0100020', '5(15)', 9294, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(618, '2023-07-24', '5700531171', '6601489643', 8, 'M010', 1, 'M0100020', '5(15)', 1728, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(619, '2023-08-01', '16431313', '6601489614', 21, 'M010', 1, 'M0100020', '5(15)', 413, '0', 'CCUS0088', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(620, '2023-08-01', '29607982', '6601489662', 9, 'M010', 1, 'M0100020', '5(15)', 2, '0', 'CCUS0062', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(621, '2023-07-28', '6200180693', '6601483551', 3, 'M010', 1, 'M0100020', '5(15)', 3445, '13', 'CCUS0028', 'C', 'นายชนะพงษ์ พงษ์ตุ่น', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(622, '2023-07-24', '18710103', '6601483303', 19, 'M010', 1, 'M0100020', '5(15)', 1399, '0', 'CCUS0063', 'C', 'นายรัตนชัย แก้วการไถ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(623, '2023-07-25', '5901139042', '6601489213', 5, 'M010', 1, 'M0100020', '5(15)', 601, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(624, '2023-07-25', '25188838', '6601489387', 13, 'M010', 1, 'M0100040', '15(45)', 20856, '09', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(625, '2023-07-25', '6300815747', '6601489154', 2, 'M010', 1, 'M0100040', '15(45)', 5672, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(626, '2023-07-24', '16370418', '6601489165', 21, 'M010', 1, 'M0100020', '5(15)', 8663, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(627, '2023-07-30', '23691746', '6601489405', 15, 'M010', 1, 'M0100020', '5(15)', 2674, '55', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(628, '2023-07-25', '6001082582', '6601489250', 5, 'M010', 1, 'M0100020', '5(15)', 9667, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(629, '2023-07-25', '6200179192', '6601482997', 3, 'M010', 1, 'M0100020', '5(15)', 6483, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(630, '2023-07-24', '5901059941', '6601483226', 5, 'M010', 1, 'M0100020', '5(15)', 7545, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(631, '2023-07-24', '25337578', '6601483133', 13, 'M010', 1, 'M0100020', '5(15)', 3468, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(632, '2023-07-25', '28730670', '6601489221', 9, 'M010', 1, 'M0100040', '15(45)', 27774, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(633, '2023-07-24', '29583016', '6601489392', 9, 'M010', 1, 'M0100020', '5(15)', 1725, '09', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(634, '2023-07-25', '6000801407', '6601489191', 4, 'M010', 1, 'M0100020', '5(15)', 843, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(635, '2023-07-25', '6001082597', '6601489222', 5, 'M010', 1, 'M0100020', '5(15)', 1094, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:48', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(636, '2023-07-24', '21152122', '6601489256', 16, 'M010', 1, 'M0100020', '5(15)', 2689, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(637, '2023-07-30', '18710113', '6601489447', 19, 'M010', 1, 'M0100020', '5(15)', 9071, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(638, '2023-07-30', '17511541', '6601489394', 19, 'M010', 1, 'M0100020', '5(15)', 7843, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(639, '2023-07-24', '5700396421', '6601483514', 8, 'M010', 1, 'M0100020', '5(15)', 8149, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(640, '2023-07-24', '6100669597', '6601483178', 3, 'M010', 1, 'M0100020', '5(15)', 1828, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(641, '2023-07-24', '16449466', '6601483090', 21, 'M010', 1, 'M0100020', '5(15)', 3192, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(642, '2023-07-24', '15893333', '6601483070', 18, 'M010', 1, 'M0100020', '5(15)', 6907, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(643, '2023-07-24', '6001083086', '6601483244', 5, 'M010', 1, 'M0100020', '5(15)', 6034, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(644, '2023-07-24', '21290458', '6601483504', 16, 'M010', 1, 'M0100020', '5(15)', 8419, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(645, '2023-07-25', '6100669480', '6601483009', 3, 'M010', 1, 'M0100020', '5(15)', 4869, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(646, '2023-07-25', '17541495', '6601483109', 20, 'M010', 1, 'M0100040', '15(45)', 87498, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(647, '2023-07-25', '6000096216', '6601483022', 5, 'M010', 1, 'M0100020', '5(15)', 7507, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(648, '2023-07-30', '19865298', '6601489479', 18, 'M010', 1, 'M0100020', '5(15)', 7578, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(649, '2023-07-25', '6001082590', '6601489249', 5, 'M010', 1, 'M0100020', '5(15)', 5801, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(650, '2023-07-25', '6100169999', '6601482912', 4, 'M010', 1, 'M0100020', '5(15)', 332, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(651, '2023-07-25', '6200557628', '6601483008', 0, 'M010', 1, 'M0100020', '5(15)', 2, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(652, '2023-07-25', '5901061421', '6601489212', 5, 'M010', 1, 'M0100020', '5(15)', 44, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(653, '2023-07-24', '27437889', '6601482999', 11, 'M010', 1, 'M0100020', '5(15)', 2061, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(654, '2023-07-25', '5800424046', '6601483083', 6, 'M010', 1, 'M0100040', '15(45)', 20999, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(655, '2023-07-30', '14674976', '6601489444', 24, 'M010', 1, 'M0100020', '5(15)', 1278, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(656, '2023-07-24', '22090488', '6601483006', 16, 'M010', 1, 'M0100020', '5(15)', 6183, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(657, '2023-07-25', '6001083026', '6601489211', 5, 'M010', 1, 'M0100020', '5(15)', 889, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(658, '2023-07-30', '20446605', '6601489437', 17, 'M010', 1, 'M0100020', '5(15)', 9543, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(659, '2023-07-25', '6100669540', '6601489297', 3, 'M010', 1, 'M0100020', '5(15)', 8354, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(660, '2023-08-01', '6200764180', '6601489313', 1, 'M010', 1, 'M0100020', '5(15)', 193, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(661, '2023-07-24', '27785764', '6601482956', 11, 'M010', 1, 'M0100020', '5(15)', 4963, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(662, '2023-07-24', '24075305', '6601489229', 14, 'M010', 1, 'M0100020', '5(15)', 3871, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(663, '2023-07-25', '6200764118', '6601489240', 1, 'M010', 1, 'M0100020', '5(15)', 1088, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(664, '2023-08-01', '6100710247', '6601489277', 4, 'M010', 1, 'M0100020', '5(15)', 3427, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:49', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(665, '2023-07-25', '6200764148', '6601489235', 1, 'M010', 1, 'M0100020', '5(15)', 964, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(666, '2023-07-25', '6000360189', '6601482955', 4, 'M010', 1, 'M0100040', '15(45)', 13498, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(667, '2023-07-24', '23691757', '6601483509', 15, 'M010', 1, 'M0100020', '5(15)', 9119, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(668, '2023-07-25', '6200366253', '6601483119', 1, 'M010', 1, 'M0100020', '5(15)', 8543, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(669, '2023-07-30', '27246635', '6601489435', 11, 'M010', 1, 'M0100040', '15(45)', 48167, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(670, '2023-07-30', '5600256583', '6601489426', 9, 'M010', 1, 'M0100020', '5(15)', 2958, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(671, '2023-07-24', '5600310551', '6601483243', 9, 'M010', 1, 'M0100020', '5(15)', 9069, '10', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(672, '2023-07-24', '23691764', '6601483167', 15, 'M010', 1, 'M0100020', '5(15)', 3480, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(673, '2023-07-24', '6100669551', '6601483245', 3, 'M010', 1, 'M0100020', '5(15)', 2437, '13', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(674, '2023-07-30', '6000925164', '6601489438', 4, 'M010', 1, 'M0100020', '5(15)', 9042, '13', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(675, '2023-07-25', '6100669545', '6601482913', 3, 'M010', 1, 'M0100020', '5(15)', 4853, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(676, '2023-07-24', '27796955', '6601489393', 11, 'M010', 1, 'M0100020', '5(15)', 1964, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(677, '2023-07-25', '6100669586', '6601482945', 3, 'M010', 1, 'M0100020', '5(15)', 3661, '55', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(678, '2023-07-30', '5900083399', '6601489470', 6, 'M010', 1, 'M0100040', '15(45)', 23258, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(679, '2023-07-25', '6201030081', '6601483255', 2, 'M010', 1, 'M0100020', '5(15)', 1187, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(680, '2023-07-25', '5901060234', '6601483115', 5, 'M010', 1, 'M0100020', '5(15)', 8196, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(681, '2023-08-01', '5901059836', '6601489303', 5, 'M010', 1, 'M0100020', '5(15)', 8517, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(682, '2023-07-30', '6000925076', '6601489498', 4, 'M010', 1, 'M0100020', '5(15)', 9411, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(683, '2023-07-25', '6300978334', '6601483214', 2, 'M010', 1, 'M0100040', '15(45)', 10280, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(684, '2023-07-24', '23861451', '6601489167', 14, 'M010', 1, 'M0100020', '5(15)', 991, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL);
INSERT INTO `install_list` (`id`, `work_date`, `u_pea_no`, `i_pea_no`, `meter_age`, `meter_type`, `phase`, `meter_size`, `meter_size_name`, `meter_read_end`, `dispose_reason`, `route`, `area`, `worker`, `status`, `pack_code`, `transfer_code`, `date_add`, `user`, `ItemCode`, `ItemName`, `pack_status`, `message`, `prev_status`) VALUES
(685, '2023-07-24', '28803819', '6601482951', 10, 'M010', 1, 'M0100020', '5(15)', 1627, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(686, '2023-07-24', '16431340', '6601483002', 21, 'M010', 1, 'M0100020', '5(15)', 9983, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(687, '2023-07-30', '6201086334', '6601489395', 2, 'M010', 1, 'M0100020', '5(15)', 4, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(688, '2023-07-30', '24075341', '6601489493', 14, 'M010', 1, 'M0100020', '5(15)', 4284, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(689, '2023-07-30', '5901138349', '6601489500', 6, 'M010', 1, 'M0100020', '5(15)', 6614, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(690, '2023-07-25', '6201086264', '6601489182', 2, 'M010', 1, 'M0100020', '5(15)', 134, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(691, '2023-07-30', '27246618', '6601489453', 11, 'M010', 1, 'M0100040', '15(45)', 59203, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(692, '2023-07-30', '6200367740', '6601489406', 1, 'M010', 1, 'M0100020', '5(15)', 3731, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(693, '2023-07-25', '6100682678', '6601483111', 4, 'M010', 1, 'M0100020', '5(15)', 5073, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(694, '2023-07-24', '17683894', '6601483099', 19, 'M010', 1, 'M0100020', '5(15)', 4894, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(695, '2023-07-25', '6100175980', '6601483102', 4, 'M010', 1, 'M0100020', '5(15)', 7887, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:50', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(696, '2023-07-24', '18681891', '6601482902', 19, 'M010', 1, 'M0100020', '5(15)', 1620, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(697, '2023-07-24', '23862302', '6601489188', 14, 'M010', 1, 'M0100020', '5(15)', 7577, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(698, '2023-07-25', '6200764160', '6601483007', 1, 'M010', 1, 'M0100020', '5(15)', 715, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(699, '2023-07-25', '5800517988', '6601483055', 7, 'M010', 1, 'M0100020', '5(15)', 13, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(700, '2023-07-25', '6300847600', '6601483131', 2, 'M010', 1, 'M0100040', '15(45)', 3350, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(701, '2023-07-24', '15589276', '6601483139', 22, 'M010', 1, 'M0100020', '5(15)', 5441, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(702, '2023-07-24', '18049578', '6601483515', 20, 'M010', 1, 'M0100020', '5(15)', 7020, '07', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(703, '2023-08-01', '29608050', '6601489299', 9, 'M010', 1, 'M0100020', '5(15)', 1141, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(704, '2023-07-25', '5700762722', '6601483130', 8, 'M010', 1, 'M0100020', '5(15)', 1096, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(705, '2023-07-24', '6100778036', '6601483238', 4, 'M010', 1, 'M0100020', '5(15)', 5101, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(706, '2023-07-24', '28905361', '6601483039', 10, 'M010', 1, 'M0100020', '5(15)', 8723, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(707, '2023-07-24', '6000097395', '6601483246', 5, 'M010', 1, 'M0100020', '5(15)', 6920, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(708, '2023-07-30', '6000369815', '6601489407', 5, 'M010', 1, 'M0100040', '15(45)', 14938, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(709, '2023-07-25', '6100169887', '6601483027', 4, 'M010', 1, 'M0100020', '5(15)', 4153, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(710, '2023-07-25', '5901060232', '6601483511', 5, 'M010', 1, 'M0100020', '5(15)', 5611, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(711, '2023-07-25', '6001665898', '6601483040', 5, 'M010', 1, 'M0100020', '5(15)', 5811, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(712, '2023-07-30', '27495025', '6601489430', 11, 'M010', 1, 'M0100020', '5(15)', 1630, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(713, '2023-07-25', '5700762293', '6601483037', 8, 'M010', 1, 'M0100020', '5(15)', 992, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(714, '2023-07-25', '6200559579', '6601483165', 0, 'M010', 1, 'M0100020', '5(15)', 1260, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(715, '2023-07-24', '24075357', '6601482960', 14, 'M010', 1, 'M0100020', '5(15)', 7555, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(716, '2023-07-25', '6100683020', '6601483029', 4, 'M010', 1, 'M0100020', '5(15)', 2152, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(717, '2023-08-01', '28904699', '6601489265', 10, 'M010', 1, 'M0100020', '5(15)', 8540, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(718, '2023-07-24', '27785681', '6601483153', 11, 'M010', 1, 'M0100020', '5(15)', 9544, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(719, '2023-07-24', '28902489', '6601489195', 10, 'M010', 1, 'M0100020', '5(15)', 6563, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(720, '2023-07-24', '5600310687', '6601489146', 9, 'M010', 1, 'M0100020', '5(15)', 9063, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:51', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(721, '2023-07-24', '16928523', '6601489233', 20, 'M010', 1, 'M0100020', '5(15)', 3769, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(722, '2023-07-30', '6200367362', '6601489424', 1, 'M010', 1, 'M0100020', '5(15)', 1173, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(723, '2023-07-24', '5800989759', '6601489246', 7, 'M010', 1, 'M0100020', '5(15)', 9441, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(724, '2023-07-30', '5900630484', '6601489446', 6, 'M010', 1, 'M0100020', '5(15)', 8715, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(725, '2023-07-24', '6100669547', '6601483183', 3, 'M010', 1, 'M0100020', '5(15)', 4067, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(726, '2023-07-24', '5700762716', '6601483256', 8, 'M010', 1, 'M0100020', '5(15)', 4138, '09', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(727, '2023-07-24', '5600310577', '6601483038', 9, 'M010', 1, 'M0100020', '5(15)', 9326, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(728, '2023-07-24', '6100669595', '6601483158', 3, 'M010', 1, 'M0100020', '5(15)', 683, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(729, '2023-07-30', '18381304', '6601489410', 19, 'M010', 1, 'M0100020', '5(15)', 6862, '09', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-11 12:24:07', 'superadmin', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(730, '2023-07-24', '18829747', '6601483058', 18, 'M010', 1, 'M0100020', '5(15)', 4811, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(731, '2023-07-25', '6201085214', '6601482998', 2, 'M010', 1, 'M0100020', '5(15)', 536, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(732, '2023-07-24', '6200179218', '6601483196', 3, 'M010', 1, 'M0100020', '5(15)', 2714, '09', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(733, '2023-07-25', '5901137376', '6601489200', 6, 'M010', 1, 'M0100020', '5(15)', 185, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(734, '2023-07-25', '6400093128', '6601483081', 1, 'M010', 1, 'M0100040', '15(45)', 10812, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(735, '2023-07-24', '22198336', '6601482979', 16, 'M010', 1, 'M0100020', '5(15)', 582, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(736, '2023-07-24', '20446634', '6601489192', 17, 'M010', 1, 'M0100020', '5(15)', 8340, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(737, '2023-08-01', '5801454499', '6601489276', 6, 'M010', 1, 'M0100020', '5(15)', 6551, '22', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(738, '2023-07-25', '6000800418', '6601482991', 4, 'M010', 1, 'M0100020', '5(15)', 8276, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(739, '2023-07-24', '21289721', '6601482921', 16, 'M010', 1, 'M0100020', '5(15)', 1387, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(740, '2023-07-25', '6000369723', '6601482937', 5, 'M010', 1, 'M0100040', '15(45)', 18236, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(741, '2023-07-30', '6000925152', '6601489427', 4, 'M010', 1, 'M0100020', '5(15)', 6753, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(742, '2023-07-24', '5800915155', '6601483150', 6, 'M010', 1, 'M0100020', '5(15)', 7294, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(743, '2023-07-24', '5700398096', '6601489151', 8, 'M010', 1, 'M0100020', '5(15)', 9610, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(744, '2023-07-24', '14674979', '6601483078', 24, 'M010', 1, 'M0100020', '5(15)', 9578, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(745, '2023-07-30', '28473140', '6601489497', 10, 'M010', 1, 'M0100020', '5(15)', 987, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(746, '2023-07-24', '17512368', '6601483034', 19, 'M010', 1, 'M0100020', '5(15)', 5752, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(747, '2023-07-24', '19720198', '6601483227', 18, 'M010', 1, 'M0100020', '5(15)', 3900, '09', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(748, '2023-07-24', '6100683026', '6601483199', 3, 'M010', 1, 'M0100020', '5(15)', 1359, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(749, '2023-07-24', '24629715', '6601483229', 13, 'M010', 1, 'M0100020', '5(15)', 6547, '09', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(750, '2023-08-01', '6200179195', '6601489283', 3, 'M010', 1, 'M0100020', '5(15)', 1362, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(751, '2023-07-30', '16823489', '6601489494', 20, 'M010', 1, 'M0100020', '5(15)', 5411, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(752, '2023-07-24', '19719959', '6601483088', 18, 'M010', 1, 'M0100020', '5(15)', 8159, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:52', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(753, '2023-07-30', '28905380', '6601489434', 10, 'M010', 1, 'M0100020', '5(15)', 1125, '13', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(754, '2023-07-24', '16703499', '6601489252', 20, 'M010', 1, 'M0100020', '5(15)', 2021, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(755, '2023-07-24', '5900632791', '6601483164', 6, 'M010', 1, 'M0100020', '5(15)', 9702, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(756, '2023-07-25', '6201028556', '6601483075', 3, 'M010', 1, 'M0100020', '5(15)', 2639, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(757, '2023-07-30', '22249566', '6601489452', 16, 'M010', 1, 'M0100020', '5(15)', 3636, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(758, '2023-07-30', '5900083348', '6601489413', 6, 'M010', 1, 'M0100040', '15(45)', 22446, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(759, '2023-08-01', '26716189', '6601489275', 12, 'M010', 1, 'M0100020', '5(15)', 3999, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(760, '2023-07-25', '6000927957', '6601483135', 4, 'M010', 1, 'M0100020', '5(15)', 2819, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(761, '2023-07-25', '6000800378', '6601483094', 4, 'M010', 1, 'M0100020', '5(15)', 2953, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(762, '2023-07-24', '5700762641', '6601482982', 8, 'M010', 1, 'M0100020', '5(15)', 5084, '55', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(763, '2023-08-01', '5900085444', '6601489273', 5, 'M010', 1, 'M0100040', '15(45)', 7841, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(764, '2023-07-25', '6201083947', '6601483228', 2, 'M010', 1, 'M0100020', '5(15)', 1308, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(765, '2023-07-25', '6300708030', '6601489168', 2, 'M010', 1, 'M0100040', '15(45)', 2138, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(766, '2023-07-24', '20750244', '6601482988', 17, 'M010', 1, 'M0100020', '5(15)', 9825, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(767, '2023-07-25', '28732903', '6601489208', 9, 'M010', 1, 'M0100040', '15(45)', 18926, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(768, '2023-07-24', '18380784', '6601483025', 19, 'M010', 1, 'M0100020', '5(15)', 1, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(769, '2023-07-24', '5800915835', '6601482919', 6, 'M010', 1, 'M0100020', '5(15)', 2549, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(770, '2023-07-24', '23757892', '6601489298', 14, 'M010', 1, 'M0100020', '5(15)', 6021, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(771, '2023-07-24', '6000096160', '6601483201', 5, 'M010', 1, 'M0100020', '5(15)', 6719, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(772, '2023-07-25', '5901060279', '6601482906', 5, 'M010', 1, 'M0100020', '5(15)', 493, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(773, '2023-07-24', '26712807', '6601489170', 12, 'M010', 1, 'M0100020', '5(15)', 4348, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(774, '2023-07-25', '6200237354', '6601489150', 3, 'M010', 1, 'M0100020', '5(15)', 2791, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(775, '2023-07-30', '5901060189', '6601489475', 5, 'M010', 1, 'M0100020', '5(15)', 6875, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(776, '2023-08-01', '5801452024', '6601489311', 7, 'M010', 1, 'M0100020', '5(15)', 7443, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(777, '2023-07-25', '6000095243', '6601483123', 5, 'M010', 1, 'M0100020', '5(15)', 9351, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(778, '2023-07-30', '24315383', '6601489439', 14, 'M010', 1, 'M0100040', '15(45)', 54311, '13', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(779, '2023-07-24', '21289720', '6601482908', 16, 'M010', 1, 'M0100020', '5(15)', 4485, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(780, '2023-07-25', '6300815725', '6601483057', 2, 'M010', 1, 'M0100040', '15(45)', 3608, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(781, '2023-07-24', '28905354', '6601483046', 10, 'M010', 1, 'M0100020', '5(15)', 2573, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(782, '2023-07-24', '17121091', '6601489193', 20, 'M010', 1, 'M0100020', '5(15)', 5719, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:53', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(783, '2023-07-25', '6200763339', '6601489180', 1, 'M010', 1, 'M0100020', '5(15)', 6, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(784, '2023-07-24', '22479395', '6601483021', 15, 'M010', 1, 'M0100020', '5(15)', 1329, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(785, '2023-07-24', '18770018', '6601482907', 19, 'M010', 1, 'M0100020', '5(15)', 131, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(786, '2023-07-30', '24629718', '6601489411', 13, 'M010', 1, 'M0100020', '5(15)', 7832, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(787, '2023-07-25', '5901060235', '6601483114', 5, 'M010', 1, 'M0100020', '5(15)', 1847, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(788, '2023-07-25', '5901060233', '6601483129', 5, 'M010', 1, 'M0100020', '5(15)', 106, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(789, '2023-07-25', '6200366250', '6601482914', 1, 'M010', 1, 'M0100020', '5(15)', 2166, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(790, '2023-07-30', '6200367900', '6601489472', 1, 'M010', 1, 'M0100020', '5(15)', 2608, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(791, '2023-07-25', '5800571661', '6601483107', 7, 'M010', 1, 'M0100020', '5(15)', 3958, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(792, '2023-07-24', '5800517975', '6601489161', 7, 'M010', 1, 'M0100020', '5(15)', 6865, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(793, '2023-07-24', '16031445', '6601483116', 21, 'M010', 1, 'M0100020', '5(15)', 9999, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(794, '2023-07-24', '5700762344', '6601489236', 8, 'M010', 1, 'M0100020', '5(15)', 9770, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(795, '2023-07-25', '6300455779', '6601489152', 2, 'M010', 1, 'M0100040', '15(45)', 8102, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(796, '2023-07-25', '6000928030', '6601483060', 4, 'M010', 1, 'M0100020', '5(15)', 5506, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(797, '2023-07-24', '5700531251', '6601483502', 8, 'M010', 1, 'M0100020', '5(15)', 7260, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(798, '2023-07-24', '16431336', '6601489173', 21, 'M010', 1, 'M0100020', '5(15)', 2940, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(799, '2023-07-25', '5901059910', '6601482987', 5, 'M010', 1, 'M0100020', '5(15)', 4329, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(800, '2023-07-25', '6000095191', '6601489218', 5, 'M010', 1, 'M0100020', '5(15)', 2340, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(801, '2023-07-24', '22384650', '6601483233', 15, 'M010', 1, 'M0100020', '5(15)', 5803, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(802, '2023-07-24', '5801222930', '6601489194', 7, 'M010', 1, 'M0100020', '5(15)', 5328, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(803, '2023-07-24', '5600256616', '6601482917', 9, 'M010', 1, 'M0100020', '5(15)', 2564, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(804, '2023-08-01', '6100710243', '6601489302', 4, 'M010', 1, 'M0100020', '5(15)', 3230, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(805, '2023-07-24', '27797410', '6601482944', 11, 'M010', 1, 'M0100020', '5(15)', 2515, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(806, '2023-07-30', '23691058', '6601489488', 15, 'M010', 1, 'M0100020', '5(15)', 239, '09', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(807, '2023-07-25', '6200366286', '6601482976', 1, 'M010', 1, 'M0100020', '5(15)', 2054, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(808, '2023-07-25', '6001082600', '6601482996', 5, 'M010', 1, 'M0100020', '5(15)', 3470, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(809, '2023-07-30', '23691017', '6601489432', 15, 'M010', 1, 'M0100020', '5(15)', 2274, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(810, '2023-07-25', '6100176005', '6601489220', 4, 'M010', 1, 'M0100020', '5(15)', 3565, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(811, '2023-07-25', '5900632819', '6601489202', 6, 'M010', 1, 'M0100020', '5(15)', 3128, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:54', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(812, '2023-07-25', '6300076967', '6601489204', 3, 'M010', 1, 'M0100040', '15(45)', 9926, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(813, '2023-08-01', '5901059837', '6601489312', 5, 'M010', 1, 'M0100020', '5(15)', 799, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(814, '2023-07-25', '6000095249', '6601483065', 5, 'M010', 1, 'M0100020', '5(15)', 3315, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(815, '2023-07-24', '5700531166', '6601483136', 8, 'M010', 1, 'M0100020', '5(15)', 4955, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(816, '2023-07-24', '14838696', '6601483080', 24, 'M010', 1, 'M0100020', '5(15)', 7559, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(817, '2023-07-24', '16703559', '6601483517', 20, 'M010', 1, 'M0100020', '5(15)', 9983, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(818, '2023-07-25', '6100170029', '6601483012', 4, 'M010', 1, 'M0100020', '5(15)', 9373, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(819, '2023-07-24', '5600256814', '6601489197', 9, 'M010', 1, 'M0100020', '5(15)', 6644, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(820, '2023-07-24', '26716192', '6601483146', 12, 'M010', 1, 'M0100020', '5(15)', 7725, '09', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(821, '2023-07-24', '27504724', '6601483259', 11, 'M010', 1, 'M0100020', '5(15)', 9028, '09', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(822, '2023-07-30', '5901139047', '6601489423', 5, 'M010', 1, 'M0100020', '5(15)', 2958, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(823, '2023-07-24', '6000927849', '6601489389', 4, 'M010', 1, 'M0100020', '5(15)', 6155, '10', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(824, '2023-07-30', '5901138364', '6601489491', 6, 'M010', 1, 'M0100020', '5(15)', 8215, '13', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(825, '2023-07-25', '6300815704', '6601489163', 2, 'M010', 1, 'M0100040', '15(45)', 6581, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(826, '2023-07-24', '6100669589', '6601483206', 3, 'M010', 1, 'M0100020', '5(15)', 4785, 'Q0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(827, '2023-07-25', '6200559603', '6601489176', 0, 'M010', 1, 'M0100020', '5(15)', 1066, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(828, '2023-07-24', '28473119', '6601483112', 10, 'M010', 1, 'M0100020', '5(15)', 9361, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(829, '2023-07-25', '6100669583', '6601489231', 3, 'M010', 1, 'M0100020', '5(15)', 6164, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(830, '2023-07-30', '5901296153', '6601489495', 5, 'M010', 1, 'M0100020', '5(15)', 7556, '55', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(831, '2023-07-24', '5801454435', '6601489185', 6, 'M010', 1, 'M0100020', '5(15)', 4763, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(832, '2023-07-24', '5600310609', '6601489224', 9, 'M010', 1, 'M0100020', '5(15)', 314, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(833, '2023-07-25', '6100669543', '6601482985', 3, 'M010', 1, 'M0100020', '5(15)', 5768, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(834, '2023-07-24', '22664939', '6601483125', 15, 'M010', 1, 'M0100020', '5(15)', 1143, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(835, '2023-07-30', '6000925149', '6601489461', 4, 'M010', 1, 'M0100020', '5(15)', 4215, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(836, '2023-07-30', '6300662147', '6601489440', 2, 'M010', 1, 'M0100040', '15(45)', 11103, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(837, '2023-07-25', '6200764146', '6601489230', 1, 'M010', 1, 'M0100020', '5(15)', 4112, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(838, '2023-07-25', '6201030122', '6601483223', 2, 'M010', 1, 'M0100020', '5(15)', 2678, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(839, '2023-07-25', '5800517987', '6601483056', 7, 'M010', 1, 'M0100020', '5(15)', 6494, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(840, '2023-07-25', '6300978404', '6601482925', 2, 'M010', 1, 'M0100040', '15(45)', 4473, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(841, '2023-07-25', '6000095244', '6601483122', 5, 'M010', 1, 'M0100020', '5(15)', 5342, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(842, '2023-07-25', '6200237325', '6601489227', 3, 'M010', 1, 'M0100020', '5(15)', 1806, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(843, '2023-07-24', '6100669549', '6601483231', 3, 'M010', 1, 'M0100020', '5(15)', 3691, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:55', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(844, '2023-07-24', '5600310614', '6601489149', 9, 'M010', 1, 'M0100020', '5(15)', 7457, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(845, '2023-07-24', '17511538', '6601483216', 19, 'M010', 1, 'M0100020', '5(15)', 2761, '09', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(846, '2023-07-25', '6000930144', '6601489162', 4, 'M010', 1, 'M0100020', '5(15)', 1067, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(847, '2023-08-01', '8833640', '6601489271', 32, 'M010', 1, 'M0100020', '5(15)', 6502, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(848, '2023-07-24', '24980033', '6601483181', 13, 'M010', 1, 'M0100020', '5(15)', 4658, '09', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(849, '2023-07-30', '21152136', '6601489473', 16, 'M010', 1, 'M0100020', '5(15)', 6461, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(850, '2023-07-24', '6000095290', '6601483251', 5, 'M010', 1, 'M0100020', '5(15)', 1243, '13', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(851, '2023-07-25', '6000095247', '6601483127', 5, 'M010', 1, 'M0100020', '5(15)', 22, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(852, '2023-07-25', '6400259278', '6601489143', 1, 'M010', 1, 'M0100040', '15(45)', 3748, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(853, '2023-07-24', '23554647', '6601483241', 14, 'M010', 1, 'M0100020', '5(15)', 1239, '09', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(854, '2023-07-25', '6100682922', '6601482971', 4, 'M010', 1, 'M0100020', '5(15)', 6245, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(855, '2023-07-24', '24472170', '6601483224', 13, 'M010', 1, 'M0100020', '5(15)', 4977, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL);
INSERT INTO `install_list` (`id`, `work_date`, `u_pea_no`, `i_pea_no`, `meter_age`, `meter_type`, `phase`, `meter_size`, `meter_size_name`, `meter_read_end`, `dispose_reason`, `route`, `area`, `worker`, `status`, `pack_code`, `transfer_code`, `date_add`, `user`, `ItemCode`, `ItemName`, `pack_status`, `message`, `prev_status`) VALUES
(856, '2023-07-25', '6200180743', '6601482943', 3, 'M010', 1, 'M0100020', '5(15)', 740, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(857, '2023-07-30', '16887303', '6601489416', 20, 'M010', 1, 'M0100020', '5(15)', 5341, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(858, '2023-07-24', '26713590', '6601489244', 12, 'M010', 1, 'M0100020', '5(15)', 6757, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(859, '2023-07-25', '6000927971', '6601483086', 4, 'M010', 1, 'M0100020', '5(15)', 6522, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(860, '2023-07-24', '22798918', '6601482941', 15, 'M010', 1, 'M0100020', '5(15)', 8346, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(861, '2023-07-24', '26316578', '6601483186', 13, 'M010', 1, 'M0100020', '5(15)', 2300, '09', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(862, '2023-07-25', '5701581812', '6601483095', 7, 'M010', 1, 'M0100020', '5(15)', 2200, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(863, '2023-07-24', '6100669588', '6601483194', 3, 'M010', 1, 'M0100020', '5(15)', 5920, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(864, '2023-07-24', '6000095289', '6601483252', 5, 'M010', 1, 'M0100020', '5(15)', 2001, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(865, '2023-07-25', 'D209992', '6601482986', 23, 'M010', 1, 'M0100070', '30(100)', 26667, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(866, '2023-07-30', '15128318', '6601489482', 23, 'M010', 1, 'M0100020', '5(15)', 8094, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-11 12:24:07', 'superadmin', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(867, '2023-08-01', '6300456391', '6601489278', 2, 'M010', 1, 'M0100040', '15(45)', 3321, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(868, '2023-07-25', '6201029451', '6601482983', 3, 'M010', 1, 'M0100020', '5(15)', 939, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(869, '2023-07-25', '5801453329', '6601483063', 6, 'M010', 1, 'M0100020', '5(15)', 2281, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(870, '2023-07-25', '6100669539', '6601489268', 3, 'M010', 1, 'M0100020', '5(15)', 6984, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(871, '2023-07-24', '6100669553', '6601483250', 3, 'M010', 1, 'M0100020', '5(15)', 2880, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(872, '2023-07-25', '6000801372', '6601482970', 4, 'M010', 1, 'M0100020', '5(15)', 9761, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(873, '2023-07-25', '6100170870', '6601483042', 4, 'M010', 1, 'M0100020', '5(15)', 5575, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(874, '2023-07-30', '5901295202', '6601489478', 5, 'M010', 1, 'M0100020', '5(15)', 7752, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(875, '2023-07-30', '19719931', '6601489400', 18, 'M010', 1, 'M0100020', '5(15)', 6603, '09', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:56', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(876, '2023-07-24', '22249588', '6601483140', 16, 'M010', 1, 'M0100020', '5(15)', 3435, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(877, '2023-07-24', '5700396371', '6601483161', 8, 'M010', 1, 'M0100020', '5(15)', 2885, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(878, '2023-08-01', '5900630587', '6601489293', 6, 'M010', 1, 'M0100020', '5(15)', 9879, '0', 'CCUS0049', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(879, '2023-07-24', '6000095204', '6601483162', 5, 'M010', 1, 'M0100020', '5(15)', 6527, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(880, '2023-07-24', '16703487', '6601483171', 20, 'M010', 1, 'M0100020', '5(15)', 404, '10', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(881, '2023-07-25', '6100669578', '6601489272', 3, 'M010', 1, 'M0100020', '5(15)', 811, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(882, '2023-07-30', '24472208', '6601489458', 14, 'M010', 1, 'M0100020', '5(15)', 3164, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-11 12:24:07', 'superadmin', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(883, '2023-07-25', '6201029450', '6601489164', 3, 'M010', 1, 'M0100020', '5(15)', 3645, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(884, '2023-07-24', '16495777', '6601489261', 21, 'M010', 1, 'M0100020', '5(15)', 7525, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(885, '2023-07-25', '5901060237', '6601483518', 5, 'M010', 1, 'M0100020', '5(15)', 4380, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(886, '2023-07-25', '6300815768', '6601483073', 2, 'M010', 1, 'M0100040', '15(45)', 2217, '0', 'CCUS0039', 'C', 'นายสาธิต นำผลไพบูลย์', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(887, '2023-07-24', '26711867', '6601483207', 12, 'M010', 1, 'M0100020', '5(15)', 80, '10', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(888, '2023-07-24', '20072393', '6601489189', 17, 'M010', 1, 'M0100020', '5(15)', 3425, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(889, '2023-07-24', '22798138', '6601483014', 15, 'M010', 1, 'M0100020', '5(15)', 6632, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(890, '2023-07-25', '6201083908', '6601489228', 2, 'M010', 1, 'M0100020', '5(15)', 6113, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(891, '2023-07-24', '6100669587', '6601483198', 3, 'M010', 1, 'M0100020', '5(15)', 6182, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(892, '2023-07-30', '5700531214', '6601489474', 8, 'M010', 1, 'M0100020', '5(15)', 7404, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-11 12:24:07', 'superadmin', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(893, '2023-07-24', '5801451945', '6601483000', 7, 'M010', 1, 'M0100020', '5(15)', 3101, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(894, '2023-07-24', '6100669590', '6601483142', 3, 'M010', 1, 'M0100020', '5(15)', 5558, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(895, '2023-07-24', '25339481', '6601483157', 13, 'M010', 1, 'M0100020', '5(15)', 3171, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(896, '2023-07-25', '6200366203', '6601483235', 1, 'M010', 1, 'M0100020', '5(15)', 507, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(897, '2023-07-25', '6100170001', '6601482926', 4, 'M010', 1, 'M0100020', '5(15)', 9409, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', NULL, NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL),
(898, '2023-07-30', '27246702', '6601489396', 11, 'M010', 1, 'M0100040', '15(45)', 1184, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', 'PA-23080001', NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 1, NULL, NULL),
(899, '2023-07-30', '6000801411', '6601489421', 4, 'M010', 1, 'M0100020', '5(15)', 9403, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', 'PA-23080001', NULL, '2023-08-11 12:24:07', 'superadmin', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 1, NULL, NULL),
(900, '2023-07-25', '6201028513', '6601489156', 3, 'M010', 1, 'M0100020', '5(15)', 906, '0', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', 'PA-23080001', NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 1, NULL, NULL),
(901, '2023-07-24', '27504788', '6601483213', 11, 'M010', 1, 'M0100020', '5(15)', 9115, '0', 'CCUS0059', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', 'PA-23080001', NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 1, NULL, NULL),
(902, '2023-07-25', '6201030085', '6601482980', 2, 'M010', 1, 'M0100020', '5(15)', 5258, '13', 'CCUS0056', 'C', 'นายธนากร เกษสุวรรณ', 'O', 'PA-23080001', NULL, '2023-08-03 17:52:57', 'Administrator', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 1, NULL, NULL),
(903, '2023-07-30', '5901139043', '6601489401', 5, 'M010', 1, 'M0100020', '5(15)', 50818, '10', 'CCUS0021', 'F', 'นายธนวัฒน์ เกษสุวรรณ', 'O', 'PA-23080001', NULL, '2023-08-11 12:24:07', 'superadmin', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 1, NULL, NULL),
(904, '2023-07-30', '5901060274', '6601489499', 5, 'M010', 1, 'M0100020', '5(15)', 35, '0', 'CCUS0021', 'C', 'นายธนวัฒน์ เกษสุวรรณ', 'O', NULL, NULL, '2023-08-11 12:24:07', 'superadmin', 'FG-7-00060', 'Electronic Energy Meter  1P2W 230 V 5(100) A Bluetooth,Type ST-1EMH', 0, NULL, NULL);

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
-- Table structure for table `logs_transfer`
--

CREATE TABLE `logs_transfer` (
  `id` int(11) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `json` mediumint(9) DEFAULT NULL,
  `date_upd` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
('Manual', 'Manual', 'manual', 'SC', NULL, 1, 7, 1),
('OPISPK', 'แพ็คมิเตอร์เก่า', 'inventory/pack', 'OP', NULL, 1, 4, 1),
('OPISTL', 'รายการติดตั้งสำเร็จ', 'inventory/install_list', 'OP', NULL, 1, 1, 1),
('OPSTOCK', 'สินค้าคงเหลือ', 'inventory/stock', 'OP', NULL, 1, 4, 1),
('OPWHTR', 'โอนสินค้า', 'inventory/transfer', 'OP', NULL, 1, 1, 1),
('SCCONF', 'กำหนดค่า', 'admin/setting', 'SC', NULL, 1, 5, 1),
('SCOWHS', 'คลังสินค้า', 'admin/warehouse', 'SC', NULL, 1, 4, 1),
('SCPERM', 'กำหนดสิทธิ์', NULL, 'SC', NULL, 1, 6, 1),
('SCTEAM', 'เขต/พิ้นที่', 'admin/team', 'SC', NULL, 1, 3, 1),
('SCUSER', 'ผู้ใช้งาน', 'users/users', 'SC', NULL, 1, 2, 1);

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
-- Table structure for table `meter_phase`
--

CREATE TABLE `meter_phase` (
  `code` varchar(20) NOT NULL,
  `phase` int(1) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meter_phase`
--

INSERT INTO `meter_phase` (`code`, `phase`, `description`) VALUES
('M010', 1, '1 เฟส 2 สาย 220 โวลท์'),
('M020', 1, '1 เฟส 2 สาย 220 โวลท์ ประกอบ CT'),
('M030', 3, '3 เฟส 4 สาย 220/380 โวลท์'),
('M040', 3, '3 เฟส 3 สาย 110 โวลท์'),
('M050', 3, '3 เฟส 4 สาย 64/110 โวลท์'),
('M060', 3, '3 เฟส 4 สาย 220/380 โวลท์ ประกอบ CT');

-- --------------------------------------------------------

--
-- Table structure for table `meter_size`
--

CREATE TABLE `meter_size` (
  `code` varchar(20) NOT NULL,
  `size` varchar(20) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meter_size`
--

INSERT INTO `meter_size` (`code`, `size`, `description`) VALUES
('M0100010', '3(9)', '3(9)A'),
('M0100020', '5(15)', '5(15)A'),
('M0100030', '10(30)', '10(30)A'),
('M0100035', '10(100)', '10(100)A'),
('M0100040', '15(45)', '15(45)A'),
('M0100050', '20(40)', '20(40)A'),
('M0100055', '20(60) ', '20(60) A'),
('M0100060', '30(60)', '30(60)A'),
('M0100065', '30(90) ', '30(90) A'),
('M0100070', '30(100)', '30(100)A'),
('M0100080', '50(100)', '50(100)A'),
('M0100090', '100(150)', '100(150)A'),
('M0200010', '5(15) ', '5(15) A'),
('M0300010', '5', '5 A'),
('M0300020', '10(30) ', '10(30) A'),
('M0300025', '10(100)', '10(100)A'),
('M0300030', '15(45) ', '15(45) A'),
('M0300040', '20(40) ', '20(40) A'),
('M0300050', '30(60) ', '30(60) A'),
('M0300060', '30(100) ', '30(100) A'),
('M0300070', '50(100) ', '50(100) A'),
('M0300080', '100(150) ', '100(150) A'),
('M0400010', '1', '1 A'),
('M0400020', '5', '5 A'),
('M0500010', '5', '5 A'),
('M0600010', '5CT', '5 A with CT'),
('M0700010', '5(45)', '5(45)A'),
('M0700020', '5(100)', '5(100)A'),
('M0800020', '5(100)', '5(100)A');

-- --------------------------------------------------------

--
-- Table structure for table `pack`
--

CREATE TABLE `pack` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `team_id` int(11) NOT NULL COMMENT 'area',
  `WhsCode` varchar(8) DEFAULT NULL,
  `status` set('O','F','C','D') NOT NULL DEFAULT 'O' COMMENT 'O = Open, F = Finished,C = Closed, D = Cancelled',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_upd` datetime DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `update_user` int(11) DEFAULT NULL,
  `remark` varchar(250) DEFAULT NULL,
  `is_transfer` tinyint(1) NOT NULL DEFAULT '0',
  `transfer_code` varchar(20) DEFAULT NULL,
  `phase` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1  or 3'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pack`
--

INSERT INTO `pack` (`id`, `code`, `team_id`, `WhsCode`, `status`, `date_add`, `date_upd`, `user`, `update_user`, `remark`, `is_transfer`, `transfer_code`, `phase`) VALUES
(1, 'PA-23080001', 3, 'N3A-2', 'F', '2023-08-09 00:00:00', NULL, 29, NULL, NULL, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pack_detail`
--

CREATE TABLE `pack_detail` (
  `id` int(11) NOT NULL,
  `pack_id` int(11) NOT NULL,
  `u_pea_no` varchar(20) NOT NULL,
  `i_pea_no` varchar(20) NOT NULL,
  `work_date` date NOT NULL,
  `meter_age` int(3) NOT NULL DEFAULT '0',
  `phase` varchar(10) DEFAULT NULL,
  `meter_size` varchar(50) DEFAULT NULL,
  `meter_read_end` int(10) DEFAULT '0',
  `dispose_reason_id` varchar(2) DEFAULT '0',
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user` int(11) DEFAULT NULL,
  `dispose_reason_name` varchar(100) DEFAULT NULL,
  `is_transfer` tinyint(1) NOT NULL DEFAULT '0',
  `transfer_code` varchar(20) DEFAULT NULL,
  `status` set('O','F','C','D') NOT NULL DEFAULT 'O' COMMENT 'O = Open,\r\nF = Finished,\r\nC = Closed,\r\nD = Cancelled'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pack_detail`
--

INSERT INTO `pack_detail` (`id`, `pack_id`, `u_pea_no`, `i_pea_no`, `work_date`, `meter_age`, `phase`, `meter_size`, `meter_read_end`, `dispose_reason_id`, `date_add`, `user`, `dispose_reason_name`, `is_transfer`, `transfer_code`, `status`) VALUES
(1, 1, '5901139043', '6601489401', '2023-07-30', 5, '1', '5(15)', 50818, '10', '2023-08-09 11:12:22', 29, 'ถ.น้ำเข้า', 0, NULL, 'F'),
(2, 1, '6201030085', '6601482980', '2023-07-25', 2, '1', '5(15)', 5258, '13', '2023-08-09 11:12:58', 29, 'ถ.ปัญหาจากสกรู', 0, NULL, 'F'),
(3, 1, '27504788', '6601483213', '2023-07-24', 11, '1', '5(15)', 9115, '0', '2023-08-09 11:16:14', 29, NULL, 0, NULL, 'F'),
(4, 1, '6201028513', '6601489156', '2023-07-25', 3, '1', '5(15)', 906, '0', '2023-08-09 11:16:30', 29, NULL, 0, NULL, 'F'),
(5, 1, '6000801411', '6601489421', '2023-07-30', 4, '1', '5(15)', 9403, '0', '2023-08-09 11:18:40', 29, NULL, 0, NULL, 'F'),
(6, 1, '27246702', '6601489396', '2023-07-30', 11, '1', '15(45)', 1184, '0', '2023-08-09 11:19:02', 29, NULL, 0, NULL, 'F');

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
(205, 16, 'SCUSER', 1, 1, 1, 1, 1),
(206, 16, 'SCTEAM', 1, 1, 1, 1, 1),
(207, 16, 'SCOWHS', 1, 1, 1, 1, 1),
(208, 16, 'SCCONF', 1, 1, 1, 1, 1),
(209, 16, 'SCPERM', 1, 1, 1, 1, 1),
(210, 16, 'OPISTL', 1, 1, 1, 1, 1),
(211, 16, 'OPWHTR', 1, 1, 1, 1, 1),
(212, 16, 'OPWHRT', 1, 1, 1, 1, 1),
(213, 16, 'OPUITM', 1, 1, 1, 1, 1),
(214, 16, 'OPWHIF', 0, 0, 0, 0, 0),
(239, 14, 'SCUSER', 0, 0, 0, 0, 0),
(240, 14, 'SCTEAM', 0, 0, 0, 0, 0),
(241, 14, 'SCOWHS', 0, 0, 0, 0, 0),
(242, 14, 'SCCONF', 0, 0, 0, 0, 0),
(243, 14, 'SCPERM', 0, 0, 0, 0, 0),
(244, 14, 'OPISTL', 1, 1, 1, 1, 1),
(245, 14, 'OPWHTR', 1, 1, 1, 1, 1),
(246, 14, 'OPISPK', 1, 1, 1, 1, 1),
(247, 14, 'OPSTOCK', 1, 1, 1, 1, 1),
(257, 27, 'SCUSER', 1, 1, 1, 1, 1),
(258, 27, 'SCTEAM', 1, 1, 1, 1, 1),
(259, 27, 'SCOWHS', 1, 1, 1, 1, 1),
(260, 27, 'SCCONF', 1, 1, 1, 1, 1),
(261, 27, 'SCPERM', 1, 1, 1, 1, 1),
(262, 27, 'OPISTL', 1, 1, 1, 1, 1),
(263, 27, 'OPWHTR', 1, 1, 1, 1, 1),
(264, 27, 'OPISPK', 1, 1, 1, 1, 1),
(265, 27, 'OPSTOCK', 1, 1, 1, 1, 1),
(275, 26, 'SCUSER', 1, 1, 1, 1, 1),
(276, 26, 'SCTEAM', 1, 1, 1, 1, 1),
(277, 26, 'SCOWHS', 1, 1, 1, 1, 1),
(278, 26, 'SCCONF', 1, 1, 1, 1, 1),
(279, 26, 'SCPERM', 1, 1, 1, 1, 1),
(280, 26, 'OPISTL', 1, 1, 1, 1, 1),
(281, 26, 'OPWHTR', 1, 1, 1, 1, 1),
(282, 26, 'OPISPK', 1, 1, 1, 1, 1),
(283, 26, 'OPSTOCK', 1, 1, 1, 1, 1),
(284, 29, 'SCUSER', 0, 0, 0, 0, 0),
(285, 29, 'SCTEAM', 0, 0, 0, 0, 0),
(286, 29, 'SCOWHS', 0, 0, 0, 0, 0),
(287, 29, 'SCCONF', 0, 0, 0, 0, 0),
(288, 29, 'SCPERM', 0, 0, 0, 0, 0),
(289, 29, 'OPISTL', 1, 1, 1, 1, 1),
(290, 29, 'OPWHTR', 1, 1, 1, 1, 1),
(291, 29, 'OPISPK', 1, 1, 1, 1, 1),
(292, 29, 'OPSTOCK', 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `code` varchar(15) DEFAULT NULL,
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

INSERT INTO `team` (`id`, `code`, `name`, `status`, `create_at`, `create_by`, `update_at`, `update_by`) VALUES
(1, 'A', 'น1', 1, '2023-08-03 12:17:00', -1, NULL, NULL),
(2, 'B', 'น2', 1, '2023-08-03 12:17:40', -1, NULL, NULL),
(3, 'C', 'น3', 1, '2023-08-03 12:17:51', -1, NULL, NULL),
(4, 'D', 'ฉ1', 1, '2023-08-03 12:18:02', -1, NULL, NULL),
(5, 'E', 'ฉ2', 1, '2023-08-03 12:18:25', -1, NULL, NULL),
(6, 'F', 'ฉ3', 1, '2023-08-03 12:19:01', -1, NULL, NULL),
(7, 'H', 'ก2', 1, '2023-08-03 12:19:15', -1, NULL, NULL),
(8, 'I', 'ก3', 1, '2023-08-03 12:19:26', -1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transfer`
--

CREATE TABLE `transfer` (
  `id` int(11) NOT NULL,
  `code` varchar(20) NOT NULL,
  `fromWhsCode` varchar(8) NOT NULL,
  `toWhsCode` varchar(8) NOT NULL,
  `remark` varchar(254) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_upd` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_user` int(11) DEFAULT NULL,
  `status` set('P','S','C') NOT NULL DEFAULT 'P' COMMENT 'P = Draft\r\nS = Success,\r\nC = Cancelled',
  `export_status` set('P','S','F') NOT NULL DEFAULT 'P',
  `DocEntry` int(11) DEFAULT NULL,
  `DocNum` int(11) DEFAULT NULL,
  `Message` text,
  `pack_id` int(11) DEFAULT NULL,
  `pack_code` varchar(20) DEFAULT NULL,
  `input_type` set('M','A') NOT NULL DEFAULT 'M' COMMENT 'M = manual\r\nA = auto'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transfer_detail`
--

CREATE TABLE `transfer_detail` (
  `id` int(11) NOT NULL,
  `transfer_id` int(11) NOT NULL,
  `transfer_code` varchar(20) NOT NULL,
  `LineNum` int(11) NOT NULL DEFAULT '0',
  `ItemCode` varchar(50) NOT NULL,
  `ItemName` varchar(100) DEFAULT NULL,
  `qty` int(11) NOT NULL DEFAULT '1',
  `fromWhsCode` varchar(8) DEFAULT NULL,
  `toWhsCode` varchar(8) NOT NULL,
  `i_pea_no` varchar(20) DEFAULT NULL,
  `u_pea_no` varchar(20) DEFAULT NULL,
  `LineStatus` set('O','C','D') NOT NULL DEFAULT 'O' COMMENT 'O = Open, \r\nC = Closed,\r\nD = Cancelled',
  `reference` varchar(20) DEFAULT NULL,
  `pack_id` int(11) DEFAULT NULL,
  `pack_row_id` int(11) DEFAULT NULL
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
  `active` tinyint(1) NOT NULL,
  `last_pass_change` date DEFAULT NULL,
  `force_reset` tinyint(1) NOT NULL DEFAULT '0',
  `create_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `create_by` int(11) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL,
  `fromWhsCode` varchar(8) DEFAULT NULL,
  `toWhsCode` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uname`, `pwd`, `name`, `uid`, `ugroup`, `team_id`, `active`, `last_pass_change`, `force_reset`, `create_at`, `create_by`, `update_at`, `update_by`, `fromWhsCode`, `toWhsCode`) VALUES
(-1, 'superadmin', '$2y$10$s.Ey6n.SIYRGq5wW.q/sJefuYVOU7pkbnA3X0XEN2ezKiTn11qk6u', 'คุณสุทัศ สังข์สวัสดิ์', '08570ca60a31013193c644d3acd4077c', -987654321, NULL, 1, '2024-12-31', 0, '2023-01-25 12:24:10', NULL, NULL, NULL, NULL, NULL),
(26, 'Administrator', '$2y$10$LLAbXdGWc4Uh/im337v6c.k41lwJ9kcL0Slh4EEy110nMisJ83QGa', 'Administrator', '7b7bc2512ee1fedcd76bdc68926d4f7b', 2, NULL, 1, '2023-08-03', 0, '2023-08-02 20:14:04', -1, '2023-08-04 14:21:06', 26, NULL, NULL),
(27, 'jeep', '$2y$10$Atuc..VPP7QgPFryQnkNNO2s.xR43b/XiWLcGlpNZCOt3fvzILF96', 'Jeep', 'ee92098e8d8fb93a9ac3870c3e94e201', 2, NULL, 1, '2023-08-03', 0, '2023-08-03 13:14:12', -1, NULL, NULL, NULL, NULL),
(28, 'N2A', '$2y$10$MGN.8zazcFRug2uVwwdJyeyPIj0KLIIEeKFSMbKvkRjPgZncliM9C', 'อุทัยธานี', '75637ed78471dd03e5cf7bbdb05e4d5a', 1, 3, 1, '2023-08-05', 0, '2023-08-05 12:26:32', -1, NULL, NULL, 'N3A-2', 'N3A-3'),
(29, 'N3A', '$2y$10$alfr6jQFIebz0aQ7Vt.AQOFowPgyhcYynIIX0.gcx1r4xDSgqWoOK', 'อุทัยธนี', '26b526fee0964a6b3025c317b54b937b', 1, 3, 1, '2023-08-09', 0, '2023-08-05 12:27:42', -1, NULL, NULL, 'N3A-2', 'N3A-3');

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
(1, 'User'),
(2, 'Admin');

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
  `last_sync` datetime DEFAULT NULL,
  `team_id` int(11) DEFAULT NULL COMMENT 'area',
  `role` tinyint(1) DEFAULT NULL COMMENT 'ประเภทคลัง\r\n0 = รอเบิก\r\n1 = คลังเบิก\r\n2 = คลังติดตั้งสำเร็จ\r\n3 = คลังลงลัง'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `code`, `name`, `listed`, `status`, `create_at`, `update_at`, `last_sync`, `team_id`, `role`) VALUES
(1, '1-DS', 'คลัง Drop ship', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(2, '1-EX', '1-EX-SYSTEM-BIN-LOCATION', 0, 0, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(3, '1-FG', 'คลังสินค้าสำเร็จรูป', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(4, '1-RC', 'คลัง RM Smart Meter และ Part ที่ต้องควบคุมอุณหภูมิ', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(5, '1-RT', 'คลังรอคืน/เคลมผู้ขาย', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(6, '1-SL', 'คลังยืม', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(7, '2-EX', 'คลังสินค้าตัวอย่าง', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(8, '2-FG', 'คลังสินค้าสำเร็จรูป', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(9, '2-GT', 'คลังประกันคุณภาพ', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(10, '2-PD', 'คลังผลิต', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(11, '2-QC', 'คลัง QC ตรวจสอบ', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(12, '2-RC', 'คลัง RM Smart Meter และ Part ที่ต้องควบคุมอุณหภูมิ', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(13, '2-RP', 'คลังซ่อม', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(14, '2-RT', 'คลังรอคืน/เคลมผู้ขาย', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(15, '2-RU', 'คลัง RM Mechanical และ Part ไม่ต้องควบคุมอุณหภูมิ รวมทั้ง PK,FS', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(16, '2-SC', 'คลังสินค้ารอทำลาย', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(17, '2-SL', 'คลังยืม', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(18, '2-SM', 'คลัง Semi', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(19, '2-SP', 'คลัง Spare Part', 0, 1, '2023-08-03 11:43:18', NULL, '2023-08-03 11:43:18', NULL, NULL),
(20, 'M2A', 'จันทบุรี', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:20:31', '2023-08-03 11:43:18', 7, 0),
(21, 'M2A-1', 'จันทบุรี/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:20:38', '2023-08-03 11:43:18', 7, 1),
(22, 'M2A-2', 'จันทบุรี/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:20:50', '2023-08-03 11:43:18', 7, 2),
(23, 'M2A-3', 'จันทบุรี/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:20:58', '2023-08-03 11:43:18', 7, 3),
(24, 'M3A', 'นครปฐม', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:21:18', '2023-08-03 11:43:18', 8, 0),
(25, 'M3A-1', 'นครปฐม/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:21:27', '2023-08-03 11:43:18', 8, 1),
(26, 'M3A-2', 'นครปฐม/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:21:35', '2023-08-03 11:43:18', 8, 2),
(27, 'M3A-3', 'นครปฐม/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:21:41', '2023-08-03 11:43:18', 8, 3),
(28, 'N1A', 'เชียงแสน', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:34:42', '2023-08-03 11:43:18', 1, 0),
(29, 'N1A-1', 'เชียงแสน/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:34:49', '2023-08-03 11:43:18', 1, 1),
(30, 'N1A-2', 'เชียงแสน/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:34:58', '2023-08-03 11:43:18', 1, 2),
(31, 'N1A-3', 'เชียงแสน/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:35:03', '2023-08-03 11:43:18', 1, 3),
(32, 'N1B', 'แม่จัน', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:35:23', '2023-08-03 11:43:18', 1, 0),
(33, 'N1B-1', 'แม่จัน/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:35:31', '2023-08-03 11:43:18', 1, 1),
(34, 'N1B-2', 'แม่จัน/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:35:36', '2023-08-03 11:43:18', 1, 2),
(35, 'N1B-3', 'แม่จัน/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:35:42', '2023-08-03 11:43:18', 1, 3),
(36, 'N2A', 'พิษณุโลก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:36:00', '2023-08-03 11:43:18', 2, 0),
(37, 'N2A-1', 'พิษณุโลก/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:36:07', '2023-08-03 11:43:18', 2, 1),
(38, 'N2A-2', 'พิษณุโลก/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:36:15', '2023-08-03 11:43:18', 2, 2),
(39, 'N2A-3', 'พิษณุโลก/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:36:20', '2023-08-03 11:43:18', 2, 3),
(40, 'N2B', 'ตะพานหิน', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:36:29', '2023-08-03 11:43:18', 2, 0),
(41, 'N2B-1', 'ตะพานหิน/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:36:35', '2023-08-03 11:43:18', 2, 1),
(42, 'N2B-2', 'ตะพานหิน/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:36:42', '2023-08-03 11:43:18', 2, 2),
(43, 'N2B-3', 'ตะพานหิน/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:36:48', '2023-08-03 11:43:18', 2, 3),
(44, 'N3A', 'อุทัยธานี', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:37:00', '2023-08-03 11:43:18', 3, 0),
(45, 'N3A-1', 'อุทัยธานี/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:37:06', '2023-08-03 11:43:18', 3, 1),
(46, 'N3A-2', 'อุทัยธานี/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:37:11', '2023-08-03 11:43:18', 3, 2),
(47, 'N3A-3', 'อุทัยธานี/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:37:16', '2023-08-03 11:43:18', 3, 3),
(48, 'NE1A', 'อุดรธานี', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:37:31', '2023-08-03 11:43:18', 4, 0),
(49, 'NE1A-1', 'อุดรธานี/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:37:37', '2023-08-03 11:43:18', 4, 1),
(50, 'NE1A-2', 'อุดรธานี/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:37:44', '2023-08-03 11:43:18', 4, 2),
(51, 'NE1A-3', 'อุดรธานี/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:37:49', '2023-08-03 11:43:18', 4, 3),
(52, 'NE1B', 'บ้านผือ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:37:57', '2023-08-03 11:43:18', 4, 0),
(53, 'NE1B-1', 'บ้านผือ/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:38:03', '2023-08-03 11:43:18', 4, 1),
(54, 'NE1B-2', 'บ้านผือ/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:38:09', '2023-08-03 11:43:18', 4, 2),
(55, 'NE1B-3', 'บ้านผือ/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:38:21', '2023-08-03 11:43:18', 4, 3),
(56, 'NE1C', 'เพ็ญ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 4, 0),
(57, 'NE1C-1', 'เพ็ญ/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 4, 1),
(58, 'NE1C-2', 'เพ็ญ/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 4, 2),
(59, 'NE1C-3', 'เพ็ญ/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 4, 3),
(60, 'NE2A', 'ร้อยเอ็ด', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 5, 0),
(61, 'NE2A-1', 'ร้อยเอ็ด/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 5, 1),
(62, 'NE2A-2', 'ร้อยเอ็ด/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 5, 2),
(63, 'NE2A-3', 'ร้อยเอ็ด/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 5, 3),
(64, 'NE2B', 'ขุขันธุ์', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 5, 0),
(65, 'NE2B-1', 'ขุขันธุ์/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 5, 1),
(66, 'NE2B-2', 'ขุขันธุ์/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 5, 2),
(67, 'NE2B-3', 'ขุขันธุ์/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 5, 3),
(68, 'NE2C', 'อุทุมพรพิสัย', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 5, 0),
(69, 'NE2C-1', 'อุทุมพรพิสัย/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 5, 1),
(70, 'NE2C-2', 'อุทุมพรพิสัย/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 5, 2),
(71, 'NE2C-3', 'อุทุมพรพิสัย/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 5, 3),
(72, 'NE3A', 'นางรอง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 6, 0),
(73, 'NE3A-1', 'นางรอง/เบิก', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 6, 1),
(74, 'NE3A-2', 'นางรอง/สำเร็จ', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 6, 2),
(75, 'NE3A-3', 'นางรอง/ลงลัง', 1, 1, '2023-08-03 11:43:18', '2023-08-03 12:58:39', '2023-08-03 11:43:18', 6, 3);

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
-- Indexes for table `dispose_reason`
--
ALTER TABLE `dispose_reason`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `install_list`
--
ALTER TABLE `install_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_pea_no` (`u_pea_no`),
  ADD KEY `date_add` (`date_add`),
  ADD KEY `i_pea_no` (`i_pea_no`),
  ADD KEY `status` (`status`),
  ADD KEY `transfer_code` (`transfer_code`),
  ADD KEY `user` (`user`),
  ADD KEY `pack_status` (`pack_status`),
  ADD KEY `pack_code` (`pack_code`);

--
-- Indexes for table `keys`
--
ALTER TABLE `keys`
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
-- Indexes for table `meter_phase`
--
ALTER TABLE `meter_phase`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `meter_size`
--
ALTER TABLE `meter_size`
  ADD PRIMARY KEY (`code`);

--
-- Indexes for table `pack`
--
ALTER TABLE `pack`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `status` (`status`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `WhsCode` (`WhsCode`),
  ADD KEY `is_transfer` (`is_transfer`),
  ADD KEY `transfer_code` (`transfer_code`),
  ADD KEY `phase` (`phase`);

--
-- Indexes for table `pack_detail`
--
ALTER TABLE `pack_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `i_pea_no` (`i_pea_no`),
  ADD KEY `is_transfer` (`is_transfer`),
  ADD KEY `transfer_code` (`transfer_code`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `menu_code` (`menu`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `transfer`
--
ALTER TABLE `transfer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `fromWhsCode` (`fromWhsCode`),
  ADD KEY `toWhsCode` (`toWhsCode`),
  ADD KEY `user` (`user`),
  ADD KEY `status` (`status`),
  ADD KEY `export_status` (`export_status`),
  ADD KEY `DocEntry` (`DocEntry`),
  ADD KEY `DocNum` (`DocNum`),
  ADD KEY `pack_code` (`pack_code`),
  ADD KEY `input_type` (`input_type`),
  ADD KEY `pack_id` (`pack_id`);

--
-- Indexes for table `transfer_detail`
--
ALTER TABLE `transfer_detail`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transfer_id_2` (`transfer_id`,`LineNum`),
  ADD KEY `LineStatus` (`LineStatus`),
  ADD KEY `transfer_code` (`transfer_code`),
  ADD KEY `transfer_id` (`transfer_id`),
  ADD KEY `reference` (`reference`),
  ADD KEY `pack_id` (`pack_id`),
  ADD KEY `pack_row_id` (`pack_row_id`);

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
  ADD KEY `team_id` (`team_id`);

--
-- Indexes for table `user_group`
--
ALTER TABLE `user_group`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dispose_reason`
--
ALTER TABLE `dispose_reason`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `install_list`
--
ALTER TABLE `install_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=905;

--
-- AUTO_INCREMENT for table `keys`
--
ALTER TABLE `keys`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `logs_transfer`
--
ALTER TABLE `logs_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pack`
--
ALTER TABLE `pack`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pack_detail`
--
ALTER TABLE `pack_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transfer`
--
ALTER TABLE `transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transfer_detail`
--
ALTER TABLE `transfer_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user_group`
--
ALTER TABLE `user_group`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

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
