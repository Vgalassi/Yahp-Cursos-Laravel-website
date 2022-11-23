@extends('layouts.app')

@section('content')

<p>Página do admin</p>
<form action="/admin/create">
<button type="submit" class="btn btn-primary" ">Adicionar dados</button>
</form>

<form action="/admin/linkprof">
    <button type="submit" class="btn btn-primary" >Relacionar professor-matéria</button>
</form>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cursos:</div>
                    <div class="row my-3 justify-content-left">
                        @foreach ($cursos as $curso)
                            <p>Nome: {{ $curso->name }}</p>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Alunos:</div>
                    <div class="row my-3 justify-content-left">
                        @foreach ($users as $user)
                            @if ($user->perm == 0)
                            <p>Nome: {{ $user->name }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Professores:</div>
                    <div class="row my-3 justify-content-left">
                        @foreach ($users as $user)
                            @if ($user->perm == 1)
                                <p>Nome: {{ $user->name }}</p>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection