<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>YahP! Cursos</title>
    <link rel="icon" type="image/png" sizes="32x32" href="https://www.yahp.com.br/website/img/logos/favicon/favicon-32x32.png">

    <link rel="stylesheet" href="/css/styles.css">
    

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria&family=Roboto&family=Secular+One&display=swap" rel="stylesheet">

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light  shadow-sm" style="background-color: rgb(48,96,170);">
            <div class="container">
                <a class="navbar-brand  navbartext" style="color: #f08416; font-size: 30px;" href="{{ url('/') }}">
                    {{  'YahP! Cursos' }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto ">
                        
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link text-white navbartext" href="/cursos">Cursos</a>
                        </li>
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item navbartext">
                                    <a class="nav-link text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown " class="nav-link dropdown-toggle text-light navbartext"  role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                    @if (Auth::user()->imagem)
                                        <img class="ms-2 profilepick" src="{{ Auth::user()->imagem }}" alt="profile picture">
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    @if(Auth::user()->perm == 0)
                                        <a href="/home" class="dropdown-item ">Meus cursos</a>
                                        <a class="dropdown-item" href="/home/{{ Auth::user()->id}}">
                                            Meu perfil
                                        </a>
                                    @endif
                                    @if(Auth::user()->perm == 1)
                                    
                                    <a class="dropdown-item" href="/professor">
                                        Cursos lecionados
                                    </a>
                                    <a class="dropdown-item" href="/professor/{{ Auth::user()->id}}">
                                        Meu perfil
                                    </a>
                                    @endif
                                    @if(Auth::user()->perm == 2)
                                        <a href="/admin" class="dropdown-item ">Admin</a>
                                        <a href="/admin/editpassword/{{ Auth::user()->id}}" class="dropdown-item ">Mudar senha</a>
                                    @endif
                                    @if(Auth::user()->perm == 3)
                                    <a href="/home" class="dropdown-item ">Área do aluno</a>
                                    <a class="dropdown-item" href="/professor">
                                        Área do professor
                                    </a>
                                    <a href="/admin" class="dropdown-item ">Área da secretaria</a>
                                    <a href="/admin/editpassword/{{ Auth::user()->id}}" class="dropdown-item ">Mudar senha</a>
                                    @endif
                                    

                                    
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Sair') }}
                                    </a>
                                    
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>

                                </div>

                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        @if (session('erro'))
        <div class="alert alert-danger" role="alert">
            {{ session('erro') }}
        </div>
        @endif

        <main class="py-4">
            @yield('content')
        </main>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>
