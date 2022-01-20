<?php

use Carbon\Carbon;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PofMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pof_carte', function(Blueprint $table) {
            $table->id('id_carte');
            $table->foreignId('id_client');
            $table->foreignId('id_prestation');
            $table->decimal('solde', 20, 6)->default(0);
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());
        });

        Schema::create('pof_carte_facture', function(Blueprint $table) {
            $table->id('id_carte_facture');
            $table->foreignId('id_carte');
            $table->foreignId('id_facture');
            $table->decimal('solde', 20, 6)->default(0);
        });

        Schema::create('pof_cheval', function(Blueprint $table) {
            $table->id('id_cheval');
            $table->foreignId('id_cheval_type');
            $table->string('nom', 255);
            $table->date('date_naissance')->nullable()->default(null);
            $table->foreignId('id_cheval_statut')->default(1);
            $table->integer('actif')->default(1);
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());
        });

        Schema::create('pof_cheval_type', function(Blueprint $table) {
            $table->id('id_cheval_type');
            $table->string('libelle', 255);
        });

        Schema::create('pof_cheval_statut', function(Blueprint $table) {
            $table->id('id_cheval_statut');
            $table->string('libelle', 255);
            $table->string('code', 4);
        });

        Schema::create('pof_client', function(Blueprint $table) {
            $table->id('id_client');
            $table->integer('id_client_parent')->nullable();
            $table->foreignId('id_user')->nullable()->default(null);
            $table->string('nom', 255);
            $table->string('prenom', 255);
            $table->string('email', 255);
            $table->date('date_naissance');
            $table->foreignId('id_client_statut');
            $table->foreignId('id_client_niveau');
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());
        });

        Schema::create('pof_client_adresse', function(Blueprint $table) {
            $table->id('id_client_adresse');
            $table->foreignId('id_client');
            $table->string('rue', 255);
            $table->string('code_postal', 10);
            $table->string('ville', 255);
        });

        Schema::create('pof_client_telephone', function(Blueprint $table) {
            $table->id('id_client_telephone');
            $table->foreignId('id_client');
            $table->string('telephone', 255);
        });

        Schema::create('pof_client_statut', function(Blueprint $table) {
            $table->id('id_client_statut');
            $table->string('libelle', 255);
            $table->string('code', 4)->nullable();
            $table->integer('par_defaut')->default(0)->nullable();
        });

        Schema::create('pof_client_cheval_statut', function(Blueprint $table) {
            $table->id('id_client_cheval_statut');
            $table->string('libelle', 255);
            $table->string('code', 4)->nullable();
            $table->integer('ordre')->nullable();
        });

        Schema::create('pof_client_cheval', function(Blueprint $table) {
            $table->id('id_client_cheval');
            $table->foreignId('id_client');
            $table->foreignId('id_cheval');
            $table->foreignId('id_client_cheval_statut');
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());
        });

        Schema::create('pof_cours', function(Blueprint $table) {
            $table->id('id_cours');
            $table->foreignId('id_cours_type');
            $table->foreignId('id_moniteur');
            $table->foreignId('id_cours_emplacement');
            $table->date('date_cours');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->time('duree');
            $table->string('libelle')->nullable();
            $table->integer('nb_cavalier_max')->nullable();
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());
        });

        Schema::create('pof_cours_client', function(Blueprint $table) {
            $table->id('id_cours_client');
            $table->foreignId('id_cours');
            $table->foreignId('id_client');
            $table->foreignId('id_cheval')->nullable();
            $table->foreignId('id_carte')->nullable()->default(null);
            $table->foreignId('id_cours_client_statut');
        });

        Schema::create('pof_cours_client_statut', function(Blueprint $table) {
            $table->id('id_cours_client_statut');
            $table->string('libelle', 255)->nullable();
            $table->string('code', 4)->nullable();
        });

        Schema::create('pof_cours_client_niveau', function(Blueprint $table) {
            $table->id('id_cours_client_niveau');
            $table->foreignId('id_client_niveau');
            $table->foreignId('id_cours');
        });

        Schema::create('pof_cours_type', function(Blueprint $table) {
            $table->id('id_cours_type');
            $table->string('libelle', 255);
            $table->string('couleur_planning', 255);
            $table->string('libelle_planning', 255);
        });

        Schema::create('pof_facture', function(Blueprint $table) {
            $table->id('id_facture');
            $table->foreignId('id_client');
            $table->foreignId('id_abonnement')->nullable()->default(null);
            $table->foreignId('id_facture_statut');
            $table->decimal('total_ht', 20, 6)->default(0);
            $table->decimal('total_ttc', 20, 6)->default(0);
            $table->decimal('total_bonachat_deduis', 20, 6)->default(0);
            $table->timestamp('date_facture')->default(Carbon::now());
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());
            $table->text('libelle')->nullable();
        });

        Schema::create('pof_facture_statut', function(Blueprint $table) {
            $table->id('id_facture_statut');
            $table->string('libelle', 255);
        });

        Schema::create('pof_facture_detail', function(Blueprint $table) {
            $table->id('id_facture_detail');
            $table->integer('id_facture_detail_pere')->nullable()->default(null);
            $table->foreignId('id_facture');
            $table->foreignId('id_prestation');
            $table->foreignId('id_prestation_groupe')->nullable()->default(null);
            $table->foreignId('id_tarif');
            $table->foreignId('id_carte')->nullable()->default(null);
            $table->integer('quantite')->default(1);
            $table->decimal('total_ht', 20, 6)->default(0);
            $table->decimal('total_ttc', 20, 6)->default(0);
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());
            $table->text('libelle')->nullable();
        });

        Schema::create('pof_client_niveau', function(Blueprint $table) {
            $table->id('id_client_niveau');
            $table->string('libelle', 255);
            $table->integer('ordre');
        });

        Schema::create('pof_prestation', function(Blueprint $table) {
            $table->id('id_prestation');
            $table->foreignId('id_prestation_type');
            $table->foreignId('id_tva')->nullable()->default(1);
            $table->string('libelle', 255);
            $table->foreignId('id_client_statut');
            $table->integer('age_min_client')->nullable();
            $table->integer('age_max_client')->nullable();
            $table->foreignId('id_cours_type');
            $table->time('duree');
        });

        Schema::create('pof_prestation_groupe', function(Blueprint $table) {
            $table->id('id_prestation_groupe');
            $table->string('libelle', 255);
        });

        Schema::create('pof_prestation_groupe_lien', function(Blueprint $table) {
            $table->id('id_prestation_groupe_lien');
            $table->foreignId('id_prestation_groupe');
            $table->foreignId('id_prestation');
            $table->integer('id_tarif_defaut');
        });

        Schema::create('pof_prestation_type', function(Blueprint $table) {
            $table->id('id_prestation_type');
            $table->string('libelle', 255);
            $table->string('code', 4)->nullable();
        });

        Schema::create('pof_moniteurs', function(Blueprint $table) {
            $table->id('id_moniteur');
            $table->foreignId('id_user')->nullable()->default(null);
            $table->string('nom', 255);
            $table->string('prenom', 255);
            $table->string('email', 255)->nullable()->default(null);
            $table->string('couleur', 10)->default('#000000');
        });

        Schema::create('pof_cours_emplacement', function(Blueprint $table) {
            $table->id('id_cours_emplacement');
            $table->string('libelle', 255);
        });

        Schema::create('pof_cours_type_prestation', function(Blueprint $table) {
            $table->id('id_cours_type_prestation');
            $table->foreignId('id_cours_type');
            $table->foreignId('id_prestation');
        });

        Schema::create('pof_tarif', function(Blueprint $table) {
            $table->id('id_tarif');
            $table->string('libelle', 255);
            $table->foreignId('id_prestation');
            $table->integer('quantite')->default(1);
            $table->decimal('prix_ht', 20, 6)->nullable()->default(null);
            $table->decimal('prix_ttc', 20, 6)->nullable()->default(null);
            $table->decimal('pourcentage', 20, 6)->nullable()->default(null);
            $table->integer('actif');
            $table->date('date_debut')->nullable()->default(null);
            $table->date('date_fin')->nullable()->default('2099-01-01');
        });

        Schema::create('pof_prestation_association', function(Blueprint $table) {
            $table->id('id_prestation_association');
            $table->string('libelle', 255);
        });

        Schema::create('pof_prestation_association_lien', function(Blueprint $table) {
            $table->id('id_prestation_association_lien');
            $table->foreignId('id_prestation_association');
            $table->foreignId('id_prestation');
            $table->integer('prestation_principale')->nullable()->default(null);
        });

        Schema::create('pof_tva', function(Blueprint $table) {
            $table->id('id_tva');
            $table->decimal('taux', 20, 6);
        });

        Schema::create('pof_log', function(Blueprint $table) {
            $table->id('id_log');
            $table->timestamp('created_at')->default(Carbon::now());
            $table->text('message');
            $table->string('category', 255)->nullable();
            $table->string('couleur', 255)->nullable()->default(null);
        });

        Schema::create('pof_abonnement', function(Blueprint $table) {
            $table->id('id_abonnement');
            $table->datetime('date_debut')->default(Carbon::now());
            $table->datetime('date_expiration')->default('2099-12-31');
            $table->decimal('total_ttc', 20, 6);
            $table->string('periodicite', 255)->default('annuel');
            $table->string('libelle', 255)->nullable();
        });

        Schema::create('pof_abonnement_client', function(Blueprint $table) {
            $table->id('id_abonnement_client');
            $table->foreignId('id_abonnement');
            $table->foreignId('id_client');
            $table->datetime('echeance');
        });

        Schema::create('pof_abonnement_prestation', function(Blueprint $table) {
            $table->id('id_abonnement_prestation');
            $table->foreignId('id_abonnement');
            $table->foreignId('id_prestation');
            $table->foreignId('id_tarif');
        });

        Schema::create('pof_bonachat', function(Blueprint $table) {
            $table->id('id_bonachat');
            $table->foreignId('id_client');
            $table->decimal('minimum', 20, 6)->default(0);
            $table->decimal('valeur', 20, 6)->default(0);
            $table->decimal('restant', 20, 6)->default(0);
            $table->datetime('date_expiration')->default('2099-12-31 00:00:00');
            $table->integer('actif')->default(1);
            $table->timestamp('created_at')->default(Carbon::now());
            $table->timestamp('updated_at')->default(Carbon::now());
        });

        Schema::create('pof_facture_bonachat', function(Blueprint $table) {
            $table->id('id_facture_bonachat');
            $table->foreignId('id_bonachat');
            $table->foreignId('id_facture');
            $table->decimal('montant', 20, 6)->default(0);
        });

        Schema::create('pof_moyen_paiement', function(Blueprint $table) {
            $table->id('id_moyen_paiement');
            $table->string('libelle', 255);
            $table->integer('actif')->default(1);
        });

        Schema::create('pof_facture_moyen_paiement', function(Blueprint $table) {
            $table->id('id_facture_moyen_paiement');
            $table->foreignId('id_moyen_paiement');
            $table->foreignId('id_facture');
            $table->decimal('montant', 20, 6);
        });

        Schema::create('pof_roles', function(Blueprint $table) {
            $table->id('id_role');
            $table->string('libelle', 255);
        });

        Schema::create('pof_user_roles', function(Blueprint $table) {
            $table->id('id_user_role');
            $table->foreignId('id_user');
            $table->foreignId('id_role');
        });

        Schema::create('pof_charge', function(Blueprint $table) {
            $table->id('id_charge');
            $table->string('periodicite', 255)->default('mensuel');
            $table->string('libelle', 255);
            $table->datetime('date_expiration')->default('2099-12-31 00:00:00');
            $table->foreignId('id_cheval_type')->nullable()->default(null);
            $table->decimal('montant', 20, 6)->nullable()->default(null);
        });

        Schema::create('pof_cheval_charge', function(Blueprint $table) {
            $table->id('id_cheval_charge');
            $table->foreignId('id_cheval');
            $table->foreignId('id_charge');
            $table->datetime('date_debut');
            $table->datetime('date_fin');
            $table->datetime('date_facturation')->default(Carbon::now());
            $table->string('precision', 255)->nullable()->default(null);
            $table->decimal('montant', 20, 6);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
