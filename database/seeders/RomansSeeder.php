<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RomansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('romans')->insert([
            'titre' => 'Colossus - Le royaume de Misère',
            'alias' => 'colossus',
            'resume' => 'Dans un Monde des Douze plus dangereux que jamais, Le Royaume de Misère vous entraîne à la rencontre des aventuriers de la guilde Colossus. De la découverte d\'un mystérieux Zaap temporel aux Catacombres de Srambad où sévit une terrible organisation criminelle, rejoignez Kuro, Orimage et Kirina dans une épopée pleine de rires, de dangers et de rebondissements.',
        ]);

        DB::table('romans')->insert([
            'titre' => 'Mythes de Sundor - Le Sildaros',
            'alias' => 'mds',
            'resume' => 'Voilà plusieurs mois que d\'étranges rumeurs parcourent les terres de Sundor. Marchands et voyageurs, sentinelles et hérauts : tous rapportent les mêmes histoires. Leurs récits parlent du retour des Grisécailles, disparus depuis des siècles, et de la naissance d\'un Enfant de Shâat. Au Nord, le grand continent de Ghern est sur le point de sombrer dans une terrible guerre civile. Au Sud du Bouclier, le long des rives de la Sinistrale, cinq cavaliers revêtus d\'armures plus sombres que la Grande Nuit ont été aperçus. Et loin vers l\'Ouest, au-delà de la Mer du Soir et du désert glacé de Derdahal, un mal ancien et méconnu s\'éveille dans les terres sauvages d\'Areak. Ces rumeurs, Oriendo les connait bien. Après des années de mercenariat parmi les célèbres Sildaros, le vieux guerrier a rengainé son épée et s\'est établi comme aubergiste avec sa femme Anthea dans le petit bourg de Vitarive. Il aspire désormais à une vie simple et paisible, loin des affres de la politique et des champs de bataille. Mais c\'est sans compter l\'arrivée dans son établissement d\'un mystérieux bretteur et d\'une enchanteresse aux yeux vairons. Car dans leur sillage, le vent du changement souffle sur Sundor, et nul ne sera bientôt à l\'abri de la tempête qui se prépare.',
        ]);

        DB::table('romans')->insert([
            'titre' => 'Chroniques d\'Irotia',
            'alias' => 'irotia',
            'resume' => 'Irotia, 3224. La planète la plus riche de l\'Empire de Solarias est dirigée par le charismatique général Maz Keltien, que l\'on dit invincible. Mais, très vite, une série d\'attentats meurtriers et une tueuse vêtue de rouge viennent remettre en question les certitudes des habitants. Qui est vraiment Feris Park, le mercenaire débarqué de la capitale quelques jours avant les faits ? Peut-il vraiment aider le vieux général à sauver la ville ? Entre complots et trahisons, sur cette planète gangrenée par le crime, Park va rapidement découvrir que les apparences sont trompeuses, et que chacun a sa part d\'ombre à cacher. En se lançant sur la piste de la Mort Rouge et de son mystérieux commanditaire, le baltringue pourrait bien mettre le doigt dans un engrenage dont l\'ampleur dépasse complètement tout ce qu\'il avait imaginé.',
        ]);
    }
}
