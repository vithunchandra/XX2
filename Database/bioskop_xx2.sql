-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2022 at 10:23 AM
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
CREATE TABLE `d_movie` (
  `id_dmovie` int(11) NOT NULL,
  `id_nota` int(11) DEFAULT NULL,
  `seat_i` int(11) DEFAULT NULL,
  `seat_j` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `d_movie`
--

INSERT INTO `d_movie` (`id_dmovie`, `id_nota`, `seat_i`, `seat_j`, `harga`) VALUES
(1, 1, 3, 5, 50000),
(2, 1, 2, 5, 50000),
(3, 1, 2, 6, 50000),
(4, 1, 1, 7, 50000),
(5, 1, 1, 6, 50000),
(6, 1, 1, 5, 50000),
(7, 2, 2, 3, 50000),
(8, 2, 2, 4, 50000);

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

DROP TABLE IF EXISTS `film`;
CREATE TABLE `film` (
  `id_film` int(11) NOT NULL,
  `nama_film` varchar(50) DEFAULT NULL,
  `sinopsis` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `trailer_link` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id_film`, `nama_film`, `sinopsis`, `image_path`, `trailer_link`, `start_date`, `end_date`, `status`) VALUES
(4, 'Yuru Camp the Movie', 'The anime film will feature the familiar characters from the franchise now grown up, and reuniting to construct a campsite.', 'Yuru_Camp_Movie.jpg', 'https://www.youtube.com/watch?v=1GnPdVAJm5U', '2022-11-02', '2022-11-30', 1),
(5, 'Sword Art Online: Progressive Movie - Kuraki Yuuya', 'Second Sword Art Online: Progressive movie.', 'swordartonline.jpg', 'https://www.youtube.com/watch?v=MLWmlQmLQLw', '2022-12-01', '2022-12-31', 1),
(6, 'Bochi The Rock Movie', 'Yearning to make friends and perform live with a band, lonely and socially anxious Hitori \"Bocchi\" Gotou devotes her time to playing the guitar. On a fateful day, Bocchi meets the outgoing drummer Nijika Ijichi, who invites her to join Kessoku Band when their guitarist, Ikuyo Kita, flees before their first show. Soon after, Bocchi meets her final bandmate—the cool bassist Ryou Yamada.\n\nAlthough their first performance together is subpar, the girls feel empowered by their shared love for music, and they are soon rejoined by Kita. Finding happiness in performing, Bocchi and her bandmates put their hearts into improving as musicians while making the most of their fleeting high school days.', 'bocchi.jpg', 'https://www.youtube.com/watch?v=Fp7lnCp_LW0', '2022-11-17', '2022-12-23', 1),
(7, 'jujutsu kaisen 0', 'ini jjk0', 'jjk0.jpg', 'halo', '2022-12-30', '2023-01-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `film_genre`
--

DROP TABLE IF EXISTS `film_genre`;
CREATE TABLE `film_genre` (
  `film_genre_id` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  `id_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film_genre`
--

INSERT INTO `film_genre` (`film_genre_id`, `id_genre`, `id_film`) VALUES
(12, 4, 6),
(13, 5, 6),
(14, 6, 6),
(19, 1, 5),
(20, 3, 5),
(21, 6, 5),
(25, 3, 4),
(26, 4, 4),
(27, 5, 4),
(28, 1, 7),
(29, 6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL,
  `nama_genre` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
CREATE TABLE `h_movie` (
  `id_nota` int(11) NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `id_theater_schedule` int(11) DEFAULT NULL,
  `buy_date` date DEFAULT NULL,
  `total` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `h_movie`
--

INSERT INTO `h_movie` (`id_nota`, `id_member`, `id_theater_schedule`, `buy_date`, `total`) VALUES
(1, 1, 3, '2022-11-21', 300000),
(2, 1, 6, '2022-12-02', 100000);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama_member` varchar(50) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `user` varchar(40) DEFAULT NULL,
  `pass` varchar(40) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama_member`, `email`, `user`, `pass`, `saldo`, `status`) VALUES
(1, 'Budi', 'budi123@example.com', 'budi', '123', 24600, 1);

-- --------------------------------------------------------

--
-- Table structure for table `point_request`
--

DROP TABLE IF EXISTS `point_request`;
CREATE TABLE `point_request` (
  `id_request` int(11) NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `jumlah_point` int(11) DEFAULT NULL,
  `status` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `id_schedule` int(11) NOT NULL,
  `id_film` int(11) DEFAULT NULL,
  `broadcast_date` date DEFAULT NULL,
  `id_session` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id_schedule`, `id_film`, `broadcast_date`, `id_session`, `status`) VALUES
(2, 4, '2022-11-01', 3, 1),
(3, 6, '2022-11-18', 2, 1),
(4, 6, '2022-11-21', 1, 1),
(5, 5, '2022-11-21', 2, 1),
(7, 5, '2022-11-21', 3, 1),
(12, 6, '2022-11-27', 2, 1),
(13, 5, '2022-11-28', 1, 1),
(14, 4, '2022-11-28', 4, 1),
(15, 6, '2022-11-28', 3, 1),
(17, 5, '2022-12-22', 2, 1),
(18, 5, '2022-12-22', 3, 1),
(19, 5, '2022-12-22', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
CREATE TABLE `session` (
  `id_session` int(11) NOT NULL,
  `session_start` time NOT NULL,
  `session_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
CREATE TABLE `theater` (
  `id_theater` int(11) NOT NULL,
  `nama_theater` varchar(100) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
CREATE TABLE `theater_schedule` (
  `id_theater_schedule` int(11) NOT NULL,
  `id_theater` int(11) DEFAULT NULL,
  `id_schedule` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `theater_schedule`
--

INSERT INTO `theater_schedule` (`id_theater_schedule`, `id_theater`, `id_schedule`, `status`) VALUES
(1, 1, 2, 1),
(2, 2, 2, 1),
(3, 1, 3, 1),
(4, 2, 3, 0),
(5, 2, 4, 1),
(6, 1, 5, 1),
(15, 1, 12, 1),
(16, 1, 13, 1),
(17, 1, 14, 1),
(18, 2, 15, 1),
(20, 2, 17, 1),
(21, 2, 18, 1),
(22, 2, 19, 1),
(23, 1, 19, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `d_movie`
--
ALTER TABLE `d_movie`
  ADD PRIMARY KEY (`id_dmovie`),
  ADD KEY `id_nota` (`id_nota`);

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`);

--
-- Indexes for table `film_genre`
--
ALTER TABLE `film_genre`
  ADD PRIMARY KEY (`film_genre_id`),
  ADD KEY `id_film` (`id_film`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indexes for table `h_movie`
--
ALTER TABLE `h_movie`
  ADD PRIMARY KEY (`id_nota`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_theater_schedule` (`id_theater_schedule`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `point_request`
--
ALTER TABLE `point_request`
  ADD PRIMARY KEY (`id_request`),
  ADD KEY `id_member` (`id_member`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_schedule`),
  ADD KEY `id_film` (`id_film`),
  ADD KEY `id_session` (`id_session`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`id_session`);

--
-- Indexes for table `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`id_theater`);

--
-- Indexes for table `theater_schedule`
--
ALTER TABLE `theater_schedule`
  ADD PRIMARY KEY (`id_theater_schedule`),
  ADD KEY `id_theater` (`id_theater`),
  ADD KEY `id_schedule` (`id_schedule`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `d_movie`
--
ALTER TABLE `d_movie`
  MODIFY `id_dmovie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `film_genre`
--
ALTER TABLE `film_genre`
  MODIFY `film_genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `h_movie`
--
ALTER TABLE `h_movie`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `point_request`
--
ALTER TABLE `point_request`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `theater`
--
ALTER TABLE `theater`
  MODIFY `id_theater` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `theater_schedule`
--
ALTER TABLE `theater_schedule`
  MODIFY `id_theater_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
