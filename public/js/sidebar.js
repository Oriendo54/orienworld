/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/sidebar.js ***!
  \*********************************/
/* ============ VARIABLES ============= */
var mainMenu;
var sidebarContent;
var sidebarButton;
var sideBar;
var sidebarOverlay;
/* ============ FUNCTIONS ============= */

function displaySideBar() {
  sideBar.classList.toggle('sidebar-activate');
  sidebarOverlay.classList.toggle('overlay-activate');
}

function modalAfficher(view) {
  var id_modal = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 1;
  $('.modal[id_modal=' + id_modal + ']').html(view).modal({
    backdrop: 'static',
    keyboard: false,
    show: true
  });
}

function modalFermer() {
  var id_modal = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 1;
  $('.modal[id_modal=' + id_modal + ']').modal('hide');
}
/* ============ MAIN CODE ============= */


document.addEventListener('DOMContentLoaded', function () {
  // Initialisation de la Sidebar et du Menu
  mainMenu = document.querySelector('.main-nav');
  sidebarContent = document.querySelector('.sidebar-body');
  sidebarButton = document.querySelector('.nav-ori');
  sideBar = document.querySelector('.main-nav-sidebar');
  sidebarOverlay = document.querySelector('.sidebar-overlay'); // Intégration du menu à l'intérieur de la Sidebar pour l'affichage sur mobile

  sidebarContent.innerHTML = mainMenu.innerHTML; // Activation de la Sidebar

  sidebarButton.addEventListener('click', displaySideBar);
});
/******/ })()
;