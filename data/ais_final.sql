-- MySQL dump 10.13  Distrib 5.7.33, for Linux (x86_64)
--
-- Host: localhost    Database: ais_final
-- ------------------------------------------------------
-- Server version	5.7.33-0ubuntu0.16.04.1

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
-- Table structure for table `admin_alerts`
--

DROP TABLE IF EXISTS `admin_alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin_alerts` (
  `Admin_Alert_Key` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Alert` text NOT NULL,
  `Alert_Time` int(10) NOT NULL,
  `Is_Read` int(1) NOT NULL,
  `Alert_Code` char(32) NOT NULL,
  PRIMARY KEY (`Admin_Alert_Key`),
  UNIQUE KEY `tbl_unique` (`Alert_Code`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_alerts`
--

LOCK TABLES `admin_alerts` WRITE;
/*!40000 ALTER TABLE `admin_alerts` DISABLE KEYS */;
INSERT INTO `admin_alerts` VALUES (1,'Lea Joy Karaan updated his/her profile.',1677029629,1,'4278985d0b986f7b5fad5546bda31ef8'),(2,'Cherry Mae Garsuta updated his/her profile.',1677031756,1,'69a1cd3bfd1fcfda0d369897f30e0863'),(3,'  updated his/her profile.',1677074899,0,'0819ce89543e03b45d2eebda1ea67d5d');
/*!40000 ALTER TABLE `admin_alerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumni`
--

DROP TABLE IF EXISTS `alumni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumni` (
  `Alumni_Key` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Batch_Key` int(10) unsigned NOT NULL,
  `First_Name` varchar(100) NOT NULL,
  `Middle_Name` varchar(100) DEFAULT NULL,
  `Last_Name` varchar(100) NOT NULL,
  PRIMARY KEY (`Alumni_Key`),
  UNIQUE KEY `tbl_unique` (`Batch_Key`,`First_Name`,`Middle_Name`,`Last_Name`)
) ENGINE=MyISAM AUTO_INCREMENT=204 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni`
--

LOCK TABLES `alumni` WRITE;
/*!40000 ALTER TABLE `alumni` DISABLE KEYS */;
INSERT INTO `alumni` VALUES (1,1,'JASON','','BALDESCO'),(2,1,'JONALYN','','LAMOSTE'),(3,1,'AILYN','','MAHINAY'),(4,1,'BELLE SHAIRA','','MASIBAY'),(5,1,'MELANIE','','RIVERO'),(6,2,'GEDYM MAE','','SAB'),(7,2,'RIZA','','SALVA'),(8,2,'JEAN','','VILLALON'),(9,2,'OLIVER','','JIMENEZ'),(10,2,'CARLO','','MOSQUISA'),(11,3,'CATALINO','','PONGASE JR.'),(12,3,'SHIELA MAE','','CALAMBA'),(13,3,'PAMELA MAE','','DAYO'),(14,3,'CHERRY MAE','','GARSUTA'),(15,3,'LEA JOY','','KARAAN'),(16,4,'FERMO JR','','ASUFRA'),(17,4,'ROLLY','','DUMADAG'),(18,4,'ENRIE JOHN','','EDEM'),(19,4,'RUPERTO II','','GARCINES'),(20,4,'NICO','','GURREA'),(21,4,'JHON KEVIN','','IBARRA'),(22,4,'JAY NIÃ‘O','','LAMOSTE'),(23,4,'GIOVANNI','','LARGO'),(24,4,'DENNIS','','LEGASPI'),(25,4,'HERBERT','','MAGLAJOS'),(26,4,'NEIL ABBIE','','MALINAO'),(27,4,'BENZENE','','BANATE'),(28,4,'JOHN LOU','','ONOD'),(29,4,'JOSEPH','','PEQUIT'),(30,4,'REYGIE','','PONOLLERA'),(31,4,'BRIAN BRANDO','','RACHO'),(32,4,'JON ALBERT','','SILAGAN'),(33,4,'BERN ANGELO','','TEMPLA'),(34,4,'JENILYN','','ALO'),(35,4,'CLAUDIA MAE','','AÃ‘ORA'),(36,4,'CRISTINE','','ARANCON'),(37,4,'RHEALYN B.','','ASUFRA'),(38,4,'REXALDIE','','BATINGAL'),(39,4,'KHEYCIE','','BANAL'),(40,4,'SHIRLY','','BANDOY'),(41,4,'MITCHELLE ANN','','BATUCAN'),(42,5,'ZORAIDA','','BOYOSE'),(43,5,'GENIRA','','CABAHUG'),(44,5,'LILIMAE','','CABASAN'),(45,5,'TRINITY ROSE','','CABIG'),(46,5,'VIRGIE','','CAMANZO'),(47,5,'MARY JANE','','CASANOVA'),(48,5,'JESSICA','','COMIGHOD'),(49,5,'FRANKLIN JOSEPH','','BOOC'),(50,5,'STEPHANIE','','DANGHIL'),(51,5,'JESSA','','DAWANG'),(52,5,'CRISSIA MAE','','DECENILLA'),(53,5,'MARICEL','','DUPIT'),(54,5,'LINIE','','FRANCISCO'),(55,5,'RICHEL','','FUDERANAN'),(56,5,'MARIEL','','GAMBA'),(57,5,'GENELYN','','GINGO'),(58,5,'HIDIE','','GULLEM'),(59,5,'GINA MAE','','HERNANDO'),(60,5,'FLORENCE JERADE','','BUCA'),(61,5,'SOFIA MAE','','HUMOC'),(62,5,'MA CARMENA','','IBARRA'),(63,5,'VERONICA','','ILANDAG'),(64,5,'ABEGAEL MAE','','IPONG'),(65,5,'MAE','','LABIS'),(66,5,'KIMBERLY ANN','','LABOR'),(67,5,'JUDITH','','LAGUNA'),(68,6,'ANGELIE','','LAMBAN'),(69,6,'IVY','','LIBAS'),(70,6,'LOVE LEA','','LIBOT'),(71,6,'JAKE VINCENT','','BUCA'),(72,6,'CHARITY ANN','','LOON'),(73,6,'HAZEL MAE','','LOPENA'),(74,6,'JESSEL','','MANCHA'),(75,6,'MA LORAINE','','NAMOCO'),(76,6,'ARGELYN','','OCAY'),(77,6,'DENIE JANE','','OCAY'),(78,6,'EMILY','','PAJO'),(79,6,'ARCELIE','','PATAC'),(80,6,'MARY JEAN','','PAURNIA'),(81,6,'ANTHONETH ROSE','','RACHO'),(82,6,'JUNAIRE EDRIS','','BUICO'),(83,6,'ANALIZA','','RASONABLE'),(84,6,'LOIDA','','SALANG'),(85,6,'RUBELYN','','SUPERA'),(86,6,'JESSA MAE','','TAMPARONG'),(87,6,'MAE VIL','','TANJAY'),(88,6,'LESLIE','','TEREC'),(89,6,'ROSE ANN','','TOLANG'),(90,6,'ANNALOU','','TOMBIGA'),(91,6,'ABEGAILE JANE','','YBAÃ‘EZ'),(92,6,'JHUN JERUM','','CEPE'),(93,6,'EUGENIO JR.','','COMIDOY'),(94,7,'ALTHER ALLID','','ABANTE'),(95,7,'JUN MICHEL','','BAUTISTA'),(96,7,'ARIEL','','BLANCO'),(97,7,'PHILIP ANTHONY','','BOYONAS'),(98,7,'RICKY','','CABILLANES'),(99,7,'RYAN','','CABULAO'),(100,7,'RICHARD','','CALOPE'),(101,7,'JAMES LIE','','CANO'),(102,7,'JONNARD','','CASUSULA'),(103,7,'ANGELITO','','CENTILLAS'),(104,7,'NIEL MARK','','DOGOY'),(105,7,'JOEY','','ADLAON'),(106,7,'MELMAR','','GONZAGA'),(107,7,'ALDIN','','GUHAYON'),(108,7,'KEVIN LESLEY','','HINAUTAN'),(109,7,'RUBIN','','HOROHORO'),(110,7,'JUSTIN JAY','','IGNACIO'),(111,8,'JESSREL','','JAMILO'),(112,8,'JAMES RYAN','','LANGAMEN'),(113,8,'JESSIE ROY','','LAO-AY'),(114,8,'EMELIO','','LEPARTO JR.'),(115,8,'VINCENT VICTOR','','MAGADAN'),(116,8,'JOSEPH','','ALCALA'),(117,8,'MARC FRANCIZ','','MANIWANG'),(118,8,'RICOL','','MELLINO'),(119,8,'MARVIN','','MERANO'),(120,8,'VALERIANO JR.','','MERANO'),(121,8,'ANGELO','','MULIT'),(122,8,'MIKO','','MUÃ‘EZ'),(123,8,'JEFFERSONN','','NAVARRO'),(124,8,'JOHN LEE','','OMBAY'),(125,8,'RUTHEL LLOYD','','ORAPA'),(126,8,'LOUIE NIEL','','PACOT'),(127,8,'DANIEL FRIEDERICK','','ALONZO'),(128,9,'CAMELITO','','PAG-ONG'),(129,9,'BONIFACIO III','','SALANG'),(130,9,'FRANCIS PAUL','','SILAGAN'),(131,9,'JOMAR','','SUMABONG'),(132,9,'JULIUS JR','','TACULOD'),(133,9,'REY MARK','','TONGCO'),(134,9,'VINCENT JOHN','','TRAGO'),(135,9,'JAYSON','','VERTUDAZO'),(136,9,'JENICELLE','','DANO'),(137,9,'SWEET ROSE','','DOGOY'),(138,9,'DOMINIC','','AMBAN'),(139,9,'JACKELYN','','MIRANDA'),(140,9,'MATT  LAURENCE','','ARMEAN'),(141,9,'GIM BERT','','ARONG'),(142,9,'ZENO','','BALICOG'),(143,9,'MELVIN','','BANOL'),(144,10,'MARK LLOYD','','ALMONTE'),(145,10,'JAYSON','','MELLIJOR'),(146,10,'DARWIN','','PAINIT'),(147,10,'FRANK JULIUS','','RACHO'),(148,10,'JONEL','','RAÃ‘ISES'),(149,10,'BRIAN VINCENT','','TINAJA'),(150,10,'MARK JOVEN','','UY'),(151,10,'CYNDIE GRACE','','ALE'),(152,10,'CHARLENE JOY','','AMIT'),(153,10,'MIRAFLOR','','ANDOY'),(154,10,'ANALYN','','ANDRADE'),(155,10,'JENNIFER','','APARICIO'),(156,10,'MONIQUE ROICE','','ANTIPOLO'),(157,10,'MA. RUBELYN','','BALLESTER'),(158,10,'ROCIL','','BATINGAL'),(159,10,'JENIFER','','BAYUD'),(160,10,'ANNABELLE','','BELOY'),(161,10,'ROSEMARIE','','BERONG'),(162,10,'JESSA MAE','','CAGABCAB'),(163,10,'CRISTEL','','CANO'),(164,11,'LANELYN','','CELOCIA'),(165,11,'VALERIE','','DE CASTRO'),(166,11,'HARLEE SON','','BALDUMAN'),(167,11,'MARIFE','','GOHOL'),(168,11,'LADY JANE','','HALAWIG'),(169,11,'MICHELLE','','LACEA'),(170,11,'JESSA','','LANSANG'),(171,11,'CHARMAINE','','LIHAT'),(172,11,'ROTCHEL','','MADERA'),(173,11,'JESSA GRACE','','MAGLAJOS'),(174,11,'GLYDEL','','MALBASIAS'),(175,11,'MEKAILA ANGELA','','MARANIA'),(176,11,'REYNA','','MARZON'),(177,11,'MARK VIRGEL','','DAOHOG'),(178,11,'MELAROSE','','MERANO'),(179,11,'KIMBERLY ANN','','OCOY'),(180,11,'RENA','','ORAÃ‘O'),(181,11,'MARLYN','','PAINIT'),(182,11,'RUVY MAE','','PALMA'),(183,11,'ANA MARIE','','PANGANORON'),(184,12,'AVIE','','PAÃ‘AMOGAN'),(185,12,'MA CHARLINE','','POJADAS'),(186,12,'DANNIELLE FAYE','','PONOLLERA'),(187,12,'JOVELYN','','PORLAJE'),(188,12,'TEOTIMO JR.','','GINGO'),(189,12,'JECELYN','','ROBANTE'),(190,12,'CARYL KEITH','','SAB'),(191,12,'MA FATIMA','','SABOTE'),(192,12,'JONAME','','SERNOS'),(193,12,'SHELLA MAE','','SUCOBOS'),(194,12,'ROSEFIN','','TAYROS'),(195,12,'ROWENA','','TAYROS'),(196,12,'MYLA','','TOLEDO'),(197,12,'MICHELL','','VALORIA'),(198,12,'JOSEPHINE','','VIBO'),(199,12,'NIÃ‘O','','HINAY'),(200,12,'EURICA','','VILLENA'),(201,12,'DENNIS','','LACEA'),(202,12,'MARVIN','','MACARAYO'),(203,12,'RJ','','MEJIA');
/*!40000 ALTER TABLE `alumni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumni_alerts`
--

DROP TABLE IF EXISTS `alumni_alerts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumni_alerts` (
  `Alumni_Alert_Key` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Alumni_Key` int(10) unsigned DEFAULT NULL,
  `Annoucement_Key` int(10) unsigned DEFAULT NULL,
  `Is_Read` int(1) NOT NULL,
  PRIMARY KEY (`Alumni_Alert_Key`),
  UNIQUE KEY `tbl_unique` (`Alumni_Key`,`Annoucement_Key`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni_alerts`
--

LOCK TABLES `alumni_alerts` WRITE;
/*!40000 ALTER TABLE `alumni_alerts` DISABLE KEYS */;
INSERT INTO `alumni_alerts` VALUES (1,15,1,1),(2,14,1,1),(3,15,2,1),(4,14,2,1),(5,15,3,1),(6,14,3,1),(7,15,4,1),(8,14,4,1),(9,15,5,1),(10,14,5,0);
/*!40000 ALTER TABLE `alumni_alerts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alumni_profiles`
--

DROP TABLE IF EXISTS `alumni_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alumni_profiles` (
  `Alumni_Profile_Key` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Alumni_Key` int(10) unsigned DEFAULT NULL,
  `Profile1` longtext NOT NULL,
  `Profile2` longtext NOT NULL,
  `Profile3` longtext NOT NULL,
  `Employment_Status` varchar(30) NOT NULL DEFAULT '',
  `Company_Name` varchar(255) NOT NULL DEFAULT '',
  `Supporting_Doc` varchar(255) NOT NULL DEFAULT '',
  `Position` varchar(100) NOT NULL DEFAULT '',
  `Awards_Received` varchar(255) NOT NULL DEFAULT '',
  `Hired_2Years_After_Grad` int(1) NOT NULL DEFAULT '0',
  `Date_Updated` int(10) NOT NULL,
  PRIMARY KEY (`Alumni_Profile_Key`),
  UNIQUE KEY `tbl_unique` (`Alumni_Key`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alumni_profiles`
--

LOCK TABLES `alumni_profiles` WRITE;
/*!40000 ALTER TABLE `alumni_profiles` DISABLE KEYS */;
INSERT INTO `alumni_profiles` VALUES (1,15,'{\"FIRST_NAME\":\"LEA JOY\",\"MIDDLE_NAME\":\"Middle Name\",\"LAST_NAME\":\"KARAAN\",\"PERMANENT_ADDRESS\":\"Magsija, Balilihan, Bohol\",\"EMAIL\":\"leajoy.karaan@gmail.com\",\"PHONE\":\"411-123456-000\",\"MOBILE\":\"0919-1234567890\",\"CIVIL_STATUS\":\"1\",\"SEX\":\"1\",\"BIRTHDAY\":\"2000-02-01\",\"ANNUAL_INCOME\":\"Php 1,500,000\"}','{\"EXAM_PASSED\":[\"Licensure Examination for Teacher\",\"Exam Name 1\",\"Exam Name 2\",\"\"],\"EXAM_DATE_TAKEN\":[\"May 2020\",\"Exam Date 1\",\"Exam Date 2\",\"\"],\"EXAM_RATING\":[\"80.5\",\"Rating 1\",\"Rating 2\",\"\"],\"ADVANCE_STUDY_PASSED\":[\"Masters 1\",\"Masters 2\",\"Masters 3\",\"\"],\"ADVANCE_STUDY_DURATION\":[\"Masters Date 1\",\"Masters Date 2\",\"Masters Date 3\",\"\"],\"ADVANCE_STUDY_PLACE\":[\"University 1\",\"University 2\",\"University 3\",\"\"],\"PURSUE_ADVANCE_STUDIES\":\"others\",\"PURSUE_ADVANCE_STUDIES_OTHERS\":\" passion to learn\"}','{\"EMPLOYMENT_STATUS\":\"self_employed\",\"JOB_EXPERIENCES\":\"never_employed\",\"NEVER_EMPLOYED\":\"lack_professional\",\"NEVER_EMPLOYED_OTHERS\":\"sdafsadf\",\"LOCAL_ABROAD\":\"abroad\",\"NAME_COMPANY\":\"Abroad company\",\"ADDRESS_COMPANY\":\"Company Address\",\"CONTACT_COMPANY\":\"dsfsdaf\",\"LINE_BUSINESS\":\"dsafsf\",\"POSITION\":\"sdfsadf\",\"WORK_ALIGNED\":\"yes\",\"STATUS_FIRST_JOB\":\"regular_permanent\",\"STATUS_CURRENT_JOB\":\"casual\",\"LEVEL_FIRST_JOB\":\"self_employed\",\"SELF_EMPLOYED_LINE\":\"sdfsadf\",\"FIND_FIRST\":\"others\",\"FIND_FIRST_OTHERS\":\"sdafsdaf\",\"FIRST_JOB_AFTER_GRAD\":\"2_3years\",\"FIRST_JOB_AFTER_GRAD_OTHERS\":\"sdfsadfs\",\"FIRST_JOB_FACTORS\":\"others\",\"FIRST_JOB_FACTORS_OTHERS\":\"sdfsadfs\",\"CHALLENGES\":\"others\",\"CHALLENGES_OTHERS\":\"sdfsadfs\",\"AWARDS\":\"yes\",\"LEVEL_AWARD\":\"others\",\"LEVEL_AWARD_OTHERS\":\"Testing\",\"SUPPORTING_DOCUMENT\":\"company id\",\"AWARD_DOC\":\"Certificate\"}','self_employed','Abroad company','company id','sdfsadf','Certificate',1,1677087522),(2,14,'','','{\"EMPLOYMENT_STATUS\":\"self_employed\",\"JOB_EXPERIENCES\":\"single_multiple\",\"FIRST_JOB_AFTER_GRAD\":\"1_2years\",\"LOCAL_ABROAD\":\"local\",\"NAME_COMPANY\":\"BISU Balilihan Campus\",\"ADDRESS_COMPANY\":\"Balilihan, Bohol\",\"CONTACT_COMPANY\":\"123456789\",\"SUPPORTING_DOCUMENT\":\"CoE\",\"FIND_FIRST\":\"advertisement\",\"AWARDS\":\"yes\",\"LEVEL_AWARD\":\"international\",\"AWARD_DOC\":\"Plaque\"}','self_employed','BISU Balilihan Campus','CoE','','international',1,1677033449);
/*!40000 ALTER TABLE `alumni_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `announcements`
--

DROP TABLE IF EXISTS `announcements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `announcements` (
  `Annoucement_Key` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Time_Stamp` int(10) NOT NULL,
  `Announcement_Code` char(32) NOT NULL,
  `Announcement` text NOT NULL,
  PRIMARY KEY (`Annoucement_Key`),
  UNIQUE KEY `tbl_unique` (`Announcement_Code`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `announcements`
--

LOCK TABLES `announcements` WRITE;
/*!40000 ALTER TABLE `announcements` DISABLE KEYS */;
INSERT INTO `announcements` VALUES (1,1676576859,'3c8bd135df41fa8e372fb8dd8a5eb8f7','This is an announcement to all alumni.'),(2,1676576899,'dce09456a54b0e0a7de4164bc0b36ff7','testing only'),(3,1676576909,'120ea8a25e5d487bf68b5f7096440019','This is a test.'),(4,1676580383,'679eab6e6e5c43e9eb71781be324b06a','Sample announcement'),(5,1677031415,'76a26fb120b6bc184a9b4f104c341d69','New announcement Feb 2023');
/*!40000 ALTER TABLE `announcements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `batches`
--

DROP TABLE IF EXISTS `batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batches` (
  `Batch_Key` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Course_Key` int(10) unsigned NOT NULL,
  `Batch` char(15) NOT NULL,
  PRIMARY KEY (`Batch_Key`),
  UNIQUE KEY `tbl_unique` (`Batch`,`Course_Key`),
  KEY `tbl_index1` (`Course_Key`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batches`
--

LOCK TABLES `batches` WRITE;
/*!40000 ALTER TABLE `batches` DISABLE KEYS */;
INSERT INTO `batches` VALUES (1,2,'2018-2019'),(2,2,'2019-2020'),(3,2,'2020-2021'),(4,1,'2018-2019'),(5,1,'2019-2020'),(6,1,'2020-2021'),(7,4,'2018-2019'),(8,4,'2019-2020'),(9,4,'2020-2021'),(10,5,'2018-2019'),(11,5,'2019-2020'),(12,5,'2020-2021');
/*!40000 ALTER TABLE `batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `Course_Key` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Course_Code` char(15) NOT NULL,
  `Course_Name` char(255) NOT NULL,
  `Department` char(10) NOT NULL,
  PRIMARY KEY (`Course_Key`),
  UNIQUE KEY `tbl_unique` (`Course_Code`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'BSIT','BS in Information Technology','ICT'),(2,'BSCS','BS in Computer Science','ICT'),(3,'BS-ELEX','BS in Electronics Technology','ITD'),(4,'BS-ELEC','BS in Electronics Technology','ITD'),(5,'BSIT-FPSM','BSIT major in Food Preparation Service Management','ITD');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `User_Key` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Alumni_Key` int(10) unsigned DEFAULT NULL,
  `Email` char(100) NOT NULL,
  `Pass_Word` char(32) NOT NULL,
  `Date_Registered` int(10) NOT NULL,
  PRIMARY KEY (`User_Key`),
  UNIQUE KEY `tbl_unique` (`Alumni_Key`),
  KEY `tbl_index1` (`Email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,15,'leajoy.karaan@gmail.com','190f59a61c072f4877cf35e32d3f5fe9',1676546903),(2,14,'cherrymae.garsuta@gmail.com','752c476b8c86a6176e3482ca9b206f80',1676546987);
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

-- Dump completed on 2023-02-27 21:38:07
