-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 22 Jun 2022 pada 05.28
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
-- Database: `oee2`
--

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
  `remark` varchar(1024) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_oee`
--

INSERT INTO `log_oee` (`id`, `line_name`, `sku_code`, `item_counter`, `NG_count`, `status`, `timestamp`, `performance`, `availability`, `quality`, `run_time`, `down_time`, `acc_setup_time`, `acc_standby_time`, `pic_name`, `remark`) VALUES
(1, 'Chopp', 'Raw', 1, 1, 'BREAKDOWN', '2022-06-10 14:05:19', 12, 12, 12, 0, 0, 0, 0, 'Daffa', 'malas malasan'),
(2, 'Chopp', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:15:24', 0, 0, 0, 0, 0, 0, 0, '', ''),
(3, 'Chopp', 'Raw', 1, 1, 'BREAKDOWN', '2022-06-13 10:18:45', 12, 12, 12, 0, 0, 0, 0, 'Daffa', 'malas malasan'),
(4, 'Chopp', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:19:05', 0, 0, 0, 0, 0, 0, 0, '', ''),
(5, 'Chopp', '', 0, 0, 'RUNNING', '2022-06-13 10:19:26', 0, 0, 0, 0, 0, 0, 0, '', ''),
(6, 'Chopp', '', 0, 0, 'RUNNING', '2022-06-13 10:19:38', 0, 0, 0, 0, 0, 0, 0, '', ''),
(7, 'Chopp', '', 0, 0, 'RUNNING', '2022-06-13 10:19:50', 0, 0, 0, 0, 0, 0, 0, '', ''),
(8, 'Chopp', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:20:05', 0, 0, 0, 0, 0, 0, 0, '', ''),
(9, 'Chopp', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:20:22', 0, 0, 0, 0, 0, 0, 0, '', ''),
(10, 'Pasta', 'Raw', 1, 1, 'BREAKDOWN', '2022-06-10 14:05:19', 12, 12, 12, 0, 0, 0, 0, 'Daffa', 'malas malasan'),
(11, 'Pasta', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:15:24', 0, 0, 0, 0, 0, 0, 0, '', ''),
(12, 'Pasta', 'Raw', 1, 1, 'BREAKDOWN', '2022-06-13 10:18:45', 12, 12, 12, 0, 0, 0, 0, 'Daffa', 'malas malasan'),
(13, 'Pasta', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:19:05', 0, 0, 0, 0, 0, 0, 0, '', ''),
(14, 'Pasta', '', 0, 0, 'RUNNING', '2022-06-13 10:19:26', 0, 0, 0, 0, 0, 0, 0, '', ''),
(15, 'Pasta', '', 0, 0, 'RUNNING', '2022-06-13 10:19:38', 0, 0, 0, 0, 0, 0, 0, '', ''),
(16, 'Pasta', '', 0, 0, 'RUNNING', '2022-06-13 10:19:50', 0, 0, 0, 0, 0, 0, 0, '', ''),
(17, 'Pasta', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:20:05', 0, 0, 0, 0, 0, 0, 0, 'Mike', 'malas malasan'),
(18, 'Pasta', '', 0, 0, 'BREAKDOWN', '2022-06-13 10:20:22', 0, 0, 0, 0, 0, 0, 0, '', ''),
(19, 'Chopp', '', 0, 0, 'RUNNING', '2022-06-13 11:14:11', 0, 0, 0, 0, 0, 0, 0, '', ''),
(20, 'Pasta', '', 0, 0, 'RUNNING', '2022-06-13 11:14:57', 0, 0, 0, 0, 0, 0, 0, '', '');

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
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `manufacturing_line`
--

INSERT INTO `manufacturing_line` (`id`, `order_id`, `line_name`, `sku_code`, `setup_time`, `cycle_time`, `run_time`, `down_time`, `temp_time`, `item_counter`, `prev_item_counter`, `NG_count`, `target`, `status`, `standby_time`, `acc_setup_time`, `acc_standby_time`, `performance`, `availability`, `quality`, `progress`, `remark`) VALUES
(1, 3, 'Pasta', 'KCNG-001', 30, 15, 0, 0, 0, 0, 0, 0, 400, 'STOP', 0, 0, 0, 0, 0, 0, 0, 'Pasang ayakan'),
(2, 4, 'Chopp', 'Raw', 30, 40, 0, 0, 0, 0, 0, 0, 250, 'STOP', 0, 0, 0, 0, 0, 0, 0, 'Pasang ayakan'),
(6, 0, 'Almond', 'None', 0, 0, 0, 0, 0, 0, 0, 0, 0, 'STOP', 0, 0, 0, 0, 0, 0, 0, '');

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
  `finished_at` datetime DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Waiting',
  `performance` int(11) NOT NULL DEFAULT 0,
  `availability` int(11) NOT NULL DEFAULT 0,
  `quality` int(11) NOT NULL DEFAULT 0,
  `progress` double NOT NULL DEFAULT 0,
  `item_counter` int(11) NOT NULL DEFAULT 0,
  `NG_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `order_list`
--

INSERT INTO `order_list` (`id`, `line_name`, `sku_code`, `quantity`, `created_at`, `started_at`, `finished_at`, `status`, `performance`, `availability`, `quality`, `progress`, `item_counter`, `NG_count`) VALUES
(1, 'Pasta', 'KCNG-001', 120, '2022-06-20 09:52:07', NULL, NULL, 'Waiting', 0, 0, 0, 100, 0, 0),
(3, 'Pasta', 'KCNG-001', 400, '2022-06-20 11:40:56', NULL, NULL, 'Waiting', 0, 0, 0, 90, 0, 0);

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
(5, 'BREAKDOWN', 'gay', 0),
(6, 'SETUP', 'Pasang ayakan', 30);

-- --------------------------------------------------------

--
-- Struktur dari tabel `sku_list`
--

CREATE TABLE `sku_list` (
  `id` int(11) NOT NULL,
  `line_name` varchar(255) NOT NULL,
  `sku_code` varchar(255) NOT NULL,
  `cycle_time` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `sku_list`
--

INSERT INTO `sku_list` (`id`, `line_name`, `sku_code`, `cycle_time`) VALUES
(1, 'All', 'None', 0),
(2, 'Pasta', 'KCNG-001', 15),
(3, 'Chopp', 'Raw', 40);

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
-- Indeks untuk tabel `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `log_oee`
--
ALTER TABLE `log_oee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `manufacturing_line`
--
ALTER TABLE `manufacturing_line`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `order_list`
--
ALTER TABLE `order_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `pic_list`
--
ALTER TABLE `pic_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `remark_list`
--
ALTER TABLE `remark_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `sku_list`
--
ALTER TABLE `sku_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
