-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 08 Septembre 2016 à 12:14
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
(60, 'attestation.pdf', 'application/pdf', 159174, 'C:\\wamp64\\tmp\\phpA700.tmp', 'upload/2/', '2016-09-02 19:18:48', 2),
(81, 'AS_400.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 66014, 'C:\\wamp64\\tmp\\phpA326.tmp', 'upload/1/', '2016-09-08 10:58:06', 1),
(82, 'ADELIA.docx', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 18171, 'C:\\wamp64\\tmp\\php55FA.tmp', 'upload/1/', '2016-09-08 12:04:24', 1),
(79, 'EXEMPLE__HARDIS_SOON_PROJ_STU_CARD_SOONxxxx_V1.0.doc', 'application/msword', 144384, 'C:\\wamp64\\tmp\\phpC036.tmp', 'upload/1/', '2016-09-07 11:35:45', 1),
(80, 'SOON_CONF_SOFT_REF_IHM-SOON-MODEL_TRADUCTION_V1.0.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 10429, 'C:\\wamp64\\tmp\\php288.tmp', 'upload/1/', '2016-09-07 12:06:37', 1),
(83, 'BUL_1509_38NMA____MARTIN_NATHANAEL00091194.pdf', 'application/pdf', 312653, 'C:\\wamp64\\tmp\\php7C20.tmp', 'upload/1/', '2016-09-08 12:04:33', 1);

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
(2, 60, 3, 0, '2016-09-02 19:50:52', 0),
(1, 81, 4, 0, '2016-09-08 10:58:14', 0),
(2, 60, 4, 0, '2016-09-02 19:50:52', 0),
(2, 60, 1, 0, '2016-09-02 19:51:55', 0),
(1, 82, 3, 0, '2016-09-08 12:08:52', 0),
(1, 80, 2, 0, '2016-09-08 10:54:52', 0),
(1, 80, 2, 0, '2016-09-08 12:08:29', 0),
(1, 81, 4, 0, '2016-09-08 12:04:57', 0),
(1, 79, 3, 0, '2016-09-08 12:08:52', 0),
(1, 80, 3, 0, '2016-09-08 12:08:52', 0),
(1, 81, 2, 0, '2016-09-08 12:08:52', 0),
(1, 83, 2, 0, '2016-09-08 12:08:52', 0),
(1, 80, 2, 0, '2016-09-08 12:08:52', 0),
(1, 81, 4, 0, '2016-09-08 12:08:52', 0),
(1, 83, 4, 0, '2016-09-08 12:08:52', 0),
(1, 79, 4, 0, '2016-09-08 12:08:52', 0);

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
(1, 'Administrateur', 'Système', 'admin', 'admin', 1, 1000000, 617665),
(2, 'Lloris', 'Hugo', 'etudiant', 'etudiant', 2, NULL, NULL),
(3, 'Bartez', 'Fabien', 'user1', 'user1', 3, NULL, NULL),
(4, 'Mandanda', 'Steve', 'user2', 'user2', 2, NULL, NULL);

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
  MODIFY `up_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
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
