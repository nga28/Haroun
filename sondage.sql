-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 28 Novembre 2012 à 12:14
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
  `NOM_USER` varchar(50) NOT NULL,
  `PRENOM_USER` varchar(50) NOT NULL,
  `ADRESSE_USER` varchar(250) NOT NULL,
  `CP_USER` varchar(5) NOT NULL,
  `VILLE_USER` varchar(50) NOT NULL,
  `MAIL_USER` varchar(250) NOT NULL,
  `MDP_USER` varchar(50) NOT NULL,
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
(7, 'a', 'a', 'a', '93100', 'Montreuil', 'a@a.frsssss', 'a', 'FO', '127.0.0.1'),
(22, 'a', 'evv', 'zzzz', '87982', 'gbrvege', 'zzz@zzz.zz', 'zzzzzzz', 'FO', '127.0.0.1'),
(23, 'ZZZZZZ', 'ZZZZZ', 'zzzz', '84871', 'zzzzzzzzz', 'ZZZZZZZ@ZZZZZ.FR', 'ZZZZZZZZZZ', 'FO', '127.0.0.1'),
(24, 'Lahideb', 'Abdel', 'rue ', '75001', 'PARIS', 'l.abdel@a.fr', 'abdell', 'FO', '127.0.0.1');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `ID_QUESTION` int(11) NOT NULL AUTO_INCREMENT,
  `ID_SONDAGE` int(11) DEFAULT NULL,
  `LIBELLE_QUESTION` varchar(750) DEFAULT NULL,
  `TYPE_SONDAGE` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_QUESTION`),
  KEY `ce_questions_sondage` (`ID_SONDAGE`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

--
-- Contenu de la table `questions`
--

INSERT INTO `questions` (`ID_QUESTION`, `ID_SONDAGE`, `LIBELLE_QUESTION`, `TYPE_SONDAGE`) VALUES
(110, 72, 'AZERTY', 0),
(111, 72, 'SSS', 2),
(112, 72, 'SQC', 1),
(114, 72, 'EDZECCE', 0),
(115, 72, '[', 0),
(116, 73, 'QDCCQ', 0),
(119, 73, 'sqcq', 1),
(120, 73, 'sdq qs', 2),
(121, 73, 'eaccaqecae', 1),
(122, 74, 'Avez-vous BeInSport ?', 1),
(123, 74, 'Avez-vous Canal + ?', 1),
(124, 74, 'Combien de matchs regardez-vous la L1 ?', 2),
(125, 74, 'Quel est votre championnat prefere ?', 0),
(126, 74, 'Quelle est votre équipe ? ', 0);

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `ID_REPONSE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_QUESTION` int(11) DEFAULT NULL,
  `ID_USER` int(11) DEFAULT NULL,
  `REPONSE` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`ID_REPONSE`),
  KEY `ce_reponse_user` (`ID_USER`),
  KEY `ce_reponse_questions` (`ID_QUESTION`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=86 ;

--
-- Contenu de la table `reponse`
--

INSERT INTO `reponse` (`ID_REPONSE`, `ID_QUESTION`, `ID_USER`, `REPONSE`) VALUES
(76, 122, 2, 'OUI'),
(77, 123, 2, 'NON'),
(78, 124, 2, '10'),
(79, 125, 2, 'L1'),
(80, 126, 2, 'FCGB'),
(81, 122, 2, 'OUI'),
(82, 123, 2, 'OUI'),
(83, 124, 2, '5'),
(84, 125, 2, 'PREMIER LEAGUE'),
(85, 126, 2, 'man utd');

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
  `URL` varchar(500) NOT NULL,
  `ID_SUJET` int(11) DEFAULT NULL,
  `STATUT` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_SONDAGE`),
  KEY `FK_CREER` (`ID_USER`),
  KEY `ce_sondage_sujet` (`ID_SUJET`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Contenu de la table `sondage`
--

INSERT INTO `sondage` (`ID_SONDAGE`, `ID_USER`, `TYPE_SONDAGE`, `DATE_CLOTURE`, `NOM_SONDAGE`, `ETAT_SONDAGE`, `URL`, `ID_SUJET`, `STATUT`) VALUES
(72, 2, 0, NULL, 'TEST', 1, 'sondages/TEST_72.php', 1, 0),
(73, 2, 0, NULL, 'ASDZEFFEF', NULL, '', 1, 0),
(74, 2, 0, '2012-11-28', 'TV', 1, 'sondages/TV_74.php', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `sujet`
--

CREATE TABLE IF NOT EXISTS `sujet` (
  `ID_SUJET` int(11) NOT NULL DEFAULT '0',
  `LIBELLE_SUJET` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_SUJET`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `sujet`
--

INSERT INTO `sujet` (`ID_SUJET`, `LIBELLE_SUJET`) VALUES
(1, 'Football'),
(2, 'Musique'),
(3, 'Politique'),
(4, 'Jeux Videos');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID_USER` int(11) NOT NULL,
  `IP` varchar(15) NOT NULL,
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
(19, '127.0.0.1'),
(20, '127.0.0.1'),
(21, '127.0.0.1'),
(22, '127.0.0.1'),
(23, '127.0.0.1'),
(24, '127.0.0.1');

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
  ADD CONSTRAINT `ce_questions_sondage` FOREIGN KEY (`ID_SONDAGE`) REFERENCES `sondage` (`ID_SONDAGE`) ON DELETE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `ce_reponse_questions` FOREIGN KEY (`ID_QUESTION`) REFERENCES `questions` (`ID_QUESTION`) ON DELETE CASCADE,
  ADD CONSTRAINT `ce_reponse_user` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`);

--
-- Contraintes pour la table `sondage`
--
ALTER TABLE `sondage`
  ADD CONSTRAINT `ce_sondage_sujet` FOREIGN KEY (`ID_SUJET`) REFERENCES `sujet` (`ID_SUJET`),
  ADD CONSTRAINT `FK_CREER` FOREIGN KEY (`ID_USER`) REFERENCES `membre` (`ID_USER`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
