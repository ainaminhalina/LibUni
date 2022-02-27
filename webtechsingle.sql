# Host: 127.0.0.1  (Version 5.5.5-10.4.11-MariaDB)
# Date: 2020-07-19 10:52:33
# Generator: MySQL-Front 6.0  (Build 2.20)


#
# Structure for table "book"
#

DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `title` text DEFAULT NULL,
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `author` text DEFAULT NULL,
  `about` text NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

#
# Data for table "book"
#

INSERT INTO `book` VALUES ('ABC',4,'Ahmad','A to Z'),('Google',5,'G','Macam mana nak guna google'),('Yahoo',6,'Y','Not relevant'),('English',7,'Aina','English'),('English',8,'Aina','English'),('Hello Web Tech',10,'Sir Norizam','RestFul');

#
# Structure for table "book_rental"
#

DROP TABLE IF EXISTS `book_rental`;
CREATE TABLE `book_rental` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `rent_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

#
# Data for table "book_rental"
#

INSERT INTO `book_rental` VALUES (1,5,5,'2020-07-16','2020-07-23'),(2,6,8,'2020-07-16','2020-07-23'),(3,7,8,'2020-07-16','2020-07-23'),(4,5,5,'2020-07-16','2020-07-23'),(5,5,9,'2020-07-19','2020-07-26'),(6,10,11,'2020-07-19','2020-07-26'),(7,6,11,'2020-07-19','2020-07-26'),(8,4,11,'2020-07-19','2020-07-26'),(9,7,11,'2020-07-19','2020-07-26'),(10,8,2,'2020-07-19','2020-07-26'),(11,4,2,'2020-07-19','2020-07-26');

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

#
# Data for table "user"
#

INSERT INTO `user` VALUES (1,'Admin','admin','admin@gmail.com','123',1),(2,'Ahmad','ahmadammar','ahmad@gmail.com','ahmad',2),(4,'Ali','ali','ali@gmail.com','12345',2),(5,'Aminah','aminah','aminah@gmail.com','ami',2),(6,'Nurul','nur','nur@gmail.com','nurul',2),(7,'Jamilah','jamilah','jamilah@gmail.com','jamilah',2),(8,'Danish','danish','danish@hotmail.com','danishawesome',2),(9,'Siti','siti','siti@gmail.com','siti',2),(10,'Siti','siti','siti@gmail.com','siti',2),(11,'Aina','ainaminhalina','ainaminhalina@gmail.com','123',2);
