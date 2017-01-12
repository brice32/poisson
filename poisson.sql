-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 12 Janvier 2017 à 14:53
-- Version du serveur :  10.1.19-MariaDB
-- Version de PHP :  7.0.13

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

CREATE TABLE `diffuser` (
  `ID_DIFFUSION` bigint(4) NOT NULL,
  `ID_NEWS` bigint(4) NOT NULL,
  `ORDRE` int(2) NOT NULL,
  `TEMPSDIFFUSION` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `diffusion`
--

CREATE TABLE `diffusion` (
  `ID` bigint(4) NOT NULL,
  `DERNIEREMODIFICATION` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `image`
--

CREATE TABLE `image` (
  `ID` bigint(4) NOT NULL,
  `CHEMIN` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE `news` (
  `ID` bigint(4) NOT NULL,
  `ID_UTILISATEUR` smallint(10) NOT NULL,
  `ID_IMAGE` bigint(4) NOT NULL,
  `TITRE` char(32) NOT NULL,
  `TEXTE` text NOT NULL,
  `TAILLEFONT` int(3) NOT NULL,
  `TAILLEBANDEAU` int(3) NOT NULL,
  `COULEURFONT` char(7) NOT NULL,
  `COULEURBANDEAU` char(12) NOT NULL,
  `DATEHEUREMODFICATION` datetime NOT NULL,
  `DATEHEURECREATION` char(32) NOT NULL,
  `POSITIONBANDEAU` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `ID` smallint(10) NOT NULL,
  `NOM` char(255) NOT NULL,
  `PRENOM` char(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `LOGIN` varchar(255) NOT NULL,
  `MOTDEPASSE` varchar(255) NOT NULL,
  `CREATION` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `CONNEXION` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ADMIN` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID`, `NOM`, `PRENOM`, `EMAIL`, `LOGIN`, `MOTDEPASSE`, `CREATION`, `CONNEXION`, `ADMIN`) VALUES
(2, 'wang', 'yuchen', '', 'test01', 'd2fd256077371f1d90f266d5a822db7d94cd037a8560c76b0a2afdc99a4c26a6', '2017-01-12 01:36:38', '0000-00-00 00:00:00', 1);

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
  ADD PRIMARY KEY (`ID`);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `diffuser`
--
ALTER TABLE `diffuser`
  ADD CONSTRAINT `FK_DIFFUSER_DIFFUSION` FOREIGN KEY (`ID_DIFFUSION`) REFERENCES `diffusion` (`ID`),
  ADD CONSTRAINT `FK_DIFFUSER_NEWS` FOREIGN KEY (`ID_NEWS`) REFERENCES `news` (`ID`);

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `FK_NEWS_IMAGE` FOREIGN KEY (`ID_IMAGE`) REFERENCES `image` (`ID`),
  ADD CONSTRAINT `FK_NEWS_UTILISATEURS` FOREIGN KEY (`ID_UTILISATEUR`) REFERENCES `utilisateurs` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
