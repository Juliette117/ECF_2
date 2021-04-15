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
        foreach($animes as $anime){
        $moyenne = DB::select("SELECT ROUND(AVG(rating), 1) as note FROM review WHERE anime_id = $anime->id ")[0];
        $anime->moyenne = $moyenne->note;
        };
        return view('welcome', ['animes' => $animes]);
        
    }

    public function displayTop() {
        return view('top');
    }
    

    public function displayWatchlist($id){
        if(Auth::user()){
             // [0] = parce que le select renvoie un tableau
            $anime = DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];
            return view('watchlist', ["anime" => $anime]);
            } else {
              return view('login');
            }
    }
   
    public function displayFicheAnime($id){
        $anime = DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];
        $reviews = DB::select("SELECT comment, rating FROM review WHERE anime_id = $id ORDER BY ID DESC");
        // en orange = le nom que j'appelle dans la vue
        // en bleu = le nom de la variable dans le controller
        return view('anime', ["anime" => $anime, "Reviews" => $reviews]);

    }
    

    public function displayReviewForm($id){

      if(Auth::user()){
        $anime = DB::select("SELECT * FROM animes WHERE id = ?", [$id])[0];
        // ? = éviter les injections sql
        $query = DB::select("SELECT * FROM review WHERE user_id = ? AND anime_id = ? ", [ Auth::id(), $id]);    
        $reviewNumber = count($query);  
        return view('new_review', ["anime" => $anime, "reviewNumber" => $reviewNumber]);
      } else {
        return view('login');
      }
      
    }

  
    public function addReview(Request $request, $id){
    
     DB::insert("INSERT INTO review(comment, rating, user_id, anime_id) VALUES (?, ?, ?, ?)", [$request["review"], $request["rating"], Auth::id(), $id]);  
     
      return redirect()->route("displayFicheAnime", $id);
      
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




  

  

 
 
 
 
 
 
 
 
 
