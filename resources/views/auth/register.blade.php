@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif

<li class="nav-item dropdown d-flex justify-content-center my-2">
    <button id="navbarDropdown" class="nav-link dropdown-toggle "  role="button" data-bs-toggle="dropdown" aria-haspopup="true" >
        <span id="selecao"></span>
    </button>

    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <button class="dropdown-item"  onclick="alunos()">
            Alunos
        </button>

        <button class="dropdown-item"  onclick="professores()">
            Professores
        </button>
        <button class="dropdown-item"  onclick="cursos()">
            Cursos
        </button>
    </div>

</li>



<div class="container" style="display: none;" id="alunos">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dados do Aluno') }}</div>

                <div class="card-body">
                    <form method="POST" action="/admin/create/createalu">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nome Completo</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">Nome de Acesso</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Endereço de e-mail</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Senha') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="CPF" class="col-md-4 col-form-label text-md-end">CPF</label>

                            <div class="col-md-6">
                                <input id="CPF" oninput="mascara(this)" type="text" class="form-control @error('CPF') is-invalid @enderror" name="CPF" value="{{ old('CPF') }}" required autocomplete="CPF" autofocus>

                                @error('CPF')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="endereco" class="col-md-4 col-form-label text-md-end">Endereço</label>

                            <div class="col-md-6">
                                <input id="endereco" type="text" class="form-control @error('endereco') is-invalid @enderror" name="endereco" value="{{ old('endereco') }}" required autocomplete="name" autofocus>

                                @error('endereco')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="filme" class="col-md-4 col-form-label text-md-end">Filme Favorito</label>

                            <div class="col-md-6">
                                <input id="filme" type="text" class="form-control @error('filme') is-invalid @enderror" name="filme" value="{{ old('filme') }}" required autocomplete="name" autofocus>

                                @error('filme')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" onclick="submit1()">
                                    {{ __('Criar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="display: none;" id="professores">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dados do Professor') }}</div>
                    <li class="nav-item dropdown d-flex justify-content-center my-2">
                        <button id="navbarDropdown" class="nav-link dropdown-toggle"  role="button" data-bs-toggle="dropdown" aria-haspopup="true" >
                            <span id="texto"></span>
                        </button>
                
                        <div class="dropdown-menu dropdown-menu-end" role="button" aria-labelledby="navbarDropdown">
                            <button class="dropdown-item"  onclick="wise()">
                                Wise Tree
                            </button>
                        <button class="dropdown-item"  onclick="atumalaca()">
                            Atumalaca
                        </button>
                        <button class="dropdown-item"  onclick="messi()">
                            Messi
                        </button>
                        </div>
                    </li>
                    <div class="d-flex justify-content-center mt-2">    
                        <img  class="hide displayimage" src="/images/profavatar/atumalaca.jpg" alt="" id = "atumalaca">
                        <img  class="hide displayimage" src="/images/profavatar/wisetree.jpg" alt="" id = "wisetree">
                        <img  class="hide displayimage" src="/images/profavatar/messicareca.jpg" alt="" id = "messi">
                    </div>

                    <form method="POST" action="/admin/create/createprof">
                        @csrf
                        <div class="row mb-3">
                            <label for="profimagem" class="col-md-4 col-form-label text-md-end"></label>
                            <div class="col-md-6">
                                <input style="display:none;" id="profimagem" type="text" class="form-control @error('profimagem') is-invalid @enderror" name="profimagem" value="" required autocomplete="profimagem" autofocus>

                                @error('profimagem')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="profname" class="col-md-4 col-form-label text-md-end">Nome Completo</label>

                            <div class="col-md-6">
                                <input id="profname" type="text" class="form-control @error('name') is-invalid @enderror" name="profname" value="{{ old('profname') }}" required autocomplete="profname" autofocus>

                                @error('profname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username"  class="col-md-4 col-form-label text-md-end">Nome de Acesso</label>

                            <div class="col-md-6">
                                <input id="profusername" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Senha</label>

                            <div class="col-md-6">
                                <input id="profpassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirmar Senha') }}</label>

                            <div class="col-md-6">
                                <input id="profpassword-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="CPF" class="col-md-4 col-form-label text-md-end">CPF</label>

                            <div class="col-md-6">
                                <input id="profCPF" oninput="mascara(this)" type="text" class="form-control @error('CPF') is-invalid @enderror" name="CPF" value="{{ old('CPF') }}" required autocomplete="CPF" autofocus>

                                @error('CPF')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="profendereco" class="col-md-4 col-form-label text-md-end">Endereço</label>

                            <div class="col-md-6">
                                <input id="profendereco" type="text" class="form-control @error('endereco') is-invalid @enderror" name="profendereco" value="{{ old('profendereco') }}" required autocomplete="profendereco" autofocus>

                                @error('profendereco')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        
                        
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" onclick="submit2()">
                                    {{ __('Criar') }}
                                </button>
                            </div>
                        </div>
                    
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="display: none;" id="cursos">
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
                        <form method="POST" action="/admin/create/createcurso">
                            @csrf
                            <div class="d-flex justify-content-center mt-2">    
                                <img  class="hide displayimage" src="/images/cursoavatar/frontlogo.png" alt="" id = "frontend">
                                <img  class="hide displayimage" src="/images/cursoavatar/datalogo.png" alt="" id = "database">
                                <img  class="hide displayimage" src="/images/cursoavatar/laravellogo.png" alt="" id = "laravel">
                            </div>

                            <div class="row mb-3">
                                <label for="cursoimagem" class="col-md-4 col-form-label text-md-end"></label>
                                <div class="col-md-6">
                                    <input style="display:none;" id="cursoimagem" type="text" class="form-control @error('cursoimagem') is-invalid @enderror" name="cursoimagem" value="" required autocomplete="cursoimagem" autofocus>
    
                                    @error('cursoimagem')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row mb-3">
                                <label for="namecurso" class="col-md-4 col-form-label text-md-end">Nome do Curso:</label>
    
                                <div class="col-md-6">
                                    <input id="namecurso" type="text" class="form-control @error('namecurso') is-invalid @enderror" name="namecurso" value="{{ old('namecurso') }}" required autocomplete="namecurso" autofocus>
                                    @error('namecurso')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="descrisimp" class="col-md-4 col-form-label text-md-end">Descrição Simples:</label>
                                <div class="col-md-6">
                                    <input id="descrisimp" type="text" class="form-control @error('descrisimp') is-invalid @enderror" name="descrisimp" value="{{ old('descrisimp') }}" required autocomplete="descrisimp" autofocus>
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
                                    <textarea rows="10" id="descricomp" type="text" class="form-control @error('descricomp') is-invalid @enderror" name="descricomp" value="{{ old('descricomp') }}" required autocomplete="descricomp" autofocus></textarea>
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
                                    <input id="minalu" type="number" class="form-control @error('minalu') is-invalid @enderror" name="minalu" value="{{ old('minalu') }}" required autocomplete="namecurso" autofocus>
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
                                    <input id="maxalu" type="text" class="form-control @error('maxalu') is-invalid @enderror" name="maxalu" value="{{ old('maxalu') }}" required autocomplete="maxalu" autofocus>
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
                                        {{ __('Criar') }}
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
    var selecao = "Selecione o dado"
    var username;
    var cpf;
    document.getElementById("texto").innerHTML = texto;
    document.getElementById("textocurso").innerHTML = texto;
    document.getElementById("selecao").innerHTML = selecao;
    function mascara(i){
   
   var v = i.value;
   
   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que não seja número
      i.value = v.substring(0, v.length-1);
      return;
   }
   
   i.setAttribute("maxlength", "14");
   if (v.length == 3 || v.length == 7) i.value += ".";
   if (v.length == 11) i.value += "-";
  }

    function submit1(){
        

        document.getElementById("profusername").value = document.getElementById("username").value;
        document.getElementById("profcpf").value = document.getElementById("CPF").value;
        document.getElementById("profpassword").value = document.getElementById("password").value;
        document.getElementById("profpassword-confirm").value = document.getElementById("password-confirm").value;
    }

    function submit2(){
        document.getElementById("username").value = document.getElementById("profusername").value;
        document.getElementById("CPF").value = document.getElementById("profCPF").value;
        document.getElementById("password").value = document.getElementById("profpassword").value
        document.getElementById("password-confirm").value = document.getElementById("profpassword-confirm").value;
    }

    function alunos(){
        document.getElementById("professores").style.display = "none";
        document.getElementById("cursos").style.display = "none";
        document.getElementById("alunos").style.display = "block";
        selecao = "Alunos";
        document.getElementById("selecao").innerHTML = selecao;
    }

    function professores(){
        document.getElementById("alunos").style.display = "none";
        document.getElementById("cursos").style.display = "none";
        document.getElementById("professores").style.display = "block";
        selecao = "Professores";
        document.getElementById("selecao").innerHTML = selecao;
        
    }

    function cursos(){
        document.getElementById("alunos").style.display = "none";
        document.getElementById("professores").style.display = "none";
        document.getElementById("cursos").style.display = "block";
        selecao = "cursos";
        document.getElementById("selecao").innerHTML = selecao;
        
    }
    function atumalaca(){
        document.getElementById("wisetree").style.display = "none";
        document.getElementById("messi").style.display = "none";
        document.getElementById("atumalaca").style.display = "block";
        document.getElementById("profimagem").value = "/images/profavatar/atumalaca.jpg";
        texto = "Atumalaca";
        document.getElementById("texto").innerHTML = texto;
    }
    function wise(){
        document.getElementById("atumalaca").style.display = "none";
        document.getElementById("messi").style.display = "none";
        document.getElementById("wisetree").style.display = "block";
        document.getElementById("profimagem").value = "/images/profavatar/wisetree.jpg";
        texto = "Wise Tree";
        document.getElementById("texto").innerHTML = texto;
    }

    function messi(){
        document.getElementById("wisetree").style.display = "none";
        document.getElementById("atumalaca").style.display = "none";
        document.getElementById("messi").style.display = "block";
        document.getElementById("profimagem").value = "/images/profavatar/messicareca.jpg";
        texto = "Messi";
        document.getElementById("texto").innerHTML = texto;
    }

    function frontend(){
        document.getElementById("laravel").style.display = "none";
        document.getElementById("database").style.display = "none";
        document.getElementById("frontend").style.display = "block";
        document.getElementById("cursoimagem").value = "/images/cursoavatar/frontlogo.png";
        texto = "Front-end";
        document.getElementById("textocurso").innerHTML = texto;
    }

    function database(){
        document.getElementById("frontend").style.display = "none";
        document.getElementById("laravel").style.display = "none";
        document.getElementById("database").style.display = "block";
        document.getElementById("cursoimagem").value = "/images/cursoavatar/datalogo.png";
        texto = "Database";
        document.getElementById("textocurso").innerHTML = texto;
    }

    function laravel(){
        document.getElementById("frontend").style.display = "none";
        document.getElementById("database").style.display = "none";
        document.getElementById("laravel").style.display = "block";
        document.getElementById("cursoimagem").value = "/images/cursoavatar/laravellogo.png";
        texto = "Laravel";
        document.getElementById("textocurso").innerHTML = texto;
    }
</script>


@endsection

