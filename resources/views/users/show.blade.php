@extends('layouts.app')

@section('content')

<div class="card" style="width: 25rem;">
@if($user->perm == 1)
<img style="width:150px; height:150px;"class="displayimage" src="{{ $user->imagem }}" alt="profile picture">
@endif
  <div class="card-body"><ul class="list-group list-group-flush">
    <h5 class="card-title">{{ $user->name }}</h5>
@if ($user->perm == 0)
    <p class="card-text">Email: {{ $user->email }}</p>
@endif 
    <p class="card-text">CPF:{{ $user->CPF }}</p>
    <p class="card-text">Endereço: {{ $user->endereco }}</p>
@if ($user->perm == 0)
<p class="card-text">Filme: {{ $user->filme }}</p>
<a href="/home/edit/{{ $user->id}}">Editar Dados</a>
<a href="/home/edit/password/{{ $user->id}}">Mudar senha</a>
@else
<a href="/professor/edit/{{ $user->id }}">Editar Dados</a>
<a href="/professor/edit/password/{{ $user->id}}">Mudar senha</a>
@endif 

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
