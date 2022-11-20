-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2022 at 01:59 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

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
DROP DATABASE IF EXISTS `bioskop_xx2`;
CREATE DATABASE IF NOT EXISTS `bioskop_xx2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bioskop_xx2`;

-- --------------------------------------------------------

--
-- Table structure for table `d_movie`
--

CREATE TABLE `d_movie` (
  `id_dmovie` int(11) NOT NULL,
  `id_nota` int(11) DEFAULT NULL,
  `seat_i` int(11) DEFAULT NULL,
  `seat_j` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

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
(4, 'Yuru Camp the Movie', 'The anime film will feature the familiar characters from the franchise now grown up, and reuniting to construct a campsite.', 'placeholder.jpg', 'https://www.youtube.com/watch?v=1GnPdVAJm5U', '2022-11-02', '2022-11-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `film_genre`
--

CREATE TABLE `film_genre` (
  `film_genre_id` int(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  `id_film` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film_genre`
--

INSERT INTO `film_genre` (`film_genre_id`, `id_genre`, `id_film`) VALUES
(1, 3, 4),
(2, 4, 4),
(3, 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

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

CREATE TABLE `h_movie` (
  `id_nota` int(11) NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `id_theater` int(11) DEFAULT NULL,
  `id_schedule` int(11) DEFAULT NULL,
  `buy_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

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
(1, 'Budi', 'budi123@example.com', 'budi', '123', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `point_request`
--

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
(2, 4, '2022-11-01', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

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

CREATE TABLE `theater` (
  `id_theater` int(11) NOT NULL,
  `nama_theater` varchar(100) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `id_theater` (`id_theater`),
  ADD KEY `id_schedule` (`id_schedule`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `d_movie`
--
ALTER TABLE `d_movie`
  MODIFY `id_dmovie` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `film_genre`
--
ALTER TABLE `film_genre`
  MODIFY `film_genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `h_movie`
--
ALTER TABLE `h_movie`
  MODIFY `id_nota` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_schedule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `theater`
--
ALTER TABLE `theater`
  MODIFY `id_theater` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `h_movie_ibfk_2` FOREIGN KEY (`id_theater`) REFERENCES `theater` (`id_theater`),
  ADD CONSTRAINT `h_movie_ibfk_3` FOREIGN KEY (`id_schedule`) REFERENCES `schedule` (`id_schedule`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
