<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// APPEL DES ROUTES DE FORTIFY POUR SECURISER LA CONNEXION A L'APPLICATION
require_once __DIR__ . '/fortify.php';

/* === LOGIN ET PERMISSIONS === */
Route::post('logout', 'Controller@logout')->name('logout');

/* ==== HOME, ABOUT, CONTACT ==== */

Route::get('/', 'HomeController@index')->name('index');
Route::get('about', 'HomeController@about')->name('about');
Route::get('contact', 'ContactController@contact')->name('contact');
Route::post('contactMe', 'ContactController@contactMe')->name('contactMe');

/* ==== PORTFOLIO ==== */

Route::get('portfolio', 'PortfolioController@portfolio')->name('portfolio');
Route::get('tictactoe', 'PortfolioController@tictactoe')->name('tictactoe');
Route::get('memory', 'PortfolioController@memory')->name('memory');
Route::get('pong', 'PortfolioController@pong')->name('pong');
Route::get('snake', 'PortfolioController@snake')->name('snake');
Route::get('skigame', 'PortfolioController@skigame')->name('skigame');
Route::get('cik', 'PortfolioController@cik')->name('cik');
Route::get('repertoire', 'PortfolioController@repertoire')->name('repertoire');
Route::get('agenda', 'PortfolioController@agenda')->name('agenda');
Route::get('todolist', 'PortfolioController@todolist')->name('todolist');
Route::get('shopping', 'PortfolioController@shoppingListe')->name('shopping');

/* ==== PONY ON FIRE ==== */

// MIDDLEWARE FORCANT LA CONNEXION DE L'UTILISATEUR POUR ACCEDER A L'APPLICATION
Route::middleware(['auth'])->group(function () {
    
    // Utilisation de la méthode namespace pour indiquer dans quel sous-dossier se trouvent les controllers
    Route::group(['namespace' => 'Pof'], function() {

        Route::get('pof', 'PofController@index')->name('pof');
        Route::get('script', 'PofController@script')->name('script');
        
        /* === TEST === */
        Route::get('testpdf', 'PDFController@testpdf')->name('testpdf');

        /* === AFFICHAGE DES PARTIES DE INDEX === */
        Route::get('index2', 'IndexController@index2')->name('index2');

        // MIDDLEWARE EMPECHANT LES CLIENTS DE SE CONNECTER AU BACK DE L'APPLICATION
        Route::middleware(['back-access'])->group(function() {

            /* === AFFICHAGE POF === */
            Route::get('getPlanning', 'PofController@getPlanning')->name('getPlanning');
            Route::get('selectionDatePlanning', 'PofController@selectionDatePlanning')->name('selectionDatePlanning');
            Route::get('changeDatePlanning', 'PofController@changeDatePlanning')->name('changeDatePlanning');
            Route::get('afficherCoursDetails', 'PofController@afficherCoursDetails')->name('afficherCoursDetails');
            Route::get('afficherClientDetails', 'PofController@afficherClientDetails')->name('afficherClientDetails');
            Route::get('clearAffichage', 'PofController@clearAffichage')->name('clearAffichage');
            Route::get('rechercherClient', 'PofController@rechercherClient')->name('rechercherClient');

            /* === GESTION DES COURS POF === */
            Route::get('coursAjouterModal', 'PofController@coursAjouterModal')->name('coursAjouterModal');
            Route::get('coursAjouter', 'PofController@coursAjouter')->name('coursAjouter');
            Route::get('ajoutCavalierModal', 'PofController@ajoutCavalierModal')->name('ajoutCavalierModal');
            Route::get('rechercherCavalier', 'PofController@rechercherCavalier')->name('rechercherCavalier');
            Route::get('ajoutCavalier', 'PofController@ajoutCavalier')->name('ajoutCavalier');
            Route::get('retirerCavalier', 'PofController@retirerCavalier')->name('retirerCavalier');
            Route::get('choixMontureModal', 'PofController@choixMontureModal')->name('choixMontureModal');
            Route::get('choixMonture', 'PofController@choixMonture')->name('choixMonture');
            Route::get('validerCours', 'PofController@validerCours')->name('validerCours');
            Route::get('invaliderCours', 'PofController@invaliderCours')->name('invaliderCours');
            Route::get('coursSuppressionModal', 'PofController@coursSuppressionModal')->name('coursSuppressionModal');
            Route::get('coursSuppression', 'PofController@coursSuppression')->name('coursSuppression');
            Route::get('clientCours', 'PofController@clientCours')->name('clientCours');
            Route::get('coursReinscrireModal', 'PofController@coursReinscrireModal')->name('coursReinscrireModal');
            Route::get('coursReinscrire', 'PofController@coursReinscrire')->name('coursReinscrire');

            /* === CLIENTS === */
            Route::get('client/{id_client?}', 'ClientController@client')->name('client');
            Route::get('clientMAJ', 'ClientController@clientMAJ')->name('clientMAJ');
            Route::get('clientAjoutModal', 'ClientController@clientAjoutModal')->name('clientAjoutModal');
            Route::get('clientAjout', 'ClientController@clientAjout')->name('clientAjout');
            Route::get('clientChangerRoleModal', 'ClientController@clientChangerRoleModal')->name('clientChangerRoleModal');
            Route::get('clientEnvoyerMailInscriptionModal', 'ClientController@clientEnvoyerMailInscriptionModal')->name('clientEnvoyerMailInscriptionModal');
            Route::get('clientEnvoyerMailInscription', 'ClientController@clientEnvoyerMailInscription')->name('clientEnvoyerMailInscription');
            Route::get('clientCheval', 'ClientController@clientCheval')->name('clientCheval');
            Route::get('clientChevalAjoutModal', 'ClientController@clientChevalAjoutModal')->name('clientChevalAjoutModal');
            Route::get('clientChevalAjout', 'ClientController@clientChevalAjout')->name('clientChevalAjout');
            Route::get('clientChevalSupprModal', 'ClientController@clientChevalSupprModal')->name('clientChevalSupprModal');
            Route::get('clientChevalSuppr', 'ClientController@clientChevalSuppr')->name('clientChevalSuppr');
            Route::get('clientTelephoneAjoutModal', 'ClientController@clientTelephoneAjoutModal')->name('clientTelephoneAjoutModal');
            Route::get('clientTelephoneAjout', 'ClientController@clientTelephoneAjout')->name('clientTelephoneAjout');
            Route::get('updateClientTelephone', 'ClientController@updateClientTelephone')->name('updateClientTelephone');
            Route::get('clientTelephoneSupprModal', 'ClientController@clientTelephoneSupprModal')->name('clientTelephoneSupprModal');
            Route::get('clientTelephoneSupprimer', 'ClientController@clientTelephoneSupprimer')->name('clientTelephoneSupprimer');
            Route::get('clientAdresseAjoutModal', 'ClientController@clientAdresseAjoutModal')->name('clientAdresseAjoutModal');
            Route::get('clientAdresseAjout', 'ClientController@clientAdresseAjout')->name('clientAdresseAjout');
            Route::get('updateClientAdresse', 'ClientController@updateClientAdresse')->name('updateClientAdresse');
            Route::get('clientAdresseSupprModal', 'ClientController@clientAdresseSupprModal')->name('clientAdresseSupprModal');
            Route::get('clientAdresseSupprimer', 'ClientController@clientAdresseSupprimer')->name('clientAdresseSupprimer');
            Route::get('clientBonachats', 'ClientController@clientBonachats')->name('clientBonachats');
            Route::get('clientBonachatsEpuises', 'ClientController@clientBonachatsEpuises')->name('clientBonachatsEpuises');
            Route::get('clientBonachatFactures', 'ClientController@clientBonachatFactures')->name('clientBonachatFactures');
            Route::get('clientBonachatCreerModal', 'ClientController@clientBonachatCreerModal')->name('clientBonachatCreerModal');
            Route::get('clientBonachatCreer', 'ClientController@clientBonachatCreer')->name('clientBonachatCreer');
            Route::get('clientBonachatMaj', 'ClientController@clientBonachatMaj')->name('clientBonachatMaj');
            Route::get('clientBonachatSupprModal', 'ClientController@clientBonachatSupprModal')->name('clientBonachatSupprModal');
            Route::get('clientBonachatSupprimer', 'ClientController@clientBonachatSupprimer')->name('clientBonachatSupprimer');

            /* === ECURIE === */
            Route::get('ecurie', 'EcurieController@ecurie')->name('ecurie');
            Route::get('ecurieChevalAjoutModal', 'EcurieController@ecurieChevalAjoutModal')->name('ecurieChevalAjoutModal');
            Route::get('ecurieChevalAjout', 'EcurieController@ecurieChevalAjout')->name('ecurieChevalAjout');
            Route::get('ecurieChevalAfficherCharges', 'EcurieController@ecurieChevalAfficherCharges')->name('ecurieChevalAfficherCharges');
            Route::get('ecurieClientChevalStatutAjoutModal', 'EcurieController@ecurieClientChevalStatutAjoutModal')->name('ecurieClientChevalStatutAjoutModal');
            Route::get('ecurieClientChevalStatutAjout', 'EcurieController@ecurieClientChevalStatutAjout')->name('ecurieClientChevalStatutAjout');
            Route::get('ecurieClientChevalStatutClientStatut', 'EcurieController@ecurieClientChevalStatutClientStatut')->name('ecurieClientChevalStatutClientStatut');
            Route::get('ecurieClientChevalStatutClientStatutAjoutModal', 'EcurieController@ecurieClientChevalStatutClientStatutAjoutModal')
                    ->name('ecurieClientChevalStatutClientStatutAjoutModal');
            Route::get('ecurieClientChevalStatutClientStatutAjout', 'EcurieController@ecurieClientChevalStatutClientStatutAjout')
                    ->name('ecurieClientChevalStatutClientStatutAjout');
            Route::get('ecurieChargeAttribuerChevauxModal', 'EcurieController@ecurieChargeAttribuerChevauxModal')->name('ecurieChargeAttribuerChevauxModal');
            Route::get('ecurieChargeAttribuerChevaux', 'EcurieController@ecurieChargeAttribuerChevaux')->name('ecurieChargeAttribuerChevaux');
            Route::get('ecurieSupprChevalChargeModal', 'EcurieController@ecurieSupprChevalChargeModal')->name('ecurieSupprChevalChargeModal');
            Route::get('ecurieSupprimerChevalCharge', 'EcurieController@ecurieSupprimerChevalCharge')->name('ecurieSupprimerChevalCharge');
            Route::get('ecurieAppliquerChargesMensuelles', 'EcurieController@ecurieAppliquerChargesMensuelles')->name('ecurieAppliquerChargesMensuelles');

            /* === FACTURES === */
            Route::get('factureAfficher', 'FactureController@factureAfficher')->name('factureAfficher');
            Route::get('factureSupprimerModal', 'FactureController@factureSupprimerModal')->name('factureSupprimerModal');
            Route::get('factureSupprimer', 'FactureController@factureSupprimer')->name('factureSupprimer');
            Route::get('facturePayerModal', 'FactureController@facturePayerModal')->name('facturePayerModal');
            Route::get('factureSetPaiementMode', 'FactureController@factureSetPaiementMode')->name('factureSetPaiementMode');
            Route::get('facturePayer', 'FactureController@facturePayer')->name('facturePayer');
            Route::get('factureGenererTickets/{id_facture?}', 'FactureController@factureGenererTickets')->name('factureGenererTickets');
            Route::get('factureModifierModal', 'FactureController@factureModifierModal')->name('factureModifierModal');
            Route::get('factureModifier', 'FactureController@factureModifier')->name('factureModifier');
            Route::get('factureImpayerModal', 'FactureController@factureImpayerModal')->name('factureImpayerModal');
            Route::get('factureImpayer', 'FactureController@factureImpayer')->name('factureImpayer');
            Route::get('factureLierModal', 'FactureController@factureLierModal')->name('factureLierModal');
            Route::get('factureLier', 'FactureController@factureLier')->name('factureLier');
            Route::get('factureDelierModal', 'FactureController@factureDelierModal')->name('factureDelierModal');
            Route::get('factureDelier', 'FactureController@factureDelier')->name('factureDelier');
            Route::get('factureAjouterSelectionTypeAjoutModal', 'FactureController@factureAjouterSelectionTypeAjoutModal')->name('factureAjouterSelectionTypeAjoutModal');
            Route::get('factureAjouterChoixPrestationModal', 'FactureController@factureAjouterChoixPrestationModal')->name('factureAjouterChoixPrestationModal');
            Route::get('factureAjouterChoixTarifModal', 'FactureController@factureAjouterChoixTarifModal')->name('factureAjouterChoixTarifModal');
            Route::get('factureAjouterChoixPrestationgroupeModal', 'FactureController@factureAjouterChoixPrestationgroupeModal')->name('factureAjouterChoixPrestationgroupeModal');
            Route::get('factureAjouter', 'FactureController@factureAjouter')->name('factureAjouter');

            // Sans prestation
            Route::get('factureAnciennePrestationPayerModal', 'FactureController@factureAnciennePrestationPayerModal')->name('factureAnciennePrestationPayerModal');
            Route::get('factureAnciennePrestationPayer', 'FactureController@factureAnciennePrestationPayer')->name('factureAnciennePrestationPayer');
            Route::get('factureAnciennePrestationModifierModal', 'FactureController@factureAnciennePrestationModifierModal')->name('factureAnciennePrestationModifierModal');
            Route::get('factureAnciennePrestationModifier', 'FactureController@factureAnciennePrestationModifier')->name('factureAnciennePrestationModifier');

            // Bons d'achat
            Route::get('factureBonachatModal', 'FactureController@factureBonachatModal')->name('factureBonachatModal');
            Route::get('factureBonachatUtiliser', 'FactureController@factureBonachatUtiliser')->name('factureBonachatUtiliser');
            Route::get('factureBonachatAnnuler', 'FactureController@factureBonachatAnnuler')->name('factureBonachatAnnuler');

            /* === ABONNEMENTS === */
            Route::get('abonnementCreerModal', 'AbonnementController@abonnementCreerModal')->name('abonnementCreerModal');
            Route::get('abonnementChoixTarifModal', 'AbonnementController@abonnementChoixTarifModal')->name('abonnementChoixTarifModal');
            Route::get('abonnementCreer', 'AbonnementController@abonnementCreer')->name('abonnementCreer');
            Route::get('abonnementGetDetails', 'AbonnementController@abonnementGetDetails')->name('abonnementGetDetails');
            Route::get('abonnementVerifierEcheance', 'AbonnementController@abonnementVerifierEcheance')->name('abonnementVerifierEcheance');
            Route::get('abonnementSupprimerModal', 'AbonnementController@abonnementSupprimerModal')->name('abonnementSupprimerModal');
            Route::get('abonnementSupprimer', 'AbonnementController@abonnementSupprimer')->name('abonnementSupprimer');
            Route::get('abonnementProlongerModal', 'AbonnementController@abonnementProlongerModal')->name('abonnementProlongerModal');
            Route::get('abonnementProlonger', 'AbonnementController@abonnementProlonger')->name('abonnementProlonger');

            /* === PARAMETRES === */
            Route::get('param', 'ParamController@param')->name('param');
            Route::get('paramPrestationAjoutModal', 'ParamController@paramPrestationAjoutModal')->name('paramPrestationAjoutModal');
            Route::get('paramPrestationAjout', 'ParamController@paramPrestationAjout')->name('paramPrestationAjout');
            Route::get('paramPrestationSupprModal', 'ParamController@paramPrestationSupprModal')->name('paramPrestationSupprModal');
            Route::get('paramPrestationSupprimer', 'ParamController@paramPrestationSupprimer')->name('paramPrestationSupprimer');
            Route::get('paramPrestationTarif', 'ParamController@paramPrestationTarif')->name('paramPrestationTarif');
            Route::get('paramTarifAjoutModal', 'ParamController@paramTarifAjoutModal')->name('paramTarifAjoutModal');
            Route::get('paramTarifAjout', 'ParamController@paramTarifAjout')->name('paramTarifAjout');
            Route::get('paramTarifSupprModal', 'ParamController@paramTarifSupprModal')->name('paramTarifSupprModal');
            Route::get('paramTarifSupprimer', 'ParamController@paramTarifSupprimer')->name('paramTarifSupprimer');
            Route::get('paramPrestationAssociation', 'ParamController@paramPrestationAssociation')->name('paramPrestationAssociation');
            Route::get('paramPrestationAssociationAjoutModal', 'ParamController@paramPrestationAssociationAjoutModal')->name('paramPrestationAssociationAjoutModal');
            Route::get('paramPrestationAssociationAjout', 'ParamController@paramPrestationAssociationAjout')->name('paramPrestationAssociationAjout');
            Route::get('paramPrestationAssociationSupprModal', 'ParamController@paramPrestationAssociationSupprModal')->name('paramPrestationAssociationSupprModal');
            Route::get('paramPrestationGroupe', 'ParamController@paramPrestationGroupe')->name('paramPrestationGroupe');
            Route::get('paramPrestationGroupeAjoutModal', 'ParamController@paramPrestationGroupeAjoutModal')->name('paramPrestationGroupeAjoutModal');
            Route::get('paramPrestationGroupeAjout', 'ParamController@paramPrestationGroupeAjout')->name('paramPrestationGroupeAjout');
            Route::get('paramPrestationGroupeSupprPrestation', 'ParamController@paramPrestationGroupeSupprPrestation')->name('paramPrestationGroupeSupprPrestation');
            Route::get('paramPrestationSupprGroupeModal', 'ParamController@paramPrestationSupprGroupeModal')->name('paramPrestationSupprGroupeModal');
            Route::get('paramPrestationSupprGroupe', 'ParamController@paramPrestationSupprGroupe')->name('paramPrestationSupprGroupe');
            Route::get('paramPrestationGroupeTarif', 'ParamController@paramPrestationGroupeTarif')->name('paramPrestationGroupeTarif');
            Route::get('paramPrestationGroupeTarifDefautModal', 'ParamController@paramPrestationGroupeTarifDefautModal')->name('paramPrestationGroupeTarifDefautModal');
            Route::get('paramPrestationGroupeTarifDefaut', 'ParamController@paramPrestationGroupeTarifDefaut')->name('paramPrestationGroupeTarifDefaut');
            Route::get('paramCreerChargeModal', 'ParamController@paramCreerChargeModal')->name('paramCreerChargeModal');
            Route::get('paramCreerCharge', 'ParamController@paramCreerCharge')->name('paramCreerCharge');
            Route::get('paramSupprChargeModal', 'ParamController@paramSupprChargeModal')->name('paramSupprChargeModal');
            Route::get('paramSupprimerCharge', 'ParamController@paramSupprimerCharge')->name('paramSupprimerCharge');

            Route::middleware(['checkrole:admin'])->group(function() {
                /* === PARAMETRES ADMIN === */
                Route::get('paramAdmin', 'AdminController@paramAdmin')->name('paramAdmin');
                Route::get('moniteurCreer', 'AdminController@moniteurCreer')->name('moniteurCreer');
                Route::get('moniteurCreerModal', 'AdminController@moniteurCreerModal')->name('moniteurCreerModal');
                Route::get('moniteurChangerRoleModal', 'AdminController@moniteurChangerRoleModal')->name('moniteurChangerRoleModal');
                Route::get('moniteurSupprModal', 'AdminController@moniteurSupprModal')->name('moniteurSupprModal');
                Route::get('moniteurSupprimer', 'AdminController@moniteurSupprimer')->name('moniteurSupprimer');
                Route::get('moniteurChangerCouleur', 'AdminController@moniteurChangerCouleur')->name('moniteurChangerCouleur');
                Route::get('moyenPaiementCreer', 'AdminController@moyenPaiementCreer')->name('moyenPaiementCreer');
                Route::get('moyenPaiementCreerModal', 'AdminController@moyenPaiementCreerModal')->name('moyenPaiementCreerModal');
                Route::get('moyenPaiementActiver', 'AdminController@moyenPaiementActiver')->name('moyenPaiementActiver');

                /* === STATISTIQUES === */
                Route::get('stats', 'StatsController@stats')->name('stats');
                Route::get('getGraphChevaux', 'StatsController@getGraphChevaux')->name('getGraphChevaux');
                Route::get('chevalChargesBenefices', 'StatsController@chevalChargesBenefices')->name('chevalChargesBenefices');

                /* === ERREURS LOG === */
                Route::get('erreurs', 'ErreurController@erreurs')->name('erreurs');
                Route::get('pofNettoyerLogs', 'ErreurController@PofLogNettoyage')->name('pofNettoyerLogs');
                Route::get('pofViderLogs', 'ErreurController@PofViderLogs')->name('pofViderLogs');
            });

            /* === CARTE === */
            Route::get('carte-ajout-quantite-modal', 'CarteController@carteAjoutQuantiteModal')->name('carteAjoutQuantiteModal');
            Route::get('carte-ajout-quantite', 'CarteController@carteAjoutQuantite')->name('carteAjoutQuantite');
            Route::get('carte-supprimer-modal', 'CarteController@carteSupprimerModal')->name('carteSupprimerModal');
            Route::get('carte-supprimer', 'CarteController@carteSupprimer')->name('carteSupprimer');

            /* === PDF === */
            Route::get('PDFFacture/{id_facture}', 'PDFController@PDFFacture')->name('PDFFacture');
            Route::get('PDFFactureHtml/{id_facture}', 'PDFController@PDFFactureHtml')->name('PDFFactureHtml');
        });
    });
});

// Route de test pour les protections
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


/* ==== ORIENWORLD ==== */

// Affichage des romans
Route::get('orienworld', 'TextController@orienworld')->name('orienworld');
Route::get('display-novel/{id_roman?}', 'TextController@displayNovel')->name('displayNovel');
Route::get('go-to-page', 'TextController@goToPage')->name('goToPage');
Route::get('starmap', 'TextController@starmap')->name('starmap');

// Commentaires
Route::post('add-comment', 'CommentaireController@addComment')->name('addComment');
Route::get('get-comments/{id_roman?}', 'CommentaireController@getComments')->name('getComments');
Route::get('delete-comment', 'CommentaireController@deleteComment')->name('deleteComment');
