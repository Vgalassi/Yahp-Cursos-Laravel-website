@extends('layouts.app')

@section('content')

<p>Nome: {{ $curso->name }}</p>
<p>Descrição Simples: {{ $curso->descrisimp }}</p>
<p>Descrição Completa:{{ $curso->descricomp }}</p>
<p>Mínimo de Alunos: {{ $curso->maxalu }}</p>
<p>Máximos de Alunos: {{ $curso->minalu }}</p>

<button> Se matricular no curso</button>
@endsection