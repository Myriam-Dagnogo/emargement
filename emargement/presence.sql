-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : dim. 28 nov. 2021 à 16:35
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
-- Base de données : `Presence`
--

-- --------------------------------------------------------

--
-- Structure de la table `apprenant`
--

CREATE TABLE `apprenant` (
  `id_apprenant` int(11) NOT NULL,
  `nom_apprenant` varchar(250) DEFAULT NULL,
  `prenom_apprenant` varchar(250) DEFAULT NULL,
  `email_apprenant` varchar(250) DEFAULT NULL,
  `pass_apprenant` varchar(250) DEFAULT NULL,
  `contact_apprenant` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `apprenant`
--

INSERT INTO `apprenant` (`id_apprenant`, `nom_apprenant`, `prenom_apprenant`, `email_apprenant`, `pass_apprenant`, `contact_apprenant`) VALUES
(4, 'Nema', 'Sidy Mohamed', 'sidi.nema@gmail.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', '0505050505'),
(3, 'Sanogo', 'Brahima', 'brahima.sanogo79@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0788737849'),
(5, 'Ouattara', 'Mamadou', 'mamadou1@gmail.com', '6216f8a75fd5bb3d5f22b6f9958cdede3fc086c2', '0747916283');

-- --------------------------------------------------------

--
-- Structure de la table `commune`
--

CREATE TABLE `commune` (
  `id_commune` int(11) NOT NULL,
  `commune` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commune`
--

INSERT INTO `commune` (`id_commune`, `commune`) VALUES
(1, 'Abobo'),
(2, 'Cocody'),
(3, 'Bingerville'),
(4, 'Adjame');

-- --------------------------------------------------------

--
-- Structure de la table `finance`
--

CREATE TABLE `finance` (
  `id_finance` int(11) NOT NULL,
  `id_partenaire` int(11) DEFAULT NULL,
  `id_formation` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `formateur`
--

CREATE TABLE `formateur` (
  `id_formateur` int(11) NOT NULL,
  `nom_formateur` varchar(250) DEFAULT 'Ndiaye',
  `prenom_formateur` varchar(250) DEFAULT 'Abdoul',
  `pass_formateur` varchar(250) DEFAULT '2323'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `formateur`
--

INSERT INTO `formateur` (`id_formateur`, `nom_formateur`, `prenom_formateur`, `pass_formateur`) VALUES
(1, 'Ndiaye', 'Abdoul', '2323');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

CREATE TABLE `formation` (
  `id_formation` int(11) NOT NULL,
  `nom_formation` varchar(250) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `partenaire` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id_formation`, `nom_formation`, `date_debut`, `date_fin`, `partenaire`) VALUES
(4, 'Développeur Web & Mobile', '2021-11-24', '2023-09-05', ''),
(3, 'Développeur data IA', '2021-05-03', '2022-01-03', ''),
(5, 'Karaté', '2021-12-01', '2022-06-30', '6');

-- --------------------------------------------------------

--
-- Structure de la table `liste_emargement`
--

CREATE TABLE `liste_emargement` (
  `id_emmarger` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `date_connexion` text DEFAULT NULL,
  `id_apprenant` int(11) DEFAULT NULL,
  `arrivee` text DEFAULT NULL,
  `depart` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `liste_emargement`
--

INSERT INTO `liste_emargement` (`id_emmarger`, `nom`, `prenom`, `mail`, `date_connexion`, `id_apprenant`, `arrivee`, `depart`) VALUES
(1, 'Sanogo', 'Brahima', 'brahima.sanogo79@gmail.com', '28-11-2021', NULL, '12:05:13', '11:05:13'),
(2, 'Sanogo', 'Brahima', 'brahima.sanogo79@gmail.com', '28-11-2021', NULL, '12:07:51', NULL),
(3, 'Dagnogo', 'Myriam', 'myriam@gmail.com', '28-11-2021', 2, '12:12:01', '12:12:20'),
(4, 'Dagnogo', 'Myriam', 'myriam@gmail.com', '28-11-2021', 2, '12:21:27', NULL),
(5, 'Sanogo', 'Brahima', 'brahima.sanogo79@gmail.com', '28-11-2021', 3, '12:31:09', NULL),
(6, 'Nema', 'Sidy Mohamed', 'sidi.nema@gmail.com', '28-11-2021', 4, '12:34:38', '12:34:51'),
(7, 'Ouattara', 'Mamadou', 'mamadou1@gmail.com', '28-11-2021', 5, '12:38:12', '12:38:50');

-- --------------------------------------------------------

--
-- Structure de la table `partenaires`
--

CREATE TABLE `partenaires` (
  `id_partenaire` int(11) NOT NULL,
  `nom_partenaire` varchar(250) DEFAULT NULL,
  `mail_partenaire` varchar(255) NOT NULL,
  `contact_partenaire` varchar(250) DEFAULT NULL,
  `formation_financée` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `partenaires`
--

INSERT INTO `partenaires` (`id_partenaire`, `nom_partenaire`, `mail_partenaire`, `contact_partenaire`, `formation_financée`) VALUES
(6, 'MTN FOUNDATION', 'mtn1@gmail.com', '0505050505', 'Referent Digital'),
(7, 'Agence universitaire de la francophonie', 'auf@gmail.com', '0544938848', 'Developpement web et mobile'),
(8, 'MTN ACADEMY', 'mtn2@gmail.com', '0505050505', 'Developpement Data IA'),
(9, 'MTN Côte d\'ivoire ', 'mtn@gmail.com', '0505050505', 'Developpement Data IA');

-- --------------------------------------------------------

--
-- Structure de la table `type_utilisateurs`
--

CREATE TABLE `type_utilisateurs` (
  `id_type` int(11) NOT NULL,
  `type` varchar(250) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `type_utilisateurs`
--

INSERT INTO `type_utilisateurs` (`id_type`, `type`) VALUES
(1, 'apprenant'),
(2, 'formateur'),
(5, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateurs` int(11) NOT NULL,
  `pseudo` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `id_type` int(11) DEFAULT NULL,
  `token` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `apprenant`
--
ALTER TABLE `apprenant`
  ADD PRIMARY KEY (`id_apprenant`);

--
-- Index pour la table `commune`
--
ALTER TABLE `commune`
  ADD PRIMARY KEY (`id_commune`);

--
-- Index pour la table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`id_finance`),
  ADD KEY `fk_id_partenaire` (`id_partenaire`),
  ADD KEY `fk_id_formation` (`id_formation`);

--
-- Index pour la table `formateur`
--
ALTER TABLE `formateur`
  ADD PRIMARY KEY (`id_formateur`);

--
-- Index pour la table `formation`
--
ALTER TABLE `formation`
  ADD PRIMARY KEY (`id_formation`);

--
-- Index pour la table `liste_emargement`
--
ALTER TABLE `liste_emargement`
  ADD PRIMARY KEY (`id_emmarger`),
  ADD KEY `fk_id_utilisateurs` (`id_apprenant`);

--
-- Index pour la table `partenaires`
--
ALTER TABLE `partenaires`
  ADD PRIMARY KEY (`id_partenaire`);

--
-- Index pour la table `type_utilisateurs`
--
ALTER TABLE `type_utilisateurs`
  ADD PRIMARY KEY (`id_type`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateurs`),
  ADD KEY `fk_id_type` (`id_type`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `apprenant`
--
ALTER TABLE `apprenant`
  MODIFY `id_apprenant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `commune`
--
ALTER TABLE `commune`
  MODIFY `id_commune` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `finance`
--
ALTER TABLE `finance`
  MODIFY `id_finance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `formateur`
--
ALTER TABLE `formateur`
  MODIFY `id_formateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `formation`
--
ALTER TABLE `formation`
  MODIFY `id_formation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `liste_emargement`
--
ALTER TABLE `liste_emargement`
  MODIFY `id_emmarger` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `partenaires`
--
ALTER TABLE `partenaires`
  MODIFY `id_partenaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `type_utilisateurs`
--
ALTER TABLE `type_utilisateurs`
  MODIFY `id_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateurs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;