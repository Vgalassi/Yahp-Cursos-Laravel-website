@extends('layouts.app')

@section('content')
<ul class="list-group list-group-flush">
    <img style="width:150px; height:150px;" src="{{ $curso->imagem }}" alt="cursoimage">
    <p>Nome: {{ $curso->name }}</p>
    <p>Descrição Simples: {{ $curso->descrisimp }}</p>
    <p>Descrição Completa:{{ $curso->descricomp }}</p>
    <p>Mínimo de Alunos: {{ $curso->maxalu }}</p>
    <p>Máximos de Alunos: {{ $curso->minalu }}</p>
    @if($professor != NULL)
    <p>Professor: {{ $professor['name']}} </p>
    @endif


<img style="width:150px; height:150px;" src="{{ $curso->imagem }}" alt="cursoimage">
<p>Nome: {{ $curso->name }}</p>
<p>Descrição Simples: {{ $curso->descrisimp }}</p>
<p>Descrição Completa:{{ $curso->descricomp }}</p>
<p>Mínimo de Alunos: {{ $curso->maxalu }}</p>
<p>Máximos de Alunos: {{ $curso->minalu }}</p>
@if($professor != NULL)

<p>Professor: {{ $professor->name}} </p>


@endif


@if (!$usuarioentrou)
<form action="/cursos/join/{{ $curso->id }}" method="POST">
    @csrf
    <a href="/cursos/join/{{ $curso->id }}"
        id="curso-submit" 
        onclick="curso.preventDefault();
        this.closest('form').submit();">
        Se matricular no curso
        </a>
</form>
@else
<p>Você já está no curso</p>

@endif
@endsection