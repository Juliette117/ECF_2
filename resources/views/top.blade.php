<x-layout>
<h3>Top</h3>
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
    
      $reponse = $bdd->query("SELECT ROUND(AVG(rating), 1) as note, title, cover FROM review INNER JOIN animes WHERE review.anime_id = animes.id GROUP BY anime_id ORDER by note DESC "); 
        while ($data = $reponse->fetch())
        {
        echo nl2br('<div class="cta">'  . htmlspecialchars($data['title']) . " - ".  htmlspecialchars($data['note']) . "  <img style ='width:25%;' src='/covers/".($data['cover'])."' /></div> <br>"); 
        }
