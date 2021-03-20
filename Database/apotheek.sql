-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 18 mrt 2021 om 01:32
-- Serverversie: 10.4.17-MariaDB
-- PHP-versie: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotheek`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contact`
--

CREATE TABLE `contact` (
  `message_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `message` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `contact`
--

INSERT INTO `contact` (`message_id`, `account_id`, `firstname`, `lastname`, `email`, `message`) VALUES
(1, 0, 'Dylan', 'Worseling', 'dylan99@quicknet.nl', 'jemoederhahahahahahagottemxdddddddddddddddddddddddddddddd'),
(2, 0, 'Dylan', 'Worselinger', 'dylan99@quicknet.nl', 'wolufhcwoehcvnewp;sfjcvnes;dpjfhnvgp;dewrgvf'),
(3, 48, 'Dylonius', 'Worseling', 'dylan99@quicknet.nl', 'bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb'),
(4, 48, 'Dylonius', 'Worseling', 'dylan99@quicknet.nl', 'ooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo'),
(5, 48, 'Dylonius', 'Worseling', 'dylan99@quicknet.nl', 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq'),
(6, 48, 'Dylonius', 'Worseling', 'dylan99@quicknet.nl', 'wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww'),
(7, 48, 'Dylonius', 'Worseling', 'dylan99@quicknet.nl', 'ccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccccc'),
(8, 48, 'Dylonius', 'Worseling', 'dylan99@quicknet.nl', 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx'),
(9, 48, 'Dylonius', 'Worseling', 'dylan99@quicknet.nl', 'bbbbbbbbbbterihgnvbdernfghvhloegwfbhnvlodewbfghnvoldewgbfhnviloukjdew'),
(10, 0, 'dini', 'lazares', 'dylan99@quicknet.nl', 'qwertyuiopasdfghjklzxcvbnm');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `email` varchar(320) NOT NULL,
  `activation_code` varchar(250) NOT NULL,
  `activation_status` tinyint(1) NOT NULL DEFAULT 0,
  `forgot_password_code` varchar(250) NOT NULL,
  `forgot_password_time` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `login`
--

INSERT INTO `login` (`id`, `firstname`, `lastname`, `username`, `password`, `email`, `activation_code`, `activation_status`, `forgot_password_code`, `forgot_password_time`) VALUES
(7, '', '', 'haha', 'hihi', 'hoho', '', 0, '', '0000-00-00 00:00:00.000000'),
(37, '', '', 'ItzDylan', '$2y$10$GXG6kpOHTKhtUYlZLHIfv.7mcQFLWUpoMUxlPOWJN9Hh./93fxpPu', 'dylan-dylan99@hotmail.com', '7fe24e6a9870ba2a4eb6731c26bd416c', 1, '', '0000-00-00 00:00:00.000000'),
(48, 'Dylonius', 'Worseling', 'qwerty', '$2y$10$G911WhYUT8B/NNnDT0SLqel.8KaV/P5SaC/KKWvQBcHH/ab3YF6x6', 'dylan99@quicknet.nl', '', 1, '', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `medicines`
--

CREATE TABLE `medicines` (
  `ID` int(11) NOT NULL,
  `MedicineName` varchar(50) NOT NULL,
  `MedicineDes` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `medicines`
--

INSERT INTO `medicines` (`ID`, `MedicineName`, `MedicineDes`) VALUES
(0, 'Paracetemol', 'Pijnstiller.'),
(0, 'Melathonine', 'Lekker slapen.'),
(0, 'Ritalin', 'ADHD behandeling.'),
(0, 'THC', 'Anti depressie.');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `news`
--

CREATE TABLE `news` (
  `ID` int(11) NOT NULL,
  `NewsName` varchar(50) NOT NULL,
  `NewsDes` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `news`
--

INSERT INTO `news` (`ID`, `NewsName`, `NewsDes`) VALUES
(1, 'Onze website is vernieuwd!', '<a href=\"nieuwe-site.php\">Link</a>'),
(2, 'Wij gaan bijna onze deuren openen.', '<a href=\"nieuwe.php\">Link</a>'),
(3, 'Nieuw recept paracetamol in opmars', '<a href=\"nieuwe.php\">Link</a>');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexen voor tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `contact`
--
ALTER TABLE `contact`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;