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
-- Table structure for table `movies`
--

DROP TABLE IF EXISTS `movies`;
CREATE TABLE IF NOT EXISTS `movies` (
  `title` varchar(100) NOT NULL,
  `synopsis` varchar(500) NOT NULL,
  `Auditorium` int(11) NOT NULL,
  `show_time_1` datetime NOT NULL,
  `seats_1` int(11) NOT NULL,
  `show_time_2` datetime DEFAULT NULL,
  `seats_2` int(11) DEFAULT NULL,
  `trailer` varchar(200) NOT NULL,
  `poster` varchar(50) NOT NULL,
  PRIMARY KEY (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`title`, `synopsis`, `Auditorium`, `show_time_1`, `seats_1`, `show_time_2`, `seats_2`, `trailer`, `poster`) VALUES
('Blacklist', 'A wanted fugitive mysteriously surrenders himself to the FBI and offers to help them in capturing deadly criminals. His sole condition is that he will work only with the new recruit, Elizabeth Keen.', 7, '2019-12-04 00:12:00', 100, '2019-12-04 12:12:00', 50, 'https://www.youtube.com/watch?v=JGBIimq1I3A', 'blacklist.jpg'),
('Spider Man', 'After being bitten by a genetically altered spider, nerdy high school student Peter Parker is endowed with amazing powers.', 2, '2020-01-02 00:00:00', 50, '2019-12-21 00:00:00', 50, 'https://youtu.be/TYMMOjBUPMM', 'spiderman.jpg'),
('Riverdale', 'After a teenager was murdered within the town of Riverdale, a group of teenagers, the jock Archie, the girl next door Betty, the new girl Veronica and the outcast Jughead try to unravel the evils lurking within this seemingly innocent town', 6, '2019-11-16 00:00:00', 50, '2019-11-22 00:00:00', 50, 'https://www.youtube.com/watch?v=HxtLlByaYTc', 'riverdale.jpg'),
('YOU', 'What would you do for love? For a brilliant male bookstore manager who crosses paths with an aspiring female writer, this question is put to the test. A charming yet awkward crush becomes something even more sinister when the writer becomes the manager\'s obsession.', 9, '2019-11-01 00:00:00', 50, '2020-02-15 00:00:00', 50, 'https://www.youtube.com/watch?v=9vIiNdYPudo', 'you.jpg'),
('Avatar', 'A paraplegic Marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.', 4, '2019-11-09 00:00:00', 50, '2019-11-30 00:00:00', 50, 'https://www.youtube.com/watch?v=6ziBFh3V1aM', 'avatar.jpg'),
('Baby Boss', 'Seven-year-old Tim gets jealous when his parents give all their attention to his little brother. Tim soon learns that the baby can talk and the two team up to foil the plans of the CEO of Puppy Co.', 11, '2019-12-14 00:00:00', 50, '2019-11-09 00:00:00', 50, 'https://www.youtube.com/watch?v=r8kE7rSzfQs', 'babyboss.jpg'),
('Joker', 'Forever alone in a crowd, failed comedian Arthur Fleck seeks connection as he walks the streets of Gotham City. Isolated, bullied and disregarded by society, Fleck begins a slow descent into madness as he transforms into the criminal mastermind known as the Joker.', 7, '2019-11-23 00:00:00', 50, '2019-11-30 00:00:00', 50, 'https://www.youtube.com/watch?v=-_DJEzZk2pc', 'joker.jpg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
