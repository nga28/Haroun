-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 20 Novembre 2012 à 15:48
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `sondage`
--

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `ID_USER` int(11) NOT NULL,
  `IP` text NOT NULL,
  `NOM_USER` text NOT NULL,
  `PRENOM_USER` text NOT NULL,
  `ADRESSE_USER` text NOT NULL,
  `CP_USER` text NOT NULL,
  `VILLE_USER` text NOT NULL,
  `MAIL_USER` text NOT NULL,
  `MDP_USER` text NOT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `ID_QUESTION` int(11) NOT NULL,
  `ID_SONDAGE` int(11) NOT NULL,
  `LIBELLE_QUESTION` text NOT NULL,
  PRIMARY KEY (`ID_QUESTION`),
  KEY `FK_CONTENNIR` (`ID_SONDAGE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `ID_REPONSE` int(11) NOT NULL,
  `ID_QUESTION` int(11) NOT NULL,
  `ID_STATS` int(11) NOT NULL,
  `LIBELLE_REPONSE` longtext NOT NULL,
  `REPONSE_QUESTION` longtext,
  PRIMARY KEY (`ID_REPONSE`),
  KEY `FK_APPARTENIR` (`ID_STATS`),
  KEY `FK_POSSEDER` (`ID_QUESTION`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sondage`
--

CREATE TABLE IF NOT EXISTS `sondage` (
  `ID_SONDAGE` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `NUM_SONDAGE` int(11) NOT NULL,
  `TYPE_SONDAGE` tinyint(1) NOT NULL,
  `DATE_CLOTURE` date DEFAULT NULL,
  PRIMARY KEY (`ID_SONDAGE`),
  KEY `FK_CREER` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `stats`
--

CREATE TABLE IF NOT EXISTS `stats` (
  `ID_STATS` int(11) NOT NULL,
  `DATE_STATS` date NOT NULL,
  PRIMARY KEY (`ID_STATS`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` int(11) NOT NULL,
  `IP` text NOT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `membre`
--
ALTER TABLE `membre`
  ADD CONSTRAINT `FK_HERITAGE_1` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `FK_CONTENNIR` FOREIGN KEY (`ID_SONDAGE`) REFERENCES `sondage` (`ID_SONDAGE`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_POSSEDER` FOREIGN KEY (`ID_QUESTION`) REFERENCES `questions` (`ID_QUESTION`),
  ADD CONSTRAINT `FK_APPARTENIR` FOREIGN KEY (`ID_STATS`) REFERENCES `stats` (`ID_STATS`);

--
-- Contraintes pour la table `sondage`
--
ALTER TABLE `sondage`
  ADD CONSTRAINT `FK_CREER` FOREIGN KEY (`ID_USER`) REFERENCES `membre` (`ID_USER`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
