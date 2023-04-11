-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 11, 2023 lúc 12:07 PM
-- Phiên bản máy phục vụ: 10.4.20-MariaDB
-- Phiên bản PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `pandora`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL COMMENT 'mã của giỏ hàng',
  `user_id` int(11) NOT NULL COMMENT 'mã của khách hàng',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'thời gian tạo ',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'thời gian cập nhật'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(20, 2, '2023-04-11 10:02:51', '2023-04-11 17:02:51'),
(21, 2, '2023-04-11 10:02:59', '2023-04-11 17:02:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_id` int(11) NOT NULL COMMENT 'mã của giỏ hàng',
  `product_id` int(11) NOT NULL COMMENT 'mã của sản phẩm',
  `size` int(11) NOT NULL COMMENT 'kích thước sản phẩm thêm vào giỏ',
  `color` varchar(255) NOT NULL COMMENT 'màu sắc của sản phẩm',
  `material` varchar(255) NOT NULL COMMENT 'chất liệu',
  `quantity` int(11) NOT NULL COMMENT 'số lượng sản phẩm',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'thời gian thêm sản phẩm vào giỏ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'mã loại chính',
  `name` varchar(255) NOT NULL COMMENT 'tên loại chính',
  `image` varchar(255) DEFAULT NULL COMMENT 'hình ảnh\r\n',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'trạng thái(1: hoạt động; 0: ngừng hoạt động)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`) VALUES
(1, 'Charm', 'charm.webp', 1),
(7, 'Vòng', 'vongtay.webp', 1),
(8, 'Hoa tai', 'hoatai.webp', 1),
(9, 'Nhẫn', 'ring.webp', 1),
(10, 'Dây chuyền', 'daychuyen.webp', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_child`
--

CREATE TABLE `category_child` (
  `id` int(11) NOT NULL COMMENT 'mã loại phụ',
  `name` varchar(255) NOT NULL COMMENT 'tên loại phụ',
  `category_id` int(11) NOT NULL COMMENT 'mã loại chính'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category_child`
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
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL COMMENT 'mã đơn hàng',
  `name_receiver` varchar(50) NOT NULL COMMENT 'tên người nhận',
  `phone_receiver` varchar(50) NOT NULL COMMENT 'số điện thoại người nhận',
  `address_receiver` varchar(255) NOT NULL COMMENT 'địa chỉ người nhận',
  `status` int(11) NOT NULL COMMENT 'trạng thái',
  `total_price` float NOT NULL COMMENT 'tổng tiền',
  `payment_id` int(11) NOT NULL COMMENT 'mã thanh toán',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'thời gian đặt',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'thời gian cập nhật',
  `note` text DEFAULT NULL COMMENT 'ghi chú',
  `user_id` int(11) NOT NULL COMMENT 'mã khách hàng',
  `user_admin_id` int(11) NOT NULL COMMENT 'mã\r\n admin',
  `cart_id` int(11) NOT NULL COMMENT 'mã giỏ hàng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL COMMENT 'mã đơn hàng',
  `product_id` int(11) NOT NULL COMMENT 'mã sản phẩm',
  `name` varchar(255) NOT NULL COMMENT 'tên sản phẩm',
  `size` varchar(15) NOT NULL COMMENT 'kích thước',
  `color` varchar(50) NOT NULL COMMENT 'màu sắc',
  `material` varchar(50) NOT NULL COMMENT 'chất liệu',
  `quantity` int(11) NOT NULL COMMENT 'số lượng',
  `price` float NOT NULL COMMENT 'giá'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL COMMENT 'mã sản phẩm',
  `name` varchar(255) NOT NULL COMMENT 'tên sản phẩm',
  `color` varchar(255) NOT NULL COMMENT 'màu sắc',
  `material` varchar(255) NOT NULL COMMENT 'chất liệu',
  `image` varchar(255) NOT NULL COMMENT 'hình ảnh',
  `price` float NOT NULL COMMENT 'giá',
  `description` text NOT NULL COMMENT 'mô tả',
  `status` int(11) NOT NULL DEFAULT 1 COMMENT 'trạng thái',
  `category_child_id` int(11) NOT NULL COMMENT 'mã loại',
  `user_id` int(11) NOT NULL COMMENT 'mã admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `color`, `material`, `image`, `price`, `description`, `status`, `category_child_id`, `user_id`) VALUES
(1, 'Charm bạc chú bạch tuộc xanh Murano ', 'Xanh dương', 'Bạc 92,5', 'charmmurano.webp', 2090000, 'Khám phá thế giới tuyệt vời của biển xanh thẳm và thêm chiếc bùa chú bạch tuộc dễ thương này vào đồ trang sức Pandora Moments của bạn. Chiếc charm bạc treo này có thủy tinh Murano hai tông màu xanh lá cây và xanh lam tuyệt đẹp với họa tiết đường lượn sóng ở mặt sau. Các xúc tu màu bạc của đồng bảng Anh cuộn tròn, cho thấy bản chất vui tươi của sinh vật đại dương thân thiện và bí ẩn này. Những viên pha lê nhân tạo có ba màu xanh lam mang lại thêm phần lấp lánh cho chiếc charm và đôi mắt của bạch tuộc.', 1, 12, 2),
(2, 'Charm bạc Pandora Moments thủy tinh murano hồng', 'Hồng', 'Bạc 92,5', 'charmmurano.webp', 1790000, 'Thêm tông màu hồng vào tiết mục phong cách của bạn với charm thủy tinh Murano này được đặt trên lõi bạc sterling. Mặt kính lấp lánh bắt sáng từ mọi góc độ, giúp chiếc vòng tay của bạn bừng sáng với tông màu hồng tinh tế. Hãy đeo nó với những chiếc vòng tay Pandora Moments yêu thích của bạn hoặc tặng nó cho người yêu màu hồng trong cuộc đời bạn.', 1, 12, 2),
(3, 'Charm bạc Disney hình chiếc giày Lọ Lem nhiều màu', 'Nhiều màu', 'Bạc 92,5', 'charmDisney.webp', 2690000, 'Nâng tầm phong cách của bạn với Charm treo Disney Cinderella Glass Slipper & Mice. Được thiết kế để kỷ niệm 70 năm ngày thành lập Cinderella của Disney, viên charm hình chiếc giày này có hình đôi bạn thân của cô là Gus và Jaq. Được hoàn thiện thủ công bằng bạc sterling, những con chuột nép mình bên trong giày bao gồm một cụm đá xanh hình trái tim trên mũi và đế được đánh bóng. Với vòng treo được đính cườm cùng những viên đá trong suốt lấp lánh, hãy đeo món trang sức này với những viên charm Disney x Pandora yêu thích của bạn để có một vẻ ngoài đầy mê hoặc.', 1, 12, 2),
(4, 'Nhẫn Pandora Moments đính đá màu xanh', 'Xanh dương', 'Bạc 92,5', 'ringMomentsblue.webp', 3890000, 'Nâng tầm phong cách của bạn với mẫu nhẫn Blue Rectangular Three Stone Sparkling. Được chế tác từ bạc và hoàn thiện hoàn toàn bằng tay với ba tinh thể nhân tạo hình chữ nhật, một hàng đá CZ cắt hình pavé chân thực chạy dọc theo thân nhẫn, mang cho mẫu nhẫn một ánh nhìn tinh tế. Bạn có thể đeo đơn chiếc hoặc phối nó cùng với các mẫu nhẫn trơn để tạo nên vẻ đẹp thanh lịch, quý phái.', 1, 18, 2),
(5, 'Vòng tay Pandora Moments đính đá Cz', 'Trong suốt', 'Bạc 92,5', 'vongmoments.webp', 2990000, 'Mang vẻ đẹp của thiên nhiên đến gần hơn với vòng đeo tay chuỗi Herbarium lấp lánh của Pandora. Vòng tay dạng chuỗi bạc này có những viên đá và đá hình marquise xung quanh một viên đá zirconias hình khối được cắt tinh xảo, tạo thành một hình dạng hình học lấy cảm hứng từ cánh hoa và lá. Một nét đẹp thanh lịch hơn của các hình ảnh mà chúng ta luôn tìm thấy trong thiên nhiên, chuỗi vòng thật hoàn hảo để mang lại cảm giác tinh tế cho vẻ ngoài hàng ngày của bạn.', 1, 16, 2),
(6, 'Charm bạc chú bạch tuộc xanh Murano ', 'Xanh dương', 'Bạc 92,5', 'charmmurano.webp', 2090000, 'Khám phá thế giới tuyệt vời của biển xanh thẳm và thêm chiếc bùa chú bạch tuộc dễ thương này vào đồ trang sức Pandora Moments của bạn. Chiếc charm bạc treo này có thủy tinh Murano hai tông màu xanh lá cây và xanh lam tuyệt đẹp với họa tiết đường lượn sóng ở mặt sau. Các xúc tu màu bạc của đồng bảng Anh cuộn tròn, cho thấy bản chất vui tươi của sinh vật đại dương thân thiện và bí ẩn này. Những viên pha lê nhân tạo có ba màu xanh lam mang lại thêm phần lấp lánh cho chiếc charm và đôi mắt của bạch tuộc.', 1, 12, 2),
(7, 'Vòng tay Pandora Moments đính đá Cz', 'Trong suốt', 'Bạc 92,5', 'vongmoments.webp', 2990000, 'Mang vẻ đẹp của thiên nhiên đến gần hơn với vòng đeo tay chuỗi Herbarium lấp lánh của Pandora. Vòng tay dạng chuỗi bạc này có những viên đá và đá hình marquise xung quanh một viên đá zirconias hình khối được cắt tinh xảo, tạo thành một hình dạng hình học lấy cảm hứng từ cánh hoa và lá. Một nét đẹp thanh lịch hơn của các hình ảnh mà chúng ta luôn tìm thấy trong thiên nhiên, chuỗi vòng thật hoàn hảo để mang lại cảm giác tinh tế cho vẻ ngoài hàng ngày của bạn.', 1, 12, 2),
(8, 'Vòng tay Pandora Moments đính đá Cz', 'Trong suốt', 'Bạc 92,5', 'vongmoments.webp', 2990000, 'Mang vẻ đẹp của thiên nhiên đến gần hơn với vòng đeo tay chuỗi Herbarium lấp lánh của Pandora. Vòng tay dạng chuỗi bạc này có những viên đá và đá hình marquise xung quanh một viên đá zirconias hình khối được cắt tinh xảo, tạo thành một hình dạng hình học lấy cảm hứng từ cánh hoa và lá. Một nét đẹp thanh lịch hơn của các hình ảnh mà chúng ta luôn tìm thấy trong thiên nhiên, chuỗi vòng thật hoàn hảo để mang lại cảm giác tinh tế cho vẻ ngoài hàng ngày của bạn.', 1, 12, 2),
(9, 'Vòng tay Pandora Moments đính đá Cz', 'Trong suốt', 'Bạc 92,5', 'vongmoments.webp', 2990000, 'Mang vẻ đẹp của thiên nhiên đến gần hơn với vòng đeo tay chuỗi Herbarium lấp lánh của Pandora. Vòng tay dạng chuỗi bạc này có những viên đá và đá hình marquise xung quanh một viên đá zirconias hình khối được cắt tinh xảo, tạo thành một hình dạng hình học lấy cảm hứng từ cánh hoa và lá. Một nét đẹp thanh lịch hơn của các hình ảnh mà chúng ta luôn tìm thấy trong thiên nhiên, chuỗi vòng thật hoàn hảo để mang lại cảm giác tinh tế cho vẻ ngoài hàng ngày của bạn.', 1, 12, 2),
(10, 'Vòng tay Pandora Moments đính đá Cz', 'Trong suốt', 'Bạc 92,5', 'vongmoments.webp', 2990000, 'Mang vẻ đẹp của thiên nhiên đến gần hơn với vòng đeo tay chuỗi Herbarium lấp lánh của Pandora. Vòng tay dạng chuỗi bạc này có những viên đá và đá hình marquise xung quanh một viên đá zirconias hình khối được cắt tinh xảo, tạo thành một hình dạng hình học lấy cảm hứng từ cánh hoa và lá. Một nét đẹp thanh lịch hơn của các hình ảnh mà chúng ta luôn tìm thấy trong thiên nhiên, chuỗi vòng thật hoàn hảo để mang lại cảm giác tinh tế cho vẻ ngoài hàng ngày của bạn.', 1, 12, 2),
(11, 'Vòng tay Pandora Moments đính đá Cz', 'Trong suốt', 'Bạc 92,5', 'vongmoments.webp', 2990000, 'Mang vẻ đẹp của thiên nhiên đến gần hơn với vòng đeo tay chuỗi Herbarium lấp lánh của Pandora. Vòng tay dạng chuỗi bạc này có những viên đá và đá hình marquise xung quanh một viên đá zirconias hình khối được cắt tinh xảo, tạo thành một hình dạng hình học lấy cảm hứng từ cánh hoa và lá. Một nét đẹp thanh lịch hơn của các hình ảnh mà chúng ta luôn tìm thấy trong thiên nhiên, chuỗi vòng thật hoàn hảo để mang lại cảm giác tinh tế cho vẻ ngoài hàng ngày của bạn.', 1, 12, 2),
(12, 'Vòng tay Pandora Moments đính đá Cz', 'Trong suốt', 'Bạc 92,5', 'vongmoments.webp', 2990000, 'Mang vẻ đẹp của thiên nhiên đến gần hơn với vòng đeo tay chuỗi Herbarium lấp lánh của Pandora. Vòng tay dạng chuỗi bạc này có những viên đá và đá hình marquise xung quanh một viên đá zirconias hình khối được cắt tinh xảo, tạo thành một hình dạng hình học lấy cảm hứng từ cánh hoa và lá. Một nét đẹp thanh lịch hơn của các hình ảnh mà chúng ta luôn tìm thấy trong thiên nhiên, chuỗi vòng thật hoàn hảo để mang lại cảm giác tinh tế cho vẻ ngoài hàng ngày của bạn.', 1, 12, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_size`
--

CREATE TABLE `product_size` (
  `product_id` int(11) NOT NULL COMMENT 'mã sản phẩm',
  `size_id` int(11) NOT NULL COMMENT 'mã kích thước',
  `quantity` int(11) NOT NULL COMMENT 'số lượng'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product_size`
--

INSERT INTO `product_size` (`product_id`, `size_id`, `quantity`) VALUES
(1, 1, 20);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL COMMENT 'mã kích thước',
  `name` varchar(15) NOT NULL COMMENT 'kích thước',
  `unit` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `sizes`
--

INSERT INTO `sizes` (`id`, `name`, `unit`) VALUES
(1, 'One size', NULL),
(3, '14,2', 'mm');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'mã người dùng',
  `name` varchar(255) NOT NULL COMMENT 'tên ',
  `avatar` varchar(255) DEFAULT NULL COMMENT 'ảnh',
  `gender` tinyint(1) NOT NULL COMMENT 'giới tính',
  `birth_date` date NOT NULL COMMENT 'ngày sinh',
  `email` varchar(255) NOT NULL COMMENT 'email',
  `password` varchar(255) NOT NULL COMMENT 'mật khẩu',
  `phone` varchar(15) NOT NULL COMMENT 'số điện thoại',
  `address` varchar(255) NOT NULL COMMENT 'địa chỉ',
  `role` int(2) NOT NULL DEFAULT 0 COMMENT 'mã chức vụ (0: khách hàng; 1: nhân viên; 2: quản lý)',
  `token_verification` varchar(255) NOT NULL COMMENT 'token đăng kí',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'trạng thái kích hoạt(1:kích hoạt, 0:chưa kích hoạt)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'thời gian tạo',
  `deleted_at` timestamp NULL DEFAULT NULL COMMENT 'thời gian xóa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `gender`, `birth_date`, `email`, `password`, `phone`, `address`, `role`, `token_verification`, `status`, `created_at`, `deleted_at`) VALUES
(2, 'admin', 'myLogo.png', 1, '2001-10-25', 'admin@gmail.com', '$2y$10$pKltmUrDd1NpPUNjuh/JP.qUO4ZHNQ2csQtEQF5vj7fg172pvo27a', '0986971670', 'Phú Xuyên - Hà Nội', 2, '642da28e9b3a31680712334', 1, '2023-04-05 16:32:14', NULL),
(3, 'Đỗ Thị Thanh Phương', 'admin_1680854146.jpg', 0, '2001-03-15', 'dothithanhphuong@gmail.com', 'dttp123', '0986971202', 'Bắc Giang', 1, '642fcaa6614e51680853670', 1, '2023-04-07 07:47:50', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL COMMENT 'mã đánh giá',
  `product_id` int(11) NOT NULL COMMENT 'mã sản phẩm',
  `user_id` int(11) NOT NULL COMMENT 'mã người dùng',
  `rating` int(11) NOT NULL COMMENT 'điểm đánh giá (1-5)',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'thời gian tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `category_child`
--
ALTER TABLE `category_child`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_admin_id` (`user_admin_id`),
  ADD KEY `FK_orders_carts` (`cart_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_child_id` (`category_child_id`),
  ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Chỉ mục cho bảng `product_size`
--
ALTER TABLE `product_size`
  ADD PRIMARY KEY (`product_id`,`size_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`,`product_id`,`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã của giỏ hàng', AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã loại chính', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `category_child`
--
ALTER TABLE `category_child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã loại phụ', AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã đơn hàng', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã sản phẩm', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã kích thước', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã người dùng', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã đánh giá';

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `category_child`
--
ALTER TABLE `category_child`
  ADD CONSTRAINT `category_child_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_carts` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`user_admin_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_child_id`) REFERENCES `category_child` (`id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `product_size`
--
ALTER TABLE `product_size`
  ADD CONSTRAINT `product_size_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `product_size_ibfk_2` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`);

--
-- Các ràng buộc cho bảng `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
