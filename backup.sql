-- MySQL dump 10.16  Distrib 10.1.25-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: league
-- ------------------------------------------------------
-- Server version	10.1.25-MariaDB

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
-- Table structure for table `matches`
--

DROP TABLE IF EXISTS `matches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team1` int(11) DEFAULT NULL,
  `team2` int(11) DEFAULT NULL,
  `date` date NOT NULL,
  `scored1` int(11) DEFAULT NULL,
  `scored2` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_62615BAE1002E4` (`team1`),
  KEY `IDX_62615BA9719535E` (`team2`),
  CONSTRAINT `FK_62615BA9719535E` FOREIGN KEY (`team2`) REFERENCES `teams` (`id`),
  CONSTRAINT `FK_62615BAE1002E4` FOREIGN KEY (`team1`) REFERENCES `teams` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matches`
--

LOCK TABLES `matches` WRITE;
/*!40000 ALTER TABLE `matches` DISABLE KEYS */;
INSERT INTO `matches` VALUES (1,3,11,'2017-07-28',NULL,NULL),(2,2,4,'2017-07-29',NULL,NULL),(3,8,7,'2017-07-30',NULL,NULL),(4,12,1,'2017-07-31',NULL,NULL),(5,6,9,'2017-08-01',NULL,NULL),(6,5,10,'2017-08-02',NULL,NULL);
/*!40000 ALTER TABLE `matches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teams`
--

DROP TABLE IF EXISTS `teams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teams` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `played` int(11) NOT NULL DEFAULT '0',
  `wins` int(11) NOT NULL DEFAULT '0',
  `draws` int(11) NOT NULL DEFAULT '0',
  `losses` int(11) NOT NULL DEFAULT '0',
  `scored` int(11) NOT NULL DEFAULT '0',
  `missed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_96C22258C4E0A61F` (`team`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teams`
--

LOCK TABLES `teams` WRITE;
/*!40000 ALTER TABLE `teams` DISABLE KEYS */;
INSERT INTO `teams` VALUES (1,'Manchester United',0,0,0,0,0,0),(2,'Real Madrid',0,0,0,0,0,0),(3,'Barselona',0,0,0,0,0,0),(4,'Chelsea',0,0,0,0,0,0),(5,'Milan',0,0,0,0,0,0),(6,'Juventus',0,0,0,0,0,0),(7,'Galatasaray',0,0,0,0,0,0),(8,'Porto',0,0,0,0,0,0),(9,'Bayern Munchen',0,0,0,0,0,0),(10,'Borussia Dortmund',0,0,0,0,0,0),(11,'PSG',0,0,0,0,0,0),(12,'Benfica',0,0,0,0,0,0);
/*!40000 ALTER TABLE `teams` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-28 15:00:32
