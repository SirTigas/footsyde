<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footsyde @hasSection('title') - @yield('title') @endif</title>

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
            <a class="navbar-brand" href="{{ route('site.home') }}"><img src="{{ asset('images/logo.png') }}" alt="" width="200px"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNavDropdown">
                <ul class="navbar-nav highlight">
                    <li class="nav-item highlight">
                        <a class="nav-link active" aria-current="page" href="{{ route('login') }}">Login</a>
                    </li>

                    <li class="nav-item highlight">
                        <a class="nav-link active" aria-current="page" href="{{ route('register') }}">Criar</a>
                    </li>
                </ul>
            </div>
        </div>
        </nav>
    </header>

    @yield('conteudo')

    <footer>
        <!--JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script>
    </footer>
</body>
</html>