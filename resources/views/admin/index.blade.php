@extends('layouts.app')

@section('content')

<p>Página do admin</p>
<form action="/admin/create">
<button type="submit" class="btn btn-primary" href="/admin/create">Adicionar dados</button>
</form>

<table class="table">
  <thead>
    <tr>
      <th scope="col">Código</th>
      <th scope="col">Nome</th>
      <th scope="col">Deletar</th>
      <th scope="col">Editar</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($cursos as $curso)
</p><tr>
      <th scope="row">1</th>
      <td><p>{{ $curso->name }}</td>
       <td> <button type="button" class="btn btn-danger">Remover</button></td>
      <td><button type="button" class="btn btn-success">Editar</button></td>
    
      
    </tr>
@endforeach
    
  </tbody>
</table>
@foreach ($cursos as $curso)
<p>{{ $curso->name }}</p>
@endforeach
             


@foreach ($users as $user)
@if ($user->perm == 0)
<p>Nome: {{ $user->name }}</p>
@endif
@endforeach
     


@foreach ($users as $user)
@if ($user->perm == 1)
<p>Nome: {{ $user->name }}</p>
 @endif
 @endforeach
                  

@endsection