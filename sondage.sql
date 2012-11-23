-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Ven 23 Novembre 2012 à 11:25
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

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
  `NOM_USER` text NOT NULL,
  `PRENOM_USER` text NOT NULL,
  `ADRESSE_USER` text NOT NULL,
  `CP_USER` text NOT NULL,
  `VILLE_USER` text NOT NULL,
  `MAIL_USER` text NOT NULL,
  `MDP_USER` text NOT NULL,
  `QUALITE` varchar(2) DEFAULT NULL,
  `IP` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ID_USER`),
  UNIQUE KEY `ID_USER` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`ID_USER`, `NOM_USER`, `PRENOM_USER`, `ADRESSE_USER`, `CP_USER`, `VILLE_USER`, `MAIL_USER`, `MDP_USER`, `QUALITE`, `IP`) VALUES
(1, 'TEST', 'test', '3 rue du test', '75001', 'Paris', 'test@test.fr', 'test', 'FO', '127.0.0.1'),
(2, 'ADMIN', 'Admin', '3 rue Admin', '75002', 'Paris', 'admin@admin.fr', 'admin', 'BO', '127.0.0.1'),
(3, 'a', 'a', 'a', '93100', 'Montreuil', 'a@a.fr', 'a', 'FO', '127.0.0.1'),
(7, 'a', 'a', 'a', '93100', 'Montreuil', 'a@a.frsssss', 'a', 'FO', '127.0.0.1');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `ID_QUESTION` int(11) NOT NULL AUTO_INCREMENT,
  `ID_SONDAGE` int(11) NOT NULL,
  `LIBELLE_QUESTION` text NOT NULL,
  `TYPE_SONDAGE` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_QUESTION`),
  KEY `FK_CONTENNIR` (`ID_SONDAGE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`ID_QUESTION`, `ID_SONDAGE`, `LIBELLE_QUESTION`, `TYPE_SONDAGE`) VALUES
(6, 24, 'xdzdcz', 0);

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
  `ID_SONDAGE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` int(11) NOT NULL,
  `TYPE_SONDAGE` tinyint(1) NOT NULL,
  `DATE_CLOTURE` date DEFAULT NULL,
  `NOM_SONDAGE` varchar(100) DEFAULT NULL,
  `ETAT_SONDAGE` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_SONDAGE`),
  KEY `FK_CREER` (`ID_USER`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `sondage`
--

INSERT INTO `sondage` (`ID_SONDAGE`, `ID_USER`, `TYPE_SONDAGE`, `DATE_CLOTURE`, `NOM_SONDAGE`, `ETAT_SONDAGE`) VALUES
(10, 2, 0, NULL, 'azz', 1),
(11, 2, 1, NULL, 'rvvsv', 1),
(13, 2, 0, NULL, '0', NULL),
(14, 2, 0, NULL, 'ddd', NULL),
(15, 2, 0, NULL, 'test22', NULL),
(20, 3, 1, NULL, 'efzfz', 1),
(21, 3, 0, NULL, 'eqzf', 1),
(22, 3, 0, NULL, 'TEST', NULL),
(23, 3, 0, NULL, 'AZERTY', 1),
(24, 3, 1, NULL, 'lol', NULL);

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
-- Contenu de la table `user`
--

INSERT INTO `user` (`ID_USER`, `IP`) VALUES
(1, '127.0.0.1'),
(2, '127.0.0.1'),
(3, '127.0.0.1'),
(7, '127.0.0.1'),
(8, '127.0.0.1'),
(9, '127.0.0.1'),
(10, '127.0.0.1'),
(11, '127.0.0.1'),
(12, '127.0.0.1'),
(13, '127.0.0.1'),
(14, '127.0.0.1'),
(15, '127.0.0.1'),
(16, '127.0.0.1'),
(17, '127.0.0.1'),
(18, '127.0.0.1'),
(19, '127.0.0.1');

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
  ADD CONSTRAINT `FK_APPARTENIR` FOREIGN KEY (`ID_STATS`) REFERENCES `stats` (`ID_STATS`),
  ADD CONSTRAINT `FK_POSSEDER` FOREIGN KEY (`ID_QUESTION`) REFERENCES `questions` (`ID_QUESTION`);

--
-- Contraintes pour la table `sondage`
--
ALTER TABLE `sondage`
  ADD CONSTRAINT `FK_CREER` FOREIGN KEY (`ID_USER`) REFERENCES `membre` (`ID_USER`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
