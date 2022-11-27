@extends('layouts.app')


@section('content')


@if(count($profcursos) == 0)
    <p class="mt-5 fw-bold fs-4 mb-5 ms-5">Você ainda não foi atribuído em nenhum curso</p>
@else
@endif

<li class="nav-item dropdown d-flex justify-content-center my-2">
    <p class="mx-2 fs-2">Selecione o curso:</p>
    <button id="navbarDropdown" class="nav-link dropdown-toggle "  role="button" data-bs-toggle="dropdown" aria-haspopup="true" >
        <span id="texto"></span>
    </button>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        @foreach ($profcursos as $profcurso)
        <button class="dropdown-item"  onclick="cursos( '{{ $profcurso->id }}', '{{ $profcurso->name }}' )">
           {{ $profcurso->name}}
        </button>
        @endforeach
    </div>
</li>

@foreach ($profcursos as $profcurso)
<div  id="{{ $profcurso->id }}" style="display: none;">
<p class="title fs-3 mt-5 ms-5">{{ $profcurso->name }}</p>
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
</div>
@endforeach

<script>
    @if(session('ultimo'))
        document.getElementById("{{ session('ultimo') }}").style.display = "block";
        texto = "Selecione um curso";
        ultimo = "{{ session('ultimo') }}";
    @else
        texto = "{{ $profcurso->name }}";
        document.getElementById("{{ $profcurso->id }}").style.display = "block";
        ultimo = "{{ $profcurso->id }}";
    @endif
        document.getElementById("texto").innerHTML = texto;


    function cursos(id,nome){
        texto = nome;
        document.getElementById("texto").innerHTML = texto;
        document.getElementById(ultimo).style.display = "none";
        document.getElementById(id).style.display = "block";
        ultimo = id;

    }
</script>

    



@endsection