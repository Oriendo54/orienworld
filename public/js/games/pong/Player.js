import GameComponent from './GameComponent.js';

const MOUSE_CONTROLLER = 1;
const KEYPAD_CONTROLLER = 2;

class Player extends GameComponent
{
    constructor(canvas, x, y, width = 5, height = 100, color = 'black', points = 0) {
        super(canvas, x, y, width, height, color);
        
        this.points = points;
        this.mouseEnabled = false;
        
        // On centre le point y pour que cela soit le milieu du paddle
        this.y -= this.height / 2;
        
        // Gestion du contrôle du joueur
        
        // Mettre en place l'événement keydown qui appelle la méthode move du player
        document.addEventListener('keydown', this.move.bind(this));
        
        document.addEventListener('mousemove', this.move.bind(this));
        
        this.canvas.addEventListener('mousedown', () => {
            this.mouseEnabled = true;
        });
        
        // Pareil que : this.canvas.addEventListener('mousedown', this.onMouseDown.bind(this));
        
        this.canvas.addEventListener('mouseup', () => {
            this.mouseEnabled = false;
        
        });
    }
    
    draw() {
        this.context.fillStyle = this.color;
        this.context.fillRect(this.x, this.y, this.width, this.height);
    }
    
    hitBall(ball) {
        return ball.y >= this.y && ball.y <= this.y + this.height;
    }
    
    move(event) {
        
        // Version avec le clavier
        
        if (this.controller == KEYPAD_CONTROLLER) {
        
            switch (event.keyCode) {
                case 38:
                    this.y -= 10;
                    break;
                case 40:
                    this.y += 10;
                    break;
            }
        } else if (this.controller == MOUSE_CONTROLLER) {
        
            // Version avec la souris
            
            if (this.mouseEnabled) {
                // Récupérer la position de la souris par rapport au canvas
                const rect = this.canvas.getBoundingClientRect();
            
                this.y = event.clientY - rect.top - this.height / 2;
            }
        }
    }
}

export default Player;
export {MOUSE_CONTROLLER, KEYPAD_CONTROLLER};