-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 03 mai 2023 à 14:34
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
  `nom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `commentaire` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'NULL',
  `validation` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livre_or_commentaires`
--

INSERT INTO `livre_or_commentaires` (`id`, `nom`, `prenom`, `email`, `date`, `commentaire`, `validation`) VALUES
(1, 'Dupont', 'Pierre', 'pierre.dupont@example.com', '2023-04-01 00:00:00', 'Superbe échoppe de bière à Jœuf, je recommande !', b'1'),
(2, 'Martin', 'Claire', 'claire.martin@example.com', '2023-04-05 00:00:00', 'Excellente sélection de bières, personnel accueillant et chaleureux.', b'1'),
(3, 'Leblanc', 'Paul', 'paul.leblanc@example.com', '2023-04-26 16:27:36', 'Ambiance agréable et bières de qualité, vivement la prochaine visite !', b'1'),
(4, 'Bernard', 'Sophie', 'sophie.bernard@example.com', '2023-04-15 00:00:00', 'Meilleur endroit pour déguster des bières artisanales à Jœuf !', b'1'),
(5, 'Simon', 'Julien', 'julien.simon@example.com', '2023-04-20 00:00:00', 'J’ai adoré les bières locales et l’atmosphère conviviale.', b'1');

-- --------------------------------------------------------

--
-- Structure de la table `origines`
--

CREATE TABLE `origines` (
  `id` int NOT NULL,
  `nom` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `origines`
--

INSERT INTO `origines` (`id`, `nom`) VALUES
(1, 'France'),
(2, 'Allemagne'),
(3, 'Belgique'),
(4, 'République tchèque'),
(5, 'Irlande'),
(6, 'États-Unis'),
(7, 'Brésil'),
(8, 'Espagne'),
(9, 'Mexique'),
(10, 'Japon'),
(11, 'Russie'),
(12, 'Pologne'),
(13, 'Afghanistan'),
(14, 'Afrique du Sud'),
(15, 'Albanie'),
(16, 'Algérie'),
(17, 'Andorre'),
(18, 'Angola'),
(19, 'Anguilla'),
(20, 'Antarctique'),
(21, 'Antigua-et-Barbuda'),
(22, 'Arabie saoudite'),
(23, 'Argentine'),
(24, 'Arménie'),
(25, 'Aruba'),
(26, 'Australie'),
(27, 'Autriche'),
(28, 'Azerbaïdjan'),
(29, 'Bénin'),
(30, 'Bahamas'),
(31, 'Bahreïn'),
(32, 'Bangladesh'),
(33, 'Barbade'),
(34, 'Belau'),
(35, 'Belize'),
(36, 'Italie'),
(37, 'Bermudes'),
(38, 'Bhoutan'),
(39, 'Birmanie'),
(40, 'Bolivie'),
(41, 'Bosnie-Herzégovine'),
(42, 'Botswana'),
(43, 'Brunei'),
(44, 'Bulgarie'),
(45, 'Burkina Faso'),
(46, 'Burundi'),
(47, 'Côte d\'Ivoire'),
(48, 'Cambodge'),
(49, 'Cameroun'),
(50, 'Canada'),
(51, 'Cap-Vert'),
(52, 'Chine'),
(53, 'Chypre'),
(54, 'Colombie'),
(55, 'Comores'),
(56, 'Congo'),
(57, 'Corée du Nord'),
(58, 'Corée du Sud'),
(59, 'Costa Rica'),
(60, 'Croatie'),
(61, 'Cuba'),
(62, 'Danemark'),
(63, 'Djibouti'),
(64, 'Dominique'),
(65, 'Égypte'),
(66, 'Émirats arabes unis'),
(67, 'Équateur'),
(68, 'Érythrée'),
(69, 'Estonie'),
(70, 'Éthiopie'),
(71, 'Finlande'),
(72, 'Gabon'),
(73, 'Gambie'),
(74, 'Géorgie'),
(75, 'Ghana'),
(76, 'Gibraltar'),
(77, 'Grèce'),
(78, 'Grenade'),
(79, 'Groenland'),
(80, 'Guadeloupe'),
(81, 'Guam'),
(82, 'Guatemala'),
(83, 'Guinée'),
(84, 'Guinée équatoriale'),
(85, 'Guinée-Bissau'),
(86, 'Guyana'),
(87, 'Guyane française'),
(88, 'Haïti'),
(89, 'Honduras'),
(90, 'Hong Kong'),
(91, 'Hongrie'),
(92, 'Islande'),
(93, 'Inde'),
(94, 'Indonésie'),
(95, 'Iran'),
(96, 'Iraq'),
(97, 'Israël'),
(98, 'Italie'),
(99, 'Jamaïque'),
(100, 'Jordanie'),
(101, 'Kenya'),
(102, 'Kirghizistan'),
(103, 'Kiribati'),
(104, 'Koweït'),
(105, 'Laos'),
(106, 'Lesotho'),
(107, 'Lettonie'),
(108, 'Liban'),
(109, 'Liberia'),
(110, 'Libye'),
(111, 'Liechtenstein'),
(112, 'Lituanie'),
(113, 'Luxembourg'),
(114, 'Macao'),
(115, 'Madagascar'),
(116, 'Malaisie'),
(117, 'Malawi'),
(118, 'Maldives'),
(119, 'Mali'),
(120, 'Mariannes du Nord'),
(121, 'Maroc'),
(122, 'Martinique'),
(123, 'Maurice'),
(124, 'Mauritanie'),
(125, 'Mayotte'),
(126, 'Micronésie'),
(127, 'Moldavie'),
(128, 'Monaco'),
(129, 'Mongolie'),
(130, 'Montserrat'),
(131, 'Mozambique'),
(132, 'Namibie'),
(133, 'Nauru'),
(134, 'Nicaragua'),
(135, 'Niger'),
(136, 'Nigeria'),
(137, 'Niue'),
(138, 'Norvège'),
(139, 'Nouvelle-Calédonie'),
(140, 'Nouvelle-Zélande'),
(141, 'Oman'),
(142, 'Ouganda'),
(143, 'Ouzbékistan'),
(144, 'Pakistan'),
(145, 'Panama'),
(146, 'Papouasie-Nouvelle-Guinée'),
(147, 'Paraguay'),
(148, 'Pays-Bas'),
(149, 'Philippines'),
(150, 'Polynésie française'),
(151, 'Porto Rico'),
(152, 'Portugal'),
(153, 'République centrafricaine'),
(154, 'République démocratique du Congo'),
(155, 'République dominicaine'),
(156, 'Réunion'),
(157, 'Roumanie'),
(158, 'Royaume-Uni'),
(159, 'Rwanda'),
(160, 'Sénégal'),
(161, 'Sahara occidental'),
(162, 'Saint-Christophe-et-Niévès'),
(163, 'Saint-Marin'),
(164, 'Saint-Pierre-et-Miquelon'),
(165, 'Saint-Siège'),
(166, 'Saint-Vincent-et-les-Grenadines'),
(167, 'Sainte-Hélène'),
(168, 'Sainte-Lucie'),
(169, 'Salvador'),
(170, 'Samoa'),
(171, 'Samoa américaines'),
(172, 'Sao Tomé-et-Principe'),
(173, 'Seychelles'),
(174, 'Sierra Leone'),
(175, 'Singapour'),
(176, 'Slovaquie'),
(177, 'Slovénie'),
(178, 'Somalie'),
(179, 'Soudan'),
(180, 'Sri Lanka'),
(181, 'Suède'),
(182, 'Suisse'),
(183, 'Suriname'),
(184, 'Eswatini'),
(185, 'Syrie'),
(186, 'Tadjikistan'),
(187, 'Tanzanie'),
(188, 'Tchad'),
(189, 'Thaïlande'),
(190, ' Timor-Leste'),
(191, 'Togo'),
(192, 'Tokélaou'),
(193, 'Tonga'),
(194, 'Trinité-et-Tobago'),
(195, 'Tunisie'),
(196, 'Turkménistan'),
(197, 'Turquie'),
(198, 'Tuvalu'),
(199, 'Ukraine'),
(200, 'Uruguay'),
(201, 'Vanuatu'),
(202, 'Venezuela'),
(203, 'Viêt Nam'),
(204, 'Wallis-et-Futuna'),
(205, 'Yémen'),
(206, 'Yougoslavie'),
(207, 'Zambie'),
(208, 'Zimbabwe'),
(209, 'ex-République yougoslave de Macédoine'),
(210, 'Chili'),
(211, 'Malte'),
(212, 'Serbie'),
(213, 'Monténégro'),
(214, 'Croatie'),
(215, 'Slovénie'),
(216, 'Bosnie-Herzégovine'),
(218, 'Taïwan');

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
  `nom` varchar(48) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '""',
  `degres` decimal(10,2) NOT NULL DEFAULT '0.00',
  `stock` int NOT NULL DEFAULT '0',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `id_categories` int DEFAULT NULL,
  `id_origines` int DEFAULT NULL,
  `contenance` int DEFAULT NULL,
  `img` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prix` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `degres`, `stock`, `description`, `id_categories`, `id_origines`, `contenance`, `img`, `prix`) VALUES
(1, 'Kwak Rouge', '8.00', 1, 'La Kwak Rouge de la brasserie belge Bosteels est une bière rafraîchissante à la cerise et aux amandes. Derrière sa robe rubis et sa mousse rose, il y a des arômes de fruits rouges, de cerise et de bonbon avec une pointe boisée.\r\n\r\nDélicatement amère, une fois en bouche, on y retrouve des saveurs fraîches et très fruitées de cerise, avec une puissance certaine qui se doit à ses 8% d&amp;amp;amp;#039;alcool.\r\n\r\nA déguster à une température de 8°C. ', 6, 3, 33, 'KwakRouge-6452222d2e624.webp', '2.45'),
(2, 'ERDINGER DUNKEL', '5.60', 12, 'L&#039;Erdinger Weissbier Dunkel est une bière de blé brun foncé avec une mousse abondante de couleur crème de durée moyenne et des bulles fines et douces, avec 5,6% d&#039;alcool en volume, son arôme se distingue par ses notes de malt grillé, du café et du caramel, sa saveur épicée, une amertume modérée, pas sucrée mais pas simple non plus, une bonne bière avec une parfaite maîtrise de ses ingrédients.', 4, 2, 50, 'erdinger_dunkel_50cl.webp', '2.25'),
(3, 'VAL DIEU GRAND CRU', '11.00', 1, 'Les bières brassées au sein même de l’Abbaye du Val-Dieu sont inspirées des recettes originales des moines de la communauté chrétienne installée ici depuis 1216. Les siècles d’expérience donnent aujourd’hui naissance à des bières sophistiquées et toujours ', 4, 3, 33, 'VAL_DIEU_GRAND_CRU_33_CL.webp', '3.00'),
(4, 'PIÑA COLADA WHEAT', '5.00', 0, 'Sa robe blonde très pâle et trouble se couvre d&#039;une fine mousse blanche très fugace. Une fois le nez plongé dans le verre, nous découvrons des arômes caractéristiques d&#039;une bière blanche belge. Les levures travaillent et laissent derrière elles l', 2, 1, 33, 'PI_A_COLADA_WHEAT_33_cl.webp', '3.30'),
(5, 'NOIRAUDE', '5.00', 33, 'Connaissez-vous la Noiraude ? Cette fameuse bière de Lorraine va vous combler.\r\n\r\nLa Noiraude est une bière blanche pur malt ; elle est brassée avec du malt de blé et du malt d&#039;orge blond. Son brassage est effectué avec une méthode d&#039;infusion, qu', 1, 1, 14, '644baffe72262.jpg', '2.00');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `origines`
--
ALTER TABLE `origines`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT pour la table `paniers`
--
ALTER TABLE `paniers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
