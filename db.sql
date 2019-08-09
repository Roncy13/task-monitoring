-- MySQL dump 10.16  Distrib 10.1.40-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: task_monitoring
-- ------------------------------------------------------
-- Server version	10.1.40-MariaDB

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
-- Table structure for table `position`
--

DROP TABLE IF EXISTS `position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `position`
--

LOCK TABLES `position` WRITE;
/*!40000 ALTER TABLE `position` DISABLE KEYS */;
INSERT INTO `position` VALUES (1,'Programmer 1','One Who turns coffee into code','2019-08-09 11:58:57','2019-08-09 11:58:57'),(2,'Qa 1','One Who Battles programmer regarding task','2019-08-09 11:59:18','2019-08-09 11:59:18'),(3,'admin','SUPER USER','2019-08-09 19:46:38','2019-08-09 19:46:38');
/*!40000 ALTER TABLE `position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tokens`
--

DROP TABLE IF EXISTS `tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `expired_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tokens`
--

LOCK TABLES `tokens` WRITE;
/*!40000 ALTER TABLE `tokens` DISABLE KEYS */;
INSERT INTO `tokens` VALUES (1,'ff4c6d8cecb3ce4e97be733e0cd633048b536546ba7e095ad113a52d885ef4fa',35,'2019-08-09 19:01:42','2019-08-09 19:01:42'),(2,'eb3090e61f84f6c9dc52627abe91d80d343779a4ba8e3efe90ac9ae99a83d1a3',35,'2019-08-09 19:04:22','2019-08-10 19:04:22'),(3,'e1631123c193b4fdb2be9c9e01ee3a85a86f9fc6369d095a5e6a4fa3e9245fab',35,'2019-08-09 19:14:18','2019-08-10 19:14:18'),(4,'d602a62071e5ef065bd0d560e0868d50cb17533b9bd467b2cde7504db49f7d5d',35,'2019-08-09 19:37:21','2019-08-10 19:37:21'),(5,'54b5ab45e5cf1b978352c60e129d316e2b9210415926d0be8639a8d6e6edaf23',35,'2019-08-09 19:40:33','2019-08-10 19:40:33'),(6,'7e964c4fb560d86f71d51df708306d3ee76b99d9d450eb56d735f6cafeb68711',35,'2019-08-09 19:40:57','2019-08-10 19:40:57'),(7,'9b3c7fc64fbd5124994418f69aa5df6d62812e85dd9ea5d166001b4ebe20d25e',35,'2019-08-09 19:41:53','2019-08-10 19:41:53'),(8,'57c001251444e7590cce848f8d75df8900ece0c27c3e762c08ea13d2b8f37607',35,'2019-08-09 19:45:54','2019-08-10 19:45:54'),(9,'e14a98c37a01db49fcbb3e70ea1b470435f4fd92b4b09e9993618bf5c4551dc6',35,'2019-08-09 19:47:32','2019-08-10 19:47:32'),(10,'1d06279d4a2a44180815cfdfd4aadd33cb5fbe86349f40ca9513ba06e67b0235',37,'2019-08-09 19:54:09','2019-08-10 19:54:09'),(11,'ae8c45983bdc84131e3e7cd83722e43b72587f99e3bb60f3bd54528cafad674b',37,'2019-08-09 19:54:20','2019-08-10 19:54:20'),(12,'c6daeeb8ebdc0132eb2f7bc5a09cadab4e3dbf121f3944b673ae46bddd3e3e20',35,'2019-08-09 20:17:18','2019-08-10 20:17:18'),(13,'dbfcee52fa0cac942009da4b329d5fca5079e8a5119eb706a9004e1047fcb2d7',37,'2019-08-09 20:18:30','2019-08-10 20:18:30');
/*!40000 ALTER TABLE `tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(200) NOT NULL,
  `lastName` varchar(200) NOT NULL,
  `middleName` varchar(200) DEFAULT NULL,
  `position_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `userPass` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (35,'James','Roncesvalles','Fombuena',1,'JamesRoncy13@gmail.com','099999912233','password','2019-08-09 18:15:15','2019-08-09 18:15:15'),(37,'Kal','Skills',NULL,3,'kal@gmail.com',NULL,'password','2019-08-09 19:54:00','2019-08-09 19:54:00'),(38,'dsadadsa','dasda','',1,'dsadas@gmail.com','1231231','123123123','2019-08-09 20:15:24','2019-08-09 20:15:24'),(39,'James','R',NULL,1,'james@gmail.com',NULL,'123123123','2019-08-09 20:16:32','2019-08-09 20:16:32'),(40,'James','R',NULL,1,'james@gmail.com',NULL,'123123123','2019-08-09 20:16:32','2019-08-09 20:16:32'),(41,'James','R',NULL,1,'james@gmail.com',NULL,'123123123','2019-08-09 20:16:32','2019-08-09 20:16:32'),(42,'James','R',NULL,1,'james@gmail.com',NULL,'123123123','2019-08-09 20:16:32','2019-08-09 20:16:32'),(43,'James','R',NULL,1,'james@gmail.com',NULL,'123123123','2019-08-09 20:16:32','2019-08-09 20:16:32'),(44,'James','R',NULL,1,'james@gmail.com',NULL,'123123123','2019-08-09 20:16:32','2019-08-09 20:16:32'),(45,'James','R',NULL,1,'james@gmail.com',NULL,'123123123','2019-08-09 20:16:32','2019-08-09 20:16:32'),(46,'James','R',NULL,1,'james@gmail.com',NULL,'123123123','2019-08-09 20:16:32','2019-08-09 20:16:32'),(47,'James','R',NULL,1,'james@gmail.com',NULL,'123123123','2019-08-09 20:16:33','2019-08-09 20:16:33'),(48,'mejas','33333',NULL,1,'james@gmail.com',NULL,'123123123','2019-08-09 20:16:33','2019-08-09 20:16:33'),(49,'Jobert','R',NULL,1,'james@gmail.com',NULL,'123123123','2019-08-09 20:16:57','2019-08-09 20:16:57'),(50,'Jobert','R',NULL,1,'james@gmail.com',NULL,'123123123','2019-08-09 20:16:57','2019-08-09 20:16:57'),(51,'Jobert','R',NULL,1,'james@gmail.com',NULL,'123123123','2019-08-09 20:16:57','2019-08-09 20:16:57'),(52,'Mark','R',NULL,1,'james@gmail.com',NULL,'dasd1231','2019-08-09 20:16:57','2019-08-09 22:30:33');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-08-09 22:31:44
