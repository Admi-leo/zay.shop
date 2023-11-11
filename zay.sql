-- MySQL dump 10.13  Distrib 8.0.30, for Linux (x86_64)
--
-- Host: localhost    Database: zay
-- ------------------------------------------------------
-- Server version	8.0.30-0ubuntu0.20.04.2

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `banners` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(249) NOT NULL,
  `description` text,
  `image` varchar(32) DEFAULT NULL,
  `public` varchar(10) NOT NULL DEFAULT 'public',
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banners`
--

LOCK TABLES `banners` WRITE;
/*!40000 ALTER TABLE `banners` DISABLE KEYS */;
INSERT INTO `banners` VALUES (1,'Things','New boots for You!','banners/iwhkxbzn4q.jpg','public','2022-10-19 04:58:51','2022-11-03 15:55:06'),(2,'Accessories','An original products for Your work table. ','banners/uqb4u0vkzd.jpg','public','2022-10-19 05:12:18','2022-11-03 15:57:08'),(3,'Brand Curology','All for Your health','banners/ryo6mgbzse.jpg','public','2022-10-19 05:25:48','2022-11-03 15:58:47');
/*!40000 ALTER TABLE `banners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `brands` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `image` varchar(64) DEFAULT NULL,
  `link` varchar(64) NOT NULL DEFAULT '/',
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brands`
--

LOCK TABLES `brands` WRITE;
/*!40000 ALTER TABLE `brands` DISABLE KEYS */;
INSERT INTO `brands` VALUES (1,'Adidas','brands/a9fnzu3q0r.png','https://adidas.com','2022-10-16 05:32:16','2022-10-30 14:13:51'),(2,'Nike','brands/jm7ovxfd77.png','https://nike.com','2022-10-16 05:32:27','2022-11-03 16:00:02'),(3,'Levi\'s','brands/9gjuj0ucy7.png','https://levis.com','2022-10-16 05:32:36','2022-11-03 16:00:12'),(4,'H&M','brands/ijcclczbvb.png','https://handm.com','2022-10-16 05:32:45','2022-11-03 16:00:23'),(5,'Apple',NULL,'','2022-11-04 06:42:01',NULL);
/*!40000 ALTER TABLE `brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `product` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int unsigned DEFAULT '0',
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (138,'mouse',5,'2022-11-03 06:27:44','2022-11-03 06:42:11',4,4),(139,'pencil',1,'2022-11-03 06:28:00',NULL,4,1),(140,'pencil',3,'2022-11-04 10:24:18','2022-11-04 11:07:30',1,1);
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `image` varchar(64) DEFAULT NULL,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Boots','categories/rv2pdldjhp.jpg','2022-10-16 05:31:32',NULL),(2,'Watches','categories/espcfwiub2.jpg','2022-10-16 05:31:50',NULL),(3,'Sunglass','categories/5am7ggz6d8.jpg','2022-10-16 05:31:59',NULL),(4,'Accessories','categories/zwad9aw0xd.jpg','2022-10-18 05:01:50','2022-11-03 16:01:46'),(5,'PC & other','categories/yzfom663rt.jpg','2022-10-18 05:02:31','2022-11-03 16:03:21');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `comments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,'comments\r\n','2022-11-04 13:49:02',NULL,1,7);
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `likes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=329 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
INSERT INTO `likes` VALUES (22,4,2,'2022-10-28 06:56:16'),(23,4,3,'2022-10-28 06:56:18'),(326,1,4,'2022-11-03 16:23:34'),(327,1,3,'2022-11-04 10:24:52'),(328,1,1,'2022-11-04 12:47:15');
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_tm` decimal(10,2) unsigned DEFAULT '0.00',
  `price_usd` decimal(10,2) unsigned DEFAULT '0.00',
  `quantity` int DEFAULT '0',
  `totalQuantity` int DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_1` varchar(32) DEFAULT NULL,
  `image_2` varchar(32) DEFAULT NULL,
  `image_3` varchar(32) DEFAULT NULL,
  `image_4` varchar(32) DEFAULT NULL,
  `rating` float(2,1) DEFAULT '0.0',
  `likes` int DEFAULT '0',
  `reviews` int DEFAULT '0',
  `sold` int DEFAULT '0',
  `color` varchar(64) DEFAULT NULL,
  `public` varchar(32) DEFAULT 'private',
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_update` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `category_id` int unsigned DEFAULT NULL,
  `brand_id` int unsigned DEFAULT NULL,
  `user_id` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  KEY `brand_id` (`brand_id`),
  FULLTEXT KEY `idx_name` (`name`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT,
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'pencil',10.00,1.00,424,16,'The new pencel','products/6pbrqdwjig.jpg','products/rkz3fkznev.jpg','products/pib3m9fupw.jpg',NULL,0.0,3,10,0,'white','public','2022-10-18 11:06:16','2022-11-04 12:47:15',1,1,1),(2,'mac',4000.00,210.00,4,4,'PC with monitor, mouse and keyboard','products/yrw5oa4bvv.jpg',NULL,NULL,NULL,0.0,1,3,0,'black','public','2022-10-18 11:06:17','2022-11-04 12:48:17',5,5,1),(3,'pencil',10.00,1.00,64,16,'The new pencel','products/pb3kygumue.jpg',NULL,NULL,NULL,0.0,2,5,0,'white','public','2022-10-18 11:51:12','2022-11-04 10:24:52',4,4,1),(4,'mouse',100.00,5.00,0,4,'The mouse is power','products/yjjp8uehqt.jpg',NULL,NULL,NULL,0.0,1,11,0,'black','public','2022-10-18 11:51:13','2022-11-03 16:23:35',4,3,1),(5,'dwwd',2.22,2.22,0,2,'2ewdwd','products/f9djhkbsiq.gif',NULL,NULL,NULL,0.0,0,1,0,'wd','public','2022-10-18 12:05:09','2022-10-30 15:59:36',4,1,1),(7,'pencil',10.00,1.00,4,16,'The new pencel','products/vih4qtdvw5.jpg',NULL,NULL,NULL,0.0,0,3,0,'white','public','2022-10-18 13:12:11','2022-10-31 05:10:44',5,2,1),(8,'mouse',100.00,5.00,0,4,'The mouse is power','products/a0sxhhs282.jpg',NULL,NULL,NULL,0.0,0,0,0,'black','public','2022-10-18 13:12:11','2022-10-25 05:09:36',3,3,1),(9,'pencil',10.00,1.00,16,16,'The new pencel',NULL,NULL,NULL,NULL,0.0,0,0,0,'white','private','2022-10-18 13:14:09',NULL,NULL,NULL,1),(10,'mouse',100.00,5.00,0,4,'The mouse is power','products/klbjx3ozkn.jpg',NULL,NULL,NULL,0.0,0,0,0,'black','public','2022-10-18 13:14:09','2022-10-26 12:01:25',1,1,1);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `product_id` int unsigned NOT NULL,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (2,1,1,'2022-10-30 13:05:51'),(3,1,1,'2022-10-30 13:10:32'),(4,1,1,'2022-10-30 13:10:36'),(5,1,1,'2022-10-30 13:10:36'),(6,1,1,'2022-10-30 13:10:37'),(12,1,2,'2022-10-30 13:20:46'),(13,1,3,'2022-10-30 13:57:50'),(14,1,7,'2022-10-30 14:07:33'),(15,1,4,'2022-10-30 14:57:07'),(16,1,5,'2022-10-30 15:59:36'),(17,4,1,'2022-10-30 16:00:01'),(18,4,2,'2022-10-30 16:00:04'),(19,4,3,'2022-10-30 16:00:07'),(20,4,4,'2022-10-30 16:00:11'),(21,4,7,'2022-10-30 16:00:13');
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `support`
--

DROP TABLE IF EXISTS `support`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `support` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `answer` text,
  `dt_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt_answer` varchar(32) DEFAULT NULL,
  `status` varchar(32) NOT NULL DEFAULT 'open',
  `user_id` int unsigned NOT NULL,
  `answer_user_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `support_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `support`
--

LOCK TABLES `support` WRITE;
/*!40000 ALTER TABLE `support` DISABLE KEYS */;
INSERT INTO `support` VALUES (2,'I want to buy my cart','No problem.','2022-10-31 12:03:56','2022-10-31','closed',4,1),(3,'MEefefsfesf efa dw',NULL,'2022-10-31 12:19:31',NULL,'open',4,NULL);
/*!40000 ALTER TABLE `support` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(249) NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `year` date DEFAULT NULL,
  `sex` tinyint unsigned DEFAULT '0',
  `image` varchar(20) DEFAULT NULL,
  `buy` int unsigned NOT NULL DEFAULT '0',
  `status` tinyint unsigned NOT NULL DEFAULT '0',
  `verified` tinyint unsigned NOT NULL DEFAULT '0',
  `resettable` tinyint unsigned NOT NULL DEFAULT '1',
  `roles_mask` int unsigned NOT NULL DEFAULT '0',
  `registered` int unsigned NOT NULL,
  `last_login` int unsigned DEFAULT NULL,
  `force_logout` mediumint unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'devel@zay.com','$2y$10$SPt66M5MI9qlaw1slHUVYu8CKu238TFmuVxB5/DU7G1AdzZYof/aO','devel','2003-03-06',1,'users/82mh6dchnt.JPG',0,0,1,1,1,1665897539,1667569552,0),(4,'hall@mail.com','$2y$10$0pnbH.HX7JAa0bvZzn6cf.Eq44q0odo6k1mZfifwBRgkCE0AC7/be','hall','2022-10-13',1,'users/9xs3r33k37.gif',0,0,1,1,2,1666798205,1667456618,0),(8,'bayr@mail.com','$2y$10$qZWFSa2GJHKY5dYKrodx9.XqJsSK5mZG7.9PLR.dZTz/eoHaLxrZy','kuwww','2022-12-11',0,'users/tyt2sf85l8.jpg',0,0,1,1,1024,1667451648,1667459177,0),(9,'bay2r@mail.com','$2y$10$VsOhC9uuNgf5pZlWxCPMUOy.iekXW/V8M8y7dnbDIw9HlwwqP0sze','dee',NULL,0,NULL,0,0,1,1,1024,1667458614,NULL,0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_confirmations`
--

DROP TABLE IF EXISTS `users_confirmations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_confirmations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int unsigned NOT NULL,
  `email` varchar(249) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `selector` varchar(16) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `email_expires` (`email`,`expires`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_confirmations`
--

LOCK TABLES `users_confirmations` WRITE;
/*!40000 ALTER TABLE `users_confirmations` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_confirmations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_remembered`
--

DROP TABLE IF EXISTS `users_remembered`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_remembered` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user` int unsigned NOT NULL,
  `selector` varchar(24) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `user` (`user`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_remembered`
--

LOCK TABLES `users_remembered` WRITE;
/*!40000 ALTER TABLE `users_remembered` DISABLE KEYS */;
INSERT INTO `users_remembered` VALUES (7,1,'7U4NBVT2CZHEQzKQv8uXZhHe','$2y$10$gJtVB6BROtzaaL55pMctPeT2HOKnVQsj9a8nH0LdeIZfF7dUjmwye',1668785101),(8,1,'87d6uf4HnbYMwc0oGph9hzB9','$2y$10$XekkCeOYqwW.SpPjqiKkDuZzScCp.rpuRdhq6ZrgSvwLDOznDYbMW',1669210649);
/*!40000 ALTER TABLE `users_remembered` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_resets`
--

DROP TABLE IF EXISTS `users_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_resets` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user` int unsigned NOT NULL,
  `selector` varchar(20) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `token` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `expires` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `selector` (`selector`),
  KEY `user_expires` (`user`,`expires`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_resets`
--

LOCK TABLES `users_resets` WRITE;
/*!40000 ALTER TABLE `users_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_throttling`
--

DROP TABLE IF EXISTS `users_throttling`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users_throttling` (
  `bucket` varchar(44) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `tokens` float unsigned NOT NULL,
  `replenished_at` int unsigned NOT NULL,
  `expires_at` int unsigned NOT NULL,
  PRIMARY KEY (`bucket`),
  KEY `expires_at` (`expires_at`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_throttling`
--

LOCK TABLES `users_throttling` WRITE;
/*!40000 ALTER TABLE `users_throttling` DISABLE KEYS */;
INSERT INTO `users_throttling` VALUES ('QduM75nGblH2CDKFyk0QeukPOwuEVDAUFE54ITnHM38',73.8021,1667569552,1668109552),('HIJQJPUQ2qyyTt0Q7_AuZA0pXm27czJnqpJsoA5IFec',49,1667458614,1667530614),('7763VQ-NA-XjxByIf65Q6uZn9_Gn-44I5pXsheQb6oc',29,1665897540,1665969540),('gf_HQx29v_qpyE0uP69vzzfZ3oy93fbXv2Bxg0mSgnQ',29,1665897540,1665969540),('PZ3qJtO_NLbJfRIP-8b4ME4WA3xxc6n9nbCORSffyQ0',4,1667458615,1667890615),('u-Ct9st8lBMPVW4s0SUTayLxtN46L5b1im8uueu4uQg',29,1665898777,1665970777),('wJRs51MEhKsfJRnkznfPoCKFoMD7AW2mKGlKEqHa1Ec',29,1665898777,1665970777),('OMhkmdh1HUEdNPRi-Pe4279tbL5SQ-WMYf551VVvH8U',14.5222,1667454640,1667490640),('vQZzUw9XlQf59k_eQZ4_V5Pb66d3puVrEQmm62Yp3S0',499,1666112302,1666285102),('Mup4Pug8NhRw0FT11hAPtgrQeEw_nxBphzhfhIe2qoQ',496.719,1667454640,1667627440),('G7HeO33KyJ1tPmYZgVS9VwyoCbK4BcXmsscdGKZja5I',29,1666798206,1666870206),('pzsxIeLVPKFqBwfPszFcKlpnmTkXDlDH7pmgDqifmeM',29,1666798206,1666870206),('GA3n6aXCVlC7BO82HOz9J_6F-Sd6fHjKUO_lNPN7NLw',29,1667188497,1667260497),('xQLXzWEvPUTIpKWIayaceMRPt806jkZf56GMr7ish5M',29,1667188497,1667260497),('Mhv6qBGM38magUCjTSdvl4UA45h3_iMjNbVIPKbyE8g',29,1667191192,1667263192),('Vgop6eGKrEacDN_765sGZy-HcK4N8u64ctecGLRuRZ4',29,1667191192,1667263192),('pISWJuu8lV6jNPTnBYJZ2xuMvwh4Zec7ichLKTOGSfU',29,1667386411,1667458411),('mXnZAZvZPZ3m4Z2xU84H3nWoTAWosMEGG4pwTDFokjs',29,1667386411,1667458411),('cV5UnEPPqe2dEN_wZK_JSDfVRt8UyX6h7lxXdffRKmk',29,1667458614,1667530614),('2nX3Ti2F9AmD1XDyQxI9Zn1KNpr350svbpYBVkL6Ky8',29,1667458614,1667530614);
/*!40000 ALTER TABLE `users_throttling` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-04 19:25:42
