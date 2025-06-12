-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 12. Jun 2025 um 13:18
-- Server-Version: 10.4.28-MariaDB
-- PHP-Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `testdatabase`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `filmverlauf`
--

CREATE TABLE `filmverlauf` (
  `Benutzer` varchar(64) NOT NULL,
  `Film_Titel` varchar(64) NOT NULL,
  `Empfohlen_am` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `filmverlauf`
--

INSERT INTO `filmverlauf` (`Benutzer`, `Film_Titel`, `Empfohlen_am`) VALUES
('a', 'Die Go!Gos\r\n', '2025-06-11'),
('b', 'Die  Wilden Kerle\r\n', '2025-06-11'),
('c', 'National Treasure\r\n', '2025-06-11'),
('a', 'National Treasure\r\n', '2025-06-11'),
('b', 'Stardust', '2025-06-11'),
('c', 'Indiana Jones and the Last Crusade', '2025-06-11'),
('b', 'Okinawa no Kaze\r\n', '2025-06-11'),
('b', 'Okinawa: Sango no Uta\r\n', '2025-06-11'),
('a', 'Die Welle\r\n', '2025-06-12'),
('a', 'India\'s Daughter\r\n', '2025-06-12'),
('c', 'El Bar\r\n', '2025-06-12'),
('a', 'Der Räuber Hotzenplotz\r\n', '2025-06-12');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `testtable`
--

CREATE TABLE `testtable` (
  `name` varchar(32) NOT NULL,
  `passwort` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `testtable`
--

INSERT INTO `testtable` (`name`, `passwort`) VALUES
('a', '$2y$10$06R856oTVmmNlr0nySl95ue5kKBvUd001BsR4YO6ImTA8bTeuWpBy'),
('b', '$2y$10$JB/mVu7x0UJGNotb92N9pOOABjTurh1kIii5MRk.PMfakDLGjn2Uq'),
('c', '$2y$10$M9Gvdc2hHUdBf.wweh8wqu4VeuTJMtFB61HYPyFKrM/96crLKmiZ6');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
