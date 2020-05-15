-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.12-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5669
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table adminho.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(15) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table adminho.admin: ~1 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id`, `username`, `password`, `nama`, `foto`) VALUES
	(1, 'opendesa', '2696554fc2fd8c48d5d4148597096dc4', 'OpenDESA', 'logo-opendesa1.png');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table adminho.jasa
CREATE TABLE IF NOT EXISTS `jasa` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Dumping data for table adminho.jasa: ~6 rows (approximately)
/*!40000 ALTER TABLE `jasa` DISABLE KEYS */;
INSERT INTO `jasa` (`id`, `nama`) VALUES
	(1, 'Lengkap'),
	(2, 'Update Saja'),
	(3, 'Install Saja'),
	(4, 'Hosting Saja'),
	(5, 'Domain Saja'),
	(6, 'Hosting+Domain');
/*!40000 ALTER TABLE `jasa` ENABLE KEYS */;

-- Dumping structure for table adminho.pelaksana
CREATE TABLE IF NOT EXISTS `pelaksana` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table adminho.pelaksana: ~3 rows (approximately)
/*!40000 ALTER TABLE `pelaksana` DISABLE KEYS */;
INSERT INTO `pelaksana` (`id`, `nama`) VALUES
	(1, 'Rudi Purwanto'),
	(2, 'Herry Wanda'),
	(3, 'Muhammad Ihsan');
/*!40000 ALTER TABLE `pelaksana` ENABLE KEYS */;

-- Dumping structure for table adminho.pelanggan
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `kecamatan` varchar(50) DEFAULT NULL,
  `kabupaten` varchar(50) DEFAULT NULL,
  `provinsi` varchar(50) DEFAULT NULL,
  `namakontak` varchar(50) DEFAULT NULL,
  `nomorkontak` varchar(50) DEFAULT NULL,
  `domain` varchar(50) DEFAULT NULL,
  `alamat_cpanel` varchar(50) DEFAULT NULL,
  `uname_cpanel` varchar(50) DEFAULT NULL,
  `pwd_cpanel` varchar(50) DEFAULT NULL,
  `pwd_admin` varchar(50) DEFAULT NULL,
  `id_jasa` int(1) DEFAULT NULL,
  `rupiah` varchar(50) DEFAULT NULL,
  `tgl_mulai` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL,
  `id_pelaksana` int(1) DEFAULT NULL,
  `tempat_hosting` int(1) DEFAULT NULL,
  `keterangan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Dumping data for table adminho.pelanggan: ~0 rows (approximately)
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;

-- Dumping structure for table adminho.pelanggan1
CREATE TABLE IF NOT EXISTS `pelanggan1` (
  `id` varchar(255) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `telp` varchar(255) DEFAULT NULL,
  `id_jasa` int(11) DEFAULT NULL,
  `id_kelamin` int(1) DEFAULT NULL,
  `id_pelaksana` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table adminho.pelanggan1: ~0 rows (approximately)
/*!40000 ALTER TABLE `pelanggan1` DISABLE KEYS */;
/*!40000 ALTER TABLE `pelanggan1` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
