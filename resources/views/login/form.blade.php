<!DOCTYPE html>
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
</html>