-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 02, 2020 alle 12:28
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.4.1

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
CREATE DATABASE IF NOT EXISTS `photo` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `photo`;

-- --------------------------------------------------------

--
-- Struttura della tabella `carrello`
--

CREATE TABLE `carrello` (
  `utente` varchar(255) NOT NULL,
  `foto` int(11) NOT NULL,
  `data` date NOT NULL,
  `stato` enum('in corso','concluso') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `carrello`
--

INSERT INTO `carrello` (`utente`, `foto`, `data`, `stato`) VALUES
('user00', 11, '2020-06-02', 'concluso'),
('user00', 20, '2020-06-02', 'concluso'),
('user01', 12, '2020-06-02', 'in corso'),
('user01', 13, '2020-06-02', 'in corso');

-- --------------------------------------------------------

--
-- Struttura della tabella `categorie`
--

CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `categorie`
--

INSERT INTO `categorie` (`id`, `nome`) VALUES
(1, 'Ritratti'),
(2, 'Paesaggi'),
(3, 'Animali'),
(4, 'Macro'),
(5, 'Bianco e nero'),
(6, 'Still Life');

-- --------------------------------------------------------

--
-- Struttura della tabella `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `titolo` varchar(255) NOT NULL,
  `venditore` varchar(255) NOT NULL,
  `prezzo` double NOT NULL,
  `stato` enum('in attesa','approvata') NOT NULL,
  `categoria` int(11) NOT NULL,
  `data` date NOT NULL,
  `tag1` varchar(255) NOT NULL,
  `tag2` varchar(255) NOT NULL,
  `tag3` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `foto`
--

INSERT INTO `foto` (`id`, `titolo`, `venditore`, `prezzo`, `stato`, `categoria`, `data`, `tag1`, `tag2`, `tag3`) VALUES
(1, 'Il riposo del guerriero', 'user00', 15, 'approvata', 3, '2020-06-02', 'leone', 'savana', 'africa'),
(2, 'Innamorati', 'user00', 8, 'approvata', 3, '2020-06-02', 'pappagalli', 'inseparabili', ''),
(3, 'Singer', 'user00', 12, 'in attesa', 5, '2020-06-02', 'cantante', 'donna', ''),
(4, 'Braies con Fede', 'user00', 10, 'approvata', 2, '2020-06-02', 'lago', 'montagna', 'acqua'),
(5, 'Reflection', 'user00', 5, 'in attesa', 2, '2020-06-02', 'lago', 'montagna', 'riflessi'),
(6, 'Donna afgana', 'user01', 20, 'approvata', 5, '2020-06-02', 'burqa', 'madre', ''),
(7, 'Thinking', 'user01', 12, 'approvata', 2, '2020-06-02', 'lago', 'ponte', 'montagna'),
(8, 'Astro', 'user01', 12, 'approvata', 2, '2020-06-02', 'astrofotografia', 'stelle', 'notte'),
(9, 'Sopravvivenza', 'user01', 15, 'approvata', 4, '2020-06-02', 'ape', 'insetto', 'fiore'),
(10, 'Intenso', 'user01', 8, 'approvata', 1, '2020-06-02', 'donna', 'sguardo', 'occhi'),
(11, 'Cherries', 'user01', 11, 'approvata', 6, '2020-06-02', 'ciliegie', 'frutta', 'cibo'),
(12, 'Cadere e rialzarsi', 'user00', 20, 'approvata', 4, '2020-06-02', 'acqua', 'fiore', 'goccia'),
(13, 'Petaloso', 'user00', 6, 'approvata', 4, '2020-06-02', 'fiore', 'viola', ''),
(14, 'Estate tropicale', 'user00', 15, 'approvata', 6, '2020-06-02', 'ananas', 'frutta', 'giallo'),
(15, 'Idee', 'user00', 22, 'approvata', 6, '2020-06-02', 'lampadina', 'luce', 'buio'),
(16, 'Kerchak', 'user00', 10, 'in attesa', 3, '2020-06-02', 'gorilla', 'zoo', ''),
(17, 'Drop', 'user00', 7, 'approvata', 4, '2020-06-02', 'acqua', 'goccia', ''),
(18, 'Portrait', 'user00', 5, 'approvata', 1, '2020-06-02', 'donna', 'moda', ''),
(19, 'Husky', 'user01', 10, 'approvata', 3, '2020-06-02', 'cane', 'ghiaccio', 'neve'),
(20, 'Tornare a scuola', 'user01', 20, 'approvata', 6, '2020-06-02', 'frutta', 'mela', 'libri');

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi`
--

CREATE TABLE `messaggi` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `oggetto` enum('informazioni ordine','problemi con un acquisto','problemi con una vendita','segnalazione utenti','altro') NOT NULL,
  `testo` text NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `messaggi`
--

INSERT INTO `messaggi` (`id`, `email`, `data`, `oggetto`, `testo`, `nome`, `cognome`) VALUES
(1, 'user00@photostock.com', '2020-06-02', 'informazioni ordine', 'Buongiorno! Non mi risulta chiaro come accedere alle immagini acquistate. Grazie e buona giornata.', 'userName', 'userSurname'),
(2, 'user01@photostock.com', '2020-04-02', 'problemi con una vendita', 'Buongiorno! Vorrei alcune precisazioni su quanto guadagno posso ottenere dalle mie foto. Grazie.', 'userName', 'userSurname'),
(3, 'ombretta.gaggi@photostock.com', '2020-05-26', 'segnalazione utenti', 'Buongiorno, ho dimenticato la mia password e non riesco ad accedere al  mio account ombretta.gaggi. Potreste aiutarmi? Grazie!', 'Ombretta', 'Gaggi');

-- --------------------------------------------------------

--
-- Struttura della tabella `piaciuti`
--

CREATE TABLE `piaciuti` (
  `foto` int(11) NOT NULL,
  `utente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `piaciuti`
--

INSERT INTO `piaciuti` (`foto`, `utente`) VALUES
(1, 'user01'),
(7, 'user00'),
(8, 'user00'),
(13, 'user01'),
(18, 'user01'),
(19, 'user00');

-- --------------------------------------------------------

--
-- Struttura della tabella `preferiti`
--

CREATE TABLE `preferiti` (
  `foto` int(11) NOT NULL,
  `utente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `preferiti`
--

INSERT INTO `preferiti` (`foto`, `utente`) VALUES
(11, 'user00'),
(19, 'user00'),
(12, 'user01'),
(13, 'user01');

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `nome` varchar(255) NOT NULL,
  `cognome` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `indirizzo` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tipo` enum('user','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`nome`, `cognome`, `data`, `indirizzo`, `username`, `password`, `email`, `tipo`) VALUES
('admin', 'admin', '1997-11-30', 'via admin', 'admin', 'admin', 'admin@photostock.com', 'admin'),
('userName', 'userSurname', '1997-12-14', 'via user 1', 'user00', 'user00', 'user00@photostock.com', 'user'),
('userName', 'userSurname', '1956-01-25', 'via user 2', 'user01', 'user01', 'user01@photostock.com', 'user');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `carrello`
--
ALTER TABLE `carrello`
  ADD PRIMARY KEY (`utente`,`foto`),
  ADD KEY `utente` (`utente`),
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
-- Indici per le tabelle `messaggi`
--
ALTER TABLE `messaggi`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `piaciuti`
--
ALTER TABLE `piaciuti`
  ADD PRIMARY KEY (`foto`,`utente`),
  ADD KEY `foto` (`foto`),
  ADD KEY `utente` (`utente`);

--
-- Indici per le tabelle `preferiti`
--
ALTER TABLE `preferiti`
  ADD PRIMARY KEY (`utente`,`foto`),
  ADD KEY `cliente` (`utente`),
  ADD KEY `foto` (`foto`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT per la tabella `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la tabella `messaggi`
--
ALTER TABLE `messaggi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `carrello`
--
ALTER TABLE `carrello`
  ADD CONSTRAINT `carrello_ibfk_1` FOREIGN KEY (`utente`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `carrello_ibfk_2` FOREIGN KEY (`foto`) REFERENCES `foto` (`id`);

--
-- Limiti per la tabella `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`venditore`) REFERENCES `utenti` (`username`),
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`categoria`) REFERENCES `categorie` (`id`);

--
-- Limiti per la tabella `piaciuti`
--
ALTER TABLE `piaciuti`
  ADD CONSTRAINT `piaciuti_ibfk_1` FOREIGN KEY (`foto`) REFERENCES `foto` (`id`),
  ADD CONSTRAINT `piaciuti_ibfk_2` FOREIGN KEY (`utente`) REFERENCES `utenti` (`username`);

--
-- Limiti per la tabella `preferiti`
--
ALTER TABLE `preferiti`
  ADD CONSTRAINT `preferiti_ibfk_2` FOREIGN KEY (`foto`) REFERENCES `foto` (`id`),
  ADD CONSTRAINT `preferiti_ibfk_3` FOREIGN KEY (`utente`) REFERENCES `utenti` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
