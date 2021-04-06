<x-layout>
  <x-slot name="title">
    Nouvelle critique de {{ $anime->title }}
  </x-slot>

  <h1>Nouvelle Critique de {{ $anime->title }}</h1>
</x-layout>


<form action="" method="POST">
@csrf
<label for="review">Écrire une critique :</label>
<textarea class="cta" id="review" name="review"
          rows="5" cols="30" required></textarea>

<label for="rating">Note</label>
 <input class= "cta " type="number" id="rating" name="rating"
       min="0" max="10" required>
 <button class="cta" type="submit">Noter</button> 
</form>

<?php

use Illuminate\Support\Facades\Auth;

try
{
    $bdd = new PDO("mysql:host=localhost;dbname=anime_ranking", "miyako", "D67Yg7sAb"); 
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->exec('SET NAMES utf8');
}
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
    } 

    if (isset($_POST['review'])) {
      //addslash = convertit "'" en string
      $review =  addslashes($_POST['review']);
    
    if (isset($_POST['rating'])) {
      $rating =  addslashes($_POST['rating']);
    
    if (Auth::check()){
      $userId = Auth::id();
    }
    

  $sql = "INSERT INTO review(comment, rating, user_id, anime_id)
          VALUES ('".$review."', '".$rating."' , '".$userId."' ,  '".$anime->id."')";  
        

          try {
            $bdd->exec($sql); 
          }
        
            catch(PDOException $e){
              echo "Erreur : " . $e->getMessage();
            }
          }
        }
  
            if (isset($bdd)) {
              //Affiche commnetaires et notes
              // DESC = ordre décroissant 
              $resp = $bdd->query("SELECT comment, rating FROM review WHERE anime_id ORDER BY ID DESC");
            
                while ($data = $resp->fetch())
            {
                echo '<br>';
                echo nl2br('<div class="cta">' . 'Commentaire:' . htmlspecialchars($data['comment']) . '<br>' . '</div>');
                echo nl2br('<div class="cta">' .  ' Note:' . htmlspecialchars($data['rating']) . ' / 10 ' . '</div>' . '<br>');
                
            }
              }  

  

?>





