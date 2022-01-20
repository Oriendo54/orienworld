import GameComponent from './GameComponent.js';

class Ball extends GameComponent
{
    constructor(canvas, x, y, radius = 10, color = 'black', speed = {x: 3, y: 3}, direction = {x: -1, y: -1}) {
        // On appelle le constructeur (constructor) du parent (GameComponent)
        super(canvas, x, y, null, null, color);
        
        // Définition des propriétés spécifiques à la classe
        this.radius = radius;
        this.speed = speed;
        this.direction = direction;
    }
    
    draw() {
        this.context.beginPath();
        this.context.fillStyle = this.color;
        this.context.arc(this.x, this.y, this.radius, 0, Math.PI * 2, true);
        this.context.fill();
    }
    
    move() {
        this.x += this.speed.x * this.direction.x;
        this.y += this.speed.y * this.direction.y;
    }
    
    increaseSpeed() {
        this.speed.x *= 1.1;
        this.speed.y *= 1.1;
    }
    
    initSpeed() {
        // Vitesse de base de la balle
        this.speed.x = 3;
        this.speed.y = 3;
    }
    
    // Mutateur (ou setter)
    set X(x) {
        if (x >= 0) {
            this.x = x;
        } else {    // Si la valeur est incorrecte on met 0 par défaut
            this.x = 0;
        }
    }
    
    // Accesseur (ou getter)
    get X() {
        return this.x;
    }
}

export default Ball;