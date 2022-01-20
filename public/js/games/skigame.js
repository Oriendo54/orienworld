import Game from 'ski/Game.js';

/* Classes et propriétés

- Player : img, x, y, speed, height, width
- Obstacles : img, x, y, speed, height, width
- Board : startingLine, finishLine (à afficher après X obstacles franchis)

*/
let game;
let buttonStart;

function launchGame() {
   game.draw();
   game.start();
}

document.addEventListener('DOMContentLoaded', function() {
   
   let canvas = document.querySelector('#skiboard');
   game = new Game(canvas);
   
   buttonStart = document.querySelector('.ski-btn');
   buttonStart.addEventListener('click', launchGame);
   
});