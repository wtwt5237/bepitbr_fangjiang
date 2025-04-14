-- MySQL dump 10.13  Distrib 8.0.23, for macos10.15 (x86_64)
--
-- Host: localhost    Database: RemoteR
-- ------------------------------------------------------
-- Server version	8.0.23

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
-- Table structure for table `TessaParameters`
--

DROP TABLE IF EXISTS `BepiParameters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `BepiParameters` (
  `JobID` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Inst` varchar(255) DEFAULT NULL,
  `Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Mode` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Thread` int(40) NOT NULL,
  `Length` int(40) NOT NULL,
  `motif0_file` longblob NOT NULL,
  `full0_file` longblob NOT NULL,
  `full0` longblob NOT NULL,
  `fasta0` longblob NOT NULL,
  PRIMARY KEY (`JobID`),
  CONSTRAINT `bepi_input_jobid` FOREIGN KEY (`JobID`) REFERENCES `Jobs` (`JobID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `TessaResults`
--

DROP TABLE IF EXISTS `BepiResults`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `BepiResults` (
  `JobID` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Predictions` mediumblob NOT NULL,
  PRIMARY KEY (`JobID`),
  CONSTRAINT `bepi_output_jobid` FOREIGN KEY (`JobID`) REFERENCES `Jobs` (`JobID`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-02-20 11:58:26

--
-- Table structure for table `Jobs`
--
-- DROP TABLE IF EXISTS `Jobs`;
--
CREATE TABLE `Jobs` (
   `JobID` varchar(40) NOT NULL,
   `Software` varchar(100) NOT NULL,
   `Analysis` varchar(255) NOT NULL,
   `Status` int NOT NULL DEFAULT '0',
   `CreateTime` datetime NOT NULL,
   `FinishTime` datetime DEFAULT NULL,
   PRIMARY KEY (`JobID`)
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

