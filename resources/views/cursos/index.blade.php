@extends('layouts.app')


@section('content')

<form action="/cursos" method="GET">
    <input type="text" id="search" name="search" class="form-control" placeholder="Procure um curso">
</form>

@if ($search)
    <p>Exibindo resultados de: {{ $search}} </p>
@endif

@if (count($cursos) == 0 && $search)
    <p>Nenhum curso encontrado</p>
    @elseif (count($cursos) == 0)
    <p>Não tem curso</p>
@endif


@foreach ($cursos as $curso)
    <p>
        Nome: {{ $curso->name }} 
        @if (  $curso->status == 0)
        Status: Matrículas abertas
        @endif
        @if (  $curso->status == 1)
        Status: Mínimo de Alunos não Atingido
        @endif
        @if (  $curso->status == 2)
        Status: Matrículas Fechadas
        @endif
        <a href="/cursos/{{ $curso->id }}">Saiba mais</a>
    </p>

@endforeach

@endsection
