import Ball from './Ball.js';
import Board from './Board.js';
import Player, {MOUSE_CONTROLLER, KEYPAD_CONTROLLER} from './Player.js';

class Game
{
    constructor(canvas) {
        
        this.canvas = canvas;
        this.context = this.canvas.getContext('2d');
        
        // Création du plateau
        this.board = new Board(canvas, 100, 100, canvas.width - 200, canvas.height - 200, 'forestgreen');
        
        // Création de la balle
        this.ball = new Ball(canvas, canvas.width / 2, canvas.height / 2);
        
        // Création des joueurs
        this.player1 = new Player(canvas, 0, canvas.height / 2);
        this.player2 = new Player(canvas, canvas.width, canvas.height / 2);
        this.player2.x -= this.player2.width;
        
         // Contrôleur du joueur 1 qui utilisera la souris
        this.player1.controller = MOUSE_CONTROLLER;
        
        // Contrôleur du joueur 2 qui utilisera le clavier
        this.player2.controller = KEYPAD_CONTROLLER;
        
        this.animation = null;
        
        // On passe directement par la propriété
        this.ball.x = -100;
        console.log(this.ball.x);
        
        // On passe par une fonction pour modifier la propriété
        this.ball.X = -100;
        console.log(this.ball.X);
    }
    
    // Méthode qui dessine tous les composants du jeu (plateau, balle, joueurs...)
    draw() {
        this.board.draw();
        this.ball.draw();
        this.player1.draw();
        this.player2.draw();
    }
    
    updateScore() {
        const scoreP1 = document.querySelector('.score1 em');
        const scoreP2 = document.querySelector('.score2 em');
        
        scoreP1.textContent = this.player1.points;
        scoreP2.textContent = this.player2.points;
    }
    
    resetBall(player) {
        if (this.ball.x)
        this.ball.x = player.x + this.ball.radius + player.width;
        this.ball.y = player.y + player.height / 2;
    }
    
    start() {
        // Lance le jeu
        
        // On efface le plateau à chaque lancement de l'animation
        this.context.clearRect(0, 0, this.canvas.width, this.canvas.height),
        
        // On redessine le plateau de jeu
        this.draw();
        
        // On gère le rebond de la balle sur les raquettes des joueurs
        if (this.ball.x <= 0 && this.ball.y > this.player1.y && this.ball.y < this.player1.y + this.player1.height) {
            this.ball.direction.x *= -1;
            this.ball.increaseSpeed();
        }
        else if(this.ball.x <= 0) {
            this.ball.x = this.canvas.width/2;
            this.ball.y = this.canvas.height/2;
            this.player2.points += 1;
            this.ball.initSpeed();
        }
        
        if (this.ball.x >= this.canvas.width && this.ball.y > this.player2.y && this.ball.y < this.player2.y + this.player2.height) {
            this.ball.direction.x *= -1;
            this.ball.increaseSpeed();
        }
        
        else if(this.ball.x >= this.canvas.width) {
            this.ball.x = this.canvas.width/2;
            this.ball.y = this.canvas.height/2;
            this.player1.points += 1;
            this.ball.initSpeed();
        }
        
        // On gère le rebond de la balle sur les bords du plateau
        if (this.ball.y<=0 || this.ball.y+this.ball.radius>=this.canvas.height) {
            this.ball.direction.y *= -1;
        }
        
        this.updateScore();
        
        // Lance le mouvement de la balle
        this.ball.move();
        
        // On relance l'animation en précisant le nom de la méthode 
        // (fonction dans une classe) qui sera rappelée
        this.animation = requestAnimationFrame(this.start.bind(this));
    }
}

export default Game;