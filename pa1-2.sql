-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 12, 2021 at 06:38 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pa1-2`
--

-- --------------------------------------------------------

--
-- Table structure for table `Award`
--

CREATE TABLE `Award` (
  `mpid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `award_name` varchar(255) DEFAULT NULL,
  `award_year` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Genre`
--

CREATE TABLE `Genre` (
  `mpid` int(11) DEFAULT NULL,
  `genre_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Likes`
--

CREATE TABLE `Likes` (
  `uemail` varchar(255) NOT NULL,
  `mpid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE `Location` (
  `mpid` int(11) NOT NULL,
  `zip` int(11) NOT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `MotionPicture`
--

CREATE TABLE `MotionPicture` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `rating` float DEFAULT NULL,
  `production` varchar(255) DEFAULT NULL,
  `budget` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Movie`
--

CREATE TABLE `Movie` (
  `mpid` int(11) NOT NULL,
  `boxoffice_collection` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `People`
--

CREATE TABLE `People` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Role`
--

CREATE TABLE `Role` (
  `mpid` int(11) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `role_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Series`
--

CREATE TABLE `Series` (
  `mpid` int(11) NOT NULL,
  `season_count` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `User_table`
--

CREATE TABLE `User_table` (
  `email` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Award`
--
ALTER TABLE `Award`
  ADD KEY `mpid` (`mpid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `Genre`
--
ALTER TABLE `Genre`
  ADD KEY `mpid` (`mpid`);

--
-- Indexes for table `Likes`
--
ALTER TABLE `Likes`
  ADD PRIMARY KEY (`uemail`,`mpid`),
  ADD KEY `mpid` (`mpid`);

--
-- Indexes for table `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`mpid`,`zip`);

--
-- Indexes for table `MotionPicture`
--
ALTER TABLE `MotionPicture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Movie`
--
ALTER TABLE `Movie`
  ADD PRIMARY KEY (`mpid`);

--
-- Indexes for table `People`
--
ALTER TABLE `People`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Role`
--
ALTER TABLE `Role`
  ADD KEY `mpid` (`mpid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `Series`
--
ALTER TABLE `Series`
  ADD PRIMARY KEY (`mpid`);

--
-- Indexes for table `User_table`
--
ALTER TABLE `User_table`
  ADD PRIMARY KEY (`email`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Award`
--
ALTER TABLE `Award`
  ADD CONSTRAINT `award_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `MotionPicture` (`id`),
  ADD CONSTRAINT `award_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `People` (`id`);

--
-- Constraints for table `Genre`
--
ALTER TABLE `Genre`
  ADD CONSTRAINT `genre_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `MotionPicture` (`id`);

--
-- Constraints for table `Likes`
--
ALTER TABLE `Likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`uemail`) REFERENCES `User_table` (`email`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`mpid`) REFERENCES `MotionPicture` (`id`);

--
-- Constraints for table `Location`
--
ALTER TABLE `Location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `MotionPicture` (`id`);

--
-- Constraints for table `Movie`
--
ALTER TABLE `Movie`
  ADD CONSTRAINT `movie_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `MotionPicture` (`id`);

--
-- Constraints for table `Role`
--
ALTER TABLE `Role`
  ADD CONSTRAINT `role_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `MotionPicture` (`id`),
  ADD CONSTRAINT `role_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `People` (`id`);

--
-- Constraints for table `Series`
--
ALTER TABLE `Series`
  ADD CONSTRAINT `series_ibfk_1` FOREIGN KEY (`mpid`) REFERENCES `MotionPicture` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
