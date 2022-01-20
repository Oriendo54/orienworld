class GameComponent
{
    constructor(canvas, x, y, width, height, color) {
        this.canvas = canvas;
        this.context = this.canvas.getContext('2d');
        this.x = x;
        this.y = y;
        this.width = width;
        this.height = height;
        this.color = color;
    }
}

export default GameComponent;