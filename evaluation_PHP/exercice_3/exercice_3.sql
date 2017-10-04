-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 04 oct. 2017 à 13:16
-- Version du serveur :  10.1.22-MariaDB
-- Version de PHP :  7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `exercice_3`
--

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id_movies` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `actors` varchar(50) DEFAULT NULL,
  `director` varchar(50) DEFAULT NULL,
  `producer` varchar(50) DEFAULT NULL,
  `year_of_prod` year(4) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `category` enum('comédie','thriller','western') DEFAULT NULL,
  `storyline` text,
  `video` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id_movies`, `title`, `actors`, `director`, `producer`, `year_of_prod`, `language`, `category`, `storyline`, `video`) VALUES
(1, 'tests', 'tests', 'tests', 'tests', 2017, 'franÃ§ais', '', 'tests', 'tests.mp4'),
(2, 'test2', 'test2', 'test2', 'test2', 2017, 'franÃ§ais', '', 'test2', 'test2.mpeg'),
(3, 'test4', 'test4', 'test4', 'test4', 2017, 'franÃ§ais', '', 'test4', 'test4.mp4'),
(4, 'test5', 'test5', 'test5', 'test5', 2017, 'franÃ§ais', '', 'test5', 'test5.mp4'),
(5, 'test6', 'test6', 'test6', 'test6', 2017, 'franÃ§ais', '', 'test6', 'test6.mp4'),
(6, 'test6', 'test6', 'test6', 'test6', 2017, 'franÃ§ais', 'western', 'test6', 'test6.mp4'),
(7, 'test7', 'test7', 'test7', 'test7', 2017, 'franÃ§ais', 'comédie', 'test7', 'test7.mp4');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id_movies`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id_movies` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
