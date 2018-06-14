-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  jeu. 14 juin 2018 à 16:30
-- Version du serveur :  5.7.17
-- Version de PHP :  5.6.30

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

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `objet` varchar(255) COLLATE utf8_bin NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `lieu`
--

CREATE TABLE `lieu` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8_bin NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `lieu`
--

INSERT INTO `lieu` (`id`, `nom`, `latitude`, `longitude`, `creation`) VALUES
(8, 'hello', 1, 11, '2018-06-14'),
(9, 'uuu', 0, 0, '2018-06-14');

-- --------------------------------------------------------

--
-- Structure de la table `lieucommentaire`
--

CREATE TABLE `lieucommentaire` (
  `id` int(11) NOT NULL,
  `idlieu` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `creation` datetime NOT NULL,
  `supprime` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `lieucommentaire`
--

INSERT INTO `lieucommentaire` (`id`, `idlieu`, `idutilisateur`, `message`, `creation`, `supprime`) VALUES
(7, 8, 5, 'azz', '2018-06-14 10:23:15', 0);

-- --------------------------------------------------------

--
-- Structure de la table `lieudescription`
--

CREATE TABLE `lieudescription` (
  `id` int(11) NOT NULL,
  `idlieu` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `lieudescription`
--

INSERT INTO `lieudescription` (`id`, `idlieu`, `idutilisateur`, `description`, `date`) VALUES
(9, 8, 5, 'yes', '2018-06-14 10:22:53'),
(10, 9, 5, '** MON LIEU **\r\n\r\n*** histoire ***\r\n\r\n*** uuuu ***', '2018-06-14 10:55:03'),
(11, 9, 5, '** MON LIEU **\r\n\r\n*** histoire ***\r\naeazeaea\r\n*** uuuu ***', '2018-06-14 10:55:19');

-- --------------------------------------------------------

--
-- Structure de la table `lieumedia`
--

CREATE TABLE `lieumedia` (
  `id` int(11) NOT NULL,
  `idlieu` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `media` varchar(255) COLLATE utf8_bin NOT NULL,
  `date` date NOT NULL,
  `supprimer` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `lieumotcle`
--

CREATE TABLE `lieumotcle` (
  `id` int(11) NOT NULL,
  `idlieu` int(11) NOT NULL,
  `idmot` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `likecommentaire`
--

CREATE TABLE `likecommentaire` (
  `id` int(11) NOT NULL,
  `idcommentaire` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `avis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `likecommentaire`
--

INSERT INTO `likecommentaire` (`id`, `idcommentaire`, `idutilisateur`, `avis`) VALUES
(16, 7, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `likelieu`
--

CREATE TABLE `likelieu` (
  `id` int(11) NOT NULL,
  `idlieu` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `avis` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `likelieu`
--

INSERT INTO `likelieu` (`id`, `idlieu`, `idutilisateur`, `avis`) VALUES
(12, 8, 5, 1);

-- --------------------------------------------------------

--
-- Structure de la table `motcle`
--

CREATE TABLE `motcle` (
  `id` int(11) NOT NULL,
  `mot` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `motcle`
--

INSERT INTO `motcle` (`id`, `mot`) VALUES
(6, 'a');

-- --------------------------------------------------------

--
-- Structure de la table `resetmdp`
--

CREATE TABLE `resetmdp` (
  `id` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `codegenere` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `signcommentaire`
--

CREATE TABLE `signcommentaire` (
  `id` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `idcommentaire` int(11) NOT NULL,
  `date` date NOT NULL,
  `traite` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `signcommentaire`
--

INSERT INTO `signcommentaire` (`id`, `idutilisateur`, `idcommentaire`, `date`, `traite`) VALUES
(3, 5, 7, '2018-06-14', 0);

-- --------------------------------------------------------

--
-- Structure de la table `signlieu`
--

CREATE TABLE `signlieu` (
  `id` int(11) NOT NULL,
  `idutilisateur` int(11) NOT NULL,
  `idlieu` int(11) NOT NULL,
  `date` date NOT NULL,
  `traite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `signlieu`
--

INSERT INTO `signlieu` (`id`, `idutilisateur`, `idlieu`, `date`, `traite`) VALUES
(3, 5, 8, '2018-06-14', 0),
(4, 5, 9, '2018-06-14', 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(100) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `mail` varchar(100) COLLATE utf8_bin NOT NULL,
  `inscription` date NOT NULL,
  `moderateur` tinyint(4) NOT NULL DEFAULT '0',
  `banni` tinyint(4) NOT NULL DEFAULT '0',
  `codevalidation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `pseudo`, `mdp`, `image`, `description`, `mail`, `inscription`, `moderateur`, `banni`, `codevalidation`) VALUES
(4, 'a', '$2y$10$x8j0RtfNGTEokWjkppYXFOWI96/F95lbFLGyjRCUfyy..ceqbx/fe', 'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Grosser_Panda.JPG/220px-Grosser_Panda.JPG', 'zef', 'a@a.a', '2018-06-14', 1, 0, 0),
(5, 'aa', '$2y$10$oiRFLX8xgMVos83gNma39OmoGeewNtWyo2/N0r9V.RRDoveVD9wxm', '\"https://dummyimage.com/50x50/d3d3d3/fff\"', '', 'aa@a.a', '2018-06-14', 0, 0, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lieu`
--
ALTER TABLE `lieu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `lieucommentaire`
--
ALTER TABLE `lieucommentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Relation_lieucommentaire_lieu` (`idlieu`),
  ADD KEY `Relation_lieucommentaire_utilisateur` (`idutilisateur`);

--
-- Index pour la table `lieudescription`
--
ALTER TABLE `lieudescription`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Relation_lieudescription_lieu` (`idlieu`) USING BTREE,
  ADD KEY `Relation_lieudescription_utilisateur` (`idutilisateur`) USING BTREE;

--
-- Index pour la table `lieumedia`
--
ALTER TABLE `lieumedia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Relation_lieumedia_lieu` (`idlieu`),
  ADD KEY `Relation_lieumedia_utilisateur` (`idutilisateur`);

--
-- Index pour la table `lieumotcle`
--
ALTER TABLE `lieumotcle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Relation_lieumotcle_lieu` (`idlieu`),
  ADD KEY `Relation_lieumotcle_motcle` (`idmot`);

--
-- Index pour la table `likecommentaire`
--
ALTER TABLE `likecommentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Relation_likecommentaire_commentaire` (`idcommentaire`),
  ADD KEY `Relation_likecommentaire_utilisateur` (`idutilisateur`);

--
-- Index pour la table `likelieu`
--
ALTER TABLE `likelieu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Relation_likelieu_lieu` (`idlieu`),
  ADD KEY `Relation_likelieu_utilisateur` (`idutilisateur`);

--
-- Index pour la table `motcle`
--
ALTER TABLE `motcle`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `resetmdp`
--
ALTER TABLE `resetmdp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Relation_resetmdp_utilisateur` (`idutilisateur`);

--
-- Index pour la table `signcommentaire`
--
ALTER TABLE `signcommentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Relation_signcommentaire_utilisateur` (`idutilisateur`),
  ADD KEY `Relation_signcommentaire_commentaire` (`idcommentaire`);

--
-- Index pour la table `signlieu`
--
ALTER TABLE `signlieu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Relation_signlieu_lieu` (`idlieu`) USING BTREE,
  ADD KEY `Relation_signlieu_utilisateur` (`idutilisateur`) USING BTREE;

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `lieu`
--
ALTER TABLE `lieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `lieucommentaire`
--
ALTER TABLE `lieucommentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `lieudescription`
--
ALTER TABLE `lieudescription`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
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
-- AUTO_INCREMENT pour la table `likecommentaire`
--
ALTER TABLE `likecommentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT pour la table `likelieu`
--
ALTER TABLE `likelieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT pour la table `motcle`
--
ALTER TABLE `motcle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `resetmdp`
--
ALTER TABLE `resetmdp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `signcommentaire`
--
ALTER TABLE `signcommentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `signlieu`
--
ALTER TABLE `signlieu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
-- Contraintes pour la table `likecommentaire`
--
ALTER TABLE `likecommentaire`
  ADD CONSTRAINT `Relation_likecommentaire_commentaire` FOREIGN KEY (`idcommentaire`) REFERENCES `lieucommentaire` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relation_likecommentaire_utilisateur` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `likelieu`
--
ALTER TABLE `likelieu`
  ADD CONSTRAINT `Relation_likelieu_lieu` FOREIGN KEY (`idlieu`) REFERENCES `lieu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relation_likelieu_utilisateur` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `resetmdp`
--
ALTER TABLE `resetmdp`
  ADD CONSTRAINT `Relation_resetmdp_utilisateur` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `signcommentaire`
--
ALTER TABLE `signcommentaire`
  ADD CONSTRAINT `Relation_signcommentaire_commentaire` FOREIGN KEY (`idcommentaire`) REFERENCES `lieucommentaire` (`id`),
  ADD CONSTRAINT `Relation_signcommentaire_utilisateur` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `signlieu`
--
ALTER TABLE `signlieu`
  ADD CONSTRAINT `Relation_signlieu_lieu` FOREIGN KEY (`idlieu`) REFERENCES `lieu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Relation_signlieu_utilisateur` FOREIGN KEY (`idutilisateur`) REFERENCES `utilisateur` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
