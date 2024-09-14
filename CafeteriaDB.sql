-- MySQL dump 10.13  Distrib 8.0.39, for Linux (x86_64)
--
-- Host: localhost    Database: Cafeteria
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.22.04.1

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
-- Table structure for table `Check_Orders`
--

DROP TABLE IF EXISTS `Check_Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Check_Orders` (
  `Check_Order_ID` int NOT NULL AUTO_INCREMENT,
  `Check_ID` int DEFAULT NULL,
  `Order_ID` int DEFAULT NULL,
  PRIMARY KEY (`Check_Order_ID`),
  KEY `Check_ID` (`Check_ID`),
  KEY `Order_ID` (`Order_ID`),
  CONSTRAINT `Check_Orders_ibfk_1` FOREIGN KEY (`Check_ID`) REFERENCES `Checks` (`Check_ID`),
  CONSTRAINT `Check_Orders_ibfk_2` FOREIGN KEY (`Order_ID`) REFERENCES `Orders` (`Order_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Check_Orders`
--

LOCK TABLES `Check_Orders` WRITE;
/*!40000 ALTER TABLE `Check_Orders` DISABLE KEYS */;
INSERT INTO `Check_Orders` VALUES (1,1,1),(2,2,2);
/*!40000 ALTER TABLE `Check_Orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Checks`
--

DROP TABLE IF EXISTS `Checks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Checks` (
  `Check_ID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int DEFAULT NULL,
  `Amount` int DEFAULT NULL,
  `Date` datetime DEFAULT NULL,
  PRIMARY KEY (`Check_ID`),
  KEY `User_ID` (`User_ID`),
  CONSTRAINT `Checks_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `Users` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Checks`
--

LOCK TABLES `Checks` WRITE;
/*!40000 ALTER TABLE `Checks` DISABLE KEYS */;
INSERT INTO `Checks` VALUES (1,1,25,'2024-08-15 09:35:00'),(2,2,8,'2024-08-15 10:05:00');
/*!40000 ALTER TABLE `Checks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Order_Details`
--

DROP TABLE IF EXISTS `Order_Details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Order_Details` (
  `Order_Detail_ID` int NOT NULL AUTO_INCREMENT,
  `Order_ID` int DEFAULT NULL,
  `Product_ID` int DEFAULT NULL,
  `Quantity` int DEFAULT NULL,
  PRIMARY KEY (`Order_Detail_ID`),
  KEY `Order_ID` (`Order_ID`),
  KEY `Order_Details_fk_Product_ID` (`Product_ID`),
  CONSTRAINT `Order_Details_fk_Product_ID` FOREIGN KEY (`Product_ID`) REFERENCES `Products` (`Product_ID`) ON DELETE CASCADE,
  CONSTRAINT `Order_Details_ibfk_1` FOREIGN KEY (`Order_ID`) REFERENCES `Orders` (`Order_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Order_Details`
--

LOCK TABLES `Order_Details` WRITE;
/*!40000 ALTER TABLE `Order_Details` DISABLE KEYS */;
INSERT INTO `Order_Details` VALUES (8,9,NULL,1),(17,20,4,1),(18,20,5,1),(19,21,4,1),(20,22,4,1),(21,23,4,1),(22,23,5,1),(23,23,17,1),(24,24,19,3),(25,25,12,4),(26,26,17,4),(27,27,18,2),(28,28,4,1),(29,29,26,3);
/*!40000 ALTER TABLE `Order_Details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Orders` (
  `Order_ID` int NOT NULL AUTO_INCREMENT,
  `User_ID` int DEFAULT NULL,
  `Order_Date` datetime DEFAULT CURRENT_TIMESTAMP,
  `Total_Amount` int DEFAULT NULL,
  `Note` text,
  `Status` enum('processing','out of delivery','Done','Canceled') DEFAULT NULL,
  PRIMARY KEY (`Order_ID`),
  KEY `User_ID` (`User_ID`),
  CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `Users` (`User_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Orders`
--

LOCK TABLES `Orders` WRITE;
/*!40000 ALTER TABLE `Orders` DISABLE KEYS */;
INSERT INTO `Orders` VALUES (1,1,'2024-08-15 09:30:00',25,'Morning coffee and tea','Done'),(2,2,'2024-08-15 10:00:00',8,'Just a tea','Canceled'),(3,2,'2024-08-15 09:30:00',25,'Morning coffee and tea','Canceled'),(4,2,'2024-08-15 10:00:00',8,'Just a tea','processing'),(5,2,'2024-08-15 09:30:00',25,'Morning coffee and tea','processing'),(6,2,'2024-08-15 10:00:00',8,'Just a tea','processing'),(7,2,'2024-08-15 09:30:00',25,'Morning coffee and tea','processing'),(9,2,'2024-08-21 12:15:50',19,'test note',NULL),(10,2,'2024-08-21 12:16:44',19,'test note',NULL),(11,2,'2024-08-21 12:25:15',29,'test note',NULL),(12,2,'2024-08-21 12:26:44',19,'test note',NULL),(13,2,'2024-08-21 12:31:32',11,'test note',NULL),(14,2,'2024-08-21 12:35:57',5,'test note',NULL),(15,2,'2024-08-21 12:40:38',5,'test note 2',NULL),(16,2,'2024-08-21 12:47:37',5,'','processing'),(17,2,'2024-08-21 12:48:31',5,'','processing'),(18,2,'2024-08-21 12:48:59',5,'','processing'),(19,2,'2024-08-21 12:54:16',5,'','processing'),(20,1,'2024-08-21 15:33:26',11,'qq','processing'),(21,1,'2024-08-21 15:45:07',5,'','processing'),(22,1,'2024-08-21 15:47:53',5,'','processing'),(23,2,'2024-08-21 16:02:36',31,'qqqqqqqq','processing'),(24,2,'2024-08-21 16:02:57',15,'water','processing'),(25,2,'2024-08-21 17:57:22',60,'','processing'),(26,1,'2024-08-21 17:58:10',80,'','processing'),(27,1,'2024-08-21 17:59:32',40,'','processing'),(28,1,'2024-08-21 18:44:51',5,'','processing'),(29,2,'2024-08-31 22:59:57',30,'','processing');
/*!40000 ALTER TABLE `Orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Products` (
  `Product_ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Price` int DEFAULT NULL,
  `Picture` varchar(255) DEFAULT NULL,
  `Status` enum('available','unavailable') DEFAULT NULL,
  PRIMARY KEY (`Product_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (4,'Teaaaeeeeeee','Hottt',50,'../../uploads/images (2).jpeg','available'),(5,'Coffee','Hot',6,'../../assets/coffee.jpg','available'),(6,'Nescafe','Hot',8,'../../assets/Nescafe.webp','available'),(7,'Cola','Cold',10,'../../assets/cola.jpg','available'),(8,'Chocolate Milk','Cold',15,'../../assets/Chocolate Milk.jpeg','available'),(9,'Cappuccino','Hot',15,'../../assets/Cappuccino.jpeg','available'),(10,'Green Tea','Hot',10,'../../assets/Green Tea.jpeg','available'),(11,'Jasmine Tea','Hot',10,'../../assets/Jasmine Tea.jpeg','available'),(12,'Mint Lemonade','Cold',15,'../../assets/Mint Lemonade.jpeg','available'),(13,'Mango Juice','Cold',20,'../../assets/Mango Juice.jpeg','available'),(14,'Strawberry Juice','Cold',20,'../../assets/Strawberry Juice.jpeg','available'),(15,'Ice Cream','Cold',15,'../../assets/ice cream.jpeg','available'),(16,'Sahlab','Hot',10,'../../assets/Sahlab.jpeg','available'),(17,'Iced Coffee','Cold',20,'../../assets/Iced Coffee.jpeg','available'),(18,'Pomegranate Juice','Cold',20,'../../assets/Pomegranate Juice.jpeg','available'),(19,'Mineral Water','Cold',5,'../../assets/Mineral Water.jpeg','available'),(26,'prod','hot',10,'../../assets/download.jpeg',NULL),(27,'prod','hot',520,'../../assets/download (1).jpeg',NULL);
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Users` (
  `User_ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Picture` varchar(255) DEFAULT NULL,
  `Room_Number` int DEFAULT NULL,
  `Role` enum('Admin','User') DEFAULT 'User',
  PRIMARY KEY (`User_ID`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'Alice','alice@example.com','password123','../../uploads/download (1).jpeg',101,'Admin'),(2,'Bob','bob@example.com','password123','bob.jpg',102,'User'),(3,'Charlie','charlie@example.com','password123','charlie.jpg',103,'User'),(6,'qwe','qwe@gmail.com','123','../../uploads/WhatsApp Image 2024-08-17 at 8.35.11 PM.jpeg',1001,'User'),(9,'ppp','pp@pp.com','123','../../uploads/Screenshot from 2024-08-20 23-24-37.png',1001,'User'),(10,'yyy','yy@gmail.com','123','../../uploads/WhatsApp Image 2024-08-17 at 8.35.11 PM.jpeg',1001,'User'),(14,'asd','asdasd@asd.com','asd','../../uploads/sugar.jpeg',100156565,'User'),(15,'anas','anaselrawy99@gmail.com','123','../../uploads/download (1).jpeg',1001,'User'),(16,'hadeer','hadeer@gmail.com','123','../../uploads/download.jpeg',100000,'User'),(17,'lamia','lamia@gmail.com','123','../../uploads/download (1).jpeg',100,'Admin');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-09-01  1:30:56
