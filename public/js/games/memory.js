/* VARIABLES */

let memory_cards = $('.memory-card');
let counter = 0;
let selected_cards = [];

/* FUNCTIONS */

function shuffleArray(array){
    array.sort(()=> Math.random() - 0.5);
}

function updateCounter(count) {
    $('#memory-tries').text(count);
}

function startMemory() {
    updateCounter(0);
    dispatchMemoryCards();
}

function endMemoryGame() {
    $('.memory-card-container').empty()
        .css({'height': '85vh', 'display': 'flex', 'flex-direction': 'column', 'justify-content': 'center', 'align-items': 'center'});

    if(counter < 10) {
        $('.memory-card-container').html('<h1>Félicitations !</h1><h2>Vous avez réussi en ' + counter + ' essais.</h2>');
    }
    else if(10 < counter < 14) {
        $('.memory-card-container').html('<h1>Vous avez réussi en ' + counter + ' essais.</h1><h2>Vous ferez mieux la prochaine fois !</h2>');
    }
    else {
        $('.memory-card-container').html('<h1>Dommage !</h1><h2>Vous avez réussi en ' + counter + ' essais. Essayez de faire mieux la prochaine fois...</h2>');
    }
                    
    $('.memory-game-info').empty();
}

// Attribue aléatoirement une image à chaque carte
function dispatchMemoryCards() {
    let memory_cards_front = $('.memory-card-front');
    let characters = ['kurogane', 'kurogane', 'zoliane', 'zoliane', 'ecudor', 'ecudor', 'redd', 'redd', 'minoes', 'minoes', 'diavolin', 'diavolin'];
    
    for(let memory_card of memory_cards_front) {
        // On mélange le tableau avant de placer une image aléatoire sur la carte
        shuffleArray(characters);
        let character = characters.pop();
        $(memory_card).append('<img src="./img/games/memory/'+ character +'.png" alt="'+ character +'" width="80%"/>');
        $(memory_card).parent().attr('image', character);
    }
}

/* Ajout ou retrait de la classe pour retourner la carte sélectionnée */
function selectMemoryCard(card) {
    if($(card).hasClass('memory-card-visible')) {
        return;
    }

    $(card).addClass('memory-card-visible');
    $(card).removeClass('memory-card-hidden');
    $(card).prop('selected', true);

    selected_cards.push(card);
    
    // On vérifie si le nombre de cartes retournées est pair
    if(selected_cards.length % 2 == 0) {
        checkSelectedCards(selected_cards);
        selected_cards = [];
    }
}

// Vérifie si les deux cartes sélectionnées correspondent
function checkSelectedCards(selected_cards) {
    // On met à jour le compteur d'essais
    counter ++;
    updateCounter(counter);

    // On compare l'attribut 'image' des cartes sélectionnées
    if($(selected_cards[0]).attr('image') === $(selected_cards[1]).attr('image')) {
        console.log('yep');
        for(let card of selected_cards) {
            setTimeout(function() {
                $(card).css('animation', 'memoryCardDisappear 0.5s forwards');
                let visible_cards = $('.memory-card-visible');
                if(visible_cards.length == memory_cards.length) {
                    endMemoryGame();
                }
            }, 1000);
        }
    }
    else {
        for(let card of selected_cards) {
            setTimeout(function() {
                $(card).removeClass('memory-card-visible');
                $(card).addClass('memory-card-hidden');
            }, 1000);
        }
    }
}

/* MAIN CODE */
document.addEventListener('DOMContentLoaded', function() {
    startMemory();
    for(let card of memory_cards) {
        $(card).on('click', function(e) {
            selectMemoryCard(this);
        });
    }
    //$('.memory-card').addEventListener('click', selectMemoryCard(this));
})