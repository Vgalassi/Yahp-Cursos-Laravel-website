@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editar') }}</div>

                <div class="card-body">
                    <form method="POST" action="/home/update/{{ $user->id}}">
                        @csrf
                        @method('PUT')

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
                            <label for="username" class="col-md-4 col-form-label text-md-end">Nome de Usuário</label>

                            <div class="col-md-6">
                                <input id="username" type="text" value = "{{ $user->username }}" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('name') }}" required autocomplete="username" autofocus>

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
                                <input id="email" type="email" value = "{{ $user->email }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
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
                                <input name="endereco" type="number" id="endereco" value = "{{ $user->endereco }}" size="10" maxlength="9" class="form-control"
                                onblur="pesquisacep(this.value);" />
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
                            <label for="filme" class="col-md-4 col-form-label text-md-end">Filme Favorito</label>

                            <div class="col-md-6">
                                <input id="filme" type="text" value = "{{ $user->filme }}" class="form-control @error('filme') is-invalid @enderror" name="filme" value="{{ old('filme') }}" required autocomplete="name" autofocus>

                                @error('filme')
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
  
  function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
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
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
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

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };


</script>
@endsection
