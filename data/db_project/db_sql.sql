DROP DATABASE IF EXISTS echoppe
CREATE DATABASE echoppe;
use echoppe;
-- ---
-- Globals
-- ---

-- SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
-- SET FOREIGN_KEY_CHECKS=0;

-- ---
-- Table 'produits'
-- 
-- ---

DROP TABLE IF EXISTS `produits`;
		
CREATE TABLE `produits` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(48) NOT NULL DEFAULT '""',
  `degres` DECIMAL NOT NULL DEFAULT 0.0,
  `stock` INTEGER NOT NULL DEFAULT 0,
  `description` VARCHAR(256) NULL DEFAULT NULL,
  `id_categorie` INTEGER NULL,
  `id_origines` INTEGER NULL,
  `contenance` INTEGER NULL DEFAULT NULL,
  `img` VARCHAR(64) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'paniers'
-- 
-- ---

DROP TABLE IF EXISTS `paniers`;
		
CREATE TABLE `paniers` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_user` INTEGER NULL,
  `id_etat_panier` INTEGER NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'categories'
-- 
-- ---

DROP TABLE IF EXISTS `categories`;
		
CREATE TABLE `categories` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(64) NOT NULL DEFAULT '""',
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'users'
-- 
-- ---

DROP TABLE IF EXISTS `users`;
		
CREATE TABLE `users` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(64) NOT NULL DEFAULT 'NULL',
  `mdp` VARCHAR(34) NOT NULL DEFAULT '0',
  `nom` VARCHAR(32) NULL DEFAULT NULL,
  `prenom` VARCHAR(32) NULL DEFAULT NULL,
  `niveau_droits` INTEGER(1) NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'etat_panier'
-- 
-- ---

DROP TABLE IF EXISTS `etat_panier`;
		
CREATE TABLE `etat_panier` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(32) NOT NULL DEFAULT 'NULL',
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'livre_or_commentaires'
-- 
-- ---

DROP TABLE IF EXISTS `livre_or_commentaires`;
		
CREATE TABLE `livre_or_commentaires` (
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `id_users` INTEGER NULL,
  `date` DATETIME NULL DEFAULT CURRENT_TIMESTAMP  ON UPDATE CURRENT_TIMESTAMP,
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
  `id` INTEGER NOT NULL AUTO_INCREMENT,
  `nom` INTEGER NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- ---
-- Table 'panier_produits'
-- 
-- ---

DROP TABLE IF EXISTS `panier_produits`;
		
CREATE TABLE `panier_produits` (
  `quantite` INTEGER NOT NULL DEFAULT 1,
  `id_paniers` INTEGER NULL,
  `id_produit` INTEGER NULL,
  PRIMARY KEY (`quantite`)
);

-- ---
-- Foreign Keys 
-- ---

ALTER TABLE `produits` ADD FOREIGN KEY (id_categorie) REFERENCES `categories` (`id`);
ALTER TABLE `produits` ADD FOREIGN KEY (id_origines) REFERENCES `origines` (`id`);
ALTER TABLE `paniers` ADD FOREIGN KEY (id_user) REFERENCES `users` (`id`);
ALTER TABLE `paniers` ADD FOREIGN KEY (id_etat_panier) REFERENCES `etat_panier` (`id`);
ALTER TABLE `livre_or_commentaires` ADD FOREIGN KEY (id_users) REFERENCES `users` (`id`);
ALTER TABLE `panier_produits` ADD FOREIGN KEY (id_paniers) REFERENCES `paniers` (`id`);
ALTER TABLE `panier_produits` ADD FOREIGN KEY (id_produit) REFERENCES `produits` (`id`);

-- ---
-- Table Properties
-- ---

-- ALTER TABLE `produits` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `paniers` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `categories` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `users` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `etat_panier` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `livre_or_commentaires` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `origines` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
-- ALTER TABLE `panier_produits` ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ---
-- Test Data
-- ---

-- INSERT INTO `produits` (`id`,`nom`,`degres`,`stock`,`description`,`id_categorie`,`id_origines`,`contenance`,`img`) VALUES
-- ('','','','','','','','','');
-- INSERT INTO `paniers` (`id`,`date`,`id_user`,`id_etat_panier`) VALUES
-- ('','','','');
-- INSERT INTO `categories` (`id`,`nom`) VALUES
-- ('','');
-- INSERT INTO `users` (`id`,`login`,`mdp`,`nom`,`prenom`,`niveau_droits`) VALUES
-- ('','','','','','');
-- INSERT INTO `etat_panier` (`id`,`nom`) VALUES
-- ('','');
-- INSERT INTO `livre_or_commentaires` (`id`,`id_users`,`date`,`commentaire`,`validation`) VALUES
-- ('','','','','');
-- INSERT INTO `origines` (`id`,`nom`) VALUES
-- ('','');
-- INSERT INTO `panier_produits` (`quantite`,`id_paniers`,`id_produit`) VALUES
-- ('','','');