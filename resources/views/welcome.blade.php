@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>YahP! Cursos</title>

        <!-- Fonts -->
    

        <!-- Styles -->
        <style>
           
        </style>
    </head>
    <body>
        <div class="container"  style="margin-top: 75px">
            <div class="row">
                <div class="col-6">
                <img  style="width: 90%; height: 90%;" src="https://www.yahp.com.br/website/img/logos/yahp-orange_2.png" alt="yaph image">
                </div>
                <div class="col-6">
                  
                    <h2 class="mt-5 title ">Conheça a Plataforma de cursos gratuítos mais íncrivel do Brasil</h2>
                    <p >Nós da Yaph oferecemos diversos cursos com certificado para a área de programação,
                        tudo isso de forma gratuita! Venha ser um Yapper, fale com a secretaria para fazer a matrícula! </p>
                </div>

            </div>
        </div>

        <div class = "container" style="margin-top: 150px">
            <div class="row">
                <div class="col-3">
                    <div class="card" style="width: 18rem; background-color: #EBF3FE;">
                        <img  style="width: 50px; height: 50px; margin-right: auto; margin-left: auto;" src="images/frontlogo.png" class="card-img-top mt-4" alt="...">
                        <div class="card-body">
                          <h5 class="card-title title" style="text-align:center;">Front-End</h5>
                          <p class="card-text">Aprenda a os conceitos primordiais de criação de sites, incluindo
                            HTML,CSS,Javascript e o framework bootstrap
                          </p>
                          
                        </div>
                      </div>
                </div>

                <div class="col-3">
                    <div class="card" style="width: 18rem; background-color: #EBF3FE;">
                        <img  style="width: 50px; height: 50px; margin-right: auto; margin-left: auto;" src="images/backlogo.png" class="card-img-top mt-4" alt="...">
                        <div class="card-body">
                          <h5 class="card-title title" style="text-align:center;">Back-End</h5>
                          <p class="card-text">Aprenda a linguagem PHP e o framework laravel para desenvolver 
                            o back-end de sistemas web
                          </p>
                          
                          
                        </div>
                      </div>
                </div>

                <div class="col-3">
                    <div class="card" style="width: 18rem; background-color: #EBF3FE;">
                        <img  style="width: 50px; height: 50px; margin-right: auto; margin-left: auto;" src="images/datalogo.png" class="card-img-top mt-4" alt="...">
                        <div class="card-body">
                          <h5 class="card-title title" style="text-align:center;">Databases</h5>
                          <p class="card-text">Aprenda como utilizar bancos de dados relacionais como 
                            MYSQL e Postgress, e bancos de dados não relacionais como MONGODB
                          </p>
                          
                        </div>
                      </div>
                </div>

                <div class="col-3">
                    <div class="card" style="width: 18rem; background-color: #EBF3FE; ">
                        <img  style="width: 50px; height: 50px; margin-right: auto; margin-left: auto;" src="images/gitlogo.png" class="card-img-top mt-4" alt="...">
                        <div class="card-body">
                          <h5 class="card-title title" style="text-align:center;">Github e Gitflow</h5>
                          <p class="card-text" style="margin-bottom: 24px;">Aprenda como utilizar o git/github e organizar a produção de 
                            projetos em equipe a partir do gitflow
                          </p>
                          
                        </div>
                      </div>
                </div>


            </div>
        </div>
    </body>
</html>
@endsection