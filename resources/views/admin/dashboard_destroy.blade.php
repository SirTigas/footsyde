@extends('admin.layouts.layout')

@section('conteudo')
<div class="container-fluid text-center" style="margin: 30px 0px 0px 0px">
    <h1 style="color: red;"><b>ATENÇÃO!</b></h1>

    <h5>AO CLICAR NO BOTÃO VERMELHO "APAGAR", O PRODUTO SERÁ EXCLUÍDO DO BANCO DE DADOS E NÃO SERÁ POSSÍVEL RECUPERÁ-LO!</h5>
    <p><small>PARA APAGAR TODOS OS PRODUTOS ACESSE: </small></p>
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
        <form action="{{ route('admin.destroy') }}" method="POST" class="d-flex" role="search">
            @csrf
            <input class="form-control me-3" type="number" placeholder="CÓDIGO DO PRODUTO" aria-label="Search" name="code"/>
            <button class="btn btn-danger" type="submit"><i class="bi bi-trash-fill"></i> <b>APAGAR</b></button>
        </form>
    </div>
</div>
@endsection