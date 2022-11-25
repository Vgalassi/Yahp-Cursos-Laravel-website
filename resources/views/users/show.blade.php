@extends('layouts.app')

@section('content')
@if($user->perm == 1)
<img class="displayimage" src="{{ $user->imagem }}" alt="profile picture">
@endif
<p></p>

<div class="container">
  <h1>{{ $user->name }}</h1>
  <p>@if ($user->perm == 0)
<p>Email: {{ $user->email }}</p>
@endif 
<p>CPF: {{ $user->CPF }}</p>
<p>CEP: {{ $user->endereco }}</p>

<p >Rua: <span id="rua"></span></p>
<p>Bairro: <span id="bairro"></span></p>
<p>Cidade: <span id="cidade"></span></p>
@if ($user->perm == 0)
<p>Filme: {{ $user->filme }}</p>
<a href="/home/edit/{{ $user->id}}">Editar Dados</a>
<a href="/home/edit/password/{{ $user->id}}">Mudar senha</a>
@else
<a href="/professor/edit/{{ $user->id }}">Editar Dados</a>
<a href="/professor/edit/password/{{ $user->id}}">Mudar senha</a>
@endif </p>
</div>


<script>
    pesquisacep( '{{ $user->endereco }}' );
    function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').innerHTML=("");
            document.getElementById('bairro').innerHTML=("");
            document.getElementById('cidade').innerHTML=("");
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').innerHTML=(conteudo.logradouro);
            document.getElementById('bairro').innerHTML=(conteudo.bairro);
            document.getElementById('cidade').innerHTML=(conteudo.localidade);
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
                document.getElementById('rua').innerHTML="...";
                document.getElementById('bairro').innerHTML="...";
                document.getElementById('cidade').innerHTML="...";

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
