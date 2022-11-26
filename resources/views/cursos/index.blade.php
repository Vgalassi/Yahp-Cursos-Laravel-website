@extends('layouts.app')


@section('content')
<div class="container">
<form action="/cursos" method="GET">
<div class="input-group mb-3 w-25">
    <input type="text" id="search" name="search" class="form-control" placeholder="Procure um curso">
</div>
</form>

@if ($search)
    <p>Exibindo resultados de: {{ $search}} </p>
@endif

@if (count($cursos) == 0 && $search)
    <p>Nenhum curso encontrado</p>
    @elseif (count($cursos) == 0)
    <p>Não tem curso</p>
@endif
</div>
<table class="table container mt-3 table-hover">
  <thead class="table-success">
    <tr>
      <th scope="col">Curso</th>
      <th scope="col">Descrição</th>
      <th scope="col">Estado</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($cursos as $curso)
<tr>
      <th scope="row">{{ $curso->name }}</th>
      <td>{{ $curso->descrisimp }}</td>
      <td> @if($curso->status == 0)
          <p>Mínimo de alunos não atingido!</p>
        @elseif ($curso->status == 2 || $curso->status == 3)
          <p>Matrículas Encerradas</p>
        @else
          <p>Matrículas Abertas - Curso acontecerá! </p>
        @endif</td>
        <td>
        <form action="/cursos/{{ $curso->id }} ">
        <button type="submit" class="btn btn-sm btn-info">
            <img src="/images/info-icon.png" alt="Info" class="icons rounded mx-auto d-block">
        </button> 
        </form>
      </td>
    
      
    </tr>
    @endforeach
    
  </tbody>

</table>
@endsection