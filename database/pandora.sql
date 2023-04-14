-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for pandora
CREATE DATABASE IF NOT EXISTS `pandora` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `pandora`;

-- Dumping structure for table pandora.carts
CREATE TABLE IF NOT EXISTS `carts` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã của giỏ hàng',
  `user_id` int NOT NULL COMMENT 'mã của khách hàng',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian tạo ',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian cập nhật',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pandora.carts: ~2 rows (approximately)
REPLACE INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
	(23, 5, '2023-04-12 06:51:08', '2023-04-12 13:51:08'),
	(24, 6, '2023-04-12 07:32:15', '2023-04-12 14:32:15');

-- Dumping structure for table pandora.cart_item
CREATE TABLE IF NOT EXISTS `cart_item` (
  `cart_id` int NOT NULL COMMENT 'mã của giỏ hàng',
  `product_id` int NOT NULL COMMENT 'mã của sản phẩm',
  `size` varchar(50) NOT NULL COMMENT 'kích thước sản phẩm thêm vào giỏ',
  `color` varchar(255) NOT NULL COMMENT 'màu sắc của sản phẩm',
  `material` varchar(255) NOT NULL COMMENT 'chất liệu',
  `quantity` int NOT NULL COMMENT 'số lượng sản phẩm',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian thêm sản phẩm vào giỏ',
  PRIMARY KEY (`cart_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pandora.cart_item: ~2 rows (approximately)
REPLACE INTO `cart_item` (`cart_id`, `product_id`, `size`, `color`, `material`, `quantity`, `created_at`) VALUES
	(23, 14, '50', 'Đen', 'Bạc', 1, '2023-04-12 06:55:58'),
	(24, 13, 'One size', 'Hồng', 'Bạc cao cấp và mạ vàng hồng 14k', 1, '2023-04-14 06:15:39');

-- Dumping structure for table pandora.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã loại chính',
  `name` varchar(255) NOT NULL COMMENT 'tên loại chính',
  `image` varchar(255) DEFAULT NULL COMMENT 'hình ảnh\r\n',
  `status` int NOT NULL DEFAULT '1' COMMENT 'trạng thái(1: hoạt động; 0: ngừng hoạt động)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pandora.categories: ~5 rows (approximately)
REPLACE INTO `categories` (`id`, `name`, `image`, `status`) VALUES
	(1, 'Charm', 'charm.webp', 1),
	(7, 'Vòng', 'vongtay.webp', 1),
	(8, 'Hoa tai', 'hoatai.webp', 1),
	(9, 'Nhẫn', 'ring.webp', 1),
	(10, 'Dây chuyền', 'daychuyen.webp', 1);

-- Dumping structure for table pandora.category_child
CREATE TABLE IF NOT EXISTS `category_child` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã loại phụ',
  `name` varchar(255) NOT NULL COMMENT 'tên loại phụ',
  `category_id` int NOT NULL COMMENT 'mã loại chính',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_child_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pandora.category_child: ~10 rows (approximately)
REPLACE INTO `category_child` (`id`, `name`, `category_id`) VALUES
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

-- Dumping structure for table pandora.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã đơn hàng',
  `name_receiver` varchar(50) NOT NULL COMMENT 'tên người nhận',
  `phone_receiver` varchar(50) NOT NULL COMMENT 'số điện thoại người nhận',
  `address_receiver` varchar(255) NOT NULL COMMENT 'địa chỉ người nhận',
  `status` int NOT NULL COMMENT 'trạng thái',
  `total_price` float NOT NULL COMMENT 'tổng tiền',
  `payment_id` int NOT NULL COMMENT 'mã thanh toán',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian đặt',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian cập nhật',
  `note` text COMMENT 'ghi chú',
  `user_id` int NOT NULL COMMENT 'mã khách hàng',
  `user_admin_id` int DEFAULT NULL COMMENT 'mã\r\n admin',
  `cart_id` int NOT NULL COMMENT 'mã giỏ hàng',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_admin_id` (`user_admin_id`),
  KEY `FK_orders_carts` (`cart_id`),
  CONSTRAINT `FK_orders_carts` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_admin_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pandora.orders: ~2 rows (approximately)
REPLACE INTO `orders` (`id`, `name_receiver`, `phone_receiver`, `address_receiver`, `status`, `total_price`, `payment_id`, `created_at`, `updated_at`, `note`, `user_id`, `user_admin_id`, `cart_id`) VALUES
	(3, 'Nguyen Manh', '0986971670', '90 Nguyễn Tuân, Phường Thanh Xuân Trung, Quận Thanh Xuân, Thành phố Hà Nội', 3, 2690000, 0, '2023-04-13 16:21:55', '2023-04-13 16:21:55', '', 6, 2, 24),
	(4, 'Nguyen Manh', '0986971670', '90 Nguyễn Tuân, Phường Thanh Xuân Trung, Quận Thanh Xuân, Thành phố Hà Nội', 3, 2390000, 0, '2023-04-14 06:16:10', '2023-04-14 06:16:10', '', 6, 2, 24);

-- Dumping structure for table pandora.order_detail
CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_id` int NOT NULL COMMENT 'mã đơn hàng',
  `product_id` int NOT NULL COMMENT 'mã sản phẩm',
  `name` varchar(255) NOT NULL COMMENT 'tên sản phẩm',
  `size` varchar(15) NOT NULL COMMENT 'kích thước',
  `color` varchar(50) NOT NULL COMMENT 'màu sắc',
  `material` varchar(50) NOT NULL COMMENT 'chất liệu',
  `quantity` int NOT NULL COMMENT 'số lượng',
  `price` float NOT NULL COMMENT 'giá',
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pandora.order_detail: ~0 rows (approximately)
REPLACE INTO `order_detail` (`order_id`, `product_id`, `name`, `size`, `color`, `material`, `quantity`, `price`) VALUES
	(3, 14, 'Nhẫn bạc có họa tiết Marvel Baby Groot đính đá cubic zirconia và tráng men đen', '50', 'Đen', 'Bạc', 1, 2690000),
	(4, 13, 'Charm bạc mạ vàng hồng 14k Pandora Moments vương miện nữ hoàng', 'One size', 'Hồng', 'Bạc cao cấp và mạ vàng hồng 14k', 1, 2390000);

-- Dumping structure for table pandora.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã sản phẩm',
  `name` varchar(255) NOT NULL COMMENT 'tên sản phẩm',
  `color` varchar(255) NOT NULL COMMENT 'màu sắc',
  `material` varchar(255) NOT NULL COMMENT 'chất liệu',
  `image` varchar(255) NOT NULL COMMENT 'hình ảnh',
  `price` float NOT NULL COMMENT 'giá',
  `description` text NOT NULL COMMENT 'mô tả',
  `status` int NOT NULL DEFAULT '1' COMMENT 'trạng thái',
  `category_child_id` int NOT NULL COMMENT 'mã loại',
  `user_id` int NOT NULL COMMENT 'mã admin',
  PRIMARY KEY (`id`),
  KEY `category_child_id` (`category_child_id`),
  KEY `user_id` (`user_id`) USING BTREE,
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_child_id`) REFERENCES `category_child` (`id`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pandora.products: ~2 rows (approximately)
REPLACE INTO `products` (`id`, `name`, `color`, `material`, `image`, `price`, `description`, `status`, `category_child_id`, `user_id`) VALUES
	(13, 'Charm bạc mạ vàng hồng 14k Pandora Moments vương miện nữ hoàng', 'Hồng', 'Bạc cao cấp và mạ vàng hồng 14k', 'jw_1681220346.jpg', 2390000, 'Tại sao lại là nữ hoàng trong một ngày khi bạn có thể là một người trong suốt cuộc đời với chiếc vương miện Pandora Moments bằng bạc được đính kim cương sang trọng này? Được tạo ra từ các kim loại hỗn hợp với chi tiết vương miện vương giả và một tấm bảng tròn có khắc \'Nữ hoàng\', chiếc charm nữ hoàng dạng lủng lẳng đôi cho phép bạn nổi bật như nữ hoàng của thế giới của mình. Nó cũng là một món quà phù hợp cho những nữ hoàng tuyệt vời trong cuộc đời bạn, những người xứng đáng có được chiếc vương miện của riêng họ.', 1, 12, 2),
	(14, 'Nhẫn bạc có họa tiết Marvel Baby Groot đính đá cubic zirconia và tráng men đen', 'Đen', 'Bạc', 'jw_1681220630.jpg', 2690000, 'Hãy khám phá người anh hùng bên trong chính mình với chiếc nhẫn Marvel Guardians of the Galaxy Baby Groot của chúng tôi. Hoàn thiện bằng tay bằng bạc sterling, chiếc nhẫn này có hình ảnh gương mặt tươi cười của Groot ở giữa và lá quanh dải nhẫn. Để tăng độ sâu và lấp lánh, đôi mắt của Groot được trang trí bằng men đen được bôi tay và bốn chiếc lá được đính bằng cubic zirconia trong suốt. "Tôi LÀ GROOT" - điều duy nhất mà Groot nói được khắc trên bên trong dải nhẫn. Thêm chiếc nhẫn này vào bộ sưu tập của bạn như một biểu tượng cho khả năng của bạn để mạnh mẽ hơn mỗi ngày.', 1, 18, 2);

-- Dumping structure for table pandora.product_size
CREATE TABLE IF NOT EXISTS `product_size` (
  `product_id` int NOT NULL COMMENT 'mã sản phẩm',
  `size_id` int NOT NULL COMMENT 'mã kích thước',
  `quantity` int NOT NULL COMMENT 'số lượng',
  PRIMARY KEY (`product_id`,`size_id`),
  KEY `size_id` (`size_id`),
  CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_size_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pandora.product_size: ~6 rows (approximately)
REPLACE INTO `product_size` (`product_id`, `size_id`, `quantity`) VALUES
	(13, 1, 10),
	(14, 4, 4),
	(14, 5, 3),
	(14, 6, 3),
	(14, 7, 4),
	(14, 8, 0);

-- Dumping structure for table pandora.sizes
CREATE TABLE IF NOT EXISTS `sizes` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã kích thước',
  `name` varchar(15) NOT NULL COMMENT 'kích thước',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pandora.sizes: ~7 rows (approximately)
REPLACE INTO `sizes` (`id`, `name`, `description`) VALUES
	(1, 'One size', NULL),
	(3, '14,2', 'mm'),
	(4, '48', NULL),
	(5, '50', NULL),
	(6, '52', NULL),
	(7, '54', NULL),
	(8, '56', NULL);

-- Dumping structure for table pandora.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã người dùng',
  `name` varchar(255) NOT NULL COMMENT 'tên ',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'ảnh',
  `gender` tinyint(1) NOT NULL COMMENT 'giới tính',
  `birth_date` date NOT NULL COMMENT 'ngày sinh',
  `email` varchar(255) NOT NULL COMMENT 'email',
  `password` varchar(255) NOT NULL COMMENT 'mật khẩu',
  `phone` varchar(15) NOT NULL COMMENT 'số điện thoại',
  `address` varchar(255) NOT NULL COMMENT 'địa chỉ',
  `role` int NOT NULL DEFAULT '0' COMMENT 'mã chức vụ (0: khách hàng; 1: nhân viên; 2: quản lý)',
  `token_verification` varchar(255) NOT NULL COMMENT 'token đăng kí',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'trạng thái kích hoạt(1:kích hoạt, 0:chưa kích hoạt)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian tạo',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'thời gian xóa',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pandora.users: ~4 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `avatar`, `gender`, `birth_date`, `email`, `password`, `phone`, `address`, `role`, `token_verification`, `status`, `created_at`, `deleted_at`) VALUES
	(2, 'admin', 'admin_1681220030.jpg', 1, '2001-10-25', 'admin@gmail.com', '$2y$10$pKltmUrDd1NpPUNjuh/JP.qUO4ZHNQ2csQtEQF5vj7fg172pvo27a', '0986971670', 'Phú Xuyên - Hà Nội', 2, '642da28e9b3a31680712334', 1, '2023-04-05 16:32:14', NULL),
	(5, 'Phus', NULL, 1, '2001-05-02', 'abc@gmail.com', '123456789', '4124124141421', 'LGHJS', 0, '52353r23r32r32r', 0, '2023-04-12 06:49:37', NULL),
	(6, 'Nguyen Manh', NULL, 1, '2001-10-25', 'nvmanh25101@gmail.com', '$2y$10$8uH1NPJURL1m.7IATO4SAO6551zh312Myo52P5XLuWmq3ldj7ZJ86', '0986971670', '175 Tay Son', 0, 'wqejqy3i123', 1, '2023-04-12 07:29:21', NULL),
	(8, 'Đỗ Thị Thanh Phương', 'admin_1681405161.jpg', 0, '2001-03-15', 'dothithanhphuong@gmail.com', '$2y$10$NBzliCa7QnHb7cHtE/SX8eOIjR3hM7zp/BK34LnSpRwPXnUkY.LHG', '0986971202', 'Bắc Giang', 1, '643834e97c9711681405161', 1, '2023-04-13 16:59:21', NULL);

-- Dumping structure for table pandora.votes
CREATE TABLE IF NOT EXISTS `votes` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã đánh giá',
  `product_id` int NOT NULL COMMENT 'mã sản phẩm',
  `user_id` int NOT NULL COMMENT 'mã người dùng',
  `rating` int NOT NULL COMMENT 'điểm đánh giá (1-5)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian tạo',
  PRIMARY KEY (`id`,`product_id`,`user_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table pandora.votes: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
