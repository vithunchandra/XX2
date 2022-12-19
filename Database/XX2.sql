/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.25-MariaDB : Database - bioskop_xx2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`bioskop_xx2` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `bioskop_xx2`;

/*Table structure for table `d_movie` */

DROP TABLE IF EXISTS `d_movie`;

CREATE TABLE `d_movie` (
  `id_dmovie` int(11) NOT NULL AUTO_INCREMENT,
  `id_nota` int(11) DEFAULT NULL,
  `seat_i` int(11) DEFAULT NULL,
  `seat_j` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_dmovie`),
  KEY `id_nota` (`id_nota`),
  CONSTRAINT `d_movie_ibfk_1` FOREIGN KEY (`id_nota`) REFERENCES `h_movie` (`id_nota`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

/*Data for the table `d_movie` */

insert  into `d_movie`(`id_dmovie`,`id_nota`,`seat_i`,`seat_j`,`harga`) values 
(10,1,2,4,50000),
(11,1,2,3,50000),
(12,1,2,2,50000),
(13,2,3,3,50000),
(14,2,3,2,50000),
(15,3,0,3,50000),
(16,3,0,4,50000),
(17,4,4,4,50000),
(18,4,0,3,50000),
(19,5,4,4,55000),
(20,5,4,5,55000),
(21,5,3,4,55000),
(22,6,2,3,50000),
(23,6,3,3,50000);

/*Table structure for table `film` */

DROP TABLE IF EXISTS `film`;

CREATE TABLE `film` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `nama_film` varchar(50) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `trailer_link` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_film`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

/*Data for the table `film` */

insert  into `film`(`id_film`,`nama_film`,`sinopsis`,`image_path`,`trailer_link`,`start_date`,`end_date`,`status`) values 
(9,'Black Adam','Nearly 5,000 years after he was bestowed with the almighty powers of the ancient gods—and imprisoned just as quickly—Black Adam (Johnson) is freed from his earthly tomb, ready to unleash his unique form of justice on the modern world.','blackadam.jpg','https://www.youtube.com/watch?v=X0tOpBuYasI','2022-11-14','2022-11-27',1),
(10,'spiderman no home','For the first time in the cinematic history of Spider-Man, our friendly neighborhood hero identity is revealed, bringing his Super Hero responsibilities into conflict with his normal life and putting those he cares about most at risk. When he enlists Doctor Strange help to restore his secret, the spell tears a hole in their world, releasing the most powerful villains who have ever fought a Spider-Man in any universe. Now, Peter will have to overcome his greatest challenge yet, which will not only forever alter his own future but the future of the Multiverse.','spiderman.jpg','https://youtu.be/JfVOs4VSpmA','2022-05-09','2022-05-28',1),
(11,'Black Phanter 2','After the events of Captain America: Civil War, King T Challa returns home to the reclusive, technologically advanced African nation of Wakanda to serve as his country new leader. However, T Challa soon finds that he is challenged for the throne from factions within his own country. When two foes conspire to destroy Wakanda, the hero known as Black Panther must team up with C.I.A. agent Everett K. Ross and members of the Dora Milaje, Wakandan special forces, to prevent Wakanda from being dragged into a world war.','wakanda2.jpeg','https://www.youtube.com/watch?v=Hg4h_f4Hj4k','2022-12-01','2022-12-21',1),
(12,'morbius ','Dangerously ill with a rare blood disorder and determined to save others suffering his same fate, Dr. Morbius attempts a desperate gamble. While at first it seems to be a radical success, a darkness inside him is unleashed. Will good override evil – or will Morbius succumb to his mysterious new urges?','morbius.png','https://youtu.be/oZ6iiRrz1SY','2022-10-09','2022-10-29',1),
(13,'doctor strange multiverse madnes','Doctor Strange teams up with a mysterious teenage girl from his dreams who can travel across multiverses, to battle multiple threats, including other-universe versions of himself, which threaten to wipe out millions across the multiverse.','multiversse.jpg','https://youtu.be/aWzlQ2N6qqg','2022-10-09','2022-10-28',1),
(14,'avatar the way of water','second season of avatar','avatar.jpeg','https://youtu.be/d9MyW72ELq0','2022-12-14','2023-01-07',1),
(15,'the menu','The film, penned by Will Tracy and Seth Reiss, focuses on a young couple who visits an exclusive destination restaurant on a remote island where the acclaimed chef has prepared a lavish tasting menu, along with some shocking surprise.Deadline notes, Fiennes plays the world-class chef who sets it all up and adds some unexpected ingredients to the menu planned. The action follows one particular A-list couple that takes part. I have heard Stone will play half of that couple.','the menu.jpg','https://youtu.be/C_uTkUGcHv4','2022-11-18','2022-12-23',1),
(16,'midnight in the switch grass','Two FBI agents cross paths with Crawford, a Florida cop who is investigating a string of murders that appear to be related. When an undercover sting goes horribly wrong, Crawford soon finds himself in a twisted game of cat and mouse with the killer.','midnight.jpg','https://youtu.be/1pNN66fRumw','2022-12-02','2022-12-22',1),
(17,'Spider-man accros the spiderverse','After reuniting with Gwen Stacy, Brooklyn full-time, friendly neighborhood Spider-Man is catapulted across the Multiverse, where he encounters a team of Spider-People charged with protecting its very existence. But when the heroes clash on how to handle a new threat, Miles finds himself pitted against the other Spiders and must redefine what it means to be a hero so he can save the people he loves most.','miles.jpg','https://youtu.be/cqGjhVJWtEg','2023-06-03','2023-06-30',1),
(18,'Puss in boots the last wish','In their quest, Puss and Kitty will be aided—against their better judgment—by a ratty, chatty, relentlessly cheerful mutt, Perrito . Together, our trio of heroes will have to stay one step ahead of Goldi and the Three Bears Crime Family, Jack Horner  and terrifying bounty hunter, the big, bad Wolf .','pussy.jpg','https://youtu.be/RqrXhwS33yc','2022-12-23','2023-01-07',1);

/*Table structure for table `film_genre` */

DROP TABLE IF EXISTS `film_genre`;

CREATE TABLE `film_genre` (
  `film_genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_genre` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  PRIMARY KEY (`film_genre_id`),
  KEY `id_film` (`id_film`),
  CONSTRAINT `film_genre_ibfk_2` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4;

/*Data for the table `film_genre` */

insert  into `film_genre`(`film_genre_id`,`id_genre`,`id_film`) values 
(54,1,12),
(55,2,12),
(56,7,12),
(57,1,13),
(58,2,13),
(62,1,14),
(63,3,14),
(64,7,14),
(65,1,11),
(66,1,15),
(67,2,15),
(68,7,15),
(69,1,16),
(70,7,16),
(71,1,17),
(72,3,17),
(73,5,17),
(74,1,18),
(75,3,18),
(76,5,18),
(77,1,9),
(81,1,10),
(82,3,10),
(83,5,10);

/*Table structure for table `genre` */

DROP TABLE IF EXISTS `genre`;

CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `nama_genre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

/*Data for the table `genre` */

insert  into `genre`(`id_genre`,`nama_genre`) values 
(1,'Action'),
(2,'Horror'),
(3,'Romance'),
(4,'Family'),
(5,'Comedy'),
(6,'Shounen'),
(7,'Thriller');

/*Table structure for table `h_movie` */

DROP TABLE IF EXISTS `h_movie`;

CREATE TABLE `h_movie` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) DEFAULT NULL,
  `id_theater_schedule` int(11) DEFAULT NULL,
  `buy_date` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_nota`),
  KEY `id_member` (`id_member`),
  KEY `id_theater_schedule` (`id_theater_schedule`),
  CONSTRAINT `h_movie_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`),
  CONSTRAINT `h_movie_ibfk_2` FOREIGN KEY (`id_theater_schedule`) REFERENCES `theater_schedule` (`id_theater_schedule`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

/*Data for the table `h_movie` */

insert  into `h_movie`(`id_nota`,`id_member`,`id_theater_schedule`,`buy_date`,`total`) values 
(1,1,41,'2022-12-19',150000),
(2,1,41,'2022-12-19',100000),
(3,1,41,'2022-12-19',100000),
(4,1,43,'2022-12-19',100000),
(5,1,42,'2022-12-19',165000),
(6,3,43,'2022-12-19',100000);

/*Table structure for table `member` */

DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `nama_member` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `user` varchar(40) DEFAULT NULL,
  `pass` varchar(255) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `member` */

insert  into `member`(`id_member`,`nama_member`,`email`,`user`,`pass`,`saldo`,`status`) values 
(1,'Budi','budi123@example.com','budi','123',99338331,1),
(2,'Akatsuki','user15@asd','Yuji','ijuy',99999,1),
(3,'Thuan','Thuan@istts.edu','Thuan','123',99238331,1),
(4,'Kenneth','kenn@gmail.com','ken','202cb962ac59075b964b07152d234b70',0,1);

/*Table structure for table `point_request` */

DROP TABLE IF EXISTS `point_request`;

CREATE TABLE `point_request` (
  `id_request` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) DEFAULT NULL,
  `jumlah_point` int(11) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id_request`),
  KEY `id_member` (`id_member`),
  CONSTRAINT `point_request_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

/*Data for the table `point_request` */

insert  into `point_request`(`id_request`,`id_member`,`jumlah_point`,`status`) values 
(2,2,99999,'\0'),
(3,1,3332,'\0'),
(4,3,2147483647,'\0');

/*Table structure for table `schedule` */

DROP TABLE IF EXISTS `schedule`;

CREATE TABLE `schedule` (
  `id_schedule` int(11) NOT NULL AUTO_INCREMENT,
  `id_film` int(11) DEFAULT NULL,
  `broadcast_date` date DEFAULT NULL,
  `id_session` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_schedule`),
  KEY `id_film` (`id_film`),
  KEY `id_session` (`id_session`),
  CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`id_session`) REFERENCES `session` (`id_session`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4;

/*Data for the table `schedule` */

insert  into `schedule`(`id_schedule`,`id_film`,`broadcast_date`,`id_session`,`status`) values 
(29,10,'2022-12-12',1,1),
(30,10,'2022-12-12',3,1),
(31,9,'2022-12-18',2,1),
(32,10,'2022-12-14',2,1),
(33,10,'2022-12-14',4,1),
(34,11,'2022-12-20',2,1),
(35,14,'2022-12-20',4,1),
(36,11,'2022-12-19',3,1);

/*Table structure for table `session` */

DROP TABLE IF EXISTS `session`;

CREATE TABLE `session` (
  `id_session` int(11) NOT NULL AUTO_INCREMENT,
  `session_start` time NOT NULL,
  `session_end` time NOT NULL,
  PRIMARY KEY (`id_session`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `session` */

insert  into `session`(`id_session`,`session_start`,`session_end`) values 
(1,'09:30:00','12:00:00'),
(2,'12:30:00','15:00:00'),
(3,'15:30:00','18:00:00'),
(4,'18:30:00','21:00:00'),
(5,'21:30:00','23:00:00');

/*Table structure for table `theater` */

DROP TABLE IF EXISTS `theater`;

CREATE TABLE `theater` (
  `id_theater` int(11) NOT NULL AUTO_INCREMENT,
  `nama_theater` varchar(100) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id_theater`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

/*Data for the table `theater` */

insert  into `theater`(`id_theater`,`nama_theater`,`width`,`height`,`harga`,`description`) values 
(1,'theater 1',8,5,50000,'ini theater 1'),
(2,'theater 2',10,8,55000,'ini theater 2');

/*Table structure for table `theater_schedule` */

DROP TABLE IF EXISTS `theater_schedule`;

CREATE TABLE `theater_schedule` (
  `id_theater_schedule` int(11) NOT NULL AUTO_INCREMENT,
  `id_theater` int(11) DEFAULT NULL,
  `id_schedule` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_theater_schedule`),
  KEY `id_theater` (`id_theater`),
  KEY `id_schedule` (`id_schedule`),
  CONSTRAINT `theater_schedule_ibfk_1` FOREIGN KEY (`id_theater`) REFERENCES `theater` (`id_theater`),
  CONSTRAINT `theater_schedule_ibfk_2` FOREIGN KEY (`id_schedule`) REFERENCES `schedule` (`id_schedule`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;

/*Data for the table `theater_schedule` */

insert  into `theater_schedule`(`id_theater_schedule`,`id_theater`,`id_schedule`,`status`) values 
(34,1,29,1),
(35,1,30,1),
(36,1,31,1),
(37,2,30,1),
(38,2,32,1),
(39,2,32,1),
(40,1,33,1),
(41,1,34,1),
(42,2,35,1),
(43,1,36,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
