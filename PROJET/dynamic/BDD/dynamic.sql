-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 15 Juin 2017 à 11:51
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

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
-- Structure de la table `tbl_files`
--

CREATE TABLE `tbl_files` (
  `up_id` int(4) NOT NULL,
  `up_filename` varchar(250) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `up_filetype` varchar(255) NOT NULL,
  `up_filesize` int(10) NOT NULL DEFAULT '0',
  `up_filetmp_name` varchar(100) NOT NULL,
  `up_filerepertory` varchar(100) NOT NULL,
  `up_filedate` datetime DEFAULT NULL,
  `up_fileuserid` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbl_files`
--

INSERT INTO `tbl_files` (`up_id`, `up_filename`, `up_filetype`, `up_filesize`, `up_filetmp_name`, `up_filerepertory`, `up_filedate`, `up_fileuserid`) VALUES
(90, 'TESTS_DEM_SOON_11610.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 132299, 'C:\\wamp64\\tmp\\phpEB23.tmp', 'upload/3/', '2017-06-15 11:39:58', 3),
(91, 'SOON-12639_PARAM_VERS_Z97.00.C_12790_V1.0.doc', 'application/msword', 1490432, 'C:\\wamp64\\tmp\\phpE13C.tmp', 'upload/3/', '2017-06-15 11:41:01', 3),
(89, 'P0013045_(1).docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 135539, 'C:\\wamp64\\tmp\\phpFF79.tmp', 'upload/3/', '2017-06-15 11:38:58', 3),
(87, 'SOON_10657_INFO.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 97949, 'C:\\wamp64\\tmp\\php4D65.tmp', 'upload/1/', '2017-06-15 11:21:49', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_group`
--

CREATE TABLE `tbl_group` (
  `id` int(4) NOT NULL,
  `group_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbl_group`
--

INSERT INTO `tbl_group` (`id`, `group_name`) VALUES
(1, 'Administrateur'),
(2, 'Employé'),
(3, 'Formateur'),
(4, 'Etudiant');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_share`
--

CREATE TABLE `tbl_share` (
  `sh_userid` int(4) NOT NULL,
  `sh_fileid` int(4) NOT NULL,
  `sh_usershid` int(4) DEFAULT NULL,
  `sh_groupshid` int(4) DEFAULT NULL,
  `sh_debdatesh` datetime DEFAULT NULL,
  `sh_findatesh` int(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbl_share`
--

INSERT INTO `tbl_share` (`sh_userid`, `sh_fileid`, `sh_usershid`, `sh_groupshid`, `sh_debdatesh`, `sh_findatesh`) VALUES
(1, 87, 3, 0, '2017-06-15 11:33:02', 0),
(1, 87, 2, 0, '2017-06-15 11:38:18', 0),
(1, 87, 3, 0, '2017-06-15 11:38:18', 0),
(3, 90, 2, 0, '2017-06-15 11:42:05', 0),
(3, 90, 4, 0, '2017-06-15 11:42:05', 0);

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
  `quota` int(200) DEFAULT NULL,
  `stock` int(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `nom`, `prenom`, `login`, `pwd`, `groupe`, `quota`, `stock`) VALUES
(1, 'Administrateur', 'Système', 'admin', 'admin', 1, 10000000, 470904),
(2, 'Lloris', 'Hugo', 'etudiant', 'etudiant', 2, 10000000, 0),
(3, 'Bartez', 'Fabien', 'user1', 'user1', 0, 500000000, 1893809),
(4, 'Mandanda', 'Steve', 'user2', 'user2', 2, 10000000, 0);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `tbl_files`
--
ALTER TABLE `tbl_files`
  ADD PRIMARY KEY (`up_id`);

--
-- Index pour la table `tbl_group`
--
ALTER TABLE `tbl_group`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pour la table `tbl_files`
--
ALTER TABLE `tbl_files`
  MODIFY `up_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;
--
-- AUTO_INCREMENT pour la table `tbl_group`
--
ALTER TABLE `tbl_group`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
