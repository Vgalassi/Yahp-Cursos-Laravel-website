@extends('layouts.app')


@section('content')

@if (count($cursos) == 0)
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
