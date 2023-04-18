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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pandora.carts: ~2 rows (approximately)
REPLACE INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
	(24, 6, '2023-04-12 07:32:15', '2023-04-12 14:32:15'),
	(25, 11, '2023-04-14 15:16:52', '2023-04-14 22:16:52'),
	(26, 2, '2023-04-18 07:01:23', '2023-04-18 14:01:23');

-- Dumping structure for table pandora.cart_item
CREATE TABLE IF NOT EXISTS `cart_item` (
  `cart_id` int NOT NULL COMMENT 'mã của giỏ hàng',
  `product_id` int NOT NULL COMMENT 'mã của sản phẩm',
  `size` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'kích thước sản phẩm thêm vào giỏ',
  `color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'màu sắc của sản phẩm',
  `material` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'chất liệu',
  `quantity` int NOT NULL COMMENT 'số lượng sản phẩm',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian thêm sản phẩm vào giỏ',
  PRIMARY KEY (`cart_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pandora.cart_item: ~1 rows (approximately)

-- Dumping structure for table pandora.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã loại chính',
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'tên loại chính',
  `image` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'hình ảnh\r\n',
  `status` int NOT NULL DEFAULT '1' COMMENT 'trạng thái(1: hoạt động; 0: ngừng hoạt động)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pandora.categories: ~5 rows (approximately)
REPLACE INTO `categories` (`id`, `name`, `image`, `status`) VALUES
	(1, 'Charm', 'admin_1681650120.png', 1),
	(7, 'Vòng', 'category_1681462691.png', 1),
	(8, 'Hoa tai', 'admin_1681650077.png', 1),
	(9, 'Nhẫn', 'category_1681462740.png', 1),
	(10, 'Hàng mới', 'new_item.png', 1);

-- Dumping structure for table pandora.category_child
CREATE TABLE IF NOT EXISTS `category_child` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã loại phụ',
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'tên loại phụ',
  `category_id` int NOT NULL COMMENT 'mã loại chính',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `category_child_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
	(18, 'Nhẫn bạc', 9),
	(19, 'Nhẫn đính đá', 9);

-- Dumping structure for table pandora.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã đơn hàng',
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
  `cart_id` int NOT NULL COMMENT 'mã giỏ hàng',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_admin_id` (`user_admin_id`),
  KEY `FK_orders_carts` (`cart_id`),
  CONSTRAINT `FK_orders_carts` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_admin_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pandora.orders: ~6 rows (approximately)
REPLACE INTO `orders` (`id`, `name_receiver`, `phone_receiver`, `address_receiver`, `status`, `total_price`, `payment_id`, `created_at`, `updated_at`, `note`, `user_id`, `user_admin_id`, `cart_id`) VALUES
	(3, 'Nguyen Manh', '0986971670', '90 Nguyễn Tuân, Phường Thanh Xuân Trung, Quận Thanh Xuân, Thành phố Hà Nội', 3, 2690000, 0, '2023-04-13 16:21:55', '2023-04-13 16:21:55', '', 6, 2, 24),
	(4, 'Nguyen Manh', '0986971670', '90 Nguyễn Tuân, Phường Thanh Xuân Trung, Quận Thanh Xuân, Thành phố Hà Nội', 3, 2390000, 0, '2023-04-14 06:16:10', '2023-04-14 06:16:10', '', 6, 2, 24),
	(5, 'Nguyễn Mạnh', '0986971670', '90 Nguyễn Tuân, ', 5, 2690000, 0, '2023-04-14 16:07:57', '2023-04-14 16:07:57', '', 11, 2, 25),
	(6, 'Nguyễn Mạnh', '0986971670', '90 Nguyễn Tuân, Phường Thanh Xuân Trung, Quận Thanh Xuân, Thành phố Hà Nội', 3, 2390000, 0, '2023-04-14 16:14:52', '2023-04-14 16:14:52', '', 11, 2, 25),
	(7, 'Nguyen Manh', '0986971670', '175, Xã Yên Giả, Thị xã Quế Võ, Tỉnh Bắc Ninh', 5, 5080000, 0, '2023-04-16 05:50:52', '2023-04-16 05:50:52', '', 6, NULL, 24),
	(8, 'Nguyen Manh', '0986971670', '175 , Xã Tiên Minh, Huyện Tiên Lãng, Thành phố Hải Phòng', 3, 2690000, 0, '2023-04-16 06:12:23', '2023-04-16 06:12:23', '', 6, NULL, 24),
	(9, 'Nguyen Manh', '0986971670', '90 Nguyễn Tuân, Phường Thanh Xuân Trung, Quận Thanh Xuân, Thành phố Hà Nội', 4, 2690000, 1, '2023-04-16 16:24:41', '2023-04-16 16:24:41', '', 6, NULL, 24),
	(13, 'Nguyễn Mạnh', '0986971670', '90 Nguyễn Tuân, Phường Thanh Xuân Trung, Quận Thanh Xuân, Thành phố Hà Nội', 1, 4180000, 0, '2023-04-18 04:10:00', '2023-04-18 04:10:00', '', 6, NULL, 24),
	(14, 'admin', '0986971670', 'Phú Xuyên - Hà Nội, Xã Cách Bi, Thị xã Quế Võ, Tỉnh Bắc Ninh', 3, 2690000, 0, '2023-04-18 07:01:36', '2023-04-18 07:01:36', '', 2, NULL, 26),
	(15, 'Nguyễn Mạnh', '0986971670', '90 Nguyễn Tuân, Phường Thanh Xuân Trung, Quận Thanh Xuân, Thành phố Hà Nội', 1, 8360000, 1, '2023-04-18 07:54:38', '2023-04-18 07:54:38', '', 6, 2, 24);

-- Dumping structure for table pandora.order_detail
CREATE TABLE IF NOT EXISTS `order_detail` (
  `order_id` int NOT NULL COMMENT 'mã đơn hàng',
  `product_id` int NOT NULL COMMENT 'mã sản phẩm',
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'tên sản phẩm',
  `size` varchar(15) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'kích thước',
  `color` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'màu sắc',
  `material` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'chất liệu',
  `quantity` int NOT NULL COMMENT 'số lượng',
  `price` float NOT NULL COMMENT 'giá',
  PRIMARY KEY (`order_id`,`product_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pandora.order_detail: ~6 rows (approximately)
REPLACE INTO `order_detail` (`order_id`, `product_id`, `name`, `size`, `color`, `material`, `quantity`, `price`) VALUES
	(3, 14, 'Nhẫn bạc có họa tiết Marvel Baby Groot đính đá cubic zirconia và tráng men đen', '50', 'Đen', 'Bạc', 1, 2690000),
	(4, 13, 'Charm bạc mạ vàng hồng 14k Pandora Moments vương miện nữ hoàng', 'One size', 'Hồng', 'Bạc cao cấp và mạ vàng hồng 14k', 1, 2390000),
	(5, 14, 'Nhẫn bạc có họa tiết Marvel Baby Groot đính đá cubic zirconia và tráng men đen', '50', 'Đen', 'Bạc', 1, 2690000),
	(6, 13, 'Charm bạc mạ vàng hồng 14k Pandora Moments vương miện nữ hoàng', 'One size', 'Hồng', 'Bạc cao cấp và mạ vàng hồng 14k', 1, 2390000),
	(7, 13, 'Charm bạc mạ vàng hồng 14k Pandora Moments vương miện nữ hoàng', 'One size', 'Hồng', 'Bạc cao cấp và mạ vàng hồng 14k', 1, 2390000),
	(7, 14, 'Nhẫn bạc có họa tiết Marvel Baby Groot đính đá cubic zirconia và tráng men đen', '52', 'Đen', 'Bạc', 1, 2690000),
	(8, 14, 'Nhẫn bạc có họa tiết Marvel Baby Groot đính đá cubic zirconia và tráng men đen', '48', 'Đen', 'Bạc', 1, 2690000),
	(9, 14, 'Nhẫn bạc có họa tiết Marvel Baby Groot đính đá cubic zirconia và tráng men đen', '54', 'Đen', 'Bạc', 1, 2690000),
	(13, 15, 'Charm bạc chú bạch tuộc xanh Murano ', 'One size', 'Xanh dương', 'Bạc 92,5', 2, 2090000),
	(14, 14, 'Nhẫn bạc có họa tiết Marvel Baby Groot đính đá cubic zirconia và tráng men đen', '48', 'Đen', 'Bạc', 1, 2690000),
	(15, 15, 'Charm bạc chú bạch tuộc xanh Murano ', 'One size', 'Xanh dương', 'Bạc 92,5', 4, 2090000);

-- Dumping structure for table pandora.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã sản phẩm',
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'tên sản phẩm',
  `color` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'màu sắc',
  `material` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'chất liệu',
  `image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'hình ảnh',
  `price` float NOT NULL COMMENT 'giá',
  `description` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'mô tả',
  `status` int NOT NULL DEFAULT '1' COMMENT 'trạng thái',
  `category_child_id` int NOT NULL COMMENT 'mã loại',
  `user_id` int NOT NULL COMMENT 'mã admin',
  PRIMARY KEY (`id`),
  KEY `category_child_id` (`category_child_id`),
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `name` (`name`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_child_id`) REFERENCES `category_child` (`id`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pandora.products: ~13 rows (approximately)
REPLACE INTO `products` (`id`, `name`, `color`, `material`, `image`, `price`, `description`, `status`, `category_child_id`, `user_id`) VALUES
	(13, 'Charm bạc mạ vàng hồng 14k Pandora Moments vương miện nữ hoàng', 'Hồng', 'Bạc cao cấp và mạ vàng hồng 14k', 'jw_1681220346.jpg', 2390000, 'Tại sao lại là nữ hoàng trong một ngày khi bạn có thể là một người trong suốt cuộc đời với chiếc vương miện Pandora Moments bằng bạc được đính kim cương sang trọng này? Được tạo ra từ các kim loại hỗn hợp với chi tiết vương miện vương giả và một tấm bảng tròn có khắc \'Nữ hoàng\', chiếc charm nữ hoàng dạng lủng lẳng đôi cho phép bạn nổi bật như nữ hoàng của thế giới của mình. Nó cũng là một món quà phù hợp cho những nữ hoàng tuyệt vời trong cuộc đời bạn, những người xứng đáng có được chiếc vương miện của riêng họ.', 1, 12, 2),
	(14, 'Nhẫn bạc có họa tiết Marvel Baby Groot đính đá cubic zirconia và tráng men đen', 'Đen', 'Bạc', 'jw_1681220630.jpg', 2690000, 'Hãy khám phá người anh hùng bên trong chính mình với chiếc nhẫn Marvel Guardians of the Galaxy Baby Groot của chúng tôi. Hoàn thiện bằng tay bằng bạc sterling, chiếc nhẫn này có hình ảnh gương mặt tươi cười của Groot ở giữa và lá quanh dải nhẫn. Để tăng độ sâu và lấp lánh, đôi mắt của Groot được trang trí bằng men đen được bôi tay và bốn chiếc lá được đính bằng cubic zirconia trong suốt. "Tôi LÀ GROOT" - điều duy nhất mà Groot nói được khắc trên bên trong dải nhẫn. Thêm chiếc nhẫn này vào bộ sưu tập của bạn như một biểu tượng cho khả năng của bạn để mạnh mẽ hơn mỗi ngày.', 1, 18, 2),
	(15, 'Charm bạc chú bạch tuộc xanh Murano ', 'Xanh dương', 'Bạc 92,5', 'charmmurano.webp', 2090000, 'Khám phá thế giới tuyệt vời của biển xanh thẳm và thêm chiếc bùa chú bạch tuộc dễ thương này vào đồ trang sức Pandora Moments của bạn. Chiếc charm bạc treo này có thủy tinh Murano hai tông màu xanh lá cây và xanh lam tuyệt đẹp với họa tiết đường lượn sóng ở mặt sau. Các xúc tu màu bạc của đồng bảng Anh cuộn tròn, cho thấy bản chất vui tươi của sinh vật đại dương thân thiện và bí ẩn này. Những viên pha lê nhân tạo có ba màu xanh lam mang lại thêm phần lấp lánh cho chiếc charm và đôi mắt của bạch tuộc.', 1, 12, 2),
	(16, 'Charm bạc Pandora Moments thủy tinh murano hồng', 'Hồng', 'Bạc 92,5', 'charmMuranoHong.webp', 1790000, 'Thêm tông màu hồng vào tiết mục phong cách của bạn với charm thủy tinh Murano này được đặt trên lõi bạc sterling. Mặt kính lấp lánh bắt sáng từ mọi góc độ, giúp chiếc vòng tay của bạn bừng sáng với tông màu hồng tinh tế. Hãy đeo nó với những chiếc vòng tay Pandora Moments yêu thích của bạn hoặc tặng nó cho người yêu màu hồng trong cuộc đời bạn.', 1, 12, 2),
	(17, 'Charm bạc Disney hình chiếc giày Lọ Lem nhiều màu', 'Nhiều màu', 'Bạc 92,5', 'charmDisney.webp', 2690000, 'Nâng tầm phong cách của bạn với Charm treo Disney Cinderella Glass Slipper & Mice. Được thiết kế để kỷ niệm 70 năm ngày thành lập Cinderella của Disney, viên charm hình chiếc giày này có hình đôi bạn thân của cô là Gus và Jaq. Được hoàn thiện thủ công bằng bạc sterling, những con chuột nép mình bên trong giày bao gồm một cụm đá xanh hình trái tim trên mũi và đế được đánh bóng. Với vòng treo được đính cườm cùng những viên đá trong suốt lấp lánh, hãy đeo món trang sức này với những viên charm Disney x Pandora yêu thích của bạn để có một vẻ ngoài đầy mê hoặc.', 1, 12, 2),
	(18, 'Nhẫn Pandora Moments đính đá màu xanh', 'Xanh dương', 'Bạc 92,5', 'ringMomentsblue.webp', 3890000, 'Nâng tầm phong cách của bạn với mẫu nhẫn Blue Rectangular Three Stone Sparkling. Được chế tác từ bạc và hoàn thiện hoàn toàn bằng tay với ba tinh thể nhân tạo hình chữ nhật, một hàng đá CZ cắt hình pavé chân thực chạy dọc theo thân nhẫn, mang cho mẫu nhẫn một ánh nhìn tinh tế. Bạn có thể đeo đơn chiếc hoặc phối nó cùng với các mẫu nhẫn trơn để tạo nên vẻ đẹp thanh lịch, quý phái.', 1, 18, 2),
	(19, 'Vòng tay Pandora Moments đính đá Cz', 'Trong suốt', 'Bạc 92,5', 'vongmoments.webp', 2990000, 'Mang vẻ đẹp của thiên nhiên đến gần hơn với vòng đeo tay chuỗi Herbarium lấp lánh của Pandora. Vòng tay dạng chuỗi bạc này có những viên đá và đá hình marquise xung quanh một viên đá zirconias hình khối được cắt tinh xảo, tạo thành một hình dạng hình học lấy cảm hứng từ cánh hoa và lá. Một nét đẹp thanh lịch hơn của các hình ảnh mà chúng ta luôn tìm thấy trong thiên nhiên, chuỗi vòng thật hoàn hảo để mang lại cảm giác tinh tế cho vẻ ngoài hàng ngày của bạn.', 1, 16, 2),
	(22, 'Charm bạc Disney chú cá Dory phim hoạt hình Pixar', 'Nhiều màu', 'Bạc 92,5', 'charmDory.webp', 2390000, 'Khơi dậy sự lạc quan bên trong bạn với chú cá Dory trong phim hoạt hình của Pixar. Chiếc charm treo bằng bạc này có hình chú cá hay quên rất được yêu thích được làm sống động bằng lớp men tráng thủ công có màu xanh lam, vàng và đen trong suốt, với các chi tiết nổi trên vây và nụ cười tỏa nắng đặc trưng. Chiếc đuôi có khớp nối của cô ấy có thể di chuyển từ bên này sang bên kia giống như cô ấy đang bơi thực sự. Thêm mẫu charm xinh xắn này vào bộ sưu tập của bạn như một lời nhắc nhở hãy tập trung vào mục tiêu của bạn - và đừng bao giờ quên nhìn vào khía cạnh tươi sáng!', 1, 12, 2),
	(23, 'Charm bạc Disney Ohana Lilo tráng men nhiều màu', 'Tráng men', 'Bạc ', 'charmOhano.webp', 2690000, 'Mẫu charm tượng trưng chogia đình, bạn bè Lilo & Stitch của Disney. Chiếc charm Lilo & Stitch bằng bạc hình trái tim này có các nhân vật được yêu thích rất nhiều được làm sống động bằng lớp men tráng bằng tay đầy màu sắc, được thiết kế đính đá Cubic Zirconia bao quanh. Mặt sau của trái tim có dòng chữ "OHANA có nghĩa là gia đình", và một trái tim nhỏ được mạ vàng hồng 14k treo bên dưới có khắc "OHANA" ở một bên..', 1, 12, 2),
	(25, 'Nhẫn bạc Pandora Signature hình tròn bao quanh', 'Trong suốt', 'Không có chất liệu khác', 'nhanSignature.webp', 4190000, 'Được đưa vào một thế giới kỳ diệu với Disney Beauty and the Beast Rose Ring. Lấy cảm hứng từ bông hồng mê hoặc trong bộ phim, chiếc nhẫn có một bông hồng đá zirconia hình khối màu đỏ ở trung tâm của dải, được bao quanh bởi những chiếc lá và cành cong cùng với ba viên đá đỏ nhỏ hơn. Kỷ niệm tình yêu không hoàn hảo nhưng kỳ diệu giữa Belle và Quái vật của Disney, chiếc nhẫn tạo nên một sự bổ sung trang nhã, kỳ quái cho mọi diện mạo.\r\n', 1, 18, 2),
	(26, 'Vòng tay bạc Pandora ngôi sao đính đá ', 'Bạc', 'Bạc 92,5', 'vongNgoisao.webp', 3290000, 'Hãy để tâm trí bạn chìm đắm trong nguồn cảm hứng từ một thế giới mộng mơ và thần kỳ, cùng với sự huyền ảo của bầu trời đêm và những vì sao lấp lánh trong màn đêm tăm tối. Chiếc vòng tay ngôi sao từ chúng tôi được làm nên từ những vì sao bằng bạc có hình dáng khác biệt, được bao phủ xung quanh với những viên đá cubic zirconia lấp lánh, và được ngăn cách bằng những thanh cắt ngang. Chi tiết này gợi lên cho chúng ta thấy hiện thực của cuộc sống vẫn luôn tồn tại song song, bên cạnh những mộng mơ cuồng nhiệt và hoang dại nhất. Mỗi ngôi sao đại diện cho một mảnh quá khứ hoặc một thành công nào đó ở tương lai. Một lần nữa, hãy để cho chiếc vòng tay tinh xảo này gợi nhắc bạn về những khoảnh khắc kiêu hãnh đã tạo nên chính bản thân mình.', 1, 16, 2),
	(27, 'Charm bạc hình trái tim bạc phối với đá Cubic Zirconia', 'Trong suốt', 'Mạ vàng 14k và bạc 92,5', 'charmCubic.webp', 3290000, 'Sao Chức Nữ (Vega) và sao Ngưu Lang (Altair), dải Ngân Hà và hiện tượng mưa ngâu diễn ra vào đầu tháng Bảy âm lịch ở Việt Nam, hay còn gọi là lễ Thất tịch. Đây cùng là thời điểm để các cặp đôi thể hiện tình yêu của mình hoặc cầu mong sớm có được tình yêu viết nên câu chuyện tình lãng mạn như ông ngâu và bà ngâu trong truyền thuyết. Viên charm như chứng nhân của cuộc gặp gỡ giữ hai tâm hồn đồng điệu. Charm được thiết kế với 2 tone – 2 kim loại hình trái tim, bao bên ngoài là hình ảnh của ngôi sao bang, được gập lại 3 lần tạo nên góc cạnh của trái tim ', 1, 12, 2),
	(28, 'Vòng tay Pandora Moments, phủ vàng 14k đính đá Cz', 'Trong suốt', 'Mạ vàng 14k', 'vongvang14k.webp', 6890000, 'Nâng tầm vẻ ngoài của bạn với vòng tay Sparkling Halo Tennis. Được mạ vàng 14k sang trọng, tác phẩm hoàn thiện bằng tay này được trang trí bằng rất nhiều những viên đá lấp lánh. Phần trung tâm có một viên đá lớn ở giữa được bao quanh bởi một vầng hào quang của các viên đá zirconia hình khối rõ ràng. Vòng tay Sparkling Halo Tennis này bao gồm một móc khóa càng để đóng an toàn. Phối nhiều kiểu với các sản phẩm Pandora Timeless lung linh khác để có một vẻ ngoài cổ điển nhưng không kém phần nổi bật.', 1, 16, 2);

-- Dumping structure for table pandora.product_size
CREATE TABLE IF NOT EXISTS `product_size` (
  `product_id` int NOT NULL COMMENT 'mã sản phẩm',
  `size_id` int NOT NULL COMMENT 'mã kích thước',
  `quantity` int NOT NULL COMMENT 'số lượng',
  PRIMARY KEY (`product_id`,`size_id`),
  KEY `size_id` (`size_id`),
  CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_size_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pandora.product_size: ~6 rows (approximately)
REPLACE INTO `product_size` (`product_id`, `size_id`, `quantity`) VALUES
	(13, 1, 10),
	(14, 4, 4),
	(14, 5, 4),
	(14, 6, 4),
	(14, 7, 4),
	(14, 8, 4),
	(15, 1, -1),
	(25, 4, 3);

-- Dumping structure for table pandora.sizes
CREATE TABLE IF NOT EXISTS `sizes` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã kích thước',
  `name` varchar(15) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'kích thước',
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pandora.sizes: ~7 rows (approximately)
REPLACE INTO `sizes` (`id`, `name`, `description`) VALUES
	(1, 'One size', NULL),
	(4, '48', NULL),
	(5, '50', NULL),
	(6, '52', NULL),
	(7, '54', NULL),
	(8, '56', NULL);

-- Dumping structure for table pandora.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã người dùng',
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
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'thời gian xóa',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pandora.users: ~7 rows (approximately)
REPLACE INTO `users` (`id`, `name`, `avatar`, `gender`, `birth_date`, `email`, `password`, `phone`, `address`, `role`, `token_verification`, `status`, `created_at`, `deleted_at`) VALUES
	(2, 'admin', 'admin_1681220030.jpg', 1, '2001-10-25', 'admin@gmail.com', '$2y$10$pKltmUrDd1NpPUNjuh/JP.qUO4ZHNQ2csQtEQF5vj7fg172pvo27a', '0986971670', 'Phú Xuyên - Hà Nội', 2, '642da28e9b3a31680712334', 1, '2023-04-05 16:32:14', NULL),
	(6, 'Nguyễn Mạnh', NULL, 1, '2001-10-25', 'nvmanh25101@gmail.com', '$2y$10$8uH1NPJURL1m.7IATO4SAO6551zh312Myo52P5XLuWmq3ldj7ZJ86', '0986971670', '90 Nguyễn Tuân, Phường Thanh Xuân Trung, Quận Thanh Xuân, Thành phố Hà Nội', 0, 'wqejqy3i123', 1, '2023-04-12 07:29:21', NULL),
	(8, 'Đỗ Thị Thanh Phương', 'admin_1681405161.jpg', 0, '2001-03-15', 'dothithanhphuong@gmail.com', '$2y$10$NBzliCa7QnHb7cHtE/SX8eOIjR3hM7zp/BK34LnSpRwPXnUkY.LHG', '0986971202', 'Bắc Giang', 1, '643834e97c9711681405161', 1, '2023-04-13 16:59:21', NULL),
	(9, 'Vũ Nụ', 'admin_1681460182.jpg', 0, '2001-06-20', 'vunu@gmail.com', '$2y$10$DyJfSVWjWdtG1na.mI1xyOTbfgqfCLmzqj5qvTNeVDY9QAcV4ev0u', '0987654321', 'Nam Định', 1, '64390bd6e4d1a1681460182', 1, '2023-04-14 08:16:23', NULL),
	(11, 'Nguyễn Mạnh', NULL, 1, '2001-10-25', 'onk252001@gmail.com', '$2y$10$BZ41Wzd/Oir9lb1OxOsnO.md4gmD3AN6QBLoZ/i7F1FAffWN/YrnO', '0986971670', '90 Nguyễn Tuân, Phường Thanh Xuân Trung, Quận Thanh Xuân, Thành phố Hà Nội', 0, '64396e175c2d11681485335', 1, '2023-04-14 15:15:35', NULL),
	(12, 'Phạm Phú', 'admin_1681636621.jpg', 1, '2001-05-20', 'phamphu@gmail.com', '$2y$10$.clAv71lBvsx.FF6Xbj9H.lLhINC60qBJ4IY2Pz8L8uBJxWooeFge', '0987998084', 'Hải Dương', 1, '643bbd0d511081681636621', 1, '2023-04-16 09:17:01', NULL),
	(17, 'Mai Đạt', 'admin_1681637614.jpg', 1, '2001-02-17', 'maidat@gmail.com ', '$2y$10$JlQCb/rTOzD6cQ4S9/3U6eF.lwIMSHBJOIhyynOtmVJRF/kKmghdu', '0808908934', 'Thái Bình', 1, '643bc0ee16dd01681637614', 1, '2023-04-16 09:33:34', NULL),
	(19, 'Nhẫn hồng', NULL, 0, '2001-10-25', 'dothithanhphuong2@gmail.com', '$2y$10$mdSqjjLNvF9aE9NdL2aYaO8yOJjbRi5Tf1bE/x9yvx04/FT/cLrba', '0987998084', '123, Xã Hoàn Long, Huyện Yên Mỹ, Tỉnh Hưng Yên', 0, '643c06e8cf7bb1681655528', 0, '2023-04-16 14:32:08', NULL);

-- Dumping structure for table pandora.votes
CREATE TABLE IF NOT EXISTS `votes` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'mã đánh giá',
  `product_id` int NOT NULL COMMENT 'mã sản phẩm',
  `user_id` int NOT NULL COMMENT 'mã người dùng',
  `rating` int NOT NULL COMMENT 'điểm đánh giá (1-5)',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian tạo',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table pandora.votes: ~1 rows (approximately)
REPLACE INTO `votes` (`id`, `product_id`, `user_id`, `rating`, `created_at`) VALUES
	(1, 14, 6, 4, '2023-04-18 06:32:57'),
	(2, 14, 2, 5, '2023-04-18 07:06:56');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
