/**
 * Author:  julienambroise
 * Created: 13/09/2021
**/

ALTER TABLE `pof_prestation_groupe` 
RENAME TO `pof_prestation_association`;

ALTER TABLE `pof_prestation_association`
CHANGE `id_prestation_groupe` `id_prestation_association` int(20) unsigned NOT NULL AUTO_INCREMENT,
ADD `libelle` varchar(255);

ALTER TABLE `pof_prestation_groupe_prestation`
RENAME TO `pof_prestation_association_lien`;

ALTER TABLE `pof_prestation_association_lien`
CHANGE `id_prestation_groupe_prestation` `id_prestation_association_lien` int(20) unsigned NOT NULL AUTO_INCREMENT,
CHANGE `id_prestation_groupe` `id_prestation_association` int(10);

DROP VIEW if exists pof_facture_detail_lien;
CREATE VIEW pof_facture_detail_lien AS
select 
f.id_facture,
fd.id_facture_detail
from pof_facture f
join pof_facture_detail fd on fd.id_facture = f.id_facture
join pof_prestation p on p.id_prestation = fd.id_prestation
left join pof_prestation_association_lien pal on pal.id_prestation = p.id_prestation
where pal.id_prestation_association_lien is null or pal.prestation_principale = 1
;

CREATE TABLE `pof_prestation_groupe` (
    `id_prestation_groupe` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `libelle` varchar(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `pof_facture_detail`
ADD id_prestation_groupe int(10)
AFTER id_prestation;