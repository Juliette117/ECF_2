<x-layout>
<h3>Watchlist</h3>
</x-layout>

<?php


try
{
    $bdd = new PDO("mysql:host=localhost;dbname=anime_ranking", "miyako", "D67Yg7sAb"); 
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->exec('SET NAMES utf8');
}
    catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
    } 


    if (isset($anime->id)) {

    
    $sql = "INSERT INTO watchlist(user_id, anime_id) 
          VALUES (  '".Auth::user()->id."' ,  '".$anime->id."')";

          try {
            $bdd->exec($sql); 
          }
            catch(PDOException $e) {
              echo "Erreur : " . "Cet anime est déjà dans votre watchlist";
            }

        };


        if (isset($bdd)) {

        $resp = $bdd->query("SELECT cover, title FROM watchlist INNER JOIN animes ON animes.id = watchlist.anime_id WHERE user_id = ".Auth::user()->id." ORDER by watchlist.id DESC ");

            while ($data = $resp->fetch())
        {

            echo nl2br('<div class="anime-list">' . "<img class style ='width:50%; margin:50px' src='/covers/".($data['cover'])."' />" . htmlspecialchars($data['title'])  . '</div> <br>');

            
                                                                                    
        }

} 

       


















