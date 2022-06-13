-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 30, 2019 at 08:25 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mycinema`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

DROP TABLE IF EXISTS `booking`;
CREATE TABLE IF NOT EXISTS `booking` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_username` varchar(100) NOT NULL,
  `b_title` varchar(100) NOT NULL,
  `b_auditorium` int(11) NOT NULL,
  `b_show_time` datetime NOT NULL,
  `tickets` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`b_id`),
  KEY `b_username` (`b_username`),
  KEY `b_title` (`b_title`)
) ENGINE=MyISAM AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`b_id`, `b_username`, `b_title`, `b_auditorium`, `b_show_time`, `tickets`, `status`) VALUES
(129, 'user', 'Baby Boss', 11, '2019-12-14 00:00:00', 1, 'CANCELLED'),
(128, 'user', 'Avatar', 4, '2019-11-09 00:00:00', 1, 'CANCELLED'),
(127, 'user', 'Spider Man', 2, '2020-01-02 00:00:00', 1, 'CANCELLED'),
(126, 'user', 'Avatar', 4, '2019-11-09 00:00:00', 1, 'CANCELLED'),
(125, 'user', 'Blacklist', 7, '2019-12-04 12:12:00', 5, 'CANCELLED'),
(124, 'aminzo', 'Blacklist', 7, '2019-12-04 00:12:00', 1, 'CANCELLED'),
(123, 'aminzo', 'Riverdale', 6, '2019-11-16 00:00:00', 5, 'CANCELLED'),
(122, 'aminzo', 'Blacklist', 7, '2019-12-04 12:12:00', 5, 'CANCELLED');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
