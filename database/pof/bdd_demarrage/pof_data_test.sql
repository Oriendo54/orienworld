/**
 * Author:  julienambroise
 * Created: 31 Mai 2021
 */


/* ===== FAKE DATA POUR TESTS ===== */

/* Chevaux */

INSERT INTO pof_cheval value 
(1, 1, 'Idoine', '2010-06-23', 1,now(),now()), 
(2, 1, 'Bismark', '2013-02-08', 1,now(),now()), 
(3, 2, 'Upsa', '2015-09-30', 1,now(),now()),
(4, 2, 'Piwi', '2011-07-21', 1, now(),now()),
(5, 3, 'Arzoun', '2017-04-16', 1,now(),now());


/* Clients */

INSERT INTO pof_client value 
(1, null, 'Testing', 'Pauline', 'paulinetesting@exemple.com', '1995-10-08', 3, 6, now(), now()),
(2, null, 'Testing', 'Nicolas', 'nicolastesting@exemple.com', '1990-07-07', 1, 5, now(), now()),
(3, null, 'Testing', 'Marie', 'marietesting@exemple.com', '2000-03-29', 2, 4, now(), now()),
(4, null, 'Testing', 'Robert', 'roberttesting@exemple.com', '2006-08-24', 2, 1, now(), now());

INSERT INTO pof_client_adresse value 
(1, 1, '1 rue des exemples' , 57415, 'Enchenberg'), 
(2, 2, '2 rue des exemples' , 57415, 'Enchenberg'), 
(3, 3, '3 rue des exemples' , 57415, 'Enchenberg'),
(4, 4, '4 rue des exemples' , 57415, 'Enchenberg');

INSERT INTO pof_client_telephone value 
(1, 1, '06-06-06-06-01'), 
(2, 2, '06-06-06-06-02'), 
(3, 3, '06-06-06-06-03'), 
(4, 4, '06-06-06-06-04');
