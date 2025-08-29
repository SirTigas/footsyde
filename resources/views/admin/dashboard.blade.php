{{--
@extends('site.layouts.layout')


@section('conteudo')
<h1>Olá, <b>{{ auth()->user()->name }}</b></h1>
<div class="container">
    <div class="row">
        <nav class="navbar bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand">Navbar</a>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Buscar produto" aria-label="Search"/>
                    <button class="btn btn-outline-success" type="submit">Buscar!</button>
                </form>
            </div>
        </nav>
    </div>
</div>
@endsection
--}}

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Footsyde - Dashboard</title>

        <!--css-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">

        <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    </head>
    <body>
        <!--navbar-->
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.dashboard') }}"><img src="{{ asset('images/logo.png') }}" alt="" width="200px"> Dashboard</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                    <ul class="navbar-nav highlight">

                        <li class="nav-item highlight">
                            <a class="nav-link active" aria-current="page" href="{{ route('site.home') }}">Home</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('site.sobre') }}">Sobre</a>
                        </li>

                        @auth
                            <li class="nav-item">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Olá, <b>{{ auth()->user()->name }}</b> </a>
                                <ul class="dropdown-menu">
                                
                                    @if(Auth::user()->role == 'admin')
                                        <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                    @endif

                                    <li><a class="dropdown-item" href="{{ route('login.logout') }}">Sair</a></li>
                                </ul>
                        @else
                            <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        @endauth
                    </ul>
                    <form class="d-flex" role="search" action="{{ route('products.search') }}" methodo="GET">
                        <input class="form-control me-2" type="search" placeholder="Nome do produto" aria-label="Search" name="name"/>
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </form>
                </div>
            </div>
            </nav>
        </header>

        <div class="container-fluid" style="margin:30px 0px 0px 0px">
            @if ($mensagem = Session::get('sucess'))
                {{ $mensagem }}
            @endif

            @foreach ($products as $p )
                <form action="{{ route('admin.update') }}" method="POST">
                    @csrf
                    <div class="col d-flex justify-content-center">
                        <div class="card mb-3" style="max-width: 1100px;">
                            <div class="row g-0">
                                
                                <!-- Imagem -->
                                <div class="col-md-3">
                                    <a href="{{ route('products.show', $p->slug) }}">
                                        <img src="{{ asset($p->image_path) }}" class="img-fluid rounded-start" alt="{{ strtoupper($p->name) }}">
                                    </a>
                                </div>

                                <!-- Conteúdo -->
                                <div class="col-md-9">
                                    <div class="card-body d-flex flex-column justify-content-between h-100">
                                        <div>
                                            <div class="d-flex justify-content-between align-items-center mt-2">
                                                <h5 class="card-title">
                                                    
                                                    Nome: <input type="text" name="name" value="{{ strtoupper($p->name) }}">  
                                                    
                                                </h5>

                                                <form action="{{ route('admin.destroy') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $p->id }}" name="id">
                                                    <input type="hidden" value="{{ $p->name }}" name="name">
                                                    <button type="submit" class="btn-close" aria-label="Close"></button>
                                                </form>
                                                                                                
                                            </div><br>
                                                                                        
                                            <p>Descrição: <textarea name="description" value="">{{ $p->description }}</textarea></p>
                                            Fornecedor: <input type="option" name="fornecedor" value="{{ $p->fornecedor }}">
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center mt-2"> 
                                                <div class="d-flex justify-content-end">
                                                    R$ <input type="decimal" name="price" value="{{ $p->price }}">

                                                    Estoque: <input type="number" name="stock" value="{{ $p->stock }}" class="form-control form-control-sm" style="width: 100px;">
                                                    
                                                    Categoria:  <select name="category_id">
                                                                    <option value="{{ $p->category_id }}">{{ $p->category_id }}</option>
                                                                    <option value="1">1 - Homem</option>
                                                                    <option value="2">2 - Mulher</option>
                                                                    <option value="3">3 - Unissex</option>
                                                                </select>

                                                    <input type="hidden" name="id" value="{{ $p->id }}">

                                                    <button type="submit" class="btn btn-success" style="margin: 0px 0px 0px 10px"><b>ATUALIZAR</b></button>
                                                    
                                                                                                            
                                                </div>                              
                                        </div>
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </div>
                </form> 
            @endforeach
            {{ $products->links() }}
        </div>
        

        <!--JS-->
        <footer>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
        </footer>
    </body>
</html>