@extends('layouts.app')

@section('content')
<ul class="list-group list-group-flush">
    <img style="width:150px; height:150px;" src="{{ $curso->imagem }}" alt="cursoimage">
    <p>{{ $curso->name }}</p>
    <p>{{ $curso->descrisimp }}</p>
    <p>{{ $curso->descricomp }}</p>
    @if($curso->status == 0)
        <p>Status: Mínimo de alunos não atingido!</p>
    @elseif ($curso->status == 2 || $curso->status == 3)
        <p>Status: Matrículas Encerradas</p>
    @else
        <p>Status: Matrículas Abertas - Curso acontecerá! </p>
    @endif
    <p>Mínimo de Alunos: {{ $curso->maxalu }}</p>
    <p>Máximos de Alunos: {{ $curso->minalu }}</p>
    @if($professor != NULL)
    <p>Professor: {{ $professor['name']}} </p>
    @else
    <P>Professor: Sem atribuição de professor até o momento!</P>
    @endif





@if (!$usuarioentrou)
@if($curso->status != 2 && $curso->status != 3)
<form action="/cursos/join/{{ $curso->id }}" method="POST">
    @csrf
    <a href="/cursos/join/{{ $curso->id }}"
        id="curso-submit" 
        onclick="curso.preventDefault();
        this.closest('form').submit();">
        Se matricular no curso
        </a>
</form>
@endif
@else
<p>Você já está no curso</p>

@endif
@endsection