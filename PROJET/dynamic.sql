-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 14 Septembre 2016 à 00:24
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `dynamic`
--

-- --------------------------------------------------------

--
-- Structure de la table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `nom` varchar(63) NOT NULL,
  `prenom` varchar(20) DEFAULT NULL,
  `login` varchar(20) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `groupe` int(2) NOT NULL,
  `quota` int(20) DEFAULT NULL,
  `stock` int(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nom`, `prenom`, `login`, `pwd`, `groupe`, `quota`, `stock`) VALUES
(1, 'Système', 'Administrateur', 'admin', 'admin', 1, 10000000, 6461664),
(2, 'Lloris', 'Hugo', 'etudiant', 'etudiant', 2, 20000000, 9910219),
(3, 'Lopez', 'Fabien', 'user1', 'user1', 0, 1000000000, NULL),
(5, 'Martin', 'Nathanaël', 'tanel', 'tanel', 0, 1000000000, 3047331),
(6, 'Imfield', 'Stanley', 'imfield', 'imfield', 0, 2000000000, 0),
(7, 'Mrtn', 'Ntnl', 'ntnl', 'ntnl', 0, 1000000000, 0),
(8, 'Soft', 'Micro', 'micro', 'micro', 0, 1000000000, 0),
(9, 'Id', 'Ando', 'andro', 'andro', 0, 10000000, 1030879);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ID_2` (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
