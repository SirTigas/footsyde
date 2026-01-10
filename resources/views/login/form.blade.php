@extends('login.layouts.layout')
@section('title', 'Fazer Login')

@section('conteudo')

<body>
    <br>
    <div class="container-fluid col-4">
        <div class="card">
            <div class="card-header">
                Fazer Login
            </div>
            <div class="card-body">
                <form action="{{ route('login.auth') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <span>
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                        @error('password')
                            <span>
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1" name="remember">
                        <label class="form-check-label" for="exampleCheck1" >Lembrar-me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">ENTRAR</button> <a href="#">Esqueci a senha</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

@endsection


{{-- <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footsyde - LOGIN</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
</head>

@if ($mensagem = Session::get('erro'))
    {{ $mensagem }}
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error )
        {{ $error }} <br>
    @endforeach
@endif

<body>
    <form action="{{ route('login.auth') }}" method="POST">
        @csrf
        Email: <br> <input name="email"> <br>

        Senha: <br> <input type="password" name="password"> <br><br>

        <button type="submit"> ENTRAR </button> <button><a href="{{ route('register') }}">CRIAR</a></button>

        <br>Lembrar-me: <input type="checkbox" name="remember">
    
    </form>
</body>
</html> --}}