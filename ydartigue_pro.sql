-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql-5.7
-- Generation Time: Oct 25, 2024 at 07:15 PM
-- Server version: 5.7.28
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ydartigue_pro`
--

-- --------------------------------------------------------

--
-- Table structure for table `AcheterVehicule_utilisateurs`
--

CREATE TABLE `AcheterVehicule_utilisateurs` (
  `log` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `role` enum('client','admin') NOT NULL DEFAULT 'client'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `AcheterVehicule_utilisateurs`
--

INSERT INTO `AcheterVehicule_utilisateurs` (`log`, `mdp`, `role`) VALUES
('admin', '1884ddab6a9177c8459f42f15768a42821d4ad193b38f12e3d2328abd9155774', 'admin'),
('client', 'f828d5a81f759ee2eae7849174c1cb1fb193650ca4d1d71608db2d6e70005286', 'client');

-- --------------------------------------------------------

--
-- Table structure for table `AcheterVehicule_vehicule`
--

CREATE TABLE `AcheterVehicule_vehicule` (
  `modele` varchar(255) CHARACTER SET latin1 NOT NULL,
  `prix` decimal(12,2) NOT NULL,
  `chemin_Vignette` varchar(255) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `AcheterVehicule_vehicule`
--

INSERT INTO `AcheterVehicule_vehicule` (`modele`, `prix`, `chemin_Vignette`, `description`) VALUES
('1963 Lincoln Continental ', '375075.00', './img/voiturejfk.jpg', 'Super voiture pour défiler.\r\nPetit trou dans la banquette et quelques taches sur le cuir.'),
('Bifta', '7854.00', './img/bifta.jpg', 'Pour se balader à la plage sur le sable chaud.'),
('Blazer', '6588.00', './img/street-blazer.jpg', 'Un quad bien tuning qui a l\'avantage de posséder une évidente faute de gout.'),
('Caddy', '8500.00', './img/caddy.jpg', 'Pour vos parties de golf les plus folles.'),
('Dirigeable Atomic', '50000000.00', './img/atomic-blimp.jpg', ''),
('Faggio', '1247.00', './img/faggio.jpg', 'Scooter :\r\n- non-aérodynamique,\r\n- non-beau,\r\n- non-économique,\r\n- photo non contractuelle (revolver non inclus),\r\n- rose'),
('Kosatka', '158000000.00', './img/kosatka.jpg', 'Avec un tarif aussi attractif, vous serez le roi des océans.\r\nOption :\r\n- nucléaire\r\n- 23 couchage\r\n- Capitaine Soviétique...\r\n- OceanGate Controller !!'),
('Lada 2101', '623.00', './img/voiturepoutine1.jpg', 'Magnifique lada 2101 qui vous emmenera (peut-être) d\'un point A à un point B en passant par le point Z (= casse auto). Dictateur non-inclus.'),
('Limousine Armée', '599999.00', './img/limoarmee.jpg', ' '),
('Shamal', '15000000.00', './img/shamal.jpg', 'Avion très bien optionné :\r\n- équipage\r\n- 28 places\r\n- Chambre et salle de bain privée'),
('Trottinette', '7.00', './img/trot.jpg', 'Une superbe trottinette pour ce déplacer dans son sous-marin par exemple.'),
('Tuktuk indien', '137.00', './img/tuktukindien.jpg', 'La propreté laisse à désirer...'),
('Voiture présidentielle américaine', '3000000.00', './img/voiturepresidentielle.jpg', 'Tournez bien la tête en meeting.');
