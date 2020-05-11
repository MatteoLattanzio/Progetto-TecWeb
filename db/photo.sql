-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2020 at 12:43 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photo`
--
CREATE DATABASE IF NOT EXISTS `photo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `photo`;

-- --------------------------------------------------------

--
-- Table structure for table `carrello`
--

CREATE TABLE `carrello` (
  `utente` varchar(255) NOT NULL,
  `foto` int(11) NOT NULL,
  `data` date NOT NULL,
  `stato` enum('in corso','concluso','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `carrello`
--

INSERT INTO `carrello` (`utente`, `foto`, `data`, `stato`) VALUES
('userBuy', 1, '2020-05-11', 'concluso');

-- --------------------------------------------------------

--
-- Table structure for table `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categorie`
--

INSERT INTO `categorie` (`id`, `nome`) VALUES
(1, 'Ritratti'),
(2, 'Paesaggi'),
(3, 'Animali'),
(4, 'Macro'),
(5, 'Piante');

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `venditore` varchar(255) NOT NULL,
  `prezzo` double NOT NULL,
  `stato` enum('in attesa','approvata','rifiutata','') NOT NULL,
  `categoria` int(11) NOT NULL,
  `data` date NOT NULL,
  `tag1` varchar(255) NOT NULL,
  `tag2` varchar(255) NOT NULL,
  `tag3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`id`, `titolo`, `venditore`, `prezzo`, `stato`, `categoria`, `data`, `tag1`, `tag2`, `tag3`) VALUES
(1, 'Venezia di notte', 'user', 20, 'approvata', 2, '2020-03-02', '', '', ''),
(2, 'Compleanno', 'user', 10, 'in attesa', 1, '2020-01-12', 'bambini', '', ''),
(3, 'Animali selvatici', 'user', 10, 'approvata', 3, '2018-02-04', 'fenicottero', 'zoo', ''),
(4, 'Casa sul lago', 'user', 15, 'approvata', 2, '2017-04-22', 'lago', 'acqua', 'legno');

-- --------------------------------------------------------

--
-- Table structure for table `messaggi`
--

CREATE TABLE `messaggi` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `oggetto` text NOT NULL,
  `testo` text NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messaggi`
--

INSERT INTO `messaggi` (`id`, `email`, `data`, `oggetto`, `testo`, `nome`, `cognome`) VALUES
(1, 'user@photostock.com', '0000-00-00', 'segnalazione utenti', 'swswsw', 'user', 'user'),
(2, 'user@photostock.com', '0000-00-00', 'segnalazione utenti', 'swswsw', 'user', 'user'),
(3, 'user@photostock.com', '0000-00-00', 'segnalazione utenti', 'swswsw', 'user', 'user'),
(9, 'user@photostock.com', '0000-00-00', 'problemi con un acquisto', 'hahahaha', 'user', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `piaciuti`
--

CREATE TABLE `piaciuti` (
  `foto` int(11) NOT NULL,
  `utente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `piaciuti`
--

INSERT INTO `piaciuti` (`foto`, `utente`) VALUES
(2, 'user'),
(3, 'userBuy'),
(4, 'user'),
(4, 'userBuy');

-- --------------------------------------------------------

--
-- Table structure for table `preferiti`
--

CREATE TABLE `preferiti` (
  `foto` int(11) NOT NULL,
  `utente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `preferiti`
--

INSERT INTO `preferiti` (`foto`, `utente`) VALUES
(3, 'userBuy');

-- --------------------------------------------------------

--
-- Table structure for table `utenti`
--

CREATE TABLE `utenti` (
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tipo` enum('user','admin','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utenti`
--

INSERT INTO `utenti` (`nome`, `cognome`, `data`, `indirizzo`, `username`, `password`, `email`, `tipo`) VALUES
('admin', 'admin', '1995-01-01', 'via amministratore', 'admin', 'admin', 'admin@photostock.com', 'admin'),
('user', 'user', '1997-11-30', 'via prova', 'user', 'user', 'user@photostock.com', 'user'),
('userBuy', 'userBuy', '1987-12-18', 'via acquisti', 'userBuy', 'buy', 'userBuy@photostock.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrello`
--
ALTER TABLE `carrello`
  ADD KEY `utente` (`utente`),
  ADD KEY `foto` (`foto`);

--
-- Indexes for table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venditore` (`venditore`),
  ADD KEY `categoria` (`categoria`);

--
-- Indexes for table `messaggi`
--
ALTER TABLE `messaggi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `piaciuti`
--
ALTER TABLE `piaciuti`
  ADD PRIMARY KEY (`foto`,`utente`),
  ADD KEY `foto` (`foto`),
  ADD KEY `utente` (`utente`);

--
-- Indexes for table `preferiti`
--
ALTER TABLE `preferiti`
  ADD PRIMARY KEY (`utente`,`foto`),
  ADD KEY `cliente` (`utente`),
  ADD KEY `foto` (`foto`);

--
-- Indexes for table `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `messaggi`
--
ALTER TABLE `messaggi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `carrello_ibfk_2` FOREIGN KEY (`foto`) REFERENCES `foto` (`id`);

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`venditore`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `categorie` (`id`);

--
-- Constraints for table `piaciuti`
--
ALTER TABLE `piaciuti`
  ADD CONSTRAINT `piaciuti_ibfk_1` FOREIGN KEY (`foto`) REFERENCES `foto` (`id`),
  ADD CONSTRAINT `piaciuti_ibfk_2` FOREIGN KEY (`utente`) REFERENCES `utenti` (`username`);

--
-- Constraints for table `preferiti`
--
ALTER TABLE `preferiti`
  ADD CONSTRAINT `preferiti_ibfk_2` FOREIGN KEY (`foto`) REFERENCES `foto` (`id`),
  ADD CONSTRAINT `preferiti_ibfk_3` FOREIGN KEY (`utente`) REFERENCES `utenti` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
