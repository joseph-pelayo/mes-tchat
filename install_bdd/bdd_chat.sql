-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 08 mars 2023 à 06:33
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `message` varchar(200) NOT NULL,
  `date` datetime(6) NOT NULL,
  `user_id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `piece`
--

CREATE TABLE `piece` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `type_ip` int(11) NOT NULL,
  `data` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `salon`
--

CREATE TABLE `salon` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `type_piece`
--

CREATE TABLE `type_piece` (
  `id` int(11) NOT NULL,
  `libelle` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `pseudo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `piece`
--
ALTER TABLE `piece`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salon`
--
ALTER TABLE `salon`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `type_piece`
--
ALTER TABLE `type_piece`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `piece`
--
ALTER TABLE `piece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `salon`
--
ALTER TABLE `salon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_piece`
--
ALTER TABLE `type_piece`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
