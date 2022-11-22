-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2022 at 03:07 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bioskop_xx2`
--
CREATE DATABASE IF NOT EXISTS `bioskop_xx2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bioskop_xx2`;

-- --------------------------------------------------------

--
-- Table structure for table `d_movie`
--

DROP TABLE IF EXISTS `d_movie`;
CREATE TABLE IF NOT EXISTS `d_movie` (
  `id_dmovie` int(11) NOT NULL AUTO_INCREMENT,
  `id_nota` int(11) DEFAULT NULL,
  `seat_i` int(11) DEFAULT NULL,
  `seat_j` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_dmovie`),
  KEY `id_nota` (`id_nota`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `d_movie`
--

INSERT INTO `d_movie` (`id_dmovie`, `id_nota`, `seat_i`, `seat_j`) VALUES
(1, 1, 3, 5),
(2, 1, 2, 5),
(3, 1, 2, 6),
(4, 1, 1, 7),
(5, 1, 1, 6),
(6, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

DROP TABLE IF EXISTS `film`;
CREATE TABLE IF NOT EXISTS `film` (
  `id_film` int(11) NOT NULL AUTO_INCREMENT,
  `nama_film` varchar(100) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `trailer_link` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_film`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id_film`, `nama_film`, `sinopsis`, `image_path`, `trailer_link`, `start_date`, `end_date`, `status`) VALUES
(4, 'Yuru Camp the Movie', 'The anime film will feature the familiar characters from the franchise now grown up, and reuniting to construct a campsite.', 'placeholder.jpg', 'https://www.youtube.com/watch?v=1GnPdVAJm5U', '2022-11-02', '2022-11-30', 1),
(5, 'Sword Art Online: Progressive Movie - Kuraki Yuuya', 'Second Sword Art Online: Progressive movie.', 'placeholder.jpg', 'https://www.youtube.com/watch?v=MLWmlQmLQLw', '2022-12-01', '2022-12-31', 1),
(6, 'Bochi The Rock Movie', 'Yearning to make friends and perform live with a band, lonely and socially anxious Hitori \"Bocchi\" Gotou devotes her time to playing the guitar. On a fateful day, Bocchi meets the outgoing drummer Nijika Ijichi, who invites her to join Kessoku Band when their guitarist, Ikuyo Kita, flees before their first show. Soon after, Bocchi meets her final bandmate—the cool bassist Ryou Yamada.\n\nAlthough their first performance together is subpar, the girls feel empowered by their shared love for music, and they are soon rejoined by Kita. Finding happiness in performing, Bocchi and her bandmates put their hearts into improving as musicians while making the most of their fleeting high school days.', 'bocchi.jpg', 'https://www.youtube.com/watch?v=Fp7lnCp_LW0', '2022-11-17', '2022-12-23', 1),
(7, 'Fate/stay night Movie: Heavens Feel - I. Presage Flower', 'The Holy Grail War: a violent battle between mages in which seven masters and their summoned servants fight for the Holy Grail, a magical artifact that can grant the victor any wish. Nearly 10 years ago, the final battle of the Fourth Holy Grail War wreaked havoc on Fuyuki City and took over 500 lives, leaving the city devastated.', 'fate.jpg', 'https://www.youtube.com/watch?v=r_sf0-o9tS0', '2022-11-23', '2022-12-07', 1),
(8, 'Fate/stay night Movie: Heavens Feel - II. Lost Butterfly', 'The Fifth Holy Grail War continues, and the ensuing chaos results in higher stakes for all participants. Shirou Emiya continues to participate in the war, aspiring to be a hero of justice who saves everyone. He sets out in search of the truth behind a mysterious dark shadow and its murder spree, determined to defeat it.', 'fate2.jpg', 'https://www.youtube.com/embed/NhJQDAIwQVc?enablejsapi=1', '2022-12-10', '2023-01-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `film_genre`
--

DROP TABLE IF EXISTS `film_genre`;
CREATE TABLE IF NOT EXISTS `film_genre` (
  `film_genre_id` int(11) NOT NULL AUTO_INCREMENT,
  `id_genre` int(11) NOT NULL,
  `id_film` int(11) NOT NULL,
  PRIMARY KEY (`film_genre_id`),
  KEY `id_film` (`id_film`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film_genre`
--

INSERT INTO `film_genre` (`film_genre_id`, `id_genre`, `id_film`) VALUES
(1, 3, 4),
(2, 4, 4),
(3, 5, 4),
(4, 1, 5),
(5, 3, 5),
(6, 6, 5),
(7, 4, 6),
(8, 5, 6),
(9, 1, 7),
(10, 6, 7),
(11, 1, 8),
(12, 6, 8);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE IF NOT EXISTS `genre` (
  `id_genre` int(11) NOT NULL AUTO_INCREMENT,
  `nama_genre` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id_genre`, `nama_genre`) VALUES
(1, 'Action'),
(2, 'Horror'),
(3, 'Romance'),
(4, 'Family'),
(5, 'Comedy'),
(6, 'Shounen'),
(7, 'Thriller');

-- --------------------------------------------------------

--
-- Table structure for table `h_movie`
--

DROP TABLE IF EXISTS `h_movie`;
CREATE TABLE IF NOT EXISTS `h_movie` (
  `id_nota` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) DEFAULT NULL,
  `id_theater_schedule` int(11) DEFAULT NULL,
  `buy_date` date DEFAULT NULL,
  PRIMARY KEY (`id_nota`),
  KEY `id_member` (`id_member`),
  KEY `id_theater_schedule` (`id_theater_schedule`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `h_movie`
--

INSERT INTO `h_movie` (`id_nota`, `id_member`, `id_theater_schedule`, `buy_date`) VALUES
(1, 1, 3, '2022-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `nama_member` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `user` varchar(40) DEFAULT NULL,
  `pass` varchar(40) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama_member`, `email`, `user`, `pass`, `saldo`, `status`) VALUES
(1, 'Budi', 'budi123@example.com', 'budi', '123', 4000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `point_request`
--

DROP TABLE IF EXISTS `point_request`;
CREATE TABLE IF NOT EXISTS `point_request` (
  `id_request` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(11) DEFAULT NULL,
  `jumlah_point` int(11) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id_request`),
  KEY `id_member` (`id_member`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `id_schedule` int(11) NOT NULL AUTO_INCREMENT,
  `id_film` int(11) DEFAULT NULL,
  `broadcast_date` date DEFAULT NULL,
  `id_session` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_schedule`),
  KEY `id_film` (`id_film`),
  KEY `id_session` (`id_session`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id_schedule`, `id_film`, `broadcast_date`, `id_session`, `status`) VALUES
(2, 4, '2022-11-01', 3, 1),
(3, 6, '2022-11-18', 2, 1),
(4, 7, '2022-12-01', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE IF NOT EXISTS `session` (
  `id_session` int(11) NOT NULL AUTO_INCREMENT,
  `session_start` time NOT NULL,
  `session_end` time NOT NULL,
  PRIMARY KEY (`id_session`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`id_session`, `session_start`, `session_end`) VALUES
(1, '09:30:00', '12:00:00'),
(2, '12:30:00', '15:00:00'),
(3, '15:30:00', '18:00:00'),
(4, '18:30:00', '21:00:00'),
(5, '21:30:00', '23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

DROP TABLE IF EXISTS `theater`;
CREATE TABLE IF NOT EXISTS `theater` (
  `id_theater` int(11) NOT NULL AUTO_INCREMENT,
  `nama_theater` varchar(100) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id_theater`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `theater`
--

INSERT INTO `theater` (`id_theater`, `nama_theater`, `width`, `height`, `harga`, `description`) VALUES
(1, 'theater 1', 8, 5, 50000, 'ini theater 1'),
(2, 'theater 2', 10, 8, 55000, 'ini theater 2');

-- --------------------------------------------------------

--
-- Table structure for table `theater_schedule`
--

DROP TABLE IF EXISTS `theater_schedule`;
CREATE TABLE IF NOT EXISTS `theater_schedule` (
  `id_theater_schedule` int(11) NOT NULL AUTO_INCREMENT,
  `id_theater` int(11) DEFAULT NULL,
  `id_schedule` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_theater_schedule`),
  KEY `id_theater` (`id_theater`),
  KEY `id_schedule` (`id_schedule`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `theater_schedule`
--

INSERT INTO `theater_schedule` (`id_theater_schedule`, `id_theater`, `id_schedule`, `status`) VALUES
(1, 1, 2, 1),
(2, 2, 2, 1),
(3, 1, 3, 1),
(4, 2, 3, 0),
(5, 1, 4, 1),
(6, 2, 4, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `d_movie`
--
ALTER TABLE `d_movie`
  ADD CONSTRAINT `d_movie_ibfk_1` FOREIGN KEY (`id_nota`) REFERENCES `h_movie` (`id_nota`);

--
-- Constraints for table `film_genre`
--
ALTER TABLE `film_genre`
  ADD CONSTRAINT `film_genre_ibfk_2` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`);

--
-- Constraints for table `h_movie`
--
ALTER TABLE `h_movie`
  ADD CONSTRAINT `h_movie_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`),
  ADD CONSTRAINT `h_movie_ibfk_2` FOREIGN KEY (`id_theater_schedule`) REFERENCES `theater_schedule` (`id_theater_schedule`);

--
-- Constraints for table `point_request`
--
ALTER TABLE `point_request`
  ADD CONSTRAINT `point_request_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`id_film`) REFERENCES `film` (`id_film`),
  ADD CONSTRAINT `schedule_ibfk_2` FOREIGN KEY (`id_session`) REFERENCES `session` (`id_session`);

--
-- Constraints for table `theater_schedule`
--
ALTER TABLE `theater_schedule`
  ADD CONSTRAINT `theater_schedule_ibfk_1` FOREIGN KEY (`id_theater`) REFERENCES `theater` (`id_theater`),
  ADD CONSTRAINT `theater_schedule_ibfk_2` FOREIGN KEY (`id_schedule`) REFERENCES `schedule` (`id_schedule`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
