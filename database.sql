-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 06, 2024 at 09:35 PM
-- Server version: 10.6.18-MariaDB-cll-lve-log
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teamclov_demo_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2024-08-18-151205', 'App\\Database\\Migrations\\TablesUser', 'default', 'App', 1723999469, 1),
(2, '2024-09-03-142907', 'App\\Database\\Migrations\\TabelProduk', 'default', 'App', 1725373991, 2),
(3, '2024-09-03-143047', 'App\\Database\\Migrations\\TabelFotoProduk', 'default', 'App', 1725373992, 2),
(4, '2024-09-03-161155', 'App\\Database\\Migrations\\TableStok', 'default', 'App', 1725380311, 3),
(5, '2024-09-03-205859', 'App\\Database\\Migrations\\TableKeranjang', 'default', 'App', 1725397390, 4),
(6, '2024-09-04-004634', 'App\\Database\\Migrations\\TableTransaksi', 'default', 'App', 1725410972, 5);

-- --------------------------------------------------------

--
-- Table structure for table `table_foto_produk`
--

CREATE TABLE `table_foto_produk` (
  `id_foto_produk` int(5) NOT NULL,
  `id_produk` int(5) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `produk_unggulan` varchar(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_foto_produk`
--

INSERT INTO `table_foto_produk` (`id_foto_produk`, `id_produk`, `foto_produk`, `produk_unggulan`, `created_at`, `updated_at`, `deleted_at`) VALUES
(12, 2, '2_240904025802_1725393482_a83211294a8a84a0d56d.jpg', '', '0000-00-00 00:00:00', NULL, NULL),
(13, 3, '3_240904025821_1725393501_81c08e50f293a3624fbe.jpg', '', '0000-00-00 00:00:00', NULL, NULL),
(14, 4, '4_240904025839_1725393519_adaa4ed159adfccd8c46.jpg', '', '0000-00-00 00:00:00', NULL, NULL),
(31, 2, '2_240905100303_1725505383_230d9848126421488a09.png', '', '0000-00-00 00:00:00', NULL, NULL),
(32, 3, '3_240905100500_1725505500_5ff75fe9ae2864eab9eb.png', '', '0000-00-00 00:00:00', NULL, NULL),
(33, 4, '4_240905100713_1725505633_e658eb30e80759009097.png', '', '0000-00-00 00:00:00', NULL, NULL),
(35, 8, '8_240905101024_1725505824_ff3c55263119b96a2717.png', '', '0000-00-00 00:00:00', NULL, NULL),
(36, 9, '9_240905101240_1725505960_338435980b873ad820b0.png', '', '0000-00-00 00:00:00', NULL, NULL),
(37, 10, '10_240905101503_1725506103_571820f5945fb5abaf7f.png', '', '0000-00-00 00:00:00', NULL, NULL),
(38, 11, '11_240905101705_1725506225_153239ee481e39985f90.png', '', '0000-00-00 00:00:00', NULL, NULL),
(39, 18, '18_240905101846_1725506326_0658f237b90be5c9bedf.png', '', '0000-00-00 00:00:00', NULL, NULL),
(42, 15, '15_240905102348_1725506628_f6fc5a8da89fef633fea.png', '', '0000-00-00 00:00:00', NULL, NULL),
(43, 17, '17_240905102441_1725506681_a4b6ce9681656f5a4500.png', '', '0000-00-00 00:00:00', NULL, NULL),
(44, 16, '16_240905102650_1725506810_f69d00dec5564a83f1b7.png', '', '0000-00-00 00:00:00', NULL, NULL),
(45, 12, '12_240905021544_1725520544_faf5b10b419b7232f274.png', '', '0000-00-00 00:00:00', NULL, NULL),
(46, 13, '13_240905021622_1725520582_f387c1538902a62a7c3c.png', '', '0000-00-00 00:00:00', NULL, NULL),
(47, 14, '14_240905021709_1725520629_d338ec30562c143aa413.png', '', '0000-00-00 00:00:00', NULL, NULL),
(48, 19, '19_240905023204_1725521524_44a13a904de1a660e8ec.png', '', '0000-00-00 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_keranjang`
--

CREATE TABLE `table_keranjang` (
  `id_keranjang` int(5) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_stok` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_keranjang`
--

INSERT INTO `table_keranjang` (`id_keranjang`, `id_produk`, `id_stok`, `id_user`, `id_transaksi`, `qty`, `harga`, `total_harga`, `created_at`, `updated_at`) VALUES
(7, 3, 3, 5, 4, 5, 150000, 750000, '2024-09-04 04:59:43', '2024-09-04 08:09:22'),
(8, 4, 4, 5, 4, 5, 150000, 750000, '2024-09-04 05:00:58', '2024-09-04 08:09:22'),
(9, 2, 1, 5, 4, 2, 150000, 300000, '2024-09-04 08:06:30', '2024-09-04 08:09:22'),
(10, 4, 4, 5, 4, 1, 150000, 150000, '2024-09-04 08:08:39', '2024-09-04 08:09:22'),
(11, 3, 3, 5, 4, 1, 150000, 150000, '2024-09-04 08:08:44', '2024-09-04 08:09:22'),
(12, 4, 4, 9, 6, 1, 150000, 150000, '2024-09-04 08:14:26', '2024-09-04 08:19:01'),
(13, 3, 3, 9, 6, 1, 150000, 150000, '2024-09-04 08:14:29', '2024-09-04 08:19:01'),
(14, 2, 1, 9, 6, 1, 150000, 150000, '2024-09-04 08:14:31', '2024-09-04 08:19:01'),
(15, 4, 4, 9, 6, 2, 150000, 300000, '2024-09-04 08:18:46', '2024-09-04 08:19:01'),
(16, 3, 5, 9, 6, 2, 150000, 300000, '2024-09-04 08:18:49', '2024-09-04 08:19:01'),
(17, 2, 1, 9, 6, 2, 150000, 300000, '2024-09-04 08:18:50', '2024-09-04 08:19:01'),
(18, 3, 5, 6, 10, 1, 150000, 150000, '2024-09-04 08:23:52', '2024-09-04 10:31:01'),
(19, 2, 1, 10, 8, 1, 150000, 150000, '2024-09-04 09:58:42', '2024-09-04 09:58:51'),
(20, 4, 4, 6, 10, 1, 150000, 150000, '2024-09-04 10:26:47', '2024-09-04 10:31:01'),
(21, 3, 5, 6, 10, 1, 150000, 150000, '2024-09-04 10:26:57', '2024-09-04 10:31:01'),
(22, 2, 1, 6, 10, 1, 150000, 150000, '2024-09-04 10:27:01', '2024-09-04 10:31:01'),
(23, 2, 1, 6, 10, 1, 150000, 150000, '2024-09-04 10:30:51', '2024-09-04 10:31:01'),
(24, 2, 1, 11, 11, 1, 150000, 150000, '2024-09-04 14:30:06', '2024-09-04 14:30:18'),
(25, 3, 5, 11, 11, 1, 150000, 150000, '2024-09-04 14:30:09', '2024-09-04 14:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `table_produk`
--

CREATE TABLE `table_produk` (
  `id_produk` int(5) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `detail_produk` text NOT NULL,
  `nomor_registrasi_produk` varchar(50) NOT NULL DEFAULT '',
  `stok` int(11) NOT NULL DEFAULT 0,
  `stiker` varchar(50) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_produk`
--

INSERT INTO `table_produk` (`id_produk`, `nama_produk`, `detail_produk`, `nomor_registrasi_produk`, `stok`, `stiker`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 'Samsu Refil', 'Samsu Refilg', '240905100311', 89, 'sale', '2024-09-03 15:51:16', '2024-09-05 10:03:11', NULL),
(3, 'Malboro BF  ', 'Jayana', '240905100520', 684, 'new', '2024-09-03 15:54:27', '2024-09-05 10:05:20', NULL),
(4, 'Dunhill', 'Queen Bee', '240905100716', 488, '0', '2024-09-03 15:58:26', '2024-09-05 10:07:16', NULL),
(8, 'Sempurna Mild ', 'Sempurna mild', '240905101044', 600, '0', '2024-09-03 16:11:12', '2024-09-05 10:10:44', NULL),
(9, 'Melon Ice', 'Melon Ice', '240905101248', 100, '0', '2024-09-04 22:32:21', '2024-09-05 10:12:48', NULL),
(10, 'Surya', 'Surya', '240904110017', 200, '0', '2024-09-04 22:57:07', '2024-09-04 23:01:07', NULL),
(11, 'Magnum', 'Magnum', '240905101713', 250, '0', '2024-09-04 23:00:19', '2024-09-05 10:17:13', NULL),
(12, 'Jarum Black', 'Queen Bee', '240905021553', 250, '0', '2024-09-04 23:02:30', '2024-09-05 14:19:56', NULL),
(13, 'Jarum Coklat', 'Quen Bee', '240905021641', 150, '0', '2024-09-05 00:54:41', '2024-09-05 14:21:45', NULL),
(14, 'Gudang Garam Filter', 'Quen Bee', '240905021713', 200, '0', '2024-09-05 00:55:34', '2024-09-05 14:22:43', NULL),
(15, 'Magnum Blue', 'Dewa Bacco', '240905102358', 100, '0', '2024-09-05 00:56:25', '2024-09-05 14:25:34', NULL),
(16, 'Gudang Garam Merah', 'Queen Bee', '240905102658', 200, '0', '2024-09-05 00:57:13', '2024-09-05 14:27:20', NULL),
(17, 'Class Mild', 'Indobacco', '240905102531', 250, '0', '2024-09-05 01:01:40', '2024-09-05 14:28:11', NULL),
(18, 'Darmawangi', 'Bacco Bintang', '240905100810', 150, '0', '2024-09-05 01:02:46', '2024-09-05 14:29:45', NULL),
(19, 'Apple Ice', 'Jayana', '240905023216', 250, '0', '2024-09-05 01:03:23', '2024-09-05 14:33:05', NULL),
(20, '-', '', '', 0, '0', '2024-09-05 01:17:50', '2024-09-05 01:17:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_stok`
--

CREATE TABLE `table_stok` (
  `id_stok` int(5) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `stok_awal` int(11) DEFAULT NULL,
  `stok_akhir` int(11) DEFAULT NULL,
  `harga_modal` int(255) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `keuntungan` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_stok`
--

INSERT INTO `table_stok` (`id_stok`, `id_produk`, `stok_awal`, `stok_akhir`, `harga_modal`, `harga_jual`, `keuntungan`, `created_at`, `updated_at`) VALUES
(1, 2, 100, 11, 130000, 150000, 220000, '2024-09-04 00:00:00', '2024-09-04 14:30:18'),
(3, 3, 400, 10, 140000, 150000, 100000, '2024-09-04 00:00:00', '2024-09-04 08:19:01'),
(4, 4, 500, 14, 140000, 150000, 140000, '2024-09-04 00:00:00', '2024-09-04 10:31:01'),
(5, 3, 300, 8, 130000, 150000, 160000, '2024-09-01 00:00:00', '2024-09-04 14:30:18'),
(6, 9, 100, 0, 120000, 140000, NULL, '2024-09-04 00:00:00', '2024-09-04 22:58:19'),
(7, 8, 600, 0, 155000, 165000, NULL, '2024-09-04 00:00:00', '2024-09-04 22:59:07'),
(8, 10, 200, 0, 155000, 165000, NULL, '2024-09-04 00:00:00', '2024-09-04 23:01:07'),
(9, 11, 250, 0, 145000, 155000, NULL, '2024-09-04 00:00:00', '2024-09-04 23:03:20'),
(10, 12, 250, 0, 120000, 150000, NULL, '2024-09-04 00:00:00', '2024-09-05 14:19:56'),
(11, 13, 150, 0, 110000, 140000, NULL, '2024-09-04 00:00:00', '2024-09-05 14:21:45'),
(12, 14, 200, 0, 120000, 150000, NULL, '2024-09-04 00:00:00', '2024-09-05 14:22:43'),
(13, 15, 100, 0, 120000, 140000, NULL, '2024-09-04 00:00:00', '2024-09-05 14:25:34'),
(14, 16, 200, 0, 145000, 165000, NULL, '2024-09-04 00:00:00', '2024-09-05 14:27:20'),
(15, 17, 250, 0, 120000, 150000, NULL, '2024-09-04 00:00:00', '2024-09-05 14:28:11'),
(16, 18, 150, 0, 130000, 145000, NULL, '2024-09-04 00:00:00', '2024-09-05 14:29:45'),
(17, 19, 250, 0, 150000, 175000, NULL, '2024-09-04 00:00:00', '2024-09-05 14:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `table_transaksi`
--

CREATE TABLE `table_transaksi` (
  `id_transaksi` int(5) NOT NULL,
  `id_user` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status_transaksi` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_transaksi`
--

INSERT INTO `table_transaksi` (`id_transaksi`, `id_user`, `total_harga`, `status_transaksi`, `created_at`, `updated_at`) VALUES
(1, 5, 600000, '', '2024-09-04 08:00:34', NULL),
(2, 5, 600000, '', '2024-09-04 08:03:39', NULL),
(3, 5, 600000, '', '2024-09-04 08:03:58', NULL),
(4, 5, 2100000, '', '2024-09-04 08:09:21', NULL),
(5, 9, 450000, '', '2024-09-04 08:14:35', NULL),
(6, 9, 1350000, '', '2024-09-04 08:19:01', NULL),
(7, 6, 150000, '', '2024-09-04 08:23:59', NULL),
(8, 10, 150000, '', '2024-09-04 09:58:51', NULL),
(9, 6, 600000, '', '2024-09-04 10:27:15', NULL),
(10, 6, 750000, '', '2024-09-04 10:31:01', NULL),
(11, 11, 300000, '', '2024-09-04 14:30:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `table_user`
--

CREATE TABLE `table_user` (
  `id` int(5) NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profil_status` varchar(5) NOT NULL,
  `role` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `table_user`
--

INSERT INTO `table_user` (`id`, `nama_user`, `email`, `password`, `profil_status`, `role`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '', 'administrator', '2024-08-18 16:46:51', '2024-08-18 16:46:51', NULL, NULL),
(2, 'budi', 'budi@gamil.com', '24263bfaefb124c488c2f5e63d1d30b418f51d0d6f5b380aa1956ec40ea57278', 'nonak', 'pelanggan', '2024-09-03 13:20:24', '2024-09-03 13:20:24', '2024-09-03 13:20:24', NULL),
(3, 'poland', 'poland@gmail.com', '25160f9b291c0a20830ae9f10d1610ecb1b115f5808e9a929833654a4c92619d', 'nonak', 'pelanggan', '2024-09-03 17:35:43', '2024-09-03 17:35:43', '2024-09-03 17:35:43', NULL),
(4, 'Tes Akun 2', 'tes@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', 'nonak', 'pelanggan', '2024-09-04 00:50:23', '2024-09-04 00:50:23', '2024-09-04 00:50:23', NULL),
(5, 'Budi2', 'budites@gmail.com', '24263bfaefb124c488c2f5e63d1d30b418f51d0d6f5b380aa1956ec40ea57278', 'nonak', 'pelanggan', '2024-09-04 00:55:43', '2024-09-04 00:55:43', '2024-09-04 00:55:43', NULL),
(6, 'Pitriani', 'pitri6068@gmail.com', 'ba0793b86b906b2f8c072faa8de3c99e66abf751f426c71be7010912e25e714a', 'nonak', 'pelanggan', '2024-09-04 00:58:37', '2024-09-04 00:58:37', '2024-09-04 00:58:37', NULL),
(7, 'Ciak', 'ciak12@gmail.com', '02cb96e7298f5027ddc289262839ab9b316577ae1139762f1c523694cdcd9e97', 'nonak', 'pelanggan', '2024-09-04 01:03:27', '2024-09-04 01:03:27', '2024-09-04 01:03:27', NULL),
(8, 'tes lagi', 'tesnomor23@gmail.com', 'b98c5c1ebfc2e66df0c744731bb409cd90874e6b435dd84b2209427f9b516f01', 'nonak', 'pelanggan', '2024-09-04 02:09:39', '2024-09-04 02:09:39', '2024-09-04 02:09:39', NULL),
(9, 'nana', 'nana@gmail.com', 'be1280997bcdafdcb05a3ac841a01da3015f82e324c3d6b38e1fafd8fda6b846', 'nonak', 'pelanggan', '2024-09-04 08:14:12', '2024-09-04 08:14:12', '2024-09-04 08:14:12', NULL),
(10, 'Wein pinte nate', 'weinpintenate123@gmail.com', '7defe50a4f704fa55d08d07081fb67a1fb68efde3ae7fb986d48e586ccd7bfdf', 'nonak', 'pelanggan', '2024-09-04 09:57:56', '2024-09-04 09:57:56', '2024-09-04 09:57:56', NULL),
(11, 'Ilham', 'ilham@gmail.com', 'b31984046c568f1fac1e6b56298a78cc11b608920db7e6d60bb22bf57cac34cb', 'nonak', 'pelanggan', '2024-09-04 14:29:14', '2024-09-04 14:29:14', '2024-09-04 14:29:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_foto_produk`
--
ALTER TABLE `table_foto_produk`
  ADD PRIMARY KEY (`id_foto_produk`);

--
-- Indexes for table `table_keranjang`
--
ALTER TABLE `table_keranjang`
  ADD PRIMARY KEY (`id_keranjang`);

--
-- Indexes for table `table_produk`
--
ALTER TABLE `table_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `table_stok`
--
ALTER TABLE `table_stok`
  ADD PRIMARY KEY (`id_stok`);

--
-- Indexes for table `table_transaksi`
--
ALTER TABLE `table_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `table_user`
--
ALTER TABLE `table_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `table_foto_produk`
--
ALTER TABLE `table_foto_produk`
  MODIFY `id_foto_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `table_keranjang`
--
ALTER TABLE `table_keranjang`
  MODIFY `id_keranjang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `table_produk`
--
ALTER TABLE `table_produk`
  MODIFY `id_produk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `table_stok`
--
ALTER TABLE `table_stok`
  MODIFY `id_stok` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `table_transaksi`
--
ALTER TABLE `table_transaksi`
  MODIFY `id_transaksi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `table_user`
--
ALTER TABLE `table_user`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
