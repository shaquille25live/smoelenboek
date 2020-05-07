-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 07 mei 2020 om 19:00
-- Serverversie: 5.7.9
-- PHP-versie: 7.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smoelenboek`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contacten`
--

DROP TABLE IF EXISTS `contacten`;
CREATE TABLE IF NOT EXISTS `contacten` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gebruikersnaam` varchar(30) CHARACTER SET utf8 NOT NULL,
  `wachtwoord` varchar(30) CHARACTER SET utf8 NOT NULL,
  `voorletter` varchar(3) CHARACTER SET utf8 NOT NULL,
  `tussenvoegsel` varchar(20) CHARACTER SET utf8 NOT NULL,
  `achternaam` varchar(30) CHARACTER SET utf8 NOT NULL,
  `email` varchar(50) CHARACTER SET utf8 NOT NULL DEFAULT 'qwerty',
  `telnr` varchar(10) DEFAULT NULL,
  `foto` varchar(40) CHARACTER SET utf8 NOT NULL DEFAULT 'default.jpg',
  `recht` enum('medewerker','secretaresse','directeur','leerling') CHARACTER SET utf8 NOT NULL DEFAULT 'medewerker',
  `afdelings_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `gebruikersnaam` (`gebruikersnaam`),
  UNIQUE KEY `gebruikersnaam_2` (`gebruikersnaam`),
  KEY `afdelings_id` (`afdelings_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `contacten`
--

INSERT INTO `contacten` (`id`, `gebruikersnaam`, `wachtwoord`, `voorletter`, `tussenvoegsel`, `achternaam`, `email`, `telnr`, `foto`, `recht`, `afdelings_id`) VALUES
(17, 'jjong', 'qwerty', 'J', 'de', 'Jong', 'j.de.jong@mondriaanict.nl', NULL, 'dejong.jpg', 'medewerker', 1),
(19, 'gjstelt', 'qwerty', 'GJ', '', 'Steltenpool', 'YCNEXT@youngcapital.nl', NULL, 'gertjan.jpg', 'directeur', NULL),
(20, 'cbertels', 'qwerty', 'C', '', 'Bertels', 'c.bertels@mondriaanict.nl', NULL, '459eeae4e5b27d0b1b09fbf8e6d0caa5.jpg', 'secretaresse', NULL),
(35, 'jordy', 'qwerty', 'J', '', 'Voorham', 'jordy@hotmail.com', '0612345678', '4c34b4d88ca8b48de426138e522a0e88.jpg', 'leerling', NULL),
(36, 'shaquille', 'qwerty', 's', '', 'Sewbaransingh', 'shaquille@YC.nl', '0612345678', 'd46294a194f225aec83d58030de675ee.png', 'leerling', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klassen`
--

DROP TABLE IF EXISTS `klassen`;
CREATE TABLE IF NOT EXISTS `klassen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `naam` varchar(30) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `mentor_id` (`mentor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klassen`
--

INSERT INTO `klassen` (`id`, `naam`, `mentor_id`) VALUES
(1, '1A', 1),
(2, '2A', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `personen`
--

DROP TABLE IF EXISTS `personen`;
CREATE TABLE IF NOT EXISTS `personen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `voornaam` varchar(30) NOT NULL,
  `tussenvoegsel` varchar(30) DEFAULT NULL,
  `achternaam` varchar(30) NOT NULL,
  `gebruikersnaam` varchar(30) NOT NULL,
  `wachtwoord` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefoonnummer` varchar(15) NOT NULL,
  `foto` varchar(30) NOT NULL DEFAULT 'default.jpg',
  `opmerkingen` text,
  `adres` varchar(30) DEFAULT NULL,
  `plaats` varchar(30) DEFAULT NULL,
  `klas_id` int(11) DEFAULT NULL,
  `recht` enum('leerling','docent','directeur','') NOT NULL DEFAULT 'leerling',
  PRIMARY KEY (`id`),
  KEY `klas_id` (`klas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `personen`
--

INSERT INTO `personen` (`id`, `voornaam`, `tussenvoegsel`, `achternaam`, `gebruikersnaam`, `wachtwoord`, `email`, `telefoonnummer`, `foto`, `opmerkingen`, `adres`, `plaats`, `klas_id`, `recht`) VALUES
(1, 'Shaquille', NULL, 'Sewbaransingh', 'ssewbaransingh', '12345', '302644142@stude', '06123645687', 'default.jpg', NULL, 'lollaan 69', 'den haag', NULL, 'docent'),
(5, 'Selena', NULL, 'Kececci', 'selena', 'qwerty', 'selena@YC.nl', '0612345678', 'selena.jpg', NULL, 'ametalyweg 12', 'den haag', 1, 'leerling'),
(6, 'Reinier', NULL, 'Dekker', 'reinier', 'qwerty', 'reinier@YC.nl', '0612345678', 'reinier.jpg', NULL, 'kattenstraat 95', 'Zaltbommel', 1, 'leerling'),
(7, 'Dario', NULL, 'Bel', 'dario', 'qwerty', 'Dario@YC.nl', '0612345678', 'dario.jpg', NULL, 'skipweg 420', 'Lisse', 1, 'leerling'),
(8, 'Jordy', NULL, 'Voorham', 'jordy', 'qwerty', 'jordy@hotmail.com', '0612365466', 'jordy.jpg', NULL, 'laan van vrede 15', 'den haag', 1, 'leerling'),
(9, 'Machelle', NULL, 'Bakker', 'machelle', 'qwerty', 'machelle@YC.nl', '06132455678', 'machelle.jpg', NULL, 'rubystraat 23', 'Haarlem', 2, 'leerling'),
(10, 'Melissa', NULL, 'Cejas', 'melissa', 'qwerty', 'melissa@YC.nl', '0612345678', 'melissa.jpg', NULL, 'zangereslaan 35', 'Velsen-Noord', 2, 'leerling'),
(11, 'Pim', NULL, 'Ritmijer', 'pim', 'qwerty', 'pim@YC.nl', '0612345678', 'pim.jpg', NULL, 'delfsteweg 933', 'Delft', 2, 'leerling'),
(12, 'Younes', NULL, 'Dian', 'younes', 'qwerty', 'younes@yc.nl', '0613245687', 'younes.jpg', NULL, 'teambadrweg 1', 'Veenendaal', 2, 'leerling'),
(13, 'Ruben', 'van den ', 'Brule', 'ruben', 'qwerty', 'ruben@YC.nl', '0698765432', 'default.jpg', NULL, 'rubenslaan 33', 'Zaltbommel', 2, 'leerling');

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `klassen`
--
ALTER TABLE `klassen`
  ADD CONSTRAINT `klassen_ibfk_1` FOREIGN KEY (`mentor_id`) REFERENCES `personen` (`id`);

--
-- Beperkingen voor tabel `personen`
--
ALTER TABLE `personen`
  ADD CONSTRAINT `personen_ibfk_1` FOREIGN KEY (`klas_id`) REFERENCES `klassen` (`id`) ON DELETE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
