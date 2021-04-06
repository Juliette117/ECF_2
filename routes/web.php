<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\New_;

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

Route::get('/', function () {
  $animes = DB::select("SELECT * FROM animes");
  return view('welcome', ["animes" => $animes]);
});

Route::get('/top', function(){
  return view('top');
});

Route::get('/watchlist', function(){
  return view('watchlist');
});


Route::post('/anime/{id}add_to_watch_list', function ($id) {
  if(Auth::user()){
    $anime = DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];
    return view('add_to_watch_list', ["anime" => $anime]);
  } else {
    return view('login');
  }
});

  Route::get('/anime/{id}/add_to_watch_list', function ($id) {
    if(Auth::user()){
      $anime = DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];
      return view('add_to_watch_list', ["anime" => $anime]);
    } else {
      return view('login');
    }
});

Route::get('/anime/{id}', function ($id) {
  $anime = DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];
  return view('anime', ["anime" => $anime]);
});

Route::post('/anime/{id}/new_review', function ($id) {
  if(Auth::user()){
    $anime = DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];
    return view('new_review', ["anime" => $anime]);
  } else {
    return view('login');
  }
});

  Route::get('/anime/{id}/new_review', function ($id) {
    if(Auth::user()){
      $anime = DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];
      return view('new_review', ["anime" => $anime]);
    } else {
      return view('login');
    }
});

Route::get('/login', function () {
  return view('login');
});

Route::post('/login', function (Request $request) {
  $validated = $request->validate([
    "username" => "required",
    "password" => "required",
  ]);
  if (Auth::attempt($validated)) {
    return redirect()->intended('/');
  }
  return back()->withErrors([
    'username' => 'The provided credentials do not match our records.',
  ]);
});

Route::get('/signup', function () {
  return view('signup');
});

Route::post('signup', function (Request $request) {
  $validated = $request->validate([
    "username" => "required",
    "password" => "required",
    "password_confirmation" => "required|same:password"
  ]);
  $user = new User();
  $user->username = $validated["username"];
  $user->password = Hash::make($validated["password"]);
  $user->save();
  Auth::login($user);

  return redirect('/');
});

Route::post('signout', function (Request $request) {
  Auth::logout();
  $request->session()->invalidate();
  $request->session()->regenerateToken();
  return redirect('/');
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
