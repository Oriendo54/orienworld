/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/orienworld.js ***!
  \************************************/
function _createForOfIteratorHelper(o, allowArrayLike) { var it = typeof Symbol !== "undefined" && o[Symbol.iterator] || o["@@iterator"]; if (!it) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = it.call(o); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

/* === VARIABLES === */
var buttonNav;
var planetList;
var closeList;
var slideNumber = 1;
var slideLeft;
var slideRight;
/* === FUNCTIONS === */
// GESTION DES SLIDERS

function carousel(x) {
  var slides = document.querySelectorAll('.slider-resume'); // Disparition de la flèche pour reculer d'une slide lorsque la première slide est affichée

  if (slideNumber <= 0) {
    var _iterator = _createForOfIteratorHelper(slideLeft),
        _step;

    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        var arrow = _step.value;
        arrow.style.display = "none";
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
  } else {
    var _iterator2 = _createForOfIteratorHelper(slideLeft),
        _step2;

    try {
      for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
        var _arrow = _step2.value;
        _arrow.style.display = "block";
      }
    } catch (err) {
      _iterator2.e(err);
    } finally {
      _iterator2.f();
    }
  } // Disparition de la flèche pour avancer d'une slide lorsque la dernière slide est affichée


  if (slideNumber >= 2) {
    var _iterator3 = _createForOfIteratorHelper(slideRight),
        _step3;

    try {
      for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
        var icon = _step3.value;
        icon.style.display = "none";
      }
    } catch (err) {
      _iterator3.e(err);
    } finally {
      _iterator3.f();
    }
  } else {
    var _iterator4 = _createForOfIteratorHelper(slideRight),
        _step4;

    try {
      for (_iterator4.s(); !(_step4 = _iterator4.n()).done;) {
        var _icon = _step4.value;
        _icon.style.display = "block";
      }
    } catch (err) {
      _iterator4.e(err);
    } finally {
      _iterator4.f();
    }
  } // Affichage de la slide sélectionnée


  for (var i = 0; i < slides.length; i++) {
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
  if ($('#page-roman').attr('current_page') == 'couverture') {
    $('.novel-previous').addClass('d-none');
  }

  if ($('#page-roman').attr('current_page') == 'prologue') {
    $('.novel-previous').removeClass('d-none');
  } // A la fin de la lecture


  if ($('#page-roman').attr('current_page') == 'conclusion') {
    $('.novel-next').addClass('d-none');
  }

  if ($('#page-roman').attr('current_page') == 'chapitre3') {
    $('.novel-next').removeClass('d-none');
  }
} // GESTION DES MAPPEMONDES


function displayDetails(event) {
  // Appel de la fonction closeDetails pour éviter la superposition des modales
  closeDetails(); // Affichage de la modale correspondant à la planète sélectionnée

  var selectDetails = document.querySelector('#' + this.alt + '-details');
  selectDetails.style.display = 'block';
  selectDetails.style.position = 'absolute';
  selectDetails.style.top = '40%';
  selectDetails.style.left = '30%';
}

function closeDetails() {
  var details = document.querySelectorAll('.planet-details');

  var _iterator5 = _createForOfIteratorHelper(details),
      _step5;

  try {
    for (_iterator5.s(); !(_step5 = _iterator5.n()).done;) {
      var detailDiv = _step5.value;
      detailDiv.style.display = 'none';
    }
  } catch (err) {
    _iterator5.e(err);
  } finally {
    _iterator5.f();
  }
}
/* === MAIN CODE === */


document.addEventListener('DOMContentLoaded', function () {
  buttonNav = document.querySelectorAll('.novel-button'); // Gestion des sliders pour la présentation des récits

  if (document.querySelector('.sliders-container')) {
    slideLeft = document.querySelectorAll('.slider-arrow-left');

    var _iterator6 = _createForOfIteratorHelper(slideLeft),
        _step6;

    try {
      for (_iterator6.s(); !(_step6 = _iterator6.n()).done;) {
        var arrow = _step6.value;
        arrow.addEventListener('click', slideToPrevious);
      }
    } catch (err) {
      _iterator6.e(err);
    } finally {
      _iterator6.f();
    }

    slideRight = document.querySelectorAll('.slider-arrow-right');

    var _iterator7 = _createForOfIteratorHelper(slideRight),
        _step7;

    try {
      for (_iterator7.s(); !(_step7 = _iterator7.n()).done;) {
        var icon = _step7.value;
        icon.addEventListener('click', slideToNext);
      }
    } catch (err) {
      _iterator7.e(err);
    } finally {
      _iterator7.f();
    }

    carousel(slideNumber);
  } // Affichage des modales sur la carte des planètes


  if (document.querySelector('#starmap')) {
    planetList = document.querySelectorAll('.starmap-planet');

    var _iterator8 = _createForOfIteratorHelper(planetList),
        _step8;

    try {
      for (_iterator8.s(); !(_step8 = _iterator8.n()).done;) {
        var planet = _step8.value;
        planet.addEventListener('click', displayDetails);
      }
    } catch (err) {
      _iterator8.e(err);
    } finally {
      _iterator8.f();
    }

    closeList = document.querySelectorAll('.close-details');

    var _iterator9 = _createForOfIteratorHelper(closeList),
        _step9;

    try {
      for (_iterator9.s(); !(_step9 = _iterator9.n()).done;) {
        var cross = _step9.value;
        cross.addEventListener('click', closeDetails);
      }
    } catch (err) {
      _iterator9.e(err);
    } finally {
      _iterator9.f();
    }
  }

  manageNavigation();
});
/******/ })()
;