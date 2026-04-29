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

-- Dumping structure for table chi001db.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categoryId` int NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `categoryDescription` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`categoryId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='These categorys orginize our products into different groupings';

-- Dumping data for table chi001db.categories: ~3 rows (approximately)
INSERT INTO `categories` (`categoryId`, `categoryName`, `categoryDescription`) VALUES
	(2, 'Gear', 'Sporting Gear'),
	(3, 'Accesories', 'Stuff that make your tech better'),
	(4, 'Tech', 'Tech from phone to laptops'),
	(5, 'Iphones', 'Iphones'),
	(6, 'Apple Watches', 'A Apple device on yout wrist'),
	(7, 'Macbooks', 'A computer for a user with lots of tasks to do');

-- Dumping structure for table chi001db.products
DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `productId` int NOT NULL AUTO_INCREMENT,
  `productName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `productDescription` mediumtext COLLATE utf8mb4_general_ci NOT NULL,
  `categoryId` int NOT NULL,
  `stockLevels` int NOT NULL DEFAULT '0',
  `productImage` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(6,2) NOT NULL,
  PRIMARY KEY (`productId`),
  KEY `FK_product_category` (`categoryId`),
  CONSTRAINT `FK_product_category` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table chi001db.products: ~11 rows (approximately)
INSERT INTO `products` (`productId`, `productName`, `productDescription`, `categoryId`, `stockLevels`, `productImage`, `price`) VALUES
	(1, 'IPhone 14', 'A iphone from 2020', 5, 100, 'iphone14.png', 856.00),
	(11, 'Clear phone case', 'Clear magsafe case', 3, 100, 'clear.png', 50.00),
	(12, 'IPhone 14 Pro', 'A pro iphone for a pro user', 5, 100, 'iphone14pro.png', 1000.00),
	(13, 'IPhone 17', 'The latest and greatest iphone model', 5, 100, 'iphone17.png', 1399.00),
	(14, 'Apple Watch Series 11', 'Apple Watch is the ultimate device for a healthy life.', 6, 100, 'watch11.png', 599.00),
	(15, 'Sport band', 'A sport band for your apple watch', 3, 100, 'sportband1.png', 59.00),
	(16, 'Apple Watch SE 3', 'A cheap apple watch for budget users', 6, 100, 'applese3.png', 399.00),
	(17, 'Macbook Neo', 'A budget freindly macbook for lightweight work', 7, 100, 'macbookneo.png', 899.00),
	(18, 'iPhone 17 Pro', 'PRO', 5, 100, 'iphone17pro.png', 1999.00),
	(19, 'Macbook Air', 'A User freindly Macbook ', 7, 100, 'macbookair.png', 1799.00),
	(20, 'Apple Watch Ultra 3', 'Personal Beast', 6, 100, 'ultra3.png', 1399.00);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
