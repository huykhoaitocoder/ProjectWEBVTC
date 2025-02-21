-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 21, 2025 lúc 05:13 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `apkrebelplay`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `level` enum('Super Admin','Moderator') NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ads`
--

CREATE TABLE `ads` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `display_order` int(11) DEFAULT 1,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `api_keys`
--

CREATE TABLE `api_keys` (
  `id` bigint(20) NOT NULL,
  `developer_id` bigint(20) DEFAULT NULL,
  `api_key` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `apps`
--

CREATE TABLE `apps` (
  `id` bigint(20) NOT NULL,
  `developer_id` bigint(20) DEFAULT NULL,
  `category_id` bigint(20) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `package_name` varchar(255) NOT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `icon` varchar(255) DEFAULT NULL,
  `status` enum('approved','pending','rejected') DEFAULT 'pending',
  `total_downloads` bigint(20) DEFAULT 0,
  `average_rating` decimal(3,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `apps`
--

INSERT INTO `apps` (`id`, `developer_id`, `category_id`, `name`, `description`, `package_name`, `price`, `icon`, `status`, `total_downloads`, `average_rating`, `created_at`) VALUES
(1, 1, 1, 'App 1', 'Ứng dụng quản lý công việc', 'com.app1', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 5000, 4.50, '2025-01-01 03:00:00'),
(2, 2, 2, 'App 2', 'Ứng dụng học lập trình', 'dme', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 3000, 4.20, '2025-01-02 04:00:00'),
(3, 3, 3, 'App 3', 'Ứng dụng chỉnh sửa ảnh', 'com.app3', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 4500, 4.70, '2025-01-03 05:00:00'),
(4, 4, 1, 'App 4', 'Ứng dụng tổ chức sự kiện', 'com.app4', 10.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 2000, 3.80, '2025-01-04 06:00:00'),
(5, 5, 2, 'App 5', 'Ứng dụng tìm việc làm', 'com.app5', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 3500, 4.00, '2025-01-05 07:00:00'),
(6, 6, 3, 'App 6', 'Ứng dụng mua sắm trực tuyến', 'com.app6', 5.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 6000, 4.30, '2025-01-06 08:00:00'),
(7, 7, 1, 'App 7', 'Ứng dụng học ngoại ngữ', 'com.app7', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 5500, 4.60, '2025-01-07 09:00:00'),
(8, 8, 2, 'App 8', 'Ứng dụng xem phim', 'com.app8', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 4000, 4.10, '2025-01-08 10:00:00'),
(9, 9, 3, 'App 9', 'Ứng dụng thể dục thể thao', 'com.app9', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 2500, 4.40, '2025-01-09 11:00:00'),
(10, 10, 1, 'App 10', 'Ứng dụng phát nhạc', 'com.app10', 10.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 7000, 4.80, '2025-01-10 12:00:00'),
(11, 1, 2, 'Pro Photo Editor', 'Ứng dụng chỉnh sửa ảnh chuyên nghiệp', 'com.example.photoeditor', 4.99, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 5000, 4.50, '2025-02-18 12:46:47'),
(12, 2, 3, 'Premium VPN', 'Dịch vụ VPN bảo mật cao', 'com.example.premiumvpn', 9.99, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 12000, 4.70, '2025-02-18 12:46:47'),
(13, 3, 4, 'Music Studio Pro', 'Trình chỉnh sửa âm thanh chuyên nghiệp', 'com.example.musicstudio', 6.99, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 8000, 4.60, '2025-02-18 12:46:47'),
(14, 1, 5, 'Finance Tracker Plus', 'Ứng dụng quản lý tài chính cá nhân', 'com.example.financetracker', 5.99, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 3000, 4.20, '2025-02-18 12:46:47'),
(15, 2, 1, 'Language Master', 'Học ngôn ngữ nhanh chóng', 'com.example.languagemaster', 7.49, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 4000, 4.30, '2025-02-18 12:46:47'),
(16, 3, 2, 'Workout Pro', 'Lập kế hoạch tập luyện chuyên nghiệp', 'com.example.workoutpro', 3.99, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 7000, 4.80, '2025-02-18 12:46:47'),
(17, 4, 3, 'Task Manager Ultimate', 'Quản lý công việc hiệu quả', 'com.example.taskmanager', 8.99, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 6000, 4.40, '2025-02-18 12:46:47'),
(18, 5, 4, 'Stock Market Pro', 'Theo dõi chứng khoán trực tiếp', 'com.example.stockmarket', 10.49, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 9000, 4.90, '2025-02-18 12:46:47'),
(19, 1, 2, 'Free Music Player', 'Trình phát nhạc miễn phí', 'com.example.freemusic', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 15000, 4.60, '2025-02-18 12:50:24'),
(20, 2, 3, 'Fast VPN Free', 'Dịch vụ VPN miễn phí tốc độ cao', 'com.example.fastvpn', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 12000, 4.70, '2025-02-18 12:50:24'),
(21, 3, 4, 'Notes Lite', 'Ứng dụng ghi chú đơn giản', 'com.example.noteslite', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 9000, 4.20, '2025-02-18 12:50:24'),
(22, 4, 1, 'Daily Task Manager', 'Quản lý công việc hàng ngày', 'com.example.dailytasks', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 8000, 4.40, '2025-02-18 12:50:24'),
(23, 5, 2, 'Workout Tracker', 'Theo dõi tập luyện miễn phí', 'com.example.workouttracker', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 11000, 4.80, '2025-02-18 12:50:24'),
(24, 6, 3, 'Weather Now', 'Ứng dụng thời tiết cập nhật', 'com.example.weathernow', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 13000, 4.50, '2025-02-18 12:50:24'),
(25, 7, 4, 'Stock Monitor', 'Theo dõi chứng khoán miễn phí', 'com.example.stockmonitor', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 7000, 4.10, '2025-02-18 12:50:24'),
(26, 8, 5, 'Secure Messenger', 'Nhắn tin bảo mật miễn phí', 'com.example.securemsg', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 14000, 4.90, '2025-02-18 12:50:24'),
(27, 9, 1, 'Travel Guide Free', 'Hướng dẫn du lịch miễn phí', 'com.example.travelguidefree', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 6000, 4.30, '2025-02-18 12:50:24'),
(28, 10, 2, 'Learn Languages', 'Ứng dụng học ngôn ngữ miễn phí', 'com.example.learnlanguages', 0.00, 'https://image.winudf.com/v2/image1/Y29tLnN1cGVyY2VsbC5jbGFzaG9mY2xhbnNfaWNvbl8xNjY1ODMxNTAzXzAyMw/icon.webp?w=280&fakeurl=1&type=.webp', 'approved', 17000, 4.70, '2025-02-18 12:50:24');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_permissions`
--

CREATE TABLE `app_permissions` (
  `id` bigint(20) NOT NULL,
  `app_id` bigint(20) DEFAULT NULL,
  `permission_name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `app_permissions`
--

INSERT INTO `app_permissions` (`id`, `app_id`, `permission_name`, `created_at`) VALUES
(1, 1, 'CAMERA', '2025-01-01 03:00:00'),
(2, 1, 'STORAGE', '2025-01-01 03:00:00'),
(3, 2, 'INTERNET', '2025-01-02 04:00:00'),
(4, 2, 'LOCATION', '2025-01-02 04:00:00'),
(5, 3, 'CAMERA', '2025-01-03 05:00:00'),
(6, 3, 'STORAGE', '2025-01-03 05:00:00'),
(7, 4, 'INTERNET', '2025-01-04 06:00:00'),
(8, 4, 'CAMERA', '2025-01-04 06:00:00'),
(9, 5, 'STORAGE', '2025-01-05 07:00:00'),
(10, 5, 'LOCATION', '2025-01-05 07:00:00'),
(11, 6, 'CAMERA', '2025-01-06 08:00:00'),
(12, 6, 'STORAGE', '2025-01-06 08:00:00'),
(13, 7, 'INTERNET', '2025-01-07 09:00:00'),
(14, 7, 'LOCATION', '2025-01-07 09:00:00'),
(15, 8, 'STORAGE', '2025-01-08 10:00:00'),
(16, 8, 'INTERNET', '2025-01-08 10:00:00'),
(17, 9, 'CAMERA', '2025-01-09 11:00:00'),
(18, 9, 'STORAGE', '2025-01-09 11:00:00'),
(19, 10, 'INTERNET', '2025-01-10 12:00:00'),
(20, 10, 'STORAGE', '2025-01-10 12:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_updates`
--

CREATE TABLE `app_updates` (
  `id` bigint(20) NOT NULL,
  `app_id` bigint(20) DEFAULT NULL,
  `version_id` bigint(20) DEFAULT NULL,
  `update_notes` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `app_versions`
--

CREATE TABLE `app_versions` (
  `id` bigint(20) NOT NULL,
  `app_id` bigint(20) DEFAULT NULL,
  `version_name` varchar(50) NOT NULL,
  `version_code` int(11) NOT NULL,
  `apk_file` varchar(255) NOT NULL,
  `file_size` bigint(20) NOT NULL,
  `status` enum('current','old','hidden') DEFAULT 'current',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `app_versions`
--

INSERT INTO `app_versions` (`id`, `app_id`, `version_name`, `version_code`, `apk_file`, `file_size`, `status`, `created_at`) VALUES
(1, 1, '1.0.0', 1, 'app1_v1.apk', 102400, 'current', '2025-01-01 03:30:00'),
(2, 2, '1.0.0', 1, 'app2_v1.apk', 204800, 'current', '2025-01-02 04:30:00'),
(3, 3, '1.0.0', 1, 'app3_v1.apk', 307200, 'current', '2025-01-03 05:30:00'),
(4, 4, '1.0.0', 1, 'app4_v1.apk', 409600, 'current', '2025-01-04 06:30:00'),
(5, 5, '1.0.0', 1, 'app5_v1.apk', 512000, 'current', '2025-01-05 07:30:00'),
(6, 6, '1.0.0', 1, 'app6_v1.apk', 614400, 'current', '2025-01-06 08:30:00'),
(7, 7, '1.0.0', 1, 'app7_v1.apk', 716800, 'current', '2025-01-07 09:30:00'),
(8, 8, '1.0.0', 1, 'app8_v1.apk', 819200, 'current', '2025-01-08 10:30:00'),
(9, 9, '1.0.0', 1, 'app9_v1.apk', 921600, 'current', '2025-01-09 11:30:00'),
(10, 10, '1.0.0', 1, 'app10_v1.apk', 1024000, 'current', '2025-01-10 12:30:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `banners`
--

CREATE TABLE `banners` (
  `id` bigint(20) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `display_order` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_comments`
--

CREATE TABLE `blog_comments` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `comment` text NOT NULL,
  `status` enum('approved','pending','rejected') DEFAULT 'approved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_id` bigint(20) DEFAULT NULL,
  `published_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('draft','published','archived') DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('app','game','tool') NOT NULL DEFAULT 'app',
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ẩm thực & Đồ uống', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(2, 'Dẫn đường & Bản đồ', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(3, 'Cá nhân hóa giao diện', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(4, 'Công cụ hỗ trợ', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(5, 'Quản lý Doanh nghiệp', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(6, 'Du lịch & Địa phương', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(7, 'Trò chơi Giải trí', 'game', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(8, 'Học tập & Giáo dục', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(9, 'Kết bạn & Hẹn hò', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(10, 'Làm đẹp & Chăm sóc bản thân', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(11, 'Liên lạc & Giao tiếp', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(12, 'Phong cách sống', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(13, 'Mua sắm trực tuyến', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(14, 'Tăng năng suất', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(15, 'Thiết kế & Nghệ thuật', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(16, 'Trang trí Nhà cửa', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(17, 'Nhạc & Âm thanh', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(18, 'Chụp & Chỉnh ảnh', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(19, 'Nuôi dạy trẻ', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(20, 'Ô tô & Phương tiện', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(21, 'Sách & Tham khảo', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(22, 'Quản lý Sự kiện', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(23, 'Sức khỏe & Thể hình', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(24, 'Tài chính cá nhân', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(25, 'Thể thao & Vận động', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(26, 'Dự báo Thời tiết', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(27, 'Thư viện & Trình chiếu', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(28, 'Tin tức & Tạp chí', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(29, 'Đọc Truyện tranh', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(30, 'Xử lý & Biên tập video', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(31, 'Y tế & Chăm sóc sức khỏe', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(32, 'Mạng xã hội', 'app', 'active', '2025-02-20 10:56:45', '2025-02-20 10:56:45'),
(33, 'Âm nhạc & Giai điệu', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(34, 'Chiến thuật & Đối kháng', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(35, 'Cờ bàn & Trí tuệ', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(36, 'Đố vui & Hỏi đáp', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(37, 'Đua xe tốc độ', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(38, 'Giải đố & Mê cung', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(39, 'Trò chơi Giáo dục', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(40, 'Hành động & Phiêu lưu', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(41, 'Mô phỏng thực tế', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(42, 'Nhập vai & Thám hiểm', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(43, 'Cuộc phiêu lưu kỳ thú', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(44, 'Trò chơi Phổ thông', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(45, 'Sòng bạc & May rủi', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(46, 'Thẻ bài chiến lược', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(47, 'Âm nhạc & Vũ điệu', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(48, 'Thể thao & Thi đấu', 'game', 'active', '2025-02-20 10:56:49', '2025-02-20 10:56:49'),
(49, 'Quản lý tập tin', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(50, 'Chụp màn hình & Ghi âm', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(51, 'Trình quét mã QR & Mã vạch', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(52, 'Tiết kiệm pin', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(53, 'Dọn dẹp & Tăng tốc thiết bị', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(54, 'Ứng dụng ghi chú & To-do', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(55, 'Trình dịch & Ngôn ngữ', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(56, 'Máy tính & Công cụ tài chính', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(57, 'Trình quản lý mật khẩu', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(58, 'Công cụ phát Wi-Fi & Kết nối', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(59, 'Đồng hồ báo thức & Hẹn giờ', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(60, 'Công cụ kiểm tra phần cứng', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(61, 'Trình ghi âm cuộc gọi', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(62, 'Ứng dụng quét tài liệu & PDF', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(63, 'Trình điều khiển từ xa', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(64, 'Công cụ hỗ trợ học tập', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(65, 'Ứng dụng tạo mã OTP & Bảo mật', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(66, 'Công cụ chỉnh sửa văn bản', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(67, 'Trình quản lý ứng dụng & sao lưu', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51'),
(68, 'La bàn & Công cụ định hướng', 'tool', 'active', '2025-02-20 10:56:51', '2025-02-20 10:56:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) NOT NULL,
  `code` varchar(50) NOT NULL,
  `discount_percentage` int(11) DEFAULT NULL CHECK (`discount_percentage` between 1 and 100),
  `max_usage` int(11) DEFAULT 1,
  `used_count` int(11) DEFAULT 0,
  `expiration_date` date NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `developers`
--

CREATE TABLE `developers` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `company_name` varchar(255) NOT NULL,
  `website` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `developers`
--

INSERT INTO `developers` (`id`, `user_id`, `company_name`, `website`, `contact_email`, `status`, `created_at`) VALUES
(1, 1, 'Tech Innovations', 'https://techinnovations.com', 'contact@techinnovations.com', 'active', '2025-01-01 03:00:00'),
(2, 2, 'CodeMasters', 'https://codemasters.com', 'info@codemasters.com', 'active', '2025-01-02 04:00:00'),
(3, 3, 'DevSolutions', 'https://devsolutions.com', 'support@devsolutions.com', 'active', '2025-01-03 05:00:00'),
(4, 4, 'AppWorld', 'https://appworld.com', 'contact@appworld.com', 'inactive', '2025-01-04 06:00:00'),
(5, 5, 'MobileTech', 'https://mobiletech.com', 'help@mobiletech.com', 'active', '2025-01-05 07:00:00'),
(6, 6, 'GameHub', 'https://gamehub.com', 'support@gamehub.com', 'active', '2025-01-06 08:00:00'),
(7, 7, 'NextGen Devs', 'https://nextgendevs.com', 'contact@nextgendevs.com', 'inactive', '2025-01-07 09:00:00'),
(8, 8, 'CreativeSoft', 'https://creativesoft.com', 'info@creativesoft.com', 'active', '2025-01-08 10:00:00'),
(9, 9, 'WebSolutions', 'https://websolutions.com', 'support@websolutions.com', 'active', '2025-01-09 11:00:00'),
(10, 10, 'AppMasters', 'https://appmasters.com', 'contact@appmasters.com', 'active', '2025-01-10 12:00:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `developer_apps`
--

CREATE TABLE `developer_apps` (
  `id` bigint(20) NOT NULL,
  `developer_id` bigint(20) DEFAULT NULL,
  `app_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `developer_payments`
--

CREATE TABLE `developer_payments` (
  `id` bigint(20) NOT NULL,
  `developer_id` bigint(20) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('bank_transfer','paypal','check') NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `discounts`
--

CREATE TABLE `discounts` (
  `id` bigint(20) NOT NULL,
  `app_id` bigint(20) DEFAULT NULL,
  `discount_percentage` int(11) DEFAULT NULL CHECK (`discount_percentage` between 1 and 100),
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `downloads`
--

CREATE TABLE `downloads` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `app_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedbacks`
--

CREATE TABLE `feedbacks` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `feedback` text NOT NULL,
  `status` enum('pending','resolved') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `title`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 1, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 1, '2025-02-21 08:48:18', '2025-02-21 08:49:25'),
(2, 2, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:18', '2025-02-21 08:48:18'),
(3, 3, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:18', '2025-02-21 08:48:18'),
(4, 1, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 1, '2025-02-21 08:48:26', '2025-02-21 08:49:24'),
(5, 2, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:26', '2025-02-21 08:48:26'),
(6, 3, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:26', '2025-02-21 08:48:26'),
(7, 1, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 1, '2025-02-21 08:48:29', '2025-02-21 08:49:23'),
(8, 2, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:29', '2025-02-21 08:48:29'),
(9, 3, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:29', '2025-02-21 08:48:29'),
(10, 1, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 1, '2025-02-21 08:48:32', '2025-02-21 08:49:22'),
(11, 2, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:32', '2025-02-21 08:48:32'),
(12, 3, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:32', '2025-02-21 08:48:32'),
(13, 1, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 1, '2025-02-21 08:48:35', '2025-02-21 08:49:21'),
(14, 2, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:35', '2025-02-21 08:48:35'),
(15, 3, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:35', '2025-02-21 08:48:35'),
(16, 1, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 1, '2025-02-21 08:48:43', '2025-02-21 08:49:20'),
(17, 2, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:43', '2025-02-21 08:48:43'),
(18, 3, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:43', '2025-02-21 08:48:43'),
(19, 1, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 1, '2025-02-21 08:48:47', '2025-02-21 08:49:20'),
(20, 2, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:47', '2025-02-21 08:48:47'),
(21, 3, 'Cập nhật mới!', 'Phiên bản mới đã sẵn sàng.', 0, '2025-02-21 08:48:47', '2025-02-21 08:48:47');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `client_secret` varchar(255) NOT NULL,
  `redirect_uri` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `oauth_tokens`
--

CREATE TABLE `oauth_tokens` (
  `id` bigint(20) NOT NULL,
  `client_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `access_token` varchar(255) NOT NULL,
  `refresh_token` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) NOT NULL,
  `purchase_id` bigint(20) DEFAULT NULL,
  `payment_method` enum('credit_card','paypal','bank_transfer') NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `status` enum('success','failed','pending') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `app_id` bigint(20) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','completed','failed') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `purchases`
--

INSERT INTO `purchases` (`id`, `user_id`, `app_id`, `amount`, `payment_status`, `created_at`) VALUES
(1, 2, 10, 50000.00, 'completed', '2025-02-19 03:00:00'),
(2, 3, 12, 75000.00, 'completed', '2025-02-19 04:30:00'),
(3, 4, 15, 100000.00, 'failed', '2025-02-19 06:00:00'),
(4, 5, 18, 0.00, 'completed', '2025-02-19 07:20:00'),
(5, 6, 20, 99000.00, 'completed', '2025-02-19 08:45:00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `refunds`
--

CREATE TABLE `refunds` (
  `id` bigint(20) NOT NULL,
  `purchase_id` bigint(20) DEFAULT NULL,
  `reason` text NOT NULL,
  `refund_status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `app_id` bigint(20) DEFAULT NULL,
  `report_reason_id` bigint(20) DEFAULT NULL,
  `description` text NOT NULL,
  `status` enum('pending','reviewed','resolved') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `report_reasons`
--

CREATE TABLE `report_reasons` (
  `id` bigint(20) NOT NULL,
  `reason` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `app_id` bigint(20) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `status` enum('approved','pending','deleted') DEFAULT 'approved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review_replies`
--

CREATE TABLE `review_replies` (
  `id` bigint(20) NOT NULL,
  `review_id` bigint(20) DEFAULT NULL,
  `developer_id` bigint(20) DEFAULT NULL,
  `response` text NOT NULL,
  `status` enum('approved','pending','deleted') DEFAULT 'approved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) NOT NULL,
  `name` enum('admin','user','developer') NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` bigint(20) NOT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `permission_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `screenshots`
--

CREATE TABLE `screenshots` (
  `id` bigint(20) NOT NULL,
  `app_id` bigint(20) DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) NOT NULL,
  `setting_key` varchar(255) NOT NULL,
  `setting_value` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `position` int(11) DEFAULT 1,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `image`, `link`, `position`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Game Hot Nhất', 'https://i.ibb.co/VppvJ4sN/nh-ch-p-m-n-h-nh-2025-02-19-040410.png', 'https://example.com/game-hot', 1, 'active', '2025-02-17 20:24:36', '2025-02-19 06:26:41'),
(2, 'Ứng Dụng Mới', 'https://i.ibb.co/8LGSZsvS/nh-ch-p-m-n-h-nh-2025-02-19-040711.png', 'https://example.com/ung-dung-moi', 2, 'active', '2025-02-17 20:24:36', '2025-02-19 06:27:43'),
(3, 'Ứng Dụng Hot', 'https://i.ibb.co/VppvJ4sN/nh-ch-p-m-n-h-nh-2025-02-19-040410.png', 'https://example.com/ung-dung-moi', 3, 'active', '2025-02-17 20:24:36', '2025-02-19 06:26:55');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sponsored_apps`
--

CREATE TABLE `sponsored_apps` (
  `id` bigint(20) NOT NULL,
  `app_id` bigint(20) DEFAULT NULL,
  `sponsor_name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `display_order` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `app_id` bigint(20) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','expired','cancelled') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role_id` bigint(20) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'jungdani', 'nickycv2004@gmail.com', '$2y$12$k.5VI6rMq8XcRi54N8nV7.M16Ne.Mc4WP4lqAXJCTSDxyZJnrXY.m', NULL, NULL, 'active', '2025-02-20 05:15:24', '2025-02-20 05:15:24'),
(2, 'jungdanit', 'nickycv2004f@gmail.com', '$2y$12$wk3sjQQzJ7CK9QM86siRUO7WB3nmR8du.XCQAq4c.DXgupM2rKbQ2', NULL, NULL, 'active', '2025-02-20 06:08:02', '2025-02-20 06:08:02'),
(3, 'jungdanit', 'nickycv200@gmail.com', '$2y$12$bvXDYj5Ej4qlajL6C5m/VuO61ERMwXqID8kOo0T0ZHLVKdXcUNB2K', NULL, NULL, 'active', '2025-02-20 07:36:16', '2025-02-20 07:36:16');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `social_links` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_links`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `api_keys`
--
ALTER TABLE `api_keys`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `api_key` (`api_key`);

--
-- Chỉ mục cho bảng `apps`
--
ALTER TABLE `apps`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_name` (`package_name`);

--
-- Chỉ mục cho bảng `app_permissions`
--
ALTER TABLE `app_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `app_updates`
--
ALTER TABLE `app_updates`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `app_versions`
--
ALTER TABLE `app_versions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `blog_comments`
--
ALTER TABLE `blog_comments`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Chỉ mục cho bảng `developers`
--
ALTER TABLE `developers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `developer_apps`
--
ALTER TABLE `developer_apps`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `developer_payments`
--
ALTER TABLE `developer_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`);

--
-- Chỉ mục cho bảng `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `app_id` (`app_id`);

--
-- Chỉ mục cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Chỉ mục cho bảng `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_id` (`client_id`);

--
-- Chỉ mục cho bảng `oauth_tokens`
--
ALTER TABLE `oauth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `access_token` (`access_token`);

--
-- Chỉ mục cho bảng `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transaction_id` (`transaction_id`);

--
-- Chỉ mục cho bảng `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `refunds`
--
ALTER TABLE `refunds`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `report_reasons`
--
ALTER TABLE `report_reasons`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `reason` (`reason`);

--
-- Chỉ mục cho bảng `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `review_replies`
--
ALTER TABLE `review_replies`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `screenshots`
--
ALTER TABLE `screenshots`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Chỉ mục cho bảng `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sponsored_apps`
--
ALTER TABLE `sponsored_apps`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `ads`
--
ALTER TABLE `ads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `api_keys`
--
ALTER TABLE `api_keys`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `apps`
--
ALTER TABLE `apps`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT cho bảng `app_permissions`
--
ALTER TABLE `app_permissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `app_updates`
--
ALTER TABLE `app_updates`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `app_versions`
--
ALTER TABLE `app_versions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `blog_comments`
--
ALTER TABLE `blog_comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT cho bảng `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `developers`
--
ALTER TABLE `developers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `developer_apps`
--
ALTER TABLE `developer_apps`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `developer_payments`
--
ALTER TABLE `developer_payments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `oauth_tokens`
--
ALTER TABLE `oauth_tokens`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `refunds`
--
ALTER TABLE `refunds`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `report_reasons`
--
ALTER TABLE `report_reasons`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `review_replies`
--
ALTER TABLE `review_replies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `screenshots`
--
ALTER TABLE `screenshots`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `sponsored_apps`
--
ALTER TABLE `sponsored_apps`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_2` FOREIGN KEY (`app_id`) REFERENCES `apps` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `downloads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
