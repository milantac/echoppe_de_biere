-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- base de données
-- 
-- ---
CREATE DATABASE IF NOT EXISTS echoppe; -- création de la base de données si elle n'existe pas
USE echoppe; -- utilisation de la base de données
-- ---
-- Table 'produits'
-- 
-- ---

CREATE TABLE IF NOT EXISTS `produits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(48) NOT NULL DEFAULT '""',
  `degres` DECIMAL NOT NULL DEFAULT 0.0,
  `stock` int NOT NULL DEFAULT 0,
  `description` VARCHAR(256) NULL DEFAULT NULL,
  `id_categorie` int NULL DEFAULT NULL,
  `id_origines` int NULL DEFAULT NULL,
  `contenance` int NULL DEFAULT NULL,
  `img` VARCHAR(64) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'paniers'
-- 
-- ---

CREATE TABLE IF NOT EXISTS `paniers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` int NULL DEFAULT NULL,
  `id_etat_panier` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'categories'
-- 
-- ---
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(64) NOT NULL DEFAULT '""',
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'users'
-- 
-- ---

CREATE TABLE `users` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `nom` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prenom` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'NULL',
  `tel` int NOT NULL,
  `numero_adresse` int NOT NULL,
  `voie_adresse` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code_postal` int NOT NULL,
  `ville_adresse` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `niveau_droits` int DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'etat_panier'
-- 
-- ---

CREATE TABLE IF NOT EXISTS `etat_panier` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(32) NOT NULL DEFAULT 'NULL',
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'livre_or_commentaires'
-- 
-- ---
CREATE TABLE IF NOT EXISTS `livre_or_commentaires` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_users` int NULL DEFAULT NULL,
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `commentaire` VARCHAR(256) NOT NULL DEFAULT 'NULL',
  `validation` bit NULL DEFAULT 0,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'origines'
-- 
-- ---

DROP TABLE IF EXISTS `origines`;
		
CREATE TABLE `origines` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'panier_produits'
-- 
-- ---

DROP TABLE IF EXISTS `panier_produits`;
		
CREATE TABLE `panier_produits` (
  `quantite` int NOT NULL DEFAULT 1,
  `id_paniers` int NULL DEFAULT NULL,
  `id_produit` int NULL DEFAULT NULL,
  PRIMARY KEY (`quantite`)
);
DROP TABLE IF EXISTS `type_users`;
		
CREATE TABLE `type_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`)
);
-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `produits` ADD FOREIGN KEY (id_categorie) REFERENCES `categories` (`id`);
ALTER TABLE `produits` ADD FOREIGN KEY (id_origines) REFERENCES `origines` (`id`);
ALTER TABLE `paniers` ADD FOREIGN KEY (id_user) REFERENCES `users` (`id`);
ALTER TABLE `paniers` ADD FOREIGN KEY (id_etat_panier) REFERENCES `etat_panier` (`id`);
ALTER TABLE `users` ADD FOREIGN KEY (niveau_droits) REFERENCES `type_users` (`id`);
ALTER TABLE `livre_or_commentaires` ADD FOREIGN KEY (id_users) REFERENCES `users` (`id`);
ALTER TABLE `panier_produits` ADD FOREIGN KEY (id_paniers) REFERENCES `paniers` (`id`);
ALTER TABLE `panier_produits` ADD FOREIGN KEY (id_produit) REFERENCES `produits` (`id`);


-- ---
-- Table Properties
-- ---

ALTER TABLE `produits` ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `paniers` ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `categories` ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `users` ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `etat_panier` ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `livre_or_commentaires` ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `origines` ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `panier_produits` ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `type_users` ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ---
-- Test Data
-- ---

INSERT INTO `categories` (`nom`) VALUES
('Ambrée'),('Blanche'),('Blonde'),('Brune'),('Noire'),('Rouge'),('Autre');
INSERT INTO `users` (`nom`, `prenom`, `login`, `tel`, `numero_adresse`, `voie_adresse`, `code_postal`, `ville_adresse`, `mdp`, `niveau_droits`) VALUES
('milant', 'milant', 'mil@ant.fr', 123456789, 32, 'rue jeanned\'arc', 54111, 'Mont-Bonvillers', '$2y$10$8OdQcxnK84HuramoDlm6ReeiduBke0BKjf4g4cDYYatUN.YXbh0B.', 1),
('tarte', 'aux pommes', 'milant@milant.fr', 612345789, 32, 'rue jeanned\'arc', 54111, 'Mont-Bonvillers', '$2y$10$8OdQcxnK84HuramoDlm6ReeiduBke0BKjf4g4cDYYatUN.YXbh0B.', 2);
INSERT IGNORE INTO `etat_panier` (`id`, `nom`) VALUES
(1, 'En cours'),(2, 'Validé'),(3, 'Annulé');
-- INSERT INTO `livre_or_commentaires` (`id`,`id_users`,`date`,`commentaire`,`validation`) VALUES
-- ('','','','','');
INSERT INTO `origines` (`nom`) VALUES
('France'),('Allemagne'),('Belge'),('Espagne'),('Portugal'),('Royaume-Uni'),('Italie'),('Pays-Bas'),('Suisse'),
('Irlande'),('Autriche'),('Danemark'),('Suède'),('Norvège'),('Finlande'),('Pologne'),('République tchèque'),('Slovaquie'),('Hongrie'),
('Roumanie'),('Bulgarie'),('Grèce'),('Ukraine'),('Biélorussie'),('Russie'),('Turquie'),('États-Unis'),('Canada'),('Mexique'),
('Brésil'),('Argentine'),('Chili'),('Colombie'),('Pérou'),('Venezuela'),('Australie'),('Nouvelle-Zélande'),('Japon'),('Corée du Sud'),
('Chine'),('Inde'),('Pakistan'),('Bangladesh'),('Indonésie'),('Malaisie'),('Philippines'),('Singapour'),('Vietnam'),('Afrique du Sud'),
('Égypte'),('Kenya'),('Nigeria'),('Algérie'),('Afghanistan'),('Albanie'),('Andorre'),('Angola'),('Antigua-et-Barbuda'),('Arabie saoudite'),
('Arménie'),('Azerbaïdjan'),('Bahamas'),('Bahreïn'),('Barbade'),('Belgique'),('Belize'),('Bénin'),('Bhoutan'),('Birmanie'),('Bolivie'),
('Bosnie-Herzégovine'),('Botswana'),('Brunei'),('Burkina Faso'),('Burundi'),('Cambodge'),('Cameroun'),('Cap-Vert'),('Centrafrique'),('Comores'),
('Congo-Brazzaville'),('Congo-Kinshasa'),('Corée du Nord'),('Costa Rica'),('Côte d\'Ivoire'),('Croatie'),('Cuba'),('Djibouti'),('Dominique'),('Émirats arabes unis'),
('Équateur'),('Érythrée'),('Estonie'),('Eswatini'),('Éthiopie'),('Fidji'),('Gabon'),('Gambie'),('Géorgie'),('Ghana'),
('Grenade'),('Guatemala'),('Guinée'),('Guinée équatoriale'),('Guinée-Bissau'),('Guyana'),('Haïti'),('Honduras'),('Îles Marshall'),('Irak'),('Iran'),
('Islande'),('Israël'),('Jamaïque'),('Jordanie'),('Kazakhstan'),('Kirghizistan'),('Kiribati'),('Koweït'),('Laos'),('Lesotho'),
('Lettonie'),('Liban'),('Liberia'),('Libye'),('Liechtenstein'),('Lituanie'),('Luxembourg'),('Macédoine du Nord'),('Madagascar'),('Malawi'),
('Maldives'),('Mali'),('Malte'),('Maroc'),('Maurice'),('Mauritanie'),('Micronésie'),('Moldavie'),('Monaco'),('Mongolie'),
('Monténégro'),('Mozambique'),('Namibie'),('Nauru'),('Népal'),('Nicaragua'),('Niger'),('Niué'),('Oman'),('Ouganda'),('Ouzbékistan'),('Palaos'),('Panama'),('Papouasie-Nouvelle-Guinée'),('Paraguay'),('Qatar'),('République dominicaine'),('Rwanda'),('Saint-Kitts-et-Nevis'),
('Saint-Vincent-et-les Grenadine'),
('Sainte-Lucie'),('Saint-Marin'),('Salomon'),('Salvador'),('Samoa'),('São Tomé-et-Principe'),('Sénégal'),('Serbie'),('Seychelles'),('Sierra Leone'),
('Singapour'),('Slovénie'),('Somalie'),('Soudan'),('Soudan du Sud'),('Sri Lanka'),('Suriname'),('Syrie'),('Tadjikistan'),('Tanzanie'),
('Tchad'),('Thaïlande'),('Timor oriental'),('Togo'),('Tonga'),('Trinité-et-Tobago'),('Tunisie'),('Turkménistan'),('Tuvalu'),('Uruguay'),
('Vanuatu'),('Vatican'),('Venezuela'),('Viêt Nam'),('Yémen'),('Zambie'),('Zimbabwe');
-- INSERT INTO `panier_produits` (`quantite`,`id_paniers`,`id_produit`) VALUES
-- ('','','');
INSERT IGNORE INTO `type_users` (`nom`) VALUES
('administrateur'),('utilisateur');