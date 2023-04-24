-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 24 avr. 2023 à 07:41
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
-- Structure de la table `biere`
--

CREATE TABLE `biere` (
  `id_biere` int NOT NULL,
  `nom_biere` varchar(60) NOT NULL,
  `photo` varchar(50) NOT NULL,
  `degres_d_alcool` int NOT NULL,
  `contenance` int NOT NULL COMMENT '(en cl)',
  `description` text NOT NULL,
  `en_stock` tinyint(1) NOT NULL,
  `id_type_de_biere` int NOT NULL,
  `id_origine` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `biere`
--

INSERT INTO `biere` (`id_biere`, `nom_biere`, `photo`, `degres_d_alcool`, `contenance`, `description`, `en_stock`, `id_type_de_biere`, `id_origine`) VALUES
(1, 'Kwak Rouge', 'Kwak_Rouge_33cl.webp', 8, 33, 'Cette Kwak Rouge se veut fidèle à la qualité et à l\'authenticité de la brasserie. Elle se révèle à travers une belle robe rouge surmontée d\'une fine couche de mousse. Au nez, on y découvre des arômes de fruits rouges, de cerise. En bouche, elle se révèle par une belle rondeur, de la puissance et des arômes de cerises et d\'amande.', 1, 6, 3),
(2, 'ERDINGER DUNKEL', 'erdinger_dunkel_50cl.webp', 5, 50, 'Cette bière brune est coiffée d\'une mousse épaisse et brillante de couleur crème. Au nez, on peut relever des arômes torréfiés, de chocolat noir ainsi que d\'arômes légèrement fruités. Enfin en bouche, on retrouve des notes de pain de campagne frais, un subtil goût de noisette et une fine amertume.', 1, 4, 2),
(3, 'VAL DIEU GRAND CRU', 'VAL_DIEU_GRAND_CRU_33_CL.webp', 11, 33, 'Les bières brassées au sein même de l’Abbaye du Val-Dieu sont inspirées des recettes originales des moines de la communauté chrétienne installée ici depuis 1216. Les siècles d’expérience donnent aujourd’hui naissance à des bières sophistiquées et toujours plus élaborées. Tradition oblige, l’élaboration se fait sans ajout d’épices ou d’aromates.\r\n\r\nLa Val-Dieu Grand Cru c’est la bière brune de dégustation par excellence ! Une Quadrupel à l’étonnante robe marron et aux reflets rougeoyants. De séduisants arômes grillés, de chocolat, de malt et de Porto. Des saveurs étonnantes de caramel, café et de noix.', 1, 4, 3),
(4, 'PIÑA COLADA WHEAT', 'PI_A_COLADA_WHEAT_33_cl.webp', 5, 33, 'Sa robe blonde très pâle et trouble se couvre d&#039;une fine mousse blanche très fugace. Une fois le nez plongé dans le verre, nous découvrons des arômes caractéristiques d&#039;une bière blanche belge. Les levures travaillent et laissent derrière elles leurs esters aux notes de banane et d&#039;épices. Les odeurs d&#039;agrumes traditionnelles d&#039;une witbier sont ici remplacées par un ananas gourmand et une noix de coco qui se développe en toile de fond.\r\n\r\nCe nez tout en équilibre est représentatif des saveurs qui se retrouvent une fois la bière en bouche. L&#039;attaque se porte sur les notes fraîches et levurées d&#039;une blanche. La fine acidité du blé s&#039;accompagne de notes finement épicées, de saveurs légères de banane. Le fruit arrive rapidement avec la noix de coco qui s&#039;exprime en douceur et en texture, apportant quelque chose de soyeux à cette bière blanche.', 0, 2, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `biere`
--
ALTER TABLE `biere`
  ADD PRIMARY KEY (`id_biere`),
  ADD KEY `id_type_de_biere` (`id_type_de_biere`,`id_origine`),
  ADD KEY `id_origine` (`id_origine`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `biere`
--
ALTER TABLE `biere`
  MODIFY `id_biere` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `biere`
--
ALTER TABLE `biere`
  ADD CONSTRAINT `biere_ibfk_1` FOREIGN KEY (`id_type_de_biere`) REFERENCES `type_de_biere` (`id_type_biere`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `biere_ibfk_2` FOREIGN KEY (`id_origine`) REFERENCES `origine` (`id_origine`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
