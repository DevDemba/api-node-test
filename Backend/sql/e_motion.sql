-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           10.3.12-MariaDB - mariadb.org binary distribution
-- SE du serveur:                Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Export de la structure de la base pour e_motion
CREATE DATABASE IF NOT EXISTS `e_motion` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `e_motion`;

-- Export de la structure de la table e_motion. admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table e_motion.admin : ~0 rows (environ)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Export de la structure de la table e_motion. car
CREATE TABLE IF NOT EXISTS `car` (
  `id_car` int(11) NOT NULL AUTO_INCREMENT,
  `modele` varchar(255) NOT NULL,
  PRIMARY KEY (`id_car`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table e_motion.car : ~0 rows (environ)
/*!40000 ALTER TABLE `car` DISABLE KEYS */;
/*!40000 ALTER TABLE `car` ENABLE KEYS */;

-- Export de la structure de la table e_motion. moto
CREATE TABLE IF NOT EXISTS `moto` (
  `id_moto` int(11) NOT NULL AUTO_INCREMENT,
  `modele` varchar(255) NOT NULL,
  `nb_tire` int(11) NOT NULL,
  PRIMARY KEY (`id_moto`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table e_motion.moto : ~0 rows (environ)
/*!40000 ALTER TABLE `moto` DISABLE KEYS */;
/*!40000 ALTER TABLE `moto` ENABLE KEYS */;

-- Export de la structure de la table e_motion. offer
CREATE TABLE IF NOT EXISTS `offer` (
  `id_offer` int(11) NOT NULL AUTO_INCREMENT,
  `id_vehicle` int(11) NOT NULL,
  `date_online_offer` date NOT NULL,
  `date_end_offer` date NOT NULL,
  `date_update_offer` date NOT NULL,
  `price_offer` int(11) NOT NULL,
  PRIMARY KEY (`id_offer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table e_motion.offer : ~0 rows (environ)
/*!40000 ALTER TABLE `offer` DISABLE KEYS */;
/*!40000 ALTER TABLE `offer` ENABLE KEYS */;

-- Export de la structure de la table e_motion. rental
CREATE TABLE IF NOT EXISTS `rental` (
  `id_rental` int(11) NOT NULL AUTO_INCREMENT,
  `id_users` int(11) NOT NULL,
  `id_offer` int(11) NOT NULL,
  `start_rental_date` date NOT NULL,
  `end_rental_date` date NOT NULL,
  `back_rental_date` date NOT NULL,
  PRIMARY KEY (`id_rental`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table e_motion.rental : ~0 rows (environ)
/*!40000 ALTER TABLE `rental` DISABLE KEYS */;
/*!40000 ALTER TABLE `rental` ENABLE KEYS */;

-- Export de la structure de la table e_motion. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` int(11) NOT NULL,
  `license_driver` varchar(255) NOT NULL,
  `point` int(11) DEFAULT 0,
  `register_date` datetime NOT NULL DEFAULT current_timestamp(),
  `gender` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Export de données de la table e_motion.users : ~4 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `lastname`, `firstname`, `birthday`, `address`, `phone`, `license_driver`, `point`, `register_date`, `gender`, `email`, `password`, `is_admin`) VALUES
	(7, 'Demba', 'DIA', '2019-07-10', '30 Rue Montéra', 783438693, 'eeeee', 0, '2019-07-22 14:40:29', 'Male', 'm.demba.dia@gmail.com', '$2b$08$5/U7h6lr3APs2eaME3MKqu/1rxwOHkvzA35Tgl2ZRz1KfY55JM7eG', NULL),
	(8, 'noreez ', 'noreez', '2019-07-10', 'pakistan', 23656256, 'oui', 0, '2019-07-22 14:46:15', 'Female', 'noreez@gmail.fr', '$2b$08$eb8.6seLij.urb45RJf8I.HLi1pM9yX2ix3X6AEBfhHvp4OkrUJra', NULL),
	(9, 'test', 'test', '2019-07-03', '30 rue de paris', 643679456, 'non', 0, '2019-07-22 14:58:49', 'Male', 'test@gmail.com', '$2b$08$8ufb3Cco6ZRgdC/0SJrfFOzPNZ1RMl4PRRxyMdyXMwTBo/sY4QkR2', NULL),
	(10, 'admin', 'admin', '2019-07-17', 'vue', 120436879, 'oui', 0, '2019-07-22 16:45:33', 'Male', 'admin@gmail.com', '$2b$08$5VOeRtzbNfdfAZBgv6puvub0u9Vxd8/WZtNRgat5t6qKkHu2TPmgm', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Export de la structure de la table e_motion. vehicles
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id_vehicle` int(11) NOT NULL AUTO_INCREMENT,
  `marque` varchar(255) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `color` varchar(64) NOT NULL,
  `nb_plate` varchar(255) NOT NULL,
  `nb_kilometer` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `price` int(11) NOT NULL,
  `available` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_vehicle`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Export de données de la table e_motion.vehicles : ~0 rows (environ)
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
