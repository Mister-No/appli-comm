-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  lun. 11 mars 2019 à 18:47
-- Version du serveur :  5.7.23
-- Version de PHP :  5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `app_comm`
--

-- --------------------------------------------------------

--
-- Structure de la table `newsletter_has_contacts`
--

CREATE TABLE `newsletter_has_contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_newsletter` int(11) DEFAULT NULL,
  `id_contact` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `newsletter_has_contacts`
--
ALTER TABLE `newsletter_has_contacts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `newsletter_has_contacts`
--
ALTER TABLE `newsletter_has_contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
