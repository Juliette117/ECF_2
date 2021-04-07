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
    //$reponse = $bdd->query("SELECT ROUND(AVG(rating), 1) as note FROM review WHERE anime_id = '".$anime->id."' ");
      $reponse = $bdd->query("SELECT ROUND(AVG(rating), 1) as note FROM review ");
        while ($donnees = $reponse->fetch())
        {
         
          echo '<div><strong> La moyenne générale de l\'anime est de <div class="cta">' .  $donnees['note'] . '</div></div>' ;
          echo '<br>';
          echo '<br>';
        }
        ?>