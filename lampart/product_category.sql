-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 30, 2023 lúc 09:35 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `product_category`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Cat', NULL, NULL),
(4, 'Food', NULL, NULL),
(5, 'Mouse', NULL, NULL),
(6, 'Dog', NULL, NULL),
(11, 'Panda', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `image_url`, `category_id`, `created_at`, `updated_at`) VALUES
(2, 'yellow', '649dcba9e07b8_cat.jpg', 2, NULL, NULL),
(13, 'Food type 1', '649d9b476333e_Pet-food-bowl.jpg', 4, NULL, NULL),
(14, 'fat dog', '649dcc177ce2a_dog.jpg', 6, NULL, NULL),
(15, 'stupid dog', '649dd007047da_dog2.jpg', 6, NULL, NULL),
(17, 'dog 2', '649e7a09ef44c_dog3.jpg', 6, NULL, NULL),
(18, 'dog 4', '649e7a17acd82_dog3.jpg', 6, NULL, NULL),
(19, 'dog 3', '649e7a307bba5_dog3.jpg', 6, NULL, NULL),
(20, 'dog 5', '649e7a3ba0381_dog3.jpg', 6, NULL, NULL),
(21, 'cat 2', '649e7a490eb57_cat.jpg', 2, NULL, NULL),
(22, 'cat 4', '649e7a55dc690_cat.jpg', 2, NULL, NULL),
(23, 'cat 6', '649e7a62b7a87_cat.jpg', 2, NULL, NULL),
(26, 'Food type 1', '649d9b476333e_Pet-food-bowl.jpg', 4, NULL, NULL),
(27, 'cat 6', '649e7a62b7a87_cat.jpg', 2, NULL, NULL),
(34, 'Food type 1 (Copy)', '649d9b476333e_Pet-food-bowl.jpg', 4, NULL, NULL),
(35, 'yellow (Copy)', '649dcba9e07b8_cat.jpg', 2, NULL, NULL),
(36, 'white (Copy)', '649f27e126c38_dog2.jpg', 6, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_product_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
