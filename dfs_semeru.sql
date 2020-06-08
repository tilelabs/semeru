-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: dfs_semeru
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.29-MariaDB

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
-- Table structure for table `outcoverage`
--

DROP TABLE IF EXISTS `outcoverage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outcoverage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_outcoverage` varchar(30) NOT NULL,
  `id_rute` int(11) NOT NULL,
  `jarak` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outcoverage`
--

LOCK TABLES `outcoverage` WRITE;
/*!40000 ALTER TABLE `outcoverage` DISABLE KEYS */;
INSERT INTO `outcoverage` VALUES (1,'Surabaya',1,'70'),(2,'Surabaya',2,'95'),(3,'Surabaya',3,'100'),(4,'Surabaya',4,'107'),(5,'Surabaya',5,'148'),(6,'Banyuwangi',1,'242'),(7,'Banyuwangi',2,'313'),(8,'Banyuwangi',3,'209'),(9,'Banyuwangi',4,'195'),(10,'Banyuwangi',5,'168'),(11,'Blitar',1,'127'),(12,'Blitar',2,'77'),(13,'Blitar',3,'181'),(14,'Blitar',4,'188'),(15,'Blitar',5,'162');
/*!40000 ALTER TABLE `outcoverage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pos`
--

DROP TABLE IF EXISTS `pos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pos` varchar(30) NOT NULL,
  `jarak` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pos`
--

LOCK TABLES `pos` WRITE;
/*!40000 ALTER TABLE `pos` DISABLE KEYS */;
INSERT INTO `pos` VALUES (4,'Malang','18'),(5,'Tumpang','8'),(6,'Gubug Klakah','19'),(7,'Ngadas','2'),(8,'Jemplang','7'),(12,'Cemoro Kandang','5'),(13,'Kalimati','1.2'),(14,'Arcopodo','1.5'),(15,'Puncak Mahameru','0'),(16,'Pasuruan','69'),(17,'Wonokitri','5'),(18,'Simpang Dingklik','10'),(27,'Probolinggo','22'),(38,'Tongas','16'),(39,'Sukapura','18'),(40,'Cemorolawang','2.5'),(41,'G.Bromo','7'),(43,'Ranu Pani','25'),(49,'Lumajang','25'),(50,'Senduro','43'),(52,'Ranu Kumbolo','1'),(53,'Oro-oro Ombo','1.5');
/*!40000 ALTER TABLE `pos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rute`
--

DROP TABLE IF EXISTS `rute`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kota` varchar(25) NOT NULL,
  `data_pos` varchar(100) NOT NULL,
  `jarak` varchar(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rute`
--

LOCK TABLES `rute` WRITE;
/*!40000 ALTER TABLE `rute` DISABLE KEYS */;
INSERT INTO `rute` VALUES (1,'Pasuruan','16,17,18,41,8,43,52,53,12,13,14,15','133.2'),(2,'Malang','4,5,6,7,8,43,52,53,12,13,14,15','71.2'),(3,'Probolinggo','27,39,40,41,8,43,52,53,12,13,14,15','91.7'),(4,'Tongas','38,39,40,41,8,43,52,53,12,13,14,15','85.7'),(5,'Lumajang','49,50,43,52,53,12,13,14,15','103.2');
/*!40000 ALTER TABLE `rute` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'dfs_semeru'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-08 22:42:14
