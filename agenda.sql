-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2014 at 11:51 
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `agenda`
--
CREATE DATABASE IF NOT EXISTS `agenda` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `agenda`;

-- --------------------------------------------------------

--
-- Table structure for table `islamic_holydays`
--

DROP TABLE IF EXISTS `islamic_holydays`;
CREATE TABLE IF NOT EXISTS `islamic_holydays` (
  `date` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='islamic holydays list';

--
-- Dumping data for table `islamic_holydays`
--

INSERT INTO `islamic_holydays` (`date`, `name`) VALUES
(0, 'name'),
(101, '1 muharam'),
(110, 'aid Al-fitre'),
(1012, 'six chawal'),
(1203, 'aid almawlid anabawi');

-- --------------------------------------------------------

--
-- Table structure for table `national_holydays`
--

DROP TABLE IF EXISTS `national_holydays`;
CREATE TABLE IF NOT EXISTS `national_holydays` (
  `date` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='table contains holy days dates';

--
-- Dumping data for table `national_holydays`
--

INSERT INTO `national_holydays` (`date`, `name`) VALUES
(0, 'name'),
(101, 'Nouvle an'),
(105, 'Fête du travail'),
(611, 'Anniversaire de la marche verte'),
(1101, 'Anniversaire du manifeste de l''indépendance 1944'),
(1408, 'Journée de Oued Ed-Dahab'),
(1811, 'Fête de l''indépendance'),
(2008, 'Fête de la révolution du roi et du peuple 1953'),
(2108, 'Anniversaire de Mohammed VI'),
(3007, 'Fête du trône');

-- --------------------------------------------------------

--
-- Table structure for table `test_islamic`
--

DROP TABLE IF EXISTS `test_islamic`;
CREATE TABLE IF NOT EXISTS `test_islamic` (
  `date` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `test_national`
--

DROP TABLE IF EXISTS `test_national`;
CREATE TABLE IF NOT EXISTS `test_national` (
  `date` int(4) NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test_national`
--

INSERT INTO `test_national` (`date`, `name`) VALUES
(0, 'name'),
(105, 'jour ferier1'),
(304, 'jour ferier a'),
(502, 'jour ferier 2'),
(505, 'jour ferier1'),
(605, 'jour ferier1'),
(803, 'jour ferier3'),
(905, 'jour ferier1'),
(1703, 'jour ferier4'),
(1704, 'jour ferier b'),
(2203, 'jour ferier 5'),
(2304, 'jour ferier c'),
(2801, 'jour ferier1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(50) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `last_name` varchar(45) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `gender` enum('male','female','alien') DEFAULT NULL,
  `tel` varchar(45) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `signup_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `gender`, `tel`, `birthday`, `signup_date`) VALUES
('680420925384241', 'Yassine', 'Moustarham', NULL, 'male', NULL, '1990-09-04', '2014-09-07 20:03:23');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
