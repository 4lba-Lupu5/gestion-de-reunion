-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 14 fév. 2022 à 15:10
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reunions`
--
CREATE DATABASE IF NOT EXISTS `reunions` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `reunions`;

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `idCompte` int(10) NOT NULL,
  `Nom` varchar(255) NOT NULL,
  `Prenom` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `TelephoneCompte` int(16) NOT NULL,
  `EmailCompte` varchar(255) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `privilege` varchar(255) NOT NULL,
  `etatCompte` varchar(50) NOT NULL,
  `statutConnexion` int(1) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`idCompte`, `Nom`, `Prenom`, `avatar`, `username`, `Password`, `TelephoneCompte`, `EmailCompte`, `sexe`, `privilege`, `etatCompte`, `statutConnexion`) VALUES
(1, 'ADMIN', 'Admin', 'avatar/default/defaultadmin.ico', 'admin', '264828fb902d67912ad1b5700e3a815f', 12345678, 'admin@reunion.bf', 'm', 'admin', 'active', 0),
(2, 'test', 'test', 'avatar/test.png', 'test', '06a5495508fbdc4a7fb5e0794755926d', 72287802, 'test@test.fr', 'm', 'user', 'active', 0),
(3, 'OUEDRAOGO', 'Yves', 'avatar/default/defaultadmin.ico', 'theRipper', '9c30771e8b6179f60e2b16621c8caa12', 71679373, 'yvesbobson7@gmail.com', 'm', 'admin', 'active', 0),
(4, 'DIALLO', 'Samba', 'avatar/default/defaultman.ico', 'diallo2022', '954d2d3191204e8caa4a6f2952ba62cf', 2020202, 'diallo@gmail.com', 'm', 'user', 'active', 0);

-- --------------------------------------------------------

--
-- Structure de la table `etatparticipant`
--

DROP TABLE IF EXISTS `etatparticipant`;
CREATE TABLE IF NOT EXISTS `etatparticipant` (
  `idEtatParticipant` int(10) NOT NULL,
  `LibelleEtatParticipant` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etatparticipant`
--

INSERT INTO `etatparticipant` (`idEtatParticipant`, `LibelleEtatParticipant`) VALUES
(1, 'Attendu'),
(2, 'Present'),
(3, 'Absent'),
(4, 'Excuse');

-- --------------------------------------------------------

--
-- Structure de la table `etatreunion`
--

DROP TABLE IF EXISTS `etatreunion`;
CREATE TABLE IF NOT EXISTS `etatreunion` (
  `idEtatReunion` int(10) NOT NULL,
  `LibelleEtatReunion` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `etatreunion`
--

INSERT INTO `etatreunion` (`idEtatReunion`, `LibelleEtatReunion`) VALUES
(1, 'Attente'),
(2, 'Passe'),
(3, 'Archive');

-- --------------------------------------------------------

--
-- Structure de la table `modereunion`
--

DROP TABLE IF EXISTS `modereunion`;
CREATE TABLE IF NOT EXISTS `modereunion` (
  `idModeReunion` int(10) NOT NULL,
  `LibelleModeReunion` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `modereunion`
--

INSERT INTO `modereunion` (`idModeReunion`, `LibelleModeReunion`) VALUES
(1, 'Unique'),
(2, 'Journalier'),
(3, 'Hebdomadaire'),
(4, 'Mensuel'),
(5, 'Semestriel');

-- --------------------------------------------------------

--
-- Structure de la table `ordre`
--

DROP TABLE IF EXISTS `ordre`;
CREATE TABLE IF NOT EXISTS `ordre` (
  `idOrdre` int(10) NOT NULL AUTO_INCREMENT,
  `LibelleOrdre` varchar(255) NOT NULL,
  `idCompte` int(10) NOT NULL,
  PRIMARY KEY (`idOrdre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ordre`
--

INSERT INTO `ordre` (`idOrdre`, `LibelleOrdre`, `idCompte`) VALUES
(1, 'Ordre 1', 1),
(2, 'Ordre 2', 1),
(3, 'fyy', 1);

-- --------------------------------------------------------

--
-- Structure de la table `ordrereunion`
--

DROP TABLE IF EXISTS `ordrereunion`;
CREATE TABLE IF NOT EXISTS `ordrereunion` (
  `idOrdre` int(10) NOT NULL,
  `idReunion` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `ordrereunion`
--

INSERT INTO `ordrereunion` (`idOrdre`, `idReunion`) VALUES
(14, 45),
(16, 45),
(18, 46),
(19, 47),
(20, 50),
(21, 50),
(22, 50),
(23, 50),
(24, 50),
(24, 49),
(21, 49),
(23, 48),
(20, 48),
(21, 48),
(1, 56),
(2, 56),
(3, 58);

-- --------------------------------------------------------

--
-- Structure de la table `participant`
--

DROP TABLE IF EXISTS `participant`;
CREATE TABLE IF NOT EXISTS `participant` (
  `idParticipant` int(10) NOT NULL AUTO_INCREMENT,
  `NomParticipant` varchar(30) NOT NULL,
  `PrenomParticipant` varchar(60) NOT NULL,
  `TelephoneParticipant` int(16) NOT NULL,
  `EmailParticipant` varchar(30) NOT NULL,
  `idCompte` int(10) NOT NULL,
  PRIMARY KEY (`idParticipant`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `participant`
--

INSERT INTO `participant` (`idParticipant`, `NomParticipant`, `PrenomParticipant`, `TelephoneParticipant`, `EmailParticipant`, `idCompte`) VALUES
(55, 'npm', 'prenom', 686, 'test@test.com', 1);

-- --------------------------------------------------------

--
-- Structure de la table `participantreunion`
--

DROP TABLE IF EXISTS `participantreunion`;
CREATE TABLE IF NOT EXISTS `participantreunion` (
  `idParticipant` int(10) NOT NULL,
  `idReunion` int(10) NOT NULL,
  `idEtatParticipant` int(10) NOT NULL,
  PRIMARY KEY (`idReunion`,`idParticipant`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `participantreunion`
--

INSERT INTO `participantreunion` (`idParticipant`, `idReunion`, `idEtatParticipant`) VALUES
(55, 58, 1);

-- --------------------------------------------------------

--
-- Structure de la table `prioritereunion`
--

DROP TABLE IF EXISTS `prioritereunion`;
CREATE TABLE IF NOT EXISTS `prioritereunion` (
  `idPrioriteReunion` int(10) NOT NULL,
  `LibellePrioriteReunion` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `prioritereunion`
--

INSERT INTO `prioritereunion` (`idPrioriteReunion`, `LibellePrioriteReunion`) VALUES
(1, 'Forte'),
(2, 'Moyen'),
(3, 'Faible');

-- --------------------------------------------------------

--
-- Structure de la table `reunion`
--

DROP TABLE IF EXISTS `reunion`;
CREATE TABLE IF NOT EXISTS `reunion` (
  `idReunion` int(10) NOT NULL AUTO_INCREMENT,
  `JourReunion` date NOT NULL,
  `HeureReunion` time NOT NULL,
  `PvReunion` varchar(60) DEFAULT NULL,
  `indicatifReunion` text,
  `idCompte` int(10) NOT NULL,
  `idTypeReunion` int(10) NOT NULL,
  `idPrioriteReunion` int(10) NOT NULL,
  `idEtatReunion` int(10) NOT NULL,
  `idModeReunion` int(10) NOT NULL,
  `NbrOrdre` int(10) NOT NULL,
  `NbrParticipant` int(10) NOT NULL,
  PRIMARY KEY (`idReunion`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reunion`
--

INSERT INTO `reunion` (`idReunion`, `JourReunion`, `HeureReunion`, `PvReunion`, `indicatifReunion`, `idCompte`, `idTypeReunion`, `idPrioriteReunion`, `idEtatReunion`, `idModeReunion`, `NbrOrdre`, `NbrParticipant`) VALUES
(57, '2022-02-04', '11:47:00', NULL, ' f', 2, 3, 1, 1, 1, 0, 0),
(58, '2022-02-03', '17:11:00', NULL, ' kljbhgvfmnj,;', 1, 2, 2, 2, 2, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `typereunion`
--

DROP TABLE IF EXISTS `typereunion`;
CREATE TABLE IF NOT EXISTS `typereunion` (
  `idTypeReunion` int(10) NOT NULL,
  `LibelleTypeReunion` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `typereunion`
--

INSERT INTO `typereunion` (`idTypeReunion`, `LibelleTypeReunion`) VALUES
(1, 'Professionnel'),
(2, 'Non Professionnel'),
(3, 'Familial');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
