-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 15 feb 2016 kl 16:52
-- Serverversion: 5.5.46-0ubuntu0.14.04.2
-- PHP-version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `artportfolio`
--
CREATE DATABASE IF NOT EXISTS `artportfolio` DEFAULT CHARACTER SET utf8 COLLATE utf8_swedish_ci;
USE `artportfolio`;

-- --------------------------------------------------------

--
-- Tabellstruktur `artcategory`
--

CREATE TABLE IF NOT EXISTS `artcategory` (
  `artcategory` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `artcatdesc` text COLLATE utf8_swedish_ci,
  PRIMARY KEY (`artcategory`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `artwork`
--

CREATE TABLE IF NOT EXISTS `artwork` (
  `workid` int(11) NOT NULL AUTO_INCREMENT,
  `worktitle` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `technique` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `worksize` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `workdescription` text COLLATE utf8_swedish_ci,
  `workimage` varchar(40) COLLATE utf8_swedish_ci DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `public` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`workid`),
  KEY `technique` (`technique`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `artwork`
--

INSERT INTO `artwork` (`workid`, `worktitle`, `technique`, `worksize`, `workdescription`, `workimage`, `year`, `public`) VALUES
(1, 'Corylus I', 'blyerts', '66 cm x 44,5 cm', 'Teckning i blyerts.', 'pencil_corylus_1_700.jpg', 2011, 1),
(2, 'Det är bara regn', 'tuschlavering', NULL, 'Förlaga till omslagsbild till boken "Det är bara regn".', 'painting_bararegn_700.jpg', 2011, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `contentid` int(11) NOT NULL AUTO_INCREMENT,
  `contenttype` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `url` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `contenttitle` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `contenttext` text COLLATE utf8_swedish_ci,
  `public` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`contentid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `content`
--

INSERT INTO `content` (`contentid`, `contenttype`, `url`, `contenttitle`, `contenttext`, `public`) VALUES
(1, 'page', 'contact', 'Kontakt', '<h2 >Kontakt</h2>\r\n<p>\r\n  <a href="mailto:maria@mariajonsson.com">maria@mariajonsson.com</a><br>\r\n  0736672278</p>\r\n\r\n\r\n<h2 >L&auml;nkar</h2>\r\n<p><a href="http://be.net/mariajonsson">behance / portfolio</a><br>\r\n  <a href="http://blognaif.tumblr.com/">blog na&iuml;f / min fotoblogg p&aring; tumblr.com</a>\r\n</p>\r\n<p><a href="http://www.facebook.com/Meaxylon"><img src="img/f_logo.jpg" width="20" height="20" border="0" alt="Meaxylon page" /></a>&nbsp;<a href="http://instagram.com/meaxylon"><img src="img/instagram-glyph.jpg" width="20" height="20" border="0" alt="Meaxylon instagram" /></a></p>', 1),
(2, 'page', 'index', 'Maria Jonsson', '<p>start</p>', 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `cvgroup`
--

CREATE TABLE IF NOT EXISTS `cvgroup` (
  `groupid` int(2) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `groupdescription` text COLLATE utf8_swedish_ci NOT NULL,
  `weight` int(2) DEFAULT NULL,
  PRIMARY KEY (`groupid`),
  UNIQUE KEY `groupname` (`groupname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=10 ;

--
-- Dumpning av Data i tabell `cvgroup`
--

INSERT INTO `cvgroup` (`groupid`, `groupname`, `groupdescription`, `weight`) VALUES
(1, 'Info', 'Maria Jonsson\r\nFödd 1980\r\nVerksam i Stockholm\r\n\r\nGodkänd för F-skatt\r\nMedlem i KRO', 1),
(2, 'Artist statement', 'Konstnär som arbetar i flera olika medium: fotografi, måleri, teckning, skulpturalt, rumsliga installationer. Motiven hämtas ofta från natur och naturvetenskap. Intresserar mig för mötet mellan det vetenskapliga och det poetiska, och mötet mellan inre, psykologiska rum och det fysiska rummet.', 2),
(3, 'Utbildning', '', 3),
(4, 'Ateljévistelser', '', 4),
(5, 'Offentlig konst ', '', 5),
(6, 'Separatutställningar ', '', 6),
(7, 'Utställningar ', '', 7),
(8, 'Illustration/böcker ', '', 8),
(9, 'Grafisk form', '', 9);

-- --------------------------------------------------------

--
-- Tabellstruktur `cvitem`
--

CREATE TABLE IF NOT EXISTS `cvitem` (
  `itemid` int(11) NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8_swedish_ci NOT NULL,
  `year1` int(4) DEFAULT NULL,
  `year2` int(4) DEFAULT NULL,
  `weight` int(2) DEFAULT NULL,
  `itemgroup` int(2) NOT NULL,
  PRIMARY KEY (`itemid`),
  KEY `itemgroup` (`itemgroup`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=5 ;

--
-- Dumpning av Data i tabell `cvitem`
--

INSERT INTO `cvitem` (`itemid`, `description`, `year1`, `year2`, `weight`, `itemgroup`) VALUES
(3, 'Ölands Konstskola, Ölands folkhögskola, Skogsby', 2005, 2008, NULL, 3),
(4, 'Konstvetenskap, Stockholms universitet', 2009, 2010, NULL, 3);

-- --------------------------------------------------------

--
-- Tabellstruktur `technique`
--

CREATE TABLE IF NOT EXISTS `technique` (
  `technique` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `description` text COLLATE utf8_swedish_ci,
  PRIMARY KEY (`technique`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `technique`
--

INSERT INTO `technique` (`technique`, `description`) VALUES
('akryl', NULL),
('akvarell', NULL),
('blandteknik', NULL),
('blyerts', NULL),
('olja', NULL),
('tusch', NULL),
('tuschlavering', NULL),
('tuschteckning', NULL);

-- --------------------------------------------------------

--
-- Tabellstruktur `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acronym` char(12) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `salt` int(11) NOT NULL,
  `userrole` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `acronym` (`acronym`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumpning av Data i tabell `user`
--

INSERT INTO `user` (`id`, `acronym`, `name`, `password`, `salt`, `userrole`) VALUES
(1, 'maria', 'Maria', '3d24be32a654161128d98f851c5ca733', 1434874722, 'admin');

-- --------------------------------------------------------

--
-- Tabellstruktur `workgroup`
--

CREATE TABLE IF NOT EXISTS `workgroup` (
  `wgroupid` int(11) NOT NULL AUTO_INCREMENT,
  `wgrouptitle` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `wgroupdescription` text COLLATE utf8_swedish_ci,
  `wgroupimage` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`wgroupid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci AUTO_INCREMENT=1 ;

--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `artwork`
--
ALTER TABLE `artwork`
  ADD CONSTRAINT `work2technique` FOREIGN KEY (`technique`) REFERENCES `technique` (`technique`) ON UPDATE CASCADE;

--
-- Restriktioner för tabell `cvitem`
--
ALTER TABLE `cvitem`
  ADD CONSTRAINT `group2item` FOREIGN KEY (`itemgroup`) REFERENCES `cvgroup` (`groupid`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
