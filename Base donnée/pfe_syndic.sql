-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 10 Juin 2013 à 09:10
-- Version du serveur: 5.5.24-log
-- Version de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `pfe_syndic`
--

-- --------------------------------------------------------

--
-- Structure de la table `apartement`
--

CREATE TABLE IF NOT EXISTS `apartement` (
  `id_apartement` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `num_etage` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `id_immeuble` int(11) NOT NULL,
  PRIMARY KEY (`id_apartement`),
  KEY `id_type` (`id_type`),
  KEY `id_immeuble` (`id_immeuble`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `apartement`
--

INSERT INTO `apartement` (`id_apartement`, `nom`, `num_etage`, `id_type`, `id_immeuble`) VALUES
(1, 'A1', 1, 3, 1),
(2, 'A2', 1, 3, 1),
(3, 'B1', 1, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE IF NOT EXISTS `facture` (
  `id_facture` int(11) NOT NULL AUTO_INCREMENT,
  `id_apartement` int(11) NOT NULL,
  `id_proprietaire` int(11) NOT NULL,
  `montant` float NOT NULL,
  `datefacture` date NOT NULL,
  `datelimite` date NOT NULL,
  `mois` varchar(10) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_facture`),
  KEY `id_apartement` (`id_apartement`),
  KEY `id_proprietaire` (`id_proprietaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `facture`
--

INSERT INTO `facture` (`id_facture`, `id_apartement`, `id_proprietaire`, `montant`, `datefacture`, `datelimite`, `mois`, `active`) VALUES
(1, 1, 1, 160, '2013-05-01', '2013-05-31', 'mai', 1),
(2, 2, 2, 150, '2013-05-01', '2013-05-31', 'mai', 1),
(3, 1, 1, 160, '2013-04-01', '2013-04-30', 'avril', 1),
(4, 2, 2, 150, '2013-04-01', '2013-04-30', 'avril', 1);

-- --------------------------------------------------------

--
-- Structure de la table `facture_s`
--

CREATE TABLE IF NOT EXISTS `facture_s` (
  `id_facture` int(11) NOT NULL AUTO_INCREMENT,
  `id_societe` int(11) NOT NULL,
  `montant` float NOT NULL,
  `datefacture` varchar(25) NOT NULL,
  `datelimite` varchar(25) NOT NULL,
  `mois` varchar(25) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_facture`),
  KEY `id_societe` (`id_societe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `facture_s`
--

INSERT INTO `facture_s` (`id_facture`, `id_societe`, `montant`, `datefacture`, `datelimite`, `mois`, `active`) VALUES
(1, 2, 1200, '2013-05-01', '2013-05-31', 'mai', 1),
(2, 2, 567.2, '2013-06-01', '2013-06-30', 'juin', 1);

-- --------------------------------------------------------

--
-- Structure de la table `forum_answer`
--

CREATE TABLE IF NOT EXISTS `forum_answer` (
  `question_id` int(4) NOT NULL DEFAULT '0',
  `a_id` int(4) NOT NULL DEFAULT '0',
  `a_name` varchar(65) NOT NULL DEFAULT '',
  `a_email` varchar(65) NOT NULL DEFAULT '',
  `a_answer` longtext NOT NULL,
  `a_datetime` varchar(25) NOT NULL DEFAULT '',
  KEY `a_id` (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `forum_answer`
--

INSERT INTO `forum_answer` (`question_id`, `a_id`, `a_name`, `a_email`, `a_answer`, `a_datetime`) VALUES
(2, 1, 'immeuble', 'asma', 'hahahahah', '26/05/13 23:52:08'),
(2, 1, 'immeuble', 'asmae', 'hehehehehehheheheh', '26/05/13 23:52:57'),
(3, 1, 'hahahÂ²', 'asma', 'dakchi', '27/05/13 00:26:54'),
(2, 1, 'immeuble', '', 'test ', '04/06/13 11:57:05');

-- --------------------------------------------------------

--
-- Structure de la table `forum_question`
--

CREATE TABLE IF NOT EXISTS `forum_question` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `topic` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext NOT NULL,
  `name` varchar(65) NOT NULL DEFAULT '',
  `email` varchar(65) NOT NULL DEFAULT '',
  `datetime` varchar(25) NOT NULL DEFAULT '',
  `view` int(4) NOT NULL DEFAULT '0',
  `reply` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `forum_question`
--

INSERT INTO `forum_question` (`id`, `topic`, `detail`, `name`, `email`, `datetime`, `view`, `reply`) VALUES
(2, 'immeuble', 'resi', 'asma', 'asmaboussalem@gmail.com', '25/05/13 04:22:32', 51, 0),
(3, 'hahahÂ²', 'hehehehe', '', '', '27/05/13 12:26:43', 9, 0),
(4, 'asma', 'gyyygygy', '', '', '27/05/13 12:36:01', 7, 0),
(5, 'hyhy', 'hahahah', 'asma', '', '27/05/13 12:38:08', 7, 0);

-- --------------------------------------------------------

--
-- Structure de la table `immeuble`
--

CREATE TABLE IF NOT EXISTS `immeuble` (
  `id_immeuble` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `nbreApart` int(11) NOT NULL,
  `nbreEtage` int(11) NOT NULL,
  `id_residence` int(11) NOT NULL,
  PRIMARY KEY (`id_immeuble`),
  KEY `id_residence` (`id_residence`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `immeuble`
--

INSERT INTO `immeuble` (`id_immeuble`, `nom`, `nbreApart`, `nbreEtage`, `id_residence`) VALUES
(1, 'FOX', 9, 4, 1),
(2, 'ALPHA', 9, 4, 1),
(3, 'DELTA', 9, 4, 1),
(4, 'MEGA', 9, 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_expediteur` int(11) NOT NULL DEFAULT '0',
  `id_destinataire` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `titre` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Contenu de la table `messages`
--

INSERT INTO `messages` (`id`, `id_expediteur`, `id_destinataire`, `date`, `titre`, `message`) VALUES
(51, 0, 4, '2013-05-27 00:02:37', 'hthth', 'rererrrerrereree'),
(52, 0, 4, '2013-05-27 00:07:59', 'hthth', 'rererrrerrereree'),
(53, 0, 4, '2013-05-27 00:08:05', 'hthth', 'rererrrerrereree'),
(54, 0, 4, '2013-05-27 00:08:10', 'hthth', 'rererrrerrereree'),
(55, 0, 4, '2013-05-27 00:09:22', 'hthth', 'rererrrerrereree'),
(56, 0, 3, '2013-05-27 00:09:36', 'hthth', 'rererrrerrereree'),
(57, 0, 4, '2013-05-27 00:11:02', 'hthth', 'rererrrerrereree'),
(58, 0, 4, '2013-05-27 00:12:05', 'hthth', 'rererrrerrereree'),
(59, 0, 4, '2013-05-27 10:31:52', 'gfgf', 'hahah');

-- --------------------------------------------------------

--
-- Structure de la table `montant_s`
--

CREATE TABLE IF NOT EXISTS `montant_s` (
  `id_montant` int(11) NOT NULL AUTO_INCREMENT,
  `id_proprietaire` int(11) NOT NULL,
  `id_apartement` int(11) NOT NULL,
  `montant` float NOT NULL,
  PRIMARY KEY (`id_montant`),
  KEY `id_proprietaire` (`id_proprietaire`),
  KEY `id_apartement` (`id_apartement`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `montant_s`
--

INSERT INTO `montant_s` (`id_montant`, `id_proprietaire`, `id_apartement`, `montant`) VALUES
(1, 1, 1, 160),
(2, 2, 2, 150);

-- --------------------------------------------------------

--
-- Structure de la table `payementpro`
--

CREATE TABLE IF NOT EXISTS `payementpro` (
  `id_payement` int(11) NOT NULL AUTO_INCREMENT,
  `id_facture` int(11) NOT NULL,
  `montantPayer` float NOT NULL,
  `datePayement` date NOT NULL,
  `id_apartement` int(11) NOT NULL,
  `id_proprietaire` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_payement`),
  KEY `id_facture` (`id_facture`),
  KEY `id_apartement` (`id_apartement`),
  KEY `id_proprietaire` (`id_proprietaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `payementpro`
--

INSERT INTO `payementpro` (`id_payement`, `id_facture`, `montantPayer`, `datePayement`, `id_apartement`, `id_proprietaire`, `active`) VALUES
(1, 1, 160, '2013-05-08', 1, 1, 1),
(2, 1, 10, '2013-05-25', 1, 1, 0),
(3, 4, 150, '2013-04-18', 2, 2, 1),
(4, 2, 150, '2013-05-22', 2, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `payementsoc`
--

CREATE TABLE IF NOT EXISTS `payementsoc` (
  `id_payement` int(11) NOT NULL AUTO_INCREMENT,
  `id_facture` int(11) NOT NULL,
  `montantPayer` float NOT NULL,
  `datePayement` date NOT NULL,
  `id_societe` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_payement`),
  KEY `id_facture` (`id_facture`),
  KEY `id_societe` (`id_societe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `payementsoc`
--

INSERT INTO `payementsoc` (`id_payement`, `id_facture`, `montantPayer`, `datePayement`, `id_societe`, `active`) VALUES
(1, 1, 1200, '2013-05-23', 2, 0),
(2, 1, 1200, '2013-05-15', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `proprietaire`
--

CREATE TABLE IF NOT EXISTS `proprietaire` (
  `id_proprietaire` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `profession` varchar(25) NOT NULL,
  `CIN` varchar(12) NOT NULL,
  `telephone` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_apartement` int(11) NOT NULL,
  `datehabita` date NOT NULL,
  `active` tinyint(1) NOT NULL,
  `datedepart` date NOT NULL,
  PRIMARY KEY (`id_proprietaire`),
  KEY `id_apartement` (`id_apartement`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `proprietaire`
--

INSERT INTO `proprietaire` (`id_proprietaire`, `nom`, `prenom`, `sexe`, `profession`, `CIN`, `telephone`, `email`, `id_apartement`, `datehabita`, `active`, `datedepart`) VALUES
(1, 'BENDHIBA', 'Zineb', 'F', 'informaticienne', 'EE32558', 661426787, 'bzineb@gmail.com', 1, '2011-11-01', 1, '0000-00-00'),
(2, 'SADOUK', 'Ahmed', 'M', 'employe', 'j897644', 65543768, 'sadouk.a@gmail.com', 2, '2011-10-05', 1, '2013-06-09'),
(3, 'TEST', 'Test test', 'M', 'employe', 'EE377995', 528281730, 'h@k.com', 3, '2013-06-06', 1, '2013-06-08');

-- --------------------------------------------------------

--
-- Structure de la table `pseudo`
--

CREATE TABLE IF NOT EXISTS `pseudo` (
  `id_pseudo` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `sexe` varchar(25) NOT NULL,
  `dateins` date NOT NULL,
  `id_apartement` int(11) NOT NULL,
  PRIMARY KEY (`id_pseudo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `pseudo`
--

INSERT INTO `pseudo` (`id_pseudo`, `pseudo`, `password`, `email`, `active`, `ip`, `nom`, `prenom`, `sexe`, `dateins`, `id_apartement`) VALUES
(1, 'zineb', 'eu9mAp6gvsUJvzZ6XxFUFQoYE+Bp06OdpaxaTKHE/w8=', 'zineb.bendhiba@gmail.com', 1, '127.0.0.1', 'BENDHIBA', 'Zineb', 'F', '2013-05-24', 1),
(2, 'fsa', 'xGRBt30FPD5muzcmizDFi66i1CsUWELLJv3mi4xQ5UQ=', 'fsa@fsa.ma', 1, '127.0.0.1', 'FSA', 'Pfe', 'M', '2013-05-25', 2);

-- --------------------------------------------------------

--
-- Structure de la table `residence`
--

CREATE TABLE IF NOT EXISTS `residence` (
  `id_residence` int(11) NOT NULL AUTO_INCREMENT,
  `raisonsocial` varchar(20) NOT NULL,
  `rue` varchar(100) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `nbreImm` int(11) NOT NULL,
  `nbreApart` int(11) NOT NULL,
  `telephone` int(11) NOT NULL,
  `fax` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id_residence`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `residence`
--

INSERT INTO `residence` (`id_residence`, `raisonsocial`, `rue`, `ville`, `nbreImm`, `nbreApart`, `telephone`, `fax`, `email`, `date_creation`) VALUES
(1, 'Najah', '105 rue de la national ', 'Agadir', 5, 40, 528281730, 528281731, 'najah@gmail.com', '2002-03-14');

-- --------------------------------------------------------

--
-- Structure de la table `societe`
--

CREATE TABLE IF NOT EXISTS `societe` (
  `id_societe` int(11) NOT NULL AUTO_INCREMENT,
  `raisonsocial` varchar(25) NOT NULL,
  `adresse` varchar(100) NOT NULL,
  `ville` varchar(25) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `telephone` int(11) NOT NULL,
  `fax` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_societe`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `societe`
--

INSERT INTO `societe` (`id_societe`, `raisonsocial`, `adresse`, `ville`, `nom`, `prenom`, `telephone`, `fax`, `email`, `active`) VALUES
(1, 'RAMSA', 'lhih', 'agadir', 'BENDHIBA', 'Hamza', 528281730, 528281731, 'ramsa@maroc.ma', 1),
(2, 'ONE', 'rue 105 imm 66', 'agadir', 'SALHI', 'Wahid', 528285540, 528285541, 'one@maroc.ma', 1);

-- --------------------------------------------------------

--
-- Structure de la table `syndic`
--

CREATE TABLE IF NOT EXISTS `syndic` (
  `id_syndic` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `CIN` varchar(12) NOT NULL,
  `telephone` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `utilisateur` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_residence` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_syndic`),
  KEY `id_residence` (`id_residence`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `syndic`
--

INSERT INTO `syndic` (`id_syndic`, `nom`, `prenom`, `sexe`, `CIN`, `telephone`, `email`, `utilisateur`, `password`, `id_residence`, `active`) VALUES
(2, 'BENDHIBA', 'Hamza', 'M', 'EE377995', 528281730, 'bendhiba.hamza@gmail.com', 'hamza', 'eu9mAp6gvsUJvzZ6XxFUFQoYE+Bp06OdpaxaTKHE/w8=', 1, 1),
(3, 'BOUSSALEM', 'Asma', 'F', 'J458790', 671988665, 'boussalem.asma@gmail.com', 'asma', 'sEVv0dxWmkJoLAPIZ3aUMjxsX/TTkGpUoy1A2QkygF8=', 1, 1),
(4, 'ADMIN', 'Admin', 'M', 'B789966', 661000000, 'admin@admin.ma', 'admin', 'gFjCZPvMtPKQNHbVd/eCSCnsIDfp9jywp+fHviqQqCY=', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_apart`
--

CREATE TABLE IF NOT EXISTS `type_apart` (
  `id_type` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(25) NOT NULL,
  `surface` double NOT NULL,
  `balcon` varchar(3) NOT NULL,
  `jardin` varchar(3) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type_apart`
--

INSERT INTO `type_apart` (`id_type`, `nom`, `surface`, `balcon`, `jardin`) VALUES
(1, 'TYPE_1', 102, 'OUI', 'NON'),
(3, 'TYPE_3', 75, 'NON', 'NON');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `apartement`
--
ALTER TABLE `apartement`
  ADD CONSTRAINT `apartement_ibfk_1` FOREIGN KEY (`id_type`) REFERENCES `type_apart` (`id_type`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `apartement_ibfk_2` FOREIGN KEY (`id_immeuble`) REFERENCES `immeuble` (`id_immeuble`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`id_apartement`) REFERENCES `apartement` (`id_apartement`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `facture_ibfk_2` FOREIGN KEY (`id_proprietaire`) REFERENCES `proprietaire` (`id_proprietaire`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `facture_s`
--
ALTER TABLE `facture_s`
  ADD CONSTRAINT `facture_s_ibfk_1` FOREIGN KEY (`id_societe`) REFERENCES `societe` (`id_societe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `immeuble`
--
ALTER TABLE `immeuble`
  ADD CONSTRAINT `immeuble_ibfk_1` FOREIGN KEY (`id_residence`) REFERENCES `residence` (`id_residence`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `payementpro`
--
ALTER TABLE `payementpro`
  ADD CONSTRAINT `payementpro_ibfk_1` FOREIGN KEY (`id_facture`) REFERENCES `facture` (`id_facture`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payementpro_ibfk_2` FOREIGN KEY (`id_apartement`) REFERENCES `apartement` (`id_apartement`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payementpro_ibfk_3` FOREIGN KEY (`id_proprietaire`) REFERENCES `proprietaire` (`id_proprietaire`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `payementsoc`
--
ALTER TABLE `payementsoc`
  ADD CONSTRAINT `payementsoc_ibfk_1` FOREIGN KEY (`id_facture`) REFERENCES `facture` (`id_facture`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payementsoc_ibfk_2` FOREIGN KEY (`id_societe`) REFERENCES `societe` (`id_societe`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `proprietaire`
--
ALTER TABLE `proprietaire`
  ADD CONSTRAINT `proprietaire_ibfk_1` FOREIGN KEY (`id_apartement`) REFERENCES `apartement` (`id_apartement`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `syndic`
--
ALTER TABLE `syndic`
  ADD CONSTRAINT `syndic_ibfk_2` FOREIGN KEY (`id_residence`) REFERENCES `residence` (`id_residence`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
