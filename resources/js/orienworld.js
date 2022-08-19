/* === VARIABLES === */

let buttonNav;
let planetList;
let closeList;
let slideNumber = 1;
let slideLeft;
let slideRight;

/* === FUNCTIONS === */

// GESTION DES SLIDERS

function carousel(x) {
    let slides = document.querySelectorAll('.slider-resume');

    // Disparition de la flèche pour reculer d'une slide lorsque la première slide est affichée
    if(slideNumber <=0) {
        for(let arrow of slideLeft) {
            arrow.style.display = "none";
        }
    }
    else {
        for(let arrow of slideLeft) {
            arrow.style.display = "block";
        }
    }

    // Disparition de la flèche pour avancer d'une slide lorsque la dernière slide est affichée
    if(slideNumber >=2) {
        for(let icon of slideRight) {
            icon.style.display = "none";
        }
    }
    else {
        for(let icon of slideRight) {
            icon.style.display = "block";
        }
    }

    // Affichage de la slide sélectionnée
    for(let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[x].style.display = "flex";
}

function slideToPrevious() {
    slideNumber -= 1;
    carousel(slideNumber);
}

function slideToNext() {
    slideNumber += 1;
    carousel(slideNumber);
}

function manageNavigation() {
    /* Masquer/afficher les flèches de navigation */

    // Au début de la lecture
    if($('#page-roman').attr('current_page') == 'couverture') {
        $('.novel-previous').addClass('d-none');
    }
    if($('#page-roman').attr('current_page') == 'prologue') {
        $('.novel-previous').removeClass('d-none');
    }
    // A la fin de la lecture
    if($('#page-roman').attr('current_page') == 'conclusion') {
        $('.novel-next').addClass('d-none');
    }
    if($('#page-roman').attr('current_page') == 'chapitre3') {
        $('.novel-next').removeClass('d-none');
    }
}


// GESTION DES MAPPEMONDES

function displayDetails(event) {
    // Appel de la fonction closeDetails pour éviter la superposition des modales
    closeDetails();
    // Affichage de la modale correspondant à la planète sélectionnée
    let selectDetails = document.querySelector('#' + this.alt + '-details');
    selectDetails.style.display = 'block';
    selectDetails.style.position = 'absolute';
    selectDetails.style.top = '40%';
    selectDetails.style.left = '30%';
}

function closeDetails() {
    let details = document.querySelectorAll('.planet-details');
    for (let detailDiv of details) {
        detailDiv.style.display = 'none';
    }
}


/* === MAIN CODE === */

document.addEventListener('DOMContentLoaded', function() {

    buttonNav = document.querySelectorAll('.novel-button');

    // Gestion des sliders pour la présentation des récits
    if(document.querySelector('.sliders-container')) {
        slideLeft = document.querySelectorAll('.slider-arrow-left');
        for (let arrow of slideLeft) {
            arrow.addEventListener('click', slideToPrevious);
        }

        slideRight = document.querySelectorAll('.slider-arrow-right');
        for (let icon of slideRight) {
            icon.addEventListener('click', slideToNext);
        }
        carousel(slideNumber);
    }

    // Affichage des modales sur la carte des planètes
    if(document.querySelector('#starmap')) {

        planetList = document.querySelectorAll('.starmap-planet');
        for(let planet of planetList) {
            planet.addEventListener('click', displayDetails);
        }

        closeList = document.querySelectorAll('.close-details');
        for(let cross of closeList) {
            cross.addEventListener('click', closeDetails);
        }
    }

    manageNavigation();

});
