<x-layout>
  <x-slot name="title">
    {{ $anime->title }}
  </x-slot>

  <article class="anime">
    <header class="anime--header">
      <div>
        <img alt="" src="/covers/{{ $anime->cover }}" />
      </div>
      <h1>{{ $anime->title }}</h1>
      </header>
  
    <p>{{ $anime->description }}</p>
    <br>
    <div>
      <div class="actions">
        <div>
          <a class="cta" href="/anime/{{ $anime->id }}/displayReviewForm">Écrire une critique</a>
        </div>
        <form action="/anime/{{$anime->id}}/watchlist" method="POST">
        @csrf
          <button class="cta">Ajouter à ma watchlist</button>
        </form>
      </div>
    </div>
  </article>
</x-layout>
<div class="reviewsContainer cta">
  <p class= "cta">Commentaires :</p>
  <ul>
    @foreach ($Reviews as $review)
      <br>
        <li>{{$review->comment}} - {{$review->rating}}/10</li>
    @endforeach
  </ul>
</div>