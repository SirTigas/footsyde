<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footsyde - CREATE</title>
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
    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        Nome: <br> <input type="text" name="name"> <br>

        Sobrenome: <br> <input type="text" name="last_name"> <br>

        Email: <br> <input name="email"> <br>

        Senha: <br> <input type="password" name="password"> <br><br>

        <button type="submit"> CADASTRAR </button> <button><a href="{{ route('login') }}">LOGIN</a></button>

    
    </form>
</body>
</html>