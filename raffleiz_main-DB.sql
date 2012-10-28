-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 08, 2012 at 02:29 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `raffleiz_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `rafflez_info`
--

CREATE TABLE IF NOT EXISTS `rafflez_info` (
  `ID` int(11) NOT NULL,
  `raffle_name` varchar(100) DEFAULT NULL,
  `#_participants` varchar(45) DEFAULT NULL,
  `timer` datetime NOT NULL,
  `date_created` datetime NOT NULL,
  `max_participants` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rafflez_info`
--

INSERT INTO `rafflez_info` (`ID`, `raffle_name`, `#_participants`, `timer`, `date_created`, `max_participants`) VALUES
(1, 'Demo', '1', '2012-07-07 00:00:00', '2012-07-06 20:53:00', '100');

-- --------------------------------------------------------

--
-- Table structure for table `raffle_joins`
--

CREATE TABLE IF NOT EXISTS `raffle_joins` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `1` varchar(45) DEFAULT NULL,
  `2` varchar(45) DEFAULT NULL,
  `3` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `raffle_joins`
--

INSERT INTO `raffle_joins` (`ID`, `1`, `2`, `3`) VALUES
(3, 'margarinic@gmail.com', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(300) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `Lname` varchar(45) DEFAULT NULL,
  `age` varchar(3) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `gender` varchar(8) DEFAULT NULL,
  `acess` varchar(45) DEFAULT NULL,
  `engagement` varchar(45) DEFAULT NULL,
  `rafflez` varchar(45) DEFAULT NULL,
  `sharing` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`ID`, `email`, `password`, `name`, `Lname`, `age`, `location`, `gender`, `acess`, `engagement`, `rafflez`, `sharing`) VALUES
(1, 'TheGuyRightThere', '08167ff9b2ed12c4b16967947136ee91', 'Admin', NULL, NULL, NULL, NULL, 'All', 'Full', NULL, 'N/A'),
(2, 'margarinic@gmail.com', '08167ff9b2ed12c4b16967947136ee91', 'Can', 'Margarini', '22', '32817', 'Male', NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
