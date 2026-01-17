@if(Auth::user()->role === 'admin' && Auth::user()->email_verified_at != NULL)
    @extends('admin.layouts.layout')

    @section('conteudo')
    <div class="container-fluid text-center" style="margin: 30px 0px 0px 0px">
        <h1 style="color: red;"><b>ATENÇÃO!</b></h1>

        <h5>AO CLICAR NO BOTÃO VERMELHO "APAGAR TUDO", TODOS OS PRODUTOS SERÃO EXCLUÍDOS DO BANCO DE DADOS E NÃO SERÁ POSSÍVEL RECUPERÁ-LOS!</h5>
    </div>

    <div class="row">
        <div class="col d-flex justify-content-center justify-content-center">
            @if ($mensagem = Session::get('success'))
                <p>{{ $mensagem }}</p>
            @endif

            @if ($mensagem = Session::get('erro'))
                <p>{{ $mensagem }}</p>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col d-flex justify-content-center justify-content-center">
            <form action="{{ route('admin.clear') }}" method="POST" class="d-flex" role="search">
                @csrf
                <button class="btn btn-danger btn-lg" type="submit"><i class="bi bi-trash-fill"></i> <b>APAGAR TUDO</b></button>
            </form>
        </div>
    </div>
    @endsection
@endif
