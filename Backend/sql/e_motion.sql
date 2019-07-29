-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 29 juil. 2019 à 10:35
-- Version du serveur :  10.3.16-MariaDB
-- Version de PHP :  7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `e_motion`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `car`
--

CREATE TABLE `car` (
  `id_car` int(11) NOT NULL,
  `modele` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `moto`
--

CREATE TABLE `moto` (
  `id_moto` int(11) NOT NULL,
  `modele` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_tire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `offer`
--

CREATE TABLE `offer` (
  `id_offer` int(11) NOT NULL,
  `id_vehicle` int(11) NOT NULL,
  `date_online_offer` date NOT NULL,
  `date_end_offer` date NOT NULL,
  `date_update_offer` date NOT NULL,
  `price_offer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rental`
--

CREATE TABLE `rental` (
  `id_rental` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_offer` int(11) NOT NULL,
  `start_rental_date` date NOT NULL,
  `end_rental_date` date NOT NULL,
  `back_rental_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` int(11) NOT NULL,
  `license_driver` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `point` int(11) DEFAULT 0,
  `register_date` datetime NOT NULL DEFAULT current_timestamp(),
  `gender` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_admin` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `birthday`, `address`, `phone`, `license_driver`, `point`, `register_date`, `gender`, `email`, `password`, `is_admin`) VALUES
(7, 'Demba', 'DIA', '2019-07-10', '30 Rue Montéra', 783438693, 'eeeee', 0, '2019-07-22 14:40:29', 'Male', 'm.demba.dia@gmail.com', '$2b$08$5/U7h6lr3APs2eaME3MKqu/1rxwOHkvzA35Tgl2ZRz1KfY55JM7eG', NULL),
(8, 'noreez ', 'noreez', '2019-07-10', 'pakistan', 23656256, 'oui', 0, '2019-07-22 14:46:15', 'Female', 'noreez@gmail.fr', '$2b$08$eb8.6seLij.urb45RJf8I.HLi1pM9yX2ix3X6AEBfhHvp4OkrUJra', NULL),
(9, 'test', 'test', '2019-07-03', '30 rue de paris', 643679456, 'non', 0, '2019-07-22 14:58:49', 'Male', 'test@gmail.com', '$2b$08$8ufb3Cco6ZRgdC/0SJrfFOzPNZ1RMl4PRRxyMdyXMwTBo/sY4QkR2', NULL),
(10, 'admin', 'admin', '2019-07-17', 'vue', 120436879, 'oui', 0, '2019-07-22 16:45:33', 'Male', 'admin@gmail.com', '$2b$08$5VOeRtzbNfdfAZBgv6puvub0u9Vxd8/WZtNRgat5t6qKkHu2TPmgm', NULL),
(11, 'SHAH', 'Noreez', '2019-07-03', 'afafa', 888884048, 'oui', 0, '2019-07-22 17:23:36', 'Male', 'directeur@gmail', '$2b$08$lAmrOEb508yLmV6/uyc4uueyu2QhaGWnO7xq1lmmQPlvPAF2.wrT2', NULL),
(14, 'jean', 'paul', '2019-07-17', 'nice ', 2147483647, 'non', 0, '2019-07-29 10:17:07', 'Male', 'jp@gmail.coom', '$2b$08$48IFpcUGxnDFZU5w2bfCx.VHJh7/nOAQ7ZShqvSumM1VVL8WYn23C', NULL),
(15, 'lorem', 'ipsum', '2019-07-10', 'rome', 488566506, 'oui', 0, '2019-07-29 10:19:33', 'Male', 'lorem-ipsum@gmail.com', '$2b$08$gsONupEPg7jDb0pC6ogcfuEnFLaPb0U.M97RNKJX28TiEIQpyd.LS', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vehicles`
--

CREATE TABLE `vehicles` (
  `id_vehicle` int(11) NOT NULL,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_plate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_kilometer` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `price` int(11) NOT NULL,
  `available` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `vehicles`
--

INSERT INTO `vehicles` (`id_vehicle`, `image`, `marque`, `serial_number`, `color`, `nb_plate`, `nb_kilometer`, `purchase_date`, `price`, `available`) VALUES
(1, '', 'test', '0080080', '', '54008', 8048048, '2019-07-23', 100, 0),
(2, '', 'test', '0080080', '#c0c0c0', '54008', 8048048, '2019-07-23', 100, 0),
(3, '', 'test', '1650084', '#008000', '5800480', 80840880, '2019-07-13', 100, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`id_car`);

--
-- Index pour la table `moto`
--
ALTER TABLE `moto`
  ADD PRIMARY KEY (`id_moto`);

--
-- Index pour la table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id_offer`);

--
-- Index pour la table `rental`
--
ALTER TABLE `rental`
  ADD PRIMARY KEY (`id_rental`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id_vehicle`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `car`
--
ALTER TABLE `car`
  MODIFY `id_car` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `moto`
--
ALTER TABLE `moto`
  MODIFY `id_moto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `offer`
--
ALTER TABLE `offer`
  MODIFY `id_offer` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rental`
--
ALTER TABLE `rental`
  MODIFY `id_rental` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id_vehicle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
