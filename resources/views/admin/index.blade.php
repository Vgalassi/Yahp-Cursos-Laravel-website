@extends('layouts.app')

@section('content')




<div style="text-align: center;" class="container">
  <h1>Página da Secretaria</h1>
  <div class="btn-group mt-3">
<form action="/admin/create">
    <button type="submit" class="btn btn-primary ms-5">Adicionar dados</button>
</form>
<form action="/admin/linkprof">
    <button type="submit" class="btn btn-primary ms-5">Relacão professor-matéria</button>
</form>
</div>
</div>


<table class="table container mt-3 table-hover">
  <thead class="table-success">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Curso</th>
      <th scope="col">Ações</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($cursos as $curso)
  <div class="modal fade" id="{{ $curso->descricomp }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>

<tr>
      <th scope="row">{{ $curso->id }}</th>
      <td>{{ $curso->name }}</td>
      <td>
        <div class="d-flex">
        <form action="/admin/show/{{ $curso->id }}">
        <button type="submit" class="btn btn-sm btn-info">
            <img src="/images/info-icon.png" alt="Info" class="icons rounded mx-auto d-block">
        </button> 
      </form>
        <form action="/admin/editcurso/{{ $curso->id }}">
        <button type="submit" class="btn btn-sm btn-success">
            <img src="/images/edit-icon.png" alt="Editar" class="icons rounded mx-auto d-block">
        </button>
      </form >
        <form action="/admin/deletecurso/{{ $curso->id }}" method="POST">
            @csrf
            @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger">
            <img src="/images/bin-icon.png" alt="Remover" class="icons rounded mx-auto d-block ">
        </button>
        </form>
        </div>
      </td>
    
      
    </tr>
    @endforeach
    
  </tbody>

  <thead class="table-primary">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Professor</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
    @if ($user->perm == 1)
    <div class="modal fade" id="{{ $user->username }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{ $user->name }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <img class="displayimage" src="{{ $user->imagem }}" alt="professor image">
              <p>Nome:{{ $user->name }}</p>
              <p>Nome de usuário:{{ $user->username }}</p>
              <p>CPF:{{ $user->CPF }}</p>
              <p>Endereço:{{ $user->endereco }}</p>
              <p>Número: {{ $user->num }}</p>
              <p>Último login: {{ $user->login }}</p>
              <p>Cursos lecionados: </p>
                @foreach ($cursos as $curso)
                @if($curso->user_id == $user->id)
                    <p> {{ $curso->name }}</p>
                @endif
                @endforeach
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
    
            </div>
          </div>
        </div>
      </div>
    <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>
          <div class="d-flex">
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#{{ $user->username }}">
                <img src="/images/info-icon.png" alt="Info" class="icons rounded mx-auto d-block">
            </button>
            
            <form action="/admin/editprof/{{ $user->id }}">
                <button type="submit" class="btn btn-sm btn-success">
                    <img src="/images/edit-icon.png" alt="Editar" class="icons rounded mx-auto d-block my-1">
                </button>
                </form>
                <form action="/admin/changeuser/{{ $user->id }}">
                  <button type = "submit" class="btn btn-warning" >
                    <img src="/images/lockicon.png" alt="Editar senha" class="icons rounded mx-auto d-block mb-1">
                  </button>
                </form>
            <form action="/admin/deleteuser/{{ $user->id }}" method="POST">
                @csrf
                @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">
                <img src="/images/bin-icon.png" alt="Remover" class="icons rounded mx-auto d-block my-1">
            </button>
            </form>
            </div>
            
        </td>

    </tr>
    @endif
    @endforeach
    </tbody> 

  <thead class="table-warning">
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Aluno</th>
            <th scope="col">Ações</th>
        </tr>
  </thead>
    <tbody>
    @foreach ($users as $user)
    @if ($user->perm == 0)
    <div class="modal fade" id="{{ $user->username }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">{{ $user->name }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <p>Nome:{{ $user->name }}</p>
              <p>Nome de usuário:{{ $user->username }}</p>
              <p>CPF:{{ $user->CPF }}</p>
              <p>Filme favorito:{{ $user->filme }}</p>
              <p>Endereço:{{ $user->endereco }}</p>
              <p>Rua:  <span id ="{{ $user->id }}r"></span></p>
              <p>Bairro: <span id="{{ $user->id}}b" ></span></p>
              <p>Cidade: <span id="{{ $user->id }}c" ></span></p>
              <p>Número: {{ $user->num }}</p>
              <p>Último login: {{ $user->login }}</p>
              <p>Cursos matriculados: </p>
                @foreach ($user->cursos as $user->curso)
                    <p> {{$user->curso->name }}</p>
                @endforeach
              
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
    
            </div>
          </div>
        </div>
      </div>
    <tr>
        <th scope="row">{{ $user->id }}</th>
        <td>{{ $user->name }}</td>
        <td>
          <div class="d-flex">
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#{{ $user->username }} " onclick="pesquisacep('{{ $user->endereco }}', '{{ $user->id }}')">
                <img src="/images/info-icon.png" alt="Info" class="icons rounded mx-auto d-block">
            </button>
            <form action="/admin/editalu/{{ $user->id }}">
            <button type="submit" class="btn btn-sm btn-success">
                <img src="/images/edit-icon.png" alt="Editar" class="icons rounded mx-auto d-block my-1">
            </button>
            </form>
              <form action="/admin/changeuser/{{ $user->id }}">
                <button type = "submit" class="btn btn-warning" >
                  <img src="/images/lockicon.png" alt="Editar senha" class="icons rounded mx-auto d-block mb-1">
                </button>
              </form>
            <form action="/admin/deleteuser/{{ $user->id }}" method="POST">
                @csrf
                @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">
                <img src="/images/bin-icon.png" alt="Remover" class="icons rounded mx-auto d-block my-1">
            </button>
            </form>
        </td>
          </div>

    </tr>
    @endif
    @endforeach
    </tbody>
     
</table>

<script>
 var id;
  function limpa_formulário_cep() {
          //Limpa valores do formulário de cep.
          document.getElementById(id+'r').innerHTML=("");
          document.getElementById(id+'b').innerHTML=("");
          document.getElementById(id+'c').innerHTML=("");
  }

  function meu_callback(conteudo) {
      if (!("erro" in conteudo)) {
          //Atualiza os campos com os valores.
          document.getElementById(id+'r').innerHTML=(conteudo.logradouro);
          document.getElementById(id+'b').innerHTML=(conteudo.bairro);
          document.getElementById(id+'c').innerHTML=(conteudo.localidade);
      } //end if.
      else {
          //CEP não Encontrado.
          limpa_formulário_cep();
          alert("CEP não encontrado.");
      }
  }
      
  function pesquisacep(valor,idpassado) {
      id = idpassado;

      //Nova variável "cep" somente com dígitos.
      var cep = valor.replace(/\D/g, '');

      //Verifica se campo cep possui valor informado.
      if (cep != "") {

          //Expressão regular para validar o CEP.
          var validacep = /^[0-9]{8}$/;

          //Valida o formato do CEP.
          if(validacep.test(cep)) {

              //Preenche os campos com "..." enquanto consulta webservice.
              document.getElementById(id+'r').innerHTML="...";
              document.getElementById(id+'b').innerHTML="...";
              document.getElementById(id+'c').innerHTML="...";

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