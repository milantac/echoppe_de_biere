-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 26 avr. 2023 à 06:44
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
-- Base de données : `echoppe`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `nom` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '""'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Ambrée'),
(2, 'Blanche'),
(3, 'Blonde'),
(4, 'Brune'),
(5, 'Noire'),
(6, 'Rouge'),
(7, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `etat_panier`
--

CREATE TABLE `etat_panier` (
  `id` int NOT NULL,
  `nom` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'NULL'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `etat_panier`
--

INSERT INTO `etat_panier` (`id`, `nom`) VALUES
(1, 'En cours'),
(2, 'Validé'),
(3, 'Annulé');

-- --------------------------------------------------------

--
-- Structure de la table `livre_or_commentaires`
--

CREATE TABLE `livre_or_commentaires` (
  `id` int NOT NULL,
  `nom` VARCHAR(255) NOT NULL,
  `prenom` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `commentaire` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'NULL',
  `validation` bit(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `origines`
--

CREATE TABLE `origines` (
  `id` int NOT NULL,
  `nom` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `origines`
--

INSERT INTO `origines` (`id`, `nom`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(5, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(11, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(16, 0),
(17, 0),
(18, 0),
(19, 0),
(20, 0),
(21, 0),
(22, 0),
(23, 0),
(24, 0),
(25, 0),
(26, 0),
(27, 0),
(28, 0),
(29, 0),
(30, 0),
(31, 0),
(32, 0),
(33, 0),
(34, 0),
(35, 0),
(36, 0),
(37, 0),
(38, 0),
(39, 0),
(40, 0),
(41, 0),
(42, 0),
(43, 0),
(44, 0),
(45, 0),
(46, 0),
(47, 0),
(48, 0),
(49, 0),
(50, 0),
(51, 0),
(52, 0),
(53, 0),
(54, 0),
(55, 0),
(56, 0),
(57, 0),
(58, 0),
(59, 0),
(60, 0),
(61, 0),
(62, 0),
(63, 0),
(64, 0),
(65, 0),
(66, 0),
(67, 0),
(68, 0),
(69, 0),
(70, 0),
(71, 0),
(72, 0),
(73, 0),
(74, 0),
(75, 0),
(76, 0),
(77, 0),
(78, 0),
(79, 0),
(80, 0),
(81, 0),
(82, 0),
(83, 0),
(84, 0),
(85, 0),
(86, 0),
(87, 0),
(88, 0),
(89, 0),
(90, 0),
(91, 0),
(92, 0),
(93, 0),
(94, 0),
(95, 0),
(96, 0),
(97, 0),
(98, 0),
(99, 0),
(100, 0),
(101, 0),
(102, 0),
(103, 0),
(104, 0),
(105, 0),
(106, 0),
(107, 0),
(108, 0),
(109, 0),
(110, 0),
(111, 0),
(112, 0),
(113, 0),
(114, 0),
(115, 0),
(116, 0),
(117, 0),
(118, 0),
(119, 0),
(120, 0),
(121, 0),
(122, 0),
(123, 0),
(124, 0),
(125, 0),
(126, 0),
(127, 0),
(128, 0),
(129, 0),
(130, 0),
(131, 0),
(132, 0),
(133, 0),
(134, 0),
(135, 0),
(136, 0),
(137, 0),
(138, 0),
(139, 0),
(140, 0),
(141, 0),
(142, 0),
(143, 0),
(144, 0),
(145, 0),
(146, 0),
(147, 0),
(148, 0),
(149, 0),
(150, 0),
(151, 0),
(152, 0),
(153, 0),
(154, 0),
(155, 0),
(156, 0),
(157, 0),
(158, 0),
(159, 0),
(160, 0),
(161, 0),
(162, 0),
(163, 0),
(164, 0),
(165, 0),
(166, 0),
(167, 0),
(168, 0),
(169, 0),
(170, 0),
(171, 0),
(172, 0),
(173, 0),
(174, 0),
(175, 0),
(176, 0),
(177, 0),
(178, 0),
(179, 0),
(180, 0),
(181, 0),
(182, 0),
(183, 0),
(184, 0),
(185, 0),
(186, 0),
(187, 0),
(188, 0),
(189, 0),
(190, 0),
(191, 0),
(192, 0),
(193, 0),
(194, 0),
(195, 0),
(196, 0),
(197, 0),
(198, 0);

-- --------------------------------------------------------

--
-- Structure de la table `paniers`
--

CREATE TABLE `paniers` (
  `id` int NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int DEFAULT NULL,
  `id_etat_panier` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `panier_produits`
--

CREATE TABLE `panier_produits` (
  `quantite` int NOT NULL DEFAULT '1',
  `id_paniers` int DEFAULT NULL,
  `id_produit` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int NOT NULL,
  `nom` varchar(48) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '""',
  `degres` decimal(10,0) NOT NULL DEFAULT '0',
  `stock` int NOT NULL DEFAULT '0',
  `description` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_categories` int DEFAULT NULL,
  `id_origines` int DEFAULT NULL,
  `contenance` int DEFAULT NULL,
  `img` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `degres`, `stock`, `description`, `id_categories`, `id_origines`, `contenance`, `img`) VALUES
(1, 'Kwak Rouge', '8', 1, 'Cette Kwak Rouge se veut fidèle à la qualité et à l\'authenticité de la brasserie. Elle se révèle à travers une belle robe rouge surmontée d\'une fine couche de mousse. Au nez, on y découvre des arômes de fruits rouges, de cerise. En bouche, elle se révèle p', 6, 3, 33, 'Kwak_Rouge_33cl.webp'),
(2, 'ERDINGER DUNKEL', '5', 1, 'Cette bière brune est coiffée d\'une mousse épaisse et brillante de couleur crème. Au nez, on peut relever des arômes torréfiés, de chocolat noir ainsi que d\'arômes légèrement fruités. Enfin en bouche, on retrouve des notes de pain de campagne frais, un sub', 4, 2, 50, 'erdinger_dunkel_50cl.webp'),
(3, 'VAL DIEU GRAND CRU', '11', 1, 'Les bières brassées au sein même de l’Abbaye du Val-Dieu sont inspirées des recettes originales des moines de la communauté chrétienne installée ici depuis 1216. Les siècles d’expérience donnent aujourd’hui naissance à des bières sophistiquées et toujours ', 4, 3, 33, 'VAL_DIEU_GRAND_CRU_33_CL.webp'),
(4, 'PIÑA COLADA WHEAT', '5', 0, 'Sa robe blonde très pâle et trouble se couvre d&#039;une fine mousse blanche très fugace. Une fois le nez plongé dans le verre, nous découvrons des arômes caractéristiques d&#039;une bière blanche belge. Les levures travaillent et laissent derrière elles l', 2, 1, 33, 'PI_A_COLADA_WHEAT_33_cl.webp');

-- --------------------------------------------------------

--
-- Structure de la table `type_users`
--

CREATE TABLE `type_users` (
  `id` int NOT NULL,
  `nom` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `type_users`
--

INSERT INTO `type_users` (`id`, `nom`) VALUES
(1, 'administrateur'),
(2, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nom` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'NULL',
  `tel` int NOT NULL,
  `numero_adresse` int NOT NULL,
  `voie_adresse` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code_postal` int NOT NULL,
  `ville_adresse` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `niveau_droits` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `login`, `tel`, `numero_adresse`, `voie_adresse`, `code_postal`, `ville_adresse`, `mdp`, `niveau_droits`) VALUES
(1, 'milant', 'milant', 'mil@ant.fr', 123456789, 32, 'rue jeanned\'arc', 54111, 'Mont-Bonvillers', '$2y$10$8OdQcxnK84HuramoDlm6ReeiduBke0BKjf4g4cDYYatUN.YXbh0B.', 1),
(2, 'tarte', 'aux pommes', 'milant@milant.fr', 612345789, 32, 'rue jeanned\'arc', 54111, 'Mont-Bonvillers', '$2y$10$8OdQcxnK84HuramoDlm6ReeiduBke0BKjf4g4cDYYatUN.YXbh0B.', 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `etat_panier`
--
ALTER TABLE `etat_panier`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livre_or_commentaires`
--
ALTER TABLE `livre_or_commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `origines`
--
ALTER TABLE `origines`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `paniers`
--
ALTER TABLE `paniers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_etat_panier` (`id_etat_panier`);

--
-- Index pour la table `panier_produits`
--
ALTER TABLE `panier_produits`
  ADD PRIMARY KEY (`quantite`),
  ADD KEY `id_paniers` (`id_paniers`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categorie` (`id_categories`),
  ADD KEY `id_origines` (`id_origines`);

--
-- Index pour la table `type_users`
--
ALTER TABLE `type_users`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `niveau_droits` (`niveau_droits`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `etat_panier`
--
ALTER TABLE `etat_panier`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `livre_or_commentaires`
--
ALTER TABLE `livre_or_commentaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `origines`
--
ALTER TABLE `origines`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT pour la table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `type_users`
--
ALTER TABLE `type_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
