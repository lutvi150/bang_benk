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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.migrations: ~4 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
	(1, '2024-08-18-151205', 'App\\Database\\Migrations\\TablesUser', 'default', 'App', 1723999469, 1),
	(2, '2024-09-03-142907', 'App\\Database\\Migrations\\TabelProduk', 'default', 'App', 1725373991, 2),
	(3, '2024-09-03-143047', 'App\\Database\\Migrations\\TabelFotoProduk', 'default', 'App', 1725373992, 2),
	(4, '2024-09-03-161155', 'App\\Database\\Migrations\\TableStok', 'default', 'App', 1725380311, 3);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_foto_produk: ~0 rows (approximately)
/*!40000 ALTER TABLE `table_foto_produk` DISABLE KEYS */;
/*!40000 ALTER TABLE `table_foto_produk` ENABLE KEYS */;

-- Dumping structure for table bang_benk.table_produk
CREATE TABLE IF NOT EXISTS `table_produk` (
  `id_produk` int(5) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(255) NOT NULL,
  `detail_produk` text NOT NULL,
  `nomor_registrasi_produk` varchar(50) NOT NULL DEFAULT '',
  `stok` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_produk: ~6 rows (approximately)
/*!40000 ALTER TABLE `table_produk` DISABLE KEYS */;
INSERT INTO `table_produk` (`id_produk`, `nama_produk`, `detail_produk`, `nomor_registrasi_produk`, `stok`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(2, 'Samsu Refil', 'Samsu Refilg', '', 100, '2024-09-03 15:51:16', '2024-09-03 17:12:03', NULL),
	(3, 'Malboro', 'malboro', '', 0, '2024-09-03 15:54:27', '2024-09-03 15:56:05', NULL),
	(4, 'Dunmil', 'Dunmil', '', 0, '2024-09-03 15:58:26', '2024-09-03 15:58:51', NULL),
	(6, 'Dunmilllll', 'tessss', '', 0, '2024-09-03 16:09:43', '2024-09-03 16:10:50', NULL),
	(7, 'Dunmilssada', 'adadad', '240903041111', 0, '2024-09-03 16:10:52', '2024-09-03 16:11:11', NULL),
	(8, '-', '', '', 0, '2024-09-03 16:11:12', '2024-09-03 16:11:12', NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_stok: ~1 rows (approximately)
/*!40000 ALTER TABLE `table_stok` DISABLE KEYS */;
INSERT INTO `table_stok` (`id_stok`, `id_produk`, `stok_awal`, `stok_akhir`, `harga_modal`, `harga_jual`, `keuntungan`, `created_at`, `updated_at`) VALUES
	(1, 2, 100, 0, 130000, 150000, NULL, '2024-09-04 00:00:00', '2024-09-03 17:02:47');
/*!40000 ALTER TABLE `table_stok` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table bang_benk.table_user: ~1 rows (approximately)
/*!40000 ALTER TABLE `table_user` DISABLE KEYS */;
INSERT INTO `table_user` (`id`, `nama_user`, `email`, `password`, `profil_status`, `role`, `last_login`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Admin', 'admin@gmail.com', '5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8', '', 'administrator', '2024-08-18 16:46:51', '2024-08-18 16:46:51', NULL, NULL),
	(2, 'budi', 'budi@gamil.com', '24263bfaefb124c488c2f5e63d1d30b418f51d0d6f5b380aa1956ec40ea57278', 'nonak', 'pelanggan', '2024-09-03 13:20:24', '2024-09-03 13:20:24', '2024-09-03 13:20:24', NULL);
/*!40000 ALTER TABLE `table_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
