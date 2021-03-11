-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2021 at 11:29 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

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
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `message_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `voornaam` varchar(64) NOT NULL,
  `achternaam` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `bericht` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`message_id`, `account_id`, `voornaam`, `achternaam`, `email`, `bericht`) VALUES
(1, 0, 'Dylan', 'Worseling', 'dylan99@quicknet.nl', 'jemoederhahahahahahagottemxdddddddddddddddddddddddddddddd'),
(2, 0, 'Dyloe', 'Worstelaar', 'dylan99@quicknet.nl', 'qwpienfwoleinfghwp;oiejfp;woejfp;woejf'),
(3, 0, 'Dylan', 'Worseling', 'dylan99@quicknet.nl', 'xfjgnvsodnfvgosledanfvgosledngefvlosengfsujlikejdnegf');

-- --------------------------------------------------------

--
-- Table structure for table `login`
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
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `email`, `activation_code`, `activation_status`, `forgot_password_code`, `forgot_password_time`) VALUES
(7, 'haha', 'hihi', 'hoho', '', 0, '', '0000-00-00 00:00:00.000000'),
(46, 'qwerty', '$2y$10$PfH8frhTfTHsjsdRsytMze3Gk75YeZ/mAeSA5IULpN0LdnVfEYQWu', 'dylan99@quicknet.nl', '', 1, '$2y$10$KG9jZvg7Va/enFAM8WFe/uEGqom0K58pAJYzcxjLS09Bnbg3MOYrC', '2021-03-11 09:52:26.000000');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `ID` int(11) NOT NULL,
  `MedicineName` varchar(50) NOT NULL,
  `MedicineDes` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`ID`, `MedicineName`, `MedicineDes`) VALUES
(0, 'Paracetemol', 'Pijnstiller.'),
(0, 'Melathonine', 'Lekker slapen.'),
(0, 'Ritalin', 'ADHD behandeling.'),
(0, 'THC', 'Anti depressie.');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `ID` int(11) NOT NULL,
  `NewsName` varchar(50) NOT NULL,
  `NewsDes` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`ID`, `NewsName`, `NewsDes`) VALUES
(1, 'Onze website is vernieuwd!', '<a href=\"nieuwe-site.php\">Link</a>'),
(2, 'Wij gaan bijna onze deuren openen.', '<a href=\"nieuwe.php\">Link</a>');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
