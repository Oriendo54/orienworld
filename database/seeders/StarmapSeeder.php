<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StarmapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $planets = [
            [
                'nom' => 'lugori',
                'resume' => 'Planète majeure du système solarian, Lugori abrite en son sein la capitale Solaria ainsi que la ville universitaire de Stène. C\'est le siège des institutions impériales et le centre névralgique d\'innovation de l\'Empire. Hélas, elle est aussi gangrénée par le crime organisé que domine la tristement célèbre Murcia, la plus puissante famille mafieuse de la galaxie.',
                'population' => 9.4
            ],
            [
                'nom' => 'irotia',
                'resume' => 'Irotia est la plus petite des planètes du système solarian. Gouvernée par le général en chef des armées Maz Keltien, elle dispose d\'une flotte puissante et de grands chantiers orbitaux qui font d\'elle la clef de voûte de l\'armada impériale. Mais depuis une douzaine d\'années, elle est également le terrain de jeu de la célèbre Mort Rouge, une tueuse à gages redoutable que les forces de la Sécurité Civile ne parviennent pas à arrêter.',
                'population' => 3.2
            ],
            [
                'nom' => 'ashura',
                'resume' => 'Planète au climat tempéré et dotée de grandes réserves d\'eau douce, Ashura s\'est rapidement imposée comme le grenier à blé de l\'Empire de Solarias. Son atmosphère irrespirable impose cependant l\'installation de dômes oxygénés, ce qui explique probablement le faible nombre de colonies qui s\'y sont implantées. On y trouve donc principalement des fermes industrielles gigantesques et des quais orbitaux d\'attache pour les vaisseaux-cargot qui distribuent les productions agricoles aux quatre coins de l\'Empire.',
                'population' => null
            ],
            [
                'nom' => 'rosamund',
                'resume' => 'Planète la plus peuplée de l\'Empire de Solarias, Rosamund abrite notamment le siège de la Banque Impériale et de nombreuses industries de nanotechnologies. La mégapole, Lentiane, est en perpétuelle concurrence avec la ville de Stène pour attirer le fleuron des entreprises et des laboratoires de recherche.',
                'population' => 11.7
            ],
            [
                'nom' => 'polaria',
                'resume' => 'A moitié désertique et stérile, Polaria est devenue le refuge du peuple polarian, chassé des autres planètes lors de la fondation de l\'Empire de Solarias. Dirigés par un Conseil des Primautés et par la toute-puissante corporation marchande de la famille Fa, ses habitants doivent lutter chaque jour dans l\'espoir de survivre.',
                'population' => 17
            ],
            [
                'nom' => 'edona',
                'resume' => 'Tête dirigeante de la très influente Confédération Edonienne, la planète Edona est tombée sous le joug de l\'Empire de Solarias en 3199 à l\'issue d\'une première révolte réprimée dans le sang. Un Protectorat y fut créé sous l\'autorité d\'un gouverneur impérial, et les pouvoirs du Nomarque furent réduits à néant. Moins de vingt ans plus tard, la planète tenta un second soulèvement pour retrouver sa liberté, qui échoua à son tour : depuis la défaite de 3216 face aux armées irotiennes, Edona est victime d\'un embargo sévère de la part de l\'administration impériale et ne rêve que de réconquérir un jour son indépendance.',
                'population' => 5.5
            ],
            [
                'nom' => 'dortamund',
                'resume' => 'Immense planète désertique et stérile, Dortamund est principalement connue pour abriter les mines de neutronium et le bagne impérial, où les détenus sont condamnés à une vie d\'enfer dans les profondeurs de cette géante chaude. Du fait des conditions de survie extrêmement dures à sa surface, elle n\'est habitée que par sa population carcérale et les corps d\'armée qui se relaient pour monter la garde dans les camps de travail forcé.',
                'population' => null
            ]
        ];

        DB::table('starmap')->insert($planets);
    }
}
