-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2015 at 04:12 PM
-- Server version: 5.5.42-1
-- PHP Version: 5.6.6-2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `webcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `Menu`
--

CREATE TABLE IF NOT EXISTS `Menu` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parentmenu_id` int(11) DEFAULT NULL,
  `displayname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Menu`
--

INSERT INTO `Menu` (`id`, `name`, `parentmenu_id`, `displayname`, `link`, `position`) VALUES
(1, 'text', NULL, 'Text', 'index.php?controller=text', 1),
(2, 'news', NULL, 'News', 'index.php?controller=news', 1),
(3, 'gallery', NULL, 'Gallery', 'index.php?controller=gallery', 1),
(4, 'contact', NULL, 'Contact', 'index.php?controller=contact', 1),
(5, 'admin', NULL, 'Admin', 'index.php?controller=admin', 4);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
`id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `email`, `password`, `name`) VALUES
(1, 'waechter.simon@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413', 'Simon Wächter');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Menu`
--
ALTER TABLE `Menu`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_DD3795AD7AF7CD57` (`parentmenu_id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Menu`
--
ALTER TABLE `Menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Menu`
--
ALTER TABLE `Menu`
ADD CONSTRAINT `FK_DD3795AD7AF7CD57` FOREIGN KEY (`parentmenu_id`) REFERENCES `Menu` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
