-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: laratest
-- ------------------------------------------------------
-- Server version	5.6.34-log

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
-- Table structure for table `education`
--

DROP TABLE IF EXISTS `education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `education` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_PROFILE_ID` int(11) DEFAULT NULL,
  `INSTITUTION` text,
  `LEVEL` text,
  `DEGREE` text,
  PRIMARY KEY (`ID`),
  KEY `USER_PROFILE_ID` (`USER_PROFILE_ID`),
  CONSTRAINT `education_ibfk_1` FOREIGN KEY (`USER_PROFILE_ID`) REFERENCES `user_profiles` (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `education`
--

LOCK TABLES `education` WRITE;
/*!40000 ALTER TABLE `education` DISABLE KEYS */;
INSERT INTO `education` VALUES (1,1001,'Grand Canyon University','Bachelor of Science','Computer Programming'),(2,1001,'Highline College','Associates of Arts','General');
/*!40000 ALTER TABLE `education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `employment_history`
--

DROP TABLE IF EXISTS `employment_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `employment_history` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_PROFILE_ID` int(11) DEFAULT NULL,
  `EMPLOYER` text,
  `POSITION` text,
  `DURATION` text,
  PRIMARY KEY (`ID`),
  KEY `USER_PROFILE_ID` (`USER_PROFILE_ID`),
  CONSTRAINT `employment_history_ibfk_1` FOREIGN KEY (`USER_PROFILE_ID`) REFERENCES `user_profiles` (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `employment_history`
--

LOCK TABLES `employment_history` WRITE;
/*!40000 ALTER TABLE `employment_history` DISABLE KEYS */;
INSERT INTO `employment_history` VALUES (1,1001,'Grand Canyon University','Student Worker','2017 - Present');
/*!40000 ALTER TABLE `employment_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(50) DEFAULT NULL,
  `SUMMARY` varchar(255) DEFAULT NULL,
  `DESCRIPTION` text,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `TITLE` (`TITLE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'test 1','A first test','This is a test group for testing the join statements.'),(2,'test 2','a second test','this is another test group for testing the join statements');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(255) NOT NULL,
  `AUTHOR` varchar(255) NOT NULL,
  `LOCATION` varchar(255) NOT NULL,
  `DESCRIPTION` text,
  `REQUIREMENTS` text,
  `SALARY` double DEFAULT NULL,
  `CREATE_DATE` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (1,'1001','A good job','clow2@my.gcu.edu','The drive way','We need someone to wash a car... son.',0,'2018-03-04 21:21:15'),(2,'Newest','clow2@my.gcu.edu','Here','Now, stand tall','Never back down',5,'2018-03-04 21:43:01');
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `join_user_group`
--

DROP TABLE IF EXISTS `join_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `join_user_group` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) DEFAULT NULL,
  `GROUP_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `USER_ID` (`USER_ID`),
  KEY `GROUP_ID` (`GROUP_ID`),
  CONSTRAINT `join_user_group_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`ID`),
  CONSTRAINT `join_user_group_ibfk_2` FOREIGN KEY (`GROUP_ID`) REFERENCES `groups` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `join_user_group`
--

LOCK TABLES `join_user_group` WRITE;
/*!40000 ALTER TABLE `join_user_group` DISABLE KEYS */;
INSERT INTO `join_user_group` VALUES (10,1001,2);
/*!40000 ALTER TABLE `join_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skills` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_PROFILE_ID` int(11) NOT NULL,
  `TITLE` varchar(100) NOT NULL,
  `DESCRIPTION` text,
  PRIMARY KEY (`ID`),
  KEY `USER_PROFILE_ID` (`USER_PROFILE_ID`),
  CONSTRAINT `skills_ibfk_1` FOREIGN KEY (`USER_PROFILE_ID`) REFERENCES `user_profiles` (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES (1,1001,'Programming','Known languages: C#, PHP, JAVA, JavaScript, C++, SQL');
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suspended_users`
--

DROP TABLE IF EXISTS `suspended_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `suspended_users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) DEFAULT NULL,
  `DURATION` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `USER_ID` (`USER_ID`),
  CONSTRAINT `suspended_users_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suspended_users`
--

LOCK TABLES `suspended_users` WRITE;
/*!40000 ALTER TABLE `suspended_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `suspended_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profiles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_ID` int(11) NOT NULL,
  `BIO` varchar(10000) DEFAULT NULL,
  `IMGURL` varchar(500) DEFAULT NULL,
  `LOCATION` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `USER_ID` (`USER_ID`),
  CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profiles`
--

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
INSERT INTO `user_profiles` VALUES (1,1001,'Developer at Larabar.',NULL,'Grand Canyon University in Phoenix, AZ'),(2,1002,'',NULL,'');
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `FIRSTNAME` varchar(255) DEFAULT NULL,
  `LASTNAME` varchar(255) DEFAULT NULL,
  `ADMIN` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `EMAIL` (`EMAIL`)
) ENGINE=InnoDB AUTO_INCREMENT=1003 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1001,'clow2@my.gcu.edu','1001','Connor','Low',1),(1002,'connorjameslow@gmail.com','cocacoco','Connor','Low',0);
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

-- Dump completed on 2018-03-04 22:05:39
