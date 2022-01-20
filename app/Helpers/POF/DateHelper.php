<?php
namespace App\Helpers\POF;

use Illuminate\Support\Facades\DB;
 
class DateHelper {
   
    public static function dateJourdelasemaine($date) {
        
        $jourdelasemaine_numero = date('w', strtotime($date));
        
        switch ($jourdelasemaine_numero) {
            case 0:
                $jourdelasemaine = 'D';
                break;
            case 1:
                $jourdelasemaine = 'L';
                break;
            case 2:
                $jourdelasemaine = 'Ma';
                break;
            case 3:
                $jourdelasemaine = 'Me';
                break;
            case 4:
                $jourdelasemaine = 'J';
                break;
            case 5:
                $jourdelasemaine = 'V';
                break;
            case 6:
                $jourdelasemaine = 'S';
                break;
        }
        
        return $jourdelasemaine;
    }
    
    public static function dateJourdelasemaineComplet($date) {
        
        $jourdelasemaine_numero = date('w', strtotime($date));
        
        switch ($jourdelasemaine_numero) {
            case 0:
                $jourdelasemaine = 'Dimanche';
                break;
            case 1:
                $jourdelasemaine = 'Lundi';
                break;
            case 2:
                $jourdelasemaine = 'Mardi';
                break;
            case 3:
                $jourdelasemaine = 'Mercredi';
                break;
            case 4:
                $jourdelasemaine = 'Jeudi';
                break;
            case 5:
                $jourdelasemaine = 'Vendredi';
                break;
            case 6:
                $jourdelasemaine = 'Samedi';
                break;
        }
        
        return $jourdelasemaine;
    }
}