-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 11 juin 2018 à 14:48
-- Version du serveur :  5.6.38
-- Version de PHP :  7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `projetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE `lieu` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gps` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lieucommentaire`
--

CREATE TABLE `lieucommentaire` (
  `id` int(11) NOT NULL,
  `idlieu` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `supprimer` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lieudescription`
--

CREATE TABLE `lieudescription` (
  `id` int(11) NOT NULL,
  `idlieu` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lieumedia`
--

CREATE TABLE `lieumedia` (
  `id` int(11) NOT NULL,
  `idlieu` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `media` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `supprimer` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `lieumotcle`
--

CREATE TABLE `lieumotcle` (
  `id` int(11) NOT NULL,
  `idlieu` int(11) NOT NULL,
  `idmot` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `motcle`
--

CREATE TABLE `motcle` (
  `id` int(11) NOT NULL,
  `mot` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `signcommentaire`
--

CREATE TABLE `signcommentaire` (
  `id` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `idcommentaire` int(11) NOT NULL,
  `date` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `taiter` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `signdescription`
--

CREATE TABLE `signdescription` (
  `id` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `iddescription` int(11) NOT NULL,
  `date` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `traiter` tinyint(1) NOT NULL,
  `motif` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `signmedia`
--

CREATE TABLE `signmedia` (
  `id` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `idmedia` int(11) NOT NULL,
  `date` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `traiter` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `mdp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `inscription` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `moderateur` tinyint(1) DEFAULT NULL,
  `banni` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `pseudo`, `mdp`, `image`, `description`, `mail`, `inscription`, `moderateur`, `banni`) VALUES
(1, 'ambroisernd', '$2y$10$Q3iD2Osih1s0DP.qOUyJyOvIiMA4jw3L96AFtepW91ZwRkiUiHyeK', NULL, NULL, 'ambroise.renaud@gmail.com', '2018-06-11', NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lieucommentaire`
--
ALTER TABLE `lieucommentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lieudescription`
--
ALTER TABLE `lieudescription`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lieumedia`
--
ALTER TABLE `lieumedia`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lieumotcle`
--
ALTER TABLE `lieumotcle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `motcle`
--
ALTER TABLE `motcle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `signcommentaire`
--
ALTER TABLE `signcommentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `signdescription`
--
ALTER TABLE `signdescription`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `signmedia`
--
ALTER TABLE `signmedia`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lieucommentaire`
--
ALTER TABLE `lieucommentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lieudescription`
--
ALTER TABLE `lieudescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lieumedia`
--
ALTER TABLE `lieumedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `lieumotcle`
--
ALTER TABLE `lieumotcle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `motcle`
--
ALTER TABLE `motcle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `signcommentaire`
--
ALTER TABLE `signcommentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `signdescription`
--
ALTER TABLE `signdescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `signmedia`
--
ALTER TABLE `signmedia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
