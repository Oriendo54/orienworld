
/* ============ VARIABLES ============= */

let mainMenu;
let sidebarContent;
let sidebarButton;
let sideBar;
let sidebarOverlay;


/* ============ FUNCTIONS ============= */

function displaySideBar() {
    sideBar.classList.toggle('sidebar-activate');
    sidebarOverlay.classList.toggle('overlay-activate');
}

function modalAfficher(view, id_modal = 1) {
    $('.modal[id_modal='+id_modal+']').html(view).modal({backdrop: 'static', keyboard: false, show: true});
}

function modalFermer(id_modal = 1) {
    $('.modal[id_modal='+id_modal+']').modal('hide');
}


/* ============ MAIN CODE ============= */

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialisation de la Sidebar et du Menu
        mainMenu = document.querySelector('.main-nav');
        sidebarContent = document.querySelector('.sidebar-body');
        sidebarButton = document.querySelector('.nav-ori');
        sideBar = document.querySelector('.main-nav-sidebar');
        sidebarOverlay = document.querySelector('.sidebar-overlay');
    
    // Intégration du menu à l'intérieur de la Sidebar pour l'affichage sur mobile
        sidebarContent.innerHTML = mainMenu.innerHTML;
    
    // Activation de la Sidebar
        sidebarButton.addEventListener('click', displaySideBar);
});
