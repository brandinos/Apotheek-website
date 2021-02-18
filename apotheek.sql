-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 16 feb 2021 om 13:56
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
-- Tabelstructuur voor tabel `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
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

    INSERT INTO `login` (`id`, `username`, `password`, `email`, `activation_code`, `activation_status`, `forgot_password_code`, `forgot_password_time`) VALUES
    (7, 'haha', 'hihi', 'hoho', '', 0, '', '0000-00-00 00:00:00.000000'),
    (37, 'ItzDylan', '$2y$10$GXG6kpOHTKhtUYlZLHIfv.7mcQFLWUpoMUxlPOWJN9Hh./93fxpPu', 'dylan-dylan99@hotmail.com', '7fe24e6a9870ba2a4eb6731c26bd416c', 1, '', '0000-00-00 00:00:00.000000'),
    (46, 'qwerty', '$2y$10$kqz/26Gc4KN4/itBYgcAyuBkLICoyZlKQZNxDSoymIyoCJk2euT8m', 'dylan99@quicknet.nl', '', 1, '', '0000-00-00 00:00:00.000000');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `login`
--
  ALTER TABLE `login`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `login`
--
  ALTER TABLE `login`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
  COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
