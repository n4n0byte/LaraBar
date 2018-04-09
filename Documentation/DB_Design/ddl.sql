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
INSERT INTO `education` VALUES (1,1001,'Grand Canyon University','Bachelor of Science','Computer Programming'),(2,1001,'Highline College','Associates of Arts','General'),(3,1005,'Trump University','Noodles','Not');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'TEST 1','A first test','This is a test group for testing the join statements.'),(2,'test 2','a second test','this is another test group for testing the join statements'),(3,'Larabar Team','Creators of Larabar.','The team who created Larabar. Join the clan.');
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
  PRIMARY KEY (`ID`),
  KEY `TITLE_INDEX` (`TITLE`),
  KEY `AUTHOR_INDEX` (`AUTHOR`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (2,'Newest','clow2@my.gcu.edu','Here','Now, stand tall','Never back down',5,'2018-03-04 21:43:01'),(3,'1001','Code Debugger','clow2@my.gcu.edu','Grand Canyon University in Phoenix, AZ','We need someone to fix all our problems.',0,'2018-03-04 22:24:48'),(4,'Community Outreach Specialist','Gabtune','','e-enable mission-critical networks','Robust composite data-warehouse',77475,'2017-08-20 01:14:06'),(6,'Senior Developer','Fivebridge','','integrate cross-platform channels','Self-enabling multi-tasking forecast',39919,'2017-08-19 04:38:48'),(7,'Teacher','Myworks','','expedite killer networks','Configurable 24/7 implementation',14411,'2017-01-06 17:31:55'),(8,'Web Designer III','Zoomcast','','orchestrate rich models','Cloned needs-based conglomeration',24298,'2017-04-17 08:27:18'),(9,'Design Engineer','Gigabox','','benchmark leading-edge applications','Integrated impactful function',80202,'2017-09-05 15:48:10'),(10,'Compute person','clow2@my.gcu.edu','Canada','unleash rich supply-chains','Open-architected value-added synergy',17837,'2018-01-11 21:41:23'),(11,'Design Engineer','Wikizz','','enable back-end web services','Grass-roots demand-driven core',36371,'2017-02-26 09:04:19'),(12,'Registered Nurse','Aimbo','','leverage cutting-edge e-tailers','Multi-tiered homogeneous concept',41294,'2017-09-05 09:47:16'),(13,'Media Manager III','Feedfire','','facilitate visionary users','Networked background artificial intelligence',24611,'2017-02-18 00:31:01'),(14,'VP Quality Control','Dabjam','','integrate next-generation paradigms','Mandatory hybrid alliance',64264,'2017-07-01 06:46:48'),(15,'Administrative Assistant III','Gigazoom','','brand clicks-and-mortar metrics','Balanced demand-driven extranet',48974,'2017-07-22 12:12:31'),(16,'Nurse Practicioner','Reallinks','','whiteboard one-to-one vortals','Managed holistic policy',88678,'2017-07-01 14:36:54'),(17,'Physical Therapy Assistant','Zoomcast','','recontextualize interactive platforms','Centralized discrete budgetary management',18638,'2017-07-08 11:52:40'),(18,'Cost Accountant','Jayo','','transform B2C synergies','Switchable web-enabled throughput',54241,'2017-09-04 11:45:26'),(19,'Recruiter','Linktype','','expedite best-of-breed initiatives','Expanded real-time archive',99138,'2017-03-18 05:10:00'),(20,'Administrative Officer','Lazz','','matrix distributed paradigms','Decentralized logistical website',52360,'2017-06-22 01:13:04'),(21,'Desktop Support Technician','Abatz','','synergize web-enabled e-tailers','User-friendly mobile info-mediaries',15827,'2017-08-15 23:45:09'),(22,'Research Nurse','Flipopia','','orchestrate clicks-and-mortar partnerships','Polarised eco-centric matrices',83109,'2018-02-09 21:32:31'),(23,'VP Accounting','Aivee','','orchestrate bleeding-edge users','Pre-emptive even-keeled info-mediaries',44284,'2017-02-06 04:28:35'),(24,'Senior Financial Analyst','Yozio','','facilitate viral interfaces','Devolved bi-directional hub',60572,'2017-09-26 00:51:02'),(25,'Director of Sales','Buzzster','','transition ubiquitous channels','Re-engineered analyzing solution',38796,'2017-07-31 06:38:44'),(26,'Mechanical Systems Engineer','Eamia','','embrace viral synergies','Versatile 24 hour parallelism',12108,'2017-10-08 20:54:31'),(27,'Nuclear Power Engineer','Quimba','','visualize value-added users','Automated incremental synergy',30990,'2017-04-03 15:09:33'),(28,'Structural Analysis Engineer','Mynte','','visualize end-to-end communities','Adaptive holistic middleware',86559,'2017-10-17 02:35:04'),(29,'Recruiting Manager','Riffwire','','drive cutting-edge action-items','Self-enabling demand-driven info-mediaries',84391,'2017-04-01 20:55:29'),(30,'Paralegal','Linktype','','implement best-of-breed mindshare','Distributed contextually-based application',56616,'2017-01-12 19:51:25'),(31,'Media Manager III','Snaptags','','seize B2C communities','Exclusive zero defect parallelism',84387,'2017-02-24 21:08:21'),(32,'Food Chemist','Yodoo','','morph end-to-end e-tailers','Grass-roots grid-enabled application',21127,'2017-06-10 08:54:30'),(33,'Teacher','Vimbo','','enhance extensible metrics','Persistent modular parallelism',71348,'2017-11-29 01:55:13'),(34,'Senior Sales Associate','Mydo','','revolutionize killer vortals','User-friendly next generation toolset',93370,'2017-06-12 02:04:59'),(35,'Technical Writer','Skilith','','matrix enterprise infomediaries','Configurable multimedia knowledge base',50186,'2017-07-02 10:14:41'),(36,'Actuary','Yotz','','morph back-end infomediaries','Persevering empowering system engine',78781,'2017-05-31 16:46:28'),(37,'Web Developer I','Agivu','','disintermediate clicks-and-mortar experiences','Open-architected responsive monitoring',44043,'2017-08-22 21:06:57'),(38,'Senior Financial Analyst','Vipe','','generate frictionless eyeballs','User-centric discrete encoding',61830,'2017-12-07 12:54:23'),(39,'Software Engineer III','Fivechat','','innovate killer platforms','Open-source encompassing focus group',98906,'2017-05-24 04:16:46'),(40,'Teacher','Voolia','','evolve cross-platform metrics','Synergistic local budgetary management',30525,'2017-11-14 16:29:26'),(41,'General Manager','Babblestorm','','engage proactive portals','Robust 3rd generation standardization',49528,'2017-04-08 22:06:16'),(42,'Administrative Assistant I','Eazzy','','optimize global deliverables','Intuitive well-modulated encryption',55589,'2018-01-06 06:02:37'),(43,'Operator','Babbleblab','','deploy viral e-markets','Reduced holistic contingency',57951,'2017-09-18 15:11:02'),(44,'Community Outreach Specialist','Edgeblab','','synergize dot-com e-tailers','Digitized bottom-line neural-net',92273,'2017-08-13 18:22:48'),(45,'Project Manager','Jabbertype','','enhance front-end content','Progressive client-driven contingency',57229,'2017-12-12 21:03:16'),(46,'Help Desk Technician','Voonder','','implement vertical communities','Profit-focused motivating conglomeration',54354,'2017-01-22 14:00:22'),(47,'Mechanical Systems Engineer','Leenti','','exploit clicks-and-mortar functionalities','Universal foreground architecture',24390,'2017-01-15 20:17:56'),(48,'Structural Engineer','Ooba','','deliver best-of-breed models','Customizable modular strategy',81342,'2018-03-15 12:41:12'),(49,'Accounting Assistant I','Feedbug','','transition intuitive relationships','Innovative neutral matrices',30840,'2017-09-16 08:11:59'),(50,'Financial Advisor','Meejo','','engage impactful convergence','Synergistic radical concept',14212,'2017-05-26 22:36:19'),(51,'Accounting Assistant IV','Demizz','','exploit sticky content','Future-proofed disintermediate definition',76506,'2017-08-23 11:02:01'),(52,'Computer Systems Analyst I','Jaxbean','','e-enable ubiquitous technologies','Future-proofed full-range matrices',31292,'2018-01-15 16:42:08'),(53,'GIS Technical Architect','Fivespan','','incubate ubiquitous portals','Public-key zero defect customer loyalty',99483,'2017-09-11 02:37:24'),(54,'Recruiter','Thoughtbeat','','whiteboard cutting-edge technologies','Secured tertiary architecture',29233,'2018-01-07 12:31:18'),(55,'Social Worker','LiveZ','','repurpose efficient solutions','Public-key logistical website',53551,'2018-01-03 22:09:04'),(56,'Community Outreach Specialist','Yabox','','incentivize back-end architectures','Fundamental 24/7 artificial intelligence',36394,'2017-05-03 10:41:04'),(57,'Account Coordinator','Skyba','','seize compelling models','Organized multi-state concept',21939,'2017-08-27 10:57:12'),(58,'VP Product Management','Kazio','','maximize robust architectures','Reactive zero defect process improvement',53298,'2017-04-24 23:37:34'),(59,'Administrative Officer','Linkbuzz','','morph magnetic web services','Expanded 4th generation customer loyalty',95383,'2017-07-10 01:02:54'),(60,'Web Developer II','Youfeed','','architect value-added convergence','Multi-channelled human-resource array',89514,'2018-02-10 07:17:45'),(61,'Senior Developer','Zoonder','','harness visionary technologies','Robust neutral neural-net',51450,'2017-11-23 14:39:25'),(62,'Biostatistician II','Avavee','','optimize impactful solutions','Extended radical capability',58300,'2017-04-13 15:52:30'),(63,'Senior Editor','Innojam','','scale proactive partnerships','Face to face holistic challenge',99292,'2017-11-25 13:34:33'),(64,'Account Coordinator','Devify','','deploy distributed mindshare','Progressive asynchronous task-force',15995,'2018-02-22 21:04:51'),(65,'Engineer II','Jaxnation','','e-enable impactful infrastructures','User-friendly intermediate architecture',50753,'2018-01-26 04:02:14'),(66,'Food Chemist','Ozu','','incentivize dot-com e-commerce','Customer-focused coherent interface',27623,'2017-05-30 17:07:19'),(67,'Research Nurse','Flashpoint','','leverage customized infrastructures','Cross-platform foreground hierarchy',30214,'2017-01-27 20:51:29'),(68,'Editor','Quinu','','exploit robust supply-chains','Multi-lateral stable solution',59313,'2017-06-15 08:17:13'),(69,'Graphic Designer','Aimbu','','whiteboard wireless web services','Grass-roots 24/7 task-force',26317,'2018-01-21 11:09:09'),(70,'Project Manager','Kwinu','','engage proactive mindshare','Organized context-sensitive core',71569,'2017-03-11 17:54:35'),(71,'Project Manager','BlogXS','','reinvent ubiquitous metrics','Multi-tiered object-oriented extranet',74785,'2018-03-04 19:33:00'),(72,'Senior Quality Engineer','Aimbo','','transition clicks-and-mortar e-markets','Optimized logistical utilisation',71788,'2017-03-03 15:43:15'),(73,'Web Designer IV','Rhybox','','streamline innovative experiences','Customer-focused mobile methodology',81361,'2017-06-11 19:06:13'),(74,'Help Desk Technician','Yadel','','engage virtual initiatives','Function-based coherent access',91021,'2017-07-04 03:43:02'),(75,'Environmental Tech','Flashspan','','expedite extensible functionalities','Monitored analyzing application',33983,'2017-05-26 16:12:46'),(76,'Actuary','Jaxspan','','morph sexy methodologies','Re-engineered non-volatile database',89566,'2017-06-28 17:25:03'),(77,'Help Desk Technician','Yakidoo','','iterate open-source paradigms','Inverse leading edge firmware',29102,'2017-09-18 19:21:39'),(78,'Sales Representative','Skyvu','','utilize rich e-business','Optional system-worthy product',99227,'2017-05-11 21:34:55'),(79,'Research Assistant IV','Yodoo','','deliver enterprise eyeballs','Proactive fresh-thinking throughput',94929,'2017-07-12 07:36:33'),(80,'Computer Systems Analyst II','Oodoo','','exploit synergistic networks','Cross-group secondary knowledge user',87326,'2017-04-12 03:33:43'),(81,'Software Test Engineer IV','Blogtag','','empower bleeding-edge schemas','Exclusive scalable help-desk',78384,'2017-04-29 06:40:21'),(82,'Quality Engineer','Zoomdog','','facilitate impactful niches','Profound systematic paradigm',57147,'2017-07-28 22:27:25'),(83,'Food Chemist','Realbuzz','','facilitate e-business vortals','Enterprise-wide maximized hierarchy',26996,'2018-03-10 03:07:27'),(84,'Community Outreach Specialist','Rooxo','','matrix leading-edge experiences','Focused grid-enabled Graphical User Interface',79785,'2018-03-04 12:34:57'),(85,'Payment Adjustment Coordinator','Thoughtblab','','synthesize extensible e-commerce','Realigned fault-tolerant analyzer',64022,'2018-03-12 11:15:19'),(86,'Senior Quality Engineer','Ntags','','engage extensible architectures','Inverse even-keeled flexibility',75679,'2017-02-25 02:23:07'),(87,'Senior Financial Analyst','Brightbean','','optimize magnetic communities','Optimized responsive hardware',24673,'2017-10-10 07:16:22'),(88,'Physical Therapy Assistant','Tambee','','iterate turn-key methodologies','Progressive impactful groupware',67636,'2018-01-23 03:06:21'),(89,'Programmer Analyst I','Demivee','','iterate interactive communities','Sharable system-worthy project',56414,'2017-05-03 05:09:25'),(90,'Assistant Manager','Rhyloo','','harness enterprise mindshare','Stand-alone motivating strategy',42750,'2017-06-29 12:55:54'),(91,'Editor','Eire','','drive vertical platforms','Cross-platform bottom-line challenge',78824,'2017-02-04 12:57:48'),(92,'Community Outreach Specialist','Babbleset','','monetize web-enabled architectures','Realigned context-sensitive methodology',18586,'2017-11-30 06:25:28'),(93,'Project Manager','Thoughtblab','','e-enable plug-and-play schemas','Adaptive secondary analyzer',13277,'2017-03-24 16:09:09'),(94,'Design Engineer','Brightdog','','utilize vertical ROI','Triple-buffered mobile help-desk',15862,'2017-07-24 02:46:45'),(95,'Pharmacist','Tazzy','','matrix 24/7 mindshare','Stand-alone attitude-oriented instruction set',52673,'2017-02-24 03:52:25'),(96,'Research Nurse','Skyble','','optimize cross-media action-items','Sharable real-time focus group',44138,'2017-10-11 17:59:19'),(97,'Systems Administrator IV','Nlounge','','extend integrated synergies','Phased demand-driven hardware',54970,'2018-03-02 08:37:17'),(98,'Human Resources Assistant II','Muxo','','empower distributed e-commerce','Switchable well-modulated moderator',52403,'2017-02-09 13:59:30'),(99,'Nuclear Power Engineer','Twimm','','mesh next-generation solutions','Expanded fresh-thinking methodology',25844,'2018-03-09 11:49:42'),(100,'Environmental Tech','Jaxspan','','engage impactful channels','Synchronised needs-based definition',87535,'2017-01-19 17:12:44'),(101,'Office Assistant II','Skilith','','e-enable open-source initiatives','Configurable client-driven functionalities',63964,'2017-07-29 07:05:52'),(102,'Graphic Designer','Jayo','','synergize impactful models','Centralized web-enabled challenge',61975,'2017-04-18 08:13:27'),(103,'Software Consultant','Browsedrive','','envisioneer wireless supply-chains','Multi-lateral directional access',73549,'2017-03-12 08:23:34'),(104,'Actuary','Snaptags','','reintermediate value-added content','Re-engineered optimal leverage',26092,'2017-11-06 21:38:11'),(105,'Web Designer IV','Photofeed','','grow innovative models','Intuitive heuristic utilisation',17497,'2017-05-31 22:51:01'),(106,'Electrical Engineer','Avavee','','envisioneer mission-critical solutions','Re-contextualized context-sensitive solution',74983,'2017-02-04 08:07:40'),(107,'VP Product Management','Omba','','deploy world-class web services','Devolved web-enabled archive',13385,'2017-08-31 08:37:08'),(108,'Paralegal','Jamia','','aggregate world-class applications','Stand-alone 6th generation functionalities',97145,'2018-01-17 15:38:42'),(109,'Programmer I','Devbug','','redefine extensible e-commerce','User-centric bottom-line artificial intelligence',86385,'2017-08-23 08:22:41'),(110,'Assistant Media Planner','Eidel','','seize compelling users','Multi-channelled static utilisation',27829,'2017-10-25 22:10:25'),(111,'Health Coach I','Kwilith','','synthesize impactful niches','Polarised disintermediate help-desk',52236,'2018-02-13 01:04:22'),(112,'Nurse','Rhyloo','','aggregate open-source experiences','Customizable intangible collaboration',61761,'2017-03-23 09:19:21'),(113,'Research Assistant III','Janyx','','grow scalable paradigms','Customizable intangible synergy',77320,'2017-07-05 07:55:59'),(114,'Web Developer I','Flashdog','','scale real-time markets','Upgradable eco-centric archive',46409,'2017-08-15 21:14:39'),(115,'Database Administrator IV','Quamba','','enhance innovative platforms','Object-based asymmetric portal',23558,'2018-01-01 18:23:10'),(116,'VP Quality Control','Flipbug','','synthesize viral metrics','Monitored user-facing implementation',54827,'2017-03-31 06:36:32'),(117,'VP Sales','Photofeed','','reintermediate world-class bandwidth','Customizable didactic conglomeration',32707,'2017-04-18 07:29:23'),(118,'Assistant Media Planner','Photolist','','incentivize extensible functionalities','Quality-focused dedicated analyzer',56140,'2017-08-25 06:55:18'),(119,'Senior Editor','Aimbu','','aggregate visionary deliverables','Multi-lateral background utilisation',89343,'2018-02-23 06:36:09'),(120,'Technical Writer','Skiba','','utilize transparent web services','Digitized systematic interface',62470,'2017-02-15 08:18:07'),(121,'Assistant Media Planner','Voomm','','enable dot-com initiatives','Integrated bandwidth-monitored conglomeration',35794,'2018-03-06 00:47:44'),(122,'Food Chemist','Pixope','','incubate cross-media technologies','Intuitive system-worthy protocol',78092,'2017-05-29 06:28:04'),(123,'Marketing Assistant','Skiptube','','exploit collaborative methodologies','Grass-roots contextually-based approach',65749,'2017-02-25 16:56:21'),(124,'Human Resources Assistant II','Trupe','','whiteboard end-to-end initiatives','Proactive leading edge portal',17051,'2017-09-09 04:25:49'),(125,'Junior Executive','Fanoodle','','utilize plug-and-play models','Synchronised 3rd generation encryption',52379,'2017-05-21 12:51:19'),(126,'Help Desk Technician','Lajo','','facilitate synergistic e-business','Operative secondary help-desk',13035,'2017-06-21 10:14:17'),(127,'Analog Circuit Design manager','Devify','','engineer revolutionary portals','Phased needs-based artificial intelligence',90672,'2017-01-05 05:27:40'),(128,'Clinical Specialist','Lazzy','','architect impactful mindshare','Advanced composite archive',16356,'2017-07-17 15:11:35'),(129,'Sales Representative','Tagchat','','exploit best-of-breed solutions','Self-enabling incremental infrastructure',38712,'2017-12-26 10:40:49'),(130,'Actuary','Skidoo','','engage proactive functionalities','Exclusive mobile contingency',40944,'2018-03-12 08:31:48'),(131,'Assistant Media Planner','Meeveo','','transform next-generation solutions','Pre-emptive demand-driven groupware',76424,'2017-12-20 10:11:00'),(132,'Registered Nurse','Rooxo','','disintermediate intuitive schemas','Monitored directional knowledge base',30106,'2017-11-15 19:22:27'),(133,'VP Sales','Talane','','scale cross-media models','Enhanced executive algorithm',61528,'2017-04-06 21:14:14'),(134,'VP Accounting','Yozio','','whiteboard efficient e-commerce','Fundamental heuristic definition',72324,'2017-07-18 10:15:47'),(135,'Human Resources Assistant I','Fliptune','','morph bleeding-edge metrics','Multi-tiered dynamic Graphical User Interface',80193,'2017-02-18 11:17:54'),(136,'Tax Accountant','Jaxnation','','brand cross-platform mindshare','Distributed exuding circuit',49601,'2017-07-01 06:09:30'),(137,'Administrative Assistant II','Quinu','','repurpose cross-media communities','Cloned 3rd generation intranet',93418,'2017-08-22 22:39:52'),(138,'Accountant I','Rhybox','','seize B2C web-readiness','Fully-configurable homogeneous software',27336,'2018-01-05 06:10:28'),(139,'VP Sales','Tavu','','envisioneer distributed eyeballs','Progressive 3rd generation concept',51030,'2017-09-03 02:34:30'),(140,'Staff Scientist','Yakijo','','engage sexy synergies','Down-sized bifurcated access',61974,'2017-08-31 01:37:22'),(141,'Payment Adjustment Coordinator','Youspan','','repurpose best-of-breed systems','Universal tangible policy',95425,'2017-04-26 10:59:25'),(142,'Help Desk Technician','Edgetag','','deliver best-of-breed supply-chains','Polarised uniform open architecture',76412,'2017-07-06 19:07:23'),(143,'Senior Cost Accountant','Dabjam','','leverage best-of-breed convergence','Public-key system-worthy model',42464,'2017-07-31 06:46:58'),(144,'Actuary','Yozio','','exploit out-of-the-box portals','Inverse eco-centric parallelism',82292,'2017-04-07 19:03:03'),(145,'Product Engineer','Npath','','maximize innovative communities','Profound tertiary policy',50148,'2018-02-05 09:09:15'),(146,'Pharmacist','Zoomlounge','','generate sexy users','Switchable tangible concept',39562,'2017-11-07 08:04:42'),(147,'Senior Cost Accountant','Skajo','','orchestrate web-enabled synergies','Virtual intermediate archive',42058,'2017-04-02 22:20:49'),(148,'Compensation Analyst','Voolith','','synergize integrated architectures','Ergonomic multi-tasking contingency',13153,'2018-01-11 03:12:20'),(149,'Programmer Analyst I','Jaxspan','','e-enable user-centric niches','Proactive didactic matrices',45839,'2018-01-30 19:54:18'),(150,'VP Product Management','Zoomcast','','synthesize B2C e-business','Phased 4th generation system engine',31005,'2017-10-21 01:39:42'),(151,'Editor','Ntag','','whiteboard 24/365 solutions','Customer-focused bandwidth-monitored toolset',95544,'2017-07-26 22:50:37'),(152,'Environmental Tech','Flashspan','','synthesize visionary e-markets','Organized incremental portal',68366,'2017-09-27 16:24:51'),(153,'Community Outreach Specialist','Feednation','','enable web-enabled channels','Operative context-sensitive product',84518,'2018-01-17 01:44:38'),(154,'A good job','clow2@my.gcu.edu','over the hill','much entertain','Good bois only',90382,'2018-03-17 00:39:45'),(155,'Software Breaker','clow2@my.gcu.edu','Artic','We would like to hire you','Must have much knowledges',12567,'2018-03-17 00:45:11');
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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `join_user_group`
--

LOCK TABLES `join_user_group` WRITE;
/*!40000 ALTER TABLE `join_user_group` DISABLE KEYS */;
INSERT INTO `join_user_group` VALUES (10,1001,2),(16,1001,1),(17,1003,1),(18,1002,1),(19,1001,3);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `suspended_users`
--

LOCK TABLES `suspended_users` WRITE;
/*!40000 ALTER TABLE `suspended_users` DISABLE KEYS */;
INSERT INTO `suspended_users` VALUES (2,1002,NULL),(4,1005,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profiles`
--

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
INSERT INTO `user_profiles` VALUES (1,1001,'Developer at Larabar.',NULL,'Grand Canyon University in Phoenix, AZ'),(2,1002,'',NULL,''),(3,1003,'',NULL,''),(4,1004,'',NULL,''),(5,1005,'',NULL,'Here');
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
) ENGINE=InnoDB AUTO_INCREMENT=1006 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1001,'clow2@my.gcu.edu','1001','Connor','Low',1),(1002,'connorjameslow@gmail.com','cocacoco','Connor','Low',0),(1003,'new@user.net','JJ.net','Josh','Jones',0),(1004,'speedycnnr@gmail.com','1234cccc','Connor','Low',0),(1005,'new@user.edu','1234','Connor','Low',0);
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

-- Dump completed on 2018-03-19 23:09:45
