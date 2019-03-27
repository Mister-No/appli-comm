-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 27 mars 2019 à 21:35
-- Version du serveur :  5.7.25
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `app_comm`
--

-- --------------------------------------------------------

--
-- Structure de la table `newsletter_sender`
--

CREATE TABLE `newsletter_sender` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom_expediteur` varchar(255) DEFAULT NULL,
  `email_expediteur` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `newsletter_sender`
--

INSERT INTO `newsletter_sender` (`id`, `nom_expediteur`, `email_expediteur`) VALUES
(1, 'Villa Beausoleil', 'relationclients@villabeausoleil.com'),
(2, 'Manon Lamotte', 'manon.lamotte@villabeausoleil.com');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `newsletter_sender`
--
ALTER TABLE `newsletter_sender`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `newsletter_sender`
--
ALTER TABLE `newsletter_sender`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
