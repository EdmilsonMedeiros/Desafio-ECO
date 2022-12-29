<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Login') }}</title> --}}
    <title>{{ 'Desafio ECO CONSULTORIA!' }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&family=Inconsolata&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js', 'resources/css/style.css'])
    {{-- <style>

    </style> --}}
        {{-- JQuery --}}
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <!--DataTables-->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
        <script type="text/javascript" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

        <!--Google Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Archivo+Narrow&display=swap" rel="stylesheet">

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-primary shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('contribuicao.index') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    {{'Desafio ECO CONSULTORIA!'}}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Cadastrar') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#aboutModal">
                                        {{ __('Sobre') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <main class="py-4">
            @yield('content')
        </main>
    </div>



        {{-- <!-- Modal recibo-->
        <div class="modal fade" id="modal-recibo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><img src="{{ asset('img/receipt.png') }}" alt=""> Recibo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="row recibo col-10 offset-1">
                            <div class="recibo-header">
                                <h5>Consectetur adipiscing elit. </h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras sollicitudin lectus sit amet metus mattis maximus.</p>
                            </div>
                            <div class="">
                                <label for="">Recibo.........:</label>
                                {{'1'}}
                            </div>

                            <div class="">
                                <label for="">Valor..........:</label>
                                {{'1'}}
                            </div>

                            <div class="">
                                <label for="">Data...........:</label>
                                {{'1'}}
                            </div>

                            <div class="">
                                <label for="">Mensageiro.....:</label>
                                {{'1'}}
                            </div>

                            <div class="">
                                <label for="">Contribuinte/ID:</label>
                                {{'1'}}
                            </div>
                            <hr>
                            <div class="">
                                <label for="">Status:</label>
                                <select name="status" id="" class="form-control">
                                    <option value="">Pendente</option>,
                                    <option value="">Recebido</option>
                                    <option value="">Cancelado</option>
                                </select>
                            </div>

                            <p class="p-recibo-right"><br>Cras sollicitudin lectus 7789825614</p>
                        </div>
                        <div class="">
                            <button type="submit" class="btn btn-primary">Atualizar status</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
            </div>
        </div> --}}

        <!-- Modal cadastro contribuinte-->
        <div class="modal fade modal-lg" id="modal-cadastrar-contribuinte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><img src="{{ asset('img/doacao.png') }}" alt=""> Cadastrar Contribuinte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                        <div class="row">
                            <form action="{{ route('contribuinte.store') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-6">
                                        <label for="">Nome</label>
                                        <input name="nome" type="text" max="50" placeholder="Nome do contribuinte" class="form-control" required>
                                    </div>

                                    <div class="col-6">
                                        <label for="">Telefone</label>
                                        <input name="telefone" type="text" placeholder="(99)99999-9999" class="form-control" required>
                                    </div>

                                    <div class="col-4">
                                        <label for="">CEP</label>
                                        <input name="cep" type="number" placeholder="59000000" class="form-control" required>
                                    </div>
                                    <div class="col-8">
                                        <label for="">Rua</label>
                                        <input name="rua" type="text" placeholder="Rua da Pedra" class="form-control" required>
                                    </div>
                                    <div class="col-2">
                                        <label for="">Número</label>
                                        <input name="numero" type="number" placeholder="00" class="form-control" required>
                                    </div>
                                    <div class="col-10">
                                        <label for="">Bairro</label>
                                        <input name="bairro" type="text" placeholder="" class="form-control" required>
                                    </div>
                                    <div class="col-5">
                                        <label for="">Cidade</label>
                                        <input name="cidade" type="text" placeholder="" class="form-control" required>
                                    </div>
                                    <div class="col-7">
                                        <label for="">Estado</label>
                                        <input name="estado" type="text" placeholder="Rio Grando do Norte" class="form-control" required>
                                    </div>
                                    <div class="col-12">
                                        <label for=""></label>
                                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
            </div>
        </div>

        <!-- Modal contribuinte-->
        {{-- <div class="modal fade" id="modal-contribuinte" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><img src="{{ asset('img/doacao.png') }}" alt=""> Contribuinte</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>
            </div>
            </div>
        </div> --}}


    <!-- Modal sobre-->
    <div class="modal fade modal-lg" id="aboutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sobre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <h4>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</h4>
                        <h5>"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."</h5>
                        <div class="col-12 text_title_line"></div><br>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vel ipsum eu ex condimentum lacinia a at tellus. Fusce vestibulum a orci vulputate mollis. Aliquam mollis purus eget tristique accumsan. Proin eu turpis suscipit, malesuada neque quis, tempor mi. Nam auctor bibendum enim vel egestas. Praesent in ipsum id purus pharetra vestibulum. Suspendisse condimentum dui tincidunt lectus posuere, a congue libero gravida. Nunc accumsan magna ut urna gravida vestibulum. Etiam turpis sem, fermentum vitae justo non, auctor feugiat libero. Mauris bibendum pulvinar erat, sit amet malesuada nulla hendrerit in.</p>

                        <p>Pellentesque orci ipsum, ultrices vitae mi non, maximus euismod purus. Fusce ullamcorper bibendum lorem at lobortis. Proin nisl dui, malesuada vel aliquet sed, fringilla eu orci. Duis euismod ante non metus dictum tempor. Suspendisse eleifend ultrices nunc id ultricies. Fusce vitae tempor arcu. Ut iaculis ut odio in gravida. Vestibulum at laoreet erat. Vestibulum varius purus et quam ornare, in malesuada nunc rhoncus. Pellentesque aliquam lacus et bibendum pulvinar. Praesent pharetra risus sed pretium posuere. Interdum et malesuada fames ac ante ipsum primis in faucibus.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
        </div>
    </div>

</body>
</html>
