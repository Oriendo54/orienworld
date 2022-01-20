/* ===== VARIABLES ===== */

let gameInfo;
let playState = true;
let player = "X";
let cells;
let button;
let gridState = ["", "", "", "", "", "", "", "", ""];
const winConditions = [
        [0, 1, 2],
        [3, 4, 5],
        [6, 7, 8],
        [0, 3, 6],
        [1, 4, 7],
        [2, 5, 8],
        [0, 4, 8],
        [2, 4, 6]
    ];

/* ===== FUNCTIONS ===== */

function activePlayer() {
    return `C\'est au tour du joueur ${player}`;
}

function winner() {
    return `Le joueur ${player} a gagné !`;
}

function draw() {
    return `Egalité !`;
}

function checkCell() {
    let selectedCell = parseInt(this.dataset.cellid);
    
    // On vérifie si la cellule est déjà jouée, et si la partie n'est pas lancée
    if(gridState[selectedCell] != "" || !playState) {
        return;
    }
    else {
        gridState[selectedCell] = player;
        this.innerHTML = player;
        checkWin();
    }
}

function checkWin() {
    let playerWin = false;
    
    // On vérifie si une des 8 conditions de victoire est remplie
    for (let condition of winConditions) {
        let check1 = gridState[condition[0]];
        let check2 = gridState[condition[1]];
        let check3 = gridState[condition[2]];
        
        // On vérifie si une des trois cases alignées est vide
        if(check1 == "" || check2 == "" || check3 == "") {
            continue;
        }
        
        // On vérifie si les trois cases alignées ont le même symbole
        if(check1 == check2 && check1 == check3) {
            playerWin = true;
            cells[condition[0]].style.background = 'rgba(255, 0, 0, .6)';
            cells[condition[1]].style.background = 'rgba(255, 0, 0, .6)';
            cells[condition[2]].style.background = 'rgba(255, 0, 0, .6)';
            break;
        }
    }
    
    // Gestion de la victoire d'un joueur
    if(playerWin) {
        gameInfo.innerHTML = winner();
        playState = false;
        return;
    }
    // Si aucun joueur n'a gagné, on vérifie s'il reste des cases disponibles pour continuer à jouer
    else if(gridState.includes("")) {
        // On change de joueur pour continuer la partie
        if(player == "X") {
            player = "O";
        }
        else {
            player = "X";
        }
        gameInfo.innerHTML = activePlayer();
    }
    // Si la grille est remplie, on déclenche l'égalité
    else {
        gameInfo.innerHTML = draw();
        playState = false;
        return;
    }
}

function restartGame() {
    
    // Remise à zéro des variables
    playState = true;
    player = "X";
    gridState = ["", "", "", "", "", "", "", "", ""];
    gameInfo.innerHTML = activePlayer();
    
    // On vide la grille
    for(let cell of cells) {
        cell.innerHTML = "";
        cell.style.background = 'rgba(255, 255, 255, .6)';
    }
}

/* ===== MAIN CODE ===== */

document.addEventListener('DOMContentLoaded', function() {
    gameInfo = document.querySelector('#morpion-game p');
    gameInfo.innerHTML = activePlayer();
    
    cells = document.querySelectorAll('.morpion-cell');
    for (let cell of cells) {
        cell.addEventListener('click', checkCell);
    }
    
    button = document.querySelector('#morpion-game .bouton');
    button.addEventListener('click', restartGame);
});