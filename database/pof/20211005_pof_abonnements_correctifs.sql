/**
 * Author:  julienambroise
 * Created: 05/10/2021
**/

/* Mise à jour des tables pour les abonnements */

ALTER TABLE `pof_abonnement`,
DROP `recurrence`;

ALTER TABLE `pof_abonnement`,
ADD `periodicite` varchar(255) NOT NULL;

ALTER TABLE `pof_abonnement`,
ADD `libelle` varchar(255);

ALTER TABLE `pof_abonnement_client`,
ADD `echeance` datetime NOT NULL;

ALTER TABLE `pof_facture`
ADD `id_abonnement` int(10) default null
AFTER `id_client`;

ALTER TABLE `pof_abonnement_prestation`
ADD `id_tarif` int(10);
