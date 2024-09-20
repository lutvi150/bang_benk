-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table bang_benk.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.migrations: ~8 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2024-08-18-151205', 'App\\Database\\Migrations\\TablesUser', 'default', 'App', 1723999469, 1),
	(2, '2024-09-03-142907', 'App\\Database\\Migrations\\TabelProduk', 'default', 'App', 1725373991, 2),
	(3, '2024-09-03-143047', 'App\\Database\\Migrations\\TabelFotoProduk', 'default', 'App', 1725373992, 2),
	(4, '2024-09-03-161155', 'App\\Database\\Migrations\\TableStok', 'default', 'App', 1725380311, 3),
	(5, '2024-09-03-205859', 'App\\Database\\Migrations\\TableKeranjang', 'default', 'App', 1725397390, 4),
	(6, '2024-09-04-004634', 'App\\Database\\Migrations\\TableTransaksi', 'default', 'App', 1725410972, 5),
	(7, '2024-09-15-052548', 'App\\Database\\Migrations\\TableBuktiBayar', 'default', 'App', 1726383009, 6),
	(8, '2020-12-28-223112', 'CodeIgniter\\Shield\\Database\\Migrations\\CreateAuthTables', 'default', 'CodeIgniter\\Shield', 1726407592, 7),
	(9, '2021-07-04-041948', 'CodeIgniter\\Settings\\Database\\Migrations\\CreateSettingsTable', 'default', 'CodeIgniter\\Settings', 1726407592, 7),
	(10, '2021-11-14-143905', 'CodeIgniter\\Settings\\Database\\Migrations\\AddContextColumn', 'default', 'CodeIgniter\\Settings', 1726407593, 7);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table bang_benk.table_bukti_bayar
CREATE TABLE IF NOT EXISTS `table_bukti_bayar` (
  `id_bukti_bayar` int(5) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(5) NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_bukti_bayar`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_bukti_bayar: ~2 rows (approximately)
/*!40000 ALTER TABLE `table_bukti_bayar` DISABLE KEYS */;
INSERT INTO `table_bukti_bayar` (`id_bukti_bayar`, `id_transaksi`, `bukti_bayar`, `keterangan`, `type`, `created_at`, `updated_at`) VALUES
	(1, 18, '18-20240915070341.1726401821_20dd850740afdd281875.jpg', 'bukti bayar tidak jelas', 'webp', '2024-09-15 13:50:50', '2024-09-15 19:03:41');
/*!40000 ALTER TABLE `table_bukti_bayar` ENABLE KEYS */;

-- Dumping structure for table bang_benk.table_foto_produk
CREATE TABLE IF NOT EXISTS `table_foto_produk` (
  `id_foto_produk` int(5) NOT NULL AUTO_INCREMENT,
  `id_produk` int(5) NOT NULL,
  `foto_produk` varchar(255) NOT NULL,
  `produk_unggulan` varchar(2) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_foto_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_foto_produk: ~18 rows (approximately)
/*!40000 ALTER TABLE `table_foto_produk` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `table_foto_produk` ENABLE KEYS */;

-- Dumping structure for table bang_benk.table_keranjang
CREATE TABLE IF NOT EXISTS `table_keranjang` (
  `id_keranjang` int(5) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `id_stok` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_keranjang`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_keranjang: ~32 rows (approximately)
/*!40000 ALTER TABLE `table_keranjang` DISABLE KEYS */;
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
	(18, 3, 5, 6, 15, 1, 150000, 150000, '2024-09-04 08:23:52', '2024-09-07 09:27:25'),
	(19, 2, 1, 10, 8, 1, 150000, 150000, '2024-09-04 09:58:42', '2024-09-04 09:58:51'),
	(20, 4, 4, 6, 15, 1, 150000, 150000, '2024-09-04 10:26:47', '2024-09-07 09:27:25'),
	(21, 3, 5, 6, 15, 1, 150000, 150000, '2024-09-04 10:26:57', '2024-09-07 09:27:25'),
	(22, 2, 1, 6, 15, 1, 150000, 150000, '2024-09-04 10:27:01', '2024-09-07 09:27:25'),
	(23, 2, 1, 6, 15, 1, 150000, 150000, '2024-09-04 10:30:51', '2024-09-07 09:27:25'),
	(24, 2, 1, 11, 17, 1, 150000, 150000, '2024-09-04 14:30:06', '2024-09-13 11:29:02'),
	(25, 3, 5, 11, 17, 1, 150000, 150000, '2024-09-04 14:30:09', '2024-09-13 11:29:02'),
	(26, 19, 17, 6, 15, 1, 175000, 175000, '2024-09-07 08:42:32', '2024-09-07 09:27:25'),
	(27, 17, 15, 6, 15, 1, 150000, 150000, '2024-09-07 08:42:41', '2024-09-07 09:27:25'),
	(28, 16, 14, 6, 15, 1, 165000, 165000, '2024-09-07 08:47:15', '2024-09-07 09:27:25'),
	(29, 15, 13, 6, 15, 1, 140000, 140000, '2024-09-07 08:47:19', '2024-09-07 09:27:25'),
	(30, 19, 17, 6, 15, 1, 175000, 175000, '2024-09-07 08:47:22', '2024-09-07 09:27:25'),
	(31, 17, 15, 6, 15, 1, 150000, 150000, '2024-09-07 08:47:27', '2024-09-07 09:27:25'),
	(32, 16, 14, 6, 15, 1, 165000, 165000, '2024-09-07 09:01:25', '2024-09-07 09:27:25'),
	(33, 17, 15, 6, 15, 1, 150000, 150000, '2024-09-07 09:27:06', '2024-09-07 09:27:25'),
	(34, 15, 13, 6, 15, 1, 140000, 140000, '2024-09-07 09:27:12', '2024-09-07 09:27:25'),
	(35, 18, 16, 13, 16, 1, 145000, 145000, '2024-09-13 11:10:58', '2024-09-13 11:11:52'),
	(36, 16, 14, 13, 16, 1, 165000, 165000, '2024-09-13 11:11:04', '2024-09-13 11:11:52'),
	(37, 15, 13, 13, 16, 1, 140000, 140000, '2024-09-13 11:11:10', '2024-09-13 11:11:52'),
	(38, 15, 13, 11, 17, 2, 140000, 280000, '2024-09-13 11:28:19', '2024-09-13 11:29:02'),
	(39, 13, 11, 11, 17, 1, 140000, 140000, '2024-09-13 11:28:42', '2024-09-13 11:29:03'),
	(40, 18, 16, 11, 17, 1, 145000, 145000, '2024-09-13 11:28:52', '2024-09-13 11:29:03'),
	(41, 18, 16, 14, 18, 1, 145000, 145000, '2024-09-15 11:47:52', '2024-09-15 12:12:22'),
	(42, 19, 17, 14, 18, 1, 175000, 175000, '2024-09-15 11:47:56', '2024-09-15 12:12:22'),
	(45, 2, 1, 1, 19, 2, 150000, 300000, '2024-09-16 08:04:49', '2024-09-16 08:25:11'),
	(48, 4, 4, 1, 19, 3, 150000, 450000, '2024-09-16 08:21:18', '2024-09-16 08:25:11');
/*!40000 ALTER TABLE `table_keranjang` ENABLE KEYS */;

-- Dumping structure for table bang_benk.table_produk
CREATE TABLE IF NOT EXISTS `table_produk` (
  `id_produk` int(5) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) NOT NULL,
  `detail_produk` text NOT NULL,
  `nomor_registrasi_produk` varchar(50) NOT NULL DEFAULT '',
  `stok` int(11) NOT NULL DEFAULT '0',
  `stiker` varchar(50) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_produk: ~16 rows (approximately)
/*!40000 ALTER TABLE `table_produk` DISABLE KEYS */;
INSERT INTO `table_produk` (`id_produk`, `nama_produk`, `detail_produk`, `nomor_registrasi_produk`, `stok`, `stiker`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 'Samsu Refil', 'Samsu Refilg', '240905100311', 78, 'sale', '2024-09-03 15:51:16', '2024-09-16 08:25:11', NULL),
	(3, 'Malboro BF  ', 'Jayana', '240905100520', 675, 'new', '2024-09-03 15:54:27', '2024-09-13 11:29:02', NULL),
	(4, 'Dunhill', 'Queen Bee', '240905100716', 481, '0', '2024-09-03 15:58:26', '2024-09-16 08:25:11', NULL),
	(8, 'Sempurna Mild ', 'Sempurna mild', '240905101044', 600, '0', '2024-09-03 16:11:12', '2024-09-05 10:10:44', NULL),
	(9, 'Melon Ice', 'Melon Ice', '240905101248', 100, '0', '2024-09-04 22:32:21', '2024-09-05 10:12:48', NULL),
	(10, 'Surya', 'Surya', '240904110017', 200, '0', '2024-09-04 22:57:07', '2024-09-04 23:01:07', NULL),
	(11, 'Magnum', 'Magnum', '240905101713', 250, '0', '2024-09-04 23:00:19', '2024-09-05 10:17:13', NULL),
	(12, 'Jarum Black', 'Queen Bee', '240905021553', 250, '0', '2024-09-04 23:02:30', '2024-09-05 14:19:56', NULL),
	(13, 'Jarum Coklat', 'Quen Bee', '240905021641', 149, '0', '2024-09-05 00:54:41', '2024-09-13 11:29:03', NULL),
	(14, 'Gudang Garam Filter', 'Quen Bee', '240905021713', 200, '0', '2024-09-05 00:55:34', '2024-09-05 14:22:43', NULL),
	(15, 'Magnum Blue', 'Dewa Bacco', '240905102358', 93, '0', '2024-09-05 00:56:25', '2024-09-13 11:29:02', NULL),
	(16, 'Gudang Garam Merah', 'Queen Bee', '240905102658', 194, '0', '2024-09-05 00:57:13', '2024-09-13 11:11:52', NULL),
	(17, 'Class Mild', 'Indobacco', '240905102531', 242, '0', '2024-09-05 01:01:40', '2024-09-07 09:27:25', NULL),
	(18, 'Darmawangi', 'Bacco Bintang', '240905100810', 147, '0', '2024-09-05 01:02:46', '2024-09-15 12:12:22', NULL),
	(19, 'Apple Ice', 'Jayana', '240905023216', 242, '0', '2024-09-05 01:03:23', '2024-09-15 12:12:22', NULL),
	(21, '-', '', '', 0, '0', '2024-09-07 08:38:59', '2024-09-07 08:38:59', NULL);
/*!40000 ALTER TABLE `table_produk` ENABLE KEYS */;

-- Dumping structure for table bang_benk.table_stok
CREATE TABLE IF NOT EXISTS `table_stok` (
  `id_stok` int(5) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `stok_awal` int(11) DEFAULT NULL,
  `stok_akhir` int(11) DEFAULT NULL,
  `harga_modal` int(255) DEFAULT NULL,
  `harga_jual` int(11) DEFAULT NULL,
  `keuntungan` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_stok`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_stok: ~16 rows (approximately)
/*!40000 ALTER TABLE `table_stok` DISABLE KEYS */;
INSERT INTO `table_stok` (`id_stok`, `id_produk`, `stok_awal`, `stok_akhir`, `harga_modal`, `harga_jual`, `keuntungan`, `created_at`, `updated_at`) VALUES
	(1, 2, 100, 22, 130000, 150000, 440000, '2024-09-04 00:00:00', '2024-09-16 08:25:11'),
	(3, 3, 400, 10, 140000, 150000, 100000, '2024-09-04 00:00:00', '2024-09-04 08:19:01'),
	(4, 4, 500, 21, 140000, 150000, 210000, '2024-09-04 00:00:00', '2024-09-16 08:25:11'),
	(5, 3, 300, 17, 130000, 150000, 340000, '2024-09-01 00:00:00', '2024-09-13 11:29:02'),
	(6, 9, 100, 0, 120000, 140000, NULL, '2024-09-04 00:00:00', '2024-09-04 22:58:19'),
	(7, 8, 600, 0, 155000, 165000, NULL, '2024-09-04 00:00:00', '2024-09-04 22:59:07'),
	(8, 10, 200, 0, 155000, 165000, NULL, '2024-09-04 00:00:00', '2024-09-04 23:01:07'),
	(9, 11, 250, 0, 145000, 155000, NULL, '2024-09-04 00:00:00', '2024-09-04 23:03:20'),
	(10, 12, 250, 0, 120000, 150000, NULL, '2024-09-04 00:00:00', '2024-09-05 14:19:56'),
	(11, 13, 150, 1, 110000, 140000, 30000, '2024-09-04 00:00:00', '2024-09-13 11:29:03'),
	(12, 14, 200, 0, 120000, 150000, NULL, '2024-09-04 00:00:00', '2024-09-05 14:22:43'),
	(13, 15, 100, 7, 120000, 140000, 140000, '2024-09-04 00:00:00', '2024-09-13 11:29:02'),
	(14, 16, 200, 6, 145000, 165000, 120000, '2024-09-04 00:00:00', '2024-09-13 11:11:52'),
	(15, 17, 250, 8, 120000, 150000, 240000, '2024-09-04 00:00:00', '2024-09-07 09:27:25'),
	(16, 18, 150, 3, 130000, 145000, 45000, '2024-09-04 00:00:00', '2024-09-15 12:12:22'),
	(17, 19, 250, 8, 150000, 175000, 200000, '2024-09-04 00:00:00', '2024-09-15 12:12:22');
/*!40000 ALTER TABLE `table_stok` ENABLE KEYS */;

-- Dumping structure for table bang_benk.table_transaksi
CREATE TABLE IF NOT EXISTS `table_transaksi` (
  `id_transaksi` int(5) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status_transaksi` varchar(50) NOT NULL,
  `nomor_transaksi` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_transaksi: ~17 rows (approximately)
/*!40000 ALTER TABLE `table_transaksi` DISABLE KEYS */;
INSERT INTO `table_transaksi` (`id_transaksi`, `id_user`, `total_harga`, `status_transaksi`, `nomor_transaksi`, `created_at`, `updated_at`) VALUES
	(1, 5, 600000, '', '', '2024-09-04 08:00:34', NULL),
	(2, 5, 600000, '', '', '2024-09-04 08:03:39', NULL),
	(3, 5, 600000, '', '', '2024-09-04 08:03:58', NULL),
	(4, 5, 2100000, '', '', '2024-09-04 08:09:21', NULL),
	(5, 9, 450000, '', '', '2024-09-04 08:14:35', NULL),
	(6, 9, 1350000, '', '', '2024-09-04 08:19:01', NULL),
	(7, 6, 150000, '', '', '2024-09-04 08:23:59', NULL),
	(8, 10, 150000, '', '', '2024-09-04 09:58:51', NULL),
	(9, 6, 600000, '', '', '2024-09-04 10:27:15', NULL),
	(10, 6, 750000, '', '', '2024-09-04 10:31:01', NULL),
	(11, 11, 300000, '', '', '2024-09-04 14:30:18', NULL),
	(12, 6, 1075000, '', '', '2024-09-07 08:42:53', NULL),
	(13, 6, 1705000, '', '', '2024-09-07 08:47:36', NULL),
	(14, 6, 1870000, '', '', '2024-09-07 09:01:31', NULL),
	(15, 6, 2160000, '', '', '2024-09-07 09:27:25', NULL),
	(16, 13, 450000, '', '', '2024-09-13 11:11:52', NULL),
	(17, 11, 865000, '', '', '2024-09-13 11:29:02', NULL),
	(18, 14, 320000, 'finish', '240915121221', '2024-09-15 12:12:21', NULL),
	(19, 1, 750000, 'finish', '240916082511', '2024-09-16 08:25:11', NULL);
/*!40000 ALTER TABLE `table_transaksi` ENABLE KEYS */;

-- Dumping structure for table bang_benk.table_user
CREATE TABLE IF NOT EXISTS `table_user` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nama_user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profil_status` varchar(5) NOT NULL,
  `role` varchar(50) NOT NULL,
  `last_login` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_user: ~13 rows (approximately)
/*!40000 ALTER TABLE `table_user` DISABLE KEYS */;
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
	(11, 'Ilham', 'ilham@gmail.com', 'b31984046c568f1fac1e6b56298a78cc11b608920db7e6d60bb22bf57cac34cb', 'nonak', 'pelanggan', '2024-09-04 14:29:14', '2024-09-04 14:29:14', '2024-09-04 14:29:14', NULL),
	(12, 'gracia', 'graciates123@gmail.com', '651f6937b5c0cc2eb976c523b46666a81ce9b991bd73b5338d8e8f576f7ca730', 'nonak', 'pelanggan', '2024-09-07 08:43:01', '2024-09-07 08:43:01', '2024-09-07 08:43:01', NULL),
	(13, 'Diana', 'diana@gmail.com', 'ef797c8118f02dfb649607dd5d3f8c7623048c9c063d532cc95c5ed7a898a64f', 'nonak', 'pelanggan', '2024-09-13 11:10:09', '2024-09-13 11:10:09', '2024-09-13 11:10:09', NULL),
	(14, 'budi', 'budi@gmail.com', '48b02c9e85f934696778e9d1e84e697ca1ea6de02e07fc13173c1f1e98bbc60c', 'nonak', 'pelanggan', '2024-09-15 11:08:32', '2024-09-15 11:08:32', '2024-09-15 11:08:32', NULL);
/*!40000 ALTER TABLE `table_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
