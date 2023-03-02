-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 16 Sep 2022 pada 09.25
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
-- Database: `oee3`
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
(58, 'Delivery ID 56 with tracking number IOT/2022/09/16/092235 has been deleted.', '2022-09-16 14:23:35');

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
(17, 'Pasta', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:20:05', 0, 0, 0, 0, 0, 0, 0, 'Mike', 'malas malasan', '', ''),
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
  `location` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `manufacturing_line`
--

INSERT INTO `manufacturing_line` (`id`, `order_id`, `line_name`, `sku_code`, `setup_time`, `cycle_time`, `run_time`, `down_time`, `temp_time`, `item_counter`, `prev_item_counter`, `NG_count`, `target`, `status`, `standby_time`, `acc_setup_time`, `acc_standby_time`, `performance`, `availability`, `quality`, `progress`, `remark`, `location`) VALUES
(1, 0, 'Pasta', 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'STOP', 0, 0, 0, 0, 0, 0, 0, '', ''),
(2, 0, 'Chopp', 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'STOP', 0, 0, 0, 0, 0, 0, 0, '', ''),
(6, 0, 'Almond', 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'STOP', 0, 0, 0, 0, 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_list`
--

CREATE TABLE `order_list` (
  `id` int(11) NOT NULL,
  `line_name` varchar(255) NOT NULL,
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
  `line_name` varchar(255) NOT NULL,
  `sku_code` varchar(255) NOT NULL,
  `cycle_time` int(11) NOT NULL DEFAULT 0,
  `material` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`material`)),
  `quantity` int(11) NOT NULL DEFAULT 0,
  `quantity_updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sku_list`
--

INSERT INTO `sku_list` (`id`, `line_name`, `sku_code`, `cycle_time`, `material`, `quantity`, `quantity_updated_at`) VALUES
(2, 'Pasta', 'KCNG-001', 15, '[{\"inventory_code\":\"KT\",\"quantity\":1}]', 86, '2022-09-16 13:05:19'),
(3, 'Chopp', 'Raw', 40, '[{\"inventory_code\":\"KT\",\"quantity\":2},{\"inventory_code\":\"KA\",\"quantity\":3}]', 5, '2022-09-14 09:11:17'),
(12, 'Pasta', 'testsku', 2, '[]', 0, '2022-09-14 11:38:22');

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
  `user_password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user_level` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_account`
--

INSERT INTO `user_account` (`id`, `user_name`, `user_password`, `created_at`, `user_level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2022-04-14 09:53:19', 3),
(2, 'juan', 'a94652aa97c7211ba8954dd15a3cf838', '2022-04-14 09:53:19', 0),
(3, 'operator', '4b583376b2767b923c3e1da60d10de59', '2022-06-16 09:54:51', 1);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `event_log`
--
ALTER TABLE `event_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT untuk tabel `inventory_list`
--
ALTER TABLE `inventory_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `log_oee`
--
ALTER TABLE `log_oee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `manufacturing_line`
--
ALTER TABLE `manufacturing_line`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT untuk tabel `pic_list`
--
ALTER TABLE `pic_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `remark_list`
--
ALTER TABLE `remark_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `sku_list`
--
ALTER TABLE `sku_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tracking_list`
--
ALTER TABLE `tracking_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT untuk tabel `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
