/**
 * Author:  julienambroise
 * Created: 1 avr. 2021
 */

DROP TABLE if exists `pof_carte`;
CREATE TABLE `pof_carte` (
  `id_carte` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_client` int(10) NOT NULL,
  `id_prestation` int(10),
  `solde` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `created_at` timestamp DEFAULT now(),
  `updated_at` timestamp DEFAULT now(),
    key `id_client` (`id_client`),
    key `id_prestation` (`id_prestation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_carte_type`;
-- CREATE TABLE `pof_carte_type` (
--   `id_carte_type` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
--   `libelle` varchar(255)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_carte_type_prestation`;
-- CREATE TABLE `pof_carte_type_prestation` (
--   `id_carte_type_prestation` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
--   `id_carte_type` int(20),
--   `id_prestation` int(20)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_carte_facture`;
CREATE TABLE `pof_carte_facture` (
  `id_carte_facture` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_facture` int(20),
  `id_carte` int(10) NOT NULL,
  `solde` decimal(20,6) NOT NULL DEFAULT '0.000000',
    key `id_facture` (`id_facture`),
    key `id_carte` (`id_carte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_cheval`;
CREATE TABLE `pof_cheval` (
  `id_cheval` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_cheval_type` int(10) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `date_naissance` date DEFAULT NULL,
  `id_cheval_statut` int(10) DEFAULT 1,
  `created_at` timestamp DEFAULT now(),
  `updated_at` timestamp DEFAULT now(),
    key `id_cheval_type` (`id_cheval_type`),
    key `id_cheval_statut` (`id_cheval_statut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_cheval_type`;
CREATE TABLE `pof_cheval_type` (
  `id_cheval_type` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_cheval_statut`;
CREATE TABLE `pof_cheval_statut` (
  `id_cheval_statut` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255),
  `code` varchar(4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_client`;
CREATE TABLE `pof_client` (
  `id_client` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_client_parent` int(10) unsigned,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_naissance` date NOT NULL,
  `id_client_statut`int(10) NOT NULL,
  `id_client_niveau`int(10) DEFAULT NULL,
  `created_at` timestamp DEFAULT now(),
  `updated_at` timestamp DEFAULT now(),
    key `id_client_parent` (`id_client_parent`),
    key `id_client_statut` (`id_client_statut`),
    key `id_client_niveau` (`id_client_niveau`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_client_adresse`;
CREATE TABLE `pof_client_adresse` (
  `id_client_adresse` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_client` int(10) NOT NULL,
  `rue` varchar(255),
  `code_postal` varchar(5) NOT NULL,
  `ville` varchar(255) NOT NULL,
    key `id_client` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_client_telephone`;
CREATE TABLE `pof_client_telephone` (
    `id_client_telephone` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_client` int(10) unsigned NOT NULL,
    `telephone` varchar(255) DEFAULT "",
    key `id_client` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_client_statut`;
CREATE TABLE `pof_client_statut` (
  `id_client_statut` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255),
  `code` varchar(4),
  `par_defaut` int(1) unsigned DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_client_cheval_statut`;
CREATE TABLE `pof_client_cheval_statut` (
  `id_client_cheval_statut` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255),
  `code` varchar(4),
  `ordre` int(11)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE if exists `pof_client_cheval_statut_client_statut`;
-- CREATE TABLE `pof_client_cheval_statut_client_statut` (
--     `id_client_cheval_statut_client_statut` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
--     `id_client_cheval_statut` int(10) unsigned NOT NULL,
--     `id_client_statut_depart` int(10) unsigned NOT NULL,
--     `id_client_statut_arrive` int(10) unsigned NOT NULL
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE if exists `pof_client_cheval`;
CREATE TABLE `pof_client_cheval` (
    `id_client_cheval` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_client` int(10) unsigned NOT NULL,
    `id_cheval` int(10) unsigned NOT NULL,
    `id_client_cheval_statut` int(10) unsigned NOT NULL,
    `created_at` timestamp DEFAULT now(),
    `updated_at` timestamp DEFAULT now(),
    key `id_client` (`id_client`),
    key `id_cheval` (`id_cheval`),
    key `id_client_cheval_statut` (`id_client_cheval_statut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_cours`;
CREATE TABLE `pof_cours` (
  `id_cours` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_cours_type` int(10),
  `id_moniteur` int(10),
  `id_cours_emplacement` int(10),
  `date_cours` date NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `duree` time NOT NULL,
  `libelle` varchar(255),
  `nb_cavalier_max` int(10) NOT NULL,
  `created_at` timestamp DEFAULT now(),
  `updated_at` timestamp DEFAULT now(),
    key `id_cours_type` (`id_cours_type`),
    key `date_cours` (`date_cours`),
    key `id_cours_emplacement` (`id_cours_emplacement`),
    key `id_moniteur` (`id_moniteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_cours_client`;
CREATE TABLE `pof_cours_client` (
  `id_cours_client` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_cours` int(10) NOT NULL,
  `id_client` int(10) NOT NULL,
  `id_cheval` int(10),
  `id_cours_client_statut` int(10) NOT NULL,
    key `id_cours` (`id_cours`),
    key `id_client` (`id_client`),
    key `id_cheval` (`id_cheval`),
    key `id_cours_client_statut` (`id_cours_client_statut`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_cours_client_statut`;
CREATE TABLE `pof_cours_client_statut` (
  `id_cours_client_statut` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255),
  `code` varchar(4)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_cours_client_niveau`;
CREATE TABLE `pof_cours_client_niveau` (
  `id_cours_client_niveau` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_client_niveau` int(10),
  `id_cours` int(10),
    key `id_client_niveau` (`id_client_niveau`),
    key `id_cours` (`id_cours`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_cours_type`;
CREATE TABLE `pof_cours_type` (
  `id_cours_type` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_facture`;
CREATE TABLE `pof_facture` (
  `id_facture` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_client` int(10) NOT NULL,
  `id_facture_statut`int(10),
  `total_ht` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `total_ttc` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `total_paye_cb` decimal(20,6) DEFAULT '0.000000',
  `total_paye_cash` decimal(20,6) DEFAULT '0.000000',
  `total_paye_cheque` decimal(20,6) DEFAULT '0.000000',
  `total_paye_virement` decimal(20,6) DEFAULT '0.000000',
  `date_facture` timestamp DEFAULT now(),
  `created_at` timestamp DEFAULT now(),
  `updated_at` timestamp DEFAULT now(),
  `libelle` text,
    key `id_client` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_facture_statut`;
CREATE TABLE `pof_facture_statut` (
  `id_facture_statut` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_facture_detail`;
CREATE TABLE `pof_facture_detail` (
  `id_facture_detail` bigint(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_facture_detail_pere` int(20) unsigned DEFAULT NULL,
  `id_facture` int(20) unsigned NOT NULL,
  `id_prestation` int(10) NOT NULL,
  `id_tarif` int(10) NOT NULL,
  `id_carte` int(10) DEFAULT NULL,
  `quantite` int(10) NOT NULL DEFAULT 1,
  `total_ht` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `total_ttc` decimal(20,6) NOT NULL DEFAULT '0.000000',
  `created_at` timestamp DEFAULT now(),
  `updated_at` timestamp DEFAULT now(),
  `libelle` text,
    key `id_facture_detail_pere` (`id_facture_detail_pere`),
    key `id_facture` (`id_facture`),
    key `id_prestation` (`id_prestation`),
    key `id_tarif` (`id_tarif`),
    key `id_carte` (`id_carte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_client_niveau`;
CREATE TABLE `pof_client_niveau` (
  `id_client_niveau` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255),
  `ordre` int(10)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_prestation`;
CREATE TABLE `pof_prestation` (
  `id_prestation` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_prestation_type` int(10),
  `id_tva` int(10),
  `libelle` varchar(255),
  `id_client_statut` int(10),
  `age_min_client` int(10),
  `age_max_client` int(10),
  `id_cours_type` int(10),
  `duree` time NOT NULL,
    key `id_prestation_type` (`id_prestation_type`),
    key `id_tva` (`id_tva`),
    key `id_client_statut` (`id_client_statut`),
    key `id_cours_type` (`id_cours_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_prestation_groupe`;
CREATE TABLE `pof_prestation_groupe` (
  `id_prestation_groupe` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_prestation_groupe_lien`;
CREATE TABLE `pof_prestation_groupe_lien` (
  `id_prestation_groupe_lien` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_prestation_groupe` int(10),
  `id_prestation` int(10)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_prestation_type`;
CREATE TABLE `pof_prestation_type` (
  `id_prestation_type` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255),
  `code` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_moniteurs`;
CREATE TABLE `pof_moniteurs` (
  `id_moniteur` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `nom` varchar(255),
  `prenom` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_cours_emplacement`;
CREATE TABLE `pof_cours_emplacement` (
  `id_cours_emplacement` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_cours_type_prestation`;
CREATE TABLE `pof_cours_type_prestation` (
  `id_cours_type_prestation` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_cours_type` int(10),
  `id_prestation` int(10),
    key `id_cours_type` (`id_cours_type`),
    key `id_prestation` (`id_prestation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_tarif`;
CREATE TABLE `pof_tarif` (
  `id_tarif` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `libelle` varchar(255),
  `id_prestation` int(10),
  `quantite` int(10) NOT NULL DEFAULT 1,
  `prix_ht` decimal(20,6) DEFAULT NULL,
  `prix_ttc` decimal(20,6) DEFAULT NULL,
  `pourcentage` decimal(20,6) DEFAULT NULL,
  `actif` int(10),
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT '2099-01-01',
    key `id_prestation` (`id_prestation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_prestation_groupe`;
CREATE TABLE `pof_prestation_groupe` (
  `id_prestation_groupe` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_prestation_groupe_prestation`;
CREATE TABLE `pof_prestation_groupe_prestation` (
  `id_prestation_groupe_prestation` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_prestation_groupe` int(10),
  `id_prestation` int(10),
  `prestation_principale` int(10) default null,
    key `id_prestation_groupe` (`id_prestation_groupe`),
    key `id_prestation` (`id_prestation`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE if exists `pof_tva`;
CREATE TABLE `pof_tva` (
  `id_tva` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `taux` decimal(20,6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP VIEW if exists pof_facture_detail_lien;
CREATE VIEW pof_facture_detail_lien AS
select 
f.id_facture,
fd.id_facture_detail
from pof_facture f
join pof_facture_detail fd on fd.id_facture = f.id_facture
join pof_prestation p on p.id_prestation = fd.id_prestation
left join pof_prestation_groupe_prestation pgp on pgp.id_prestation = p.id_prestation
where pgp.id_prestation_groupe_prestation is null or pgp.prestation_principale = 1
;


DROP TABLE if exists `pof_log`;
CREATE TABLE `pof_log` (
  `id_log` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp DEFAULT now(),
  `message` text,
  `category` varchar(255),
  primary key (`id_log`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;