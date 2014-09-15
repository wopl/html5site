-- phpMyAdmin SQL Dump
-- version 3.3.7deb8
-- http://www.phpmyadmin.net
--
-- Host: wp057.webpack.hosteurope.de
-- Erstellungszeit: 15. September 2014 um 17:56
-- Server Version: 5.5.31
-- PHP-Version: 5.3.3-7+squeeze19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `db11197344-protrack`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `counter`
--

CREATE TABLE IF NOT EXISTS `counter` (
  `id` varchar(20) NOT NULL,
  `clicks` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `counter`
--

INSERT INTO `counter` (`id`, `clicks`) VALUES
('home', 71);
