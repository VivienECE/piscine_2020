-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 16 avr. 2020 à 15:20
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
  `ImageProfil` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdAcheteur`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`IdAcheteur`, `IdUtilisateur`, `Nom`, `Prenom`, `Adresse`, `CodePostal`, `Pays`, `Telephone`, `TypeDeCarte`, `NumeroCarte`, `NomCarte`, `ExpirationCarte`, `CodedeSecurite`, `ImageProfil`) VALUES
(1, 22, 'Vivien', 'DET', '5 allÃ©e', '91090', 'EEEEEEE', '11111111111111111111', 'visa', '1111111111111111111', '22222222', '05/21', '222', NULL),
(2, 23, '', '', '', '', '', '99999999999', 'visa', '7777777777777777777', '777', '10/20', '777', NULL),
(3, 24, 'vvvv', 'vvvv', 'vvv', '00000', 'ffff', '99999999999', 'visa', '7777777777777777777', '777', '10/20', '777', NULL),
(4, 25, 'eeeee', 'eeeeeeeee', 'eeeeeeee', '44444', '3333333333', '333333333333333333', 'visa', '3333333333333333333', 'E333', '02/20', '333', NULL),
(5, 26, 'tesst', 'tesst', 'tesst', '222222', 'tesst', '22222222222222', 'visa', '2222222222222222222', 'tesst', '01/20', '222', NULL),
(6, 28, 'eeeeeeee', 'eeeeeeeee', 'eeeeeeeee', '44444', '44444', '4444444', 'visa', '444444444444444', '4444', '03/22', '444', NULL);

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
  `Image` varchar(255) DEFAULT NULL,
  `Video` varchar(255) DEFAULT NULL,
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
  `Email` varchar(50) DEFAULT NULL,
  `Pseudo` varchar(20) NOT NULL,
  `MotDePasse` varchar(60) NOT NULL,
  PRIMARY KEY (`IdUtilisateur`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IdUtilisateur`, `Email`, `Pseudo`, `MotDePasse`) VALUES
(26, 'test@gmail.com', 'test', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(45, NULL, 'testaezaez2', '154606927db7c898fcbc7f13fe20d495454cf2d7'),
(46, NULL, 'testezasdaz3', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(47, NULL, 'vivioo', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(48, NULL, 'testzaz', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(49, NULL, 'testzdaddqs', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(50, NULL, 'testfazsq', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(51, NULL, 'testazrfaed', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(52, NULL, 'testzazesadaz', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(53, NULL, 'testezadazd', '70c39dd13150a26cb73160899a46d05304b7b1db'),
(54, NULL, 'azeazeeazaze', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(55, NULL, 'testzaaezeaz', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(56, NULL, 'testazeaezeaza', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(57, NULL, 'testaeadseaze', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(58, NULL, 'testazeasdsaze', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(59, NULL, 'testzaeaz', '036455fb3ea0e5ca05e14970dad9e710fae9a911'),
(60, NULL, 'testrzrrazarz', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(61, NULL, 'testrsdfsqsd', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(62, NULL, 'testazdasd', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(63, NULL, 'testazeazdsq', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(64, NULL, 'testazeazdsqe', '3b29d9ff9ebedbe619f3b45efd411101dd6af3b6'),
(65, NULL, 'testazeazdseqe', '3b29d9ff9ebedbe619f3b45efd411101dd6af3b6'),
(66, NULL, 'testazedsa', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(67, NULL, 'testzqdsqdzq', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a');

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `IdVendeur` int(8) NOT NULL AUTO_INCREMENT,
  `IdUtilisateur` int(8) NOT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `ImageProfil` varchar(255) DEFAULT NULL,
  `ImageFond` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdVendeur`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
