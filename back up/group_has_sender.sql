-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 27 mars 2019 à 21:32
-- Version du serveur :  5.7.25
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `app_comm`
--

-- --------------------------------------------------------

--
-- Structure de la table `group_has_sender`
--

CREATE TABLE `group_has_sender` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_group` int(11) DEFAULT NULL,
  `Id_expediteur` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `group_has_sender`
--

INSERT INTO `group_has_sender` (`id`, `id_group`, `Id_expediteur`) VALUES
(1, 2, 1),
(2, 2, 2),
(3, 3, 1),
(4, 3, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `group_has_sender`
--
ALTER TABLE `group_has_sender`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `group_has_sender`
--
ALTER TABLE `group_has_sender`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
