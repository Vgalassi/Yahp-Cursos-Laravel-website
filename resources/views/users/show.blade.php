@extends('layouts.app')

@section('content')

<p>Nome: {{ $user->name }}</p>
<p>Email: {{ $user->email }}</p>
<p>CPF:{{ $user->CPF }}</p>
<p>Endereço: {{ $user->endereco }}</p>
<p>Filme: {{ $user->filme }}</p>

<a href="/home/edit/{{ $user->id}}">Editar</a>
@endsection