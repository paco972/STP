-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 22 mars 2023 à 08:47
-- Version du serveur :  10.3.32-MariaDB
-- Version de PHP : 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `stp`
--

-- --------------------------------------------------------

--
-- Structure de la table `connexion`
--

CREATE TABLE `connexion` (
  `id` int(10) NOT NULL,
  `idEtudiant` int(10) NOT NULL,
  `idMaquette` int(10) NOT NULL,
  `debut` timestamp NULL DEFAULT current_timestamp(),
  `fin` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `connexion`
--

INSERT INTO `connexion` (`id`, `idEtudiant`, `idMaquette`, `debut`, `fin`) VALUES
(1, 15, 1, '2021-05-24 12:59:10', '2021-05-24 13:12:42'),
(3, 15, 3, '2021-05-24 13:05:09', '2021-05-24 13:11:56'),
(4, 3, 5, '2021-05-26 14:18:48', '2021-05-26 14:20:51');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id` int(10) NOT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `user` varchar(25) DEFAULT NULL,
  `pwd` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `etudiant`
--

CREATE TABLE `etudiant` (
  `id` int(10) NOT NULL,
  `nom` varchar(25) DEFAULT NULL,
  `prenom` varchar(25) DEFAULT NULL,
  `user` varchar(25) DEFAULT NULL,
  `pwd` varchar(128) DEFAULT NULL,
  `section` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `etudiant`
--

INSERT INTO `etudiant` (`id`, `nom`, `prenom`, `user`, `pwd`, `section`) VALUES
(1, 'MAUGEE', 'Killian', '', '1234', 'SN2'),
(2, 'CHERUBIN', 'Arnaud', '', 'uccw@nZv2', 'SN2'),
(3, 'HILLION', 'Yannik', '', '76kyffXTiy', 'SN2'),
(4, 'VATON', 'Melvyn', '', '77Th5NcWbk', 'SN2'),
(5, 'OLIVIERI', 'Kenji', '', '@T0K#xVUI', 'SN2'),
(6, 'LAGRAND', 'Mathis', '', 'ppPjcH8Krp', 'SN2'),
(7, 'CARIN', 'Matthew', '', 'K891Y6n5zO', 'SN2'),
(8, 'DELRIC', 'Elie', '', '2TJIq$7YR&pe0a8g', 'SN2'),
(14, 'TOTO', 'TITI', 'tototiti', '123456', 'SN2'),
(15, 'TOTO', 'Titi', 'tototiti', '$2y$10$0WEhdAohJz9JsHBwTj.FB.Ub39qUkOB0q12j1tblbv62wlFmBYaoK', 'SN2'),
(16, 'TERIEUR', 'Alex', 'alexterieur', '$2y$10$f3FEv1TyuT4eO6CfPQBtO.vApMG331RIaAJjA1swfNgKnlZKSoKdy', 'SN1'),
(17, 'TERIEUR', 'Alain', 'alainterieur', '$2y$10$cu.kG7PtOQ7kcI1obIsfqu8I96D29MWZUrdK611NsGzItwUAtDJRa', 'SN1');

-- --------------------------------------------------------

--
-- Structure de la table `maquette`
--

CREATE TABLE `maquette` (
  `id` int(10) NOT NULL,
  `type` varchar(25) DEFAULT NULL,
  `disponible` tinyint(1) NOT NULL DEFAULT 1,
  `adresseIP` varchar(25) NOT NULL DEFAULT '0.0.0.0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `maquette`
--

INSERT INTO `maquette` (`id`, `type`, `disponible`, `adresseIP`) VALUES
(1, 'Raspberry pi 3', 1, '192.168.1.151'),
(2, 'Raspberry pi 3', 1, '192.168.1.152'),
(3, 'Raspberry pi 3', 1, '192.168.1.153'),
(4, 'Raspberry pi 3', 1, '192.168.1.154'),
(5, 'Raspberry pi 3', 1, '192.168.1.155'),
(6, 'Raspberry pi 3', 1, '192.168.1.156'),
(7, 'Raspberry pi 3', 1, '192.168.1.157');

-- --------------------------------------------------------

--
-- Structure de la table `tp`
--

CREATE TABLE `tp` (
  `id` int(10) NOT NULL,
  `titre` varchar(255) DEFAULT NULL,
  `difficulte` int(11) NOT NULL DEFAULT 1,
  `duree` float NOT NULL,
  `urlSujet` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tp`
--

INSERT INTO `tp` (`id`, `titre`, `difficulte`, `duree`, `urlSujet`) VALUES
(1, 'Telemesure de Consommation Electrique - Collecte des donnees', 2, 2, './sujets/TCE_TP1.pdf'),
(2, 'Telemesure de Consommation Electrique - Affichage sur un tableau de bord', 1, 2, './sujets/TCE_TP2.pdf'),
(3, 'Telemesure de Consommation Electrique - Stockage des donnees en base', 4, 3, './sujets/TCE_TP3.pdf'),
(4, 'Telemesure de Consommation Electrique - Affichage des statistiques', 5, 4, './sujets/TCE_TP4.pdf');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `connexion`
--
ALTER TABLE `connexion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKconnexion523011` (`idMaquette`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `maquette`
--
ALTER TABLE `maquette`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tp`
--
ALTER TABLE `tp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `connexion`
--
ALTER TABLE `connexion`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `etudiant`
--
ALTER TABLE `etudiant`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `maquette`
--
ALTER TABLE `maquette`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `tp`
--
ALTER TABLE `tp`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
