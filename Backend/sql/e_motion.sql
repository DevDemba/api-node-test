SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `e_motion`
--

-- --------------------------------------------------------

-- DROP DATABASE IF EXISTS e_motion;
-- CREATE DATABASE IF NOT EXISTS e_motion;

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--
DROP TABLE IF EXISTS admins;
CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `cars`
--
DROP TABLE IF EXISTS cars;
CREATE TABLE `cars` (
  `id_car` int(11) NOT NULL,
  `modele` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `motos`
--
DROP TABLE IF EXISTS motos;
CREATE TABLE `motos` (
  `id_moto` int(11) NOT NULL,
  `modele` varchar(255) NOT NULL,
  `nb_tire` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `offers`
--
DROP TABLE IF EXISTS offers;
CREATE TABLE `offers` (
  `id_offer` int(11) NOT NULL,
  `id_vehicle` int(11) NOT NULL,
  `date_online_offer` date NOT NULL,
  `date_end_offer` date NOT NULL,
  `date_update_offer` date NOT NULL,
  `price_offer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `rentals`
--
DROP TABLE IF EXISTS rentals;
CREATE TABLE `rentals` (
  `id_rental` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `id_offer` int(11) NOT NULL,
  `start_rental_date` date NOT NULL,
  `end_rental_date` date NOT NULL,
  `back_rental_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--
DROP TABLE IF EXISTS users;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `license_driver` varchar(255) NOT NULL,
  `point` int(11) NOT NULL,
  `register_date` date NOT NULL,
  `gender` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vehicles`
--
DROP TABLE IF EXISTS vehicles;
CREATE TABLE `vehicles` (
  `id_vehicle` int(11) NOT NULL,
  `marque` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `color` varchar(64) NOT NULL,
  `nb_plate` varchar(255) NOT NULL,
  `nb_kilometer` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `price` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Index pour la table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id_car`);

--
-- Index pour la table `moto`
--
ALTER TABLE `motos`
  ADD PRIMARY KEY (`id_moto`);

--
-- Index pour la table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id_offer`);

--
-- Index pour la table `rentals`
--
ALTER TABLE `rentals`
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
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `cars`
--
ALTER TABLE `cars`
  MODIFY `id_car` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `motos`
--
ALTER TABLE `motos`
  MODIFY `id_moto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `offers`
--
ALTER TABLE `offers`
  MODIFY `id_offer` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id_rental` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id_vehicle` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
