-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 14, 2023 at 10:04 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pandora`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int NOT NULL COMMENT 'mã của giỏ hàng',
  `user_id` int NOT NULL COMMENT 'mã của khách hàng',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian tạo ',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(23, 5, '2023-04-12 06:51:08', '2023-04-12 13:51:08'),
(24, 6, '2023-04-12 07:32:15', '2023-04-12 14:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_id` int NOT NULL COMMENT 'mã của giỏ hàng',
  `product_id` int NOT NULL COMMENT 'mã của sản phẩm',
  `size` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'kích thước sản phẩm thêm vào giỏ',
  `color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'màu sắc của sản phẩm',
  `material` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'chất liệu',
  `quantity` int NOT NULL COMMENT 'số lượng sản phẩm',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian thêm sản phẩm vào giỏ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`cart_id`, `product_id`, `size`, `color`, `material`, `quantity`, `created_at`) VALUES
(23, 14, '50', 'Đen', 'Bạc', 1, '2023-04-12 06:55:58'),
(24, 13, 'One size', 'Hồng', 'Bạc cao cấp và mạ vàng hồng 14k', 1, '2023-04-14 06:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL COMMENT 'mã loại chính',
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'tên loại chính',
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'hình ảnh\r\n',
  `status` int NOT NULL DEFAULT '1' COMMENT 'trạng thái(1: hoạt động; 0: ngừng hoạt động)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`) VALUES
(1, 'Charm', 'charm.webp', 0),
(7, 'Vòng', 'category_1681462691.png', 0),
(8, 'Hoa tai', 'hoatai.webp', 1),
(9, 'Nhẫn', 'category_1681462740.png', 1),
(10, 'Dây chuyền', 'daychuyen.webp', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category_child`
--

CREATE TABLE `category_child` (
  `id` int NOT NULL COMMENT 'mã loại phụ',
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'tên loại phụ',
  `category_id` int NOT NULL COMMENT 'mã loại chính'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_child`
--

INSERT INTO `category_child` (`id`, `name`, `category_id`) VALUES
(1, 'Charm thủy tinh', 1),
(2, 'Charm đính đá', 1),
(11, 'Charm chặn', 1),
(12, 'Charm treo', 1),
(13, 'Charm nhỏ', 1),
(14, 'Charm xích an toàn', 1),
(15, 'Charm đặc biệt', 1),
(16, 'Vòng mềm', 7),
(17, 'Vòng dây da', 7),
(18, 'Nhẫn bạc', 9);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL COMMENT 'mã đơn hàng',
  `name_receiver` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'tên người nhận',
  `phone_receiver` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'số điện thoại người nhận',
  `address_receiver` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'địa chỉ người nhận',
  `status` int NOT NULL COMMENT 'trạng thái',
  `total_price` float NOT NULL COMMENT 'tổng tiền',
  `payment_id` int NOT NULL COMMENT 'mã thanh toán',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian đặt',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian cập nhật',
  `note` text COLLATE utf8mb4_general_ci COMMENT 'ghi chú',
  `user_id` int NOT NULL COMMENT 'mã khách hàng',
  `user_admin_id` int DEFAULT NULL COMMENT 'mã\r\n admin',
  `cart_id` int NOT NULL COMMENT 'mã giỏ hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name_receiver`, `phone_receiver`, `address_receiver`, `status`, `total_price`, `payment_id`, `created_at`, `updated_at`, `note`, `user_id`, `user_admin_id`, `cart_id`) VALUES
(3, 'Nguyen Manh', '0986971670', '90 Nguyễn Tuân, Phường Thanh Xuân Trung, Quận Thanh Xuân, Thành phố Hà Nội', 3, 2690000, 0, '2023-04-13 16:21:55', '2023-04-13 16:21:55', '', 6, 2, 24),
(4, 'Nguyen Manh', '0986971670', '90 Nguyễn Tuân, Phường Thanh Xuân Trung, Quận Thanh Xuân, Thành phố Hà Nội', 3, 2390000, 0, '2023-04-14 06:16:10', '2023-04-14 06:16:10', '', 6, 2, 24);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int NOT NULL COMMENT 'mã đơn hàng',
  `product_id` int NOT NULL COMMENT 'mã sản phẩm',
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'tên sản phẩm',
  `size` varchar(15) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'kích thước',
  `color` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'màu sắc',
  `material` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'chất liệu',
  `quantity` int NOT NULL COMMENT 'số lượng',
  `price` float NOT NULL COMMENT 'giá'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `product_id`, `name`, `size`, `color`, `material`, `quantity`, `price`) VALUES
(3, 14, 'Nhẫn bạc có họa tiết Marvel Baby Groot đính đá cubic zirconia và tráng men đen', '50', 'Đen', 'Bạc', 1, 2690000),
(4, 13, 'Charm bạc mạ vàng hồng 14k Pandora Moments vương miện nữ hoàng', 'One size', 'Hồng', 'Bạc cao cấp và mạ vàng hồng 14k', 1, 2390000);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL COMMENT 'mã sản phẩm',
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'tên sản phẩm',
  `color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'màu sắc',
  `material` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'chất liệu',
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'hình ảnh',
  `price` float NOT NULL COMMENT 'giá',
  `description` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'mô tả',
  `status` int NOT NULL DEFAULT '1' COMMENT 'trạng thái',
  `category_child_id` int NOT NULL COMMENT 'mã loại',
  `user_id` int NOT NULL COMMENT 'mã admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `color`, `material`, `image`, `price`, `description`, `status`, `category_child_id`, `user_id`) VALUES
(13, 'Charm bạc mạ vàng hồng 14k Pandora Moments vương miện nữ hoàng', 'Hồng', 'Bạc cao cấp và mạ vàng hồng 14k', 'jw_1681220346.jpg', 2390000, 'Tại sao lại là nữ hoàng trong một ngày khi bạn có thể là một người trong suốt cuộc đời với chiếc vương miện Pandora Moments bằng bạc được đính kim cương sang trọng này? Được tạo ra từ các kim loại hỗn hợp với chi tiết vương miện vương giả và một tấm bảng tròn có khắc \'Nữ hoàng\', chiếc charm nữ hoàng dạng lủng lẳng đôi cho phép bạn nổi bật như nữ hoàng của thế giới của mình. Nó cũng là một món quà phù hợp cho những nữ hoàng tuyệt vời trong cuộc đời bạn, những người xứng đáng có được chiếc vương miện của riêng họ.', 1, 12, 2),
(14, 'Nhẫn bạc có họa tiết Marvel Baby Groot đính đá cubic zirconia và tráng men đen', 'Đen', 'Bạc', 'jw_1681220630.jpg', 2690000, 'Hãy khám phá người anh hùng bên trong chính mình với chiếc nhẫn Marvel Guardians of the Galaxy Baby Groot của chúng tôi. Hoàn thiện bằng tay bằng bạc sterling, chiếc nhẫn này có hình ảnh gương mặt tươi cười của Groot ở giữa và lá quanh dải nhẫn. Để tăng độ sâu và lấp lánh, đôi mắt của Groot được trang trí bằng men đen được bôi tay và bốn chiếc lá được đính bằng cubic zirconia trong suốt. \"Tôi LÀ GROOT\" - điều duy nhất mà Groot nói được khắc trên bên trong dải nhẫn. Thêm chiếc nhẫn này vào bộ sưu tập của bạn như một biểu tượng cho khả năng của bạn để mạnh mẽ hơn mỗi ngày.', 1, 18, 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_size`
--

CREATE TABLE `product_size` (
  `product_id` int NOT NULL COMMENT 'mã sản phẩm',
  `size_id` int NOT NULL COMMENT 'mã kích thước',
  `quantity` int NOT NULL COMMENT 'số lượng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_size`
--

INSERT INTO `product_size` (`product_id`, `size_id`, `quantity`) VALUES
(13, 1, 10),
(14, 4, 4),
(14, 5, 3),
(14, 6, 3),
(14, 7, 4),
(14, 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int NOT NULL COMMENT 'mã kích thước',
  `name` varchar(15) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'kích thước',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `description`) VALUES
(1, 'One size', NULL),
(3, '14,2', 'mm'),
(4, '48', NULL),
(5, '50', NULL),
(6, '52', NULL),
(7, '54', NULL),
(8, '56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL COMMENT 'mã người dùng',
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'tên ',
  `avatar` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'ảnh',
  `gender` tinyint(1) NOT NULL COMMENT 'giới tính',
  `birth_date` date NOT NULL COMMENT 'ngày sinh',
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'email',
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'mật khẩu',
  `phone` varchar(15) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'số điện thoại',
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'địa chỉ',
  `role` int NOT NULL DEFAULT '0' COMMENT 'mã chức vụ (0: khách hàng; 1: nhân viên; 2: quản lý)',
  `token_verification` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'token đăng kí',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'trạng thái kích hoạt(1:kích hoạt, 0:chưa kích hoạt)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian tạo',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'thời gian xóa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `gender`, `birth_date`, `email`, `password`, `phone`, `address`, `role`, `token_verification`, `status`, `created_at`, `deleted_at`) VALUES
(2, 'admin', 'admin_1681220030.jpg', 1, '2001-10-25', 'admin@gmail.com', '$2y$10$pKltmUrDd1NpPUNjuh/JP.qUO4ZHNQ2csQtEQF5vj7fg172pvo27a', '0986971670', 'Phú Xuyên - Hà Nội', 2, '642da28e9b3a31680712334', 1, '2023-04-05 16:32:14', NULL),
(5, 'Phus', NULL, 1, '2001-05-02', 'abc@gmail.com', '123456789', '4124124141421', 'LGHJS', 0, '52353r23r32r32r', 0, '2023-04-12 06:49:37', NULL),
(6, 'Nguyen Manh', NULL, 1, '2001-10-25', 'nvmanh25101@gmail.com', '$2y$10$8uH1NPJURL1m.7IATO4SAO6551zh312Myo52P5XLuWmq3ldj7ZJ86', '0986971670', '175 Tay Son', 0, 'wqejqy3i123', 1, '2023-04-12 07:29:21', NULL),
(8, 'Đỗ Thị Thanh Phương', 'admin_1681405161.jpg', 0, '2001-03-15', 'dothithanhphuong@gmail.com', '$2y$10$NBzliCa7QnHb7cHtE/SX8eOIjR3hM7zp/BK34LnSpRwPXnUkY.LHG', '0986971202', 'Bắc Giang', 1, '643834e97c9711681405161', 1, '2023-04-13 16:59:21', NULL),
(9, 'Vũ Nụ', 'admin_1681460182.jpg', 0, '2001-06-20', 'vunu@gmail.com', '$2y$10$DyJfSVWjWdtG1na.mI1xyOTbfgqfCLmzqj5qvTNeVDY9QAcV4ev0u', '0987654321', 'Nam Định', 1, '64390bd6e4d1a1681460182', 1, '2023-04-14 08:16:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int NOT NULL COMMENT 'mã đánh giá',
  `product_id` int NOT NULL COMMENT 'mã sản phẩm',
  `user_id` int NOT NULL COMMENT 'mã người dùng',
  `rating` int NOT NULL COMMENT 'điểm đánh giá (1-5)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `category_child`
--
ALTER TABLE `category_child`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_admin_id` (`user_admin_id`),
  ADD KEY `FK_orders_carts` (`cart_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_child_id` (`category_child_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`product_id`,`size_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`,`product_id`,`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã của giỏ hàng', AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã loại chính', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category_child`
--
ALTER TABLE `category_child`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã loại phụ', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã đơn hàng', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã sản phẩm', AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã kích thước', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã người dùng', AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã đánh giá';

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `category_child`
--
ALTER TABLE `category_child`
  ADD CONSTRAINT `category_child_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_carts` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_admin_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_child_id`) REFERENCES `category_child` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_size_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
