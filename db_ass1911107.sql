-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_ass1911107
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_admin`
--

DROP TABLE IF EXISTS `tb_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `sandi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_admin`
--

LOCK TABLES `tb_admin` WRITE;
/*!40000 ALTER TABLE `tb_admin` DISABLE KEYS */;
INSERT INTO `tb_admin` VALUES (1,'asrul','$2y$10$KWcFEQrwF5QtxEC1iWVtGeAK2ZAIpszR35cjXWkPsq0WI95LZo8Lq');
/*!40000 ALTER TABLE `tb_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jenis`
--

DROP TABLE IF EXISTS `tb_jenis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_jenis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_pohon` varchar(50) DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jenis`
--

LOCK TABLES `tb_jenis` WRITE;
/*!40000 ALTER TABLE `tb_jenis` DISABLE KEYS */;
INSERT INTO `tb_jenis` VALUES (16,'Sonneratia alba','1762822667_sonneratiaalba.jpeg'),(17,'Avicennia marina','1762822689_avicenniamarina.jpeg'),(18,'Rhizophora apiculata','1762822711_rhizophoraapiculata.jpeg'),(19,'Bruguiera cylindrica','1762830010_bruguieracylindrica.jpg'),(20,'Bruguiera gymnorhiza','1762830027_bruguieragymnorhiza.jpg'),(21,'Avicennia alba','1762830058_avicenniaalba.png'),(22,'Rhizophora mucronata','1762830124_rhizophoramucronata.jpg'),(23,'Rhizophora stylosa','1762830155_rhizophorastylosa.jpg'),(24,'Sonneratia caseolaris','1762830192_sonneratiecaseolaris.jpg');
/*!40000 ALTER TABLE `tb_jenis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_lokasi`
--

DROP TABLE IF EXISTS `tb_lokasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_lokasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_jenis` int(11) NOT NULL,
  `nama_lokasi` varchar(100) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `desa` varchar(50) DEFAULT NULL,
  `kota` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_jenis` (`id_jenis`),
  CONSTRAINT `tb_lokasi_ibfk_1` FOREIGN KEY (`id_jenis`) REFERENCES `tb_jenis` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_lokasi`
--

LOCK TABLES `tb_lokasi` WRITE;
/*!40000 ALTER TABLE `tb_lokasi` DISABLE KEYS */;
INSERT INTO `tb_lokasi` VALUES (9,16,'Kel. Gambesi','0.753660','127.3387835','Gambesi','Ternate'),(10,17,'Kel. Fitu','0.754994','127.340721','Fitu','Ternate'),(11,18,'Kel. Jambula','0.754343','127.323929','Jambula','Ternate'),(12,22,'Kel. Doyado','0.712804','127.459417','Doyado','Tidore'),(14,21,'Kel. Tugulufa','0.670784','127.454547','Tugulufa','Tidore'),(15,20,'Kel. Rum Balibunga','0.732927','127.385309','Rum Balibunga','Tidore'),(17,23,'Kel. Maftutu','0.744835','127.448332','Maftutu','Tidore'),(18,24,'Kel. Tosa','0.743080','127.450136','Tosa','Tidore'),(19,19,'Kel. Goto','0.681170','127.454573','Goto','Tidore');
/*!40000 ALTER TABLE `tb_lokasi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-11-11 14:36:22
