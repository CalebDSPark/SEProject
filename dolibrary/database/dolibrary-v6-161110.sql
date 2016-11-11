-- MySQL dump 10.13  Distrib 5.6.24, for Win32 (x86)
--
-- Host: localhost    Database: dolibrary
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `tbl_books`
--

DROP TABLE IF EXISTS `tbl_books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_books` (
  `INVT_ID` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `CODE` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  `TITLE` varchar(45) NOT NULL,
  `AUTHOR` varchar(45) DEFAULT NULL,
  `CATE` int(4) unsigned zerofill DEFAULT NULL,
  `GENRE` int(4) unsigned zerofill DEFAULT NULL,
  `DESCR` varchar(100) DEFAULT NULL,
  `STATUS` int(1) DEFAULT NULL,
  PRIMARY KEY (`INVT_ID`),
  KEY `CATE_ID_idx` (`CATE`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_books`
--

LOCK TABLES `tbl_books` WRITE;
/*!40000 ALTER TABLE `tbl_books` DISABLE KEYS */;
INSERT INTO `tbl_books` VALUES (000001,'1111','Java','Park',0001,0001,'',1),(000002,'2222','C#','Kim',0002,0002,'',3),(000003,'3333','Android','Lee',0003,0001,'',1),(000004,'43-3434','Software Engineering','Park',0001,0003,'',1),(000005,'111222','C++','Choi',0002,0004,'',1),(000006,'121-12122','Javascript','John',0001,0005,'',1),(000007,'343-3434','PHP','David',0003,0006,'',1),(000008,'77777','Json','Park',0001,0001,'',1),(000009,'211-323','MySQL','Mark',0003,0002,'',1),(000014,'353-5355','AJAX','Park',0001,0004,'dfd',1);
/*!40000 ALTER TABLE `tbl_books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_borrow`
--

DROP TABLE IF EXISTS `tbl_borrow`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_borrow` (
  `BO_ID` int(6) unsigned zerofill NOT NULL,
  `ORDER_DATE` date NOT NULL,
  `MEMBER_ID` varchar(30) CHARACTER SET latin1 NOT NULL,
  `REQ_STATUS` int(1) DEFAULT '0',
  PRIMARY KEY (`BO_ID`),
  KEY `MEMBER_ID_idx` (`MEMBER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_borrow`
--

LOCK TABLES `tbl_borrow` WRITE;
/*!40000 ALTER TABLE `tbl_borrow` DISABLE KEYS */;
INSERT INTO `tbl_borrow` VALUES (000001,'2016-10-16','staff1',1),(000002,'2016-10-16','staff1',1),(000003,'2016-10-17','user1',1),(000004,'2016-10-17','staff1',1),(000005,'2016-10-22','staff2',1),(000006,'2016-10-22','user2',1),(000007,'2016-11-10','staff1',1),(000008,'2016-11-10','staff2',1),(000009,'2016-11-10','user2',1);
/*!40000 ALTER TABLE `tbl_borrow` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_borrow_bag`
--

DROP TABLE IF EXISTS `tbl_borrow_bag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_borrow_bag` (
  `INVT_ID` int(6) unsigned zerofill NOT NULL,
  PRIMARY KEY (`INVT_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_borrow_bag`
--

LOCK TABLES `tbl_borrow_bag` WRITE;
/*!40000 ALTER TABLE `tbl_borrow_bag` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_borrow_bag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_borrow_detail`
--

DROP TABLE IF EXISTS `tbl_borrow_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_borrow_detail` (
  `BO_ID` int(6) unsigned zerofill NOT NULL,
  `INVT_ID` int(6) unsigned zerofill NOT NULL,
  `REQ_DATE` date DEFAULT NULL,
  `DUE_DATE` date DEFAULT NULL,
  `RETURN_DATE` date DEFAULT NULL,
  PRIMARY KEY (`BO_ID`,`INVT_ID`),
  KEY `ORDER_ID_idx` (`BO_ID`),
  KEY `INVT_ID_idx` (`INVT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_borrow_detail`
--

LOCK TABLES `tbl_borrow_detail` WRITE;
/*!40000 ALTER TABLE `tbl_borrow_detail` DISABLE KEYS */;
INSERT INTO `tbl_borrow_detail` VALUES (000001,000006,'2016-10-16','2016-10-19','2016-10-22'),(000001,000007,'2016-10-16','2016-10-19','2016-11-10'),(000002,000002,'2016-10-16','2016-10-19','2016-11-10'),(000002,000005,'2016-10-16','2016-10-19','2016-11-10'),(000003,000003,'2016-10-17','2016-10-20','2016-10-22'),(000004,000001,'2016-10-17','2016-10-20','2016-10-22'),(000005,000008,'2016-10-22','2016-10-27','2016-10-23'),(000005,000014,'2016-10-22','2016-10-27','2016-10-23'),(000006,000003,'2016-10-20','2016-10-25','2016-10-22'),(000007,000002,'2016-11-10','2016-11-15','2016-11-10'),(000008,000001,'2016-11-10','2016-11-15','2016-11-10'),(000009,000002,'2016-11-10','2016-11-13',NULL),(000009,000003,'2016-11-10','2016-11-13','2016-11-10');
/*!40000 ALTER TABLE `tbl_borrow_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_member`
--

DROP TABLE IF EXISTS `tbl_member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_member` (
  `ID` varchar(45) NOT NULL,
  `PW` varchar(255) CHARACTER SET latin1 NOT NULL,
  `FNAME` varchar(45) NOT NULL,
  `LNAME` varchar(45) NOT NULL,
  `SID` varchar(45) DEFAULT NULL,
  `EMP_ID` varchar(45) DEFAULT NULL,
  `LEVEL` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `PHONE` varchar(30) DEFAULT NULL,
  `EMAIL` varchar(45) CHARACTER SET latin1 DEFAULT NULL,
  `ADDRESS` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `BIRTHDAY` date DEFAULT NULL,
  `GENDER` varchar(5) DEFAULT NULL,
  `STATUS` int(1) DEFAULT '1',
  `MEMO` varchar(200) DEFAULT NULL,
  `DEPT` varchar(45) DEFAULT NULL,
  `JOBTITLE` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `JOBTITLE_ID_idx` (`JOBTITLE`),
  KEY `DEPT_ID_idx` (`DEPT`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_member`
--

LOCK TABLES `tbl_member` WRITE;
/*!40000 ALTER TABLE `tbl_member` DISABLE KEYS */;
INSERT INTO `tbl_member` VALUES ('staff1','1234','Nelson','Eng','5555','111-555','staff','778-938-3947','nelson@dolibrary.com','456 Street','2009-12-09','2',1,'maria memo','Library','Manager'),('staff2','1234','Maria','Park','1234','111-777','staff','604-777-888','maria@dolibrary.com','','2016-08-08','2',1,'','0003','0001'),('user1','1234','Caleb','Park','1111',NULL,'student','604-724-0600','caleb@gmail.com',NULL,NULL,NULL,1,NULL,'0001','0001'),('user2','1234','Jordan','Cheng','2222',NULL,'student','778-758-9689','','','0000-00-00',NULL,1,'','0001','0001'),('user3','1234','Seong Min','Kim','3333',NULL,'student','778-412-8792','ds@gmail.com','','2016-07-04',NULL,1,'I am DS','0002','0003'),('user4','1234','Trenton','Wong','4444','','student','604-789-7214','','','0000-00-00','1',1,'','0001','0002');
/*!40000 ALTER TABLE `tbl_member` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-11-10 17:47:22
