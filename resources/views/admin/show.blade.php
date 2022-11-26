@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card ">
                    <div class="card-header">{{ $curso->name }}</div>
                        <div class="mt-4 ms-3 justify-content-center">
                            <img style="width:150px; height:150px;" src="{{ $curso->imagem }}" alt="cursoimage">
                            <p>Nome: {{ $curso->name }}</p>
                            <p>Descrição Simples: {{ $curso->descrisimp }}</p>
                            <p>Descrição Completa:{{ $curso->descricomp }}</p>
                            <p>Mínimo de Alunos: {{ $curso->minalu }}</p>
                            <p>Máximos de Alunos: {{ $curso->maxalu }}</p>
                            @if($curso->status == 0)
                                <p>Status: Mínimo de alunos não atingido!</p>
                            @elseif ($curso->status == 2 || $curso->status == 3)
                                <p>Status: Matrículas Encerradas</p>
                            @else
                                <p>Status: Matrículas Abertas - Curso acontecerá! </p>
                            @endif
                            @if($professor != NULL)
                                <p>Professor: {{ $professor['name']}} </p>
                            @else
                                <p>Professor: Sem atribuição de professor até o momento!</P>
                            @endif
                            <p>
                            Media dos alunos:
                            @if ($media)
                                {{ number_format($media,2) }}
                                <p>Alunos aprovados: {{ $aprovado }}({{ number_format($aprovadop,2 ) }}%)</p>
                                <p>Alunos reprovados: {{ $reprovado }}({{ number_format($reprovadop,2 ) }}%)</p>
                            @else
                                Nenhuma nota atribuída
                            @endif
                            </p>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        $count = 0;
    @endphp
    <div class="d-flex justify-content-center mb-5">
    @if($curso->status != 3)
    <form action="/admin/show/close/{{ $curso->id }}">
        <button type="submit" class="btn btn-danger">Fechar matrículas</button>
    </form>
    @else
    <form action="/admin/show/open/{{ $curso->id }}">
        <button type="submit" class="btn btn-secondary">Cancelar fechamento</button>
    </form>
    @endif
</div>
<li class="nav-item dropdown d-flex justify-content-center my-2">
    <button id="navbarDropdown" class="nav-link dropdown-toggle "  role="button" data-bs-toggle="dropdown" aria-haspopup="true" >
        <span id="proftexto"></span>
    </button>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        @foreach ($professores as $prof)
        <button class="dropdown-item"  onclick="professores( '{{ $prof->id }}', '{{ $prof->name }}' )">
           {{ $prof->name}}
        </button>
        @endforeach
    </div>
</li>
<div class="d-flex justify-content-center">
    <form action="/admin/linkprof/attach">
     <input id="profid" style="display:none;" type="text" class="form-control @error('profid') is-invalid @enderror" name="profid" value="" required autocomplete="alunoid" >
     <input id="cursoid" style="display:none;" type="text" class="form-control @error('cursoid') is-invalid @enderror" name="cursoid" value="{{ $curso->id }}" required autocomplete="cursoid" >
    <button class="btn btn-primary mb-5">Atribuir professor</button>
</form>
</div>  
    <li class="nav-item dropdown d-flex justify-content-center my-2">
        <button id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-haspopup="true" >
            <span id="texto"></span>
        </button>
        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            @foreach ($users as $user)
                @php
                    $flag = 0;
                @endphp
                @foreach ($user->cursos as $cursoselect)
                    @if($cursoselect->id == $curso->id)
                        @php
                            $flag = 1;
                            $count = $count + 1;
                        @endphp
                    @endif      
                @endforeach
                
                @if($flag != 1)
                        <button class="dropdown-item"  onclick="alunos( '{{ $user->id  }}', '{{ $user->name }}' )">
                            {{ $user->name }}
                        </button>
                @endif
             @endforeach
        </div>

    </li>   
    <div class="d-flex justify-content-center">
            <form action="/admin/show/attachalu/{{ $curso->id }}">
             <input id="alunoid" style="display:none;" type="text" class="form-control @error('alunoid') is-invalid @enderror" name="alunoid" value="" required autocomplete="alunoid" autofocus>
             
            <button class="btn btn-primary mb-5">Matricular aluno</button>
        </form>
    </div>

    @if ($count != 0)
    <div class="container"><p class="mt-5 fw-bold fs-3"> Alunos({{$count }}):</p> </div>
    <table class="table container table-hover">
         
        <thead>
          <tr>
            <th scope="col">Nome</th>
            <th scope="col">Nota</th>
            <th scope="col">Ações</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            @foreach ($user->cursos as $cursoalu)
                <tr>
                @if($cursoalu->id == $curso->id)
                <th scope="row">{{ $user->name }}</th>
                    @foreach ($notas as $nota)
                        @if ($nota->user_id == $user->id && $nota->curso_id == $curso->id)
                            <td>{{ $nota->nota }}</td>
                        @endif
                    
                    @endforeach
                
                <td colspan="2">
                    <form action="/admin/show/dettachalu/{{ $cursoalu->id }}/{{ $user->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        Desmatricular
                    </button>
                    </form>
                </td>
              </tr>
            @endif 
        @endforeach
    @endforeach
    @else
    <p class="mt-5 fw-bold fs-3">Não há alunos nesse curso</p>
    @endif
    
    

    

    </tbody>
    </table>

    <script>
        texto = "Selecione um aluno"
        document.getElementById("texto").innerHTML = texto;
        document.getElementById("proftexto").innerHTML = "Selecione um professor";

        function alunos(alunoid,alunonome){
        document.getElementById("texto").innerHTML = alunonome;
        document.getElementById("alunoid").value = alunoid;

    }

    function professores(profid,profnome){
        document.getElementById("proftexto").innerHTML = profnome;
        document.getElementById("profid").value = profid;

    }
    </script>


@endsection