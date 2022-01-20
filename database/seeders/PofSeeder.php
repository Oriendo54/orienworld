<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PofSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /*
        Données nécessaires pour le fonctionnement de l'application
        */
        $chevaux_types = [
            ['libelle' => 'Shetland'],
            ['libelle' => 'Poney'],
            ['libelle' => 'Double-poney'],
            ['libelle' => 'Cheval']
        ];
        DB::table('pof_cheval_type')->insert($chevaux_types);

        $chevaux_statuts = [
            ['libelle' => 'Club',
             'code' => 'C'],
            ['libelle' => 'Propriétaire',
             'code' => 'P'],
            ['libelle' => 'Demi-pension',
             'code' => 'DP']
        ];
        DB::table('pof_cheval_statut')->insert($chevaux_statuts);

        $client_cheval_statuts = [
            ['libelle' => 'Propriétaire',
             'code' => 'P',
             'ordre' => 1],
            ['libelle' => 'Demi-pension',
             'code' => 'DP',
             'ordre' => 2]
        ];
        DB::table('pof_client_cheval_statut')->insert($client_cheval_statuts);

        $client_statuts = [
            ['libelle' => 'Adhérent',
             'code' => 'ADH',
             'par_defaut' => 0],
            ['libelle' => 'Passager',
             'code' => 'PSG',
             'par_defaut' => 1],
            ['libelle' => 'Adhérent-propriétaire',
             'code' => 'ADHP',
             'par_defaut' => 0],
            ['libelle' => 'Passager-propriétaire',
             'code' => 'PSGP',
             'par_defaut' => 0]
        ];
        DB::table('pof_client_statut')->insert($client_statuts);

        $client_niveaux = [
            ['libelle' => 'Débutant',
             'ordre' => 1],
            ['libelle' => 'G1',
             'ordre' => 2],
            ['libelle' => 'G2',
             'ordre' => 3],
            ['libelle' => 'G3',
             'ordre' => 4],
            ['libelle' => 'G4',
             'ordre' => 5],
            ['libelle' => 'G5',
             'ordre' => 6],
            ['libelle' => 'G6',
             'ordre' => 7],
            ['libelle' => 'G7',
             'ordre' => 8]
        ];
        DB::table('pof_client_niveau')->insert($client_niveaux);

        $cours_client_statuts = [
            ['libelle' => 'Inscrit',
             'code' => 'INS'],
            ['libelle' => 'Valide',
             'code' => 'VAL']
        ];
        DB::table('pof_client_statut')->insert($cours_client_statuts);

        $cours_types = [
            ['libelle' => 'Cours collectif',
             'couleur_planning' => 'warning',
             'libelle_planning' => 'CC'],
            
            ['libelle' => 'Cours particulier',
             'couleur_planning' => 'primary',
             'libelle_planning' => 'CP'],
            
            ['libelle' => 'Promenade',
             'couleur_planning' => 'danger',
             'libelle_planning' => 'Promenade'],

            ['libelle' => 'Stage',
             'couleur_planning' => 'success',
             'libelle_planning' => 'Stage'],

            ['libelle' => 'Randonnée',
             'couleur_planning' => 'info',
             'libelle_planning' => 'Rando']
        ];
        DB::table('pof_cours_type')->insert($cours_types);

        $cours_emplacements = [
            ['libelle' => 'Grand manège'],
            ['libelle' => 'Petit manège'],
            ['libelle' => 'Carrière'],
            ['libelle' => 'Promenade'] 
        ];
        DB::table('pof_cours_emplacement')->insert($cours_emplacements);

        $facture_statuts = [
            ['libelle' => 'A régler'],
            ['libelle' => 'Payée']
        ];
        DB::table('pof_facture_statut')->insert($facture_statuts);

        $prestation_types = [
            ['libelle' => 'Carte cours',
             'code' => 'CAR'],
            ['libelle' => 'Pension',
             'code' => 'PEN'],
            ['libelle' => 'Travail chevaux',
             'code' => 'TRA'],
            ['libelle' => 'Concours',
             'code' => 'CON'],
            ['libelle' => 'Cotisation',
             'code' => 'COT'],
            ['libelle' => 'Licence',
             'code' => 'LIC'],
            ['libelle' => 'Bon d\'achat',
             'code' => 'BON'],
            ['libelle' => 'Fourniture',
             'code' => 'FNT']
        ];
        DB::table('pof_prestation_type')->insert($prestation_types);

        $prestations = [
            ['id_prestation_type' => 1,
             'libelle' => 'Cours collectif ADH 30min -13ans',
             'id_client_statut' => 1,
             'age_min_client' => 0,
             'age_max_client' => 12,
             'id_cours_type' => 1,
             'duree' => '00:30:00'],
            
             ['id_prestation_type' => 1,
             'libelle' => 'Cours collectif PSG 30min -13ans',
             'id_client_statut' => 2,
             'age_min_client' => 0,
             'age_max_client' => 12,
             'id_cours_type' => 1,
             'duree' => '00:30:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Cours collectif ADH 30min +13ans',
             'id_client_statut' => 1,
             'age_min_client' => 13,
             'age_max_client' => 99,
             'id_cours_type' => 1,
             'duree' => '00:30:00'],
            
             ['id_prestation_type' => 1,
             'libelle' => 'Cours collectif PSG 30min +13ans',
             'id_client_statut' => 2,
             'age_min_client' => 13,
             'age_max_client' => 99,
             'id_cours_type' => 1,
             'duree' => '00:30:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Cours collectif ADH 1h -13ans',
             'id_client_statut' => 1,
             'age_min_client' => 0,
             'age_max_client' => 12,
             'id_cours_type' => 1,
             'duree' => '01:00:00'],
            
             ['id_prestation_type' => 1,
             'libelle' => 'Cours collectif PSG 1h -13ans',
             'id_client_statut' => 2,
             'age_min_client' => 0,
             'age_max_client' => 12,
             'id_cours_type' => 1,
             'duree' => '01:00:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Cours collectif ADH 1h +13ans',
             'id_client_statut' => 1,
             'age_min_client' => 13,
             'age_max_client' => 99,
             'id_cours_type' => 1,
             'duree' => '01:00:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Cours collectif PSG 1h +13ans',
             'id_client_statut' => 2,
             'age_min_client' => 13,
             'age_max_client' => 99,
             'id_cours_type' => 1,
             'duree' => '01:00:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Cours collectif ADHP 1h',
             'id_client_statut' => 3,
             'age_min_client' => 0,
             'age_max_client' => 99,
             'id_cours_type' => 1,
             'duree' => '01:00:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Cours collectif PSGP 1h',
             'id_client_statut' => 4,
             'age_min_client' => 0,
             'age_max_client' => 99,
             'id_cours_type' => 1,
             'duree' => '01:00:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Cours particulier ADH 30min +13ans',
             'id_client_statut' => 1,
             'age_min_client' => 13,
             'age_max_client' => 99,
             'id_cours_type' => 2,
             'duree' => '00:30:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Cours particulier PSG 30min +13ans',
             'id_client_statut' => 2,
             'age_min_client' => 13,
             'age_max_client' => 99,
             'id_cours_type' => 2,
             'duree' => '00:30:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Cours particulier ADH 1h',
             'id_client_statut' => 1,
             'age_min_client' => 0,
             'age_max_client' => 99,
             'id_cours_type' => 2,
             'duree' => '01:00:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Cours particulier PSG 1h',
             'id_client_statut' => 2,
             'age_min_client' => 0,
             'age_max_client' => 99,
             'id_cours_type' => 2,
             'duree' => '01:00:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Promenade enfant',
             'id_client_statut' => 4,
             'age_min_client' => 0,
             'age_max_client' => 12,
             'id_cours_type' => 3,
             'duree' => '00:30:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Promenade adulte',
             'id_client_statut' => 4,
             'age_min_client' => 13,
             'age_max_client' => 99,
             'id_cours_type' => 3,
             'duree' => '01:00:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Stage ADH',
             'id_client_statut' => 1,
             'age_min_client' => 0,
             'age_max_client' => 99,
             'id_cours_type' => 4,
             'duree' => '03:00:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Stage PSG',
             'id_client_statut' => 2,
             'age_min_client' => 0,
             'age_max_client' => 99,
             'id_cours_type' => 4,
             'duree' => '03:00:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Randonnée ADH',
             'id_client_statut' => 1,
             'age_min_client' => 0,
             'age_max_client' => 99,
             'id_cours_type' => 5,
             'duree' => '08:00:00'],

             ['id_prestation_type' => 1,
             'libelle' => 'Randonnée PSG',
             'id_client_statut' => 2,
             'age_min_client' => 0,
             'age_max_client' => 99,
             'id_cours_type' => 5,
             'duree' => '08:00:00'],

            ['id_prestation_type' => 2,
             'libelle' => 'Location installations sportives',
             'id_client_statut' => 0,
             'age_min_client' => 0,
             'age_max_client' => 99,
             'id_cours_type' => 0,
             'duree' => '00:00:00']
        ];
        DB::table('pof_prestation')->insert($prestations);

        $tva = [
            ['taux' => 20],
            ['taux' => 10],
            ['taux' => 5],
            ['taux' => 0]
        ];
        DB::table('pof_tva')->insert($tva);

        $moyens_paiement = [
            ['libelle' => 'Carte bancaire',
             'actif' => 1],
            ['libelle' => 'Especes',
             'actif' => 1],
            ['libelle' => 'Cheque',
             'actif' => 1],
            ['libelle' => 'Virement',
             'actif' => 0],
            ['libelle' => 'Cheque vacances',
             'actif' => 0]
        ];
        DB::table('pof_moyen_paiement')->insert($moyens_paiement);

        $roles = [
            ['libelle' => 'admin'],
            ['libelle' => 'moniteur'],
            ['libelle' => 'client']
        ];
        DB::table('pof_roles')->insert($roles);

        /*
        Données de base pour tester l'application
        */

        $moniteurs = [
            ['nom' => 'Testing',
             'prenom' => 'Moniteur1',
             'couleur' => '#f665e4'],

            ['nom' => 'Testing',
             'prenom' => 'Moniteur2',
             'couleur' => '#80df00'],

            ['nom' => 'Testing',
             'prenom' => 'Moniteur3',
             'couleur' => '#004adf']
        ];
        DB::table('pof_moniteurs')->insert($moniteurs);

        $chevaux = [
            ['id_cheval_type' => 1,
             'nom' => 'Rosy',
             'date_naissance' => '2010-06-23',
             'id_cheval_statut' => 1,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()],

             ['id_cheval_type' => 1,
             'nom' => 'Bismark',
             'date_naissance' => '2013-02-08',
             'id_cheval_statut' => 1,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()],

             ['id_cheval_type' => 2,
             'nom' => 'Upsa',
             'date_naissance' => '2015-09-30',
             'id_cheval_statut' => 1,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()],

             ['id_cheval_type' => 2,
             'nom' => 'Piwi',
             'date_naissance' => '2011-07-21',
             'id_cheval_statut' => 3,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()],

             ['id_cheval_type' => 3,
             'nom' => 'Arzoun',
             'date_naissance' => '2017-04-16',
             'id_cheval_statut' => 2,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()],

             ['id_cheval_type' => 4,
             'nom' => 'Levito',
             'date_naissance' => '2015-10-21',
             'id_cheval_statut' => 1,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()]
        ];
        DB::table('pof_cheval')->insert($chevaux);

        $clients = [
            ['id_client_parent' => null,
             'id_user' => null,
             'nom' => 'Testing',
             'prenom' => 'Pauline',
             'email' => 'paulinetesting@exemple.com',
             'date_naissance' => '1995-10-08',
             'id_client_statut' => 3,
             'id_client_niveau' => 6,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()],

             ['id_client_parent' => null,
             'id_user' => null,
             'nom' => 'Testing',
             'prenom' => 'Nicolas',
             'email' => 'nicolastesting@exemple.com',
             'date_naissance' => '1990-07-07',
             'id_client_statut' => 1,
             'id_client_niveau' => 5,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()],

             ['id_client_parent' => null,
             'id_user' => null,
             'nom' => 'Testing',
             'prenom' => 'Marie',
             'email' => 'marietesting@exemple.com',
             'date_naissance' => '2000-03-29',
             'id_client_statut' => 2,
             'id_client_niveau' => 4,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()],

             ['id_client_parent' => null,
             'id_user' => null,
             'nom' => 'Testing',
             'prenom' => 'Eric',
             'email' => 'erictesting@exemple.com',
             'date_naissance' => '2006-08-24',
             'id_client_statut' => 2,
             'id_client_niveau' => 1,
             'created_at' => Carbon::now(),
             'updated_at' => Carbon::now()]
        ];
        DB::table('pof_client')->insert($clients);

        $chevaux_proprietaires = [
            ['id_client' => 3,
            'id_cheval' => 5,
            'id_client_cheval_statut' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()],

            ['id_client' => 3,
            'id_cheval' => 4,
            'id_client_cheval_statut' => 2,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]
        ];
        DB::table('pof_client_cheval')->insert($chevaux_proprietaires);

        $adresses = [
            ['id_client' => 1,
             'rue' => '1 rue des exemples',
             'code_postal' => '57415',
             'ville' => 'Enchenberg'],

             ['id_client' => 2,
             'rue' => '2 rue des exemples',
             'code_postal' => '57415',
             'ville' => 'Enchenberg'],

             ['id_client' => 3,
             'rue' => '3 rue des exemples',
             'code_postal' => '57415',
             'ville' => 'Enchenberg'],

             ['id_client' => 4,
             'rue' => '4 rue des exemples',
             'code_postal' => '57415',
             'ville' => 'Enchenberg']
        ];
        DB::table('pof_client_adresse')->insert($adresses);

        $telephones = [
            ['id_client' => 1, 'telephone' => '06-06-06-06-01'],
            ['id_client' => 2, 'telephone' => '06-06-06-06-02'],
            ['id_client' => 3, 'telephone' => '06-06-06-06-03'],
            ['id_client' => 4, 'telephone' => '06-06-06-06-04']
        ];
        DB::table('pof_client_telephone')->insert($telephones);

        $charges = [
            ['periodicite' => 'unitaire',
            'libelle' => 'dentiste',
            'id_cheval_type' => null,
            'date_expiration' => '2099-12-31 00:00:00',
            'montant' => 90],

            ['periodicite' => 'unitaire',
            'libelle' => 'visite vétérinaire',
            'id_cheval_type' => null,
            'date_expiration' => '2099-12-31 00:00:00',
            'montant' => 45],

            ['periodicite' => 'unitaire',
            'libelle' => 'ferrage',
            'id_cheval_type' => null,
            'date_expiration' => '2099-12-31 00:00:00',
            'montant' => 75],

            ['periodicite' => 'unitaire',
            'libelle' => 'vermifuge',
            'id_cheval_type' => null,
            'date_expiration' => '2099-12-31 00:00:00',
            'montant' => 20],

            ['periodicite' => 'mensuel',
            'libelle' => 'nourriture poneys',
            'id_cheval_type' => 2,
            'date_expiration' => '2099-12-31 00:00:00',
            'montant' => 80],

            ['periodicite' => 'mensuel',
            'libelle' => 'nourriture double-poneys',
            'id_cheval_type' => 3,
            'date_expiration' => '2099-12-31 00:00:00',
            'montant' => 120],

            ['periodicite' => 'mensuel',
            'libelle' => 'nourriture chevaux',
            'id_cheval_type' => 4,
            'date_expiration' => '2099-12-31 00:00:00',
            'montant' => 150],
        ];
        DB::table('pof_charge')->insert($charges);

        $tarifs = [
            ['libelle' => 'CC ADH 30min enfant',
            'id_prestation' => 1,
            'quantite' => 1,
            'prix_ht' => 16,
            'prix_ttc' => 20,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],

            ['libelle' => 'CC ADH 30min adulte',
            'id_prestation' => 3,
            'quantite' => 1,
            'prix_ht' => 32,
            'prix_ttc' => 40,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],

            ['libelle' => 'CC ADH 1h enfant',
            'id_prestation' => 5,
            'quantite' => 1,
            'prix_ht' => 24,
            'prix_ttc' => 30,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],

            ['libelle' => 'CC ADH 1h adulte',
            'id_prestation' => 7,
            'quantite' => 1,
            'prix_ht' => 40,
            'prix_ttc' => 50,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],

            ['libelle' => 'CC PSG 30min enfant',
            'id_prestation' => 2,
            'quantite' => 1,
            'prix_ht' => 24,
            'prix_ttc' => 30,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],

            ['libelle' => 'CC PSG 30min adulte',
            'id_prestation' => 4,
            'quantite' => 1,
            'prix_ht' => 40,
            'prix_ttc' => 50,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],

            ['libelle' => 'CC PSG 1h enfant',
            'id_prestation' => 6,
            'quantite' => 1,
            'prix_ht' => 32,
            'prix_ttc' => 40,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],

            ['libelle' => 'CC PSG 1h adulte',
            'id_prestation' => 8,
            'quantite' => 1,
            'prix_ht' => 48,
            'prix_ttc' => 60,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],

            ['libelle' => 'CC ADHP 1h',
            'id_prestation' => 9,
            'quantite' => 1,
            'prix_ht' => 36,
            'prix_ttc' => 45,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],

            ['libelle' => 'CC PSGP 1h',
            'id_prestation' => 10,
            'quantite' => 1,
            'prix_ht' => 44,
            'prix_ttc' => 55,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],

            ['libelle' => 'CP ADH 30min adulte',
            'id_prestation' => 11,
            'quantite' => 1,
            'prix_ht' => 48,
            'prix_ttc' => 60,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],

            ['libelle' => 'CP ADH 1h',
            'id_prestation' => 13,
            'quantite' => 1,
            'prix_ht' => 60,
            'prix_ttc' => 75,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],

            ['libelle' => 'CP PSG 30min adulte',
            'id_prestation' => 12,
            'quantite' => 1,
            'prix_ht' => 56,
            'prix_ttc' => 70,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],

            ['libelle' => 'CP PSG 1h',
            'id_prestation' => 14,
            'quantite' => 1,
            'prix_ht' => 68,
            'prix_ttc' => 85,
            'pourcentage' => null,
            'actif' => 1,
            'date_debut' => Carbon::now(),
            'date_fin' => Carbon::now()->addYear()],
        ];
        DB::table('pof_tarif')->insert($tarifs);

        /*
        ATTRIBUTION DU ROLE ADMINISTRATEUR AU PREMIER UTILISATEUR ENREGISTRE
        */
        DB::table('pof_user_roles')->insert(['id_user' => 1, 'id_role' => 1]);
    }
}
