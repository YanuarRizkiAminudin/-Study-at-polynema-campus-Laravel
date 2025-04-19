-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping data for table pwl_pos1.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;

-- Dumping data for table pwl_pos1.migrations: ~12 rows (approximately)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2025_03_28_230146_create_m_supplier_table', 1),
	(6, '2025_04_10_142322_create_m_level_table', 1),
	(7, '2025_04_10_142548_create_m_user_table', 1),
	(8, '2025_04_10_142829_create_m_kategori_table', 1),
	(9, '2025_04_10_154459_create_m_barang_table', 1),
	(10, '2025_04_10_154753_create_t_stok_table', 1),
	(11, '2025_04_10_155019_create_t_penjualan_table', 1),
	(12, '2025_04_10_155331_create_t_penjualan_detail_table', 1);

-- Dumping data for table pwl_pos1.m_barang: ~2 rows (approximately)
DELETE FROM `m_barang`;
INSERT INTO `m_barang` (`barang_id`, `kategori_id`, `barang_kode`, `barang_nama`, `harga_beli`, `harga_jual`, `created_at`, `updated_at`) VALUES
	(4, 4, '232', 'wesww', 2343533, 134213333, '2025-04-14 14:55:10', '2025-04-14 17:12:30'),
	(6, 5, '2325656', 'wetewdr', 1232466, 2345689, '2025-04-15 06:49:12', '2025-04-15 06:49:12');

-- Dumping data for table pwl_pos1.m_kategori: ~3 rows (approximately)
DELETE FROM `m_kategori`;
INSERT INTO `m_kategori` (`kategori_id`, `kategori_kode`, `kategori_nama`, `created_at`, `updated_at`) VALUES
	(4, 'wdwdqfdsfg', 'ewdwesdfg', '2025-04-13 19:22:24', '2025-04-14 17:13:26'),
	(5, 'gaww', 'ahrahrha', '2025-04-15 02:44:02', '2025-04-15 02:44:02'),
	(6, 'thkjzkj', 'kjhzg', '2025-04-15 02:45:41', '2025-04-15 02:45:41');

-- Dumping data for table pwl_pos1.m_level: ~7 rows (approximately)
DELETE FROM `m_level`;
INSERT INTO `m_level` (`level_id`, `level_kode`, `level_nama`, `created_at`, `updated_at`) VALUES
	(1, 'ADM', 'Administrator', NULL, '2025-04-13 13:28:53'),
	(2, 'MNGa', 'Manager2', NULL, '2025-04-13 13:26:31'),
	(3, 'STFHAS', 'Staff/Kasir/gudang', NULL, '2025-04-15 19:45:20'),
	(6, 'ADMT', 'ADMIN TOKO', '2025-04-13 07:33:46', '2025-04-13 07:33:46'),
	(7, 'ADBO', 'ADMIN GANTENG', '2025-04-13 07:43:28', '2025-04-14 06:22:38'),
	(10, 'sdfg', 'gfsgfd', '2025-04-14 16:07:38', '2025-04-14 16:07:38'),
	(11, 'jkh', 'jkhhj', '2025-04-14 16:43:49', '2025-04-14 16:43:49');

-- Dumping data for table pwl_pos1.m_supplier: ~1 rows (approximately)
DELETE FROM `m_supplier`;
INSERT INTO `m_supplier` (`supplier_id`, `supplier_kode`, `supplier_nama`, `supplier_alamat`, `created_at`, `updated_at`) VALUES
	(2, 'dakjf', 'dfjsfkjs', 'sfdlkjsks', '2025-04-15 15:34:38', '2025-04-15 15:34:38');

-- Dumping data for table pwl_pos1.m_user: ~4 rows (approximately)
DELETE FROM `m_user`;
INSERT INTO `m_user` (`user_id`, `level_id`, `username`, `nama`, `password`, `created_at`, `updated_at`) VALUES
	(6, 3, 'qwe', 'asdadaasd', '123456', '2025-04-13 10:19:35', '2025-04-13 10:39:00'),
	(7, 1, 'rerrtre', 'redredresresresr', 'trdesredytr', '2025-04-13 10:25:17', '2025-04-13 10:25:17'),
	(11, 1, 'frgs', 'gsfh', '$1$w/Uy87wM$LBIwApJAbUsHfd01H3B15.', '2025-04-14 16:08:05', '2025-04-14 16:08:05'),
	(12, 1, 'admin2', 'Noklen', '$2y$10$ITvGjFXWc.kqZ8G9kSAaVOltUXD1b3WiJPzr/kSDty/XleeTAlQOi', '2025-04-15 19:16:22', '2025-04-15 19:16:22');

-- Dumping data for table pwl_pos1.password_reset_tokens: ~0 rows (approximately)
DELETE FROM `password_reset_tokens`;

-- Dumping data for table pwl_pos1.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;

-- Dumping data for table pwl_pos1.t_penjualan: ~0 rows (approximately)
DELETE FROM `t_penjualan`;

-- Dumping data for table pwl_pos1.t_penjualan_detail: ~0 rows (approximately)
DELETE FROM `t_penjualan_detail`;

-- Dumping data for table pwl_pos1.t_stok: ~0 rows (approximately)
DELETE FROM `t_stok`;

-- Dumping data for table pwl_pos1.users: ~0 rows (approximately)
DELETE FROM `users`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
