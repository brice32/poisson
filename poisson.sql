-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 16 Janvier 2017 à 14:25
-- Version du serveur :  5.6.26
-- Version de PHP :  5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `poisson`
--

-- --------------------------------------------------------

--
-- Structure de la table `diffuser`
--

CREATE TABLE IF NOT EXISTS `diffuser` (
  `ID_DIFFUSION` bigint(4) NOT NULL,
  `ID_NEWS` bigint(4) NOT NULL,
  `ORDRE` int(2) NOT NULL,
  `TEMPSDIFFUSION` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `diffuser`
--

INSERT INTO `diffuser` (`ID_DIFFUSION`, `ID_NEWS`, `ORDRE`, `TEMPSDIFFUSION`) VALUES
(1, 2, 1, 15),
(1, 3, 2, 30);

-- --------------------------------------------------------

--
-- Structure de la table `diffusion`
--

CREATE TABLE IF NOT EXISTS `diffusion` (
  `ID` bigint(4) NOT NULL,
  `DERNIEREMODIFICATION` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `diffusion`
--

INSERT INTO `diffusion` (`ID`, `DERNIEREMODIFICATION`) VALUES
(1, '2017-01-16 14:21:23');

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE IF NOT EXISTS `image` (
  `ID` bigint(4) NOT NULL,
  `CHEMIN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `image`
--

INSERT INTO `image` (`ID`, `CHEMIN`) VALUES
(1, 'images/images2017/1.jpg'),
(2, 'images/images2017/2.jpg'),
(3, 'images/images2017/3.jpg'),
(4, 'images/images2017/4.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `ID` bigint(4) NOT NULL,
  `ID_UTILISATEUR` smallint(10) NOT NULL,
  `ID_IMAGE` bigint(4) NOT NULL,
  `TITRE` char(32) NOT NULL,
  `TEXTE` text NOT NULL,
  `TAILLEFONT` int(3) NOT NULL,
  `TAILLEBANDE` int(3) NOT NULL,
  `COULEURFONT` char(7) NOT NULL,
  `COULEURBANDEAU` char(12) NOT NULL,
  `DATEHEUREMODIFICATION` datetime NOT NULL,
  `DATEHEURECREATION` char(32) NOT NULL,
  `POSITIONBANDEAU` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`ID`, `ID_UTILISATEUR`, `ID_IMAGE`, `TITRE`, `TEXTE`, `TAILLEFONT`, `TAILLEBANDE`, `COULEURFONT`, `COULEURBANDEAU`, `DATEHEUREMODIFICATION`, `DATEHEURECREATION`, `POSITIONBANDEAU`) VALUES
(1, 6, 1, 'Aircafte carrier', 'Aircafte carrier text', 10, 10, 'gris', 'gris', '2017-01-01 00:00:00', '2017-01-01 00:00:00', 'top'),
(2, 7, 2, 'test02', 'test02 texte', 10, 10, 'gris', 'gris', '2017-01-01 00:00:00', '2017-01-01 00:00:00', 'left'),
(3, 7, 4, 'paris', 'paris texte', 10, 10, 'gris', 'gris', '2017-01-26 00:00:00', '2017-01-26 00:00:00', 'left'),
(4, 6, 3, 'bordeaux', 'paris texte', 10, 10, 'gris', 'gris', '2017-01-26 00:00:00', '2017-01-26 00:00:00', 'left');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(10) unsigned NOT NULL,
  `nom` char(255) NOT NULL,
  `prenom` char(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  `creation` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `connexion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `admin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `nom`, `prenom`, `email`, `login`, `motdepasse`, `creation`, `connexion`, `admin`) VALUES
(6, 'wang', 'yuchen', 'wangyc32@gmail.com', 'test01', '39dd1b0e4356a97f2fbdf14f7858dfd49b524ba4b4ba97bdc895496074800a6c', '2017-01-12 18:14:34', '0000-00-00 00:00:00', 1),
(7, 'willian', 'ruchaud', 'ruchaud@3il.fr', 'test02', 'fb5380fc71a98ce78215db372b0b81595d770ad3900978cf3f933b4863d87496', '2017-01-12 18:15:11', '0000-00-00 00:00:00', 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `diffuser`
--
ALTER TABLE `diffuser`
  ADD PRIMARY KEY (`ID_DIFFUSION`,`ID_NEWS`),
  ADD KEY `I_FK_DIFFUSER_DIFFUSION` (`ID_DIFFUSION`),
  ADD KEY `I_FK_DIFFUSER_NEWS` (`ID_NEWS`);

--
-- Index pour la table `diffusion`
--
ALTER TABLE `diffusion`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `I_FK_NEWS_UTILISATEURS` (`ID_UTILISATEUR`),
  ADD KEY `I_FK_NEWS_IMAGE` (`ID_IMAGE`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `diffuser`
--
ALTER TABLE `diffuser`
  ADD CONSTRAINT `FK_DIFFUSER_DIFFUSION` FOREIGN KEY (`ID_DIFFUSION`) REFERENCES `diffusion` (`ID`),
  ADD CONSTRAINT `FK_DIFFUSER_NEWS` FOREIGN KEY (`ID_NEWS`) REFERENCES `news` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
