@extends('layouts.app')

@section('content')
@if($user->perm == 1)
<img class="displayimage" src="{{ $user->imagem }}" alt="profile picture">
@endif
<p>Nome: {{ $user->name }}</p>
@if ($user->perm == 0)
<p>Email: {{ $user->email }}</p>
@endif 
<p>CPF:{{ $user->CPF }}</p>
<p>Endereço: {{ $user->endereco }}</p>
@if ($user->perm == 0)
<p>Filme: {{ $user->filme }}</p>
<a href="/home/edit/{{ $user->id}}">Editar Dados</a>
@else
<a href="/professor/edit/{{ $user->id }}">Editar Dados</a>
@endif 
<a href="/home/edit/password/{{ $user->id}}">Mudar senha</a>

@endsection