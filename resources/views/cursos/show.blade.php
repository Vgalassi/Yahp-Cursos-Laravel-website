@extends('layouts.app')

@section('content')
<div class="container justify-content-center">
<div class="col-40">
  
<div class="card" style="width: 18rem;">
  <img style="width:150px; height:150px;" src="{{ $curso->imagem }}" alt="cursoimage">
  <div class="card-body"><ul class="list-group list-group-flush">
    <h5 class="card-title">{{ $curso->name }}</h5>
    <p class="card-text">{{ $curso->descrisimp }}</p>
    <p class="card-text">{{ $curso->descricomp }}</p>

    <p class="card-text">Mínimo de Alunos: {{ $curso->maxalu }}</p>
    <p class="card-text">Máximos de Alunos: {{ $curso->minalu }}</p>
    @if($professor != NULL)
    <p class="card-text">Professor: {{ $professor['name']}} </p>
    @endif    
@if (!$usuarioentrou)
    <form action="/cursos/join/{{ $curso->id }}" method="POST">
        @csrf
        <a class="btn" href="/cursos/join/{{ $curso->id }}"
            id="curso-submit" 
            onclick="curso.preventDefault();
            this.closest('form').submit();">
            Se matricular no curso
            </a>
    </form>
    @else
    <p>Você já está no curso</p>
</ul>

@endif
  </div>
</div>
</div>  
<style>.card {
  margin-top: 2em;
  padding: 1.5em 0.5em 0.5em;
  border-radius: 2em;
  text-align: center;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}
.card img {
  width: 65%;
  
  margin: 0 auto;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
.card .card-title {
  font-weight: 700;
  font-size: 1.5em;
}
.card .btn {
  border-radius: 2em;
  background-color: teal;
  color: #ffffff;
  padding: 0.5em 1.5em;
}
.card .btn:hover {
  background-color: rgba(0, 128, 128, 0.7);
  color: #ffffff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}</style>


@endsection
