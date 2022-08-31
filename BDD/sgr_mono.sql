-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 24 jan. 2022 à 16:30
-- Version du serveur :  5.7.17
-- Version de PHP :  7.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `sgr_mono`
--
CREATE DATABASE IF NOT EXISTS `SGR_mono` DEFAULT CHARACTER SET utf8 COLLATE utf8_swedish_ci;
USE `SGR_mono`;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `id_produit` int(11) NOT NULL AUTO_INCREMENT,
  `nom_produit` varchar(50) NOT NULL,
  PRIMARY KEY (`id_produit`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id_produit`, `nom_produit`) VALUES
(1, 'alcool'),
(2, 'gluten'),
(3, 'tomate'),
(4, 'mozzarella'),
(5, 'champignon'),
(6, 'oeuf'),
(7, 'lait');

-- --------------------------------------------------------

--
-- Structure de la table `boisson`
--

CREATE TABLE IF NOT EXISTS `boisson` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom_boisson` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `PU` float(11,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `boisson`
--

INSERT INTO `boisson` (`id`, `nom_boisson`, `description`, `PU`) VALUES
(1, 'pastis', ' une dose de pastis et une carafe d eau. boisson désaltérante', 5.00),
(2, 'demi', 'bière pression ou bouteille', 2.50),
(3, 'pichet 1/4 rouge', 'pichet 1/4L de vin rouge', 6.75),
(4, 'Badoit 1l ', 'bouteille d eau gazeuse Badoit 1L', 7.45),
(5, 'coca', 'canette 30cl', 2.50);

-- --------------------------------------------------------
--
-- Structure de la table `sgr_table`
--

CREATE TABLE IF NOT EXISTS `sgr_table` (
  `id_table` int(11) NOT NULL AUTO_INCREMENT,
  `numero_table` int(11) NOT NULL,
  `type_table` varchar(3) NOT NULL,
  `id_serveur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_table`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `sgr_table`
--

INSERT INTO `sgr_table` (`id_table`, `numero_table`, `type_table`,`id_serveur`) VALUES
(1, 101, 'RON',NULL),
(2, 201, 'CAR',NULL),
(3, 102, 'RON',NULL),
(4, 103, 'CAR',NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE IF NOT EXISTS `reservation` (
  `id_resa` int(11) NOT NULL AUTO_INCREMENT,
  `nom_resa` varchar(30) NOT NULL,
  `etat_resa` varchar(5) NOT NULL DEFAULT 'enreg',
  `id_table` int(11) DEFAULT NULL,
  `nb_pers` int(11) DEFAULT 0,
  `arrivee` datetime DEFAULT NULL,
  PRIMARY KEY (`id_resa`),
  KEY `reservation_ibfk_1` (`id_table`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Structure de la table `chaise`
--

CREATE TABLE IF NOT EXISTS `chaise` (
  `id_chaise` int(11) NOT NULL AUTO_INCREMENT,
  `id_resa` int(11) NOT NULL,
  `id_type_chaise` int(11) DEFAULT NULL,
  `emplacement` varchar(40) DEFAULT NULL,
  `comentaire` text,
  PRIMARY KEY (`id_chaise`),
  KEY `chaise_ibfk_1` (`id_resa`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commander_boisson_indiv`
--

CREATE TABLE IF NOT EXISTS `commander_boisson_indiv` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `id_chaise` int(11) NOT NULL,
  `id_boisson` int(11) NOT NULL,
  `quand` datetime NOT NULL,
  `etat` VARCHAR(5) DEFAULT NULL,
  PRIMARY KEY (`id_commande`,`id_chaise`),
  KEY `commander_boisson_indiv_ibfk_1` (`id_chaise`),
  KEY `commander_boisson_indiv_ibfk_2` (`id_boisson`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commander_boisson_table`
--

CREATE TABLE IF NOT EXISTS `commander_boisson_table` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `id_resa` int(11) NOT NULL,
  `id_boisson` int(11) NOT NULL,
  `quand` datetime NOT NULL,
  `etat` VARCHAR(5) DEFAULT NULL,
  PRIMARY KEY (`id_commande`,`id_resa`),
  KEY `commander_boisson_table_ibfk_1` (`id_resa`),
  KEY `commander_boisson_table_ibfk_2` (`id_boisson`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commander_menu`
--

CREATE TABLE IF NOT EXISTS `commander_menu` (
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `id_chaise` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `quand` datetime NOT NULL,
  `etat` VARCHAR(5) DEFAULT NULL,
  PRIMARY KEY (`id_commande`,`id_chaise`),
  KEY `commander_menu_ibfk_1` (`id_chaise`),
  KEY `commander_menu_ibfk_2` (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `commander_menu`
--


-- --------------------------------------------------------

--
-- Structure de la table `commander_plat`
--

CREATE TABLE IF NOT EXISTS `commander_plat` (
  `id_chaise` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL AUTO_INCREMENT,
  `id_plat` int(11) NOT NULL,
  `quand` datetime NOT NULL,
  `etat` VARCHAR(5) DEFAULT NULL,
  PRIMARY KEY (`id_commande`,`id_chaise`),
  KEY `commander_plat_ibfk_1` (`id_plat`),
  KEY `commander_plat_ibfk_2` (`id_chaise`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `contenir_boisson_produit`
--

CREATE TABLE IF NOT EXISTS `contenir_boisson_produit` (
  `id_boisson` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id_boisson`,`id_produit`),
  KEY `contenir_boisson_produit_ibfk_2` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contenir_boisson_produit`
--

INSERT INTO `contenir_boisson_produit` (`id_boisson`, `id_produit`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `plat`
--

CREATE TABLE IF NOT EXISTS `plat` (
  `id_plat` int(11) NOT NULL AUTO_INCREMENT,
  `nom_plat` varchar(50) NOT NULL DEFAULT 'nom du plat',
  `description` text NOT NULL,
  `type_plat` varchar(10) NOT NULL DEFAULT 'entplades',
  `PU_carte` float(11,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id_plat`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `plat`
--

INSERT INTO `plat` (`id_plat`, `nom_plat`, `description`, `type_plat`, `PU_carte`) VALUES
(1, 'salade verte', 'laitue, scarole...', 'entree', 8.50),
(2, 'tomate mozza', 'tomate mozzarella', 'entree', 9.00),
(3, 'pizza reine', 'patte fine, tomate, mozzarella, champignons ', 'plat', 14.50),
(4, 'iles flottante', 'iles flottante sur crème anglaise avec caramel', 'dessert', 9.30);


-- --------------------------------------------------------

--
-- Structure de la table `contenir_menu_plat`
--

CREATE TABLE IF NOT EXISTS `contenir_menu_plat` (
  `id_plat` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  PRIMARY KEY (`id_plat`,`id_menu`),
  KEY `contenir_menu_plat_produit_ibfk_2` (`id_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contenir_menu_plat`
--

INSERT INTO `contenir_menu_plat` (`id_plat`, `id_menu`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(3, 2),
(4, 2),
(1, 3),
(2, 3),
(3, 3),
(3, 7);

-- --------------------------------------------------------

--
-- Structure de la table `contenir_plat_produit`
--

CREATE TABLE IF NOT EXISTS `contenir_plat_produit` (
  `id_plat` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  PRIMARY KEY (`id_plat`,`id_produit`),
  KEY `contenir_platcarte_produit_ibfk_2` (`id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contenir_plat_produit`
--

INSERT INTO `contenir_plat_produit` (`id_plat`, `id_produit`) VALUES
(3, 2),
(2, 3),
(3, 3),
(2, 4),
(3, 4),
(3, 5),
(4, 6),
(4, 7);

-- --------------------------------------------------------

--
-- Structure de la table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `id_menu` int(11) NOT NULL AUTO_INCREMENT,
  `nom_menu` varchar(50) NOT NULL DEFAULT 'nom du menu',
  `PU` float NOT NULL DEFAULT '0',
  `description` text,
  `date_menu` date DEFAULT NULL,
  PRIMARY KEY (`id_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `menu`
--

INSERT INTO `menu` (`id_menu`, `nom_menu`, `PU`, `description`, `date_menu`) VALUES
(1, 'menu EPD', 35, 'entrée plat déssert', NULL),
(2, 'menu PD', 25, 'plat dessert', NULL),
(3, 'menu EP', 25, 'entree plat', NULL),
(7, 'menu P', 15, 'plat seul', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id_message` int(11) NOT NULL AUTO_INCREMENT,
  `id_expediteur` int(255) NOT NULL,
  `id_destinataire` varchar(255) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `lu` int(11) DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_message`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;





--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(30) NOT NULL,
  `role` varchar(30) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `image` varchar(400)  NULL,
  `status` varchar(255)  NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id_user`, `login`, `role`, `mdp`) VALUES
(1, 'test', 'boom', 'test'),
(2, 'service', 'service', 'service'),
(3, 'cuisine', 'cuisine', 'cuisine'),
(4, 'admin', 'admin', 'admin'),
(5, 'bar', 'bar', 'bar'),
(6, 's20', 'service', 's20'),
(7, 'rang', 'rang', 'rang');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `srg_table`
--
ALTER TABLE `sgr_table`
  ADD CONSTRAINT `sgr_table_ibfk_1` FOREIGN KEY (`id_serveur`) REFERENCES `user` (`id_user`);
--
-- Contraintes pour la table `chaise`
--
ALTER TABLE `chaise`
  ADD CONSTRAINT `chaise_ibfk_1` FOREIGN KEY (`id_resa`) REFERENCES `reservation` (`id_resa`);

--
-- Contraintes pour la table `commander_boisson_indiv`
--
ALTER TABLE `commander_boisson_indiv`
  ADD CONSTRAINT `commander_boisson_indiv_ibfk_1` FOREIGN KEY (`id_chaise`) REFERENCES `chaise` (`id_chaise`),
  ADD CONSTRAINT `commander_boisson_indiv_ibfk_2` FOREIGN KEY (`id_boisson`) REFERENCES `boisson` (`id`);

--
-- Contraintes pour la table `commander_boisson_table`
--
ALTER TABLE `commander_boisson_table`
  ADD CONSTRAINT `commander_boisson_table_ibfk_1` FOREIGN KEY (`id_resa`) REFERENCES `reservation` (`id_resa`),
  ADD CONSTRAINT `commander_boisson_table_ibfk_2` FOREIGN KEY (`id_boisson`) REFERENCES `boisson` (`id`);

--
-- Contraintes pour la table `commander_menu`
--
ALTER TABLE `commander_menu`
  ADD CONSTRAINT `commander_menu_ibfk_1` FOREIGN KEY (`id_chaise`) REFERENCES `chaise` (`id_chaise`),
  ADD CONSTRAINT `commander_menu_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Contraintes pour la table `commander_platcarte`
--
ALTER TABLE `commander_plat`
  ADD CONSTRAINT `commander_plat_ibfk_1` FOREIGN KEY (`id_plat`) REFERENCES `plat` (`id_plat`),
  ADD CONSTRAINT `commander_plat_ibfk_2` FOREIGN KEY (`id_chaise`) REFERENCES `chaise` (`id_chaise`);

--
-- Contraintes pour la table `contenir_boisson_produit`
--
ALTER TABLE `contenir_boisson_produit`
  ADD CONSTRAINT `contenir_boisson_produit_ibfk_1` FOREIGN KEY (`id_boisson`) REFERENCES `boisson` (`id`),
  ADD CONSTRAINT `contenir_boisson_produit_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Contraintes pour la table `contenir_menu_plat`
--
ALTER TABLE `contenir_menu_plat`
  ADD CONSTRAINT `contenir_menu_plat_produit_ibfk_1` FOREIGN KEY (`id_plat`) REFERENCES `plat` (`id_plat`),
  ADD CONSTRAINT `contenir_menu_plat_produit_ibfk_2` FOREIGN KEY (`id_menu`) REFERENCES `menu` (`id_menu`);

--
-- Contraintes pour la table `contenir_plat_produit`
--
ALTER TABLE `contenir_plat_produit`
  ADD CONSTRAINT `contenir_platcarte_produit_ibfk_1` FOREIGN KEY (`id_plat`) REFERENCES `plat` (`id_plat`),
  ADD CONSTRAINT `contenir_platcarte_produit_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Contraintes pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`id_table`) REFERENCES `sgr_table` (`id_table`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
