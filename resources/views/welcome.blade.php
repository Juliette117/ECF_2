<x-layout>
  <ul role="list" class="anime-list">
    @foreach($animes as $anime)
      <li class="flow">
        <div class="flow">
          <div>
            <img alt="" src="/covers/{{ $anime->cover }}" />
          </div>
          <h2>
            {{ $anime->title }}
          </h2>  
        <div class="cta">{{ $anime->moyenne }}</div>
      </div>
        <a class="cta" href="/anime/{{ $anime->id }}">Voir</a>
      
      </li>
    @endforeach
  </ul>
</x-layout>


























<?php 

// try
// {
    // $bdd = new PDO("mysql:host=localhost;dbname=anime_ranking", "miyako", "D67Yg7sAb"); 
    // $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // $bdd->exec('SET NAMES utf8');
// }
    // catch(PDOException $e){
      // echo "Erreur : " . $e->getMessage();
    // } 
      // $resp = $bdd->query("SELECT ROUND(AVG(rating), 1) as note FROM review WHERE anime_id = '".$anime->id."' ");
        // while ($data = $resp->fetch())
        // {
        
          // echo '<div class="cta">' . $data['note'] . '</div>' ;
        // }
        // ?>



































