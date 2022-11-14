@extends('layouts.app')

@section('content')

<p>Nome: {{ Auth::user()->name }}</p>
<p>Email: {{ Auth::user()->email }}</p>
<p>CPF:{{ Auth::user()->CPF }}</p>
<p>Endereço: {{ Auth::user()->endereco }}</p>
<p>Filme: {{ Auth::user()->filme }}</p>

<button> Editar perfil</button>
@endsection