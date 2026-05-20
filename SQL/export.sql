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

-- Dumping structure for table chi001db.products
CREATE TABLE IF NOT EXISTS `products` (
  `productId` int NOT NULL AUTO_INCREMENT,
  `productName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `productDescription` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `categoryId` int NOT NULL,
  `stockLevels` int NOT NULL DEFAULT '0',
  `productImage` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  PRIMARY KEY (`productId`),
  KEY `FK_product_category` (`categoryId`),
  CONSTRAINT `FK_product_category` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table chi001db.products: ~13 rows (approximately)
REPLACE INTO `products` (`productId`, `productName`, `productDescription`, `categoryId`, `stockLevels`, `productImage`, `price`) VALUES
	(1, 'IPhone 14', 'A reliable and stylish smartphone with a powerful camera, smooth performance, and long battery life, perfect for everyday use.', 5, 10, 'iphone14.png', 856.00),
	(11, 'Clear phone case', 'A lightweight protective case with a transparent design that keeps your phone safe while showing off its original look.', 3, 100, 'clear.png', 50.00),
	(12, 'IPhone 14 Pro', 'A premium smartphone featuring advanced cameras, powerful performance, and a stunning display for a professional experience.', 5, 100, 'iphone14pro.png', 1000.00),
	(13, 'IPhone 17', 'A modern smartphone with fast performance, improved cameras, and a sleek design built for everyday life.', 5, 100, 'iphone17.png', 1399.00),
	(14, 'Apple Watch Series 11', 'A sleek and powerful smartwatch designed to keep you connected, active, and healthy with advanced tracking features.', 6, 100, 'watch11.png', 599.00),
	(15, 'Sport band', 'A comfortable and durable watch band designed for everyday wear, workouts, and active lifestyles.', 3, 100, 'sportband1.png', 59.00),
	(16, 'Apple Watch SE 3', 'An affordable smartwatch with essential fitness tracking, notifications, and smooth performance for daily use.', 6, 100, 'applese3.png', 399.00),
	(17, 'Macbook Neo', 'The MacBook Neo is a sleek, modern laptop designed for everyday use, combining solid performance with a stylish design. It’s ideal for students and casual users who want a balance of speed, portability, and affordability for daily tasks like browsing, streaming, and schoolwork.', 7, 100, 'macbookneo.png', 899.00),
	(18, 'iPhone 17 Pro', 'A high-end smartphone with professional-grade cameras, powerful hardware, and premium features for advanced users.', 5, 100, 'iphone17pro.png', 1999.00),
	(19, 'Macbook Air', 'The MacBook Air is Apple’s thin and lightweight laptop, built for portability and efficiency. It delivers strong performance with Apple silicon chips, long battery life (up to around 18 hours), and a silent, fanless design—making it perfect for everyday use and productivity on the go.', 7, 100, 'macbookair.png', 1799.00),
	(20, 'Apple Watch Ultra 3', 'A rugged and advanced smartwatch built for adventure, fitness, and extreme durability.', 6, 100, 'ultra3.png', 1399.00),
	(21, 'Mac Pro', 'The Mac Pro is Apple’s most powerful desktop computer, designed for professionals who need extreme performance. It features high-end processors, advanced graphics, and a modular design that allows for customization and expansion. Built for tasks like video editing, 3D rendering, and software development, the Mac Pro delivers exceptional speed, reliability, and efficiency in demanding workflows.', 7, 20, 'macpro.png', 12000.00),
	(22, 'Macbook Pro', 'The MacBook Pro is a high-performance laptop designed for demanding tasks like video editing, coding, and creative work. It features more powerful chips, advanced graphics, and a premium display, making it ideal for professionals who need speed, power, and reliability.', 7, 19, 'macbookpro.png', 2699.00);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
