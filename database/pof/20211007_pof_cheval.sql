/**
 * Author:  julienambroise
 * Created: 04/10/2021
**/

ALTER TABLE `pof_cheval`
ADD `actif` int(2) default 0
AFTER `id_cheval_statut`;