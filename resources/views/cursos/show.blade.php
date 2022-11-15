@extends('layouts.app')

@section('content')

<p>Nome: {{ $curso->name }}</p>
<p>Descrição Simples: {{ $curso->descrisimp }}</p>
<p>Descrição Completa:{{ $curso->descricomp }}</p>
<p>Mínimo de Alunos: {{ $curso->maxalu }}</p>
<p>Máximos de Alunos: {{ $curso->minalu }}</p>

<form action="/cursos/join/{{ $curso->id }}" method="POST">
    @csrf
    <a href="/cursos/join/{{ $curso->id }}"
        id="curso-submit" 
        onclick="curso.preventDefault();
        this.closest('form').submit();">
        Se matricular no curso
        </a>
</form>
@endsection