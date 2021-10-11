-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 20. Jul 2021 um 12:02
-- Server-Version: 10.4.17-MariaDB
-- PHP-Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `zutrittskontrolle`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zutrittskontrolle`
--

CREATE TABLE `zutrittskontrolle` (
  `id` int(11) NOT NULL,
  `nummer` double NOT NULL,
  `bezahlt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Daten für Tabelle `zutrittskontrolle`
--

INSERT INTO `zutrittskontrolle` (`id`, `nummer`, `bezahlt`) VALUES
(1,750920000700347,1),
(2,580920000700616,1),
(3,660920000700012,1),
(4,200920000700501,1),
(5,610920000700287,1),
(6,330920000100010,1),
(7,310920000100012,1),
(8,801122333700006,1),
(9,841122333700002,1),
(10,851122333700001,1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `zutrittskontrolle`
--
ALTER TABLE `zutrittskontrolle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `zutrittskontrolle`
--
ALTER TABLE `zutrittskontrolle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
