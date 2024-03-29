-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2023 at 04:15 PM
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
(91, '060223163641', 2, '      -', '80', 4000, 2, '2023-02-06 16:36:41', 10),
(92, '060223183129', 2, 'Hatyai Thailand 112/331', '50', 6000, 1, '2023-02-06 18:31:29', 18);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(11) NOT NULL,
  `order_number` varchar(20) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_price` int(11) NOT NULL,
  `order_count_detail` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `order_number`, `product_id`, `product_price`, `order_count_detail`) VALUES
(76, '060223163641', 21, 400, 5),
(77, '060223163641', 22, 400, 5),
(78, '060223183129', 16, 200, 6),
(79, '060223183129', 22, 400, 4),
(80, '060223183129', 21, 400, 8);

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
(20, 90, 2, '060223_161812.png', '2280.00', 'ไทยพาณิชย์', 'admin adminadmin adminadmin adminadmin adminadmin adminadmin adminadmin adminadmin adminadmin admin', '2023-02-06', '22:18:00', 'ชำระเรียบร้อย'),
(21, 91, 2, '060223_163700.png', '4080.00', 'ไทยพาณิชย์', '', '2023-02-06', '22:36:00', 'ชำระเรียบร้อย'),
(22, 92, 2, '060223_183210.png', '6050.00', 'กสิกร', 'payment-formpayment-formpayment-formpayment-formpayment-form', '2023-02-07', '01:33:00', 'ตรวจสอบ');

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
(21, 'กางเกง ผ้าคอตตอน ขา 5 ส่วน ทรง', 'ผ้าฟอกดูลำลอง กางเกงที่สวมใส่อยู่บ้านและออกไปข้างนอกก็ดูดีไม่แพ้กัน', '16751011769010.webp', '2', 400.00, 'Uniqlo', '2023-02-01', 15),
(22, 'กางเกง Jogger Ultra Stretch DR', 'คล่องตัวดีเยี่ยมผสานผิวสัมผัสเรียบลื่นดุจแพรไหม กางเกงจ็อกเกอร์สำหรับทุกโอกาส', '16751014753335.webp', '1', 400.00, 'Uniqlo', '2023-02-01', 15),
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
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
