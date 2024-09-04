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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.migrations: ~6 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2024-08-18-151205', 'App\\Database\\Migrations\\TablesUser', 'default', 'App', 1723999469, 1),
	(2, '2024-09-03-142907', 'App\\Database\\Migrations\\TabelProduk', 'default', 'App', 1725373991, 2),
	(3, '2024-09-03-143047', 'App\\Database\\Migrations\\TabelFotoProduk', 'default', 'App', 1725373992, 2),
	(4, '2024-09-03-161155', 'App\\Database\\Migrations\\TableStok', 'default', 'App', 1725380311, 3),
	(5, '2024-09-03-205859', 'App\\Database\\Migrations\\TableKeranjang', 'default', 'App', 1725397390, 4),
	(6, '2024-09-04-004634', 'App\\Database\\Migrations\\TableTransaksi', 'default', 'App', 1725410972, 5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_foto_produk: ~4 rows (approximately)
/*!40000 ALTER TABLE `table_foto_produk` DISABLE KEYS */;
INSERT INTO `table_foto_produk` (`id_foto_produk`, `id_produk`, `foto_produk`, `produk_unggulan`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(11, 2, '2_240904025750_1725393470_08548554c163385b47ba.jpg', '', '0000-00-00 00:00:00', NULL, NULL),
	(12, 2, '2_240904025802_1725393482_a83211294a8a84a0d56d.jpg', '', '0000-00-00 00:00:00', NULL, NULL),
	(13, 3, '3_240904025821_1725393501_81c08e50f293a3624fbe.jpg', '', '0000-00-00 00:00:00', NULL, NULL),
	(14, 4, '4_240904025839_1725393519_adaa4ed159adfccd8c46.jpg', '', '0000-00-00 00:00:00', NULL, NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_keranjang: ~2 rows (approximately)
/*!40000 ALTER TABLE `table_keranjang` DISABLE KEYS */;
INSERT INTO `table_keranjang` (`id_keranjang`, `id_produk`, `id_stok`, `id_user`, `id_transaksi`, `qty`, `harga`, `total_harga`, `created_at`, `updated_at`) VALUES
	(7, 3, 3, 5, 4, 5, 150000, 750000, '2024-09-04 04:59:43', '2024-09-04 08:09:22'),
	(8, 4, 4, 5, 4, 5, 150000, 750000, '2024-09-04 05:00:58', '2024-09-04 08:09:22'),
	(9, 2, 1, 5, 4, 2, 150000, 300000, '2024-09-04 08:06:30', '2024-09-04 08:09:22'),
	(10, 4, 4, 5, 4, 1, 150000, 150000, '2024-09-04 08:08:39', '2024-09-04 08:09:22'),
	(11, 3, 3, 5, 4, 1, 150000, 150000, '2024-09-04 08:08:44', '2024-09-04 08:09:22');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_produk: ~6 rows (approximately)
/*!40000 ALTER TABLE `table_produk` DISABLE KEYS */;
INSERT INTO `table_produk` (`id_produk`, `nama_produk`, `detail_produk`, `nomor_registrasi_produk`, `stok`, `stiker`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 'Samsu Refil', 'Samsu Refilg', '', 98, 'sale', '2024-09-03 15:51:16', '2024-09-04 08:09:22', NULL),
	(3, 'Malboro', 'malboro', '', 394, 'new', '2024-09-03 15:54:27', '2024-09-04 08:09:22', NULL),
	(4, 'Dunmil', 'Dunmil', '', 494, '0', '2024-09-03 15:58:26', '2024-09-04 08:09:22', NULL),
	(6, 'Dunmilllll', 'tessss', '', 0, '0', '2024-09-03 16:09:43', '2024-09-03 16:10:50', NULL),
	(7, 'Dunmilssada', 'adadad', '240903041111', 0, '0', '2024-09-03 16:10:52', '2024-09-03 16:11:11', NULL),
	(8, '-', '', '', 0, '0', '2024-09-03 16:11:12', '2024-09-03 16:11:12', NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_stok: ~3 rows (approximately)
/*!40000 ALTER TABLE `table_stok` DISABLE KEYS */;
INSERT INTO `table_stok` (`id_stok`, `id_produk`, `stok_awal`, `stok_akhir`, `harga_modal`, `harga_jual`, `keuntungan`, `created_at`, `updated_at`) VALUES
	(1, 2, 100, 2, 130000, 150000, 40000, '2024-09-04 00:00:00', '2024-09-04 08:09:22'),
	(3, 3, 400, 8, 140000, 150000, 80000, '2024-09-04 00:00:00', '2024-09-04 08:09:22'),
	(4, 4, 500, 8, 140000, 150000, 80000, '2024-09-04 00:00:00', '2024-09-04 08:09:22');
/*!40000 ALTER TABLE `table_stok` ENABLE KEYS */;

-- Dumping structure for table bang_benk.table_transaksi
CREATE TABLE IF NOT EXISTS `table_transaksi` (
  `id_transaksi` int(5) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status_transaksi` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_transaksi: ~0 rows (approximately)
/*!40000 ALTER TABLE `table_transaksi` DISABLE KEYS */;
INSERT INTO `table_transaksi` (`id_transaksi`, `id_user`, `total_harga`, `status_transaksi`, `created_at`, `updated_at`) VALUES
	(1, 5, 600000, '', '2024-09-04 08:00:34', NULL),
	(2, 5, 600000, '', '2024-09-04 08:03:39', NULL),
	(3, 5, 600000, '', '2024-09-04 08:03:58', NULL),
	(4, 5, 2100000, '', '2024-09-04 08:09:21', NULL);
/*!40000 ALTER TABLE `table_transaksi` ENABLE KEYS */;

/*!40000 ALTER TABLE `table_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
