-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table pandora.carts
DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã của giỏ hàng',
  `user_id` int(11) NOT NULL COMMENT 'mã của khách hàng',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian tạo ',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian cập nhật',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pandora.carts: ~0 rows (approximately)

-- Dumping structure for table pandora.cart_item
DROP TABLE IF EXISTS `cart_item`;
CREATE TABLE IF NOT EXISTS `cart_item` (
  `cart_id` int(11) NOT NULL COMMENT 'mã của giỏ hàng',
  `product_id` int(11) NOT NULL COMMENT 'mã của sản phẩm',
  `size` int(11) NOT NULL COMMENT 'kích thước sản phẩm thêm vào giỏ',
  `color` varchar(255) NOT NULL COMMENT 'màu sắc của sản phẩm',
  `material` varchar(255) NOT NULL COMMENT 'chất liệu',
  `quantity` int(11) NOT NULL COMMENT 'số lượng sản phẩm',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian thêm sản phẩm vào giỏ',
  PRIMARY KEY (`cart_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pandora.cart_item: ~0 rows (approximately)

-- Dumping structure for table pandora.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã loại chính',
  `name` varchar(255) NOT NULL COMMENT 'tên loại chính',
  `image` varchar(255) DEFAULT NULL COMMENT 'hình ảnh\r\n',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT 'trạng thái(1: hoạt động; 0: ngừng hoạt động)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pandora.categories: ~0 rows (approximately)
INSERT INTO `categories` (`id`, `name`, `image`, `status`) VALUES
	(1, 'Charm', 'category_1680763338.png', 1);

-- Dumping structure for table pandora.category_child
DROP TABLE IF EXISTS `category_child`;
CREATE TABLE IF NOT EXISTS `category_child` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã loại phụ',
  `name` varchar(255) NOT NULL COMMENT 'tên loại phụ',
  `category_id` int(11) NOT NULL COMMENT 'mã loại chính',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_child_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pandora.category_child: ~2 rows (approximately)
INSERT INTO `category_child` (`id`, `name`, `category_id`) VALUES
	(1, 'Charm thủy tinh', 1),
	(2, 'Charm đính đá', 1);

-- Dumping structure for table pandora.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã đơn hàng',
  `name_receiver` varchar(50) NOT NULL COMMENT 'tên người nhận',
  `phone_receiver` varchar(50) NOT NULL COMMENT 'số điện thoại người nhận',
  `address_receiver` varchar(255) NOT NULL COMMENT 'địa chỉ người nhận',
  `status` int(11) NOT NULL COMMENT 'trạng thái',
  `total_price` float NOT NULL COMMENT 'tổng tiền',
  `payment_id` int(11) NOT NULL COMMENT 'mã thanh toán',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian đặt',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian cập nhật',
  `note` text COMMENT 'ghi chú',
  `user_id` int(11) NOT NULL COMMENT 'mã khách hàng',
  `user_admin_id` int(11) NOT NULL COMMENT 'mã\r\n admin',
  `cart_id` int(11) NOT NULL COMMENT 'mã giỏ hàng',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_admin_id` (`user_admin_id`),
  KEY `FK_orders_carts` (`cart_id`),
  CONSTRAINT `FK_orders_carts` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_admin_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pandora.orders: ~0 rows (approximately)

-- Dumping structure for table pandora.order_detail
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_id` int(11) NOT NULL COMMENT 'mã đơn hàng',
  `product_id` int(11) NOT NULL COMMENT 'mã sản phẩm',
  `name` varchar(255) NOT NULL COMMENT 'tên sản phẩm',
  `size` varchar(15) NOT NULL COMMENT 'kích thước',
  `color` varchar(50) NOT NULL COMMENT 'màu sắc',
  `material` varchar(50) NOT NULL COMMENT 'chất liệu',
  `quantity` int(11) NOT NULL COMMENT 'số lượng',
  `price` float NOT NULL COMMENT 'giá',
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pandora.order_detail: ~0 rows (approximately)

-- Dumping structure for table pandora.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã sản phẩm',
  `name` varchar(255) NOT NULL COMMENT 'tên sản phẩm',
  `color` varchar(255) NOT NULL COMMENT 'màu sắc',
  `material` varchar(255) NOT NULL COMMENT 'chất liệu',
  `image` varchar(255) NOT NULL COMMENT 'hình ảnh',
  `price` float NOT NULL COMMENT 'giá',
  `description` text NOT NULL COMMENT 'mô tả',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT 'trạng thái',
  `category_child_id` int(11) NOT NULL COMMENT 'mã loại',
  `user_id` int(11) NOT NULL COMMENT 'mã admin',
  PRIMARY KEY (`id`),
  KEY `category_child_id` (`category_child_id`),
  KEY `user_id` (`user_id`) USING BTREE,
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_child_id`) REFERENCES `category_child` (`id`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pandora.products: ~2 rows (approximately)
INSERT INTO `products` (`id`, `name`, `color`, `material`, `image`, `price`, `description`, `status`, `category_child_id`, `user_id`) VALUES
	(2, 'Charm bạc Pandora Moments thủy tinh murano hồng', 'Hồng', 'Bạc 92,5', 'jw_1680848948.jpg', 1790000, 'Thêm tông màu hồng vào tiết mục phong cách của bạn với charm thủy tinh Murano này được đặt trên lõi bạc sterling. Mặt kính lấp lánh bắt sáng từ mọi góc độ, giúp chiếc vòng tay của bạn bừng sáng với tông màu hồng tinh tế. Hãy đeo nó với những chiếc vòng tay Pandora Moments yêu thích của bạn hoặc tặng nó cho người yêu màu hồng trong cuộc đời bạn.', 1, 1, 2);

-- Dumping structure for table pandora.product_size
DROP TABLE IF EXISTS `product_size`;
CREATE TABLE IF NOT EXISTS `product_size` (
  `product_id` int(11) NOT NULL COMMENT 'mã sản phẩm',
  `size_id` int(11) NOT NULL COMMENT 'mã kích thước',
  `quantity` int(11) NOT NULL COMMENT 'số lượng',
  PRIMARY KEY (`product_id`,`size_id`),
  KEY `size_id` (`size_id`),
  CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_size_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pandora.product_size: ~0 rows (approximately)
INSERT INTO `product_size` (`product_id`, `size_id`, `quantity`) VALUES
	(2, 1, 20);

-- Dumping structure for table pandora.sizes
DROP TABLE IF EXISTS `sizes`;
CREATE TABLE IF NOT EXISTS `sizes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã kích thước',
  `name` varchar(15) NOT NULL COMMENT 'kích thước',
  `unit` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pandora.sizes: ~1 rows (approximately)
INSERT INTO `sizes` (`id`, `name`, `unit`) VALUES
	(1, 'One size', NULL),
	(3, '14,2', 'mm');

-- Dumping structure for table pandora.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã người dùng',
  `name` varchar(255) NOT NULL COMMENT 'tên ',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'ảnh',
  `gender` tinyint(1) NOT NULL COMMENT 'giới tính',
  `birth_date` date NOT NULL COMMENT 'ngày sinh',
  `email` varchar(255) NOT NULL COMMENT 'email',
  `password` varchar(255) NOT NULL COMMENT 'mật khẩu',
  `phone` varchar(15) NOT NULL COMMENT 'số điện thoại',
  `address` varchar(255) NOT NULL COMMENT 'địa chỉ',
  `role` int(2) NOT NULL DEFAULT '0' COMMENT 'mã chức vụ (0: khách hàng; 1: nhân viên; 2: quản lý)',
  `token_verification` varchar(255) NOT NULL COMMENT 'token đăng kí',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'trạng thái kích hoạt(1:kích hoạt, 0:chưa kích hoạt)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian tạo',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'thời gian xóa',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pandora.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `name`, `avatar`, `gender`, `birth_date`, `email`, `password`, `phone`, `address`, `role`, `token_verification`, `status`, `created_at`, `deleted_at`) VALUES
	(2, 'admin', NULL, 1, '2001-10-25', 'admin@gmail.com', '$2y$10$pKltmUrDd1NpPUNjuh/JP.qUO4ZHNQ2csQtEQF5vj7fg172pvo27a', '0986971670', 'Phú Xuyên - Hà Nội', 2, '642da28e9b3a31680712334', 1, '2023-04-05 16:32:14', NULL),
	(3, 'Đỗ Thị Thanh Phương', 'admin_1680854146.jpg', 0, '2001-03-15', 'dothithanhphuong@gmail.com', 'dttp123', '0986971202', 'Bắc Giang', 1, '642fcaa6614e51680853670', 1, '2023-04-07 07:47:50', NULL);

-- Dumping structure for table pandora.votes
DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã đánh giá',
  `product_id` int(11) NOT NULL COMMENT 'mã sản phẩm',
  `user_id` int(11) NOT NULL COMMENT 'mã người dùng',
  `rating` int(11) NOT NULL COMMENT 'điểm đánh giá (1-5)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian tạo',
  PRIMARY KEY (`id`,`product_id`,`user_id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table pandora.votes: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
