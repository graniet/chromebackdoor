-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Jeu 14 Janvier 2016 à 11:43
-- Version du serveur :  5.5.38
-- Version de PHP :  5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `chromeback`
--

-- --------------------------------------------------------

--
-- Structure de la table `logs_checker`
--

CREATE TABLE `logs_checker` (
`id` int(11) NOT NULL,
  `url_site` text NOT NULL,
  `logs_site` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `logs_checker`
--

INSERT INTO `logs_checker` (`id`, `url_site`, `logs_site`) VALUES
(1, 'lol', 'effe');

-- --------------------------------------------------------

--
-- Structure de la table `payloads`
--

CREATE TABLE `payloads` (
`id` int(11) NOT NULL,
  `name` text NOT NULL,
  `urlverif` text NOT NULL,
  `codeinject` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `payloads`
--

INSERT INTO `payloads` (`id`, `name`, `urlverif`, `codeinject`) VALUES
(3, 'facebook', 'aWYodGFiVVJMLmluZGV4T2YoJ2ZhY2Vib29rJykgIT09IC0xICkgLy8gdXJsIGluICcnDQp7DQogICAgZmFjZWJvb2tfbG9hZCgpOw0KfQ==', 'ZnVuY3Rpb24gZmFjZWJvb2tfbG9hZCgpDQp7DQogICAgY29uc29sZS5sb2coJ2ZhY2Vib29rIGluanRlY3QnKQ0KfQ=='),
(4, '7thspace', 'aWYodGFiVVJMLmluZGV4T2YoJzd0aHNwYWNlJykgIT09IC0xICkgLy8gdXJsIGluICcnDQp7DQogICAgdGVzdCgpOw0KfQ==', 'ZnVuY3Rpb24gdGVzdCgpDQp7DQogICAgY29uc29sZS5sb2coJ0luamVjdGVkIDd0aHNwYWNlJykNCn0=');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
`id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `bot` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `username`, `password`, `bot`) VALUES
(1, 'root', '7b24afc8bc80e548d66c4e7ff72171c5', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `logs_checker`
--
ALTER TABLE `logs_checker`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `payloads`
--
ALTER TABLE `payloads`
 ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `logs_checker`
--
ALTER TABLE `logs_checker`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `payloads`
--
ALTER TABLE `payloads`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
