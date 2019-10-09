-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 17, 2019 at 06:05 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `busstation`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

DROP TABLE IF EXISTS `bus`;
CREATE TABLE IF NOT EXISTS `bus` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `startDestination` varchar(250) NOT NULL,
  `endDestination` varchar(250) NOT NULL,
  `price` int(100) NOT NULL,
  `busType` varchar(250) NOT NULL,
  `company` varchar(250) NOT NULL,
  `route` text NOT NULL,
  `maxSeat` int(100) NOT NULL,
  `availableSeat` int(100) NOT NULL,
  `departureTime` time NOT NULL,
  `arrivalTime` time NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`ID`, `startDestination`, `endDestination`, `price`, `busType`, `company`, `route`, `maxSeat`, `availableSeat`, `departureTime`, `arrivalTime`) VALUES
(1, 'Sarajevo', 'Mostar', 5, 'small', 'centrotrans', 'Zenica, Jajce', 30, 19, '17:00:00', '20:00:00'),
(5, 'Sarajevo', 'Zenica', 5, 'middle', 'gras', 'Grbavica, Malta', 50, 49, '13:00:00', '13:45:00'),
(6, 'Sarajevo', 'Bihac', 10, 'VIP', 'centrotrans', 'Jajce, Mostar', 45, 44, '15:00:00', '21:00:00'),
(7, 'Sarajevo', 'Konjic', 10, 'small', 'gras', 'Jajce', 100, 99, '18:00:00', '19:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

DROP TABLE IF EXISTS `register`;
CREATE TABLE IF NOT EXISTS `register` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `type` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`ID`, `email`, `name`, `password`, `type`) VALUES
(3, 'dzejlana.kovacevic@gmail.com', 'Dzejlana Kovacevic', '$2y$10$kjHhOkwdjX.GT95L.b3nwu/6vssI4wExjtai5je5ZCqkm51Vji5xC', 1),
(2, 'abu@gmail.com', 'abu', '$2y$10$0crSDP6MZgkzKg7ajMSTQeFZJntpv1mVsZ/X/xMndnooyf5cPB59q', 0),
(6, 'combe@hotmail.com', 'combe', '$2y$10$ehVZB02/vNSKZNDMYcOtKu6eRkNsAXOX/XH/T1okuFPTSNSjjM.Da', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reserved`
--

DROP TABLE IF EXISTS `reserved`;
CREATE TABLE IF NOT EXISTS `reserved` (
  `ID` int(100) NOT NULL AUTO_INCREMENT,
  `user` varchar(250) NOT NULL,
  `busID` int(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reserved`
--

INSERT INTO `reserved` (`ID`, `user`, `busID`) VALUES
(1, ' abu@gmail.com ', 1),
(3, ' abu@gmail.com ', 7),
(4, ' abu@gmail.com ', 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
