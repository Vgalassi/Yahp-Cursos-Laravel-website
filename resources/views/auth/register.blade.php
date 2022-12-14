@extends('layouts.app')

@section('content')


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
                            <label for="email" class="col-md-4 col-form-label text-md-end">Endere??o de e-mail</label>

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
                            <div class="row "> 
                            <label for="cep" class="col-md-4 col-form-label text-md-end">Cep</label>

                            <div class="col-md-6">
                                <input name="cep" type="text" id="cep" value="" size="10" maxlength="9" class="form-control @error('cep') is-invalid @enderror" required autocomplete="name" autofocus
                                onblur="pesquisacep(this.value);" /></label><br />
                            </div>
                        </div>

                            <div class="row ">
                            <label for="rua" class="col-md-4 col-form-label text-md-end">Rua</label>

                            <div class="col-md-6">
                                <input name="rua" type="text" id="rua" value="" size="10" maxlength="9" class="form-control @error('rua') is-invalid @enderror" required autocomplete="name" autofocus/></label><br />
                            </div>
                        </div>

                            <div class="row ">
                            <label for="bairro" class="col-md-4 col-form-label text-md-end">Bairro</label>

                            <div class="col-md-6">
                                <input name="bairro" type="text" id="bairro" value="" size="10" maxlength="9" class="form-control @error('bairro') is-invalid @enderror" required autocomplete="name" autofocus/></label><br />
                            </div>
                        </div>

                            <div class="row ">
                            <label for="cidade" class="col-md-4 col-form-label text-md-end">Cidade</label>

                            <div class="col-md-6">
                                <input name="cidade" type="text" id="cidade" value="" size="10" maxlength="9" class="form-control @error('cidade') is-invalid @enderror" required autocomplete="name" autofocus/></label><br />
                            </div>
                        </div>

                        <div class="row mb-3">
                        <label for="num" class="col-md-4 col-form-label text-md-end">N??mero</label>
                        <div class="col-md-6">
                            <input id="num" type="text" class="form-control @error('num') is-invalid @enderror" name="num" value="{{ old('num') }}" required autocomplete="num" autofocus>

                            @error('num')
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
                                <input style="display:none;" id="profimagem" type="text" class="form-control @error('profimagem') is-invalid @enderror" name="profimagem" value="" required autocomplete="profimagem" >

                                @error('profimagem')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="d-flex justify-content-center ">
                        <p style="display:none;" class ="text-danger" id="erroprofessor">Por favor,escolha uma imagem</p>
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
                        
                            <div class="row ">
                            <label for="pcep" class="col-md-4 col-form-label text-md-end">Cep</label>

                            <div class="col-md-6">
                                <input name="pcep" type="text" id="pcep" value="" size="10" maxlength="9" class="form-control @error('pcep') is-invalid @enderror" required autocomplete="name" autofocus
                                onblur="ppesquisacep(this.value);" /></label><br />
                            </div>
                        </div>

                            <div class="row ">
                            <label for="prua" class="col-md-4 col-form-label text-md-end">Rua</label>

                            <div class="col-md-6">
                                <input name="prua" type="text" id="prua" value="" size="10" maxlength="9" class="form-control @error('prua') is-invalid @enderror" required autocomplete="name" autofocus/></label><br />
                            </div>
                        </div>

                            <div class="row ">
                            <label for="pbairro" class="col-md-4 col-form-label text-md-end">Bairro</label>

                            <div class="col-md-6">
                                <input name="pbairro" type="text" id="pbairro" value="" size="10" maxlength="9" class="form-control @error('pbairro') is-invalid @enderror" required autocomplete="name" autofocus/></label><br />
                            </div>
                        </div>

                            <div class="row ">
                            <label for="pcidade" class="col-md-4 col-form-label text-md-end">Cidade</label>

                            <div class="col-md-6">
                                <input name="pcidade" type="text" id="pcidade" value="" size="10" maxlength="9" class="form-control @error('pcidade') is-invalid @enderror" required autocomplete="name" autofocus/></label><br />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="pnum" class="col-md-4 col-form-label text-md-end">Numero</label>

                            <div class="col-md-6">
                                <input id="pnum" type="text" class="form-control @error('pnum') is-invalid @enderror" name="pnum" value="{{ old('pnum') }}" required autocomplete="pnum" autofocus>

                                @error('pnum')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" onclick="submit2(),verifica_imagemprof()">
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
                                    <input style="display:none;" id="cursoimagem" type="text" class="form-control @error('cursoimagem') is-invalid @enderror" name="cursoimagem" value="" required autocomplete="cursoimagem" >
    
                                    @error('cursoimagem')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                            <p style="display:none;" class="text-danger" id="errocurso">Por favor,escolha uma imagem</p>
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
                                <label for="descrisimp" class="col-md-4 col-form-label text-md-end">Descri????o Simples:</label>
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
                                <label for="descricomp" class="col-md-4 col-form-label text-md-end">Descri????o Detalhada:</label>
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
                                <label for="descricomp" class="col-md-4 col-form-label text-md-end">M??nimo de Alunos:</label>
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
                                <label for="maxalu" class="col-md-4 col-form-label text-md-end">M??ximo de Alunos:</label>
                                <div class="col-md-6">
                                    <input id="maxalu" type="number" class="form-control @error('maxalu') is-invalid @enderror" name="maxalu" value="{{ old('maxalu') }}" required autocomplete="maxalu" autofocus>
                                    @error('maxalu')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" onclick="verifica_imagemcurso()">
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
   
   if(isNaN(v[v.length-1])){ // impede entrar outro caractere que n??o seja n??mero
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
    
    
    function limpa_formul??rio_cep() {
            //Limpa valores do formul??rio de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
        } //end if.
        else {
            //CEP n??o Encontrado.
            limpa_formul??rio_cep();
            alert("CEP n??o encontrado.");
            document.getElementById('cep').value="Cep inv??lido";
        }
    }
        
    function pesquisacep(valor) {

        //Nova vari??vel "cep" somente com d??gitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Express??o regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conte??do.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep ?? inv??lido.
                limpa_formul??rio_cep();
                alert("Formato de CEP inv??lido.");
                document.getElementById('cep').value="Cep inv??lido";
            }
        } //end if.
        else {
            //cep sem valor, limpa formul??rio.
            limpa_formul??rio_cep();
            document.getElementById('cep').value="Cep inv??lido";
        }
    };



    function plimpa_formul??rio_cep() {
            //Limpa valores do formul??rio de cep.
            document.getElementById('prua').value=("");
            document.getElementById('pbairro').value=("");
            document.getElementById('pcidade').value=("");
    }

    function pmeu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('prua').value=(conteudo.logradouro);
            document.getElementById('pbairro').value=(conteudo.bairro);
            document.getElementById('pcidade').value=(conteudo.localidade);
        } //end if.
        else {
            //CEP n??o Encontrado.
            plimpa_formul??rio_cep();
            palert("CEP n??o encontrado.");
            document.getElementById('pcep').value="Cep inv??lido";
        }
    }
        
    function ppesquisacep(valor) {

        //Nova vari??vel "cep" somente com d??gitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Express??o regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('prua').value="...";
                document.getElementById('pbairro').value="...";
                document.getElementById('pcidade').value="...";

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=pmeu_callback';

                //Insere script no documento e carrega o conte??do.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep ?? inv??lido.
                plimpa_formul??rio_cep();
                alert("Formato de CEP inv??lido.");
                document.getElementById('pcep').value="Cep inv??lido";
            }
        } //end if.
        else {
            //cep sem valor, limpa formul??rio.
            plimpa_formul??rio_cep();
            document.getElementById('pcep').value="Cep inv??lido";
        }
    };

    function verifica_imagemcurso(){
        if(document.getElementById("cursoimagem").value.length == 0){
        document.getElementById("errocurso").style.display = "block";
        }
    }

    function verifica_imagemprof(){
        if(document.getElementById("profimagem").value.length == 0){
        document.getElementById("erroprofessor").style.display = "block";
        }
    }


    </script>

    


@endsection

