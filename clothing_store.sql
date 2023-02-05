-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2023 at 01:32 PM
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
-- Database: `clothing_store`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `cart_date` datetime NOT NULL DEFAULT current_timestamp(),
  `order_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `mem_id` int(11) NOT NULL COMMENT 'รหัสพนักงาน',
  `mem_fname` varchar(40) NOT NULL COMMENT 'ชื่อ',
  `mem_lname` varchar(40) NOT NULL COMMENT 'นามสกุล',
  `mem_email` varchar(80) NOT NULL COMMENT 'อีเมลล์',
  `mem_tel` varchar(10) NOT NULL COMMENT 'เบอร์',
  `mem_address` varchar(100) NOT NULL COMMENT 'ที่อยู่',
  `mem_username` varchar(30) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `mem_password` varchar(60) NOT NULL COMMENT 'รหัสผ่าน',
  `mem_create_at` varchar(15) NOT NULL,
  `mem_status` enum('admin','personnel','user') NOT NULL DEFAULT 'user' COMMENT 'สถานะ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`mem_id`, `mem_fname`, `mem_lname`, `mem_email`, `mem_tel`, `mem_address`, `mem_username`, `mem_password`, `mem_create_at`, `mem_status`) VALUES
(1, 'Sumat', 'Thongin', 'sumat@demo.com', '0932132612', '  1001/32 Thailand  Ratatatata             ', 'demo', '$2y$10$OsBJKA6tkMFg4LZ7hUy89.B.pi1jVcJAApi5UoXPWfqWPe8JQ9xdy', '2020-04-08', 'user'),
(2, 'admin', 'admin', 'admin@admin.com', '0894969999', '      -', 'admin', '$2y$10$1Psji12WhAwbKQ8YYgIXL.CW8kRXKRt9fG6ORTWTU2hPZdeLBWQem', '2020-04-08', 'admin'),
(5, 'รฐภูมินทร์', 'นาอุดม', 'ratapumin@gmail.com', '0621646560', 'หาดใหญ่', 'ratapumin', '$2y$10$c6dmJgby28wUAmtPjLdlKeNqPVbiqhiah34inOc98cgvp7p0/bLQO', '2023-02-01', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `new_id` int(11) NOT NULL COMMENT 'รหัสข่าว',
  `new_title` varchar(30) NOT NULL COMMENT 'หัวข้อข่าว',
  `new_image` varchar(100) NOT NULL COMMENT 'รูปข่าว',
  `new_date` date NOT NULL COMMENT 'วันที่ลงข่าว'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`new_id`, `new_title`, `new_image`, `new_date`) VALUES
(4, 'สไตล์การแต่งตัว', '16750969417189.jpg', '2023-02-01');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `order_shipping` varchar(2) NOT NULL,
  `price_total` int(8) NOT NULL,
  `order_status` int(1) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_number`, `mem_id`, `address`, `order_shipping`, `price_total`, `order_status`, `order_date`, `order_count`) VALUES
(56, '280123170138', 1, '1001/32 Thailand ', '50', 15800, 1, '2023-01-28 17:01:38', 0),
(57, '280123170909', 1, '1001/32 Thailand ', '50', 15800, 0, '2023-01-28 17:09:09', 0),
(58, '010223160429', 2, '      -', '50', 100, 2, '2023-02-01 16:04:29', 0),
(59, '010223160536', 2, '      -', '50', 100, 2, '2023-02-01 16:05:36', 0),
(60, '010223192724', 1, '  1001/32 Thailand ', '50', 1530, 2, '2023-02-01 19:27:24', 0),
(61, '040223091401', 2, '      -', '50', 800, 1, '2023-02-04 09:14:01', 0),
(62, '040223092549', 2, '      -', '80', 1800, 1, '2023-02-04 09:25:49', 9),
(63, '040223100458', 2, '      -', '50', 1200, 1, '2023-02-04 10:04:58', 6),
(64, '040223102655', 2, '      -', '50', 1600, 1, '2023-02-04 10:26:55', 8),
(65, '040223105037', 2, '      -', '80', 3000, 1, '2023-02-04 10:50:37', 15),
(66, '040223105654', 2, '      -', '80', 3200, 1, '2023-02-04 10:56:54', 16),
(67, '040223105935', 2, '      -', '50', 1200, 1, '2023-02-04 10:59:35', 6),
(68, '040223110518', 2, '      -', '80', 1200, 1, '2023-02-04 11:05:18', 6),
(69, '040223110723', 2, '      -', '50', 1200, 1, '2023-02-04 11:07:23', 6),
(70, '050223114402', 1, '', '50', 0, 0, '2023-02-05 11:44:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `order_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_number`, `product_id`, `product_price`, `order_count`) VALUES
(37, '280123170138', 9, 15800, 0),
(38, '280123170909', 7, 15800, 0),
(39, '010223160429', 16, 100, 0),
(40, '010223160536', 16, 100, 0),
(41, '010223192724', 29, 390, 0),
(42, '040223091401', 16, 200, 0),
(43, '040223092549', 16, 200, 9),
(44, '040223100458', 16, 200, 6),
(45, '040223102655', 16, 200, 8),
(46, '040223105037', 16, 200, 15),
(47, '040223105654', 16, 200, 16),
(48, '040223105935', 16, 200, 6),
(49, '040223110518', 16, 200, 6),
(50, '040223110723', 16, 200, 6),
(51, '050223114402', 22, 400, 0);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `mem_id` int(11) NOT NULL,
  `payment_file` varchar(100) NOT NULL,
  `payment_price` decimal(10,2) NOT NULL,
  `payment_bank` varchar(50) NOT NULL,
  `payment_Detail` text NOT NULL,
  `payment_date` date NOT NULL,
  `payment_time` time NOT NULL,
  `payment_status` enum('ตรวจสอบ','ชำระเรียบร้อย') NOT NULL DEFAULT 'ตรวจสอบ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `order_id`, `mem_id`, `payment_file`, `payment_price`, `payment_bank`, `payment_Detail`, `payment_date`, `payment_time`, `payment_status`) VALUES
(1, 26, 1, '280123_135103.png', '15880.00', 'ไทยพาณิชย์', '', '2023-01-28', '19:50:00', 'ชำระเรียบร้อย'),
(3, 58, 2, '010223_160615.png', '150.00', 'ไทยพาณิชย์', 'aas', '2023-02-02', '22:06:00', 'ชำระเรียบร้อย'),
(4, 59, 2, '010223_160722.png', '150.00', 'ไทยพาณิชย์', 'gw', '2023-02-01', '22:07:00', 'ชำระเรียบร้อย'),
(5, 60, 1, '010223_192812.png', '1.00', 'กรุงเทพ', 'Sumat thonginSumat thonginSumat thonginSumat thonginSumat thonginSumat thonginSumat thonginSumat thonginSumat thonginSumat thonginSumat thonginSumat thonginSumat thonginSumat thonginSumat thonginSumat thongin', '2023-02-02', '01:28:00', 'ชำระเรียบร้อย'),
(6, 63, 2, '040223_100534.jpg', '1.00', 'ไทยพาณิชย์', '', '2023-02-04', '16:05:00', 'ชำระเรียบร้อย'),
(7, 62, 2, '040223_101649.png', '1.00', 'กรุงเทพ', '', '2023-02-05', '16:17:00', 'ตรวจสอบ'),
(8, 61, 2, '040223_102015.jpg', '1.00', 'กสิกร', '', '2023-02-05', '17:21:00', 'ตรวจสอบ'),
(9, 64, 2, '040223_102734.jpg', '1.00', 'ไทยพาณิชย์', '', '2023-02-04', '16:27:00', 'ตรวจสอบ'),
(10, 64, 2, '040223_103016.jpg', '0.00', 'ไทยพาณิชย์', '', '2023-02-04', '16:30:00', 'ตรวจสอบ'),
(11, 64, 2, '040223_103324.jpg', '1.00', 'ไทยพาณิชย์', '', '2023-02-04', '16:30:00', 'ตรวจสอบ'),
(12, 64, 2, '040223_103350.png', '1.00', 'ไทยพาณิชย์', '', '2023-02-04', '16:33:00', 'ตรวจสอบ'),
(13, 64, 2, '040223_103544.png', '1.00', 'ไทยพาณิชย์', '', '2023-02-04', '16:35:00', 'ตรวจสอบ'),
(14, 65, 2, '040223_105106.jpg', '3000.00', 'ไทยพาณิชย์', 'asdasfasdfasdfasdasdgasdg', '2023-02-04', '16:51:00', 'ตรวจสอบ'),
(15, 66, 2, '040223_105718.png', '3.00', 'ไทยพาณิชย์', 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', '2023-02-04', '16:57:00', 'ตรวจสอบ'),
(16, 67, 2, '040223_110001.png', '1.00', 'กรุงไทย', '', '2023-02-04', '16:59:00', 'ตรวจสอบ'),
(17, 68, 2, '040223_110537.jpg', '1250.00', 'ไทยพาณิชย์', '', '2023-02-04', '17:05:00', 'ตรวจสอบ'),
(18, 69, 2, '040223_110746.jpg', '1250.00', 'กรุงเทพ', 'qqqqqqqq', '2023-02-19', '18:08:00', 'ตรวจสอบ');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(30) NOT NULL,
  `product_detail` varchar(500) NOT NULL,
  `product_image` varchar(50) NOT NULL,
  `product_code` varchar(10) NOT NULL,
  `product_price` double(10,2) NOT NULL,
  `product_tag` varchar(30) NOT NULL,
  `product_date` date NOT NULL,
  `product_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_detail`, `product_image`, `product_code`, `product_price`, `product_tag`, `product_date`, `product_count`) VALUES
(16, 'เสื้อเชิ้ตแขนสามส่วน', 'เสื้อผู้ชายเสื้อฮาวายเสื้อผ้าแฟชั่นผู้ชายเสื้อผ้าผู้ชายเกาหลี', '16750993669812.jpg', '1', 200.00, 'HandM', '2023-02-01', 20),
(21, 'กางเกง ผ้าคอตตอน ขา 5 ส่วน ทรง', 'ผ้าฟอกดูลำลอง กางเกงที่สวมใส่อยู่บ้านและออกไปข้างนอกก็ดูดีไม่แพ้กัน', '16751011769010.webp', '2', 400.00, 'Uniqlo', '2023-02-01', 30),
(22, 'กางเกง Jogger Ultra Stretch DR', 'คล่องตัวดีเยี่ยมผสานผิวสัมผัสเรียบลื่นดุจแพรไหม กางเกงจ็อกเกอร์สำหรับทุกโอกาส', '16751014753335.webp', '1', 400.00, 'Uniqlo', '2023-02-01', 30),
(23, 'ยีนส์ Ultra Stretch ทรงสกินนี่', 'ยืดหยุ่นอย่างน่าทึ่งเพื่อความกระชับสบายและดูเนี้ยบอย่างมีสไตล์', '16751016162111.webp', '2', 650.00, 'Uniqlo', '2023-01-31', 0),
(24, 'ยืดหยุ่นอย่างน่าทึ่งเพื่อความก', 'ยืดหยุ่นอย่างน่าทึ่งเพื่อความกระชับสบายและดูเนี้ยบอย่างมีสไตล์', '16751016801730.webp', '2', 590.00, 'Uniqlo', '2023-02-01', 0),
(25, 'กางเกง Smart ผ้าคอตตอน ขา 5 ส่', 'ยืดหยุ่นดูทะมัดทะแมง กางเกงจากผ้าคอตตอนที่ให้สัมผัสสบาย สวมใส่ได้หลายโอกาส', '16751019176509.webp', '2', 690.00, 'Uniqlo', '2023-02-01', 0),
(28, 'Hoodie รุ่น TORA', 'กลับมาอีกครั้งตามคำเรียกร้อง\r\nเสื้อกันหนาว Hoodie รุ่น TORA\r\nเนื้อผ้าหนานุ่ม สวมใส่สบาย', '16751036675636.jfif', '3', 690.00, 'URTHE', '2023-02-02', 0),
(29, 'URTHE // WORSTBOY', 'เสื้อยืดแขนสั้น OVERSIZED\r\nรุ่น WORSTBOY\r\nสกรีนลายหน้าหลัง เนื้อผ้านุ่ม ใส่สบายมากกก', '16751039064462.jpg', '3', 390.00, 'URTHE', '2023-02-02', 0),
(34, 'asdasdadasd', 'asdasdadada', '16753205584100.png', '3', 12234.00, 'Uniqlo', '2023-02-25', 0),
(35, 'aaaaaaaaaaaawdarfar', 'awafasdfasfasf', '16753206826062.png', '3', 22434.00, 'Uniqlo', '2023-02-04', 0),
(36, 'awfawrarag', 'sdgasdgasdgasdgasdgasdgasdgasdgascbvzdfbsdfbaergasdfgasdfgasdgasdga', '16753207061587.jpg', '3', 22441.00, 'URTHE', '2023-02-04', 0),
(37, '', '', '16753322079100.jpg', '', 0.00, 'HandM', '0000-00-00', 0),
(38, 'asdasdadasdaaaaaaaaaa', 'asdasdadasdaaaaaaaaaaasdasdadasdaaaaaaaaaaasdasdadasdaaaaaaaaaaasdasdadasdaaaaaaaaaa', '16753322379243.png', '3', 2231.00, 'Uniqlo', '2023-02-04', 12);

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

CREATE TABLE `product_tag` (
  `product_tag_id` int(11) NOT NULL,
  `product_tag_name` varchar(50) NOT NULL,
  `product_tag_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_tag`
--

INSERT INTO `product_tag` (`product_tag_id`, `product_tag_name`, `product_tag_date`) VALUES
(1, 'HandM', '2023-02-01'),
(2, 'Uniqlo', '2023-02-01'),
(3, 'URTHE', '2023-02-02'),
(4, 'ฟาร์มไก่อภิชาติ', '2023-02-02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`mem_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`new_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD PRIMARY KEY (`product_tag_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `mem_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสพนักงาน', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `new_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'รหัสข่าว', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `product_tag`
--
ALTER TABLE `product_tag`
  MODIFY `product_tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
