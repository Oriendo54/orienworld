/**
 * Author:  julienambroise
 * Created: 21/09/2021
**/

CREATE TABLE `pof_abonnement` (
    `id_abonnement` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `date_debut` datetime NOT NULL default now(),
    `date_expiration` datetime NOT NULL default '2099-12-31',
    `total_ttc` float(10) NOT NULL,
    `recurrence` varchar(255) NOT NULL default 'annuel'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `pof_abonnement_client` (
    `id_abonnement_client` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_abonnement` int(10) NOT NULL,
    `id_client` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `pof_abonnement_prestation` (
    `id_abonnement_prestation` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `id_abonnement` int(10) NOT NULL,
    `id_prestation` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;