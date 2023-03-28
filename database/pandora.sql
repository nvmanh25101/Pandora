-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:3306
-- Thời gian đã tạo: Th3 28, 2023 lúc 05:20 PM
-- Phiên bản máy phục vụ: 5.7.33
-- Phiên bản PHP: 7.4.19

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
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL COMMENT 'mã loại chính',
  `name` varchar(255) NOT NULL COMMENT 'tên loại chính',
  `image` varchar(255) DEFAULT NULL COMMENT 'hình ảnh\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_child`
--

CREATE TABLE `category_child` (
  `id` int(11) NOT NULL COMMENT 'mã loại phụ',
  `name` varchar(255) NOT NULL COMMENT 'tên loại phụ',
  `category_id` int(11) NOT NULL COMMENT 'mã loại chính'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `total_price` int(11) NOT NULL COMMENT 'tổng tiền',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian đặt',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian cập nhật',
  `note` text COMMENT 'ghi chú',
  `user_id` int(11) NOT NULL COMMENT 'mã khách hàng',
  `admin_name` varchar(50) NOT NULL COMMENT 'tên admin'
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
  `price` int(11) NOT NULL COMMENT 'giá'
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
  `price` int(11) NOT NULL COMMENT 'giá',
  `description` text NOT NULL COMMENT 'mô tả',
  `status` int(11) NOT NULL COMMENT 'trạng thái',
  `category_child_id` int(11) NOT NULL COMMENT 'mã loại',
  `user_id` int(11) NOT NULL COMMENT 'mã admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_size`
--

CREATE TABLE `product_size` (
  `product_id` int(11) NOT NULL COMMENT 'mã sản phẩm',
  `size_id` int(11) NOT NULL COMMENT 'mã kích thước'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL COMMENT 'mã chức vụ',
  `name` int(11) NOT NULL COMMENT 'tên chức vụ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL COMMENT 'mã kích thước',
  `name` varchar(15) NOT NULL COMMENT 'kích thước'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `role_id` int(11) NOT NULL COMMENT 'mã chức vụ',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `votes`
--

CREATE TABLE `votes` (
  `product_id` int(11) NOT NULL COMMENT 'mã sản phẩm',
  `user_id` int(11) NOT NULL COMMENT 'mã người dùng',
  `star` int(11) NOT NULL COMMENT 'số sao',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'thời gian tạo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `category_child`
--
ALTER TABLE `category_child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_child_id` (`category_child_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `product_size`
--
ALTER TABLE `product_size`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `size_id` (`size_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- Chỉ mục cho bảng `votes`
--
ALTER TABLE `votes`
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã loại chính';

--
-- AUTO_INCREMENT cho bảng `category_child`
--
ALTER TABLE `category_child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã loại phụ';

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã đơn hàng';

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã sản phẩm';

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã chức vụ';

--
-- AUTO_INCREMENT cho bảng `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã kích thước';

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'mã người dùng';

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `category_child`
--
ALTER TABLE `category_child`
  ADD CONSTRAINT `category_child_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

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
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

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
