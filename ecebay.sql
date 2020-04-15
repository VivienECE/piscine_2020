-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 15 avr. 2020 à 15:54
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `ecebay`
--

-- --------------------------------------------------------

--
-- Structure de la table `achatimmediat`
--

DROP TABLE IF EXISTS `achatimmediat`;
CREATE TABLE IF NOT EXISTS `achatimmediat` (
  `IdAchatImmediat` int(8) NOT NULL AUTO_INCREMENT,
  `IdAcheteur` int(8) NOT NULL,
  `IdItem` int(8) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`IdAchatImmediat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `achete`
--

DROP TABLE IF EXISTS `achete`;
CREATE TABLE IF NOT EXISTS `achete` (
  `IdAcheteur` int(8) NOT NULL,
  `IdAchatImmediat` int(8) NOT NULL,
  `IdEnchere` int(8) NOT NULL,
  `IdMeilleureOffre` int(8) NOT NULL,
  `IdPanier` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `acheteur`
--

DROP TABLE IF EXISTS `acheteur`;
CREATE TABLE IF NOT EXISTS `acheteur` (
  `IdAcheteur` int(8) NOT NULL AUTO_INCREMENT,
  `IdUtilisateur` int(8) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `Adresse` text NOT NULL,
  `CodePostal` varchar(10) NOT NULL,
  `Pays` varchar(20) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `TypeDeCarte` varchar(14) NOT NULL,
  `NumeroCarte` varchar(19) NOT NULL,
  `NomCarte` varchar(20) NOT NULL,
  `ExpirationCarte` varchar(5) NOT NULL,
  `CodedeSecurite` varchar(3) NOT NULL,
  PRIMARY KEY (`IdAcheteur`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`IdAcheteur`, `IdUtilisateur`, `Nom`, `Prenom`, `Adresse`, `CodePostal`, `Pays`, `Telephone`, `TypeDeCarte`, `NumeroCarte`, `NomCarte`, `ExpirationCarte`, `CodedeSecurite`) VALUES
(1, 22, 'Vivien', 'DET', '5 allÃ©e', '91090', 'EEEEEEE', '11111111111111111111', 'visa', '1111111111111111111', '22222222', '05/21', '222');

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `IdAdmin` int(8) NOT NULL AUTO_INCREMENT,
  `IdUtilisateur` int(8) NOT NULL,
  `Nom` varchar(12) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  PRIMARY KEY (`IdAdmin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`IdAdmin`, `IdUtilisateur`, `Nom`, `Prenom`) VALUES
(1, 1, 'Super', 'Admin');

-- --------------------------------------------------------

--
-- Structure de la table `enchere`
--

DROP TABLE IF EXISTS `enchere`;
CREATE TABLE IF NOT EXISTS `enchere` (
  `IdEnchere` int(8) NOT NULL AUTO_INCREMENT,
  `IdItem` int(8) NOT NULL,
  `DateDebut` date NOT NULL,
  `DateFin` date NOT NULL,
  `PrixFinal` int(8) NOT NULL COMMENT '=(2nd offre + chere) +1euro',
  PRIMARY KEY (`IdEnchere`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `imageitem`
--

DROP TABLE IF EXISTS `imageitem`;
CREATE TABLE IF NOT EXISTS `imageitem` (
  `IdImage` int(8) NOT NULL AUTO_INCREMENT,
  `IdItem` int(8) NOT NULL,
  `Lien` varchar(80) NOT NULL,
  PRIMARY KEY (`IdImage`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `imagevendeur`
--

DROP TABLE IF EXISTS `imagevendeur`;
CREATE TABLE IF NOT EXISTS `imagevendeur` (
  `IdImage` int(8) NOT NULL AUTO_INCREMENT,
  `IdVendeur` int(8) NOT NULL,
  `Type` varchar(8) NOT NULL,
  `Lien` varchar(80) NOT NULL,
  PRIMARY KEY (`IdImage`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `IdItem` int(8) NOT NULL AUTO_INCREMENT,
  `IdVendeur` int(8) NOT NULL,
  `Nom` text NOT NULL,
  `Description` text NOT NULL,
  `Categorie` text NOT NULL COMMENT 'Bon/Feraille...',
  `PrixInitial` int(8) NOT NULL,
  `Date` date NOT NULL,
  `Statut` varchar(12) NOT NULL COMMENT 'vendu/attente/proposition...',
  PRIMARY KEY (`IdItem`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `meilleureoffre`
--

DROP TABLE IF EXISTS `meilleureoffre`;
CREATE TABLE IF NOT EXISTS `meilleureoffre` (
  `IdMeilleurOffre` int(8) NOT NULL AUTO_INCREMENT,
  `IdItem` int(8) NOT NULL,
  `Date` date NOT NULL,
  `PrixFinal` int(8) NOT NULL,
  PRIMARY KEY (`IdMeilleurOffre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `negocie`
--

DROP TABLE IF EXISTS `negocie`;
CREATE TABLE IF NOT EXISTS `negocie` (
  `IdNegociation` int(8) NOT NULL AUTO_INCREMENT,
  `IdVendeur` int(8) NOT NULL,
  `IdAcheteur` int(8) NOT NULL,
  `IdMeilleureOffre` int(8) NOT NULL,
  `EtapeNegociation` int(1) NOT NULL COMMENT '[1-5] +1 apres chaque contre-offre',
  `Date` date NOT NULL,
  `Prix` int(8) NOT NULL,
  PRIMARY KEY (`IdNegociation`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `offreenchere`
--

DROP TABLE IF EXISTS `offreenchere`;
CREATE TABLE IF NOT EXISTS `offreenchere` (
  `IdOffre` int(8) NOT NULL AUTO_INCREMENT,
  `IdEnchere` int(8) NOT NULL,
  `IdAcheteur` int(8) NOT NULL,
  `Date` int(11) NOT NULL,
  `Prix` int(8) NOT NULL,
  PRIMARY KEY (`IdOffre`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `IdPanier` int(8) NOT NULL AUTO_INCREMENT,
  `PrixTotal` int(8) NOT NULL,
  PRIMARY KEY (`IdPanier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `IdUtilisateur` int(10) NOT NULL AUTO_INCREMENT COMMENT 'PRIMARY',
  `Email` varchar(50) NOT NULL,
  `Pseudo` varchar(20) NOT NULL,
  `MotDePasse` varchar(60) NOT NULL,
  PRIMARY KEY (`IdUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IdUtilisateur`, `Email`, `Pseudo`, `MotDePasse`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin'),
(22, 'vivien.eaetetournay@outlook.fr', 'viveaat', 'cd79480c7bc8fd44fa15d329d43c7bba29aff44b'),
(21, 'vivien.eaeetournay@outlook.fr', 'viveaa', 'f882e7e2875432d43bd50e79a635d3739ac0262d');

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `IdVendeur` int(8) NOT NULL,
  `IdUtilisateur` int(8) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `Description` text NOT NULL,
  `TypeDeCarte` varchar(14) NOT NULL,
  `NumeroCarte` varchar(19) NOT NULL,
  `NomCarte` varchar(20) NOT NULL,
  `ExpirationCarte` varchar(5) NOT NULL,
  `CodedeSecurite` varchar(3) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  PRIMARY KEY (`IdVendeur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `videoitem`
--

DROP TABLE IF EXISTS `videoitem`;
CREATE TABLE IF NOT EXISTS `videoitem` (
  `IdVideo` int(8) NOT NULL AUTO_INCREMENT,
  `IdItem` int(8) NOT NULL,
  `Lien` varchar(80) NOT NULL,
  PRIMARY KEY (`IdVideo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
