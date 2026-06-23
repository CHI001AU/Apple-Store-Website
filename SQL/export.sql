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

-- Dumping structure for table chi001db.basketitems
DROP TABLE IF EXISTS `basketitems`;
CREATE TABLE IF NOT EXISTS `basketitems` (
  `basketItemId` int NOT NULL AUTO_INCREMENT,
  `userId` int DEFAULT NULL,
  `productId` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`basketItemId`),
  KEY `FK__users` (`userId`),
  KEY `FK_basketitems_products` (`productId`),
  CONSTRAINT `FK__users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_basketitems_products` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table chi001db.basketitems: ~0 rows (approximately)

-- Dumping structure for table chi001db.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categoryId` int NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `categoryDescription` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`categoryId`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='These categorys orginize our products into different groupings';

-- Dumping data for table chi001db.categories: ~6 rows (approximately)
INSERT INTO `categories` (`categoryId`, `categoryName`, `categoryDescription`) VALUES
	(2, 'Gear', 'Sporting Gear'),
	(3, 'Accesories', 'Stuff that make your tech better'),
	(4, 'Tech', 'Tech from phone to laptops'),
	(5, 'Iphones', 'Iphones'),
	(6, 'Apple Watches', 'A Apple device on yout wrist'),
	(7, 'Macbooks', 'A computer for a user with lots of tasks to do');

-- Dumping structure for table chi001db.orderitems
DROP TABLE IF EXISTS `orderitems`;
CREATE TABLE IF NOT EXISTS `orderitems` (
  `orderItemId` int NOT NULL AUTO_INCREMENT,
  `orderId` int DEFAULT NULL,
  `productId` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `price` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`orderItemId`),
  KEY `FK_orderitems_orders` (`orderId`),
  KEY `FK_orderitems_products` (`productId`),
  CONSTRAINT `FK_orderitems_orders` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_orderitems_products` FOREIGN KEY (`productId`) REFERENCES `products` (`productId`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table chi001db.orderitems: ~0 rows (approximately)

-- Dumping structure for table chi001db.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderId` int NOT NULL AUTO_INCREMENT,
  `orderDate` date DEFAULT NULL,
  `orderStatus` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `userId` int DEFAULT NULL,
  PRIMARY KEY (`orderId`),
  KEY `FK_orders_users` (`userId`),
  CONSTRAINT `FK_orders_users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table chi001db.orders: ~0 rows (approximately)

-- Dumping structure for table chi001db.products
DROP TABLE IF EXISTS `products`;
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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table chi001db.products: ~14 rows (approximately)
INSERT INTO `products` (`productId`, `productName`, `productDescription`, `categoryId`, `stockLevels`, `productImage`, `price`) VALUES
	(1, 'IPhone 14', '	A reliable and stylish smartphone built for everyday performance. Powered by the A15 Bionic chip, it delivers fast and smooth operation across all tasks. With a dual-camera system, Crash Detection, and impressive battery life, the iPhone 14 is a dependable companion for work and life.', 5, 10, 'iphone14.png', 856.00),
	(11, 'Clear phone case', 'A lightweight and protective case that lets your phone\'s design speak for itself. Crafted from durable, scratch-resistant material with a crystal-clear finish, it provides everyday protection against drops and bumps without adding unnecessary bulk — keeping your phone looking as good as new.', 3, 100, 'clear.png', 50.00),
	(12, 'IPhone 14 Pro', '	A premium smartphone that raises the bar with its Pro-grade 48MP camera system, Always-On Retina display, and the powerful A16 Bionic chip. Designed for professionals and enthusiasts alike, it handles photography, video, and demanding apps with ease — all in a refined stainless steel and glass build.', 5, 100, 'iphone14pro.png', 1000.00),
	(13, 'IPhone 17', 'A modern smartphone engineered for speed, creativity, and connectivity. Featuring Apple\'s latest chip, a next-generation camera system, and a beautifully refined design, the iPhone 17 delivers a seamless experience whether you\'re capturing memories, staying productive, or staying connected throughout the day.', 5, 100, 'iphone17.png', 1399.00),
	(14, 'Apple Watch Series 11', 'A sleek and powerful smartwatch built to keep you at your best every day. With advanced health sensors for heart rate, blood oxygen, and ECG monitoring, along with fitness tracking and smart notifications, the Series 11 seamlessly blends cutting-edge technology with an elegant, customisable design.', 6, 100, 'watch11.png', 599.00),
	(15, 'Sport band', 'A comfortable and durable watch band designed for active lifestyles. Made from high-performance, sweat-resistant fluoroelastomer, it offers a secure and comfortable fit during workouts, outdoor adventures, or everyday wear. Available in a range of colours to match your personal style.', 3, 100, 'sportband1.png', 59.00),
	(16, 'Apple Watch SE 3', '	An affordable yet capable smartwatch that delivers the core Apple Watch experience at an accessible price. Packed with essential health and fitness features — including heart rate monitoring, activity tracking, and emergency SOS — the SE 3 is the perfect entry point into the Apple Watch ecosystem.', 6, 100, 'applese3.png', 399.00),
	(17, 'Macbook Neo', '	A sleek and modern laptop built for the way you work today. Featuring a thin, lightweight design without compromising on performance, the MacBook Neo powers through everyday tasks, creative projects, and video calls with ease — all while delivering impressive battery life to keep up with your busy schedule.', 7, 100, 'macbookneo.png', 899.00),
	(18, 'iPhone 17 Pro', '	A high-end smartphone engineered for creators and power users who demand the very best. With a professional-grade camera system, a durable titanium frame, and Apple\'s most advanced chip, the iPhone 17 Pro handles 4K video, complex editing, and intensive applications with remarkable speed and precision.', 5, 100, 'iphone17pro.png', 1999.00),
	(19, 'Macbook Air', '	Apple\'s iconic thin and lightweight laptop, redesigned for effortless portability without sacrificing power. The MacBook Air features a stunning Liquid Retina display, a fanless design for silent operation, and all-day battery life — making it the perfect everyday laptop for students, professionals, and everyone in between.', 7, 100, 'macbookair.png', 1799.00),
	(20, 'Apple Watch Ultra 3', '	A rugged and advanced smartwatch built to perform in the most demanding environments. Crafted with a durable titanium case, precision dual-frequency GPS, and an extended battery that lasts days on a single charge, the Ultra 3 is the ultimate companion for athletes, hikers, and outdoor explorers.', 6, 100, 'ultra3.png', 1399.00),
	(21, 'Mac Pro', '	Apple\'s most powerful desktop computer, designed for professionals who demand extreme performance. With high-end processors, advanced graphics capabilities, and a modular design built for expansion, the Mac Pro excels in the most intensive workflows — from video editing and 3D rendering to music production and software development.', 7, 20, 'macpro.png', 12000.00),
	(22, 'Macbook Pro', '	A powerhouse laptop crafted for professionals who need serious performance in a portable form. Featuring Apple\'s most advanced chips, a breathtaking Liquid Retina XDR display, and exceptional battery life, the MacBook Pro handles everything from complex code and high-resolution video to detailed 3D graphics with effortless precision.', 7, 19, 'macbookpro.png', 2699.00),
	(23, 'Iphone 16e', '	Apple\'s most capable affordable iPhone, built for those who want a premium experience without the premium price tag. Powered by the A18 chip with full Apple Intelligence support, a 48MP camera, and up to 26 hours of battery life, the iPhone 16e delivers a complete, modern iPhone experience', 5, 19, 'iphone16e.png', 899.00);

-- Dumping structure for table chi001db.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `firstName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lastName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `street` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `town` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `state` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `postcode` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table chi001db.users: ~5 rows (approximately)
INSERT INTO `users` (`userId`, `username`, `password`, `firstName`, `lastName`, `street`, `town`, `state`, `postcode`, `phone`, `email`) VALUES
	(5, 'Admin', 'kgeroghoerghoerhgeo', 'Liam', 'Child', 'willandra 10', 'sydney', 'QLD', '2066', '0494 392 844', 'chi001@stpiusx.nsw.edu.au'),
	(6, 'Josh-apple', 'Josh', 'Josh', 'Pez', '51 street', 'willoughby', 'NSW', '2068', '0466898406', 'myemail@gmail.com'),
	(8, 'Admins', 'ghghghg', 'ghghghg', 'ghghghg', 'ghghghg', 'ghghghg', 'ghghghg', '2073', '0477591153', 'ghghghg@ghghg.com'),
	(9, 'Rayan', 'wefjknerkferkfhrekfh', 'glen', 'child', 'willandra 10', 'sydney', 'QLD', '2928', '0494 392 844', 'chi001@stpiusx.nsw.edu.au'),
	(11, 'Bfihfruihfirufhrui', 'asdfghjklasdfghj', 'asdf', 'asdf', 'sfrii1', 'kfbwek', 'asdfsa', 'asdf', '0462821712', 'ghghghg@ghghg.com'),
	(12, 'Asdfghjk', 'adfftstsetst', 'oqn--Qo_F-8--8SY2Ms', '-e0D_J2O8-__--09_M9_0C_2-e_S_6_Uf_', 'willandra 10', 'sydney', 'QLD', '2066', '0494 392 844', 'fgdfg@frifj.com');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
