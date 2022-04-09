-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 08, 2022 lúc 05:44 AM
-- Phiên bản máy phục vụ: 10.1.38-MariaDB
-- Phiên bản PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `landing_page`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `contents`
--

CREATE TABLE `contents` (
  `id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` text,
  `img` longtext,
  `status` int(2) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `contents`
--

INSERT INTO `contents` (`id`, `id_menu`, `description`, `content`, `img`, `status`, `created_at`, `updated_at`) VALUES
(7, 5, '<p>Crypto Education</p>', '<p>We focus on investment course and blockchain developer</p>', '1126632159_05_04_2022_5-50980_computer-guy-meme-transparent.png', 1, '2022-04-05 06:49:55', '2022-04-05 06:49:55'),
(8, 5, '<p>Crypto Alert Group</p>', '<p>Group to share investment recommendations and ask question about&nbsp; Crypto</p>', '131753064_05_04_2022_5-50980_computer-guy-meme-transparent.png', 1, '2022-04-05 07:01:06', '2022-04-05 07:01:06'),
(9, 5, '<p>Crypto Portfolio</p>', '<p>Investment fund for mid term and long team investors</p>', '1393357478_05_04_2022_5-50980_computer-guy-meme-transparent.png', 1, '2022-04-05 07:02:37', '2022-04-05 07:02:37'),
(10, 5, '<p>Naked Coin</p>', '<p>Investment recommentdation run by machine learning and data scanning</p>', '114289110_05_04_2022_5-50980_computer-guy-meme-transparent.png', 1, '2022-04-05 07:03:45', '2022-04-05 07:03:45');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` int(2) NOT NULL,
  `m_order` int(2) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `menus`
--

INSERT INTO `menus` (`id`, `name`, `content`, `description`, `status`, `m_order`, `created_at`, `updated_at`) VALUES
(1, 'Team', NULL, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book<br></p>', 1, 4, NULL, '2022-04-05 06:44:24'),
(5, 'Blockable Hub', NULL, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book<br></p>', 1, 0, NULL, '2022-04-05 06:42:29'),
(8, 'Blockable Nest', NULL, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>', 1, 1, '2022-04-04 03:26:52', '2022-04-05 06:43:13'),
(9, 'Partnership', NULL, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>', 1, 3, '2022-04-04 03:51:18', '2022-04-05 06:43:58'),
(10, 'News', NULL, NULL, 1, 5, '2022-04-05 06:46:23', '2022-04-05 06:47:14'),
(11, 'Contact us', NULL, '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book<br></p>', 1, 6, '2022-04-05 06:47:01', '2022-04-05 06:47:01');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` text,
  `img` longtext,
  `status` int(2) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `tag_name` varchar(255) DEFAULT NULL,
  `type` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `avatar` text,
  `role` int(2) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `avatar`, `role`, `status`, `created_at`, `updated_at`) VALUES
(2, 'admin2@gmail.com', '$2y$10$11XXhUbVJZqnwa.Jm7W21uszMx8tLF1zWbMlvEW9CjFr/KuQ.ghzm', 'admin1', NULL, 0, 0, '2022-04-03 08:13:45', '2022-04-03 09:27:37'),
(4, 'hiupc@gmail.com', '$2y$10$MbEq3Q1IJQ2O7287vQWOpeTn.WzFmsIr33xQviY9daqWjFnYPaPne', 'Híu Pc', NULL, 0, 1, '2022-04-04 01:24:51', '2022-04-04 01:24:51'),
(5, 'admin@gmail.com', '$2a$12$2jg88RQYYuhv0bS1sqvrLeTdR87yu0BMh9bm8Q8M5f3afTWRmkSnC', 'admin', NULL, 1, NULL, NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `contents`
--
ALTER TABLE `contents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
