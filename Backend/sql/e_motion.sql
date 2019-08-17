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
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table e_motion.admin : ~0 rows (environ)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Export de la structure de la table e_motion. car
CREATE TABLE IF NOT EXISTS `car` (
  `id_car` int(11) NOT NULL AUTO_INCREMENT,
  `modele` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_car`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table e_motion.car : ~0 rows (environ)
/*!40000 ALTER TABLE `car` DISABLE KEYS */;
/*!40000 ALTER TABLE `car` ENABLE KEYS */;

-- Export de la structure de la table e_motion. moto
CREATE TABLE IF NOT EXISTS `moto` (
  `id_moto` int(11) NOT NULL AUTO_INCREMENT,
  `modele` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_tire` int(11) NOT NULL,
  PRIMARY KEY (`id_moto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table e_motion.rental : ~0 rows (environ)
/*!40000 ALTER TABLE `rental` DISABLE KEYS */;
/*!40000 ALTER TABLE `rental` ENABLE KEYS */;

-- Export de la structure de la table e_motion. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `is_admin` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table e_motion.users : ~7 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `lastname`, `firstname`, `birthday`, `address`, `phone`, `license_driver`, `point`, `register_date`, `gender`, `email`, `password`, `is_admin`) VALUES
	(7, 'Demba', 'DIA', '2019-07-10', '30 rue de la paix', 783438693, 'eeeee', 0, '2019-07-22 14:40:29', 'Male', 'm.demba.dia@gmail.com', '$2b$08$5/U7h6lr3APs2eaME3MKqu/1rxwOHkvzA35Tgl2ZRz1KfY55JM7eG', NULL),
	(8, 'noreez ', 'noreez', '2019-07-10', 'pakistan', 23656256, 'oui', 0, '2019-07-22 14:46:15', 'Female', 'noreez@gmail.fr', '$2b$08$eb8.6seLij.urb45RJf8I.HLi1pM9yX2ix3X6AEBfhHvp4OkrUJra', NULL),
	(9, 'test', 'test', '2019-07-03', '15 rue de paris', 643679456, 'non', 0, '2019-07-22 14:58:49', 'Male', 'test@gmail.com', '$2b$08$8ufb3Cco6ZRgdC/0SJrfFOzPNZ1RMl4PRRxyMdyXMwTBo/sY4QkR2', NULL),
	(10, 'admin', 'admin', '2019-07-17', 'vue', 120436879, 'oui', 0, '2019-07-22 16:45:33', 'Male', 'admin@gmail.com', '$2b$08$5VOeRtzbNfdfAZBgv6puvub0u9Vxd8/WZtNRgat5t6qKkHu2TPmgm', 1),
	(11, 'SHAH', 'Noreez', '2019-07-03', 'afafa', 888884048, 'oui', 0, '2019-07-22 17:23:36', 'Male', 'directeur@gmail', '$2b$08$lAmrOEb508yLmV6/uyc4uueyu2QhaGWnO7xq1lmmQPlvPAF2.wrT2', NULL),
	(14, 'jean', 'paul', '2019-07-17', 'nice ', 2147483647, 'non', 0, '2019-07-29 10:17:07', 'Male', 'jp@gmail.coom', '$2b$08$48IFpcUGxnDFZU5w2bfCx.VHJh7/nOAQ7ZShqvSumM1VVL8WYn23C', NULL),
	(15, 'lorem', 'ipsum', '2019-07-10', 'rome', 488566506, 'oui', 0, '2019-07-29 10:19:33', 'Male', 'lorem-ipsum@gmail.com', '$2b$08$gsONupEPg7jDb0pC6ogcfuEnFLaPb0U.M97RNKJX28TiEIQpyd.LS', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Export de la structure de la table e_motion. vehicles
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id_vehicle` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marque` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_plate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_kilometer` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `price` int(11) NOT NULL,
  `available` tinyint(4) DEFAULT 0,
  `total` int(11) DEFAULT 0,
  PRIMARY KEY (`id_vehicle`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Export de données de la table e_motion.vehicles : ~20 rows (environ)
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` (`id_vehicle`, `image`, `marque`, `serial_number`, `color`, `nb_plate`, `nb_kilometer`, `purchase_date`, `price`, `available`, `total`) VALUES
	(1, '', 'test', '0080080', '', '54008', 8048048, '2019-07-23', 100, 0, 0),
	(2, '', 'test', '0080080', '#c0c0c0', '54008', 8048048, '2019-07-23', 100, 0, 0),
	(3, '', 'test', '1650084', '#008000', '5800480', 80840880, '2019-07-13', 100, 4, 0),
	(4, '', 'audi', '123896699', '#408080', 'eg-564-jk', 30000, '2019-07-17', 6000, 0, 0),
	(5, '', 'test', '18599', '#004040', '5z4e8r', 30000, '2019-07-10', 15000, 0, 0),
	(6, '', 'isogeo', '188595954749', '#008040', '54-fdfg-52', 30000, '2019-07-11', 30000, 0, 0),
	(7, '', 'verte', '2549595', '#00ff00', '25959f66', 30000, '2019-07-16', 1500, 0, 0),
	(8, '', 'verte', '2549595', '#00ff00', '25959f66', 30000, '2019-07-16', 1500, 0, 0),
	(10, '', 'zdreer', 'retrztez', '#408080', 'zettee', 0, '2019-07-10', 15000, 0, 0),
	(12, '', 'ferrari', '368363498', '#ff0000', 'sz546gh', 35000, '2019-07-17', 4500, 0, 0),
	(13, '', 'ferrari', '368363498', '#ff0000', 'sz546gh', 35000, '2019-07-17', 4500, 0, 0),
	(14, '', 'rttty', 'yyy', '#800080', 'tttt', 0, '2019-07-10', 15000, 0, 0),
	(15, '', 'mini', '149849693', '#ffff00', 'fg-549-he', 28000, '2019-07-17', 12580, 0, 0),
	(16, '', 'ford', '5484869569', '#ffffff', 'zz-476-aa', 60540, '2019-08-05', 22500, 0, 0),
	(17, '', 'zzrtzy', 'tzyer', '#000080', '2t98258', 15000, '2019-07-04', 4500, 0, 0),
	(18, '', 'foot', '365959', '#008040', '6549+595', 49595, '2019-07-11', 6150, 0, 0),
	(19, '', 'uiheio', '59595626', '#00ff00', 'df665fg', 120000, '2019-07-10', 2560, 0, 0),
	(21, '', 'cheval', '98484626', '#008040', 'fg576sh', 12489, '2019-07-04', 48352, 0, 0),
	(23, '', 'kawasaki', '1871285', '#000080', 'hd-432-kr', 14620, '2019-08-15', 14000, 0, 0),
	(29, '', 'shop', '41911174842', '#ff8000', 'sq892kj', 15054, '2019-08-07', 2000, 0, 0);
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
