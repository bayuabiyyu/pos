-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table db_pos.barang
CREATE TABLE IF NOT EXISTS `barang` (
  `kode_barang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kode_kategori` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kode_satuan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_barang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `stok` int(11) NOT NULL,
  `stok_min` int(11) NOT NULL,
  `harga_beli` double NOT NULL,
  `harga_jual` double NOT NULL,
  `keterangan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table db_pos.detail_pembelian
CREATE TABLE IF NOT EXISTS `detail_pembelian` (
  `kode_transaksi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `qty` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `diskon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sub_total` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table db_pos.detail_penjualan
CREATE TABLE IF NOT EXISTS `detail_penjualan` (
  `kode_transaksi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kode_barang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `harga` double NOT NULL,
  `qty` double NOT NULL,
  `diskon` double NOT NULL,
  `sub_total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table db_pos.kategori
CREATE TABLE IF NOT EXISTS `kategori` (
  `kode_kategori` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_kategori` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_kategori`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table db_pos.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table db_pos.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table db_pos.pelanggan
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `kode_pelanggan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_pelanggan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table db_pos.pembelian
CREATE TABLE IF NOT EXISTS `pembelian` (
  `kode_transaksi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kode_supplier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `total_harga` double NOT NULL,
  `total_diskon` double NOT NULL,
  `dll` double NOT NULL,
  `bayar` double NOT NULL,
  `kembali` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table db_pos.penjualan
CREATE TABLE IF NOT EXISTS `penjualan` (
  `kode_transaksi` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kode_pelanggan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tgl_transaksi` datetime NOT NULL,
  `total_sub_total` double NOT NULL,
  `pajak` double NOT NULL,
  `total_diskon` double NOT NULL,
  `dll` double NOT NULL,
  `total_harga` double NOT NULL,
  `jenis_pembayaran` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bayar` double NOT NULL,
  `kembali` double NOT NULL,
  `keterangan` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_transaksi`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table db_pos.role
CREATE TABLE IF NOT EXISTS `role` (
  `kode_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table db_pos.satuan
CREATE TABLE IF NOT EXISTS `satuan` (
  `kode_satuan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_satuan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_satuan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table db_pos.supplier
CREATE TABLE IF NOT EXISTS `supplier` (
  `kode_supplier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama_supplier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alamat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `no_telp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`kode_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
-- Dumping structure for table db_pos.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `kode_role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
