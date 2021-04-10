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

Route::get('/', [AnimeController::class, 'displayListAnime']); 

Route::get('/top', [AnimeController::class, 'displayTop']);

Route::get('/watchlist', [AnimeController::class, 'watchlist']);
Route::post('/anime/{id}/watchlist', [AnimeController::class, 'displayWatchlist']);

Route::get('/anime/{id}', [AnimeController::class, 'displayFicheAnime']);


Route::get('/anime/{id}/new_review', [AnimeController::class, 'addReview']);
Route::post('/anime/{id}/new_review', [AnimeController::class, 'addReview']);


Route::get('/login', [AnimeController::class, 'displayLogin']);
Route::post('/login', [AnimeController::class, 'toLogIn']);


Route::get('/signup', [AnimeController::class, 'displaySignup']);
Route::post('signup', [AnimeController::class, 'register']);

Route::post('signout', [AnimeController::class, 'signout']);


