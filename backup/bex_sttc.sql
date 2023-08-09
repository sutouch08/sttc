-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 03, 2023 at 06:01 AM
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
(248, 26, 'SCUSER', 1, 1, 1, 1, 1),
(249, 26, 'SCTEAM', 1, 1, 1, 1, 1),
(250, 26, 'SCOWHS', 1, 1, 1, 1, 1),
(251, 26, 'SCCONF', 1, 1, 1, 1, 1),
(252, 26, 'SCPERM', 1, 1, 1, 1, 1),
(253, 26, 'OPISTL', 1, 1, 1, 1, 1),
(254, 26, 'OPWHTR', 1, 1, 1, 1, 1),
(255, 26, 'OPISPK', 1, 1, 1, 1, 1),
(256, 26, 'OPSTOCK', 1, 1, 1, 1, 1);

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
(1, 'A', 'เขต 1', 1, '2023-01-24 12:28:46', -1, '2023-07-22 14:08:01', -1),
(3, 'B', 'เขต 2', 1, '2023-01-24 15:56:05', -1, '2023-07-22 14:08:06', -1),
(4, 'C', 'เขต 3', 1, '2023-05-07 16:11:41', -1, '2023-07-22 14:08:08', NULL),
(5, 'D', 'เขต 4', 1, '2023-05-07 16:11:48', -1, '2023-07-22 14:08:11', NULL),
(6, 'E', 'เขต 5', 1, '2023-05-07 16:11:54', -1, '2023-07-22 14:08:14', NULL),
(7, 'F', 'นางรอง', 1, '2023-05-07 16:12:01', -1, '2023-07-25 13:24:29', -1),
(8, 'G', 'เขต 7', 1, '2023-05-07 16:12:06', -1, '2023-07-22 14:08:19', NULL),
(9, 'H', 'จันทบุรึ', 1, '2023-05-07 16:12:12', -1, '2023-07-26 17:55:45', -1);

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
(26, 'Administrator', '$2y$10$9sexPXsGHd5M7c8d1vrG3.ZIOy.b4bbw.Yn4b/OevUz6wUH9FGSUC', 'Administrator', '7b7bc2512ee1fedcd76bdc68926d4f7b', 2, NULL, 1, '2023-08-02', 0, '2023-08-02 20:14:04', -1, NULL, NULL, NULL, NULL);

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
(1, '1-DS', 'คลัง Drop ship', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:29', '2023-07-25 13:22:35', NULL, 0),
(2, '1-EX', '1-EX-SYSTEM-BIN-LOCATION', 0, 0, '2023-07-25 13:22:35', '2023-07-26 20:04:32', '2023-07-25 13:22:35', NULL, 0),
(3, '1-FG', 'คลังสินค้าสำเร็จรูป', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:34', '2023-07-25 13:22:35', NULL, 0),
(4, '1-RC', 'คลัง RM Smart Meter และ Part ที่ต้องควบคุมอุณหภูมิ', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:36', '2023-07-25 13:22:35', NULL, 0),
(5, '1-RT', 'คลังรอคืน/เคลมผู้ขาย', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:38', '2023-07-25 13:22:35', NULL, 0),
(6, '1-SL', 'คลังยืม', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:41', '2023-07-25 13:22:35', NULL, 0),
(7, '2-EX', 'คลังสินค้าตัวอย่าง', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:44', '2023-07-25 13:22:35', NULL, 0),
(8, '2-FG', 'คลังสินค้าสำเร็จรูป', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:45', '2023-07-25 13:22:35', NULL, 0),
(9, '2-GT', 'คลังประกันคุณภาพ', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:47', '2023-07-25 13:22:35', NULL, 0),
(10, '2-PD', 'คลังผลิต', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:49', '2023-07-25 13:22:35', NULL, 0),
(11, '2-QC', 'คลัง QC ตรวจสอบ', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:50', '2023-07-25 13:22:35', NULL, 0),
(12, '2-RC', 'คลัง RM Smart Meter และ Part ที่ต้องควบคุมอุณหภูมิ', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:52', '2023-07-25 13:22:35', NULL, 0),
(13, '2-RP', 'คลังซ่อม', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:54', '2023-07-25 13:22:35', NULL, 0),
(14, '2-RT', 'คลังรอคืน/เคลมผู้ขาย', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:56', '2023-07-25 13:22:35', NULL, 0),
(15, '2-RU', 'คลัง RM Mechanical และ Part ไม่ต้องควบคุมอุณหภูมิ รวมทั้ง PK,FS', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:58', '2023-07-25 13:22:35', NULL, 0),
(16, '2-SC', 'คลังสินค้ารอทำลาย', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:04:59', '2023-07-25 13:22:35', NULL, 0),
(17, '2-SL', 'คลังยืม', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:05:01', '2023-07-25 13:22:35', NULL, 0),
(18, '2-SM', 'คลัง Semi', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:05:02', '2023-07-25 13:22:35', NULL, 0),
(19, '2-SP', 'คลัง Spare Part', 0, 1, '2023-07-25 13:22:35', '2023-07-26 20:05:04', '2023-07-25 13:22:35', NULL, 0),
(20, 'M2A', 'จันทบุรี', 1, 1, '2023-07-25 13:22:35', '2023-07-26 20:11:50', '2023-07-25 13:22:35', 9, 0),
(21, 'M2A-1', 'จันทบุรี/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 20:11:57', '2023-07-25 13:22:35', 9, 1),
(22, 'M2A-2', 'จันทบุรี/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 20:12:03', '2023-07-25 13:22:35', 9, 2),
(23, 'M2A-3', 'จันทบุรี/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-26 20:12:13', '2023-07-25 13:22:35', 9, 3),
(24, 'M3A', 'นครปฐม', 1, 1, '2023-07-25 13:22:35', '2023-07-31 15:02:14', '2023-07-25 13:22:35', 4, 0),
(25, 'M3A-1', 'นครปฐม/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:51:37', '2023-07-25 13:22:35', NULL, 1),
(26, 'M3A-2', 'นครปฐม/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:29', '2023-07-25 13:22:35', NULL, 2),
(27, 'M3A-3', 'นครปฐม/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:38', '2023-07-25 13:22:35', NULL, 3),
(28, 'N1A', 'เชียงแสน', 1, 1, '2023-07-25 13:22:35', '2023-07-26 20:40:03', '2023-07-25 13:22:35', 1, 0),
(29, 'N1A-1', 'เชียงแสน/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 20:40:09', '2023-07-25 13:22:35', 1, 1),
(30, 'N1A-2', 'เชียงแสน/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-25 14:27:06', '2023-07-25 13:22:35', 1, 2),
(31, 'N1A-3', 'เชียงแสน/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-26 20:40:14', '2023-07-25 13:22:35', 1, 3),
(32, 'N1B', 'แม่จัน', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:53:51', '2023-07-25 13:22:35', NULL, 0),
(33, 'N1B-1', 'แม่จัน/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:14', '2023-07-25 13:22:35', NULL, 1),
(34, 'N1B-2', 'แม่จัน/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:29', '2023-07-25 13:22:35', NULL, 2),
(35, 'N1B-3', 'แม่จัน/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:38', '2023-07-25 13:22:35', NULL, 3),
(36, 'N2A', 'พิษณุโลก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:53:51', '2023-07-25 13:22:35', NULL, 0),
(37, 'N2A-1', 'พิษณุโลก/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:14', '2023-07-25 13:22:35', NULL, 1),
(38, 'N2A-2', 'พิษณุโลก/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:29', '2023-07-25 13:22:35', NULL, 2),
(39, 'N2A-3', 'พิษณุโลก/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:38', '2023-07-25 13:22:35', NULL, 3),
(40, 'N2B', 'ตะพานหิน', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:53:51', '2023-07-25 13:22:35', NULL, 0),
(41, 'N2B-1', 'ตะพานหิน/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:14', '2023-07-25 13:22:35', NULL, 1),
(42, 'N2B-2', 'ตะพานหิน/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:29', '2023-07-25 13:22:35', NULL, 2),
(43, 'N2B-3', 'ตะพานหิน/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:38', '2023-07-25 13:22:35', NULL, 3),
(44, 'N3A', 'อุทัยธานี', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:53:51', '2023-07-25 13:22:35', NULL, 0),
(45, 'N3A-1', 'อุทัยธานี/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:14', '2023-07-25 13:22:35', NULL, 1),
(46, 'N3A-2', 'อุทัยธานี/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:29', '2023-07-25 13:22:35', NULL, 2),
(47, 'N3A-3', 'อุทัยธานี/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:38', '2023-07-25 13:22:35', NULL, 3),
(48, 'NE1A', 'อุดรธานี', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:53:51', '2023-07-25 13:22:35', NULL, 0),
(49, 'NE1A-1', 'อุดรธานี/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:14', '2023-07-25 13:22:35', NULL, 1),
(50, 'NE1A-2', 'อุดรธานี/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:29', '2023-07-25 13:22:35', NULL, 2),
(51, 'NE1A-3', 'อุดรธานี/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:38', '2023-07-25 13:22:35', NULL, 3),
(52, 'NE1B', 'บ้านผือ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:53:51', '2023-07-25 13:22:35', NULL, 0),
(53, 'NE1B-1', 'บ้านผือ/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:14', '2023-07-25 13:22:35', NULL, 1),
(54, 'NE1B-2', 'บ้านผือ/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:29', '2023-07-25 13:22:35', NULL, 2),
(55, 'NE1B-3', 'บ้านผือ/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:38', '2023-07-25 13:22:35', NULL, 3),
(56, 'NE1C', 'เพ็ญ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:53:51', '2023-07-25 13:22:35', NULL, 0),
(57, 'NE1C-1', 'เพ็ญ/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:14', '2023-07-25 13:22:35', NULL, 1),
(58, 'NE1C-2', 'เพ็ญ/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:29', '2023-07-25 13:22:35', NULL, 2),
(59, 'NE1C-3', 'เพ็ญ/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:38', '2023-07-25 13:22:35', NULL, 3),
(60, 'NE2A', 'ร้อยเอ็ด', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:53:51', '2023-07-25 13:22:35', NULL, 0),
(61, 'NE2A-1', 'ร้อยเอ็ด/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:14', '2023-07-25 13:22:35', NULL, 1),
(62, 'NE2A-2', 'ร้อยเอ็ด/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:29', '2023-07-25 13:22:35', NULL, 2),
(63, 'NE2A-3', 'ร้อยเอ็ด/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:38', '2023-07-25 13:22:35', NULL, 3),
(64, 'NE2B', 'ขุขันธุ์', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:53:51', '2023-07-25 13:22:35', NULL, 0),
(65, 'NE2B-1', 'ขุขันธุ์/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:14', '2023-07-25 13:22:35', NULL, 1),
(66, 'NE2B-2', 'ขุขันธุ์/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:29', '2023-07-25 13:22:35', NULL, 2),
(67, 'NE2B-3', 'ขุขันธุ์/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:38', '2023-07-25 13:22:35', NULL, 3),
(68, 'NE2C', 'อุทุมพรพิสัย', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:53:51', '2023-07-25 13:22:35', NULL, 0),
(69, 'NE2C-1', 'อุทุมพรพิสัย/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:14', '2023-07-25 13:22:35', NULL, 1),
(70, 'NE2C-2', 'อุทุมพรพิสัย/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:29', '2023-07-25 13:22:35', NULL, 2),
(71, 'NE2C-3', 'อุทุมพรพิสัย/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-26 14:52:38', '2023-07-25 13:22:35', NULL, 3),
(72, 'NE3A', 'นางรอง', 1, 1, '2023-07-25 13:22:35', '2023-07-25 14:32:35', '2023-07-25 13:22:35', 7, 0),
(73, 'NE3A-1', 'นางรอง/เบิก', 1, 1, '2023-07-25 13:22:35', '2023-07-25 14:32:43', '2023-07-25 13:22:35', 7, 1),
(74, 'NE3A-2', 'นางรอง/สำเร็จ', 1, 1, '2023-07-25 13:22:35', '2023-07-25 14:32:51', '2023-07-25 13:22:35', 7, 2),
(75, 'NE3A-3', 'นางรอง/ลงลัง', 1, 1, '2023-07-25 13:22:35', '2023-07-25 14:32:58', '2023-07-25 13:22:35', 7, 3);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pack_detail`
--
ALTER TABLE `pack_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=257;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
