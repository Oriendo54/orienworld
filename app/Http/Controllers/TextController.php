<?php

namespace app\Http\Controllers;

use Carbon\Carbon;
use App\Models\Romans;
use App\Models\Starmap;
use App\Models\Commentaires;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class TextController extends Controller {
    
    public function orienworld() {
        $romans = Romans::all();
        return view('orienworld.orienworld', compact('romans'));
    }

    /*
    * displayNovel :
    *   - À partir d'un id_roman, renvoie la vue pour afficher le roman souhaité.
    */
    public function displayNovel(Request $request) {
        $roman = Romans::find($request->id_roman);
        $page = 'couverture';
        $comments = Commentaires::where('id_roman', $roman->id_roman)
            ->where('page', $page)
            ->get();

        return view('orienworld.display_roman', compact('roman', 'page', 'comments'));
    }

    /* 
    * goToPage :
    *   - Récupère en requête la page actuelle, le roman consulté et un indice d'incrémentation
    *   - Incrémentation de -1 pour reculer d'une page et 1 pour avancer d'une page
    *   - En fonction de l'incrémentation, renvoie la page demandée
    */
    public function goToPage(Request $request) {
        $roman = Romans::find($request->id_roman);
        if($request->current_page == 'couverture') {
                $page = 'prologue';
        }
        else if($request->current_page == 'prologue') {
            if($request->increment > 0) {
                $page = 'chapitre1';
            }
            else {
                $page = 'couverture';
            }
        }
        else if($request->current_page == 'chapitre1' && $request->increment < 0) {
            $page = 'prologue';
        }
        // Gestion de la page de conclusion après les 3 premiers chapitres pour MDS et Irotia
        else if($request->current_page == 'chapitre3' && ($roman->id_roman == 2 || $roman->id_roman == 3) && $request->increment > 0) {
            $page = 'conclusion';
        }
        else if($request->current_page == 'conclusion' && ($roman->id_roman == 2 || $roman->id_roman == 3) && $request->increment < 0) {
            $page = 'chapitre3';
        }
        else {
            // Récupération du numéro de page actuel pour le concaténer et créer le nouveau numéro
            $current_page = substr($request->current_page, 8);
            $page = 'chapitre' . ($current_page + $request->increment);
        }

        return response()->json([
            'view' => view('orienworld.'.$roman->alias.'.'.$page, compact('page'))
                ->render(),
            'roman' => $roman->alias,
        ]);
    }


    public function starmap() {
        $planets = Starmap::all();

        return view('orienworld.irotia.starmap', compact('planets'));
    }
}