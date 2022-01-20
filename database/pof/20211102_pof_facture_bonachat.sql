/**
 * Author:  julienambroise
 * Created: 02/11/2021
**/

DROP TABLE if exists `pof_bonachat`;
CREATE TABLE `pof_bonachat` (
  `id_bonachat` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_client` int(10) NOT NULL,
  `minimum` decimal(20,6) DEFAULT '0.000000',
  `valeur` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `restant` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `date_expiration` datetime NOT NULL DEFAULT '2099-12-31 00:00:00',
  `actif` int(10) NOT NULL DEFAULT 1,
  `created_at` timestamp DEFAULT now(),
  `updated_at` timestamp DEFAULT now(),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_facture_bonachat`;
CREATE TABLE `pof_facture_bonachat` (
  `id_facture_bonachat` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_bonachat` int(10) NOT NULL,
  `id_facture` int(10) NOT NULL,
  `montant` decimal(20,6) NOT NULL DEFAULT '0.000000'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_moyen_paiement`;
CREATE TABLE `pof_moyen_paiement` (
  `id_moyen_paiement` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255) NOT NULL,
  `actif` int(2) NOT NULL default 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_facture_moyen_paiement`;
CREATE TABLE `pof_facture_moyen_paiement` (
  `id_facture_moyen_paiement` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_moyen_paiement` int(10) NOT NULL,
  `id_facture` int(10) NOT NULL,
  `montant` decimal(20,6) NOT NULL default 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `pof_facture`
DROP `total_paye_cb`;

ALTER TABLE `pof_facture`
DROP `total_paye_cash`;

ALTER TABLE `pof_facture`
DROP `total_paye_cheque`;

ALTER TABLE `pof_facture`
DROP `total_paye_virement`;

ALTER TABLE `pof_facture` ADD `total_bonachat_deduis` decimal(20.6) NOT NULL DEFAULT 0 AFTER `total_ttc`;
UPDATE `pof_facture` SET `total_bonachat_deduis` = `total_ttc` WHERE `total_bonachat_deduis` = 0;

INSERT INTO `pof_moyen_paiement`
VALUES(1, 'carte bancaire', 1), (2, 'especes', 1), (3, 'cheque', 1), (4, 'virement', 0), (5, 'cheque vacances', 1);