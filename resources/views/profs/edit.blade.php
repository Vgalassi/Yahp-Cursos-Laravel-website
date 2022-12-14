@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar') }}</div>

                <div class="card-body">
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
                        <img class="displayimage" src="{{ $user->imagem }}" alt="" id = "main">   
                        <img  class="hide displayimage" src="/images/profavatar/atumalaca.jpg" alt="" id = "atumalaca">
                        <img  class="hide displayimage" src="/images/profavatar/wisetree.jpg" alt="" id = "wisetree">
                        <img  class="hide displayimage" src="/images/profavatar/messicareca.jpg" alt="" id = "messi">
                    </div>

                    <form method="POST" action="/professor/update/{{ $user->id}}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="imagem" class="col-md-4 col-form-label text-md-end"></label>
                            <div class="col-md-6">
                                <input  style="display:none;"id="imagem" type="text" class="form-control @error('imagem') is-invalid @enderror" name="imagem" value="{{ $user->imagem }}" required autocomplete="imagem" autofocus>

                                @error('imagem')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nome Completo</label>

                            <div class="col-md-6">
                                <input id="name" type="text" value = "{{ $user->name }}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="username" class="col-md-4 col-form-label text-md-end">Nome de Usu??rio</label>

                            <div class="col-md-6">
                                <input id="username" type="text" value = "{{ $user->username }}" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        

                        <div class="row mb-3">
                            <label for="CPF"  class="col-md-4 col-form-label text-md-end">CPF</label>

                            <div class="col-md-6">
                                <input id="CPF" value = "{{ $user->CPF }}" oninput="mascara(this)" type="text" class="form-control @error('CPF') is-invalid @enderror" name="CPF" value="{{ old('CPF') }}" required autocomplete="CPF" autofocus>

                                @error('CPF')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3"> 
                            <label for="endereco" class="col-md-4 col-form-label text-md-end">Cep</label>

                            <div class="col-md-6">
                                <input name="endereco" type="text" id="endereco" value = "{{ $user->endereco }}" size="10" maxlength="9" class="form-control @error('endereco') is-invalid @enderror"
                                onblur="pesquisacep(this.value);" />
                                @error('endereco')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                            <label for="num" class="col-md-4 col-form-label text-md-end">Numero</label>
                        <div class="col-md-6">
                            <input id="num" type="text" class="form-control @error('num') is-invalid @enderror" name="num" value="{{ $user->num }}" required autocomplete="num" autofocus>

                            @error('num')
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
<script>
   
    texto = "Foto de Perfil";
    document.getElementById("texto").innerHTML = texto;

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


  function atumalaca(){
        document.getElementById("main").style.display = "none";
        document.getElementById("wisetree").style.display = "none";
        document.getElementById("messi").style.display = "none";
        document.getElementById("atumalaca").style.display = "block";
        document.getElementById("imagem").value = "/images/profavatar/atumalaca.jpg";
        texto = "Atumalaca";
        document.getElementById("texto").innerHTML = texto;
    }
    function wise(){
        document.getElementById("main").style.display = "none";
        document.getElementById("atumalaca").style.display = "none";
        document.getElementById("messi").style.display = "none";
        document.getElementById("wisetree").style.display = "block";
        document.getElementById("imagem").value = "/images/profavatar/wisetree.jpg";
        texto = "Wise Tree";
        document.getElementById("texto").innerHTML = texto;
    }

    function messi(){
        document.getElementById("main").style.display = "none";
        document.getElementById("wisetree").style.display = "none";
        document.getElementById("atumalaca").style.display = "none";
        document.getElementById("messi").style.display = "block";
        document.getElementById("imagem").value = "/images/profavatar/messicareca.jpg";
        texto = "Messi";
        document.getElementById("texto").innerHTML = texto;
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
            document.getElementById('endereco').value="Cep inv??lido";
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
                document.getElementById('endereco').value="Cep inv??lido";
                alert("Formato de CEP inv??lido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formul??rio.
            limpa_formul??rio_cep();
            document.getElementById('endereco').value="Cep inv??lido";
        }
    };


</script>
@endsection
