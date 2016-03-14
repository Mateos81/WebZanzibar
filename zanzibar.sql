-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 14 Mars 2016 à 22:23
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `zanzibar`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `Id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Title` varchar(80) NOT NULL,
  `Content` text NOT NULL,
  `Picture` text,
  `Author` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `articles`
--

INSERT INTO `articles` (`Id`, `Date`, `Title`, `Content`, `Picture`, `Author`) VALUES
(1, '2016-03-14', 'title', 'content', 'Zanzibar-Z-Logo.png', 'admin'),
(2, '2016-03-14', 'Title', 'ContÃ©nt 3', '', 'admin'),
(3, '2016-03-14', 'On met un titre Ã  la hauteur de l''image c''est Ã  dire un titre vraiment Ã©norme', 'On met un commentaire Ã  la hauteur de l''image c''est Ã  dire un commentaire vraiment Ã©norme (comme cette pÃ©pite). Enfin c''est pour tester si Ã§a fait pas de la bipppppp.\r\n', '', 'admin'),
(4, '2016-03-14', 'Titre avec des accent Ã Ã©Ã´iuf', 'Ã©Ã Ã§Ã¨^kÃ®', '', 'admin'),
(5, '2016-03-14', 'Test avec image bis', 'Ceci est un test avec une image bis', 'Hydrangeas.jpg', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `calendar`
--

CREATE TABLE `calendar` (
  `Date` date NOT NULL,
  `Event` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `Login` varchar(25) NOT NULL,
  `Pwd` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`Login`, `Pwd`) VALUES
('admin', 'admin');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`Date`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`Login`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
