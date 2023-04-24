-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 24 avr. 2023 à 07:55
-- Version du serveur : 8.0.32
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `echoppe_de_biere`
--

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int NOT NULL,
  `nom_utilisateur` varchar(30) NOT NULL,
  `prenom_utilisateur` varchar(30) NOT NULL,
  `mail_utilisateur` varchar(60) NOT NULL,
  `tel_utilisateur` int NOT NULL,
  `numero_adresse` int NOT NULL,
  `voie_adresse` varchar(100) NOT NULL,
  `code_postal` int NOT NULL,
  `ville_adresse` varchar(50) NOT NULL,
  `mdp_utilisateur` varchar(255) NOT NULL,
  `type_utilisateur` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `nom_utilisateur`, `prenom_utilisateur`, `mail_utilisateur`, `tel_utilisateur`, `numero_adresse`, `voie_adresse`, `code_postal`, `ville_adresse`, `mdp_utilisateur`, `type_utilisateur`) VALUES
(1, 'milant', 'milant', 'mil@ant.fr', 123456789, 32, 'rue jeanned\'arc', 54111, 'Mont-Bonvillers', '$2y$10$8OdQcxnK84HuramoDlm6ReeiduBke0BKjf4g4cDYYatUN.YXbh0B.', 1),
(3, 'tarte', 'aux pommes', 'milant@milant.fr', 612345789, 32, 'rue jeanned\'arc', 54111, 'Mont-Bonvillers', '$2y$10$8OdQcxnK84HuramoDlm6ReeiduBke0BKjf4g4cDYYatUN.YXbh0B.', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`),
  ADD KEY `type_utilisateur` (`type_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`type_utilisateur`) REFERENCES `type_utilisateur` (`id_type_utilisateur`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
