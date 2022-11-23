@extends('layouts.app')

@section('content')
<div style="text-align: center;" class="container">
  <h1>Página do admin</h1>
  <div class="btn-group mt-3">
<form action="/admin/create">
    <button type="submit" class="btn btn-primary ms-5">Adicionar dados</button>
</form>
<form action="/admin/linkprof">
    <button type="submit" class="btn btn-primary ms-5">Relacionar professor-matéria</button>
</form>
</div>
</div>

<table class="table container mt-3 table-hover">
  <thead class="table-success">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Curso</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($cursos as $curso)
<tr>
      <th scope="row">{{ $curso->id }}</th>
      <td>{{ $curso->name }}</td>
      <td>
        <button type="button" class="btn btn-sm btn-info">
            <img src="/images/info-icon.png" alt="Info" class="icons rounded mx-auto d-block">
        </button> 
        <button type="button" class="btn btn-sm btn-success">
            <img src="/images/edit-icon.png" alt="Editar" class="icons rounded mx-auto d-block">
        </button>
        <button type="button" class="btn btn-sm btn-danger">
            <img src="/images/bin-icon.png" alt="Remover" class="icons rounded mx-auto d-block">
        </button>
      </td>
    
      
    </tr>
    @endforeach
    
  </tbody>

  <thead class="table-primary">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Professor</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
    @if ($user->perm == 1)
    <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>
            <button type="button" class="btn btn-sm btn-info">
                <img src="/images/info-icon.png" alt="Info" class="icons rounded mx-auto d-block">
            </button>
            <button type="button" class="btn btn-sm btn-success">
                <img src="/images/edit-icon.png" alt="Editar" class="icons rounded mx-auto d-block">
            </button>
            <button type="button" class="btn btn-sm btn-danger">
                <img src="/images/bin-icon.png" alt="Remover" class="icons rounded mx-auto d-block">
            </button>
            
        </td>

    </tr>
    @endif
    @endforeach
    </tbody> 

  <thead class="table-warning">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Aluno</th>
            <th scope="col">Ações</th>
        </tr>
  </thead>
    <tbody>
    @foreach ($users as $user)
    @if ($user->perm == 0)
    <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>
            <button type="button" class="btn btn-sm btn-info">
                <img src="/images/info-icon.png" alt="Info" class="icons rounded mx-auto d-block">
            </button>
            <button type="button" class="btn btn-sm btn-success">
                <img src="/images/edit-icon.png" alt="Editar" class="icons rounded mx-auto d-block">
            </button>
            <button type="button" class="btn btn-sm btn-danger">
                <img src="/images/bin-icon.png" alt="Remover" class="icons rounded mx-auto d-block ">
            </button>
            
        </td>

    </tr>
    @endif
    @endforeach
    </tbody>
     
</table>
    
     
@endsection