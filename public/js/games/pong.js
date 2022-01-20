/* # Pong

## Classes et propriétés

- Player (x, y, width, height, points, color, draw()...)
- Ball (x, y, radius, speed, direction, color, draw()...)
- Board (canvas, context, color, draw()...)

## Modules
Les classes sont dans un dossier à part et sont importées dans le fichier pong.js */

/* ====== MODULES ====== */

/* import Player from './modules/player.js';*/
import Game from './pong/game.js';

/* ====== VARIABLES ====== */

document.addEventListener('DOMContentLoaded', function() {
    let canvas = document.querySelector('#board');
    const game = new Game(canvas);

    // On dessine le plateau de jeu
    game.draw();
    game.updateScore();

    let buttonStart = document.querySelector('#button-start');
    buttonStart.addEventListener('click', function() {
        // On démarre la partie
        game.start();
    });
});