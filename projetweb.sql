-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 12 juin 2018 à 15:43
-- Version du serveur :  5.7.19
-- Version de PHP :  7.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `objet` varchar(255) COLLATE utf8_bin NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

DROP TABLE IF EXISTS `lieu`;
CREATE TABLE IF NOT EXISTS `lieu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `creation` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `lieucommentaire`
--

DROP TABLE IF EXISTS `lieucommentaire`;
CREATE TABLE IF NOT EXISTS `lieucommentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idlieu` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `creation` date NOT NULL,
  `supprime` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Relation_lieucommentaire_lieu` (`idlieu`),
  KEY `Relation_lieucommentaire_utilisateur` (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `lieudescription`
--

DROP TABLE IF EXISTS `lieudescription`;
CREATE TABLE IF NOT EXISTS `lieudescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idlieu` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Relation_lieudescription_lieu` (`idlieu`) USING BTREE,
  KEY `Relation_lieudescription_utilisateur` (`idutilisateur`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `lieumedia`
--

DROP TABLE IF EXISTS `lieumedia`;
CREATE TABLE IF NOT EXISTS `lieumedia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idlieu` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `media` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `supprimer` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Relation_lieumedia_lieu` (`idlieu`),
  KEY `Relation_lieumedia_utilisateur` (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `lieumotcle`
--

DROP TABLE IF EXISTS `lieumotcle`;
CREATE TABLE IF NOT EXISTS `lieumotcle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idlieu` int(11) NOT NULL,
  `idmot` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Relation_lieumotcle_lieu` (`idlieu`),
  KEY `Relation_lieumotcle_motcle` (`idmot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `likelieu`
--

DROP TABLE IF EXISTS `likelieu`;
CREATE TABLE IF NOT EXISTS `likelieu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idlieu` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `avis` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Relation_likelieu_lieu` (`idlieu`),
  KEY `Relation_likelieu_utilisateur` (`idutilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `motcle`
--

DROP TABLE IF EXISTS `motcle`;
CREATE TABLE IF NOT EXISTS `motcle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mot` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `signcommentaire`
--

DROP TABLE IF EXISTS `signcommentaire`;
CREATE TABLE IF NOT EXISTS `signcommentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idutilisateur` int(11) NOT NULL,
  `idcommentaire` int(11) NOT NULL,
  `date` date NOT NULL,
  `traite` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Relation_signcommentaire_utilisateur` (`idutilisateur`),
  KEY `Relation_signcommentaire_commentaire` (`idcommentaire`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `signdescription`
--

DROP TABLE IF EXISTS `signdescription`;
CREATE TABLE IF NOT EXISTS `signdescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idutilisateur` int(11) NOT NULL,
  `iddescription` int(11) NOT NULL,
  `date` date NOT NULL,
  `traite` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Relation_signdescription_utilisateur` (`idutilisateur`),
  KEY `Relation_signdescription_description` (`iddescription`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(100) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `mail` varchar(100) COLLATE utf8_bin NOT NULL,
  `inscription` date NOT NULL,
  `moderateur` tinyint(4) NOT NULL DEFAULT '0',
  `banni` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `lieucommentaire`
--
ALTER TABLE `lieucommentaire`
  ADD CONSTRAINT `Relation_lieucommentaire_lieu` FOREIGN KEY (`idlieu`) REFERENCES `lieu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relation_lieucommentaire_utilisateur` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `lieudescription`
--
ALTER TABLE `lieudescription`
  ADD CONSTRAINT `Relation_lieudescription_lieu` FOREIGN KEY (`idlieu`) REFERENCES `lieu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relation_lieudescription_utilisateur2` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `lieumedia`
--
ALTER TABLE `lieumedia`
  ADD CONSTRAINT `Relation_lieumedia_lieu` FOREIGN KEY (`idlieu`) REFERENCES `lieu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relation_lieumedia_utilisateur` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `lieumotcle`
--
ALTER TABLE `lieumotcle`
  ADD CONSTRAINT `Relation_lieumotcle_lieu` FOREIGN KEY (`idlieu`) REFERENCES `lieu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relation_lieumotcle_motcle` FOREIGN KEY (`idmot`) REFERENCES `motcle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `likelieu`
--
ALTER TABLE `likelieu`
  ADD CONSTRAINT `Relation_likelieu_lieu` FOREIGN KEY (`idlieu`) REFERENCES `lieu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relation_likelieu_utilisateur` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `signcommentaire`
--
ALTER TABLE `signcommentaire`
  ADD CONSTRAINT `Relation_signcommentaire_commentaire` FOREIGN KEY (`idcommentaire`) REFERENCES `lieucommentaire` (`id`),
  ADD CONSTRAINT `Relation_signcommentaire_utilisateur` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `signdescription`
--
ALTER TABLE `signdescription`
  ADD CONSTRAINT `Relation_signdescription_description` FOREIGN KEY (`iddescription`) REFERENCES `lieudescription` (`id`),
  ADD CONSTRAINT `Relation_signdescription_utilisateur` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
