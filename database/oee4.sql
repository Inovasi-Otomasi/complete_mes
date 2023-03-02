-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 04 Okt 2022 pada 03.46
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oee4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `event_log`
--

CREATE TABLE `event_log` (
  `id` int(11) NOT NULL,
  `event` varchar(1024) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `event_log`
--

INSERT INTO `event_log` (`id`, `event`, `created_at`) VALUES
(1, 'New order created for line Pasta [SKU KCNG-001: 20 pcs]', '2022-09-15 09:23:29'),
(2, 'Order ID 5 for line Pasta Deleted [KCNG-001: 20 pcs]', '2022-09-15 15:31:37'),
(3, 'New inventory has been added [testinv: 33]', '2022-09-15 15:37:06'),
(4, 'Inventory ID 1 has been changed.', '2022-09-15 15:45:35'),
(5, 'Inventory ID 7 has been deleted.', '2022-09-15 15:54:35'),
(6, 'New remark has been created. [BREAKDOWN: ]', '2022-09-15 16:02:44'),
(7, 'New remark has been created. [BREAKDOWN: Sedang frustasi]', '2022-09-15 16:04:28'),
(8, 'Remark ID 8 has been changed', '2022-09-15 16:04:44'),
(9, 'Remark ID 8 has been deleted.', '2022-09-15 16:06:15'),
(10, 'New PIC has been created. [Mek]', '2022-09-15 16:31:31'),
(11, 'PIC ID 6 has been changed.', '2022-09-15 16:31:39'),
(12, 'PIC ID 6 has been deleted.', '2022-09-15 16:31:51'),
(13, 'Log ID 8 has been changed.', '2022-09-15 16:34:07'),
(14, 'New SKU for line Chopp has been created. [Chopp: 111111]', '2022-09-15 16:36:30'),
(15, 'SKU ID 13 has been changed.', '2022-09-15 16:38:25'),
(16, 'SKU ID 13 has been deleted.', '2022-09-15 16:38:28'),
(17, 'New order has been created for line Pasta. [KCNG-001: 55]', '2022-09-15 16:44:21'),
(18, 'Order ID 35 has been deleted.', '2022-09-15 16:44:30'),
(19, 'New order for line Pasta has been created. [KCNG-001: 2 pcs]', '2022-09-16 09:07:03'),
(20, 'Order ID 36 has been deleted.', '2022-09-16 09:07:12'),
(21, 'New delivery has been created. [gora]', '2022-09-16 09:49:00'),
(22, 'Delivery ID 55 with tracking number IOT/2022/09/16/044859 has been deleted.', '2022-09-16 09:49:05'),
(23, 'New Line has been created. [Customer: test]', '2022-09-16 10:12:20'),
(24, 'Line ID 9 has been deleted.', '2022-09-16 10:12:24'),
(25, 'New order for line Pasta has been created. [KCNG-001: 2 pcs]', '2022-09-16 11:21:39'),
(26, 'Order ID 37 has been deleted.', '2022-09-16 11:24:32'),
(27, 'Order ID 34 has been deleted.', '2022-09-16 11:24:35'),
(28, 'New order for line Pasta has been created. [KCNG-001: 1 pcs]', '2022-09-16 11:24:38'),
(29, 'Order ID 38 has been deleted.', '2022-09-16 11:25:26'),
(30, 'New order for line Pasta has been created. [KCNG-001: 1 pcs]', '2022-09-16 11:25:29'),
(31, 'Order ID 39 has been deleted.', '2022-09-16 11:27:19'),
(32, 'New order for line Pasta has been created. [KCNG-001: 1 pcs]', '2022-09-16 11:27:23'),
(33, 'Line Pasta has been assigned for order .', '2022-09-16 11:27:30'),
(34, 'Order ID 40 has been deleted.', '2022-09-16 11:28:13'),
(35, 'New order for line Pasta has been created. [KCNG-001: 1 pcs]', '2022-09-16 11:28:16'),
(36, 'Line Pasta has been assigned for order 41.', '2022-09-16 11:28:21'),
(37, 'New Line has been created. [Ayam]', '2022-09-16 12:59:00'),
(38, 'New Line has been created. [s]', '2022-09-16 12:59:32'),
(39, 'Line s has been deleted.', '2022-09-16 12:59:37'),
(40, 'All line job stop.', '2022-09-16 13:04:58'),
(41, 'Line Pasta has been assigned for order 41.', '2022-09-16 13:05:10'),
(42, 'Line Pasta job starting.', '2022-09-16 13:05:13'),
(43, 'Line Pasta job standby.', '2022-09-16 13:05:16'),
(44, 'Line Pasta job stop.', '2022-09-16 13:05:19'),
(45, 'All line job stop.', '2022-09-16 13:10:34'),
(46, 'All line job stop.', '2022-09-16 13:11:13'),
(47, 'All line job stop.', '2022-09-16 13:11:18'),
(48, 'All line job stop.', '2022-09-16 13:11:21'),
(49, 'Order ID 41 has been deleted.', '2022-09-16 13:11:28'),
(50, 'Order ID 33 has been deleted.', '2022-09-16 13:11:31'),
(51, 'Order ID 32 has been deleted.', '2022-09-16 13:11:40'),
(52, 'Order ID 31 has been deleted.', '2022-09-16 13:11:43'),
(53, 'Order ID 30 has been deleted.', '2022-09-16 13:11:46'),
(54, 'Order ID 29 has been deleted.', '2022-09-16 13:11:49'),
(55, 'Order ID 27 has been deleted.', '2022-09-16 13:11:52'),
(56, 'Order ID 1 has been deleted.', '2022-09-16 13:11:57'),
(57, 'New delivery has been created. [Customer: Bapak Mek]', '2022-09-16 14:22:35'),
(58, 'Delivery ID 56 with tracking number IOT/2022/09/16/092235 has been deleted.', '2022-09-16 14:23:35'),
(59, 'New SKU has been created. [Pasta: TEST]', '2022-09-21 15:20:11'),
(60, 'New SKU has been created. [[\"Pasta\",\"Almond\"]: 123]', '2022-09-21 17:01:47'),
(61, 'SKU ID 15 has been deleted. [123]', '2022-09-21 17:10:25'),
(62, 'New SKU has been created. [: 123]', '2022-09-21 17:10:32'),
(63, 'New SKU has been created. [: memory_chip]', '2022-09-21 17:21:37'),
(64, 'SKU ID 17 has been changed.', '2022-09-22 11:44:32'),
(65, 'SKU ID 17 has been changed.', '2022-09-22 11:45:11'),
(66, 'SKU ID 17 has been changed.', '2022-09-22 11:45:18'),
(67, 'SKU ID 17 has been changed.', '2022-09-22 11:45:26'),
(68, 'New order for line  has been created. [memory_chip: 10 pcs]', '2022-09-22 11:52:27'),
(69, 'Order ID 42 has been deleted. [memory_chip: 10 pcs]', '2022-09-22 11:52:36'),
(70, 'New order for line {} has been created. [KCNG-001: 12 pcs]', '2022-09-22 11:57:42'),
(71, 'Order ID 43 has been deleted. [KCNG-001: 12 pcs]', '2022-09-22 11:57:46'),
(72, 'New order for line [{\"line_name\":\"Pasta\",\"cycle_time\":12}] has been created. [memory_chip: 1 pcs]', '2022-09-22 11:57:50'),
(73, 'New SKU has been created. [: t]', '2022-09-22 12:32:22'),
(74, 'SKU ID 18 has been deleted. [t]', '2022-09-22 12:32:25'),
(75, 'New order for line  has been created. [KCNG-001: 1 pcs]', '2022-09-22 12:34:32'),
(76, 'Order ID 44 has been deleted. [memory_chip: 1 pcs]', '2022-09-22 12:34:40'),
(77, 'Order ID 45 has been deleted. [KCNG-001: 1 pcs]', '2022-09-22 12:35:30'),
(78, 'New order for line  has been created. [memory_chip: 1 pcs]', '2022-09-22 12:35:34'),
(79, 'New order for line  has been created. [123: 12 pcs]', '2022-09-22 12:38:39'),
(80, 'Line Pasta has been assigned for order 47.', '2022-09-22 14:52:22'),
(81, 'Line Almond has been assigned for order 47.', '2022-09-22 14:52:28'),
(82, 'Line Pasta has been assigned for order 46.', '2022-09-22 14:52:37'),
(83, 'Line Pasta has been assigned for order 47.', '2022-09-22 14:52:45'),
(84, 'New SKU has been created. [: TEST-2]', '2022-09-22 14:54:43'),
(85, 'New order has been created. [TEST-2: 20 pcs]', '2022-09-22 14:58:58'),
(86, 'Line Pasta has been assigned for order 48.', '2022-09-22 14:59:13'),
(87, 'Line Chopp has been assigned for order 48.', '2022-09-22 14:59:17'),
(88, 'SKU ID 2 has been changed.', '2022-09-22 15:02:45'),
(89, 'SKU ID 2 has been changed.', '2022-09-22 15:03:11'),
(90, 'SKU ID 2 has been changed.', '2022-09-22 15:06:26'),
(91, 'SKU ID 3 has been changed.', '2022-09-22 15:06:32'),
(92, 'SKU ID 12 has been deleted. [testsku]', '2022-09-22 15:06:38'),
(93, 'SKU ID 2 has been changed.', '2022-09-22 15:17:57'),
(94, 'SKU ID 3 has been changed.', '2022-09-22 15:18:00'),
(95, 'SKU ID 14 has been changed.', '2022-09-22 15:18:03'),
(96, 'SKU ID 16 has been changed.', '2022-09-22 15:18:07'),
(97, 'SKU ID 17 has been changed.', '2022-09-22 15:18:17'),
(98, 'SKU ID 19 has been changed.', '2022-09-22 15:18:19'),
(99, 'Order ID 48 has been deleted. [TEST-2: 20 pcs]', '2022-09-22 15:18:42'),
(100, 'Order ID 47 has been deleted. [123: 12 pcs]', '2022-09-22 15:18:50'),
(101, 'Order ID 46 has been deleted. [memory_chip: 1 pcs]', '2022-09-22 15:18:54'),
(102, 'New order has been created. [TEST-2: 12 pcs]', '2022-09-22 15:19:15'),
(103, 'Line Chopp has been assigned for order 49.', '2022-09-22 15:21:01'),
(104, 'Line Pasta has been assigned for order 49.', '2022-09-22 15:35:13'),
(105, 'Line Chopp has been assigned for order 49.', '2022-09-22 16:04:34'),
(106, 'Line Pasta has been assigned for order 49.', '2022-09-22 16:04:43'),
(107, 'SKU ID 19 has been changed.', '2022-09-22 16:04:59'),
(108, 'Line Chopp has been assigned for order 49.', '2022-09-22 16:05:07'),
(109, 'Line Pasta\'s job is starting.', '2022-09-22 16:14:47'),
(110, 'Line Chopp\'s job is starting.', '2022-09-22 16:18:27'),
(111, 'Line Pasta\'s job stopped.', '2022-09-22 16:18:44'),
(112, 'Line Chopp\'s job stopped.', '2022-09-22 16:18:48'),
(113, 'New order has been created. [TEST-2: 12 pcs]', '2022-09-22 16:19:16'),
(114, 'Order ID 49 has been deleted. [TEST-2: 12 pcs]', '2022-09-22 16:20:30'),
(115, 'Line Pasta has been assigned for order 50.', '2022-09-22 16:20:36'),
(116, 'Line Pasta\'s job is starting.', '2022-09-22 16:20:40'),
(117, 'Line Chopp has been assigned for order 50.', '2022-09-22 16:20:43'),
(118, 'Line Chopp\'s job is starting.', '2022-09-22 16:20:46'),
(119, 'Line Pasta\'s job stopped.', '2022-09-22 16:21:20'),
(120, 'Line Chopp\'s job stopped.', '2022-09-22 16:21:32'),
(121, 'New SKU has been created. [: all]', '2022-09-22 16:26:13'),
(122, 'New order has been created. [all: 2 pcs]', '2022-09-22 16:26:24'),
(123, 'SKU ID 20 has been changed.', '2022-09-22 16:43:07'),
(124, 'Line Chopp has been assigned for order 51.', '2022-09-22 16:49:23'),
(125, 'Line Pasta has been assigned for order 51.', '2022-09-22 16:49:37'),
(126, 'Line Almond has been assigned for order 51.', '2022-09-22 16:49:52'),
(127, 'New SKU has been created. [: Benda-A]', '2022-09-23 09:45:26'),
(128, 'Order ID 51 has been deleted. [all: 2 pcs]', '2022-09-23 09:46:08'),
(129, 'Order ID 50 has been deleted. [TEST-2: 12 pcs]', '2022-09-23 09:46:13'),
(130, 'New SKU has been created. [: a]', '2022-09-23 09:47:39'),
(131, 'New SKU has been created. [: s]', '2022-09-23 10:01:09'),
(132, 'SKU ID 22 has been deleted. [a]', '2022-09-23 10:02:56'),
(133, 'SKU ID 23 has been deleted. [s]', '2022-09-23 10:03:04'),
(134, 'SKU ID 21 has been changed.', '2022-09-23 10:16:22'),
(135, 'New order has been created. [Benda-A: 10 pcs]', '2022-09-23 11:07:57'),
(136, 'Line Pasta has been assigned for order 52.', '2022-09-23 11:19:08'),
(137, 'Line Pasta\'s job is starting.', '2022-09-23 11:19:11'),
(138, 'Line Chopp has been assigned for order 52.', '2022-09-23 11:19:15'),
(139, 'Line Chopp\'s job is starting.', '2022-09-23 11:19:17'),
(140, 'Line Almond has been assigned for order 52.', '2022-09-23 11:19:22'),
(141, 'Line Almond\'s job is starting.', '2022-09-23 11:19:25'),
(142, 'New delivery has been created. [Customer: Bapak Mek]', '2022-09-23 11:28:29'),
(143, 'Delivery ID 57 with tracking number IOT/2022/09/23/062829 has been deleted.', '2022-09-23 11:30:03'),
(144, 'New order has been created. [Benda-A: 2 pcs]', '2022-09-23 13:13:18'),
(145, 'New order has been created. [KCNG-001: 20 pcs]', '2022-09-23 13:13:35'),
(146, 'Line Pasta has been assigned for order 53.', '2022-09-23 13:14:59'),
(147, 'Line Pasta\'s job is starting.', '2022-09-23 13:15:02'),
(148, 'SKU ID 2 has been changed.', '2022-09-23 13:21:40'),
(149, 'SKU ID 21 has been changed.', '2022-09-23 13:21:42'),
(150, 'Order ID 52 has been deleted. [Benda-A: 10 pcs]', '2022-09-23 13:22:35'),
(151, 'Order ID 53 has been deleted. [Benda-A: 2 pcs]', '2022-09-23 13:22:39'),
(152, 'Order ID 54 has been deleted. [KCNG-001: 20 pcs]', '2022-09-23 13:22:42'),
(153, 'New order has been created. [Benda-A: 20 pcs]', '2022-09-23 13:22:48'),
(154, 'Line Pasta has been assigned for order 55.', '2022-09-23 13:24:19'),
(155, 'Line Pasta\'s job is starting.', '2022-09-23 13:24:22'),
(156, 'Line Pasta\'s job stopped.', '2022-09-23 13:51:55'),
(157, 'Order ID 55 has been deleted. [Benda-A: 20 pcs]', '2022-09-23 13:52:42'),
(158, 'New order has been created. [Benda-A: 1 pcs]', '2022-09-23 13:52:47'),
(159, 'Line Pasta has been assigned for order 56.', '2022-09-23 13:53:14'),
(160, 'Line Pasta\'s job is starting.', '2022-09-23 13:53:22'),
(161, 'Line Pasta\'s job stopped.', '2022-09-23 13:53:30'),
(162, 'Line Chopp has been assigned for order 56.', '2022-09-23 13:54:48'),
(163, 'Line Chopp\'s job is starting.', '2022-09-23 13:54:51'),
(164, 'Line Almond has been assigned for order 56.', '2022-09-23 13:54:54'),
(165, 'Line Almond\'s job is starting.', '2022-09-23 13:54:57'),
(166, 'Line Chopp\'s job stopped.', '2022-09-23 13:55:01'),
(167, 'Line Almond\'s job stopped.', '2022-09-23 13:55:04'),
(168, 'New order has been created. [Benda-A: 22 pcs]', '2022-09-23 14:03:47'),
(169, 'Line Pasta has been assigned for order 57.', '2022-09-23 14:03:51'),
(170, 'Line Chopp has been assigned for order 57.', '2022-09-23 14:09:00'),
(171, 'Line Almond has been assigned for order 57.', '2022-09-23 14:11:02'),
(172, 'Line Pasta has been assigned for order 57.', '2022-09-23 14:11:09'),
(173, 'Line Pasta\'s job stopped.', '2022-09-23 14:11:28'),
(174, 'Line Chopp\'s job is starting.', '2022-09-23 14:11:37'),
(175, 'Line Chopp\'s job stopped.', '2022-09-23 14:11:45'),
(176, 'All line job stop.', '2022-09-23 14:18:46'),
(177, 'All line\'s job stopped.', '2022-09-23 14:18:46'),
(178, 'All line\'s job stopped.', '2022-09-23 14:20:37'),
(179, 'Order ID 57 has been deleted. [Benda-A: 22 pcs]', '2022-09-26 09:16:36'),
(180, 'Order ID 56 has been deleted. [Benda-A: 1 pcs]', '2022-09-26 09:16:40'),
(181, 'New order has been created. [Benda-A: 1 pcs]', '2022-09-26 09:16:44'),
(182, 'Line Pasta has been assigned for order 58.', '2022-09-26 09:16:54'),
(183, 'Line Pasta\'s job is starting.', '2022-09-26 09:16:57'),
(184, 'Line Pasta\'s job stopped.', '2022-09-26 09:17:00'),
(185, 'Line Chopp has been assigned for order 58.', '2022-09-26 09:17:12'),
(186, 'Line Chopp\'s job is starting.', '2022-09-26 09:17:16'),
(187, 'Line Chopp\'s job stopped.', '2022-09-26 09:17:18'),
(188, 'Line Almond has been assigned for order 58.', '2022-09-26 09:17:33'),
(189, 'Line Almond\'s job is starting.', '2022-09-26 09:17:36'),
(190, 'Line Almond\'s job stopped.', '2022-09-26 09:18:06'),
(191, 'New Line has been created. [PRESS_1]', '2022-09-26 10:39:54'),
(192, 'Line PRESS_1 has been deleted.', '2022-09-26 10:39:57'),
(193, 'New order has been created. [KCNG-001: 20 pcs]', '2022-09-26 15:34:40'),
(194, 'Order ID 59 has been deleted. [KCNG-001: 20 pcs]', '2022-09-26 15:34:43'),
(195, 'New order has been created. [Benda-A: 22 pcs]', '2022-09-26 15:34:48'),
(196, 'Line Pasta has been assigned for order 60.', '2022-09-26 15:34:54'),
(197, 'Line Pasta\'s job is starting.', '2022-09-26 15:34:57'),
(198, 'Line Pasta\'s job stopped.', '2022-09-26 15:35:21'),
(199, 'Line Chopp has been assigned for order 60.', '2022-09-26 15:35:29'),
(200, 'Line Chopp\'s job is starting.', '2022-09-26 15:35:32'),
(201, 'New order has been created. [KCNG-001: 1 pcs]', '2022-09-27 10:48:24'),
(202, 'Account ID 2 has been deleted.', '2022-09-27 15:06:13'),
(203, 'New Account has been created. [goraasep]', '2022-09-27 15:28:23'),
(204, 'New Account has been created. [juan]', '2022-09-27 15:29:01'),
(205, 'New Account has been created. [tt]', '2022-09-27 16:20:59'),
(206, 'New Account has been created. [tt]', '2022-09-27 16:22:01'),
(207, 'Account ID 7 has been deleted.', '2022-09-27 16:23:54'),
(208, 'New Account has been created. [tt]', '2022-09-27 16:24:00'),
(209, 'Account ID 8 has been deleted.', '2022-09-27 16:24:09'),
(210, 'New Account has been created. [tt]', '2022-09-27 16:26:00'),
(211, 'New order has been created. [Benda-A: 121 pcs]', '2022-09-27 16:26:15'),
(212, 'Order ID 62 has been deleted. [Benda-A: 121 pcs]', '2022-09-27 16:26:18'),
(213, 'Account ID 9 has been changed.', '2022-09-27 16:56:11'),
(214, 'Account ID 9 has been changed.', '2022-09-27 16:59:00'),
(215, 'Account ID 9 has been changed.', '2022-09-27 17:01:13'),
(216, 'Breakdown log ID 17 has been changed.', '2022-09-27 17:01:23'),
(217, 'New delivery has been created. [Customer: 1]', '2022-09-27 17:01:40'),
(218, 'Delivery ID 58 with tracking number IOT/2022/09/27/120139 has been deleted.', '2022-09-27 17:01:45'),
(219, 'Account ID 9 has been changed.', '2022-09-27 17:03:10'),
(220, 'New inventory has been added. [1: 1 pcs]', '2022-09-27 17:04:24'),
(221, 'New inventory has been added. [2: 2 pcs]', '2022-09-27 17:05:53'),
(222, 'Inventory ID 9 has been deleted.', '2022-09-27 17:05:55'),
(223, 'Inventory ID 8 has been changed.', '2022-09-27 17:06:00'),
(224, 'Inventory ID 8 has been deleted.', '2022-09-27 17:06:03'),
(225, 'New SKU has been created. [: 123]', '2022-09-27 17:06:15'),
(226, 'SKU ID 24 has been changed.', '2022-09-27 17:06:20'),
(227, 'SKU ID 24 has been deleted. [333]', '2022-09-27 17:06:23'),
(228, 'New PIC has been created. [da]', '2022-09-27 17:06:31'),
(229, 'PIC ID 7 has been changed.', '2022-09-27 17:06:36'),
(230, 'PIC ID 7 has been deleted.', '2022-09-27 17:06:39'),
(231, 'New remark has been created. [BREAKDOWN: Gay]', '2022-09-27 17:06:51'),
(232, 'Remark ID 9 has been changed.', '2022-09-27 17:06:55'),
(233, 'Remark ID 9 has been deleted.', '2022-09-27 17:07:00'),
(234, 'New order has been created. [Benda-A: 1 pcs]', '2022-09-27 17:07:49'),
(235, 'Order ID 63 has been deleted. [Benda-A: 1 pcs]', '2022-09-27 17:07:53'),
(236, 'Line Chopp\'s job stopped.', '2022-09-27 17:08:07'),
(237, 'Account ID 9 has been changed.', '2022-09-27 17:15:43'),
(238, 'Account ID 9 has been changed.', '2022-09-27 17:21:37'),
(239, 'Account ID 9 has been changed.', '2022-09-28 09:53:42'),
(240, 'New Line has been created. [test]', '2022-09-28 10:00:38'),
(241, 'Line test has been deleted.', '2022-09-28 10:00:44'),
(242, 'Account ID 3 has been changed.', '2022-09-28 10:01:44'),
(243, 'Account ID 9 has been changed.', '2022-09-28 10:03:39'),
(244, 'New Line has been created. [test]', '2022-09-28 10:04:28'),
(245, 'Line test has been deleted.', '2022-09-28 10:04:43'),
(246, 'Account ID 3 has been changed.', '2022-09-28 10:16:50'),
(247, 'Account ID 5 has been changed.', '2022-09-28 10:26:07'),
(248, 'Account ID 5 has been changed.', '2022-09-28 10:26:12'),
(249, 'Line Pasta has been assigned for order 61.', '2022-09-28 11:32:33'),
(250, 'Account ID 3 has been changed.', '2022-09-28 16:46:35'),
(251, 'Account ID 3 has been changed.', '2022-10-03 08:47:04'),
(252, 'New Line has been created. [test]', '2022-10-03 08:49:36');

-- --------------------------------------------------------

--
-- Struktur dari tabel `inventory_list`
--

CREATE TABLE `inventory_list` (
  `id` int(11) NOT NULL,
  `inventory_name` varchar(255) NOT NULL,
  `inventory_code` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `inventory_list`
--

INSERT INTO `inventory_list` (`id`, `inventory_name`, `inventory_code`, `quantity`, `updated_at`) VALUES
(1, 'Kacang Tanah', 'KT', 51, '2022-09-15 15:45:35'),
(3, 'Kacang Aer', 'KA', 20, '2022-08-05 13:33:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_oee`
--

CREATE TABLE `log_oee` (
  `id` int(11) NOT NULL,
  `line_name` varchar(255) NOT NULL,
  `sku_code` varchar(255) NOT NULL,
  `item_counter` int(11) NOT NULL,
  `NG_count` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp(),
  `performance` float NOT NULL,
  `availability` float NOT NULL,
  `quality` float NOT NULL,
  `run_time` int(11) NOT NULL DEFAULT 0,
  `down_time` int(11) NOT NULL DEFAULT 0,
  `acc_setup_time` int(11) NOT NULL DEFAULT 0,
  `acc_standby_time` int(11) NOT NULL DEFAULT 0,
  `pic_name` varchar(255) NOT NULL DEFAULT '',
  `remark` varchar(1024) NOT NULL DEFAULT '',
  `detail` varchar(1024) NOT NULL DEFAULT '',
  `location` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_oee`
--

INSERT INTO `log_oee` (`id`, `line_name`, `sku_code`, `item_counter`, `NG_count`, `status`, `timestamp`, `performance`, `availability`, `quality`, `run_time`, `down_time`, `acc_setup_time`, `acc_standby_time`, `pic_name`, `remark`, `detail`, `location`) VALUES
(1, 'Chopp', 'Raw', 1, 1, 'BREAKDOWN', '2022-06-10 14:05:19', 12, 12, 12, 0, 0, 0, 0, 'Daffa', 'malas malasan', '', ''),
(2, 'Chopp', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:15:24', 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(3, 'Chopp', 'Raw', 1, 1, 'BREAKDOWN', '2022-06-13 10:18:45', 12, 12, 12, 0, 0, 0, 0, 'Daffa', 'malas malasan', '', ''),
(4, 'Chopp', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:19:05', 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(5, 'Chopp', '', 0, 0, 'RUNNING', '2022-06-13 10:19:26', 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(6, 'Chopp', '', 0, 0, 'RUNNING', '2022-06-13 10:19:38', 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(7, 'Chopp', '', 0, 0, 'RUNNING', '2022-06-13 10:19:50', 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(8, 'Chopp', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:20:05', 0, 0, 0, 0, 0, 0, 0, 'Gora', 'malas malasan', 'hyunhhss', ''),
(9, 'Chopp', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:20:22', 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(10, 'Pasta', 'Raw', 1, 1, 'BREAKDOWN', '2022-06-10 14:05:19', 12, 12, 12, 0, 0, 0, 0, 'Daffa', 'malas malasan', '', ''),
(11, 'Pasta', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:15:24', 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(12, 'Pasta', 'Raw', 1, 1, 'BREAKDOWN', '2022-06-13 10:18:45', 12, 12, 12, 0, 0, 0, 0, 'Daffa', 'malas malasan', '', ''),
(13, 'Pasta', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:19:05', 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(14, 'Pasta', '', 0, 0, 'RUNNING', '2022-06-13 10:19:26', 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(15, 'Pasta', '', 0, 0, 'RUNNING', '2022-06-13 10:19:38', 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(16, 'Pasta', '', 0, 0, 'RUNNING', '2022-06-13 10:19:50', 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(17, 'Pasta', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:20:05', 0, 0, 0, 0, 0, 0, 0, 'Mike', 'malas malasan', '1', ''),
(18, 'Pasta', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:20:22', 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(19, 'Chopp', '', 0, 0, 'RUNNING', '2022-06-13 11:14:11', 0, 0, 0, 0, 0, 0, 0, '', '', '', ''),
(20, 'Pasta', '', 0, 0, 'RUNNING', '2022-06-13 11:14:57', 0, 0, 0, 0, 0, 0, 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `manufacturing_line`
--

CREATE TABLE `manufacturing_line` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT 0,
  `line_name` varchar(255) NOT NULL,
  `sku_code` varchar(255) NOT NULL DEFAULT 'None',
  `setup_time` int(11) NOT NULL DEFAULT 0,
  `cycle_time` int(11) NOT NULL DEFAULT 0,
  `run_time` int(11) NOT NULL DEFAULT 0,
  `down_time` int(11) NOT NULL DEFAULT 0,
  `temp_time` int(11) NOT NULL DEFAULT 0,
  `item_counter` int(11) NOT NULL DEFAULT 0,
  `prev_item_counter` int(11) NOT NULL DEFAULT 0,
  `NG_count` int(11) NOT NULL DEFAULT 0,
  `target` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT 'STOP',
  `standby_time` int(11) NOT NULL DEFAULT 0,
  `acc_setup_time` int(11) NOT NULL DEFAULT 0,
  `acc_standby_time` int(11) NOT NULL DEFAULT 0,
  `performance` double NOT NULL DEFAULT 0,
  `availability` double NOT NULL DEFAULT 0,
  `quality` double NOT NULL DEFAULT 0,
  `progress` double NOT NULL DEFAULT 0,
  `remark` text NOT NULL,
  `location` varchar(255) NOT NULL DEFAULT '',
  `rule` varchar(1024) NOT NULL DEFAULT '[]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `manufacturing_line`
--

INSERT INTO `manufacturing_line` (`id`, `order_id`, `line_name`, `sku_code`, `setup_time`, `cycle_time`, `run_time`, `down_time`, `temp_time`, `item_counter`, `prev_item_counter`, `NG_count`, `target`, `status`, `standby_time`, `acc_setup_time`, `acc_standby_time`, `performance`, `availability`, `quality`, `progress`, `remark`, `location`, `rule`) VALUES
(1, 61, 'Pasta', 'KCNG-001', 0, 15, 0, 0, 0, 0, 0, 0, 1, 'STOP', 0, 0, 0, 0, 0, 0, 0, '', '', '{}'),
(2, 0, 'Chopp', 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'STOP', 0, 0, 0, 0, 0, 0, 0, '', '', '{}'),
(6, 0, 'Almond', 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'STOP', 0, 0, 0, 0, 0, 0, 0, '', '', '{}'),
(15, 0, 'test', 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'STOP', 0, 0, 0, 0, 0, 0, 0, '', '', '[]');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_list`
--

CREATE TABLE `order_list` (
  `id` int(11) NOT NULL,
  `line_rules` longtext NOT NULL,
  `sku_code` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `started_at` datetime DEFAULT NULL,
  `estimation` datetime DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Waiting',
  `performance` int(11) NOT NULL DEFAULT 0,
  `availability` int(11) NOT NULL DEFAULT 0,
  `quality` int(11) NOT NULL DEFAULT 0,
  `progress` double NOT NULL DEFAULT 0,
  `item_counter` int(11) NOT NULL DEFAULT 0,
  `NG_count` int(11) NOT NULL DEFAULT 0,
  `storage` int(11) NOT NULL DEFAULT 0,
  `delivered` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `order_list`
--

INSERT INTO `order_list` (`id`, `line_rules`, `sku_code`, `quantity`, `created_at`, `started_at`, `estimation`, `finished_at`, `status`, `performance`, `availability`, `quality`, `progress`, `item_counter`, `NG_count`, `storage`, `delivered`) VALUES
(58, '[{\"line_name\":\"Pasta\",\"cycle_time\":1,\"quantity\":100,\"start_job\":1,\"stop_job\":1},{\"line_name\":\"Chopp\",\"cycle_time\":2,\"quantity\":12,\"start_job\":1,\"stop_job\":1},{\"line_name\":\"Almond\",\"cycle_time\":3,\"quantity\":1,\"start_job\":1,\"stop_job\":1}]', 'Benda-A', 1, '2022-09-26 09:16:44', '2022-09-26 09:17:36', NULL, '2022-09-26 09:18:06', 'Completed', 0, 0, 0, 100, 0, 0, 1, 0),
(60, '[{\"line_name\":\"Pasta\",\"cycle_time\":1,\"quantity\":100,\"start_job\":1,\"stop_job\":1},{\"line_name\":\"Chopp\",\"cycle_time\":2,\"quantity\":12,\"start_job\":1,\"stop_job\":1},{\"line_name\":\"Almond\",\"cycle_time\":3,\"quantity\":1,\"start_job\":0,\"stop_job\":0}]', 'Benda-A', 22, '2022-09-26 15:34:48', '2022-09-26 15:35:32', NULL, NULL, 'Work In Progress', 0, 0, 0, 66.67, 0, 0, 1, 0),
(61, '[{\"line_name\":\"Pasta\",\"cycle_time\":15,\"quantity\":1,\"start_job\":0,\"stop_job\":0}]', 'KCNG-001', 1, '2022-09-27 10:48:24', NULL, NULL, NULL, 'Waiting', 0, 0, 0, 0, 0, 0, 1, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pic_list`
--

CREATE TABLE `pic_list` (
  `id` int(11) NOT NULL,
  `pic_name` varchar(255) NOT NULL,
  `employee_id` bigint(20) NOT NULL,
  `contact` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pic_list`
--

INSERT INTO `pic_list` (`id`, `pic_name`, `employee_id`, `contact`) VALUES
(1, 'Mike', 123123123, 'mike@mike.com'),
(2, 'Gora', 8989898, '7878787'),
(4, 'Daffa', 666, '999');

-- --------------------------------------------------------

--
-- Struktur dari tabel `remark_list`
--

CREATE TABLE `remark_list` (
  `id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `detail` text NOT NULL,
  `remark_time` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `remark_list`
--

INSERT INTO `remark_list` (`id`, `status`, `detail`, `remark_time`) VALUES
(1, 'STANDBY', 'Break', 30),
(2, 'STANDBY', 'Change line', 20),
(4, 'BREAKDOWN', 'malas malasan', 0),
(6, 'SETUP', 'Pasang ayakan', 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sku_list`
--

CREATE TABLE `sku_list` (
  `id` int(11) NOT NULL,
  `line_rules` longtext NOT NULL,
  `sku_code` varchar(255) NOT NULL,
  `material` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`material`)),
  `quantity` int(11) NOT NULL DEFAULT 0,
  `quantity_updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sku_list`
--

INSERT INTO `sku_list` (`id`, `line_rules`, `sku_code`, `material`, `quantity`, `quantity_updated_at`) VALUES
(2, '[{\"line_name\":\"Pasta\",\"cycle_time\":15,\"quantity\":1,\"start_job\":0,\"stop_job\":0}]', 'KCNG-001', '[{\"inventory_code\":\"KT\",\"quantity\":1}]', 86, '2022-09-16 13:05:19'),
(21, '[{\"line_name\":\"Pasta\",\"cycle_time\":1,\"quantity\":100,\"start_job\":0,\"stop_job\":0},{\"line_name\":\"Chopp\",\"cycle_time\":2,\"quantity\":12,\"start_job\":0,\"stop_job\":0},{\"line_name\":\"Almond\",\"cycle_time\":3,\"quantity\":1,\"start_job\":0,\"stop_job\":0}]', 'Benda-A', '[]', 0, '2022-09-23 09:45:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tracking_list`
--

CREATE TABLE `tracking_list` (
  `id` int(11) NOT NULL,
  `tracking_number` varchar(255) NOT NULL,
  `items` text NOT NULL,
  `customer` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `from_time` datetime NOT NULL,
  `to_time` datetime NOT NULL,
  `address` text NOT NULL,
  `lat` double NOT NULL DEFAULT 0,
  `lng` double NOT NULL DEFAULT 0,
  `tracker_id` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(1024) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user_level` int(11) NOT NULL DEFAULT 0,
  `privileges` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_account`
--

INSERT INTO `user_account` (`id`, `user_name`, `user_password`, `created_at`, `user_level`, `privileges`) VALUES
(1, 'admin', '$2a$12$v5jlcyDwoTJ1lBXdbknX3.qDmSoZ3hxexYPhxfn/J8HXddCCeKLIW', '2022-04-14 09:53:19', 3, '[\"admin\"]'),
(3, 'operator', '$2a$12$ZuvPDUeg54BDXJ3AgGG35epXUTgVNrcGdl/MN.G8EvyAIsK0zj35.', '2022-06-16 09:54:51', 1, '[\"view_dashboard\",\"view_line_1\",\"view_breakdown_log\",\"edit_breakdown_log\"]'),
(4, 'goraasep', '$2y$10$RFPcI6VKrfieE5AHr3HFme5qsBIK8OZy985umGerQrdlcgCWp7lOa', '2022-09-27 15:28:23', 0, '[]'),
(5, 'juan', '$2y$10$on9pR5NCey75agnj0vtwwuh8E4d0qBZcPXEUh5iWIRSLEEElvnm/K', '2022-09-27 15:29:01', 0, '[\"view_dashboard\"]'),
(9, 'tt', '$2y$10$FnSmaaTULB3M7DZ28I633udE/o5firs3zOemyDYxpVntvu/FKtgKm', '2022-09-27 16:26:00', 0, '[\"view_dashboard\",\"add_line\",\"view_all_line\",\"view_order\",\"add_order\",\"delete_order\",\"view_oee_management\",\"add_sku\",\"edit_sku\",\"delete_sku\",\"add_pic\",\"edit_pic\",\"delete_pic\",\"add_remark\",\"edit_remark\",\"delete_remark\",\"view_warehouse_management\",\"add_inventory\",\"edit_inventory\",\"delete_inventory\",\"edit_fg\",\"view_pct\",\"add_delivery\",\"delete_delivery\",\"view_breakdown_log\",\"edit_breakdown_log\",\"view_event_log\",\"view_reporting\"]');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `event_log`
--
ALTER TABLE `event_log`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `inventory_list`
--
ALTER TABLE `inventory_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `log_oee`
--
ALTER TABLE `log_oee`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `manufacturing_line`
--
ALTER TABLE `manufacturing_line`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pic_list`
--
ALTER TABLE `pic_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `remark_list`
--
ALTER TABLE `remark_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `sku_list`
--
ALTER TABLE `sku_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tracking_list`
--
ALTER TABLE `tracking_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `event_log`
--
ALTER TABLE `event_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- AUTO_INCREMENT untuk tabel `inventory_list`
--
ALTER TABLE `inventory_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `log_oee`
--
ALTER TABLE `log_oee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `manufacturing_line`
--
ALTER TABLE `manufacturing_line`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `pic_list`
--
ALTER TABLE `pic_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `remark_list`
--
ALTER TABLE `remark_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `sku_list`
--
ALTER TABLE `sku_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tracking_list`
--
ALTER TABLE `tracking_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
