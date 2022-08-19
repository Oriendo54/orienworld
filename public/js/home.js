/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/home.js ***!
  \******************************/
/* =========== VARIABLES ============ */
var aboutMe;
var medallion;
/* =========== FUNCTIONS ============ */

function displayAbout() {
  aboutMe.classList.toggle('about-appear');
}

function hideAbout() {
  aboutMe.classList.toggle('about-disappear');
}
/* =========== MAIN CODE ============ */


document.addEventListener('DOMContentLoaded', function () {
  aboutMe = document.querySelector('.hidden-about');
  medallion = document.querySelector('.display-about');
  medallion.addEventListener('mouseover', displayAbout);
  medallion.addEventListener('mouseleave', hideAbout);
});
/******/ })()
;