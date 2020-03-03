-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 03, 2020 alle 16:46
-- Versione del server: 10.4.10-MariaDB
-- Versione PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `photo`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `Id` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `foto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `venditore` varchar(255) NOT NULL,
  `prezzo` double NOT NULL,
  `categoria` int(11) NOT NULL,
  `tag1` varchar(255) NOT NULL,
  `tag2` varchar(255) NOT NULL,
  `tag3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `preferiti`
--

CREATE TABLE `preferiti` (
  `Id` int(11) NOT NULL,
  `cliente` varchar(255) NOT NULL,
  `foto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `foto` (`foto`);

--
-- Indici per le tabelle `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venditore` (`venditore`),
  ADD KEY `categoria` (`categoria`);

--
-- Indici per le tabelle `preferiti`
--
ALTER TABLE `preferiti`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `cliente` (`cliente`),
  ADD KEY `foto` (`foto`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `carrello`
--
ALTER TABLE `carrello`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `carrello_ibfk_2` FOREIGN KEY (`foto`) REFERENCES `foto` (`id`);

--
-- Limiti per la tabella `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`venditore`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `categorie` (`id`);

--
-- Limiti per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  ADD CONSTRAINT `preferiti_ibfk_1` FOREIGN KEY (`cliente`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `preferiti_ibfk_2` FOREIGN KEY (`foto`) REFERENCES `foto` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
