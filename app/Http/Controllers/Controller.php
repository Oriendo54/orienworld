<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function wip(string $route) {
        return view('errors.wip', compact('route'));
    }

    // GESTION DES ERREURS

    /*
    * getErrorModal :
    *   - Génère un message d'erreur
    *   - Renvoie un objet json contenant la modale d'erreur et le message choisi.
    */
    public function getErrorModal($erreur) {
        return response()->json([
            'view' => view('pony.erreur_modal', compact('erreur'))
                ->render(),
            'erreur' => $erreur
        ]);
    }
    
    /*
    *   - Renvoie un objet json contenant la modale de message et le message choisi.
    */
    public function getMessageModal($message) {
        return response()->json([
            'view' => view('pony.message_modal', compact('message'))
                ->render()
        ]);
    }
    
    function PofLog($message,$category = null,$couleur = null) {
        
        $message = str_replace('\'','',$message);
        
        $sql = 'insert into pof_log (message,category,couleur) value (\''.$message.'\',\''.$category.'\',\''.$couleur.'\')';
        
        DB::select($sql);
    }
    
    function genererChaineAleatoire($longueur = 10) {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longueurMax = strlen($caracteres);
        $chaineAleatoire = '';
        for ($i = 0; $i < $longueur; $i++) {
            $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
        }
        return $chaineAleatoire;
    }

    /* Gère la déconnexion des utilisateurs */
    public function logout(Request $request) {
        $this->PofLog('déconnexion de '.auth()->user()->name);
        Auth::logout();

        /* Suppression de la session et du token de sécurité pour que le prochain
        utilisateur ne soit pas obligé de rentrer ses identifiants deux fois en se connectant */
        $this->PofLog('suppression de la session et rafraîchissement du token de connexion');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        $this->PofLog('Renvoi vers la page de connexion');
        return redirect(route('login'));
    }
}
