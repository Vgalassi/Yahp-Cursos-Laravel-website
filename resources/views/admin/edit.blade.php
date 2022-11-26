@extends('layouts.app')

@section('content')


<div class="container" >
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dados do Curso') }}</div>
                    <div class="card-body">
                        <li class="nav-item dropdown d-flex justify-content-center my-2">
                            <button id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-haspopup="true" >
                                <span id="textocurso"></span>
                            </button>
                    
                            <div class="dropdown-menu dropdown-menu-end" role="button" aria-labelledby="navbarDropdown">
                                <button class="dropdown-item"  onclick="frontend()">                                   
                                    Front-end
                                </button>
                            <button class="dropdown-item"  onclick="database()">
                                    Database
                            </button>
                            <button class="dropdown-item"  onclick="laravel()">
                                    Laravel
                            </button>
                            </div>
                        </li>
                        <form method="POST" action="/admin/updatecurso/{{ $curso->id }} ">
                            @csrf
                            @method('put')
                            
                            <div class="d-flex justify-content-center mt-2"> 
                                <img class="displayimage" src="{{ $curso->imagem }}" alt="" id = "main">      
                                <img  class="hide displayimage" src="/images/cursoavatar/frontlogo.png" alt="" id = "frontend">
                                <img  class="hide displayimage" src="/images/cursoavatar/datalogo.png" alt="" id = "database">
                                <img  class="hide displayimage" src="/images/cursoavatar/laravellogo.png" alt="" id = "laravel">
                            </div>

                            <div class="row mb-3">
                                <label for="imagem" class="col-md-4 col-form-label text-md-end"></label>
                                <div class="col-md-6">
                                    <input style="display:none;" id="imagem" type="text" class="form-control @error('imagem') is-invalid @enderror" name="imagem" value="{{ $curso->imagem }}" required autocomplete="imagem" autofocus>
    
                                    @error('imagem')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Nome do Curso:</label>
    
                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $curso->name }}" required autocomplete="name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="descrisimp" class="col-md-4 col-form-label text-md-end">Descrição Simples:</label>
                                <div class="col-md-6">
                                    <input id="descrisimp" type="text" class="form-control @error('descrisimp') is-invalid @enderror" name="descrisimp" value="{{ $curso->descrisimp }}" required autocomplete="descrisimp" autofocus>
                                    @error('descrisimp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="descricomp" class="col-md-4 col-form-label text-md-end">Descrição Detalhada:</label>
                                <div class="col-md-6">
                                    <textarea rows="10" id="descricomp" type="text" class="form-control @error('descricomp') is-invalid @enderror" name="descricomp"  required autocomplete="descricomp" autofocus>{{ $curso->descricomp }}</textarea>
                                    @error('descricomp')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="descricomp" class="col-md-4 col-form-label text-md-end">Mínimo de Alunos:</label>
                                <div class="col-md-6">
                                    <input id="minalu" type="number" class="form-control @error('minalu') is-invalid @enderror" name="minalu" value="{{ $curso->minalu }}" required autocomplete="name" autofocus>
                                    @error('minalu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="maxalu" class="col-md-4 col-form-label text-md-end">Màximo de Alunos:</label>
                                <div class="col-md-6">
                                    <input id="maxalu" type="text" class="form-control @error('maxalu') is-invalid @enderror" name="maxalu" value=" {{ $curso->maxalu }}" required autocomplete="maxalu" autofocus>
                                    @error('maxalu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Editar') }}
                                    </button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        var texto = "Selecione uma imagem"
        document.getElementById("textocurso").innerHTML = texto;

     function frontend(){
        document.getElementById("main").style.display = "none";
        document.getElementById("laravel").style.display = "none";
        document.getElementById("database").style.display = "none";
        document.getElementById("frontend").style.display = "block";
        document.getElementById("imagem").value = "/images/cursoavatar/frontlogo.png";
        texto = "Front-end";
        document.getElementById("textocurso").innerHTML = texto;
    }

    function database(){
        document.getElementById("main").style.display = "none";
        document.getElementById("frontend").style.display = "none";
        document.getElementById("laravel").style.display = "none";
        document.getElementById("database").style.display = "block";
        document.getElementById("imagem").value = "/images/cursoavatar/datalogo.png";
        texto = "Database";
        document.getElementById("textocurso").innerHTML = texto;
    }

    function laravel(){
        document.getElementById("main").style.display = "none";
        document.getElementById("frontend").style.display = "none";
        document.getElementById("database").style.display = "none";
        document.getElementById("laravel").style.display = "block";
        document.getElementById("imagem").value = "/images/cursoavatar/laravellogo.png";
        texto = "Laravel";
        document.getElementById("textocurso").innerHTML = texto;
    }
    
</script>



@endsection