<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cards = [
            [
                'titre' => 'Le Morpion',
                'resume' => 'Qui n\'a jamais joué au célèbre jeu du Morpion ? Alignez trois symboles identiques pour battre votre adversaire !',
                'addendum' => 'Nécessite deux joueurs.',
                'src' => 'img/games/morpion.png',
                'alt' => 'morpion',
                'route' => 'tictactoe',
                'tag' => 'game',
            ], [
                'titre' => 'Le Memory',
                'resume' => 'Retournez les cartes pour constituer des paires et remporter la partie. Qui aura la meilleure mémoire ?',
                'addendum' => '',
                'src' => 'img/games/memory/memory.png',
                'alt' => 'memory',
                'route' => 'memory',
                'tag' => 'game',
            ], [
                'titre' => 'Pong',
                'resume' => 'Le célèbre jeu Pong ! Parviendrez-vous à conserver la balle sur le plateau ?',
                'addendum' => '',
                'src' => 'img/games/pong.png',
                'alt' => 'pong',
                'route' => 'pong',
                'tag' => 'game'
            ], [
                'titre' => 'Snakes and Ladders',
                'resume' => 'Atteignez l\'autre extrémité du plateau en empruntant les échelles, mais attention aux serpents qui vous renvoient en arrière !',
                'addendum' => 'Nécessite deux joueurs.',
                'src' => 'img/work-in-progress.png',
                'alt' => 'snake_and_ladders',
                'route' => 'snake',
                'tag' => 'game',
            ], [
                'titre' => 'Le jeu du ski',
                'resume' => 'Descendez les pistes en évitant les obstacles ! Le but est de réaliser le meilleur chrono possible.',
                'addendum' => 'Mais attention au yéti qui essaye de vous attraper !',
                'src' => 'img/work-in-progress.png',
                'alt' => 'jeu_du_ski',
                'route' => 'skigame',
                'tag' => 'game',
            ], [
                'titre' => 'Le jeu du Cik',
                'resume' => 'Une variante des échecs dans l\'espace : les pions sont des vaisseaux qui peuvent s\'attaquer pour se détruire.',
                'addendum' => 'Faites tomber la planète-mère de votre adversaire.',
                'src' => 'img/work-in-progress.png',
                'alt' => 'jeu_du_cik',
                'route' => 'cik',
                'tag' => 'game',
            ], [
                'titre' => 'PonyOnFire',
                'resume' => 'PonyOnFire permet de gérer le fonctionnement d\'un centre équestre. Réalisé en 2021 pour la Sellerie des Nacres.',
                'addendum' => 'Laravel, Jquery et Bootstrap.',
                'src' => 'img/pony-on-fire/logo_pony.png',
                'alt' => 'pony_on_fire',
                'route' => 'pof',
                'tag' => 'pro',
            ], [
                'titre' => 'Agenda',
                'resume' => 'Agenda intéractif réalisé au cours de ma formation avec la 3W Academy.',
                'addendum' => 'HTML, CSS et Javascript.',
                'src' => 'img/work-in-progress.png',
                'alt' => 'agenda',
                'route' => 'agenda',
                'tag' => 'autre',
            ], [
                'titre' => 'Carnet de contacts',
                'resume' => 'Carnet de contacts intéractif réalisé au cours de ma formation avec la 3W Academy.',
                'addendum' => 'HTML, CSS et Javascript',
                'src' => 'img/work-in-progress.png',
                'alt' => 'carnet_de_contacts',
                'route' => 'repertoire',
                'tag' => 'autre',
            ], [
                'titre' => 'Liste de courses',
                'resume' => 'Triez vos produits par catégorie, réutilisez d\'anciennes listes ou consultez des recettes pour ajouter leurs ingrédients !',
                'addendum' => 'HTML, CSS et Javascript',
                'src' => 'img/work-in-progress.png',
                'alt' => 'liste_de_courses',
                'route' => 'shopping',
                'tag' => 'autre',
            ], [
                'titre' => 'To-do liste',
                'resume' => 'Tasklist intéractive réalisée au cours de ma formation avec la 3W Academy.',
                'addendum' => 'HTML, CSS et VueJS',
                'src' => 'img/projects/tasklist.png',
                'alt' => 'todo_liste',
                'route' => 'todolist',
                'tag' => 'autre',
            ]
        ];

        DB::table('portfolio_cartes')->insert($cards);
    }
}
