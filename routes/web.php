<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Affiche la liste des animes
Route::get('/', [AnimeController::class, 'displayListAnime']); 

//Affiche le Top
Route::get('/top', [AnimeController::class, 'displayTop']);

//Affiche la watchlist
Route::get('/watchlist', [AnimeController::class, 'watchlist']);
Route::post('/anime/{id}/watchlist', [AnimeController::class, 'displayWatchlist']);

//Affiche la fiche de l'anime
Route::get('/anime/{id}', [AnimeController::class, 'displayFicheAnime']);

//Page pour ajouter un commentaire
Route::get('/anime/{id}/new_review', [AnimeController::class, 'addReview']);
Route::post('/anime/{id}/new_review', [AnimeController::class, 'addReview']);

//Page pour se connecter
Route::get('/login', [AnimeController::class, 'displayLogin']);
Route::post('/login', [AnimeController::class, 'toLogIn']);

//Page pour s'inscrire
Route::get('/signup', [AnimeController::class, 'displaySignup']);
Route::post('signup', [AnimeController::class, 'register']);

//Page pour se déconnecter
Route::post('signout', [AnimeController::class, 'signout']);


