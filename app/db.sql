-- MySQL dump 10.13  Distrib 5.7.40, for Linux (x86_64)
--
-- Host: localhost    Database: samrons
-- ------------------------------------------------------
-- Server version	5.7.40-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,0,'Fashion','Fashion Category'),(2,1,'Women','Women Fashion'),(8,0,'Electronics','Electronics'),(9,2,'Apparels','Appreals');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `option_values`
--

DROP TABLE IF EXISTS `option_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `option_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_id` int(11) DEFAULT NULL,
  `value_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `option_id` (`option_id`),
  CONSTRAINT `option_values_ibfk_1` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option_values`
--

LOCK TABLES `option_values` WRITE;
/*!40000 ALTER TABLE `option_values` DISABLE KEYS */;
INSERT INTO `option_values` VALUES (1,1,'S'),(2,1,'M'),(3,1,'L'),(4,2,'Red'),(5,2,'Green'),(6,1,'S'),(7,1,'M'),(8,1,'L'),(9,2,'Red'),(10,2,'Green'),(11,1,'S'),(12,1,'M'),(13,2,'Red'),(14,1,'S'),(15,2,'Red'),(16,2,'Blue'),(17,1,'S'),(18,2,'Red'),(19,2,'Blue'),(20,1,'S'),(21,2,'Red'),(22,2,'Blue'),(23,1,'S'),(24,2,'Red'),(25,2,'Blue'),(26,1,'S'),(27,2,'Red'),(28,2,'Blue'),(29,1,'S'),(30,2,'Red'),(31,2,'Blue'),(32,1,'S'),(33,2,'Red'),(34,2,'Blue'),(35,1,'S'),(36,2,'Red'),(37,2,'Blue'),(38,1,'S'),(39,2,'Red'),(40,2,'Blue');
/*!40000 ALTER TABLE `option_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (1,'size'),(2,'color');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_options`
--

DROP TABLE IF EXISTS `product_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `option_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `option_id` (`option_id`),
  CONSTRAINT `product_options_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `product_options_ibfk_2` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_options`
--

LOCK TABLES `product_options` WRITE;
/*!40000 ALTER TABLE `product_options` DISABLE KEYS */;
INSERT INTO `product_options` VALUES (1,1,1),(2,1,2),(3,2,1),(4,2,2);
/*!40000 ALTER TABLE `product_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_variants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sku_id` varchar(50) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `product_image` blob,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_variants_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variants`
--

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
INSERT INTO `product_variants` VALUES (1,'sku100',1,100,500,_binary 'ElNTmnuW5s'),(2,'sku101',1,101,501,_binary '7pjelpgD4Q'),(3,'sku102',1,102,502,_binary 'xuShNO9z94'),(4,'sku103',1,103,503,_binary 'WE1EpEDqMc'),(5,'sku104',1,104,504,_binary 'h8KfmykHvB'),(6,'sku105',1,105,505,_binary 'dhAWxhLUOl'),(7,'sku100',2,100,500,_binary 'Ny75TXYflt'),(8,'sku101',2,101,501,_binary 'UG6bQsJMT9'),(9,'sku102',2,102,502,_binary 'GU0oBEY7KK'),(10,'sku103',2,103,503,_binary 'kh6csRTaC2'),(11,'sku104',2,104,504,_binary 'mVrWPrIu6D'),(12,'sku105',2,105,505,_binary 'QUhMNGutI0');
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Kurta','Kurta Description',67,9),(2,'Kurta','Kurta Description',67,9);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `create_datetime` datetime NOT NULL,
  `url_address` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (22,'priyanka','priyankanitk1727@gmail.com','bc8b69795bb22032c875cdeae4d13c2d91fa7d22','2022-10-29 01:49:21','oPnX9iwwfg','9910670050'),(23,'vendor','vendor@gmail.com','bc8b69795bb22032c875cdeae4d13c2d91fa7d22','2022-11-07 16:15:23','pZNzNzVsWT','9910670050'),(24,'vendor','vendor1@gmail.com','bc8b69795bb22032c875cdeae4d13c2d91fa7d22','2022-11-07 16:36:53','FRD5sB31qL','9910670050'),(25,'priyanka','a@b.com','7110eda4d09e062aa5e4a390b0a572ac0d2c0220','2022-11-10 12:55:18','tr5SwbNJd5','123456'),(26,'amber','a@b.com','7110eda4d09e062aa5e4a390b0a572ac0d2c0220','2022-11-12 11:11:58','61FPNbHnau','12334'),(27,'test','a@b.com','7110eda4d09e062aa5e4a390b0a572ac0d2c0220','2022-11-12 11:25:15','GvfZN3asjn','123456'),(28,'test123','a@bc.com','a29c57c6894dee6e8251510d58c07078ee3f49bf','2022-11-12 18:03:53','62Ytq8l7pj','1234567890'),(29,'test123','a@bc.com','a29c57c6894dee6e8251510d58c07078ee3f49bf','2022-11-12 18:05:21','nmxu0DdDFv','1234567890'),(30,'test123','a@bc.com','a29c57c6894dee6e8251510d58c07078ee3f49bf','2022-11-12 18:06:01','bjT3JkP1JN','1234567890'),(31,'test','a@bd.com','a29c57c6894dee6e8251510d58c07078ee3f49bf','2022-11-12 18:52:31','sHvJSJtrIl','1234567890');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `variant_values`
--

DROP TABLE IF EXISTS `variant_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `variant_values` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `variant_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `value_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `variant_id` (`variant_id`),
  KEY `product_id` (`product_id`),
  KEY `value_id` (`value_id`),
  CONSTRAINT `variant_values_ibfk_1` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`id`),
  CONSTRAINT `variant_values_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `variant_values_ibfk_3` FOREIGN KEY (`value_id`) REFERENCES `option_values` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `variant_values`
--

LOCK TABLES `variant_values` WRITE;
/*!40000 ALTER TABLE `variant_values` DISABLE KEYS */;
INSERT INTO `variant_values` VALUES (1,1,1,1),(2,2,1,2),(3,3,1,3),(4,4,1,4),(5,5,1,5),(6,6,1,NULL),(7,7,2,6),(8,8,2,7),(9,9,2,8),(10,10,2,9),(11,11,2,10),(12,12,2,NULL);
/*!40000 ALTER TABLE `variant_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vendors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `url_address` varchar(255) DEFAULT NULL,
  `create_datetime` datetime DEFAULT NULL,
  `aadhar` varchar(255) DEFAULT NULL,
  `pancard` varchar(255) DEFAULT NULL,
  `gst` varchar(50) DEFAULT NULL,
  `cheque` blob,
  `photo` blob,
  `signature` blob,
  `current_account_number` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vendors`
--

LOCK TABLES `vendors` WRITE;
/*!40000 ALTER TABLE `vendors` DISABLE KEYS */;
INSERT INTO `vendors` VALUES (67,'priyanka','priyankanitk1727@gmail.com','bc8b69795bb22032c875cdeae4d13c2d91fa7d22','9910670050','ojmcQKenIh','2022-11-15 23:24:24','123124124525','dsfsafas','1234567890',_binary 'GYKkOg4a2u',_binary '8vXo24ag7T',_binary 'xbHuKo5bV9','45353532',1);
/*!40000 ALTER TABLE `vendors` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-12-19 14:25:34
