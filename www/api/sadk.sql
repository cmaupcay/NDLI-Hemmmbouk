-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 02 déc. 2021 à 22:22
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sadk`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `mdp` varchar(512) NOT NULL,
  `pseudo` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `bateau`
--

CREATE TABLE `bateau` (
  `idBateau` int(11) NOT NULL,
  `nomBateau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `cookie`
--

CREATE TABLE `cookie` (
  `id` int(11) NOT NULL,
  `idu` int(11) NOT NULL,
  `ip` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sauve`
--

CREATE TABLE `sauve` (
  `idSauve` int(11) NOT NULL,
  `nomSauve` varchar(40) NOT NULL,
  `prenomSauve` varchar(40) NOT NULL,
  `age` int(11) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `idSauveteur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `sauveteur`
--

CREATE TABLE `sauveteur` (
  `idSauveteur` int(11) NOT NULL,
  `nomSauveteur` varchar(40) NOT NULL,
  `prenomSauveteur` varchar(40) NOT NULL,
  `Poste` varchar(30) NOT NULL,
  `idBateau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bateau`
--
ALTER TABLE `bateau`
  ADD PRIMARY KEY (`idBateau`);

--
-- Index pour la table `cookie`
--
ALTER TABLE `cookie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_admin` (`idu`);

--
-- Index pour la table `sauve`
--
ALTER TABLE `sauve`
  ADD PRIMARY KEY (`idSauve`),
  ADD KEY `FK_SAUVE` (`idSauveteur`);

--
-- Index pour la table `sauveteur`
--
ALTER TABLE `sauveteur`
  ADD PRIMARY KEY (`idSauveteur`),
  ADD KEY `FK_SAUVETEUR` (`idBateau`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `bateau`
--
ALTER TABLE `bateau`
  MODIFY `idBateau` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `cookie`
--
ALTER TABLE `cookie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sauve`
--
ALTER TABLE `sauve`
  MODIFY `idSauve` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `sauveteur`
--
ALTER TABLE `sauveteur`
  MODIFY `idSauveteur` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cookie`
--
ALTER TABLE `cookie`
  ADD CONSTRAINT `FK_admin` FOREIGN KEY (`idu`) REFERENCES `admin` (`id`);

--
-- Contraintes pour la table `sauve`
--
ALTER TABLE `sauve`
  ADD CONSTRAINT `FK_SAUVE` FOREIGN KEY (`idSauveteur`) REFERENCES `sauveteur` (`idSauveteur`) ON DELETE CASCADE;

--
-- Contraintes pour la table `sauveteur`
--
ALTER TABLE `sauveteur`
  ADD CONSTRAINT `FK_SAUVETEUR` FOREIGN KEY (`idBateau`) REFERENCES `bateau` (`idBateau`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
