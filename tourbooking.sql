-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 11:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tourbooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `airlines_list`
--

CREATE TABLE `airlines_list` (
  `id` int(30) NOT NULL,
  `airlines` text NOT NULL,
  `logo_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `airport_list`
--

CREATE TABLE `airport_list` (
  `id` int(3) NOT NULL,
  `airport` text NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airport_list`
--

INSERT INTO `airport_list` (`id`, `airport`, `location`) VALUES
(1, 'Sân Bay Nha Trang', 'Khánh Hòa'),
(2, 'Sân bay Tân Sơn Nhất ', 'Hồ Chí Minh'),
(3, 'Sân bay Đà Nẵng ', 'Đà Nẵng');

-- --------------------------------------------------------

--
-- Table structure for table `booked_flight`
--

CREATE TABLE `booked_flight` (
  `id` int(30) NOT NULL,
  `flight_id` int(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `num_tickets` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked_flight`
--

INSERT INTO `booked_flight` (`id`, `flight_id`, `name`, `email`, `phone`, `num_tickets`) VALUES
(1, 9, 'anh tu', '123@gmail.com', '123', 20),
(2, 9, 'anh tu', '123@gmail.com', '123', 20),
(3, 6, 'anh tu', '123@gmail.com', '123', 20),
(4, 7, 'anh tu', '123@gmail.com', '123', 20),
(5, 7, 'anh tu', '123@gmail.com', '123', 20),
(6, 6, 'anh tu dep trai', '123@gmail.com', '123', 20);

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_book` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_tour` int(11) NOT NULL,
  `id_depa` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_book`, `id_user`, `id_tour`, `id_depa`, `quantity`) VALUES
(6101241, 6, 101, 24, 1);

-- --------------------------------------------------------

--
-- Table structure for table `booking_request`
--

CREATE TABLE `booking_request` (
  `id_request` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `name_request` text NOT NULL,
  `email_request` text NOT NULL,
  `phone_request` int(15) NOT NULL,
  `address_request` text DEFAULT NULL,
  `desc_request` text NOT NULL,
  `ads_request` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `deday` date NOT NULL,
  `reday` date NOT NULL,
  `pulocation` varchar(100) NOT NULL,
  `dolocation` varchar(100) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cartype` varchar(50) NOT NULL,
  `addinfo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departure`
--

CREATE TABLE `departure` (
  `id_depa` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departure`
--

INSERT INTO `departure` (`id_depa`, `name`) VALUES
(24, 'Hà Nội'),
(28, 'Thành phố Hồ Chí Minh'),
(236, 'Đà Nẵng'),
(258, 'Khánh Hòa');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `id_dest` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id_dest`, `name`) VALUES
(65000, 'Singapore'),
(66000, 'Thái Lan'),
(81000, 'Nhật Bản'),
(82000, 'Hàn Quốc'),
(84001, 'Thủ đô Hà Nội, vịnh Hạ Long - Quảng Ninh'),
(84002, 'Thành phố Huế'),
(84003, 'Thành phố Đà Nẵng'),
(84004, 'Thành phố biển Nha Trang - Khánh Hòa'),
(84005, 'Thành phố Đà Lạt'),
(86000, 'Trung Quốc');

-- --------------------------------------------------------

--
-- Table structure for table `flight_list`
--

CREATE TABLE `flight_list` (
  `id` int(30) NOT NULL,
  `airline_id` int(30) NOT NULL,
  `plane_no` text NOT NULL,
  `departure_airport_id` int(30) NOT NULL,
  `arrival_airport_id` int(30) NOT NULL,
  `departure_datetime` datetime NOT NULL,
  `arrival_datetime` datetime NOT NULL,
  `seats` int(10) NOT NULL,
  `price` double NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flight_list`
--

INSERT INTO `flight_list` (`id`, `airline_id`, `plane_no`, `departure_airport_id`, `arrival_airport_id`, `departure_datetime`, `arrival_datetime`, `seats`, `price`, `date_created`) VALUES
(6, 222, 'a02', 1, 2, '2024-11-24 08:47:00', '2024-11-25 08:47:00', 44, 2000, '2024-11-24 08:47:00'),
(7, 222, '102', 1, 2, '2024-11-24 08:54:50', '2024-11-27 08:54:50', 44, 2000, '2024-11-24 08:54:50'),
(8, 1, 'a02', 1, 2, '2024-11-24 09:03:35', '2024-11-24 09:03:35', 44, 2000, '2024-11-24 09:03:35'),
(9, 1, 'a02', 1, 3, '2024-11-24 09:07:32', '2024-11-24 09:07:32', 0, 0, '2024-11-24 09:07:32');

-- --------------------------------------------------------

--
-- Table structure for table `khachsan`
--

CREATE TABLE `khachsan` (
  `id_hotel` int(11) NOT NULL,
  `name_hotel` text NOT NULL,
  `rating_hotel` int(1) NOT NULL,
  `price_hotel` text NOT NULL,
  `contact_hotel` int(11) NOT NULL,
  `desc_hotel` text DEFAULT NULL,
  `img_hotel` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `khachsan`
--

INSERT INTO `khachsan` (`id_hotel`, `name_hotel`, `rating_hotel`, `price_hotel`, `contact_hotel`, `desc_hotel`, `img_hotel`) VALUES
(1, 'VINPEARL RESORT & SPA PHU QUOC', 5, 'Liên hệ', 902976588, 'Vinpearl Resort & Spa Phú Quốc mang đậm kiến trúc Á Đông với mái ngói đỏ điển hình trong quần thể Vinpearl Phú Quốc. Khu nghỉ dưỡng sở hữu các chòi spa trên mặt hồ độc đáo và kết nối thuận tiện với các tiện ích trong quần thể như sân golf, Vinpearl Land và Vinpearl Safari.', 'images/vinpearlresortspaphuquoc/hotel_main.jpg'),
(2, 'VINPEARL CODOTEL RIVERFRONT Đà Nẵng', 5, '2.300.000 đ', 932659588, 'Vinpearl Condotel Riverfront Đà Nẵng là tòa khách sạn căn hộ hiện đại với tầm nhìn độc đáo hướng trực diện sông Hàn và cầu Rồng, mở thoáng bao quát toàn thành phố. Khách sạn được xây dựng theo phong cách kiến trúc tân cổ điển hiện đại với thiết kế tiện nghi bậc nhất theo tiêu chuẩn quốc tế, cùng lượng dịch vụ, giải trí chuẩn 5 sao mang tới những trải nghiệm đẳng cấp nhất cho du khách.', 'images/vinpearlcodoteldanang/hotel_main.png'),
(3, 'VINOASIS PHU QUOC', 5, '2.500.000 đ', 902976588, 'VinOasis là quần thể khách sạn- ẩm thực- mua sắm- sự kiện- giải trí công nghệ cao đa tiện ích được thiết kế để nâng tầm trải nghiệm cho du khách. Được ví như một ốc đảo ngập tràn cảm hứng, VinOasis – một điểm đến đáp ứng vạn nhu cầu – với quy mô 1,378 phòng nghỉ tiện nghi bậc nhất, thế giới ẩm thực quốc tế phong phú và các hoạt động giải trí đỉnh cao, sôi động ngày đêm.', 'images/vinoasisphuquoc/hotel_main.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `card_number` varchar(16) DEFAULT NULL,
  `expiration_month` int(11) DEFAULT NULL,
  `expiration_year` int(11) DEFAULT NULL,
  `security_code` varchar(4) DEFAULT NULL,
  `card_holder` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `payment_method`, `transaction_id`, `card_number`, `expiration_month`, `expiration_year`, `security_code`, `card_holder`, `created_at`) VALUES
(1, 'Bank Transfer', '123', NULL, NULL, NULL, NULL, NULL, '2024-11-24 23:46:36'),
(2, 'Card Payment', NULL, '4539148803436467', 5, 2027, '3333', 'LE XUAN DUONG', '2024-11-24 23:53:26'),
(3, 'Card Payment', NULL, '4539148803436467', 5, 2035, '123', 'LEXUANDUONG', '2024-11-24 23:59:57'),
(4, 'Bank Transfer', '123', NULL, NULL, NULL, NULL, NULL, '2024-11-25 00:00:07'),
(5, 'Bank Transfer', '123', NULL, NULL, NULL, NULL, NULL, '2024-11-25 00:02:37');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id_room` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL,
  `name_room` text NOT NULL,
  `smallbed_room` int(1) NOT NULL,
  `largebed_room` int(1) NOT NULL,
  `price_room` text NOT NULL,
  `desc_room` text DEFAULT NULL,
  `img_room` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id_room`, `id_hotel`, `name_room`, `smallbed_room`, `largebed_room`, `price_room`, `desc_room`, `img_room`) VALUES
(8, 1, 'PHÒNG DELUXE HƯỚNG VƯỜN', 2, 1, 'BB – 2,850,000 VND/MỖI ĐÊM\r\nBBVS – 3,750,000 VND/MỖI ĐÊM\r\nFB – 4,750,000 VND/MỖI ĐÊM\r\nFBVS – 5,550,000 VND/MỖI ĐÊM', 'Phòng 01 giường lớn hoặc 02 giường đơn.\r\nHướng vườn.\r\nDiện tích trung bình 46m2.\r\nTối đa 02 người lớn và 02 trẻ em dưới 12 tuổi ở (có phụ thu).\r\nĐặt ngay, thanh toán sau.', 'images/vinpearlresortspaphuquoc/room_default.jpg'),
(9, 1, 'PHÒNG DELUXE HƯỚNG HỒ BƠI', 2, 1, 'BB – 3,150,000 VND/MỖI ĐÊM\r\nBBVS – 4,050,000 VND/MỖI ĐÊM\r\nFB – 4,950,000 VND/MỖI ĐÊM\r\nFBVS – 5,850,000 VND/MỖI ĐÊM', 'Phòng 01 giường lớn hoặc 02 giường đơn.\r\nHướng hồ bơi.\r\nDiện tích trung bình 46m2.\r\nTối đa 02 người lớn và 02 trẻ em dưới 12 tuổi ở (có phụ thu).\r\nĐặt ngay, thanh toán sau.', 'images/vinpearlresortspaphuquoc/room_default.jpg'),
(10, 1, 'PHÒNG DELUXE HƯỚNG BIỂN', 2, 1, 'BB – 3,350,000 VND/MỖI ĐÊM\r\nBBVS – 4,250,000 VND/MỖI ĐÊM\r\nFB – 5,150,000 VND/MỖI ĐÊM\r\nFBVS – 6,050,000 VND/MỖI ĐÊM', 'Phòng 01 giường lớn hoặc 02 giường đơn.\r\nHướng biển.\r\nDiện tích trung bình 46m2.\r\nTối đa 02 người lớn và 02 trẻ em dưới 12 tuổi ở (có phụ thu).\r\nĐặt ngay, thanh toán sau.', 'images/vinpearlresortspaphuquoc/room_default.jpg'),
(11, 2, 'Phòng Studio', 2, 0, '2.300.000 ₫ mỗi đêm', '2 khách.\r\n2 giường. \r\nĐặt ngay, thanh toán sau.\r\nBao gồm bữa sáng buffet.\r\nĐậu xe miễn phí.', 'images/vinpearlcodoteldanang/room_studio.jpg'),
(12, 2, 'Phòng Executive', 2, 1, '2.850.000 ₫ mỗi đêm', '2 khách.\r\n02 giường đơn/1 giường cỡ king.\r\nĐặt ngay, thanh toán sau.\r\nBao gồm bữa sáng buffet.\r\nĐậu xe miễn phí.', 'images/vinpearlcodoteldanang/room_executive.jpg'),
(13, 2, 'Phòng Executive River View', 0, 1, '3.550.000 ₫ mỗi đêm', '2 khách.\r\n1 giường cỡ king.\r\nĐặt ngay, thanh toán sau.\r\nBao gồm bữa sáng buffet.\r\nĐậu xe miễn phí.', 'images/vinpearlcodoteldanang/room_executive_river.jpg'),
(14, 3, 'STANDARD KING ROOM / TWIN ROOM', 2, 1, 'BB – 2,500,000 VND/MỖI ĐÊM\r\nBBVS – 3,400,000 VND/MỖI ĐÊM\r\nFB – 4,300,000 VND/MỖI ĐÊM\r\nFBVS – 5,200,000 VND/MỖI ĐÊM', '01 giường cỡ King (02NL) Hoặc 02 giường đơn (single bed) (02NL)\r\nDiện tích: 42m2\r\nHướng vườn.\r\nTối đa: 02 NL +02 TE, 03 NL + 01 TE (Có phụ thu)\r\nĐặt ngay, thanh toán sau.', 'images/vinoasisphuquoc/room_king.jpg'),
(15, 3, 'JUNIOR SUITE ROOM', 0, 1, 'BB – 3,350,000 VND/MỖI ĐÊM\r\nBBVS – 4,250,000 VND/MỖI ĐÊM\r\nFB – 5,150,000 VND/MỖI ĐÊM\r\nFBVS – 6,050,000 VND/MỖI ĐÊM', '01 giường cỡ King (02NL)\r\nDiện tích: 84m2.\r\nHướng vườn.\r\nTối đa: 02 NL +02 TE, 03 NL + 01 TE (Có phụ thu)\r\nĐặt ngay, thanh toán sau.', 'images/vinoasisphuquoc/room_junior.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tour`
--

CREATE TABLE `tour` (
  `id_tour` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `id_dest` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `type` enum('Trong nước','Ngoài nước') NOT NULL,
  `price` int(11) NOT NULL,
  `desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tour`
--

INSERT INTO `tour` (`id_tour`, `name`, `id_dest`, `duration`, `date`, `time`, `type`, `price`, `desc`) VALUES
(101, 'Du lịch Miền Bắc', 84001, 5, '2024-12-01', '09:00:00', 'Trong nước', 3000000, 'Du lịch Miền Bắc: Hà Nội, vịnh Hạ Long'),
(102, 'Du lịch Huế', 84002, 3, '2024-12-01', '09:00:00', 'Trong nước', 2000000, 'Du lịch cung đình Huế'),
(103, 'Du lịch Đà Nẵng', 84003, 3, '2024-12-02', '09:00:00', 'Trong nước', 2000000, 'Du lịch Đà Nẵng, phiêu du tại Bà Nà Hill'),
(104, 'Du lịch Nha Trang', 84004, 3, '2024-12-02', '09:00:00', 'Trong nước', 1000000, 'Du lịch biển Nha Trang'),
(105, 'Du lịch Đà Lạt', 84005, 3, '2024-12-02', '09:00:00', 'Trong nước', 1000000, 'Du lịch Đà Lạt\r\nMát lạnh bạc hà'),
(201, 'Du lịch Singapore', 65000, 5, '2024-12-01', '09:00:00', 'Ngoài nước', 10000000, 'Du lịch Singapore vui lắm'),
(202, 'Du lịch Thái Lan', 66000, 3, '2024-12-02', '09:00:00', 'Ngoài nước', 10000000, 'Du lịch Thái Lan vui lắm'),
(203, 'Du lịch Nhật Bản', 81000, 7, '2024-12-03', '09:00:00', 'Ngoài nước', 20000000, 'Du lịch Nhật Bản quá đã'),
(204, 'Du lịch Hàn Quốc', 82000, 7, '2024-12-03', '09:00:00', 'Ngoài nước', 20000000, 'Du lịch Hàn Quốc cùng các oppa'),
(205, 'Du lịch Trung Quốc', 86000, 7, '2024-12-03', '09:00:00', 'Ngoài nước', 15000000, 'Du lịch Trung Quốc\r\nMẵn cuối hài dón khíu chọ');

-- --------------------------------------------------------

--
-- Table structure for table `tourcar`
--

CREATE TABLE `tourcar` (
  `id` int(11) NOT NULL,
  `cartype` varchar(50) NOT NULL,
  `priceperday` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tourcar`
--

INSERT INTO `tourcar` (`id`, `cartype`, `priceperday`) VALUES
(4, 'Xe 7 chỗ', 1000000),
(5, 'Xe 11 chỗ', 1500000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` enum('Admin','User') NOT NULL DEFAULT 'User',
  `status` enum('Active','Inactive','Banned') NOT NULL DEFAULT 'Active',
  `createdat` datetime NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `email`, `password`, `phone`, `address`, `role`, `status`, `createdat`, `reset_token`, `reset_expires`) VALUES
(6, 'admin', 'admin123@gmail.com', 'admin123', '0963852741', '123 abc', 'Admin', 'Active', '2024-11-24 21:13:00', NULL, NULL),
(7, '', 'user2@gmail.com', 'user2', '0963852742', '', 'User', 'Active', '2024-11-24 21:16:12', '194055', '2024-11-25 00:01:56'),
(8, '', 'giahuy.nguyenx00@gmail.com', 'abc123', '0963852742', '', 'User', 'Active', '2024-11-24 21:18:14', '498768', '2024-11-25 11:56:46'),
(9, '', 'user3@gmail.com', 'abc123', '0123654741', '', 'User', 'Active', '2024-11-24 23:23:16', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `airlines_list`
--
ALTER TABLE `airlines_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `airport_list`
--
ALTER TABLE `airport_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booked_flight`
--
ALTER TABLE `booked_flight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_book`,`id_user`,`id_tour`,`id_depa`),
  ADD KEY `MaBook` (`id_book`,`id_user`,`id_tour`,`id_depa`),
  ADD KEY `FK_Tour` (`id_tour`),
  ADD KEY `FK_Depa` (`id_depa`);

--
-- Indexes for table `booking_request`
--
ALTER TABLE `booking_request`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `booking_room_id` (`id_hotel`),
  ADD KEY `booking_hotel_id` (`id_hotel`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cartype` (`cartype`);

--
-- Indexes for table `departure`
--
ALTER TABLE `departure`
  ADD PRIMARY KEY (`id_depa`),
  ADD KEY `MaDepa` (`id_depa`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id_dest`),
  ADD KEY `MaDest` (`id_dest`);

--
-- Indexes for table `flight_list`
--
ALTER TABLE `flight_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `khachsan`
--
ALTER TABLE `khachsan`
  ADD PRIMARY KEY (`id_hotel`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id_room`),
  ADD KEY `room_hotel_id` (`id_hotel`);

--
-- Indexes for table `tour`
--
ALTER TABLE `tour`
  ADD PRIMARY KEY (`id_tour`,`id_dest`),
  ADD KEY `MaTour` (`id_tour`,`id_dest`),
  ADD KEY `FK_Dest` (`id_dest`);

--
-- Indexes for table `tourcar`
--
ALTER TABLE `tourcar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cartype` (`cartype`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user` (`id_user`,`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `airlines_list`
--
ALTER TABLE `airlines_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `airport_list`
--
ALTER TABLE `airport_list`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booked_flight`
--
ALTER TABLE `booked_flight`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `booking_request`
--
ALTER TABLE `booking_request`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `flight_list`
--
ALTER TABLE `flight_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `khachsan`
--
ALTER TABLE `khachsan`
  MODIFY `id_hotel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id_room` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tourcar`
--
ALTER TABLE `tourcar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `FK_Depa` FOREIGN KEY (`id_depa`) REFERENCES `departure` (`id_depa`),
  ADD CONSTRAINT `FK_Tour` FOREIGN KEY (`id_tour`) REFERENCES `tour` (`id_tour`);

--
-- Constraints for table `booking_request`
--
ALTER TABLE `booking_request`
  ADD CONSTRAINT `booking_hotel_id` FOREIGN KEY (`id_hotel`) REFERENCES `khachsan` (`id_hotel`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`cartype`) REFERENCES `tourcar` (`cartype`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `room_hotel_id` FOREIGN KEY (`id_hotel`) REFERENCES `khachsan` (`id_hotel`);

--
-- Constraints for table `tour`
--
ALTER TABLE `tour`
  ADD CONSTRAINT `FK_Dest` FOREIGN KEY (`id_dest`) REFERENCES `destination` (`id_dest`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
