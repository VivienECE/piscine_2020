-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `achatimmediat`
--

INSERT INTO `achatimmediat` (`IdAchatImmediat`, `IdItem`, `PrixFinal`, `DateFin`) VALUES
(1, 2, '2000', '2020-04-16'),
(2, 4, '80', '2020-04-30'),
(3, 5, '80', '2020-04-30'),
(4, 10, '200', '2020-04-30'),
(5, 11, '200', '2020-04-30'),
(6, 12, '200', '2020-04-30');

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

(1, 1, 'DURANT', 'Vincent', '5 allÃ©e des peupliers', '91000', 'France', '0938732343', 'visa', '2346472437243777', 'Detournay', '05/21', '333', 'images/imageprofil_1');

(1, 1, 'Vivien', 'DETOURNAY', '5 allÃ©e', '91090', 'France', '0193093283', 'visa', '3823234432213', 'Detournay', '05/21', '222', 'images/imageprofil_1');


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
-- Structure de la table `commandes`
--

DROP TABLE IF EXISTS `commandes`;
CREATE TABLE IF NOT EXISTS `commandes` (
  `IdCommande` int(8) NOT NULL AUTO_INCREMENT,
  `IdItem` int(8) NOT NULL,
  `IdAcheteur` int(8) NOT NULL,
  `NomPrenom` varchar(255) NOT NULL,
  `Adresse` varchar(255) NOT NULL,
  `CP` varchar(255) NOT NULL,
  `Pays` varchar(255) NOT NULL,
  `Livraison` date NOT NULL,
  `Prix` varchar(255) NOT NULL,
  PRIMARY KEY (`IdCommande`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`IdCommande`, `IdItem`, `IdAcheteur`, `NomPrenom`, `Adresse`, `CP`, `Pays`, `Livraison`, `Prix`) VALUES
(8, 5, 1, 'Vivien DETOURNAY', '5 allÃ©e', '91090', 'France', '2020-04-25', '80'),
(9, 4, 1, 'Vivien DETOURNAY', '5 allÃ©e', '91090', 'France', '2020-04-25', '80'),
(10, 2, 1, 'Vivien DETOURNAY', '5 allÃ©e', '91090', 'France', '2020-04-25', '2000');

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
-- Structure de la table `favoris`
--

DROP TABLE IF EXISTS `favoris`;
CREATE TABLE IF NOT EXISTS `favoris` (
  `IdFavoris` int(8) NOT NULL AUTO_INCREMENT,
  `IdAcheteur` int(8) NOT NULL,
  `IdItem` int(8) NOT NULL,
  PRIMARY KEY (`IdFavoris`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`IdFavoris`, `IdAcheteur`, `IdItem`) VALUES
(74, 1, 6),
(76, 1, 11);
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

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
  `Statut` varchar(255) NOT NULL COMMENT 'vendu/attente/proposition...',
  `Image` varchar(255) DEFAULT NULL,
  `Video` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdItem`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `item`
--

INSERT INTO `item` (`IdItem`, `IdVendeur`, `Nom`, `Description`, `Categorie`, `PrixInitial`, `Date`, `Statut`, `Image`, `Video`) VALUES
(1, 1, 'Montre de luxe', 'Montre de mon arrière, arrière...grand-père. En état de marche.', 'accessoire', 150, '2020-04-16', 'En cours!', '../items/images/item_1.png', NULL),

(2, 1, 'New York', 'Peinture à l\'huile', 'musee', 1000, '2020-04-16', 'Vendu!', '../items/images/item_2.png', NULL),
(3, 1, 'Bidonville', 'Illustration', 'musee', 90, '2020-04-17', 'En cours!', '../items/images/item_3.png', NULL),
(4, 1, 'Strange Farm', 'Illustration', 'musee', 80, '2020-04-17', 'Vendu!', '../items/images/item_4.png', NULL),
(5, 1, 'Futuristic Street', 'Illustration', 'musee', 80, '2020-04-17', 'Vendu!', '../items/images/item_5.png', NULL),

(2, 1, 'New York', 'Peinture à l\'huile', 'musee', 1000, '2020-04-16', 'En cours!', '../items/images/item_2.png', NULL),
(3, 1, 'Bidonville', 'Illustration', 'musee', 90, '2020-04-17', 'En cours!', '../items/images/item_3.png', NULL),
(4, 1, 'Strange Farm', 'Illustration', 'musee', 80, '2020-04-17', 'En cours!', '../items/images/item_4.png', NULL),
(5, 1, 'Futuristic Street', 'Illustration', 'musee', 80, '2020-04-17', 'En cours!', '../items/images/item_5.png', NULL),

(6, 1, 'Rapiere', 'Rapiere du XVII', 'musee', 300, '2020-04-17', 'En cours!', '../items/images/item_6.png', NULL),
(7, 45, 'Solitude Falling', 'Illustration', 'musee', 80, '2020-04-17', 'En cours!', '../items/images/item_7.png', NULL),
(8, 78, 'Bague', 'Bague en diamant', 'accessoire', 1500, '2020-04-17', 'En cours!', '../items/images/item_8.png', NULL),
(9, 78, 'Piece Antique', 'Piece Antique', 'tresor', 35, '2020-04-17', 'En cours!', '../items/images/item_9', NULL),
(12, 2, 'Paysage Futuriste', 'Illustration', 'musee', 0, '2020-04-19', 'En cours!', '../items/images/item_12', NULL),
(11, 2, 'Vallee Enneigee', 'Illustration', 'musee', 0, '2020-04-19', 'En cours!', '../items/images/item_11', NULL),
(10, 2, 'Vallee Futuriste', 'Illustration', 'musee', 0, '2020-04-19', 'En cours!', '../items/images/item_10', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `meilleureoffre`
--

DROP TABLE IF EXISTS `meilleureoffre`;
CREATE TABLE IF NOT EXISTS `meilleureoffre` (
  `IdMeilleureOffre` int(8) NOT NULL AUTO_INCREMENT,
  `IdItem` int(8) NOT NULL,
  `DateFin` date NOT NULL,
  `PrixFinal` int(8) NOT NULL,
  PRIMARY KEY (`IdMeilleureOffre`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `meilleureoffre`
--

INSERT INTO `meilleureoffre` (`IdMeilleureOffre`, `IdItem`, `DateFin`, `PrixFinal`) VALUES
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
  `Date` date DEFAULT NULL,
  `Prix` int(8) NOT NULL,
  PRIMARY KEY (`IdNegociation`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `negocie`
--

INSERT INTO `negocie` (`IdNegociation`, `IdVendeur`, `IdAcheteur`, `IdMeilleureOffre`, `EtapeNegociation`, `Date`, `Prix`) VALUES
(4, 78, 1, 3, 1, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `offreenchere`
--

DROP TABLE IF EXISTS `offreenchere`;
CREATE TABLE IF NOT EXISTS `offreenchere` (
  `IdOffre` int(8) NOT NULL AUTO_INCREMENT,
  `IdEnchere` int(8) NOT NULL,
  `IdAcheteur` int(8) NOT NULL,
  `Date` int(11) DEFAULT NULL,
  `Prix` int(8) NOT NULL,
  PRIMARY KEY (`IdOffre`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `offreenchere`
--

INSERT INTO `offreenchere` (`IdOffre`, `IdEnchere`, `IdAcheteur`, `Date`, `Prix`) VALUES
(2, 2, 1, NULL, 2),
(3, 1, 1, NULL, 85),
(5, 3, 1, NULL, 35);

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
-- Structure de la table `selectionne`
--

DROP TABLE IF EXISTS `selectionne`;
CREATE TABLE IF NOT EXISTS `selectionne` (
  `IdSelectionne` int(8) NOT NULL AUTO_INCREMENT,
  `IdAcheteur` int(8) NOT NULL,
  `IdAchatImmediat` int(8) NOT NULL,
  PRIMARY KEY (`IdSelectionne`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `selectionne`
--

INSERT INTO `selectionne` (`IdSelectionne`, `IdAcheteur`, `IdAchatImmediat`) VALUES
(28, 1, 5);

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
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`IdUtilisateur`, `Email`, `Pseudo`, `MotDePasse`) VALUES
(1, 'acheteur@gmail.com', 'acheteur', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(2, 'vendeur@gmail.com', 'vendeur', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a'),
(3, 'vendeur2@gmail.com', 'Trysha', '01b307acba4f54f55aafc33bb06bbbf6ca803e9a');

-- --------------------------------------------------------

--
-- Structure de la table `vendeur`
--

DROP TABLE IF EXISTS `vendeur`;
CREATE TABLE IF NOT EXISTS `vendeur` (
  `IdVendeur` int(8) NOT NULL AUTO_INCREMENT,
  `IdUtilisateur` int(8) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `ImageProfil` varchar(255) DEFAULT NULL,
  `ImageFond` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IdVendeur`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vendeur`
--

INSERT INTO `vendeur` (`IdVendeur`, `IdUtilisateur`, `Nom`, `Prenom`, `ImageProfil`, `ImageFond`) VALUES
(1, 2, 'PIERRE', 'Loic', '../items/profil/imageprofil_1.png\r\n', NULL),
(2, 3, 'SIMONS', 'Trysha', '../items/profil/imageprofil_2.png\r\n', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
