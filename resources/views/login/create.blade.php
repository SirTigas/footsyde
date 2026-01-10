@extends('login.layouts.layout')
@section('title', 'Criar novo usuário')

@section('conteudo')
<body>
    <br>
    <div class="container-fluid col-4">
        <div class="card">
            <div class="card-header">
                Criar novo usuário
            </div>
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name') }}">
                        @error('name')
                            <span>
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Sobrenome</label>
                        <input type="txt" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name') }}">
                        @error('last_name')
                            <span>
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="emailHelp" name="email" value="{{ old('email') }}">
                        <div id="emailHelp" class="form-text">Seu email não será compartilhado com ninguém</div>
                        @error('email')
                            <span>
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        @if ($mensagem = Session::get('erro'))
                            <span>
                                <strong style="color:red">{{ $mensagem }}</strong>
                            </span>
                        @endif                        
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

                    <button type="submit" class="btn btn-primary">CADASTRAR</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

@endsection
