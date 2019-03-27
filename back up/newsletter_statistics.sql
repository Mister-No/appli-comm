-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  mer. 27 mars 2019 à 12:07
-- Version du serveur :  5.7.25
-- Version de PHP :  5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `app_comm`
--

-- --------------------------------------------------------

--
-- Structure de la table `newsletter_statistics`
--

CREATE TABLE `newsletter_statistics` (
  `id` int(11) NOT NULL,
  `date_heure` datetime DEFAULT NULL,
  `id_newsletter` int(11) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `ouverture` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `newsletter_statistics`
--
ALTER TABLE `newsletter_statistics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `newsletter_statistics`
--
ALTER TABLE `newsletter_statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
