@extends('layouts.app')

@section('content')

@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<li class="nav-item dropdown d-flex justify-content-center my-2">
    <button id="navbarDropdown" class="nav-link dropdown-toggle "  role="button" data-bs-toggle="dropdown" aria-haspopup="true" >
        <span id="textoprof"></span>
    </button>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        @foreach ($users as $user)
        @if($user->perm == 1)
        <button class="dropdown-item"  onclick="profbutton( '{{ $user->name }}', ' {{ $user->id }}' )">
           {{ $user->name}}
        </button>
        @endif
        @endforeach

    </div>

</li>


<li class="nav-item dropdown d-flex justify-content-center my-2">
    <button id="navbarDropdown" class="nav-link dropdown-toggle "  role="button" data-bs-toggle="dropdown" aria-haspopup="true" >
        <span id="textocurso"></span>
    </button>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        @foreach ($cursos as $curso)
        @if($curso->user_id == NULL)
        <button class="dropdown-item"  onclick="cursobutton('{{ $curso->name }}', '{{ $curso->id}}')">
           {{ $curso->name}}
        </button>
        @endif
        @endforeach
    </div>
</li>

    <form action="/admin/linkprof/attach">
    <div class="row mb-3">
        <label for="profid" class="col-md-4 col-form-label text-md-end"></label>
        <div class="col-md-6">
            <input  id="profid" type="text" class="form-control @error('profid') is-invalid @enderror" name="profid" value="" required autocomplete="profid" autofocus>

            @error('profid')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="cursoid" class="col-md-4 col-form-label text-md-end"></label>
        <div class="col-md-6">
            <input  id="cursoid" type="text" class="form-control @error('cursoid') is-invalid @enderror" name="cursoid" value="" required autocomplete="cursoid" autofocus>

            @error('cursoid')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="d-flex justify-content-center">
    <button class ="btn btn-primary">Relacionar</button>
    </div>
    </form>


    <script>
        textoprof = 'Selecione um professor';
        textocurso = 'Selecione um curso';
        

    document.getElementById("textoprof").innerHTML = textoprof;
    document.getElementById("textocurso").innerHTML = textocurso;



    function profbutton(professornome,professorid){
        document.getElementById("textoprof").innerHTML = professornome;
        document.getElementById("profid").value = professorid;

    }

    function cursobutton(cursonome,cursoid){
        document.getElementById("textocurso").innerHTML = cursonome;
        document.getElementById("cursoid").value = cursoid;
    }

    </script>




@endsection