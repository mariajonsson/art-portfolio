-- phpMyAdmin SQL Dump
-- version 4.4.13.1
-- http://www.phpmyadmin.net
--
-- Värd: localhost:3306
-- Tid vid skapande: 05 mars 2016 kl 00:00
-- Serverversion: 5.6.26
-- PHP-version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databas: `artportfolio`
--
CREATE DATABASE IF NOT EXISTS `artportfolio` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `artportfolio`;

-- --------------------------------------------------------

--
-- Tabellstruktur `artcategory`
--

CREATE TABLE IF NOT EXISTS `artcategory` (
  `artcategory` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `artcatdesc` text COLLATE utf8_swedish_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

-- --------------------------------------------------------

--
-- Tabellstruktur `artwork`
--

CREATE TABLE IF NOT EXISTS `artwork` (
  `workid` int(11) NOT NULL,
  `worktitle` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `technique` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `worksize` varchar(20) COLLATE utf8_swedish_ci DEFAULT NULL,
  `workdescription` text COLLATE utf8_swedish_ci,
  `workimage` varchar(40) COLLATE utf8_swedish_ci DEFAULT NULL,
  `year` int(4) DEFAULT NULL,
  `public` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `artwork`
--

INSERT INTO `artwork` (`workid`, `worktitle`, `technique`, `worksize`, `workdescription`, `workimage`, `year`, `public`) VALUES
(1, 'Corylus I', 'blyerts', '66 cm x 44,5 cm', 'Teckning i blyerts.', 'pencil_corylus_1_700.jpg', 2011, 1),
(2, 'Det är bara regn', 'tuschlavering', NULL, 'Förlaga till omslagsbild till boken "Det är bara regn".', 'painting_bararegn_700.jpg', 2011, 1),
(3, 'Corylus II', 'blyerts', '66 cm x 44,5 cm', 'Teckning i blyerts', 'pencil_corylus_2_700.jpg', 2011, 1),
(4, 'Forestial', 'blyerts', '42 cm x 14 cm', 'Blyertsteckningar i bok.', 'forestial-1-700.jpg', 2008, 1),
(5, 'Forestial', 'blyerts', '42 cm x 14 cm', 'Blyertsteckningar i bok.', 'forestial-1-700.jpg', 2008, 1),
(6, 'Undisclosed Inquiry', 'tuschlavering', NULL, 'Tuschlavering.', 'interior_1_700.jpg', 2014, 1),
(7, 'Undisclosed Inquiry', 'tuschlavering', NULL, 'Tuschlavering.', 'interior_2_700.jpg', 2014, 1);

-- --------------------------------------------------------

--
-- Tabellstruktur `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `contentid` int(11) NOT NULL,
  `contenttype` varchar(20) COLLATE utf8_swedish_ci NOT NULL,
  `url` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL,
  `contenttitle` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `contenttext` text COLLATE utf8_swedish_ci,
  `public` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

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
  `groupid` int(2) NOT NULL,
  `groupname` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `groupdescription` text COLLATE utf8_swedish_ci NOT NULL,
  `weight` int(2) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `cvgroup`
--

INSERT INTO `cvgroup` (`groupid`, `groupname`, `groupdescription`, `weight`) VALUES
(1, 'Info', 'Maria Jonsson\r\n<br>Född 1980\r\n<br>Verksam i Stockholm\r\n<br>\r\n<br>Godkänd för F-skatt\r\n<br>Medlem i KRO', 1),
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
  `itemid` int(11) NOT NULL,
  `description` text COLLATE utf8_swedish_ci NOT NULL,
  `year1` int(4) DEFAULT NULL,
  `year2` int(4) DEFAULT NULL,
  `weight` int(2) DEFAULT NULL,
  `itemgroup` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Dumpning av Data i tabell `cvitem`
--

INSERT INTO `cvitem` (`itemid`, `description`, `year1`, `year2`, `weight`, `itemgroup`) VALUES
(3, 'Ölands Konstskola, Ölands folkhögskola, Skogsby', 2005, 2008, NULL, 3),
(4, 'Konstvetenskap, Stockholms universitet', 2009, 2010, NULL, 3),
(5, 'Fil. mag. examen Filmvetenskap, Stockholms universitet', 2001, 2004, 3, 3),
(6, 'Ateljévistelse (stipendium), William Nordings ateljé, Vickleby', 2009, NULL, NULL, 4),
(7, 'Ateljéplats hos ateljékollektivet/-föreningen Detroit Sthlm, Stockholm', 2008, 2010, NULL, 4),
(8, 'Ateljéplats på Krukmakargatan 28, Stockholm', 2014, NULL, NULL, 4),
(9, 'Landstinget i Kalmar län, ett verk inköpt', 2013, NULL, NULL, 5),
(10, 'Oskarshamns sjukhus, konstnärlig gestaltning, uppdrag av Landstinget i Kalmar län', 2012, NULL, NULL, 5),
(11, 'Oskarshamns sjukhus, två verk inköpta av Landstinget i Kalmar län', 2012, NULL, NULL, 5),
(12, 'Mörbylånga kommunhus, ett verk inköpt av Mörbylånga kommun', 2008, NULL, NULL, 5),
(13, '"The Natural History of Trees", Teatergalleriet, Kalmar', 2011, NULL, NULL, 6),
(14, '"Where A Million Rhinestones Sit And Cry", Rotundan, Kalmar', 2011, NULL, NULL, 6),
(15, 'Vårsalongen, Liljevalchs konsthall, Stockholm', 2015, NULL, NULL, 7),
(16, 'Vårsalong, Ölands Museum Himmelsberga', 2014, NULL, NULL, 7),
(17, '”Skiftningar”, Gärdslösa Prästgård, Gärdslösa', 2013, NULL, NULL, 7),
(18, 'Teckningar, Källströmsgården, Påskallavik', 2012, NULL, NULL, 7),
(19, 'Galleri Hint of Mint, Stockholm', 2011, NULL, NULL, 7),
(20, 'Designarkivet, Nybro', 2010, NULL, NULL, 7),
(21, '"Backworlds", Detroit Gallery, Stockholm', 2010, NULL, NULL, 7),
(22, '”Future Shock”, Konstnatten, Lilla Frö', 2009, NULL, NULL, 7),
(23, 'Ölands museum Himmelsberga', 2008, NULL, NULL, 7),
(24, '"Veckans konstnär", Hamnmagasinet, Mönsterås Konstförening', 2008, NULL, NULL, 7),
(25, 'Ölands Konstskolas avgångsutställning, Oskarshamns Konsthall', 2008, NULL, NULL, 7),
(26, '"14:12", Ölands Konstskola i samarbete med Kalmar Konstmuseum', 2007, NULL, NULL, 7),
(27, 'Illustrationer, tidsskriften "Nio-Fem - tidsskrift om arbetsliv och profession" (Nr 2 2014, Nr 1 2015)', NULL, NULL, 1, 8),
(28, 'Omslag, boken "Det är bara regn", Alice Eggers, (Pequod Press, 2012)', NULL, NULL, 2, 8),
(29, 'Illustrationer, omslag, boken "Ett Eden i Vickleby" Gunilla Pravitz, (2010)', NULL, NULL, 3, 8),
(30, 'Illustrationer till tidningen People, (2009)', NULL, NULL, 4, 8),
(31, 'Logotyp till Yellow Danger Brewery', 2014, NULL, NULL, 9),
(32, 'Logotyp och grafisk profil till TAM-Arkiv', 2014, NULL, NULL, 9),
(33, 'Grafisk form till skivomslag, Preybird ”St. Preybird”', 2011, NULL, NULL, 9),
(34, 'Logotyp till Preybird, artist och musikproducent', 2010, NULL, NULL, 9);

-- --------------------------------------------------------

--
-- Tabellstruktur `technique`
--

CREATE TABLE IF NOT EXISTS `technique` (
  `technique` varchar(30) COLLATE utf8_swedish_ci NOT NULL,
  `description` text COLLATE utf8_swedish_ci
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
  `id` int(11) NOT NULL,
  `acronym` char(12) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `salt` int(11) NOT NULL,
  `userrole` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

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
  `wgroupid` int(11) NOT NULL,
  `wgrouptitle` varchar(40) COLLATE utf8_swedish_ci NOT NULL,
  `wgroupdescription` text COLLATE utf8_swedish_ci,
  `wgroupimage` varchar(30) COLLATE utf8_swedish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `artcategory`
--
ALTER TABLE `artcategory`
  ADD PRIMARY KEY (`artcategory`);

--
-- Index för tabell `artwork`
--
ALTER TABLE `artwork`
  ADD PRIMARY KEY (`workid`),
  ADD KEY `technique` (`technique`);

--
-- Index för tabell `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`contentid`);

--
-- Index för tabell `cvgroup`
--
ALTER TABLE `cvgroup`
  ADD PRIMARY KEY (`groupid`),
  ADD UNIQUE KEY `groupname` (`groupname`);

--
-- Index för tabell `cvitem`
--
ALTER TABLE `cvitem`
  ADD PRIMARY KEY (`itemid`),
  ADD KEY `itemgroup` (`itemgroup`);

--
-- Index för tabell `technique`
--
ALTER TABLE `technique`
  ADD PRIMARY KEY (`technique`);

--
-- Index för tabell `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `acronym` (`acronym`);

--
-- Index för tabell `workgroup`
--
ALTER TABLE `workgroup`
  ADD PRIMARY KEY (`wgroupid`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `artwork`
--
ALTER TABLE `artwork`
  MODIFY `workid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT för tabell `content`
--
ALTER TABLE `content`
  MODIFY `contentid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT för tabell `cvgroup`
--
ALTER TABLE `cvgroup`
  MODIFY `groupid` int(2) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT för tabell `cvitem`
--
ALTER TABLE `cvitem`
  MODIFY `itemid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT för tabell `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT för tabell `workgroup`
--
ALTER TABLE `workgroup`
  MODIFY `wgroupid` int(11) NOT NULL AUTO_INCREMENT;
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
