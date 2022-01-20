/**
 * Author:  julienambroise
 * Created: 15/10/2021
**/

ALTER TABLE pof_moniteurs
ADD couleur varchar(10) default '#000000';

UPDATE `ponyonebddp`.`pof_moniteurs` SET `couleur` = '#f665e4' WHERE (`id_moniteur` = '1');
UPDATE `ponyonebddp`.`pof_moniteurs` SET `couleur` = '#80df00' WHERE (`id_moniteur` = '2');
UPDATE `ponyonebddp`.`pof_moniteurs` SET `couleur` = '#004adf' WHERE (`id_moniteur` = '3');
UPDATE `ponyonebddp`.`pof_moniteurs` SET `couleur` = '#f3e20e' WHERE (`id_moniteur` = '4');
