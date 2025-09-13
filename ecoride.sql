-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 13, 2025 at 01:51 AM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecoride`
--

-- --------------------------------------------------------

--
-- Table structure for table `covoiturage`
--

CREATE TABLE `covoiturage` (
  `id_covoiturage` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `id_vehicule` int NOT NULL,
  `adresse_depart` varchar(255) NOT NULL,
  `adresse_arrivee` varchar(255) NOT NULL,
  `date_depart` datetime NOT NULL,
  `date_arrivee` datetime NOT NULL,
  `prix_personne` decimal(10,2) NOT NULL,
  `places_disponibles` int NOT NULL,
  `est_ecologique` tinyint(1) DEFAULT '0',
  `animaux_autorises` tinyint(1) DEFAULT '0',
  `fumeur` tinyint(1) DEFAULT '0',
  `statut` enum('actif','en_cours','termine','annule','litige') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `covoiturage`
--

INSERT INTO `covoiturage` (`id_covoiturage`, `id_utilisateur`, `id_vehicule`, `adresse_depart`, `adresse_arrivee`, `date_depart`, `date_arrivee`, `prix_personne`, `places_disponibles`, `est_ecologique`, `animaux_autorises`, `fumeur`, `statut`) VALUES
(10, 1, 6, 'rogne', 'marignane', '2025-05-28 22:12:00', '2025-05-28 23:12:00', 10.00, 2, 1, 1, 1, 'termine'),
(11, 1, 6, 'Arles', 'Marseille', '2025-06-01 08:00:00', '2025-06-01 10:00:00', 5.00, 3, 0, 1, 0, 'termine'),
(12, 4, 8, 'Nîmes', 'Montpellier', '2025-06-02 09:30:00', '2025-06-02 11:00:00', 4.50, 2, 1, 0, 0, 'termine'),
(13, 5, 9, 'Avignon', 'Orange', '2025-06-03 07:00:00', '2025-06-03 07:45:00', 3.00, 4, 0, 1, 0, 'actif'),
(14, 6, 10, 'Aix-en-Provence', 'Nice', '2025-06-04 06:00:00', '2025-06-04 09:00:00', 8.00, 2, 1, 0, 0, 'actif'),
(16, 8, 12, 'Arles', 'Valence', '2025-06-06 08:15:00', '2025-06-06 11:45:00', 7.50, 1, 1, 0, 0, 'actif'),
(17, 12, 13, 'Marseille', 'Gap', '2025-06-07 09:00:00', '2025-06-07 12:30:00', 6.50, 2, 1, 0, 1, 'annule'),
(20, 12, 3, 'lestac', 'arles', '2025-05-31 08:20:00', '2025-05-31 09:20:00', 10.00, 2, 1, 0, 0, 'termine'),
(21, 12, 3, 'Toulouse', 'Bordeaux', '2025-06-10 09:00:00', '2025-06-10 12:00:00', 10.00, 2, 1, 0, 0, 'actif'),
(22, 5, 9, 'Lyon', 'Grenoble', '2025-06-11 08:30:00', '2025-06-11 10:00:00', 6.00, 2, 0, 1, 0, 'actif'),
(23, 4, 8, 'Nice', 'Cannes', '2025-06-12 14:00:00', '2025-06-12 15:00:00', 4.00, 2, 1, 0, 0, 'litige'),
(24, 17, 14, 'Paris', 'Orléans', '2025-06-13 07:00:00', '2025-06-13 09:30:00', 12.00, 1, 0, 0, 0, 'termine'),
(25, 17, 14, 'Marseille', 'Aix-en-Provence', '2025-06-14 17:00:00', '2025-06-14 17:45:00', 3.50, 4, 1, 1, 0, 'litige'),
(26, 18, 15, 'Montpellier', 'Narbonne', '2025-06-15 09:15:00', '2025-06-15 11:30:00', 5.50, 3, 1, 1, 1, 'actif'),
(27, 19, 16, 'Avignon', 'Valence', '2025-06-16 08:45:00', '2025-06-16 10:45:00', 6.50, 2, 1, 0, 0, 'actif'),
(28, 20, 17, 'Toulon', 'Marseille', '2025-06-17 07:00:00', '2025-06-17 08:30:00', 4.00, 2, 1, 1, 0, 'actif'),
(29, 21, 18, 'Lille', 'Arras', '2025-06-18 10:00:00', '2025-06-18 11:00:00', 3.00, 4, 0, 0, 0, 'actif'),
(30, 12, 13, 'Nantes', 'Angers', '2025-06-19 16:00:00', '2025-06-19 17:30:00', 6.00, 0, 1, 0, 0, 'actif'),
(31, 4, 8, 'Dijon', 'Besançon', '2025-06-20 06:30:00', '2025-06-20 08:00:00', 5.00, 3, 0, 1, 0, 'actif'),
(32, 5, 9, 'Strasbourg', 'Colmar', '2025-06-21 09:00:00', '2025-06-21 10:15:00', 4.50, 2, 1, 0, 0, 'actif'),
(33, 6, 10, 'Clermont-Ferrand', 'St-Etienne', '2025-06-22 07:15:00', '2025-06-22 08:45:00', 5.00, 1, 1, 1, 0, 'actif'),
(34, 7, 11, 'Marseille', 'Toulon', '2025-06-23 13:30:00', '2025-06-23 15:00:00', 6.00, 3, 0, 0, 0, 'actif'),
(35, 8, 12, 'Perpignan', 'Narbonne', '2025-06-24 08:00:00', '2025-06-24 09:00:00', 3.50, 1, 1, 0, 0, 'actif'),
(36, 12, 3, 'Arles', 'saint martin', '2025-06-09 15:50:00', '2025-06-09 16:05:00', 7.00, 4, 1, 0, 1, 'termine'),
(37, 16, 19, 'marseille', 'arles', '2025-06-16 19:41:00', '2025-06-16 20:41:00', 21.00, 3, 0, 1, 1, 'actif'),
(38, 17, 14, 'Lille', 'Nantes', '2025-06-18 20:47:00', '2025-06-18 23:47:00', 23.00, 3, 0, 0, 0, 'actif'),
(39, 23, 20, 'Arles', 'Pertuis', '2025-06-10 19:29:00', '2025-06-10 20:29:00', 54.00, 2, 1, 1, 0, 'termine'),
(40, 12, 3, 'Salon de provence', 'Martigue', '2025-06-15 13:46:00', '2025-06-15 14:59:00', 15.00, 5, 1, 1, 1, 'termine'),
(41, 1, 6, 'Arles', 'Martigues', '2025-06-15 15:52:00', '2025-06-15 16:10:00', 24.00, 3, 0, 0, 0, 'termine'),
(42, 1, 6, 'Arles', 'Martigue', '2025-06-15 16:00:00', '2025-06-15 19:00:00', 24.00, 3, 0, 0, 0, 'termine'),
(43, 1, 6, 'Arles', 'Raphele', '2025-06-15 16:18:00', '2025-06-15 16:35:00', 2.00, 2, 0, 0, 0, 'termine'),
(44, 1, 6, 'arles', 'fos', '2025-06-15 16:25:00', '2025-06-15 16:39:00', 21.00, 2, 0, 0, 0, 'termine'),
(45, 1, 6, 'arles', 'fos', '2025-06-15 16:26:00', '2025-06-15 17:26:00', 23.00, 2, 0, 0, 0, 'termine'),
(46, 1, 6, 'arles', 'fos', '2025-06-16 16:28:00', '2025-06-16 17:28:00', 23.00, 2, 0, 0, 0, 'termine'),
(47, 1, 6, 'Arles', 'raphele', '2025-06-15 16:36:00', '2025-06-15 16:51:00', 24.00, 2, 0, 0, 0, 'termine'),
(48, 1, 6, 'testA', 'testB', '2025-06-15 16:43:00', '2025-06-15 16:50:00', 2.00, 2, 0, 0, 0, 'termine'),
(49, 1, 6, 'testA', 'testB', '2025-06-15 17:07:00', '2025-06-15 17:30:00', 24.00, 1, 0, 0, 0, 'litige'),
(50, 1, 6, 'Arles', 'Fos', '2025-06-15 17:23:00', '2025-06-15 17:36:00', 23.00, 1, 0, 0, 0, 'termine'),
(51, 12, 3, 'test A', 'test B', '2025-06-15 18:01:00', '2025-06-15 19:02:00', 2.00, 2, 0, 0, 0, 'termine'),
(52, 12, 3, 'test A', 'test C', '2025-06-15 18:08:00', '2025-06-15 19:08:00', 2.00, 2, 0, 0, 0, 'termine'),
(53, 1, 6, 'test bob', 'test bob A', '2025-06-15 18:23:00', '2025-06-15 19:24:00', 23.00, 2, 0, 0, 0, 'termine'),
(54, 1, 6, 'test D', 'test E', '2025-06-15 18:30:00', '2025-06-15 19:30:00', 23.00, 3, 0, 0, 0, 'termine'),
(55, 1, 6, 'test R', 'test F', '2025-06-15 18:33:00', '2025-06-15 19:33:00', 34.00, 2, 0, 0, 0, 'termine'),
(56, 12, 3, 'test T', 'test G', '2025-06-15 18:41:00', '2025-06-15 19:41:00', 23.00, 1, 0, 0, 0, 'litige'),
(57, 1, 6, 'test B', 'test V', '2025-06-15 18:53:00', '2025-06-15 19:53:00', 23.00, 3, 0, 0, 0, 'termine'),
(58, 12, 3, 'test h', 'test j', '2025-06-15 19:15:00', '2025-06-15 20:15:00', 23.00, 2, 0, 0, 0, 'termine'),
(59, 4, 8, 'test A', 'test AL', '2025-06-15 19:19:00', '2025-06-15 20:19:00', 23.00, 1, 0, 0, 0, 'litige'),
(60, 4, 8, 'test J', 'test K', '2025-06-15 20:07:00', '2025-06-15 21:07:00', 32.00, 1, 0, 0, 0, 'termine'),
(61, 1, 6, 'test role', 'test rolerrr', '2025-06-15 20:57:00', '2025-06-15 21:57:00', 23.00, 1, 0, 0, 0, 'termine'),
(120, 4, 8, 'Nîmes', 'Montpellier', '2025-09-03 09:30:00', '2025-09-03 11:00:00', 4.50, 2, 1, 0, 0, 'actif'),
(121, 5, 9, 'Avignon', 'Orange', '2025-09-10 07:00:00', '2025-09-10 07:45:00', 3.00, 4, 0, 1, 0, 'actif'),
(122, 6, 10, 'Aix-en-Provence', 'Nice', '2025-09-20 06:00:00', '2025-09-20 09:00:00', 8.00, 2, 1, 0, 0, 'actif'),
(123, 7, 11, 'Salon-de-Provence', 'Toulon', '2025-09-28 10:00:00', '2025-09-28 12:30:00', 6.00, 3, 0, 1, 0, 'actif'),
(124, 8, 12, 'Arles', 'Valence', '2025-10-05 08:15:00', '2025-10-05 11:45:00', 7.50, 0, 1, 0, 0, 'actif'),
(125, 12, 13, 'Marseille', 'Gap', '2025-10-14 09:00:00', '2025-10-14 12:30:00', 6.50, 3, 1, 1, 0, 'actif'),
(126, 17, 14, 'Toulouse', 'Bordeaux', '2025-10-21 09:00:00', '2025-10-21 12:00:00', 10.00, 2, 1, 0, 0, 'actif'),
(127, 18, 15, 'Lyon', 'Grenoble', '2025-11-01 08:30:00', '2025-11-01 10:00:00', 6.00, 3, 0, 1, 0, 'actif'),
(128, 19, 16, 'Nice', 'Cannes', '2025-11-09 14:00:00', '2025-11-09 15:00:00', 4.00, 2, 1, 0, 0, 'actif'),
(129, 16, 19, 'Paris', 'Orléans', '2025-11-18 07:00:00', '2025-11-18 09:30:00', 12.00, 1, 0, 0, 0, 'actif'),
(130, 6, 10, 'Montpellier', 'Narbonne', '2025-11-23 09:15:00', '2025-11-23 11:30:00', 5.50, 2, 0, 0, 0, 'actif'),
(131, 1, 7, 'Avignon', 'Valence', '2025-12-01 08:45:00', '2025-12-01 10:45:00', 6.50, 3, 1, 0, 0, 'actif'),
(132, 4, 8, 'Toulon', 'Marseille', '2025-12-08 07:00:00', '2025-12-08 08:30:00', 4.00, 2, 1, 1, 0, 'actif'),
(133, 20, 17, 'Bayonne', 'Pau', '2025-12-12 10:00:00', '2025-12-12 11:30:00', 5.00, 3, 1, 0, 0, 'actif'),
(134, 21, 18, 'Limoges', 'Poitiers', '2025-12-15 09:30:00', '2025-12-15 11:00:00', 6.00, 2, 1, 1, 0, 'actif'),
(135, 23, 20, 'Reims', 'Troyes', '2025-12-18 14:00:00', '2025-12-18 15:30:00', 5.50, 4, 0, 0, 0, 'actif'),
(136, 12, 13, 'Chambéry', 'Annecy', '2025-12-20 16:00:00', '2025-12-20 17:00:00', 4.50, 3, 1, 0, 0, 'actif'),
(137, 19, 16, 'Saint-Étienne', 'Lyon', '2025-12-22 08:00:00', '2025-12-22 09:15:00', 3.50, 2, 1, 0, 0, 'actif'),
(138, 6, 10, 'Brest', 'Quimper', '2025-12-24 07:00:00', '2025-12-24 08:30:00', 5.00, 2, 0, 0, 0, 'actif'),
(140, 4, 8, 'Perpignan', 'Narbonne', '2025-10-05 09:15:00', '2025-10-05 10:30:00', 4.00, 1, 1, 0, 0, 'actif'),
(141, 5, 9, 'Clermont-Ferrand', 'St-Étienne', '2025-10-08 07:30:00', '2025-10-08 09:00:00', 5.50, 3, 0, 0, 1, 'actif'),
(142, 6, 10, 'Biarritz', 'Dax', '2025-10-10 13:00:00', '2025-10-10 14:00:00', 3.50, 2, 1, 1, 0, 'actif'),
(143, 7, 11, 'La Rochelle', 'Niort', '2025-10-12 15:00:00', '2025-10-12 16:00:00', 4.50, 3, 0, 0, 0, 'actif'),
(144, 8, 12, 'Bayonne', 'Pau', '2025-10-15 09:00:00', '2025-10-15 10:45:00', 4.00, 1, 1, 0, 1, 'actif'),
(146, 17, 14, 'Dijon', 'Besançon', '2025-10-22 06:30:00', '2025-10-22 08:00:00', 4.50, 2, 0, 0, 0, 'actif'),
(147, 18, 15, 'Nancy', 'Metz', '2025-10-25 08:45:00', '2025-10-25 10:00:00', 4.00, 3, 0, 1, 0, 'actif'),
(148, 19, 16, 'Caen', 'Rouen', '2025-10-28 09:30:00', '2025-10-28 11:30:00', 6.50, 2, 1, 0, 0, 'actif'),
(149, 16, 19, 'Châteauroux', 'Tours', '2025-11-02 10:00:00', '2025-11-02 11:30:00', 5.00, 2, 0, 1, 0, 'actif'),
(150, 6, 10, 'Brive-la-Gaillarde', 'Cahors', '2025-11-06 14:00:00', '2025-11-06 15:30:00', 4.50, 2, 0, 0, 1, 'actif'),
(151, 1, 7, 'Valence', 'Grenoble', '2025-11-11 08:00:00', '2025-11-11 09:30:00', 5.00, 3, 1, 0, 0, 'actif'),
(152, 4, 8, 'Le Puy-en-Velay', 'Clermont-Ferrand', '2025-11-14 07:15:00', '2025-11-14 08:45:00', 6.00, 3, 1, 1, 0, 'actif'),
(153, 20, 17, 'Agen', 'Montauban', '2025-11-17 10:30:00', '2025-11-17 12:00:00', 5.00, 2, 0, 0, 0, 'actif'),
(154, 21, 18, 'Béziers', 'Sète', '2025-11-20 09:00:00', '2025-11-20 10:00:00', 4.00, 2, 1, 1, 0, 'actif'),
(155, 23, 20, 'Poitiers', 'Angoulême', '2025-11-24 16:00:00', '2025-11-24 17:30:00', 4.50, 1, 0, 0, 0, 'actif'),
(156, 12, 13, 'Troyes', 'Auxerre', '2025-11-27 08:30:00', '2025-11-27 09:45:00', 4.50, 2, 1, 0, 0, 'actif'),
(157, 19, 16, 'Épinal', 'Vesoul', '2025-12-03 14:30:00', '2025-12-03 15:45:00', 4.00, 2, 0, 0, 1, 'actif'),
(158, 6, 10, 'Périgueux', 'Libourne', '2025-12-06 09:00:00', '2025-12-06 10:30:00', 4.50, 3, 1, 0, 0, 'actif'),
(159, 12, 13, 'Arles', 'Fos', '2025-06-17 14:02:00', '2025-06-17 14:16:00', 23.00, 2, 0, 0, 0, 'actif'),
(160, 12, 3, 'Fos', 'Istres', '2025-06-17 14:30:00', '2025-06-17 15:07:00', 21.00, 1, 0, 0, 0, 'actif'),
(161, 12, 3, 'testDebitCredit', 'testDebitCredit2222', '2025-06-18 15:48:00', '2025-06-18 15:52:00', 10.00, 1, 0, 1, 1, 'termine'),
(162, 1, 6, 'testDebit2', 'testDebit2', '2025-06-18 16:14:00', '2025-06-18 16:18:00', 10.00, 2, 1, 0, 0, 'termine'),
(163, 12, 3, 'testdebit3', 'testdebit3', '2025-06-18 16:23:00', '2025-06-18 17:23:00', 10.00, 2, 0, 0, 0, 'actif'),
(164, 1, 6, 'testdebit4', 'testdebit4', '2025-06-18 16:46:00', '2025-06-18 17:46:00', 10.00, 2, 0, 0, 0, 'actif'),
(165, 1, 6, 'testdebitbob', 'testdebitbob', '2025-06-18 16:48:00', '2025-06-18 17:48:00', 10.00, 2, 0, 0, 0, 'annule'),
(166, 1, 6, 'testdebitbob2', 'testdebitbob2', '2025-06-18 16:52:00', '2025-06-18 17:52:00', 10.00, 1, 0, 0, 0, 'termine'),
(168, 12, 3, 'testGen', 'testGen', '2025-06-18 19:06:00', '2025-06-18 20:06:00', 10.00, 0, 1, 0, 0, 'termine'),
(169, 12, 3, 'testMail', 'testMail', '2025-06-18 21:38:00', '2025-06-18 22:38:00', 10.00, 1, 0, 0, 0, 'termine'),
(170, 1, 6, 'testMail2', 'testMail2', '2025-06-18 21:52:00', '2025-06-18 22:52:00', 10.00, 1, 0, 0, 0, 'termine'),
(171, 12, 3, 'testMail3', 'testMail3', '2025-06-18 22:16:00', '2025-06-18 23:16:00', 10.00, 0, 0, 0, 0, 'litige'),
(172, 12, 3, 'testMail4', 'testMail4', '2025-06-18 22:41:00', '2025-06-18 23:41:00', 10.00, 0, 0, 0, 0, 'termine'),
(173, 12, 3, 'testMailCredit', 'testMailCredit', '2025-06-18 22:55:00', '2025-06-18 23:55:00', 10.00, 0, 0, 0, 0, 'termine'),
(174, 1, 6, 'testmailcredit1', 'testmailcredit1', '2025-06-18 23:00:00', '2025-06-18 00:00:00', 10.00, 0, 0, 0, 0, 'termine'),
(175, 12, 3, 'testRembourse', 'testRembours', '2025-06-22 21:42:00', '2025-06-22 22:42:00', 20.00, 0, 0, 0, 0, 'annule'),
(176, 12, 3, 'testRembours2', 'testRembours2', '2025-06-22 22:24:00', '2025-06-22 23:24:00', 10.00, 1, 0, 0, 0, 'annule'),
(177, 12, 3, 'testMailAnnul', 'testMailAnnul', '2025-06-23 17:33:00', '2025-06-23 18:33:00', 10.00, 2, 0, 0, 0, 'annule'),
(178, 12, 3, 'testMailAnnul2', 'testMailAnnul2', '2025-06-23 18:49:00', '2025-06-23 19:49:00', 20.00, 0, 0, 0, 0, 'annule'),
(179, 12, 3, 'testAnnul3', 'testAnnul3', '2025-06-23 19:06:00', '2025-06-23 20:06:00', 10.00, 0, 0, 0, 0, 'annule'),
(180, 12, 3, 'testannul', 'testannul', '2025-06-23 19:37:00', '2025-06-23 20:37:00', 20.00, 0, 0, 0, 0, 'annule'),
(181, 12, 3, 'testAnnul', 'testAnnul', '2025-06-23 20:52:00', '2025-06-23 21:52:00', 20.00, 1, 0, 0, 0, 'annule'),
(183, 12, 3, 'testAnnul4', 'testAnnul4', '2025-06-23 20:01:00', '2025-06-23 21:01:00', 20.00, 1, 0, 0, 0, 'annule'),
(184, 12, 3, 'testSup', 'testSup', '2025-06-23 20:06:00', '2025-06-23 21:06:00', 20.00, 2, 0, 0, 0, 'annule'),
(185, 12, 3, 'testAvis', 'testAvis', '2025-07-01 19:25:00', '2025-07-01 20:25:00', 10.00, 1, 0, 0, 0, 'annule'),
(186, 12, 3, 'testTerminé', 'testTerminé', '2025-07-04 22:06:00', '2025-07-04 23:06:00', 10.00, 1, 0, 0, 0, 'litige'),
(188, 1, 6, 'testAvisReçus', 'testAvisReçus', '2025-07-12 22:33:00', '2025-07-12 23:33:00', 10.00, 0, 0, 0, 0, 'termine'),
(189, 1, 6, 'avisTestReçus', 'avisTestReçus', '2025-07-12 22:57:00', '2025-07-12 23:57:00', 10.00, 0, 0, 0, 0, 'litige'),
(190, 12, 3, 'testgraph', 'testgraph', '2025-08-05 19:42:00', '2025-08-05 20:42:00', 10.00, 0, 0, 0, 0, 'litige'),
(191, 12, 3, 'testeBtnReport', 'testeBtnReport', '2025-08-15 18:50:00', '2025-08-15 19:50:00', 20.00, 0, 0, 0, 0, 'litige'),
(192, 12, 3, 'testReport', 'testReport', '2025-08-28 18:28:00', '2025-08-28 19:28:00', 10.00, 1, 0, 0, 0, 'litige'),
(193, 12, 3, 'testToken', 'testToken', '2025-09-01 20:00:00', '2025-09-01 21:00:00', 23.00, 2, 0, 0, 0, 'actif'),
(194, 26, 22, 'testEnv', 'testEnv', '2025-09-05 20:27:00', '2025-09-05 21:27:00', 10.00, 2, 0, 1, 0, 'annule');

-- --------------------------------------------------------

--
-- Table structure for table `marque`
--

CREATE TABLE `marque` (
  `id_marque` int NOT NULL,
  `nom_marque` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `marque`
--

INSERT INTO `marque` (`id_marque`, `nom_marque`) VALUES
(1, 'fiat'),
(2, 'audi'),
(3, 'peugeot'),
(4, 'renault'),
(7, 'Citroën'),
(8, 'Tesla'),
(9, 'Dacia'),
(10, 'Volkswagen'),
(11, 'Toyota'),
(12, 'BMW'),
(13, 'Mercedes-Benz'),
(14, 'Ford'),
(15, 'Opel'),
(16, 'Hyundai'),
(17, 'Kia'),
(18, 'Mazda'),
(19, 'Nissan'),
(20, 'Mitsubishi'),
(21, 'Alfa Romeo'),
(22, 'Volvo'),
(23, 'Honda'),
(24, 'Suzuki'),
(25, 'Jeep');

-- --------------------------------------------------------

--
-- Table structure for table `notation`
--

CREATE TABLE `notation` (
  `id_notation` int NOT NULL,
  `id_utilisateur_cible` int NOT NULL,
  `id_utilisateur_auteur` int NOT NULL,
  `id_covoiturage` int NOT NULL,
  `note` tinyint NOT NULL,
  `date_notation` datetime DEFAULT CURRENT_TIMESTAMP
) ;

--
-- Dumping data for table `notation`
--

INSERT INTO `notation` (`id_notation`, `id_utilisateur_cible`, `id_utilisateur_auteur`, `id_covoiturage`, `note`, `date_notation`) VALUES
(1, 12, 12, 20, 4, '2025-06-03 22:39:46'),
(3, 1, 12, 10, 4, '2025-06-03 22:42:44'),
(4, 12, 12, 17, 4, '2025-06-03 22:43:15'),
(5, 12, 18, 17, 2, '2025-06-03 23:33:18'),
(6, 18, 18, 26, 5, '2025-06-03 23:35:05'),
(7, 1, 12, 49, 3, '2025-06-15 17:24:45'),
(8, 1, 12, 61, 4, '2025-06-15 22:01:06'),
(9, 12, 1, 161, 3, '2025-06-18 15:58:05'),
(10, 1, 12, 170, 5, '2025-06-18 22:04:39'),
(11, 12, 1, 171, 4, '2025-06-18 22:19:17'),
(12, 12, 1, 172, 4, '2025-06-18 22:48:18'),
(13, 12, 1, 173, 4, '2025-06-18 22:59:39'),
(14, 1, 12, 174, 5, '2025-06-22 21:08:34'),
(15, 12, 1, 181, 4, '2025-06-29 21:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `parametre`
--

CREATE TABLE `parametre` (
  `id_parametre` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `propriete` varchar(50) NOT NULL,
  `valeur` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `parametre`
--

INSERT INTO `parametre` (`id_parametre`, `id_utilisateur`, `propriete`, `valeur`) VALUES
(1, 12, 'langue', 'es'),
(2, 12, 'notifications', 'non'),
(3, 1, 'langue', 'fr'),
(4, 1, 'notifications', 'oui');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int NOT NULL,
  `libelle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `libelle`) VALUES
(1, 'administrateur'),
(2, 'employe'),
(3, 'utilisateur');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id_transaction` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `id_covoiturage` int NOT NULL,
  `id_passager` int NOT NULL,
  `montant` int NOT NULL,
  `type` enum('plateforme','chauffeur') NOT NULL,
  `statut` enum('en_attente','validée','refusée','remboursée') DEFAULT 'en_attente',
  `date_transaction` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id_transaction`, `id_utilisateur`, `id_covoiturage`, `id_passager`, `montant`, `type`, `statut`, `date_transaction`) VALUES
(1, 1, 161, 1, 2, 'plateforme', 'validée', '2025-06-18 22:50:55'),
(2, 12, 161, 1, 10, 'chauffeur', 'en_attente', '2025-06-18 22:50:55'),
(3, 1, 162, 1, 2, 'plateforme', 'validée', '2025-06-18 23:14:46'),
(4, 1, 163, 12, 2, 'plateforme', 'validée', '2025-06-18 23:23:27'),
(5, 1, 163, 1, 2, 'plateforme', 'validée', '2025-06-18 23:26:57'),
(6, 12, 163, 1, 10, 'chauffeur', 'en_attente', '2025-06-18 23:26:57'),
(7, 1, 164, 1, 2, 'plateforme', 'validée', '2025-06-18 23:46:45'),
(8, 1, 165, 1, 2, 'plateforme', 'validée', '2025-06-18 23:49:10'),
(9, 2, 166, 1, 2, 'plateforme', 'validée', '2025-06-18 23:53:01'),
(10, 2, 166, 12, 2, 'plateforme', 'validée', '2025-06-18 23:55:32'),
(11, 1, 166, 12, 10, 'chauffeur', 'validée', '2025-06-18 23:55:32'),
(13, 2, 168, 12, 2, 'plateforme', 'validée', '2025-06-19 02:07:12'),
(14, 2, 168, 1, 2, 'plateforme', 'validée', '2025-06-19 02:11:10'),
(15, 12, 168, 1, 10, 'chauffeur', 'validée', '2025-06-19 02:11:10'),
(16, 2, 168, 4, 2, 'plateforme', 'validée', '2025-06-19 02:14:53'),
(17, 12, 168, 4, 10, 'chauffeur', 'validée', '2025-06-19 02:14:53'),
(18, 2, 169, 12, 2, 'plateforme', 'validée', '2025-06-19 04:38:43'),
(19, 2, 169, 1, 2, 'plateforme', 'validée', '2025-06-19 04:40:29'),
(20, 12, 169, 1, 10, 'chauffeur', 'validée', '2025-06-19 04:40:29'),
(21, 2, 170, 1, 2, 'plateforme', 'validée', '2025-06-19 04:52:50'),
(22, 2, 170, 12, 2, 'plateforme', 'validée', '2025-06-19 04:54:34'),
(23, 1, 170, 12, 10, 'chauffeur', 'validée', '2025-06-19 04:54:34'),
(24, 2, 13, 12, 2, 'plateforme', 'validée', '2025-06-19 05:05:04'),
(25, 5, 13, 12, 3, 'chauffeur', 'en_attente', '2025-06-19 05:05:04'),
(26, 2, 171, 12, 2, 'plateforme', 'validée', '2025-06-19 05:16:34'),
(27, 2, 171, 1, 2, 'plateforme', 'validée', '2025-06-19 05:17:16'),
(28, 12, 171, 1, 10, 'chauffeur', 'validée', '2025-06-19 05:17:16'),
(29, 2, 172, 12, 2, 'plateforme', 'validée', '2025-06-19 05:41:30'),
(30, 2, 172, 1, 2, 'plateforme', 'validée', '2025-06-19 05:44:20'),
(31, 12, 172, 1, 10, 'chauffeur', 'validée', '2025-06-19 05:44:20'),
(32, 2, 173, 12, 2, 'plateforme', 'validée', '2025-06-19 05:56:02'),
(33, 2, 173, 1, 2, 'plateforme', 'validée', '2025-06-19 05:56:57'),
(34, 12, 173, 1, 10, 'chauffeur', 'validée', '2025-06-19 05:56:57'),
(35, 2, 174, 1, 2, 'plateforme', 'validée', '2025-06-19 06:00:35'),
(36, 2, 174, 12, 2, 'plateforme', 'validée', '2025-06-19 06:01:34'),
(37, 1, 174, 12, 10, 'chauffeur', 'validée', '2025-06-19 06:01:34'),
(38, 2, 175, 12, 2, 'plateforme', 'validée', '2025-06-23 04:42:59'),
(39, 2, 175, 1, 2, 'plateforme', 'validée', '2025-06-23 04:47:21'),
(40, 12, 175, 1, 20, 'chauffeur', 'remboursée', '2025-06-23 04:47:21'),
(41, 2, 175, 1, 2, 'plateforme', 'validée', '2025-06-23 04:49:33'),
(42, 12, 175, 1, 20, 'chauffeur', 'remboursée', '2025-06-23 04:49:33'),
(43, 2, 176, 12, 2, 'plateforme', 'remboursée', '2025-06-23 05:24:56'),
(44, 2, 176, 1, 2, 'plateforme', 'remboursée', '2025-06-23 05:26:46'),
(45, 12, 176, 1, 10, 'chauffeur', 'remboursée', '2025-06-23 05:26:46'),
(46, 2, 176, 1, 2, 'plateforme', 'remboursée', '2025-06-23 05:28:26'),
(47, 12, 176, 1, 10, 'chauffeur', 'remboursée', '2025-06-23 05:28:26'),
(48, 2, 177, 12, 2, 'plateforme', 'remboursée', '2025-06-24 00:34:03'),
(49, 2, 177, 1, 2, 'plateforme', 'remboursée', '2025-06-24 00:37:58'),
(50, 12, 177, 1, 10, 'chauffeur', 'remboursée', '2025-06-24 00:37:58'),
(51, 2, 177, 1, 2, 'plateforme', 'remboursée', '2025-06-24 00:38:57'),
(52, 12, 177, 1, 10, 'chauffeur', 'remboursée', '2025-06-24 00:38:57'),
(53, 2, 177, 1, 2, 'plateforme', 'remboursée', '2025-06-24 00:46:41'),
(54, 12, 177, 1, 10, 'chauffeur', 'remboursée', '2025-06-24 00:46:41'),
(55, 2, 177, 1, 2, 'plateforme', 'remboursée', '2025-06-24 00:51:08'),
(56, 12, 177, 1, 10, 'chauffeur', 'remboursée', '2025-06-24 00:51:08'),
(57, 2, 177, 1, 2, 'plateforme', 'remboursée', '2025-06-24 00:52:17'),
(58, 12, 177, 1, 10, 'chauffeur', 'remboursée', '2025-06-24 00:52:17'),
(59, 2, 177, 1, 2, 'plateforme', 'remboursée', '2025-06-24 00:53:53'),
(60, 12, 177, 1, 10, 'chauffeur', 'remboursée', '2025-06-24 00:53:53'),
(61, 2, 177, 1, 2, 'plateforme', 'remboursée', '2025-06-24 00:58:31'),
(62, 12, 177, 1, 10, 'chauffeur', 'remboursée', '2025-06-24 00:58:31'),
(63, 2, 177, 1, 2, 'plateforme', 'remboursée', '2025-06-24 01:05:12'),
(64, 12, 177, 1, 10, 'chauffeur', 'remboursée', '2025-06-24 01:05:12'),
(65, 2, 177, 1, 2, 'plateforme', 'remboursée', '2025-06-24 01:06:13'),
(66, 12, 177, 1, 10, 'chauffeur', 'remboursée', '2025-06-24 01:06:13'),
(67, 2, 177, 1, 2, 'plateforme', 'remboursée', '2025-06-24 01:10:54'),
(68, 12, 177, 1, 10, 'chauffeur', 'remboursée', '2025-06-24 01:10:54'),
(69, 2, 177, 1, 2, 'plateforme', 'remboursée', '2025-06-24 01:13:31'),
(70, 12, 177, 1, 10, 'chauffeur', 'remboursée', '2025-06-24 01:13:31'),
(71, 2, 177, 1, 2, 'plateforme', 'remboursée', '2025-06-24 01:39:30'),
(72, 12, 177, 1, 10, 'chauffeur', 'remboursée', '2025-06-24 01:39:30'),
(73, 2, 178, 12, 2, 'plateforme', 'remboursée', '2025-06-24 01:49:31'),
(74, 2, 178, 1, 2, 'plateforme', 'remboursée', '2025-06-24 01:52:43'),
(75, 12, 178, 1, 20, 'chauffeur', 'remboursée', '2025-06-24 01:52:43'),
(76, 2, 179, 12, 2, 'plateforme', 'remboursée', '2025-06-24 02:06:45'),
(77, 2, 179, 1, 2, 'plateforme', 'remboursée', '2025-06-24 02:07:28'),
(78, 12, 179, 1, 10, 'chauffeur', 'remboursée', '2025-06-24 02:07:28'),
(79, 2, 180, 12, 2, 'plateforme', 'remboursée', '2025-06-24 02:37:37'),
(80, 2, 180, 1, 2, 'plateforme', 'remboursée', '2025-06-24 02:38:40'),
(81, 12, 180, 1, 20, 'chauffeur', 'remboursée', '2025-06-24 02:38:40'),
(82, 2, 181, 12, 2, 'plateforme', 'remboursée', '2025-06-24 02:52:35'),
(83, 2, 181, 1, 2, 'plateforme', 'remboursée', '2025-06-24 02:53:22'),
(84, 12, 181, 1, 20, 'chauffeur', 'remboursée', '2025-06-24 02:53:22'),
(85, 2, 181, 1, 2, 'plateforme', 'remboursée', '2025-06-24 02:54:18'),
(86, 12, 181, 1, 20, 'chauffeur', 'remboursée', '2025-06-24 02:54:18'),
(90, 2, 183, 12, 2, 'plateforme', 'remboursée', '2025-06-24 03:01:40'),
(91, 2, 183, 1, 2, 'plateforme', 'remboursée', '2025-06-24 03:03:13'),
(92, 12, 183, 1, 20, 'chauffeur', 'remboursée', '2025-06-24 03:03:13'),
(93, 2, 184, 12, 2, 'plateforme', 'remboursée', '2025-06-24 03:06:54'),
(94, 2, 184, 1, 2, 'plateforme', 'remboursée', '2025-06-24 03:07:39'),
(95, 12, 184, 1, 20, 'chauffeur', 'remboursée', '2025-06-24 03:07:39'),
(96, 2, 184, 1, 2, 'plateforme', 'remboursée', '2025-06-24 03:09:03'),
(97, 12, 184, 1, 20, 'chauffeur', 'remboursée', '2025-06-24 03:09:03'),
(98, 2, 185, 12, 2, 'plateforme', 'validée', '2025-07-02 02:26:01'),
(99, 2, 185, 1, 2, 'plateforme', 'validée', '2025-07-02 02:28:41'),
(100, 12, 185, 1, 10, 'chauffeur', 'validée', '2025-07-02 02:28:41'),
(101, 2, 130, 1, 2, 'plateforme', 'remboursée', '2025-07-05 04:30:14'),
(102, 6, 130, 1, 5, 'chauffeur', 'remboursée', '2025-07-05 04:30:14'),
(103, 2, 186, 12, 2, 'plateforme', 'validée', '2025-07-05 05:07:08'),
(105, 2, 186, 1, 2, 'plateforme', 'validée', '2025-07-05 05:09:50'),
(106, 12, 186, 1, 10, 'chauffeur', 'validée', '2025-07-05 05:09:50'),
(107, 2, 188, 1, 2, 'plateforme', 'validée', '2025-07-13 05:33:57'),
(108, 2, 188, 12, 2, 'plateforme', 'validée', '2025-07-13 05:35:58'),
(109, 1, 188, 12, 10, 'chauffeur', 'validée', '2025-07-13 05:35:58'),
(110, 2, 189, 1, 2, 'plateforme', 'validée', '2025-07-13 05:57:35'),
(111, 2, 189, 12, 2, 'plateforme', 'validée', '2025-07-13 05:59:37'),
(112, 1, 189, 12, 10, 'chauffeur', 'validée', '2025-07-13 05:59:37'),
(113, 2, 190, 12, 2, 'plateforme', 'validée', '2025-08-06 02:42:44'),
(114, 2, 190, 1, 2, 'plateforme', 'validée', '2025-08-06 02:43:46'),
(115, 12, 190, 1, 10, 'chauffeur', 'validée', '2025-08-06 02:43:46'),
(116, 2, 141, 12, 2, 'plateforme', 'validée', '2025-08-16 01:49:00'),
(117, 5, 141, 12, 5, 'chauffeur', 'en_attente', '2025-08-16 01:49:00'),
(118, 2, 191, 12, 2, 'plateforme', 'validée', '2025-08-16 01:50:31'),
(119, 2, 191, 1, 2, 'plateforme', 'validée', '2025-08-16 01:51:36'),
(120, 12, 191, 1, 20, 'chauffeur', 'validée', '2025-08-16 01:51:36'),
(121, 2, 140, 12, 2, 'plateforme', 'validée', '2025-08-20 02:29:27'),
(122, 4, 140, 12, 4, 'chauffeur', 'en_attente', '2025-08-20 02:29:27'),
(123, 2, 192, 12, 2, 'plateforme', 'validée', '2025-08-29 01:29:02'),
(124, 2, 192, 1, 2, 'plateforme', 'validée', '2025-08-29 01:30:19'),
(125, 12, 192, 1, 10, 'chauffeur', 'en_attente', '2025-08-29 01:30:19'),
(126, 2, 193, 12, 2, 'plateforme', 'validée', '2025-09-02 03:00:49'),
(127, 2, 124, 12, 2, 'plateforme', 'validée', '2025-09-05 02:19:55'),
(128, 8, 124, 12, 7, 'chauffeur', 'en_attente', '2025-09-05 02:19:55'),
(129, 2, 194, 26, 2, 'plateforme', 'remboursée', '2025-09-06 03:27:26');

-- --------------------------------------------------------

--
-- Table structure for table `user_covoiturage`
--

CREATE TABLE `user_covoiturage` (
  `id_utilisateur` int NOT NULL,
  `id_covoiturage` int NOT NULL,
  `role_utilisateur` enum('conducteur','passager') NOT NULL,
  `trajet_termine` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_covoiturage`
--

INSERT INTO `user_covoiturage` (`id_utilisateur`, `id_covoiturage`, `role_utilisateur`, `trajet_termine`) VALUES
(1, 10, 'conducteur', 0),
(1, 11, 'conducteur', 0),
(1, 24, 'passager', 1),
(1, 41, 'conducteur', 0),
(1, 42, 'conducteur', 0),
(1, 43, 'conducteur', 0),
(1, 44, 'conducteur', 0),
(1, 45, 'conducteur', 0),
(1, 46, 'conducteur', 0),
(1, 47, 'conducteur', 0),
(1, 48, 'conducteur', 0),
(1, 49, 'conducteur', 0),
(1, 50, 'conducteur', 0),
(1, 53, 'conducteur', 0),
(1, 54, 'conducteur', 0),
(1, 55, 'conducteur', 1),
(1, 56, 'passager', 1),
(1, 57, 'conducteur', 1),
(1, 59, 'passager', 1),
(1, 60, 'passager', 1),
(1, 61, 'conducteur', 1),
(1, 131, 'conducteur', 0),
(1, 151, 'conducteur', 0),
(1, 161, 'passager', 1),
(1, 162, 'conducteur', 1),
(1, 165, 'conducteur', 0),
(1, 166, 'conducteur', 1),
(1, 168, 'passager', 1),
(1, 169, 'passager', 1),
(1, 170, 'conducteur', 1),
(1, 171, 'passager', 1),
(1, 172, 'passager', 1),
(1, 173, 'passager', 1),
(1, 174, 'conducteur', 1),
(1, 175, 'passager', 0),
(1, 177, 'passager', 0),
(1, 178, 'passager', 0),
(1, 179, 'passager', 0),
(1, 180, 'passager', 0),
(1, 183, 'passager', 0),
(1, 185, 'passager', 1),
(1, 186, 'passager', 1),
(1, 188, 'conducteur', 1),
(1, 189, 'conducteur', 1),
(1, 190, 'passager', 1),
(1, 191, 'passager', 1),
(1, 192, 'passager', 0),
(4, 12, 'conducteur', 0),
(4, 21, 'passager', 0),
(4, 27, 'passager', 0),
(4, 59, 'conducteur', 1),
(4, 60, 'conducteur', 1),
(4, 61, 'passager', 0),
(4, 120, 'conducteur', 0),
(4, 132, 'conducteur', 0),
(4, 140, 'conducteur', 0),
(4, 152, 'conducteur', 0),
(4, 168, 'passager', 1),
(5, 13, 'conducteur', 0),
(5, 121, 'conducteur', 0),
(5, 141, 'conducteur', 0),
(6, 14, 'conducteur', 0),
(6, 16, 'passager', 0),
(6, 122, 'conducteur', 0),
(6, 130, 'conducteur', 0),
(6, 138, 'conducteur', 0),
(6, 142, 'conducteur', 0),
(6, 150, 'conducteur', 0),
(6, 158, 'conducteur', 0),
(7, 25, 'passager', 0),
(7, 123, 'conducteur', 0),
(7, 143, 'conducteur', 0),
(8, 16, 'conducteur', 0),
(8, 26, 'passager', 0),
(8, 124, 'conducteur', 0),
(8, 144, 'conducteur', 0),
(12, 10, 'passager', 1),
(12, 17, 'conducteur', 0),
(12, 20, 'conducteur', 0),
(12, 22, 'passager', 0),
(12, 23, 'passager', 1),
(12, 25, 'passager', 1),
(12, 33, 'passager', 0),
(12, 35, 'passager', 0),
(12, 36, 'conducteur', 0),
(12, 40, 'conducteur', 0),
(12, 49, 'passager', 0),
(12, 50, 'passager', 0),
(12, 51, 'conducteur', 0),
(12, 52, 'conducteur', 0),
(12, 55, 'passager', 1),
(12, 56, 'conducteur', 1),
(12, 58, 'conducteur', 1),
(12, 61, 'passager', 1),
(12, 124, 'passager', 0),
(12, 136, 'conducteur', 0),
(12, 140, 'passager', 0),
(12, 141, 'passager', 0),
(12, 156, 'conducteur', 0),
(12, 159, 'conducteur', 0),
(12, 160, 'conducteur', 0),
(12, 161, 'conducteur', 1),
(12, 166, 'passager', 1),
(12, 168, 'conducteur', 1),
(12, 169, 'conducteur', 1),
(12, 170, 'passager', 1),
(12, 171, 'conducteur', 1),
(12, 172, 'conducteur', 1),
(12, 173, 'conducteur', 1),
(12, 174, 'passager', 1),
(12, 175, 'conducteur', 0),
(12, 176, 'conducteur', 0),
(12, 177, 'conducteur', 0),
(12, 178, 'conducteur', 0),
(12, 179, 'conducteur', 0),
(12, 180, 'conducteur', 0),
(12, 181, 'conducteur', 0),
(12, 183, 'conducteur', 0),
(12, 184, 'conducteur', 0),
(12, 185, 'conducteur', 1),
(12, 186, 'conducteur', 1),
(12, 188, 'passager', 1),
(12, 189, 'passager', 1),
(12, 190, 'conducteur', 1),
(12, 191, 'conducteur', 1),
(12, 192, 'conducteur', 1),
(12, 193, 'conducteur', 0),
(13, 12, 'passager', 0),
(13, 22, 'passager', 0),
(13, 28, 'passager', 0),
(14, 11, 'passager', 0),
(14, 13, 'passager', 0),
(15, 11, 'passager', 0),
(15, 14, 'passager', 0),
(15, 27, 'passager', 0),
(16, 13, 'passager', 0),
(16, 17, 'passager', 0),
(16, 30, 'passager', 0),
(16, 35, 'passager', 0),
(16, 37, 'conducteur', 0),
(16, 129, 'conducteur', 0),
(16, 149, 'conducteur', 0),
(17, 12, 'passager', 0),
(17, 25, 'conducteur', 0),
(17, 36, 'passager', 0),
(17, 38, 'conducteur', 0),
(17, 126, 'conducteur', 0),
(17, 146, 'conducteur', 0),
(18, 17, 'passager', 0),
(18, 26, 'conducteur', 0),
(18, 32, 'passager', 0),
(18, 127, 'conducteur', 0),
(18, 147, 'conducteur', 0),
(19, 13, 'passager', 0),
(19, 27, 'conducteur', 0),
(19, 30, 'passager', 0),
(19, 128, 'conducteur', 0),
(19, 137, 'conducteur', 0),
(19, 148, 'conducteur', 0),
(19, 157, 'conducteur', 0),
(20, 14, 'passager', 0),
(20, 28, 'conducteur', 0),
(20, 33, 'passager', 0),
(20, 133, 'conducteur', 0),
(20, 153, 'conducteur', 0),
(21, 16, 'passager', 0),
(21, 29, 'conducteur', 0),
(21, 31, 'passager', 0),
(21, 134, 'conducteur', 0),
(21, 154, 'conducteur', 0),
(22, 20, 'passager', 0),
(22, 34, 'passager', 0),
(23, 39, 'conducteur', 0),
(23, 135, 'conducteur', 0),
(23, 155, 'conducteur', 0),
(26, 194, 'conducteur', 0);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `nom` varchar(30) DEFAULT NULL,
  `prenom` varchar(30) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `credits` int DEFAULT '20',
  `photo` varchar(50) DEFAULT NULL,
  `id_role` int DEFAULT NULL,
  `poste` varchar(50) DEFAULT NULL,
  `numero_badge` varchar(20) DEFAULT NULL,
  `preference_role` enum('chauffeur','passager','les_deux') DEFAULT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `pseudo`, `nom`, `prenom`, `email`, `mot_de_passe`, `credits`, `photo`, `id_role`, `poste`, `numero_badge`, `preference_role`, `actif`) VALUES
(1, 'bob', 'nakamoto', 'bob', 'bob@test.com', '$2y$12$53s1w6ZnxazYIZSdrv3sEOSQ.qihFNE2.GHcLMOasL16FnzOYhdEu', 26, 'uploads/profils/6823b62e890bd_ppBob.jpg', 3, NULL, NULL, 'les_deux', 1),
(2, 'satoshi', 'nakamoto', 'satoshi', 'satoshiAdmin@test.com', '$2y$12$2s50yS7QpCu/4t4EKlsbhuzzTq.RKMu4jk0s4Nn/nJENPq9YdmJai', 170, NULL, 1, 'administrateur', '10', 'les_deux', 1),
(3, 'hal', 'finney', 'hal', 'hal@test.com', '$2y$12$2s50yS7QpCu/4t4EKlsbhuzzTq.RKMu4jk0s4Nn/nJENPq9YdmJai', 20, NULL, 2, 'moderateur', '11', NULL, 1),
(4, 'alice', 'nakamoto', 'alice', 'alice@test.com', '$2y$12$2s50yS7QpCu/4t4EKlsbhuzzTq.RKMu4jk0s4Nn/nJENPq9YdmJai', 48, NULL, 3, NULL, NULL, NULL, 1),
(5, 'aly', 'nakamoto', 'aly', 'aly@test.com', '$2y$12$KdWNSxC6J9CRNNIFD2pDfOEL3Xy40RY.pK/cnsFShHcw/Pfkvqkve', 20, NULL, 3, NULL, NULL, NULL, 1),
(6, 'matthieu', 'nakamoto', 'matthieu', 'matthieu@test.com', '$2y$12$9PvU8.Qd0Gr2Yld8saJfTuoSYdiNbfjDo7WKzja4aGmZfGXHMfI7i', 20, NULL, 3, NULL, NULL, NULL, 1),
(7, 'marie', 'nakamoto', 'marie', 'marie@test.com', '$2y$12$3EHiwUiwZ64avGG2CgOUe..DlNDCk4FGEnmgHJaNFJxLVO2bDikSi', 20, NULL, 3, NULL, NULL, NULL, 1),
(8, 'claudia', 'nakamoto', 'claudia', 'claudia@test.com', '$2y$12$Nlca29aJPsvmi3RI2OZ43u78EMF82SRDgAz2jMeoj78isyggAl5Su', 20, NULL, 3, NULL, NULL, NULL, 1),
(9, 'vitalik', 'butterin', 'vitalik', 'vitalik@test.com', '$2y$12$7XLv75j8FbulVAmVJnxI5u.sxVUTpgvNVwDTy2uRahRpWhTbyQ//a', 20, NULL, 2, 'moderateur', '12', NULL, 1),
(10, 'albert', 'dupond', 'albert', 'albert@test.com', '$2y$12$XSDX6T6C/awiAJlp/8TcYuRGLB6xfDqRUtYeZ0zZ2FLD1gXlW3EpC', 20, NULL, 2, 'informaticien', '13', NULL, 1),
(11, 'magalie', 'dupond', 'magalie', 'magali@test.com', '$2y$12$YmMEsIPc4mOK8Mpt4edBSuiXf9W6DI9uevwaUcKPisma2s/CxSkCK', 20, NULL, 2, 'moderatrice', '14', NULL, 1),
(12, 'test', 'test', 'test', 'test@test.com', '$2y$12$kLhv9nyq2wwGOjcN8Fd6l.SQ6a/KKXaPbhQfN.wlIv6v7cEDA0ntC', 206, 'uploads/profils/6823b5d534b5c_test1.jpg', 3, NULL, NULL, 'les_deux', 1),
(13, 'user12', 'Durand', 'Lucas', 'user12@mail.com', '$2y$12$l.ps2JRaYijzsWSAmwUsnOxsG7uO.wNmZm9DyVQ.eTX8eLc9Qk9dy', 20, NULL, 3, NULL, NULL, NULL, 1),
(14, 'user13', 'Moreau', 'Emma', 'user13@mail.com', '$2y$12$AluCTKGcAFp85wxMtU8Ca.IKZCH55j7iARaD8kjWEDqPQIkeqnLZy', 20, NULL, 3, NULL, NULL, NULL, 1),
(15, 'user14', 'Martin', 'Hugo', 'user14@mail.com', '$2y$12$FfBpeI4PrKXljIPR3WF9HuChse3zqxEXW5pTP/mMHf3z7duASqlly', 20, NULL, 3, NULL, NULL, NULL, 1),
(16, 'user15', 'Lemoine', 'Léa', 'user15@mail.com', '$2y$12$cypET.M7KcykOoXDydPu3eCKzdsl.VMrOodeCae3mQBSlTcPT/5bK', 20, NULL, 3, NULL, NULL, NULL, 1),
(17, 'user16', 'Petit', 'Max', 'user16@mail.com', '$2y$12$1uj9vH4UIV18hZ86gom09.J5ZVhSmr6NVQQmDWLOPCswXqlkc1aDO', 20, NULL, 3, NULL, NULL, NULL, 1),
(18, 'user17', 'Garcia', 'Camille', 'user17@mail.com', '$2y$12$WQqYafCSUtCcVI0Nv7Qwb.vYDopz0E9Dtx9BjRolnwl92BEXG/EmO', 20, NULL, 3, NULL, NULL, NULL, 1),
(19, 'user18', 'Leroux', 'Noah', 'user18@mail.com', '$2y$12$RYaKIm6J3yvTB4c6wwrS7.QX9qklFLQ8v66nnQQkzQZ1m.9/IOJVC', 20, NULL, 3, NULL, NULL, NULL, 1),
(20, 'user19', 'Schmitt', 'Chloé', 'user19@mail.com', '$2y$12$YlbYW829EieNw6CANnoMG.5GCQjuTGHvo5lWTeyRJUpzqeeAKlIgS', 20, NULL, 3, NULL, NULL, NULL, 1),
(21, 'user20', 'Bernard', 'Lilian', 'user20@mail.com', '$2y$12$NzqJBHJPUsXkPA9xLQ4mOeLW7n6LFKQQjz46J/ruo1GGfYZeHGMGq', 20, NULL, 3, NULL, NULL, NULL, 1),
(22, 'user21', 'Rousseau', 'Inès', 'user21@mail.com', '$2y$12$TAuZxAuadia70dqvCHrdqeVCT/osDb3ho6bqc4NLfaLDjX7nC8ssq', 20, NULL, 3, NULL, NULL, NULL, 1),
(23, 'lois', 'delatore', 'lois', 'lois@test.com', '$2y$10$jnUUsOF96NoSVYC5JiCBkupgdfgW4Nq635tsTRbYikJocISf4sYI2', 20, NULL, 3, NULL, NULL, NULL, 1),
(24, 'employerTestCrea', 'employerTestCrea', 'employerTestCrea', 'employerTest@test.com', '$2y$12$wzQEcmpYyzEiQEBwgSySAuaZlSV9FIGl9t9nXtwhlGrCa6t7VvlDa', 20, NULL, 2, 'testeur', '16', NULL, 1),
(25, 'testToken', 'testUpDate', 'testUpDate', 'testToken@test.com', '$2y$12$UmlG/Iy6.OguEo4.yvTSauwJPX3oGlkFeg1Jq9ugwnGHZyLIqRCVK', 20, NULL, 3, NULL, NULL, 'chauffeur', 1),
(26, 'testEnv', 'testEnv', 'test', 'testEnv@test.com', '$2y$12$tybCoZEsTKWvSUBmdVx0ZuHtKW3BfDnJnt6X2teT8oZaZspFdoypu', 20, NULL, 3, NULL, NULL, 'les_deux', 1),
(27, 'testUser', 'Nom', 'Prenom', 'test@example.com', '$2y$12$tcof5g5/NFbNIYzSo/F2HuZRnL5sdcaS9lFjZJ3rSCsF9Kc4C0Jpm', 20, NULL, 3, NULL, NULL, NULL, 1),
(28, 'testUser3', 'Nom', 'Prenom', 'test3@example.com', '$2y$12$vRs4BLK1qeI.yvGvnA.uXO/Eke7hJ82SDcSiXYqK6y04vVe.T6XbC', 20, NULL, 3, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vehicule`
--

CREATE TABLE `vehicule` (
  `id_vehicule` int NOT NULL,
  `id_utilisateur` int NOT NULL,
  `id_marque` int NOT NULL,
  `modele` varchar(50) NOT NULL,
  `immatriculation` varchar(30) DEFAULT NULL,
  `couleur` varchar(50) NOT NULL,
  `energie` enum('essence','diesel','electrique','hybride') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicule`
--

INSERT INTO `vehicule` (`id_vehicule`, `id_utilisateur`, `id_marque`, `modele`, `immatriculation`, `couleur`, `energie`) VALUES
(3, 12, 3, '306', 'mm 343 mm', 'gris', 'essence'),
(6, 1, 4, 'megane', 'mm 564 pp', 'noir', 'essence'),
(7, 1, 4, 'Clio', 'AB-123-CD', 'Bleu', 'essence'),
(8, 4, 3, '208', 'EF-456-GH', 'Rouge', 'diesel'),
(9, 5, 7, 'C3', 'IJ-789-KL', 'Noir', 'essence'),
(10, 6, 8, 'Model 3', 'MN-321-OP', 'Blanc', 'electrique'),
(11, 7, 9, 'Sandero', 'QR-654-ST', 'Gris', 'essence'),
(12, 8, 10, 'Golf', 'UV-987-WX', 'Vert', 'diesel'),
(13, 12, 11, 'Yaris', 'YZ-741-AA', 'Bleu clair', 'hybride'),
(14, 17, 12, 'Serie 1', 'AA-101-AA', 'Gris foncé', 'diesel'),
(15, 18, 13, 'Classe A', 'BB-202-BB', 'Noir', 'essence'),
(16, 19, 14, 'Focus', 'CC-303-CC', 'Rouge', 'essence'),
(17, 20, 15, 'Corsa', 'DD-404-DD', 'Blanc', 'electrique'),
(18, 21, 16, 'i30', 'EE-505-EE', 'Bleu', 'hybride'),
(19, 16, 3, '306', 'PM-345-LK', 'vert', 'diesel'),
(20, 23, 4, 'megane', '132 mp 433', 'noir', 'essence'),
(22, 26, 2, 'A3', 'test-123-env', 'noir', 'essence');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `covoiturage`
--
ALTER TABLE `covoiturage`
  ADD PRIMARY KEY (`id_covoiturage`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_vehicule` (`id_vehicule`);

--
-- Indexes for table `marque`
--
ALTER TABLE `marque`
  ADD PRIMARY KEY (`id_marque`);

--
-- Indexes for table `notation`
--
ALTER TABLE `notation`
  ADD PRIMARY KEY (`id_notation`),
  ADD UNIQUE KEY `id_utilisateur_auteur` (`id_utilisateur_auteur`,`id_covoiturage`),
  ADD KEY `id_utilisateur_cible` (`id_utilisateur_cible`),
  ADD KEY `id_covoiturage` (`id_covoiturage`);

--
-- Indexes for table `parametre`
--
ALTER TABLE `parametre`
  ADD PRIMARY KEY (`id_parametre`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id_transaction`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_passager` (`id_passager`),
  ADD KEY `transaction_ibfk_3` (`id_covoiturage`);

--
-- Indexes for table `user_covoiturage`
--
ALTER TABLE `user_covoiturage`
  ADD PRIMARY KEY (`id_utilisateur`,`id_covoiturage`),
  ADD KEY `fk_uc_covoiturage` (`id_covoiturage`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `fk_utilisateur_role` (`id_role`);

--
-- Indexes for table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id_vehicule`),
  ADD KEY `fk_voiture_utilisateur` (`id_utilisateur`),
  ADD KEY `fk_voiture_marque` (`id_marque`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `covoiturage`
--
ALTER TABLE `covoiturage`
  MODIFY `id_covoiturage` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;

--
-- AUTO_INCREMENT for table `marque`
--
ALTER TABLE `marque`
  MODIFY `id_marque` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notation`
--
ALTER TABLE `notation`
  MODIFY `id_notation` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parametre`
--
ALTER TABLE `parametre`
  MODIFY `id_parametre` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id_transaction` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id_vehicule` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `covoiturage`
--
ALTER TABLE `covoiturage`
  ADD CONSTRAINT `covoiturage_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `covoiturage_ibfk_2` FOREIGN KEY (`id_vehicule`) REFERENCES `vehicule` (`id_vehicule`);

--
-- Constraints for table `notation`
--
ALTER TABLE `notation`
  ADD CONSTRAINT `notation_ibfk_1` FOREIGN KEY (`id_utilisateur_cible`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `notation_ibfk_2` FOREIGN KEY (`id_utilisateur_auteur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `notation_ibfk_3` FOREIGN KEY (`id_covoiturage`) REFERENCES `covoiturage` (`id_covoiturage`);

--
-- Constraints for table `parametre`
--
ALTER TABLE `parametre`
  ADD CONSTRAINT `parametre_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_passager`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `transaction_ibfk_3` FOREIGN KEY (`id_covoiturage`) REFERENCES `covoiturage` (`id_covoiturage`) ON DELETE CASCADE;

--
-- Constraints for table `user_covoiturage`
--
ALTER TABLE `user_covoiturage`
  ADD CONSTRAINT `fk_uc_covoiturage` FOREIGN KEY (`id_covoiturage`) REFERENCES `covoiturage` (`id_covoiturage`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_uc_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `fk_utilisateur_role` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);

--
-- Constraints for table `vehicule`
--
ALTER TABLE `vehicule`
  ADD CONSTRAINT `fk_voiture_marque` FOREIGN KEY (`id_marque`) REFERENCES `marque` (`id_marque`),
  ADD CONSTRAINT `fk_voiture_utilisateur` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
