/**
 * Author:  julienambroise
 * Created: 16/11/2021
**/

DROP TABLE if exists `pof_roles`;
CREATE TABLE `pof_roles` (
  `id_role` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE if exists `pof_user_roles`;
CREATE TABLE `pof_user_roles` (
  `id_user_role` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_user` int(10) NOT NULL,
  `id_role` int(10) NOT NULL default 3
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `pof_roles` VALUES(1, 'admin'), (2, 'moniteur'), (3, 'client');

ALTER TABLE `pof_client` ADD id_user int(10) DEFAULT NULL AFTER id_client_parent;
ALTER TABLE `pof_moniteurs` ADD id_user int(10) DEFAULT NULL AFTER id_moniteur;
ALTER TABLE `pof_moniteurs` ADD email varchar(255) DEFAULT NULL AFTER prenom;

/*
ATTRIBUTION DU ROLE ADMINISTRATEUR AU PREMIER UTILISATEUR ENREGISTRE
*/
INSERT INTO `pof_user_roles` VALUES(1, 1, 1);