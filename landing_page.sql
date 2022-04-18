-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th4 14, 2022 lúc 08:44 AM
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
(7, 5, 'Crypto Education', 'We focus on investment course and blockchain developer', '1126632159_05_04_2022_5-50980_computer-guy-meme-transparent.png', 1, '2022-04-05 06:49:55', '2022-04-05 06:49:55'),
(8, 5, 'Crypto Alert Group', 'Group to share investment recommendations and ask question about&nbsp; Crypto', '131753064_05_04_2022_5-50980_computer-guy-meme-transparent.png', 1, '2022-04-05 07:01:06', '2022-04-05 07:01:06'),
(9, 5, 'Crypto Portfolio', 'Investment fund for mid term and long team investors', '1393357478_05_04_2022_5-50980_computer-guy-meme-transparent.png', 1, '2022-04-05 07:02:37', '2022-04-05 07:02:37'),
(10, 5, 'Naked Coin', 'Investment recommentdation run by machine learning and data scanning', '114289110_05_04_2022_5-50980_computer-guy-meme-transparent.png', 1, '2022-04-05 07:03:45', '2022-04-05 07:03:45'),
(11, 8, 'yggdrasil', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:41:16', '2022-04-13 11:41:16'),
(12, 8, 'N Project', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:41:36', '2022-04-13 11:41:36'),
(13, 8, 'other project', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:41:52', '2022-04-13 11:41:52'),
(14, 8, 'other project', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:41:53', '2022-04-13 11:41:53'),
(15, 9, 'Partnership text test test 1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:42:09', '2022-04-13 11:42:09'),
(16, 9, 'Partnersip 2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:42:25', '2022-04-13 11:42:25'),
(17, 9, 'partner ship 3', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:42:41', '2022-04-13 11:42:41'),
(18, 9, 'partner ship 4', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:42:58', '2022-04-13 11:42:58'),
(19, 12, 'Blockchain Basics', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:43:16', '2022-04-13 11:43:16'),
(20, 12, 'Blockchain & Cryptocurrency (Bitcoin, Ethereum) Essentials', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:43:38', '2022-04-13 11:43:38'),
(21, 12, 'NTF (Non fugible Tokens) for Beginner: Theory and Practice', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:43:52', '2022-04-13 11:43:52'),
(22, 10, 'An exclusive information session for', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:44:09', '2022-04-13 11:44:09'),
(23, 10, 'An exclusive information session for', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:44:23', '2022-04-13 11:44:23'),
(24, 10, 'An exclusive information session for', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:44:44', '2022-04-13 11:44:44'),
(25, 1, 'Jenny Wilson|project manager', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:45:07', '2022-04-13 11:45:07'),
(26, 1, 'Guy Hawkins|Project manager', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:45:21', '2022-04-13 11:45:21'),
(27, 1, 'Jane Cooper|Project Manager', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', '', 1, '2022-04-13 11:45:38', '2022-04-13 11:45:38');

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
(1, 'Team', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 1, 5, NULL, '2022-04-13 12:32:58'),
(5, 'Blockable Hub', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 1, 0, NULL, '2022-04-05 06:42:29'),
(8, 'Blockable Nest', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 1, 1, '2022-04-04 03:26:52', '2022-04-05 06:43:13'),
(9, 'Partnership', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 1, 3, '2022-04-04 03:51:18', '2022-04-05 06:43:58'),
(10, 'News', NULL, NULL, 1, 6, '2022-04-05 06:46:23', '2022-04-13 12:33:05'),
(11, 'Contact us', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 1, 7, '2022-04-05 06:47:01', '2022-04-13 11:40:22'),
(12, 'Blockable academy', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 0, 4, '2022-04-13 11:39:47', '2022-04-13 12:32:49');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `content` text,
  `img` varchar(255) DEFAULT NULL,
  `status` int(2) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `tag_name` varchar(255) DEFAULT NULL,
  `type` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `description`, `content`, `img`, `status`, `created_at`, `updated_at`, `tag_name`, `type`) VALUES
(1, 'News|all levels', 'Blockchain basics', '', 1, '2022-04-13 12:03:49', '2022-04-13 12:03:49', NULL, NULL),
(2, 'News|all levels', 'Blockchain basics', '', 1, '2022-04-13 12:04:06', '2022-04-13 12:04:06', NULL, NULL),
(3, 'News|all levels', 'Blockchain basics', '', 1, '2022-04-13 12:04:17', '2022-04-13 12:04:17', NULL, NULL),
(4, 'News|all levels', 'Blockchain basics', '', 1, '2022-04-13 12:04:28', '2022-04-13 12:04:28', NULL, NULL),
(5, 'News|all levels', 'Blockchain basics', '', 1, '2022-04-13 12:04:36', '2022-04-13 12:04:36', NULL, NULL),
(6, 'News|all levels', 'Blockchain basics', '', 1, '2022-04-13 12:04:44', '2022-04-13 12:04:44', NULL, NULL),
(7, 'News|all levels', 'Blockchain basics', '', 1, '2022-04-13 12:04:54', '2022-04-13 12:04:54', NULL, NULL),
(8, 'News|all levels', 'Blockchain basics', '', 1, '2022-04-13 12:05:04', '2022-04-13 12:05:04', NULL, NULL),
(9, 'News|all levels', 'Blockchain basics', '', 1, '2022-04-13 12:05:13', '2022-04-13 12:05:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `logo_img` varchar(255) DEFAULT NULL,
  `bg_img` varchar(255) DEFAULT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `settings`
--

INSERT INTO `settings` (`id`, `address`, `email`, `phone`, `logo_img`, `bg_img`, `created_at`, `updated_at`) VALUES
(1, 'Đống Đa, Hà Nội', 'daily@gmail.com', '0346753906', '', '', '2022-04-13 12:10:10', '2022-04-13 12:10:10');

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
(1, 'admin@gmail.com', '$2a$12$CX1ABNeNWs7sF0J8/v85p.nweTtWZL3ThFx7CqnjsbNit.CFMfnlC', 'Admin', NULL, 1, 1, NULL, NULL),
(2, 'admin2@gmail.com', '$2y$10$11XXhUbVJZqnwa.Jm7W21uszMx8tLF1zWbMlvEW9CjFr/KuQ.ghzm', 'admin1', NULL, 0, 0, '2022-04-03 08:13:45', '2022-04-03 09:27:37');

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
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT cho bảng `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
