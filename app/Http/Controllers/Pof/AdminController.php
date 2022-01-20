<?php

namespace App\Http\Controllers\Pof;

use App\Models\User;
use App\Models\Pof\PofRole;
use Illuminate\Http\Request;
use App\Models\Pof\PofFacture;
use App\Models\Pof\PofUserRole;
use App\Models\Pof\PofMoniteurs;
use App\Mail\UserInscriptionMail;
use App\Http\Controllers\Controller;
use App\Models\Pof\PofMoyenPaiement;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function paramAdmin() {
        $moniteurs = PofMoniteurs::all();
        $moyens_paiement = PofMoyenPaiement::all();

        return view('pony.admin.admin', compact('moniteurs', 'moyens_paiement'));
    }


    public function moniteurCreerModal(Request $request) {
        
        $moniteur = PofMoniteurs::find($request->id_moniteur);
        $roles = PofRole::all();

        return response()->json([
            'view' => view('pony.admin.admin_moniteur_creer_modal', compact('moniteur', 'roles'))
                ->render()
        ]);
    }


    public function moniteurChangerRoleModal(Request $request) {
        $role = PofRole::find($request->id_role);
        $moniteur = PofMoniteurs::find($request->id_moniteur);

        $message = 'Vous êtes sur le point de changer le rôle de ce moniteur.';
        if($request->ancien_role == 1) {
            $message = 'Vous êtes sur le point de révoquer un administrateur !';
        }

        $action = 'attribuer le rôle '.$role->libelle.' à ce moniteur';
        $fonction = 'moniteurCreer('.$moniteur->id_moniteur.')';

        return response()->json([
            'view' => view('pony.warning_modal', compact('action', 'fonction'))
                ->render()
        ]);
    }


    public function moniteurChangerRole(PofMoniteurs $moniteur, PofRole $role) {
        $user_role = $moniteur->pofuserrole;
        $user_role->id_role = $role->id_role;
        $user_role->save();

        return $user_role->pofrole;
    }

    
    public function moniteurCreer(Request $request) {
        if(!$request->id_moniteur) {
            $moniteur = new PofMoniteurs;
        }
        else {
            $moniteur = PofMoniteurs::find($request->id_moniteur);
        }
        $moniteur->nom = $request->nom;
        $moniteur->prenom = $request->prenom;
        $moniteur->couleur = $request->couleur;
        $moniteur->email = $request->email;
        $moniteur->save();

        // Création d'un User pour que le moniteur puisse accéder à l'application
        if(!$moniteur->pofuser) {
            $user = new User;
            $user->name = $moniteur->nom.' '.$moniteur->prenom;
            $user->email = $moniteur->email;
            $user->password = Hash::make($this->genererChaineAleatoire());
            $user->save();

            $moniteur->id_user = $user->id;
            $moniteur->save();

            $user_role = new PofUserRole;
            $user_role->id_user = $user->id;
            $user_role->id_role = 2;
            $user_role->save();

            Mail::to($moniteur->email)->send(new UserInscriptionMail($user));

            $moniteurs = PofMoniteurs::all();
            $message = $moniteur->nom.' '.$moniteur->prenom.' a été inscrit à l\'application. Un lien lui a été envoyé à son adresse email pour générer son mot-de-passe.';

            return response()->json([
                'view' => view('pony.admin.admin_moniteur', compact('moniteurs'))
                    ->render(),
                'modal' => view('pony.message_modal', compact('message'))
                    ->render()
            ]);
        }

        if($request->id_role) {
            $user_role = $moniteur->pofuserrole;
            $user_role->id_role = $request->id_role;
            $user_role->save();
        }

        $moniteurs = PofMoniteurs::all();

        return response()->json([
            'view' => view('pony.admin.admin_moniteur', compact('moniteurs'))
                ->render()
        ]);
    }


    public function moniteurChangerCouleur(Request $request) {
        $moniteur = PofMoniteurs::find($request->id_moniteur);
        $moniteur->couleur = $request->couleur_moniteur;
        $moniteur->save();

        $moniteurs = PofMoniteurs::all();

        return response()->json([
            'view' => view('pony.admin.admin_moniteur', compact('moniteurs'))
                ->render()
        ]);
    }


    public function moniteurSupprModal(Request $request) {
        $moniteur = PofMoniteurs::find($request->id_moniteur);
        $element = 'ce moniteur';
        $function = 'moniteurSupprimer('.$moniteur->id_moniteur.')';

        return response()->json([
            'view' => view('pony.delete_warning_modal', compact('element', 'function'))
                ->render()
        ]);
    }


    public function moniteurSupprimer(Request $request) {
        $moniteur = PofMoniteurs::find($request->id_moniteur);
        $moniteur->delete();

        return;
    }


    public function moyenPaiementCreerModal() {
        return response()->json([
            'view' => view('pony.admin.admin_moyenpaiement_creer_modal')
                ->render()
        ]);
    }
    
    public function moyenPaiementCreer(Request $request) {
        $moyen_paiement = new PofMoyenPaiement;
        $moyen_paiement->libelle = $request->libelle;
        $moyen_paiement->actif = 1;
        $moyen_paiement->save();

        $moyens_paiement = PofMoyenPaiement::all();

        return response()->json([
            'view' => view('pony.admin.admin_paiements', compact('moyens_paiement'))
                ->render()
        ]);
    }

    public function moyenPaiementActiver(Request $request) {
        $moyen_paiement = PofMoyenPaiement::find($request->id_moyen_paiement);
        if($moyen_paiement->actif == 1) {
            $moyen_paiement->actif = 0;
        }
        else {
            $moyen_paiement->actif = 1;
        }
        $moyen_paiement->save();

        // Mise à jour des moyens de paiement disponibles pour les factures
        $factures = PofFacture::where('id_facture_statut', 1)->get();
        foreach($factures as $facture) {
            $facture_moyens_paiement = $this->factureMoyensPaiementMaj($facture);
        }

        $moyens_paiement = PofMoyenPaiement::all();

        return response()->json([
            'view' => view('pony.admin.admin_paiements', compact('moyens_paiement'))
                ->render()
        ]);
    }
}
