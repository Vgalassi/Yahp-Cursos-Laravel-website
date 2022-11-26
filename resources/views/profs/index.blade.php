@extends('layouts.app')


@section('content')

@if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
@endif

@if(count($profcursos) == 0)
    <p class="mt-5 fw-bold fs-4 mb-5 ms-5">Você ainda não foi atribuído em nenhum curso</p>
@endif

@foreach ($profcursos as $profcurso)
<p class="title mt-5 ms-5">{{ $profcurso->name }}</p>
<table class="table container mt-3 table-hover">
    <thead class="table-success">
        <tr>
            
            <th scope="col">Nome do Aluno</th>
            <th scope="col">Nota</th>
        </tr>
    </thead>
    <tbody>

    @foreach ($alunos as $aluno)
        @foreach ($aluno->cursos as $cursoaluno)
            @if($cursoaluno->id == $profcurso->id)
            <tr>
                <th scope="row"><p>{{ $aluno->name }}</p></th>
                <td>
                    <form method="POST" action="/professor/notas/{{ $profcurso->id }}/{{ $aluno->id}}">
                        @csrf
                            @foreach ($notas as $nota)
                             @if($nota->user_id == $aluno->id && $nota->curso_id == $profcurso->id)
                                @php
                                    $notaaluno = $nota->nota;
                                @endphp 
                              @endif    
                            @endforeach
                            <label for="{{ $aluno->id }}" ></label>    
                                <input  id="{{ $aluno->id}}" type="text" value="{{ $notaaluno }}" name="{{ $aluno->id }}">
                                <button type="submit" class="btn btn-primary">Atribuir</button>
                            @php
                                $notaaluno = NULL;
                            @endphp 
                                
                    </form>         
                </td>
            </tr>
            @endif
        @endforeach
    @endforeach
    </tbody>
</table>
@endforeach


    



@endsection