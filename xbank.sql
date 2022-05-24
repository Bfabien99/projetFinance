-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mar. 24 mai 2022 à 18:14
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `xbank`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenoms` varchar(100) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id`, `nom`, `prenoms`, `contact`, `email`, `password`) VALUES
(1, 'Konan', 'Arsène', '0709167244', 'arsenesaie@gmail.com', 'f64ba71a5d1ccd651a3d742b1e9c5c77');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenoms` varchar(100) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` text NOT NULL,
  `solde` int(11) NOT NULL DEFAULT 0,
  `date_creation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenoms`, `contact`, `email`, `password`, `solde`, `date_creation`) VALUES
(8, 'Brou', 'Kouadio Stéphane Fabien', '0153148864', 'Fabienbrou99@gmail.com', '8082b382bea4c85367617e7271768276', 6300, '2022-05-23 15:07:08'),
(10, 'Brou', 'FfffEEFEF Ef', '', 'Maredo6101@doerma.com', '8843028fefce50a6de50acdf064ded27', 0, '2022-05-24 10:41:30'),
(11, 'Taryn Nolan', 'Prttra Wunscdd', '6217310775', 'Your.email+fakedata15377@gmail.com', 'd17a77691095a32bc500279675aeadd2', 0, '2022-05-24 10:43:34');

-- --------------------------------------------------------

--
-- Structure de la table `depot`
--

CREATE TABLE `depot` (
  `depot_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `somme` int(11) NOT NULL,
  `date_depot` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `depot`
--

INSERT INTO `depot` (`depot_id`, `client_id`, `somme`, `date_depot`) VALUES
(1, 8, 20000, '2022-05-24 16:02:06'),
(2, 8, 2000, '2022-05-24 16:03:42');

-- --------------------------------------------------------

--
-- Structure de la table `historiques`
--

CREATE TABLE `historiques` (
  `historique_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `somme` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `historiques`
--

INSERT INTO `historiques` (`historique_id`, `client_id`, `somme`, `type`, `date`) VALUES
(1, 8, 20000, 'depot', '2022-05-24 16:02:06'),
(2, 8, 12000, 'retrait', '2022-05-24 16:03:15'),
(3, 8, 2000, 'depot', '2022-05-24 16:03:42'),
(4, 8, 1500, 'retrait', '2022-05-24 16:03:57'),
(5, 8, 1200, 'retrait', '2022-05-24 16:10:22'),
(6, 8, 1000, 'retrait', '2022-05-24 16:11:13');

-- --------------------------------------------------------

--
-- Structure de la table `retrait`
--

CREATE TABLE `retrait` (
  `retrait_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `somme` int(11) NOT NULL,
  `date_retrait` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `retrait`
--

INSERT INTO `retrait` (`retrait_id`, `client_id`, `somme`, `date_retrait`) VALUES
(1, 8, 12000, '2022-05-24 16:03:15'),
(2, 8, 1500, '2022-05-24 16:03:57'),
(3, 8, 1200, '2022-05-24 16:10:22'),
(4, 8, 1000, '2022-05-24 16:11:13');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `depot`
--
ALTER TABLE `depot`
  ADD PRIMARY KEY (`depot_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `historiques`
--
ALTER TABLE `historiques`
  ADD PRIMARY KEY (`historique_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Index pour la table `retrait`
--
ALTER TABLE `retrait`
  ADD PRIMARY KEY (`retrait_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `depot`
--
ALTER TABLE `depot`
  MODIFY `depot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `historiques`
--
ALTER TABLE `historiques`
  MODIFY `historique_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `retrait`
--
ALTER TABLE `retrait`
  MODIFY `retrait_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `depot`
--
ALTER TABLE `depot`
  ADD CONSTRAINT `depot_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `historiques`
--
ALTER TABLE `historiques`
  ADD CONSTRAINT `historiques_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `retrait`
--
ALTER TABLE `retrait`
  ADD CONSTRAINT `retrait_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
