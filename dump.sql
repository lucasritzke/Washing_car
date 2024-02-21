-- MySQL dump 10.13  Distrib 8.2.0, for Linux (x86_64)
--
-- Host: localhost    Database: washing_project
-- ------------------------------------------------------
-- Server version	8.2.0

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
-- Table structure for table `car_informations`
--

DROP TABLE IF EXISTS `car_informations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `car_informations` (
  `id_car` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(45) NOT NULL,
  `carCPF` varchar(23) DEFAULT NULL,
  `email` varchar(70) NOT NULL,
  `service_type` varchar(23) NOT NULL,
  `car_name` varchar(45) NOT NULL,
  `car_plate` varchar(27) NOT NULL,
  `car_mileage` varchar(15) NOT NULL,
  `car_image_1` longblob,
  `car_image_2` longblob,
  `car_image_3` longblob,
  `car_image_4` longblob,
  `today_day` varchar(12) NOT NULL,
  `pick_up_Day` varchar(12) NOT NULL,
  `total_value` varchar(10) NOT NULL,
  PRIMARY KEY (`id_car`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `car_informations`
--

LOCK TABLES `car_informations` WRITE;
/*!40000 ALTER TABLE `car_informations` DISABLE KEYS */;
/*!40000 ALTER TABLE `car_informations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hamburger`
--

DROP TABLE IF EXISTS `hamburger`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hamburger` (
  `file_name` varchar(30) DEFAULT NULL,
  `display_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hamburger`
--

LOCK TABLES `hamburger` WRITE;
/*!40000 ALTER TABLE `hamburger` DISABLE KEYS */;
INSERT INTO `hamburger` VALUES ('edit_informations.php','Edit informations'),('add_new_jobs.php','Other tasks'),('edit_worker.php','Edit workers');
/*!40000 ALTER TABLE `hamburger` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'Car-Washing'),(2,'Car Polishing'),(8,'Clean');
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu` (
  `file_name` varchar(40) NOT NULL,
  `display_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES ('index.php','Home'),('register.php','Register'),('search.php','Search'),('close_order.php','Close order'),('list_orders.php','List orders'),('remove_order.php','Remove order');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `workers`
--

DROP TABLE IF EXISTS `workers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `workers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `birthdate` varchar(20) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `edit_informations` tinyint(1) DEFAULT '0',
  `search_informations` tinyint(1) DEFAULT '0',
  `create_new_jobs` tinyint(1) DEFAULT '0',
  `add_workers` tinyint(1) DEFAULT '0',
  `remove_workers` tinyint(1) DEFAULT '0',
  `edit_workers` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `workers`
--

LOCK TABLES `workers` WRITE;
/*!40000 ALTER TABLE `workers` DISABLE KEYS */;
INSERT INTO `workers` VALUES (1,'Adimn','2006-02-08','Male','111.111.111-23',1,1,1,1,1,1),(23,'Lucas Felipe Ritzke','2024-02-01','Male','111.111.111-21',0,1,0,0,0,0),(24,'Lucas','2024-02-07','Male','111.111.111-20',0,0,0,0,0,0),(25,'Luciano','2000-02-08','Male','111.111.111-99',0,0,1,1,1,0);
/*!40000 ALTER TABLE `workers` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-20 17:17:29
