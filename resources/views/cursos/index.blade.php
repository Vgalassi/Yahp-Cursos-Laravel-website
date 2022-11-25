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
      <th scope="col">ID</th>
      <th scope="col">Curso</th>
      <th scope="col">Estado</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($cursos as $curso)
<tr>
      <th scope="row">{{ $curso->id }}</th>
      <td>{{ $curso->name }}</td>
      <td> @if (  $curso->status == 0)
        Matrículas abertas
        @endif
        @if (  $curso->status == 1)
        Mínimo de Alunos não Atingido
        @endif
        @if (  $curso->status == 2)
        Matrículas Fechadas
        @endif</td>
      <td>
        <form action="/cursos/{{ $curso->id }}">
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
