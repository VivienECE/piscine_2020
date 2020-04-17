-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  ven. 17 avr. 2020 à 02:17
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
  `IdItem` int(8) NOT NULL,
  `PrixFinal` varchar(255) NOT NULL,
  `DateFin` date NOT NULL,
  PRIMARY KEY (`IdAchatImmediat`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `achatimmediat`
--

INSERT INTO `achatimmediat` (`IdAchatImmediat`, `IdItem`, `PrixFinal`, `DateFin`) VALUES
(1, 2, '2000', '2020-04-16'),
(2, 4, '80', '2020-04-30'),
(3, 5, '80', '2020-04-30');

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `acheteur`
--

INSERT INTO `acheteur` (`IdAcheteur`, `IdUtilisateur`, `Nom`, `Prenom`, `Adresse`, `CodePostal`, `Pays`, `Telephone`, `TypeDeCarte`, `NumeroCarte`, `NomCarte`, `ExpirationCarte`, `CodedeSecurite`, `ImageProfil`) VALUES
(1, 22, 'Vivien', 'DET', '5 allÃ©e', '91090', 'EEEEEEE', '11111111111111111111', 'visa', '1111111111111111111', '22222222', '05/21', '222', NULL),
(2, 23, '', '', '', '', '', '99999999999', 'visa', '7777777777777777777', '777', '10/20', '777', NULL),
(3, 24, 'vvvv', 'vvvv', 'vvv', '00000', 'ffff', '99999999999', 'visa', '7777777777777777777', '777', '10/20', '777', NULL),
(4, 25, 'eeeee', 'eeeeeeeee', 'eeeeeeee', '44444', '3333333333', '333333333333333333', 'visa', '3333333333333333333', 'E333', '02/20', '333', NULL),
(5, 26, 'tesst', 'tesst', 'tesst', '222222', 'tesst', '22222222222222', 'visa', '2222222222222222222', 'tesst', '01/20', '222', NULL),
(6, 28, 'eeeeeeee', 'eeeeeeeee', 'eeeeeeeee', '44444', '44444', '4444444', 'visa', '444444444444444', '4444', '03/22', '444', NULL),
(7, 72, '11111111111111111', '11111111111111111', '1111111111111111111111111111111111', '1111111111', '11111111111111111', '11111111111111111', 'visa', '1111111111111111111', '11111111111111111', '01/20', '111', 'images/compte.png'),
(8, 73, '11111111111111111', '11111111111111111', '1111111111111111111111111111111111', '1111111111', '11111111111111111', '11111111111111111', 'visa', '1111111111111111111', '11111111111111111', '01/20', '111', ''),
(9, 74, '11111111111111111', '11111111111111111', '1111111111111111111111111111111111', '1111111111', '11111111111111111', '11111111111111111', 'visa', '1111111111111111111', '11111111111111111', '01/20', '111', '../acheteur/images/imageprofil_74.jpg');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `enchere`
--

INSERT INTO `enchere` (`IdEnchere`, `IdItem`, `DateDebut`, `DateFin`, `PrixFinal`) VALUES
(1, 1, '2020-04-16', '2020-04-22', 150),
(2, 6, '2020-04-17', '2020-04-30', 300),
(3, 8, '2020-04-17', '2020-04-30', 1500);

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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`IdItem`, `IdVendeur`, `Nom`, `Description`, `Categorie`, `PrixInitial`, `Date`, `Statut`, `Image`, `Video`) VALUES
(1, 70, 'Montre de luxe', 'Montre de mon arrière, arrière...grand-père. En état de marche.', 'musee', 150, '2020-04-16', 'vente', '../items/images/item_1.png', NULL),
(2, 56, 'New York', 'Peinture à l\'huile', 'musee', 1000, '2020-04-16', 'vente', '../items/images/item_2.png', NULL),
(3, 45, 'Bidonville', 'Illustration', 'musee', 90, '2020-04-17', 'vente', '../items/images/item_3.png', NULL),
(4, 45, 'Strange Farm', 'Illustration', 'musee', 80, '2020-04-17', 'vente', '../items/images/item_4.png', NULL),
(5, 45, 'Futuristic Street', 'Illustration', 'musee', 80, '2020-04-17', 'vente', '../items/images/item_5.png', NULL),
(6, 45, 'Rapiere', 'Rapiere du XVII', 'musee', 300, '2020-04-17', 'vente', '../items/images/item_6.png', NULL),
(7, 45, 'Solitude Falling', 'Illustration', 'musee', 80, '2020-04-17', 'vente', '../items/images/item_7.png', NULL),
(8, 78, 'Bague', 'Bague en diamant', 'musee', 1500, '2020-04-17', 'vente', '../items/images/item_8', NULL),
(9, 78, 'Piece Antique', 'Piece Antique', 'musee', 35, '2020-04-17', 'vente', '../items/images/item_9', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `meilleureoffre`
--

DROP TABLE IF EXISTS `meilleureoffre`;
CREATE TABLE IF NOT EXISTS `meilleureoffre` (
  `IdMeilleurOffre` int(8) NOT NULL AUTO_INCREMENT,
  `IdItem` int(8) NOT NULL,
  `DateFin` date NOT NULL,
  `PrixFinal` int(8) NOT NULL,
  PRIMARY KEY (`IdMeilleurOffre`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `meilleureoffre`
--

INSERT INTO `meilleureoffre` (`IdMeilleurOffre`, `IdItem`, `DateFin`, `PrixFinal`) VALUES
(1, 3, '2020-04-17', 90),
(2, 7, '2020-04-30', 78),
(3, 9, '2020-04-30', 30);

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
) ENGINE=MyISAM AUTO_INCREMENT=75 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IdUtilisateur`, `Email`, `Pseudo`, `MotDePasse`) VALUES
(26, 'test@gmail.com', 'test', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(74, 'o2o3k@outlook.fr', '111111111122', '7ecece7e9354b71ce40f31fe1d02316985157fb0'),
(73, 'o2ok@outlook.fr', '11111111112', '7ecece7e9354b71ce40f31fe1d02316985157fb0'),
(72, 'outloook.outlook@outlook.fr', '11111111111111', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(71, NULL, 'testeeee', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(70, NULL, 'vendeur8', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(69, NULL, 'vendeur3', '4ee6cbf5889832fd1f11e22976e5330e0e97cf20'),
(68, NULL, 'vendeur2', '4ee6cbf5889832fd1f11e22976e5330e0e97cf20'),
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
