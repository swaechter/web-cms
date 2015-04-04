-- phpMyAdmin SQL Dump
-- version 4.2.12deb2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 04, 2015 at 07:56 PM
-- Server version: 5.5.42-1
-- PHP Version: 5.6.7-1

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
-- Table structure for table `Image`
--

CREATE TABLE IF NOT EXISTS `Image` (
`id` int(11) NOT NULL,
  `filename` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(15) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `MailConfiguration`
--

CREATE TABLE IF NOT EXISTS `MailConfiguration` (
`id` int(11) NOT NULL,
  `smtpserver` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `port` int(11) NOT NULL,
  `sender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `MailConfiguration`
--

INSERT INTO `MailConfiguration` (`id`, `smtpserver`, `port`, `sender`, `username`, `password`) VALUES
(1, 'smtp.foobar.com', 587, 'support@foobar.com', 'foobar', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `Menu`
--

CREATE TABLE IF NOT EXISTS `Menu` (
`id` int(11) NOT NULL,
  `parentmenu_id` int(11) DEFAULT NULL,
  `displayname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Menu`
--

INSERT INTO `Menu` (`id`, `parentmenu_id`, `displayname`, `link`) VALUES
(1, NULL, 'Home', '/text/show/1'),
(2, NULL, 'Über uns', '/text/show/2'),
(3, NULL, 'News', '/news'),
(4, NULL, 'Dienstleistungen', ''),
(5, 4, 'Dienstleistung 1', '/text/show/3'),
(6, 4, 'Dienstleistung 2', '/text/show/4'),
(7, 4, 'Dienstleistung 3', '/text/show/5'),
(8, NULL, 'Produkte', ''),
(9, 8, 'Produkt 1', '/text/show/6'),
(10, 8, 'Produkt 2', '/text/show/7'),
(11, 8, 'Produkt 3', '/text/show/8'),
(12, 8, 'Produkt 4', '/text/show/9'),
(13, 8, 'Produkt 5', '/text/show/10'),
(14, 8, 'Produkt 6', '/text/show/11'),
(15, NULL, 'Partner & Kunden', '/text/show/12'),
(16, NULL, 'Referenzen', '/text/show/13'),
(17, NULL, 'Support', '/text/show/14'),
(18, NULL, 'Gallery', '/gallery'),
(19, NULL, 'Kontakt', '/contact');

-- --------------------------------------------------------

--
-- Table structure for table `News`
--

CREATE TABLE IF NOT EXISTS `News` (
`id` int(11) NOT NULL,
  `date` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `News`
--

INSERT INTO `News` (`id`, `date`, `title`, `text`) VALUES
(1, '04.04.2015 13:24:30', 'News 1', 'News 1'),
(2, '04.04.2015 13:24:38', 'News 2', 'News 2');

-- --------------------------------------------------------

--
-- Table structure for table `Resource`
--

CREATE TABLE IF NOT EXISTS `Resource` (
`id` int(11) NOT NULL,
  `filename` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Text`
--

CREATE TABLE IF NOT EXISTS `Text` (
`id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `Text`
--

INSERT INTO `Text` (`id`, `title`, `text`) VALUES
(1, 'Home', 'Home'),
(2, 'Über uns', 'Über uns'),
(3, 'Dienstleistung 1', 'Dienstleistung 1'),
(4, 'Dienstleistung 2', 'Dienstleistung 2'),
(5, 'Dienstleistung 3', 'Dienstleistung 3'),
(6, 'Produkt 1', 'Produkt 1'),
(7, 'Produkt 2', 'Produkt 2'),
(8, 'Produkt 3', 'Produkt 3'),
(9, 'Produkt 4', 'Produkt 4'),
(10, 'Produkt 5', 'Produkt 5'),
(11, 'Produkt 6', 'Produkt 6'),
(12, 'Partner & Kunden', 'Partner & Kunden'),
(13, 'Referenzen', 'Referenzen'),
(14, 'Support', 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE IF NOT EXISTS `User` (
`id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `name`, `email`, `password`) VALUES
(1, 'Simon Wächter', 'waechter.simon@gmail.com', 'ba3253876aed6bc22d4a6ff53d8406c6ad864195ed144ab5c87621b6c233b548baeae6956df346ec8c17f5ea10f35ee3cbc514797ed7ddd3145464e2a0bab413');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Image`
--
ALTER TABLE `Image`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `MailConfiguration`
--
ALTER TABLE `MailConfiguration`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Menu`
--
ALTER TABLE `Menu`
 ADD PRIMARY KEY (`id`), ADD KEY `IDX_DD3795AD7AF7CD57` (`parentmenu_id`);

--
-- Indexes for table `News`
--
ALTER TABLE `News`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Resource`
--
ALTER TABLE `Resource`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Text`
--
ALTER TABLE `Text`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Image`
--
ALTER TABLE `Image`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `MailConfiguration`
--
ALTER TABLE `MailConfiguration`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Menu`
--
ALTER TABLE `Menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `News`
--
ALTER TABLE `News`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Resource`
--
ALTER TABLE `Resource`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Text`
--
ALTER TABLE `Text`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
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
