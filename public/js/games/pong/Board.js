import GameComponent from './GameComponent.js';

class Board extends GameComponent
{
    // Constructeur de notre classe (appelée lors de l'instanciation - ex: new Board())
    constructor(canvas, x, y, width, height, color) {
        super(canvas, x, y, width, height, color);
    }
    
    draw() {
        // Plateau
        this.context.fillStyle = this.color;
        this.context.fillRect(this.x, this.y, this.width, this.height);
        
        // Line médiane
        this.context.beginPath();
        this.context.moveTo(this.canvas.width / 2, 100);
        this.context.lineTo(this.canvas.width / 2, this.canvas.height - 100);
        this.context.strokeStyle = 'white';
        this.context.stroke();
    }
}

export default Board;