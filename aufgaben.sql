-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for aufgaben
CREATE DATABASE IF NOT EXISTS `aufgaben` /*!40100 DEFAULT CHARACTER SET armscii8 COLLATE armscii8_bin */;
USE `aufgaben`;

-- Dumping structure for table aufgaben.aufgaben
CREATE TABLE IF NOT EXISTS `aufgaben` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `aufgabe` varchar(50) COLLATE armscii8_bin NOT NULL,
  `loesung` float NOT NULL DEFAULT 0,
  `level` int(1) NOT NULL,
  `operation1` float DEFAULT NULL,
  `operation2` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=armscii8 COLLATE=armscii8_bin;

-- Dumping data for table aufgaben.aufgaben: ~0 rows (approximately)
INSERT INTO `aufgaben` (`id`, `aufgabe`, `loesung`, `level`, `operation1`, `operation2`) VALUES
	(1, '17|-38|-90|-145|-197|-252|?|', -304, 1, -52, -55),
	(2, '193|108|202|117|?|', 211, 1, 94, -85),
	(3, '-15|-102|-151|-238|-287|?|', -374, 1, -87, -49),
	(4, '-66|-132|-198|-264|?|', -330, 1, -66, -66),
	(5, '-3|-58|-113|-168|-223|?|', -278, 1, -55, -55),
	(6, '0|0|0|0|0|0|0|0|0|?|', 0, 2, 46, 95),
	(7, '29|-29|-30|30|29|-29|-30|30|?|', 29, 2, -1, -1),
	(8, '-16|-48|-45|-135|-132|-396|-393|?|', -1179, 2, 3, 3),
	(9, '-81|81|80|-80|-81|?|', 81, 2, -1, -1),
	(10, '35|-39|78|4|-8|-82|164|90|?|', -180, 2, -74, -2),
	(11, '36|-158|-449|-837|-1322|-1904|?|', -1904, 3, -97, 1),
	(12, '27|83|167|279|419|587|?|', 587, 3, 28, 1),
	(13, '-85|-211|-400|-652|-967|?|', -967, 3, -63, 1),
	(14, '80|82|85|89|94|?|', 94, 3, 1, 1),
	(15, '-73|-65|-53|-37|-17|7|35|?|', 35, 3, 4, 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
