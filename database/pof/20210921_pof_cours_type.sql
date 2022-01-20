/**
 * Author:  julienambroise
 * Created: 21/09/2021
**/

ALTER TABLE `pof_cours_type`
ADD `couleur_planning` varchar(255),
ADD `libelle_planning` varchar(255);

UPDATE `pof_cours_type` 
SET `couleur_planning` = 'warning', `libelle_planning` = 'CC' WHERE (`id_cours_type` = 1);

UPDATE `pof_cours_type` 
SET `couleur_planning` = 'primary', `libelle_planning` = 'CP' WHERE (`id_cours_type` = 2);

UPDATE `pof_cours_type` 
SET `couleur_planning` = 'danger', `libelle_planning` = 'Promenade' WHERE (`id_cours_type` = 3);

UPDATE `pof_cours_type` 
SET `couleur_planning` = 'success', `libelle_planning` = 'Stage' WHERE (`id_cours_type` = 4);

UPDATE `pof_cours_type` 
SET `couleur_planning` = 'danger', `libelle_planning` = 'Rando' WHERE (`id_cours_type` = 5);

