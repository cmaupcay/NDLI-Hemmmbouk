-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 03 déc. 2021 à 01:21
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
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `mdp` varchar(512) NOT NULL,
  `pseudo` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `texte` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`texte`)),
  `image` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`image`)),
  `categorie` int(11) NOT NULL,
  `dateCreation` datetime NOT NULL,
  `dateMAJ` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `bateau`
--

CREATE TABLE `bateau` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nomBateau` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `cookie`
--

CREATE TABLE `cookie` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `idu` int(11) NOT NULL,
  `ip` varchar(16) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `victime`
--

CREATE TABLE `victime` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nomVictime` varchar(40) NOT NULL,
  `prenomVictime` varchar(40) NOT NULL,
  `age` int(11) NOT NULL,
  `sexe` varchar(1) NOT NULL,
  `decede` boolean NOT NULL,
  `idSortie` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `sauveteur`
--

CREATE TABLE `sauveteur` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nomSauveteur` varchar(40) NOT NULL,
  `prenomSauveteur` varchar(40) NOT NULL,
  `Poste` varchar(30) NOT NULL,
  `idArticle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `sortie`
--

CREATE TABLE `sortie` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `infos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`infos`)),
  `idArticle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;