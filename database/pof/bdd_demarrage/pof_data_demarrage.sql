
/* vider les tables annexes dépendante */

truncate table pof_facture;
truncate table pof_facture_detail;
truncate table pof_tarif;
truncate table pof_cours;
truncate table pof_prestation_groupe;
truncate table pof_prestation_groupe_prestation;
truncate table pof_carte;


/* Chevaux */

truncate table pof_cheval_type;
truncate table pof_cheval_statut;
truncate table pof_client_cheval_statut;

INSERT INTO pof_cheval_type value (1, 'Shetland'), (2, 'Poney'), (3, 'Double-poney'), (4, 'Cheval');
INSERT INTO pof_cheval_statut value (1, 'Club','C'), (2, 'Propriétaire','P'), (3, 'Demi-pension','DP');
INSERT INTO pof_client_cheval_statut value (1, 'Propriétaire','P',1), (2, 'Demi-pension','DP',2);


/* Clients */

truncate table pof_client_statut;
truncate table pof_client_niveau;

INSERT INTO pof_client_statut value (1, 'Adhérent', 'ADH',0), (2, 'Passager', 'PSG',1), (3, 'Adherent-propriétaire', 'ADHP',0), 
(4, 'Passager-propriétaire', 'PSGP',0);
INSERT INTO pof_client_niveau value (1, 'Débutant', 1), (2, 'G1', 2), (3, 'G2', 3), (4, 'G3', 4), (5, 'G4', 5), (6, 'G5', 6),
(7, 'G6', 7), (8, 'G7', 8);


/* Cours */

truncate table pof_cours_client_statut;
truncate table pof_cours_type;
truncate table pof_cours_emplacement;

INSERT INTO pof_cours_client_statut value (1, 'Inscrit', 'INS'), (2, 'Valide', 'VAL');
INSERT INTO pof_cours_type value (1, 'Cours collectif'), (2, 'Cours particulier'), (3, 'Promenade'), (4, 'Stage'), (5, 'Randonnée');
INSERT INTO pof_cours_emplacement value (1, 'Grand manège'), (2, 'Petit manège'), (3, 'Carrière'), (4, 'Promenade');


/* Facture */

truncate table pof_facture_statut;

INSERT INTO pof_facture_statut value (1, 'À régler'), (2, 'Payée');


/* Moniteurs */

truncate table pof_moniteurs;
INSERT INTO pof_moniteurs value 
(1, 'Mayer', 'Guillaume'), 
(2, 'Mayer', 'Rachel'), 
(3, 'Pas de Moniteur', '');


/* Prestations */

truncate table pof_prestation;
truncate table pof_prestation_type;

INSERT INTO pof_prestation_type value
(1, 'Carte cours', 'CAR'),
(2, 'Pension', 'PEN'),
(3, 'Travail chevaux', 'TRA'),
(4, 'Concours', 'CON'),
(5, 'Cotisation', 'COT'),
(6, 'Licence', 'LIC'),
(7, "Bon d'achat", 'BON')
;

INSERT INTO pof_prestation (id_prestation_type,id_tva,libelle,id_client_statut,age_min_client,age_max_client,id_cours_type,duree)
value
(1, 1, 'Cours collectif ADH 30min -13 ans', 1, 0, 12, 1, '00:30:00'),
(1, 1, 'Cours collectif PSG 30min -13 ans', 2, 0, 12, 1, '00:30:00'),
(1, 1, 'Cours collectif ADH 30min +13 ans', 1, 13, 99, 1, '00:30:00'),
(1, 1, 'Cours collectif PSG 30min +13 ans', 2, 13, 99, 1, '00:30:00'),

(1, 1, 'Cours collectif ADHP 30min -13 ans', 3, 0, 12, 1, '00:30:00'),
(1, 1, 'Cours collectif PSGP 30min -13 ans', 4, 0, 12, 1, '00:30:00'),
(1, 1, 'Cours collectif ADHP 30min +13 ans', 3, 13, 99, 1, '00:30:00'),
(1, 1, 'Cours collectif PSGP 30min +13 ans', 4, 13, 99, 1, '00:30:00'),

(1, 1, 'Cours collectif ADH 1h -13 ans', 1, 0, 12, 1, '01:00:00'),
(1, 1, 'Cours collectif PSG 1h -13 ans', 2, 0, 12, 1, '01:00:00'),
(1, 1, 'Cours collectif ADH 1h +13 ans', 1, 13, 99, 1, '01:00:00'),
(1, 1, 'Cours collectif PSG 1h +13 ans', 2, 13, 99, 1, '01:00:00'),

(1, 1, 'Cours collectif ADHP 1h -13ans', 3, 0, 12, 1, '01:00:00'),
(1, 1, 'Cours collectif PSGP 1h -13ans', 4, 0, 12, 1, '01:00:00'),
(1, 1, 'Cours collectif ADHP 1h +13ans', 3, 13, 99, 1, '01:00:00'),
(1, 1, 'Cours collectif PSGP 1h +13ans', 4, 13, 99, 1, '01:00:00'),

(1, 1, 'Cours particulier ADH 30min', 1, 0, 0, 2, '00:30:00'),
(1, 1, 'Cours particulier PSG 30min', 2, 0, 0, 2, '00:30:00'),

(1, 1, 'Cours particulier ADHP 30min', 3, 0, 0, 2, '00:30:00'),
(1, 1, 'Cours particulier PSGP 30min + location installation', 4, 0, 0, 2, '00:30:00'),

(1, 1, 'Cours particulier ADH 1h', 1, 0, 0, 2, '01:00:00'),
(1, 1, 'Cours particulier PSG 1h', 2, 0, 0, 2, '01:00:00'),

(1, 1, 'Cours particulier ADHP 1h', 3, 0, 0, 2, '01:00:00'),
(1, 1, 'Cours particulier PSGP 1h + location installation', 4, 0, 0, 2, '01:00:00'),

(1, 1, 'Promenade enfant', 4, 0, 12, 3, '00:30:00'),
(1, 1, 'Promenade adulte', 4, 13, 99, 3, '01:00:00'),

(1, 1, 'Stage ADH', 1, 0, 0, 4, '03:00:00'),
(1, 1, 'Stage PSG', 2, 0, 0, 4, '03:00:00'),
(1, 1, 'Stage ADHP', 3, 0, 0, 4, '03:00:00'),
(1, 1, 'Stage PSGP', 4, 0, 0, 4, '03:00:00'),

(1, 1, 'Randonnée ADH', 1, 0, 0, 5, '08:00:00'),
(1, 1, 'Randonnée PSG', 2, 0, 0, 5, '08:00:00'),
(1, 1, 'Randonnée ADHP', 3, 0, 0, 5, '08:00:00'),
(1, 1, 'Randonnée PSGP', 4, 0, 0, 5, '08:00:00'),

(1, 2, 'Location installation sportive', 0, 0, 0,0, '00:00:00');



/* TVA */

truncate table pof_tva;

insert into pof_tva (id_tva,taux) value 
(1,20.00),(2,10.00),(3,5.00),(4,0.00);