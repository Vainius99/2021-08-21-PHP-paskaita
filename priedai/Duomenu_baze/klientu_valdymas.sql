-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 04, 2021 at 12:58 PM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klientu_valdymas`
--

-- --------------------------------------------------------

--
-- Table structure for table `imones`
--

DROP TABLE IF EXISTS `imones`;
CREATE TABLE IF NOT EXISTS `imones` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `pavadinimas` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  `tipas_id` int(4) NOT NULL,
  `aprasymas` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `imones`
--

INSERT INTO `imones` (`ID`, `pavadinimas`, `tipas_id`, `aprasymas`) VALUES
(1, 'Skrajojantis Brokolis', 1, 'Technologijos'),
(2, 'Greita Sraige', 3, 'Maisto produktai'),
(3, 'Vyrai Juodais Triusikais', 2, 'Apranga'),
(4, 'Girtas Vairas', 2, 'Vairavimo Paslaugos'),
(5, 'Tu ir As Mes Kartu', 3, 'Socialiniai tinklai'),
(6, 'Ismanusis Grieblys', 3, 'Zemes ukio Technologijos'),
(7, 'Antanas ir draugai', 2, 'Draudimo Paslaugos'),
(8, 'Sviesa Tunelio Gale', 1, 'Laidojimo paslaugos'),
(9, 'Galuniu Kramtytojai', 1, 'Naminiai Gyvunai'),
(10, 'El Wagentosh', 3, 'Automobiliai'),
(11, 'Penkta koja', 1, 'Ortopedija');

-- --------------------------------------------------------

--
-- Table structure for table `imones_tipas`
--

DROP TABLE IF EXISTS `imones_tipas`;
CREATE TABLE IF NOT EXISTS `imones_tipas` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `pavadinimas` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  `aprasymas` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `imones_tipas`
--

INSERT INTO `imones_tipas` (`ID`, `pavadinimas`, `aprasymas`) VALUES
(1, 'MB', 'Mazoji bendrija'),
(2, 'UAB', 'Uzdaroji Akcine Bendrove'),
(3, 'AB', 'Akcine Bendrove');

-- --------------------------------------------------------

--
-- Table structure for table `klientai`
--

DROP TABLE IF EXISTS `klientai`;
CREATE TABLE IF NOT EXISTS `klientai` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `vardas` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  `pavarde` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  `teises_id` int(4) NOT NULL,
  `aprasymas` text COLLATE utf8_lithuanian_ci NOT NULL,
  `imones_id` int(120) NOT NULL,
  `pridejimo_data` date NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `klientai`
--

INSERT INTO `klientai` (`ID`, `vardas`, `pavarde`, `teises_id`, `aprasymas`, `imones_id`, `pridejimo_data`) VALUES
(43, 'vardas0', 'pavarde0', 3, 'nera', 2, '2021-08-27'),
(4, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(5, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(6, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(7, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(8, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(9, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(10, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(11, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(12, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(13, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(14, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(15, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(16, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(17, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(18, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(19, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(20, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(21, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(22, 'vardas2', 'pavarde2', 1, 'nera', 1, '2021-08-27'),
(23, 'vardas2', 'pavarde2', 2, 'nera', 1, '2021-08-27'),
(24, 'vardas2', 'pavarde2', 5, 'nera', 3, '2021-08-27'),
(25, 'vardas2', 'pavarde2', 1, 'nera', 5, '2021-08-27'),
(26, 'vardas2', 'pavarde2', 3, 'nera', 1, '2021-08-27'),
(27, 'vardas2', 'pavarde2', 4, 'nera', 10, '2021-08-27'),
(28, 'vardas2', 'pavarde2', 3, 'nera', 7, '2021-08-27'),
(29, 'vardas2', 'pavarde2', 2, 'nera', 3, '2021-08-27'),
(30, 'vardas2', 'pavarde2', 2, 'nera', 2, '2021-08-27'),
(31, 'vardas2', 'pavarde2', 2, 'nera', 3, '2021-08-27'),
(32, 'vardas2', 'pavarde2', 3, 'nera', 8, '2021-08-27'),
(33, 'vardas2', 'pavarde2', 1, 'nera', 6, '2021-08-27'),
(34, 'vardas2', 'pavarde2', 3, 'nera', 10, '2021-08-27'),
(35, 'vardas2', 'pavarde2', 2, 'nera', 9, '2021-08-27'),
(36, 'vardas2', 'pavarde2', 1, 'nera', 2, '2021-08-27'),
(37, 'vardas2', 'pavarde2', 5, 'nera', 6, '2021-08-27'),
(38, 'vardas2', 'pavarde2', 2, 'nera', 9, '2021-08-27'),
(39, 'vardas2', 'pavarde2', 5, 'nera', 8, '2021-08-27'),
(40, 'vardas2', 'pavarde2', 1, 'nera', 6, '2021-08-27'),
(41, 'vardas2', 'pavarde2', 2, 'nera', 3, '2021-08-27'),
(42, 'vardas2', 'pavarde2', 2, 'nera', 9, '2021-08-27'),
(44, 'vardas1', 'pavarde1', 2, 'nera', 8, '2021-08-27'),
(45, 'vardas2', 'pavarde2', 2, 'nera', 10, '2021-08-27'),
(46, 'vardas3', 'pavarde3', 1, 'nera', 10, '2021-08-27'),
(47, 'vardas4', 'pavarde4', 5, 'nera', 3, '2021-08-27'),
(48, 'vardas5', 'pavarde5', 2, 'nera', 5, '2021-08-27'),
(49, 'vardas6', 'pavarde6', 2, 'nera', 10, '2021-08-27'),
(50, 'vardas7', 'pavarde7', 4, 'nera', 6, '2021-08-27'),
(51, 'vardas8', 'pavarde8', 2, 'nera', 6, '2021-08-27'),
(52, 'vardas9', 'pavarde9', 2, 'nera', 6, '2021-08-27'),
(53, 'vardas10', 'pavarde10', 5, 'nera', 2, '2021-08-27'),
(54, 'vardas11', 'pavarde11', 3, 'nera', 8, '2021-08-27'),
(55, 'vardas12', 'pavarde12', 5, 'nera', 4, '2021-08-27'),
(56, 'vardas13', 'pavarde13', 2, 'nera', 5, '2021-08-27'),
(63, 'test12', 'test12', 1, 'test12', 1, '2021-08-31'),
(64, 'test3', 'test3', 1, 'test3', 1, '2021-08-31'),
(69, 'test', 'test', 1, '<p>xsxsx</p>', 1, '2021-09-04');

-- --------------------------------------------------------

--
-- Table structure for table `klientai_rikiavimas`
--

DROP TABLE IF EXISTS `klientai_rikiavimas`;
CREATE TABLE IF NOT EXISTS `klientai_rikiavimas` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `rikiavimo_pavadinimas` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  `rikiavimo_stulpelis` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `klientai_rikiavimas`
--

INSERT INTO `klientai_rikiavimas` (`ID`, `rikiavimo_pavadinimas`, `rikiavimo_stulpelis`) VALUES
(1, 'Vardas', 'klientai.vardas'),
(2, 'Pavarde', 'klientai.pavarde'),
(3, 'Teises', 'klientai_teises.pavadinimas');

-- --------------------------------------------------------

--
-- Table structure for table `klientai_teises`
--

DROP TABLE IF EXISTS `klientai_teises`;
CREATE TABLE IF NOT EXISTS `klientai_teises` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `pavadinimas` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  `reiksme` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `klientai_teises`
--

INSERT INTO `klientai_teises` (`ID`, `pavadinimas`, `reiksme`) VALUES
(1, 'Naujas klientas', '1'),
(2, 'Pastovus klientas', '2'),
(3, 'VIP klientas', '3'),
(4, 'Uzsienio klientas', '4'),
(5, 'Nemokus klientas', '5');

-- --------------------------------------------------------

--
-- Table structure for table `registracija`
--

DROP TABLE IF EXISTS `registracija`;
CREATE TABLE IF NOT EXISTS `registracija` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `pasirinkimas` int(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `registracija`
--

INSERT INTO `registracija` (`ID`, `pasirinkimas`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vartotojai`
--

DROP TABLE IF EXISTS `vartotojai`;
CREATE TABLE IF NOT EXISTS `vartotojai` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `vardas` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  `pavarde` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  `username` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  `teises_id` int(4) NOT NULL,
  `password` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  `registracijos_data` date NOT NULL,
  `paskutinis_prisijungimas` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `vartotojai`
--

INSERT INTO `vartotojai` (`ID`, `vardas`, `pavarde`, `username`, `teises_id`, `password`, `registracijos_data`, `paskutinis_prisijungimas`) VALUES
(1, 'vardas1', 'pavarde1', 'admin', 1, 'admin', '2021-08-27', '2021-09-04 15:52:06'),
(2, 'vardas2', 'pavarde2', 'vadyb', 2, 'vadyb', '2021-08-27', '2021-08-30 00:00:00'),
(3, 'vardas3', 'pavarde3', 'inspekt', 3, 'inspekt', '2021-08-27', '2021-08-27 00:00:00'),
(4, 'vardas4', 'pavarde4', 'admin_s', 4, 'admin_s', '2021-08-27', '2021-08-27 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `vartotojai_teises`
--

DROP TABLE IF EXISTS `vartotojai_teises`;
CREATE TABLE IF NOT EXISTS `vartotojai_teises` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `pavadinimas` varchar(120) COLLATE utf8_lithuanian_ci NOT NULL,
  `reiksme` int(4) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;

--
-- Dumping data for table `vartotojai_teises`
--

INSERT INTO `vartotojai_teises` (`ID`, `pavadinimas`, `reiksme`) VALUES
(1, 'Adminas', 1),
(2, 'Vadybininkas', 2),
(3, 'Inspektorius', 3),
(4, 'Sistemos adminas', 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
