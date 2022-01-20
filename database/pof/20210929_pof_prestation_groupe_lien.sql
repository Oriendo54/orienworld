/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  pierremayer
 * Created: 29 sept. 2021
 */

DROP TABLE if exists `pof_prestation_groupe_lien`;
CREATE TABLE `pof_prestation_groupe_lien` (
  `id_prestation_groupe_lien` int(20) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `id_prestation_groupe` int(10),
  `id_prestation` int(10)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;