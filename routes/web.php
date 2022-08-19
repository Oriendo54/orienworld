<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// APPEL DES ROUTES DE FORTIFY POUR SECURISER LA CONNEXION A L'APPLICATION
require_once __DIR__ . '/fortify.php';

/* === LOGIN ET PERMISSIONS === */
Route::post('logout', 'Controller@logout')->name('logout');

/* ==== HOME, ABOUT, CONTACT ==== */

Route::get('/', 'HomeController@index')->name('index');
Route::get('about', 'HomeController@about')->name('about');
Route::get('aboutMe', 'HomeController@aboutMe')->name('aboutMe');
Route::get('contact', 'ContactController@contact')->name('contact');
Route::post('contactMe', 'ContactController@contactMe')->name('contactMe');

/* ==== PORTFOLIO ==== */

Route::get('portfolio', 'PortfolioController@portfolio')->name('portfolio');
Route::get('tictactoe', 'PortfolioController@tictactoe')->name('tictactoe');
Route::get('memory', 'PortfolioController@memory')->name('memory');
Route::get('pong', 'PortfolioController@pong')->name('pong');
Route::get('snake', 'PortfolioController@snake')->name('snake');
Route::get('skigame', 'PortfolioController@skigame')->name('skigame');
Route::get('cik', 'PortfolioController@cik')->name('cik');
Route::get('repertoire', 'PortfolioController@repertoire')->name('repertoire');
Route::get('agenda', 'PortfolioController@agenda')->name('agenda');
Route::get('todolist', 'PortfolioController@todolist')->name('todolist');
Route::get('shopping', 'PortfolioController@shoppingListe')->name('shopping');
Route::get('pof', 'PortfolioController@ponyOnFire')->name('pof');

// Route de test pour les protections
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


/* ==== ORIENWORLD ==== */

// Affichage des romans
Route::get('orienworld', 'TextController@orienworld')->name('orienworld');
Route::get('display-novel/{id_roman?}', 'TextController@displayNovel')->name('displayNovel');
Route::get('go-to-page', 'TextController@goToPage')->name('goToPage');
Route::get('starmap', 'TextController@starmap')->name('starmap');

// Commentaires
Route::post('add-comment', 'CommentaireController@addComment')->name('addComment');
Route::get('get-comments/{id_roman?}', 'CommentaireController@getComments')->name('getComments');
Route::get('delete-comment', 'CommentaireController@deleteComment')->name('deleteComment');
