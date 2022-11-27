@extends('layouts.app')
@section('content')
<div class="card" style="width: 25rem;">
@if($user->perm == 1)
<img style="width:150px; height:150px;"class="displayimage" src="{{ $user->imagem }}" alt="profile picture">
@endif
  <div class="card-body"><ul class="list-group list-group-flush">
    <h5 class="card-title">{{ $user->name }}</h5>
@if ($user->perm == 0)
    <p class="card-text">Email: {{ $user->email }}</p>
@endif 

    <p class="card-text">CPF:{{ $user->CPF }}</p>
    <p class="card-text">Endereço: {{ $user->endereco }}</p>
<p class="card-text">Rua: <span id="rua"></span></p>
<p class="card-text">Bairro: <span id="bairro"></span></p>
<p class="card-text">Cidade: <span id="cidade"></span></p>
<p class="card-text">Número: {{ $user->num }}</p>

@if ($user->perm == 0)
<p class="card-text">Filme: {{ $user->filme }}</p>
<a href="/home/edit/{{ $user->id}}">Editar Dados</a>
<a href="/home/edit/password/{{ $user->id}}">Mudar senha</a>
@else
<a href="/professor/edit/{{ $user->id }}">Editar Dados</a>
<a href="/professor/edit/password/{{ $user->id}}">Mudar senha</a>
@endif 

</div>  
<style>.card {
  margin-top: 2em;
  padding: 1.5em 0.5em 0.5em;
  border-radius: 2em;
  text-align: center;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
}
.card img {
  width: 65%;
  
  margin: 0 auto;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}
.card .card-title {
  font-weight: 700;
  font-size: 1.5em;
}
.card .btn {
  border-radius: 2em;
  background-color: teal;
  color: #ffffff;
  padding: 0.5em 1.5em;
}
.card .btn:hover {
  background-color: rgba(0, 128, 128, 0.7);
  color: #ffffff;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}</style>

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
