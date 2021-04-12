<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Review;


class AnimeController extends Controller
{
    public function displayListAnime() {
        $animes = DB::select("SELECT * FROM animes");
        return view('welcome', ['animes' => $animes]);
    }

    public function displayTop() {
        return view('top');
    }
    
    public function watchlist(){
        if(Auth::user()){
            return view('watchlist');
            } else {
              return view('login');
            }
    }

    public function displayWatchlist($id){
        if(Auth::user()){
            $anime = DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];
            return view('watchlist', ["anime" => $anime]);
            } else {
              return view('login');
            }
    }
   
    public function displayFicheAnime($id){
        $anime = DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];
        return view('anime', ["anime" => $anime]);
    }
    

    public function addReview(Request $request, $id){
      if(Auth::user()){
          $anime = DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];
          // $review = Review::find($id);
          // $review->comment = $request->input('comment');
          // $review->rating = $request->input('rating');
          // $review->user_id = Auth::id();
          // $review->anime_id = $id;
          // $review->save();
          
          return view('new_review', ["anime" => $anime]);
        } else {
          return view('login');
        }
  }

    public function displayLogin(){
        return view('login');
    }

    public function toLogIn(Request $request){
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
    }

    public function displaySignup(){
        return view('signup');
    }
    
    public function register(Request $request){

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
    }

    public function signout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    
    public function test()
      {

      }
      

}




  

  

 
 
 
 
 
 
 
 
 
